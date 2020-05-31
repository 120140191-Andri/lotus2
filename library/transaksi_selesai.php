<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");

    $st = mysqli_real_escape_string($db, $_REQUEST['st']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);
    $tipe = 0;

    if($tipe == 0){
        $akses = 19;
    }else if($tipe == 1){
        $akses = 23;
    }

    if(cek_hak_akses_aksi_submenu($userid,$akses,"user_tambah") > 0 ){
        $id = mysqli_real_escape_string($db, $_REQUEST['id']);
        $q2 = mysqli_query($db, "select * from pembelian where transaksi_id='$id'");
        $row_data = mysqli_num_rows($q2);
        if($row_data > 0){
            $q = mysqli_query($db, "update transaksi set transaksi_proses='$st' where transaksi_id='$id'");

            if($q){
                $result = true;
            } else{
                $result = false;
            }
        }else{
            $result = null;
        }
    }else{
        $result = "denied";
    }

    echo json_encode($result);
?>