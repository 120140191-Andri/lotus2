<?php 
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $idjual = $_POST['id_jual'];
    $jumlah = $_POST['qty'];
    
    $ubah = "UPDATE penjualan SET penjualan_jumlah='$jumlah' WHERE penjualan_id='$idjual'";
    if(mysqli_multi_query($db, $ubah)){
                
    }else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }
    
?> 