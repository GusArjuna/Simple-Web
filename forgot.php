<?php 
    require 'connections.php';
    $i=true; // set $i true
    $g=false;
    if(isset($_GET["makesure"])){
        $username=$_GET["username"]; //mendapatkan username dari inputan user
        $user=mysqli_query($conn,"SELECT * FROM users WHERE username='$username';"); //mengambil data dari database global
        if(mysqli_num_rows($user)===1){ // memastikan di $user atau query di atas ada usernamenya 
            $i=false;   // mengubah $i menjadi false biar ganti tampilannya
            $userid=mysqli_fetch_assoc($user); //mendapatkan datanya nya bentuk associative array            
            $id=$userid["id"]; //mengambil id dari username yang di input user
        }else{
            $g=true;
        }
    }
    if(isset($_POST["submit"])){
        $username=$_GET["username"]; //mendapatkan username dari inputan user
        $user=mysqli_query($conn,"SELECT * FROM users WHERE username='$username';"); //mengambil data dari database global
        $userid=mysqli_fetch_assoc($user); //mendapatkan datanya nya bentuk associative array            
        $id=$userid["id"]; //mengambil id dari username yang di input user
        $password = htmlspecialchars($_POST["newpassword"]); // mengambil password baru yang di input user
        $repassword = htmlspecialchars($_POST["newrepasswd"]); // confirm new password
        if($password !== $repassword){// cek passwordnya sama tidak
            $i=false;   // mengubah $i menjadi false biar ganti tampilannya
        }else{
            $password = password_hash($password,PASSWORD_DEFAULT);    // jika password sama maka password di hash di encripyt
            mysqli_query($conn,"UPDATE users SET passwords='$password' WHERE id='$id';"); // query untuk update
            if(mysqli_affected_rows($conn)>0){ // jika berhasil maka direct ke login
                echo "<script>
                    alert('Data Changed');
                    document.location.href='login.php';
                    </script>"; 
            }else{
                echo "<script> 
                    alert('Data Unchanged');
                    </script>";
                echo mysqli_error($conn);
                $i=false;   // mengubah $i menjadi false biar ganti tampilannya
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="forgotpage">
        <?php if($i):?>
        <div class="forgotbox1">
        <form action="" method="get">
                <div class="keyword">
                    <p><label for="username">Username : </label></p>
                </div>
                <div class="inputuser">
                    <input type="text" name="username" id="username" placeholder="Username" required>
                </div>
                <button type="submit" name="makesure">Submit</button>
            </form>
        </div>
        <?php else:?>
        <iv class="forgotbox2">
        <form action="" method="post">
                <div class="keyword">
                    <p><label for="newpassword">New Password : </label></p>
                    <p><label for="newrepasswd">Confirm New Password : </label></p>
                </div>
                <div class="inputuser">
                    <div class="boxinputuser"></div>
                    <input type="password" name="newpassword" id="newpassword" placeholder="Password" required>
                    <img src="img/matahitam.png" id="showpass" onclick="show('newpassword');">
                    <div class="boxinputuser"></div>
                    <input type="password" name="newrepasswd" id="newrepasswd" placeholder="Confirm" required>
                    <img src="img/matahitam.png" id="showpass" onclick="show('newrepasswd');">
                </div>
                <button type="submit" name="submit">Submit</button>
            </form>
        </iv>
        <?php endif;?>
    </div>
    <script src="script.js"></script>
</body>
</html>