<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $editboxid = mysqli_real_escape_string($db, $_REQUEST['editboxid']);
    $editbox1 = mysqli_real_escape_string($db, $_REQUEST['editbox1']);
    $editbox2 = mysqli_real_escape_string($db, $_REQUEST['editbox2']);
    $editbox3 = mysqli_real_escape_string($db, $_REQUEST['editbox3']);
    $editbox4 = mysqli_real_escape_string($db, $_REQUEST['editbox4']);
    $editbox5 = mysqli_real_escape_string($db, $_REQUEST['editbox5']);
    $editbox6 = mysqli_real_escape_string($db, $_REQUEST['editbox6']);
    $editbox7 = mysqli_real_escape_string($db, $_REQUEST['editbox7']);
    $editbox8 = mysqli_real_escape_string($db, $_REQUEST['editbox8']);
    $editbox9 = mysqli_real_escape_string($db, $_REQUEST['editbox9']);
    $editbox10 = mysqli_real_escape_string($db, $_REQUEST['editbox10']);
    $editboxstat = mysqli_real_escape_string($db, $_REQUEST['editboxstat']);

    $editboxstrip1 = str_replace(",", "", $editbox4);
    $editboxstrip2 = str_replace(",", "", $editbox5);
    $editboxstrip3 = str_replace(",", "", $editbox6);
    $editboxstrip4 = str_replace(",", "", $editbox7);
    $editboxstrip5 = str_replace(",", "", $editbox8);
    $editboxstrip6 = str_replace(",", "", $editbox9);

    if ($usersettingplt === 'M'){
        $editboxstrip2n = $editboxstrip2 * 100;
        $editboxstrip3n = $editboxstrip3 * 100;
        $editboxstrip4n = $editboxstrip4 * 100;
    }else{
        $editboxstrip2n = $editboxstrip2;
        $editboxstrip3n = $editboxstrip3;
        $editboxstrip4n = $editboxstrip4;
    };

    if ($usersettingb === 'KG'){
        $editboxstrip5n = $editboxstrip5 * 1000;
    }else{
        $editboxstrip5n = $editboxstrip5;
    };
    
    $check = "SELECT * FROM barang WHERE barang_barcode = '$editbox1' and barang_id <> '$editboxid' LIMIT 1";
    $resultcheck = mysqli_query($db,$check);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $_SESSION['errorexist'] = 1;   
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        $sql = "UPDATE barang SET barang_barcode='$editbox1', barang_nama='$editbox2', barang_tipe='$editbox3', barang_stock='$editboxstrip1', barang_panjang='$editboxstrip2n', barang_lebar='$editboxstrip3n', barang_tinggi='$editboxstrip4n', barang_berat='$editboxstrip5n', barang_harga='$editboxstrip6', barang_lokasi='$editbox10', barang_status='$editboxstat', barang_opid='$userid', barang_tdiubah='$today' WHERE barang_id='$editboxid' LIMIT 1 ";

        if (mysqli_query($db, $sql)) {
            $_SESSION['updateexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    };
?>