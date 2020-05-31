<?php
    include('config.php');
    include('config_hakakses.php');
    $today = date("Y-m-d H:i:s");

    if(isset($_GET['aksi'])){
        if($_GET['aksi'] == "simpan"){
            $userid = mysqli_real_escape_string($db, $_REQUEST['sess']);
            $opsi = "user_".mysqli_real_escape_string($db, $_REQUEST['opsi']);
            if(cek_hak_akses_aksi_submenu($userid,2,$opsi) == 1 ){
                $hakakses = $_POST['hakakses'];
                $id = mysqli_real_escape_string($db, $_REQUEST['id']);
                if(count($hakakses) > 0){
                    for($x=0;$x<count($hakakses);$x++){
                        $data_akses = explode("#",$hakakses[$x]);
                        $data_id = $data_akses[0];
                        $data_akses_value = $data_akses[1];

                        @$cek_data = mysqli_num_rows(mysqli_query($db, "select * from hakakses where karyawan_id='$id' and hakakses_access='$data_id'"));
                        $q = false;
                        if($cek_data > 0){
                            if($data_akses_value == "lihat"){
                                $dt = "user_lihat=if(user_lihat=0,'1',user_lihat)";
                            }else if($data_akses_value == "tambah"){
                                $dt = "user_tambah=if(user_tambah=0,'1',user_tambah)";
                            }else if($data_akses_value == "ubah"){
                                $dt = "user_ubah=if(user_ubah=0,'1',user_ubah)";
                            }else if($data_akses_value == "hapus"){
                                $dt = "user_hapus=if(user_hapus=0,'1',user_hapus)";
                            }else if($data_akses_value == "android"){
                                $dt = "android=if(android=0,'1',android)";
                            }
                            $sql = "UPDATE hakakses set $dt where karyawan_id='$id' and hakakses_access='$data_id'";
                        }else{
                            if($data_akses_value == "lihat"){
                                $dt = ", user_lihat";
                            }else if($data_akses_value == "tambah"){
                                $dt = ", user_tambah";
                            }else if($data_akses_value == "ubah"){
                                $dt = ", user_ubah";
                            }else if($data_akses_value == "hapus"){
                                $dt = ", user_hapus";
                            }else if($data_akses_value == "android"){
                                $dt = ", android";
                            }
                            $sql = "INSERT INTO hakakses (karyawan_id, hakakses_level, hakakses_access $dt) VALUES ('$id', '0', '$data_id','1')";
                        }
                        $q = mysqli_query($db, $sql);
                    }
                }else{
                    $sql = "DELETE FROM hakakses where karyawan_id='$id'";
                    $q = mysqli_query($db, $sql);
                }

                $cek_data_bedax = mysqli_query($db, "select * from hakakses where karyawan_id='$id' order by hakakses_id asc");
                while($cek_data_beda=mysqli_fetch_assoc($cek_data_bedax)){
                    $pembanding='';
                    $counter= 0;
                    $d="";
                    if($cek_data_beda['user_lihat']=="1"){
                        $pembanding = $cek_data_beda['hakakses_access']."#lihat";
                        $cek_status_akses = in_array($pembanding, $hakakses);
                        if(!$cek_status_akses){
                            $counter++;
                            $d.=",user_lihat=0";
                        }
                    }
                    if($cek_data_beda['user_tambah']=="1"){
                        $pembanding = $cek_data_beda['hakakses_access']."#tambah";
                        $cek_status_akses = in_array($pembanding, $hakakses);
                        if(!$cek_status_akses){
                            $counter++;
                            $d.=",user_tambah=0";
                        }
                    }
                    if($cek_data_beda['user_ubah']=="1"){
                        $pembanding = $cek_data_beda['hakakses_access']."#ubah";
                        $cek_status_akses = in_array($pembanding, $hakakses);
                        if(!$cek_status_akses){
                            $counter++;
                            $d.=",user_ubah=0";
                        }
                    }
                    if($cek_data_beda['user_hapus']=="1"){
                        $pembanding = $cek_data_beda['hakakses_access']."#hapus";
                        $cek_status_akses = in_array($pembanding, $hakakses);
                        if(!$cek_status_akses){
                            $counter++;
                            $d.=",user_hapus=0";
                        }
                    }
                    if($cek_data_beda['android']=="1"){
                        $pembanding = $cek_data_beda['hakakses_access']."#android";
                        $cek_status_akses = in_array($pembanding, $hakakses);
                        if(!$cek_status_akses){
                            $counter++;
                            $d.=",android=0";
                        }
                    }

                    $id_hapus = $cek_data_beda['hakakses_access'];
                    if($counter == 5){
                        
                        mysqli_query($db, "delete from hakakses where karyawan_id='$id' and hakakses_access='$id_hapus'");
                    }else if($counter > 0 && $counter < 5){
                        $d = substr($d,1);
                        mysqli_query($db, "update hakakses set  $d where karyawan_id='$id' and hakakses_access='$id_hapus'");
                    }
                }

                if($q){
                    $result = true;
                } else{
                    $result = false;
                }

            }else{
                $result = 'denied';
            }
        
            echo json_encode($result);

        }else if($_GET['aksi']=="reset"){
            $userid = mysqli_real_escape_string($db, $_REQUEST['sess']);
            if(cek_hak_akses_aksi_submenu($userid,2,"user_ubah") == 1){
                $id = mysqli_real_escape_string($db, $_REQUEST['id']);
                $q = mysqli_query($db, "delete from hakakses where karyawan_id='$id'");

                if($q){
                    $result = true;
                } else{
                    $result = false;
                }
            }else{
                $result = false;
            }

            echo json_encode($result);
        }else{
            $result = "denied";
            echo json_encode($result);
        }
    }else{
        $result = "denied";
        echo json_encode($result);
    }
?>