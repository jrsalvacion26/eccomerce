<?php

include_once "./db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize the input
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Prepare the SQL statement
    $sql = "SELECT password FROM admin WHERE username = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("s", $username);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the username exists
    if ($result->num_rows === 1) {
        // Fetch the password from the result
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $storedPassword)) {
            // Password is correct, set session variables and redirect to the dashboard
            session_start();
            $_SESSION['username'] = $username;
            // Additional session variables can be set if needed

            header("Location: index.php");
            exit;
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }

    // Close the statement
    $stmt->close();
}

?>
