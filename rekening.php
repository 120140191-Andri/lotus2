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
        var pemilik = $(this).attr("data-pemilik");
        var bank = $(this).attr("data-bank");
        var nomor = $(this).attr("data-nomor");
        var jenis = $(this).attr("data-jenis");
        var status = $(this).attr("data-status");
        var opid = $(this).attr("data-opid");
        var tdiubah = $(this).attr("data-tdiubah");
        
        $("#id_value").val(id);
        $("#pemilik_value").val(pemilik);
        $("#nama_pemilik").html(pemilik);
        $("#bank_value").val(bank);
        $("#nomor_value").val(nomor);
        $("#opid_value").val(opid);
        $("#tdiubah_value").val(tdiubah);
        if(jenis == "1"){
                $("#jn2").removeAttr("checked");
                $("#jn3").removeAttr("checked");
                $("#jn1").attr("checked","checked");
            }else if(jenis == "2"){
                $("#jn1").removeAttr("checked");
                $("#jn3").removeAttr("checked");
                $("#jn2").attr("checked","checked");
            }else{
                $("#jn1").removeAttr("checked");
                $("#jn2").removeAttr("checked");
                $("#jn3").attr("checked","checked");
            };
        if(status == "1"){
                $("#st2").removeAttr("checked");
                $("#st1").attr("checked","checked");
            }else{
                $("#st1").removeAttr("checked");
                $("#st2").attr("checked","checked");
            };
        
        $("#detailedit").show();
    });
});
</script>

