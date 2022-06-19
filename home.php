<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location:index.php");
}
$id=$_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
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
                <li class="nav-link  p-1"><a class="navbar-brand " href="./home.php"> <img src="./images/Pharmacy.svg" alt=""></a> </li>
                <li class="nav-link pt-4"><a class="navbar-brand " href="./forme/forme.php">forme</a></li>
                <li class="nav-link pt-4"><a class="navbar-brand " href="./medicament/medicament.php">Medicament</a></li>
            </ul>
            <a href="logout.php" class="text-decoration-none">Logout</a>
        </nav>
    </header>
    <div class="container row">
        <h1 class="d-flex pb-5 px-5 align-items-center col-6 ">
            Hallo <?php echo $_SESSION['nom'].' '.$_SESSION['prenom'];?> Welcome to your Pharmacy Management
        </h1>
        <div class="col-6">
            <img src="./images/Pharmacist-cuate.svg" class="float-end " alt="">
        </div>
    </div>
</body>
</html>
