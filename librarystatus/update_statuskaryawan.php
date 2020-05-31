<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $editboxid = mysqli_real_escape_string($db, $_REQUEST['editboxid']);
    $editbox2 = mysqli_real_escape_string($db, $_REQUEST['editbox2']);
    $changestatus = mysqli_real_escape_string($db, $_REQUEST['changestatus']);

    $checkuser = "SELECT * FROM karyawan WHERE (karyawan_user = '$editbox2' and karyawan_id <> '$editboxid' and karyawan_user <> '') LIMIT 1";
    $resultcheck = mysqli_query($db,$checkuser);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $_SESSION['errorexist'] = 1;   
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        if($changestatus == 1){
            $sql = "UPDATE karyawan SET karyawan_status='2', karyawan_opid='$userid', karyawan_tdiubah='$today' WHERE karyawan_id='$editboxid' LIMIT 1 ";
        
            if(mysqli_multi_query($db, $sql)){
                $_SESSION['updateexist'] = 1; 
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
            }
        }else{
            $sql = "UPDATE karyawan SET karyawan_status='1', karyawan_opid='$userid', karyawan_tdiubah='$today' WHERE karyawan_id='$editboxid' LIMIT 1 ";
        
            if(mysqli_multi_query($db, $sql)){
                $_SESSION['updateexist'] = 1; 
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
            }
        }
        
    };
?>