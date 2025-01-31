<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
 <div class="fade-in">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    </button>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="btn btn-dark nav-link" href="log.html"> <i class="bi bi-person-fill-x"></i>
              Log Out</a> 
        </li>
    </ul>
    </div>
  </nav>
    
<div class="container">

<?php
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-success'>".$_SESSION['message']."</div>";
    unset($_SESSION['message']);
}

$servername = "localhost";
$username = "Group8";
$password = "";
$database = "if0_36660578_smplsp";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, password FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table border='1'>
    <tr>
    <th>Username</th>
    <th>Password</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["username"]."</td>
        <td>".$row["password"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
<div class="fade-in">
<div class="container">
    <div class="button"> <h2> CONTROL PANEL</h2> <i class="bi bi-tools"></i>
    
        <form action='https://localhost/project/adminu.php' method='post'> <h2> Updates Account </h2>
            <input type='text' name='current_username' placeholder='Current Username' required>
            <input type='text' name='new_username' placeholder='New Username'>
            <input type='text' name='new_password' placeholder='New Password'>
            <input type='submit' class="btn btn-outline-success" value='Update'>
        </form>
        
        <form action='https://localhost/project/admini.php' method='post'>
            <input type='text' name='username' placeholder='Username' required>
            <input type='text' name='password' placeholder='Password' required>
            <input type='submit' class="btn btn-outline-success" value='Insert'>
        </form>
        
        <form action='https://localhost/project/admind.php' method='post'>
            <input type='text' name='usernamedelete' placeholder='Username' required>
            <input type='submit' class="btn btn-outline-danger" value='Delete'>
        </form>

    </div>
</div>
<div class="fade-in">
<div class = "container">
<p>
1. <i class="bi bi-arrow-down-square-fill"></i> Insert: Inserting data refers to adding new records or rows into a database table.
</p>
<p>
2. <i class="bi bi-gear-wide-connected"></i> Update: Updating data involves modifying existing records or rows in a database table with new values.
</p>
<p>
3. <i class="bi bi-trash3-fill"></i> Delete: Deleting data entails removing existing records or rows from a database table.
</p>
</div>
</div>

</body>
</html>
