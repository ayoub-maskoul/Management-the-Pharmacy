<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacie";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$codef = $_GET['up'];


$sql3 = "SELECT libelle FROM forme where codef='$codef'";
$result = $conn->query($sql3);
$val = $result->fetch_assoc();
$lib=$val['libelle'];
?>

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
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" name="libelle" value="<?php echo $lib;?>" placeholder="Entre your libelle" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </body>
</html>


<?php
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
    
    $sql = "UPDATE forme SET libelle='$libelle'  WHERE codef=$codef";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location:forme.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();
}
