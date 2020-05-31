<?php
    $error = false;
    $error2 = false;
    include("library/config.php");
    session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
        
        $sql = "SELECT * FROM karyawan WHERE karyawan_user = '$myusername' and karyawan_pass = '$mypassword' and (karyawan_status = '0' OR karyawan_status = '1')";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $sess = $row['karyawan_id'];
        $count = mysqli_num_rows($result);
        
        if($count == 1) {
            $_SESSION['login_user'] = $myusername;    
            $_SESSION['sess'] =$sess;
            header("location: dashboard.php");
        }else{
            $error = true;
        };
   }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="asset/favicon.png" />
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/script.js"></script>
</head>

<script>
function showpass() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>

<body style="position:relative;">
    <div class="logincontainer">
        <div class="loginnamatoko">
            
        </div>
        <div class="loginform">
            <h1 class="loginformh1">LOTUS</h1>
            <h4 class="loginformh4">Masuk ke sistem</h4>
            <form action="" method = "post">
                <h5 class="loginformh5">USERNAME</h5>
                <input class="textinput" type="text" id="username" name="username" value="" autocomplete="off" required><br>
                <h5 class="loginformh5">PASSWORD</h5>
                <input class="textinput" type="password" id="password" name="password" value="" required><br>
                
                <label class="container_check" style ="float:left; padding-top:2px;"><h5 class="loginformh5" style ="float:left; margin-left:5px;">Lihat password</h5><input type="checkbox" value="" onclick="showpass()"><span class="checkmark_box"></span></label>
                <input class="loginformsubmit" type="submit" value="MASUK">
            </form>
            <?php if ($error == true) { ?>
            <div class="loginalert"><h5>Password salah / karyawan tidak aktif</h5></div>
            <?php
                };
            ?>
            
        </div>
    </div>
</body>