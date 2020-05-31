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
        var barcode = $(this).attr("data-barcode");
        var nama = $(this).attr("data-nama");
        var tipe = $(this).attr("data-tipe");
        var stock = $(this).attr("data-stock");
        var panjang = $(this).attr("data-panjang");
        var lebar = $(this).attr("data-lebar");
        var tinggi = $(this).attr("data-tinggi");
        var berat = $(this).attr("data-berat");
        var harga = $(this).attr("data-harga");
        var lokasi = $(this).attr("data-lokasi");
        var status = $(this).attr("data-status");
        var opid = $(this).attr("data-opid");
        var tdiubah = $(this).attr("data-tdiubah");
        
        $("#id_view").html(id);
        $("#barcode_view").html(barcode);
        $("#nama_view").html(nama);
        $("#tipe_view").html(tipe);
        $("#stock_view").html(new Intl.NumberFormat('ja-JP').format(stock));
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
        $("#harga_view").html(new Intl.NumberFormat('ja-JP').format(harga));
        $("#lokasi_view").html(lokasi);
        $("#st_value").html(status);
            if(status == "1"){
                $("#st_view").html("Aktif");
            }else{
                $("#st_view").html("Tidak Aktif");
            };
        $("#opid_view").html(opid);
        $("#tdiubah_view").html(tdiubah);
        
        
        $("#id_value").val(id);
        $("#barcode_value").val(barcode);
        $("#nama_value").val(nama);
        $("#tipe_value").val(tipe);
        $("#stock_value").val(new Intl.NumberFormat('ja-JP').format(stock));
        $("#panjang_value").val(new Intl.NumberFormat('ja-JP').format(panjang));
        $("#lebar_value").val(new Intl.NumberFormat('ja-JP').format(lebar));
        $("#tinggi_value").val(new Intl.NumberFormat('ja-JP').format(tinggi));
        $("#berat_value").val(new Intl.NumberFormat('ja-JP').format(berat));
        $("#harga_value").val(new Intl.NumberFormat('ja-JP').format(harga));
        $("#lokasi_value").val(lokasi);
        $("#st_value").val(status);
            if(status == "1"){
                $("#st2").removeAttr("checked");
                $("#st1").attr("checked","checked");
            }else{
                $("#st1").removeAttr("checked");
                $("#st2").attr("checked","checked");
            };
        $("#opid_value").val(opid);
        $("#tdiubah_value").val(tdiubah);
        
        $("#detailbox").show();
    });
});
</script>





