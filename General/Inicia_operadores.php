<?php

$boton_guarda=new inputs($phpv,$conexion,'');
    $boton_guarda->propiedades['type']='submit';
    $boton_guarda->propiedades['name']='Operadores';
    $boton_guarda->propiedades['value']='Guardar';
    $boton_guarda->propiedades['class']='Celdas Medio botones_submenu';
    $boton_guarda->propiedades['style']=array(
        'width'=>'50%'
    );
$boton_Modifica=new inputs($phpv,$conexion,'');
    $boton_Modifica->propiedades['type']='submit';
    $boton_Modifica->propiedades['name']='Operadores';
    $boton_Modifica->propiedades['value']='Modificar';
    $boton_Modifica->propiedades['class']='Celdas Medio botones_submenu';
    $boton_Modifica->propiedades['style']=array(
        'width'=>'50%'
    );
$boton_Eliminar=new inputs($phpv,$conexion,'');
    $boton_Eliminar->propiedades['type']='submit';
    $boton_Eliminar->propiedades['name']='Operadores';
    $boton_Eliminar->propiedades['value']='Eliminar';
    $boton_Eliminar->propiedades['class']='Celdas Medio botones_submenu';
    $boton_Eliminar->propiedades['style']=array(
        'width'=>'50%'
    );
$boton_Limpiar=new inputs($phpv,$conexion,'');
    $boton_Limpiar->propiedades['type']='submit';
    $boton_Limpiar->propiedades['name']='Operadores';
    $boton_Limpiar->propiedades['value']='Limpiar';
    $boton_Limpiar->propiedades['class']='Celdas Medio botones_submenu';
    $boton_Limpiar->propiedades['style']=array(
        'width'=>'50%'
    );
$boton_Cancelar=new inputs($phpv,$conexion,'');
    $boton_Cancelar->propiedades['type']='submit';
    $boton_Cancelar->propiedades['name']='Operadores';
    $boton_Cancelar->propiedades['value']='Cancelar';
    $boton_Cancelar->propiedades['class']='Celdas Medio botones_submenu';
    $boton_Cancelar->propiedades['style']=array(
        'width'=>'50%',
        "display"=>'none'
    );
$boton_Confirmar=new inputs($phpv,$conexion,'');
    $boton_Confirmar->propiedades['type']='submit';
    $boton_Confirmar->propiedades['name']='Operadores';
    $boton_Confirmar->propiedades['value']='Confirmar';
    $boton_Confirmar->propiedades['class']='Celdas Medio botones_submenu';
    $boton_Confirmar->propiedades['style']=array(
        "color"=>'red',
        'width'=>'50%',
        "display"=>'none'
    );
?>