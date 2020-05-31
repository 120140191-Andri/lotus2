<div class=hiddenphpsession; style="display:none;">
    <?php
    if($_SESSION['errorexist'] == 1){
        $warningmessageexist = 1;
    }else{
        $_SESSION['errorexist'] == '0';
        $warningmessageexist = 0;
    };
    unset($_SESSION['errorexist']);
                
    if($_SESSION['successexist'] == 1){
        $successmessageexist = 1;
    }else{
        $_SESSION['successexist'] == '0';
        $successmessageexist = 0;
    };
    unset($_SESSION['successexist']);
                
    if($_SESSION['updateexist'] == 1){
        $updatemessageexist = 1;
    }else{
        $_SESSION['updateexist'] == '0';
        $updatemessageexist = 0;
    };
    unset($_SESSION['updateexist']);
    ?>
</div>

<?php if($warningmessageexist == 1){ ?>
    <div class="alert alert-danger fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <h4 class="headnavigation3"><strong>Gagal!</strong> Gagal memasukkan data karyawan. Username karyawan sudah ada. Harap dicoba kembali dengan Username karyawan yang lain.</h4></div>
<?php ; }else{ ?>
    <div class="warningmessagebox" style="display:none;"></div>
<?php ; }; if($successmessageexist == 1){ ?>
    <div class="alert alert-success fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <h4 class="headnavigation3"><strong>Sukses!</strong> Data berhasil dimasukkan.</h4></div>
<?php ; }else{ ?>
    <div class="warningmessagebox" style="display:none;"></div>
<?php ; }; if($updatemessageexist == 1){ ?>
    <div class="alert alert-success fade in alert-dismissible show"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" style="font-size:20px">×</span> </button> <h4 class="headnavigation3"><strong>Sukses!</strong> Data berhasil dirubah.</h4></div>
<?php ; }else{ ?>
    <div class="warningmessagebox" style="display:none;"></div>
<?php ; }; ?>