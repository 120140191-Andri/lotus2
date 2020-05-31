<?php
    include('../library/confirm.php');

    $hasil = $_POST['hasil'];
    $nonota = $_POST['nonota'];

    if($hasil == "terima"){
        $hsl = 2;
    }else{
        $hsl = 3;
    }

    $ubah = "UPDATE transaksi SET transaksi_proses='$hsl' WHERE transaksi_nota='$nonota'";
    if(mysqli_multi_query($db, $ubah)){
        echo $hasil;        
    }else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }

?>