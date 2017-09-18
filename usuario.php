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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE t_users_dat SET strnombre=%s, stremail=%s, strapellido=%s WHERE idusuario=%s",
                       GetSQLValueString($_POST['str_nombre'], "text"),
                       GetSQLValueString($_POST['str_apellido'], "text"),
                       GetSQLValueString($_POST['str_ced'], "text"),
                      
                       GetSQLValueString($_POST['idusuario'], "int"));

  mysql_select_db($database_sms, $sms);
  $Result1 = mysql_query($updateSQL, $sms) or die(mysql_error());

  $updateGoTo = "editar_perfil.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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

           <form action="<?php echo $editFormAction; ?>" method="post" name="form1"  id="form1" role="form">

            <div class="col-md-12 center-block">
                <center>
                <h3>Editar Usuario</h3>
                </center>
            </div> 
<div class="clearfix"></div> <hr>
         <div class="col-md-10 col-md-offset-1">
     
            <div class="form-group col-md-6">
                <label>* <?php echo "Nombre" ?>:</label>
                <input class="form-control" type="text" name="str_nombre" value="<?php echo htmlentities(ObtenerNombreUsuario($id), ENT_COMPAT, 'UTF-8'); ?>" size="32">
            </div>

            <div class="form-group col-md-6">
                <label>* <?php echo "Apellido" ?>:</label>
                <input class="form-control" type="text" name="str_apellido" value="<?php echo htmlentities(ObtenerApellidoUsuario($id), ENT_COMPAT, 'UTF-8');  ?>" size="32">
            </div>
<div class="clearfix"></div> <hr>
            <div class="form-group col-md-6">
                <label>* <?php echo "Cédula" ?></label>:
                <input class="form-control" type="text" name="str_ced" value="<?php echo htmlentities($row_Recordset2['str_ced'], ENT_COMPAT, 'UTF-8'); ?>" size="32">
            </div>
      

            <input type="hidden" name="MM_update" value="form1">
            <input type="hidden" name="idusuario" value="<?php echo $id; ?>">
                
<div class="clearfix"></div> <hr>

             </div>
              <div class="form-group col-md-4 col-md-offset-2">
                <button  type="submit" class="form-control btn btn-info"  ><?php echo "Guardar Cambios" ?></button>
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
