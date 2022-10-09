<?php
    include_once($_SERVER["DOCUMENT_ROOT"]."/Librerias/General/Auto_load.php");
    if(isset($_POST['ProcessMySql'])){
        if($_POST['ProcessMySql']=='Get_list_Database'){
            $ProcesosMysql->lista_DB("");
            if(!isset($_POST['formato']) or(isset($_POST['formato']) and $_POST['formato']=="lista_text")){
                $listasBD=$ProcesosMysql->getlista_DB();
                for ($i=0; $i <count($listasBD); $i++) { 
                    echo $listasBD[$i];
                    echo"<br>";
                }

            }
            if(isset($_POST['formato']) and $_POST['formato']=="lista_desplegable"){
                $listasBD=$ProcesosMysql->getlista_DB(); 
                array_unshift($listasBD, "Selecione Base de Datos ");

                $despieges=array(
                    "name"=>'Seletor_database',
                    "Subtitulo"=>array(),
                    "Elementos"=>$listasBD,
                    "TextComplemento"=>array(),
                    "class"=>' procMaxWid vh_5 design_black ',
                    "style"=>'',
                    "Excesiones"=>array(
                        'information_schema',
                        'mysql',
                        'performance_schema',
                        'phpmyadmin',
                        'test',
                    ),
                    'id'=>'Seletor_database',
                    #"libre"=>''
                    "libre"=>'onclick="DescargaTablas_ajax();"'
                    #"libre"=>'onchage="ControlesMysql_ajax();"'
                );
                echo $libre_v5->despieges($despieges);
            }
        }

        if($_POST['ProcessMySql']=='Get_list_Tablas'){
            $lista_Tablas=Array(
                "Database"=>$_POST['Database_select']
            );
            $ProcesosMysql->lista_Tablas($lista_Tablas);            
            if(!isset($_POST['formato']) or(isset($_POST['formato']) and $_POST['formato']=="lista_text")){
                $listasTB=$ProcesosMysql->getlista_Tablas();
                for ($i=0; $i <count($listasTB); $i++) { 
                    echo $listasTB[$i];
                    echo"<br>";
                }

            }
            if(isset($_POST['formato']) and $_POST['formato']=="lista_desplegable"){
                
                #$listasBD=$ProcesosMysql->getlista_DB(); 
                $listasTablas=$ProcesosMysql->getlista_Tablas();

                array_unshift($listasTablas, "Selecione Tabla");

                $despieges=array(
                    "name"=>'Selector_Tabla',
                    "Subtitulo"=>array(),
                    "Elementos"=>$listasTablas,
                    "TextComplemento"=>array(),
                    "class"=>' procMaxWid vh_5 design_black ',
                    "style"=>'',
                    "Excesiones"=>array(
                        'information_schema',
                        'mysql',
                        'performance_schema',
                        'phpmyadmin',
                        'test',
                    ),
                    'id'=>'Selector_Tabla',
                    #"libre"=>''
                    "libre"=>'onclick="DescargaColumnas_ajax();"'
                    #"libre"=>'onchage="ControlesMysql_ajax();"'
                );
                echo $libre_v5->despieges($despieges);
            }
        }

        if($_POST['ProcessMySql']=='Get_list_Columnas'){#interna
            $lista_Tablas=Array(
                "Database"=>$_POST['Database_select'],
                "Tabla"=>$_POST['Tabla_select'],
            );  
            $ProcesosMysql->lista_Columnas($lista_Tablas); 
            #$ProcesosMysql->viewlista_Columnas(); 
                      
            if(!isset($_POST['formato']) or(isset($_POST['formato']) and $_POST['formato']=="lista_text")){                
                $lista_CM=$ProcesosMysql->getlista_Columnas();
                for ($i=0; $i <count($lista_CM); $i++) { 
                    echo $lista_CM[$i];
                    echo"<br>";
                }

            }
            
            if(isset($_POST['formato']) and $_POST['formato']=="lista_desplegable"){
                
                #$listasBD=$ProcesosMysql->getlista_DB(); 
                $listasColumnas=$ProcesosMysql->getlista_Columnas();
                array_unshift($listasColumnas, "Selecione Columna");

                $despieges=array(
                    "name"=>'Selector_Columnas',
                    "Subtitulo"=>array(),
                    "Elementos"=>$listasColumnas,
                    "TextComplemento"=>array(),
                    "class"=>' procMaxWid vh_5 design_black ',
                    "style"=>'',
                    "Excesiones"=>array(
                        'information_schema',
                        'mysql',
                        'performance_schema',
                        'phpmyadmin',
                        'test',
                    ),
                    'id'=>'Selector_Columnas',
                    #"libre"=>''
                    "libre"=>'onclick=""'
                    #"libre"=>'onchage="ControlesMysql_ajax();"'
                );
                echo $libre_v5->despieges($despieges);
            }
                

        }
        if($_POST['ProcessMySql']=='desplegable_text_busqueda'){#externa
            
            if(isset($_POST['TablaEmisora']))   {$tablaEmisora=$_POST['TablaEmisora'];          }else{echo"Datos Faltantes [Te]";}
            if(isset($_POST['Tabla']))          {$tabla=$_POST['Tabla'];                        }else{echo"Datos Faltantes [T]";}
            if(isset($_POST['Columna']))        {$columna=$_POST['Columna'];                    }else{echo"Datos Faltantes [C]";}
            if(isset($_POST['ColumnaEmisora'])){$columna_emisora=$_POST['ColumnaEmisora'];    }else{echo"Datos Faltantes [Ce]";}
            if(isset($_POST['Database']))       {$database=$_POST['Database'];                  }else{$database="Gestor_oficina";}
            if(isset($_POST['value']))          {$ValorBuscar=$_POST['value'];                  }else{echo"Datos Faltantes [V]";}
            #echo $_POST['value'];
            #echo $_POST['Tabla'];
            #echo $columna_emisora;
                $libre_v2->db($database,$conexion,$phpv);

				$GeneraSql=array(
					"tabla"=>$tablaEmisora,
					"Operacion"=>
					array(  
						'viewSQL'=>'',    
						'SELECT'=>array(
							"Activar"		=>'true',
							"LIKE"			=>'true',
							"LOWER"			=>'true',
                            "%"				=>'true',
							"getColumnas"	=>array('*'),
							"BuscaColumnas"	=>array($columna_emisora),
							"BuscaDatos"	=>array($ValorBuscar),
							#"Condiciones"	=>$Condiciones,
						),
					)
				);
				$Ares_v1->GeneraSql($GeneraSql);
				$sql=$Ares_v1->getSql();
			    #$Ares_v1->viewSql();
				$res=$libre_v2->ejecuta($conexion,$sql,$phpv);
                #echo $libre_v2->mysql_nu_ro		($res,$phpv);
               
                $array_title["Atributos"]['title']=array(
                    "objeto"=>'input',#input,select,textarea
                    "type"=>'button',#input,button,submit,date,datetime ect.
                    "name"=>'',
                    "value"=>'Busqueda Externa',#busca en una tabla relacionada
                    "id"=>'',
                    "class"=>array('Diseno_botones3'),#soportes para formato string o array 
                    "readonly"=>false,#true o false
                    "disabled"=>false,#true o false
                    "title"=>'',
                    "style"=>array(
                        "width"=>"",
                        "box-shadow"=>"",
                        "background"=>''
                    ),
                    "placeholder"=>'',
                    "js"=>array(
                    ),
                    "libre"=>array(						
                    ),
                    "autofocus"=>''
                );
                $array["Atributos"]=array(
                    "objeto"=>'input',#input,select,textarea
                    "type"=>'input',#input,button,submit,date,datetime ect.
                    "name"=>$columna,
                    "value"=>'',
                    "id"=>$columna,
                    "class"=>array('Diseno_botones3'),#soportes para formato string o array 
                    "readonly"=>false,#true o false
                    "disabled"=>false,#true o false
                    "title"=>'',
                    "style"=>array(
                        "width"=>"",
                        "box-shadow"=>"",
                        "background"=>''
                    ),
                    "placeholder"=>'',
                    "js"=>array(
                    ),
                    "libre"=>array(						
                    ),
                    "autofocus"=>''
                );
                $array["array_title"]['style']['width']='max-content';
                $array["Atributos"]['type']='submit';
                $array["Atributos"]['style']['width']='max-content';
                
				$array["Atributos"]['class'][]="Diseno_botones3_option";
                echo $libre_v5->inputArray($array_title["Atributos"]['title']);
				while($datos= $libre_v2->mysql_fe_ar($res,$phpv,'')){
					if(!empty($array['ColumnasAMostrar']) and (count($array['ColumnasAMostrar'])<=0)){
						echo"Requiere Expancionsb";
					}
					$array["Atributos"]['value']=$datos[$columna_emisora];
					echo $libre_v5->inputArray($array["Atributos"]);
				}
            

        }
        if($_POST['ProcessMySql']=='textoBusqueda'){
            ####Busca en base de datos algun dato espesifico enviado via AJAX
            
                if(isset($_POST['Tabla']))      {$tabla=$_POST['Tabla'];        }else{echo"Datos Faltantes [T]";}
                if(isset($_POST['Columna']))    {$columna=$_POST['Columna'];    }else{echo"Datos Faltantes [C]";}
                if(isset($_POST['Database']))   {$database=$_POST['Database'];  }else{$database="Gestor_oficina";}
                if(isset($_POST['value']))      {$ValorBuscar=$_POST['value'];  }else{echo"Datos Faltantes [V]";}
                    $libre_v2->db($database,$conexion,$phpv);
                    $GeneraSql=array(
                        "tabla"=>$tabla,
                        "Operacion"=>
                        array(  
                            'viewSQL'=>'',    
                            'SELECT'=>array(
                                "Activar"		=>'true',
                                "LIKE"			=>'true',
                                "LOWER"			=>'true',
                                "%"				=>'true',
                                "getColumnas"	=>array('*'),
                                "BuscaColumnas"	=>array($_POST['Columna']),
                                "BuscaDatos"	=>array($ValorBuscar),
                                #"Condiciones"	=>$Condiciones,
                            ),
                        )
                    );
                    $Ares_v1->GeneraSql($GeneraSql);
                    $sql=$Ares_v1->getSql();
                    #$Ares_v1->viewSql();
                    $res=$libre_v2->ejecuta($conexion,$sql,$phpv);
                    #echo $libre_v2->mysql_nu_ro		($res,$phpv);
                    $array_title["Atributos"]['title']=array(
                        "objeto"=>'input',#input,select,textarea
                        "type"=>'button',#input,button,submit,date,datetime ect.
                        "name"=>'',
                        "value"=>'Busqueda Interna',#busca en la misma tabla
                        "id"=>'',
                        "class"=>array('Diseno_botones3'),#soportes para formato string o array 
                        "readonly"=>false,#true o false
                        "disabled"=>false,#true o false
                        "title"=>'',
                        "style"=>array(
                            "width"=>"",
                            "box-shadow"=>"",
                            "background"=>''
                        ),
                        "placeholder"=>'',
                        "js"=>array(
                        ),
                        "libre"=>array(						
                        ),
                        "autofocus"=>''
                    );
                    $array["Atributos"]=array(
                        "objeto"=>'input',#input,select,textarea
                        "type"=>'input',#input,button,submit,date,datetime ect.
                        "name"=>$columna,
                        "value"=>'',
                        "id"=>$columna,
                        "class"=>array('Diseno_botones3'),#soportes para formato string o array 
                        "readonly"=>false,#true o false
                        "disabled"=>false,#true o false
                        "title"=>'',
                        "style"=>array(
                            "width"=>"",
                            "box-shadow"=>"",
                            "background"=>''
                        ),
                        "placeholder"=>'',
                        "js"=>array(
                        ),
                        "libre"=>array(						
                        ),
                        "autofocus"=>''
                    );
                    echo $libre_v5->inputArray($array_title["Atributos"]['title']);
                
                    $array["Atributos"]['class'][]="Diseno_botones3_option";
                    while($datos= $libre_v2->mysql_fe_ar($res,$phpv,'')){
                        if(!empty($array['ColumnasAMostrar']) and (count($array['ColumnasAMostrar'])<=0)){
                            echo"Requiere Expancionsb";
                        }
                        $array["Atributos"]['value']=$datos[$columna];
                        $array["Atributos"]['type']='submit';
                        echo $libre_v5->inputArray($array["Atributos"]);
                    }
        }
    }
?>