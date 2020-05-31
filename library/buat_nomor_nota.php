<?php
    include('../library/config.php');

    $today = date("Y-m-d H:i:s");
    $tipe=$_POST['tipe'];
    if($tipe == 0){
        $tipe_val = "NB-";
    }else if($tipe == 1){
        $tipe_val = "NJ-";
    }
    $query_detail = "select * from transaksi where date(transaksi_tanggal)=date(now()) and transaksi_tipe='$tipe'"; 
    $hak_akses_result3 = mysqli_query($db,$query_detail); 
    $resultx = null;
    $dtx = mysqli_num_rows($hak_akses_result3);
    $no = $dtx+1;
    $resultx = $tipe_val."".date("ymd")."-".sprintf("%03d",$no);

    echo json_encode($resultx);
?>