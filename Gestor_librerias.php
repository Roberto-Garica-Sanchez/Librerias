<?php
$Gestor_liberias=array(
    "sistemas_cuentas" =>array(
        "annie"=>'',
        "ares"=>'',
        "carmesi"=>'',
        "celeste"=>'',
    )
);

#include_once($programa_ejecucion.);
if(!empty($_POST['Soft_version']))
switch ($_POST['Soft_version']) {
    case 'Annie':
        switch ($_POST['name_programa']) {
            case 'sistemas_cuentas':
                echo $programa_ejecucion=$_POST['name_programa'].'/'.$_POST['Soft_version'];
                include_once("General\CentroDeProcesos.php");
            break;
        }
    break;
    case 'Ares':
    break;
    case 'Carmesi':
    break;
    case 'Celeste':
    break;
}
else{
    include_once("General\CentroDeProcesos.php");
}
?>