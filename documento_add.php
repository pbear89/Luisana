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

 $tipo_doc = "0";
    if (isset($_GET["id"])) {
        $tipo_doc = $_GET["id"];
    } else {
      header("Location: documentos.php");
    }

/* PHP_SELF */    
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

 $insertSQL = sprintf("INSERT INTO t_docs (id_tipo, id_user, fch_emision, str_dependencia, str_remitente) VALUES (%s, %s, NOW(), %s, %s)",

                       GetSQLValueString($_POST['t_doc'], "int"),
                       GetSQLValueString($_SESSION['MM_Idusuario'], "int"),
                       GetSQLValueString($_POST['str_dependencia'], "text"),
                       GetSQLValueString($_POST['str_remitente'], "text")
                       
                    );

  mysqli_select_db($sms, $database_sms);
  $Result1 = mysqli_query($sms, $insertSQL) or die(mysqli_error($sms));
   $id = mysqli_insert_id($sms);

    /* <!-- PRESTACION SOCIAL -->  */
 if ($_POST['t_doc']==1) {   
        $insertSQL2 = sprintf("INSERT INTO t_prest_social ( id_doc, str_nombre, fch_creacion, fch_mod ) VALUES (%s, %s, NOW(), NOW())",

                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST['str_nombre'], "text")

                );

        mysqli_select_db($sms, $database_sms);
        $Result2 = mysqli_query($sms, $insertSQL2) or die(mysqli_error($sms)); 
    }
    /* <!-- TRAMITE --> */
 if ($_POST['t_doc']==2) {   
        $insertSQL2 = sprintf("INSERT INTO t_tramite ( id_doc, str_tipo, fch_creacion, fch_mod ) VALUES (%s, %s, NOW(), NOW())",

                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST['str_tipo'], "text")

                );

        mysqli_select_db($sms, $database_sms);
        $Result2 = mysqli_query($sms, $insertSQL2) or die(mysqli_error($sms));
  
   }  
    /* <!-- RECLAMO --> */
 if ($_POST['t_doc']==3) { 
         $insertSQL2 = sprintf("INSERT INTO t_tramite ( id_doc, str_nombre, fch_reclamo, fch_creacion, fch_mod ) VALUES (%s, %s, %s, NOW(), NOW())",

                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST['str_nombre'], "text"),
                GetSQLValueString($_POST['fch_reclamo'], "text")

                );

        mysqli_select_db($sms, $database_sms);
        $Result2 = mysqli_query($sms, $insertSQL2) or die(mysqli_error($sms));
  
    }  
    /* <!-- EXPEDIENTE --> */
 if ($_POST['t_doc']==4) {  
          $insertSQL2 = sprintf("INSERT INTO t_tramite ( id_doc, str_dependencia, fch_creacion, fch_mod ) VALUES (%s, %s, NOW(), NOW())",

                GetSQLValueString($id, "int"),
                GetSQLValueString($_POST['str_dependencia'], "text")

                );

        mysqli_select_db($sms, $database_sms);
        $Result2 = mysqli_query($sms, $insertSQL2) or die(mysqli_error($sms));
  
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
	$query_Recordset1 = "SELECT * FROM t_docs";
	$Recordset1 = mysqli_query($sms, $query_Recordset1) or die(mysqli_error($sms));
	$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


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
                      <input  type="text" name="nombre" class="form-control" readonly  title="Minimo 2 caracteres, solo letras admitidas" value="<?php echo ObtenerNombreUsuario($_SESSION['MM_Idusuario']);?>" >
                </div>

                <div class="form-group col-md-4">
                    <label>Tipo de Documento: </label>         
                      <input  type="text" name="tipo_doc" class="form-control" readonly  title="Minimo 2 caracteres, solo letras admitidas" 
                      value="<?php echo utf8_decode(ObtenerTipoDocumento($tipo_doc));?>" >
                </div>

                <div class="form-group col-md-4">
                    <label>Fecha Emision:</label>
                  <input required name="fch_emision" class="form-control" type="date" >
                </div>

                
                <div class="clearfix"></div> <hr>
                

                <div class="form-group col-md-6">
                    <label>Dependencia:</label>
                    <textarea required class="form-control" maxlength="240" name="str_dependencia" pattern="[A-Za-z].{2,}" title="Minimo 2 caracteres" rows="8" cols="20"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label>Remitente: </label>
                  <textarea required class="form-control" maxlength="240" name="str_remitente" pattern="[A-Za-z].{2,}" title="Minimo 2 caracteres" rows="8" cols="20"></textarea>
                </div>

<div class="clearfix"></div> <hr>
<!-- PRESTACION SOCIAL -->
<?php if ($tipo_doc==1) { ?>  
                <div class="form-group col-md-4">
                    <label>Nombre</label>
                  <input required  type="text" name="str_nombre" maxlength="120" class="form-control" pattern="[A-Za-z].{4,}" title="Minimo 4 caracteres">
                </div>
<?php  }  ?>
<!-- TRAMITE -->
<?php if ($tipo_doc==2) { ?>  
                <div class="form-group col-md-4">
                    <label>Tipo de Traminte</label>
                  <input required  type="text" name="str_tipo" maxlength="240" class="form-control" pattern="[A-Za-z].{4,}" title="Minimo 4 caracteres">
                </div>
<?php  }  ?>
<!-- RECLAMO -->
<?php if ($tipo_doc==3) { ?>  
                <div class="form-group col-md-4">
                    <label>Nombre</label>
                  <input required  type="text" name="str_nombre" maxlength="120" class="form-control" pattern="[A-Za-z].{4,}" title="Minimo 4 caracteres">
                </div>
                
                <div class="form-group col-md-4">
                    <label>Fecha Reclamo:</label>
                  <input required name="fch_reclamo" class="form-control" type="date" >
                </div>
<?php  }  ?>
<!-- EXPEDIENTE -->
<?php if ($tipo_doc==4) { ?>  
                <div class="form-group col-md-4">
                    <label>Dependencia del Expediente</label>
                  <input required  type="text" name="str_dependencia" maxlength="240" class="form-control" pattern="[A-Za-z].{4,}" title="Minimo 4 caracteres">
                </div>
<?php  }  ?>
                
<div class="clearfix"></div> <hr>

             </div>
             
                 <input required  class="form-control btn btn-info" type="submit" value="Registrar">
                  <input type="hidden" name="MM_update" value="form1" />
                  <input type="hidden" name="t_doc" value="<?php echo $tipo_doc;   ?>" />
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
