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
    $(".datalookup1").click(function(){
        var id = $(this).attr("data-id");
        var nama = $(this).attr("data-nama");
        var tipe = $(this).attr("data-tipe");
        var alamat = $(this).attr("data-alamat");
        var status = $(this).attr("data-status");
        var opid = $(this).attr("data-opid");
        var tdiubah = $(this).attr("data-tdiubah");
        
        $("#id_value").val(id);
        $("#nama_value").val(nama);
        if(tipe == "1"){
                $("#tipe2").removeAttr("checked");
                $("#tipe3").removeAttr("checked");
                $("#tipe4").removeAttr("checked");
                $("#tipe1").attr("checked","checked");
            }else if(tipe == "2"){
                $("#tipe1").removeAttr("checked");
                $("#tipe3").removeAttr("checked");
                $("#tipe4").removeAttr("checked");
                $("#tipe2").attr("checked","checked");
            }else if(tipe == "3"){
                $("#tipe2").removeAttr("checked");
                $("#tipe1").removeAttr("checked");
                $("#tipe4").removeAttr("checked");
                $("#tipe3").attr("checked","checked");
            }else{
                $("#tipe2").removeAttr("checked");
                $("#tipe3").removeAttr("checked");
                $("#tipe1").removeAttr("checked");
                $("#tipe4").attr("checked","checked");
            };
        
        $("#alamat_value").val(alamat);
        if(status == "1"){
                $("#st2").removeAttr("checked");
                $("#st1").attr("checked","checked");
            }else{
                $("#st1").removeAttr("checked");
                $("#st2").attr("checked","checked");
            };
        $("#opid_value").val(opid);
        $("#tdiubah_value").val(tdiubah);
        
        $("#detailedit1").show();
    });
});
</script>





<title>Lotus - Unit</title>

