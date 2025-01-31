<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEW RECORD</title>
    <link rel="stylesheet" type="text/css" href="styless.css"> 
</head>

<body>
 <img src="warehouse.jpg" alt="warehouse" class="bg-image">

<div class = "background"> <p> </p> </div>
<div class="parent-container">
    <div class="container">
<?php

// Establishing database connection (replace with your actual database credentials)
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $itemName = $_POST["item"];
    $productNumber = $_POST["product_num"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $dateArrival = $_POST["date"];
    $department = $_POST["department"];
    $section = $_POST["section"];
    $subject = $_POST["subject"];

    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Insert data into the parent table (supplies)
        $insertParentSQL = "INSERT INTO supplies (ItemName, ProductNumber, Quantity, Price, DateArrival, Department, Subject, Section) 
                            VALUES ('$itemName', '$productNumber', '$quantity', '$price', '$dateArrival', '$department', '$subject', '$section')";
        $conn->query($insertParentSQL);

        // Check if the section is "LIBRARY SECTION" and change $department to $subject
        if ($section == "LIBRARY SECTION") {
            $subject = $department;
            $department = null; // Reset $department since it's no longer relevant
        } else {
            $subject = null; // Set $subject to null if the section is not "LIBRARY SECTION"
        }

        // Decide which child table to insert data into based on the selected section
        $tableName = '';
        switch ($section) {
            case "UNIVERSITY MATERIALS SECTION":
                $tableName = "u_material";
                break;
            case "PRINTING PRESS SECTION":
                $tableName = "printer_section";
                break;
            case "LIBRARY SECTION":
                $tableName = "library_section";
                break;
            case "SUPPLY SECTION":
                $tableName = "supply_section";
                break;
            default:
                echo "Invalid section selected.";
                exit;
        }

        // Insert data into the appropriate child table using the generated ProductNumber
      $insertChildSQL = "INSERT INTO $tableName (ItemName, ProductNumber, Quantity, Price, DateArrival";

// Check if the section is "LIBRARY SECTION" to include "Subject"
if ($section == "LIBRARY SECTION") {
    $insertChildSQL .= ", Subject) VALUES ('$itemName', '$productNumber', '$quantity', '$price', '$dateArrival', '$subject')";
} else {
    // For other sections, include "Department"
    $insertChildSQL .= ", Department) VALUES ('$itemName', '$productNumber', '$quantity', '$price', '$dateArrival', '$department')";
}

$conn->query($insertChildSQL);

        // Commit the transaction
        $conn->commit();
        
        echo "Data inserted successfully.";

    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

// Close connection
$conn->close();

?>

    </div>
    <div class="button-container">
        <button onclick="goToIndex()">Go back to Supply Section</button>
        <form method="post" action="data.php">
    <button type="submit" name="showDataBtn">Show Data</button> <!-- Change type to "submit" -->
</form>
    </div>
</div>

<script>
function goToIndex() {
    window.location.href = 'Supply Section.html';
}
</script>

</body>
</html>