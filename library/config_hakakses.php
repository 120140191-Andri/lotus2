<?php
    
    function cek_hak_akses_menu($userid,$menu){
        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($db === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $cek_count_akses = mysqli_fetch_assoc(mysqli_query($db,"select count(*) as jum from hakakses inner join mst_hakakses on hakakses.hakakses_access=mst_hakakses.id_akses where karyawan_id='$userid' and id_menu='$menu'"));
        @$count_akses = $cek_count_akses["jum"];
        if(($count_akses > 0) || ($userid == 1 || $userid == 2)){
            $akses = 1;
        }else{
            $akses = 0;
        }

        return $akses;
    }

    function cek_hak_akses_submenu($userid,$submenu){
        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($db === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $cek_count_akses = mysqli_fetch_assoc(mysqli_query($db,"select count(*) as jum from hakakses inner join mst_hakakses on hakakses.hakakses_access=mst_hakakses.id_akses where karyawan_id='$userid' and hakakses_access='$submenu'"));
        @$count_akses = $cek_count_akses["jum"];
        if(($count_akses > 0) || ($userid == 1 || $userid == 2)){
            $akses = 1;
        }else{
            $akses = 0;
        }

        return $akses;
    }


    function cek_hak_akses_aksi_submenu($userid,$submenu,$aksi){
        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($db === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $cek_count_akses = mysqli_fetch_assoc(mysqli_query($db,"select count(*) as jum from hakakses inner join mst_hakakses on hakakses.hakakses_access=mst_hakakses.id_akses where karyawan_id='$userid' and hakakses_access='$submenu' and $aksi=1"));
        @$count_akses = $cek_count_akses["jum"];
        if(($count_akses > 0) || ($userid == 1 || $userid == 2)){
            $akses = 1;
        }else{
            $akses = 0;
        }

        return $akses;
    }

    function nama_opt($id){
        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($db === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $cek_nama = mysqli_fetch_assoc(mysqli_query($db,"select karyawan_nama from karyawan where karyawan_id='$id'"));

        return $cek_nama['karyawan_nama'];
    }

    function nama_supplier($id){
        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($db === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $cek_nama = mysqli_fetch_assoc(mysqli_query($db,"select supplier_nama from supplier where supplier_id='$id'"));

        return $cek_nama['supplier_nama'];
    }

    function nama_material($id){
        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($db === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $cek_nama = mysqli_fetch_assoc(mysqli_query($db,"select material_nama from material where material_id='$id'"));

        return $cek_nama['material_nama'];
    }

    function nama_status_material($id){
        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($db === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $cek_nama = mysqli_fetch_assoc(mysqli_query($db,"select satuan_nama from material inner join satuan on material.satuan_id=satuan.satuan_id where material.material_id='$id'"));

        return $cek_nama['satuan_nama'];
    }


?>