<?php if (!isset($_SESSION)) {
	@session_start();
}

$hostname_sms = "localhost";
$database_sms = "gob_db";
$username_sms = "root";
$password_sms = "";

$sms = mysqli_connect($hostname_sms , $username_sms , $password_sms) or die ("Error " . mysqli_error($sms));

$con = @mysqli_connect($hostname_sms , $username_sms , $password_sms, $database_sms) or die ("Error " . mysqli_error($con));

if (is_file("includes/funciones.php")){
	include("includes/funciones.php");
}
else
{
	include("../includes/funciones.php");
}

// mysqli_select_db ($sms, $database_sms);
// $query_info = "SELECT * FROM tblinfo WHERE idinfo = 1";
// $info = mysqli_query($sms, $query_info) or die(mysqli_error());
// $row_info = mysqli_fetch_assoc ($info);
// $totalRows_info = mysqli_num_rows($info);
//
// mysqli_select_db ($sms, $database_sms);
// $query_infoing = "SELECT * FROM tblinfoing WHERE idinfo = 1";
// $infoing = mysqli_query($sms, $query_infoing) or die(mysqli_error());
// $row_infoing = mysqli_fetch_assoc($infoing);
// $totalRows_info = mysqli_num_rows($infoing);

?>
