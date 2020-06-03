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
    <link rel="stylesheet" href="asset/css/bootstrap.min.css"> 
    
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/cleave.min.js"></script>
    <script type="text/javascript" src="script/script.js"></script>
    <script type="text/javascript" src="script/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="script/select2.js"></script>
    <script src="asset/js/popper.min.js"></script> 
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
    <style>
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

        $('#tabel-data').hide();
        $('#tabel-data_wrapper').hide();

        var nonota = $(this).attr("data-nota");
        $("#nojual").val(nonota);
        
        var tglnota = $(this).attr("data-tgl");
        $("#tgljual").val(tglnota);
        
        var totaljual = $(this).attr("total-jual");
        var totaljl   = $(this).attr("total-jl");
        $("#totaljual").val(totaljual);
        
        var diskon      = $(this).attr("data-diskon");
        // var hasildiskon = (diskon/100)*totaljl;
        // var totaldiskon = hasilppn - hasildiskon;
        var totaldiskon = totaljl - (totaljl*(diskon/100)); 
        $("#ndiskon").val(diskon);
        $("#diskon").val(totaldiskon);
        // alert(totaldiskon);
        $("#diskon1").val(totaldiskon);
        $("#diskon1").val(formatRupiah($('#diskon1').val(), ""));

        var ppn = $(this).attr("data-ppn");
        // var totppn   = parseInt(totaljl) * parseInt(ppn) / 100;
        // var hasilppn = parseInt(totaljl) - parseInt(totppn);
        var hasilppn = totaldiskon + (totaldiskon*(ppn/100));
        $("#nppn").val(ppn);
        $("#ppn").val(hasilppn);
        // alert(hasilppn);
        $('#ppn1').val(hasilppn);
        $('#ppn1').val(formatRupiah($('#ppn1').val(), ""));

        var tenor = $(this).attr("data-tenor");
        $('.itenor').val(tenor);
        $('.ippn').val(ppn);
        $('.idiskon').val(diskon);
        
        var sisa = $(this).attr("data-sisa");
        $("#sisa").val(sisa);
        
        var operator = $(this).attr("operator");
        $("#operator").val(operator);

        var jenisbayar = "Lunas";
        $('#jenis-bayar').val(jenisbayar);

        var notrans = $(this).attr('data-transaksi');
        $('#notrans').val(notrans);

        tampil_datax(notrans);
        
        var detail = $(this).attr("detail");
        
        $('.entryfield6').show(1000);

        if (detail == "True"){
            $('#rpsisa').text("Lunas");
            $('#nominal_bayar').val("");
            $('#totsis').val("");
            $('#rptotsisa').text("");
            $('#rpinp').text("");
            $('.konfir').hide();
        }else{
            $('.konfir').show();
        }

        $('.tb-history').hide();
        $('.tb-history').show();
        $("#detailentry").show(1000);
        $("#tampil-tabel").hide();
    });
});

