<?php
    include('../library/confirm.php');

    $hasil = $_POST['hasil'];
    $nonota = $_POST['nonota'];

    if($hasil == "terima"){
        $hsl = 1;
    }else{
        $hsl = 2;
    }

    $cek = mysqli_query($db, "SELECT transaksi_proses FROM transaksi WHERE transaksi_nota='$nonota'");
    $rd  = mysqli_fetch_array($cek);

    $status = $rd['transaksi_proses'];

    if($status == 0) {
        $tgl = date('Y-m-d H:i:s');

        $ubah = "UPDATE transaksi SET transaksi_proses='$hsl', transaksi_tdiubah='$tgl' WHERE transaksi_nota='$nonota'";
        if(mysqli_multi_query($db, $ubah)){
            echo $hasil;        
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    }else{
        echo "Pembayaran Sudah Dikonfirmasi";
    }

?>