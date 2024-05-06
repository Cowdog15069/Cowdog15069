<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEW RECORD</title>
    <link rel="stylesheet" href="phpstyle.css"> <!-- Link your CSS file -->
</head>
<body>
<div class="background"></div>
<div class="parent-container">
    <div class="container">
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['showDataBtn'])) {
    $servername = "localhost";
    $username = "group8";
    $password = "";
    $database = "group8";

    // Establish a connection to the database
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Process form data
    $ItemName = $_POST['item'] ?? '';
    $ProductNumber = $_POST['product_num'] ?? '';
    $Quantity = $_POST['quantity'] ?? '';
    $Price = mysqli_real_escape_string($conn, $_POST['price']) ?? '';
    $DateArrival = $_POST['date'] ?? '';
    $Department = $_POST['department'] ?? '';

    // Insert data into the database
    $sql = "INSERT INTO supply_section (ItemName, ProductNumber, Quantity, Price, DateArrival, Department) 
            VALUES ('$ItemName', '$ProductNumber', '$Quantity', '$Price', '$DateArrival', '$Department')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}

// Show data if requested
if (isset($_POST['showDataBtn'])) {
    $servername = "localhost";
    $username = "group8";
    $password = "";
    $database = "group8";

    // Establish a connection to the database
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve data from the database
    $sql = "SELECT * FROM supply_section";
    $result = mysqli_query($conn, $sql);

    // Display data in a table format
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Item Name</th><th>Product Number</th><th>Quantity</th><th>Price</th><th>Date Arrival</th><th>Department</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["ItemName"] . "</td><td>" . $row["ProductNumber"] . "</td><td>" . $row["Quantity"] . "</td><td>" . $row["Price"] . "</td><td>" . $row["DateArrival"] . "</td><td>" . $row["Department"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close connection
    mysqli_close($conn);
}
?>

    </div>
    <div class="button-container">
        <button onclick="goToIndex()">Go back to Supply Section</button>
        <form method="post" action="https://localhost/project/supply.php">
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