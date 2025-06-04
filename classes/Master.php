<?php
require_once('../config.php');
date_default_timezone_set('Asia/Kolkata'); // Replace with your timezone
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}
		$check = $this->conn->query("SELECT * FROM `category_list` where `name` = '{$name}' and delete_flag = 0 ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = " Category already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `category_list` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `category_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success'," New Category successfully saved.");
			else
				$this->settings->set_flashdata('success'," Category successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `category_list` set delete_flag = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Category successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	
	function save_cab() {
    if (!empty($_POST['password'])) {
        $_POST['password'] = md5($_POST['password']); // Convert password to MD5
    }

    if (empty($_POST['id'])) {
        $prefix = date('Ym-');
        $code = sprintf("%'.05d", 1);
        while (true) {
            $check = $this->conn->query("SELECT * FROM `cab_list` WHERE reg_code = '{$prefix}{$code}'")->num_rows;
            if ($check > 0) {
                $code = sprintf("%'.05d", ceil($code) + 1);
            } else {
                break;
            }
        }
        $_POST['reg_code'] = $prefix . $code;
    }

    extract($_POST);
    $data = "";
    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id', 'oldpassword'))) {
            $v = $this->conn->real_escape_string($v);
            if (!empty($data)) $data .= ",";
            $data .= " `{$k}`='{$v}' ";
        }
    }

    if (empty($id)) {
        $sql = "INSERT INTO `cab_list` SET {$data}";
        $save = $this->conn->query($sql);
    } else {
        $sql = "UPDATE `cab_list` SET {$data} WHERE id = '{$id}'";
        $save = $this->conn->query($sql);
    }

    if ($save) {
        $resp['status'] = 'success';
        $cid = empty($id) ? $this->conn->insert_id : $id;
        $resp['id'] = $cid;
        $resp['msg'] = empty($id) ? "New Cab successfully saved." : "Cab successfully updated.";

        if ($this->settings->userdata('id') == $cid && $this->settings->userdata('login_type') == 3) {
            foreach ($_POST as $k => $v) {
                if (!in_array($k, ['password'])) {
                    $this->settings->set_userdata($k, $v);
                }
            }
            $resp['msg'] = "Account successfully updated.";
        }

        // Image Upload
        if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
            if (!is_dir(base_app . "uploads/drivers/"))
                mkdir(base_app . "uploads/drivers/");
            $fname = 'uploads/drivers/' . $cid . '.png';
            $dir_path = base_app . $fname;
            $upload = $_FILES['img']['tmp_name'];
            $type = mime_content_type($upload);
            $allowed = array('image/png', 'image/jpeg');
            if (!in_array($type, $allowed)) {
                $resp['msg'] .= " But Image failed to upload due to invalid file type.";
            } else {
                $new_height = 200;
                $new_width = 200;
                list($width, $height) = getimagesize($upload);
                $t_image = imagecreatetruecolor($new_width, $new_height);
                imagealphablending($t_image, false);
                imagesavealpha($t_image, true);
                $gdImg = ($type == 'image/png') ? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
                imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                if ($gdImg) {
                    if (is_file($dir_path))
                        unlink($dir_path);
                    $uploaded_img = imagepng($t_image, $dir_path);
                    imagedestroy($gdImg);
                    imagedestroy($t_image);
                } else {
                    $resp['msg'] .= " But Image failed to upload due to unknown reason.";
                }
            }
            if (isset($uploaded_img)) {
                $this->conn->query("UPDATE cab_list SET `image_path` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) WHERE id = '{$cid}'");
                if ($id == $this->settings->userdata('id')) {
                    $this->settings->set_userdata('avatar', $fname);
                }
            }
        }
    } else {
        $resp['status'] = 'failed';
        $resp['msg'] = "Error: " . $this->conn->error;
    }

    return json_encode($resp);
}




	/*function save_cab(){
		if(!empty($_POST['password']))
			$_POST['password'] = md5($_POST['password']);
		else
			unset($_POST['password']);
		if(empty($_POST['id'])){
			$prefix = date('Ym-');
			$code = sprintf("%'.05d",1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `cab_list` where reg_code = '{$prefix}{$code}'")->num_rows;
				if($check > 0){
					$code = sprintf("%'.05d",ceil($code) + 1);
				}else{
					break;
				}
			}
			$_POST['reg_code'] = $prefix.$code;
		}


		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','oldpassword'))){
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($cab_reg_no)){
			$check = $this->conn->query("SELECT * FROM `cab_list` where `cab_reg_no` = '{$cab_reg_no}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
			if($this->capture_err())
				return $this->capture_err();
			if($check > 0){
				$resp['status'] = 'failed';
				$resp['msg'] = " Cab already exist.";
				return json_encode($resp);
				exit;
			}
		}
		if(isset($body_no)){
			$check = $this->conn->query("SELECT * FROM `cab_list` where `body_no` = '{$body_no}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
			if($this->capture_err())
				return $this->capture_err();
			if($check > 0){
				$resp['status'] = 'failed';
				$resp['msg'] = " Cab Body # already exist.";
				return json_encode($resp);
				exit;
			}
		}
		if(isset($oldpassword)){
			$cur_pass = $this->conn->query("SELECT `password` from `cab_list` where id = '{$this->settings->userdata('id')}'")->fetch_array()[0];
			if(md5($oldpassword) != $cur_pass){
				$resp['status'] = 'failed';
				$resp['msg'] = " Current Password is Incorrect.";
				return json_encode($resp);
				exit;
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `cab_list` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `cab_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			$cid = empty($id) ? $this->conn->insert_id : $id;
			$resp['id'] = $cid ;
			if(empty($id))
				$resp['msg'] = " New Cab successfully saved.";
			else
				$resp['msg'] = " Cab successfully updated.";
				if($this->settings->userdata('id')  == $cid && $this->settings->userdata('login_type') == 3){
					foreach($_POST as $k => $v){
						if(!in_array($k,['password']))
						$this->settings->set_userdata($k,$v);
					}
					$resp['msg'] = " Account successfully updated.";
				}
				if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
					if(!is_dir(base_app."uploads/dirvers/"))
						mkdir(base_app."uploads/dirvers/");
					$fname = 'uploads/dirvers/'.$cid.'.png';
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
						$this->conn->query("UPDATE cab_list set `image_path` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$cid}' ");
						if($id == $this->settings->userdata('id')){
								$this->settings->set_userdata('avatar',$fname);
						}
					}
				}
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if(isset($resp['msg']) && $resp['status'] == 'success'){
			$this->settings->set_flashdata('success',$resp['msg']);
		}
		return json_encode($resp);
	}*/
	function delete_cab(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `cab_list` set `delete_flag` = 1  where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Cab successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	//new new for map 
	/*function save_booking(){
    if(empty($_POST['id'])){
        $prefix = date('Ym-');
        $code = sprintf("%'.05d",1);
        while(true){
            $check = $this->conn->query("SELECT * FROM `cab_list` WHERE reg_code = '{$prefix}{$code}'")->num_rows;
            if($check > 0){
                $code = sprintf("%'.05d",ceil($code) + 1);
            } else {
                break;
            }
        }
        $_POST['client_id'] = $this->settings->userdata('id');
        $_POST['ref_code'] = $prefix.$code;
        $_POST['created_at'] = date("Y-m-d H:i:s"); // Add created_at timestamp
    }

    // Extract pickup and drop-off location names
    $pickupLocation = $_POST['pickup_zone'];
    $dropoffLocation = $_POST['drop_zone'];

    // Fetch latitude and longitude for pickup and drop-off locations
    $pickupCoords = json_decode(file_get_contents("https://nominatim.openstreetmap.org/search?format=json&q={$pickupLocation}&limit=1"), true);
    $dropoffCoords = json_decode(file_get_contents("https://nominatim.openstreetmap.org/search?format=json&q={$dropoffLocation}&limit=1"), true);

    // Add latitude and longitude to the POST data
    $_POST['pickup_lat'] = $pickupCoords[0]['lat'];
    $_POST['pickup_lng'] = $pickupCoords[0]['lon'];
    $_POST['dropoff_lat'] = $dropoffCoords[0]['lat'];
    $_POST['dropoff_lng'] = $dropoffCoords[0]['lon'];

    extract($_POST);
    $data = "";
    foreach($_POST as $k =>$v){
        if(!in_array($k,array('id'))){
            if(!empty($data)) $data .=","; 
            $data .= " `{$k}`='{$v}' ";
        }
    }
    if(empty($id)){
        $sql = "INSERT INTO `booking_list` SET {$data} ";
        $save = $this->conn->query($sql);
    } else {
        $sql = "UPDATE `booking_list` SET {$data} WHERE id = '{$id}' ";
        $save = $this->conn->query($sql);
    }
    if($save){
        $resp['status'] = 'success';
        if(empty($id))
            $this->settings->set_flashdata('success', "Cab has been booked successfully.");
        else
            $this->settings->set_flashdata('success', "Booking successfully updated.");
    } else {
        $resp['status'] = 'failed';
        $resp['err'] = $this->conn->error . "[{$sql}]";
    }
    return json_encode($resp);
}*/
	//new after map
	/*function save_booking(){
    if(empty($_POST['id'])){
        $prefix = date('Ym-');
        $code = sprintf("%'.05d",1);
        while(true){
            $check = $this->conn->query("SELECT * FROM `cab_list` WHERE reg_code = '{$prefix}{$code}'")->num_rows;
            if($check > 0){
                $code = sprintf("%'.05d",ceil($code) + 1);
            } else {
                break;
            }
        }
        $_POST['client_id'] = $this->settings->userdata('id');
        $_POST['ref_code'] = $prefix.$code;
        $_POST['created_at'] = date("Y-m-d H:i:s"); // Add created_at timestamp
    }

    // Extract latitude and longitude from input fields
    $pickupCoords = explode(',', $_POST['pickup_zone']);
    $dropoffCoords = explode(',', $_POST['drop_zone']);

    $_POST['pickup_lat'] = trim(str_replace('Lat:', '', $pickupCoords[0]));
    $_POST['pickup_lng'] = trim(str_replace('Lng:', '', $pickupCoords[1]));
    $_POST['dropoff_lat'] = trim(str_replace('Lat:', '', $dropoffCoords[0]));
    $_POST['dropoff_lng'] = trim(str_replace('Lng:', '', $dropoffCoords[1]));

    extract($_POST);
    $data = "";
    foreach($_POST as $k =>$v){
        if(!in_array($k,array('id'))){
            if(!empty($data)) $data .=","; 
            $data .= " `{$k}`='{$v}' ";
        }
    }
    if(empty($id)){
        $sql = "INSERT INTO `booking_list` SET {$data} ";
        $save = $this->conn->query($sql);
    } else {
        $sql = "UPDATE `booking_list` SET {$data} WHERE id = '{$id}' ";
        $save = $this->conn->query($sql);
    }
    if($save){
        $resp['status'] = 'success';
        if(empty($id))
            $this->settings->set_flashdata('success', "Cab has been booked successfully.");
        else
            $this->settings->set_flashdata('success', "Booking successfully updated.");
    } else {
        $resp['status'] = 'failed';
        $resp['err'] = $this->conn->error . "[{$sql}]";
    }
    return json_encode($resp);
}*/
	
	//Commented for map integration---
	//Original
	function save_booking(){
    if(empty($_POST['id'])){
        $prefix = date('Ym-');
        $code = sprintf("%'.05d",1);
        while(true){
            $check = $this->conn->query("SELECT * FROM `cab_list` WHERE reg_code = '{$prefix}{$code}'")->num_rows;
            if($check > 0){
                $code = sprintf("%'.05d",ceil($code) + 1);
            } else {
                break;
            }
        }
        $_POST['client_id'] = $this->settings->userdata('id');
        $_POST['ref_code'] = $prefix.$code;
        $_POST['created_at'] = date("Y-m-d H:i:s"); // Add created_at timestamp
    }

    extract($_POST);
    $data = "";
    foreach($_POST as $k =>$v){
        if(!in_array($k,array('id'))){
            if(!empty($data)) $data .=","; 
            $data .= " `{$k}`='{$v}' ";
        }
    }
    if(empty($id)){
        $sql = "INSERT INTO `booking_list` SET {$data} ";
        $save = $this->conn->query($sql);
    } else {
        $sql = "UPDATE `booking_list` SET {$data} WHERE id = '{$id}' ";
        $save = $this->conn->query($sql);
    }
    if($save){
        $resp['status'] = 'success';
        if(empty($id))
            $this->settings->set_flashdata('success', "Cab has been booked successfully.");
        else
            $this->settings->set_flashdata('success', "Booking successfully updated.");
    } else {
        $resp['status'] = 'failed';
        $resp['err'] = $this->conn->error . "[{$sql}]";
    }
    return json_encode($resp);
}

	function driver_cancel_booking(){
    extract($_POST); // Get the booking ID
    $qry = $this->conn->query("SELECT * FROM `booking_list` WHERE id = '{$id}'");

    if($qry->num_rows > 0){
        $booking = $qry->fetch_assoc();
        
        // Check if the booking is still pending
        if($booking['status'] == 0){
            $update = $this->conn->query("UPDATE `booking_list` SET status = '4' WHERE id = '{$id}'");
            if($update){
                $resp['status'] = 'success';
                $resp['msg'] = 'Booking cancelled successfully by driver.';
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = 'Failed to cancel the booking.';
            }
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = 'Booking is already processed and cannot be cancelled.';
        }
    } else {
        $resp['status'] = 'failed';
        $resp['msg'] = 'Booking not found.';
    }
    return json_encode($resp);
}

	/*function save_booking(){
		if(empty($_POST['id'])){
			$prefix = date('Ym-');
			$code = sprintf("%'.05d",1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `cab_list` where reg_code = '{$prefix}{$code}'")->num_rows;
				if($check > 0){
					$code = sprintf("%'.05d",ceil($code) + 1);
				}else{
					break;
				}
			}
			$_POST['client_id'] = $this->settings->userdata('id');
			$_POST['ref_code'] = $prefix.$code;
		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `booking_list` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `booking_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success'," Cab has been booked successfully.");
			else
				$this->settings->set_flashdata('success'," Booking successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}*/
	function delete_booking(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `booking_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Booking successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function cancel_booking(){
    extract($_POST); // Extract the booking ID
    $qry = $this->conn->query("SELECT * FROM `booking_list` WHERE id = '{$id}'");
    if($qry && $qry->num_rows > 0){
        $booking = $qry->fetch_assoc();
        $created_at = strtotime($booking['created_at']); // Booking creation time
        $now = time(); // Current time
        // Check if cancellation is within 5 minutes
        if(($now - $created_at) <= 300){
            $update = $this->conn->query("UPDATE `booking_list` SET status = '4' WHERE id = '{$id}'");
            if($update){
                $resp['status'] = 'success';
                $resp['msg'] = 'Booking cancelled successfully.';
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = 'Failed to cancel the booking.';
            }
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = 'Cancellation period has expired.';
        }
    } else {
        $resp['status'] = 'failed';
        $resp['msg'] = 'Booking not found.';
    }
    return json_encode($resp); // Return response as JSON
}


	function update_booking_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `booking_list` set `status` = '{$status}' where id = '{$id}' ");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Booking status successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_category':
		echo $Master->save_category();
	break;
	case 'delete_category':
		echo $Master->delete_category();
	break;
	case 'save_cab':
		echo $Master->save_cab();
	break;
	case 'delete_cab':
		echo $Master->delete_cab();
	break;
	case 'save_booking':	//Altered		
		echo $Master->save_booking();
	break;
	case 'delete_booking':
		echo $Master->delete_booking();
	break;
	case 'update_booking_status':
		echo $Master->update_booking_status();
	break;
	case 'cancel_booking':	//Altered
    echo $Master->cancel_booking();
    break;
	case 'driver_cancel_booking': //New Function by me
        echo $Master->driver_cancel_booking();
        break;

	default:
		// echo $sysset->index();
		break;
}