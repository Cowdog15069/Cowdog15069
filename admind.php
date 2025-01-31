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
    $username = $_POST['usernamedelete'];

    if (empty($username)) {
        $error = "Username is required.";
    } else {
        // Check if username exists and is not admin
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $error = "The username does not exist.";
        } elseif ($username == "admin") {
            $error = "Cannot delete admin account.";
        } else {
            // Prepare and bind
            $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);

            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['message'] = "User deleted successfully.";
            } else {
                $error = "Error deleting user: " . $conn->error;
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
