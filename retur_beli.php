<?php
   include('library/session.php');
   include('library/config_hakakses.php');
    if(cek_hak_akses_aksi_submenu($userid,20,"user_tambah") > 0 ){ 
        $st = "";
    }else{
        $st = "disabled";
    }
    
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
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/cleave.min.js"></script>
    <script type="text/javascript" src="script/jquery.dataTables.min.js"></script>
    <style type="text/css">
        
    </style>
    <script>
        var userid = '<?php echo $userid; ?>';
        var datas = "";
        function cek_transaksi(){
            var load = "";
            $.ajax({
                type : "POST", 
                url  : "<?php echo 'library/cek_transaksi_retur.php'; ?>", 
                dataType : "JSON", 
                data : {userid:userid,load:load},
                success: function(data){
                    if(data == "denied"){
                        $("#load").hide();
                        alert('Anda tidak memiliki akses untuk melakukan aksi ini.');
                        location.reload();
                    }else{
                        if(data['count'] == 1){
                            $("#no_nota").val(data['no_nota']);
                            $("#tgl_nota_beli").val(data['tgl_nota']);
                            $("#no_nota_retur").val(data['no_retur']);
                            $("#supplier_id").val(data['sup']);
                            $("#item").html(data['item']+" Item");
                            $("#sebelum").html(data['tot']);
                            $("#tot_retur").val(data['retur']);
                            $("#setelah").html(data['setelah_retur']);
                            datas = data['data'];
                            $('#kadal').dataTable().fnClearTable();
                            $('#kadal').dataTable().fnAddData(datas);

                            $("#tampil-tabel").hide();
                            $("#detailentry").show();
                            $("#load").hide();
                        }else{
                            $("#detailentry").hide();
                            $("#tampil-tabel").show();
                            $("#load").hide();
                        }
                    }
                }
            });
        }

        $(document).ready(function(){
           
           cek_transaksi();

           $(".transaksi_batal").on('click',function(){
                $("#load").show();
                var result = confirm("Masih ada data retur yang belum disimpan, Anda yakin akan membatalkan nya ?");
                if (result) {
                    var no_nota_retur = $("#no_nota_retur").val();
                    var userid = '<?php echo $userid; ?>';
                    $.ajax({
                        type : "POST", 
                        url  : "<?php echo 'library/batal_retur.php'; ?>", 
                        dataType : "JSON", 
                        data : {userid:userid,no_nota_retur:no_nota_retur},
                        success: function(data){
                            if(data == true){
                               location.reload();
                            }else{
                                alert("Gagal membatalkan data retur, silahkan coba kembali.");
                                $("#load").hide();
                            }
                        }
                    });
                    
                }else{
                    $("#load").hide();
                }
           });

           $(".transaksi_kembali").on('click',function(){
                $("#load").show();
                $(".rincian").attr("load","nota");
                location.reload();
           });

           $(".dataedit").on('click',function(){
                $("#load").show();
                var no_nota = $(this).attr("data-no_nota");
                var load = "detail";
                $.ajax({
                    type : "POST", 
                    url  : "<?php echo 'library/cek_transaksi_retur.php'; ?>", 
                    dataType : "JSON", 
                    data : {no_nota:no_nota,userid:userid,load:load},
                    success: function(data){
                        $("#load").hide();
                        $("#no_nota").val(data['no_nota']);
                        $("#tgl_nota_beli").val(data['tgl_nota']);
                        $("#no_nota_retur").val(data['no_retur']);
                        $("#supplier_id").val(data['sup']);
                        $("#item").html(data['item']+" Item");
                        $("#sebelum").html(data['tot']);
                        $("#tot_retur").val(data['retur']);
                        $("#setelah").html(data['setelah_retur']);
                        datas = data['data'];
                        $('#kadal').dataTable().fnClearTable();
                        $('#kadal').dataTable().fnAddData(datas);

                        $("#tampil-tabel").hide();
                        $(".buat_transaksi").attr("disabled","");
                        $(".rincian").attr("data-load","detail");
                        $(".buat_transaksi").hide();
                        $("#batal").hide();
                        $("#detailentry").show();
                        $(".transaksi_kembali").show();
                        $("#load").hide(); 
                    },error: function() {
                        $("#load").hide();
                        alert('Jaringan gagal.');  
                    }
                });

           });
        });
    </script>
    <style type="text/css">
        
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
        <div class="navcontainer">
            <div class="navleft">
                <h2 class="headnavigation"><?php echo strtoupper("$userjob") ?> <redfont>/</redfont> <?php echo $usernamalengkap ?></h2>
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Retur <redfont>/</redfont> Pembelian</h5>
            </div>
        </div>
        <hr class="hrred" style="padding:0px!important;">
            <div class="dashcontainer1">
                <div id="alert"></div>
            <?php
                $query = "SELECT * FROM retur_beli order by id_retur_beli desc";
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
                        <?php if(cek_hak_akses_aksi_submenu($userid,20,"user_tambah") > 0 ){ ?>
                            <div class="formsubmit tambahentry" style="position:absolute; float:right; z-index:50;cursor: pointer;"><h5><i class="fas fa-plus fas2"></i> Buat Retur</h5></div>
                        <?php } ?>
                        <thead>
                            <tr>
                                <th style="text-align:center;">No.</th>
                                <th style="text-align:center;">No. Nota Retur</th>
                                <th style="text-align:center;">Tanggal Retur</th>
                                <th style="text-align:center;">Nama Supplier</th>
                                <th style="text-align:center;">Status Retur</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px!important;">
                        <?php $mulai=0; while($row = mysqli_fetch_assoc($search_result)): $mulai++; 
                            $id_beli=$row['id_beli'];    $sup = mysqli_fetch_assoc(mysqli_query($db,"select supplier_id from transaksi where transaksi_id='$id_beli'"));
                        ?>
                            <tr>
                                <td style="width:30%;text-align: center;"><?php echo $mulai;?>.</td>
                                <td style="width:30%;text-align: center;"><?php echo $row['no_retur_beli'];?></td>
                                <td style="width:20%;"><?php echo date('d/m/Y',strtotime($row['tgl_retur']));?></td>
                                <td style="width:20%;"><?php echo nama_supplier($sup['supplier_id']);?></td>
                                <td style="width:15%;text-align:center;"><?php if($row['status'] == 2){ echo "<span class='badge_status_aktif'>selesai</span>"; }else{ echo "<span class='badge_status_non_aktif'>Menunggu Scan Gudang</span>"; }?></td>
                                <td style="width:20%;text-align:center;"><h4>
                                    <?php if(cek_hak_akses_aksi_submenu($userid,20,"user_lihat") > 0 ){ ?>
                                      <a class="dataedit" data-no_nota="<?php echo $row['no_retur_beli'];?>" style="cursor:pointer;color:#EA2027;" ><i class="fas fa-list fas2"></i> Rincian</a>
                                    <?php } ?>
                                    <?php if(cek_hak_akses_aksi_submenu($userid,20,"user_tambah") > 0 ){ ?>
                                      <a class="" target="_blank" href="barcode/retur_beli.php?trans=<?php echo $row['id_beli']; ?>&kode=<?php echo $row['no_retur_beli'];?>&id=<?php echo $row['id_retur_beli'];?>&cetak=<?php echo nama_opt($userid); ?>" style="cursor:pointer;color:#EA2027;" ><i class="fas fa-print fas2"></i> Cetak Nota</a>
                                    <?php } ?>
                                    </h4>
                                </td>                 
                            </tr>                  
                        <?php endwhile;?>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        $('#tabel-data').DataTable({"order": [[ 1, "desc" ]]});
                    </script>
                </div> 
            </div>
            <input type="hidden" name="diskonx" id="diskonx">
            <input type="hidden" name="ppnx" id="ppnx">
            <div class="detailentry" id="detailentry">
                <h3 class="headnavigation"><redfont><div id="jdl"></div></redfont></h3>
                <br>
                <div class="boxentry">
                <div class="entryfield2" style="width: auto;">
                    <input type="hidden" name="opt" id="opt" value="<?php echo $userid; ?>">
                    <h5 class="headnavigation">No. Nota Retur<redfont><i></i></redfont></h5>
                    <input class="textinput2" type="text" disabled name="no_nota_retur" id="no_nota_retur" value="" autocomplete="off" required><br>
                    <h5 class="headnavigation">No. Nota Beli<redfont><i></i></redfont></h5>
                    <input class="textinput2" type="text" disabled name="no_nota" id="no_nota" value="" autocomplete="off" required><br>
                    <h5 class="headnavigation" style="margin-top: 10px;"><redfont><i></i></redfont></h5>
                    <input type="hidden" name="id_nota" id="id_nota" value="">
                </div>
                <div class="entryfield2" style="width: auto;">
                    
                </div>
                <div class="entryfield2" style="width: auto;">
                    <h5 class="headnavigation">Tanggal Nota Beli<redfont><i></i></redfont></h5>
                    <input class="textinput2" type="text" disabled name="tgl_nota_beli" id="tgl_nota_beli" value="" autocomplete="off" required><br>
                    <h5 class="headnavigation" style="margin-top: -6px;">Supplier (<redfont><i>Harus Dipilih</i></redfont>)</h5>
                    <select class="textinput2" name="supplier_id" disabled id="supplier_id">
                        <option value="">== Pilih Supplier ==</option>
                        <?php $qq1 = mysqli_query($db,"select * from supplier order by supplier_nama asc"); 
                        while ($data_sup = mysqli_fetch_assoc($qq1)){ ?>
                        <option id="opt<?php echo $data_sup['supplier_id']; ?>" value="<?php echo $data_sup['supplier_id']; ?>"><?php echo $data_sup['supplier_nama']; ?></option>
                        <?php } ?>
                    </select><br><br><br>
                </div>

                <div class="entryfield2 detail_box" style="width: auto;border: 1px solid red;padding: 5px;margin-top: 15px;width: 36%; font-family: fbold;margin-right: 5px!important;">
                    <b>
                        <div style="display: inline-flex;width: 100%;">
                            <div style="width: 50%;"><h5 class="detail_beli">Total Item : <sapn id="item" class="badge_status_aktif"></sapn></h5><h5 class="detail_beli"></h5></div>
                            <div style="text-align: right;width: 50%;"><button style="float: right;margin-right: 0px;" data-load="nota" class="btn-default rincian"><span class="fa fa-list"></span> Rincian Nota Beli</button></div>
                        </div>
                    <h5 class="detail_beli">Jumlah Sebelum Retur : <div style="float: right;font-size: 16px;"><strong>Rp. <span id="sebelum"></span></strong></div></h5>
                    <h5 class="detail_beli">Jumlah Setelah Retur &nbsp;&nbsp;: <div style="float:right;font-size: 16px;">Rp. <span id="setelah"></span></div></h5></b>
                    <input type="hidden" name="jumx" value="0" id="jumx">
                    <input type="hidden" name="totx" value="0" id="totx">
                    <input type="hidden" name="itemx" value="0" id="itemx">
                </div>
                </div>
                <div id="detail_transaksi">
                    <table id="kadal" style="font-size: 12px;"></table> 
                </div>
                <div style="float: left;padding-top: 15px;">
                    <div style="display: inline-flex;align-items: baseline;">
                        <div style="font-family: 'Arial';"><h4>Total Retur Beli (Rp.) </h4></div>&nbsp;&nbsp;<input class="textinput2 cleaveuang" style="text-align: right;" type="text" name="tot_retur" id="tot_retur" value="0" autocomplete="off" disabled>
                    </div>
                </div>
                <div style="float: right;padding-top: 15px;">
                    <div class="formsubmitcancel transaksi_batal" id="batal" style="cursor: pointer;border:1px solid grey;width: 100px;"><h5>Batal</h5></div><div class="formsubmitcancel transaksi_kembali" style="display: none;cursor: pointer;border:1px solid grey;width: 150px;"><h5>Batal</h5></div>
                    <button class="formsubmit buat_transaksi" <?php echo $st; ?> id="jdl_btn" style="background-color: #6ACA6B!important;width: 100px;">Simpan</button><br><br><br>
                </div>
            </div>
        </div>
    </div>
    <div id="bg"></div>
    <div id="modal-kotak" class="col-md-8 buat">
        <div id="atas">
            <span class="close">&times;</span>
            <h2>Pilih Nota Beli</h2>
            <hr>
            <input type="hidden" name="trans_id" id="trans_id">
            <input type="hidden" name="diskon" id="diskon">
            <input type="hidden" name="ppn" id="ppn">
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;"><label>No. Nota Beli</label></div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4">
                    <input class="textinput2" type="text" title="Isi dengan no. nota beli yg akan diretur dan kemudian enter." placeholder="Isi no. nota beli dan kemudian enter." name="no_nota_dialog" id="no_nota_dialog" value="" autocomplete="off" required>  
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;">Tanggal Nota Beli</div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4"><input class="textinput2" type="text" name="tgl_nota" id="tgl_nota" value="" autocomplete="off" required disabled="disabled"></div>
            </div>
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;">Nama Supplier</div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4"><input class="textinput2" type="text" name="nama_sup" id="nama_sup" value="" autocomplete="off" required disabled="disabled"></div>
            </div>
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;">Jumlah Nota Beli (Rp.)</div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4"><input class="textinput2" style="text-align: right;" type="text" name="jum" id="jum" value="" autocomplete="off" required disabled="disabled"></div>
            </div>
            <hr>
        </div>
    
        <div id="bawah" style="text-align: right;">
            <button id="tombol-tutup">Batal</button>
            <button id="tombol-pilih" <?php echo $st; ?> >Pilih</button>
        </div>
    </div>  

    <div id="modal-kotak" class="col-md-8 second">
        <div id="atas">
            <span class="close">&times;</span>
            <h2>Rincian Nota Pembelian</h2>
            <hr>
            <input type="hidden" name="trans_id" id="trans_id">
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;"><label>No. Nota Beli</label></div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4">
                    <input class="textinput2" type="text" title="Isi dengan no. nota beli yg akan diretur dan kemudian enter." placeholder="" disabled="" name="no_nota_dialog_view" id="no_nota_dialog_view" value="" autocomplete="off" required>  
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;">Tanggal Nota Beli</div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4"><input class="textinput2" type="text" name="tgl_nota_view" id="tgl_nota_view" value="" autocomplete="off" required disabled="disabled"></div>
            </div>
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;">Nama Supplier</div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4"><input class="textinput2" type="text" name="nama_sup_view" id="nama_sup_view" value="" autocomplete="off" required disabled="disabled"></div>
            </div>
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;">Diskon Nota (%)</div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4"><input class="textinput2" type="text" name="diskon_nota_view" id="diskon_nota_view" value="" autocomplete="off" required disabled="disabled"></div>
            </div>
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;">PPN Nota (%)</div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4"><input class="textinput2" type="text" name="ppn_nota_view" id="ppn_nota_view" value="" autocomplete="off" required disabled="disabled"></div>
            </div>
            <div class="row">
                <div class="col-md-3" style="padding-top:13px;">Jumlah Nota Beli (Rp.)</div><div class="col-md-1" style="padding-top:13px;">:</div>
                <div class="col-md-4"><input class="textinput2" style="text-align: right;" type="text" name="jum_view" id="jum_view" value="" autocomplete="off" required disabled="disabled"></div>
            </div>
            <hr>
        </div>
        <div id="bawah" style="text-align: right;padding-right: 20px;">
            <button id="tombol-tutup" class="kembali">Kembali</button>
        </div>
    </div>  
    <script type="text/javascript">
        var no_nota_retur = "";
        function get_nota(no_nota){
            var load = "detail";
            $.ajax({
                type : "POST", 
                url  : "<?php echo 'library/load_nota_beli.php'; ?>", 
                dataType : "JSON", 
                data : {no_nota:no_nota,load:load,userid:userid},
                success: function(data){
                    $("#load").hide();
                    datas = data['data'];
                    $('#kadal').dataTable().fnClearTable();
                    $('#kadal').dataTable().fnAddData(datas);
                    $("#no_nota_retur").val(data['no_retur']);
                    $("#supplier_id").val(data['sup']);
                    $("#setelah").html(data['ret']);
                    var c = data['no_retur'];
                    localStorage.x=c;
                    return c;
                },error: function() {
                    $("#load").hide();
                    alert('Jaringan gagal.');  
                }
            }); 

        }
        $(document).ready(function(){
            $(".sbbutton").css("width","100%");
            $('.tambahentry').on('click',function(){
                $("#no_nota_dialog").val("");
                $("#tgl_nota").val("");
                $("#nama_sup").val("");
                $("#jum").val("");
                $('.buat , #bg').fadeIn("slow");
            });
            $('#tombol-tutup').on('click',function(){
                $('.buat , #bg').fadeOut("slow");
            });

            $(".rincian").on('click',function(){
                var no_nota = $("#no_nota").val();
                var load = "nota";
                $("#load").show();
                $.ajax({
                    type : "POST", 
                    url  : "<?php echo 'library/load_nota_beli.php'; ?>", 
                    dataType : "JSON", 
                    data : {no_nota:no_nota,load:load,userid:userid},
                    success: function(data){
                        $("#load").hide();
                        if(data['item'] > 0){
                            $("#no_nota_dialog_view").val(no_nota);
                            $("#tgl_nota_view").val(data['tgl']);
                            $("#nama_sup_view").val(data['nama']);
                            $("#diskon_nota_view").val(data['diskon']);
                            $("#ppn_nota_view").val(data['ppn']);
                            $("#jum_view").val(data['tot']);
                            $(".second , #bg").fadeIn("slow");
                        }else{
                            $("#load").hide();
                            alert('Gagal load data nota.'); 
                        }
                    },error: function() {
                        $("#load").hide();
                        alert('Jaringan gagal.');  
                    }
                }); 
                
            });
            
            $(".kembali").on('click',function(){
                $(".second , #bg").fadeOut("slow");
            });

            $('#tombol-pilih').on('click',function(){
                $("#load").show();
                var no = $("#no_nota_dialog").val();
                var nm = $("#nama_sup").val();
                var tgl = $("#tgl_nota").val();
                var diskon = $("#diskon").val();
                var ppn = $("#ppn").val();
                var trans_id = $("#trans_id").val();
                var jum =  $("#jum").val();
                if(jum != "" && no != ""){
                    var no_nota_retur = localStorage.x;
                    $.ajax({
                        type : "POST", 
                        url  : "<?php echo 'library/simpan_buat_retur_beli.php'; ?>", 
                        dataType : "JSON", 
                        data : {no_nota_retur:no_nota_retur,trans_id:trans_id,userid:userid},
                        success: function(data){
                            if(data == "denied"){
                                $("#load").hide();
                                alert('Anda tidak memiliki akses untuk melakukan aksi ini.');
                                location.reload();
                            }else{
                                if(data == true){
                                    $("#tampil-tabel").hide();
                                    $("#no_nota").val(no);
                                    $("#tgl_nota_beli").val(tgl);
                                    $("#diskonx").val(diskon);
                                    $("#ppnx").val(ppn);
                                    $("#detailentry").show();
                                    $("#load").hide();
                                    $('#modal-kotak , #bg').fadeOut("slow");
                                }else{
                                    $("#load").hide();
                                    alert('Gagal membuat nota retur pembelian.'); 
                                }
                            }
                        },error: function() {
                            $("#load").hide();
                            alert('Jaringan gagal.');  
                        }
                    });        
                    
                }else{  
                    alert('Data nota beli belum dipilih.');
                    $("#load").hide();
                }
            });
            $('.close').on('click',function(){
                $('#modal-kotak , #bg').fadeOut("slow");
            });

            $(".buat_transaksi").on('click',function(){
                var no_nota_retur = $('#no_nota_retur').val();
                $.ajax({
                    type : "POST", 
                    url  : "<?php echo 'library/aksi_retur_beli.php?aksi=selesai'; ?>", 
                    dataType : "JSON", 
                    data : {no_nota_retur:no_nota_retur,userid:userid},
                    success: function(data){
                        if(data == "denied"){
                            $("#load").hide();
                            alert('Anda tidak memiliki akses untuk melakukan aksi ini.');
                            location.reload();
                        }else{
                            if(data['hasil'] == true){
                                location.reload();
                            }else if(data['hasil'] == "Kosong"){
                                $("#load").hide();
                                alert('Gagal menyelesaikan retur pembelian, anda belum input retur barang pada nota retur ini'); 
                            }else{
                                $("#load").hide();
                                alert('Gagal menyelesaikan retur pembelian.'); 
                                location.reload();
                            }
                        }
                    },error: function() {
                        $("#load").hide();
                        alert('Jaringan gagal.');  
                    }
                }); 
            });

            $('#no_nota_dialog').keypress(function(event) {
                if (event.keyCode == 13) {
                    var no_nota = $(this).val();
                    var load = "nota";
                    $("#load").show();
                    $.ajax({
                        type : "POST", 
                        url  : "<?php echo 'library/load_nota_beli.php'; ?>", 
                        dataType : "JSON", 
                        data : {no_nota:no_nota,load:load,userid:userid},
                        success: function(data){
                            $("#load").hide();
                            if(data['item'] > 0){
                                $("#tgl_nota").val(data['tgl']);
                                $("#nama_sup").val(data['nama']);
                                $("#trans_id").val(data['id']);
                                $("#jum").val(data['tot']);
                                $("#diskon").val(data['diskon']);
                                $("#ppn").val(data['ppn']);
                                $("#item").html(data['item']+" Item");
                                $("#sebelum").html(data['tot']);
                                get_nota(no_nota);
                            }else{
                                $("#load").hide();
                                alert('Data nota beli tidak ditemukan.'); 
                            }
                        },error: function() {
                            $("#load").hide();
                            alert('Jaringan gagal.');  
                        }
                    });                
                }
            });

        });

        $(('.cleaveuang')).toArray().forEach(function(field){
            var cleaveUangRupiah = new Cleave(field, {
                numeral: true,
                numeralDecimalMark: '.',
                delimiter: ',',
                numeralPositiveOnly: true
            });
        });
        

    function filter_data(tmp_barcode){
        var x = tmp_barcode.filter(function (el) {
              return el != "";
        });

        return x;

    }

    set_table(datas);
    function set_table(datas){
        var tmp_barcode = [];
        var dt_tbl = $("#kadal").DataTable({
            data:datas,
            autoWidth: false,
            columns:[
                {title:"No.",width: "5%","className": "dt-center"},
                {title:"Kode",width: "15%"},
                {title:"Nama Bahan Baku",width: "50%"},
                {title:"Qty Beli",width: "20%","className": "dt-center"},
                {title:"Harga Modal (Rp.)",width: "10%"},
                {title:"Max. Qty Retur",width: "10%"},
                {title:"Qty Retur",width: "5%"},
                {title:"Harga Retur (Rp.)",width: "10%"},
                {title:"Aksi",width: "5%","className": "dt-center"}
            ],
            "columnDefs": [ {
                "targets": "_all",
                "createdCell": function (td, cellData, rowData, row, col, input) {
                    $(td).css("width","0px");
                    $(td).css("padding","0px");
                }
              }
              ],
            pageLength: 5,
            "fnDrawCallback": function( oSettings ) {
                $(('.cleaveuang')).toArray().forEach(function(field){
                    var cleaveUangRupiah = new Cleave(field, {
                        numeral: true,
                        numeralDecimalMark: '.',
                        delimiter: ',',
                        numeralPositiveOnly: true
                    });
                });
           },
            stateSave: true
        });

        $("#kadal").find("td").css("width","0px");
        $("#kadal").find("td").css("padding","1px");
    }

    $('#kadal').on( 'click', 'td .tambah_retur', function () {
        $("#load").show();
        var id_bb = $(this).attr("data-id");
        var id_pembelian = $(this).attr("data-pembelian");
        var q_ret = $('#qty_retur'+id_bb).val().replace(/\,/g, '');
        var no_nota_retur = $('#no_nota_retur').val();
        var max_ret = $('#max_qty'+id_bb).val();
        var h_ret = $('#harga_retur'+id_bb).val().replace(/\,/g, '');
        var max_h_ret = $('#harga'+id_bb).val().replace(/\,/g, '');
        var tot_setelah_retur = $('#setelah').text().replace(/\,/g, '');
        if(q_ret == 0 || q_ret == ""){
            alert("Qty Retur harus diisi tidak boleh kosong atau 0.");
            $('#qty_retur'+id_bb).focus();
            $("#load").hide();
        }else if(h_ret == 0 || h_ret == ""){
            alert("Harga Retur harus diisi tidak boleh kosong atau 0.");
            $('#harga_retur'+id_bb).focus();
            $("#load").hide();
        }else if(Number(max_ret) < Number(q_ret)){
            alert("Qty Retur tidak boleh melebihi maksimal qty retur.");
            $('#qty_retur'+id_bb).focus();
            $("#load").hide();
        }else if(Number(max_h_ret) < Number(h_ret)){
            alert("Harga Retur tidak boleh melebihi harga modal.");
            $('#harga_retur'+id_bb).focus();
            $("#load").hide();
        }else{
            if(Number(q_ret) < 0){
                $("#load").hide();
                alert("Qty retur tidak boleh minus.");
            }else if(Number(h_ret) < 0){
                $("#load").hide();
                alert("Harga retur tidak boleh minus.");
            }else{
                var tot_retur = $("#tot_retur").val().replace(/\,/g, '');
                $.ajax({
                    type : "POST", 
                    url  : "<?php echo 'library/aksi_retur_beli.php?aksi=simpan'; ?>", 
                    dataType : "JSON", 
                    data : {no_nota_retur:no_nota_retur,id_pembelian:id_pembelian,qty_retur:q_ret,harga_retur:h_ret,max_ret:max_ret,harga_modal:max_h_ret,tot_retur:tot_retur,tot_setelah_retur:tot_setelah_retur,userid:userid},
                    success: function(data){
                        if(data == "denied"){
                            $("#load").hide();
                            alert('Anda tidak memiliki akses untuk melakukan aksi ini.');
                            location.reload();
                        }else{
                            if(data['duplikat'] == true){
                                $("#load").hide();
                                alert('Data Retur sudah ada.'); 
                                location.reload();
                            }else{
                                if(data['perubahan'] == true){
                                    $("#load").hide();
                                    alert('Data Nota telah terjadi perubahan.'); 
                                    location.reload();
                                }else{
                                    if(data['hasil'] == true){
                                        $('#harga_retur'+id_bb).attr("disabled","");
                                        $("#retur"+id_bb).attr("data-id_detail",data['id']);
                                        $('#qty_retur'+id_bb).attr("disabled","");
                                        $("#retur"+id_bb).addClass("hapus_retur").removeClass("tambah_retur");
                                        $("#retur"+id_bb).addClass("btn-danger").removeClass("btn-default");
                                        $("#aksi"+id_bb).html("Hapus");
                                        $("#tot_retur").val(data['ret']);
                                        $("#setelah").html(data['setelah_retur']);
                                        $("#load").hide();
                                    }else{
                                        $("#load").hide();
                                        alert('Gagal tambah retur pembelian.'); 
                                        location.reload();
                                    }
                                }
                            }
                        }
                    },error: function() {
                        $("#load").hide();
                        alert('Jaringan gagal.');  
                    }
                });  
            }      
        }
    });

     $('#kadal').on( 'click', 'td .hapus_retur', function () {
        $("#load").show();
        var result = confirm("Anda yakin akan membatalkan retur ini ?");
        if (result) {
            var id_bb = $(this).attr("data-id");
            var id_pembelian = $(this).attr("data-pembelian");
            var no_nota_retur = $('#no_nota_retur').val();
            var q_ret = $('#qty_retur'+id_bb).val().replace(/\,/g, '');
            var h_ret = $('#harga_retur'+id_bb).val().replace(/\,/g, '');
            var tot_retur = $('#tot_retur').val().replace(/\,/g, '');
            var tot_setelah_retur = $("#setelah").text().replace(/\,/g, '');
            $.ajax({
                type : "POST", 
                url  : "<?php echo 'library/aksi_retur_beli.php?aksi=batal'; ?>", 
                dataType : "JSON", 
                data : {no_nota_retur:no_nota_retur,id_pembelian:id_pembelian,qty_retur:q_ret,harga_retur:h_ret,tot_setelah_retur:tot_setelah_retur,tot_retur:tot_retur,userid:userid},
                success: function(data){
                    if(data == "denied"){
                        $("#load").hide();
                        alert('Anda tidak memiliki akses untuk melakukan aksi ini.');
                        location.reload();
                    }else{
                        if(data['hasil'] == true){
                            $('#harga_retur'+id_bb).removeAttr("disabled");
                            $('#qty_retur'+id_bb).removeAttr("disabled");
                            $('#harga_retur'+id_bb).val("0");
                            $('#qty_retur'+id_bb).val("0");
                            $("#retur"+id_bb).addClass("tambah_retur").removeClass("hapus_retur");
                            $("#retur"+id_bb).addClass("btn-default").removeClass("btn-danger");
                            $("#aksi"+id_bb).html("Tambah");
                            $("#setelah").html(data['setelah_retur']);
                            $("#tot_retur").val(data['ret']);
                            $("#load").hide();
                        }else{
                            $("#load").hide();
                            alert('Gagal membatalkan retur pembelian.'); 
                            location.reload();
                        }
                    }
                },error: function() {
                    $("#load").hide();
                    alert('Jaringan gagal.');  
                }
            }); 
        }else{
            $("#load").hide();
        }
    });
   
    </script>
</body>
</html>