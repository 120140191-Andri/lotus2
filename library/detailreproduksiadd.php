
        <?php
            include('../library/config.php');
            $material = mysqli_real_escape_string($db, $_REQUEST['material']);
            $bbarcode = mysqli_real_escape_string($db, $_REQUEST['bbarcode']);
            $usersettingplt = mysqli_real_escape_string($db, $_REQUEST['plt']);
            $usersettingb = mysqli_real_escape_string($db, $_REQUEST['b']);

            $komposisi = mysqli_query($db,"select * from komposisi,material where komposisi.material_barcode = material.material_barcode and komposisi.material_barcode = $material and komposisi.barang_barcode = $bbarcode");
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

            <td style="background-color:#ccc;"><?php echo $row['material_barcode'];?></td>
            <td style="background-color:#ccc;"><?php echo $row['material_nama'];?></td>
            
            <td style="background-color:#ccc;">Panjang = <?php echo $komposisipanjang_converted;?> <?php echo $usersettingplt;?> <redfont>x</redfont> Lebar = <?php echo $komposisilebar_converted;?> <?php echo $usersettingplt;?> <redfont>x</redfont> Tinggi = <?php echo $komposisitinggi_converted;?> <?php echo $usersettingplt;?> <redfont>--</redfont> Berat = <?php echo $komposisiberat_converted;?> <?php echo $usersettingb;?></td>
            <td style="background-color:#ccc;"><?php echo $row['komposisi_qty'];?></td>


        <?php
        }
        ?>