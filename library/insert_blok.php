<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $blokentrybox1 = mysqli_real_escape_string($db, $_REQUEST['blokentrybox1']);
    $blokentrybox2 = mysqli_real_escape_string($db, $_REQUEST['blokentrybox2']);
    $blokentryboxjenis = mysqli_real_escape_string($db, $_REQUEST['blokentryboxjenis']);

    $check = "SELECT * FROM unit WHERE unit_nama = '$blokentrybox1' LIMIT 1";
    $resultcheck = mysqli_query($db,$check);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $_SESSION['errorexist'] = 1;   
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        $sql = "INSERT INTO blok (blok_nama, unit_id, blok_tipe, blok_status, blok_opid, blok_tdiubah) VALUES ('$blokentrybox1', '$blokentrybox2', '$blokentryboxjenis', '1', '$userid', '$today')";

        if(mysqli_query($db, $sql)){
            $_SESSION['successexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    };
?>