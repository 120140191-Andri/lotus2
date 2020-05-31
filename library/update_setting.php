<?php
    include('../library/confirm.php');

    $today = date("Y-m-d H:i:s");
    $settingplt = mysqli_real_escape_string($db, $_REQUEST['settingplt']);
    $settingb = mysqli_real_escape_string($db, $_REQUEST['settingb']);

    $sql = "UPDATE setting SET setting_plt='$settingplt', setting_b='$settingb' where karyawan_id = '$userid' LIMIT 1 ";
   
    if (mysqli_query($db, $sql)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo "Error updating record: " . mysqli_error($db);
    }
?>