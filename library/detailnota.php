<?php
    include('../library/config.php');
?>
<option></option>
<?php
    $notaget = mysqli_real_escape_string($db, $_REQUEST['nota']);
                       
    $daftarpesanan = mysqli_query($db,"select * from pesanannota,nota,barang where pesanannota.nota_nomor = '$notaget' and nota.nota_nomor = '$notaget' and pesanannota.barang_barcode = barang.barang_barcode");
    while($row = mysqli_fetch_array($daftarpesanan))
    {
?>
    <option 
        value="<?php echo $row['barang_barcode'];?>"
        data-barcodecustom="<?php echo $row['barang_barcode'];?>"
    >
        <?php echo $row['barang_nama'];?>
    </option>

<?php
}
?>