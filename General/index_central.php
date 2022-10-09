<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestor</title>
</head>
<body>
    <form action="" method="post" id="formu1">
        <?php        
        session_start();
        include_once($_SERVER["DOCUMENT_ROOT"]."/CentroDeProcesos.php");
        $menu_lateral = new libre_v5('php7',$conexion,'');
            $libre_v5_obj= new libre_v5('php7',$conexion,'');
            $elemento_menu=array(
                #'Transporte Garcia',
                #'Cuentas',
                #'Sistemas Gps',
                #'Admin GPS',
                'Control Combustible',
                'Control Archivos'
            );
            $name_menu_cenntral="menu_central";            
            $class=array(
                'Conte_principal'=>'Menu_central',
                'Div_Opcion'=>'Conte_Cuadrado_auto',
                'Boton'=>'boton_Cuadrado_auto_claro',
                'img'=>'img_Cuadrado_auto'
            );
            $otros_arrays=array(
                'img_activa'    => 'true',
                'img_defaul'    =>'img/defaul.jpg',
                'img'           =>array("img/logo.jpg","img/admin_garcia.png",'img/MAPS.jpg',"img/candado2-sistem.jpg","img/combustible.png"),
                'memoria'       =>array('Activa'=>true,'type'=>'hidden')
            );
            $libre_v5_obj->menu($name_menu_cenntral,$elemento_menu,$class,$otros_arrays);
            //include_once("cargar_archivos\consultar\Consu_folder.php");// dirrectorios 
            echo"<div id='Conte_pri' class='Conte_pri'>";
        
                if(!empty($_POST[$name_menu_cenntral]) and $_POST[$name_menu_cenntral]=='Cuentas')              {include_once("Cuentas2/body.php");}
                if(!empty($_POST[$name_menu_cenntral]) and $_POST[$name_menu_cenntral]=='Sistemas Gps')         {include_once("SistemaDeGPS/body_GPS.php");}
                if(!empty($_POST[$name_menu_cenntral]) and $_POST[$name_menu_cenntral]=="Control Combustible")  {include_once($_SERVER["DOCUMENT_ROOT"]."/combustible/body_combustible.php");}
                if(!empty($_POST[$name_menu_cenntral]) and $_POST[$name_menu_cenntral]=="Control Archivos")     {include_once($_SERVER["DOCUMENT_ROOT"]."/ControlArchivos/body_ControlArchivos.php");}
            
            echo"</div>";
            /*
            echo"<div id='ConsolaProcesos' class='ConsolaProcesos'>";
                include_once($_SERVER["DOCUMENT_ROOT"]."/Consola_de_operaciones.php");
            echo"</div>";
            */
            
        ?>
        </form>
</body>
</html>