function tampil_datax(nonota){
    var dt = '';
    
    $.ajax({
		type: 'POST',
		url: "library/load_jual_barang.php",
        data: {nonota: nonota},
		success: function(respon) {
			var dat = JSON.parse(respon);
            var i = 0;
            var total = 0;
            $.each(dat, function(key,value) {
                i ++;
                total = total + value.barang_harga * value.penjualan_jumlah;
                dt += 
                `<tr>
                    <td style="text-align:center">`+ value.barang_id +`</td>
                    <td style="text-align:center">`+ value.barang_nama +`</td>
                    <td style="text-align:center" id="pjumlah">`+ value.penjualan_jumlah +` Frame</td>
                    <td style="text-align:center"> <input type="number" min="0" class="inqty-`+value.penjualan_id+`" value="`+value.penjualan_jumlah+`"><input type="hidden" id="id_jual"> <a style="color: white;" class="ubah-btn detail-nota badge_status_aktif konfir btn-primary" data-idp="`+value.penjualan_id+`">Ubah</a></td>
                    <td style="text-align:center">`+ formatRupiah(value.barang_harga, "Rp:") +`</td>
                </tr>`;
                
            });
            $('#ttlhrg').val(total);
            $('.tampil-dt').html(dt);
            $('#totaljual').val(formatRupiah($('#ttlhrg').val(), ""));
            
            // var hasildiskon = ($("#ndiskon").val()/100)*parseInt($('#ttlhrg').val());
            // var totaldiskon = hasilppn - hasildiskon;
            // var totaldiskon = $("#nppn").val(hasilppn);
            var totaldiskon = parseInt($('#ttlhrg').val()) - (parseInt($('#ttlhrg').val())*(parseInt($("#ndiskon").val())/100));
            $("#diskon1").val(totaldiskon);
            $("#diskon1").val(formatRupiah($('#diskon1').val(), ""));
            
            // var totppn   = parseInt($('#ttlhrg').val()) * parseInt($('#nppn').val()) / 100;
            // var hasilppn = parseInt($('#ttlhrg').val()) - parseInt(totppn);
            // var hasilppn = $("#nppn").val(hasilppn);
            var hasilppn = totaldiskon + (totaldiskon*($('#nppn').val()/100));
            $('#ppn1').val(hasilppn);
            $('#ppn1').val(formatRupiah($('#ppn1').val(), ""));
            
		}
	});

}

$(document).ready(function(){
    $('#tb-dt').on('click', '.ubah-btn', function(){
        var idp = $(this).attr('data-idp');
        var qty = $('.inqty-'+idp).val();
        var notrans = $('#notrans').val();
        $.ajax({
            type: 'POST',
		    url: "library/ubah_penjualan_jumlah.php",
            data: {
                id_jual: idp,
                qty: qty,
            },
            success: function(respon) {
                tampil_datax(notrans);
            }
        });
    });
});

// function tampil_qty(nonota){

//     $.ajax({
// 		type: 'POST',
// 		url: "library/load_jual_barang.php",
//         data: {nonota: nonota},
// 		success: function(respon) {
// 			var dat = JSON.parse(respon);
//             var i = 0;
//             $.each(dat, function(key,value) {
//                 $('.jmlh').val(value.penjualan_jumlah);
//             });
// 		}
// 	});

// }
</script>
<script>

    // function ubah(){
    //     $(document).on('keypress',function(e) {
    //         if(e.which == 13) {
    //             var id_jual = $('#id_jual').val();
    //             var nonota = $("#nojual").val();
    //             var notrans = $('#notrans').val();
    //             var qty = $('.inqty').val();
                
    //             $.ajax({
    //                 type: 'POST',
	// 	            url: "library/ubah_penjualan_jumlah.php",
    //                 data: {
    //                     id_jual: id_jual,
    //                     qty: qty,
    //                 },
    //                 success: function(respon) {
    //                     tampil_datax(notrans);
    //                 }
    //             });
    //         }
    //     });
    // }

</script>

