<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//session_start();
require_once('../config.php');

/*if (!isset($_POST['otp']) || !isset($_SESSION['otp']) || $_POST['otp'] != $_SESSION['otp']) {
    echo json_encode(["status" => "failed", "msg" => "Invalid OTP! Please try again."]);
    exit;
}
*/
////new start
if (isset($_POST['otp']) && isset($_SESSION['otp'])) {
    if ($_POST['otp'] != $_SESSION['otp']) {
        echo json_encode(["status" => "failed", "msg" => "Invalid OTP! Please try again."]);
        exit;
    }
    // OTP is correct, unset it to prevent reuse
    unset($_SESSION['otp']);
}
/// new end

/*header('Content-Type: application/json'); // Add this before echo
echo json_encode(["status" => "success"]); // Ensure this is correct
exit;
*/
Class Users extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_users(){
		if(!isset($_POST['status']) && $this->settings->userdata('login_type') == 1){
			$_POST['status'] = 1;
		}
		extract($_POST);
		$oid = $id;
		$data = '';
		if(isset($oldpassword)){
			if(md5($oldpassword) != $this->settings->userdata('password')){
				return 4;
			}
		}
		/*$chk = $this->conn->query("SELECT * FROM `users` where username ='{$username}' ".($id>0? " and id!= '{$id}' " : ""))->num_rows;
		if($chk > 0){
			return 3;
			exit;
			
		}*/
		////New
		$stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
		$stmt->bind_param("si", $username, $id);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			echo json_encode(["status" => "failed", "msg" => "Username already exists."]);
			exit;
		}
		///end new
		foreach($_POST as $k => $v){
			if(in_array($k,array('firstname','middlename','lastname','username','type'))){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if(!empty($password)){
			$password = md5($password);
			if(!empty($data)) $data .=" , ";
			$data .= " `password` = '{$password}' ";
		}

		if(empty($id)){
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if($qry){
				$id = $this->conn->insert_id;
				$this->settings->set_flashdata('success','User Details successfully saved.');
				$resp['status'] = 1;
			}else{
				$resp['status'] = 2;
			}

		}else{
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if($qry){
				$this->settings->set_flashdata('success','User Details successfully updated.');
				if($id == $this->settings->userdata('id')){
					foreach($_POST as $k => $v){
						if($k != 'id'){
							if(!empty($data)) $data .=" , ";
							$this->settings->set_userdata($k,$v);
						}
					}
					
				}
				$resp['status'] = 1;
			}else{
				$resp['status'] = 2;
			}
			
		}
		
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = 'uploads/avatar-'.$id.'.png';
			$dir_path =base_app. $fname;
			$upload = $_FILES['img']['tmp_name'];
			$type = mime_content_type($upload);
			$allowed = array('image/png','image/jpeg');
			if(!in_array($type,$allowed)){
				$resp['msg'].=" But Image failed to upload due to invalid file type.";
			}else{
				$new_height = 200; 
				$new_width = 200; 
		
				list($width, $height) = getimagesize($upload);
				$t_image = imagecreatetruecolor($new_width, $new_height);
				imagealphablending( $t_image, false );
				imagesavealpha( $t_image, true );
				$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
				imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				if($gdImg){
						if(is_file($dir_path))
						unlink($dir_path);
						$uploaded_img = imagepng($t_image,$dir_path);
						imagedestroy($gdImg);
						imagedestroy($t_image);
				}else{
				$resp['msg'].=" But Image failed to upload due to unkown reason.";
				}
			}
			if(isset($uploaded_img)){
				$this->conn->query("UPDATE users set `avatar` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}' ");
				if($id == $this->settings->userdata('id')){
						$this->settings->set_userdata('avatar',$fname);
				}
			}
		}
		if(isset($resp['msg']))
		$this->settings->set_flashdata('success',$resp['msg']);
		return  $resp['status'];
	}
	public function delete_users(){
		extract($_POST);
		$avatar = $this->conn->query("SELECT avatar FROM users where id = '{$id}'")->fetch_array()['avatar'];
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if($qry){
			$this->settings->set_flashdata('success','User Details successfully deleted.');
			if(is_file(base_app.$avatar))
				unlink(base_app.$avatar);
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}

public function save_client() {
    extract($_POST);
    
    // Check if it's an update or a new client
    $is_update = isset($id) && !empty($id);

    // Hash password only if it's a new client or updating password
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = NULL;
    }

    // Check if email is already in use by another client
    $stmt = $this->conn->prepare("SELECT id FROM client_list WHERE email = ? AND id != ?");
    $stmt->bind_param("si", $email, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode(["status" => "failed", "msg" => "Email already exists!"]);
        exit;
    }
    $stmt->close();

    // Prepare SQL query for INSERT or UPDATE
    if ($is_update) {
        // Updating existing client
        $sql = "UPDATE client_list SET firstname = ?, middlename = ?, lastname = ?, gender = ?, contact = ?, address = ?, email = ? ";
        if (!empty($password)) {
            $sql .= ", password = ? ";
        }
        $sql .= " WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        
        if (!empty($password)) {
            $stmt->bind_param("ssssssssi", $firstname, $middlename, $lastname, $gender, $contact, $address, $email, $hashed_password, $id);
        } else {
            $stmt->bind_param("sssssssi", $firstname, $middlename, $lastname, $gender, $contact, $address, $email, $id);
        }
    } else {
        // Creating a new client
        $sql = "INSERT INTO client_list (firstname, middlename, lastname, gender, contact, address, email, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssss", $firstname, $middlename, $lastname, $gender, $contact, $address, $email, $hashed_password);
    }

    // Execute Query
    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "failed", "msg" => "Database error: " . $stmt->error]); // Show SQL error
    }
    
    $stmt->close();
    exit;
}
	
