<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    $subkategori_nama = mysqli_real_escape_string($db, $_REQUEST['nama_subkategori']);
    $kategori_id = mysqli_real_escape_string($db, $_REQUEST['kategori_idx']);
    $subkategori_kode = mysqli_real_escape_string($db, $_REQUEST['kode_subkategori']);
    $subkategori_status = mysqli_real_escape_string($db, $_REQUEST['st']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['opt']);

    if($_POST['id'] == ""){
    	if(cek_hak_akses_aksi_submenu($userid,8,"user_tambah") > 0 ){
	        $checkuser = "SELECT * FROM subkategori WHERE UCASE(subkategori_nama) = UCASE('$subkategori_nama') and subkategori_kode=$subkategori_kode and kategori_id=$kategori_id LIMIT 0,1";
	        $resultcheck = mysqli_query($db,$checkuser);
	        $count = mysqli_num_rows($resultcheck);
	        
	        if($count == 0) {
	            $sql = "INSERT INTO subkategori (subkategori_nama,subkategori_kode,kategori_id,subkategori_status,subkategori_opid,subkategori_tdiubah) values ('$subkategori_nama','$subkategori_kode','$kategori_id','$subkategori_status','$userid','$today')";

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
    	if(cek_hak_akses_aksi_submenu($userid,8,"user_ubah") > 0 ){
	        $id = mysqli_real_escape_string($db, $_REQUEST['id']);
	        $checkuser = "SELECT * FROM subkategori WHERE subkategori_id = '$id' LIMIT 0,1";
	        $resultcheck = mysqli_query($db,$checkuser);
	        $count = mysqli_num_rows($resultcheck);
	        
	        if($count > 0) {
	            $sql = "UPDATE subkategori SET subkategori_nama='$subkategori_nama', subkategori_kode='$subkategori_kode', kategori_id='$kategori_id', subkategori_status='$subkategori_status', subkategori_opid='$userid',subkategori_tdiubah='$today' where subkategori_id='$id'";

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