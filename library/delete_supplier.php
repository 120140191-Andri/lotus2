<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $today = date("Y-m-d H:i:s");
    $id = mysqli_real_escape_string($db, $_REQUEST['id']);
    $userid = mysqli_real_escape_string($db, $_REQUEST['opt']);
    if(cek_hak_akses_aksi_submenu($userid,5,"user_tambah") > 0 ){  
        $sql_cek = "SELECT * FROM supplier WHERE supplier_id='$id'";
        $x = mysqli_num_rows(mysqli_query($db, $sql_cek));

        if($x > 0){
            $sql = "DELETE FROM supplier WHERE supplier_id='$id'";
           
            if (mysqli_query($db, $sql)) {
                $result = true;
                $_SESSION["err"]=7;
            } else {
                $result = "3";
                $_SESSION["err"]=8;
            }
        }else{
            $result = "4";
            $_SESSION["err"]=9;
        }
    }else{
        $result = "4";
        $_SESSION["err"]=10;
    }
?>