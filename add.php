<?php
    session_start();
    require 'connections.php';
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
    }
    if(isset($_POST['submit'])){
        if(addstudent($_POST)>0){
            echo "<script>
                    alert('Data Successfully Added!');
                    document.location.href='index.php';
                </script>"; 
        }else{
            echo "<script>
                    alert('Data Unsuccessfully Added!');
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
                    <p><label for="national">Nationality : </label></p>
                </div>
                <div class="inputuser">
                    <input type="text" name="fullname" id="fullname" placeholder="Jhonny Sudarman" value="" required>
                    <input type="text" name="gender" id="gender" placeholder="Male" value="" required>
                    <input type="text" name="day" id="day" placeholder="DD" value="" required><label>\</label>
                    <input type="text" name="month" id="month" placeholder="MM" value="" required><label>\</label>
                    <input type="text" name="year" id="year" placeholder="YYYY" value="" required>
                    <input type="text" name="phone" id="phone" placeholder="062-****"  value="" required>
                    <input type="text" name="national" id="national" placeholder="Indonesian" value="" required>
                </div>
                <div class="keyword">
                <p><label for="faculty">Faculcty : </label></p>
                <p><label for="major">Major : </label></p>
                <p><label for="ssid">Student ID : </label></p>
                <p><label for="address">Address : </label></p>
                <p><label for="city">City </label></p>
            </div>
            <div class="inputuser">
                <input type="text" name="faculty" id="faculty" placeholder="Technical" value="" required>
                <input type="text" name="major" id="major" placeholder="Information" value="" required>
                <input type="text" name="ssid" id="ssid" placeholder="1461****" value="" required>
                <input type="text" name="addresss" id="addresss" placeholder="Jl. jockey***" value="" required>
                <input type="text" name="city" id="city" placeholder="Los Angeles" value="" required>
            </div>
            <button type="submit" name="submit">Submit</button>
            <button name="cancel" onclick="var noAngkot=0; while(noAngkot<12){document.getElementsByTagName('input')[noAngkot].setAttribute('value','y');noAngkot++;}">Cancel</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>