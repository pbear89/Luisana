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


	mysqli_select_db ($sms, $database_sms);
	$query_Recordset1 = "SELECT * FROM t_docs WHERE id=$id";
	$Recordset1 = mysqli_query($sms, $query_Recordset1) or die(mysqli_error($sms));
	$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


if ((isset($_GET['id'])) && ($_GET['id'] != "")) {

    if ($row_Recordset1['id_tipo']==1) {
        $deleteSQL = sprintf("DELETE FROM t_prest_social WHERE id_doc=%s",  GetSQLValueString($_GET['id'], "int"));
        mysql_select_db($database_sms, $sms);
        $Result1 = mysqli_query($deleteSQL, $sms) or die(mysql_error());
    }

    if ($row_Recordset1['id_tipo']==2) {
        $deleteSQL = sprintf("DELETE FROM t_tramite WHERE id_doc=%s",  GetSQLValueString($_GET['id'], "int"));
        mysql_select_db($database_sms, $sms);
        $Result1 = mysqli_query($deleteSQL, $sms) or die(mysql_error());
    }  
    
    if ($row_Recordset1['id_tipo']==3) {
        $deleteSQL = sprintf("DELETE FROM t_reclamo WHERE id_doc=%s",  GetSQLValueString($_GET['id'], "int"));
        mysql_select_db($database_sms, $sms);
        $Result1 = mysqli_query($deleteSQL, $sms) or die(mysql_error());
    }  

    if ($row_Recordset1['id_tipo']==4) {
        $deleteSQL = sprintf("DELETE FROM t_expediente WHERE id_doc=%s",  GetSQLValueString($_GET['id'], "int"));
        mysql_select_db($database_sms, $sms);
        $Result1 = mysqli_query($deleteSQL, $sms) or die(mysql_error());
    }

    $deleteSQL = sprintf("DELETE FROM t_docs WHERE id=%s",  GetSQLValueString($_GET['id'], "int"));
    mysql_select_db($database_sms, $sms);
    $Result1 = mysqli_query($deleteSQL, $sms) or die(mysql_error());
   

    header("Location: documentos.php");
}
?>
