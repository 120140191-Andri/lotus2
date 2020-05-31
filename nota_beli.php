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
    <style>
        .disabled{
            background-color:grey;
        }
        
        .disabled:hover{
            background-color:grey;
            border: 1px solid grey;
            color : white;
        }
        
        .tampilkan{
            display: block;
        }
        
        .sembunyikan{
            display: none;
        }
    </style>
</head>
<script>
$(document).ready(function(){
	$("#detailentry").hide();
    $(".datalookup").click(function(){
        var nonota = $(this).attr("data-nota");
        $("#nobeli").val(nonota);
        
        var tglnota = $(this).attr("data-tgl");
        $("#tglbeli").val(tglnota);
        
        var totalbeli = $(this).attr("total-beli");
        $("#totalbeli").val(totalbeli);
        
        var sisa = $(this).attr("data_sisa");
        $("#sisa").val(sisa);
        
        var operator = $(this).attr("operator");
        $("#operator").val(operator);
        tampilkan_datax(nonota);
        
        $("#detailentry").show();
        $("#tampil-tabel").hide();
    });
});
function tampilkan_datax(nonota){
    var html = '';
        $("#tabel-data5").DataTable().destroy();
        $("#tabel-data0").DataTable().destroy();
        $.ajax({
                type : "POST", 
                url  : "<?php echo 'library/load_bayar_nota_beli.php'; ?>", 
                dataType : "JSON", 
                data : {nonota:nonota},
                success: function(data){
                    if(data != null){
                        var i = 0;
                        html +='';
                        console.log(data);
                        if(data.length > 0){
                        for(i=0;i < data.length;i++){
                            console.log(data[i].id);
                            var x = i+1;
                            if(x == 1){
                                var tombol = '<a class="formsubmit1" href="hapus.php?id_bayar='+data[i].id+'">Hapus</a>';
                            }else{
                               var tombol = "";
                            }
                            
                            if(data[i].st == "1")
                            {
                               var st = '<span class="badge_status_aktif">Lunas</span>';
                            }
                            else
                            {
                               var st = '<span class="badge_status_non_aktif">Angsur</span>';
                            }
                            html += '<tr>'+
                                '<td>'+x+'.</td>'+
                                '<td>'+data[i].tgl+'</td>'+
                                '<td>'+data[i].jenis+'</td>'+
                                '<td style="text-align:right;">'+data[i].nominal+'</td>'+
                                '<td style="text-align:right;">'+data[i].sisa+'</td>'+
                                '<td>'+st+'</td>'+
                                '<td>'+data[i].opt+'</td>'+
                                '<td>'+tombol+'</td>'+
                                '</tr>';
                        }
                        }
                    }
                       $("#tampil_data").html(html);
                        $("#tabel-data5").DataTable({
                        "lengthMenu": [5]});
                        $("#tampil_data2").html(html);
                        $("#tabel-data0").DataTable({
                        "lengthMenu": [5]});
                }
        });
}
</script>

