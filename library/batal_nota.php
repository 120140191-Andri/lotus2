<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");

    $tipe = mysqli_real_escape_string($db, $_REQUEST['tipe']);
    $id = mysqli_real_escape_string($db, $_REQUEST['id']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);

    if($tipe == 0){
        $akses = 19;
    }else if($tipe == 1){
        $akses = 23;
    }

    if(cek_hak_akses_aksi_submenu($userid,$akses,"user_hapus") > 0 ){
        $id = mysqli_real_escape_string($db, $_REQUEST['id']);
        $q = mysqli_query($db, "delete from transaksi where transaksi_id='$id'");

        if($q){
            $result = true;
        } else{
            $result = false;
        }
    }else{
        $result = "denied";
    }

    echo json_encode($result);
?>