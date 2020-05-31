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
    <link rel="stylesheet" type="text/css" href="css/select2.css">
    
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/cleave.min.js"></script>
    <script type="text/javascript" src="script/script.js"></script>
    <script type="text/javascript" src="script/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="script/select2.js"></script>
    <?php include("loader.php"); ?> <script>$("#load").show();</script>
</head>


<script>
$(document).ready(function(){
    $(".datalookup2").click(function(){
        var blokid = $(this).attr("data-blokid");
        var blokunitid = $(this).attr("data-blokunitid");
        var bloknama = $(this).attr("data-bloknama");
        var bloktipe = $(this).attr("data-bloktipe");
        var blokstatus = $(this).attr("data-blokstatus");
        var blokopid = $(this).attr("data-blokopid");
        var bloktdiubah = $(this).attr("data-bloktdiubah");
        
        $("#blokid_value").val(blokid);
        $("#blokunitid_value").val(blokunitid);
        $("#bloknama_value").val(bloknama);
        if(bloktipe == "1"){
                $("#bloktipe2").removeAttr("checked");
                $("#bloktipe3").removeAttr("checked");
                $("#bloktipe4").removeAttr("checked");
                $("#bloktipe1").attr("checked","checked");
            }else if(bloktipe == "2"){
                $("#bloktipe1").removeAttr("checked");
                $("#bloktipe3").removeAttr("checked");
                $("#bloktipe4").removeAttr("checked");
                $("#bloktipe2").attr("checked","checked");
            }else if(bloktipe == "3"){
                $("#bloktipe2").removeAttr("checked");
                $("#bloktipe1").removeAttr("checked");
                $("#bloktipe4").removeAttr("checked");
                $("#bloktipe3").attr("checked","checked");
            }else{
                $("#bloktipe2").removeAttr("checked");
                $("#bloktipe3").removeAttr("checked");
                $("#bloktipe1").removeAttr("checked");
                $("#bloktipe4").attr("checked","checked");
            };
        
        if(blokstatus == "1"){
                $("#blokst2").removeAttr("checked");
                $("#blokst1").attr("checked","checked");
            }else{
                $("#blokst1").removeAttr("checked");
                $("#blokst2").attr("checked","checked");
            };
        $("#blokopid_value").val(blokopid);
        $("#bloktdiubah_value").val(bloktdiubah);
        
        $("#detailedit2").show();
    });
});
</script>


