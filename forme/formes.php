
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

    $sql = "SELECT f.libelle, sum(m.qt) AS total_medicament , sum(m.qt * m.ppv) AS total_prix from forme f ,  medicament m where f.codef = m.codef AND f.userid=$id group by f.libelle " ;
    $result = $conn->query($sql);
    $res = "";
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $res .=  "<tr> <td>" . $row["libelle"]. "</td><td>" . $row["total_medicament"]. "</td><td>" . $row["total_prix"]. "</td>  </tr>";
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
<table class="table p-4" >
  <thead>
    <tr>
      <th scope="col">forme</th>
      <th scope="col">QT</th>
      <th scope="col">Prix total</th>
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