
<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $kode_obat       = mysqli_real_escape_string($mysqli, trim($_POST['kode_obat']));
            $nama_obat       = mysqli_real_escape_string($mysqli, trim($_POST['nama_obat']));
            $btk_obat        = mysqli_real_escape_string($mysqli, trim($_POST['btk_obat']));
            $atr_pakai       = mysqli_real_escape_string($mysqli, trim($_POST['atr_pakai']));
            $indikasi        = mysqli_real_escape_string($mysqli, trim($_POST['indikasi']));
            $kontraindikasi  = mysqli_real_escape_string($mysqli, trim($_POST['kontraindikasi']));
            $efek_smp        = mysqli_real_escape_string($mysqli, trim($_POST['efek_smp']));
            $dosis           = mysqli_real_escape_string($mysqli, trim($_POST['dosis']));
            $satuan          = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));
            $stok            = mysqli_real_escape_string($mysqli, trim($_POST['stok']));
            $created_user = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel obat
            $query = mysqli_query($mysqli, "INSERT INTO is_obat(kode_obat,nama_obat,btk_obat,atr_pakai,indikasi,kontraindikasi,efek_smp,dosis,satuan,stok,created_user,updated_user) 
            VALUES('$kode_obat','$nama_obat','$btk_obat','$atr_pakai','$indikasi','$kontraindikasi','$efek_smp','$dosis','$satuan','$stok','$created_user','$created_user')")
            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=obat&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['kode_obat'])) {
                // ambil data hasil submit dari form
            $kode_obat       = mysqli_real_escape_string($mysqli, trim($_POST['kode_obat']));
            $nama_obat       = mysqli_real_escape_string($mysqli, trim($_POST['nama_obat']));
            $btk_obat        = mysqli_real_escape_string($mysqli, trim($_POST['btk_obat']));
            $atr_pakai       = mysqli_real_escape_string($mysqli, trim($_POST['atr_pakai']));
            $indikasi        = mysqli_real_escape_string($mysqli, trim($_POST['indikasi']));
            $kontraindikasi  = mysqli_real_escape_string($mysqli, trim($_POST['kontraindikasi']));
            $efek_smp        = mysqli_real_escape_string($mysqli, trim($_POST['efek_smp']));
            $dosis           = mysqli_real_escape_string($mysqli, trim($_POST['dosis']));
            $satuan          = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));
            
                $updated_user = $_SESSION['id_user'];

                // perintah query untuk mengubah data pada tabel obat
                $query = mysqli_query($mysqli, "UPDATE is_obat SET  nama_obat       = '$nama_obat',
                                                                    btk_obat        = '$btk_obat',
                                                                    atr_pakai       = '$atr_pakai',
                                                                    indikasi        = '$indikasi',
                                                                    kontraindikasi  = '$kontraindikasi',
                                                                    efek_smp        = '$efek_smp',
                                                                    dosis           = '$dosis',
                                                                    satuan          = '$satuan',
                                                                    updated_user    = '$updated_user'
                                                              WHERE kode_obat       = '$kode_obat'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=obat&alert=2");
                }         
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $kode_obat = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel obat
            $query = mysqli_query($mysqli, "DELETE FROM is_obat WHERE kode_obat='$kode_obat'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=obat&alert=3");
            }
        }
    }       
}       
?>