<title>Lotus - Barang jadi</title>

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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Barang jadi</h5>
            </div>
        </div>
        
        <hr class="hrred">
            <div class="dashcontainer1">
                <div class="detailcontainer" id="detailentry">
                    <h3 class="headnavigation"><redfont><i class="fas fa-people-carry"></i> Tambah barang jadi</redfont></h3>
                    <br>
                    <form class="boxentry" action="library/insert_barang.php" method="post">
                    <div class="entryfield">
                        <h5 class="headnavigation">Kode barcode <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="entrybox1" value="" autocomplete="off" required><br><br><br>
                        <h5 class="headnavigation">Nama barang <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="entrybox2" value="" autocomplete="off" required><br><br><br>
                        <h5 class="headnavigation">Tipe barang</h5>
                        <input class="textinput2" type="text" name="entrybox3" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Stok barang <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox4" value="" autocomplete="off" required><br><br><br>
                    </div>
                    <div class="entryfield">
                        <h5 class="headnavigation">Panjang barang <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox5" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Lebar barang <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox6" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Tinggi barang <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox7" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Berat barang <?php if ($usersettingb === 'KG'){echo '(<redfont>Kilogram</redfont>)';}else{echo '(<redfont>Gram</redfont>)';};?></h5>
                        <input class="textinput2 cleaveuang" type="text" name="entrybox8" value="" autocomplete="off"><br><br><br>
                    </div>
                    <div class="entryfield">
                        <h5 class="headnavigation">Harga barang <redfont><i>(Harus diisi)</i></redfont></h5>
                        <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" type="text" name="entrybox9" value="" autocomplete="off" required maxlength="20"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br><br><br>
                        
                        <h5 class="headnavigation">Lokasi unit</h5>
                        <input class="textinput2" type="text" name="entrybox10" value="" autocomplete="off"><br><br><br>
                    </div>
                        
                        <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                            <h5 class="headnavigation"><redfont><i>Ingin menambahkan data?</i></redfont></h5>
                            <input class="formsubmit boxsubmit" type="submit" name="" value="Tambah barang">
                            <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('detailentry');"><h5>BATAL</h5></div>
                        </div>
                    </form>
                </div>

                <div class="dcctable" id="dcctable">
                    <table id="tabel-data">
                        <div class="formsubmit" style="position:absolute; float:right; z-index:50;" onclick="datalookup('detailentry'); datahide('dcctable');"><h5><i class="fas fa-plus fas2"></i> Tambah data barang jadi</h5></div>
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Nama barang</th>
                                <th>Stok</th>
                                <th>Harga barang</th>
                                <th>Status</th>
                                <th style="width:10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $barang = mysqli_query($db,"select * from barang");
                            while($row = mysqli_fetch_array($barang))
                            {
                                
                                if ($usersettingplt === 'M'){
                                    $barangpanjang_converted = $row['barang_panjang'] / 100;
                                    $baranglebar_converted = $row['barang_lebar'] / 100;
                                    $barangtinggi_converted = $row['barang_tinggi'] / 100;
                                }else{
                                    $barangpanjang_converted = $row['barang_panjang'];
                                    $baranglebar_converted = $row['barang_lebar'];
                                    $barangtinggi_converted = $row['barang_tinggi'];
                                };

                                if ($usersettingb === 'KG'){
                                    $barangberat_converted = $row['barang_berat'] / 1000;
                                }else{
                                    $barangberat_converted = $row['barang_berat'];
                                };
                                
                                
                                $stokbarang = number_format($row['barang_stock']);
                                $hargabarang = number_format($row['barang_harga']);
                                
                        ?>
                            
                        <tr>
                            <td><?php echo $row['barang_barcode'];?></td>
                            <td><?php echo $row['barang_nama'];?></td>
                            <td><div style="float:left; margin-right:10px;"><?php echo $stokbarang;?> pcs</div> <h5 class="headnavigation" style="float:left;"> </h5></td>
                            <td>Rp. <?php echo $hargabarang;?></td>
                            
                            <td style="width:20px; text-align:center;">
                                <form class="statuschangeform" action="librarystatus/update_statusbarang.php" method="post">
                                    <input class="textinput2" type="text" name="editboxid" value="<?php echo $row['barang_id'];?>" style="display:none;">
                                    <input class="textinput2" type="text" name="editbox2" value="<?php echo $row['barang_barcode']?>" style="display:none;">
                                    <input class="textinput2" type="text" name="changestatus" value="<?php echo $row['barang_status']?>" style="display:none;">
                                    
                                    <?php if ($row['barang_status'] === '1'){echo '<input class="statusaktif" type="submit" name="" value="Aktif">';}else{echo '<input class="statusnonaktif" type="submit" name="" value="Tidak aktif">';}; ?>
                                </form>
                            </td>
                            
                            <td>
                                <a
                                   class="datalookup"
                                   onclick="datahide('dcctable');"
                                   style="cursor:pointer;"
                                   data-id="<?php echo $row['barang_id'];?>"
                                   data-barcode="<?php echo $row['barang_barcode'];?>"
                                   data-nama="<?php echo $row['barang_nama']?>"
                                   data-tipe="<?php echo $row['barang_tipe']?>"
                                   data-stock="<?php echo $row['barang_stock']?>"
                                   data-panjang="<?php echo $barangpanjang_converted ?>"
                                   data-lebar="<?php echo $baranglebar_converted ?>"
                                   data-tinggi="<?php echo $barangtinggi_converted ?>"
                                   data-berat="<?php echo $barangberat_converted ?>"
                                   data-harga="<?php echo $row['barang_harga'] ?>"
                                   data-lokasi="<?php echo $row['barang_lokasi']?>"
                                   data-status="<?php echo $row['barang_status']?>"
                                   data-opid="<?php echo $row['barang_opid']?>"
                                   data-tdiubah="<?php echo $row['barang_tdiubah']?>"
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
                    <h3 class="headnavigation"><redfont><i class="fas fa-box-open"></i> Data barang lengkap</redfont></h3>
                    <br>
                    <div class="entryfield">
                        <h5 class="headnavigation">Kode barcode</h5>
                        <h2 class="headnavigation"><redfont id="barcode_view">barcode</redfont></h2><br><br>
                        <h5 class="headnavigation">Nama barang</h5>
                        <h2 class="headnavigation"><redfont id="nama_view">nama</redfont></h2><br><br>
                        <h5 class="headnavigation">Tipe barang</h5>
                        <h2 class="headnavigation"><redfont id="tipe_view">tipe</redfont></h2><br><br>
                        <h5 class="headnavigation">Stok barang</h5>
                        <h2 class="headnavigation"><redfont id="stock_view">stok</redfont></h2><br><br>
                    </div>
                    <div class="entryfield">
                        <h5 class="headnavigation">Panjang barang</h5>
                        <h2 class="headnavigation"><redfont><a id="panjang_view">panjang</a> <?php if ($usersettingplt === 'M'){echo '<redfont>Meter</redfont>';}else{echo '<redfont>Centimeter</redfont>';};?></redfont></h2><br><br>
                        <h5 class="headnavigation">Lebar barang</h5>
                        <h2 class="headnavigation"><redfont><a id="lebar_view">lebar</a> <?php if ($usersettingplt === 'M'){echo '<redfont>Meter</redfont>';}else{echo '<redfont>Centimeter</redfont>';};?></redfont></h2><br><br>
                        <h5 class="headnavigation">Tinggi barang</h5>
                        <h2 class="headnavigation"><redfont><a id="tinggi_view"></a> <?php if ($usersettingplt === 'M'){echo '<redfont>Meter</redfont>';}else{echo '<redfont>Centimeter</redfont>';};?></redfont></h2><br><br>
                        <h5 class="headnavigation">Berat barang</h5>
                        <h2 class="headnavigation"><redfont><a id="berat_view"></a> <?php if ($usersettingb === 'KG'){echo '<redfont>Kilogram</redfont>';}else{echo '<redfont>Gram</redfont>';};?></redfont></h2><br><br>
                    </div>
                    <div class="entryfield">
                        <h5 class="headnavigation">Harga barang</h5>
                        <h2 class="headnavigation"><redfont>Rp.</redfont><redfont id="harga_view">harga</redfont></h2><br><br>
                        <h5 class="headnavigation">Lokasi unit</h5>
                        <h2 class="headnavigation"><redfont id="lokasi_view">lokasi</redfont></h2><br><br>
                            
                        <h5 class="headnavigation">Status barang</h5>
                        <h2 class="headnavigation"><redfont id="st_view">status</redfont></h2><br><br>
                    </div>
                    <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                        <h5 class="headnavigation"><redfont><i>Ingin merubah data?</i></redfont></h5>
                        <div class="formsubmit editbox" onclick="datahide('detailbox'); datalookup('detailedit');"><h5>Ubah data barang</h5></div>
                        <div class="formsubmitcancel" onclick="datahide('detailbox'); datalookup('dcctable');"><h5>TUTUP</h5></div>
                    </div>
                </div>
                    
                <div class="detailcontainer" id="detailedit">
                    <h3 class="headnavigation"><redfont><i class="fas fa-toolbox"></i> Ubah data barang</redfont> / <redfont id="nama_view">nama</redfont></h3>
                    <br>
                    <form class="boxedit" action="library/update_barang.php" method="post">
                        <div class="entryfield">
                            <input class="textinput2" id="id_value" type="text" name="editboxid" value="" style="display:none;">
                            <h5 class="headnavigation">Barcode barang <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" id="barcode_value" type="text" name="editbox1" value="" autocomplete="off" required><br><br><br>
                            <h5 class="headnavigation">Nama barang <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" id="nama_value" type="text" name="editbox2" value="" autocomplete="off"  required><br><br><br>
                            <h5 class="headnavigation">Tipe barang</h5>
                            <input class="textinput2" id="tipe_value" type="text" name="editbox3" value="" autocomplete="off"><br><br><br>
                            <h5 class="headnavigation">Stok barang <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2 cleaveuang" id="stock_value" type="text" name="editbox4" value="" autocomplete="off"  required><br><br><br>
                        </div>
                        <div class="entryfield">
                            <h5 class="headnavigation">Panjang barang <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                            <input class="textinput2 cleaveuang" id="panjang_value" type="text" name="editbox5" value="" autocomplete="off"><br><br><br>
                            <h5 class="headnavigation">Lebar barang <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                            <input class="textinput2 cleaveuang" id="lebar_value" type="text" name="editbox6" value="" autocomplete="off"><br><br><br>
                            <h5 class="headnavigation">Tinggi barang <?php if ($usersettingplt === 'M'){echo '(<redfont>Meter</redfont>)';}else{echo '(<redfont>Centimeter</redfont>)';};?></h5>
                            <input class="textinput2 cleaveuang" id="tinggi_value" type="text" name="editbox7" value="" autocomplete="off"><br><br><br>
                            <h5 class="headnavigation">Berat barang <?php if ($usersettingb === 'KG'){echo '(<redfont>Kilogram</redfont>)';}else{echo '(<redfont>Gram</redfont>)';};?></h5>
                            <input class="textinput2 cleaveuang" id="berat_value" type="text" name="editbox8" value="" autocomplete="off"><br><br><br>
                        </div>
                        <div class="entryfield">
                            <h5 class="headnavigation">Harga barang <redfont><i>(Harus diisi)</i></redfont></h5>
                            <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" id="harga_value" type="text" name="editbox9" value="harga" autocomplete="off" required maxlength="20"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br><br><br>
                            <h5 class="headnavigation">Lokasi unit</h5>
                            <input class="textinput2" id="lokasi_value" type="text" name="editbox10" value="" autocomplete="off"><br><br><br>
                            
                            <div style="display:none;">
                            <h5 class="headnavigation">Status barang</h5>
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
                        </div>
                        
                        <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                            <h5 class="headnavigation"><redfont><i>Ingin merubah data?</i></redfont></h5>
                            <input class="formsubmit" type="submit" name="" value="Ubah data barang">
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