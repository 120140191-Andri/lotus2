<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    $tipe = 0;//mysqli_real_escape_string($db, $_REQUEST['tipe']);
    $no_nota = mysqli_real_escape_string($db, $_REQUEST['no_nota']);
    $jenis = mysqli_real_escape_string($db, $_REQUEST['jenis']);
    $user_transaksi = mysqli_real_escape_string($db, $_REQUEST['user_transaksi']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);
    $jumlah = mysqli_real_escape_string($db, $_REQUEST['jumlah']);
    $harga = mysqli_real_escape_string($db, $_REQUEST['harga']);
    $disc = mysqli_real_escape_string($db, $_REQUEST['disc']);
    $jum = mysqli_real_escape_string($db, $_REQUEST['jum']);
    $item = mysqli_real_escape_string($db, $_REQUEST['item']);
    $ppn_nota = mysqli_real_escape_string($db, $_REQUEST['ppn_nota']);
    $diskon_nota = mysqli_real_escape_string($db, $_REQUEST['diskon_nota']);
    $material = mysqli_real_escape_string($db, $_REQUEST['material']);
    $transaksi_id = mysqli_real_escape_string($db, $_REQUEST['transaksi_id']);

    if($tipe == 0){
    	$akses = 19;
    	$tujuan = ",supplier_id";
    }else if($tipe == 1){
    	$akses = 23;
    	$tujuan = ",pelanggan_id";
    }

	if(cek_hak_akses_aksi_submenu($userid,$akses,"user_tambah") > 0 ){
        $cek_nota = mysqli_num_rows(mysqli_query($db, "select * from transaksi where transaksi_id='$transaksi_id'"));
        if($cek_nota > 0){
            $checkuser = "SELECT * FROM pembelian WHERE material_id = '$material' and transaksi_id='$transaksi_id' LIMIT 0,1";
            $resultcheck = mysqli_query($db,$checkuser);
            $count = mysqli_num_rows($resultcheck);
            
            if($count == 0) {
                $sql = "INSERT INTO pembelian (pembelian_tipe,transaksi_id,supplier_id,material_id,pembelian_jumlah,pembelian_harga,pembelian_status,pembelian_opid,pembelian_tdiubah,pembelian_diskon) values ('$jenis','$transaksi_id','$user_transaksi','$material','$jumlah','$harga','0','$userid','$today','$disc')";
                
                if(mysqli_multi_query($db, $sql)){
                    $result['st'] = true;
                    $result['id'] = mysqli_insert_id($db);
                    $diskon = $harga * ($disc / 100);
                    $set_diskon = $harga - $disc;
                    $totx = ($set_diskon * $jumlah) + $jum;
                    $result['item'] = 1+$item;
                    $result['jum'] = number_format($totx,2);
                    $tot_diskon_nota = $totx - ($totx * ($diskon_nota /100));
                    $tot_ppn_nota = $tot_diskon_nota + ($tot_diskon_nota * ($ppn_nota / 100)); 
                    $result['tot'] = number_format($tot_ppn_nota,2);
                }else{
                    $result = "2";
                }
            }else{
                $result= "3";
            }
        }else{
            $result= "5";
        }
    }else{
        $result = "4";
    }

    echo json_encode($result);
   
?>