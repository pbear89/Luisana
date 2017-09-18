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

//*********************************************
//*********************************************
//*********************************************
function ObtenerNombreUsuario($identificador)
{
    global $database_sms, $sms;
    mysqli_select_db ($sms, $database_sms);
    $query_ConsultaFuncion = sprintf("SELECT t_users_dat.str_nombre FROM t_users_dat WHERE t_users_dat.id_user = %s",$identificador);
    $ConsultaFuncion = mysqli_query($sms, $query_ConsultaFuncion) or die(mysqli_error($sms));
    $row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
    $totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);

    return $row_ConsultaFuncion['str_nombre'];
    mysqli_free_result($ConsultaFuncion);
}

//*********************************************
//*********************************************
//*********************************************
function ObtenerApellidoUsuario($identificador)
{
    global $database_sms, $sms;
    mysqli_select_db ($sms, $database_sms);
    $query_ConsultaFuncion = sprintf("SELECT t_users_dat.str_apellido FROM t_users_dat WHERE t_users_dat.id_user = %s",$identificador);
    $ConsultaFuncion = mysqli_query($sms, $query_ConsultaFuncion) or die(mysqli_error($sms));
    $row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
    $totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);

    return $row_ConsultaFuncion['str_apellido'];
    mysqli_free_result($ConsultaFuncion);
}

//*********************************************
//*********************************************
//*********************************************
function ObtenerTipoDocumento($identificador)
{
    global $database_sms, $sms;
    mysqli_select_db ($sms, $database_sms);
    $query_ConsultaFuncion = sprintf("SELECT * FROM t_docs_tipo WHERE id = %s",$identificador);    
    $ConsultaFuncion = mysqli_query($sms, $query_ConsultaFuncion) or die(mysqli_error($sms));
    $row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
    $totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);

    return $row_ConsultaFuncion['str_tipo'];

    mysqli_free_result($ConsultaFuncion);
}

//*********************************************
//*********************************************
//*********************************************
function ObtenerTipoUsuario($identificador)
{
    global $database_sms, $sms;
    mysqli_select_db ($sms, $database_sms);
    $query_ConsultaFuncion = sprintf("SELECT * FROM t_users WHERE id = %s",$identificador);    
    $ConsultaFuncion = mysqli_query($sms, $query_ConsultaFuncion) or die(mysqli_error($sms));
    $row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
    $totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);

    return $row_ConsultaFuncion['int_lvl'];

    mysqli_free_result($ConsultaFuncion);
}

//*********************************************
//*********************************************
//*********************************************
function ObtenerTipoUsuarioTxt($identificador)
{
    global $database_sms, $sms;
    mysqli_select_db ($sms, $database_sms);
    $query_ConsultaFuncion = sprintf("SELECT * FROM t_users WHERE id = %s",$identificador);    
    $ConsultaFuncion = mysqli_query($sms, $query_ConsultaFuncion) or die(mysqli_error($sms));
    $row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
    $totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);

    if ($row_ConsultaFuncion['int_lvl']==1) {
        return "Usuario Comun";
    } else {
        return "Administrador";
    }

    mysqli_free_result($ConsultaFuncion);
}

//*********************************************
//*********************************************
//*********************************************
