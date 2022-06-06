<?php



class MRestaurant
{
    public $Kode;
    public $Nama;
    public $kategori;
    public $Harga;
    public $statuss;
    public $desk;
    public $img;


    public function add_data($data)
    {
        require('koneksi.php');
        if(isset($_POST['tombol'])){
            $Kode = $_POST['Kode'];
            $Nama = $_POST['Nama'];
            $kategori = $_POST['kategori'];
            $Harga = $_POST['Harga'];
            $statuss = $_POST['statuss'];
            $desk = $_POST['desk'];
            $img = $_FILES['img']['name'];

                $ekstensi_diperbolehkan = array('png','jpg','jpeg'); //ekstensi file gambar yang bisa diupload 
                
                $x = explode('.', $img); //memisahkan nama file dengan ekstensi yang diupload
                $ekstensi = strtolower(end($x));
                $file_tmp = $_FILES['img']['tmp_name'];   

                      if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                              move_uploaded_file($file_tmp, 'gambar/'.$img); //memindah file gambar ke folder gambar
                                // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                                $sql = "INSERT INTO tbl_category(Kode, Nama, kategori, Harga, statuss, desk, img)
                                        VALUES ('$Kode','$Nama','$kategori','$Harga','$statuss','$desk', '$img')";
                                $query = mysqli_query($koneksi, $sql);
                                // periska query apakah ada error
                                if(!$query){
                                    die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                                         " - ".mysqli_error($koneksi));
                                } else {  
                                  echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                                }
              
                          } else {     
                              echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='index.php';</script>";
                          }
              
        }
    }

    public function deleteCat()
    {
        require('koneksi.php');
        $Kode = $_GET['Kode'];
        $sql = "DELETE FROM tbl_category WHERE Kode = '$Kode'";
        $query = mysqli_query($koneksi, $sql);
        if ($query == 1) {
            echo "<script>window.alert('Yakin Hapus Data ?');
				window.location('index.php')</script>";
        }
    }

    public function updatedata($Kode)
    {

        require('koneksi.php');
        if(isset($_POST['tombol'])){
            $Kode = $_POST['Kode'];
            $Nama = $_POST['Nama'];
            $kategori = $_POST['kategori'];
            $Harga = $_POST['Harga'];
            $statuss = $_POST['statuss'];
            $desk = $_POST['desk'];
            $img = $_POST['img'];

            $sql = "UPDATE tbl_category SET 
                    Nama='$Nama',
                    kategori='$kategori', 
                    Harga='$Harga',
                    statuss='$statuss',
                    desk='$desk',
                    img='$img' 
                    WHERE Kode='$Kode'";

            $hasil =  mysqli_query($koneksi, $sql);
            if ($hasil == 1) {
                echo "<script>window.alert('Update Data ?'); window.location('index.php')</script>";
            }
        }
    }

    function detailRes($Kode)
    {
        require('Koneksi.php');
        $query  = "SELECT * from tbl_category WHERE Kode='$Kode'";
        $hasil = mysqli_query($koneksi, $query);
        return mysqli_fetch_array($hasil);
    }


}
