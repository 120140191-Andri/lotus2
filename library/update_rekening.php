<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $editboxid = mysqli_real_escape_string($db, $_REQUEST['editboxid']);
    $editbox1 = mysqli_real_escape_string($db, $_REQUEST['editbox1']);
    $editbox2 = mysqli_real_escape_string($db, $_REQUEST['editbox2']);
    $editbox3 = mysqli_real_escape_string($db, $_REQUEST['editbox3']);
    $editboxjenis = mysqli_real_escape_string($db, $_REQUEST['editboxjenis']);
    $editboxstat = mysqli_real_escape_string($db, $_REQUEST['editboxstat']);

    $check = "SELECT * FROM rekening WHERE rekening_nomor = '$editbox3' and rekening_id <> '$editboxid' LIMIT 1";
    $resultcheck = mysqli_query($db,$check);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $_SESSION['errorexist'] = 1;   
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        $sql = "UPDATE rekening SET rekening_npemilik='$editbox1', rekening_bank='$editbox2', rekening_nomor='$editbox3', rekening_jenis='$editboxjenis', rekening_status='$editboxstat', rekening_opid='$userid', rekening_tdiubah='$today' WHERE rekening_id='$editboxid' LIMIT 1 ";

        if (mysqli_query($db, $sql)) {
            $_SESSION['updateexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    };
?>