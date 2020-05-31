<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<style type="text/css">
	#header tr td{
		padding: 2px!important;
	}
</style>
<center><b><u style="font-size:20px;">Nota Beli</u></b></center>
<img alt="Coding Sips" src="barcode.php?codetype=Code128&size=30&text=<?php echo $_GET['kode']; ?>&print=true" />

<table style="100%;font-size:12px;" class="nowrap" id="head">
		<?php 
				include('../library/config.php');
				//include('../library/session.php');
  				include('../library/config_hakakses.php');
  				$id = $_GET['id'];
				$data = mysqli_fetch_assoc(mysqli_query($db,"select * from transaksi inner join supplier on transaksi.supplier_id=supplier.supplier_id where transaksi.transaksi_id='$id'"));

				$ppn=$data['transaksi_ppn']; $disc=$data['transaksi_diskon']; $tot_jual=0;
				$sql = mysqli_query($db,"select * from pembelian where transaksi_id='$id'");
				while($key = mysqli_fetch_assoc($sql)){
				 	$sebelum_disc =  $key['pembelian_jumlah'] * $key['pembelian_harga'];
                 	$setelah_disc =  $sebelum_disc - ($sebelum_disc *($key['pembelian_diskon']/100));
					$tot_jual += $setelah_disc;
			   	}	
			   	$disc_nota = ($tot_jual*($disc/100)); 
			   	$totdisc_nota = ($tot_jual-$disc_nota);
			   	$ppn_nota = ($totdisc_nota*($ppn/100)); 
			   	$totppn_nota = ($totdisc_nota+$ppn_nota);
		?>
		<tbody id="header">
			<tr>
				<th style="width:23%">Tgl. Nota Beli</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:38%;"><?php echo date('d/M/Y',strtotime($data['transaksi_tanggal'])); ?></td>
				<th style="width:14%;">No. Nota Beli</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:25%;"><?php echo $data['transaksi_nota']; ?></td>
			</tr>
			<tr>
				<th style="width:23%">Nama Supplier</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:38%;"><?php echo nama_supplier($data['supplier_id']); ?></td>
				<th style="width:14%;">Operator Nota</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:25%;"><?php echo nama_opt($data['transaksi_opid']); ?></td>
			</tr>
			<tr>
				<th style="width:23%">Jumlah Nota Beli</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:38%;"> Rp. <?php echo number_format($tot_jual,2,".",","); ?></td>
				<th style="width:14%;">Jenis Nota</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:25%;"><?php if($data['transaksi_tipe'] == 0){ echo "Tunai"; }else{ echo "Kredit"; } ?></td>
			</tr>
			<tr>
				<th style="width:23%">Tot. Set. Disc Nota (<?php echo $disc; ?>%)</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:38%;"> Rp. <?php echo number_format($totdisc_nota,2,".",","); ?></td>
				<th style="width:14%;"></th>
				<td style="padding-right: 10px;"></td>
				<td style="width:25%;"></td>
			</tr>
			<tr>
				<th style="width:23%">Tot. Set. PPN Nota (<?php echo $ppn; ?>%)</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:38%;">Rp. <?php echo number_format($totppn_nota,2,".",","); ?></td>
				<th style="width:14%;"></th>
				<td style="padding-right: 10px;"></td>
				<td style="width:25%;"></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table style="100%;font-size:12px;" class="table table-bordered">
        <thead>
            <tr>
                <th style="width:3%;">No.</th>
                <th style="width:19%;">Nama Bahan Baku</th>
                <th style="width:15%;">Qty Beli</th>
                <th style="width:22%;">Harga Jual (Rp.)</th>
                <th style="width:10%;">Disc (%)</th>
                <th style="width:24%;">Tot. Set. Disc (Rp.)</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=0; $setelah_disc3=0; 
        		$sql2 = mysqli_query($db,"select * from pembelian where transaksi_id='$id'");
        		$no=0;
				while($key2 = mysqli_fetch_assoc($sql2)){
				 	$sebelum_discx =  $key2['pembelian_jumlah'] * $key2['pembelian_harga'];
				 	if($key2['pembelian_diskon'] != 0){
                 		$setelah_discx =  $sebelum_discx - ($sebelum_discx * ($key2['pembelian_diskon']/100));
                 	}else{
                 		$setelah_discx =  $sebelum_discx;
                 	}
					//$tot_jualx += $setelah_discx;
					$no++;
		?>
            <tr>
                <td style="text-align:center;"><?php echo $no; ?></td>
                <td><?php echo nama_material($key2['material_id']); ?></td>
                <td><?php echo str_replace(".00","",number_format($key2['pembelian_jumlah'],2,".",",")); ?> <?php echo nama_status_material($key2['material_id']) ?></td>
                <td style="text-align:right;">Rp. <?php echo number_format($key2['pembelian_harga'],2,".",","); ?></td>
                <td style="text-align: center;"><?php echo str_replace(".00","",number_format($key2['pembelian_diskon'],2,".",",")); ?>%</td>
                <td style="text-align:right;">Rp. <?php echo number_format($setelah_discx,2,".",",");; ?></td>
            </tr>
		<?php } ?>	
        </tbody>
    </table>
    <div style="float: right;padding-right: 50px;">
    	<div style="text-align: center;">
	    	<h6>Dicetak Oleh:</h6>
	    	<br>
	    	<h5><?php echo $_GET['cetak']; ?></h5>
    	</div>
    </div>

    <script type="text/javascript">
    	window.print();
    </script>