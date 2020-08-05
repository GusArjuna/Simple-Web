<?php
    require 'connections.php';
    $ssid=$_GET["ssid"];
    $student=shows("SELECT * FROM students WHERE ssid='$ssid'")[0];
    $dob=explode(' ',$student['dob']);
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
    }
    if(isset($_POST['submit'])){
        if(update($_POST,$ssid)>0){
            echo "<script>
                    alert('Data Changed');
                    document.location.href='index.php';
                </script>"; 
        }else{
            echo "<script>
                    alert('Data Unchanged');
                </script>";
                echo mysqli_error($conn);
        }
    }
    if(isset($_POST['cancel'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="addpage">
        <div class="addbox">
            <form action="" method="post">
                <div class="keyword">
                    <p><label for="fullname">Fullname : </label></p>
                    <p><label for="gender">Gender : </label></p>
                    <p><label>Date of Birth : </label></p>
                    <p><label for="phone">Phone Number : </label></p>
                    <p><label for="email">Nationality : </label></p>
                </div>
                <div class="inputuser">
                    <input type="text" name="fullname" id="fullname" value="<?= $student['fullname']?>" placeholder="Jhonny Sudarman" required>
                    <input type="text" name="gender" id="gender" value="<?= $student['gender']?>" placeholder="Male" required>
                    <input type="text" name="day" id="day" value="<?= $dob[0]?>" placeholder="DD" required><label>\</label>
                    <input type="text" name="month" id="month" value="<?= $dob[1]?>" placeholder="MM" required><label>\</label>
                    <input type="text" name="year" id="year" value="<?= $dob[2]?>" placeholder="YYYY" required>
                    <input type="text" name="phone" id="phone" value="<?= $student['phone']?>" placeholder="062-****" required>
                    <input type="text" name="national" id="national" value="<?= $student['national']?>" placeholder="Indonesian" required>
                </div>
                <div class="keyword">
                <p><label for="faculty">faculty : </label></p>
                <p><label for="major">Major : </label></p>
                <p><label for="address">Address : </label></p>
                <p><label for="city">City </label></p>
            </div>
            <div class="inputuser">
                <input type="text" name="faculty" id="faculty" value="<?= $student['faculty']?>" placeholder="Technical" required>
                <input type="text" name="major" id="major" value="<?= $student['major']?>" placeholder="Information" required>
                <input type="text" name="addresss" id="addresss" value="<?= $student['addresss']?>" placeholder="Jl. jockey***" required>
                <input type="text" name="city" id="city" value="<?= $student['city']?>" placeholder="Los Angeles" required>
            </div>
            <button type="submit" name="submit" >Submit</button>
            <button name="cancel" >Cancel</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>