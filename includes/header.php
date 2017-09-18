<!-- header -->
<div class="header">
		<div class="container">
			<div class="header-nav">
				<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					    <h1><a class="navbar-brand" href="index.php"><img class="logo-header" src="images/logo.png" alt="" /></a></h1>

					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a class="hvr-overline-from-center button2 active" href="index.php">Inicio</a></li>
							<li><a class="hvr-overline-from-center button2" href="index.php">Ayuda</a></li>


				  <?php if(isset($_SESSION["MM_Idusuario"])){ ?>
							<!-- <li><a class="hvr-overline-from-center button2" href="about.html">Módulos</a></li> -->
							<li class="hvr-overline-from-center button2" class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" >Opciones <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<!-- <li><a href="registro_doc.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Registro de Documento</a></li> -->
									<li><a href="documentos.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Registro/Consulta de Documento</a></li>
									<!-- <li><a href="#">Another action</a></li> -->
									<li role="separator" class="divider"></li>
									<!-- <?php if(isset($_SESSION["MM_Idusuario"])){ ?>
									<li><a href="respaldo.php"><i class="fa fa-cloud-download" aria-hidden="true"></i> Hacer Respaldo Dase de Datos </a></li>
									<li role="separator" class="divider"></li>
									<li><a href="restaurar_bd.php"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Restaurar Dase de Datos </a></li>

									<li role="separator" class="divider"></li>
									<?php }  ?> -->
									<!-- <li><a href="editar_perfil.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Datos de Cuenta</a></li> -->
									<li><a href="usuario.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Datos de Cuenta</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar Sesión</a></li>
								</ul>
							</li>

					<?php } else { ?>
						<li><a class="hvr-overline-from-center button2" href="login.php">Iniciar Sesión</a></li>
					<?php }  ?>
							<!-- <li><a class="hvr-overline-from-center button2" href="contact.html">Contact</a></li> -->
						</ul>
						<div class="search-box">
							<div id="sb-search" class="sb-search">
								<form>
									<input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
									<input class="sb-search-submit" type="submit" value="">
									<span class="sb-icon-search"> </span>
								</form>
							</div>
						</div>
					</div><!-- /navbar-collapse -->

					<!-- search-scripts -->
					<script src="js/classie.js"></script>
					<script src="js/uisearch.js"></script>
						<script>
							new UISearch( document.getElementById( 'sb-search' ) );
						</script>
					<!-- //search-scripts -->
				</nav>
			</div>
		</div>
</div>
<!-- header -->
