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
    <link rel="stylesheet" type="text/css" href="css/select2.css">
    
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/cleave.min.js"></script>
    <script type="text/javascript" src="script/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="script/select2.js"></script>
    <script>
        var idx = "";
        var data_cetak = [];
        function cek_transaksi(idx){
            var userid = '<?php echo $userid; ?>';
            var transaksi_id = $("#id_nota").val();
            $.ajax({
                type : "POST", 
                url  : "<?php echo 'library/cek_transaksi.php'; ?>", 
                dataType : "JSON", 
                data : {userid:userid,transaksi_id:transaksi_id,idx:idx},
                success: function(data){
                        if(data != "5"){
                        if(data['count'] > 0){
                            if(idx == ""){
                                $(".barcode-cetak").hide();
                                $("#jdl").html("<i class='fas fa-balance-scale'></i> Tambah data transaksi");
                            }else{
                                var xx = idx.split("#");
                                if(xx[1] == "lihat"){
                                    $(".barcode-cetak").hide();
                                $   ("#jdl").html("<i class='fas fa-balance-scale'></i> Lihat data transaksi");
                                }else{
                                    $("#judulbtn").html("Simpan");
                                    $(".barcode-cetak").show();
                                    $(".simpantransaksi").show();
                                    $("#jdl").html("<i class='fas fa-balance-scale'></i> Ubah data transaksi");
                                }
                            }
                            $(".detail_box").show();
                            $("#tampil-tabel").hide();
                            $(".detailentry").show();
                            $("#no_nota").val(data['no_nota']);
                            $("#no_nota").attr("disabled","");
                            $("#id_nota").val(data['id']);
                            $("#disc").val(data['disc']);
                            $("#ppn").val(data['ppn']);
                            $("#item").html(data['item']+" Bahan Baku");
                            $("#sebelum").html(data['jum']);
                            $("#setelah").html(data['tot']);
                            $("#total").html(data['tot']);
                            $("#jumx").val(data['jum'].split(",").join(""));
                            $("#totx").val(data['tot'].split(",").join(""));
                            $("#itemx").val(data["item"]);
                            $(".cinput").attr("disabled","");
                            $("#pelanggan_id").attr("disabled","");
                            $("#supplier_id").attr("disabled","");
                            if(data['tipe'] == "0"){
                                $("#tipe").attr("checked","checked");
                                $("#supplier_id").val(data['user_transaksi']);
                                $("#tipe1").removeAttr("checked");
                            }else{
                                $("#tipe1").attr("checked","checked");
                                $("#tipe").removeAttr("checked");
                                $("#pelanggan_id").val(data['user_transaksi']);
                            }

                            if(data['status'] == "0"){
                                $("#st").attr("checked","checked");
                                $("#st1").removeAttr("checked");
                            }else{
                                $("#st1").attr("checked","checked");
                                $("#st").removeAttr("checked");
                            }
                            var len;
                            if(data['data_mat'] != null){
                                for(len=0;len<data['data_mat'].length;len++){
                                    $('#jumlah'+data['data_mat'][len].material_id).attr("data-id_beli",data['data_mat'][len].pembelian_id);
                                    $("#jumlah"+data['data_mat'][len].material_id).attr("disabled","");
                                    $("#jum_setelah_diskon"+data['data_mat'][len].material_id).attr("disabled","");
                                    $("#jum_sebelum_diskon"+data['data_mat'][len].material_id).attr("disabled","");
                                    $("#disc_mat"+data['data_mat'][len].material_id).attr("disabled","");
                                    $("#harga"+data['data_mat'][len].material_id).attr("disabled","");
                                    $("#jumlah"+data['data_mat'][len].material_id).val(data['data_mat'][len].jumlah);
                                    $("#harga"+data['data_mat'][len].material_id).val(data['data_mat'][len].pembelian_harga);
                                    $("#jum_setelah_diskon"+data['data_mat'][len].material_id).val(data['data_mat'][len].pembelian_total);
                                    $("#jum_sebelum_diskon"+data['data_mat'][len].material_id).val(data['data_mat'][len].pembelian_tot);
                                    $("#disc_mat"+data['data_mat'][len].material_id).val(data['data_mat'][len].pembelian_diskon);
                                    $('table tr td #jumlah'+data['data_mat'][len].material_id).css("background-color","#80808063");
                                    $('table tr td #harga'+data['data_mat'][len].material_id).css("background-color","#80808063");
                                    $('table tr td #disc_mat'+data['data_mat'][len].material_id).css("background-color","#80808063");
                                    $('table tr td #jum_setelah_diskon'+data['data_mat'][len].material_id).css("background-color","#80808063");
                                    $('table tr td #jum_sebelum_diskon'+data['data_mat'][len].material_id).css("background-color","#80808063");
                                    $('.cb'+data['data_mat'][len].material_id).attr("checked","checked");
                                    $('.cleaveuang').toArray().forEach(function(field){ var cleaveUangRupiah = new Cleave(field, { numeral: true, numeralDecimalMark: '.', delimiter: ',' });
                                    });
                                    var code = data["data_mat"][len].material_barcode;
                                    if($.inArray(code,data_cetak) === -1){
                                        data_cetak.push(code);
                                    }
                                    //console.log(""+data_cetak);
                                }
                            }

                            $(".buat_transaksi").attr("disabled","");
                            $("#detail_transaksi").fadeIn(1000);
                            $("#tabel-data2_wrapper").css("position","static");
                            $(".cinput").attr("disabled",true);
                            $("#load").hide();
                        }else{
                            $("#load").hide();
                            $(".detailentry").hide();
                            $(".detailbox").hide();
                        }
                    }else{
                        alert("Data nota tidak ada.")
                        $("#load").hide();
                        $(".detailentry").hide();
                        $(".detailbox").hide();
                    }
                }
            });

        }
        $(document).ready(function(){
            var idx = "";
            $(".detail_box").hide();
            var a = '<?php if(!isset($_SESSION["err"])){ echo ""; }else{ echo $_SESSION["err"]; } $_SESSION["err"]=""; ?>';
            if(a == 1){
                $("#alert").html('<div class="alert alert-success fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Success!</strong> berhasil tambah data. </div>');
            }else if(a == 2){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> data yang akan anda masukkan sudah ada. </div>');
            }else if(a == 3){
                $("#alert").html('<div class="alert alert-success fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> gagal tambah data. </div>');
            }else if(a == 4){
                $("#alert").html('<div class="alert alert-success fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Success!</strong> berhasil ubah data. </div>');
            }else if(a == 5){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> gagal ubah data. </div>');
            }else if(a == 6){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> data yang akan anda ubah sudah tidak ada. </div>');
            }else if(a == 7){
                $("#alert").html('<div class="alert alert-success fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Success!</strong> berhasil hapus data. </div>');
            }else if(a == 8){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> gagal hapus data. </div>');
            }else if(a == 9){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> data yang akan anda hapus sudah tidak ada. </div>');
            }else if(a == 10){
                $("#alert").html('<div class="alert alert-danger fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <strong>Error!</strong> anda tidak mempunyai akses untuk melakukan aksi ini. </div>');
            }

            $(".alert").on('click',function(){
                $(this).hide();
            });
            setTimeout(function(){ $(".alert").hide(); }, 8000);
            $("#pelanggan_id").val(1);
            cek_transaksi(idx);
            $(".tambahentry").on('click',function(){
                $("#tampil-tabel").hide();
                $("#jdl").html("<i class='fas fa-balance-scale'></i> Tambah data transaksi");
                $(".detailentry").show();
                if($("#tipe").is(':checked')) {
                    nonota_otomatis(0);
                    $("#supplier_id").removeAttr("disabled");
                    $("#jdl_btn").removeAttr("disabled");
                }else{
                    alert("gak ceklist");
                    $("#supplier_id").attr("disabled","");
                }
            });

            $(".transaksi_batal").on('click',function(){
                var id = $("#id_nota").val();
                var tanda = $("#judulbtn").text();
                if(id == "" || tanda == "Simpan" || idx != ""){
                    $("#jdl").html("<i class='fas fa-balance-scale'></i> Tambah data transaksi");
                    $("#tampil-tabel").show();
                    $(".detailentry").hide();
                }else{
                    var result = confirm("Masih ada transaksi yang belum disimpan, Anda yakin akan membatalkan nya ?");
                    if (result) {
                        $("#load").show();
                        var id = $("#id_nota").val();
                        if($("#tipe").is(':checked')) {
                            var tipe = $("#tipe").val();
                        }else{
                            var tipe = $("#tipe1").val();
                        }
                        var userid = '<?php echo $userid; ?>';
                        $.ajax({
                            type : "POST", 
                            url  : "<?php echo 'library/batal_nota.php'; ?>", 
                            dataType : "JSON", 
                            data : {id:id,tipe:tipe,userid:userid},
                            success: function(data){
                                if(data == "denied"){
                                    $("#load").hide();
                                    alert('Anda tidak memiliki akses untuk melakukan aksi ini.');
                                    location.reload();
                                }else{
                                    if(data == true){
                                        $("#load").hide();
                                        location.reload();
                                    }else{
                                        $("#load").hide();
                                        alert('Pembatalan transaksi gagal.');  
                                    }
                                }
                            },error: function() {
                                $("#load").hide();
                                alert('Pembatalan transaksi gagal.');  
                            }
                        });return false;
                    }else{
                        $("#load").hide();
                    }
                }
            });

            $(".datalookup").click(function(){
               $("#tampil-tabel").hide();
                $("#jdl").html("<i class='fas fa-balance-scale'></i> Ubah data transaksi");
                $(".detailentry").show();
                if($("#tipe").is(':checked')) {
                    //nonota_otomatis(0);
                    $("#supplier_id").removeAttr("disabled");
                    $("#jdl_btn").removeAttr("disabled");
                }else{
                    $("#supplier_id").attr("disabled","");
                }
                $(".simpantransaksi").hide();
                
                idx = $(this).attr("data-id")+"#lihat";
                cek_transaksi(idx);
                
                $(".barcode-cetak").hide();
                $("#jdl").html("<i class='fas fa-balance-scale'></i> Lihat data transaksi");
                console.log(idx);
                $("#jnsklik").val(idx);
            });

            $(".dataedit").click(function(){
                $("#tampil-tabel").hide();
                $("#jdl").html("<i class='fas fa-balance-scale'></i> Ubah data transaksi");
                $(".detailentry").show();
                if($("#tipe").is(':checked')) {
                    //nonota_otomatis(0);
                    $("#supplier_id").removeAttr("disabled");
                    $("#jdl_btn").removeAttr("disabled");
                }else{
                    $("#supplier_id").attr("disabled","");
                }
                idx = $(this).attr("data-id")+"#ubah";
                cek_transaksi(idx);
                $("#jnsklik").val(idx);
            });

            $(".boxsubmit").on('click',function(){
                $("#load").show();
            });
            $(".boxsubmit").on('click',function(){
                $("#load").show();
                $("#jdl").html("<i class='fas fa-user-check'></i> Ubah data transaksi");
                $("#id").val($("#id_view").val());
                $("#nama_transaksi").val($("#nama_view").text());
                $("#tipe_transaksi").val($("#tipe_transaksi_view").text());
                $("#alamat_transaksi").val($("#alamat_view").text());
                $("#opt_transaksi").val($("#opt_view").text());
                $("#jdl_btn").val("Ubah transaksi");
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
                var result = confirm("Anda yakin akan menghapus data transaksi ("+nama+") ?");
                if (result) {  
                    $.ajax({
                        type : "POST", 
                        url  : "<?php echo 'library/delete_transaksi.php'; ?>", 
                        dataType : "JSON", 
                        data : {id:id,opt:opt},
                        success: function(data){
                            if(data == true){
                                //location.reload();
                            }else{
                                //location.reload();
                            }
                        },error: function() {
                            //location.reload();
                        }
                    });return false;
                }else{
                    $("#load").hide();
                }
            });

            $("#pelanggan_id").attr("disabled","");

            var tipe ="";
            /*$("#tipe1").on('click',function(){
                if($(this).val() == "1"){
                    $("#load").show();
                    tipe = 1;
                    nonota_otomatis(1);
                    $("#supplier_id").attr("disabled","");
                    $("#pelanggan_id").removeAttr("disabled");
                    $("#jdl_btn").removeAttr("disabled");
                    console.log($(this).val());
                }else{
                    $("#supplier_id").removeAttr("disabled");
                    $("#pelanggan_id").attr("disabled","");
                    console.log($(this).val());
                }
            });*/

            $("#tipe").on('click',function(){
                if($(this).val() == "0"){
                    $("#load").show();
                    tipe = 0;
                    nonota_otomatis(0);
                    $("#pelanggan_id").attr("disabled","");
                    $("#supplier_id").removeAttr("disabled");
                    $("#jdl_btn").removeAttr("disabled");
                }else{
                    $("#pelanggan_id").removeAttr("disabled");
                    $("#supplier_id").attr("disabled","");
                }
            });

            if($("#tipe").attr("checked")){
                $("#pelanggan_id").attr("disabled","");
            }else{
                $("#supplier_id").attr("disabled","");
            }


            $("#jdl_btn").attr("disabled","");
            $("#detail_transaksi").hide();
            $(".buat_transaksi").on('click',function(){
                if($("#st1").is(':checked')) {
                    var jenis_nota = $("#st1").val();
                }else{
                    var jenis_nota = $("#st").val();
                }
                var no_nota = $("#no_nota").val();
                var disc = $("#disc").val();
                var ppn = $("#ppn").val();
                var opt = '<?php echo $userid; ?>';
                
                if(tipe == 0){
                    var supplier = $("#supplier_id").val();
                    if(supplier != ""){
                        $("#load").show();
                        buat_nota(tipe,no_nota,jenis_nota,supplier,opt,disc,ppn);
                    }else{
                        alert('Pilih supplier untuk melanjutkan pembuatan nota.');
                        $("#load").hide();
                    }
                }else if(tipe == 1){
                    var pelanggan = $("#pelanggan_id").val();
                    console.log(pelanggan);
                    if(pelanggan != ""){
                        $("#load").show();
                        buat_nota(tipe,no_nota,jenis_nota,pelanggan,opt,disc,ppn);
                    }else{
                        alert('Pilih pelanggan untuk melanjutkan pembuatan nota.');
                        $("#load").hide();
                    }
                }else{
                    alert('Pilih tipe transaksi dahulu.');
                    $("#load").hide();
                }
            });

            $(".simpantransaksi").on('click', function(){
                var tanda = $("#judulbtn").text();
                $("#load").show();
                var id = $("#id_nota").val();
                //alert(id);
                var st = 1;
                var userid = '<?php echo $userid; ?>';
                $.ajax({
                    type : "POST", 
                    url  : "<?php echo 'library/transaksi_selesai.php'; ?>", 
                    dataType : "JSON", 
                    data : {st:st,id:id,userid:userid},
                    success: function(data){
                        if(data == "denied"){
                            $("#load").hide();
                            alert('Anda tidak memiliki akses untuk melakukan aksi ini.');
                            location.reload();
                        }else if(data == null){
                            $("#load").hide();
                            alert('Anda belum memilih barang pada transaksi.');
                        }else{
                            if(data == true){
                                $("#load").hide();
                                /*$("#jumlah"+value).removeAttr("disabled");
                                $("#jumlah"+value).val("");
                                $('#jumlah'+value).css("background-color","");
                                $("#jumlah"+value).attr("data-id_beli","");
                                //if($(this).is(":checked")){
                                   $(".cb"+value).removeAttr("checked"); */
                                //}
                                if(tanda != "Simpan"){
                                    var dt_fix = filter_data(tmp_barcode);
                                    if(dt_fix.length > 0){
                                        window.open('barcode/index.php?data='+dt_fix, '_blank');
                                    }
                                }
                                location.reload();
                            }else{
                                $("#load").hide();
                                alert('Gagal simpan transaksi.');  
                            }
                        }
                        $("#load").hide();
                    },error: function() {
                        alert("Gagal simpan transaksi.");
                        $("#load").hide();
                    }
                });
            });

            $("#editfield").on('dblclick',function(){
                $("#disc").removeAttr("disabled");
                $("#ppn").removeAttr("disabled");
            });

            $('#disc').keypress(function(event) {
                if (event.keyCode == 13) {
                    $("#load").show();
                    $("#disc").attr("disabled","disabled");
                    $("#ppn").attr("disabled","disabled");
                    $("#load").show();
                    var id = $("#id_nota").val();        
                    var disc = $("#disc").val();         
                    var ppn = $("#ppn").val();         
                    var opt = '<?php echo $userid; ?>';  
                    ubah_transaksi(id,opt,disc,ppn);
                }
            });
            $('#ppn').keypress(function(event) {
                if (event.keyCode == 13) {
                    $("#load").show();
                    $("#disc").attr("disabled","disabled");
                    $("#ppn").attr("disabled","disabled");
                    $("#load").show();
                    var id = $("#id_nota").val();        
                    var disc = $("#disc").val();         
                    var ppn = $("#ppn").val();         
                    var opt = '<?php echo $userid; ?>';  
                    ubah_transaksi(id,opt,disc,ppn);
                }
            });

        });

        function ubah_transaksi(id,opt,disc,ppn){
            $.ajax({
                type : "POST", 
                url  : "<?php echo 'library/ubah_transaksi.php'; ?>", 
                dataType : "JSON", 
                data : {id:id,opt:opt,disc:disc,ppn:ppn},
                success: function(data){
                    if(data != "5"){
                        if(data == true){
                            $("#load").hide();
                            cek_transaksi(idx);
                            //location.reload();
                        }else{
                            $("#load").hide();
                            alert("Gagal ubah diskon dan ppn nota.");
                            //location.reload();
                        }
                    }else{
                        alert("Gagal, nota pembelian tidak ditemukan atau nota pembelian tersebut telah dibatalkan.");
                        $("#load").hide();
                        location.reload();
                    }
                },error: function() {
                    $("#load").hide();
                    alert("Gagal ubah diskon dan ppn nota.");
                    //location.reload();
                }
            });
        }

        function nonota_otomatis(tipe){
            $.ajax({
                type : "POST", 
                url  : "<?php echo 'library/buat_nomor_nota.php'; ?>", 
                dataType : "JSON", 
                data : {tipe:tipe},
                success: function(data){
                    $("#no_nota").val(data);
                    $("#no_nota").attr("disabled","");
                    $("#load").hide();
                },error: function() {
                    alert("Gagal buat nomor nota.");
                    $("#load").hide();
                }
            });

        }

        function buat_nota(tipe,no_nota,jenis_nota,user_transaksi,opt,disc,ppn){
            $.ajax({
                type : "POST", 
                url  : "<?php echo 'library/buat_nota.php'; ?>", 
                dataType : "JSON", 
                data : {tipe:tipe,no_nota:no_nota,jenis:jenis_nota,user_transaksi:user_transaksi,userid:opt,disc:disc,ppn:ppn},
                success: function(data){
                    if(data['st'] == true){
                        if(tipe == 0) {
                            $("#supplier_id").attr("disabled","");
                        }else{
                            $("#pelanggan_id").attr("disabled","");
                        }
                        $(".detail_box").show();
                        $("#item").html("0 Bahan Baku");
                        $("#sebelum").html("0");
                        $("#setelah").html("0");
                        $("#total").html("0");
                        $(".buat_transaksi").attr("disabled","");
                        $("#detail_transaksi").fadeIn(1000);
                        $("#tabel-data2_wrapper").css("position","static");
                        $("#id_nota").val(data['id']);
                        $(".cinput").attr("disabled",true);
                        $("#load").hide();
                    }else if(data == "2"){
                        alert("Gagal buat nomor nota.");
                        $("#load").hide();
                    }else if(data == "3"){
                        alert("Gagal buat nomor nota, nota sudah ada.");
                        $("#load").hide();
                        //location.reload();
                    }else if(data == "4"){
                        alert("Gagal buat nomor nota, anda tidak memiliki akses untuk melakukan transaksi ini.");
                        $("#load").hide();
                        //location.href="dashboard.php";
                    }
                },error: function() {
                    alert("Gagal buat nomor nota.");
                    $("#load").hide();
                }
            });
        }

        function validateNumber(event) {
            var key = window.event ? event.keyCode : event.which;
            if ( key < 48 || key > 57 ) {
                return false;
            } else {
                return true;
            }
        };

        function enable_field(){
        }

    </script>
    <style type="text/css">
        .entryfield2{
            margin-right: 15px!important;
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
        <div class="navcontainer">
            <div class="navleft">
                <h2 class="headnavigation"><?php echo strtoupper("$userjob") ?> <redfont>/</redfont> <?php echo $usernamalengkap ?></h2>
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Transaksi</h5>
            </div>
        </div>
        <hr class="hrred">
            <div class="dashcontainer1">
                <div id="alert"></div>
            <?php
                if(isset($_POST['search']))
                {
                    $halaman = 10; /* page halaman*/
                    $page =isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                    $mulai =($page>1) ? ($page * $halaman) - $halaman : 0;
                    
                    $valueToSearch = $_POST['valueToSearch'];
                    $query = "SELECT * FROM transaksi LEFT JOIN pelanggan ON transaksi.pelanggan_id=pelanggan.pelanggan_id LEFT JOIN supplier ON transaksi.supplier_id=supplier.supplier_id WHERE CONCAT(supplier_nama, pelanggan_nama, transaksi_tipe)  LIKE '%".$valueToSearch."%' LIMIT $mulai, $halaman";
                    $search_result = filterTable($query);

                    $total_pages_sql = "SELECT count(*) FROM transaksi LEFT JOIN pelanggan ON transaksi.pelanggan_id=pelanggan.pelanggan_id LEFT JOIN supplier ON transaksi.supplier_id=supplier.supplier_id WHERE CONCAT(supplier_nama, pelanggan_nama, transaksi_tipe)  LIKE '%".$valueToSearch."%'";
                    $hasil = mysqli_query($db,$total_pages_sql);
                    @$total_rows = mysqli_fetch_array($hasil)[0];
                    $total_pages = ceil($total_rows / $halaman);
                } else {
                    $halaman = 10; /* page halaman*/
                    $page =isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                    $mulai =($page>1) ? ($page * $halaman) - $halaman : 0;
                    
                    $query = "SELECT * FROM transaksi LEFT JOIN pelanggan ON transaksi.pelanggan_id=pelanggan.pelanggan_id LEFT JOIN supplier ON transaksi.supplier_id=supplier.supplier_id LIMIT $mulai, $halaman";
                    $search_result = filterTable($query);
                    
                    $total_pages_sql = "SELECT COUNT(*) FROM transaksi LEFT JOIN pelanggan ON transaksi.pelanggan_id=pelanggan.pelanggan_id LEFT JOIN supplier ON transaksi.supplier_id=supplier.supplier_id";
                    $hasil = mysqli_query($db,$total_pages_sql);
                    @$total_rows = mysqli_fetch_array($hasil)[0];
                    $total_pages = ceil($total_rows / $halaman);

                }
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
                        <?php if(cek_hak_akses_aksi_submenu($userid,19,"user_tambah") > 0 ){ ?>
                            <div class="formsubmit tambahentry" style="position:absolute; float:right; z-index:50;"><h5><i class="fas fa-plus fas2"></i> Tambah data transaksi</h5></div>
                        <?php } ?>
                        <thead>
                            <tr>
                                <th style="text-align:center;">No.</th>
                                <th style="text-align:center;">Tanggal Nota</th>
                                <th style="text-align:center;">Tipe Transaksi</th>
                                <th style="text-align:center;">Nota Transaksi</th>
                                <th style="text-align:center;">Status Nota</th>
                                <th style="text-align:center;">Terakhir Ubah</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px!important;">
                        <?php while($row = mysqli_fetch_assoc($search_result)): $mulai++; ?>
                            <tr>
                                <td style="width:3%;text-align: center;"><?php echo $mulai;?>.</td>
                                <td style="width:20%;"><?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?></td>
                                <td style="width:10%;"><?php if($row['transaksi_tipe'] == 0){ echo "Pembelian"; }?></td>
                                <td style="width:20%;"><?php echo $row['transaksi_nota'];?></td>
                                <td style="width:8%;text-align:center;"><?php if($row['transaksi_status'] == 1){ echo "<span class='badge_status_aktif'>Lunas</span>"; }else{ echo "<span class='badge_status_non_aktif'>Kredit</span>"; }?></td>
                                <td style="width:15%;text-align:center;"><?php $tg=explode(" ",$row['transaksi_tdiubah']); echo date('d/m/Y',strtotime($tg[0]))." ".$tg[1];?></td>
                                <td style="width:20%;text-align:center;"><h4>
                                    <?php if(cek_hak_akses_aksi_submenu($userid,19,"user_lihat") > 0 ){ ?>
                                    <a class="datalookup" style="cursor:pointer;" data-id="<?php echo $row['transaksi_id'];?>" data-nama="<?php echo $row['transaksi_nama'];?>" data-alamat="<?php echo $row['transaksi_alamat'];?>" data-tipe="<?php echo $row['transaksi_tipe'];?>" data-status="<?php echo $row['transaksi_status'];?>" data-opt="<?php echo $row['transaksi_opid'];?>"><i class="fas fa-list fas2"></i> Lihat data</a>
                                    <?php } ?>
                                    &nbsp;
                                    <?php if(cek_hak_akses_aksi_submenu($userid,19,"user_ubah") > 0 ){ ?>
                                      <a class="dataedit" data-id="<?php echo $row['transaksi_id'];?>" style="cursor:pointer;color:#EA2027;" ><i class="fas fa-edit fas2"></i> Ubah Nota</a>
                                    <?php } ?>
                                    &nbsp;
                                    <?php if(cek_hak_akses_aksi_submenu($userid,19,"user_tambah") > 0 ){ ?>
                                      <a class="" target="_blank" href="barcode/nota_beli.php?kode=<?php echo $row['transaksi_nota'];?>&id=<?php echo $row['transaksi_id'];?>&cetak=<?php echo nama_opt($userid); ?>" style="cursor:pointer;color:#EA2027;" ><i class="fas fa-print fas2"></i> Cetak Nota</a>
                                    <?php } ?>
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
            <div class="detailentry" id="detailentry">
                <h3 class="headnavigation"><redfont><div id="jdl"></div></redfont></h3>
                <br>
                <div class="boxentry">
                <div class="entryfield2" style="width: auto;">
                    <input type="hidden" name="opt" id="opt" value="<?php echo $userid; ?>">
                    <h5 class="headnavigation">Tipe Transaksi <redfont><i></i></redfont></h5>
                    <div id="rd">
                    <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                        <label class="checkboxlabel"><h5 class="headnavigation">Pembelian</h5>
                          <input class="cinput" type="radio" name="tipe" id="tipe" value="0" checked="checked">
                          <span class="checkmark"></span>
                        </label>
                        <!-- <label class="checkboxlabel"><h5 class="headnavigation">Penjualan</h5>
                          <input class="cinput" type="radio" name="tipe" id="tipe1" value="1">
                          <span class="checkmark"></span>
                        </label> -->
                    </div>
                    </div><br><br><br>
                    <h5 class="headnavigation" style="margin-top: 10px;"><redfont><i></i></redfont></h5>
                    <button class="formsubmit buat_transaksi" id="jdl_btn">Buat transaksi</button>
                    <div class="formsubmitcancel transaksi_batal"style="cursor: pointer;"><h5>Batal</h5></div><br><br><br>
                    <input type="hidden" name="id_nota" id="id_nota" value="">
                </div>
                <div class="entryfield2" style="width: auto;">
                    <h5 class="headnavigation">No. Nota <redfont><i></i></redfont></h5>
                    <input class="textinput2" type="text" name="no_nota" id="no_nota" value="" autocomplete="off" required><br>
                    <h5 class="headnavigation">Supplier (<redfont><i>Harus Dipilih</i></redfont>)</h5>
                    <select class="textinput2 select2" name="supplier_id" id="supplier_id">
                        <option value="">== Pilih Supplier ==</option>
                        <?php $qq1 = mysqli_query($db,"select * from supplier order by supplier_nama asc"); 
                        while ($data_sup = mysqli_fetch_assoc($qq1)){ ?>
                        <option id="opt<?php echo $data_sup['supplier_id']; ?>" value="<?php echo $data_sup['supplier_id']; ?>"><?php echo $data_sup['supplier_nama']; ?></option>
                        <?php } ?>
                    </select><br><br><br>
                </div>
                <div class="entryfield2" style="width: auto;">
                    <h5 class="headnavigation">Status transaksi <redfont><i></i></redfont></h5>
                    <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                        <label class="checkboxlabel"><h5 class="headnavigation">Lunas</h5>
                          <input class="cinput" type="radio" checked="checked" name="st" id="st1" value="1">
                          <span class="checkmark"></span>
                        </label>
                        <label class="checkboxlabel"><h5 class="headnavigation">Kredit</h5>
                          <input class="cinput" type="radio" name="st" id="st" value="0">
                          <span class="checkmark"></span>
                        </label>
                    </div><br><br>
                    <div class="checkboxcontainer" id="editfield" style="float:left;margin-top: 8px;">
                        <div style="position: relative;float: left;margin-right: 20px;">
                            <h5 class="headnavigation">Diskon (%) <redfont><i></i></redfont></h5>
                            <input style="width: 60px!important;" class="textinput2 cinput cleaveuang" type="text" name="disc" id="disc" value="0" autocomplete="off" required>
                        </div>
                        <div style="position: relative;float: right;">
                            <h5 class="headnavigation">PPN (%) <redfont><i></i></redfont></h5>
                            <input style="width: 60px!important;" class="textinput2 cinput cleaveuang" type="text" name="ppn" id="ppn" value="0" autocomplete="off" required>
                        </div>
                    </div><br><br><br>
                </div>

                <div class="entryfield2 detail_box" style="width: auto;border: 1px solid red;padding: 5px;width: 33%; font-family: fbold;margin-right: 5px!important;">
                    <b><h5 class="detail_beli">Total Item : <sapn id="item" class="badge_status_aktif"></sapn></h5><h5 class="detail_beli"></h5>
                    <h5 class="detail_beli">Jumlah Sebelum Diskon & PPN : <div style="float: right;font-size: 16px;"><strong>Rp. <span id="sebelum"></span></strong></div></h5>
                    <h5 class="detail_beli">Jumlah Setelah Diskon & PPN &nbsp;&nbsp;: <div style="float:right;font-size: 16px;">Rp. <span id="setelah"></span></div></h5></b>
                    <input type="hidden" name="jumx" value="0" id="jumx">
                    <input type="hidden" name="totx" value="0" id="totx">
                    <input type="hidden" name="itemx" value="0" id="itemx">
                    <input type="hidden" name="jnsklik" value="" id="jnsklik">
                </div>
                </div>
                <br>
                <div id="detail_transaksi">
                        <?php if(cek_hak_akses_aksi_submenu($userid,10,"user_tambah") > 0 ){ ?>
                            <div class="btn-transaksi">
                                <button class="formsubmit simpantransaksi" style="float:left; z-index:50;position: absolute;"><h5><i class="fas fa-save fas2"></i> <span id="judulbtn">Simpan dan cetak barcode</span></h5></button>
                            </div>
                            <div class="btn-transaksi barcode-cetak" style="padding-left: 180px;" >
                                <button class="formsubmit cetak_nota" style="font-size:14px;float:left; z-index:50;position: absolute;"><h5><i class="fas fa-print fas2"></i> Cetak Barcode</h5></button>
                            </div>
                        <?php } ?> <!-- target="_blank" href="barcode/index.php?kode=123" -->
                        <table id="kadal" style="font-size: 12px;"></table> 
                            <?php
                            $xdata=[];
                            $data_mat = mysqli_query($db,"select * from material inner join satuan on material.satuan_id=satuan.satuan_id order by material_nama asc");
                            $no=0;
                            while(
                                $data_detail=mysqli_fetch_assoc($data_mat)){
                                $no++; 
                                $xdata[] = [
                                    $no.'.',
                                    $data_detail['material_barcode'],
                                    $data_detail['material_nama'], 
                                    '<div class="input-table"><input type="text" class="input-trans cleaveuang" autocomplete="off" data-id_beli="" name="jumlah" style="width:60px!important;" autocomplete="off" id="jumlah'.$data_detail['material_id'].'"><label>'.$data_detail['satuan_nama'].'</label></div>', 
                                    '<input type="text" class="input-trans cleaveuang" style="width:80px!important;" data-id_belix="" autocomplete="off" name="harga" id="harga'.$data_detail['material_id'].'">', 
                                    '<input type="text" class="input-trans cleaveuang" autocomplete="off" style="background-color:#80808063;" disabled value="0" name="jum_sebelum_diskon" id="jum_sebelum_diskon'.$data_detail['material_id'].'">', 
                                    '<input type="text" class="input-trans cleaveuang"  style="width:50px!important;"   data-id_belix="" autocomplete="off" name="disc_mat" value="0" id="disc_mat'.$data_detail['material_id'].'">', 
                                    '<input type="text" class="input-trans cleaveuang"  data-id_belix="" autocomplete="off" style="background-color:#80808063;" disabled value="0" name="jum_setelah_diskon" id="jum_setelah_diskon'.$data_detail['material_id'].'">', 
                                    '<label class="container_check"><input class="x cb'.$data_detail['material_id'].'" type="checkbox" name="x" id="x" data-barcode="'.$data_detail['material_barcode'].'" value="'.$data_detail['material_id'].'"><span class="checkmark_box"></span></label>',
                                    '<input style="width:50px!important;" class="input-trans cc cleaveuang bc'.$data_detail['material_id'].'" type="text" name="bc" id="'.$data_detail['material_barcode'].'" value="0" >'

                                ]; 
                             }
                             ?>  
                    <script type="text/javascript">
                        var datas = <?=json_encode($xdata)?>;
                        $(('.cleaveuang')).toArray().forEach(function(field){
                            var cleaveUangRupiah = new Cleave(field, {
                                numeral: true,
                                numeralDecimalMark: '.',
                                delimiter: ','
                            });
                        });
                        console.log(datas);
                        var tmp_barcode = [];
                        var dt_tbl = $("#kadal").DataTable({
                            data:datas,
                            autoWidth: false,
                            columns:[
                                {title:"No.",width: "5%","className": "dt-center"},
                                {title:"Kode",width: "15%"},
                                {title:"Nama Bahan Baku",width: "25%"},
                                {title:"Qty Beli",width: "10%","className": "dt-center"},
                                {title:"Harga Modal (Rp.)",width: "10%"},
                                {title:"Jumlah Sebelum Diskon (Rp.)",width: "15%"},
                                {title:"Diskon (%)",width: "5%"},
                                {title:"Jumlah Setelah Diskon  (Rp.)",width: "15%"},
                                {title:"Aksi",width: "5%","className": "dt-center"},
                                {title:"Cetak Barcode",width: "5%","className": "dt-center"}
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
                                idx = $("#jnsklik").val();
                                cek_transaksi(idx);
                                $(('.cleaveuang')).toArray().forEach(function(field){
                                    var cleaveUangRupiah = new Cleave(field, {
                                        numeral: true,
                                        numeralDecimalMark: '.',
                                        delimiter: ','
                                    });
                                });
                                //alert("render");
                                $("table .cc").keyup(function(){
                                    tmp_barcode[$(this).attr("id")]=$(this).attr("id")+"|"+$(this).val();
                                    console.log(tmp_barcode);
                                }); 
                                
                           },
                            stateSave: true
                        });

                        $("#kadal").find("td").css("width","0px");
                        $("#kadal").find("td").css("padding","1px");

                    $(document).ready(function(){
                        $("#supplier_id").select2({
                            placeholder: "Pilih Nama Supplier",
                            allowClear: true
                        });

                        $('#kadal').on( 'click', 'td .x', function () {
                            var value = $(this).val();
                            if ($(this).is(':checked')) {
                                $("#load").show();
                                //alert(value+" = "+$("#jumlah"+value).val());
                                var jumlah = $("#jumlah"+value).val().split(",").join("");
                                var harga  = $("#harga"+value).val().split(",").join("");
                                var disc  = $("#disc_mat"+value).val().split(",").join("");
                                if($("#st1").is(':checked')) {
                                    var jenis_nota = $("#st1").val();
                                }else{
                                    var jenis_nota = $("#st").val();
                                }
                                var no_nota = $("#no_nota").val();
                                var opt = '<?php echo $userid; ?>';
                                var supplier = $("#supplier_id").val();
                                var transaksi_id = $("#id_nota").val();
                                var user_transaksi = $("#supplier_id").val();
                                if(jumlah == "" || jumlah == null || jumlah == "0"){
                                    alert("Jumlah pembelian bahan baku masih kosong.");
                                    $(this).prop("checked",false);
                                    $("#load").hide();
                                }else{
                                    if(harga == "" || harga == null || harga == "0"){
                                        alert("Harga modal pembelian bahan baku masih kosong.");
                                        $(this).prop("checked",false);
                                        $("#load").hide();
                                    }else{
                                        var ppn_nota = $("#ppn").val();
                                        var diskon_nota = $("#disc").val();
                                        var jum = $("#jumx").val();
                                        var item = $("#itemx").val();
                                        $.ajax({
                                            type : "POST", 
                                            url  : "<?php echo 'library/insert_pembelian.php'; ?>", 
                                            dataType : "JSON", 
                                            data : {no_nota:no_nota,jenis:jenis_nota,transaksi_id:transaksi_id,user_transaksi:user_transaksi,material:value,harga:harga,disc:disc,jumlah:jumlah,userid:opt,ppn_nota:ppn_nota,diskon_nota:diskon_nota,jum:jum,item:item},
                                            success: function(data){
                                                if(data != "5"){
                                                    if(data['st'] == true){
                                                        $("#jumlah"+value).attr("disabled","");
                                                        $("#harga"+value).attr("disabled","");
                                                        $("#disc_mat"+value).attr("disabled","");
                                                        $("#ppn_mat"+value).attr("disabled","");
                                                        $('table tr td #jumlah'+value).css("background-color","#80808063");
                                                        $('table tr td #harga'+value).css("background-color","#80808063");
                                                        $('table tr td #disc_mat'+value).css("background-color","#80808063");
                                                        $('table tr td #ppn_mat'+value).css("background-color","#80808063");
                                                        $("#jumlah"+value).attr("data-id_beli",data['id']);
                                                        $("#item").html(data['item']+" Bahan Baku");

                                                        $("#sebelum").html(data["jum"]);
                                                        $("#setelah").html(data["tot"]);
                                                        $("#total").html(data["tot"]);

                                                        cek_transaksi(idx);

                                                        $("#load").hide();
                                                    }else if(data == "2"){
                                                        alert("Gagal pilih barang.");
                                                        $("#load").hide();
                                                    }else if(data == "3"){
                                                        alert("Gagal pilih barang, barang sudah ada di nota tersebut.");
                                                        $("#load").hide();
                                                        ////location.reload();
                                                    }else if(data == "4"){
                                                        alert("Gagal pilih barang, anda tidak memiliki akses untuk melakukan transaksi ini.");
                                                        $("#load").hide();
                                                        ////location.href="dashboard.php";
                                                    }
                                                }else{
                                                    alert("Gagal, nota pembelian tidak ditemukan atau nota pembelian tersebut telah dibatalkan.");
                                                    $("#load").hide();
                                                    location.reload();
                                                }
                                            },error: function() {
                                                alert("Gagal pilih barang.");
                                                $("#load").hide();
                                            }
                                        });
                                    }
                                }
                            }else{
                                var value = $(this).attr('value');
                                var result = confirm("Anda yakin akan membatalkan nya ?");
                                if (result) {
                                    $("#load").show();
                                    var value = $(this).attr('value');
                                    var transaksi_id = $("#id_nota").val();
                                    var id = $("#jumlah"+value).attr("data-id_beli");
                                    var userid = '<?php echo $userid; ?>';
                                    $.ajax({
                                        type : "POST", 
                                        url  : "<?php echo 'library/batal_pembelian.php'; ?>", 
                                        dataType : "JSON", 
                                        data : {id:id,userid:userid,transaksi_id:transaksi_id},
                                        success: function(data){
                                            if(data != "5"){
                                                if(data == "denied"){
                                                    $("#load").hide();
                                                    alert('Anda tidak memiliki akses untuk melakukan aksi ini.');
                                                    ////location.reload();
                                                }else{
                                                    if(data == true){
                                                        $("#load").hide();
                                                        $("#jumlah"+value).removeAttr("disabled");
                                                        //$("#jumlah"+value).val("");
                                                        $('#jumlah'+value).css("background-color","");
                                                        $("#harga"+value).removeAttr("disabled");
                                                        //$("#harga"+value).val("");
                                                        $("#jum_setelah_diskon"+value).val("0");
                                                        $("#jum_sebelum_diskon"+value).val("0");
                                                        $('#harga'+value).css("background-color","");
                                                        $("#disc_mat"+value).removeAttr("disabled");
                                                        $("#ppn_mat"+value).removeAttr("disabled");
                                                        $('#disc_mat'+value).css("background-color","");
                                                        $('#ppn_mat'+value).css("background-color","");
                                                        //if($(this).is(":checked")){
                                                        var code = $('.cb'+value).attr("data-barcode");
                                                        $(".cb"+value).prop("checked",false);
                                                        cek_transaksi(idx);
                                                        data_cetak = $.grep(data_cetak, function(value) {
                                                          return value != code;
                                                        });
                                                        alert("render delete "+data_cetak);
                                                        //}
                                                        ////location.reload();
                                                    }else{
                                                        $("#load").hide();
                                                        alert('Pembatalan transaksi gagal.');  
                                                    }
                                                }
                                            }else{
                                                alert("Gagal, nota pembelian tidak ditemukan atau nota pembelian tersebut telah dibatalkan.");
                                                $("#load").hide();
                                                location.reload();
                                            }
                                        },error: function() {
                                            $("#load").hide();
                                            alert('Pembatalan transaksi gagal.');  
                                        }
                                    });return false;
                                }else{
                                    $("#load").hide();
                                }
                            }
                            
                        });

                        $(".cetak_nota").on('click',function(){
                            var dt_fix = filter_data(tmp_barcode);
                            if(dt_fix.length > 0){
                                window.open('barcode/index.php?data='+dt_fix, '_blank');
                            }
                        });

                    });

                    function filter_data(tmp_barcode){
                        var x = tmp_barcode.filter(function (el) {
                              return el != "";
                        });

                        return x;

                    }
                   
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div id="bg"></div>
    <div id="modal-kotak">
        <div id="atas">
            Pilih Rekening
            <hr>
            Rekening Pengirim <br>
            <select>
                <option>Pilih Rekening</option>
                <?php 
                    $data_rek = mysqli_query($db,"select rekening_id,rekening_pemilik,rekening_bank from rekening where rekening_jenis = 1");
                    while($list_rek = mysqli_fetch_assoc($data_rek)){ ?>

                        <option value="<?php echo $list_rek['rekening_id'] ?>"><?php echo $list_rek['rekening_pemilik']." - ".$list_rek['rekening_bank']; ?></option>
                <?php
                    }
                ?>
            </select><br>

            Rekening Penerima <br>
            <select>
                <option>Pilih Rekening</option>
                <?php 
                    $data_rekx = mysqli_query($db,"select rekening_id,rekening_pemilik,rekening_bank from rekening where rekening_jenis = 3");
                    while($list_rekx = mysqli_fetch_assoc($data_rekx)){ ?>

                        <option value="<?php echo $list_rekx['rekening_id'] ?>"><?php echo $list_rekx['rekening_pemilik']." - ".$list_rekx['rekening_bank']; ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div id="bawah">
            <button id="tombol-tutup">CLOSE</button>
            <button id="tombol-pilih" style="text-align: right;">Pilih</button>
        </div>
    </div>  
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#rb').on('click',function(){
            $('#modal-kotak , #bg').fadeIn("slow");
        });
        $('#tombol-tutup').on('click',function(){
            $('#modal-kotak , #bg').fadeOut("slow");
        });

        $('#tombol-pilih').on('click',function(){
            $('#modal-kotak , #bg').fadeOut("slow");
        });
    });
</script>