<title>Lotus - Blok</title>

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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Blok</h5>
            </div>
        </div>
        
        <hr class="hrred">
        
        <div class="dashcontainer1" id="dashcontainer2">
            <div class="detailcontainer" id="detailentry2">
                <h3 class="headnavigation"><redfont><i class="fas fa-warehouse"></i> Tambah data blok</redfont></h3>
                <br>
                <form class="boxentry" action="library/insert_blok.php" method="post">
                    <div class="entryfield">
                        <h5 class="headnavigation">Nama blok <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="blokentrybox1" value="" autocomplete="off" required maxlength="25"><br><br><br>
                        <h5 class="headnavigation">Lokasi blok</h5>
                        
                        
                        
                        <select class="textinput2 blokunitdata2" name="blokentrybox2">
                            <option></option>
                            <?php $unit = mysqli_query($db,"select * from unit where unit_status=1"); while($rowunit = mysqli_fetch_array($unit)) { ?>
                            <option value="<?php echo $rowunit['unit_id'];?>"><?php echo $rowunit['unit_nama'];?></option>
                            <?php } ?>
                        </select><br><br>
                    
                        <script type="text/javascript">
                            $(".blokunitdata2").select2({
                                placeholder: "Pilih nama unit",
                                allowClear: true
                            });
                        </script>
                          
                        
                        
                    
                        <h5 class="headnavigation">Jenis blok</h5>
                        <label class="checkboxlabel"><h5 class="headnavigation">Blok bahan baku</h5>
                            <input type="radio" name="blokentryboxjenis" value="1">
                            <span class="checkmark"></span>
                        </label><br><br>
                        <label class="checkboxlabel"><h5 class="headnavigation">Blok barang jadi</h5>
                            <input type="radio" name="blokentryboxjenis" value="2">
                            <span class="checkmark"></span>
                        </label><br><br>
                        <label class="checkboxlabel"><h5 class="headnavigation">Blok galeri</h5>
                            <input type="radio" name="blokentryboxjenis" value="3">
                            <span class="checkmark"></span>
                        </label><br><br>
                    </div>
                    
                    <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                        <h5 class="headnavigation"><redfont><i>Ingin menambahkan data?</i></redfont></h5>
                        <input class="formsubmit boxsubmit" type="submit" name="" value="Tambah blok">
                        <div class="formsubmitcancel" onclick="datalookup('dcctable2'); datahide('detailentry2');"><h5>BATAL</h5></div>
                    </div>
                </form>
            </div>
            
            <div class="dcctable" id="dcctable2">
                <table id="tabel-data2">
                    <div class="formsubmit" style="position:absolute; float:right; z-index:50;" onclick="datalookup('detailentry2'); datahide('dcctable2');"><h5><i class="fas fa-plus fas2"></i> Tambah blok</h5></div>
                    <a href="unit.php"><div class="formsubmit" style="position:absolute; float:right; z-index:50; left:360px;" onclick="datalookup('dashcontainer1'); datahide('dashcontainer2');"><h5><i class="fas fa-eye fas2"></i> Tampilkan unit</h5></div></a>
                    
                    <div class="formsubmit" style="position:absolute; float:right; z-index:50; left:495px;" disabled><h5><i class="fas fa-eye fas2"></i> Tampilkan blok</h5></div>
                    <thead>
                        <tr>
                            <th>Lokasi blok (Unit)</th>
                            <th>Nama blok</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th style="width:10%;">Aksi</th>
                        </tr>
                        </thead>
                <tbody>
                    <?php
                        $blok = mysqli_query($db,"select * from blok join unit on blok.unit_id = unit.unit_id");
                        while($row = mysqli_fetch_array($blok))
                        {
                            
                    ?>
                        <tr>
                            <td><?php echo $row['unit_nama'];?></td>
                            <td><?php echo $row['blok_nama'];?></td>
                            <td><?php if ($row['blok_tipe'] === '1'){echo 'Blok bahan baku';}elseif ($row['blok_tipe'] === '2'){echo 'Blok barang jadi';}elseif ($row['blok_tipe'] === '3'){echo 'Blok galeri';}else{echo '--';}; ?></td>
                            
                            <td style="width:20px; text-align:center;">
                                <form class="statuschangeform" action="librarystatus/update_statusblok.php" method="post">
                                    <input class="textinput2" type="text" name="blokeditboxid" value="<?php echo $row['blok_id'];?>" style="display:none;">
                                    <input class="textinput2" type="text" name="blokeditboxunitid" value="<?php echo $row['unit_id'];?>" style="display:none;">
                                    <input class="textinput2" type="text" name="blokeditbox2" value="<?php echo $row['blok_nama']?>" style="display:none;">
                                    <input class="textinput2" type="text" name="blokchangestatus" value="<?php echo $row['blok_status']?>" style="display:none;">
                                    
                                    <?php if ($row['blok_status'] === '1'){echo '<input class="statusaktif" type="submit" name="" value="Aktif">';}else{echo '<input class="statusnonaktif" type="submit" name="" value="Tidak aktif">';}; ?>
                                </form>
                                </td>
                            
                            <td>
                                <a
                                   class="datalookup datalookup2"
                                   onclick="datahide('dcctable2');"
                                   style="cursor:pointer;"
                                   data-blokid="<?php echo $row['blok_id'];?>"
                                   data-blokunitid="<?php echo $row['unit_id'];?>"
                                   data-bloknama="<?php echo $row['blok_nama'];?>"
                                   data-bloktipe="<?php echo $row['blok_tipe'];?>"
                                   data-blokstatus="<?php echo $row['blok_status']?>"
                                   data-blokopid="<?php echo $row['blok_opid']?>"
                                   data-bloktdiubah="<?php echo $row['blok_tdiubah']?>"
                                   ><h4><i class="fas fa-pencil-alt fas2"></i> Ubah blok</h4></a></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                    
                    <script>
                        $(document).ready(function(){
                            $('#tabel-data2').DataTable({
                                stateSave: true
                            });
                        });
                    </script>
                    
                </table>
            </div>
        </div>
        
        <div class="detailcontainer" id="detailedit2">
            <h3 class="headnavigation"><redfont><i class="fas fa-warehouse"></i> Ubah data blok</redfont></h3>
            <br>
            <form class="boxedit" action="library/update_blok.php" method="post">
                <div class="entryfield">
                    <input class="textinput2" type="text" name="blokeditboxid" id="blokid_value" value="" style="display:none;">
                    <h5 class="headnavigation">Nama blok <redfont><i>(Harus diisi)</i></redfont></h5>
                    <input class="textinput2" type="text" name="blokeditbox1" id="bloknama_value" value="" autocomplete="off" required maxlength="25"><br><br><br>
                    <h5 class="headnavigation">Lokasi blok</h5>                     
                    
                    <select class="textinput2 blokunitdata2" name="blokeditbox2" id="blokunitid_value">
                        <option></option>
                        <?php $unit = mysqli_query($db,"select * from unit where unit_status=1"); while($rowunit = mysqli_fetch_array($unit)) {?>
                        <option value="<?php echo $rowunit['unit_id'] ?>"><?php echo $rowunit['unit_nama'] ?></option>
                        <?php } ?>
                    </select><br><br>
                    
                    <script type="text/javascript">
                    $(".blokunitdata2").select2({
                        placeholder: "Pilih nama unit",
                        allowClear: true
                    });
                    </script>
                    
                    <h5 class="headnavigation">Jenis blok</h5>
                    <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                        <label class="checkboxlabel"><h5 class="headnavigation">Blok bahan baku</h5>
                            <input type="radio" name="blokeditboxjenis" id="bloktipe1" value="1">
                            <span class="checkmark"></span>
                        </label><br><br>
                        <label class="checkboxlabel"><h5 class="headnavigation">Blok barang jadi</h5>
                            <input type="radio" name="blokeditboxjenis" id="bloktipe2" value="2">
                            <span class="checkmark"></span>
                        </label><br><br>
                        <label class="checkboxlabel"><h5 class="headnavigation">Blok galeri</h5>
                            <input type="radio" name="blokeditboxjenis" id="bloktipe3" value="3">
                            <span class="checkmark"></span>
                        </label><br><br>
                    </div><br><br><br><br><br><br><br>
                    
                    <h5 class="headnavigation">Status blok</h5>
                        <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                            <label class="checkboxlabel"><h5 class="headnavigation">Aktif</h5>
                                <input type="radio" name="blokeditboxstat" id="blokst1" value="1">
                                <span class="checkmark"></span>
                            </label>
                                <label class="checkboxlabel"><h5 class="headnavigation">Tidak Aktif</h5>
                                <input type="radio" name="blokeditboxstat" id="blokst2" value="2">
                                <span class="checkmark"></span>
                            </label>
                        </div><br><br><br>
                </div>
                <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                    <h5 class="headnavigation"><redfont><i>Ingin merubah data?</i></redfont></h5>
                    <input class="formsubmit" type="submit" name="" value="Ubah data blok">
                                    
                    <div class="formsubmitcancel" onclick="datahide('detailedit2'); datalookup('dcctable2');"><h5>BATAL</h5></div>
                </div>
            </form>
        </div>
    
    </div>
</body>

<footer>
<script type="text/javascript" src="script/footerscript.js"></script>
</footer>