<?php
   include('library/session.php');
   include('library/config_hakakses.php');
?>
<html>
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
    <script type="text/javascript" src="script/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            var a = '<?php if(!isset($_SESSION["err"])){ echo ""; }else{ echo $_SESSION["err"]; } $_SESSION["err"]=""; ?>';
            if(a == 1){
                $("#alert").html('<div class="alert alert-success fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Success!</strong> berhasil tambah data. </div>');
            }else if(a == 2){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> data yang akan anda masukkan sudah ada. </div>');
            }else if(a == 3){
                $("#alert").html('<div class="alert alert-success fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> gagal tambah data. </div>');
            }else if(a == 4){
                $("#alert").html('<div class="alert alert-success fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Success!</strong> berhasil ubah data. </div>');
            }else if(a == 5){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> gagal ubah data. </div>');
            }else if(a == 6){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> data yang akan anda ubah sudah tidak ada. </div>');
            }else if(a == 7){
                $("#alert").html('<div class="alert alert-success fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Success!</strong> berhasil hapus data. </div>');
            }else if(a == 8){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> gagal hapus data. </div>');
            }else if(a == 9){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> data yang akan anda hapus sudah tidak ada. </div>');
            }else if(a == 10){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show  headnavigation3"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> anda tidak mempunyai akses untuk melakukan aksi ini. </div>');
            }

            $(".alert").on('click',function(){
                $(this).hide();
            });
            setTimeout(function(){ $(".alert").hide(); }, 8000);

            $("#load").hide();
            $(".detailentry").hide();
            $(".detailbox").hide();

            $(".tambahentry").on('click',function(){
                $("#tampil-tabel").hide();
                $("#jdl").html("<i class='fas fa-user-plus'></i> Tambah data kategori");
                $(".detailentry").show();
            });

            $(".datalookup").click(function(){
                $("#tampil-tabel").hide();
                var id = $(this).attr("data-id");
                var nama = $(this).attr("data-nama");
                var kode = $(this).attr("data-kode");
                var alamat = $(this).attr("data-alamat");
                var status = $(this).attr("data-status");
                var opt = $(this).attr("data-opt");

                $("#id_view").val(id);
                $("#nama_view").html(nama);
                $("#kode_kategori_view").html(kode);
                $("#opt_view").html(opt);
                $("#st_value").val(status);
                if(status == "1"){
                    $("#st_view").html("<h2 class='headnavigation'><redfont>Aktif</redfont></h2>");
                }else{
                    $("#st_view").html("<h2 class='headnavigation''><redfont>Tidak Aktif</redfont></h2>");
                }
                $(".detailbox").show();
            });

            $(".boxsubmit").on('click',function(){
                $("#load").show();
            });
            $(".boxsubmit").on('click',function(){
                $("#load").show();
                $("#jdl").html("<i class='fas fa-user-check'></i> Ubah data kategori");
                $("#id").val($("#id_view").val());
                $("#nama_kategori").val($("#nama_view").text());
                $("#kode_kategori").val($("#kode_kategori_view").text());
                $("#opt_kategori").val($("#opt_view").text());
                $("#jdl_btn").val("Ubah kategori");
                var x = $("#st_value").val();
                if(x == "1"){
                    $("#st").removeAttr("checked");
                    $("#st1").attr("checked","checked");
                }else{
                    $("#st1").removeAttr("checked");
                    $("#st").attr("checked","checked");
                }

                $(".detailbox").hide();
                $("#load").hide();
                $(".detailentry").show();
            });



            $(".tambahentrycancel").on('click',function(){
                $("#tampil-tabel").show();
                $(".detailentry").hide();
            });

            $(".detailboxcancel").on('click',function(){
                $("#tampil-tabel").show();
                $(".detailbox").hide();
            });

            $(".nomor").keypress(validateNumber);

            $(".hapus_data").on('click',function(){
                $("#load").show();
                var id = $(this).attr("data-id");
                var nama = $(this).attr("data-nama");         
                var opt = '<?php echo $userid; ?>';         
                var result = confirm("Anda yakin akan menghapus data kategori ("+nama+") ?");
                if (result) {  
                    $.ajax({
                        type : "POST", 
                        url  : "<?php echo 'library/delete_kategori.php'; ?>", 
                        dataType : "JSON", 
                        data : {id:id,opt:opt},
                        success: function(data){
                            if(data == true){
                                location.reload();
                            }else{
                                location.reload();
                            }
                        },error: function() {
                            location.reload();
                        }
                    });return false;
                }else{
                    $("#load").hide();
                }
            });

        });

        function validateNumber(event) {
            var key = window.event ? event.keyCode : event.which;
            /*if (event.keyCode === 8 || event.keyCode === 46) {
                return true;
            } else */if ( key < 48 || key > 57 ) {
                return false;
            } else {
                return true;
            }
        };

    </script>
    <style type="text/css">
        body{
            overflow-y: auto;
        }
    </style>
