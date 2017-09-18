<?php require_once('../conex/sms.php'); ?>
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


// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "../index.php";
  $MM_redirectLoginFailed = "../acceso_negado.php";
  $MM_redirecttoReferrer = false;

  mysqli_select_db($sms, $database_sms);
  $LoginRS__query=sprintf("SELECT id, str_user, str_pass FROM t_users WHERE str_user=%s AND str_pass=%s",
          GetSQLValueString($loginUsername, "text"),
          GetSQLValueString(sha1($password), "text"));

          $LoginRS=mysqli_query($sms, $LoginRS__query) or die(mysqli_error($sms));
          $row_LoginRS = mysqli_fetch_assoc($LoginRS);
          $loginFoundUser = mysqli_num_rows($LoginRS);


  if ($loginFoundUser) {
     $loginStrGroup = "";

  	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
      //declare two session variables and assign them
      $_SESSION['MM_Username'] = $loginUsername;
      $_SESSION['MM_UserGroup'] = $loginStrGroup;
  	  $_SESSION['MM_Idusuario'] = $row_LoginRS["id"];

      echo "1";
  }  else {
       echo "0";
  }
}
?>
