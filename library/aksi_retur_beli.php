<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');
    $today = date("Y-m-d H:i:s");

    if(isset($_GET['aksi'])){
        if($_GET['aksi'] == "simpan"){
            $no_nota_retur = mysqli_real_escape_string($db, $_REQUEST['no_nota_retur']);
            $id_pembelian = mysqli_real_escape_string($db, $_REQUEST['id_pembelian']);
            $qty_retur = mysqli_real_escape_string($db, $_REQUEST['qty_retur']);
            $harga_retur = mysqli_real_escape_string($db, $_REQUEST['harga_retur']);
            $max_ret = mysqli_real_escape_string($db, $_REQUEST['max_ret']);
            $harga_modal = mysqli_real_escape_string($db, $_REQUEST['harga_modal']);
            $tot_retur_sebelumnya = mysqli_real_escape_string($db, $_REQUEST['tot_retur']);
            $tot_setelah_retur = mysqli_real_escape_string($db, $_REQUEST['tot_setelah_retur']);
            $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);

            if(cek_hak_akses_aksi_submenu($userid,20,"user_tambah") > 0 ){
                $q = mysqli_query($db, "select * from retur_beli where no_retur_beli='$no_nota_retur'");
                $data_r = mysqli_fetch_assoc($q);
                $x = mysqli_num_rows($q);
                if($x > 0){
                    $id_retur_beli = $data_r['id_retur_beli'];
                    
                    $cek_duplikat_data = mysqli_num_rows(mysqli_query($db, "select id_beli_detail from retur_beli_detail where id_retur_beli='$id_retur_beli' and id_beli_detail='$id_pembelian'"));
                    if($cek_duplikat_data > 0){
                        $result['duplikat'] = true;
                    }else{
                        $cek_data_qty_retur = mysqli_fetch_assoc(mysqli_query($db, "select sum(qty_retur) as jum_qty_retur from retur_beli_detail where id_beli_detail='$id_pembelian'"));
                        $cek_data_qty_beli = mysqli_fetch_assoc(mysqli_query($db, "select pembelian_jumlah from pembelian where pembelian_id='$id_pembelian'"));
                        if(($cek_data_qty_retur['jum_qty_retur']+$qty_retur) > $cek_data_qty_beli['pembelian_jumlah']){
                            $result['perubahan'] = true;
                            $result['duplikat'] = false;
                        }else{
                            $simp = mysqli_query($db,"insert into retur_beli_detail (id_retur_beli,id_beli_detail,qty_retur,harga_retur,qty_keluar,status,operator_gdg,max_retur,harga_dtg_set_disc) values ('$id_retur_beli','$id_pembelian','$qty_retur','$harga_retur','0',NULL,NULL,'$max_ret','$harga_modal')");
                            
                            if($simp){
                                $result['id'] = mysqli_insert_id($db);
                                $tot_retur =  $qty_retur * $harga_retur;
                                $result['ret'] = number_format($tot_retur+$tot_retur_sebelumnya);
                                $result['setelah_retur'] = number_format($tot_setelah_retur-$tot_retur,2);
                                $result['hasil'] = true;
                                $result['perubahan'] = false;
                                $result['duplikat'] = false;
                            }else{
                                $result['hasil'] = false;
                                $result['perubahan'] = false;
                                $result['duplikat'] = false;
                            }
                        }
                    }
                }else{
                    $result['hasil'] = false;
                    $result['perubahan'] = false;
                    $result['duplikat'] = false;
                }
            }else{
                $result = "denied";
            }

            echo json_encode($result);
        }else if($_GET['aksi'] == "batal"){
            $no_nota_retur = mysqli_real_escape_string($db, $_REQUEST['no_nota_retur']);
            $id_pembelian = mysqli_real_escape_string($db, $_REQUEST['id_pembelian']);
            $qty_retur = mysqli_real_escape_string($db, $_REQUEST['qty_retur']);
            $harga_retur = mysqli_real_escape_string($db, $_REQUEST['harga_retur']);
            $tot_ret = mysqli_real_escape_string($db, $_REQUEST['tot_retur']);
            $tot_setelah_retur = mysqli_real_escape_string($db, $_REQUEST['tot_setelah_retur']);
            $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);

           if(cek_hak_akses_aksi_submenu($userid,20,"user_hapus") > 0 ){
                $q = mysqli_query($db, "select * from retur_beli where no_retur_beli='$no_nota_retur'");
                $x = mysqli_num_rows($q);
                if($x > 0){
                    $data_r = mysqli_fetch_assoc($q);
                    $id_retur_beli = $data_r['id_retur_beli'];
                    $simp = mysqli_query($db,"delete from retur_beli_detail where id_retur_beli='$id_retur_beli' and id_beli_detail='$id_pembelian'");
                    if($simp){
                        $result['hasil'] = true;
                        $result['ret'] = number_format(($tot_ret - ($qty_retur * $harga_retur)));
                        $pengurangan_retur = $qty_retur * $harga_retur;
                        $result['setelah_retur'] = number_format($tot_setelah_retur+$pengurangan_retur,2);
                    }else{
                        $result['hasil'] = false;
                    }
                } else{
                    $result['hasil'] = false;
                }
            }else{
                $result = "denied";
            }

            echo json_encode($result);
        }else if($_GET['aksi'] == "selesai"){
            $no_nota_retur = mysqli_real_escape_string($db, $_REQUEST['no_nota_retur']);
            $userid = mysqli_real_escape_string($db, $_REQUEST['userid']);

           if(cek_hak_akses_aksi_submenu($userid,20,"user_tambah") > 0 ){
                $q = mysqli_query($db, "select * from retur_beli where no_retur_beli='$no_nota_retur'");
                $x = mysqli_num_rows($q);
                if($x > 0){
                    $data_cek_retur = mysqli_fetch_assoc($q);
                    $id_retur = $data_cek_retur['id_retur_beli'];
                    $q2 = mysqli_query($db, "select * from retur_beli_detail where id_retur_beli='$id_retur'");
                    $y = mysqli_num_rows($q2);
                    if($y > 0){
                        $simp = mysqli_query($db,"update retur_beli set status='1' where id_retur_beli='$id_retur'");
                        if($simp){
                            $result['hasil'] = true;
                        }else{
                            $result['hasil'] = false;
                        }
                    }else{
                        $result['hasil'] = "Kosong";
                    }
                } else{
                    $result['hasil'] = false;
                }
            }else{
                $result = "denied";
            }

            echo json_encode($result);
        }
    }
?>