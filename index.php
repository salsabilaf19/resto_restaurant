<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require('Controller/CRestaurant.php');
require('inner-page.php');
echo "<div class=\"container\">";
echo "<link href=\"./assets/css/style.css\" rel=\"stylesheet\">";
$Res=new CRestaurant();

if(isset($_GET['target']))
{
	if($_GET['target']=='input')
	{
		$Res->inputForm(); 
	}
	else if($_GET['target']=='list')
	{
		$Res->cetakdata(); 
	}
	else if($_GET['target']=='edit')
	{
		$Res->updateForm();
	}
	else if($_GET['target']=='delete')
	{
		$Res->deleteForm($_GET['Kode']);
	}
	else if($_GET['target']=='detail')
	{
		$Res->detailDB($_GET['Kode']);
	}
	else if($_GET['target']=='cetakMakanan')
	{
		$Res->cetakMakanan($_GET['Kode']);
	}
	else if($_GET['target']=='cetakMinuman')
	{
		$Res->cetakMinuman($_GET['Kode']);
	}
	else if($_GET['target']=='cetakLainnya')
	{
		$Res->cetakLainnya($_GET['Kode']);
	}

}
else
{
$Res->cetakdata();
}
echo "</div>";
?>
