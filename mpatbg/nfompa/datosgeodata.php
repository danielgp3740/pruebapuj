<?php
//include("config.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');

$geotable = $_GET['table'];
//$sql = "select * from $geotable as json";
$sql_geodata = "select geo_codigo, geo_coory, geo_coorx, geo_descripcion, geo_fotourl from ".$geotable." as json";

if (!$response = $cnxn_pag->ejecutar($sql_geodata)){
    echo "Ha ocurrido un error";
    exit;
}

while ($row=$cnxn_pag->obtener_filasrow($response)){
    foreach ($row as $i => $attr){
        echo $attr.", ";
    }
    echo ";";
}
?>
