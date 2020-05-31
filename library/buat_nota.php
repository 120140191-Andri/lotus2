<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    $tipe = mysqli_real_escape_string($db, $_REQUEST['tipe']);
    $no_nota = mysqli_real_escape_string($db, $_REQUEST['no_nota']);
    $ppn = mysqli_real_escape_string($db, $_REQUEST['ppn']);
    $disc = mysqli_real_escape_string($db, $_REQUEST['disc']);
    $jenis = mysqli_real_escape_string($db, $_REQUEST['jenis']);
    $user_transaksi = mysqli_real_escape_string($db, $_REQUEST['user_transaksi']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);

    if($tipe == 0){
    	$akses = 19;
    	$tujuan = ",supplier_id";
    }else if($tipe == 1){
    	$akses = 23;
    	$tujuan = ",pelanggan_id";
    }

	if(cek_hak_akses_aksi_submenu($userid,$akses,"user_tambah") > 0 ){
        $checkuser = "SELECT * FROM transaksi WHERE transaksi_nota = '$no_nota' LIMIT 0,1";
        $resultcheck = mysqli_query($db,$checkuser);
        $count = mysqli_num_rows($resultcheck);
        
        if($count == 0) {
            $sql = "INSERT INTO transaksi (transaksi_tipe $tujuan,transaksi_tanggal,transaksi_status,transaksi_opid,transaksi_tdiubah,transaksi_nota,transaksi_ppn,transaksi_diskon) values ('$tipe','$user_transaksi','$today','$jenis','$userid','$today','$no_nota','$ppn','$disc')";

            if(mysqli_multi_query($db, $sql)){
                $result['st'] = true;
                $result['id'] = mysqli_insert_id($db);
            }else{
                $result = "2";
            }
        }else{
            $result= "3";
        }
    }else{
        $result = "4";
    }

    echo json_encode($result);
   
?>