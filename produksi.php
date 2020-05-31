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
        document.getElementById("qtyproduksi").value = "";
        document.getElementById("catprod").value = "";
        $('.pilihbarang').val(null).trigger('change');
        $('.pilihnotapesanan').val(null).trigger('change');
        $('.pilihpesanancustom').val(null).trigger('change');
    });
    
    
    $('.pilihnotapesanan').change(function(){
        $('.pilihpesanancustom').val(null).trigger('change');
    });
    
    //==============================================================================//
    $(".pilihnotapesanan").change(function(){
        var nota = $('option:selected', this).attr("data-nota");
        
        $.ajax({
            type : "POST", 
            url  : "<?php echo 'library/detailnota.php'; ?>",
            data : {nota:nota},
            success: function(data){
                $("#detaildaftarnota").html(data);
            }
        });
    });
    
    
    $(".pilihbarang").change(function(){
        var barcode = $('option:selected', this).attr("data-barcode");
        
        var plt = '<?php echo $usersettingplt; ?>';
        var b = '<?php echo $usersettingb; ?>';
        $.ajax({
            type : "POST", 
            url  : "<?php echo 'library/detailproduksi.php'; ?>",
            data : {barcode:barcode,plt:plt,b:b},
            success: function(data){
                $("#dcctable1").html(data);
            }
        });
    });
    
    $(".pilihpesanancustom").change(function(){
        var barcodecustom = $('option:selected', this).attr("data-barcodecustom");
        
        var plt = '<?php echo $usersettingplt; ?>';
        var b = '<?php echo $usersettingb; ?>';
        $.ajax({
            type : "POST", 
            url  : "<?php echo 'library/detail_produksicustom.php'; ?>",
            data : {barcodecustom:barcodecustom,plt:plt,b:b},
            success: function(data){
                $("#dcctable2").html(data);
            }
        });
    });
});
</script>

<title>Lotus - Produksi</title>

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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Master <redfont>/</redfont> Produksi</h5>
            </div>
        </div>
        
        <hr class="hrred">
            <div class="dashcontainer1">
                <div class="produksicontainer">
                    <h2 class="headnavigation" style="margin-bottom:10px;">Produksi Barang</h2>
                    <form class="entryprod" action="library/insert_produksi.php" method="post">
                        
                        
                    <?php
                        $today = date("dmY");
                    ?>
                    
                    <div class="entryfield2">
                        <label class="checkboxlabel kodeproduksiradio"><h3 class="headnavigation">Produksi Standar</h3>
                            <input type="radio" id="prodstandar" name="produksiradio" value="PRS-<?php echo $today; ?>-<?php echo(rand(1,99999)); ?>">
                            <span class="checkmark"></span>
                        </label>
                        <br><br><br>
                        
                        <h5 class="headnavigation">Kode Produksi</h5>
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
                        <br><br>
                        
                        <h5 class="headnavigation">Qty Barang Produksi <redfont>(Frame)</redfont></h5>
                        <input class="textinput3 cleaveuang qtyinput" type="text" name="produksi3" id="qtyproduksi" value="" autocomplete="off" disabled>
                    </div>
                    
                    
                    
                    
                    <div class="entryfield2">
                        <label class="checkboxlabel kodeproduksiradio"><h3 class="headnavigation">Produksi Custom</h3>
                            <input type="radio" id="prodcustom" name="produksiradio" value="PRC-<?php echo $today; ?>-<?php echo(rand(1,99999)); ?>">
                            <span class="checkmark"></span>
                        </label>
                        <br><br><br>
                        
                        <h5 class="headnavigation">Pilih Nota Pesanan</h5>
                        <select class="textinput3 pilihnotapesanan" name="produksi4">
                            <option></option>
                            <?php $unit = mysqli_query($db,"select * from nota where nota_status=1"); while($rowunit = mysqli_fetch_array($unit)) { ?>
                            <option 
                                    value="<?php echo $rowunit['nota_id'];?>"
                                    data-nota="<?php echo $rowunit['nota_nomor'];?>"
                            >
                                <?php echo $rowunit['nota_nomor'];?>
                            </option>
                            <?php } ?>
                        </select><br><br>
                        
                        <script type="text/javascript">
                            $(".pilihnotapesanan").select2({
                                placeholder: "Pilih nota",
                                allowClear: true
                            });
                        </script>
                        
                        <h5 class="headnavigation">Pilih Pesanan Barang Custom</h5>
                        <div class="pilbar2">
                            <select class="textinput3 pilihpesanancustom" id="detaildaftarnota" name="produksi5" onchange="showKomposisi('dcctable2', this)">
                                
                            </select><br><br>
                        </div>
                        
                        <script type="text/javascript">
                            $(".pilihpesanancustom").select2({
                                placeholder: "Pilih pesanan custom",
                                allowClear: true
                            });
                        </script>
                        
                        <div class="notesbutton" onclick="togglecatatanprod()">Tambah Catatan Produksi</div>
                    </div>
                    
                    <div class="entryfield2" id="catatanprod" style="padding-top:35px; display:none;">
                        <h5 class="headnavigation">Catatan Produksi</h5>
                        <textarea class="textinputarea catatanproduksi" type="text" id="catprod" name="produksi6" value="" autocomplete="off" maxlength="150" rows="4" style="margin:0px !important;" disabled></textarea><br><br><br>
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
                        $(".pilihpesanancustom").prop("disabled", true);
                        $(".pilihnotapesanan").prop("disabled", true);
                              
                        $("#prodstandar").click(function(){
                            $(".pilihbarang").prop("disabled", false);
                            $(".pilihpesanancustom").prop("disabled", true);
                            $(".pilihnotapesanan").prop("disabled", true);
                            $("#kodeproduksi").prop("disabled", false);
                            $(".qtyinput").prop("disabled", false);
                            $(".catatanproduksi").prop("disabled", false);
                            
                            $("#kodeproduksi").prop("required", true);
                            $("#qtyproduksi").prop("required", true);
                            $(".pilihbarang").prop("required", true);
                            $(".pilihnotapesanan").prop("required", false);
                            $(".pilihpesanancustom").prop("required", false);
                        });
                        $("#prodcustom").click(function(){
                            $(".pilihpesanancustom").prop("disabled", false);
                            $(".pilihbarang").prop("disabled", true);
                            $(".pilihnotapesanan").prop("disabled", false);
                            $("#kodeproduksi").prop("disabled", false);
                            $(".qtyinput").prop("disabled", false);
                            $(".catatanproduksi").prop("disabled", false);
                            
                            $("#kodeproduksi").prop("required", true);
                            $("#qtyproduksi").prop("required", true);
                            $(".pilihbarang").prop("required", false);
                            $(".pilihnotapesanan").prop("required", true);
                            $(".pilihpesanancustom").prop("required", true);
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