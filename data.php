<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECORDED DATA</title>
    <link rel="stylesheet" href="datastyle.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    
    <style>
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
}

.bg-image {
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%; 
    height: 100%; 
    object-fit: cover; 
    z-index: -1;
    filter: blur(8px);
}

.parent-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.button-container {
    position: fixed;
    display: flex;
    bottom: 20px;
    left: 20px;
}

.button-container button {
      margin: 5px;
}

.button-back {
    position: fixed;
    bottom: 20px;
    right: 20px;
}


.container {
  background-color: #ccc;
    border: 1px solid #000;
    width: calc(100% - 30px); 
    padding: 20px;
    margin: 10px;
    border-radius: 10px;
    box-sizing: border-box;
}


table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

@media (max-width: 600px) {
    .background {
        background-size: cover;
        background-position: center;
    }
}

@media (max-width: 768px) {
    .button-container {
        bottom: 10px;
        left: 10px;
        flex-direction: column; 
    }

    .button-back {
        bottom: 10px;
        right: 10px;
    }

.container {
    background-color: #ccc;
    border: 2px solid #000;
    width: calc(50% - 20px);
    padding: 20px;
    margin: 10px auto 20px auto; 
    border-radius: 10px;
    box-sizing: border-box;
    overflow-x: auto;
    text-align: center; 
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto; 
}

th,
td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}


@media (max-width: 600px) {
    .container {
        width: 100%;
        padding: 10px; 
    }

    th,
    td {
        padding: 4px; 
    }
}

    </style>
</head>
<body>

 <img src="warehouse.jpg" alt="warehouse" class="bg-image">

    <div class="background"></div>
    <p></p>
<div class="parent-container">

    <?php
    $servername = "localhost";
    $username = "Group8";
    $password = "";
    $database = "if0_36660578_smplsp";
    

  
    $conn = new mysqli($servername, $username, $password, $database);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
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
        <button id="backButton" class="btn btn-outline-dark" disabled> <i class="bi bi-caret-left-square-fill"></i> Back</button>
        <button id="nextButton" class="btn btn-outline-primary">Next <i class="bi bi-caret-right-square-fill"></i></button>
        <div class= "button-back">
        <button class="btn btn-outline-danger" onclick="goToIndex()">Go back to Supply Section <i class="bi bi-caret-down-square-fill"></i></button>

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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>