<script>
$(document).ready(function(){
    $(".datalookup1").click(function(){
       
     var nobeli1 = $(this).attr("no-beli1");
        $("#nobeli1").val(nobeli1);
        
        var tglbeli1 = $(this).attr("tgl-beli1");
        $("#tglbeli1").val(tglbeli1);
        
        var jenisbeli = $(this).attr("jenis-beli");
        $("#jenisbeli").val(jenisbeli);
        
        var namasup = $(this).attr("nama-sup");
        $("#namasup").val(namasup);
        
        var jumnota = $(this).attr("jum-nota");
        $("#jumnota").val(jumnota);
        tampilkan_datax(nobeli1);
        $("#detailbox").show();
        $("#tabel-datax").css("display","none");
        $("#tampil-tabel").css("display","block");
        $("#tabel-data").hide();
    });
});
</script>
<title>Lotus - Nota Beli</title>

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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Bayar Nota Beli</h5>
            </div>
        </div>
        
 
        <hr class="hrred">
            <div class="dashcontainer1">
                <div class="detailcontainer1" id="detailentry">
                    <h3 class="headnavigation"><redfont><i class="fas fa-people-carry"></i> Bayar Nota</redfont></h3>
                    <br>
                    <form class="boxentry" action="library/insert_notabeli.php" method="post">
                    <div class="entryfield4">
                        <h5 class="headnavigation">No. Nota Beli </h5>
                        <input class="textinput4" type="text" name="nobeli" id="nobeli" value="" autocomplete="off" readonly><br><br>
                        <h5 class="headnavigation">Tanggal Nota Beli</h5>
                        <input class="textinput4" type="text" name="tglbeli" id="tglbeli" value="" autocomplete="off" readonly><br><br>
                       <h5 class="headnavigation">Operator </h5>
				        <input class="textinput4 cleaveuang" type="text" id="operator" name="operator" value="" autocomplete="off" required maxlength="100" readonly><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br>
                    </div>
                    <div class="entryfield4">
                       <h5 class="headnavigation">Total Nota Beli (Rp.)</h5>
                        <input class="textinput4" type="text" name="totalbeli" id="totalbeli" value="" autocomplete="off" readonly><br><br>
                        <h5 class="headnavigation">Sisa Nota Beli (Rp.)</h5>
                        <input class="textinput4" type="text" name="sisa" id="sisa" value="" autocomplete="off" readonly><br><br>
                        <h5 class="headnavigation">Maks. Bayar (Rp.)</h5>
				        <input class="textinput4 cleaveuang" type="text" id="max_bayar" name="max_bayar" value="" autocomplete="off" readonly>
				        </div>
						<div id="ifNo" style="display:block">
				</div>
                   <div class="entryfield5">
						<h5 class="headnavigation " >Status transaksi <redfont><i>*</i></redfont></h5>
						<label class="checkboxlabel" ><h5 class="headnavigation">Transfer</h5>
						<input class="cinput" type="radio" onclick="javascript:yesnoCheck();" name="jenis" id="yesCheck" value="Transfer"/>
						<span class="checkmark"></span>
						</label><br><br>
						<label class="checkboxlabel"><h5 class="headnavigation">Tunai</h5>
						<input type="radio" onclick="javascript:yesnoCheck();" name="jenis" id="noCheck" checked="checked" value="Tunai"/>
						<span class="checkmark"></span>
						</label><br><br>
						<label class="checkboxlabel"><h5 class="headnavigation">Retur</h5>
						<input type="radio" onclick="javascript:yesnoCheck();" name="jenis" id="noCheck1" value="Retur"/>
						<span class="checkmark"></span>
						</label><br><br>
						<label class="checkboxlabel"><h5 class="headnavigation">Giro</h5>
						<input type="radio" onclick="javascript:yesnoCheck();" name="jenis" id="noCheck2" value="Giro"/>
						<span class="checkmark"></span>
						</label><br><br>
                        </div> 
                    <div class="entryfield6">
                        <div class="detailpop">
						<h5 class="headnavigation">Nominal Bayar (Rp.)<redfont><i>(Harus diisi)</i></redfont></h5>
				        <input class="textinput4 cleaveuang" type="text" id="nominal_bayar" name="nominal_bayar" value="" autocomplete="off" required maxlength="100"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3>
                       <h5 style class="headnavigation sembunyikan retur"> Retur Total (Rp.)<redfont><i>(Harus diisi)</i></redfont></h5>
                      <input class="textinput4 cleaveuang sembunyikan retur" type="text" id="total_retur"  name="total_retur" value="0" autocomplete="off" required maxlength="100">
                       <h3 class="headnavigation"   style="float:left; margin:10px 0px 0px 5px;"></h3><br><br>
                       <h5 class="headnavigation sembunyikan"> Nama Rekening <redfont><i>(Pengirim)</i></redfont></h5>
				        <input class="textinput4 sembunyikan" type="text" id="rnamapengirim" name="rnamapengirim" maxlength="50" readonly>    
                         <h5 class="headnavigation sembunyikan"> Nama Rekening <redfont><i>(Penerima)</i></redfont></h5>
                        <input class="textinput4 sembunyikan" type="text" id="rnamapenerima" name="rnamapenerima" maxlength="50" readonly>
                       </div>
                       <div class="detailpop">
                    <div id="ifYes" style="display:none">
				        <div style="display: inline-flex;"><h5 class="headnavigation sembunyikan"> Rekening Nomor <redfont><i>(Pengirim)</i></redfont> </h5>&nbsp;&nbsp;<a class="formsubmit2 sembunyikan" style="margin-bottom:3px;" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck1"><h5>UBAH</h5>
                        </a></div>
				        <input class="textinput4 sembunyikan" type="text" id="rnopengirim" name="rnopengirim" maxlength="50" readonly><br><br>
                        <h5 class="headnavigation sembunyikan"> Rekening Nomor <redfont><i>(Penerima)</i></redfont> </h5>
                        <input class="textinput4 sembunyikan" type="text" id="rnopenerima" name="rnopenerima" maxlength="50" readonly>
                    </div>
                        <h5 class="headnavigation sembunyikan"> Rekening bank <redfont><i>(Pengirim)</i></redfont></h5>
				        <input class="textinput4 sembunyikan" type="text" id="rbankpengirim" name="rbankpengirim" maxlength="50" readonly><br><br>
                          <h5 class="headnavigation sembunyikan"> Rekening bank <redfont><i>(Penerima)</i></redfont></h5>
                        <input class="textinput4 sembunyikan" type="text" id="rbankpenerima" name="rbankpenerima" maxlength="50" readonly>
                        </div>
                        </div>
                    <div class="konfirmasi" style="position:absolute; top:8px; right:0px;">
                        <input class="formsubmit boxsubmit" type="submit" name="" value="Bayar">
                        <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('detailentry');"><h5>BATAL</h5></div>
                    </div>
                    
                 </form>
            <div id="tampil-tabel">  
                <div class="dcctable" style="overflow-x: auto;">
                    <table id="tabel-data5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl. Nota Beli</th>
                                <th>Jenis</th>
                                <th>Jumlah Bayar (Rp.)</th>
                                <th>Sisa Nota Beli (Rp.)</th>
                                <th>Status</th>
                                <th>Operator Bayar (Rp.)</th>
                                <th>Aksi </th>
                            </tr>
                        </thead>
                    <tbody id="tampil_data">
                        
                        </tbody> 
                    </table>
                </div> 
				</div> 
                </div>
        <div class="dcctable" id="tabel-datax" style="overflow-x: auto;">
        <div class="" style="text-align:left;display: inline-flex;">
        <form method="get">
                <label> Pilih Tanggal</label>
                <input type="date" name="tanggal">
                <input type="submit" style="width: 80px;" class="btn-default" value="Cari">
		</form>
		<!-- <input type="button" id="reset" onClick="reset()" value="Reset"> -->
		<button style="margin-left: 10px;" type="reset" onclick="reset()" id="tombol-tutup"> Reset</button>
			</div>
                    <table id="tabel-data">
                        <thead>
                            <tr>
                                <th style="width:1%;">No. &nbsp;</th>
                                <th style="width:2%;">No. Nota Beli &nbsp;</th>
                                <th style="width:2%;">Tgl. Nota Beli &nbsp;</th>
                                <th style="width:14%;">Nama Supplier &nbsp;</th>
                                <th style="width:2%;">Total Nota Beli (Rp.) &nbsp;</th>
                                <th style="width:2%;">Sisa Nota Beli (Rp.) &nbsp;</th>
                                <th style="width:2%;">Total Retur Beli (Rp.)<br><blackfont>[Belum dipotong]</blackfont>&nbsp;</th>
                                <th>Total Retur Beli (Rp.)<br><font color=green>[Sudah dipotong]</font> &nbsp; </th>
                                <th>Total Giro (Rp.) &nbsp;</th>
                                <th>Nominal Giro (Rp.) &nbsp;</th>
                                <th>Pot Giro (Rp.)&nbsp;</th>
                                <th>Total Giro (Rp.)<br><font color=green>[Setelah Potongan]</font> &nbsp; </th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Lihat Data &nbsp;  </th>
                            </tr>
                            
                        </thead>
                        
                        
                        <tbody>
                        <?php
                        if(isset($_GET['tanggal']))
                        {
				        $tgl = $_GET['tanggal'];
                        $transaksi = mysqli_query($db,"SELECT *,( pembelian_harga * pembelian_jumlah ) AS total FROM transaksi INNER JOIN pembelian ON transaksi.transaksi_id=pembelian.transaksi_id WHERE transaksi_tanggal='$tgl'");
                        }
                        else
                        {
                             $transaksi = mysqli_query($db,"SELECT *,( pembelian_harga * pembelian_jumlah ) AS total FROM transaksi INNER JOIN pembelian ON transaksi.transaksi_id=pembelian.transaksi_id GROUP BY pembelian.transaksi_id");
                        }
                            while($row = mysqli_fetch_array($transaksi))
                        {
                            $nota  = $row['transaksi_nota'];
                            $total  = $row['total'];
                            @$bayar = mysqli_fetch_assoc(mysqli_query($db,"select sum(jumlah) as tot from bayar_nota_beli where no_nota_beli = '$nota'"));
                            $sisa = $row['total']- $bayar['tot'];
                            $cek_lunas = mysqli_num_rows(mysqli_query($db,"select * from bayar_nota_beli where no_nota_beli = '$nota' and status=1"));
                                
                            if($cek_lunas == 0){
                                    
                        ?>
                        <tr>
                            <td><?php echo $row['transaksi_id'];?></td>
                            <td><?php echo $row['transaksi_nota'];?></td>
                            <td><?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?></td>
                            <td><?php echo nama_supplier($row['supplier_id']);?></td>
                            <td style="text-align:right;"><?php echo number_format($row['total'],2);?></td>
                            <td style="text-align:right;"><?php echo number_format($sisa,2);?></td>
                            <td><?php echo $row['pembelian_expedisi'];?></td>
                            <td><?php echo $row['pembelian_expedisi'];?></td>
                            <td><?php echo $row['pembelian_expedisi'];?></td>
                            <td><?php echo $row['pembelian_expedisi'];?></td>
                            <td><?php echo $row['pembelian_expedisi'];?></td>
                            <td><?php echo $row['pembelian_expedisi'];?></td>
                            <td style="width:8%;text-align:center;">
                            <?php if($sisa == 0)
                            { 
                            echo "<span class='badge_status_aktif'>Lunas</span>"; 
                            }
                            elseif($sisa == $total)
                            {
                            echo "<span class='badge_status_non_aktif'>Belum Lunas</span>"; 
                            }
                            else
                            { 
                            echo "<span class='badge_status_non_aktif'>Angsur</span>"; 
                            }?></td>
                            <td style="width:8%;text-align:center;">
                            <?php if($sisa == 0 || $sisa < 0)
                        { 
                                ?>
                                
                            <div class="formsubmit1 disabled"><h5>Bayar</h5>
                            </div>
                            <?php }else{ ?>    
                             <div class="formsubmit1 datalookup" 
                             data_sisa="<?php echo number_format($sisa,2); ?>"
                          data-nota="<?php echo $row['transaksi_nota'];?>" 
                           data-tgl="<?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?>"
                           total-beli="<?php echo number_format($row['total'],2);?>"
                           operator="<?php echo strtoupper("$userjob") ?> / <?php echo $usernamalengkap ?>"><h5>Bayar</h5>
                            </div>
                        <?php } ?>
                            </td>
                            <td style="width:8%;text-align:center;">
                        <div class="datalookup1" 
                           id = "<?php echo $row['id']; ?>"
                           no-beli1="<?php echo $row['transaksi_nota'];?>"
                           tgl-beli1="<?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?>"
                           jenis-beli="<?php echo $row['transaksi_id'];?>"
                           nama-sup="<?php echo nama_supplier($row['supplier_id']);?>"
                           jum-nota="<?php echo number_format($row['total'],2);?>"><h5><i class="fas fa-list fas2"></i>Detail</h5></div>
                            </td>
                        </tr>
                        <?php
                        } }
                        ?>
                        </tbody> 
                         <script>
                            $(document).ready(function(){
                                $('#tabel-data').DataTable({
                                });
                            });
                        </script>
                    </table>
                </div>
    
        </div>    
