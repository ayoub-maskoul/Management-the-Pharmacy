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
    $codem =$_GET['del'];
    $sql = "DELETE FROM medicament WHERE codem=$codem";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                    alert('code medicament $codem is delete')
                    document.location='medicament.php';
            </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
}
?>