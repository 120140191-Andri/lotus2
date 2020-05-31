<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $entrybox1 = mysqli_real_escape_string($db, $_REQUEST['entrybox1']);
    $entrybox2 = mysqli_real_escape_string($db, $_REQUEST['entrybox2']);
    $entrybox3 = mysqli_real_escape_string($db, $_REQUEST['entrybox3']);
    $entrybox4 = mysqli_real_escape_string($db, $_REQUEST['entrybox4']);
    $entrybox5 = mysqli_real_escape_string($db, $_REQUEST['entrybox5']);
    $entrybox6 = mysqli_real_escape_string($db, $_REQUEST['entrybox6']);
    $entrybox7 = mysqli_real_escape_string($db, $_REQUEST['entrybox7']);
    $entrybox8 = mysqli_real_escape_string($db, $_REQUEST['entrybox8']);
    $entrybox9 = mysqli_real_escape_string($db, $_REQUEST['entrybox9']);
    $entrybox10 = mysqli_real_escape_string($db, $_REQUEST['entrybox10']);

    $entryboxstrip1 = str_replace(",", "", $entrybox4);
    $entryboxstrip2 = str_replace(",", "", $entrybox5);
    $entryboxstrip3 = str_replace(",", "", $entrybox6);
    $entryboxstrip4 = str_replace(",", "", $entrybox7);
    $entryboxstrip5 = str_replace(",", "", $entrybox8);
    $entryboxstrip6 = str_replace(",", "", $entrybox9);

    if ($usersettingplt === 'M'){
        $entryboxstrip2n = $entryboxstrip2 * 100;
        $entryboxstrip3n = $entryboxstrip3 * 100;
        $entryboxstrip4n = $entryboxstrip4 * 100;
    }else{
        $entryboxstrip2n = $entryboxstrip2;
        $entryboxstrip3n = $entryboxstrip3;
        $entryboxstrip4n = $entryboxstrip4;
    };

    if ($usersettingb === 'KG'){
        $entryboxstrip5n = $entryboxstrip5 * 1000;
    }else{
        $entryboxstrip5n = $entryboxstrip5;
    };

    $check = "SELECT * FROM barang WHERE barang_barcode = '$entrybox1' LIMIT 1";
    $resultcheck = mysqli_query($db,$check);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $sql = "UPDATE barang SET barang_stock=barang_stock+1, barang_opid='$userid', barang_tdiubah='$today' WHERE barang_barcode = '$entrybox1' limit 1";
   
        if (mysqli_query($db, $sql)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    }else{
        $sql = "INSERT INTO barang (barang_barcode, barang_nama, barang_tipe, barang_stock, barang_panjang, barang_lebar, barang_tinggi, barang_berat, barang_harga, barang_lokasi, barang_status, barang_opid, barang_tdiubah) VALUES ('$entrybox1', '$entrybox2', '$entrybox3', '$entryboxstrip1', '$entryboxstrip2n', '$entryboxstrip3n', '$entryboxstrip4n', '$entryboxstrip5n', '$entryboxstrip6', '$entrybox10', '1', '$userid', '$today')";

        if(mysqli_query($db, $sql)){
            $_SESSION['successexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    };
?>