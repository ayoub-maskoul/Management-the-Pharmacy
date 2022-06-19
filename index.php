
<?php

session_start();

error_reporting(0);
if (isset($_SESSION['id'])) {
    header("Location:home.php");
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
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql = "SELECT * FROM user WHERE email ='$email' AND password ='$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['prenom']=$row['prenom'];
        $_SESSION['nom']=$row['nom'];
        $_SESSION['id']=$row['id'];
        header("Location: home.php");
    } else{
        echo "<script>alert('Email or password is worng')</script>";
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
    <div class="container w-50" >
        <div class=" text-center">
            <img class="img-fluid" src="./images/Pharmacy.svg" alt="">
        </div>
        <form method="post" class="p-5">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control"  value="<?php echo $email ;?>"  placeholder="Entre your email" name="email">
            </div>
            <div class="mb-3">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control"  value="<?php echo $password ;?>"  placeholder="Entre your password" name="password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">log in</button>
        </form>
        <div><a  class="btn btn-success" href="./sing.php">Create New Account</a></div>
    </div>
</body>
</html>




