<table id="tabel-data1">
    <div style="position:absolute; float:right; z-index:50; padding-top:15px;"><h3 class="headnavigation">Spesifikasi Bahan Baku Produksi Biasa</h3></div>
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
            $barcodeget = mysqli_real_escape_string($db, $_REQUEST['barcode']);
            $usersettingplt = mysqli_real_escape_string($db, $_REQUEST['plt']);
            $usersettingb = mysqli_real_escape_string($db, $_REQUEST['b']);

            $komposisi = mysqli_query($db,"select * from komposisi,material where komposisi.material_barcode = material.material_barcode and komposisi.barang_barcode = $barcodeget");
            while($row = mysqli_fetch_array($komposisi))
            {

                if ($usersettingplt === 'M'){
                    $komposisipanjang_converted = $row['komposisi_panjang'] / 100;
                    $komposisilebar_converted = $row['komposisi_lebar'] / 100;
                    $komposisitinggi_converted = $row['komposisi_tinggi'] / 100;
                }else{
                    $komposisipanjang_converted = $row['komposisi_panjang'];
                    $komposisilebar_converted = $row['komposisi_lebar'];
                    $komposisitinggi_converted = $row['komposisi_tinggi'];
                };

                if ($usersettingb === 'KG'){
                    $komposisiberat_converted = $row['komposisi_berat'] / 1000;
                }else{
                    $komposisiberat_converted = $row['komposisi_berat'];
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
            <td><?php echo $row['komposisi_qty'];?></td>
        </tr>

        <?php
        }
        ?>
    </tbody>
</table>

<div class="konfirmasi" style="width:100%; float:right; text-align:right; margin-top:10px;">
    <input class="startprod" type="submit" name="" value="Mulai Produksi" onclick="myFunction()">
    <div class="cancelprod">BATAL</div>
</div>  

<script>
    $('#tabel-data1').DataTable({
        stateSave: true,
        "pageLength": 5
    });
    
    $('.cancelprod').click(function(){
        document.getElementById("kodeproduksi").value = "";
        document.getElementById("qtyproduksi").value = "";
        $('.pilihbarang').val(null).trigger('change');
        document.getElementById("catprod").value = "";
    });
</script>