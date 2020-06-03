<?php 
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $nota = mysqli_real_escape_string($db, $_REQUEST['nonota']);
    $datax = [];
    $datay= array();
    $bayar_nota_jual = mysqli_query($db,"SELECT * FROM bayar_nota_jual WHERE transaksi_id='$nota' ORDER BY id_bayar DESC, tgl_bayar DESC");
    if(mysqli_num_rows($bayar_nota_jual) > 0)
    {
        while($row = mysqli_fetch_assoc($bayar_nota_jual))   
        {
            //mysqli_query($db,"SELECT * FROM bayar_nota_jual INNER JOIN karyawan ON bayar_nota_jual.karyawan_id=karyawan.karyawan_id group by karyawan.karyawan_id" );
            $datay=array(
                "idb"     => $row['id_bayar'],
                "tgl"     => date('d/m/Y',strtotime($row['tgl_bayar'])),
                "nominal" => $row['jumlah'],
                "st"      => 'Angsur',
                "sisa"    => $row['sisa']
            );
            $datax[] = $datay;
        }
    
    }

    echo json_encode($datax);
    
?> 
