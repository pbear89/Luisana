<?php require_once('conex/sms.php');
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
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
	 padding: 1em;
	 /* border-bottom: 1px dotted grey; */
}
.table{
	padding: 1em;
}
</style>
</head>
<body>

<?php include('includes/header.php'); ?>

<!-- first -->
<div class="ser-first">
	<div class="container">

		<div class="col-md-12 center-block">
			<center>
			<h3>Registro o Consulta De Documentos</h3>
			</center>
		</div> 
		<div class="clearfix"></div> <hr>

		
		<div class="col-md-12 table">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td class="center">
						<label for="">Tipo de Documento a Crear</label>
							<select class="form-control" id="t_doc">
								<option value=""> - Seleccione Uno - </option>
								<option value="4"> Expediente </option>
								<option value="1"> Prestacion Social </option>
								<option value="3"> Reclamo </option>
								<option value="2"> Tramite </option>
							</select>
						</td>
						<td class="center">
							<button type="button" class="btn btn-info" onclick="comprobar_link()">	
									Registrar Documento <i class="fa fa-pencil" aria-hidden="true"></i> 
						</button> 
						</td>
						<!-- <td class="center col-md-6">
							<a type="button" class="btn btn-info" href="productos_edit.php?recordId=<?php echo $row_Recordset1['idproducto']?>" title="Editar">
									Registrar <i class="fa fa-pencil" aria-hidden="true"></i> 
							</a>

							<a  type="button" class="btn btn-danger" onclick="ConfirmDemo(<?php echo $row_Recordset1['idproducto']?>)" title="Eliminar">
									<i class="fa fa-times" aria-hidden="true"></i>
							</a>
						</td> -->
					</tr>
				
				</tbody>
			</table>
		</div> 
	<div class="clearfix"></div> <hr>

		<div class="col-md-12 center-block">
			<center>
			<h3>Documentos Registrados</h3>
			</center>
		</div> 
	<div class="clearfix"></div> <hr>

		<div class="table-responsive col-md-12">
			<?php if ($totalRows_Recordset1==0){?>
			<div class="col-md-12 center-block">
				<br>
				<h3>No hay documentos registrados</h3>
				<br>
			</div> 
			<?php } else { ?>
			<div class="clearfix"></div> <hr>
				<table class="table table-striped table-bordered table-hover" id="dataTables-example" style="border-radius: 5px;">
					<thead>
							<tr>
									<th># de Registro</th>
									<th>Tipo</th>
									<th>Emision</th>
									<th>Dependencia</th>
									<th>Remitente</th>
									<th>Opciones</th>
							</tr>
					</thead>
					<tbody>
						<?php do { ?>									
						<tr class="odd gradeX" >	
							<td>#<?php echo str_pad($row_Recordset1['id'], 8, "0", STR_PAD_LEFT); ?></td>
							
							<td><?php echo ObtenerTipoDocumento($row_Recordset1['id_tipo']); ?> </td>

							<td><?php echo date('d/m/Y',strtotime($row_Recordset1['fch_emision'])); ?></td>

							<td><?php echo $row_Recordset1['str_dependencia']; ?></td>

							<td><?php echo $row_Recordset1['str_remitente']; ?></td>

							<td class="center col-md-3">
							<?php if (ObtenerTipoUsuario($_SESSION['MM_Idusuario'])==2) {?>
								<a type="button" class="btn btn-info" href="documento_edit.php?id=<?php echo $row_Recordset1['id']?>" title="Editar">
										Editar <i class="fa fa-pencil" aria-hidden="true"></i> 
								</a>

								<a  type="button" class="btn btn-danger" onclick="ConfirmDemo1(<?php echo $row_Recordset1['id']?>)" title="Eliminar">
										Eliminar <i class="fa fa-times" aria-hidden="true"></i>
								</a>
							<?php } else {?>
								<a type="button" class="btn btn-info" href="documento_ver.php?id=<?php echo $row_Recordset1['id']?>" title="Ver">
										Ver <i class="fa fa-eye" aria-hidden="true"></i> 
								</a>
							<?php } ?>
							</td> 
						</tr>
								
						<?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>


					</tbody>
				</table>
			<?php } ?>
	</div>
	<!-- /.table-responsive -->






		 <div class="clearfix"></div>    
		
	</div>

</div>
<!-- //first -->

<div class="clearfix"></div>

<?php include('includes/footer.php'); ?>

<script>
    function comprobar_link() {

				var t_documento = 0;
				var t_documento = $('#t_doc option:selected').val();
        if (t_documento == 0) {
            alert("Debe Seleccionar Un Tipo de Documento a Crear! ");
        } else {
            window.location.href='documento_add.php?id='+t_documento+'';
        }
    }
</script>
<script>
    var table = $('#dataTables-example').DataTable();

    $(document).ready(function() {
        table.page.len( 50 ).draw();
        table.order( [ 0, 'des' ] ).draw();
    });
</script>
<script>

    function ConfirmDemo1() {
        var idcompra;
        var idcompra = $('#compra').val();
//Ingresamos un mensaje a mostrar
        var mensaje = confirm("¿Confirma la eliminación de este registro? \n Esto también eliminará los datos asociados a este Documento.");
//Detectamos si el usuario acepto el mensaje
        if (mensaje) {
            alert("Eliminando Registro "+idcompra );
//            alert("compras_ver.php?eliminar=1&recordId="+idcompra);
            window.location.href='documento_del.php?eliminar=1&id='+idcompra;
        }
//Detectamos si el usuario denegó el mensaje
        else {
            alert("El registro no será eliminado");
            //window.location.reload();
        }
    }
</script>

</body>
</html>
