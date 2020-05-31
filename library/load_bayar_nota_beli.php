<?php 
    include('../library/confirm.php');
    include('../library/config_hakakses.php');

    $nota = mysqli_real_escape_string($db, $_REQUEST['nonota']);
    $datax = [];
    $datay= array();
    $bayar_nota_beli = mysqli_query($db,"SELECT * FROM bayar_nota_beli WHERE no_nota_beli='$nota' ORDER BY id_bayar DESC, tgl_bayar DESC");
    if(mysqli_num_rows($bayar_nota_beli) > 0)
    {
    while($row = mysqli_fetch_assoc($bayar_nota_beli))   
    {
        //mysqli_query($db,"SELECT * FROM bayar_nota_beli INNER JOIN karyawan ON bayar_nota_beli.karyawan_id=karyawan.karyawan_id group by karyawan.karyawan_id" );
        $datay=array(
            "tgl" => date('d/m/Y',strtotime($row['tgl_bayar'])),
            "jenis" => $row['jenis'],
            "nominal" => $row['jumlah'],
            "sisa" => $row['sisa'],
            "st" => $row['status'],
            "opt" => $row['karyawan_nama'],
            //"opt" => karyawan_nama($row['karyawan_id']),
            "id" => $row['id_bayar'],
        );
    $datax[]=$datay;
    }
    }else{
        $datax = null;
    }

    echo json_encode($datax);
?> 