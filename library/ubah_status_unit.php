<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    session_start();
    $st = mysqli_real_escape_string($db, $_REQUEST['st']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['opt']);

  
    if(cek_hak_akses_aksi_submenu($userid,10,"user_ubah") > 0 ){ 
        $id = mysqli_real_escape_string($db, $_REQUEST['id']);

        $sql = "UPDATE unit SET unit_status='$st',unit_opid='$userid',unit_tdiubah=now() where unit_id='$id'";

        if(mysqli_multi_query($db, $sql)){
            //header('Location: ' . $_SERVER['HTTP_REFERER']);
            $_SESSION['err']="4";
        }else{
            //header('Location: ' . $_SERVER['HTTP_REFERER']);
            $_SESSION['err']="5";
        }
       
    }else{
        $result = "4";
        $_SESSION["err"]=10;
    }
    
?>