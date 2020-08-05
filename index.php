<?php
    session_start();
    require 'connections.php';
    if(!$_SESSION['login']){
        header("Location: login.php");
    }
    if(isset($_POST['logout'])){
        session_unset(); // matikan session
        session_destroy(); // matikan session
        setcookie("mainkey","",time()-3600); // matikan cookie
        setcookie("us","",time()-3600); // matikan cookie
        header("Location: login.php");
    }
    if(isset($_POST['addproduct'])){
        header("Location: add.php");
    }

    $students=shows("SELECT * FROM students");

    if(isset($_POST['searchbutton'])){
        $students=studentSearch($_POST["searchbar"]);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="indexpage">
        <div class="uptopindex">
            <a href="index.php"><img src="img/kucingpoi.png" width="110px" height="30px"></a>
            <div class="searchpart">
                <form action="" method="post">
                    <input type="text" name="searchbar" id="searchbar" placeholder="Search">
                    <button type="submit" name="searchbutton" id="searchbutton"></button>
                </form>
            </div>
        </div>
        <div class="downtopindex"></div>
        <div class="indexbox">
            <div class="header">
                <a href="index.php"><img src="img/kucingpoi.png" width="380px" height="90px"></a>
                <a href="index.php"><img src="img/headliner.JPG" width="450px" height="90px" style="margin-left: 130px;"></a>
            </div>
            <div class="recomended">Rekomendasi</div>
            <div class="recomendedcontent">Hotnews</div>
            <div class="content">
                <div class="headercontent">List Produk Terbaru</div>
                <form action="" method="POST">
                    <button name="addproduct" id="addproduct"> Add New Product</button>
                    <img src="img/loadinggif.gif" class="gif">
                    <div class="tablecontent" id="tableid">
                        <table class="table-index">
                        <tr style="position: absolute; top: 253px;">
                            <th class="indexnumbertable">No.</th>
                            <th style="width: 150px;">Action</th>
                            <th style="width: 160px;">Student ID</th>
                            <th style="width: 170px;">Name</th>
                            <th style="width: 85px;">Faculty</th>
                            <th style="width: 88px;">Major</th>
                        </tr>
                        <?php $i=1; foreach($students as $student):?>
                        <tr>
                            <td class="indexnumbertable"><?= $i; $i++?></td>
                            <td style="width: 150px;">
                                <a href="edit.php?ssid=<?= $student['ssid']?>" id="act1">Edit</a>
                                <a href="delete.php?ssid=<?= $student['ssid']?>" id="act2" onclick="return confirm('Are you Sure?');">Delete</a>
                            </td>
                            <td style="width: 160px;"><?= $student["ssid"]?></td>
                            <td style="width: 170px;"><?= $student["fullname"]?></td>
                            <td style="width: 85px;"><?= $student["faculty"]?></td>
                            <td style="width: 85px;"><?= $student["major"]?></td>
                        </tr>
                        <?php endforeach;?>
                        </table>
                    </div>
                    <button name="logout" id="logout" onclick="return confirm('Are you Sure?');">Log Out!</button>
                </form>
            </div>
            <div class="sidecontent"><div class="headersidecontent"></div></div>
            <div class="footer"><div class="headerfooter"></div></div>
        </div>
    </div>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="script.js"></script>   
</body>
</html>