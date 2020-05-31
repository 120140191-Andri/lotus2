<table id="tabel-data2">
    <div style="position:absolute; float:right; z-index:50; padding-top:15px;"><h3 class="headnavigation">Spesifikasi Bahan Baku Produksi Custom</h3></div>
    <thead>
        <tr>
            <th>Barcode Bahan Baku</th>
            <th>Nama Material</th>
            <th>Ukuran Bahan Baku</th>
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>
            <?php
                include('../library/config.php');
                $barcodeget = mysqli_real_escape_string($db, $_REQUEST['barcodecustom']);
                $usersettingplt = mysqli_real_escape_string($db, $_REQUEST['plt']);
                $usersettingb = mysqli_real_escape_string($db, $_REQUEST['b']);

                $komposisi = mysqli_query($db,"select * from pesanancustom,material where pesanancustom.material_barcode = material.material_barcode and pesanancustom.barang_barcode = $barcodeget");
                while($row = mysqli_fetch_array($komposisi))
                {

                    if ($usersettingplt === 'M'){
                        $komposisipanjang_converted = $row['pesanan_panjang'] / 100;
                        $komposisilebar_converted = $row['pesanan_lebar'] / 100;
                        $komposisitinggi_converted = $row['pesanan_tinggi'] / 100;
                    }else{
                        $komposisipanjang_converted = $row['pesanan_panjang'];
                        $komposisilebar_converted = $row['pesanan_lebar'];
                        $komposisitinggi_converted = $row['pesanan_tinggi'];
                    };

                    if ($usersettingb === 'KG'){
                        $komposisiberat_converted = $row['pesanan_berat'] / 1000;
                    }else{
                        $komposisiberat_converted = $row['pesanan_berat'];
                    };
                    
                    if($komposisipanjang_converted == '' && $komposisipanjang_converted == '0'){
                        $komposisipanjang_converted = '-';
                    }
                    if($komposisilebar_converted == '' && $komposisilebar_converted == '0'){
                        $komposisilebar_converted = '-';
                    }
                    if($komposisitinggi_converted == '' && $komposisitinggi_converted == '0'){
                        $komposisitinggi_converted = '-';
                    }
                    if($komposisiberat_converted == '' && $komposisiberat_converted == '0'){
                        $komposisiberat_converted = '-';
                    }
            ?>

            <tr>
                <td><?php echo $row['material_barcode'];?></td>
                <td><?php echo $row['material_nama'];?></td>
                <td>Panjang = <?php echo $komposisipanjang_converted;?> <?php echo $usersettingplt;?> <redfont>x</redfont> Lebar = <?php echo $komposisilebar_converted;?> <?php echo $usersettingplt;?> <redfont>x</redfont> Tinggi = <?php echo $komposisitinggi_converted;?> <?php echo $usersettingplt;?> <redfont>--</redfont> Berat = <?php echo $komposisiberat_converted;?> <?php echo $usersettingb;?></td>
                <td><?php echo $row['pesanan_qty'];?></td>
            </tr>

            <?php
            }
            ?>
        </tbody>
</table>

<div class="konfirmasi" style="width:100%; float:right; text-align:right; margin-top:10px;">
    <input class="startprod" type="submit" name="" value="Mulai Produksi">
    <div class="cancelprod">BATAL</div>
</div>  
                        
<script>
    $('#tabel-data2').DataTable({
        stateSave: true,
        "pageLength": 5,
    });
    
    $('.cancelprod').click(function(){
        document.getElementById("kodeproduksi").value = "";
        document.getElementById("qtyproduksi").value = "";
        document.getElementById("catprod").value = "";
        $('.pilihnotapesanan').val(null).trigger('change');
        $('.pilihpesanancustom').val(null).trigger('change');
    });
</script>