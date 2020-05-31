<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $editboxid = mysqli_real_escape_string($db, $_REQUEST['editboxid']);
    $editbox1 = mysqli_real_escape_string($db, $_REQUEST['editbox1']);
    $editbox2 = mysqli_real_escape_string($db, $_REQUEST['editbox2']);
    $editbox3 = mysqli_real_escape_string($db, $_REQUEST['editbox3']);
    $editbox4 = mysqli_real_escape_string($db, $_REQUEST['editbox4']);
    $editbox5 = mysqli_real_escape_string($db, $_REQUEST['editbox5']);
    $editbox6 = mysqli_real_escape_string($db, $_REQUEST['editbox6']);
    $editbox7 = mysqli_real_escape_string($db, $_REQUEST['editbox7']);
    $editbox8 = mysqli_real_escape_string($db, $_REQUEST['editbox8']);
    $editbox9 = mysqli_real_escape_string($db, $_REQUEST['editbox9']);
    $editboxstat = mysqli_real_escape_string($db, $_REQUEST['editboxstat']);

    $editboxstrip1 = str_replace(",", "", $editbox8);
    $editboxstrip2 = str_replace(",", "", $editbox9);

    $checkuser = "SELECT * FROM karyawan WHERE (karyawan_user = '$editbox2' and karyawan_id <> '$editboxid' and karyawan_user <> '') LIMIT 1";
    $resultcheck = mysqli_query($db,$checkuser);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $_SESSION['errorexist'] = 1;   
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        $sql = "UPDATE karyawan SET karyawan_nama='$editbox1', karyawan_user='$editbox2', karyawan_pass='$editbox3', karyawan_iplokasi='1', karyawan_job='$editbox4', karyawan_ktp='$editbox5', karyawan_nohp='$editbox6', karyawan_alamat='$editbox7', karyawan_gbulanan='$editboxstrip1', karyawan_gharian='$editboxstrip2', karyawan_status='$editboxstat', karyawan_opid='$userid', karyawan_tdiubah='$today' WHERE karyawan_id='$editboxid' LIMIT 1 ";
        
        if(mysqli_multi_query($db, $sql)){
            $_SESSION['updateexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    };
?>