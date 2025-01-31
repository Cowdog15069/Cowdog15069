<?php
// Database connection settings
$servername = "localhost";
$username = "Group8";
$password = "";
$database = "if0_36660578_smplsp";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Both username and password are required.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already exists.";
        } else {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);

            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['message'] = "User inserted successfully.";
            } else {
                $error = "Error inserting user: " . $conn->error;
            }

            // Close statement
            $stmt->close();
        }
    }
}

if (!empty($error)) {
    $_SESSION['error'] = $error;
}

$conn->close();

// Redirect back to admin.php
header("Location: admin.php");
exit();
?>