/*
//after admin error
public function save_client() {
    extract($_POST);

    // Hash password (Modify if you use a different hashing method)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert query
    $sql = "INSERT INTO client_list (firstname, middlename, lastname, gender, contact, address, email, password) 
            VALUES ('$firstname', '$middlename', '$lastname', '$gender', '$contact', '$address', '$email', '$hashed_password')";

    $save = $this->conn->query($sql);
	///new
	$check = $this->conn->query("SELECT * FROM `client_list` WHERE email = '{$email}' AND delete_flag = '0' AND id != '{$id}' ")->num_rows;

    if ($save) {
        header('Content-Type: application/json');
        echo json_encode(["status" => "success"]);
        exit;
    } else {
        header('Content-Type: application/json');
        echo json_encode(["status" => "failed", "msg" => $this->conn->error]); // Show MySQL error
        exit;
    }
}*/

	/*public function save_client(){
    // Debug: Log incoming POST data
    error_log("POST Data: " . print_r($_POST, true));

    // Hash password if provided
    if(!empty($_POST['password']))
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    else
        unset($_POST['password']);

    // Check old password if provided
    if(isset($_POST['oldpassword'])){
        if($this->settings->userdata('id') > 0 && $this->settings->userdata('login_type') == 2){
            $get = $this->conn->query("SELECT * FROM `client_list` where id = '{$this->settings->userdata('id')}'");
            $res = $get->fetch_array();
            if($res['password'] != md5($_POST['oldpassword'])){
                return json_encode([
                    'status' =>'failed',
                    'msg'=>' Current Password is incorrect.'
                ]);
            }
        }
        unset($_POST['oldpassword']);
    }

    // Prepare data for insertion
    extract($_POST);
    $data = "";
    foreach($_POST as $k => $v){
        if(!in_array($k, array('id'))){
            if(!empty($data)) $data .= ", ";
            $data .= " `{$k}` = '{$v}' ";
        }
    }

    // Check for duplicate email
    $check = $this->conn->query("SELECT * FROM `client_list` where email = '{$email}' and delete_flag ='0' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;
    if($check > 0){
        $resp['status'] = 'failed';
        $resp['msg'] = ' Email already exists in the database.';
    }else{
        // Insert or update query
        if(empty($id)){
            $sql = "INSERT INTO `client_list` set $data";
        }else{
            $sql = "UPDATE `client_list` set $data where id = '{$id}'";
        }

        // Debug: Log the SQL query
        error_log("SQL Query: " . $sql);

        // Execute the query
        $save = $this->conn->query($sql);
        if($save){
            $resp['status'] = 'success';
            $uid = empty($id) ? $this->conn->insert_id : $id;
            if(empty($id)){
                $resp['msg'] = " Account is successfully registered.";
            }else if($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 2){
                $resp['msg'] = " Account Details has been updated successfully.";
                foreach($_POST as $k => $v){
                    if(!in_array($k,['password'])){
                        $this->settings->set_userdata($k,$v);
                    }
                }
            }else{
                $resp['msg'] = " Client's Account Details has been updated successfully.";
            }

            // Handle avatar upload
            if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
                if(!is_dir(base_app."uploads/clients/"))
                    mkdir(base_app."uploads/clients/");
                $fname = 'uploads/clients/'.$uid.'.png';
                $dir_path =base_app. $fname;
                $upload = $_FILES['img']['tmp_name'];
                $type = mime_content_type($upload);
                $allowed = array('image/png','image/jpeg');
                if(!in_array($type,$allowed)){
                    $resp['msg'].=" But Image failed to upload due to invalid file type.";
                }else{
                    $new_height = 200; 
                    $new_width = 200; 
            
                    list($width, $height) = getimagesize($upload);
                    $t_image = imagecreatetruecolor($new_width, $new_height);
                    imagealphablending( $t_image, false );
                    imagesavealpha( $t_image, true );
                    $gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
                    imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    if($gdImg){
                            if(is_file($dir_path))
                            unlink($dir_path);
                            $uploaded_img = imagepng($t_image,$dir_path);
                            imagedestroy($gdImg);
                            imagedestroy($t_image);
                    }else{
                    $resp['msg'].=" But Image failed to upload due to unkown reason.";
                    }
                }
                if(isset($uploaded_img)){
                    $this->conn->query("UPDATE client_list set `image_path` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$uid}' ");
                    if($id == $this->settings->userdata('id') && $this->settings->userdata('login_type') == 2){
                            $this->settings->set_userdata('image_path',$fname);
                    }
                }
            }
        }else{
            $resp['status'] = 'failed';
            if(empty($id)){
                $resp['msg'] = " Account has failed to register for some reason.";
            }else if($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 2){
                $resp['msg'] = " Account Details has failed to update.";
            }else{
                $resp['msg'] = " Client's Account Details has failed to update.";
            }
            // Debug: Log the database error
            error_log("Database Error: " . $this->conn->error);
        }
    }
    
    if($resp['status'] == 'success')
    $this->settings->set_flashdata('success',$resp['msg']);
    return json_encode($resp);
} */

///new dummy delete
	function delete_client(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `client_list` set delete_flag = 1 where id='{$id}'");
		if($del){
			$resp['status'] = 'success';
			$resp['msg'] = ' Client Account has been deleted successfully.';
		}else{
			$resp['status'] = 'failed';
			//$resp['msg'] = $this->conn->error;
			$resp['msg'] = " Client Account has failed to delete";
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	
}
// end dummy delete
$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save':
		echo $users->save_users();
	break;
	case 'delete':
		echo $users->delete_users();
	break;
	case 'save_client':
		echo $users->save_client();
	break;
	case 'delete_client':
		echo $users->delete_client();
	break;
	break;
	default:
		// echo $sysset->index();
		break;
}