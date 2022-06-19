
<?php
$prenom='';
$nom='';
$email='';
$password='';
$cpassword='';


session_start();

if (isset($_SESSION['prenom'])) {
    header("Location:index.php");
}
if (isset($_POST['submit'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pharmacie";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $prenom=$_POST['prenom'];
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    if ($password==$cpassword){
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<script>alert('this email already exists')</script>";
        } else{
            $sql = "INSERT INTO user ( prenom,nom ,email,password)
            VALUES ( '$prenom', '$nom','$email','$password')";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                $prenom='';
                $nom='';
                $email='';
                $password='';
                $cpassword='';
                echo "<script>
                    alert('sing is completed')
                    document.location='index.php';
                    </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }else{
        echo "<script>alert('Password Not Matched')</script>";
    }
    $conn->close();
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body style="background-color: #FFE77AFF;">
    <div class="container  w-50">
    <div class=" text-center">
            <img class="img-fluid" src="./images/Pharmacy.svg" alt="">
        </div>
        <form method="post" class="p-5">
            <div class="mb-3">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" value="<?php echo $prenom ;?>" placeholder="Entre your prenom" name="prenom">
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" value="<?php echo $nom ;?>" placeholder="Entre your nom" name="nom">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="<?php echo $email ;?>" placeholder="Entre your email" name="email">
            </div>
            <div class="mb-3">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" value="<?php echo $password ;?>" placeholder="Entre your password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirme Password</label>
                <input type="password" class="form-control" value="<?php echo $cpassword ;?>" placeholder="Entre your password again" name="cpassword">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">sing up</button>
        </form>
        <div><span>Have an account? </span><a  class="btn btn-success" href="./index.php">log in</a></div>
    </div>
</body>
</html>