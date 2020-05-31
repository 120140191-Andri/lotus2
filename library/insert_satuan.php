<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    $satuan_nama = mysqli_real_escape_string($db, $_REQUEST['nama_satuan']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['opt']);

    if($_POST['id'] == ""){
    	if(cek_hak_akses_aksi_submenu($userid,6,"user_tambah") > 0 ){
	        $checkuser = "SELECT * FROM satuan WHERE UCASE(satuan_nama) = UCASE('$satuan_nama') LIMIT 0,1";
	        $resultcheck = mysqli_query($db,$checkuser);
	        $count = mysqli_num_rows($resultcheck);
	        
	        if($count == 0) {
	            $sql = "INSERT INTO satuan (satuan_nama,satuan_opid,satuan_tdiubah) values ('$satuan_nama','$userid','$today')";

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
    	if(cek_hak_akses_aksi_submenu($userid,6,"user_ubah") > 0 ){
	        $id = mysqli_real_escape_string($db, $_REQUEST['id']);
	        $checkuser = "SELECT * FROM satuan WHERE satuan_id = '$id' LIMIT 0,1";
	        $resultcheck = mysqli_query($db,$checkuser);
	        $count = mysqli_num_rows($resultcheck);
	        
	        if($count > 0) {
	            $sql = "UPDATE satuan SET satuan_nama='$satuan_nama',satuan_opid='$userid',satuan_tdiubah='$today' where satuan_id='$id'";

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