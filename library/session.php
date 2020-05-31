<?php
    include('library/config.php');
    session_start();
    $error = false;
   
    $user_check = $_SESSION['login_user'];
   
    $ses_sql = mysqli_query($db,"select * from karyawan where karyawan_user = '$user_check' ");
   
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
    $login_session      = $row['karyawan_user'];
    $userid             = $row['karyawan_id'];
    $usernamalengkap    = $row['karyawan_nama'];
    $userjob            = $row['karyawan_job'];
    $userstatus         = $row['karyawan_status'];

    $sessionsetting = mysqli_query($db,"select * from setting where karyawan_id = '$userid' ");
    $row2 = mysqli_fetch_array($sessionsetting,MYSQLI_ASSOC);
    $usersettingplt = $row2['setting_plt'];
    $usersettingb   = $row2['setting_b'];
    
    if(!isset($_SESSION['login_user'])){
        header("location:index.php");
        die();
    }
?>