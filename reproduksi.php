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

<style>
    html, body {min-width:1250px !important;}
</style>

<script>
$(document).ready(function(){
    $('#addkodeproduksi').click(function(){
        var idkodeproduksi = document.getElementsByName("produksiradio");
        for(i = 0; i < idkodeproduksi.length; i++) { 
            if(idkodeproduksi[i].checked) 
                document.getElementById("kodeproduksi").value
                    = idkodeproduksi[i].value;
        }
    });
    
    $('.kodeproduksiradio').click(function(){
        document.getElementById("kodeproduksi").value = "";
        document.getElementById("namabarang").value = "";
        document.getElementById("catprod").value = "";
        $('.pilihbarang').val(null).trigger('change');
    });
    
    
    $(".pilihbarang").change(function(){
        var barcode = $('option:selected', this).attr("data-barcode");
        
        var plt = '<?php echo $usersettingplt; ?>';
        var b = '<?php echo $usersettingb; ?>';
        $.ajax({
            type : "POST", 
            url  : "<?php echo 'library/detailreproduksi.php'; ?>",
            data : {barcode:barcode,plt:plt,b:b},
            success: function(data){
                $("#dcctable1").html(data);
            }
        });
    });
    
    
});
</script>

<title>Lotus - Re-Produksi</title>

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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Re-Produksi</h5>
            </div>
        </div>
        
        <hr class="hrred">
            <div class="dashcontainer1">
                <div class="produksicontainer">
                    <h2 class="headnavigation" style="margin-bottom:10px;">Re-Produksi Barang</h2>
                    <form class="entryprod" action="library/insert_reproduksi.php" method="post">
                        
                        
                    <?php
                        $today = date("dmY");
                    ?>
                    
                    <div class="entryfield2">
                        <label class="checkboxlabel kodeproduksiradio"><h3 class="headnavigation">Barang Produksi Standar</h3>
                            <input type="radio" id="prodstandar" name="produksiradio" value="RPRS-<?php echo $today; ?>-<?php echo(rand(1,99999)); ?>">
                            <span class="checkmark"></span>
                        </label>
                        <br><br><br>
                        
                        <h5 class="headnavigation">Kode Re-Produksi</h5>
                        <input class="textinput3" type="text" name="produksi1" id="kodeproduksi" value="" autocomplete="off" style="width:200px !important;" disabled>
                        <div class="kodeprodbutton" id="addkodeproduksi">Buat Kode</div>
                        <br><br><br>
                        
                        <h5 class="headnavigation">Pilih Barang</h5>
                        <select class="textinput3 pilihbarang" name="produksi2" onchange="showKomposisi('dcctable1', this)" >
                            <option></option>
                            <?php $unit = mysqli_query($db,"select * from barang where barang_status=1"); while($rowunit = mysqli_fetch_array($unit)) { ?>
                            <option
                                value="<?php echo $rowunit['barang_barcode'];?>"
                                data-barcode="<?php echo $rowunit['barang_barcode'];?>"
                            >
                                <?php echo $rowunit['barang_nama'];?>
                            </option>
                            <?php
                                }
                            ?>
                        </select>
                        
                        <script type="text/javascript">
                            $(".pilihbarang").select2({
                                placeholder: "Pilih nama barang",
                                allowClear: true
                            });
                        </script>
                    </div>
                    
                    
                    <div class="entryfield2">
                        <label class="checkboxlabel kodeproduksiradio"><h3 class="headnavigation">Barang Produksi Custom</h3>
                            <input type="radio" id="prodcustom" name="produksiradio" value="RPRC-<?php echo $today; ?>-<?php echo(rand(1,99999)); ?>">
                            <span class="checkmark"></span>
                        </label>
                        <br><br><br>
                        
                        <h5 class="headnavigation">Nama Barang</h5>
                        <input class="textinput3" type="text" name="produksi3" id="namabarang" value="" autocomplete="off" disabled><br><br><br>
                        
                        <div class="notesbutton" onclick="togglecatatanprod()">Tambah Catatan Re-Produksi</div>
                    </div>
                    
                    <div class="entryfield2" id="catatanprod" style="padding-top:45px; display:none;">
                        <h5 class="headnavigation">Catatan Re-Produksi</h5>
                        <textarea class="textinputarea catatanproduksi" type="text" id="catprod" name="produksi4" value="" autocomplete="off" maxlength="150" rows="7" style="margin:0px !important;" disabled></textarea><br><br><br>
                    </div>
                    
                    <script>
                        function togglecatatanprod() {
                          var x = document.getElementById("catatanprod");
                          if (x.style.display === "none") {
                            x.style.display = "block";
                          } else {
                            x.style.display = "none";
                          }
                        }
                        
                        $(".pilihbarang").prop("disabled", true);
                              
                        $("#prodstandar").click(function(){
                            $("#kodeproduksi").prop("disabled", false);
                            $("#namabarang").prop("disabled", false);
                            $("#catprod").prop("disabled", false);
                            $(".pilihbarang").prop("disabled", false);
                            
                            $("#kodeproduksi").prop("required", true);
                            $("#catprod").prop("required", true);
                            $(".pilihbarang").prop("required", true);
                        });
                        $("#prodcustom").click(function(){
                            $("#kodeproduksi").prop("disabled", false);
                            $("#namabarang").prop("disabled", false);
                            $("#catprod").prop("disabled", false);
                            $(".pilihbarang").prop("disabled", false);
                            
                            $("#kodeproduksi").prop("required", true);
                            $("#catprod").prop("required", true);
                            $(".pilihbarang").prop("required", true);
                        });
                    </script>
                    
                    
                    <div class="dcctable dcctableproduksi" id="dcctable1" style="display:none;">
                        
                    </div>
                    
                    <div class="dcctable dcctableproduksi" id="dcctable2" style="display:none;">
                        
                    </div>
                        
                        
                    </form>
                </div>
            </div>
    </div>
</body>

<footer>
<script type="text/javascript" src="script/footerscript.js"></script>

<script>
    function showKomposisi(divId, element)
    {
        document.getElementById(divId).style.display = element.value > 0 ? 'block' : 'none';
    };
</script>
</footer>