</head>
<title>Lotus</title>
<body>
    <?php include("loader.php"); ?>
    <div class="spacer"></div>
    <?php
        include('library/submenusidebar.php');
    ?>
    <div class="menudisplaycontainer">
        
    <div id="alert"></div>
        
        <div class="navcontainer">
            <div class="navleft">
                <h2 class="headnavigation"><?php echo strtoupper("$userjob") ?> <redfont>/</redfont> <?php echo $usernamalengkap ?></h2>
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> kategori</h5>
            </div>
        </div>
        <hr class="hrred">
            <div class="dashcontainer1">
                
            <?php

                $query = "SELECT * FROM kategori";
                $search_result = filterTable($query);

                function filterTable($query)
                {
                    $connect = mysqli_connect("localhost", "root", "", "lotus");
                    $filter_Result = mysqli_query($connect, $query);
                    return $filter_Result;
                }
                
            ?>    
            <div id="tampil-tabel"> 
                <div class="dcctable">
                    <table id="tabel-data">
                    <?php if(cek_hak_akses_aksi_submenu($userid,8,"user_tambah") > 0 ){ ?>
                        <div class="formsubmit tambahentry" style="position:absolute; float:right; z-index:50;"><h5><i class="fas fa-plus fas2"></i> Tambah data kategori</h5></div>
                    <?php } ?>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kode</th>
                                <th>Status</th>
                                <th style="width:10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px!important;">
                        <?php $mulai=0; while($row = mysqli_fetch_assoc($search_result)): $mulai++; ?>
                            <tr>
                                <td><?php echo $row['kategori_nama'];?></td>
                                <td><?php echo $row['kategori_kode'];?></td>
                                
                                
                                <td style="width:20px; text-align:center;">
                                <form class="statuschangeform" action="librarystatus/update_statuskategori.php" method="post">
                                    <input class="textinput2" type="text" name="editboxid" value="<?php echo $row['kategori_id'];?>" style="display:none;">
                                    <input class="textinput2" type="text" name="editbox2" value="<?php echo $row['kategori_kode']?>" style="display:none;">
                                    <input class="textinput2" type="text" name="changestatus" value="<?php echo $row['kategori_status']?>" style="display:none;">
                                    
                                    <?php if ($row['kategori_status'] === '1'){echo '<input class="statusaktif" type="submit" name="" value="Aktif">';}else{echo '<input class="statusnonaktif" type="submit" name="" value="Tidak aktif">';}; ?>
                                </form>
                                </td>
                                
                                <td style="text-align:center;"><h4>
                                    <?php if(cek_hak_akses_aksi_submenu($userid,8,"user_lihat") > 0 ){ ?>
                                    <a class="datalookup" style="cursor:pointer;" data-id="<?php echo $row['kategori_id'];?>" data-nama="<?php echo $row['kategori_nama'];?>" data-kode="<?php echo $row['kategori_kode'];?>" data-status="<?php echo $row['kategori_status'];?>" data-opt="<?php echo $row['kategori_opid'];?>"><i class="fas fa-list fas2"></i> Lihat data</a>
                                    <?php } ?>
                                    &nbsp;
                                    </h4>
                                </td>                 
                            </tr>                  
                        <?php endwhile;?>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        $('#tabel-data').DataTable();
                    </script> 
                </div> 
            </div>
            <div class="detailcontainer detailentry" id="detailentry">
                <h3 class="headnavigation"><redfont><div id="jdl"></div></redfont></h3>
                <br>
                <form class="boxentry" action="library/insert_kategori.php" method="post">
                <div class="entryfield">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="opt" id="opt" value="<?php echo $userid; ?>">
                    <h5 class="headnavigation">Nama kategori <redfont><i>*</i></redfont></h5>
                    <input class="textinput2" type="text" name="nama_kategori" id="nama_kategori" value="" autocomplete="off" required><br><br><br>
                    <h5 class="headnavigation">kode kategori <redfont>*</redfont></h5>
                    <input class="textinput2" type="text" name="kode_kategori" id="kode_kategori" value="" autocomplete="off" required><br><br><br>
                    
                    <!-- 
                    <h5 class="headnavigation">OPT kategori</h5>
                    <input class="textinput2" type="text" name="opt_kategori" id="opt_kategori" value="" autocomplete="off"><br><br><br> -->
                    <h5 class="headnavigation">Status kategori <redfont><i>*</i></redfont></h5>
                    <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                        <label class="checkboxlabel"><h5 class="headnavigation">Aktif</h5>
                          <input type="radio" checked="checked" name="st" id="st1" value="1">
                          <span class="checkmark"></span>
                        </label>
                        <label class="checkboxlabel"><h5 class="headnavigation">Tidak Aktif</h5>
                          <input type="radio" name="st" id="st" value="0">
                          <span class="checkmark"></span>
                        </label>
                    </div><br><br><br>
                </div>
                <div class="entryfield">
                </div>
                <div class="entryfield">
                   
                </div>
                    
                <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                    <h5 class="headnavigation"><redfont><i>Ingin menambahkan data?</i></redfont></h5>
                    <input class="formsubmit boxsubmitx" type="submit" id="jdl_btn" value="Tambah kategori">
                    <div class="formsubmitcancel tambahentrycancel"><h5>BATAL</h5></div>
                </div>
                </form>
            </div>

            <div class="detailcontainer detailbox" id="detailbox">
                <h3 class="headnavigation"><redfont><i class="fas fa-user-check"></i> Data kategori lengkap</redfont></h3>
                <br>
                <input type="hidden" id="id_view" name="id_view">
                <div class="entryfield">
                    <h5 class="headnavigation">Nama kategori</h5>
                    <h2 class="headnavigation"><redfont><div id="nama_view"></div></redfont></h2><br><br>
                    <h5 class="headnavigation">kode kategori</h5>
                    <h2 class="headnavigation"><redfont><div id="kode_kategori_view"></div></redfont></h2><br><br>
                    
                    <h5 class="headnavigation">OPT kategori</h5>
                    <h2 class="headnavigation"><redfont><div id="opt_view"></div></redfont></h2><br><br>
                    <h5 class="headnavigation">Status kategori</h5>
                    <div class="checkboxcontainer" style="float:left; margin-top:5px;">

                        <redfont><div id="st_view"></div></redfont>
                    </div><br><br>
                    <input type="hidden" name="st_value" id="st_value">
                </div>
                <div class="entryfield">
 
                </div>
                
                <div class="konfirmasi" style="position:absolute; bottom:0; right:0;">
                    <h5 class="headnavigation"><redfont><i>Ingin mengubah data?</i></redfont></h5>
                    <input class="formsubmit boxsubmit" type="submit" name="" value="Ubah kategori">
                    <div class="formsubmitcancel detailboxcancel"><h5>BATAL</h5></div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>