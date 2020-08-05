<?php
    require 'connections.php';
    $del=$_GET["ssid"];
    mysqli_query($conn,"DELETE FROM students WHERE ssid=$del");
    if(mysqli_affected_rows($conn)>0){
        echo "<script>
                alert('Data Successfully Deleted');
                document.location.href='index.php';
            </script>";
    }else{
        echo "<script>
                alert('Data Unsuccessfully Deleted');
                document.location.href='index.php';
            </script>";
    }

?>