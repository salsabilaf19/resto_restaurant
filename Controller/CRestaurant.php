<?php

require_once('Model/MRestaurant.php');
require_once('form.php');


class CRestaurant
{
    public $Kode;
    public $Nama;
    public $kategori;
    public $Harga;
    public $statuss;
    public $desk;
    public $img;

    public function inputForm()
    {
        echo "<center><h2>Tambah Menu</h2>";
        $formRes = new Form("", "Input Menu");
        $formRes-> addField("Kode","Kode", "text");
        $formRes-> addField("Nama","Nama", "text");
        $formRes->addSelect("kategori","Kategori", "select",array(
            array('indeks' => 'Makanan','value' => 'Makanan'),
            array('indeks' => 'Minuman','value' => 'Minuman'),
            array('indeks' => 'Lainnya','value' => 'Lainnya')),
            array('indeks' => 'selected'));
        $formRes-> addField("Harga","Harga", "text");
        $formRes->addRadio("statuss","Status","radio",array(
            array("indeks" => 0,"value" => "Tersedia"),
            array("indeks" => 1,"value" => "Tidak Tersedia"))
        );
        $formRes-> addTextarea("desk","Deskripsi", "textarea");
        $formRes-> addImage("img","Upload Image", "file");


        if(isset($_POST['tombol'])){
            $formRes->getForm();
            $data['Kode'] = $_POST['Kode'];
            $data['Nama'] = $_POST['Nama'];
            $data['kategori'] = $_POST['kategori'];
            $data['Harga'] = $_POST['Harga'];
            $data['statuss'] = $_POST['statuss'];
            $data['desk'] = $_POST['desk'];
            $data['img'] = $_POST['img'];

            

            $MRes = new MRestaurant();
            $MRes->add_data($data);

            echo "</center>";
            $this->cetakdata();

            
        } else {
            $data = $formRes->displayForm();

            require('view/Res_input.php');
            
        }
    }


    public function updateForm()
    {
        require('koneksi.php');
        $Kode = $_GET['Kode'];
        $result = mysqli_query($koneksi, "SELECT * FROM tbl_category where Kode='$Kode'");
        while ($res = mysqli_fetch_array($result)) {

        echo "<center><h2>Update Menu</h2>";
        $formRes = new Form("", "Update Menu");
        $formRes-> addField("Kode","Kode", "text", $res['Kode'],'readonly');
        $formRes-> addField("Nama","Nama", "text", $res['Nama']);
        $formRes->addSelect("kategori","Kategori", "select",array(
            array('indeks' => 'Makanan','value' => 'Makanan'),
            array('indeks' => 'Minuman','value' => 'Minuman'),
            array('indeks' => 'Lainnya','value' => 'Lainnya')),
            array(array($res['kategori'] => 'selected')));
        $formRes-> addField("Harga","Harga", "text", $res['Harga']);
        $formRes->addSelect("statuss","Status","radio",array(
            array("indeks" => 0,"value" => "Tersedia"),
            array("indeks" => 1,"value" => "Habis")),
            array(array($res["statuss"] => "selected")));
        $formRes-> addTextarea("desk","Deskripsi", "textarea", $res['desk']);
        $formRes-> addImage("img","Upload Image", "file", $res['img']);


        }

        if(isset($_POST['tombol'])){
            $formRes->getForm();
            $data['Kode'] = $_POST['Kode'];
            $data['Nama'] = $_POST['Nama'];
            $data['kategori'] = $_POST['kategori'];
            $data['Harga'] = $_POST['Harga'];
            $data['statuss'] = $_POST['statuss'];
            $data['desk'] = $_POST['desk'];
            $data['img'] = $_POST['img'];

            $MRes = new MRestaurant();
            $MRes->updatedata($Kode);

            echo "</center>";

            $this->cetakdata();
        } else {
            $data = $formRes->displayForm();

            require('view/Res_Edit.php');
            
        }
    }


    public function cetakdata()
    {
        require('koneksi.php');

        $MRestaurant = new MRestaurant();

        $sql = mysqli_query($koneksi,"SELECT * from tbl_category order by Kode asc");
        while ($z = mysqli_fetch_array($sql)) {
            $data .= "<center>";
            $data .= "<hr><b><div class='menu-content'>" . $z['Kode'] ."</div></b><br>";
            $data .= "<div class='menu-content'>" . $z['Nama'] . " . . . . . . . . . . . . . . . . . . .";
            $data .= "<span> Rp. " . $z['Harga']."</span></div> <br>";
            $data .= "<div class=\"menu-ingredients\">" . $z['desk'] . "<br></div>";
            $data .= "<div class='menu-content'>" . $z['kategori'] . " - ";
            $data .= "<i>" .$z['statuss'] . "</i></div><br>";
            $data .= "<img src='gambar/". $z['img'] . "' style='width: 120px;'><br>";
            $data .= "<br><div class='menu-content'>
						<a href='index.php?target=edit&Kode=" . $z['Kode'] . "' class='btn btn-success'>Edit</a></button>
						<a href='index.php?target=delete&Kode=" . $z['Kode'] . "' class='btn btn-danger'>Delete</a>
                        <a href='index.php?target=detail&Kode=" . $z['Kode'] . "' class='btn btn-danger'>Detail</a>
                     <br></div>";
            $data .= "</center>";
        } 

        require('view/Vrestoran.php');
    }


    function deleteForm($Kode)
    {
       
        $deleteKategori = new MRestaurant();
        $deleteKategori->deleteCat($Kode);
        $this->cetakdata();
    }

