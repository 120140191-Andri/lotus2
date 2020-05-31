<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");

    $entrybox1 = mysqli_real_escape_string($db, $_REQUEST['entrybox1']);
    $entrybox2 = mysqli_real_escape_string($db, $_REQUEST['entrybox2']);
    $entrybox3 = mysqli_real_escape_string($db, $_REQUEST['entrybox3']);
    $entrybox4 = mysqli_real_escape_string($db, $_REQUEST['entrybox4']);
    $entrybox5 = mysqli_real_escape_string($db, $_REQUEST['entrybox5']);
    $entrybox6 = mysqli_real_escape_string($db, $_REQUEST['entrybox6']);
    $entrybox7 = mysqli_real_escape_string($db, $_REQUEST['entrybox7']);
    $entrybox8 = mysqli_real_escape_string($db, $_REQUEST['entrybox8']);
    $entrybox9 = mysqli_real_escape_string($db, $_REQUEST['entrybox9']);

    $entryboxstrip1 = str_replace(",", "", $entrybox8);
    $entryboxstrip2 = str_replace(",", "", $entrybox9);

    $checkuser = "SELECT * FROM karyawan WHERE (karyawan_user = '$entrybox2' and karyawan_user <> '') LIMIT 1";
    $resultcheck = mysqli_query($db,$checkuser);
    $count = mysqli_num_rows($resultcheck);
        
    if($count == 1) {
        $_SESSION['errorexist'] = 1;   
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        $sql = "INSERT INTO karyawan (karyawan_nama, karyawan_user, karyawan_pass, karyawan_iplokasi, karyawan_job, hakakses_level, karyawan_ktp, karyawan_nohp, karyawan_alamat, karyawan_gbulanan, karyawan_gharian, karyawan_status, karyawan_opid, karyawan_tdiubah) VALUES ('$entrybox1', '$entrybox2', '$entrybox3', '0', '$entrybox4', '1', '$entrybox5', '$entrybox6', '$entrybox7', '$entryboxstrip1', '$entryboxstrip2', '1', '$userid', '$today') ; INSERT INTO setting (karyawan_id, setting_plt, setting_b) VALUES ('$entrybox1', 'CM', 'G')";

        if(mysqli_multi_query($db, $sql)){
            $_SESSION['successexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    };
?>