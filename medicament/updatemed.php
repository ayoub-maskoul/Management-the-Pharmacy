<?php
$codem = $_GET['up'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacie";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql2 = "SELECT codef FROM forme";
$result = $conn->query($sql2);
$res = "";
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $res .= "<option value=".$row["codef"].">" .$row["codef"] ."</option>";
    }
} else{
    $res = "<option> nothing</option>";
}


$sql3 = "SELECT nom , ppv ,qt FROM medicament where codem='$codem'";
$result = $conn->query($sql3);
$val = $result->fetch_assoc();
$nom=$val['nom'];
$prix=$val['ppv'];
$qt = $val['qt'];
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
                <li class="nav-link pt-4"><a class="navbar-brand " href="../forme/forme.php">forme</a></li>
                <li class="nav-link pt-4"><a class="navbar-brand " href="./medicament.php">Medicament</a></li>
            </ul>
            <a href="../logout.php" class="text-decoration-none">Logout</a>
        </nav>
    </header>
        <form method="post" class="p-5">
            <div class="mb-3">
                <label for="nomM" class="form-label">nom medicament</label>
                <input type="text" class="form-control" value="<?php echo $nom;?>" placeholder="Entre your nom medicament" name="nomM">
            </div>
            <div class="mb-3">
            <select name="codef" class="form-select">
                <?php
                    echo $res;
                ?>
            </select>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">prix</label>
                <input type="text" class="form-control" value="<?php echo $prix ;?>" placeholder="Entre your prix" name="prix">
            </div>
            <div class="mb-3">
                <label for="qt" class="form-label">QT</label>
                <input type="text" class="form-control" value="<?php echo $qt ;?>" placeholder="Entre your qt" name="qt">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>

<?php
$codem = $_GET['up'];


if (isset($_POST['submit'])){
    $nomM=$_POST['nomM'];
    $codef=$_POST['codef'];
    $prix=$_POST['prix'];
    $qt=$_POST['qt'];
    
    $sql = "UPDATE medicament SET nom='$nomM', codef='$codef' ,ppv='$prix',qt='$qt'   WHERE codem='$codem'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location:medicament.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>