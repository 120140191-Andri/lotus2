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
    <script type="text/javascript">  
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            tablinks2 = document.getElementsByClassName("ss");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
                tablinks[i].className = tablinks[i].className.replace(" arrow_box", "");
                tablinks2[i].className = tablinks2[i].className.replace(" arrow_box2", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
            evt.currentTarget.className += " arrow_box";
            if(document.getElementsByClassName("tablinks active").length > 0){
                var x = evt.currentTarget.childNodes;
                x[0].className += " arrow_box2";
            }
        }

        $(document).ready(function(){
            $("#tab_container").hide();
            $("#tambah_hakakses").hide();
            $("#srengseng").show();


            $(".datalookup").click(function(){
                $(".tablinks").removeClass("active");
                $(".tablinks").removeClass("arrow_box");
                $(".ss").removeClass("arrow_box2");

                $(".tablinks:first").addClass("active");
                $(".tablinks:first").addClass("arrow_box");
                $(".ss:first").addClass("arrow_box2");
                var tandai = $(this).attr('data-tandai');
                if(tandai == "check"){
                    $(".simpanhakakses").html("<h5>Ubah data hak akses</h5>");
                    if('<?php echo cek_hak_akses_aksi_submenu($userid,2,"user_ubah") ?>' == '1'){
                        $(".simpanhakakses").show();
                        $(".resethakakses").show();
                    }else{
                        $(".simpanhakakses").hide();
                        $(".resethakakses").hide();
                    }
                    $(".simpanhakakses").attr('data-opsi','ubah');
                }else{
                    $(".simpanhakakses").html("<h5>Simpan data hak akses</h5>");
                    if('<?php echo cek_hak_akses_aksi_submenu($userid,2,"user_tambah") ?>' == '1'){
                        $(".simpanhakakses").show();
                        $(".resethakakses").hide();
                    }else{
                        $(".simpanhakakses").hide();
                        $(".resethakakses").hide();
                    }
                    $(".simpanhakakses").attr('data-opsi','tambah');
                }


                $("#load").show();
                var id = $(this).attr('data-id');
                var nama = $(this).attr('data-nama');
                var pekerjaan = $(this).attr('data-pekerjaan');
                $.ajax({
                    type : "POST", 
                    url  : "<?php echo 'library/load_hakakses.php'; ?>", 
                    dataType : "JSON", 
                    data : {id:id},
                    success: function(data){
                        var html = '';
                        var x,y;
                        for(y=0;y<data.length;y++){
                            console.log(data[y]);
                            
                            html+='<div id="'+data[y].menu+'" class="tabcontent">';
                            html+='<table id="tabel-data'+y+'"><thead><th>No.</th><th>Nama Menu</th><th>Akses Lihat</th><th>Akses Tambah</th><th>Akses Ubah</th><th>Akses Hapus</th><th>Akses Android</th></thead><tbody>';
                           for(x=0;x<data[y].datamenu.length;x++){
                                console.log(data[y].datamenu[x]);
                                if(data[y].datamenu[x].mst_lihat == "1"){
                                    if(data[y].datamenu[x].st_lihat == "1"){
                                        var st = "checked='checked'";
                                    }else{
                                        var st = "";
                                    }
                                    var data_lihat = '<label class="container_check"><input type="checkbox" value="'+data[y].datamenu[x].lihat+'" '+st+'><span class="checkmark_box"></span></label>';
                                }else{
                                    var data_lihat = '';
                                } 

                                if(data[y].datamenu[x].mst_tambah == "1"){
                                    if(data[y].datamenu[x].st_tambah == "1"){
                                        var st = "checked='checked'";
                                    }else{
                                        var st = "";
                                    }
                                    var data_tambah = '<label class="container_check"><input type="checkbox" value="'+data[y].datamenu[x].tambah+'" '+st+'><span class="checkmark_box"></span></label>';
                                }else{
                                    var data_tambah = '';
                                }

                                if(data[y].datamenu[x].mst_ubah == "1"){
                                    if(data[y].datamenu[x].st_ubah == "1"){
                                        var st = "checked='checked'";
                                    }else{
                                        var st = "";
                                    }
                                    var data_ubah = '<label class="container_check"><input type="checkbox" value="'+data[y].datamenu[x].ubah+'" '+st+'><span class="checkmark_box"></span></label>';
                                }else{
                                    var data_ubah = '';
                                }

                                if(data[y].datamenu[x].mst_hapus == "1"){
                                    if(data[y].datamenu[x].st_hapus == "1"){
                                        var st = "checked='checked'";
                                    }else{
                                        var st = "";
                                    }
                                    var data_hapus = '<label class="container_check"><input type="checkbox" value="'+data[y].datamenu[x].hapus+'" '+st+'><span class="checkmark_box"></span></label>';
                                }else{
                                    var data_hapus = '';
                                }

                                if(data[y].datamenu[x].mst_android == "1"){
                                    if(data[y].datamenu[x].st_android == "1"){
                                        var st = "checked='checked'";
                                    }else{
                                        var st = "";
                                    }
                                    var data_android = '<label class="container_check"><input type="checkbox" value="'+data[y].datamenu[x].android+'" '+st+'><span class="checkmark_box"></span></label>';
                                }else{
                                    var data_android = '';
                                }

                                html +='<tr>'+
                                    '<td style="width:5%;text-align:center;">'+data[y].datamenu[x].no+'.</td>'+
                                    '<td><h5>'+data[y].datamenu[x].nama_menu+'</h5></td>'+ 
                                    '<td style="width:10%;text-align:center;"><h5>'+data_lihat+'</h5></td>'+
                                    '<td style="width:10%;text-align:center;"><h5>'+data_tambah+'</h5></td>'+
                                    '<td style="width:10%;text-align:center;"><h5>'+data_ubah+'</h5></td>'+
                                    '<td style="width:10%;text-align:center;"><h5>'+data_hapus+'</h5></td>'+
                                    '<td style="width:10%;text-align:center;"><h5>'+data_android+'</h5></td>'+
                                '</tr>'; 
                            } 
                            html+='</tbody></table></div>';
                        }          
                        $("#all_data").html(html); 
                        for(y=0;y<data.length;y++){
                            $("#tabel-data"+y).DataTable({pageLength: 5,stateSave: true});
                        }
                        $(".tabcontent").hide(); 
                        $(".tabcontent:first").show();       
                    },
                });

                $("#tambah_hakakses").show();
                $("#tab_container").show();
                $(".dcc").hide();
                $(".dcctable").hide();
                $("#id_karyawan_hak_akses").val(id);
                $("#nama_karyawan").html(nama);
                $("#pekerjaan_karyawan").html(pekerjaan);
                $("#load").hide();
            });

            $(".cancel").click(function(){
                $(".dcctable").show();
                $("#tambah_hakakses").hide();
                $("#tab_container").hide();
                $(".dcc").show();
            });

            $(".simpanhakakses").click(function(){
                $("#load").show();
                var searchIDs = $("#tab_container input:checkbox:checked").map(function(){
                  return $(this).val();
                }).get();
                if(searchIDs.length > 0){
                    var id = $("#id_karyawan_hak_akses").val();
                    var sess = '<?php echo $_SESSION['sess'] ?>';
                    var send = $(this).attr("data-opsi");
                    $.ajax({
                        type : "POST", 
                        url  : "<?php echo 'library/insert_hakakses.php?aksi=simpan'; ?>", 
                        dataType : "JSON", 
                        data : {hakakses:searchIDs,id:id,sess:sess,opsi:send},
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
                                    alert('error simpan data.');  
                                }
                            }
                        },error: function() {
                            $("#load").hide();
                            alert('error simpan data.');
                        }
                    });
                }else{
                    alert("Anda belum memilih hak akses untuk karyawan ini.");
                    $("#load").hide();
                }
            });

            $(".resethakakses").click(function(){
                $("#load").show();
                var id = $("#id_karyawan_hak_akses").val();
                var nama = $("#nama_karyawan").text();
                var result = confirm("Anda yakin akan mereset data hak akses karyawan ("+nama+") ?");
                if (result) {
                    var sess = '<?php echo $_SESSION['sess'] ?>';
                    $.ajax({
                        type : "POST", 
                        url  : "<?php echo 'library/insert_hakakses.php?aksi=reset'; ?>", 
                        dataType : "JSON", 
                        data : {id:id,sess:sess},
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
                                    alert('error simpan data.');  
                                }
                            }
                        },error: function() {
                            $("#load").hide();
                            alert('error simpan data.');
                        }
                    });return false;
                }else{
                    $("#load").hide();
                }
            });

            $("#load").hide();

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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Daftar hak akses</h5>
            </div>
        </div>
        <hr class="hrred">
            <div class="dashcontainer1">
                 
                <div class="dcctable">
                    <table id="tabel-data">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Pekerjaan</th>
                                <th>Data hak akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM hakakses right join karyawan on karyawan.karyawan_id=hakakses.karyawan_id WHERE karyawan.karyawan_id!=1 and karyawan.karyawan_id!=2 order by karyawan.karyawan_id desc";
                                $search_result = filterTable($query);
                                   
                                function filterTable($query)
                                {
                                    $connect = mysqli_connect("localhost", "root", "", "lotus");
                                    $filter_Result = mysqli_query($connect, $query);
                                    return $filter_Result;
                                }
                                
                            ?> 
                        <?php
                        $hakakses = mysqli_query($db,"select * from karyawan where karyawan_id!='1' and karyawan_id!='2'");
                        $mulai=0; while($row = mysqli_fetch_assoc($search_result)){ $mulai++;
                            if($row['hakakses_id'] == '' || $row['hakakses_id'] == null){ $tandai = "plus"; $color="red;"; }else{ $tandai="check"; $color="green;"; } ?>
                            <tr>
                                <td><?php echo $mulai;?></td>
                                <td><?php echo $row['karyawan_nama'];?></td>
                                <td><?php echo $row['karyawan_job'];?></td>
                                <td><h4>
                                    <?php if(cek_hak_akses_aksi_submenu($userid,2,"user_lihat") > 0 ){ ?>
                                    <a class="datalookup" style="cursor:pointer;" data-tandai="<?php echo $tandai;?>" data-id="<?php echo $row['karyawan_id'];?>" data-nama="<?php echo $row['karyawan_nama'];?>" data-pekerjaan="<?php echo $row['karyawan_nama'];?>"><i class="fas fa-address-book fas2"></i> Lihat data </a> <i style="color:<?php echo $color;?>" class="badge-cusstom fa fa-<?php echo $tandai; ?>"></i>
                                    <?php } ?>
                                    </h4>
                                </td>                 
                            </tr>                  
                        <?php } ?>
                        </tbody>
                 <script type="text/javascript">
                     $('#tabel-data').DataTable({stateSave: true});
                 </script>       
            
                    </table>
                </div> 
                <div id="tambah_hakakses" style="padding-bottom: 70px;height: auto;">
                    <form action="" method="post">
                        <br>
                        <h3 class="headnavigation"><redfont><i class="fas fa-user-shield"></i> Data hak akses karyawan</redfont></h3>
                        <br>
                        <input type="hidden" name="id_karyawan_hak_akses" id="id_karyawan_hak_akses" />
                        <div class="entryfield2">
                            <h5 class="headnavigation">Nama karyawan</h5>
                            <h2 class="headnavigation" id="nama_karyawan"></h2><br>
                            <div class="formsubmit simpanhakakses" data-opsi="" style="margin-right:5px!important;margin-left:5px!important;"><h5>Simpan data hak akses</h5></div>
                            <div class="formsubmit resethakakses" style="margin-right:5px!important;"><h5>Reset data hak akses</h5></div>
                        </div>
                        <div class="entryfield2">
                            <h5 class="headnavigation">Pekerjaan</h5>
                            <h2 class="headnavigation" id="pekerjaan_karyawan"></h2><br>
                            <div class="formsubmitcancel cancel" style="width: 150px;margin-right:1px!important;"><h5>Tutup Tanpa Simpan</h5></div>
                        </div>
                    </form>
                </div><br><br><br>
            <div id="tab_container" style="margin-top: 10px;">
                <div class="tab">
                    <?php 
                    $connect = mysqli_connect("localhost", "root", "", "lotus");
                    $query_data_hakakses = "SELECT * FROM menu_utamahakakses";
                    $hak_akses_result2 = filterTable($query_data_hakakses);
                    $x = 0;
                    while($dt = mysqli_fetch_assoc($hak_akses_result2)){ 
                        $x = $x+1;
                        if($x == 1){
                            $aktif = "active arrow_box";
                            $aktif2 ="arrow_box2";
                        }else{ 
                            $aktif= "";
                            $aktif2= "";
                        } ?>
                    <button class="tablinks <?php echo $aktif; ?>" onclick="openCity(event, '<?php echo $dt['nama_menu'] ?>')" id="defaultOpen"><span class="ss <?php echo $aktif2; ?>"></span><?php echo $dt['nama_menu'] ?></button>
                <?php } ?>
                </div>
                <div id="all_data"></div>
            </div>
        </div>
    </div>

</body>
</html>
