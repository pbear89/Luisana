<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1'); ?>
<?php require_once('conex/sms.php'); 
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
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

 $id = "0";
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    } else {
      header("Location: documentos.php");
    }

/* PHP_SELF */    
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

    if (isset($_POST["id"])) {
        $id = $_POST["id"];
    } else {
      header("Location: documentos.php");
    }

  $updateSQL = sprintf("UPDATE t_docs SET str_dependencia=%s, str_remitente=%s  WHERE id=%s",
                        
                        GetSQLValueString($_POST['str_dependencia'], "text"),
                        GetSQLValueString($_POST['str_remitente'], "text"),
                        GetSQLValueString($_POST['id'], "int")
                        
                    );

  mysqli_select_db($sms, $database_sms);
  $Result1 = mysqli_query($sms, $updateSQL) or die(mysqli_error($sms)); 

 /* <!-- PRESTACION SOCIAL -->  */
 if ($_POST['t_doc']==1) {   
        $updateSQL2 = sprintf("UPDATE t_prest_social SET fch_mod=NOW(), str_nombre=%s  WHERE id=%s",
                
                GetSQLValueString($_POST['str_nombre'], "text"),
                GetSQLValueString($id, "int")

                );

        mysqli_select_db($sms, $database_sms);
        $Result2 = mysqli_query($sms, $updateSQL2) or die(mysqli_error($sms)); 
    }
    /* <!-- TRAMITE --> */
 if ($_POST['t_doc']==2) {   
        $updateSQL2 = sprintf("UPDATE t_tramite SET fch_mod=NOW(), str_tipo=%s  WHERE id=%s",
                
                GetSQLValueString($_POST['str_tipo'], "text"),
                GetSQLValueString($id, "int")

                );

        mysqli_select_db($sms, $database_sms);
        $Result2 = mysqli_query($sms, $updateSQL2) or die(mysqli_error($sms));
  
   }  
    /* <!-- RECLAMO --> */
 if ($_POST['t_doc']==3) { 
         $updateSQL2 = sprintf("UPDATE t_tramite SET fch_mod=NOW(), str_nombre=%s  WHERE id=%s",
                
                GetSQLValueString($_POST['str_nombre'], "text"),
                GetSQLValueString($id, "int")

                );

        mysqli_select_db($sms, $database_sms);
        $Result2 = mysqli_query($sms, $updateSQL2) or die(mysqli_error($sms));
  
    }  
    /* <!-- EXPEDIENTE --> */
 if ($_POST['t_doc']==4) {  
          $updateSQL2 = sprintf("UPDATE t_expediente SET fch_mod=NOW(), str_dependencia=%s  WHERE id=%s",
                
                GetSQLValueString($_POST['str_nombre'], "text"),
                GetSQLValueString($id, "int")

                );

        mysqli_select_db($sms, $database_sms);
        $Result2 = mysqli_query($sms, $updateSQL2) or die(mysqli_error($sms));
  
    }  


  $updateGoTo = "documentos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));

}
/* //PHP_SELF */  


	mysqli_select_db ($sms, $database_sms);
	$query_Recordset1 = "SELECT * FROM t_docs WHERE id=$id";
	$Recordset1 = mysqli_query($sms, $query_Recordset1) or die(mysqli_error($sms));
	$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

if ($row_Recordset1['id_tipo']==1) {
	mysqli_select_db ($sms, $database_sms);
	$query_Recordset2 = "SELECT * FROM t_prest_social WHERE id_doc=$id";
	$Recordset2 = mysqli_query($sms, $query_Recordset2) or die(mysqli_error($sms));
	$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
	$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
}

if ($row_Recordset1['id_tipo']==2) {
	mysqli_select_db ($sms, $database_sms);
	$query_Recordset2 = "SELECT * FROM t_tramite WHERE id_doc=$id";
	$Recordset2 = mysqli_query($sms, $query_Recordset2) or die(mysqli_error($sms));
	$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
	$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
}

if ($row_Recordset1['id_tipo']==3) {
	mysqli_select_db ($sms, $database_sms);
	$query_Recordset2 = "SELECT * FROM t_reclamo WHERE id_doc=$id";
	$Recordset2 = mysqli_query($sms, $query_Recordset2) or die(mysqli_error($sms));
	$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
	$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
}

if ($row_Recordset1['id_tipo']==4) {
	mysqli_select_db ($sms, $database_sms);
	$query_Recordset2 = "SELECT * FROM t_expediente WHERE id_doc=$id";
	$Recordset2 = mysqli_query($sms, $query_Recordset2) or die(mysqli_error($sms));
	$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
	$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
}

?>
<!DOCTYPE html>
<html>
<head>
<?php include('includes/css.php');

