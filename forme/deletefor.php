<?php
if (isset($_GET['del'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pharmacie";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $codef =$_GET['del'];
    $sql2= "SELECT codef FROM medicament WHERE codef='$codef'";
    $result = $conn->query($sql2);
    if($result->num_rows > 0){
        echo "<script>
                  alert('you cant delete $codef ')
                  document.location='forme.php';
              </script>";
              die ("Error");
              
    }
    $sql = "DELETE FROM forme WHERE codef=$codef";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                  alert('code forme $codef is delete')
                  document.location='forme.php';
              </script>";
      } 
    $conn->close();
}
?>