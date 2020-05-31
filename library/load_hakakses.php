<?php
    include('../library/config.php');

    $today = date("Y-m-d H:i:s");
    $id=$_POST['id'];
    $query_detail = "SELECT *,GROUP_CONCAT(CONCAT_WS('/',menu,id_akses,lihat,tambah,ubah,hapus,android) SEPARATOR ',') as n FROM mst_hakakses INNER JOIN menu_utamahakakses ON mst_hakakses.id_menu=menu_utamahakakses.id_menu_utama GROUP BY menu_utamahakakses.id_menu_utama"; $hak_akses_result3 = mysqli_query($db,$query_detail); 
    $resultx = null;
    while($dtx = mysqli_fetch_assoc($hak_akses_result3)){
        $n = explode(",",$dtx['n']); 
        $nmx = $dtx['nama_menu'];
        $data = array();
        $result = null;
        for($y=0;$y < count($n);$y++){ 
            $value=explode("/",$n[$y]);
            $akses= $value[1]; 
            $cek_gakakses=mysqli_fetch_assoc(mysqli_query($db,"select user_lihat,user_tambah,user_ubah,user_hapus,android from hakakses where karyawan_id='$id' and hakakses_access='$akses'"));
            $akses_st1 = $cek_gakakses['user_lihat'];
            $akses_st2 = $cek_gakakses['user_tambah'];
            $akses_st3 = $cek_gakakses['user_ubah'];
            $akses_st4 = $cek_gakakses['user_hapus'];
            $akses_st5 = $cek_gakakses['android'];
            $data = array(
                'no' => $y+1,
                'menu' => $dtx['nama_menu'],
                'nama_menu' => $value[0],
                'lihat' => $value[1]."#lihat",
                'tambah' => $value[1]."#tambah",
                'ubah' => $value[1]."#ubah",
                'hapus' => $value[1]."#hapus",
                'android' => $value[1]."#android",
                'st_lihat' => $akses_st1,
                'st_tambah' => $akses_st2,
                'st_ubah' => $akses_st3,
                'st_hapus' => $akses_st4,
                'st_android' => $akses_st5,
                'mst_lihat' => $value[2],
                'mst_tambah' => $value[3],
                'mst_ubah' => $value[4],
                'mst_hapus' => $value[5],
                'mst_android' => $value[6],
            );
        $result[]=$data;
        }
        $resultx[] = array(
            'menu' => $nmx,
            'datamenu' => $result,
        );
        
    }

    echo json_encode($resultx);
?>