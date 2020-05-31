<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    session_start();
    $nama_pelanggan = mysqli_real_escape_string($db, $_REQUEST['nama_pelanggan']);
    $cp_nama = mysqli_real_escape_string($db, $_REQUEST['cp_nama']);
    $no_rek = mysqli_real_escape_string($db, $_REQUEST['no_rek']);
    $kontak = mysqli_real_escape_string($db, $_REQUEST['kontak']);
    $bank = mysqli_real_escape_string($db, $_REQUEST['bank']);
    $alamat_pelanggan = mysqli_real_escape_string($db, $_REQUEST['alamat_pelanggan']);
    $cp_telepon = mysqli_real_escape_string($db, $_REQUEST['cp_telepon']);
    $opt_pelanggan = mysqli_real_escape_string($db, $_REQUEST['opt_pelanggan']);
    $st = mysqli_real_escape_string($db, $_REQUEST['st']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['opt']);

    if($_POST['id'] == ""){
        if(cek_hak_akses_aksi_submenu($userid,6,"user_tambah") > 0 ){
            $checkuser = "SELECT * FROM pelanggan WHERE UCASE(pelanggan_nama) = UCASE('$nama_pelanggan') LIMIT 0,1";
            $resultcheck = mysqli_query($db,$checkuser);
            $count = mysqli_num_rows($resultcheck);
            
            if($count == 0) {
                $sql = "INSERT INTO pelanggan values ('','$nama_pelanggan', '$bank', '$no_rek', '$alamat_pelanggan', '$kontak', '$cp_nama', '$cp_telepon','$st','$opt_pelanggan','$today')";

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
        if(cek_hak_akses_aksi_submenu($userid,6,"user_tambah") > 0 ){
            $id = mysqli_real_escape_string($db, $_REQUEST['id']);
            $checkuser = "SELECT * FROM pelanggan WHERE pelanggan_id = '$id' LIMIT 0,1";
            $resultcheck = mysqli_query($db,$checkuser);
            $count = mysqli_num_rows($resultcheck);
            
            if($count > 0) {
                $sql = "UPDATE pelanggan SET pelanggan_nama='$nama_pelanggan', pelanggan_bank='$bank', pelanggan_rekening='$no_rek', pelanggan_alamat='$alamat_pelanggan', pelanggan_kontak='$kontak', pelanggan_cpnama='$cp_nama', pelanggan_cptelpon='$cp_telepon',pelanggan_status='$st',pelanggan_opid='$opt_pelanggan',pelanggan_tdiubah='$today' where pelanggan_id='$id'";

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