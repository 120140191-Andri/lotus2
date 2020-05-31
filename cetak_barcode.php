<?php
    require ('library/tc-lib-barcode/vendor/autoload.php');
    $barcode = new \Com\Tecnick\Barcode\Barcode();
    $targetPath = "barcode/";
    
    /*if (! is_dir($targetPath)) {
        mkdir($targetPath, 0777, true);
    }*/
    $MRP = 122;//$_POST["mrp"];
    $MFGDate = 11;//strtotime($_POST["mfg_date"]);
    $EXPDate = 777;//strtotime($_POST["exp_date"]);
   // $productData = "098{$MRP}10{$MFGDate}55{$EXPDate}";
    $productData = "0981055";
    $barcode = new \Com\Tecnick\Barcode\Barcode();
    $bobj = $barcode->getBarcodeObj('C128C', "{$productData}", 450, 70, 'black', array(
        0,
        0,
        0,
        0
    ));
    
    $imageData = $bobj->getPngData();
    $timestamp = time();
    
    file_put_contents($targetPath . $timestamp . '.png', $imageData);
    ?>
<div class="result-heading">Output:</div>
<img src="<?php echo $targetPath . $timestamp ; ?>.png">