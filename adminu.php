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
    $current_username = $_POST['current_username'];
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    if (empty($current_username)) {
        $error = "Current username is required.";
    } else {
        // Check if current username exists and is not admin
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->bind_param("s", $current_username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $error = "The current username does not exist.";
        } elseif ($current_username == "admin") {
            $error = "Cannot update admin account.";
        } else {
            // Prepare update query
            $sql = "UPDATE users SET ";
            $params = [];
            $types = '';

            if (!empty($new_username)) {
                $sql .= "username = ?";
                $params[] = $new_username;
                $types .= 's';
            }
            if (!empty($new_password)) {
                if (!empty($new_username)) {
                    $sql .= ", ";
                }
                $sql .= "password = ?";
                $params[] = $new_password;
                $types .= 's';
            }

            $sql .= " WHERE username = ?";
            $params[] = $current_username;
            $types .= 's';

            // Prepare and bind
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);

            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['message'] = "User updated successfully.";
            } else {
                $error = "Error updating user: " . $conn->error;
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
