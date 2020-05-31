<?php
   include('library/session.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="asset/favicon.png" />
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/style2.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/solid.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/cleave.min.js"></script>
    <script type="text/javascript" src="script/script.js"></script>
    <script type="text/javascript" src="script/jquery.dataTables.min.js"></script>
    <?php include("loader.php"); ?> <script>$("#load").show();</script>
</head>


<script>
$(document).ready(function(){
    $(".datalookup").click(function(){
        var id = $(this).attr("data-id");
        var supplier = $(this).attr("data-supplier");
        var barcode = $(this).attr("data-barcode");
        var lokasi = $(this).attr("data-lokasi");
        var nama = $(this).attr("data-nama");
        var tipe = $(this).attr("data-tipe");
        var panjang = $(this).attr("data-panjang");
        var lebar = $(this).attr("data-lebar");
        var tinggi = $(this).attr("data-tinggi");
        var berat = $(this).attr("data-berat");
        var hbtt = $(this).attr("data-hbtt");
        var hbtr = $(this).attr("data-hbtr");
        var stock = $(this).attr("data-stock");
        var status = $(this).attr("data-status");
        var opid = $(this).attr("data-opid");
        var tdiubah = $(this).attr("data-tdiubah");
        
        $("#id_view").html(id);
        $("#supplier_view").html(supplier);
        $("#barcode_view").html(barcode);
        $("#lokasi_view").html(lokasi);
            if(lokasi == ""){
                $("#lokasi_view").html("--");
            };
        $("#nama_view").html(nama);
        $("#tipe_view").html(tipe);
            if(tipe == ""){
                $("#tipe_view").html("--");
            };
        $("#panjang_view").html(new Intl.NumberFormat('ja-JP').format(panjang));
            if(panjang == ""){
                $("#panjang_view").html("--");
            };
        $("#lebar_view").html(new Intl.NumberFormat('ja-JP').format(lebar));
            if(lebar == ""){
                $("#lebar_view").html("--");
            };
        $("#tinggi_view").html(new Intl.NumberFormat('ja-JP').format(tinggi));
            if(tinggi == ""){
                $("#tinggi_view").html("--");
            };
        $("#berat_view").html(new Intl.NumberFormat('ja-JP').format(berat));
            if(berat == ""){
                $("#berat_view").html("--");
            };
        $("#hbtt_view").html(new Intl.NumberFormat('ja-JP').format(hbtt));
            if(hbtt == ""){
                $("#hbtt_view").html("--");
            };
        $("#hbtr_view").html(new Intl.NumberFormat('ja-JP').format(hbtr));
            if(hbtr == ""){
                $("#hbtr_view").html("--");
            };
        
        $("#stock_view").html(new Intl.NumberFormat('ja-JP').format(stock));
            if(stock == ""){
                $("#stock_view").html("--");
            };
        $("#st_view").html(status);
            if(status == "1"){
                $("#st_view").html("Aktif");
            }else{
                $("#st_view").html("Tidak Aktif");
            };
        $("#opid_view").html(opid);
        $("#tdiubah_view").html(tdiubah);
        
        
        $("#id_value").val(id);
        $("#supplier_value").val(supplier);
        $("#barcode_value").val(barcode);
        $("#lokasi_value").val(lokasi);
        $("#nama_value").val(nama);
        $("#tipe_value").val(tipe);
        $("#panjang_value").val(new Intl.NumberFormat('ja-JP').format(panjang));
        $("#lebar_value").val(new Intl.NumberFormat('ja-JP').format(lebar));
        $("#tinggi_value").val(new Intl.NumberFormat('ja-JP').format(tinggi));
        $("#berat_value").val(new Intl.NumberFormat('ja-JP').format(berat));
        $("#hbtt_value").val(new Intl.NumberFormat('ja-JP').format(hbtt));
        $("#hbtr_value").val(new Intl.NumberFormat('ja-JP').format(hbtr));
        $("#stock_value").val(new Intl.NumberFormat('ja-JP').format(stock));
        $("#st_value").val(status);
            if(status == "1"){
                $("#st1").attr("checked","checked");
                $("#st2").removeAttr("checked");
            }else{
                $("#st1").removeAttr("checked");
                
                $("#st2").attr("checked","checked");
            };
        $("#opid_value").val(opid);
        $("#tdiubah_value").val(tdiubah);
        
        var plt = '<?php echo $usersettingplt; ?>';
        var b = '<?php echo $usersettingb; ?>';
        $.ajax({
            type : "POST", 
            url  : "<?php echo 'library/detailmaterial.php'; ?>", 
            dataType : "JSON", 
            data : {barcode:barcode,plt:plt,b:b},
            success: function(data){
                var html = "";
                if(data.length > 0){
                    var x =0;
                   for(x = 0;x < data.length;x++){
                       if(data[x].barcode5 == "1"){
                          var st = '<input class="statusaktif" type="submit" name="" value="Aktif">';
                       }else{
                           var st = '<input class="statusnonaktif" type="submit" name="" value="Tidak aktif">';
                       }
                       html += "<tr>"+
                           "<td>"+data[x].barcode+"</td>"+
                           "<td>"+data[x].barcode1+"</td>"+
                           "<td>"+data[x].barcode2+"</td>"+
                           "<td>"+data[x].barcode3+"</td>"+
                           "<td>"+data[x].barcode4+"</td>"+
                           "<td style='width:20px; text-align:center;'><form class='statuschangeform' action='librarystatus/update_statusmaterial.php' method='post'>"+
                                    "<input class='textinput2' type='text' name='editboxid' value='"+data[x].barcode6+"' style='display:none;'>"+
                                    "<input class='textinput2' type='text' name='editbox2' value='"+data[x].barcode+"' style='display:none;'>"+
                                    "<input class='textinput2' type='text' name='changestatus' value='"+data[x].barcode5+"' style='display:none;'>"+st+"</td></form>"+
                           "</tr>";
                   }
                }
                $("#detailmaterial").html(html);
            }
        });
        
        $("#detailbox").show();
    });
});
</script>





<title>Lotus - Stok</title>

<body>
    <div class="spacer"></div>
    
    <?php
        include('library/submenusidebar.php');
    ?>
    
    <div class="menudisplaycontainer">
        
    <?php
        include('library/warningsystem.php');
    ?>
        
        <div class="navcontainer">
            <div class="navleft">
                <h2 class="headnavigation"><?php echo strtoupper("$userjob") ?> <redfont>/</redfont> <?php echo $usernamalengkap ?></h2>
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Stok</h5>
            </div>
        </div>
        
        <hr class="hrred">
            <div class="dashcontainer1">
                <div class="detailcontainer" id="detailentry">
                    <h3 class="headnavigation"><redfont><i class="fas fa-people-carry"></i> Tambah bahan baku</redfont></h3>
                    <br>
                    <form class="boxentry" action="library/insert_material.php" method="post">
                    <div class="entryfield">
                        <h5 class="headnavigation">Kode barcode <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="entrybox1" value="" autocomplete="off" required><br><br><br>
                        <h5 class="headnavigation">Nama bahan baku <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="entrybox2" value="" autocomplete="off" required><br><br><br>
                        <h5 class="headnavigation">Tipe bahan baku</h5>
                        <input class="textinput2" type="text" name="entrybox3" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Stok bahan baku</h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox4" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Asal supplier <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="entrybox9" value="" autocomplete="off" required><br><br><br>
                    </div>
                    <div class="entryfield">
                        <h5 class="headnavigation">Panjang bahan baku <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox5" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Lebar bahan baku <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox6" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Tinggi bahan baku <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox7" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Berat bahan baku <?php if ($usersettingb === 'KG'){echo '(<redfont>Kilogram</redfont>)';}else{echo '(<redfont>Gram</redfont>)';};?></h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox8" value="" autocomplete="off"><br><br><br>
                    </div>
                    <div class="entryfield">
                        <h5 class="headnavigation">Harga beli tertimbang</h5>
                        <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" type="text" name="entrybox11" value="" autocomplete="off" required maxlength="100"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br><br><br>
                        <h5 class="headnavigation">Harga beli terakhir</h5>
                        <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" type="text" name="entrybox12" value="" autocomplete="off" required maxlength="100"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br><br><br>
                        <h5 class="headnavigation">Lokasi bahan baku</h5>
                        <input class="textinput2" type="text" name="entrybox10" value="" autocomplete="off"><br><br><br>
                    </div>
                        
                    <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                        <h5 class="headnavigation"><redfont><i>Ingin menambahkan data?</i></redfont></h5>
                        <input class="formsubmit boxsubmit" type="submit" name="" value="Tambah bahan baku">
                        <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('detailentry');"><h5>BATAL</h5></div>
                    </div>
                    </form>
                </div>

                <div class="dcctable" id="dcctable">
                    <table id="tabel-data">
                        <a href="stok.php"><div class="formsubmit" style="position:absolute; float:right; z-index:50;"><h5><i class="fas fa-eye fas2"></i> Tampilkan Bahan Baku Yang Tersedia</h5></div></a>
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Nama Bahan Baku</th>
                                <th>Jumlah Stok Gudang</th>
                                <th>Harga Beli Tertimbang</th>
                                <th>Harga Beli Terakhir</th>
                                <th style="width:10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $material = mysqli_query($db,"select *, SUM(material_stok) as materialstock, MAX(material_hargabtt) as mthbtt from material group by material_barcode");
                            while($row = mysqli_fetch_array($material))
                            {
                                
                                if ($usersettingplt === 'M'){
                                    $materialpanjang_converted = $row['material_panjang'] / 100;
                                    $materiallebar_converted = $row['material_lebar'] / 100;
                                    $materialtinggi_converted = $row['material_tinggi'] / 100;
                                }else{
                                    $materialpanjang_converted = $row['material_panjang'];
                                    $materiallebar_converted = $row['material_lebar'];
                                    $materialtinggi_converted = $row['material_tinggi'];
                                };

                                if ($usersettingb === 'KG'){
                                    $materialberat_converted = $row['material_berat'] / 1000;
                                }else{
                                    $materialberat_converted = $row['material_berat'];
                                };
                                
                                $materialstok = number_format($row['materialstock']);
                                $materialhbtt = number_format($row['mthbtt']);
                                $materialhbtr = number_format($row['material_hargabtr']);
                        ?>
                            
                            
                        <tr>
                            <td><?php echo $row['material_barcode'];?></td>
                            <td><?php echo $row['material_nama'];?></td>
                            <td><div style="float:left; margin-right:10px;"><?php echo $materialstok;?> pcs</div> <h5 class="headnavigation" style="float:left;"></h5></td>
                            <td>Rp. <?php echo $materialhbtt;?></td>
                            <td>Rp. <?php echo $materialhbtr;?></td>
                            
                            <td>
                                <a class="datalookup"
                                   onclick="datahide('dcctable');"
                                   style="cursor:pointer;"
                                   data-id="<?php echo $row['material_id'];?>"
                                   data-supplier="<?php echo $row['supplier_id'];?>"
                                   data-barcode="<?php echo $row['material_barcode'];?>"
                                   data-lokasi="<?php echo $row['material_lokasi']?>"
                                   data-nama="<?php echo $row['material_nama']?>"
                                   data-tipe="<?php echo $row['material_tipe']?>"
                                   data-panjang="<?php echo $materialpanjang_converted ?>"
                                   data-lebar="<?php echo $materiallebar_converted ?>"
                                   data-tinggi="<?php echo $materialtinggi_converted ?>"
                                   data-berat="<?php echo $materialberat_converted ?>"
                                   data-hbtt="<?php echo $row['material_hargabtt'] ?>"
                                   data-hbtr="<?php echo $row['material_hargabtr'] ?>"
                                   data-stock="<?php echo $row['material_stok']?>"
                                   data-status="<?php echo $row['material_status']?>"
                                   data-opid="<?php echo $row['material_opid']?>"
                                   data-tdiubah="<?php echo $row['material_tdiubah']?>"
                                ><h4><i class="fas fa-list fas2"></i> Lihat data</h4></a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                        
                        <script>
                            $(document).ready(function(){
                                $('#tabel-data').DataTable({
                                    stateSave: true
                                });
                            });
                        </script>
                        
                    </table>
                </div>
                
                <div class="detailcontainer" id="detailbox">
                    <h3 class="headnavigation"><redfont><i class="fas fa-box-open"></i> Detail stok barang</redfont></h3>
                    <br>
                    
                    <table id="tabel-data2">
                        <a href="stok-all.php"><div class="formsubmit" style="position:absolute; float:right; z-index:50;"><h5><i class="fas fa-eye fas2"></i> Tampilkan Semua Bahan Baku</h5></div></a>
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Nama Bahan Baku</th>
                                <th>Jumlah Stok Gudang</th>
                                <th>Harga Beli Tertimbang</th>
                                <th>Harga Beli Terakhir</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="detailmaterial">

                        <tr>
                            <td><?php echo $row['material_barcode'];?></td>
                            <td><?php echo $row['material_nama'];?></td>
                            <td><div style="float:left; margin-right:10px;"><?php echo $materialstok;?> pcs</div> <h5 class="headnavigation" style="float:left;"></h5></td>
                            <td>Rp. <?php echo $materialhbtt;?></td>
                            <td>Rp. <?php echo $materialhbtr;?></td>
                            
                            <td style="width:20px; text-align:center;">
                                <form class="statuschangeform" action="librarystatus/update_statusmaterial.php" method="post">
                                    <input class="textinput2" type="text" name="editboxid" value="<?php echo $row['material_id'];?>" style="display:none;">
                                    <input class="textinput2" type="text" name="editbox2" value="<?php echo $row['material_barcode']?>" style="display:none;">
                                    <input class="textinput2" type="text" name="changestatus" value="<?php echo $row['material_status']?>" style="display:none;">
                                    
                                    <?php if ($row['material_status'] === '1'){echo '<input class="statusaktif" type="submit" name="" value="Aktif">';}else{echo '<input class="statusnonaktif" type="submit" name="" value="Tidak aktif">';}; ?>
                                </form>
                            </td>
                            
                            
                        </tr>
                        </tbody>
                        
                        <script>
                            $(document).ready(function(){
                                $('#tabel-data2').DataTable({
                                    stateSave: true
                                });
                            });
                        </script>
                        
                    </table>
                    
                    
                    
                    
                            
                    <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                        <div class="formsubmitcancel" onclick="datahide('detailbox'); datalookup('dcctable');"><h5>TUTUP</h5></div>
                    </div>
                </div>
                        
                <div class="detailcontainer" id="detailedit">
                    <h3 class="headnavigation"><redfont><i class="fas fa-toolbox"></i> Ubah data bahan baku</redfont></h3>
                    <br>
                    <form class="boxedit" action="library/update_material.php" method="post">
                        <div class="entryfield">
                            <input class="textinput2" type="text" name="editboxid" id="id_value" value="" style="display:none;">
                            <h5 class="headnavigation">Bahan baku barcode <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="editbox1" id="barcode_value" value="" autocomplete="off" required><br><br><br>
                            <h5 class="headnavigation">Nama bahan baku <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="editbox2" id="nama_value" value="" autocomplete="off" required><br><br><br>
                            <h5 class="headnavigation">Tipe bahan baku</h5>
                            <input class="textinput2" type="text" name="editbox3" id="tipe_value" value="" autocomplete="off"><br><br><br>
                            <h5 class="headnavigation">Stok bahan baku</h5>
                            <input class="textinput2 cleaveuang" type="text" name="editbox4" id="stock_value" value="" autocomplete="off"><br><br><br>
                            <h5 class="headnavigation">Asal supplier <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="editbox9" id="supplier_value" value="" autocomplete="off" required><br><br><br>
                        </div>
                        <div class="entryfield">
                            <h5 class="headnavigation">Panjang bahan baku <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                            <input class="textinput2 cleaveuang" type="text" name="editbox5" id="panjang_value" value="" autocomplete="off"><br><br><br>
                            <h5 class="headnavigation">Lebar bahan baku <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                            <input class="textinput2 cleaveuang" type="text" name="editbox6" id="lebar_value" value="" autocomplete="off"><br><br><br>
                            <h5 class="headnavigation">Tinggi bahan baku <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                            <input class="textinput2 cleaveuang" type="text" name="editbox7" id="tinggi_value" value="" autocomplete="off"><br><br><br>
                            <h5 class="headnavigation">Berat bahan baku <?php if ($usersettingb === 'KG'){echo '(<redfont>Kilogram</redfont>)';}else{echo '(<redfont>Gram</redfont>)';};?></h5>
                            <input class="textinput2 cleaveuang" type="text" name="editbox8" id="berat_value" value="" autocomplete="off"><br><br><br>
                        </div>
                        <div class="entryfield">
                            <h5 class="headnavigation">Harga beli tertimbang</h5>
                            <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" id="hbtt_value" type="text" name="editbox11" value="harga" autocomplete="off" required maxlength="20"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br><br><br>
                            <h5 class="headnavigation">Harga beli terakhir</h5>
                            <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" id="hbtr_value" type="text" name="editbox12" value="harga" autocomplete="off" required maxlength="20"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br><br><br>
                            <h5 class="headnavigation">Lokasi bahan baku</h5>
                            <input class="textinput2" type="text" name="editbox10" id="lokasi_value" value="" autocomplete="off"><br><br><br>
                                    
                            <h5 class="headnavigation">Status bahan baku</h5>
                            <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                                <label class="checkboxlabel"><h5 class="headnavigation">Aktif</h5>
                                    <input type="radio" name="editboxstat" id="st1" value="1">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkboxlabel"><h5 class="headnavigation">Tidak Aktif</h5>
                                    <input type="radio" name="editboxstat" id="st2" value="2">
                                    <span class="checkmark"></span>
                                </label>
                            </div><br><br><br>
                        </div>
                                
                        <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                            <h5 class="headnavigation"><redfont><i>Ingin merubah data?</i></redfont></h5>
                            <input class="formsubmit" type="submit" name="" value="Ubah data material">
                            <div class="formsubmitcancel" onclick="datahide('detailedit'); datalookup('detailbox');"><h5>BATAL</h5></div>
                        </div>
                    </form>
                </div>
                
            </div>
    </div>
</body>

<footer>
<script type="text/javascript" src="script/footerscript.js"></script>
</footer>