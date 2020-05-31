<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $kode = mysqli_real_escape_string($db, $_REQUEST['produksi1']);
    $qtyprod = mysqli_real_escape_string($db, $_REQUEST['produksi3']);
    $notapil = mysqli_real_escape_string($db, $_REQUEST['produksi4']);
    $catprod = mysqli_real_escape_string($db, $_REQUEST['produksi6']);
    $qtyproduksi = 1 * $qtyprod;

    if($notapil !=0){
        $jenis = '2';
        $barpil = mysqli_real_escape_string($db, $_REQUEST['produksi5']);
        
        $checkstok = mysqli_query($db,"select * from pesanancustom,material where pesanancustom.material_barcode = material.material_barcode and pesanancustom.barang_barcode = $barpil and material.material_stok < pesanancustom.pesanan_qty*$qtyproduksi");
        if($checkstok->num_rows == 0) {
            $komposisi = mysqli_query($db,"select * from pesanancustom,material where pesanancustom.material_barcode = material.material_barcode and pesanancustom.barang_barcode = $barpil");
            while($row = mysqli_fetch_array($komposisi))
            {
                $pesananqty = $row['pesanan_qty'];
                $materialbarcode = $row['material_barcode'];
                
                $komposisiqty = $pesananqty*$qtyproduksi;
                
                $updatestok = "UPDATE material SET material_stok=material_stok - $komposisiqty, material_opid='$userid', material_tdiubah='$today' WHERE material_barcode='$materialbarcode'";        

                if(mysqli_query($db, $updatestok)){
                    $_SESSION['successexist'] = 1;
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }else{
                    $_SESSION['errorexist'] = 1;   
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
            
            $sql = "INSERT INTO produksi (produksi_jenis, produksi_kode, produksi_barangid, produksi_qty, produksi_notapesanan, produksi_catatan) VALUES ('$jenis', '$kode', '$barpil', '$qtyprod', '$notapil', '$catprod')";
            if(mysqli_query($db, $sql)){
                $_SESSION['successexist'] = 1;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                $_SESSION['errorexist'] = 1;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }else{
            $_SESSION['errorexist'] = 1;   
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        $jenis = '1';
        $barpil = mysqli_real_escape_string($db, $_REQUEST['produksi2']);
        
        $checkstok = mysqli_query($db,"select * from komposisi,material where komposisi.material_barcode = material.material_barcode and komposisi.barang_barcode = $barpil and material.material_stok < komposisi.komposisi_qty*$qtyproduksi");
        
        
        if($checkstok->num_rows == 0) {
            $komposisi = mysqli_query($db,"select * from komposisi,material where komposisi.material_barcode = material.material_barcode and komposisi.barang_barcode = $barpil");
            while($row = mysqli_fetch_array($komposisi))
            {
                $komposisiqty = $row['komposisi_qty'];
                $materialbarcode = $row['material_barcode'];
                
                $jumlahkomposisi = $komposisiqty*$qtyproduksi;

                $updatestok = "UPDATE material SET material_stok=material_stok - $jumlahkomposisi, material_opid='$userid', material_tdiubah='$today' WHERE material_barcode='$materialbarcode'";        

                if(mysqli_query($db, $updatestok)){
                    $_SESSION['successexist'] = 1;
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }else{
                    $_SESSION['errorexist'] = 1;   
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
            
            $sql = "INSERT INTO produksi (produksi_jenis, produksi_kode, produksi_barangid, produksi_qty, produksi_notapesanan, produksi_catatan) VALUES ('$jenis', '$kode', '$barpil', '$qtyprod', '$notapil', '$catprod')";
            if(mysqli_query($db, $sql)){
                $_SESSION['successexist'] = 1;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                $_SESSION['errorexist'] = 1;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }else{
            $_SESSION['errorexist'] = 1;   
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        
    }



    
?>