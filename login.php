<?php
// Database connection parameters
$servername = "localhost";
$username_db = "group8";
$password_db = "";
$database = "group8";

// Check if the form is submitted with username and password
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    // Retrieve username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Connect to the database
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username_db, $password_db);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to select user with provided username
        $stmt = $conn->prepare("SELECT * FROM users WHERE Username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Check if a row with the provided username exists
        if ($stmt->rowCount() == 1) {
            // Fetch the user's details
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Compare the input password with the stored password retrieved from the database
            if ($password === $user['Password']) {
                // Password is correct, redirect to index.html
                header("Location: index.html");
                exit();
            } else {
                // Password is incorrect, redirect back to login page with error message
                header("Location: login.html?error=3"); // Redirect with an error parameter indicating incorrect password
                exit();
            }
        } else {
            // User with provided username does not exist, redirect back to login page with error message
            header("Location: login.html?error=2"); // Redirect with an error parameter indicating username not found
            exit();
        }
    } catch(PDOException $e) {
        // Log the error message to a file for debugging
        error_log("Database Error: " . $e->getMessage(), 0);

        // If an error occurs, redirect back to login page with error message
        header("Location: login.html?error=4"); // Redirect with an error parameter indicating database error
        exit();
    }
} else {
    // If form is not submitted with username and password, redirect back to login page
    header("Location: login.html"); // Redirect without any error parameter
    exit();
}
?>
