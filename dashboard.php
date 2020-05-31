<?php
   include('library/session.php');
   include('library/config_hakakses.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="asset/favicon.png" />
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/solid.css">
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/script.js"></script>
</head>

<title>Lotus</title>

<body>
    <div class="spacer"></div>
    <div class="sidebar">
        <div class="containerlogo">
            <h1 class="loginformh1">LOTUS</h1>
            <h4 class="loginformh5">Menu</h4>
        </div>
        <div class="sbbutton sbbutton1">
            <h5 class="sbbuttonf"><i class="fas fa-home"></i>Menu utama</h5>
        </div>
        <?php 
            if(cek_hak_akses_menu($userid,"2")==1){
        ?>
        <div class="sbbutton sbbutton2">
            <h5 class="sbbuttonf"><i class="fas fa-check"></i>Konfirmasi</h5>
        </div>
        <?php 
            } if(cek_hak_akses_menu($userid,"1")==1){
        ?>
        <div class="sbbutton sbbutton3">
            <h5 class="sbbuttonf"><i class="fas fa-database"></i>Master</h5>
        </div>
        <?php } if(cek_hak_akses_menu($userid,"3")==1){
        ?>        
        <div class="sbbutton sbbutton4">
            <h5 class="sbbuttonf"><i class="fas fa-receipt"></i>Nota</h5>
        </div>
        <?php } if(cek_hak_akses_menu($userid,"4")==1){
        ?> 
        <div class="sbbutton sbbutton5">
            <h5 class="sbbuttonf"><i class="fas fa-warehouse"></i>Unit</h5>
        </div>
        <?php } if(cek_hak_akses_menu($userid,"5")==1){
        ?> 
        <div class="sbbutton sbbutton6">
            <h5 class="sbbuttonf"><i class="fas fa-balance-scale"></i>Transaksi</h5>
        </div>
        <?php } if(cek_hak_akses_menu($userid,"6")==1){
        ?> 
        <div class="sbbutton sbbutton7">
            <h5 class="sbbuttonf"><i class="fas fa-money-bill-wave"></i>Keuangan</h5>
        </div>
        <?php } if(cek_hak_akses_menu($userid,"7")==1){
        ?> 
        <div class="sbbutton sbbutton8">
            <h5 class="sbbuttonf"><i class="fas fa-chart-line"></i>Aktifitas</h5>
        </div>
        <?php } if(cek_hak_akses_menu($userid,"8")==1){
        ?> 
        <div class="sbbutton sbbutton9">
            <h5 class="sbbuttonf"><i class="fas fa-pencil-alt"></i>Laporan</h5>
        </div>
        <?php } ?>
        <div class="sbbutton sbbutton10">
            <h5 class="sbbuttonf"><i class="fas fa-cog"></i>Pengaturan</h5>
        </div>
        <div class="sbbutton" onclick="location.href='logout.php';">
            <h5 class="sbbuttonf"><i class="fas fa-sign-out-alt"></i>Keluar</h5>
        </div>
    </div>
    
    <div class="menudisplaycontainer">
        <div class="navcontainer">
            <div class="navleft">
                <h2 class="headnavigation"><?php echo strtoupper("$userjob") ?> <redfont>/</redfont> <?php echo $usernamalengkap ?></h2>
                <h5 class="headnavigation2 headnav1">Lotus <redfont>/</redfont> Menu Utama</h5>
                <h5 class="headnavigation2 headnav2">Lotus <redfont>/</redfont> Konfirmasi</h5>
                <h5 class="headnavigation2 headnav3">Lotus <redfont>/</redfont> Master</h5>
                <h5 class="headnavigation2 headnav4">Lotus <redfont>/</redfont> Nota</h5>
                <h5 class="headnavigation2 headnav5">Lotus <redfont>/</redfont> Unit</h5>
                <h5 class="headnavigation2 headnav6">Lotus <redfont>/</redfont> Transaksi</h5>
                <h5 class="headnavigation2 headnav7">Lotus <redfont>/</redfont> Keuangan</h5>
                <h5 class="headnavigation2 headnav8">Lotus <redfont>/</redfont> Aktifitas</h5>
                <h5 class="headnavigation2 headnav9">Lotus <redfont>/</redfont> Laporan</h5>
                <h5 class="headnavigation2 headnav10">Lotus <redfont>/</redfont> Pengaturan</h5>
            </div>
        </div>
        
        <hr class="hrred">
        
        <div class="dashboard1" id="dashboard1">
            
        </div>
        
        <div class="dashcontainer1">
            
            
            
            
            
        </div>
        
        <div class="dashcontainer2">
            
            
            
            
        </div>
        
        <div class="dashcontainer3">
            <?php if(cek_hak_akses_submenu($userid,"1")==1){?> 
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-male"></i><i class="fas fa-female"></i> </div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext" href="daftarkaryawan.php">Daftar<br>karyawan</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"2")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-hashtag"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="hakakses.php">Hak Akses</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"3")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-box"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="barangjadi.php">Barang</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"4")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-truck-loading" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="supplier.php">Supplier</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"5")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-handshake" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="pelanggan.php">Pelanggan</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"6")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-info"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="satuan.php">Satuan</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"7")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-tag"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="Kategori.php">Kategori</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"8")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-tags" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="subkategori.php">Subkategori</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"9")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-check-alt" style="margin-left:-10px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="rekening.php">Rekening</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"10")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-warehouse" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="unit.php">Unit</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"11")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-dolly" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="produksi.php">Produksi</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"31")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-dolly" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="reproduksi.php">Re-Produksi</h5></div>
            </div>
            <?php } if(cek_hak_akses_submenu($userid,"12")==1){?>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-dumpster-fire" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">Pemusnahan</h5></div>
            </div>
            <?php }?>
        </div>
        
        <div class="dashcontainer4">
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-file-invoice-dollar"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">Tutup nota</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-file-invoice"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Riwayat tutup nota</h5></div>
            </div>
        </div>
        
        <div class="dashcontainer5">
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-pallet" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" style="bottom:-5px !important;">Gudang<br>material</h5></div>
            </div>
            
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-pallet" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" style="bottom:-5px !important;">Gudang barang jadi</h5></div>
            </div>
            
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-camera-retro"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">Gallery</h5></div>
            </div>
        </div>
        
        <div class="dashcontainer6">
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-shopping-cart" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="transaksi.php">Transaksi</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-undo"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="retur_beli.php">Retur beli</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-bill" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="nota_beli.php">Bayar nota beli</h5></div>
            </div>
             <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-bill" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="mutasi.php">Mutasi</h5></div>
            </div>
             <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-bill" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext" href="data_mutasi.php">Penerimaan Mutasi</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-bill" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">Bayar nota beli</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-bill-wave"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Pencairan Giro beli</h5></div>
            </div>
            
            <div class="dbboxmenu" style="clear:left;">
                <div class="dbboxicon"><i class="fas fa-credit-card"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">Penjualan</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-undo"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">Retur jual</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-bill" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">Bayar nota jual</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-bill-wave"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Pencairan Giro jual</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-cash-register"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">POS</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-file-invoice"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Void nota pembatalan</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-bill-alt" style="margin-left:-8px;"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">Setoran POS</h5></div>
            </div>
        </div>
        
        <div class="dashcontainer7">
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-book-open"></i></div>
                <div class="dbboxtext"><h5 class="dbboxtext">Kas kecil</h5></div>
            </div>
            <div class="dbboxmenu dbboxmenu2" style="width:220px;">
                <div class="dbboxicon"><i class="fas fa-exclamation"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Piutang dan potongan kompensasi <br>karyawan</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-exchange-alt"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Pindah piutang karyawan</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-history"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Riwayat pindah piutang</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-book-reader"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Penggajian karyawan</h5></div>
            </div>
            <div class="dbboxmenu" style="clear:left;">
                <div class="dbboxicon"><i class="fas fa-money-bill-alt"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Bayar komisi sales</h5></div>
            </div>
            <div class="dbboxmenu">
                <div class="dbboxicon"><i class="fas fa-money-bill-alt"></i></div>
                <div class="dbboxtext" style="bottom:-5px !important;"><h5 class="dbboxtext">Bayar komisi collector</h5></div>
            </div>
        </div>
        
        <div class="dashcontainer8">
                   

        </div>
        
        <div class="dashcontainer9">
            
                
        </div>
        
        <div class="dashcontainer10" style="margin-top:15px;">
            <form class="boxentry" action="library/update_setting.php" method="post">
                <h3 class="headnavigation"><redfont>Pengaturan satuan</redfont></h3>
                <br>
                <br>
                <div class="entryfield">
                    <h5 class="headnavigation">Satuan <redfont>panjang</redfont>, <redfont>lebar</redfont> dan <redfont>tinggi</redfont></h5>
                    
                    <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                        <label class="checkboxlabel"><h5 class="headnavigation">Centimeter (<redfont>CM</redfont>)</h5>
                            <input type="radio" <?php if ($usersettingplt === 'CM'){echo 'checked="checked"';}else{echo '';};?> name="settingplt" value="CM">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkboxlabel"><h5 class="headnavigation">Meter (<redfont>M</redfont>)</h5>
                            <input type="radio" <?php if ($usersettingplt === 'M'){echo 'checked="checked"';}else{echo '';};?> name="settingplt" value="M">
                            <span class="checkmark"></span>
                        </label>
                    </div><br><br><br><br>
                    
                    <h5 class="headnavigation">Satuan <redfont>berat</redfont></h5>
                    
                    <div class="checkboxcontainer" style="float:left; margin-top:5px;">
                        <label class="checkboxlabel"><h5 class="headnavigation">Gram (<redfont>G</redfont>)</h5>
                            <input type="radio" <?php if ($usersettingb === 'G'){echo 'checked="checked"';}else{echo '';};?> name="settingb" value="G">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkboxlabel"><h5 class="headnavigation">Kilogram (<redfont>KG</redfont>)</h5>
                            <input type="radio" <?php if ($usersettingb === 'KG'){echo 'checked="checked"';}else{echo '';};?> name="settingb" value="KG">
                            <span class="checkmark"></span>
                        </label>
                    </div><br><br><br><br>
                    
                    
                    <h5 class="headnavigation"><redfont><i>Ingin merubah pengaturan?</i></redfont></h5>
                    <input class="formsubmit boxsubmit" type="submit" name="" value="Ubah pengaturan">
                </div>
            </form>
        </div>
    </div>
</body>