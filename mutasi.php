<?php
   include('library/session.php');
   include('library/config_hakakses.php');
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
</head>

<script>
$(document).ready(function(){
    $(".datalookup").click(function(){
        var nonota = $(this).attr("data-nota");
        $("#nobeli").val(nonota);
        
        var tglnota = $(this).attr("data-tgl");
        $("#tglbeli").val(tglnota);
        
        var totalbeli = $(this).attr("total-beli");
        $("#totalbeli").val(totalbeli);
        
        var sisa = $(this).attr("data-sisa");
        $("#sisa").val(sisa);
    
        
        $("#detailentry").show();
        $("#dcctable").hide();
    });
});
</script>


<title>Lotus - Mutasi</title>

<body>
    <div class="spacer"> </div>
    
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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Mutasi </h5>
            </div>
        </div>
        
 
        <hr class="hrred">
            <div class="dashcontainer1">
                <div class="detailcontainer" id="detailentry">
                    <h3 class="headnavigation"><redfont><i class="fas fa-people-carry"></i> Mutasi </redfont></h3>
                    <br>
                    <form class="boxentry" action="library/insert_transaksi.php" method="post">
                    <div class="entryfield">
                        <h5 class="headnavigation">No. Mutasi </h5>
                        <input class="textinput2" type="text" name="nobeli" id="nobeli" value="" autocomplete="off"><br><br><br>
                        <h5 class="headnavigation">Pilih Lokasi Awal </h5>
                        <input class="textinput2" type="text" name="tglbeli" id="tglbeli" value="" autocomplete="off" ><br><br><br>
                    </div>
                   <div class="entryfield">
						<h5 class="headnavigation">Jenis Mutasi <redfont><i>*</i></redfont></h5>
						<label class="checkboxlabel"><h5 class="headnavigation">Mutasi Barang</h5>
						<input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck"/>
						<span class="checkmark"></span>
						</label>
						<label class="checkboxlabel"><h5 class="headnavigation">Mutasi Bahan Baku</h5>
						<input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck1"/>
						<span class="checkmark"></span>
						</label>
						<br><br><br>
                        <h5 class="headnavigation">Pilih Lokasi Tujuan</h5>
                        <div class="pilbar1">
                        <select class="textinput3 lokasi" id="lokasi" name="lokasi" required="true">                    
                        <option>Pilih Lokasi</option>
                        </select>
                        <script type="text/javascript">
                            $(".lokasi").select2({
                            allowClear: true
                            });
                        </script>
                        </div>		
                        </div>			
					<div class="entryfield">
                        <div class="formsubmit" style="position:absolute; bottom:-90px;"  onclick="datalookup('buatnomutasi'); datahide('dcctable');"><h5>Buat No Mutasi</h5>
                        </div><br><br>
                        
                    </div>
                    
                    <div class="konfirmasi" style="position:absolute; bottom:0px; right:0;">
                        <input class="formsubmit boxsubmit" type="submit" name="" value="Mutasi">
                        <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('detailentry');"><h5>Batal</h5></div>
                    </div>
                 </form>
                 <div id="tampil-tabel">  
                <div class="dcctable">
                    <table id="tabel-data0">
                        <div class="formsubmit" style="position:absolute; left:220px; z-index:50;"  name="yesno" id="yesCheck1"><h5><i class="fas fa-plus fas2"></i> Buat Mutasi</h5></div>
                        <thead>
                            <tr>
                                <th style="text-align:center;">Kode Item</th>
                                <th style="text-align:center;">Nama Item</th>
                                <th style="text-align:center;">Lokasi Awal</th>
                                <th style="text-align:center;">Lokasi Tujuan</th>
                                <th style="text-align:center;">Qty mutasi</th>
                            </tr>
                        </thead>
                    </table>
                    <script type="text/javascript">
                        $('#tabel-data0').DataTable();
                    </script>
                </div> 
				</div> 
                </div>
                <div class="dcctable" id="dcctable">
                    <table id="tabel-data">
                       <div class="formsubmit" style="position:absolute; left:430px; z-index:50;" onclick="datalookup('detailentry'); datahide('dcctable');"><h5><i class="fas fa-plus fas2"></i> Buat Mutasi</h5></div>
                        <thead>
                            <tr>
                                <th>No. Mutasi</th>
                                <th>Tgl. Mutasi</th>
                                <th>Status</th>
                                <th style="width:3%;">Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $mutasi = mysqli_query($db,"select * from mutasi ");
                            while($row = mysqli_fetch_array($mutasi))
                            {
                        ?>
                        <tr>
                            <td><?php echo $row['no_mutasi'];?></td>
                            <td><?php echo date('d/m/Y',strtotime($row['tanggal']));?></td>
                            <td style="width:8%;text-align:center;"><?php if($row['status'] == 1){ echo "<span class='badge_status_aktif'>Proses</span>"; }else{ echo "<span class='badge_status_non_aktif'>selesai</span>"; }?></td>
                            <td>
                            <div class="formsubmit1" onclick="datalookup('cetak'); datahide('dcctable');"><h5>Lihat</h5>
                            </div>
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
<div id="bg">
</div>
	<div id="modal-kotak1">
		<div id="atas">
			Pilih Rekening
            <hr>
        </div>
        <div class="dcctable" id="dcctable">
                    <table id="tabel-mutasi">
                        <thead>
                            <tr>
                                <th>Kode Item</th>
                                <th>Nama Item</th>
                                <th>Lokasi Tujuan</th>
                                <th>Jumlah Qty</th>
                                <th>Qty Mutasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody> 
                         <script>
                            $(document).ready(function(){
                                $('#tabel-mutasi').DataTable({
                                    stateSave: true
                                });
                            });
                        </script>
                    </table>
                </div>
                        <hr>    
        <div id="bawah">
            <button id="tombol-tutup">CLOSE</button>
			<button id="tombol-pilih">PILIH</button>
        </div>
 </div>
         <div class="detailcontainer" id="buatnomutasi">
                    <h3 class="headnavigation"><redfont><i class="fas fa-box-open"></i> Data Nota Beli</redfont></h3>
                    <br>
                        <div class="entryfield">
                        <h5 class="headnavigation">No. Mutasi </h5>
                        <input class="textinput2" type="text" name="nobeli" id="nobeli" value="" autocomplete="off" readonly><br><br><br> 
                        <h5 class="headnavigation">Pilih Lokasi Awal </h5>
                        <input class="textinput2" type="text" name="tglbeli" id="tglbeli" value="" autocomplete="off" readonly><br><br><br> 
                    </div>
                   <div class="entryfield">
	                    <h5 class="headnavigation">No. Mutasi </h5>
                        <input class="textinput2" type="text" name="nobeli" id="nobeli" value="" autocomplete="off" readonly><br><br><br> 
                        <div class="pilbar2">
                        <select class="textinput3 lokasi1" id="lokasi1" name="lokasi1" required="true">                    
                        <option>Pilih Lokasi</option>
                        </select>
                        <script type="text/javascript">
                            $(".lokasi1").select2({
                            allowClear: true
                            });
                        </script>
                        </div>	
                    </div>
                 <div class="dcctable" id="dcctable">
                    <table id="tabel-data1">
                        <thead>
                            <tr>
                                <th>No. Mutasi</th>
                                <th>Tgl. Mutasi</th>
                                <th>Status</th>
                                <th style="width:3%;">Aksi </th>
                            </tr>
                        </thead>
                        <tbody>                   
                        
                        </tbody> 
                         <script>
                            $(document).ready(function(){
                                $('#tabel-data1').DataTable({
                                    stateSave: true
                                });
                            });
                        </script>
                    </table>
                </div>    		
                     <div class="konfirmasi" style="position:absolute; bottom:0px; right:0;">
                        <div class="formsubmitcancel" onclick="datalookup('detailentry'); datahide('buatnomutasi');"><h5>Kembali</h5></div>
                    </div>
                </div>
                <div class="detailcontainer" id="cetak">
                    <h3 class="headnavigation"><redfont><i class="fas fa-box-open"></i> Daftar Mutasi Item</redfont></h3>
                    <br>
                 <div class="dcctable" id="dcctable">
                    <table id="tabel-data2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>nama item</th>
                                <th>QTY Mutasi</th>
                                <th>Lokasi Awal </th>
                                <th>Lokasi Tujuan </th>
                            </tr>
                        </thead>
                        <tbody>                   
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
                     <div class="konfirmasi" style="position:absolute; bottom:0px; right:0;">
                       <input class="formsubmit boxsubmit" type="submit" name="" value="Cetak">
                        <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('cetak');"><h5>Kembali</h5></div>
                    </div>
                </div>
        </div> 
        </div>
</body>

<footer>
<script type="text/javascript" src="script/footerscript.js"></script>
</footer>

<script type="text/javascript">
	$(document).ready(function()
                      {
		$('#yesCheck').click(function()
                        {
        $('#modal-kotak1 , #bg').fadeIn("slow");
		});
        $('#yesCheck1').click(function()
                        {
				$('#modal-kotak1 , #bg').fadeIn("slow");
		});
		$('#tombol-tutup').click(function()
                                 {
			$('#modal-kotak1 , #bg').fadeOut("slow");
		});
        $('#tombol-cetak').click(function()
                                 {
			$('#modal-kotak1 , #bg').fadeOut("slow");
		});
		
		$('#tombol-pilih').click(function()
                                 {
            
            var nama = $("#pilihan_rek1").find(":selected").attr("data-pemilik1");
			var bank = $("#pilihan_rek1").find(":selected").attr("data-bank1");
			var nomor = $("#pilihan_rek1").find(":selected").attr("data-nomor1");
			$("#rnamapengirim").val(bank);
			$("#rbankpengirim").val(nama);
			$("#rnopengirim").val(nomor);
			console.log(nama);
			$('#modal-kotak , #bg').fadeOut("slow");
            
            
			var nama = $("#pilihan_rek2").find(":selected").attr("data-pemilik");
			var bank = $("#pilihan_rek2").find(":selected").attr("data-bank");
			var nomor = $("#pilihan_rek2").find(":selected").attr("data-nomor");
			$("#rnamapenerima").val(bank);
			$("#rbankpenerima").val(nama);
			$("#rnopenerima").val(nomor);
			console.log(nama);
			$('#modal-kotak , #bg').fadeOut("slow"); 
		});
        
	});
</script>