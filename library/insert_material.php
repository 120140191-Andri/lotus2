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
    $entrybox11 = mysqli_real_escape_string($db, $_REQUEST['entrybox11']);
    $entrybox12 = mysqli_real_escape_string($db, $_REQUEST['entrybox12']);

    $entryboxstrip1 = str_replace(",", "", $entrybox4);
    $entryboxstrip2 = str_replace(",", "", $entrybox5);
    $entryboxstrip3 = str_replace(",", "", $entrybox6);
    $entryboxstrip4 = str_replace(",", "", $entrybox7);
    $entryboxstrip5 = str_replace(",", "", $entrybox8);
    $entryboxstrip6 = str_replace(",", "", $entrybox11);
    $entryboxstrip7 = str_replace(",", "", $entrybox12);

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

    $check = "SELECT * FROM material WHERE material_barcode = '$entrybox1' LIMIT 1";
    $resultcheck = mysqli_query($db,$check);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $sql = "UPDATE material SET material_stok=material_stok+1, material_opid='$userid', material_tdiubah='$today' WHERE material_barcode = '$entrybox1' limit 1";
   
        if (mysqli_query($db, $sql)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    }else{
        $sql = "INSERT INTO material (material_barcode, material_nama, material_tipe, material_stok, material_panjang, material_lebar, material_tinggi, material_berat, material_hargabtt, material_hargabtr, supplier_id, material_lokasi, material_status, material_opid, material_tdiubah) VALUES ('$entrybox1', '$entrybox2', '$entrybox3', '$entryboxstrip1', '$entryboxstrip2n', '$entryboxstrip3n', '$entryboxstrip4n', '$entryboxstrip5n', '$entryboxstrip6' , '$entryboxstrip7' , '$entrybox9', '$entrybox10', '1', '$userid', '$today')";

        if(mysqli_query($db, $sql)){
            $_SESSION['successexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
        
    };
?>