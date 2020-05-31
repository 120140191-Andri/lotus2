<?php
    include('../library/confirm.php');


    $retur = mysqli_real_escape_string($db, $_REQUEST['total_retur']);
    $nominal = mysqli_real_escape_string($db, str_replace(",","",$_REQUEST['nominal_bayar']));
    $nobeli = mysqli_real_escape_string($db, $_REQUEST['nobeli']);
    $jenis = mysqli_real_escape_string($db, $_REQUEST['jenis']);
    $sisabayar = mysqli_real_escape_string($db, str_replace(",","",$_REQUEST['sisa']));
    $op = mysqli_real_escape_string($db, $_REQUEST['operator']);
    $rnamarim = mysqli_real_escape_string($db, $_REQUEST['rnamapengirim']);
    $rbankrim = mysqli_real_escape_string($db, $_REQUEST['rbankpengirim']);
    $rnorim = mysqli_real_escape_string($db, $_REQUEST['rnopengirim']);
    $rnamaima = mysqli_real_escape_string($db, $_REQUEST['rnamapenerima']);
    $rbankima = mysqli_real_escape_string($db, $_REQUEST['rbankpenerima']);
    $rnoima = mysqli_real_escape_string($db, $_REQUEST['rnopenerima']);
    $checkuser = "SELECT * FROM karyawan WHERE (karyawan_user = '$entrybox2' and karyawan_user <> '') LIMIT 1";
    $resultcheck = mysqli_query($db,$checkuser);
    $count = mysqli_num_rows($resultcheck);
    $sisa = $sisabayar - $nominal;
    if($sisa == 0 || $sisa < 0){
        $st = "1";
    }
    else
    {
        $st = "0";
    }
        $sql = "INSERT INTO bayar_nota_beli (tgl_bayar,no_nota_beli,jenis,jumlah,sisa,karyawan_nama,pengirim_nama,pengirim_bank,pengirim_no,penerima_nama,penerima_bank,penerima_no,status) VALUES (now(),'$nobeli', '$jenis','$nominal','$sisa','$op','$rnamarim','$rbankrim','$rnorim','$rnamaima','$rbankima', '$rnoima','$st')";

        if(mysqli_multi_query($db, $sql))
        {
            $_SESSION['successexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
?>