<div id="bg"></div>
	<div id="modal-kotak">
		<div id="atas">
			Pilih Rekening
            <hr>
            </div>
               <br>
        <div  id="kiri" class="boxentry">
          <h5 class="headnavigation">Rekening Pengirim<redfont>(Harus di isi)</redfont></h5>
            <div class="pilbar1">
            <select class="textinput3 pilihan_rek1" id="pilihan_rek1" name="pilihan_rek1" required >
                  <option disabled value="" selected hidden>Pilih Rekening</option>  
                    <?php 
                    $data_rek = mysqli_query($db,"select rekening_id,rekening_pemilik,rekening_bank, rekening_nomor from rekening where rekening_jenis = 1");
                    while($list_rek = mysqli_fetch_assoc($data_rek)){ ?>

                        <option data-nomor1="<?php echo $list_rek['rekening_nomor']; ?>" 
						data-pemilik1="<?php echo $list_rek['rekening_pemilik']; ?>" 
						data-bank1="<?php echo $list_rek['rekening_bank']; ?>" value="
						<?php echo $list_rek['rekening_id']; ?>">
						<?php echo $list_rek['rekening_pemilik']." - ".$list_rek['rekening_bank']."-".$list_rek['rekening_nomor']; ?>
						</option>
                <?php
                    }
                ?>
            </select><br><br><br><br><br><br><br>
            <script type="text/javascript">
                $(".pilihan_rek1").select2({
                allowClear: true
                 });
            </script>
        </div>
        <div id="bawah">
			<button id="tombol-tutup">TUTUP</button>
        </div>
        </div> 
        <div  id="kanan">
            <h5 class="headnavigation">Rekening Penerima <redfont>(Harus di isi)</redfont></h5>
            <div class="pilbar2">
            <select class="textinput3 pilihan_rek2" id="pilihan_rek2" name="pilihan_rek2" required>                    
             <option disabled value="" selected hidden>Pilih Rekening</option>
                <?php 
                  $data_rekx = mysqli_query($db,"select rekening_id,rekening_pemilik,rekening_bank,rekening_nomor from rekening where rekening_jenis = 2");
                    while($list_rekx = mysqli_fetch_assoc($data_rekx))
                    { ?>
                 <option 
                 data-nomor="<?php echo $list_rekx['rekening_nomor']; ?>" 
                 data-pemilik="<?php echo $list_rekx['rekening_pemilik']; ?>" 
                 data-bank="<?php echo $list_rekx['rekening_bank']; ?>" 
                 value="<?php echo $list_rekx['rekening_id']; ?>">
                 <?php echo $list_rekx['rekening_pemilik']." - ".$list_rekx['rekening_bank']." - ".$list_rekx['rekening_nomor']; ?>
                 </option>
                <?php
                 }
                ?>
            </select><br><br><br><br><br><br><br>
        </div>   
            <script type="text/javascript">
                $(".pilihan_rek2").select2({
                allowClear: true
                });
            </script>
            <div id="bawah">
			<button id="tombol-pilih">PILIH</button>
            </div>
         </div>`  
    </div>     
            <div class="detailcontainer" id="detailbox">
                    <h3 class="headnavigation"><redfont><i class="fas fa-people-carry"></i> Detail Nota Bayar </redfont></h3>
                    <br>
                    <form class="boxentry" action="library/insert_notabeli.php" method="post">
                    <div class="entryfield">
                        <h5 class="headnavigation">No. Nota Jual </h5>
                        <input class="textinput2" type="text" name="nobeli1" id="nobeli1" value="" autocomplete="off" readonly><br>
                         <h5 class="headnavigation">Jumlah Nota </h5>
                        <input class="textinput2" type="text" name="jumnota" id="jumnota" value="" autocomplete="off" readonly><br>
                    </div>
                     <div class="entryfield">
                        <h5 class="headnavigation">Nama Supliier </h5>
                        <input class="textinput2" type="text" name="namasup" id="namasup" value="" autocomplete="off" readonly><br>   
                    </div>
                    <div class="entryfield">
                         <h5 class="headnavigation">Tgl. Nota Jual </h5>
                        <input class="textinput2" type="text" name="tglbeli1" id="tglbeli1" value="" autocomplete="off" readonly><br>
                    </div><br>
                    
                    <div class="konfirmasi" style="position:absolute; top:8px; right:12px";>
                        <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('detailbox');"><h5>Kembali</h5></div>
                    </div>
                 </form>
                 <div id="tampil-tabel">  
                <div class="dcctable">
                    <table id="tabel-data0">
                        <thead>
                            <tr>
                               
                               <th>No</th>
                                <th>Tgl. Nota Beli</th>
                                <th>Jenis</th>
                                <th>Jumlah Bayar (Rp.)</th>
                                <th>Sisa Nota Beli (Rp.)</th>
                                <th>Status</th>
                                <th>Operator Bayar (Rp.)</th>
                                <th>Aksi </th>
                            </tr>
                        </thead>
                        <tbody id="tampil_data2">
                        </tbody> 
                    </table>
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
				$('#modal-kotak , #bg').fadeIn("slow");
		});
        $('#yesCheck1').click(function()
                        {
				$('#modal-kotak , #bg').fadeIn("slow");
		});
		$('#tombol-tutup').click(function(e)
                                 {
            e.preventDefault()
			$('#modal-kotak , #bg').fadeOut("slow");
		});
		
		$('#tombol-pilih').click(function(e)
                                 {
            e.preventDefault();
            var nama = $("#pilihan_rek1").find(":selected").attr("data-pemilik1");
			var bank = $("#pilihan_rek1").find(":selected").attr("data-bank1");
			var nomor = $("#pilihan_rek1").find(":selected").attr("data-nomor1");
            
            
			var nama2 = $("#pilihan_rek2").find(":selected").attr("data-pemilik");
			var bank2 = $("#pilihan_rek2").find(":selected").attr("data-bank");
			var nomor2 = $("#pilihan_rek2").find(":selected").attr("data-nomor");
            
            if(nama == undefined || nama2 == undefined)
            {
                alert("Pilihan rekening harus diisi.");
            }else{
                $("#rnamapengirim").val(bank);
                $("#rbankpengirim").val(nama);
                $("#rnopengirim").val(nomor);
                $(".sembunyikan").addClass("tampilkan");
                $(".tampilkan").removeClass("sembunyikan");
                $(".retur").hide();
                $("#rnamapenerima").val(bank2);
                $("#rbankpenerima").val(nama2);
                $("#rnopenerima").val(nomor2);
			    $('#modal-kotak , #bg').fadeOut("slow"); 
            }
		});
        
	});
</script>

<script type="text/javascript">
					 window.onload = function() 
					 {
						document.getElementById('ifYes').style.display = 'none';
						document.getElementById('ifNo').style.display = 'none';
						document.getElementById('ifNo').style.display = 'none';
					}
					function yesnoCheck()
					 {
						if (document.getElementById('yesCheck').checked) 
						{
							document.getElementById('ifYes').style.display = 'block';
							document.getElementById('ifNo').style.display = 'none';
						} 
						else if(document.getElementById('noCheck').checked) {
							document.getElementById('ifNo').style.display = 'block';
							document.getElementById('ifYes').style.display = 'none';
                             $(".tampilkan").addClass("sembunyikan");
                                $(".sembunyikan").removeClass("tampilkan");
                                $(".retur").hide();
					   }
						   else if(document.getElementById('noCheck1').checked) {
							document.getElementById('ifNo').style.display = 'block';
							document.getElementById('ifYes').style.display = 'none';
                               $(".tampilkan").addClass("sembunyikan");
                                $(".sembunyikan").removeClass("tampilkan");
                                $(".retur").show();
					   }
					}
    
</script>


<script>
function reset(){
	var url = "nota_beli.php";
	window.location=url;
        }
</script>