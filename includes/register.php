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

// *** Redirect if username exists


  $MM_dupKeyRedirect="../registro_error.php";
  $loginUsername = $_POST['usuario'];
  $LoginRS__query = sprintf("SELECT str_user FROM t_users WHERE str_user=%s",
                    GetSQLValueString($loginUsername, "text")
                  );
  mysqli_select_db($sms, $database_sms);
  $LoginRS=mysqli_query($sms, $LoginRS__query) or die(mysqli_error($sms));
  $loginFoundUser = mysqli_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser > 0) {
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
   echo "0";
  }

if($loginFoundUser == 0) {
  $insertSQL = sprintf("INSERT INTO t_users (str_user, str_pass) VALUES (%s, %s)",
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString(sha1($_POST['password']), "text"));

  mysqli_select_db($sms, $database_sms);
  $Result1 = mysqli_query($sms, $insertSQL) or die(mysqli_error($sms));
   $id = mysqli_insert_id($sms);

  $insertSQL2 = sprintf("INSERT INTO t_users_dat ( id_user, str_nombre, str_apellido, str_ced, str_mail ) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($id, "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['ced'], "int"),
                       GetSQLValueString($_POST['ced'], "int"),
                       GetSQLValueString($_POST['email'], "text")
                     );

  mysqli_select_db($sms, $database_sms);
$Result2 = mysqli_query($sms, $insertSQL2) or die(mysqli_error($sms));
 // $asunto= "Registro en sms.com";
 //EnvioCorreoRegistro($_POST['email'] ,$_POST['password'], $asunto, $_POST['nombre']);

 echo "1";
}

?>
