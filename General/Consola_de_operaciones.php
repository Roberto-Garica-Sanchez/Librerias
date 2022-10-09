<?php
    
    #include_once("libre_v5.php");
    #if(empty($libre_v5))$libre_v5= new libre_v5('php7',$conexion,'');
    echo"<div id='consola1' class='consola1'>";
        /*
        $validacion_de_campos=array(
            "Validacion_general"=>true,
            "Validacion_insert"=>true,
            "Validacion_update"=>true,
            "Validacion_delect"=>true,
            "Campos_vacios"         =>$array_base,
            "noDefaul"              =>$array_base,
            "Valores_No_validos"    =>$array_base,
            "Error_especifico"      =>$array_base,
        );
        */
        mysqli_select_db ($conexion ,$database);
        $libre_v4-> Columnas($database,$tabla);             
        $columnas=$libre_v4->getColumnas();
        if(empty($validacion_de_campos)){echo"sistema de validacion con encontrado ";}
        if(empty($TextColumna))$TextColumna='';
        if(!isset($validacion_de_campos['ColumnasRepetidas']))$validacion_de_campos['ColumnasRepetidas']=array();
        if(!isset($validacion_de_campos['ColumnasRelacionadas']))$validacion_de_campos['ColumnasRelacionadas']=array();
        
        #Campos_vacios
            $array=array(
                'title'=>'<a  style="color: #0080cc;">Campos Vacios</a>',
                'columnas'=> $columnas,
                'validacion'=>$validacion_de_campos['Campos_vacios'],
                'Cambio_de_texto'=>$TextColumna
            );
            if($validacion_de_campos['Campos_vacios']['validacion']==false){mensajes($array);}
        #Valores_No_validos
            $array=array(
                'title'=>'<a style="color: red;">Valor No Valido</a>',
                'columnas'=> $columnas,
                'validacion'=>$validacion_de_campos['Valores_No_validos'],
                'Cambio_de_texto'=>$TextColumna
            );
            if($validacion_de_campos['Valores_No_validos']['validacion']==false)mensajes($array);
        #noDefaul    
            $array=array(
                'title'=>'<a style="color: orange;" title="Selecionar un valor de las listaas o verificar los valores que sean correctos">Selecione una valor diferentes</a>',
                'columnas'=> $columnas,
                'validacion'=>$validacion_de_campos['noDefaul'],
                'Cambio_de_texto'=>$TextColumna
            );    
            if($validacion_de_campos['noDefaul']['validacion']==false)mensajes($array);
        #Valores Repetidos    
            $array=array(
                'title'=>'<a style="color: orange;" title="Valores Repetidos">Valore Repetido</a>',
                'columnas'=> $columnas,
                'validacion'=>$validacion_de_campos['ColumnasRepetidas'],
                'Cambio_de_texto'=>$TextColumna
            );    
            if(isset($validacion_de_campos['ColumnasRepetidas']['validacion']) and $validacion_de_campos['ColumnasRepetidas']['validacion']==false)mensajes($array);
       #Valores de tablas relacionadas     
            $array=array(
                'title'=>'<a style="color: red;" title="Columnas Relacionadas">No Existe el Valor En La Base de datos </a>',
                'columnas'=> $columnas,
                'validacion'=>$validacion_de_campos['ColumnasRelacionadas'],
                'Cambio_de_texto'=>$TextColumna
            );    
            if(isset($validacion_de_campos['ColumnasRelacionadas']['validacion']) and $validacion_de_campos['ColumnasRelacionadas']['validacion']==false){
                
                mensajes($array);
            }
        #Error_especificos    
            $array=array(
                'title'=>'<a style="">Error Particulares</a>',
                'columnas'=> $columnas,
                'validacion'=>$validacion_de_campos['Error_especifico'],
                'Cambio_de_texto'=>$TextColumna
            );
            if($validacion_de_campos['Error_especifico']['validacion']==false)mensajes($array);
            if (!empty($consola) and gettype($consola)=='string'){
                #echo $consola;
            }
            if (!empty($consola) and gettype($consola)=='array'){
                for ($i=0; $i <count($consola) ; $i++) { 
                    $consola[$i];
                }
            }
            if(isset($resultado_Operacion)){
                if(isset($resultado_Operacion['Todo Completo']) and $resultado_Operacion['Todo Completo']=='true'){
                    echo "Guardado Completado";
                }
                if(isset($resultado_Operacion['Todo Completo']) and $resultado_Operacion['Todo Completo']=='false'){
                    $tablas=$resultado_Operacion['Tablas en proceso'];
                    
                    if($resultado_Operacion['Operacion']=='Modificar'){
                        echo "Modificasion ";
                        if($resultado_Operacion["Completo"]=='true'){echo"<br> Todas las Tablas Modificadas";}
                       
                        for ($i=0; $i <count($tablas) ; $i++) { 
                            #echo $tablas[$i];
                            #echo $resultado_Operacion[$tablas[$i]];
                            
                            echo('<pre>');
                            print_r($resultado_Operacion[$tablas[$i]]);
                            echo('</pre>'); 
                        }
                    }
                }
                /*
                    echo('<pre>');
                    print_r($resultado_Operacion);
                    echo('</pre>'); 
                */
            }
            
    echo"</div>";
    /*
			echo('<pre>');
			print_r($validacion_de_campos);
			echo('</pre>'); 
    */
    include_once('Inicia_operadores.php');
    #desactiva los botones guardar o modificar a causa de alguna validacion que resulto en negativa  (la causa esta registrada en la variable $validacion_de_campos)
        if($validacion_de_campos['Validacion_general']==false){
            $boton_guarda->propiedades['class']='botones_submenu boton_desactivado ';  
            $boton_Modifica->propiedades['class']='botones_submenu boton_desactivado ';
            $boton_Modifica->propiedades['disabled']=true;
        }
    #desactiva el boton guardar si el sistema detecta que se estan modificando registros ya guardados
        if($validacion_de_campos['Validacion_insert']==false){
            $boton_guarda->propiedades['class']='botones_submenu boton_desactivado ';
            $boton_guarda->propiedades['disabled']=true;
        }
    #desactiva el boton modificar si el sistema detecta que los datos son registro nuevos 
        if($validacion_de_campos['Validacion_update']==false){        
            $boton_Modifica->propiedades['disabled']=true;
            $boton_Modifica->propiedades['class']='botones_submenu boton_desactivado ';
        }
    #Proceso de Eliminacion de registros Detectado, Confirmar
    

    echo"<div id='DivOperadores' class='DivOperadores'>";    
        $boton_guarda->view();
        $boton_Modifica->view();
        $boton_Eliminar->view();
        $boton_Limpiar->view();
        $boton_Cancelar->view();
        $boton_Confirmar->view();
    echo"</div>";

    function mensajes($array){
        /*    
            $array=array(
                'title'=>'Valores No Validos',
                'columnas'=> $columnas,
                'validacion'=>$validacion_de_campos['Valores_No_validos'],
                'Cambio_de_texto'=>$TextColumna
            );
        */
        
        echo"<div style='float: left; width: 100%;border: solid .5px;' class=''>";
            echo"<div style='float: left; width: 100%;' class='botone_n'>";
                echo$array['title'];
            echo"</div>";
            for ($i=0; $i <count($array['columnas']); $i++) { 
                $style="width: 100%;";                
                switch (gettype($array['validacion'][$array['columnas'][$i]])) {
                    case 'boolean':
                        if(empty($array['validacion'][$array['columnas'][$i]]) ){
                            echo"<div style='$style'id='model1' class='botones_submenu Celdas'>";
                                if(!empty($array['Cambio_de_texto'][$array['columnas'][$i]])){
                                    echo $array['Cambio_de_texto'][$array['columnas'][$i]];
                                }else{
                                    echo $array['columnas'][$i].": ".$_POST[$array['columnas'][$i]];
                                }
                            echo"</div>";
                        }
                    break;
                    case 'string':
                        echo"<div style='$style' class='botones_submenu Celdas'>";
                            #columna con el error 
                                if(!empty($array['Cambio_de_texto'][$array['columnas'][$i]])){
                                    echo $array['Cambio_de_texto'][$array['columnas'][$i]];
                                }else{
                                    echo $array['columnas'][$i];
                                }
                                #mensaje de error presente 
                                echo"<a style='font-weight: bold;color: red;'> ". $array['validacion'][$array['columnas'][$i]].": ".$_POST[$array['columnas'][$i]]."</a>";
                        echo"</div>";
                        
                    break;
                }
            }
        echo"</div>";
    
    }
?>