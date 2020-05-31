<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");

    $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);
    $idx = mysqli_real_escape_string($db, $_REQUEST['idx']);
    $transaksi_id = mysqli_real_escape_string($db, $_REQUEST['transaksi_id']);
    if($idx != ""){
        if(cek_hak_akses_aksi_submenu($userid,19,"user_ubah") > 0 ){
            $cek_nota = mysqli_num_rows(mysqli_query($db, "select * from transaksi where transaksi_id='$transaksi_id'"));
            if(($cek_nota > 0 && $transaksi_id != "") || $transaksi_id == ""){
                $q = mysqli_query($db, "select * from transaksi where transaksi_id='$idx'");
                $dt = mysqli_fetch_assoc($q);
                $jum = mysqli_num_rows($q);
                if($jum > 0){
                    $result['count'] = $jum;
                    $result['no_nota'] =  $dt['transaksi_nota'];
                    $result['tipe'] =  $dt['transaksi_tipe'];
                    $result['disc'] =  $dt['transaksi_diskon'];
                    $result['ppn'] =  $dt['transaksi_ppn'];
                    if($dt['transaksi_tipe'] == 0){
                        $result['user_transaksi'] = $dt['supplier_id'];
                    }else{
                        $result['user_transaksi'] = $dt['pelanggan_id'];
                    }
                    $result['status'] = $dt['transaksi_status'];
                    $result['id'] = $dt['transaksi_id'];
                    $t_id = $dt['transaksi_id'];
                    $dtx=null;
                    $xid=null;
                    $item = 0;
                    $jum = 0;
                    $tot = 0;
                    $q_mat = mysqli_query($db, "select * from pembelian inner join material on pembelian.material_id=material.material_id  where pembelian_opid='$userid' and transaksi_id='$t_id'");
                    while($dt_mat = mysqli_fetch_assoc($q_mat)){
                        $item++;
                        $set_fix = 0;
                        if($dt_mat['pembelian_diskon'] > 0){
                            $diskon = $dt_mat['pembelian_harga'] * ($dt_mat['pembelian_diskon'] / 100);
                        }else{
                            $diskon = 0;
                        }
                        $set_diskon = $dt_mat['pembelian_harga'] - $diskon;
                        $set_tot = $dt_mat['pembelian_harga']  * $dt_mat['pembelian_jumlah'];
                        $set_fix = $set_diskon  * $dt_mat['pembelian_jumlah'];
                        $jum=$jum+$set_fix;
                        $dtx=array(
                            'material_id' => $dt_mat['material_id'],
                            'jumlah' => $dt_mat['pembelian_jumlah'],
                            'pembelian_id' => $dt_mat['pembelian_id'],
                            'pembelian_tot' => $set_tot,
                            'pembelian_total' => $set_fix,
                            'pembelian_diskon' => $dt_mat['pembelian_diskon'],
                            'pembelian_harga' => $dt_mat['pembelian_harga'],
                            'material_barcode' => $dt_mat['material_barcode'],
                            ); 
                        $xid[]=$dtx;
                    }
                    $result['data_mat'] = $xid;
                    $result['item'] = $item;
                    if($dt['transaksi_diskon'] > 0){
                        $diskon_nota = $jum * ($dt['transaksi_diskon'] / 100);
                    }else{
                        $diskon_nota = 0;
                    }
                    $set_diskon_nota = $jum - $diskon_nota;
                    if($dt['transaksi_ppn'] > 0){
                        $ppn_nota = $set_diskon_nota * ($dt['transaksi_ppn'] / 100);
                    }else{
                        $ppn_nota = 0;
                    }
                    $tot = $set_diskon_nota + $ppn_nota;
                    $result['jum'] = number_format($jum,2);
                    $result['tot'] = number_format($tot,2);
                } else{
                    $result['count'] = 0;
                }
            }else{
                $result= "5";
            }
        }else{
            $result = "4";
        }
    }else{
        if(cek_hak_akses_aksi_submenu($userid,19,"user_tambah") > 0 ){
            $cek_nota = mysqli_num_rows(mysqli_query($db, "select * from transaksi where transaksi_id='$transaksi_id'"));
            if(($cek_nota > 0 && $transaksi_id != "") || $transaksi_id == ""){
                $q = mysqli_query($db, "select * from transaksi where transaksi_opid='$userid' and transaksi_proses=0");
                $dt = mysqli_fetch_assoc($q);
                $jum = mysqli_num_rows($q);
                if($jum > 0){
                    $result['count'] = $jum;
                    $result['no_nota'] =  $dt['transaksi_nota'];
                    $result['tipe'] =  $dt['transaksi_tipe'];
                    $result['disc'] =  $dt['transaksi_diskon'];
                    $result['ppn'] =  $dt['transaksi_ppn'];
                    if($dt['transaksi_tipe'] == 0){
                        $result['user_transaksi'] = $dt['supplier_id'];
                    }else{
                        $result['user_transaksi'] = $dt['pelanggan_id'];
                    }
                    $result['status'] = $dt['transaksi_status'];
                    $result['id'] = $dt['transaksi_id'];
                    $t_id = $dt['transaksi_id'];
                    $dtx=null;
                    $xid=null;
                    $item = 0;
                    $jum = 0;
                    $tot = 0;
                    $q_mat = mysqli_query($db, "select * from pembelian inner join material on pembelian.material_id=material.material_id  where pembelian_opid='$userid' and transaksi_id='$t_id'");
                    while($dt_mat = mysqli_fetch_assoc($q_mat)){
                        $item++;
                        $set_fix = 0;
                        if($dt_mat['pembelian_diskon'] > 0){
                            $diskon = $dt_mat['pembelian_harga'] * ($dt_mat['pembelian_diskon'] / 100);
                        }else{
                            $diskon = 0;
                        }
                        $set_diskon = $dt_mat['pembelian_harga'] - $diskon;
                        $set_tot = $dt_mat['pembelian_harga']  * $dt_mat['pembelian_jumlah'];
                        $set_fix = $set_diskon  * $dt_mat['pembelian_jumlah'];
                        $jum=$jum+$set_fix;
                        $dtx=array(
                            'material_id' => $dt_mat['material_id'],
                            'jumlah' => $dt_mat['pembelian_jumlah'],
                            'pembelian_id' => $dt_mat['pembelian_id'],
                            'pembelian_tot' => $set_tot,
                            'pembelian_total' => $set_fix,
                            'pembelian_diskon' => $dt_mat['pembelian_diskon'],
                            'pembelian_harga' => $dt_mat['pembelian_harga'],
                            'material_barcode' => $dt_mat['material_barcode'],
                            ); 
                        $xid[]=$dtx;
                    }
                    $result['data_mat'] = $xid;
                    $result['item'] = $item;
                    if($dt['transaksi_diskon'] > 0){
                        $diskon_nota = $jum * ($dt['transaksi_diskon'] / 100);
                    }else{
                        $diskon_nota = 0;
                    }
                    $set_diskon_nota = $jum - $diskon_nota;
                    if($dt['transaksi_ppn'] > 0){
                        $ppn_nota = $set_diskon_nota * ($dt['transaksi_ppn'] / 100);
                    }else{
                        $ppn_nota = 0;
                    }
                    $tot = $set_diskon_nota + $ppn_nota;
                    $result['jum'] = number_format($jum,2);
                    $result['tot'] = number_format($tot,2);
                } else{
                    $result['count'] = 0;
                }
            }else{
                $result= "5";
            }
        }else{
            $result = "4";
        }
        
    }

    echo json_encode($result);
?>