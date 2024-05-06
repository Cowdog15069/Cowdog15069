<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECORD UPDATE</title>
    <link rel="stylesheet" href="phpstyle.css"> <!-- Link your CSS file -->
</head>
<body>
<div class="background"></div>
<div class="parent-container">
    <div class="container">
    <?php
    // Connect to MySQL database
    $servername = "localhost";
    $username_db = "group8";
    $password_db = "";
    $database = "group8";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize $table variable
    $table = "";

    // Check if the form is submitted
    if(isset($_POST['submit'])) {
        // Retrieve form data
        $section = $_POST['sections']; // Changed to lowercase 'sections'
        $item = $_POST['item'];
        $product_num = $_POST['product_num'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        
        // Adjusted for the change in form field name
        $subject = $_POST['subject'];

        // Determine the table based on the selected section
        switch($section) {
            case 'ss':
                $table = "supply_section";
                break;
            case 'um':
                $table = "u_material";
                break;
            case 'pps':
                $table = "printer_section";
                break;
            case 'ls':
                $table = "library_section";
                break;
            default:
                // Handle default case if needed
                break;
        }

        // Check if any field is not empty
        $fieldsToUpdate = [];
        if (!empty($item)) {
            $fieldsToUpdate[] = "ItemName='$item'";
        }
        if (!empty($quantity)) {
            $fieldsToUpdate[] = "Quantity='$quantity'";
        }
        if (!empty($price)) {
            $fieldsToUpdate[] = "Price='$price'";
        }
        if (!empty($date)) {
            $fieldsToUpdate[] = "DateArrival='$date'";
        }
        if (!empty($subject)) {
            $fieldsToUpdate[] = "Subject='$subject'";
        }

        // Check if there are fields to update
        if (!empty($fieldsToUpdate)) {
            $sql = "UPDATE $table SET " . implode(", ", $fieldsToUpdate) . " WHERE ProductNumber='$product_num'";

            // Execute the SQL query
            if ($conn->query($sql) === TRUE) {
                if ($conn->affected_rows > 0) {
                    echo "Record updated successfully";
                } else {
                    echo "The product number you input is not yet recorded. Please use a valid product number.";
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            // No fields to update
            echo "No fields to update.";
        }
    }
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
