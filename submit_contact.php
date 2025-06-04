<?php
// Database connection details
$host = 'localhost'; // Replace with your database host
$dbname = 'cbsphp'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate input (optional but recommended)
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        die("Please fill all the fields.");
    }

    // Connect to the database
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL query to insert data
        $sql = "INSERT INTO contact (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        // Execute the query
        $stmt->execute();

        // Success message
        echo ("#contact");
    } catch (PDOException $e) {
        // Handle database errors
        die("Error: " . $e->getMessage());
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: contact_form.html"); // Replace with your form page
    exit();
}
?>