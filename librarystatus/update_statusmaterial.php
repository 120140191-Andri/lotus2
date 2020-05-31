<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $editboxid = mysqli_real_escape_string($db, $_REQUEST['editboxid']);
    $editbox2 = mysqli_real_escape_string($db, $_REQUEST['editbox2']);
    $changestatus = mysqli_real_escape_string($db, $_REQUEST['changestatus']);
    
    $check = "SELECT * FROM material WHERE material_barcode = '$editbox2' and material_id <> '$editboxid' LIMIT 1";
    $resultcheck = mysqli_query($db,$check);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $_SESSION['errorexist'] = 1;   
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        if($changestatus == 1){
            $sql = "UPDATE material SET material_status='2', material_opid='$userid', material_tdiubah='$today' WHERE material_id='$editboxid' LIMIT 1 ";

            if (mysqli_query($db, $sql)) {
                $_SESSION['updateexist'] = 1; 
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Error updating record: " . mysqli_error($db);
            }
        }else{
            $sql = "UPDATE material SET material_status='1', material_opid='$userid', material_tdiubah='$today' WHERE material_id='$editboxid' LIMIT 1 ";

            if (mysqli_query($db, $sql)) {
                $_SESSION['updateexist'] = 1; 
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Error updating record: " . mysqli_error($db);
            }
        }
    };
?>