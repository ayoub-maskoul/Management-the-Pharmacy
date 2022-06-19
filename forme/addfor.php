<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        a{
            color: #2C5F2D;
        }
    </style>
</head>
<body>
    <header style="background-color: #FFE77AFF;">
        <nav class="navbar d-flex justify-content-around align-items-center">
            <ul class="nav">
                <li class="nav-link  p-1"><a class="navbar-brand " href="../home.php"> <img src="../images/Pharmacy.svg" alt=""></a> </li>
                <li class="nav-link pt-4"><a class="navbar-brand " href="./forme.php">forme</a></li>
                <li class="nav-link pt-4"><a class="navbar-brand " href="../medicament/medicament.php">Medicament</a></li>
            </ul>
            <a href="../logout.php" class="text-decoration-none">Logout</a>
        </nav>
    </header>
        <form method="post" class="p-5">
            <div class="mb-3">
                <label for="libelle" class="form-label">libelle</label>
                <input type="text" class="form-control" placeholder="Entre your libelle" name="libelle">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>


<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location:index.php");
}
$id=$_SESSION['id'];
if (isset($_POST['submit'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pharmacie";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $libelle=$_POST['libelle'];
    
    $sql = "INSERT INTO forme ( libelle,userid)
    VALUES ( '$libelle',$id)";

    if ($conn->query($sql) === TRUE) {
        header("Location:forme.php");
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

?>