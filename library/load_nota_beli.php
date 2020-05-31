 <?php
 include('../library/config.php');
 include('../library/config_hakakses.php');
 date_default_timezone_set('Asia/Jakarta');
$load=$_POST['load'];
if($load == "detail"){
    $no_nota=$_POST['no_nota'];
    $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);
    $xdata=[];
    if(cek_hak_akses_aksi_submenu($userid,20,"user_tambah") > 0 ){
        $dt = mysqli_fetch_assoc(mysqli_query($db, "select * from transaksi where transaksi_nota='$no_nota'"));
        $id = $dt['transaksi_id'];
        $data_mat = mysqli_query($db,"select * from pembelian inner join material on pembelian.material_id=material.material_id inner join satuan on material.satuan_id=satuan.satuan_id where pembelian.transaksi_id = '$id'");
        $no=0;
        $ret = 0;
        while($data_detail=mysqli_fetch_assoc($data_mat)){
            $no++; 
            $id_beli = $data_detail['pembelian_id'];

            $qty_retur = "0";
            $harga_retur = "0";
            $disabled = "";
            $title_button = "Tambah";
            $class = "btn-default tambah_retur";

            $data_retur = mysqli_fetch_assoc(mysqli_query($db,"select qty_retur,harga_retur,qty_retur*harga_retur as tot_r  from retur_beli_detail where id_beli_detail = '$id_beli'"));
            @$qty_retur_sebelumnya = $data_retur['qty_retur'];
            $max_retur = $data_detail['pembelian_jumlah'] - $qty_retur_sebelumnya;
            $ret += $data_retur['tot_r']; 
            if($max_retur == 0 || $max_retur < 0){
                $edit = "disabled";
            }else{
                $edit = "";
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
                    '<button class="'.$class.'" '.$edit.' data-id="'.$data_detail['material_id'].'" data-pembelian="'.$data_detail['pembelian_id'].'" id="retur'.$data_detail['material_id'].'" data-id_detail=""><span id="aksi'.$data_detail['material_id'].'">'.$title_button.'</span></button>'

            ]; 
         }


        $query_detail = "select * from retur_beli where date(tgl_retur)=date(now())"; 
        $hak_akses_result3 = mysqli_query($db,$query_detail); 
        $resultx = null;
        $dtx = mysqli_num_rows($hak_akses_result3);
        $no = $dtx+1;
        $resultx = "RB-".date("ymd")."-".sprintf("%03d",$no);
        $result['sup'] = $dt['supplier_id'];
        $result['tgl'] = Date('d/m/Y',strtotime($dt['transaksi_tanggal']));
        $result['no_retur'] = $resultx;
        $result['data'] = $xdata;

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
        $result['ret'] = number_format($tot-$ret,2);
    }else{
        $result = "denied";
    }
    echo json_encode($result);
 }else{
    $no_nota = mysqli_real_escape_string($db, $_REQUEST['no_nota']);
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
    $result['id'] = $dt['transaksi_id'];
    $result['diskon'] = $dt['transaksi_diskon'];
    $result['ppn'] = $dt['transaksi_ppn'];
    $result['tot'] = number_format($tot,2);
    $result['jum'] = number_format($jum,2);
    $result['nama'] = nama_supplier($dt['supplier_id']);
    $result['tgl'] = date('d/m/Y',strtotime($dt['transaksi_tanggal']));

    echo json_encode($result);
 }

 ?>  