<?php
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $idb = $_POST['idb'];

    $sql = "DELETE FROM bayar_nota_jual WHERE id_bayar='$idb'";

    if(mysqli_multi_query($db, $sql)){
        echo "Data Bayar Berhasil Dihapus";
    }else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }

?>