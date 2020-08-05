<?php
    require 'connections.php';
    if(isset($_POST["submit"])){
        if(adduser($_POST)>0){
            echo "<script>
                    alert('Data Registered');
                    document.location.href='login.php';
                    </script>"; 
        }else{
            echo "<script>
                    alert('Data Unegistered');
                    </script>"; 
            mysqli_error($conn);
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
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="registpage">
        <div class="registbox">
            <form action="" method="post">
                <div class="keyword">
                    <p><label for="username">Username : </label></p>
                    <p><label for="passwd">Password : </label></p>
                    <p><label for="repasswd">Confirm password : </label></p>
                    <p><label for="email">E-Mail : </label></p>
                </div>
                <div class="inputuser">
                    <input type="text" name="username" id="username" placeholder="Username" required>
                    <div class="boxinputuser"></div>
                    <input type="password" name="passwd" id="passwd" placeholder="Password" required>
                    <img src="img/matahitam.png" id="showpass" onclick="show('passwd');">
                    <div class="boxinputuser"></div>
                    <input type="password" name="repasswd" id="repasswd" placeholder="Confirm" required>
                    <img src="img/matahitam.png" id="showpass" onclick="show('repasswd');">
                    <input type="text" name="email" id="email" placeholder="123@example.com" required>
                </div>
                <div class="term">
                        <input type="checkbox" name="terms" id="terms" required>
                        <label for="terms">I have read and agree to the <a href="">Terms of Service</a></label>
                        <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>