<body ondragstart="return false;" ondrop="return false;">
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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Unit</h5>
            </div>
        </div>
        
        <hr class="hrred">
        
        <div class="dashcontainer1" id="dashcontainer1">
            <div class="detailcontainer" id="detailentry1">
                <h3 class="headnavigation"><redfont><i class="fas fa-warehouse"></i> Tambah data unit</redfont></h3>
                <br>
                <form class="boxentry" action="library/insert_unit.php" method="post">
                    <div class="entryfield">
                        <h5 class="headnavigation">Nama unit <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="entrybox1" value="" autocomplete="off" required maxlength="25"><br><br><br>
                        <h5 class="headnavigation">Alamat unit <redfont><i>(Harus diisi)</i></redfont></h5>
                        <textarea class="textinputarea" type="text" name="entrybox2" value="" autocomplete="off" required maxlength="100" rows="4"></textarea><br><br><br><br><br>
                    
                        <h5 class="headnavigation">Jenis unit</h5>
                        <label class="checkboxlabel"><h5 class="headnavigation">Gudang bahan baku</h5>
                            <input type="radio" name="entryboxjenis" value="1" checked="checked">
                            <span class="checkmark"></span>
                        </label><br><br>
                        <label class="checkboxlabel"><h5 class="headnavigation">Gudang barang jadi</h5>
                            <input type="radio" name="entryboxjenis" value="2">
                            <span class="checkmark"></span>
                        </label><br><br>
                        <label class="checkboxlabel"><h5 class="headnavigation">Gudang galeri</h5>
                            <input type="radio" name="entryboxjenis" value="3">
                            <span class="checkmark"></span>
                        </label><br><br>
                    </div>
                    
                    <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                        <h5 class="headnavigation"><redfont><i>Ingin menambahkan data?</i></redfont></h5>
                        <input class="formsubmit boxsubmit" type="submit" name="" value="Tambah unit">
                        <div class="formsubmitcancel" onclick="datalookup('dcctable1'); datahide('detailentry1');"><h5>BATAL</h5></div>
                    </div>
                </form>
            </div>
            
            <div class="dcctable" id="dcctable1">
                <table id="tabel-data">
                    <div class="formsubmit" style="position:absolute; float:right; z-index:50;" onclick="datalookup('detailentry1'); datahide('dcctable1');"><h5><i class="fas fa-plus fas2"></i> Tambah unit</h5></div>
                    <div class="formsubmit" style="position:absolute; float:right; z-index:50; left:360px;" disabled><h5><i class="fas fa-eye fas2"></i> Tampilkan unit</h5></div>
                    
                    <a href="blok.php"><div class="formsubmit" style="position:absolute; float:right; z-index:50; left:495px;" onclick="datalookup('dashcontainer2'); datahide('dashcontainer1');"><h5><i class="fas fa-eye fas2"></i> Tampilkan blok</h5></div></a>
                    <thead>
                        <tr>
                            <th>Nama unit</th>
                            <th>Jenis</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th style="width:10%;">Aksi</th>
                        </tr>
                        </thead>
                <tbody>
                    <?php
                        $unit = mysqli_query($db,"select * from unit");
                        while($row = mysqli_fetch_array($unit))
                        {
                            
                    ?>
                        <tr>
                            <td><?php echo $row['unit_nama'];?></td>
                            <td><?php if ($row['unit_tipe'] === '1'){echo 'Gudang bahan baku';}elseif ($row['unit_tipe'] === '2'){echo 'Gudang barang jadi';}else{echo 'Gudang galeri';}; ?></td>
                            <td><?php echo $row['unit_alamat'];?></td>
                            
                            <td style="width:20px; text-align:center;">
                                <form class="statuschangeform" action="librarystatus/update_statusunit.php" method="post">
                                    <input class="textinput2" type="text" name="editboxid" value="<?php echo $row['unit_id'];?>" style="display:none;">
                                    <input class="textinput2" type="text" name="editbox2" value="<?php echo $row['unit_nama']?>" style="display:none;">
                                    <input class="textinput2" type="text" name="changestatus" value="<?php echo $row['unit_status']?>" style="display:none;">
                                    
                                    <?php if ($row['unit_status'] === '1'){echo '<input class="statusaktif" type="submit" name="" value="Aktif">';}else{echo '<input class="statusnonaktif" type="submit" name="" value="Tidak aktif">';}; ?>
                                </form>
                                </td>
                            
                            <td>
                                <a
                                   class="datalookup datalookup1"
                                   onclick="datahide('dcctable1');"
                                   style="cursor:pointer;"
                                   data-id="<?php echo $row['unit_id'];?>"
                                   data-nama="<?php echo $row['unit_nama'];?>"
                                   data-tipe="<?php echo $row['unit_tipe'];?>"
                                   data-alamat="<?php echo $row['unit_alamat']?>"
                                   data-status="<?php echo $row['unit_status']?>"
                                   data-opid="<?php echo $row['unit_opid']?>"
                                   data-tdiubah="<?php echo $row['unit_tdiubah']?>"
                                   ><h4><i class="fas fa-pencil-alt fas2"></i> Ubah unit</h4></a></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        
        
        <div class="detailcontainer" id="detailedit1">
            <h3 class="headnavigation"><redfont><i class="fas fa-warehouse"></i> Ubah data unit</redfont></h3>
            <br>
            <form class="boxedit" action="library/update_unit.php" method="post">
                <div class="entryfield">
                    <input class="textinput2" type="text" name="editboxid" id="id_value" value="" style="display:none;">
                    <h5 class="headnavigation">Nama unit <redfont><i>(Harus diisi)</i></redfont></h5>
                    <input class="textinput2" type="text" name="editbox1" id="nama_value" value="" autocomplete="off" required maxlength="100"><br><br><br>
                    <h5 class="headnavigation">Alamat unit <redfont><i>(Harus diisi)</i></redfont></h5>
                    <textarea class="textinputarea" type="text" name="editbox2" id="alamat_value" value="" autocomplete="off" required maxlength="100" rows="4"></textarea><br><br><br><br><br>
                            
                    <h5 class="headnavigation">Jenis unit</h5>
                    <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                        <label class="checkboxlabel"><h5 class="headnavigation">Gudang bahan baku</h5>
                            <input type="radio" name="editboxjenis" id="tipe1" value="1">
                            <span class="checkmark"></span>
                        </label><br><br>
                        <label class="checkboxlabel"><h5 class="headnavigation">Gudang barang jadi</h5>
                            <input type="radio" name="editboxjenis" id="tipe2" value="2">
                            <span class="checkmark"></span>
                        </label><br><br>
                        <label class="checkboxlabel"><h5 class="headnavigation">Gudang galeri</h5>
                            <input type="radio" name="editboxjenis" id="tipe3" value="3">
                            <span class="checkmark"></span>
                        </label><br><br>
                    </div><br><br><br><br><br><br><br>
                    
                    <div style="display:none;">
                    <h5 class="headnavigation">Status gudang</h5>
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
                    <input class="formsubmit" type="submit" name="" value="Ubah data unit">
                                    
                    <div class="formsubmitcancel" onclick="datahide('detailedit1'); datalookup('dcctable1');"><h5>BATAL</h5></div>
                </div>
            </form>
        </div>
    
    </div>
</body>

<footer>
<script type="text/javascript" src="script/footerscript.js"></script>
    
<script>
    $.fn.dataTable.render.ellipsis = function () {
        return function ( data, type, row ) {
            return type === 'display' && data.length > 50 ?
                data.substr( 0, 50 ) +'…' :
            data;
        }
    };
    
    $(document).ready(function(){
        $('#tabel-data').DataTable({
            columnDefs: [ {
                targets: 2,
                render: $.fn.dataTable.render.ellipsis()
            } ],
            stateSave: true
        });
    });
</script>
</footer>