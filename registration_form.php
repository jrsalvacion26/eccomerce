<?php

include_once "./db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//require './PHPMailer-master/src/Exception.php';
//require './PHPMailer-master/src/PHPMailer.php';
//require './PHPMailer-master/src/SMTP.php';


// Function to send email using PHPMailer
function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0; // Set to 2 for debugging
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // Replace with your email address
        $mail->Password = 'your_email_password'; // Replace with your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; // Check your SMTP server documentation for the correct port

        // Sender and recipient
        $mail->setFrom('renesalvacion055@gmail.com', 'Your Name'); // Replace with your email address and name
        $mail->addAddress($to);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    // Retrieve the uploaded file details
    $file = $_FILES['profile_picture'];
    $filename = $file['name'];
    $tempFilePath = $file['tmp_name'];

    // Sanitize the input
    $fullname = mysqli_real_escape_string($conn, $fullname);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $role = mysqli_real_escape_string($conn, $role);
   


    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Move the uploaded file to a desired location
$targetDirectory = "./uploads";
$targetFilePath = $targetDirectory . '/' . $filename;
move_uploaded_file($tempFilePath, $targetFilePath);

// Prepare the SQL statement to insert user data into the "user" table
$sql = "INSERT INTO user (fullname, username, password, role, profile_picture) 
        VALUES (?, ?, ?, ?, ?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("sssss", $fullname, $username, $hashedPassword, $role, $targetFilePath);

// Execute the prepared statement
if ($stmt->execute()) {
    // Redirect to login page
    header("Location: login.php");
    exit;
} else {
    echo "Error inserting record: " . $stmt->error;
}

// Close the statement
$stmt->close();

}

?>