<title>Lotus - Konfirmasi Nota</title>

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
                <h5 class="headnavigation2">Lotus <redfont>/</redfont> Konfirmasi Penjualan</h5>
            </div>
        </div>
        
        <hr class="hrred">
            <div class="dashcontainer1">
                <div class="detailcontainer1" id="detailentry">
                    <h3 class="headnavigation"><redfont><i class="fas fa-people-carry"></i> Bayar Nota</redfont></h3>
                    <br>
                    <form class="boxentry" action="library/insert_notajual.php" method="post">
                    <div class="entryfield4">

                        <input type="hidden" id="notrans" value="">

                        <h5 class="headnavigation">No. Nota jual </h5>
                        <input class="textinput4" type="text" name="nojual" id="nojual" value="" autocomplete="off" readonly><br><br>
                        <h5 class="headnavigation">Tanggal Nota jual</h5>
                        <input class="textinput4" type="text" name="tgljual" id="tgljual" value="" autocomplete="off" readonly><br><br>
                       <h5 class="headnavigation">Nama Pelanggan </h5>
				        <input class="textinput4 cleaveuang" type="text" id="operator" name="operator" value="" autocomplete="off" required maxlength="100" readonly><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3><br>
                    </div>
                    <div class="entryfield4">
                       <h5 class="headnavigation">Total Nota jual (Rp.)</h5>
                        <input class="textinput4" type="text" name="totaljual" id="totaljual" value="" autocomplete="off" readonly><br><br>
                        <h5 class="headnavigation">Jenis Bayar</h5>
				        <input class="textinput4 cleaveuang" type="text" id="jenis-bayar" name="max_bayar" value="Kredit" autocomplete="off" readonly>
				        <!-- <h5 class="headnavigation">Sisa Bayar</h5>
                        <input class="textinput4" type="number" name="sisa" id="sisa" value="" autocomplete="off" readonly required>
                        <p>Sisa Bayar (Rp).<h4 id="rpsisa"></h4></p> -->
                        </div>
						<div id="ifNo" style="display:block">
                        
				</div>
                   <div class="entryfield5">
                        <br><br>
						<!-- <h5 class="headnavigation " >Status transaksi <redfont><i>*</i></redfont></h5>
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
						</label><br><br> -->
                    </div> 
                    <div class="entryfield6">
                        <div class="detailpop">
                        <!-- <h5 class="headnavigation">Sisa Nota jual (Rp.)</h5>
     -->
                        <label>Tenor (Hari)
                        <input class="textinput4 itenor" type="text" value="" autocomplete="off" value="0"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3></label><br>

                        <label>Diskon (%)
                        <input class="textinput4 idiskon" type="text" value="" autocomplete="off" value="0"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3></label><br>

                        <label>PPN (%)
                        <input class="textinput4 ippn" type="text" value="" autocomplete="off" value="0"><h3 class="headnavigation" style="float:left; margin:10px 0px 0px 5px;"></h3></label><br>
                        
                        <!-- rupiah -->
                        <script>
                            function formatRupiah(angka, prefix) {
                                    var number_string = angka
                                            .replace(/[^,\d]/g, '')
                                            .toString(),
                                        split = number_string.split(','),
                                        sisa = split[0].length % 3,
                                        rupiah = split[0].substr(0, sisa),
                                        ribuan = split[0]
                                            .substr(sisa)
                                            .match(/\d{3}/gi);

                                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                    if (ribuan) {
                                        separator = sisa
                                            ? '.'
                                            : '';
                                        rupiah += separator + ribuan.join('.');
                                    }

                                    rupiah = split[1] != undefined
                                        ? rupiah + ',' + split[1]
                                        : rupiah;
                                    return prefix == undefined
                                        ? rupiah
                                        : (
                                            rupiah
                                                ? 'Rp. ' + rupiah
                                                : ''
                                        );
                            }
                        </script>
                        <!-- rupiah -->
                       
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
                        
                    <p></p>
                    <table class="dcctable tb-history">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Qty Jual</th>
                                <th>Ubah Qty Jual</th>
                                <th>Harga (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody class="tampil-dt" id="tb-dt">
                                    
                        </tbody>
                        <input type="hidden" id="ttlhrg" value="">
                    </table>
                    
                    <!-- <h5 class="headnavigation">Total Nota jual (Rp.)</h5>
                    <input class="textinput4" type="text" name="totaljual" id="totaljual" value="" autocomplete="off" readonly><br><br> -->

                    <div class="entryfield5">
                       <br><br>
                       <!-- form ppn -->
                       <!-- <h5 class="headnavigation">Jumlah Sebelum Diskon Dari PPN</h5> -->
                       <input class="textinput4" type="hidden" name="" id="nppn" value="" autocomplete="off" readonly>
                       <input class="textinput4" type="hidden" name="totaljual" id="ppn" value="" autocomplete="off" readonly>
                       <input type="hidden" id="nnppn">
                       <!-- dibawah ppn yang di hide/munculkan -->
                       <input class="textinput4" type="hidden" name="totaljual" id="ppn1" value="" autocomplete="off" readonly><br><hr>
                       <h5 class="headnavigation">Jumlah Setelah Diskon Dari PPN</h5>
                       
                       <!-- form diskon -->
                       <input class="textinput4" type="hidden" name="" id="ndiskon" value="" autocomplete="off" readonly>
                       <input class="textinput4" type="hidden" name="totaljual" id="diskon" value="" autocomplete="off" readonly>
                       <input class="textinput4" type="text" name="totaljual" id="diskon1" value="" autocomplete="off" readonly><br><hr>
                    </div> 
                    <!-- <script type="text/javascript">
                            var cleave = new Cleave('#ppn1', {
                                numeral: true,
                                numeralDecimalMark: 'thousand',
                                delimiter: '.'
                            });
                    </script> -->
                        
                    <div class="konfirmasi" style="position: absolute; margin-top: 500; margin-left: 850px;">
                        <a class="formsubmit boxsubmit badge_status_aktif konfir btn-success" id="terima" >Terima</a>
                        <a class="formsubmit boxsubmit badge_status_non_aktif konfir btn-danger" id="tolak" >Tolak</a>
                        <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('detailentry');"><h5>Kembali</h5></div>
                    </div>

                    <script>
                        $('.formsubmitcancel').click(function(){
                            window.location.href = 'konfirmasi_penjualan.php';  
                        });
                    </script>

                    <script>
                        $(document).ready(function(){
                            $('.konfir').click(function(){
                                var hasil = $(this).attr('id');
                                var no_nota = $('#nojual').val();
                                $.ajax({
                                    type: 'POST',
		                            url: "library/konfirmasi_nota_jual.php",
                                    data: {
                                        nonota: no_nota,
                                        hasil: hasil
                                    },
                                    success: function(respon) {
                                        alert("Transaksi Berhasil Di"+respon);  
                                        window.location.href = 'konfirmasi_penjualan.php';
                                    }
                                });
                            });
                        });
                    </script>
                    
                 </form>
            <div id="tampil-tabel">  
                <div class="dcctable" style="overflow-x: auto;">
                    <table id="tabel-data5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl. Nota jual</th>
                                <th>Jenis</th>
                                <th>Jumlah Bayar (Rp.)</th>
                                <th>Sisa Nota jual (Rp.)</th>
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

		<!-- <input type="button" id="reset" onClick="reset()" value="Reset"> -->
	
			</div>
                    <table id="tabel-data">
                        <thead>
                            <tr>
                                <th style="width:1%;">No. &nbsp;</th>
                                <th style="width:2%;">Tanggal &nbsp;</th>
                                <th style="width:2%;">No. Nota Jual &nbsp;</th>
                                <th style="width:14%;">Nama Pelanggan &nbsp;</th>
                                <th style="width:14%;">Status Bayar &nbsp;</th>
                                <th style="width:2%;">Jumlah Nota (Rp.) &nbsp;</th>
                                <th>Aksi</th>
                            </tr>
                            
                        </thead>
                        
                        
                        <tbody>
                        <?php
                            // ( 1 * penjualan_jumlah) 1 = harga penjualan nanti
                            $transaksi = mysqli_query($db,"SELECT * ,SUM( barang_harga * penjualan_jumlah ) AS total FROM penjualan INNER JOIN transaksi ON penjualan.transaksi_id=transaksi.transaksi_id INNER JOIN barang ON penjualan.barang_id=barang.barang_id GROUP BY penjualan.transaksi_id ORDER BY transaksi.transaksi_proses ASC");
                            $i = 0;
                            
                            while($row = mysqli_fetch_array($transaksi))
                        {
                            $i++;

                            $nota  = $row['transaksi_nota'];
                            
                            $sts = $row['transaksi_proses'];

                            $bayar = mysqli_fetch_assoc(mysqli_query($db,"select sum(jumlah) as tot from bayar_nota_jual where transaksi_id = '$nota'"));
                            $sisa = $row['total'] - $bayar['tot'];

                        ?>  
                        <tr>
                            <td><?= $i ?></td>
                            <td><?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?></td>
                            <td><?= $row['transaksi_nota'];?></td>
                            
                            <td><?php echo nama_supplier($row['pelanggan_id']);?></td>

                            <td style="width:8%;text-align:center;">
                             
                            <?php if ($sts == 0) : ?>

                                <span class='badge_status'>Belum Dikonfirmasi</span> 
                            
                            <?php elseif ($sts == 1) : ?>
                            
                                <span class='badge_status_aktif'>Dikonfirmasi</span> 
                            
                            <?php elseif ($sts == 2) : ?>

                                <span class='badge_status_non_aktif'>Ditolak</span>

                            <?php endif; ?>

                            </td>
                            
                            <td style="text-align:right;"><?php echo number_format($row['total'],2);?></td>

                            <td style="width:8%;text-align:center;">

                                <button
                                    class="btn btn-primary dropdown-toggle"
                                    type="button"
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="padding: 15px;">
                                    <?php if ($sts == 0) : ?>
                                        <a style="color: white;" class="datalookup detail-nota badge_status_aktif btn-primary"
                                        data-tenor="<?= $row['transaksi_tenor'] ?>"
                                        data-ppn="<?= $row['transaksi_ppn'] ?>"
                                        data-diskon="<?= $row['transaksi_diskon'] ?>"
                                        data-transaksi="<?= $row['transaksi_id'] ?>"
                                        data-sisa="<?= number_format($sisa,2) ?>"
                                        data-nota="<?= $row['transaksi_nota'];?>" 
                                        data-tgl="<?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?>"
                                        total-jual="<?php echo number_format($row['total'],2);?>"
                                        total-jl="<?= $row['total'] ?>"
                                        operator="<?= nama_supplier($row['pelanggan_id']) ?>"
                                        detail="True"
                                        >Detail</a>
                                        &nbsp;
                                        <a style="color: white;" class="datalookup detail-nota badge_status_aktif btn-success"
                                        data-tenor="<?= $row['transaksi_tenor'] ?>"
                                        data-ppn="<?= $row['transaksi_ppn'] ?>"
                                        data-diskon="<?= $row['transaksi_diskon'] ?>"
                                        data-transaksi="<?= $row['transaksi_id'] ?>"
                                        data-sisa="<?= number_format($sisa,2) ?>"
                                        data-nota="<?= $row['transaksi_nota'];?>" 
                                        data-tgl="<?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?>"
                                        total-jual="<?php echo number_format($row['total'],2);?>"
                                        total-jl="<?= $row['total'] ?>"
                                        operator="<?= nama_supplier($row['pelanggan_id']) ?>"
                                        detail="False"
                                        >Terima</a>
                                        <a style="color: white;" class="datalookup detail-nota badge_status_non_aktif btn-danger"
                                        data-tenor="<?= $row['transaksi_tenor'] ?>"
                                        data-ppn="<?= $row['transaksi_ppn'] ?>"
                                        data-diskon="<?= $row['transaksi_diskon'] ?>"
                                        data-transaksi="<?= $row['transaksi_id'] ?>"
                                        data-sisa="<?= number_format($sisa,2) ?>"
                                        data-nota="<?= $row['transaksi_nota'];?>" 
                                        data-tgl="<?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?>"
                                        total-jual="<?php echo number_format($row['total'],2);?>"
                                        total-jl="<?= $row['total'] ?>"
                                        operator="<?= nama_supplier($row['pelanggan_id']) ?>"
                                        detail="False"
                                        >Tolak</a>
                                    <?php else : ?>
                                        <a style="color: white;" class="datalookup detail-nota badge_status_aktif btn-primary"
                                        data-tenor="<?= $row['transaksi_tenor'] ?>"
                                        data-ppn="<?= $row['transaksi_ppn'] ?>"
                                        data-diskon="<?= $row['transaksi_diskon'] ?>"
                                        data-transaksi="<?= $row['transaksi_id'] ?>"
                                        data-sisa="<?= number_format($sisa,2) ?>"
                                        data-nota="<?= $row['transaksi_nota'];?>" 
                                        data-tgl="<?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?>"
                                        total-jual="<?php echo number_format($row['total'],2);?>"
                                        total-jl="<?= $row['total'] ?>"
                                        operator="<?= nama_supplier($row['pelanggan_id']) ?>"
                                        detail="True"
                                        >Detail</a>
                                        &nbsp;
                                        <a class="badge_status_aktif disabled btn-secondary" disabled='disabled'>Terima</a>
                                        <a class="badge_status_non_aktif disabled btn-secondary" disabled='disabled'>Tolak</a>
                                    <?php endif; ?>
                                </div>

                            </td>
                            <!-- <td style="width:8%;text-align:center;">
                         -->
                        <!-- <div class="datalookup1" 
                           id = "<?php echo $row['id']; ?>"
                           no-jual1="<?php echo $row['transaksi_nota'];?>"
                           tgl-jual1="<?php echo date('d/m/Y',strtotime($row['transaksi_tanggal']));?>"
                           jenis-jual="<?php echo $row['transaksi_id'];?>"
                           nama-sup="<?php echo nama_supplier($row['supplier_id']);?>"
                           jum-nota="<?php echo number_format($row['total'],2);?>"><h5><i class="fas fa-list fas2"></i>Detail</h5>
                        </div> -->
                            <!-- </td> -->
                        </tr>
                        <?php
                            } 
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
                    <form class="boxentry" action="library/insert_notajual.php" method="post">
                    <div class="entryfield">
                        <h5 class="headnavigation">No. Nota Jual </h5>
                        <input class="textinput2" type="text" name="nojual1" id="nojual1" value="" autocomplete="off" readonly><br>
                         <h5 class="headnavigation">Jumlah Nota </h5>
                        <input class="textinput2" type="text" name="jumnota" id="jumnota" value="" autocomplete="off" readonly><br>
                    </div>
                     <div class="entryfield">
                        <h5 class="headnavigation">Nama Supliier </h5>
                        <input class="textinput2" type="text" name="namasup" id="namasup" value="" autocomplete="off" readonly><br>   
                    </div>
                    <div class="entryfield">
                         <h5 class="headnavigation">Tgl. Nota Jual </h5>
                        <input class="textinput2" type="text" name="tgljual1" id="tgljual1" value="" autocomplete="off" readonly><br>
                    </div><br>
                    
                    <div class="konfirmasi" style="position:absolute; top:8px; right:12px";>
                        <div class="formsubmitcancel" onclick="datalookup('dcctable'); datahide('detailbox');"><h5>Kembali</h5></div>
                    </div>
                 </form>
                 <div id="tampil-tabel">  
                <div class="dcctable">
                    <!-- <table id="tabel-data0">
                        <thead>
                            <tr>
                               
                               <th>No</th>
                                <th>Tgl. Nota jual</th>
                                <th>Jenis</th>
                                <th>Jumlah Bayar (Rp.)</th>
                                <th>Sisa Nota jual (Rp.)</th>
                                <th>Status</th>
                                <th>Operator Bayar (Rp.)</th>
                                <th>Aksi </th>
                            </tr>
                        </thead>
                        <tbody id="tampil_data2">
                        </tbody> 
                    </table> -->
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
	var url = "nota_jual.php";
	window.location=url;
        }
</script>
