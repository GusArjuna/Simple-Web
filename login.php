<?php
    require 'connections.php';
    session_start();
    if(isset($_COOKIE["mainkey"])&&isset($_COOKIE["us"])){
        $mainkey=$_COOKIE["mainkey"]; // mengambil cookie yang isinya id
        $us=$_COOKIE["mainkey"]; // mengambil cookie yang isinya hash username
        $user=mysqli_query($conn,"SELECT * FROM users WHERE id='$mainkey';"); // mengambil seluruh data dari user yang di input
        $user_verify=mysqli_fetch_assoc($user); // memilah dalam bentuk array associative
        if($user_verify["username"===hash("sha256",$us)]){ // cek apabila username dan hash username di cookie sama
            $_SESSION['login']=true; // add session
        }
    }

    if(isset($_POST['login'])){
        $username=$_POST["username"]; // ambil value username yang di imputkan user
        $password=$_POST["password"]; // ambil value password yang di inputkan user
        $stu=mysqli_query($conn,"SELECT * FROM users WHERE username='$username';"); // query mengambil value yang ada di database dengan username yang di tuju
        if(mysqli_num_rows($stu)===1){ // memastikan di $stu atau query di atas ada usernamenya 
            $student=mysqli_fetch_assoc($stu); // memilah value database agar ada penamannya
            if(password_verify($_POST["password"],$student["passwords"])){ // verivy password yang ada di database dan yang di inputkan 
                $_SESSION['login']=true; // add session
                if(isset($_POST["remember"])){ // cek apakah user centang remember me
                    setcookie("mainkey",$student["id"],time()+30000); // set cookie
                    setcookie("us",hash('sha256',$_POST["username"]),time()+30000); // set cookie
                }
                header("Location: index.php");
                exit;
            }else{
                echo "<script>alert('Password is wrong!');</script>";    
            }
        }else{
            echo "<script>alert('Username is doesn't Exist');</script>";
        }
    }
    if(isset($_SESSION['login'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="loginpage">
        <div class="loginbox">
            <h2>Login</h2>
            <form action="" method="post">
                <p><label for="username">Username</label></p>
                <div class="under">
                    <img src="img/ini.png">
                    <input type="text" name="username" id="username" placeholder="Username">
                </div>
                <p><label for="password">Password</label></p>
                <div class="under">
                    <img src="img/lockp.png">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <img src="img/mataputih.png" id="showpass" onclick="show('password');">
                </div>
                <div class="remem">
                    <label for="remember">Remember Me</label>
                    <input type="checkbox" name="remember" id="remember">
                </div>
                <button type="submit" name="login" id="login">Log In</button>
                <div class="linkforgot"><p><a href="forgot.php">Forgot Password</a></p><br><br></div>
                <div class="linkregist"><p>Don't have an Account? <a href="signup.php">Sign Up!</a></p></div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>