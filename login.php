<?php
// Database connection parameters
$servername = "localhost";
$username = "Group8";
$password = "";
$database = "if0_36660578_smplsp";

// Check if the form is submitted with username and password
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    // Retrieve username and password from the POST request
    $form_username = $_POST['username'];
    $form_password = $_POST['password'];

    try {
        // Connect to the database
        $conn = new PDO("mysql:host=$servername;dbname=$database", $dbUsername, $dbPassword);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to select user with provided username
        $stmt = $conn->prepare("SELECT * FROM users WHERE Username = :username");
        $stmt->bindParam(':username', $form_username);
        $stmt->execute();

        // Check if a row with the provided username exists
        if ($stmt->rowCount() == 1) {
            // Fetch the user's details
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Compare the input password with the stored password retrieved from the database
            if ($form_password === $user['Password']) {
                // Password is correct, redirect based on user role
                if ($user['Username'] === 'admin') {
                    // Admin user, redirect to admin.php
                    header("Location: admin.php");
                    exit();
                } else {
                    // Non-admin user, redirect to index.html
                    header("Location: index.html");
                    exit();
                }
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
    } catch (PDOException $e) {
        // Log the error message, including the exception code and stack trace, to a file for debugging
        error_log("Database Error (Code: " . $e->getCode() . "): " . $e->getMessage() . "\n" . $e->getTraceAsString(), 0);

        // Temporarily display the error message for debugging (remove in production)
        echo "Database Error: " . $e->getMessage(); // Comment this line in production

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