?>
<style media="screen">
.center-block { 
   margin-left:auto;
   margin-right:auto;
     display:block;
     padding: 2em;
     border-bottom: 1px dotted grey;
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
                <h3>Registro de Documento</h3>
                </center>
            </div> 
<div class="clearfix"></div> <hr>
         <div class="col-md-10 col-md-offset-1">

                <div class="form-group col-md-4">
                    <label>Usuario que realiza el registro: </label>         
                      <input  type="text" name="nombre" class="form-control" readonly  title="Minimo 2 caracteres, solo letras admitidas" value="<?php echo ObtenerNombreUsuario($row_Recordset1['id_user']);?>" >
                </div>

                <div class="form-group col-md-4">
                    <label>Tipo de Documento: </label>         
                      <input  type="text" name="id" class="form-control" readonly  title="Minimo 2 caracteres, solo letras admitidas" 
                      value="<?php echo utf8_decode(ObtenerTipoDocumento($row_Recordset1['id_tipo']));?>" >
                </div>

                <div class="form-group col-md-4">
                    <label>Fecha Emision:</label>
                  <input readonly name="fch_emision" value="<?php echo date('d/m/Y', strtotime($row_Recordset1['fch_emision'])) ?>" class="form-control" type="text" >
                </div>

                
                <div class="clearfix"></div> <hr>
                

                <div class="form-group col-md-6">
                    <label>Dependencia:</label>
                    <textarea class="form-control" maxlength="240" name="str_dependencia" pattern="[A-Za-z].{2,}" title="Minimo 2 caracteres" rows="8" cols="20"><?php echo $row_Recordset1['str_dependencia']; ?></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label>Remitente: </label>
                    <textarea class="form-control" maxlength="240" name="str_remitente" pattern="[A-Za-z].{2,}" title="Minimo 2 caracteres" rows="8" cols="20"><?php echo $row_Recordset1['str_remitente']; ?></textarea>
                </div>

<div class="clearfix"></div> <hr>
<!-- PRESTACION SOCIAL -->
<?php if ($id==1) { ?>  
                <div class="form-group col-md-4">
                    <label>Nombre</label>
                  <input required  type="text" name="str_nombre" maxlength="120" class="form-control" pattern="[A-Za-z].{4,}" title="Minimo 4 caracteres" value="<?php echo $row_Recordset2['str_nombre']; ?>">
                </div>
<?php  }  ?>
<!-- TRAMITE -->
<?php if ($id==2) { ?>  
                <div class="form-group col-md-4">
                    <label>Tipo de Traminte</label>
                  <input required  type="text" name="str_tipo" maxlength="240" class="form-control" pattern="[A-Za-z].{4,}" title="Minimo 4 caracteres" value="<?php echo $row_Recordset2['str_tipo']; ?>">
                </div>
<?php  }  ?>
<!-- RECLAMO -->
<?php if ($id==3) { ?>  
                <div class="form-group col-md-4">
                    <label>Nombre</label>
                  <input required  type="text" name="str_nombre" maxlength="120" class="form-control" pattern="[A-Za-z].{4,}" title="Minimo 4 caracteres" value="<?php echo $row_Recordset2['str_nombre']; ?>">
                </div>
                
                <div class="form-group col-md-4">
                    <label>Fecha Reclamo:</label>
                  <input class="form-control" type="text" readonly value="<?php echo  $row_Recordset2['fch_reclamo']; ?>">
                </div>
<?php  }  ?>
<!-- EXPEDIENTE -->
<?php if ($id==4) { ?>  
                <div class="form-group col-md-4">
                    <label>Dependencia del Expediente</label>
                  <input required  type="text" name="str_dependencia" maxlength="240" class="form-control" pattern="[A-Za-z].{4,}" title="Minimo 4 caracteres" value="<?php echo $row_Recordset2['str_dependencia']; ?>">
                </div>
<?php  }  ?>
                
<div class="clearfix"></div> <hr>

             </div>
             
                 <input required  class="form-control btn btn-info" type="submit" value="Modificar">
                  <input type="hidden" name="MM_update" value="form1" />
                  <input type="hidden" name="t_doc" value="<?php echo $row_Recordset1['id_tipo']   ?>" />
                  <input type="hidden" name="id" value="<?php echo $id;   ?>" />
             <div class="clearfix"></div>

                </form>
        </div>

    <div class="clearfix"></div>
  </div>
</div>
<!-- //banner-bottom -->

<?php include('includes/footer.php'); ?>

<script>
$(document).ready(function() {
// Esta primera parte crea un loader no es necesaria

// Interceptamos el evento submit
$('#form, #fat, #documento_add').submit(function() {
// Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {

                if(data ==1) {

                 var contenido = '<a href="#" class="close" data-dismiss="alert">&times;</a><strong>Ingreso Exitoso!</strong> Sera Redireccionado.';

              $('#alert-success').html(contenido);

                  $('#alert-success').fadeIn("normal");

                setTimeout(function(){
                  window.location.href='documentos.php'; 
                  }, 2000);  
                }

                if(data ==0) {

                 var contenido = '<a href="#" class="close" data-dismiss="alert">&times;</a><strong>Datos Erroneos!</strong> Chequee sus datos y vuelva a intentarlo.';

                    $('#alert-error').html(contenido);

                    $('#alert-error').fadeIn("normal");

                }
            }
        })
        return false;
    });
});


$(document).ready(function() {
   // Esta primera parte crea un loader no es necesaria

   // Interceptamos el evento submit
    $('#form, #fat, #customer_register').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {

                if(data ==1)
                {
                 var contenido = '<a href="#" class="close" data-dismiss="alert">&times;</a><strong>Registro Exitoso!</strong> Ya puedes ingresar a tu cuenta.';

              $('#alert-success').html(contenido);

                    $('#alert-success').fadeIn("normal");

                }

                if(data ==0)
                {

                 var contenido = '<a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error en registro!</strong> Su Correo ya se encuentra registrado, por favor pruebe con otro.';

                     $('#alert-error').html(contenido);

                     $('#alert-error').fadeIn("normal");

                    // window.location.href='login.php';

                }



            }
        })
        return false;
    });
});
</script>
</body>
</html>
