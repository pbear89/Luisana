<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
require_once('conex/sms.php'); 
if (!isset($_SESSION['MM_Idusuario'])){		
	header('Location: index.php');	
}
?>
<?php 
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        //Iniciamos la variable $conexion
        global $con;

        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        //Agregamos $conexion en las funciones mysqli_real_escape_string y mysqli_escape_string
        $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($con,$theValue) : mysqli_escape_string($con,$theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NdivL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NdivL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NdivL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NdivL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

/* PHP_SELF */    
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

// Name of the file
	$filename = $_FILES['str_archivo']['name'];
/* $filename = $_POST['archivo']; */
/* // MySQL host
$mysql_host = $hostname_sms;
// MySQL username
$mysql_username = $username_sms;
// MySQL password
$mysql_password = $password_sms;
// Database name
$mysql_database = $database_sms;

// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error()); */

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysqli_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($sms) . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";

}

$id= $_SESSION['MM_Idusuario'];

	mysqli_select_db ($sms, $database_sms);
	$query_Recordset1 = "SELECT * FROM t_users WHERE id=".$id."";
	$Recordset1 = mysqli_query($sms, $query_Recordset1) or die(mysqli_error($sms));
	$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


	mysqli_select_db ($sms, $database_sms);
	$query_Recordset2 = "SELECT * FROM t_users_dat WHERE id_user=".$id."";
	$Recordset2 = mysqli_query($sms, $query_Recordset2) or die(mysqli_error($sms));
	$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
	$totalRows_Recordset2 = mysqli_num_rows($Recordset2);



?>
<!DOCTYPE html>
<html>
<head>
<?php include('includes/css.php'); ?>
<style media="screen">
.center-block { 
   margin-left:auto;
   margin-right:auto;
     display:block;
     padding: 2em;
     /* border-bottom: 1px dotted grey; */
     margin-bottom: 1em;
}
.table{
    padding: 1em;
}
textarea{
  resize: none;
}
</style>
</head>
<body>

<?php include('includes/header.php');

?>

<!-- banner-bottom -->
<div class="typrography">
  <div class="container">	

    <div class="col-md-12">
          
           <form action="<?php echo $editFormAction; ?>" method="post" name="form1"  id="form1" role="form" enctype="multipart/form-data" >

            <div class="col-md-12 center-block">
                <center>
                <h3>Restaurar Base de Datos</h3>
                </center>
            </div> 
<div class="clearfix"></div> <hr>

         <div class="col-md-10 col-md-offset-1">
     
            <div class="form-group col-md-6">
                <label>* <?php echo "Nombre" ?>:</label>
                <!-- <input class="form-control" type="file" name="archivo" accept=".sql"> -->
                <input name="str_archivo" class="form-control" type="file" accept=".sql"/>
            </div>

      

            <input type="hidden" name="MM_update" value="form1">
                
<div class="clearfix"></div> <hr>

             </div>
              <div class="form-group col-md-4 col-md-offset-2">
                <button  type="submit" class="form-control btn btn-info"  ><?php echo "Restaurar Base de Datos" ?></button>
            </div>
              <div class="form-group col-md-4">
               <a class="form-control btn btn-warning" href="index.php">Regresar a Inicio</a>
            </div>
                 
                  
        <div class="clearfix"></div> <hr>

                </form>
        </div>

    <div class="clearfix"></div>
  </div>
</div>
<!-- //banner-bottom -->

<?php include('includes/footer.php'); ?>


</body>
</html>
