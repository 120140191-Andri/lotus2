<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    $kategori_nama = mysqli_real_escape_string($db, $_REQUEST['nama_kategori']);
    $kategori_kode = mysqli_real_escape_string($db, $_REQUEST['kode_kategori']);
    $kategori_status = mysqli_real_escape_string($db, $_REQUEST['st']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['opt']);

    if($_POST['id'] == ""){
    	if(cek_hak_akses_aksi_submenu($userid,7,"user_tambah") > 0 ){
	        $checkuser = "SELECT * FROM kategori WHERE UCASE(kategori_nama) = UCASE('$kategori_nama') LIMIT 0,1";
	        $resultcheck = mysqli_query($db,$checkuser);
	        $count = mysqli_num_rows($resultcheck);
	        
	        if($count == 0) {
	            $sql = "INSERT INTO kategori (kategori_nama,kategori_kode,kategori_status,kategori_opid,kategori_tdiubah) values ('$kategori_nama','$kategori_kode','$kategori_status','$userid','$today')";

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
    	if(cek_hak_akses_aksi_submenu($userid,7,"user_ubah") > 0 ){
	        $id = mysqli_real_escape_string($db, $_REQUEST['id']);
	        $checkuser = "SELECT * FROM kategori WHERE kategori_id = '$id' LIMIT 0,1";
	        $resultcheck = mysqli_query($db,$checkuser);
	        $count = mysqli_num_rows($resultcheck);
	        
	        if($count > 0) {
	            $sql = "UPDATE kategori SET kategori_nama='$kategori_nama', kategori_kode='$kategori_kode', kategori_status='$kategori_status', kategori_opid='$userid',kategori_tdiubah='$today' where kategori_id='$id'";

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