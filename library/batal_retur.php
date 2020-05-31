<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");

    $no_nota_retur = mysqli_real_escape_string($db, $_REQUEST['no_nota_retur']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);

   /* if($tipe == 0){
        $akses = 19;
    }else if($tipe == 1){
        $akses = 23;
    }*/

    //if(cek_hak_akses_aksi_submenu($userid,$akses,"user_hapus") > 0 ){
        $q = mysqli_query($db, "delete from retur_beli where no_retur_beli='$no_nota_retur'");

        if($q){
            $result = true;
        } else{
            $result = false;
        }
    /*}else{
        $result = "denied";
    }*/

    echo json_encode($result);
?>