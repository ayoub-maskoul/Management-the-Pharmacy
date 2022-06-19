

<?php
  
session_start();
if (!isset($_SESSION['id'])) {
    header("Location:index.php");
}
$id=$_SESSION['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pharmacie";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT codef, libelle FROM forme where userid=$id";
    $result = $conn->query($sql);
    $res = "";
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $res .=  "<tr> <td>" . $row["codef"]. "</td><td>" . $row["libelle"]. "</td> <td> "   . 
        '<a class="btn mx-2 btn-outline-danger"" href=./deletefor.php?del='.$row["codef"].'>Delete</a>'. 
        '<a class="btn btn-outline-success"" href=./updatefor.php?up='.$row["codef"].'>Update</a>' . "</td>". "</tr>";
    }
    } 
    $conn->close();
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
    <a class="btn btn-primary m-3" href="./addfor.php">Add</a>
    <a class="btn btn-primary m-3" href="./formes.php">Total the Medicament</a>
<table class="table p-4" >
  <thead>
    <tr>
      <th scope="col">Code forme</th>
      <th scope="col">Libelle</th>
      <th scope="col">Operation</th>
    </tr>
  </thead>
  <tbody>
    <?php
    echo $res;
    ?>
  </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>