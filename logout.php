<?php
session_start();
    $_SESSION['MM_Username'] = "";
    $_SESSION['MM_UserGroup'] = "";
	$_SESSION['MM_Idusuario'] = "";
	$_SESSION['MM_Temporal'] = "";
	unset ($_SESSION['MM_Username']);
    unset ($_SESSION['MM_UserGroup']);
	unset ($_SESSION['MM_Idusuario']);
	unset ($_SESSION['MM_Temporal']);	
header('Location: index.php');
?>