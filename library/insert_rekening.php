<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $entrybox1 = mysqli_real_escape_string($db, $_REQUEST['entrybox1']);
    $entrybox2 = mysqli_real_escape_string($db, $_REQUEST['entrybox2']);
    $entrybox3 = mysqli_real_escape_string($db, $_REQUEST['entrybox3']);
    $entryboxjenis = mysqli_real_escape_string($db, $_REQUEST['entryboxjenis']);

    $check = "SELECT * FROM rekening WHERE rekening_nomor = '$entrybox3' LIMIT 1";
    $resultcheck = mysqli_query($db,$check);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $_SESSION['errorexist'] = 1;   
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        $sql = "INSERT INTO rekening (rekening_npemilik, rekening_bank, rekening_nomor, rekening_jenis, rekening_status, rekening_opid, rekening_tdiubah) VALUES ('$entrybox1', '$entrybox2', '$entrybox3', '$entryboxjenis', '1', '$userid', '$today')";

        if(mysqli_query($db, $sql)){
            $_SESSION['successexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    };
?>