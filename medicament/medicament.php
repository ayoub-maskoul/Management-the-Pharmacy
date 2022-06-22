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

    $sql = "SELECT codem, nom , codef , ppv ,qt FROM medicament where userid=$id";
    $result = $conn->query($sql);
    $res = "";
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $res .=  "<tr> <td>" . $row["codem"]. "</td><td>" . $row["nom"]. "</td> <td> "
        . $row["codef"]. "</td> <td> "   . $row["ppv"]. "</td><td> "   . $row["qt"]. "</td> <td> ". 
        '<a class="btn mx-2 btn-outline-danger"" href=./deletemed.php?del='.$row["codem"].'>Delete</a>'. 
        '<a class="btn btn-outline-success"" href=./updatemed.php?up='.$row["codem"].'>Update</a>' . "</td>". "</tr>";
    }
    }
    $sql2 = "SELECT codef,libelle FROM forme where userid=$id";
    $result = $conn->query($sql2);
    $res2 = "";
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $res2 .= "<option value=".$row["codef"].">" .$row["libelle"] ."</option>";
      }
    } else{
        $res2 = "<option> nothing</option>";
    }
    

  if (isset($_POST['searche'])){
    $codef= $_POST['codef'];
    $sql = "SELECT codem, nom , codef , ppv , qt FROM medicament WHERE codef=$codef AND userid=$id";
    if ($result->num_rows > 0){
      $result = $conn->query($sql);
      $res = "";
      if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $res .=  "<tr> <td>" . $row["codem"]. "</td><td>" . $row["nom"]. "</td> <td> "
          . $row["codef"]. "</td> <td> "   . $row["ppv"]. "dh</td><td> "   . $row["qt"]. "</td> <td> ". 
          '<a class="btn mx-2 btn-outline-danger"" href=./deletemed.php?del='.$row["codem"].'>Delete</a>'. 
          '<a class="btn btn-outline-success"" href=./updatemed.php?up='.$row["codem"].'>Update</a>' . "</td>". "</tr>";
      }
    }
    } else{
      echo "<script>alert('nothing forme')</script>";
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
                <li class="nav-link pt-4"><a class="navbar-brand " href="../forme/forme.php">forme</a></li>
                <li class="nav-link pt-4"><a class="navbar-brand " href="./medicament.php">Medicament</a></li>
            </ul>
            <a href="../logout.php" class="text-decoration-none">Logout</a>
        </nav>
    </header>
    <a class="btn btn-primary m-3" href="./addmed.php">Add</a>
    <form method="post">
      <label for="codef" class="form-label mx-3">libelle</label>
      <div class="mb-3 mx-3 d-flex">
        <select name="codef" class="form-select w-25">
            <?php
                echo $res2;
            ?>
        </select>
        <input type="submit" name="searche" class="btn btn-primary m-1" value="searche">
      </div>
    </form>
<table class="table p-4" class="">
  <thead>
    <tr>
      <th scope="col">Code medicament</th>
      <th scope="col">nom medicament</th>
      <th scope="col">code forme</th>
      <th scope="col">prix</th>
      <th scope="col">QT</th>
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


