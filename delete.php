<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECORD DELETE</title>
    <link rel="stylesheet" href="phpstyle.css"> <!-- Link your CSS file -->
</head>
<body>
<div class="background"></div>
<div class="parent-container">
    <div class="container">
    <?php
// Replace these variables with your MySQL database credentials
$servername = "localhost";
$username = "group8";
$password = "";
$database = "group8";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $section = $_POST['sections'];
    $product_number = $_POST['product_num'];
    $department = isset($_POST['department']) ? $_POST['department'] : null;
    $subject = isset($_POST['subject']) ? $_POST['subject'] : null;
    
    // If section is Library, change department to subject
    if ($section == "ls") {
        $department = $subject;
    }
    
    // Use the correct table name based on the section
    $table_name = "";
    switch ($section) {
        case "ss":
            $table_name = "supply_section";
            break;
        case "um":
            $table_name = "u_material";
            break;
        case "pps":
            $table_name = "printer_section";
            break;
        case "ls":
            $table_name = "library_section";
            break;
        default:
            die("Invalid section selected.");
    }
    
    // SQL query to check if any rows exist that match the given criteria
    $sql_select = "SELECT * FROM $table_name WHERE ProductNumber = ?";
    if ($section != "ls") {
        $sql_select .= " AND Department = ?";
    }
    
    // Prepare and bind parameters for select query
    $stmt_select = $conn->prepare($sql_select);
    if ($section == "ls") {
        $stmt_select->bind_param("s", $product_number);
    } else {
        $stmt_select->bind_param("ss", $product_number, $department);
    }
    
    // Execute the select query
    $stmt_select->execute();
    
    // Store the result
    $result = $stmt_select->get_result();
    
    // Check if any rows were found
    if ($result->num_rows > 0) {
        // If rows were found, proceed with the delete operation
        
        // SQL query to delete data from the table
        $sql_delete = "DELETE FROM $table_name WHERE ProductNumber = ?";
        if ($section != "ls") {
            $sql_delete .= " AND Department = ?";
        }
        
        // Prepare and bind parameters for delete query
        $stmt_delete = $conn->prepare($sql_delete);
        if ($section == "ls") {
            $stmt_delete->bind_param("s", $product_number);
        } else {
            $stmt_delete->bind_param("ss", $product_number, $department);
        }
        
        // Execute the delete query
        $stmt_delete->execute();
        
        // Check if any row was affected
        if ($stmt_delete->affected_rows > 0) {
            echo "Data deleted successfully.";
        } else {
            echo "An error occurred while deleting the data.";
        }
        
        // Close the delete statement
        $stmt_delete->close();
    } else {
        echo "No data corresponds to your entry. Please double check it.";
    }
    
    // Close the select statement
    $stmt_select->close();
}

// Close connection
$conn->close();
?>






</div>
    <div class="button-container">
        <button onclick="goToIndex()">Go back to Update/Delete Page</button>
    </div>
</div>

<script>
    function goToIndex() {
        window.location.href = 'und.html';
    }
</script>

</body>
</html>