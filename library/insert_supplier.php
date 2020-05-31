<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    session_start();
    $nama_supplier = mysqli_real_escape_string($db, $_REQUEST['nama_supplier']);
    $cp_nama = mysqli_real_escape_string($db, $_REQUEST['cp_nama']);
    $no_rek = mysqli_real_escape_string($db, $_REQUEST['no_rek']);
    $kontak = mysqli_real_escape_string($db, $_REQUEST['kontak']);
    $bank = mysqli_real_escape_string($db, $_REQUEST['bank']);
    $alamat_supplier = mysqli_real_escape_string($db, $_REQUEST['alamat_supplier']);
    $cp_telepon = mysqli_real_escape_string($db, $_REQUEST['cp_telepon']);
    $st = mysqli_real_escape_string($db, $_REQUEST['st']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['opt']);

    if($_POST['id'] == ""){
        if(cek_hak_akses_aksi_submenu($userid,5,"user_tambah") > 0 ){ 
            $checkuser = "SELECT * FROM supplier WHERE UCASE(supplier_nama) = UCASE('$nama_supplier') LIMIT 0,1";
            $resultcheck = mysqli_query($db,$checkuser);
            $count = mysqli_num_rows($resultcheck);
            
            if($count == 0) {
                $sql = "INSERT INTO supplier values ('','$nama_supplier', '$bank', '$no_rek', '$alamat_supplier', '$kontak', '$cp_nama', '$cp_telepon','$st','$userid','$today')";

                if(mysqli_multi_query($db, $sql)){
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    $_SESSION['err']="1";
                }else{
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    $_SESSION['err']="2";
                }
            }else{
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                $_SESSION['err']="3";
            }
        }else{
            $result = "4";
            $_SESSION["err"]=10;
        }
    }else{
        if(cek_hak_akses_aksi_submenu($userid,5,"user_ubah") > 0 ){ 
            $id = mysqli_real_escape_string($db, $_REQUEST['id']);
            $checkuser = "SELECT * FROM supplier WHERE supplier_id = '$id' LIMIT 0,1";
            $resultcheck = mysqli_query($db,$checkuser);
            $count = mysqli_num_rows($resultcheck);
            
            if($count > 0) {
                $sql = "UPDATE supplier SET supplier_nama='$nama_supplier', supplier_bank='$bank', supplier_rekening='$no_rek', supplier_alamat='$alamat_supplier', supplier_kontak='$kontak', supplier_cpnama='$cp_nama', supplier_cptelpon='$cp_telepon',supplier_status='$st',supplier_opid='$userid',supplier_tdiubah='$today' where supplier_id='$id'";

                if(mysqli_multi_query($db, $sql)){
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    $_SESSION['err']="4";
                }else{
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    $_SESSION['err']="5";
                }
            }else{
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                $_SESSION['err']="6";
            }
        }else{
            $result = "4";
            $_SESSION["err"]=10;
        }
    }
?>