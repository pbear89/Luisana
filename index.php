<?php require_once('conex/sms.php'); ?>
<!DOCTYPE html>
<html>
<head>
<?php include('includes/css.php'); ?>
<style media="screen">
.center-block {
   margin-left:auto;
   margin-right:auto;
   display:block;
}
.logo-index {
	width: auto;
	height: 20em;
}
</style>
</head>
<body>

<?php include('includes/header.php'); ?>

<!-- banner-bottom -->
<div class="banner-bottom">
	<div class="container">
		<div class="col-md-12 center-block">
			<img class="logo-index center-block" src="images/logo.png" alt="" >
		</div>
		<!-- <h3 class="title1">Gestion  de Expedientes y  Documentos</h3> -->
		<div class="bottom-grids">
      <?php if(!isset($_SESSION["MM_Idusuario"])){ ?>
        <div class="col-lg-4 col-md-2 col-sm-2 bottom-grid">
        </div>
        <div class="col-lg-4 col-md-8 col-sm-8 bottom-grid">
        	<div class="bottom-text">
            <h3>Instrucciones</h3>
            <p>Para poder realizar: <br>Consultas,
              Agregar Registros <br>o Modificaciones.<br>
              Debe <strong> <a href="login.php">Iniciar Sesión</a></strong> .</p>
          </div>
          <div class="bottom-spa"><span class="glyphicon glyphicon-education" aria-hidden="true"></span></div>
        </div>

        <div class="col-lg-4 col-md-2 col-sm-2 bottom-grid">
        </div>

      <?php } else { ?>

        	<div class="col-md-3 bottom-grid">
  			</div>
			  
			<div class="col-md-3 bottom-grid">
				<a href="documentos.php">
					<div class="bottom-text">
						<h3>Registro Y Consulta De Documentos</h3>
						<p><strong>Registrar Documentos</strong> y <strong>Tramites </strong>de entrada a la oficina.
						También podra <strong>Consultar Documentos</strong> registrados previamente.</p>

					</div>
					<div class="bottom-spa"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div>
				</a>
			</div>
			

  			<div class="col-md-3 bottom-grid">
  				<div class="bottom-text">
  					<h3>Administracion de Usuario</h3>
  					<p>Editar los datos de <strong>Usuario </strong> como  <strong>Nombre y Apellido</strong>, <strong>Cédula</strong> y <strong>Correo</strong>.</p>
  				</div>
  				<div class="bottom-spa"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></div>
  			</div>

  			<div class="col-md-3 bottom-grid">
  			<!--	<div class="bottom-text">
  					<h3>OUR RELIABILITY</h3>
  					<p>Sed ut perspiciatis unde
  					omnis iste natus error sit
  					voluptatem accusantium doloremque
  					explicabo.</p>
  				</div>
  				<div class="bottom-spa"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></div>
  		-->
  			</div>
      <?php } ?>

			<div class="clearfix"></div>
		</div>
	</div>
</div>

<!-- //banner-bottom -->
<div class="clearfix"></div>

<?php include('includes/footer.php'); ?>

</body>
</html>
