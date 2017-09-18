<?php require_once('conex/sms.php'); ?>
<?php
if (isset($_SESSION['MM_Idusuario'])){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include('includes/css.php'); ?>
</head>
<body>

<?php include('includes/header.php'); ?>

<!-- banner-bottom -->
<div class="typrography">
	 <div class="container">

		<div class="col-md-4 col-md-offset-1">
			<form class="form-horizontal"  action="includes/login.php" id="customer_login3" name="customer_login3">

					<h3 class="bars">Inicio de Sesión</h3>

		 <div class="form-group">
			<br>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
				  <input required  type="text" name="usuario" class="form-control" placeholder="Usuario" aria-describedby="basic-addon1">
				</div>

				<div class="input-group">
				  <input required  type="password" name="password" class="form-control" placeholder="Contraseña" aria-describedby="basic-addon2">
					<span class="input-group-addon" id="basic-addon2">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</span>
				</div>
	 		</div>
				 <input required  class="form-control btn btn-info" type="submit" value="Login">
	 		<div class="clearfix"></div>

				</form>
		</div>

    <div class="col-md-2" ><hr></div>

		<div class="col-md-4">
			<form class="form-horizontal"  action="includes/register.php" id="customer_register" name="customer_register">

					<h3 class="bars">Registro de Usuario</h3>

		 <div class="form-group">
			<br>

				<div class="input-group">
					<span class="input-group-addon" >Nombre</span>
				  <input required  type="text" name="nombre" class="form-control" placeholder="Nombre" pattern="[A-Za-z].{2,}" title="Minimo 2 caracteres, solo letras admitidas" >
				</div>

				<div class="input-group">
				  <input required  type="text" name="apellido" class="form-control" placeholder="Apellido" pattern="[A-Za-z].{2,}"
				  title="Minimo 2 caracteres, solo letras admitidas" >
					<span class="input-group-addon" >Apellido</span>
				</div>

				<div class="input-group">
					<span class="input-group-addon" >Cédula</span>
				  <input required  type="text" name="ced" class="form-control" placeholder="Cédula" pattern="[0-9].{6,}" title="Solo números permitidos, minimo 6 caracteres">
				</div>

				<div class="input-group">
				  <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
				  <input required  type="text" name="usuario" class="form-control" placeholder="Usuario" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}" title="Debe contener al menos 1 Mayuscula y 1 Minuscula, minimo 8 caracteres" >
				</div>

				<div class="input-group">
				  <input required  type="password" name="password" class="form-control" placeholder="Contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Debe contener al menos 1 Número, una Mayuscula y 1 Minuscula, minimo 8 caracteres" >
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</span>
				</div>

	 		</div>
				 <input required  class="form-control btn btn-success" type="submit" value="Login">
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
$('#form, #fat, #customer_login3').submit(function() {
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
				  window.location.href='index.php';
 }, 4000);  
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
