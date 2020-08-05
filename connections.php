<?php
    $conn = mysqli_connect('localhost','root','','pagelogin');
    
    function shows($req){
        global $conn;                               // untuk mengambil $conn di atas biar jadi global
        $result = mysqli_query($conn,$req);         // mengambil query dari $_req tapi masih bentuk array di dalam array
        $rows=[];                                   // membuat array untuk wadah
        while($row=mysqli_fetch_assoc($result)){
            $rows[]=$row;
        }
        return $rows;
    }

    function addstudent($req){
        global $conn;
        
        $fullname = mysqli_real_escape_string($conn,htmlspecialchars($req["fullname"]));
        $gender = mysqli_real_escape_string($conn,htmlspecialchars($req["gender"]));
        $day = mysqli_real_escape_string($conn,htmlspecialchars($req["day"]));
        $month = mysqli_real_escape_string($conn,htmlspecialchars($req["month"]));
        $year = mysqli_real_escape_string($conn,htmlspecialchars($req["year"]));
        $phone = mysqli_real_escape_string($conn,htmlspecialchars($req["phone"]));
        $dob=$day." ".$month." ".$year;
        $national = mysqli_real_escape_string($conn,htmlspecialchars($req["national"]));
        $faculty = mysqli_real_escape_string($conn,htmlspecialchars($req["faculty"]));
        $major = mysqli_real_escape_string($conn,htmlspecialchars($req["major"]));
        $ssid = mysqli_real_escape_string($conn,htmlspecialchars($req["ssid"]));
        $addresss = mysqli_real_escape_string($conn,htmlspecialchars($req["addresss"]));
        $city = mysqli_real_escape_string($conn,htmlspecialchars($req["city"]));
        $same = mysqli_query($conn,"SELECT ssid FROM students WHERE ssid='$ssid';");
        if(mysqli_fetch_assoc($same)){
               echo"<script>alert('Student ID is already exist!');</script>";
            return false;
        }

        //  mysqli_real_escape_string buat escape char khusus kayak ' ben bisa di masukno
        // htmlspecialchars buat menghilangkan efek tag html barangkali ada user iseng masukkan tag html ke dalam database

        $add = "INSERT INTO students VALUES(
            '$fullname','$gender','$dob','$phone','$national','$faculty','$major','$ssid','$addresss','$city'
        );";

        mysqli_query($conn,$add);
        return mysqli_affected_rows($conn);
    }

    function adduser($req){
        global $conn;
        
        $username = htmlspecialchars($req["username"]);
        $password = htmlspecialchars($req["passwd"]);
        $repassword = htmlspecialchars($req["repasswd"]);
        $email = htmlspecialchars($req["email"]);
        $same = mysqli_query($conn,"SELECT username FROM users WHERE username='$username';");
        if(mysqli_fetch_assoc($same)){
               echo"<script>alert('username is already exist!');</script>";
            return false;
        }

        if($password !== $repassword){
            echo"<script>alert('Password is not same');</script>";
            return false;
        }

        $password = password_hash($password,PASSWORD_DEFAULT);
        mysqli_query($conn,"INSERT INTO users VALUES
        ('','$username','$password','$email');");

        return mysqli_affected_rows($conn);

    }
    
    function studentSearch($req){
        $search="SELECT * FROM students WHERE 
        fullname LIKE '%$req%' OR
        faculty LIKE '%$req%' OR
        major LIKE '%$req%' OR
        ssid LIKE '%$req%';";
        return shows($search);
    }

    function update($req,$id){
        global $conn;
        
        $fullname = mysqli_real_escape_string($conn,htmlspecialchars($req["fullname"]));
        $gender = mysqli_real_escape_string($conn,htmlspecialchars($req["gender"]));
        $day = mysqli_real_escape_string($conn,htmlspecialchars($req["day"]));
        $month = mysqli_real_escape_string($conn,htmlspecialchars($req["month"]));
        $year = mysqli_real_escape_string($conn,htmlspecialchars($req["year"]));
        $phone = mysqli_real_escape_string($conn,htmlspecialchars($req["phone"]));
        $dob=$day." ".$month." ".$year;
        $national = mysqli_real_escape_string($conn,htmlspecialchars($req["national"]));
        $faculty = mysqli_real_escape_string($conn,htmlspecialchars($req["faculty"]));
        $major = mysqli_real_escape_string($conn,htmlspecialchars($req["major"]));
        $addresss = mysqli_real_escape_string($conn,htmlspecialchars($req["addresss"]));
        $city = mysqli_real_escape_string($conn,htmlspecialchars($req["city"]));

        //  mysqli_real_escape_string buat escape char khusus kayak ' ben bisa di masukno
        // htmlspecialchars buat menghilangkan efek tag html barangkali ada user iseng masukkan tag html ke dalam database

        $updt = "UPDATE students SET 
        fullname='$fullname', 
        gender='$gender', 
        phone='$phone', 
        dob='$dob', 
        national='$national', 
        faculty='$faculty', 
        major='$major', 
        addresss='$addresss', 
        city='$city'
        WHERE ssid='$id';";

        mysqli_query($conn,$updt);
        return mysqli_affected_rows($conn);
    }
?>