<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $blokeditboxid = mysqli_real_escape_string($db, $_REQUEST['blokeditboxid']);
    $blokeditbox1 = mysqli_real_escape_string($db, $_REQUEST['blokeditbox1']);
    $blokeditbox2 = mysqli_real_escape_string($db, $_REQUEST['blokeditbox2']);
    $blokeditboxjenis = mysqli_real_escape_string($db, $_REQUEST['blokeditboxjenis']);
    $blokeditboxstat = mysqli_real_escape_string($db, $_REQUEST['blokeditboxstat']);

    $check = "SELECT * FROM blok WHERE blok_nama = '$blokeditbox1' and blok_id <> '$blokeditboxid' LIMIT 1";
    $resultcheck = mysqli_query($db,$check);
    $count = mysqli_num_rows($resultcheck);

    if($count == 1) {
        $_SESSION['errorexist'] = 1;   
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        $sql = "UPDATE blok SET blok_nama='$blokeditbox1', unit_id='$blokeditbox2', blok_tipe='$blokeditboxjenis', blok_status='$blokeditboxstat', blok_opid='$userid', blok_tdiubah='$today' WHERE blok_id='$blokeditboxid' LIMIT 1 ";

        if (mysqli_query($db, $sql)) {
            $_SESSION['updateexist'] = 1; 
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    };
?>