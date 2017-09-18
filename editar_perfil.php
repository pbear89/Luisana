<?php require_once("conex/sms.php");

 if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
  // For security, start by assuming the visitor is NOT authorized.
  $isValid = False;

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username.
  // Therefore, we know that a user is NOT logged in if that Session variable is blank.
  if (!empty($UserName)) {
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login.
    // Parse the strings into arrays.
    $arrUsers = Explode(",", $strUsers);
    $arrGroups = Explode(",", $strGroups);
    if (in_array($UserName, $arrUsers)) {
      $isValid = true;
    }
    // Or, you may restrict access to only certain users based on their username.
    if (in_array($UserGroup, $arrGroups)) {
      $isValid = true;
    }
    if (($strUsers == "") && true) {
      $isValid = true;
    }
  }
  return $isValid;
}

$MM_restrictGoTo = "usuario_sesion_caducada.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0)
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo);
  exit;
}
 ?>
 <?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tblusuarios SET strnombre=%s, stremail=%s WHERE idusuario=%s",
                       GetSQLValueString($_POST['strnombre'], "text"),
                       GetSQLValueString($_POST['stremail'], "text"),


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

$usuario_perfilusuario = "0";
if (isset($_SESSION["MM_Idusuario"])) {
  $usuario_perfilusuario = $_SESSION["MM_Idusuario"];
}
mysql_select_db($database_sms, $sms);
$query_perfilusuario = sprintf("SELECT * FROM tblusuarios WHERE tblusuarios.idusuario = %s", GetSQLValueString($usuario_perfilusuario, "int"));
$perfilusuario = mysql_query($query_perfilusuario, $sms) or die(mysql_error());
$row_perfilusuario = mysql_fetch_assoc($perfilusuario);
$totalRows_perfilusuario = mysql_num_rows($perfilusuario);
?>
<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <meta name="description" content=" ">
  <meta name="author" content=" ">
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

  <title><?php echo $title ?></title>

  <?php include("includes/css.php")?>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="bootstrap/js/html5shiv.js"></script>
  <script src="bootstrap/js/respond.min.js"></script>
  <![endif]-->

</head>
<body>
<div class="wrapper">

<?php include("includes/header.php")?>

<section id="Content" role="main">
<div class="container">
<div id="content" class="col-md-12  margen-superior col-sm-12 centrado">


    <div class="login-content">
          <div class="content">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table  class="editar-perfil" align="center">
      <tr valign="baseline">
        <td nowrap align="right"><?php echo $first_name ?>:</td>
        <td><input type="text" name="strnombre" value="<?php echo htmlentities($row_perfilusuario['strnombre'], ENT_COMPAT, 'UTF-8'); ?>" size="32"></td>
      </tr>
      <br><br>
      <tr valign="baseline">
        <td nowrap align="right">Email:</td>
        <td><input type="text" name="stremail" value="<?php echo htmlentities($row_perfilusuario['stremail'], ENT_COMPAT, 'UTF-8'); ?>" size="32"></td>
      </tr>
       <br><br>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit"  class="btn btn-default" value="Guardar"/></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="idusuario" value="<?php echo $row_perfilusuario['idusuario']; ?>">
  </form>
  </div>

        </div>
                        <!-- end accourdion group -->
                          <!-- end accourdion group -->

						</div>

  <!-- FULL WIDTH -->
</div>
<!-- !container -->

<!-- !full-width -->

<!-- !container -->

<!-- !full-width -->

<!-- !container -->


</section>

<div class="clearfix visible-xs visible-sm"></div>
<!-- fixes floating problems when mobile menu is visible -->

<?php include("includes/footer.php")?>


<?php include("includes/formularios.php")?>

</div>

<?php include("includes/js.php")?>


</body>


</html>
