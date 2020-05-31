<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<style type="text/css">
	#header tr td{
		padding: 2px!important;
	}
</style>
<center><b><u style="font-size:20px;">Nota Retur Pembelian</u></b></center>
<img alt="Coding Sips" src="barcode.php?codetype=Code128&size=30&text=<?php echo $_GET['kode']; ?>&print=true" />

<table style="100%;font-size:12px;" class="nowrap" id="head">
		<?php 
			include('../library/config.php');
			//include('../library/session.php');
				include('../library/config_hakakses.php');
				$id = $_GET['id'];
				$trans = $_GET['trans'];
			$data = mysqli_fetch_assoc(mysqli_query($db,"select * from retur_beli where id_retur_beli='$id'"));
			$sp = mysqli_fetch_assoc(mysqli_query($db,"select * from transaksi where transaksi_id='$trans'"));

			$tot_retur=0;
			$sql = mysqli_query($db,"select * from retur_beli_detail where id_retur_beli='$id'");
			while($key = mysqli_fetch_assoc($sql)){
			 	$jumlah_retur =  $key['qty_retur'] * $key['harga_retur'];
				$tot_retur += $jumlah_retur;
		   	}	
		?>
		<tbody id="header">
			<tr>
				<th style="width:23%">Tgl. Nota Retur</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:38%;"><?php echo date('d/m/Y',strtotime($data['tgl_retur'])); ?></td>
				<th style="width:14%;">No. Nota Retur</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:25%;"><?php echo $data['no_retur_beli']; ?></td>
			</tr>
			<tr>
				<th style="width:23%">Nama Supplier</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:38%;"><?php echo nama_supplier($sp['supplier_id']); ?></td>
				<th style="width:14%;">Operator Nota</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:25%;"><?php echo nama_opt($data['operator_nota']); ?></td>
			</tr>
			<tr>
				<th style="width:23%">Jumlah Nota Retur</th>
				<td style="padding-right: 10px;">:</td>
				<td style="width:38%;"> Rp. <?php echo number_format($tot_retur,2,".",","); ?></td>
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
                <th style="width:15%;">Qty Retur</th>
                <th style="width:22%;">Harga Retur (Rp.)</th>
                <th style="width:24%;">Total Retur (Rp.)</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=0; $jum_retur=0; 
        		$sql2 = mysqli_query($db,"select * from retur_beli_detail where id_retur_beli='$id'");
        		$no=0;
				while($key2 = mysqli_fetch_assoc($sql2)){
					$id_pembelian = $key2['id_beli_detail'];
					$data_brg = mysqli_fetch_assoc(mysqli_query($db,"select * from pembelian where pembelian_id='$id_pembelian'"));
				 	$jum_retur =  $key2['qty_retur'] * $key2['harga_retur'];

					$no++;
		?>
            <tr>
                <td style="text-align:center;"><?php echo $no; ?></td>
                <td><?php echo nama_material($data_brg['material_id']); ?></td>
                <td><?php echo str_replace(".00","",number_format($key2['qty_retur'],2,".",",")); ?> <?php echo nama_status_material($data_brg['material_id']) ?></td>
                <td style="text-align:right;">Rp. <?php echo number_format($key2['harga_retur'],2,".",","); ?></td>
                <td style="text-align:right;">Rp. <?php echo number_format($jum_retur,2,".",",");; ?></td>
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