<?php
    $arrays='';    
    $columnas   = $libre_v4->Columnas($database,$tabla);     //obtiene las columnas de la tabla tanque
    $libre_v4->ExtraColumns($database,$tabla);               //busca si existe una columna auto incremental
    $Excepcion  = $libre_v4->getExtraColumns();                     //obtiene los resultados de la busqueda 
    if(empty($valores))$valores    = $libre_v4->ColunasInPost();                       //obtiene los valores enviado por post apartir de los nombre de las columnas 
    if(empty($ValoresByKey))$ValoresByKey='false';
    $ColumnasInsert     = $columnas;                //columnas de insert 
    $ValoresInsert      =  $valores;                //valores para insetar en la tabla 
    $array=array(
        "tabla"=>$tabla,
        "Operacion"=>
        array(  'INSERT'=>array(
                "Activar"    =>'true',
                "ValoresByKey"      =>$ValoresByKey,
                "ColumnasInsert"    =>$ColumnasInsert,//array(),
                "ValoresInsert"     =>$ValoresInsert, //array(),
                "Excepcion"         =>$Excepcion
            )
        )
    );
    
    $Ares_v1->GeneraSql($array);                    //genera el codigo MySql 
    $Ares_v1->viewSql();                            //visualisa el codigo generado
    $sql=$Ares_v1->getSql();                        //recupera el codigo generado
    $libre_v2->db($database,$conexion,$phpv);
    /*
    if (mysqli_query($conexion, $sql)) {                                //Envia las instruciones pa MYSQL para guarda la informacion 
        if(empty($consola))$consola='';
        if(empty($res))$res='';
        $res="OK";
        $consola=$consola."<a class='ok'>Se han Registros ".mysqli_affected_rows($conexion)."</>";

    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);       //si la instruciones estan mal el programa devulvera un error 
    }
    if(mysqli_affected_rows($conexion)>0){
        $libre_v4->Columnas($database,$tabla);
        $libre_v4->ColunasInPostClear();
    }
    */
    
    
?>