<title>Lotus - Rekening</title>

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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Rekening</h5>
            </div>
        </div>
        
        <hr class="hrred">
        
            <div class="dashcontainer1">
                <div class="detailcontainer" id="detailentry">
                    <h3 class="headnavigation"><redfont><i class="fas fa-credit-card"></i> Tambah data rekening</redfont></h3>
                    <br>
                    <form class="boxentry" action="library/insert_rekening.php" method="post">
                        <div class="entryfield">
                            <h5 class="headnavigation">Nama pemilik rekening <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="entrybox1" value="" autocomplete="off" required maxlength="25"><br><br><br>
                            <h5 class="headnavigation">Nama bank <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="entrybox2" value="" autocomplete="off" required maxlength="25"><br><br><br>
                            <h5 class="headnavigation">Nomor rekening <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="entrybox3" value="" autocomplete="off" inputmode="numeric" onkeypress="return numberOnly(event)" required maxlength="20"><br><br><br>
                            <h5 class="headnavigation">Jenis rekening</h5>
                                <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                                    <label class="checkboxlabel"><h5 class="headnavigation">Pemilik</h5>
                                      <input type="radio" name="entryboxjenis" value="1">
                                      <span class="checkmark"></span>
                                    </label>
                                    <label class="checkboxlabel"><h5 class="headnavigation">Supplier</h5>
                                      <input type="radio" name="entryboxjenis" value="2">
                                      <span class="checkmark"></span>
                                    </label>
                                    <label class="checkboxlabel"><h5 class="headnavigation">Pelanggan</h5>
                                      <input type="radio" name="entryboxjenis" value="3">
                                      <span class="checkmark"></span>
                                    </label>
                                </div><br><br><br>
                        </div>
                        <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                            <h5 class="headnavigation"><redfont><i>Ingin menambahkan data?</i></redfont></h5>
                            <input class="formsubmit boxsubmit" type="submit" name="" value="Tambah rekening">
                            <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('detailentry');"><h5>BATAL</h5></div>
                        </div>
                    </form>
                </div>
                
                <div class="dcctable" id="dcctable">
                    <table id="tabel-data">
                        <div class="formsubmit" style="position:absolute; float:right; z-index:50;" onclick="datalookup('detailentry'); datahide('dcctable');"><h5><i class="fas fa-plus fas2"></i> Tambah rekening</h5></div>
                        <thead>
                            <tr>
                                <th>Nama pemilik rekening</th>
                                <th>Jenis rekening</th>
                                <th>Nama bank</th>
                                <th>Nomor rekening</th>
                                <th>Status</th>
                                <th style="width:10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $karyawan = mysqli_query($db,"select * from rekening");
                            while($row = mysqli_fetch_array($karyawan))
                            {
                        ?>
                            <tr>
                                <td><?php echo $row['rekening_npemilik'];?></td>
                                <td><?php if ($row['rekening_jenis'] === '1'){echo 'Pemilik';}elseif ($row['rekening_jenis'] === '2'){echo 'Supplier';}else{echo 'Pelanggan';}; ?></td>
                                <td><?php echo $row['rekening_bank'];?></td>
                                <td><?php echo $row['rekening_nomor'];?></td>
                                
                                <td style="width:20px; text-align:center;">
                                <form class="statuschangeform" action="librarystatus/update_statusrekening.php" method="post">
                                    <input class="textinput2" type="text" name="editboxid" value="<?php echo $row['rekening_id'];?>" style="display:none;">
                                    <input class="textinput2" type="text" name="editbox2" value="<?php echo $row['rekening_nomor']?>" style="display:none;">
                                    <input class="textinput2" type="text" name="changestatus" value="<?php echo $row['rekening_status']?>" style="display:none;">
                                    
                                    <?php if ($row['rekening_status'] === '1'){echo '<input class="statusaktif" type="submit" name="" value="Aktif">';}else{echo '<input class="statusnonaktif" type="submit" name="" value="Tidak aktif">';}; ?>
                                </form>
                                </td>

                                <td>
                                    <a 
                                       class="datalookup"
                                       onclick="datahide('dcctable');"
                                       style="cursor:pointer;"
                                       data-id="<?php echo $row['rekening_id'];?>"
                                       data-pemilik="<?php echo $row['rekening_npemilik'];?>"
                                       data-bank="<?php echo $row['rekening_bank'];?>"
                                       data-nomor="<?php echo $row['rekening_nomor']?>"
                                       data-jenis="<?php echo $row['rekening_jenis']?>"
                                       data-status="<?php echo $row['rekening_status']?>"
                                       data-opid="<?php echo $row['rekening_opid']?>"
                                       data-tdiubah="<?php echo $row['rekening_tdiubah']?>"
                                    ><h4><i class="fas fa-pencil-alt fas2"></i> Ubah rekening</h4></a></td>
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
            </div>
        <div class="detailcontainer" id="detailedit">
            <h3 class="headnavigation"><redfont><i class="fas fa-credit-card"></i> Ubah data rekening</redfont> / <redfont id="nama_pemilik"></redfont></h3>
            <br>
                <form class="boxedit" action="library/update_rekening.php" method="post">
                    <div class="entryfield">
                        <input class="textinput2" type="text" name="editboxid" id="id_value" value="" style="display:none;">
                        <h5 class="headnavigation">Nama pemilik rekening <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="editbox1" id="pemilik_value" value="" autocomplete="off" required maxlength="100"><br><br><br>
                        <h5 class="headnavigation">Nama bank rekening <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="editbox2" id="bank_value" value="" autocomplete="off" required maxlength="100"><br><br><br>
                        <h5 class="headnavigation">Nomor rekening <redfont><i>(Harus diisi)</i></redfont></h5>
                        <input class="textinput2" type="text" name="editbox3" id="nomor_value" value="" autocomplete="off" inputmode="numeric" onkeypress="return numberOnly(event)" required maxlength="20"><br><br><br>
                        <h5 class="headnavigation">Jenis rekening</h5>
                        <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                            <label class="checkboxlabel"><h5 class="headnavigation">Pemilik</h5>
                                <input type="radio" name="editboxjenis" id="jn1" value="1">
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkboxlabel"><h5 class="headnavigation">Supplier</h5>
                                <input type="radio" name="editboxjenis" id="jn2" value="2">
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkboxlabel"><h5 class="headnavigation">Pelanggan</h5>
                                <input type="radio" name="editboxjenis" id="jn3" value="3">
                                <span class="checkmark"></span>
                            </label>
                        </div><br><br><br>
                        
                        <div style="display:none;">
                        <h5 class="headnavigation">Status rekening</h5>
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
                        <input class="formsubmit" type="submit" name="" value="Ubah data rekening">
                        <div class="formsubmitcancel" onclick="datahide('detailedit'); datalookup('dcctable');"><h5>BATAL</h5></div>
                    </div>
                </form>
        </div>
    </div>
</body>

<footer>
<script type="text/javascript" src="script/footerscript.js"></script>
</footer>