<!-- <div>1 . Display barcode with random product number <br>
<img alt="Coding Sips" src="barcode.php?text=ProductNo:-9034092348023&print=true&size=40" />
</div>

<br>
<br>
<div>
2. Display barcode with code type :- Code39 <br>
<img alt="Coding Sips" src="barcode.php?codetype=Code39&size=50&text=Coding-sips-item-no-324324&print=true" />
</div>

<br>
<br> -->
<div style="width: 100%">
<?php 
	$dt = explode(",",$_GET['data']); 
	for($x=0;$x < count($dt);$x++){
		$data = explode("|", $dt[$x]);
		for($y=0;$y<$data[1];$y++){
?>
	<img alt="Coding Sips" src="barcode.php?codetype=Code128&size=50&text=<?php echo $data[0]; ?>&print=true" />

<?php } } ?>
</div>
<!-- 4. Display barcode in verticle order <br>
<img alt="Coding Sips" src="barcode.php?codetype=Code128&size=30&text=Coding-sips&orientation=vertical" />
</div> -->
<script type="text/javascript">
	window.print();
</script>