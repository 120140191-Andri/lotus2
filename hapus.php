<?php 
include('conec.php');
$id_bayar = $_GET['id_bayar'];
mysql_query("DELETE FROM bayar_nota_beli WHERE id_bayar='$id_bayar'")or die(mysql_error());
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>