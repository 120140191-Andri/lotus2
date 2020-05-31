<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");

    $trans_id = mysqli_real_escape_string($db, $_REQUEST['trans_id']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);
    $no_nota_retur = mysqli_real_escape_string($db, $_REQUEST['no_nota_retur']);


    if(cek_hak_akses_aksi_submenu($userid,20,"user_tambah") > 0 ){
        /*$cek_nota = mysqli_num_rows(mysqli_query($db, "select * from retur_beli"));//" where id_beli='$trans_id' and date(tgl_retur)=date(now())"));
        if($cek_nota > 0){
            $result = "5";
        }else{*/
            $q = mysqli_query($db, "insert into retur_beli (tgl_retur,no_retur_beli,id_beli,status,operator_nota) values (now(),'$no_nota_retur','$trans_id','0','$userid')");

            if($q){
                $result = true;
            } else{
                $result = false;
            }
        //}
    }else{
        $result = "denied";
    }

    echo json_encode($result);
?>