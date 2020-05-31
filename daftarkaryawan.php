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
        var nama = $(this).attr("data-nama");
        var user = $(this).attr("data-user");
        var pass = $(this).attr("data-pass");
        var alamat = $(this).attr("data-alamat");
        var iplokasi = $(this).attr("data-iplokasi");
        var job = $(this).attr("data-job");
        var level = $(this).attr("data-level");
        var ktp = $(this).attr("data-ktp");
        var nohp = $(this).attr("data-nohp");
        var gbulanan = $(this).attr("data-gbulanan");
        var gharian = $(this).attr("data-gharian");
        var status = $(this).attr("data-status");
        var opid = $(this).attr("data-opid");
        var tdiubah = $(this).attr("data-tdiubah");
        
        $("#id_view").html(id);
        $("#nama_view").html(nama);
        $("#user_view").html(user);
            if(user == ""){
                $("#user_view").html("--");
            };
        $("#pass_view").html(pass);
            if(pass == ""){
                $("#pass_view").html("--");
            };
        $("#alamat_view").html(alamat);
            if(alamat == ""){
                $("#alamat_view").html("--");
            };
        $("#iplokasi_view").html(iplokasi);
        $("#job_view").html(job);
        $("#level_view").html(level);
        $("#ktp_view").html(ktp);
            if(ktp == ""){
                $("#ktp_view").html("--");
            };
        $("#nohp_view").html(nohp);
            if(nohp == ""){
                $("#nohp_view").html("--");
            };
        $("#gbulanan_view").html(new Intl.NumberFormat('ja-JP').format(gbulanan));
        $("#gharian_view").html(new Intl.NumberFormat('ja-JP').format(gharian));
            if(gharian == ""){
                $("#gharian_view").html("--");
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
        $("#nama_value").val(nama);
        $("#user_value").val(user);
        $("#pass_value").val(pass);
        $("#alamat_value").val(alamat);
        $("#iplokasi_value").val(iplokasi);
        $("#job_value").val(job);
        $("#level_value").val(level);
        $("#ktp_value").val(ktp);
        $("#nohp_value").val(nohp);
        $("#gbulanan_value").val(new Intl.NumberFormat('ja-JP').format(gbulanan));
        $("#gharian_value").val(new Intl.NumberFormat('ja-JP').format(gharian));
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

<title>Lotus - Karyawan</title>

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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Daftar karyawan</h5>
            </div>
        </div>
        
        <hr class="hrred">
            <div class="dashcontainer1">
                <div class="detailcontainer" id="detailentry">
                    <h3 class="headnavigation"><redfont><i class="fas fa-user-plus"></i> Tambah karyawan</redfont></h3>
                    <br>
                    <form class="boxentry" action="library/insert_karyawan.php" method="post">
                        <div class="entryfield">
                            <h5 class="headnavigation">Nama karyawan <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="entrybox1" value="" autocomplete="off" required maxlength="50"><br><br><br>
                            <h5 class="headnavigation">Username karyawan</h5>
                            <input class="textinput2" type="text" name="entrybox2" value="" autocomplete="off" maxlength="12"><br><br><br>
                            <h5 class="headnavigation">Password karyawan</h5>
                            <input class="textinput2" type="text" name="entrybox3" value="" autocomplete="off" maxlength="12"><br><br><br>
                            <h5 class="headnavigation" style="width:300px;"><redfont><i>Jika karyawan tidak membutuhkan login pada aplikasi, kolom Username dan Password karyawan tidak perlu di isi.</i></redfont></h5>
                        </div>
                        <div class="entryfield">
                            <h5 class="headnavigation">Pekerjaan karyawan <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="entrybox4" value="" autocomplete="off" required maxlength="20"><br><br><br>
                            <h5 class="headnavigation">Nomor KTP karyawan</h5>
                            <input class="textinput2" type="text" name="entrybox5" value="" autocomplete="off" inputmode="numeric" onkeypress="return numberOnly(event)" maxlength="17"><br><br><br>
                            <h5 class="headnavigation">Nomor HP karyawan</h5>
                            <input class="textinput2" type="text" name="entrybox6" value="" autocomplete="off" inputmode="numeric" onkeypress="return numberOnly(event)" maxlength="14"><br><br><br>
                            <h5 class="headnavigation">Alamat karyawan</h5>
                            <textarea class="textinputarea" type="text" name="entrybox7" value="" autocomplete="off" maxlength="150"></textarea><br><br><br>
                        </div>
                        <div class="entryfield">
                            <h5 class="headnavigation">Gaji Bulanan <redfont><i>(Harus diisi)</i></redfont></h5>
                            <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" type="text" name="entrybox8" value="" autocomplete="off" required maxlength="12"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br><br><br>

                            <h5 class="headnavigation">Uang Harian</h5>
                            <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" type="text" name="entrybox9" value="" autocomplete="off" maxlength="12"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br><br><br>
                        </div>
                        
                        <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                            <h5 class="headnavigation"><redfont><i>Ingin menambahkan data?</i></redfont></h5>
                            <input class="formsubmit boxsubmit" type="submit" name="" value="Tambah karyawan">
                            <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('detailentry');"><h5>BATAL</h5></div>
                        </div>
                    </form>
                </div>
                
                <div class="dcctable" id="dcctable">
                    <table id="tabel-data">
                        <div class="formsubmit" style="position:absolute; float:right; z-index:50;" onclick="datalookup('detailentry'); datahide('dcctable');"><h5><i class="fas fa-plus fas2"></i> Tambah data karyawan</h5></div>
                        <thead>
                            <tr>
                                <th>Nama karyawan</th>
                                <th>Pekerjaan</th>
                                <th>Nomor HP</th>
                                <th>Status</th>
                                <th style="width:10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $karyawan = mysqli_query($db,"select * from karyawan where karyawan_id!='1' and karyawan_id!='2'");
                            while($row = mysqli_fetch_array($karyawan))
                            {
                        ?> 
                            
                            <tr>
                                <td><?php echo $row['karyawan_nama'];?></td>
                                <td><?php echo $row['karyawan_job'];?></td>
                                <td><?php if($row['karyawan_nohp'] == ''){echo "--";}else{echo $row['karyawan_nohp'];};?></td>
                                
                                <td style="width:20px; text-align:center;">
                                <form class="statuschangeform" action="librarystatus/update_statuskaryawan.php" method="post">
                                    <input class="textinput2" type="text" name="editboxid" value="<?php echo $row['karyawan_id'];?>" style="display:none;">
                                    <input class="textinput2" type="text" name="editbox2" value="<?php echo $row['karyawan_user']?>" style="display:none;">
                                    <input class="textinput2" type="text" name="changestatus" value="<?php echo $row['karyawan_status']?>" style="display:none;">
                                    
                                    <?php if ($row['karyawan_status'] === '1'){echo '<input class="statusaktif" type="submit" name="" value="Aktif">';}else{echo '<input class="statusnonaktif" type="submit" name="" value="Tidak aktif">';}; ?>
                                </form>
                                </td>
                                
                                <td>
                                    <a
                                       class="datalookup"
                                       onclick="datahide('dcctable');"
                                       style="cursor:pointer;"
                                       data-id="<?php echo $row['karyawan_id'];?>"
                                       data-nama="<?php echo $row['karyawan_nama']?>"
                                       data-user="<?php echo $row['karyawan_user']?>"
                                       data-pass="<?php echo $row['karyawan_pass']?>"
                                       data-alamat="<?php echo $row['karyawan_alamat']?>"
                                       data-iplokasi="<?php echo $row['karyawan_iplokasi']?>"
                                       data-job="<?php echo $row['karyawan_job']?>"
                                       data-level="<?php echo $row['hakakses_level']?>"
                                       data-ktp="<?php echo $row['karyawan_ktp']?>"
                                       data-nohp="<?php echo $row['karyawan_nohp']?>"
                                       data-gbulanan="<?php echo $row['karyawan_gbulanan']?>"
                                       data-gharian="<?php echo $row['karyawan_gharian']?>"
                                       data-status="<?php echo $row['karyawan_status']?>"
                                       data-opid="<?php echo $row['karyawan_opid']?>"
                                       data-tdiubah="<?php echo $row['karyawan_tdiubah']?>"
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
                    <h3 class="headnavigation"><redfont><i class="fas fa-user-check"></i> Data karyawan lengkap</redfont></h3>
                    <br>
                    <div class="entryfield">
                        <h5 class="headnavigation">Nama karyawan</h5>
                        <h2 class="headnavigation4"><redfont id="nama_view">nama</redfont></h2><br><br>
                        <h5 class="headnavigation">Username karyawan</h5>
                        <h2 class="headnavigation4"><redfont id="user_view">user</redfont></h2><br><br>
                        <h5 class="headnavigation">Password</h5>
                        <h2 class="headnavigation4"><redfont id="pass_view">password</redfont></h2><br><br>
                        <h5 class="headnavigation">Alamat</h5>
                        <h4 class="headnavigation4"><redfont id="alamat_view">alamat</redfont></h4><br><br>
                    </div>
                    <div class="entryfield">
                        <h5 class="headnavigation">Pekerjaan</h5>
                        <h2 class="headnavigation"><redfont id="job_view">job</redfont></h2><br><br>
                        <h5 class="headnavigation">Nomor KTP</h5>
                        <h2 class="headnavigation4"><redfont id="ktp_view">ktp</redfont></h2><br><br>
                        <h5 class="headnavigation">Nomor HP</h5>
                        <h2 class="headnavigation4"><redfont id="nohp_view">hp</redfont></h2><br><br>
                    </div>
                        <div class="entryfield">
                            <h5 class="headnavigation">Gaji bulanan</h5>
                            <h2 class="headnavigation4"><redfont>Rp.</redfont><redfont id="gbulanan_view">gbulanan</redfont></h2><br><br>
                            <h5 class="headnavigation4">Uang harian</h5>
                            <h2 class="headnavigation"><redfont>Rp.</redfont><redfont id="gharian_view">gharian</redfont></h2><br><br>
                            <h5 class="headnavigation">Status karyawan</h5>
                            <h2 class="headnavigation"><redfont id="st_view">status</redfont></h2><br><br>
                    </div>
                    <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                        <h5 class="headnavigation"><redfont><i>Ingin merubah data?</i></redfont></h5>
                        <div class="formsubmit editbox" onclick="datahide('detailbox'); datalookup('detailedit');"><h5>Ubah data karyawan</h5></div>
                        <div class="formsubmitcancel" onclick="datahide('detailbox'); datalookup('dcctable');"><h5>TUTUP</h5></div>
                    </div>
                </div>
                                
                <div class="detailcontainer" id="detailedit">
                    <h3 class="headnavigation"><redfont><i class="fas fa-user-edit"></i> Ubah data karyawan</redfont></h3>
                    <br>
                    <form class="boxedit" action="library/update_karyawan.php" method="post">
                        <div class="entryfield">
                            <input class="textinput2" type="text" name="editboxid" id="id_value" value="" style="display:none;">
                            <h5 class="headnavigation">Nama karyawan <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="editbox1" id="nama_value" value="" autocomplete="off" required maxlength="100"><br><br><br>
                            <h5 class="headnavigation">Username karyawan</h5>
                            <input class="textinput2" type="text" name="editbox2" id="user_value" value="" autocomplete="off" maxlength="12"><br><br><br>
                            <h5 class="headnavigation">Password karyawan</h5>
                            <input class="textinput2" type="text" name="editbox3" id="pass_value" value="" autocomplete="off" maxlength="50"><br><br><br>
                            <h5 class="headnavigation" style="width:300px;"><redfont><i>Jika karyawan tidak membutuhkan login pada aplikasi, kolom Username dan Password karyawan tidak perlu di isi.</i></redfont></h5>
                        </div>
                        <div class="entryfield">
                            <h5 class="headnavigation">Pekerjaan karyawan <redfont><i>(Harus diisi)</i></redfont></h5>
                            <input class="textinput2" type="text" name="editbox4" id="job_value" value="" autocomplete="off" required maxlength="20"><br><br><br>
                            <h5 class="headnavigation">Nomor KTP karyawan</h5>
                            <input class="textinput2" type="text" name="editbox5" id="ktp_value" value="" autocomplete="off" inputmode="numeric" onkeypress="return numberOnly(event)" maxlength="17"><br><br><br>
                            <h5 class="headnavigation">Nomor HP karyawan</h5>
                            <input class="textinput2" type="text" name="editbox6" id="nohp_value" value="" autocomplete="off" inputmode="numeric" onkeypress="return numberOnly(event)" maxlength="14"><br><br><br>
                            <h5 class="headnavigation">Alamat karyawan</h5>
                            <textarea class="textinputarea" type="text" name="editbox7" id="alamat_value" value="" autocomplete="off" maxlength="150" rows="4"></textarea><br><br><br>
                        </div>
                        <div class="entryfield">
                            <h5 class="headnavigation">Gaji bulanan <redfont><i>(Harus diisi)</i></redfont></h5>
                            <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" type="text" name="editbox8" id="gbulanan_value" value="" autocomplete="off" required maxlength="100"><br><br><br>
                            <h5 class="headnavigation">Uang Harian</h5>
                            <h3 class="headnavigation" style="float:left; margin:10px 5px 0px 0px;"><redfont>Rp. </redfont></h3><input class="textinputuang cleaveuang" type="text" name="editbox9" id="gharian_value" value="" autocomplete="off" maxlength="100"><br><br><br>
                                
                            <div style="display:none;">
                            <h5 class="headnavigation">Status karyawan</h5>
                            <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                                <label class="checkboxlabel"><h5 class="headnavigation">Aktif</h5>
                                    <input type="radio" name="editboxstat" id="st1" value="1">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkboxlabel"><h5 class="headnavigation">Tidak Aktif</h5>
                                    <input type="radio" name="editboxstat" id="st2" value="2">
                                    <span class="checkmark"></span>
                                </label>
                            </div><br><br><br><br>
                            </div>
                        </div>
                                
                        <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                            <h5 class="headnavigation"><redfont><i>Ingin merubah data?</i></redfont></h5>
                            <input class="formsubmit" type="submit" name="" value="Ubah data karyawan">
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