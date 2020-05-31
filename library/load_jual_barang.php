<?php 
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $nota = mysqli_real_escape_string($db, $_REQUEST['nonota']);
    $datax = [];
    $datay= array();
    $bayar_nota_jual = mysqli_query($db,"SELECT * FROM penjualan INNER JOIN barang ON penjualan.barang_id = barang.barang_id WHERE transaksi_id='$nota'");
    if(mysqli_num_rows($bayar_nota_jual) > 0)
    {
        while($row = mysqli_fetch_assoc($bayar_nota_jual))   
        {
            //mysqli_query($db,"SELECT * FROM bayar_nota_jual INNER JOIN karyawan ON bayar_nota_jual.karyawan_id=karyawan.karyawan_id group by karyawan.karyawan_id" );
            $datay=array(
                "penjualan_id"     => $row['penjualan_id'],
                "barang_id"        => $row['barang_id'],
                "barang_nama"      => $row['barang_nama'],
                "penjualan_jumlah" => $row['penjualan_jumlah'],
                "barang_harga"     => $row['barang_harga']
            );
            $datax[] = $datay;
        }
    
    }

    echo json_encode($datax);
    
?> 