<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $idb  = $_POST['idb'];
    $sisa = $_POST['sisa'];
    $nom  = $_POST['nominal'];

    $sql = "UPDATE bayar_nota_jual SET jumlah='$nom', sisa='$sisa' WHERE id_bayar='$idb'";

    if(mysqli_multi_query($db, $sql)){
        echo $idb;
    }else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }

?>
