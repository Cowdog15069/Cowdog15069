<?php
// Connect to MySQL database
$servername = "localhost";
$username = "Group8";
$password = "";
$database = "if0_36660578_smplsp";


$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Check if the checkbox to delete all data in supplies table is checked
    if (isset($_POST['delete_all_supplies'])) {
        // Delete all data from the supplies table
        $sql = "DELETE FROM supplies";
        if ($conn->query($sql) === TRUE) {
            echo "All data deleted successfully from supplies table.";
        } else {
            echo "Error deleting all data from supplies table: " . $conn->error;
        }
    } else {
        // Retrieve form data
        $section = $_POST['sections'];
        $product_num = $_POST['product_num'];

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

        // Check if product number is provided
        if (!empty($product_num)) {
            // Delete the record from the selected table
            $sql = "DELETE FROM $table WHERE ProductNumber='$product_num'";
            if ($conn->query($sql) === TRUE) {
                if ($conn->affected_rows > 0) {
                    echo "Record deleted successfully from $table table.";
                } else {
                    echo "The product number you input is not yet recorded. Please use a valid product number.";
                }
            } else {
                echo "Error deleting record from $table table: " . $conn->error;
            }

            // Delete the record from the supplies table
            $sql = "DELETE FROM supplies WHERE ProductNumber='$product_num'";
            if ($conn->query($sql) === TRUE) {
                if ($conn->affected_rows > 0) {
                    echo "Record deleted successfully from supplies table.";
                } else {
                    echo "The product number you input is not yet recorded in supplies table. Please use a valid product number.";
                }
            } else {
                echo "Error deleting record from supplies table: " . $conn->error;
            }
        } else {
            // No product number provided
            echo "Please provide a product number to delete.";
        }
    }

    // Redirect after processing the form submission
    header("Location: und.html");
    exit();
}

$conn->close();
?>
