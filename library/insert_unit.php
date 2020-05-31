<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    $unit_nama = mysqli_real_escape_string($db, $_REQUEST['nama_unit']);
    $unit_tipe = mysqli_real_escape_string($db, $_REQUEST['tipe_unit']);
    $unit_alamat = mysqli_real_escape_string($db, $_REQUEST['alamat_unit']);
    $unit_status = mysqli_real_escape_string($db, $_REQUEST['st']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['opt']);

    if($_POST['id'] == ""){
    	if(cek_hak_akses_aksi_submenu($userid,10,"user_tambah") > 0 ){
	        $checkuser = "SELECT * FROM unit WHERE UCASE(unit_nama) = UCASE('$unit_unit') LIMIT 0,1";
	        $resultcheck = mysqli_query($db,$checkuser);
	        $count = mysqli_num_rows($resultcheck);
	        
	        if($count == 0) {
	            $sql = "INSERT INTO unit (unit_nama,unit_tipe,unit_alamat,unit_status,unit_opid,unit_tdiubah) values ('$unit_nama','$unit_tipe','$unit_alamat','$unit_status','$userid','$today')";

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
    	if(cek_hak_akses_aksi_submenu($userid,10,"user_ubah") > 0 ){
	        $id = mysqli_real_escape_string($db, $_REQUEST['id']);
	        $checkuser = "SELECT * FROM unit WHERE unit_id = '$id' LIMIT 0,1";
	        $resultcheck = mysqli_query($db,$checkuser);
	        $count = mysqli_num_rows($resultcheck);
	        
	        if($count > 0) {
	            $sql = "UPDATE unit SET unit_nama='$unit_nama', unit_tipe='$unit_tipe', unit_alamat='$unit_alamat', unit_status='$unit_status', unit_opid='$userid',unit_tdiubah='$today' where unit_id='$id'";

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