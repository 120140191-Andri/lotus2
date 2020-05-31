<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");

    $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);
    $load = mysqli_real_escape_string($db, $_REQUEST['load']);

    if(cek_hak_akses_aksi_submenu($userid,20,"user_tambah") > 0 ){
        if($load == "detail"){
            $no_nota = mysqli_real_escape_string($db, $_REQUEST['no_nota']);
            $datax = mysqli_query($db, "select * from retur_beli where no_retur_beli='$no_nota'");
        }else{
           $datax = mysqli_query($db, "select * from retur_beli where operator_nota='$userid' and status=0"); 
        }
        
        $cek_nota = mysqli_num_rows($datax);
        if($cek_nota > 0){
            $dt = mysqli_fetch_assoc($datax);
            $t_id = $dt['id_beli'];
            $r_id = $dt['id_retur_beli'];
            $data_nota = mysqli_fetch_assoc(mysqli_query($db, "select * from transaksi where transaksi_id='$t_id'"));

                $result['count']    = 1;
                $result['no_retur'] = $dt['no_retur_beli'];
                $result['tgl_nota'] = date('d/m/Y',strtotime($data_nota['transaksi_tanggal']));
                $result['no_nota']  = $data_nota['transaksi_nota'];
                $result['sup']      = $data_nota['supplier_id'];

            $no_nota=$data_nota['transaksi_nota'];
            $xdata=[];
            $dt = mysqli_fetch_assoc(mysqli_query($db, "select * from transaksi where transaksi_nota='$no_nota'"));
            $id = $dt['transaksi_id'];
            $data_mat = mysqli_query($db,"select * from pembelian inner join material on pembelian.material_id=material.material_id inner join satuan on material.satuan_id=satuan.satuan_id where pembelian.transaksi_id = '$id'");
            $no=0;
            $tot_retur = 0;
            $ret = 0;
            while($data_detail=mysqli_fetch_assoc($data_mat)){
                $id_beli = $data_detail['pembelian_id'];
                $datax = mysqli_query($db,"select * from retur_beli_detail where id_retur_beli='$r_id' and id_beli_detail='$id_beli'");
                $count_data = mysqli_num_rows($datax);
                if($count_data > 0){
                    $cek_detail = mysqli_fetch_assoc($datax);
                    $qty_retur = $cek_detail['qty_retur'];
                    $harga_retur = $cek_detail['harga_retur'];
                    $disabled = "disabled";
                    $title_button = "Hapus";
                    $class = "btn-danger hapus_retur";
                    $tot_retur += $cek_detail['qty_retur'] * $cek_detail['harga_retur'];
                }else{
                    $qty_retur = "0";
                    $harga_retur = "0";
                    $disabled = "";
                    $title_button = "Tambah";
                    $class = "btn-default tambah_retur";
                    $tot_retur += 0;
                }

                $id_beli = $data_detail['pembelian_id'];
                $data_retur = mysqli_fetch_assoc(mysqli_query($db,"select qty_retur,harga_retur,qty_retur*harga_retur as tot_r from retur_beli_detail inner join retur_beli on retur_beli_detail.id_retur_beli=retur_beli.id_retur_beli where id_beli_detail = '$id_beli' and retur_beli.status <> 0"));
                @$qty_retur_sebelumnya = $data_retur['qty_retur'];
                $max_retur = $data_detail['pembelian_jumlah'] - $qty_retur_sebelumnya;
                $ret += $data_retur['tot_r']; 
                $no++; 
                if($max_retur == 0 || $max_retur < 0){
                    $edit = "disabled";
                }else{
                    $edit = "";
                }

                if($load == "detail"){
                    $btn = "";
                    $edit = "disabled";
                }else{
                    $btn = '<button class="'.$class.'" '.$edit.' data-id="'.$data_detail['material_id'].'" data-pembelian="'.$data_detail['pembelian_id'].'" id="retur'.$data_detail['material_id'].'" data-id_detail=""><span id="aksi'.$data_detail['material_id'].'">'.$title_button.'</span></button>';
                }
                $xdata[] = [
                    $no.'.',
                    $data_detail['material_barcode'],
                    $data_detail['material_nama']." - ".$data_detail['pembelian_jumlah'], 
                    '<div class="input-table"><input type="text" class="input-trans cleaveuang" autocomplete="off" data-id_beli="" name="jumlah" style="width:60px!important;" autocomplete="off" value="'.$data_detail['pembelian_jumlah'].'" style="background-color:#80808063;" disabled id="jumlah'.$data_detail['material_id'].'"><label>'.$data_detail['satuan_nama'].'</label></div>', 
                    '<input type="text" class="input-trans cleaveuang" value="'.$data_detail['pembelian_harga'].'"  style="width:80px!important;" data-id_belix="" autocomplete="off" disabled name="harga" id="harga'.$data_detail['material_id'].'">', 
                    '<input type="text" class="input-trans cleaveuang" style="width:60px!important;" autocomplete="off" style="background-color:#80808063;" disabled  value="'.$max_retur.'" name="max_qty" id="max_qty'.$data_detail['material_id'].'">', 
                    '<input type="text" class="input-trans cleaveuang"  style="width:50px!important;"   data-id_belix="" autocomplete="off" name="qty_retur" '.$edit.' '.$disabled.' value="'.$qty_retur.'" id="qty_retur'.$data_detail['material_id'].'">', 
                    '<input type="text" '.$edit.' class="input-trans cleaveuang" style="width:80px!important;"  data-id_belix="" autocomplete="off" value="'.$harga_retur.'" '.$disabled.' name="harga_retur" id="harga_retur'.$data_detail['material_id'].'">', 
                    $btn

                ]; 
             }

                $result['data'] = $xdata;
                $result['retur'] = $tot_retur;

                $item = 0;
                $jum = 0;
                $tot = 0;
                $dt = mysqli_fetch_assoc(mysqli_query($db, "select * from transaksi where transaksi_nota='$no_nota'"));
                $t_id = $dt['transaksi_id'];
                $q_mat = mysqli_query($db, "select * from pembelian inner join material on pembelian.material_id=material.material_id  where transaksi_id='$t_id'");
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
                    $id_beli = $dt_mat['pembelian_id'];
                    $data_retur = mysqli_fetch_assoc(mysqli_query($db,"select qty_retur,harga_retur from retur_beli_detail where id_beli_detail = '$id_beli'"));
                    @$qty_ret = $data_retur['qty_retur'];
                    $max_retur = $dt_mat['pembelian_jumlah'] - $qty_retur;
                    $dtx=array(
                        'material_id' => $dt_mat['material_id'],
                        'jumlah' => $dt_mat['pembelian_jumlah'],
                        'pembelian_id' => $dt_mat['pembelian_id'],
                        'pembelian_tot' => $set_tot,
                        'pembelian_total' => $set_fix,
                        'pembelian_diskon' => $dt_mat['pembelian_diskon'],
                        'pembelian_harga' => $dt_mat['pembelian_harga'],
                        'material_barcode' => $dt_mat['material_barcode'],
                        'max_retur' => $max_retur,
                        ); 
                    $xid[]=$dtx;
                }
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
                $result['item'] = $item;
                $result['jum'] = number_format($jum,2);
                $result['tot'] = number_format($tot,2);
                if($load != "detail"){
                    $result['setelah_retur'] = number_format(($tot-$ret)-$tot_retur,2);
                }else{
                    $data_retur_all = mysqli_fetch_assoc(mysqli_query($db,"select qty_retur,harga_retur,sum(qty_retur*harga_retur) as tot_r from retur_beli_detail inner join retur_beli on retur_beli_detail.id_retur_beli=retur_beli.id_retur_beli where id_beli = '$t_id'"));
                    $ret_all = $data_retur_all['tot_r']; 
                    $result['setelah_retur'] = number_format($tot-$ret_all,2);
                }

        }else{
            $result= "5";
        }
    }else{
        $result = "denied";
    }
        
    echo json_encode($result);
?>