<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECORDED DATA</title>
    <link rel="stylesheet" href="datastyle.css"> <!-- Link your CSS file -->
    <style>
        .parent-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button-container {
            position: fixed;
            display: flex;
            bottom: 20px;
            left: 20px;
        }

        .button-container button {
            margin: 5px;
            margin-top: 50px;
        }

        .button-back {
    position: fixed;
    bottom: 20px; /* Adjust this value as needed */
    right: 5px; /* Adjust this value as needed */
}

        .container {
            margin-bottom: 20px;
            width: 800px;
            overflow: hidden;
    position: relative;
    top: 80px; /* Adjust as needed */
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <p></p>
<div class="parent-container">

    <?php
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

    // Fetch data from supply_section table
    $sql = "SELECT * FROM supply_section";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container" id="supplySection">';
        echo "<h2>Supply Section:</h2>";
        echo "<table>";
        echo "<tr><th>ItemName</th><th>ProductNumber</th><th>Quantity</th><th>Price</th><th>DateArrival</th><th>Department</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ItemName"] . "</td>";
            echo "<td>" . $row["ProductNumber"] . "</td>";
            echo "<td>" . $row["Quantity"] . "</td>";
            echo "<td>" . $row["Price"] . "</td>";
            echo "<td>" . $row["DateArrival"] . "</td>";
            echo "<td>" . $row["Department"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
    } else {
        echo '<div class="container" id="supplySection">';
        echo "<p>No results in Supply Section</p>";
        echo '</div>';
    }

    // Fetch data from u_material table
    $sql = "SELECT * FROM u_material";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container" id="uMaterialSection" style="display: none;">';
        echo "<h2>U Material Section:</h2>";
        echo "<table>";
        echo "<tr><th>ItemName</th><th>ProductNumber</th><th>Quantity</th><th>Price</th><th>DateArrival</th><th>Department</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ItemName"] . "</td>";
            echo "<td>" . $row["ProductNumber"] . "</td>";
            echo "<td>" . $row["Quantity"] . "</td>";
            echo "<td>" . $row["Price"] . "</td>";
            echo "<td>" . $row["DateArrival"] . "</td>";
            echo "<td>" . $row["Department"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
    } else {
        echo '<div class="container" id="uMaterialSection" style="display: none;">';
        echo "<p>No results in U Material Section</p>";
        echo '</div>';
    }

    // Fetch data from printer_section table
    $sql = "SELECT * FROM printer_section";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container" id="printerSection" style="display: none;">';
        echo "<h2>Printer Section:</h2>";
        echo "<table>";
        echo "<tr><th>ItemName</th><th>ProductNumber</th><th>Quantity</th><th>Price</th><th>DateArrival</th><th>Department</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ItemName"] . "</td>";
            echo "<td>" . $row["ProductNumber"] . "</td>";
            echo "<td>" . $row["Quantity"] . "</td>";
            echo "<td>" . $row["Price"] . "</td>";
            echo "<td>" . $row["DateArrival"] . "</td>";
            echo "<td>" . $row["Department"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
    } else {
        echo '<div class="container" id="printerSection" style="display: none;">';
        echo "<p>No results in Printer Section</p>";
        echo '</div>';
    }

    // Fetch data from library_section table
    $sql = "SELECT * FROM library_section";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container" id="librarySection" style="display: none;">';
        echo "<h2>Library Section:</h2>";
        echo "<table>";
        echo "<tr><th>ItemName</th><th>ProductNumber</th><th>Quantity</th><th>Price</th><th>DateArrival</th><th>Subject</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ItemName"] . "</td>";
            echo "<td>" . $row["ProductNumber"] . "</td>";
            echo "<td>" . $row["Quantity"] . "</td>";
            echo "<td>" . $row["Price"] . "</td>";
            echo "<td>" . $row["DateArrival"] . "</td>";
            echo "<td>" . $row["Subject"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
    } else {
        echo '<div class="container" id="librarySection" style="display: none;">';
        echo "<p>No results in Library Section</p>";
        echo '</div>';
    }

    // Close connection
    $conn->close();
    ?>

    <div class="button-container">
        <button id="backButton" disabled>Back</button>
        <button id="nextButton">Next</button>
        <div class= "button-back">
        <button onclick="goToIndex()">Go back to Supply Section</button>
</div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var sections = document.querySelectorAll('.container'); // Select all section containers
    var currentIndex = 0; // Initialize the current section index

    function showSection(index) {
        // Hide all sections
        sections.forEach(function(section) {
            section.style.display = 'none';
        });

        // Show the section at the specified index
        sections[index].style.display = 'block';

        // Enable/disable buttons based on the current section
        if (index === 0) {
            document.getElementById('backButton').disabled = true; // Disable back button on first section
        } else {
            document.getElementById('backButton').disabled = false; // Enable back button on other sections
        }

        if (index === sections.length - 1) {
            document.getElementById('nextButton').disabled = true; // Disable next button on last section
        } else {
            document.getElementById('nextButton').disabled = false; // Enable next button on other sections
        }
    }

    // Show the initial section (Supply Section)
    showSection(currentIndex);

    // Function to show the next section
    function showNextSection() {
        currentIndex++;
        showSection(currentIndex);
    }

    // Function to show the previous section
    function showPrevSection() {
        currentIndex--;
        showSection(currentIndex);
    }

    // Attach click event listeners to the next and back buttons
    document.getElementById('nextButton').addEventListener('click', showNextSection);
    document.getElementById('backButton').addEventListener('click', showPrevSection);
});
</script>

<script>
function goToIndex() {
    window.location.href = 'Supply Section.html';
}
</script>
</body>
</html>
