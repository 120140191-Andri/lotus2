<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    $id = mysqli_real_escape_string($db, $_REQUEST['id']);
    $ppn = mysqli_real_escape_string($db, $_REQUEST['ppn']);
    $disc = mysqli_real_escape_string($db, $_REQUEST['disc']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['opt']);

	if(cek_hak_akses_aksi_submenu($userid,19,"user_ubah") > 0 ){
        $checkuser = "SELECT * FROM transaksi WHERE transaksi_id = '$id' LIMIT 0,1";
        $resultcheck = mysqli_query($db,$checkuser);
        $count = mysqli_num_rows($resultcheck);
        
        if($count > 0) {
            $sql = "UPDATE transaksi set transaksi_opid='$userid',transaksi_tdiubah='$today',transaksi_ppn='$ppn',transaksi_diskon='$disc' where transaksi_id='$id'";

            if(mysqli_multi_query($db, $sql)){
                $result = true;
            }else{
                $result = "2";
            }
        }else{
            $result= "5";
        }
    }else{
        $result = "4";
    }

    echo json_encode($result);
   
?>