    function detailDB($Kode){
        $MRes=new MRestaurant(); 
        $z=$MRes->detailRes($Kode);
        $data = "<h1><center> Detail Menu </center></h1>";
                $data .= "<center>";
                $data .= "<hr><b><div class='menu-content'>" . $z['Kode'] ."</div></b><br>";
                $data .= "<div class='menu-content'>" . $z['Nama'] . " . . . . . . . . . . . . . . . . . . .";
                $data .= "<span> Rp. " . $z['Harga']."</span></div> <br>";
                $data .= "<div class=\"menu-ingredients\">" . $z['desk'] . "<br></div>";
                $data .= "<div class='menu-content'>" . $z['kategori'] . " - ";
                $data .= "<i>" .$z['statuss'] . "</i></div><br>";
                $data .= "<img src='gambar/". $z['img'] . "' style='width: 120px;'><br>";
                $data .= "</center>";
        require('view/Res_detail.php');
    }
    public function cetakMakanan()
    {
        require('koneksi.php');

        $MRestaurant = new MRestaurant();

        $sql = mysqli_query($koneksi,"SELECT * from tbl_category WHERE kategori='Makanan' order by Kode asc");
        while ($z = mysqli_fetch_array($sql)) {
            $data .= "<center>";
            $data .= "<hr><b><div class='menu-content'>" . $z['Kode'] ."</div></b><br>";
            $data .= "<div class='menu-content'>" . $z['Nama'] . " . . . . . . . . . . . . . . . . . . .";
            $data .= "<span> Rp. " . $z['Harga']."</span></div> <br>";
            $data .= "<div class=\"menu-ingredients\">" . $z['desk'] . "<br></div>";
            $data .= "<div class='menu-content'>" . $z['kategori'] . " - ";
            $data .= "<i>" .$z['statuss'] . "</i></div><br>";
            $data .= "<img src='gambar/". $z['img'] . "' style='width: 120px;'><br>";
            $data .= "<br><div class='menu-content'>
						<a href='index.php?target=edit&Kode=" . $z['Kode'] . "' class='btn btn-success'>Edit</a></button>
						<a href='index.php?target=delete&Kode=" . $z['Kode'] . "' class='btn btn-danger' >Delete</a>
                        <a href='index.php?target=detail&Kode=" . $z['Kode'] . "' class='btn btn-danger ' >Detail</a>
                     <br></div>";
            $data .= "</center>";
        } 

        require('view/VrestoranMak.php');
    }

    public function cetakMinuman()
    {
        require('koneksi.php');
        $MRestaurant = new MRestaurant();

        $sql = mysqli_query($koneksi,"SELECT * from tbl_category where kategori='Minuman' order by Kode asc");
        while ($z = mysqli_fetch_array($sql)) {
            $data .= "<center>";
            $data .= "<hr><b><div class='menu-content'>" . $z['Kode'] ."</div></b><br>";
            $data .= "<div class='menu-content'>" . $z['Nama'] . " . . . . . . . . . . . . . . . . . . .";
            $data .= "<span> Rp. " . $z['Harga']."</span></div> <br>";
            $data .= "<div class=\"menu-ingredients\">" . $z['desk'] . "<br></div>";
            $data .= "<div class='menu-content'>" . $z['kategori'] . " - ";
            $data .= "<i>" .$z['statuss'] . "</i></div><br>";
            $data .= "<img src='gambar/". $z['img'] . "' style='width: 120px;'><br>";
            $data .= "<br><div class='menu-content'>
						<a href='index.php?target=edit&Kode=" . $z['Kode'] . "' class='btn btn-success'>Edit</a></button>
						<a href='index.php?target=delete&Kode=" . $z['Kode'] . "' class='btn btn-danger' >Delete</a>
                        <a href='index.php?target=detail&Kode=" . $z['Kode'] . "' class='btn btn-danger ' >Detail</a>
                     <br></div>";
            $data .= "</center>";
        } 

        require('view/VrestoranMin.php');
    }

    public function cetakLainnya()
    {
        require('koneksi.php');

        $MRestaurant = new MRestaurant();

        $sql = mysqli_query($koneksi,"SELECT * from tbl_category WHERE kategori='Lainnya' order by Kode asc");
        while ($z = mysqli_fetch_array($sql)) {
            $data .= "<center>";
            $data .= "<hr><b><div class='menu-content'>" . $z['Kode'] ."</div></b><br>";
            $data .= "<div class='menu-content'>" . $z['Nama'] . " . . . . . . . . . . . . . . . . . . .";
            $data .= "<span> Rp. " . $z['Harga']."</span></div> <br>";
            $data .= "<div class=\"menu-ingredients\">" . $z['desk'] . "<br></div>";
            $data .= "<div class='menu-content'>" . $z['kategori'] . " - ";
            $data .= "<i>" .$z['statuss'] . "</i></div><br>";
            $data .= "<img src='gambar/". $z['img'] . "' style='width: 120px;'><br>";
            $data .= "<br><div class='menu-content'>
						<a href='index.php?target=edit&Kode=" . $z['Kode'] . "' class='btn btn-success'>Edit</a></button>
						<a href='index.php?target=delete&Kode=" . $z['Kode'] . "' class='btn btn-danger' >Delete</a>
                        <a href='index.php?target=detail&Kode=" . $z['Kode'] . "' class='btn btn-danger' >Detail</a>
                     <br></div>";
            $data .= "</center>";
        } 

        require('view/VrestoranLain.php');
    }
   
}
?>