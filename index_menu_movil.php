<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nuevo Motor</title>
        <?php
            include_once('libre_v5.php');                           
        ?>
    </head>
    <body>
        <form action="" method="post">            
            <?php
                
                $objetos_libreria = new libre_v5();  
                //if(empty($libre_v5))$libre_v5= new libre_v5('php7',$conexion,'');

                $TEST=array('boton1','TESA');
                //$objetos_libreria->menu('PRUEBA',$TEST,'TEST');  

                    $menu_lateral = new libre_v5();   
                        $elemento_menu=array('Arbol Operativo','Cuentas Operadores','Taller','Almacen','Contabilidad');
                        $class_menu="Menu_movil_lateral";
                    echo $menu_lateral->menu_movil($elemento_menu,$class_menu);
            ?>
        </form>   
    </body>
</html>