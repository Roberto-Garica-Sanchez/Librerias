<?php
/* 
	SELECT ID_G FROM empresa.folio  
	JOIN empresa.viaticos_c ON folio.ID_G=viaticos_c.ID_G 
	JOIN empresa.casetas ON folio.ID_G=casetas.ID_G 
	JOIN empresa.casetas ON folio.ID_G=casetas.ID_G 
	JOIN empresa.casetas ON folio.ID_G=casetas.ID_G 
	JOIN empresa.casetas ON folio.ID_G=casetas.ID_G 
	JOIN empresa.casetas ON folio.ID_G=casetas.ID_G 
	JOIN empresa.casetas ON folio.ID_G=casetas.ID_G 

	WHERE folio.ID_G='6136'
*/
/*
	busca repetidos 
		SELECT COUNT(*)total ,* FROM `viaticos_c` GROUP by ID_G HAVING ID_G>1
		SELECT * FROM `viaticos_c` GROUP by ID_G HAVING count(ID_G)>1

	##busca elementos repetidos y los elimina 
		DELETE FROM viaticos_c  
		WHERE ID_G IN (SELECT * 
					FROM (SELECT ID_G FROM `viaticos_c` GROUP by ID_G HAVING count(ID_G)>1) AS A
					);
 */
	/*
		invitado=rFWRPsmmy9jjRNuY
		Acceso_sistema=Mv4d536et4Ex6ro3

		ob_start();  
		$interface = ob_get_contents();
        ob_end_clean(); 	
	*/
	
//$phpv='php5';
//if(empty($libre_v2))$libre_v2= new libre_v2($phpv,$conexion);  
class Ares_v1{
	public $sql;
	function genera_sql($id,$tipo,$tb,$db,$conexion,$phpv,$system,$datos,$datos_Systm){
		if($tipo==''){echo"<br>[genera_sql] Tipo sin definir";$close=true;}
		if($id==''){echo"<br>[genera_sql] ID sin definir";$close=true;}
		if($tb==''){echo"<br>[genera_sql] TB sin definir";$close=true;}
		if($db==''){echo"<br>[genera_sql] DB sin definir";$close=true;}
		if($phpv==''){echo"<br>[genera_sql] PHPV sin definir";$close=true;}
		if($datos_Systm['datos_mysql']==''){echo"<br>[genera_sql] datos_mysql Sin Datos";$close=true;}
		if($close==true){exit;}
		
		
		$datos_local	= tablas_v2::info	($db,$tb);				//descarga los datos de le programa
		$datos_mysql	= $datos_Systm['datos_mysql'];
		if($datos_Systm=='')$datos_mysql	= descarga_db		($db,$conexion,$phpv);	//descarga los datos de mysql 
		
		$array_name		= $datos_mysql['columnas'][$tb];
		$array_exencion	= $datos_local['none'];			
		$array_insert	= $datos_local['insert'];			
		$array_update	= $datos_local['update'];			
		$tipo_traducion	= $datos_local['tradu'];
		$array_traductor= $datos_local['name'];
		if($system[diagnostico]<>''){
			if($tipo_traducion==manual){
				echo"<div style='color: black;width: 600px;position: absolute;left: 200px;background: white;'>";
					echo"<table border='1'>";
					echo"<tr>";
					echo"<td>db:			</td>";
					echo"<td>Tabla:			</td>";
					echo"<td>Name: 			</td>";
					echo"<td>execiones:		</td>";
					echo"<td>insert:		</td>";
					echo"<td>update: 		</td>";
					echo"<td>traductor:		</td>";
					echo"<td>traduccion:	</td>";
					echo"<td>tipo			</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td>".$db."</td>";
					echo"<td>".$tb."</td>";
					echo"<td>".count($array_name)."</td>";
					echo"<td>".count($array_exencion)."</td>";
					echo"<td>".count($array_exencion)."</td>";
					echo"<td>".count($array_insert)."</td>";
					echo"<td>".count($array_update)."</td>";
					echo"<td> ".count($array_traductor)."</td>";
					echo"<td> ".$tipo_traducion."</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td>Datos de traducion</td>";
					echo"<td>".$datos_local[datos]."</td>";
					echo"</tr>";
					echo"</table>";
					echo"<table border='1'>";
						echo"<tr>";
						echo"<td>";echo"Name sql";				echo"</td>";
						echo"<td>";echo"Omitir none";				echo"</td>";
						echo"<td>";echo"Omitir insert";			echo"</td>";
						echo"<td>";echo"Omitir update";			echo"</td>";
						echo"<td>";echo"Name traductor";		echo"</td>";
						echo"</tr>";
						for($x=0; $x<count($array_name);$x++){
							echo"<tr>";
							echo"<td>";echo$array_name[$x];			echo"</td>";
							echo"<td>";if($array_exencion[$x]=="")	echo"Null";else echo$array_exencion[$x];		echo"</td>";
							echo"<td>";if($array_insert[$x]=="")	echo"Null";else echo$array_insert[$x];			echo"</td>";
							echo"<td>";if($array_update[$x]=="")	echo"Null";else echo$array_update[$x];			echo"</td>";
							echo"<td>"; echo$array_traductor[$array_name[$x]];	echo"</td>";
							echo"</tr>";
						}
					echo"</table>";
				echo"</div>";
			}
			if($tipo_traducion==auto){
				echo"<div style='color: black;width: 600px;position: absolute;left: 200px;background: white;'>";
					echo"<table border='1'>";
					echo"<tr>";
					echo"<td>db:			</td>";
					echo"<td>Tabla:			</td>";
					echo"<td>Name: 			</td>";
					echo"<td>execiones:		</td>";
					echo"<td>insert:		</td>";
					echo"<td>update: 		</td>";
					echo"<td>traductor:		</td>";
					echo"<td>traduccion:	</td>";
					echo"<td>tipo			</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td>".$db."</td>";
					echo"<td>".$tb."</td>";
					echo"<td>".count($array_name)."</td>";
					echo"<td>".count($array_exencion)."</td>";
					echo"<td>".count($array_exencion)."</td>";
					echo"<td>".count($array_insert)."</td>";
					echo"<td>".count($array_update)."</td>";
					echo"<td> ".count($array_traductor)."</td>";
					echo"<td> ".$tipo_traducion."</td>";
					echo"</tr>";
					echo"<tr>";
					echo"<td>Datos de traducion</td>";
					echo"<td>".$datos_local[datos]."</td>";
					echo"</tr>";
					echo"</table>";
					echo"<table border='1'>";
						echo"<tr>";
						echo"<td>";echo"Name sql";				echo"</td>";
						echo"<td>";echo"Omitir none";				echo"</td>";
						echo"<td>";echo"Omitir insert";			echo"</td>";
						echo"<td>";echo"Omitir update";			echo"</td>";
						echo"<td>";echo"Name traductor";		echo"</td>";
						echo"</tr>";
						for($x=0; $x<count($array_name);$x++){
							echo"<tr>";
							echo"<td>";echo$array_name[$x];			echo"</td>";
							echo"<td>";if($array_exencion[$x]=="")	echo"Null";else echo$array_exencion[$x];		echo"</td>";
							echo"<td>";if($array_insert[$x]=="")	echo"Null";else echo$array_insert[$x];			echo"</td>";
							echo"<td>";if($array_update[$x]=="")	echo"Null";else echo$array_update[$x];			echo"</td>";
							echo"<td>";echo$array_traductor[$x];	echo"</td>";
							echo"</tr>";
						}
					echo"</table>";
				echo"</div>";
			}
		}
			
		if($array_name=="")			{echo"<br>[Ares_v1::genera_sql][$db][$tb]  sin ARRAY NAME ";$close=true;}
		if($array_traductor=="")	{echo"<br>[Ares_v1::genera_sql][$db][$tb]  sin ARRAY TRADUCTOR";$close=true;}
		
		if(count($array_name)<>count($array_exencion)){//verifica que el array_name se igual de largo que el array_ value
			echo"<br>[Ares_v1::genera_sql][$db][$tb] Diferencia entre los array de exencion(".count($array_exencion).") y name[mysql]".count($array_name);
			$close=true;
		}
		if(count($array_name)<>count($array_insert)){//verifica que el array_name se igual de largo que el array_ value
			echo"<br>[Ares_v1::genera_sql][$db][$tb] Diferencia entre los array de insert(".count($array_insert).") y name[mysql] ".count($array_name);
			$close=true;
		}
		if(count($array_name)<>count($array_update)){//verifica que el array_name se igual de largo que el array_ value
			echo"<br>[Ares_v1::genera_sql][$db][$tb] Diferencia entre los array de update(".count($array_update).") y name[mysql] ".count($array_name);
			$close=true;
		}
		if(count($array_name)<>count($array_traductor)){//verifica que el array_name se igual de largo que el array_ value
			echo"<br>[Ares_v1::genera_sql][$db][$tb] Diferencia entre los array de exencion(".count($array_exencion).") y name[mysql] ".count($array_name);
			$close=true;
		}
		
		if($close==true){exit;}
		
		if(($tipo==INSERT)or($tipo==insert)){
			if($tipo_traducion==manual){//PENDIENTE PARA TEST
				$sql="INSERT INTO ".$tb." (";
				for($x=0; $x<count($array_name); $x++){
					if($array_exencion[$array_name[$x]]==""){//condicion para omitir una coluna  en el sql 
						if($x<>0)$sql=$sql.","; 
						$sql=$sql.$array_name[$x];
					}
				}				
				$sql=$sql.") VALUE (";
				$acti=false;
				for($x=0; $x<count($array_name); $x++){
					if($array_insert[$x]==""){//condicion para omitir una coluna en el sql 
						if($acti==true)$sql=$sql.","; 
						if($array_name[$x]==$id){
							$elemento=$array_traductor[$array_name[$x]];
							$sql=$sql."'$_POST[$elemento]'";
						}else{//si es el elemento id
							$sql=$sql."''";
						}
						$acti=true;
					}
				}
				$sql=$sql.")";
			}
			if($tipo_traducion==auto){
				$sql="INSERT INTO ".$tb." (";
				$acti=false;
				for($x=0; $x<count($array_name); $x++){
					
					if($array_insert[$x]==""){//condicion para omitir una coluna  en el sql 
						if($acti==true)$sql=$sql.","; 
						$sql=$sql.$array_name[$x];
						$acti=true;
					}
				}
				
				$sql=$sql.") VALUE (";
				
				$acti=false;
				for($x=0; $x<count($array_name); $x++){
					if($array_insert[$x]==""){//condicion para omitir una coluna en el sql 
						if($acti==true)$sql=$sql.","; 
						if($array_name[$x]==$id){
							$elemento=$array_traductor[$x];
							$sql=$sql."'$_POST[$elemento]'";
						}else{//si es el elemento id
							$sql=$sql."''";
						}
						$acti=true;
					}
				}
				$sql=$sql.")";
				
			}
			
		}
		if(($tipo==UPDATE)or($tipo==update)){
			if($tipo_traducion==manual){
				$sql="UPDATE $tb SET ";
				$acti=false;
				for($x=0; $x<count($array_name); $x++){
					if($array_update[$x]==""){
						if($array_update[$x]==""){
							if($acti==true)$sql=$sql.",";
							$sql=$sql.$array_name[$x]."='".$_POST[$array_traductor[$array_name[$x]]]."'";
							$acti=true;
						}
						if($id==$array_name[$x])$id_value=$_POST[$array_traductor[$array_name[$x]]];					
					}
				}
				$sql=$sql." WHERE $id='".$id_value."'";
				
			}
			if($tipo_traducion==auto){
				$sql="UPDATE $tb SET ";
				$acti=false;
				for($x=0; $x<count($array_name); $x++){
					if($array_update[$x]==""){
						if($acti==true)$sql=$sql.",";
						$sql=$sql.$array_name[$x]."='".$_POST[$array_traductor[$x]]."'";
						$acti=true;
					}
					if($id==$array_name[$x])$id_value=$_POST[$array_traductor[$x]];
				}	
			
				$sql=$sql." WHERE $id='".$id_value."'";
			}
		}
		if(($tipo==SELECT)or($tipo==select)){
			$sql="SELECT * FROM ".$tb;
			if(($datos[col_espe]<>'')and($dato[espe]<>'')){
				$sql="";$consulta="SELECT * FROM $tabla WHERE ".$datos[col_espe]."='".$dato[espe]."'";
			}
			
		}
	
	
		$res			= array(
		"version"	=> "genera_sql",
		"info"		=> $info,
		"sql"		=> $sql,
		"consola"	=> $consola
		);
		return $res;
	}
	function viewSql(){
		echo "<br>".$this->sql;
	}
	public function getSql(){
		return $this->sql;
	}
	public 	function GeneraSql($array){
		/*
			$tabla="repostajes";
			$ColumnasInsert     = array('Fecha','Placas','Cliente','Operador','Contador_Inicio','Contador_Final','Total_Despachado') ;
			$ValoresInsert      = array($_POST['Fecha'],$_POST['Placas'],$_POST['Cliente'],$_POST['Operador'],$_POST['Contador_Inicio'],$_POST['Contador_Final'],$_POST['Total_Despachado']);
			$getColumnas        = array('*') ;
			$BuscaColumnas      = array('ID_G') ;
			$BuscaDatos         = array(5);
        	$Condiciones        = array();
			$ModifiColumnas     = array('Fecha','Placas','Cliente','Operador','Contador_Inicio','Contador_Final','Total_Despachado') ;
			$ModifiDatos        = array($_POST['Fecha'],$_POST['Placas'],$_POST['Cliente'],$_POST['Operador'],$_POST['Contador_Inicio'],$_POST['Contador_Final'],$_POST['Total_Despachado']);
		*/
		/*	
			$array=array(
				"tabla"=>$tabla,
				"Operacion"=>
				array(  
						'INSERT'=>array(
						"Activar"    =>'true',//'false'
						"ValoresByKey"		=>$ValoresByKey,
						"ColumnasInsert"    =>$ColumnasInsert,//array(),
						"ValoresInsert"     =>$ValoresInsert, //array(),
						"Excepcion"			=>$Excepcion
					),      'SELECT'=>array(
						"Activar"	=>'true',
						"LIKE"		=>'falses',
						"getColumnas"	=>$getColumnas,
						"BuscaColumnas"	=>$BuscaColumnas,
						"BuscaDatos"	=>$BuscaDatos,
						"Condiciones"	=>$Condiciones,
						"LIMIT"			=>array(
							"Elementos"=>'',
							"posicion"=>''
						),
						"ByOrder"		=>array(
							"Columna"	=>'Columna',
							"ASC-DESC"	=>'DESC'
						),
						"JOIN"=>array(
							'Inner Join'=>Array(
								'ColumnaUnion'=>'',	
								'vinculos'=>array(
									'tabla'=>array(),
									'columna'=>array(),
									
								)
							),
							'Left outer Join'=>Array(),
							'Right outer Join'=>Array(),
							'Full outer join'=>Array(),

						)

					),      'UPDATE'=>array(
						"Activar"	=>'true',//'false'
						"LIKE"		=>'true',//'false'
						"ModifiColumnas"    =>$getColumnas,//array()
						"ModifiDatos"    	=>$ModifiDatos,//array()
						"BuscaColumnas"  	=>$BuscaColumnas,//array()
						"BuscaDatos"     	=>$BuscaDatos,//array()
						"Condiciones"  		=>$Condiciones,
						"Excepcion"			=>$Excepcion
					),      'DELETE'=>array(
						"Activar"	=>'true',//'false'
						"LIKE"		=>'true',//'false'
						"BuscaColumnas"  	=>$BuscaColumnas,//array()
						"BuscaDatos"     	=>$BuscaDatos,//array()
						"Condiciones"   =>$Condiciones
					)
				)
			);
		*/	
		if(!empty($array['Operacion']['INSERT']['Activar']) and $array['Operacion']['INSERT']['Activar']=='true'){
			$datos=$array['Operacion']['INSERT'];
			if(empty($datos['ValoresByKey']))$datos['ValoresByKey']='false';
			if($datos['ValoresByKey']=='false')
			if(count($datos['ColumnasInsert'])!=count($datos['ValoresInsert'])){
				echo"Error tamaño de columnas-datos diferente".count($datos['ColumnasInsert'])." to ".count($datos['ValoresInsert']); exit;
			}
			if(gettype($datos['ColumnasInsert'])=='array'){			
				$DatosDeCiclo="";				
				for ($x=0; $x<count($datos['ColumnasInsert']); $x++) { 
					$Excepcion=false;
					#verificasion de excesiones 
					if(!empty($datos['Excepcion']) and gettype($datos['Excepcion'])=='array')
					for ($z=0; $z < count($datos['Excepcion']); $z++) { 
						if($datos['Excepcion'][$z]==$datos['ColumnasInsert'][$x]){$Excepcion=true;break;}
					}
					#procesado de datos despues de las exceiones 
					if($Excepcion==false){
						$DatosDeCiclo=$DatosDeCiclo.$datos['ColumnasInsert'][$x];
						if(($x+1)<count($datos['ColumnasInsert']))$DatosDeCiclo=$DatosDeCiclo.",";			
					}
				}
				$ColumnasInsert=$DatosDeCiclo;
			}
			
			if(empty($datos['ValoresByKey']))$datos['ValoresByKey']='false';
			if(!empty($datos['ValoresByKey']))
			switch ($datos['ValoresByKey']) {
				case 'true':
					if(gettype($datos['ValoresInsert'])=='array'){#verifica si los datos viene en un array
						$DatosDeCiclo="";
						for ($x=0; $x<count($datos['ColumnasInsert']); $x++) { 
							$Excepcion=false;
							#verificasion de excesiones 
							if(!empty($datos['Excepcion']) and gettype($datos['Excepcion'])=='array')
							for ($z=0; $z < count($datos['Excepcion']); $z++) { 
								if($datos['Excepcion'][$z]==$datos['ColumnasInsert'][$x]){$Excepcion=true;break;}
							}
							#procesado de datos despues de las excesiones 
							if($Excepcion==false){
								$Columna=$datos['ColumnasInsert'][$x];
								if(!empty($datos['ValoresInsert'][$Columna])){#si el valor para la columna existe 
									$DatosDeCiclo=$DatosDeCiclo."'".$datos['ValoresInsert'][$Columna]."'";
								}else{
									$DatosDeCiclo=$DatosDeCiclo."''";
								}
								if(($x+1)<count($datos['ColumnasInsert']))$DatosDeCiclo=$DatosDeCiclo.",";	
							}
						}
						$ValoresInsert=$DatosDeCiclo;

					}
					
				break;
				case 'false':
					if(gettype($datos['ValoresInsert'])=='array'){#verifica si los datos viene en un array				
						$DatosDeCiclo="";
						for ($x=0; $x<count($datos['ValoresInsert']); $x++) {#Ciclo para extraer los datos ingresados 			
							$Excepcion=false;
							# verificasion si existe una exceion
							if(!empty($datos['Excepcion']) and gettype($datos['Excepcion'])=='array')
							for ($z=0; $z < count($datos['Excepcion']); $z++) { #ciclo para extraer las exceiones
								if($datos['Excepcion'][$z]==$datos['ColumnasInsert'][$x]){$Excepcion=true;break;}	#compara el datos actual con las execiones 
							}
							#prosesado de datos depues de la excesiones 
							if($Excepcion==false){
								$DatosDeCiclo=$DatosDeCiclo."'".$datos['ValoresInsert'][$x]."'";
								if(($x+1)<count($datos['ValoresInsert']))$DatosDeCiclo=$DatosDeCiclo.",";
							}
						}
						$ValoresInsert=$DatosDeCiclo;
					}
					
				break;
				
			}
			$sql="INSERT INTO ".$array['tabla']." (".$ColumnasInsert.") VALUES (".$ValoresInsert.")";
			$this->sql=$sql;
		}		
		if(!empty($array['Operacion']['SELECT']['Activar']) and $array['Operacion']['SELECT']['Activar']=='true'){
			$datos=$array['Operacion']['SELECT'];
			$Condiciones='';
			#Genera las Columnas que se descargan 
				if(gettype($datos['getColumnas'])=='string')$getColumnas=$datos['getColumnas'];
				if(gettype($datos['getColumnas'])=='array'){
					$DatosDeCiclo="";
					for ($x=0; $x<count($datos['getColumnas']); $x++) { 					
						$DatosDeCiclo=$DatosDeCiclo." ".$datos['getColumnas'][$x];
						if(($x+1)<count($datos['getColumnas']))$DatosDeCiclo=$DatosDeCiclo.",";			
					}
					$getColumnas=$DatosDeCiclo;
				}
			#Genera las Condiciones de busqueda 
				if(!empty($datos['BuscaColumnas']) and gettype($datos['BuscaColumnas'])=='array'){
						if(gettype($datos['BuscaColumnas'])=='array'){
							$DatosDeCiclo="";	
							# busqueda mediante LIKE
								if(count($datos['BuscaColumnas'])!=count($datos['BuscaDatos'])){
									echo"Error tamaño de columnas-datos diferente";
								}
								for ($x=0; $x<count($datos['BuscaColumnas']); $x++) {
										
									$DatosDeCiclo=$DatosDeCiclo." ".$datos['BuscaColumnas'][$x];
									if(!empty($datos['Condiciones'][$x])){
										$DatosDeCiclo=$DatosDeCiclo." ".$datos['Condiciones'][$x]." ";
									}else{
										if($datos['LIKE']=='true')$DatosDeCiclo=$DatosDeCiclo." LIKE "; else $DatosDeCiclo=$DatosDeCiclo." = ";
									}							
									$DatosDeCiclo=$DatosDeCiclo." '".$datos['BuscaDatos'][$x]."'";
									#compueba si existe otra parametro de busqueda y agrega el conector AND OR 
										if(($x+1)<count($datos['BuscaColumnas'])){
											if($datos['LIKE']=='true')$DatosDeCiclo=$DatosDeCiclo." or "; else $DatosDeCiclo=$DatosDeCiclo." and ";
										}
								}
								$Condiciones=$DatosDeCiclo;
						}						
						if(count($datos['BuscaColumnas'])>0)$Condiciones=" WHERE ".$Condiciones;
				}	
			#Genera las Condiciones de ordenado de datos 		
				if(!empty($datos['ByOrder']) and !empty($datos['ByOrder']['Columna'])){
					$Condiciones=$Condiciones." Order By ".$datos['ByOrder']['Columna'].' '.$datos['ByOrder']['ASC-DESC'];
				}
			#LIMIT Genera Control de datos 
				if(!empty($datos['LIMIT']) and !empty($datos['LIMIT']['Elementos'])){
					$Condiciones=$Condiciones." LIMIT ".$datos['LIMIT']['Elementos'];
					if(!empty($datos['LIMIT']['posicion'])){
						$Condiciones=$Condiciones." OFFSET  ".$datos['LIMIT']['posicion'];
					}
				}
			#JOIN Codigo para tablas combinadas
				$vinculo_tablas='';
				if(!empty($datos['JOIN'])){
					
					if(!empty($datos['JOIN']['Inner Join'])){
						$columnaUnion	=$datos['JOIN']['Inner Join']['ColumnaUnion'];
						$vinculo		=$datos['JOIN']['Inner Join']['vinculos'];
						for ($i=0; $i <count($vinculo['tabla']); $i++) { 
							$vinculo_tablas.=" INNER JOIN ";
							$vinculo_tablas.=$vinculo['tabla'][$i];
							$vinculo_tablas.=" ON ";
							$vinculo_tablas.=$vinculo['tabla'][$i].'.'.$vinculo['columna'][$i];
							$vinculo_tablas.=" = ";
							$vinculo_tablas.=$array['tabla'].'.'.$columnaUnion;
							#INNER JOIN 
							#repostajes_tanques ON
							#repostajes_tanques.IDTanque =repostajes_unidades.TanqueSurtidor
						}
					}
					#if(!empty($datos['JOIN']['Left outer Join']))
					#if(!empty($datos['JOIN']['Right outer Join']))
					#if(!empty($datos['JOIN']['Full outer join']))
				}
			$sql="SELECT ".$getColumnas." FROM ".$array['tabla']." ".$vinculo_tablas." ".$Condiciones;
			$this->sql=$sql;
		}
		if(!empty($array['Operacion']['UPDATE']['Activar']) and $array['Operacion']['UPDATE']['Activar']=='true'){
			$datos=$array['Operacion']['UPDATE'];
			if(gettype($datos['ModifiColumnas'])=='array'){
				$DatosDeCiclo="";	
				if(count($datos['ModifiColumnas'])!=count($datos['ModifiDatos'])){
					echo"Error tamaño de columnas-datos diferente";
				}
				for ($x=0; $x<count($datos['ModifiColumnas']); $x++) {
					$Excepcion=false;
					if(!empty($datos['Excepcion']) and gettype($datos['Excepcion'])=='array')
					for ($z=0; $z < count($datos['Excepcion']); $z++) { 
						if($datos['Excepcion'][$z]==$datos['ModifiColumnas'][$x]){$Excepcion=true;break;}
					}
					if($Excepcion==false){
						$DatosDeCiclo=$DatosDeCiclo." ".$datos['ModifiColumnas'][$x];
						$DatosDeCiclo=$DatosDeCiclo." = ";
						$DatosDeCiclo=$DatosDeCiclo." '".$datos['ModifiDatos'][$x]."'";
						if(($x+1)<count($datos['ModifiColumnas']))$DatosDeCiclo=$DatosDeCiclo.",";
					}
				}

				$DatosChance=$DatosDeCiclo;
			}	
			if(gettype($datos['BuscaColumnas'])=='array'){
				$DatosDeCiclo="";	
				if(count($datos['BuscaColumnas'])==0){echo"Datos Invalidos ['UPDATE'][WHERE]";exit;}
				if(count($datos['BuscaColumnas'])!=count($datos['BuscaDatos'])){
					echo"Error tamaño de columnas-datos diferente";
				}
				for ($x=0; $x<count($datos['BuscaColumnas']); $x++) {
					$DatosDeCiclo=$DatosDeCiclo." ".$datos['BuscaColumnas'][$x];
					if($datos['LIKE']=='true')$DatosDeCiclo=$DatosDeCiclo." LIKE "; else $DatosDeCiclo=$DatosDeCiclo." = ";
					$DatosDeCiclo=$DatosDeCiclo." '".$datos['BuscaDatos'][$x]."'";
					if(($x+1)<count($datos['BuscaColumnas'])){
						if($datos['LIKE']=='true')$DatosDeCiclo=$DatosDeCiclo." or "; else $DatosDeCiclo=$DatosDeCiclo." and ";
					}
				}
				$Condiciones=$DatosDeCiclo;
			}	
			if(!empty($Condiciones))$Condiciones=" WHERE ".$Condiciones;else $Condiciones='';
			$sql="UPDATE ".$array['tabla']." SET ".$DatosChance." ".$Condiciones;
			$this->sql=$sql;
		}
		if(!empty($array['Operacion']['DELETE']['Activar']) and $array['Operacion']['DELETE']['Activar']=='true'){			
			$Condiciones='';
			$datos=$array['Operacion']['DELETE'];
			if(gettype($datos['BuscaColumnas'])=='array'){
				$DatosDeCiclo="";	
				if(count($datos['BuscaColumnas'])==0){echo"Datos Invalidos ['UPDATE'][WHERE]";exit;}
				if(count($datos['BuscaColumnas'])!=count($datos['BuscaDatos'])){
					echo"Error tamaño de columnas-datos diferente";
				}
				for ($x=0; $x<count($datos['BuscaColumnas']); $x++) {
					$DatosDeCiclo=$DatosDeCiclo." ".$datos['BuscaColumnas'][$x];
					if($datos['LIKE']=='true')$DatosDeCiclo=$DatosDeCiclo." LIKE "; else $DatosDeCiclo=$DatosDeCiclo." = ";
					$DatosDeCiclo=$DatosDeCiclo." '".$datos['BuscaDatos'][$x]."'";
					if(($x+1)<count($datos['BuscaColumnas'])){
						if($datos['LIKE']=='true')$DatosDeCiclo=$DatosDeCiclo." or "; else $DatosDeCiclo=$DatosDeCiclo." and ";
					}
				}
				$Condiciones=$DatosDeCiclo;
			}	
			$Condiciones=" WHERE ".$Condiciones;
			$sql="DELETE FROM ".$array['tabla']." ".$Condiciones;
			$this->sql=$sql;
		}
		/*Base Diseño*/
		//$sql= "INSERT INTO repostajes (Fecha,Placas) VALUES ('".$_POST['Fecha']."','".$_POST['Placas']."')";
		//$sql= "SELECT * FROM $tabla WHERE $col_espe='$espe'";
		//$sql= "SELECT * FROM $tabla WHERE $col_espe LIKE  '$espe'";
		//$sql= "DELETE FROM $tabla  WHERE $col_espe='$espe'";
		//$sql= "UPDATE repostajes SET Fecha='".$_POST['Fecha']."', Placas='".$_POST['Placas']."' WHERE ID_G='".$_POST['ID']."'";
	}
	public function ControlSql(){
		####
		echo"<div>";

		echo"</div>";
		
	}
}
class libre_v2	{		
	private $libre_v1;
	private $phpv;
	private $conexion;
	
	public function __construct($phpv,$conexion){	
		$this->libre_v1	=new libre_v1();	
		$this->phpv=$phpv;	
		$this->conexion=$conexion;	
	}		
	function div				($style,$libre,$conte)													{
		if (($style=='')&&($libre=='')){$style="width: 100px; height: 100px; background: yellowgreen;";}
		$res="<div style='$style' $libre>$conte</div>";
		return $res;
	}
	function select				($sel_name,$sel_style,$sel_libre,$sel_conta,$sel_value,$sel_visual,$sel_title,$sel_libre2)	{
		$res="<select name='$sel_name' class='Medio' style='$sel_style' $sel_libre>";
			for($x=0; $x<=$sel_conta; $x++){
				if(!empty($_POST['$sel_name']) and  $_POST[$sel_name]==$sel_value[$x])$sel_libre2[$x]=" selected";
				$res=$res."<option value='$sel_value[$x]'  title='$sel_title[$x]' $sel_libre2[$x]>$sel_visual[$x]</option>";
			}
		$res=$res."</select>";
		return $res;
	}
	function focuas_a			($limite,$to)															{
		$if='if (this.value.length == this.getAttribute("maxlength")) '. $to.'.focus()';
		$libre="maxlength='$limite' onkeyup='$if'";
		return $libre;
	}
	function db					($base,$conexion,$phpv)													{
		//echo$phpv;
		//$base  	°base de datos que se decea conectar
		//$conexion °que entrega la funcion "login"
		//$php 		°Vesion de php que Ejecuta El Servidor 
		if ($base=="") 		{echo"[db]Base de Datos no Definida"; 	}		
		if ($conexion=="") 	{echo"[db] Conexion no existente";		}		
		if ($phpv=="")  	{echo"[db]Version de php no Definidad";	}
		if ($phpv=='php5')	{$res=mysql_select_db($base,$conexion) or die ("[db]Error php5". mysql_error());}
		if ($phpv=='php7')	{$res=mysqli_select_db($conexion,$base)	or die ("[db]Error php7". mysqli_error($conexion));}
		return $res;
	}
	function login				($host,$user,$pass,$db,$phpv)											{
		//$user		°usuario con que Se Realica login en la bd
		//$host		°Como "localhost" o "192.168.1.x"
		//$conexion °que entrega la funcion "login"
		//$php 		°Vesion de php que Ejecuta El Servidor 	
		if (empty($phpv))  	{echo"[lg]version de php no Definidad";}
		if ($phpv=='php5')	{$conexion=mysql_connect($host,$user,$pass)  or die("[Ln]". mysql_error());}
		if ($phpv=='php7')	{$conexion=mysqli_connect($host,$user,$pass,$db) or die("[Ln]". mysqli_error());}
		return $conexion;
	}
	function ejecuta			($conexion,$res,$phpv)													{
		if ($res=="")		{echo"[ejecuta]Sin Res para Ejecutar ";	exit;}
		if ($conexion=="") 	{echo"[ejecuta]Sin Conexion ".$res;		exit;}
		if ($phpv=="")		{echo"[ejecuta]Sin Version ".$res;		exit;}
		if ($phpv=='php5') 	{$resu=mysql_query($res,$conexion) or die("\r<br>Error De Query php=$phpv\r<br>$res<br>".mysql_error($conexion));}
		if ($phpv=='php7') 	{$resu=mysqli_query($conexion,$res)or die("\r<br>Error De Query php=$phpv\r<br>$res<br>".mysqli_error($conexion));}
		return $resu;
	}
	function mysql_da_se		($res,$posicion,$phpv)													{
		if ($posicion=="")	{$posicion=0;}
		if ($res=="")		{echo"[da_se]Sin 'Res' para mysql_da_se";exit;} 
		if ($phpv=="")  	{echo"[da_se]version de php no Definidad";}
		if ($phpv=='php5')	{mysql_data_seek($res,$posicion);}
		if ($phpv=='php7')	{mysqli_data_seek($res,$posicion);}	
	}
	function mysql_nu_ro		($res,$phpv)															{
		if ($res=="")		{echo"[nu_ro]Sin 'Res' para nu_ro";exit;}
		if ($phpv=="")  	{echo"[nu_ro]version de php no Definidad";}
		if ($phpv=='php5') 	{$res=mysql_num_rows($res);}
		if ($phpv=='php7')	{$res=mysqli_num_rows($res);}
		return $res;
	}																				
	function mysql_fe_ar		($consu,$phpv,$id)															{
		if ($consu=="")		{echo"[fe_ar]Sin 'Res' para mysql_fe_ar";exit;}
		if ($phpv=="")  	{echo"[fe_ar]version de php no Definidad id='$id'";}
		if ($phpv=='php5') 	{$res=mysql_fetch_array($consu);}
		if ($phpv=='php7')	{$res=mysqli_fetch_array($consu);}
		return $res;
	}
	function mysql_cl			($conexion,$phpv)																			{	
		if ($conexion=="") 	{echo"[cl] Conecion no existente";}
		if ($phpv=="")  	{echo"[cl]version de php no Definidad";}
		if ($phpv==php5)	{mysql_close($conexion);}
		if ($phpv==php7)	{mysqli_close($conexion);}
	}
	function input2				($type2,$name,$title,$value,$style,$id,$libre,$class)										{
		if ($class=='')		$class='Medio';
		if(!empty($id)){$id="id='$id'";}
        #asigna el valor directamente desde el post
        if(empty($value) and !empty($name)and!empty($_POST[$name])){$value=$_POST[$name];}
		$d="<input type='$type2' 			style='$style' $id class='$class' name='$name' value='$value' 	title='$title' ".$libre."0 >";
		if($type2=='label')$d="<label 		style='$style' $id class='$class' name='$name' 				title='$title' $libre >$value</label>";
		if($type2=='tarea')$d="<textarea 	style='$style' $id class='$class' name='$name'					title='$title' $libre >$value</textarea>";
		return $d;
	}	
	function input3				($array,$index,$operador,$type,$style,$class,$title,$holder,$libre,$disabled){
		
		if($operador=="inter"){
			$value	=$array['inter'][$index];
			if(empty($class))		$class='Medio';
			if(!empty($id)){$cid="id='$index'";}
			$d="<input 
			type		='$type'	
			style		='$style' 
			
			class		='$class' 
			
			value		='$value' 	
			title		='$title' 
			placeholder	='$holder'
			$libre  disabled>";	
		}
		if($operador=="input"){
			$name	=$array['name'][$index];
			if(!empty($_POST[$name]))$value	=$_POST[$name]; else $value='';
			$id		=$array['name'][$index];
			$holder	=$array['inter'][$index];
			$max	=$array['size'][$index];
			if ($class=='')		{$class='Medio';}
			if($id<>'')			{$cid="id='$index'";}
			if($disabled<>'')	{$disabled="disabled";}
			$d="<input 
			type		='$type'	
			style		='$style' 
			$cid 
			class		='$class' 
			name		='$name' 
			value		='$value' 	
			title		='$title' 
			maxlength	='$max'
			placeholder	='$holder'
			$libre  
			$disabled
			>";
		}
		//if($type==label)$d="<label 	style='$style' $cid class='$class' name='$name' 				title='$title' $libre >$value</label>";
		//if($type==tarea)$d="<textarea 	style='$style' $cid class='$class' name='$name'					title='$title' $libre >$value</textarea>";
		return $d;
	}
	function consulta			($tabla,$conexion,$col_espe,$espe,$orde,$dire,$phpv,$buscar,$pre_sql)								{ 
		$function['close']=false;
		if($tabla=='')	{echo "[consulta] tabla sin definir"; $function['close']=true;}
	
		if($function['close']==true){exit;}
		$consu="No Consu";
		$consulta="SELECT * FROM ".$tabla;
		if (!empty($espe) and !empty($col_espe))							{$consulta="SELECT * FROM $tabla WHERE $col_espe='$espe'";}
		if (!empty($espe) and !empty($col_espe) and !empty($buscar))		{$consulta="SELECT * FROM $tabla WHERE $col_espe LIKE  '$espe'";}
		if (!empty($dire) or ($dire=='desendente')or($dire=='DESENDENTE'))	$dire='DESC';
		if (empty($dire))		$dire='ASC';
		if (!empty($orde))		{$consulta=$consulta." ORDER BY $orde $dire";}
		if ($pre_sql==true)		{echo$consulta;}
		$consu=$this->ejecuta($conexion,$consulta,$phpv);
		
		return $consu;
	}
	function compro				($com,$col,$var,$consu,$conexion,$phpv,$todos){
		$d=false;
		$res=$consu;
		if(empty($posicion))$posicion='';
		$this->mysql_da_se($res,$posicion,$phpv);
		
		while($dato=$this->mysql_fe_ar($res,$phpv,'')){
			if ($dato[$col]==$com){$d=true; break;}
		}
		if(!empty($var) and !empty($dato[$var]))$d=$dato[$var];
		if(!empty($todos)){$d=$dato;}
		return $d;
	}
	function despliegre_mysql	($name,$name2,$consu,$descarga,$phpv,$libre,$className,$dataset,$set){
		
		$res='';
		if(empty($className))$class="class='Medio'";			#si se define una clase se le pone por defeto una 
		if(!empty($className))$class="class='$className'";		#si detecta una clase definida la usa 
		$res=$res."<select $class name='$name' $libre>";		#crea el objeto
		if(!empty($name2))$res=$res."<OPTION value='$name'>$name2</OPTION>";
			#$this->mysql_da_se($consu,0,$phpv);
			if($this->mysql_nu_ro($consu,$phpv)==0){$res=$res."<OPTION value=''>Ningun Dato Registrado</OPTION>";}
			$EXISTE_OPCION='false';
			$this->mysql_da_se		($consu,0,$phpv);
			while($datos= $this->mysql_fe_ar($consu,$phpv,'')){
				$set='';	
				if(! empty($_POST[$name]) and  $_POST[$name]==$datos[$descarga]){
					$EXISTE_OPCION='true';
				}
				switch (gettype($descarga)) {
					case 'string':
						if(!empty($_POST[$name]) and  $datos[$descarga]==$_POST[$name]){$set='selected';}
						if(!empty($dataset)){if($datos[$dataset]==$set){$set='selected';}}
	
						$res=$res."<option value='$datos[$descarga]' $set>$datos[$descarga]</option>";
					break;
					case 'array':
					break;
					
				}
				
			}
			if($EXISTE_OPCION=='false' and !empty($_POST[$name])){
				
				$res=$res."<option value='".$_POST[$name]."' selected>".$_POST[$name]."</option>";
			}
		$res=$res."</select>";
		return $res;
	}
	function delete				($tabla,$col_espe,$espe,$conexion,$phpv)													{
		if($tabla=='')		echo"[Fuincion delete](faltante Tabla)";
		if($col_espe=='')	echo"[Fuincion delete](faltante columna)";
		if($espe=='')		echo"[Fuincion delete](faltante dato especifico)";
		$res="DELETE FROM $tabla  WHERE $col_espe='$espe'";
		libre_v1::ejecuta($conexion,$res,$phpv);
	}
	function zero				($valor)																					{
		$res=str_pad($valor,2, '0', STR_PAD_LEFT);
		return $res;
	}
	function forma_num			($numero,$decimal)																			{
		if($decimal=="")$decimal=2;
		$res =round($numero,$decimal);
		return $res;
	}
	function Presenta1			($type,$type1,$type2,$x,$n1,$n2,$v1,$v2,$n_r1,$n_r2,$title1,$title2,$focus1,$focus2,$max1,$max2,$style1,$style2){
		if($type<>hidden){
		echo"
			<tr >
				<td >$x</td >
				<td ><input type='$type1' name='$n1' value='$v1' title='$title1' Class='Medio' $focus1 maxlength='$max1' style='$style1'>	</td >
				<td ><input type='$type2' name='$n2' value='$v2' title='$title2' Class='Medio' $focus2 maxlength='$max2' style='$style2'>	</td >
			</tr >";
		}
		if($type==hidden){echo"<tr ><td>$x</td><td >$name1</td ><td >$name2</td ></tr >";}
	}
	function presenta2			($hidden,$name1,$name2,$type,$style,$borra,$consu){
		if($type=='text')echo"<div style='float:left; background: #87bfda; color: black; font-size: 10px;'>";
			
			if(empty($_POST[$hidden]))$_POST[$hidden]=0;
			if($type=='text')echo$this->input2($type,'','',$hidden,'','','','');
			echo$this->input2($type,$hidden,'',$_POST[$hidden],'','','','');
			if($type=='text')	echo"<br>";
			for($x=1; $x<=$_POST[$hidden]; $x++){
				$Name1=$name1.$x;
				$Name2=$name2.$x;
				if (!empty($_POST[$Name1]) and !empty($_POST[$Name2]) and($_POST[$hidden]>1)){$_POST[$hidden]=$_POST[$hidden]-1;}
			}
			for($x=1; $x<=$_POST[$hidden]; $x++){
				$y=$x+1;
				$Name1=$name1.$x;
				$Name2=$name2.$x;
				$Name3=$name1.$y;
				$Name4=$name2.$y;
				if (($borra<>'')and($_POST[$Name1]==$borra))	{$_POST[$Name1]='';$_POST[$Name2]='';}
				if ((
						empty($_POST[$Name1])or($_POST[$Name1]=='0')
					)and empty($_POST[$Name2]) and !empty($_POST[$Name3]) and !empty($_POST[$Name4])){
					$_POST[$Name1]=$_POST[$Name3];
					$_POST[$Name2]=$_POST[$Name4];
					$_POST[$Name3]='';
					$_POST[$Name4]='';
				}
				if(empty($_POST[$Name1]))$_POST[$Name1]='';
				if(empty($_POST[$Name2]))$_POST[$Name2]='';
				if($type=='text')	echo"<input type='$type' class='Medio' name='' 			value='$x' 				style='$style width: 25px;'>";
				if($type=='text')	echo"<input type='$type' class='Medio' name='' 			value='$Name1'			style='$style'>";
									echo"<input type='$type' class='Medio' name='$Name1' 	value='$_POST[$Name1]'	style='$style'>";
				if($type=='text')	echo"<input type='$type' class='Medio' name='' 			value='$Name2' 			style='$style'>";
									echo"<input type='$type' class='Medio' name='$Name2' 	value='$_POST[$Name2]'	style='$style'>";
				if($type=='text')	echo"<br>";
				if(empty($total))$total=0;
				if(!empty($_POST[$name2]))$total=$total+$_POST[$Name2];
			}
			if(empty($total))$total=0;
		if($type=='text')echo"</div>";
		return round($total,2);
	}
	
	function Presenta3			($id,$style,$style_t,$title,$col1,$col2,$t0,$t1,$t2,$repite,$limite,$name1,$name2,$name3,$n_r1,$n_r2,$title1,$title2,$max1,$max2,$style1,$style2,$d1,$d2,$final){
		if ($col1==''){$col1=Comentarios;}
		if ($col2==''){$col2=Importe;}
		echo"<table id='$id' style='$style'>";
		echo"
			<tr style='$style_t'><td colspan='3'><center>$title</center></td></tr>
			<tr><td></td><td>$col1</td><td>$col2</td></tr>
		";
		$t=0;
		for($x=1; $x<=$repite; $x++){
			$n1=$name1.$x;
			$v1=$_POST[$n1];
			$n2=$name2.$x;
			$v2=$_POST[$n2];
			if ($n_r1<>'')$n1=$n_r1;
			if ($n_r2<>'')$n2=$n_r2;
			if (($_POST[$n2]<>'')and($repite==$x)and($repite<$limite))	{$repite=$repite+1;}
			if (($_POST[$n1]=='')and($repite==$x))						{$libre1="autofocus";}
			if (($_POST[$n2]=='')and($repite==$x))						{$libre2="autofocus";}
			$c1=input2($t1,$n1,$title1,$v1,$style1,$d1,$libre1);
			$c2=input2($t2,$n2,$title2,$v2,$style2,$d2,$libre2);
			if ($t0=='')$t0=hidden;
			if (($t0==hidden)and($t1==hidden))	{$c1=$c1.input2(button,'','',$v1,'text-align: left;');}
			if (($t0==hidden)and($t2==hidden))	{$c2=$c2.input2(button,'','',$v2,'text-align: left;');}
			$t=$t+$_POST[$n2];
			print"<tr><td>$x</td><td>$c1</td><td>$c2</td></tr>";
		}
		echo"<tr><td></td><td>Total</td><td>$t</td></tr>$final
		</table>";
		return $repite;
	}
	function auto_tab_insert	($tabla,$n0,$v0,$n1,$v1,$n2,$v2,$n3,$v3,$n4,$v4,$n5,$v5,$n6,$v6,$n7,$v7,$n8,$v8,$n9,$v9,$n10,$v10,$na1,$va1,$repit1,$na2,$va2,$repit2,$na3,$va3,$repit3,$na4,$va4,$repit4){
		$d="INSERT INTO $tabla ($n0";
		IF ($n1<>'')$d=$d.",$n1";
		IF ($n2<>'')$d=$d.",$n2";
		IF ($n3<>'')$d=$d.",$n3";
		IF ($n4<>'')$d=$d.",$n4";
		IF ($n5<>'')$d=$d.",$n5";
		IF ($n6<>'')$d=$d.",$n6";
		IF ($n7<>'')$d=$d.",$n7";
		IF ($n8<>'')$d=$d.",$n8";
		IF ($n9<>'')$d=$d.",$n9";
		IF ($n10<>'')$d=$d.",$n10";
		for($x=1; $x<=$repit1; $x++){
			IF ($repit1>=$x)$d=$d.",";
			$Name1=$na1.$x;
			$d=$d.$Name1;
		}
		IF ($na2<>''){
			for($x=1; $x<=$repit2; $x++){
				IF ($repit2>=$x)$d=$d.",";
				$Name1=$na2.$x;
				$d=$d.$Name1;
			}
		}
		IF ($na3<>''){
			for($x=1; $x<=$repit3; $x++){
				IF ($repit3>=$x)$d=$d.",";
				$Name1=$na3.$x;
				$d=$d.$Name1;
			}
		}
		IF ($na4<>''){
			for($x=1; $x<=$repit4; $x++){
				IF ($repit4>=$x)$d=$d.",";
				$Name1=$na4.$x;
				$d=$d.$Name1;
			}
		}
		$d=$d.") VALUE ('$v0'";
		IF ($n1<>'')$d=$d.",'$v1'";
		IF ($n2<>'')$d=$d.",'$v2'";
		IF ($n3<>'')$d=$d.",'$v3'";
		IF ($n4<>'')$d=$d.",'$v4'";
		IF ($n5<>'')$d=$d.",'$v5'";
		IF ($n6<>'')$d=$d.",'$v6'";
		IF ($n7<>'')$d=$d.",'$v7'";
		IF ($n8<>'')$d=$d.",'$v8'";
		IF ($n9<>'')$d=$d.",'$v9'";
		IF ($n10<>'')$d=$d.",'$v10'";
		for($x=1; $x<=$repit1; $x++){
			IF ($repit1>=$x)$d=$d.",";
			$Name1=$va1.$x;
			$d=$d."'$_POST[$Name1]'";
		}
		IF ($va2<>''){
			for($x=1; $x<=$repit2; $x++){
				IF ($repit2>=$x)$d=$d.",";
				$Name1=$va2.$x;
				$d=$d."'$_POST[$Name1]'";
			}
		}
		IF ($va3<>''){
			for($x=1; $x<=$repit3; $x++){
				IF ($repit3>=$x)$d=$d.",";
				$Name1=$va3.$x;
				$d=$d."'$_POST[$Name1]'";
			}
		}
			IF ($va4<>''){
			for($x=1; $x<=$repit4; $x++){
				IF ($repit4>=$x)$d=$d.",";
				$Name1=$va4.$x;
				$d=$d."'$_POST[$Name1]'";
			}
		}
		$d=$d.")";
		return $d;
	}
	function espe_tab_insert	($tabla,$n0,$v0,$n1,$v1,$n2,$v2,$n3,$v3,$n4,$v4,$n5,$v5,$n6,$v6,$n7,$v7,$n8,$v8,$n9,$v9,$v10,$n10,$v11,$n11,$v12,$n12,$v13,$n13,$v14,$n14,$v15,$n15,$v16,$n16,$v17,$n17,$v18,$n18,$v19,$n19,$v20,$n20,$v21,$n21,$v22,$n22,$v23,$n23,$v24,$n24,$v25,$n25,$v26,$n26,$v27,$n27,$v28,$n28,$v29,$n29){
		$d="INSERT INTO $tabla ($n0";
		IF ($n1<>'')	$d=$d.",$n1";	
		IF ($n2<>'')	$d=$d.",$n2";	
		IF ($n3<>'')	$d=$d.",$n3";	
		IF ($n4<>'')	$d=$d.",$n4";	
		IF ($n5<>'')	$d=$d.",$n5";
		IF ($n6<>'')	$d=$d.",$n6";	
		IF ($n7<>'')	$d=$d.",$n7";	
		IF ($n8<>'')	$d=$d.",$n8";	
		IF ($n9<>'')	$d=$d.",$n9";	
		IF ($n10<>'')	$d=$d.",$n10";
		IF ($n11<>'')	$d=$d.",$n11";	
		IF ($n12<>'')	$d=$d.",$n12";	
		IF ($n13<>'')	$d=$d.",$n13";	
		IF ($n14<>'')	$d=$d.",$n14";	
		IF ($n15<>'')	$d=$d.",$n15";
		IF ($n16<>'')	$d=$d.",$n16";	
		IF ($n17<>'')	$d=$d.",$n17";	
		IF ($n18<>'')	$d=$d.",$n18";	
		IF ($n19<>'')	$d=$d.",$n19";	
		IF ($n20<>'')	$d=$d.",$n20";
		IF ($n21<>'')	$d=$d.",$n21";	
		IF ($n22<>'')	$d=$d.",$n22";	
		IF ($n23<>'')	$d=$d.",$n23";	
		IF ($n24<>'')	$d=$d.",$n24";	
		IF ($n25<>'')	$d=$d.",$n25";
		IF ($n26<>'')	$d=$d.",$n26";	
		IF ($n27<>'')	$d=$d.",$n27";	
		IF ($n28<>'')	$d=$d.",$n28";	
		IF ($n29<>'')	$d=$d.",$n29";	
		IF ($n30<>'')	$d=$d.",$n30";
		$d=$d.") VALUE ('$v0'";
		IF ($n1<>'')	$d=$d.",'$v1'";	
		IF ($n2<>'')	$d=$d.",'$v2'";
		IF ($n3<>'')	$d=$d.",'$v3'";	
		IF ($n4<>'')	$d=$d.",'$v4'";	
		IF ($n5<>'')	$d=$d.",'$v5'";
		IF ($n6<>'')	$d=$d.",'$v6'";	
		IF ($n7<>'')	$d=$d.",'$v7'";	
		IF ($n8<>'')	$d=$d.",'$v8'";	
		IF ($n9<>'')	$d=$d.",'$v9'";	
		IF ($n10<>'')	$d=$d.",'$v10'";
		IF ($n11<>'')	$d=$d.",'$v11'";
		IF ($n12<>'')	$d=$d.",'$v12'";
		IF ($n13<>'')	$d=$d.",'$v13'";
		IF ($n14<>'')	$d=$d.",'$v14'";
		IF ($n15<>'')	$d=$d.",'$v15'";
		IF ($n16<>'')	$d=$d.",'$v16'";			
		IF ($n17<>'')	$d=$d.",'$v17'";
		IF ($n18<>'')	$d=$d.",'$v18'";
		IF ($n19<>'')	$d=$d.",'$v19'";
		IF ($n20<>'')	$d=$d.",'$v20'";
		IF ($n21<>'')	$d=$d.",'$v21'";
		IF ($n22<>'')	$d=$d.",'$v22'";
		IF ($n23<>'')	$d=$d.",'$v23'";
		IF ($n24<>'')	$d=$d.",'$v24'";
		IF ($n25<>'')	$d=$d.",'$v25'";
		IF ($n26<>'')	$d=$d.",'$v26'";
		IF ($n27<>'')	$d=$d.",'$v27'";
		IF ($n28<>'')	$d=$d.",'$v28'";
		IF ($n29<>'')	$d=$d.",'$v29'";
		IF ($n30<>'')	$d=$d.",'$v30'";
		$d=$d.")";
		return $d;
	}
	function espe_tab_update	($tabla,$n_id,$v_id,$n0,$v0,$n1,$v1,$n2,$v2,$n3,$v3,$n4,$v4,$n5,$v5,$n6,$v6,$n7,$v7,$n8,$v8,$n9,$v9,$n10,$v10,$n11,$v11,$n12,$v12,$n13,$v13,$n14,$v14,$n15,$v15,$n16,$v16,$n17,$v17,$n18,$v18,$n19,$v19,$n20,$v20,$n21,$v21,$n22,$v22,$n23,$v23,$n24,$v24,$n25,$v25,$n26,$v26,$n27,$v27,$n28,$v28,$n29,$v29){
		$d="UPDATE $tabla SET ";
		IF ($n0<>'')$d=$d."$n0='$v0'";	IF ($n1<>'')$d=$d.",$n1='$v1'";
		IF ($n2<>'')$d=$d.",$n2='$v2'";	IF ($n3<>'')$d=$d.",$n3='$v3'";
		IF ($n4<>'')$d=$d.",$n4='$v4'";	IF ($n5<>'')$d=$d.",$n5='$v5'";
		IF ($n6<>'')$d=$d.",$n6='$v6'";	IF ($n7<>'')$d=$d.",$n7='$v7'";	
		IF ($n8<>'')$d=$d.",$n8='$v8'";	IF ($n9<>'')$d=$d.",$n9='$v9'";	
		
		IF ($n10<>'')$d=$d.",$n10='$v10'";	IF ($n11<>'')$d=$d.",$n11='$v11'";	
		IF ($n12<>'')$d=$d.",$n12='$v12'";	IF ($n13<>'')$d=$d.",$n13='$v13'";	
		IF ($n14<>'')$d=$d.",$n14='$v14'";	IF ($n15<>'')$d=$d.",$n15='$v15'";	
		IF ($n16<>'')$d=$d.",$n16='$v16'";	IF ($n17<>'')$d=$d.",$n17='$v17'";	
		IF ($n18<>'')$d=$d.",$n18='$v18'";	IF ($n19<>'')$d=$d.",$n19='$v19'";	
		IF ($n20<>'')$d=$d.",$n20='$v20'";	IF ($n21<>'')$d=$d.",$n21='$v21'";	
		IF ($n22<>'')$d=$d.",$n22='$v22'";	IF ($n23<>'')$d=$d.",$n23='$v23'";	
		IF ($n24<>'')$d=$d.",$n24='$v24'";	IF ($n25<>'')$d=$d.",$n25='$v25'";	
		IF ($n26<>'')$d=$d.",$n26='$v26'";	IF ($n27<>'')$d=$d.",$n27='$v27'";	
		IF ($n28<>'')$d=$d.",$n28='$v28'";	IF ($n29<>'')$d=$d.",$n29='$v29'";	
		IF ($n30<>'')$d=$d.",$n30='$v30'";
		IF ($v_id<>'')$d=$d." WHERE $n_id='$v_id'";
		return $d;
	}
	function menu				($type,$style,$libre,$name,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$script_input,$array)			{	
		if(!empty($array['memoria']))$memoria=$array['memoria'];
		if($style=="")$style="width: 120px; height: 300px; background: #002681b3; position: absolute; top: 55px;";
		if($script_input=="")$script_input="onClick='cambia_co_centro(this);'";
		$id_def='id';
		$id_sel='id_s';
		$d1=$id_def;
		$d2=$id_def;
		$d3=$id_def;
		$d4=$id_def;
		$d5=$id_def;
		$d6=$id_def;
		$d7=$id_def;
		$d8=$id_def;
		$d9=$id_def;
		$d10=$id_def;
		$d11=$id_def;
		if(empty($_POST[$name]))$_POST[$name]=$v1;
		if($_POST[$name]==$v1){$d1=$id_sel;}
		if($_POST[$name]==$v2){$d2=$id_sel;}
		if($_POST[$name]==$v3){$d3=$id_sel;}
		if($_POST[$name]==$v4){$d4=$id_sel;}
		if($_POST[$name]==$v5){$d5=$id_sel;}
		if($_POST[$name]==$v6){$d6=$id_sel;}
		if($_POST[$name]==$v7){$d7=$id_sel;}
		if($_POST[$name]==$v8){$d8=$id_sel;}
		if($_POST[$name]==$v9){$d9=$id_sel;}
		if($_POST[$name]==$v10){$d10=$id_sel;}
		if($_POST[$name]==$v11){$d10=$id_sel;}
		
		if(!empty($memoria)){
			$conte=	libre_v2::input2('hidden',$name,'',$_POST[$name],'',$memoria['id'],'','');
		}else{
			$conte=	libre_v2::input2('hidden',$name,'',$_POST[$name],'','','','');
		}
											  			
		if(!empty($v1))$conte=$conte.	$this->input2($type,$name,'',$v1,"",$d1 ,''.$script_input,'');
		if(!empty($v2))$conte=$conte.	$this->input2($type,$name,'',$v2,"",$d2 ,''.$script_input,'');
		if(!empty($v3))$conte=$conte.	$this->input2($type,$name,'',$v3,"",$d3 ,''.$script_input,'');
		if(!empty($v4))$conte=$conte.	$this->input2($type,$name,'',$v4,"",$d4 ,''.$script_input,'');
		if(!empty($v5))$conte=$conte.	$this->input2($type,$name,'',$v5,"",$d5 ,''.$script_input,'');
		if(!empty($v6))$conte=$conte.	$this->input2($type,$name,'',$v6,"",$d6 ,''.$script_input,'');
		if(!empty($v7))$conte=$conte.	$this->input2($type,$name,'',$v7,"",$d7 ,''.$script_input,'');
		if(!empty($v8))$conte=$conte.	$this->input2($type,$name,'',$v8,"",$d8 ,''.$script_input,'');
		if(!empty($v9))$conte=$conte.	$this->input2($type,$name,'',$v9,"",$d9 ,''.$script_input,'');
		if(!empty($v10))$conte=$conte.	$this->input2($type,$name,'',$v10,"",$d10,'','');
		if(!empty($v11))$conte=$conte.	$this->input2($type,$name,'',$v11,"",$d11,'','');
		$res=	$this->libre_v1->div($style,$libre,$conte);
		return $res;
	}
	function menu2				($type,$style,$libre,$name,$id_def,$id_sel,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$script_input){	
		
		if($style=="")$style="width: 120px; height: 300px; background: #002681b3; position: absolute; top: 55px;";
		if($script_input=="")$script_input="onClick='cambia_co_centro(this);'";
		if($id_def=="")$id_def='id';
		if($id_sel=="")$id_sel='id_s';
		$d1=$id_def;
		$d2=$id_def;
		$d3=$id_def;
		$d4=$id_def;
		$d5=$id_def;
		$d6=$id_def;
		$d7=$id_def;
		$d8=$id_def;
		$d9=$id_def;
		$d10=$id_def;
		$d11=$id_def;
		if(empty($_POST[$name]))$_POST[$name]=$v1;
		if($_POST[$name]==$v1){$d1=$id_sel;}
		if($_POST[$name]==$v2){$d2=$id_sel;}
		if($_POST[$name]==$v3){$d3=$id_sel;}
		if($_POST[$name]==$v4){$d4=$id_sel;}
		if($_POST[$name]==$v5){$d5=$id_sel;}
		if($_POST[$name]==$v6){$d6=$id_sel;}
		if($_POST[$name]==$v7){$d7=$id_sel;}
		if($_POST[$name]==$v8){$d8=$id_sel;}
		if($_POST[$name]==$v9){$d9=$id_sel;}
		if($_POST[$name]==$v10){$d10=$id_sel;}
		if($_POST[$name]==$v11){$d10=$id_sel;}
		$conte=	libre_v2::input2('hidden',$name,'',$_POST[$name],'','','','');
										//($type2,$name,$title,$value,$style,$id,$libre,$class)
			if($v1<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v1,"",$d1 ,''.$script_input,'');
			if($v2<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v2,"",$d2 ,''.$script_input,'');
			if($v3<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v3,"",$d3 ,''.$script_input,'');
			if($v4<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v4,"",$d4 ,''.$script_input,'');
			if($v5<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v5,"",$d5 ,''.$script_input,'');
			if($v6<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v6,"",$d6 ,''.$script_input,'');
			if($v7<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v7,"",$d7 ,''.$script_input,'');
			if($v8<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v8,"",$d8 ,''.$script_input,'');
			if($v9<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v9,"",$d9 ,''.$script_input,'');
			if($v10<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v10,"",$d10,''.$script_input,'');
			if($v11<>'')$conte=$conte.	libre_v2::input2($type,$name,'',$v11,"",$d11,''.$script_input,'');
			$res=	libre_v2::div($style,$libre,$conte);
		return $res;
	}
	function menu3				($type,$style,$libre,$name,$id_defaul,$id_select,$class_defaul,$class_select,$array,$script_input)			{	
		echo"<div style='$style'>";
			if($id_def=="")$id_def='id';
			if($id_sel=="")$id_sel='id_s';
			if($class_defaul=="")$class_defaul=botones_submenu;
			if($class_select=="")$class_select=botone_n;
			if($_POST[$name]=="")$_POST[$name]=$array[0];
			echo libre_v2::input2(hidden,$name,'',$_POST[$name]);
			for($x=0; $x<count($array); $x++){		
				$class=$class_defaul;
				if($_POST[$name]==$array[$x]){$class=$class_select;	}
				echo libre_v2::input2($type,$name,'',$array[$x],"width: 100%;",'','',$class);
			}
			$res=	libre_v2::div($style,$libre,$conte);
		echo"</div>";
		return $res;
	}
	function despieges			($name,$title,$inicio,$fin,$libre,$id)														{
		$d=$d."<select name='$name' class='Medio' style='width: auto;' title='$title' $libre id='$id'>";
		for($x=$inicio; $x<=$fin; $x++){
			$set='';
			$x=zero($x);
			if($_POST[$name]==$x){$set='selected';}
			$d=$d."<option value='$x' $set>$x</option>";
		}
		$d=$d.'</select>';
		return $d;
	}
	function tablero			($size,$style,$title1,$ts,$i1,$d1,$tc1,$ic1,$dc1,$if1,$df1,$i2,$d2,$tc2,$ic2,$dc2,$if2,$df2,$i3,$d3,$tc3,$ic3,$dc3,$if3,$df3,$i4,$d4,$tc4,$ic4,$dc4,$if4,$df4,$i5,$d5,$tc5,$ic5,$dc5,$if5,$df5,$i6,$d6,$tc6,$ic6,$dc6,$if6,$df6,$i7,$d7,$tc7,$ic7,$dc7,$if7,$df7,$i8,$d8,$tc8,$ic8,$dc8,$if8,$df8,$i9,$d9,$tc9,$ic9,$dc9,$if9,$df9,$i10,$d10,$tc10,$ic10,$dc10,$if10,$df10,$i11,$d11,$tc11,$ic11,$dc11,$if11,$df11,$i12,$d12,$tc12,$ic12,$dc12,$if12,$df12,$i13,$d13,$tc13,$ic13,$dc13,$if13,$df13,$i14,$d14,$tc14,$ic14,$dc14,$if14,$df14,$i15,$d15,$tc15,$ic15,$dc15,$if15,$df15,$i16,$d16,$tc16,$ic16,$dc16,$if16,$df16,$i17,$d17,$tc17,$ic17,$dc17,$if17,$df17,$i18,$d18,$tc18,$ic18,$dc18,$if18,$df18,$i19,$d19,$tc19,$ic19,$dc19,$if19,$df19,$i20,$d20,$tc20,$ic20,$dc20,$if20,$df20,$i21,$d21,$tc21,$ic21,$dc21,$if21,$df21,$class){
		$res='
		<table border="'.$size.'" id="conte-dere" style="'.$style.'" class="'.$class.'">
			<tr  ><td colspan="2" align="center" style="'.$ts.'"><font color="'.$tf.'">'.$title1.'</font ></td ></tr >
			<tr  bgcolor="'.$tc1.'">
				<td bgcolor="'.$ic1.'"><font color="'.$if1.'"> '.$i1.'</font ></td >
				<td bgcolor="'.$dc1.'"><font color="'.$df1.'"> '.$d1.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc2.'">
				<td bgcolor="'.$ic2.'"><font color="'.$if2.'">	'.$i2.'</font ></td >
				<td bgcolor="'.$dc2.'"><font color="'.$df2.'">	'.$d2.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc3.'">
				<td bgcolor="'.$ic3.'"><font color="'.$if3.'">	'.$i3.'</font ></td >
				<td bgcolor="'.$dc3.'"><font color="'.$df3.'">	'.$d3.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc4.'">
				<td bgcolor="'.$ic4.'"><font color="'.$if4.'">	'.$i4.'</font ></td >
				<td bgcolor="'.$dc4.'"><font color="'.$df4.'">	'.$d4.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc5.'">
				<td bgcolor="'.$ic5.'"><font color="'.$if5.'">	'.$i5.'</font ></td >
				<td bgcolor="'.$dc5.'"><font color="'.$df5.'">	'.$d5.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc6.'">
				<td bgcolor="'.$ic6.'"><font color="'.$if6.'">	'.$i6.'</font ></td >
				<td bgcolor="'.$dc6.'"><font color="'.$df6.'">	'.$d6.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc7.'">
				<td bgcolor="'.$ic7.'"><font color="'.$if7.'">	'.$i7.'</font ></td >
				<td bgcolor="'.$dc7.'"><font color="'.$df7.'">	'.$d7.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc8.'">
				<td bgcolor="'.$ic8.'"><font color="'.$if8.'">	'.$i8.'</font ></td >
				<td bgcolor="'.$dc8.'"><font color="'.$df8.'">	'.$d8.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc9.'">
				<td bgcolor="'.$ic9.'"><font color="'.$if9.'">	'.$i9.'</font ></td >
				<td bgcolor="'.$dc9.'"><font color="'.$df9.'">	'.$d9.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc10.'">
				<td bgcolor="'.$ic10.'"><font color="'.$if10.'">	'.$i10.'</font ></td >
				<td bgcolor="'.$dc10.'"><font color="'.$df10.'">	'.$d10.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc11.'">
				<td bgcolor="'.$ic11.'"><font color="'.$if11.'">	'.$i11.'</font ></td >
				<td bgcolor="'.$dc11.'"><font color="'.$df11.'">	'.$d11.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc12.'">
				<td bgcolor="'.$ic12.'"><font color="'.$if12.'">	'.$i12.'</font ></td >
				<td bgcolor="'.$dc12.'"><font color="'.$df12.'">	'.$d12.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc13.'">
				<td bgcolor="'.$ic13.'"><font color="'.$if13.'">	'.$i13.'</font ></td >
				<td bgcolor="'.$dc13.'"><font color="'.$df13.'">	'.$d13.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc14.'">
				<td bgcolor="'.$ic14.'"><font color="'.$if14.'">	'.$i14.'</font ></td >
				<td bgcolor="'.$dc14.'"><font color="'.$df14.'">	'.$d14.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc15.'">
				<td bgcolor="'.$ic15.'"><font color="'.$if15.'">	'.$i15.'</font ></td >
				<td bgcolor="'.$dc15.'"><font color="'.$df15.'">	'.$d15.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc16.'">
				<td bgcolor="'.$ic16.'"><font color="'.$if16.'">    '.$i16.'</font ></td >
				<td bgcolor="'.$dc16.'"><font color="'.$df16.'">    '.$d16.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc17.'">
				<td bgcolor="'.$ic17.'"><font color="'.$if17.'">    '.$i17.'</font ></td >
				<td bgcolor="'.$dc17.'"><font color="'.$df17.'">    '.$d17.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc18.'">
				<td bgcolor="'.$ic18.'"><font color="'.$if18.'">    '.$i18.'</font ></td >
				<td bgcolor="'.$dc18.'"><font color="'.$df18.'">    '.$d18.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc19.'">
				<td bgcolor="'.$ic19.'"><font color="'.$if19.'">    '.$i19.'</font ></td >
				<td bgcolor="'.$dc19.'"><font color="'.$df19.'">    '.$d19.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc20.'">
				<td bgcolor="'.$ic20.'"><font color="'.$if20.'">    '.$i20.'</font ></td >
				<td bgcolor="'.$dc20.'"><font color="'.$df20.'">    '.$d20.'</font ></td >
			</tr >
			<tr  bgcolor="'.$tc21.'">
				<td bgcolor="'.$ic21.'"><font color="'.$if21.'">    '.$i21.'</font ></td >
				<td bgcolor="'.$dc21.'"><font color="'.$df21.'">    '.$d21.'</font ></td >
			</tr >
		</table >';
		return $res;
	}	
	function tablero_2			($size,$style,$title1,$id,$libre,$class,$array,$array1,$i1,$d1,$i2,$d2,$i3,$d3,$i4,$d4,$i5,$d5,$i6,$d6,$i7,$d7,$i8,$d8,$i9,$d9,$i10,$d10){	
		if($size=="")	$size=0;
		if($style=="")	{$style="position: absolute; height: 100px; width: 100px; background: yellowgreen;";}
		$res=$res."<table border='$size' style='$style' id='$id' $libre class='$class'>";
			$res=$res."<tr><td colspan='2'>$title1</td></tr>";		
			if($array<>""){
				$conta=count($array);
				for($x=0; $x<$conta; $x++){
					$i=$array1[$x];
					$d=input2(text,$array[$x],"",$_POST[$array[$x]]);
					$res=$res."<tr><td>$i</td><td>$d</td></tr>";
				}
			}
			if($array==""){
					$res=$res."<tr><td>$i1</td><td>$d1</td></tr>";		
					$res=$res."<tr><td>$i2</td><td>$d2</td></tr>";		
					$res=$res."<tr><td>$i3</td><td>$d3</td></tr>";		
					$res=$res."<tr><td>$i4</td><td>$d4</td></tr>";		
					$res=$res."<tr><td>$i5</td><td>$d5</td></tr>";		
					$res=$res."<tr><td>$i6</td><td>$d6</td></tr>";		
					$res=$res."<tr><td>$i7</td><td>$d7</td></tr>";		
					$res=$res."<tr><td>$i8</td><td>$d8</td></tr>";		
					$res=$res."<tr><td>$i9</td><td>$d9</td></tr>";		
					$res=$res."<tr><td>$i10</td><td>$d10</td></tr>";		
			}
		$res=$res."</table>";
		return $res;

	}
	function tablero_array		($size,$style,$title,$id,$libre,$class,$array_text,$array_mysql,$array_type,$array_name,$array_title,$array_value,$array_style,$array_id,$array_libre,$array_class){	
		
		if($size=="")	$size=0;
		if($style=="")	{$style="position: absolute; height: 100px; width: 100px; background: yellowgreen;";}
		$res=$res."<table border='$size' style='$style' id='$id' $libre class='$class'>";
		$res=$res."<tr><td colspan='2'>$title</td></tr>";		
										$conta=count($array_name);
			if($array_mysql<>"")		$conta=count($array_mysql);
			for($x=0; $x<$conta; $x++){
				$i =$array_text[$x];
				if ($array_type[$x]=="")	$array_type[$x]="text";
				if ($array_mysql[$x]<>"")	$array_name[$x]=$array_mysql[$x];
				if ($array_value[$x]=="")	$array_value[$x]=$_POST[$array_name[$x]];
				
				if (($array_type[$x]==text)||($array_type[$x]==hidden)||($array_type[$x]==button)){	$d=input2(hidden,$array_name[$x],$array_title[$x],$array_value[$x],$array_style[$x],$array_id[$x],$array_libre[$x],$array_class[$x]).input2($array_type[$x],$array_name[$x],$array_title[$x],$array_value[$x],$array_style[$x],$array_id[$x],$array_libre[$x],$array_class[$x]);	}
				if ($array_type[$x]==textarea)	{														$d="<textarea name='$array_name[$x]' title='$array_title[$x]' style='$array_style[$x]' id='$array_id[$x]' class='$array_class[$x]' $array_libre[$x]>$array_value[$x]</textarea>";	}
				if ($array_type[$x]==Estatus)	{				$d=objeto::Estatus('',ver);}
				if ($array_type[$x]==Fecha_re)	{				$d=objeto::Fecha_re();}
				if ($array_type[$x]==N_Fact)	{				$d=objeto::N_Fact();}
				
				$res=$res."<tr><td>$i</td><td>$d</td></tr>";
			}
		$res=$res."</table>";
		return $res;

	}
	function alert_js			($mensaje) {
		$res="<script> alert('$mensaje'); </script>";
		return $res;
	}
	function contenedor			($id,$caption,$style,$contenido){
		$res="";
		if($caption=="")	$res		=	$res.			"<label style='position: absolute; top: 5px; left: 5px; color: white;'>$id		</label>";
		if($caption<>"")	$res		=	$res.			"<label style='position: absolute; top: 5px; left: 5px; color: white;'>$caption	</label>";
		
		if($style=="")		$style		=					"width: 200px; min-height: 200px; background: rgba(5, 72, 108, 0.67);";
		if($style_cont=="")	$style_cont =	$style_cont.	"background: rgba(5, 72, 108, 0.51);";
		
							$style		= 	$style.			"position: absolute;";
							$style_cont	= 	$style_cont.	"width: 100%; height: auto; position: absolute; top: 30px;";
							$res		=	$res.			libre_v1::div($style_cont,"",$contenido);
							$res		=					libre_v1::div($style,"id='$id'",$res);
		return $res;
	}
	function windows			($name,$style1,$style2,$contenido,$windows){
		if($name=="")									{$name="win_prueba";}
		$style=$style1;
		//$conte="<label style='left: 5px; position: absolute; color: white;'>$name</label>";
		if(($_POST[$name]=="")or($_POST[$name]=="-"))							{$actuador="x"; $class="div$name";} 	//Contenido mostrado  
		if(($_POST[$name]=="x")or(($windows==min)and($_POST[$name]=="")))		{$actuador="-"; $class="min";}		//Contenido oculto 
		$sub_style	="position: absolute; top: 2px; bottom: 2px; left: 2px; right: 2px; color: white; overflow: auto; background: #292a2d;";
		$libre="id='res$name' ";
		$conte		=$conte.libre_v1::div			($sub_style,$libre,$contenido);
		$conte=$conte.libre_v1::input2(button,$name,'',$actuador	,'position: absolute; right: 5px; width: 20px;',"act".$name,"onclick='windows($name);'");//,'onclick="windows(this);"'
		
		$libre="id='$name' class='$class'";
		$res		=libre_v1::div					($style,$libre,$conte);
		return $res;
	}
	function tran($hidden,$name1,$name2,$dato){
		for($x=1; $x<=$hidden; $x++){
			$Name1=$name1.$x;
			$Name2=$name2.$x;
			$_POST[$Name1]=$dato[$Name2];
			
		}
	}
	function borrar				($n1){
		for($y=1; $y<=20; $y++){
			$N=$n1.$y;
			$_POST[$N]='';
		}
	}		
	function cal_tiempo			($hora_i,$hora_f,$minu_i,$minu_f){
		$tiempo=0;
		if($hora_f==$hora_i){//cuando sea la misma hora 
			$horas=0;
			$minutos=$minu_f-$minu_i;
		}
		if($hora_f<$hora_i){//cuando la hora es menor[cambio de dia ] 
			$ho=24-$hora_i;
			$horas=$ho+$hora_f;
			if($horas>=1){
				$tiempo=$minu_f-$minu_i;				
				if($tiempo==0){//cuando pasan 60 minutos exactos 
					$horas=$horas+1;
					$minutos=$tiempo;
				}	
				if($tiempo<0){					//cuando pasan menos 60 minutos
					$minutos=$tiempo*-1;
				}
				if($tiempo>0){					//cuando pasan mas 60 minutos
					$ti=60-$minu_i;
					$tiempo=$ti+$minu_f;
					$minutos=$tiempo-60;
					$horas=$horas+1;
				}
			}			
		}
		if($hora_f>$hora_i){//cuando la hora es mayor 
			$horas=$hora_f-$hora_i;
			if($horas>=1){
				$tiempo=$minu_f-$minu_i;							
				if($tiempo==0){//cuando pasan 60 minutos exactos 
					$horas=$horas+1;
					$minutos=$tiempo;
				}		
				if($tiempo<0){					//cuando pasan menos 60 minutos
					$minutos=$tiempo*-1;
				}
				if($tiempo>0){					//cuando pasan mas 60 minutos
					$ti=60-$minu_i;
					$tiempo=$ti+$minu_f;
					$minutos=$tiempo-60;
					$horas=$horas+1;
				}
				
			}
		}
		$res			= array(
		"horas"		=> $horas,
		"minutos"	=> $minutos,
		);
		return $res;
	}
	function build_insert		($date){
		$sql="INSERT INTO ".$date[config][tb]." (".$date[mysql][0];
		for($x=1; $x<=count($date[mysql])-1; $x++){
			$sql=$sql.",".$date[mysql][$x];
		}
		$sql=$sql.") VALUE ('".$_POST[$date[name][0]];
		for($x=1; $x<=count($date[name])-1; $x++){
			$sql=$sql."','".$_POST[$date[name][$x]];
		}
		$sql=$sql."')";
		return $sql;
	}
	function build_insert2		($date,$id){			
		if($id==''){//Añada los valores automaticamente 
			$sql="INSERT INTO ".$date[config][tb]." (".$date[mysql][0];
			for($x=1; $x<=count($date[mysql])-1; $x++){
				$sql=$sql.",".$date[mysql][$x];
			}
			$sql=$sql.") VALUE ('".$_POST[$date[name][0]];
			for($x=1; $x<=count($date[name])-1; $x++){
				$sql=$sql."','".$_POST[$date[name][$x]];
			}
			$sql=$sql."')";
		}
		if($id<>''){//Crea una Celda vacia
			$sql="INSERT INTO ".$date[config][tb]." (".$date[mysql][0];
			for($x=1; $x<=count($date[mysql])-1; $x++){
				$sql=$sql.",".$date[mysql][$x];
			}
			$sql=$sql.") VALUE ('".$id;
			for($x=1; $x<=count($date[name])-1; $x++){
				$sql=$sql."','";
			}
			$sql=$sql."')";
		}
		return $sql;
	}		
	function guarda_indivi($id,$tb,$operador,$conexion,$phpv){
		$pre			=tablas_v1::info(empresa,$tb);
		$sql			=libre_v2::build_insert2($pre,$id); //ok
		if($operador=="echo")echo$sql;
		if($operador==ejecuta)libre_v2::ejecuta($conexion,$sql,$phpv);
	}
	function crea_array($name){//ID asignado entro del arrayA
		if(empty($name))$array=array();//crea un array sin id
		if(!empty($name))$array[$name]=array();//crear un arrayB dentro de otro arrayA
		return $array;
	}
	function add_array($array,$name,$new_dato){
		if(empty($name))	$array[]=$new_dato;//ingresa un dato al final del array
		if(!empty($name))	$array[$name][]=$new_dato;	//agregar en una subArrray	
		//if($name=="==")$array[$new_dato][]=$new_dato;//esta mal-> uso im practico
		return $array;
	}
	function busca_array($array,$busca){
		$res=false;
		for($x=0; $x<count($array); $x++){//busca si existe el id
			if($array[$x]==$busca){$res=true;}
		}
		return $res;
	}
	function formato_num($numero){
		$res=number_format($numero,2);
		return $res;
	}
	function suma_totales($array,$tabla,$title,$total_name,$intefaces,$conexion,$phpv){
		$total=0;
		
		for($y=0;$y<count($array); $y++){				
			$consu=libre_v2::consulta($tabla	    	,$conexion	,'ID_G',$array[$y],'ID_G','1'	,$phpv,'');
			$dato=libre_v2::mysql_fe_ar		($consu,$phpv);
			$total			=$total+$dato[$total_name];
		}
		$formato			=libre_v2::formato_num($total);
		if($intefaces==true){
			echo"<div style='width: 220px'>";
				echo libre_v1::input2(text,'','',$title		,"width: 88px; height: 20px;"				,''		,"disabled",botone_n);
				echo libre_v1::input2(text,'','',$res		,"width: 122px; height: 20px; text-align: right;padding: 0px 5px;"				,''		,"disabled",botones_submenu);
			echo"</div>";
		}
		$res			= array(
		"normal"	=> $total,
		"formato"	=> $formato			
		);
		return $res;
	}
}
class tablas_v2	{		
	//$array_insert	= array('','');
	//$array_update	= array('','');
	
	function info($db,$tb){//tablas_v2::info(empresa,folio);
		$datos_encontrados=false;
		$db1='empresa';
			$db1_1='sistema_cuentas_ares';
		$db2='empresa2';
		$db3='login';
		$db4='combustible';
		if($db==$db1 or $db==$db1_1){ #empresa o sistema_cuentas_ares
			$tb1	='folio';
			$tb2	='abo_acu';
			$tb27	='clientes';
			$tb25	='choferes';
			$tb3	='casetas';
			$tb4	='casetas_c';
			$tb5	='casetas_via';
			$tb24	='casetas_c_via';
			$tb10	='facturas';
			$tb17	='facturas_c';
			$tb6	='fletes';
			$tb14	='fletes_c';
			$tb21	='fechas';
			$tb7	='viaticos';
			$tb15	='viaticos_c';
			$tb8	='diesel';
			$tb16	='diesel_c';
			$tb11	='ryr';
			$tb18	='ryr_c';
			$tb12	='guias';
			$tb19	='guias_c';
			$tb13	='maniobras';
			$tb20	='maniobras_c';
			$tb22	='km';
			$tb23	='update1';
			$tb26	='placas';
			//tablas_v1::info(empresa,folio);
			if($tb==$tb1){//folio
				$traducion="manual";
				$array_mysql 	= array(
					"ID_G"			=> 	'ID_G',
					"CLIENTE"		=>	'CLIENTE',
					"PLACAS"		=>	'PLACAS',
					"CHOFER"		=>	'CHOFER',
					"Descripcion"	=>	'Descripcion',
					"Revisado"		=>	'Revisado',
					"Difer_1"		=>	'Difer_1',
					"Carta1"		=>	'Carta1',
					"Carta2"		=>	'Carta2',
					"Carta3"		=>	'Carta3',
					"Carta4"		=>	'Carta4',
					"N_Cuenta"		=>	'N_Cuenta',
					"sueldo"		=>	'sueldo',
					"isr"			=>	'isr');
				$array_name 	= array(
					"ID_G"			=> 	'Carta1',
					"CLIENTE"		=>	'cliente',
					"PLACAS"		=>	'placas',
					"CHOFER"		=>	'chofer',
					"Descripcion"	=>	'come',
					"Revisado"		=>	'CambRevi',
					"Difer_1"		=>	'Difer_1',
					"Carta1"		=>	'Carta1',
					"Carta2"		=>	'Carta2',
					"Carta3"		=>	'Carta3',
					"Carta4"		=>	'Carta4',
					"N_Cuenta"		=>	'n_c',
					"sueldo"		=>	'sueldo',
					"isr"			=>	'isr');
				$array_inter 	= array(
					"ID_G"			=> 	"Codigo G",
					"CLIENTE"		=>	'Cliente',
					"PLACAS"		=>	'Unidad',
					"CHOFER"		=>	'Operador',
					"Descripcion"	=>	'Descripcion',
					"Revisado"		=>	'Estado',
					"Difer_1"		=>	'Diferencia',
					"Carta1"		=>	"Carta Porte 1",
					"Carta2"		=>	"Carta Porte 2",
					"Carta3"		=>	"Carta Porte 3",
					"Carta4"		=>	"Carta Porte 4",
					"N_Cuenta"		=>	"N° Cuenta",
					"sueldo"		=>	'Sueldo',
					"isr"			=>	'Retencion');
				$array_none		= array('','','','','','','','','','','','','','');//11
				$array_update	= array('','','','','','','','','','','','','','');//11
				$array_insert	= array('','','','','','','','','','','','','','');//11
				$array_size 	= array(
					"ID_G"			=> 	"10",
					"CLIENTE"		=>	"25",
					"PLACAS"		=>	"6",
					"CHOFER"		=>	"25",
					"Descripcion"	=>	"200",
					"Revisado"		=>	"5",
					"Difer_1"		=>	"15",
					"Carta1"		=>	"10",
					"Carta2"		=>	"10",
					"Carta3"		=>	"10",
					"Carta4"		=>	"10",
					"N_Cuenta"		=>	"4",
					"sueldo"		=>	"15",
					"isr"			=>	"15");
				$datos_encontrados=true;
				
			}
			if($tb==$tb2){//abo_acu
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					'add_en'=>'add_en',
					'Hide_ac'=>'Hide_ac',
					'ID_ac1'=>'ID_ac1',
					'ID_ac2'=>'ID_ac2',
					'ID_ac3'=>'ID_ac3',
					'ID_ac4'=>'ID_ac4',
					'ID_ac5'=>'ID_ac5',
					'ac1'=>'ac1',
					'ac2'=>'ac2',
					'ac3'=>'ac3',
					'ac4'=>'ac4',
					'ac5'=>'ac5',
					'Hide_ab'=>'Hide_ab',
					'ab1'=>'ab1',
					'ab2'=>'ab2',
					'ab3'=>'ab3',
					'ab4'=>'ab4',
					'ab5'=>'ab5',
					'ab_Com1'=>'ab_Com1',
					'ab_Com2'=>'ab_Com2',
					'ab_Com3'=>'ab_Com3',
					'ab_Com4'=>'ab_Com4',
					'ab_Com5'=>'ab_Com5',
					'dif1'=>'dif1',
					'Totalac'=>'Totalac',
					'Totalab'=>'Totalab',
					'Total_Total'=>'Total_Total',
					'rete'=>'rete'
				);
				#$array_name		= array('Carta1','add_en','Hide_ac','ID_ac1','ID_ac2','ID_ac3','ID_ac4','ID_ac5','ac1','ac2','ac3','ac4','ac5','Hide_ab','ab1','ab2','ab3','ab4','ab5','ab_Com1','ab_Com2','ab_Com3','ab_Com4','ab_Com5','dif1','Totalac','Totalab','Total_Total','rete');
				$array_name	= array(
					'ID_G'=>'Carta1',
					'add_en'=>'add_en',
					'Hide_ac'=>'hidden_ac',
					'ID_ac1'=>'ID_ac1',
					'ID_ac2'=>'ID_ac2',
					'ID_ac3'=>'ID_ac3',
					'ID_ac4'=>'ID_ac4',
					'ID_ac5'=>'ID_ac5',
					'ac1'=>'ac1',
					'ac2'=>'ac2',
					'ac3'=>'ac3',
					'ac4'=>'ac4',
					'ac5'=>'ac5',
					'Hide_ab'=>'hidden_ab',
					'ab1'=>'ab1',
					'ab2'=>'ab2',
					'ab3'=>'ab3',
					'ab4'=>'ab4',
					'ab5'=>'ab5',
					'ab_Com1'=>'ab_Com1',
					'ab_Com2'=>'ab_Com2',
					'ab_Com3'=>'ab_Com3',
					'ab_Com4'=>'ab_Com4',
					'ab_Com5'=>'ab_Com5',
					'dif1'=>'dif1',
					'Totalac'=>'Totalac',
					'Totalab'=>'Totalab',
					'Total_Total'=>'Total_Total',
					'rete'=>'rete'
				);
				$array_inter 	= array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','');;
				$array_none		= array('','1','','','','','','','','','','','','','','','','','','','','','','','','','','','');
				$array_insert	= array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
				$array_update	= array('','1','','','','','','','','','','','','','','','','','','','','','','','','','','','');
				$array_size		= array('4','4','4','4','4','4','4','4','15','15','15','15','15','4','15','15','15','15','15','30','30','30','30','30','10','15','15','15','10');
				$datos_encontrados=true;
				
			}
			if($tb==$tb3){//casetas
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'Carta1',
					'HIDE4'=>'HIDE4',
					'TOTAL4'=>'TOTAL4',
					"4TEXT1"=>'4TEXT1',
					"4TEXT2"=>'4TEXT2',
					"4TEXT3"=>'4TEXT3',
					"4TEXT4"=>'4TEXT4',
					"4TEXT5"=>'4TEXT5',
					"4TEXT6"=>'4TEXT6',
					"4TEXT7"=>'4TEXT7',
					"4TEXT8"=>'4TEXT8',
					"4TEXT9"=>'4TEXT9',
					"4TEXT10"=>'4TEXT10',
					"4TEXT11"=>'4TEXT11',
					"4TEXT12"=>'4TEXT12',
					"4TEXT13"=>'4TEXT13',
					"4TEXT14"=>'4TEXT14',
					"4TEXT15"=>'4TEXT15',
					"4TEXT16"=>'4TEXT16',
					"4TEXT17"=>'4TEXT17',
					"4TEXT18"=>'4TEXT18',
					"4TEXT19"=>'4TEXT19',
					"4TEXT20"=>'4TEXT20'
				);
				$array_name 	= array(
					'ID_G'=>'Carta1',
					'HIDE4'=>'HIDE4',
					'TOTAL4'=>'TOTAL4',
					"4TEXT1"=>'4TEXT1',
					"4TEXT2"=>'4TEXT2',
					"4TEXT3"=>'4TEXT3',
					"4TEXT4"=>'4TEXT4',
					"4TEXT5"=>'4TEXT5',
					"4TEXT6"=>'4TEXT6',
					"4TEXT7"=>'4TEXT7',
					"4TEXT8"=>'4TEXT8',
					"4TEXT9"=>'4TEXT9',
					"4TEXT10"=>'4TEXT10',
					"4TEXT11"=>'4TEXT11',
					"4TEXT12"=>'4TEXT12',
					"4TEXT13"=>'4TEXT13',
					"4TEXT14"=>'4TEXT14',
					"4TEXT15"=>'4TEXT15',
					"4TEXT16"=>'4TEXT16',
					"4TEXT17"=>'4TEXT17',
					"4TEXT18"=>'4TEXT18',
					"4TEXT19"=>'4TEXT19',
					"4TEXT20"=>'4TEXT20'
				);
				$array_none		= array('','','','','','','','','','','','','','','','','','','','','','','');
				$array_inter	= array('','','','','','','','','','','','','','','','','','','','','','','');//21 
				$array_insert	= array('','','','','','','','','','','','','','','','','','','','','','','');//21
				$array_update	= array('','1','','','','','','','','','','','','','','','','','','','','','');//21
				$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
				
			}
			if($tb==$tb4){//casetas_c
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'Carta1',
					"4TEXT1"=>'4TEXT1',
					"4TEXT2"=>'4TEXT2',
					"4TEXT3"=>'4TEXT3',
					"4TEXT4"=>'4TEXT4',
					"4TEXT5"=>'4TEXT5',
					"4TEXT6"=>'4TEXT6',
					"4TEXT7"=>'4TEXT7',
					"4TEXT8"=>'4TEXT8',
					"4TEXT9"=>'4TEXT9',
					"4TEXT10"=>'4TEXT10',
					"4TEXT11"=>'4TEXT11',
					"4TEXT12"=>'4TEXT12',
					"4TEXT13"=>'4TEXT13',
					"4TEXT14"=>'4TEXT14',
					"4TEXT15"=>'4TEXT15',
					"4TEXT16"=>'4TEXT16',
					"4TEXT17"=>'4TEXT17',
					"4TEXT18"=>'4TEXT18',
					"4TEXT19"=>'4TEXT19',
					"4TEXT20"=>'4TEXT20'
				);
				$array_name 	= array(
					'ID_G'=>'Carta1',
					"4TEXT1"=>'4TEXT_C1',
					"4TEXT2"=>'4TEXT_C2',
					"4TEXT3"=>'4TEXT_C3',
					"4TEXT4"=>'4TEXT_C4',
					"4TEXT5"=>'4TEXT_C5',
					"4TEXT6"=>'4TEXT_C6',
					"4TEXT7"=>'4TEXT_C7',
					"4TEXT8"=>'4TEXT_C8',
					"4TEXT9"=>'4TEXT_C9',
					"4TEXT10"=>'4TEXT_C10',
					"4TEXT11"=>'4TEXT_C11',
					"4TEXT12"=>'4TEXT_C12',
					"4TEXT13"=>'4TEXT_C13',
					"4TEXT14"=>'4TEXT_C14',
					"4TEXT15"=>'4TEXT_C15',
					"4TEXT16"=>'4TEXT_C16',
					"4TEXT17"=>'4TEXT_C17',
					"4TEXT18"=>'4TEXT_C18',
					"4TEXT19"=>'4TEXT_C19',
					"4TEXT20"=>'4TEXT_C20'
				);
				$array_inter 	=array();
				$array_none 	= array('','','','','','','','','','','','','','','','','','','','','');
				$array_insert	= array('','','','','','','','','','','','','','','','','','','','','');
				$array_update	= array('','1','','','','','','','','','','','','','','','','','','','');
				$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
				
			}
			if($tb==$tb5){//casetas_via
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'Carta1',
					'HIDE'=>'HIDE',
					'TOTAL'=>'TOTAL',
					"TEXT1"=>'TEXT1',
					"TEXT2"=>'TEXT2',
					"TEXT3"=>'TEXT3',
					"TEXT4"=>'TEXT4',
					"TEXT5"=>'TEXT5',
					"TEXT6"=>'TEXT6',
					"TEXT7"=>'TEXT7',
					"TEXT8"=>'TEXT8',
					"TEXT9"=>'TEXT9',
					"TEXT10"=>'TEXT10',
					"TEXT11"=>'TEXT11',
					"TEXT12"=>'TEXT12',
					"TEXT13"=>'TEXT13',
					"TEXT14"=>'TEXT14',
					"TEXT15"=>'TEXT15',
					"TEXT16"=>'TEXT16',
					"TEXT17"=>'TEXT17',
					"TEXT18"=>'TEXT18',
					"TEXT19"=>'TEXT19',
					"TEXT20"=>'TEXT20'
				);
				$array_name 	= array(
					'ID_G'=>'Carta1',
					'HIDE'=>'hidden_c_via',
					'TOTAL'=>'TOTAL',
					"TEXT1"=>'TEXT1',
					"TEXT2"=>'TEXT2',
					"TEXT3"=>'TEXT3',
					"TEXT4"=>'TEXT4',
					"TEXT5"=>'TEXT5',
					"TEXT6"=>'TEXT6',
					"TEXT7"=>'TEXT7',
					"TEXT8"=>'TEXT8',
					"TEXT9"=>'TEXT9',
					"TEXT10"=>'TEXT10',
					"TEXT11"=>'TEXT11',
					"TEXT12"=>'TEXT12',
					"TEXT13"=>'TEXT13',
					"TEXT14"=>'TEXT14',
					"TEXT15"=>'TEXT15',
					"TEXT16"=>'TEXT16',
					"TEXT17"=>'TEXT17',
					"TEXT18"=>'TEXT18',
					"TEXT19"=>'TEXT19',
					"TEXT20"=>'TEXT20'
				);
				$array_none	= array('','','','','','','','','','','','','','','','','','','','','','','');
				$array_insert	= array('','','','','','','','','','','','','','','','','','','','','','','');//23
				$array_update	= array('','1','','','','','','','','','','','','','','','','','','','','','');//23
				$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
				
				
			}
			if($tb==$tb6){//fletes
				$traducion="manual";
				
				$array_mysql	= array(
				"ID_G"		=> 	"ID_G",
				"HIDE1"		=> 	"HIDE1",
				"TOTAL1"	=> 	"TOTAL1",
				"1TEXT1"	=> 	"1TEXT1",
				"1TEXT2"	=> 	"1TEXT2",
				"1TEXT3"	=> 	"1TEXT3",
				"1TEXT4"	=> 	"1TEXT4",
				"1TEXT5"	=> 	"1TEXT5",
				"Flete_R"	=> 	"Flete_R",
				"comi_ass"	=> 	"comi_ass");					
				$array_name 	= array(
				"ID_G"		=> 	"Carta1",
				"HIDE1"		=> 	"hidden_fe",
				"TOTAL1"	=> 	"TOTAL1",
				"1TEXT1"	=> 	"1TEXT1",
				"1TEXT2"	=> 	"1TEXT2",
				"1TEXT3"	=> 	"1TEXT3",
				"1TEXT4"	=> 	"1TEXT4",
				"1TEXT5"	=> 	"1TEXT5",
				"Flete_R"	=> 	"flete_r",
				"comi_ass"	=> 	"comi");	
				$array_inter 	= array(
				"ID_G"		=> 	"",
				"HIDE1"		=> 	"",
				"TOTAL1"	=> 	"",
				"1TEXT1"	=> 	"",
				"1TEXT2"	=> 	"",
				"1TEXT3"	=> 	"",
				"1TEXT4"	=> 	"",
				"1TEXT5"	=> 	"",
				"Flete_R"	=> 	"Flete Real",
				"comi_ass"	=> 	"Comision");	
				$array_none		= array('','','','','','','','','','');//10
				$array_insert	= array('','','','','','','','','','');//10
				$array_update	= array('','','','','','','','','','');//10
				$array_size 	= array(
				"ID_G"		=> 	"4",
				"HIDE1"		=> 	"2",
				"TOTAL1"	=> 	"15",
				"1TEXT1"	=> 	"15",
				"1TEXT2"	=> 	"15",
				"1TEXT3"	=> 	"15",
				"1TEXT4"	=> 	"15",
				"1TEXT5"	=> 	"15",
				"Flete_R"	=> 	"15",
				"comi_ass"	=> 	"15");	
				
			}
			if($tb==$tb7){//viaticos
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					'HIDE2'=>'HIDE2',
					'TOTAL2'=>'TOTAL2',
					"2TEXT1"=>'2TEXT1',
					"2TEXT2"=>'2TEXT2',
					"2TEXT3"=>'2TEXT3',
					"2TEXT4"=>'2TEXT4',
					"2TEXT5"=>'2TEXT5'
				);
				$array_none		= array('','','','','','','','');//8
				$array_insert	= array('','','','','','','','');//8
				$array_update	= array('','','','','','','','');//8
				$array_name 	= array(
					'ID_G'=>'Carta1',
					'HIDE2'=>'hidden_v',
					'TOTAL2'=>'TOTAL2',
					"2TEXT1"=>'2TEXT1',
					"2TEXT2"=>'2TEXT2',
					"2TEXT3"=>'2TEXT3',
					"2TEXT4"=>'2TEXT4',
					"2TEXT5"=>'2TEXT5'
				);
				
			}
			if($tb==$tb8){//diesel
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					'HIDE3'=>'HIDE3',
					'TOTAL3'=>'TOTAL3',
					"3TEXT1"=>'3TEXT1',
					"3TEXT2"=>'3TEXT2',
					"3TEXT3"=>'3TEXT3',
					"3TEXT4"=>'3TEXT4',
					"3TEXT5"=>'3TEXT5',
					"3TEXT6"=>'3TEXT6',
					"3TEXT7"=>'3TEXT7',
					'presio_d'=>'presio_d',
					'medidor_inicio'=>'medidor_inicio',
					'medidor_final'=>'medidor_final'
				);
				$array_none		= array('','','','','','','','','','','','','');//13
				$array_insert	= array('','','','','','','','','','','','','');//13	
				$array_update	= array('','','','','','','','','','','','','');//13	
				$array_name 	= array(
					'ID_G'=>'Carta1',
					'HIDE3'=>'hidden_d',
					'TOTAL3'=>'TOTAL3',
					"3TEXT1"=>'3TEXT1',
					"3TEXT2"=>'3TEXT2',
					"3TEXT3"=>'3TEXT3',
					"3TEXT4"=>'3TEXT4',
					"3TEXT5"=>'3TEXT5',
					"3TEXT6"=>'3TEXT6',
					"3TEXT7"=>'3TEXT7',
					'presio_d'=>'presio_d',
					'medidor_inicio'=>'crome_i',
					'medidor_final'=>'crome_f'
				);
				$datos_encontrados=true;
				
			}
			if($tb==$tb10){//facturas
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					'HIDE5'=>'HIDE5',
					'TOTAL5'=>'TOTAL5',
					"5TEXT1"=>'5TEXT1',
					"5TEXT2"=>'5TEXT2',
					"5TEXT3"=>'5TEXT3',
					"5TEXT4"=>'5TEXT4',
					"5TEXT5"=>'5TEXT5'
				);
				$array_none		= array('','','','','','','','');//8
				$array_insert	= array('','','','','','','','');//8
				$array_update	= array('','','','','','','','');//8
				$array_name 	= array(
					'ID_G'=>'Carta1',
					'HIDE5'=>'hidden_f',
					'TOTAL5'=>'TOTAL5',
					"5TEXT1"=>'5TEXT1',
					"5TEXT2"=>'5TEXT2',
					"5TEXT3"=>'5TEXT3',
					"5TEXT4"=>'5TEXT4',
					"5TEXT5"=>'5TEXT5'
				);
				
			}
			if($tb==$tb11){//ryr
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					'HIDE6'=>'HIDE6',
					'TOTAL6'=>'TOTAL6',
					"6TEXT1"=>'6TEXT1',
					"6TEXT2"=>'6TEXT2',
					"6TEXT3"=>'6TEXT3',
					"6TEXT4"=>'6TEXT4',
					"6TEXT5"=>'6TEXT5',
					"6TEXT6"=>'6TEXT6',
					"6TEXT7"=>'6TEXT7',
					"6TEXT8"=>'6TEXT8',
					"6TEXT9"=>'6TEXT9',
					"6TEXT10"=>'6TEXT10'
				);
				$array_none		= array('','','','','','','','','','','','','');//13
				$array_insert	= array('','','','','','','','','','','','','');//13
				$array_update	= array('','','','','','','','','','','','','');//13
				$array_name 	= array(
					'ID_G'=>'Carta1',
					'HIDE6'=>'hidden_r',
					'TOTAL6'=>'TOTAL6',
					"6TEXT1"=>'6TEXT1',
					"6TEXT2"=>'6TEXT2',
					"6TEXT3"=>'6TEXT3',
					"6TEXT4"=>'6TEXT4',
					"6TEXT5"=>'6TEXT5',
					"6TEXT6"=>'6TEXT6',
					"6TEXT7"=>'6TEXT7',
					"6TEXT8"=>'6TEXT8',
					"6TEXT9"=>'6TEXT9',
					"6TEXT10"=>'6TEXT10'
				);
			}
			if($tb==$tb12){//guias
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					'HIDE7'=>'HIDE7',
					'TOTAL7'=>'TOTAL7',
					"7TEXT1"=>'7TEXT1',
					"7TEXT2"=>'7TEXT2',
					"7TEXT3"=>'7TEXT3',
					"7TEXT4"=>'7TEXT4',
					"7TEXT5"=>'7TEXT5'
				);
				$array_none		= array('','','','','','','','');//8
				$array_insert	= array('','','','','','','','');//8
				$array_update	= array('','','','','','','','');//8
				$array_name 	= array(
					'ID_G'=>'Carta1',
					'HIDE7'=>'hidden_g',
					'TOTAL7'=>'TOTAL7',
					"7TEXT1"=>'7TEXT1',
					"7TEXT2"=>'7TEXT2',
					"7TEXT3"=>'7TEXT3',
					"7TEXT4"=>'7TEXT4',
					"7TEXT5"=>'7TEXT5');
				
			}
			if($tb==$tb13){//maniobras
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					'HIDE8'=>'HIDE8',
					'TOTAL8'=>'TOTAL8',
					"8TEXT1"=>'8TEXT1',
					"8TEXT2"=>'8TEXT2',
					"8TEXT3"=>'8TEXT3',
					"8TEXT4"=>'8TEXT4',
					"8TEXT5"=>'8TEXT5',
					"8TEXT6"=>'8TEXT6');
				$array_none		= array('','','','','','','','','');//9
				$array_insert	= array('','','','','','','','','');//9
				$array_update	= array('','','','','','','','','');//9
				$array_name 	= array(
					'ID_G'=>'Carta1',
					'HIDE8'=>'hidden_g',
					'TOTAL8'=>'TOTAL8',
					"8TEXT1"=>'8TEXT1',
					"8TEXT2"=>'8TEXT2',
					"8TEXT3"=>'8TEXT3',
					"8TEXT4"=>'8TEXT4',
					"8TEXT5"=>'8TEXT5',
					"8TEXT6"=>'8TEXT6');
				
			}
			if($tb==$tb14){//fletes_c
				$traducion="auto";
				$array_mysql	= array(
					"ID_G"		=> 	"ID_G",
					"HIDE1"		=> 	"HIDE1",
					"TOTAL1"	=> 	"TOTAL1",
					"1TEXT1"	=> 	"1TEXT1",
					"1TEXT2"	=> 	"1TEXT2",
					"1TEXT3"	=> 	"1TEXT3",
					"1TEXT4"	=> 	"1TEXT4",
					"1TEXT5"	=> 	"1TEXT5");
				$array_none		= array('','','','','','');//6
				$array_insert	= array('','','','','','');//6
				$array_update	= array('','','','','','');//6
				$array_name 	= array(
					"ID_G"		=> 	"ID_G",
					"1TEXT1"	=> 	"1TEXT_C1",
					"1TEXT2"	=> 	"1TEXT_C2",
					"1TEXT3"	=> 	"1TEXT_C3",
					"1TEXT4"	=> 	"1TEXT_C4",
					"1TEXT5"	=> 	"1TEXT_C5");
				
			}
			if($tb==$tb15){//viaticos_c
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					"2TEXT1"=>'2TEXT1',
					"2TEXT2"=>'2TEXT2',
					"2TEXT3"=>'2TEXT3',
					"2TEXT4"=>'2TEXT4',
					"2TEXT5"=>'2TEXT5'
				);
				$array_none		= array('','','','','','');//6
				$array_insert	= array('','','','','','');//6
				$array_update	= array('','','','','','');//6
				$array_name 	= array(
					'ID_G'=>'ID_G',
					"2TEXT1"=>'2TEXT_C1',
					"2TEXT2"=>'2TEXT_C2',
					"2TEXT3"=>'2TEXT_C3',
					"2TEXT4"=>'2TEXT_C4',
					"2TEXT5"=>'2TEXT_C5'
				);
				
			}
			if($tb==$tb16){//diesel_c
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					"3TEXT1"=>'3TEXT1',
					"3TEXT2"=>'3TEXT2',
					"3TEXT3"=>'3TEXT3',
					"3TEXT4"=>'3TEXT4',
					"3TEXT5"=>'3TEXT5',
					"3TEXT6"=>'3TEXT6',
					"3TEXT7"=>'3TEXT7'
				);
				$array_none		= array('','','','','','','','');//8
				$array_insert	= array('','','','','','','','');//8
				$array_update	= array('','','','','','','','');//8
				$array_name 	= array(
					'ID_G'=>'Carta1',
					"3TEXT1"=>'3TEXT_C1',
					"3TEXT2"=>'3TEXT_C2',
					"3TEXT3"=>'3TEXT_C3',
					"3TEXT4"=>'3TEXT_C4',
					"3TEXT5"=>'3TEXT_C5',
					"3TEXT6"=>'3TEXT_C6',
					"3TEXT7"=>'3TEXT_C7'
				);
			}
			if($tb==$tb17){//facturas_c
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					"5TEXT1"=>'5TEXT1',
					"5TEXT2"=>'5TEXT2',
					"5TEXT3"=>'5TEXT3',
					"5TEXT4"=>'5TEXT4',
					"5TEXT5"=>'5TEXT5'
				);
				$array_none		= array('','','','','','');//6
				$array_insert	= array('','','','','','');//6
				$array_update	= array('','','','','','');//6
				$array_name 	= array(
					'ID_G'=>'Carta1',
					"5TEXT1"=>'5TEXT1',
					"5TEXT2"=>'5TEXT2',
					"5TEXT3"=>'5TEXT3',
					"5TEXT4"=>'5TEXT4',
					"5TEXT5"=>'5TEXT5'
				);
				
			}
			if($tb==$tb18){//ryr_c
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					"6TEXT1"=>'6TEXT1',
					"6TEXT2"=>'6TEXT2',
					"6TEXT3"=>'6TEXT3',
					"6TEXT4"=>'6TEXT4',
					"6TEXT5"=>'6TEXT5',
					"6TEXT6"=>'6TEXT6',
					"6TEXT7"=>'6TEXT7',
					"6TEXT8"=>'6TEXT8',
					"6TEXT9"=>'6TEXT9',
					"6TEXT10"=>'6TEXT10'
				);
				$array_none		= array('','','','','','','','','','','');//11
				$array_insert	= array('','','','','','','','','','','');//11
				$array_update	= array('','','','','','','','','','','');//11
				$array_name 	= array(
					'ID_G'=>'Carta1',
					"6TEXT1"=>'6TEXT_C1',
					"6TEXT2"=>'6TEXT_C2',
					"6TEXT3"=>'6TEXT_C3',
					"6TEXT4"=>'6TEXT_C4',
					"6TEXT5"=>'6TEXT_C5',
					"6TEXT6"=>'6TEXT_C6',
					"6TEXT7"=>'6TEXT_C7',
					"6TEXT8"=>'6TEXT_C8',
					"6TEXT9"=>'6TEXT_C9',
					"6TEXT10"=>'6TEXT_C10'
				);
			}
			if($tb==$tb19){//guias_c
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					"7TEXT1"=>'7TEXT1',
					"7TEXT2"=>'7TEXT2',
					"7TEXT3"=>'7TEXT3',
					"7TEXT4"=>'7TEXT4',
					"7TEXT5"=>'7TEXT5'
				);
				$array_none		= array('','','','','','');//6
				$array_insert	= array('','','','','','');//6
				$array_update	= array('','','','','','');//6
				$array_name 	= array(
					'ID_G'=>'ID_G',
					"7TEXT1"=>'7TEXT_C1',
					"7TEXT2"=>'7TEXT_C2',
					"7TEXT3"=>'7TEXT_C3',
					"7TEXT4"=>'7TEXT_C4',
					"7TEXT5"=>'7TEXT_C5'
				);
				
			}
			if($tb==$tb20){//maniobras_c
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'ID_G',
					"8TEXT1"=>'8TEXT1',
					"8TEXT2"=>'8TEXT2',
					"8TEXT3"=>'8TEXT3',
					"8TEXT4"=>'8TEXT4',
					"8TEXT5"=>'8TEXT5',
					"8TEXT6"=>'8TEXT6');
				$array_none		= array('','','','','','','');//7
				$array_insert	= array('','','','','','','');//7
				$array_update	= array('','','','','','','');//7
				$array_name 	= array(
					'ID_G'=>'Carta1',
					"8TEXT1"=>'8TEXT_C1',
					"8TEXT2"=>'8TEXT_C2',
					"8TEXT3"=>'8TEXT_C3',
					"8TEXT4"=>'8TEXT_C4',
					"8TEXT5"=>'8TEXT_C5',
					"8TEXT6"=>'8TEXT_C6');
				
			}
			if($tb==$tb21){//fechas
				$traducion="manual";
				$array_mysql	= array(
					"ID_G"	=> 	"Carta1",
					"D"		=> 	"D",
					"M"		=>	"M",
					"A"		=>	"A",
					"D_r"	=>	"D_r",
					"M_r"	=>	"M_r",
					"A_r"	=>	"A_r",
					"D_c"	=>	"D_c",
					"M_c"	=>	"M_c",
					"A_c"	=>	"A_c",
					"inicio"=>	"inicio",
					'fin'	=>  'fin'
				);	
				
				$array_name 	= array(
					"ID_G"	=> 	"Carta1",
					"D"		=> 	"D",
					"M"		=>	"M",
					"A"		=>	"A",
					"D_r"	=>	"D_r",
					"M_r"	=>	"M_r",
					"A_r"	=>	"A_r",
					"D_c"	=>	"D_c",
					"M_c"	=>	"M_c",
					"A_c"	=>	"A_c",
					"inicio"=>	"inicio",
					"fin"	=>	"fin"
				);
				$array_inter 	= array(
					"ID_G"	=> 	"Carta 1",
					"D"		=> 	"01-31",
					"M"		=>	"01-12",
					"A"		=>	"2015",
					"D_r"	=>	"01-31",
					"M_r"	=>	"01-12",
					"A_r"	=>	"2031",
					"D_c"	=>	"Auto",
					"M_c"	=>	"Auto",
					"A_c"	=>	"Auto",
					"inicio"=>	"inicio"
				);
				$array_none		= array('','','','','','','','','','','','');//12
				$array_insert	= array('','','','','','','','','','','','');//12
				$array_update	= array('','','','','','','','','','','','');//12
				$array_size 	= array(
					"ID_G"	=> 	"4",
					"D"		=> 	"2",
					"M"		=>	"2",
					"A"		=>	"4",
					"D_r"	=>	"2",
					"M_r"	=>	"2",
					"A_r"	=>	"4",
					"D_c"	=>	"2",
					"M_c"	=>	"2",
					"A_c"	=>	"4",
					"inicio"=>	"10"
				);
				
			}
			if($tb==$tb22){//km
				$traducion="manual";
				$array_mysql	= array(
					"ID_G"	=> 	"ID_G",
					"KM_S"	=> 	"KM_S",
					"KM_E"	=>	"KM_E"
				);					
				$array_name 	= array(
					"ID_G"	=> 	"Carta1",
					"KM_S"	=> 	"km_i",
					"KM_E"	=>	"km_f"
				);
				$array_inter 	= array(
					"ID_G"	=> 	"Carta 1",
					"KM_S"	=> 	"Kilometraje de inicio",
					"KM_E"	=>	"Kilometraje de Final"
				);
				$array_none	= array('','','');//3
				$array_insert	= array('','','');//3
				$array_update	= array('','','');//3
				$array_size 	= array(
					"ID_G"	=> 	"4",
					"KM_S"	=> 	"10",
					"KM_E"	=>	"10"
				);					
				$datos_encontrados=true;
				
			}
			if($tb==$tb23){//update1
				$traducion="auto";
				$array_mysql	= array(ID_G	,actua_km);
				$array_name 	= array(Carta1	,km_i);
				
			}
			if($tb==$tb24){//casetas_c_via
				$traducion="auto";
				$array_mysql	= array(
					'ID_G'=>'Carta1',
					"TEXT1"=>'TEXT1',
					"TEXT2"=>'TEXT2',
					"TEXT3"=>'TEXT3',
					"TEXT4"=>'TEXT4',
					"TEXT5"=>'TEXT5',
					"TEXT6"=>'TEXT6',
					"TEXT7"=>'TEXT7',
					"TEXT8"=>'TEXT8',
					"TEXT9"=>'TEXT9',
					"TEXT10"=>'TEXT10',
					"TEXT11"=>'TEXT11',
					"TEXT12"=>'TEXT12',
					"TEXT13"=>'TEXT13',
					"TEXT14"=>'TEXT14',
					"TEXT15"=>'TEXT15',
					"TEXT16"=>'TEXT16',
					"TEXT17"=>'TEXT17',
					"TEXT18"=>'TEXT18',
					"TEXT19"=>'TEXT19',
					"TEXT20"=>'TEXT20'
				);
				$array_name 	= array(
					'ID_G'=>'Carta1',
					"TEXT1"=>'9TEXT_C1',
					"TEXT2"=>'9TEXT_C2',
					"TEXT3"=>'9TEXT_C3',
					"TEXT4"=>'9TEXT_C4',
					"TEXT5"=>'9TEXT_C5',
					"TEXT6"=>'9TEXT_C6',
					"TEXT7"=>'9TEXT_C7',
					"TEXT8"=>'9TEXT_C8',
					"TEXT9"=>'9TEXT_C9',
					"TEXT10"=>'9TEXT_C10',
					"TEXT11"=>'9TEXT_C11',
					"TEXT12"=>'9TEXT_C12',
					"TEXT13"=>'9TEXT_C13',
					"TEXT14"=>'9TEXT_C14',
					"TEXT15"=>'9TEXT_C15',
					"TEXT16"=>'9TEXT_C16',
					"TEXT17"=>'9TEXT_C17',
					"TEXT18"=>'9TEXT_C18',
					"TEXT19"=>'9TEXT_C19',
					"TEXT20"=>'9TEXT_C20'
				);
				$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
				$array_insert	= array('','','','','','','','','','','','','','','','','','','','','');//21
				$array_update	= array('','1','','','','','','','','','','','','','','','','','','','');//21
				$array_none	= array('','','','','','','','','','','','','','','','','','','','','');//21
				
			}
			if($tb==$tb25){//choferes
				$traducion		="auto";
				$array_mysql	= array(ID_Ch	,Nombre_Ch,Edad,Direccion, Celular,ulti_viaje,Estatus,N_Fact);
				$array_name 	= array(ID_Ch	,chofer,Edad,Direccion,Celular,ulti_viaje,Estatus,N_Fact);
				$array_none		= array('1','','','','','','','');//7
				$array_insert	= array('1','','','','','','','');
				$array_update	= array('1','','','','','1','1','1');
				$array_size		= array(2,50,2,25,10,4,1);
				
			
			}
			if($tb==$tb26){//placas
				
				$traducion		="auto";
				$array_mysql	= array(ID_Pl	,Placas,Marca,Modelo, N_eco,Color);
				$array_name 	= array(ID_Pl	,placas,Marca,Modelo, N_eco,Color);
				$array_none		= array('1','','','','','');//5
				$array_insert	= array('1','','','','','');
				$array_update	= array('1','','','','','');
				$array_size		= array(4,15,15,10,15);
			}	
			if($tb==$tb27){//clientes
				
				$traducion		="auto";
				$array_mysql	= array(ID_Cl	,Nombre_Cl,Fecha_re,Destino, N_fact);
				$array_name		= array(ID_Cl	,cliente,Fecha_re,destino,N_fact);
				$array_none		= array('1','','','','');//5
				$array_insert	= array('1','','','','');
				$array_update	= array('1','','1','','1');
				$array_size		= array(2,25,15,5);
			}
			
		}
		if($db==$db2){
			$tb1=folio;
			$tb2=abo_acu;
			$tb3=casetas;
			$tb4=casetas_c;
			$tb5=casetas_via;
			$tb6=fletes;
			$tb7=viaticos;
			$tb8=disel;
			$tb10=facturas;
			$tb11=ryr;
			$tb12=guias;
			$tb13=maniobras;
			$tb14=fletes_c;
			$tb15=viaticos_c;
			$tb16=disel_c;
			$tb17=facturas_c;
			$tb18=ryr_c;
			$tb19=guias_c;
			$tb20=maniobras_c;
			$tb21=fechas;
			$tb22=km;
			$tb23=update1;
			$tb24=casetas_c_via;
			$tb25=choferes;
			//tablas_v1::info(empresa,folio);
			if($tb==$tb1){//folio
				$traducion="manual";
				$array_mysql 	= array(
				"ID_G"			=> 	ID_G,
				"CLIENTE"		=>	CLIENTE,
				"PLACAS"		=>	PLACAS,
				"CHOFER"		=>	CHOFER,
				"Descripcion"	=>	Descripcion,
				"Revisado"		=>	Revisado,
				"Difer_1"		=>	Difer_1,
				"Carta1"		=>	Carta1,
				"Carta2"		=>	Carta2,
				"Carta3"		=>	Carta3,
				"Carta4"		=>	Carta4,
				"N_Cuenta"		=>	N_Cuenta,
				"sueldo"		=>	sueldo,
				"isr"			=>	isr);
				$array_name 	= array(
				"ID_G"			=> 	Carta1,
				"CLIENTE"		=>	cliente,
				"PLACAS"		=>	placas,
				"CHOFER"		=>	chofer,
				"Descripcion"	=>	come,
				"Revisado"		=>	CambRevi,
				"Difer_1"		=>	Difer_1,
				"Carta1"		=>	Carta1,
				"Carta2"		=>	Carta2,
				"Carta3"		=>	Carta3,
				"Carta4"		=>	Carta4,
				"N_Cuenta"		=>	n_c,
				"sueldo"		=>	sueldo,
				"isr"			=>	isr);
				$array_inter 	= array(
				"ID_G"			=> 	"Codigo G",
				"CLIENTE"		=>	Cliente,
				"PLACAS"		=>	Unidad,
				"CHOFER"		=>	Operador,
				"Descripcion"		=>	Descripcion,
				"Revisado"		=>	Estado,
				"Difer_1"		=>	Diferencia,
				"Carta1"		=>	"Carta Porte 1",
				"Carta2"		=>	"Carta Porte 2",
				"Carta3"		=>	"Carta Porte 3",
				"Carta4"		=>	"Carta Porte 4",
				"N_Cuenta"		=>	"N° Cuenta",
				"sueldo"		=>	Sueldo,
				"isr"			=>	Retencion);
				$array_none	= array('','','','','','','','','','','','','','');//11
				$array_size 	= array(
				"ID_G"			=> 	"10",
				"CLIENTE"		=>	"25",
				"PLACAS"		=>	"6",
				"CHOFER"		=>	"25",
				"Descripcion"	=>	"200",
				"Revisado"		=>	"5",
				"Difer_1"		=>	"15",
				"Carta1"		=>	"10",
				"Carta2"		=>	"10",
				"Carta3"		=>	"10",
				"Carta4"		=>	"10",
				"N_Cuenta"		=>	"4",
				"sueldo"		=>	"15",
				"isr"			=>	"15");
				
			}
			if($tb==$tb2){//abo_acu
				$traducion="auto";
				$array_mysql	= array(ID_G,add_en,Hide_ac,ID_ac1,ID_ac2,ID_ac3,ID_ac4,ID_ac5,ac1,ac2,ac3,ac4,ac5,Hide_ab,ab1,ab2,ab3,ab4,ab5,ab_Com1,ab_Com2,ab_Com3,ab_Com4,ab_Com5,dif1,Totalac,Totalab,Total_Total,rete);
				$array_name		= array(Carta1,add_en,Hide_ac,ID_ac1,ID_ac2,ID_ac3,ID_ac4,ID_ac5,ac1,ac2,ac3,ac4,ac5,Hide_ab,ab1,ab2,ab3,ab4,ab5,ab_Com1,ab_Com2,ab_Com3,ab_Com4,ab_Com5,dif1,Totalac,Totalab,Total_Total,rete);
				$array_none		= array('',1,'','','','','','','','','','','','','','','','','','','','','','','','','','','');
				$array_size		= array(4,4,4,4,4,4,4,4,15,15,15,15,15,4,15,15,15,15,15,30,30,30,30,30,10,15,15,15,10);
				
			}
			if($tb==$tb3){//casetas
				$traducion="auto";
				$array_mysql	= array(ID_G,HIDE4,TOTAL4,"4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20");
				$array_name 	= array(Carta1,HIDE4,TOTAL4,"4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20");
				$array_none		= array('','','','','','','','','','','','','','','','','','','','','','','');
				$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
				
			}
			if($tb==$tb4){//casetas_c
				$traducion="auto";
				$array_mysql	= array(ID_G	,"4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20");
				$array_name 	= array(Carta1	,"4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20");
				$array_none 	= array('','','','','','','','','','','','','','','','','','','','','');
				$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
				
			}
			if($tb==$tb5){//casetas_via
				$traducion="auto";
				$array_mysql	= array(ID_G	,HIDE,TOTAL		
					,"TEXT1","TEXT2","TEXT3","TEXT4","TEXT5"
					,"TEXT6","TEXT7","TEXT8","TEXT9","TEXT10"
					,"TEXT11","TEXT12","TEXT13","TEXT14","TEXT15"
					,"TEXT16","TEXT17","TEXT18","TEXT19","TEXT20");
				$array_name 	= array(Carta1	,HIDE9,TOTAL9	
				,"4TEXT_VIA1","4TEXT_VIA2","4TEXT_VIA3","4TEXT_VIA4","4TEXT_VIA5"
				,"4TEXT_VIA6","4TEXT_VIA7","4TEXT_VIA8","4TEXT_VIA9","4TEXT_VIA10"
				,"4TEXT_VIA11","4TEXT_VIA12","4TEXT_VIA3","4TEXT_VIA14","4TEXT_VIA15"
				,"4TEXT_VIA16","4TEXT_VIA17","4TEXT_VIA8","4TEXT_VIA19","4TEXT_VIA20");
				$array_none	= array('','','','','','','','','','','','','','','','','','','','','','','');
				$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
				
				
			}
			if($tb==$tb6){//fletes
				$traducion="manual";
				//$array_mysql	= array(ID_G	,HIDE1,TOTAL1,"1TEXT1","1TEXT2","1TEXT3","1TEXT4","1TEXT5",Flete_R,comi_ass);
				//$array_name 	= array(Carta1	,HIDE1,TOTAL2,"1TEXT1","1TEXT2","1TEXT3","1TEXT4","1TEXT5",flete_r,comi);
				
				$array_mysql	= array(
				"ID_G"		=> 	"ID_G",
				"HIDE1"		=> 	"HIDE1",
				"TOTAL1"	=> 	"TOTAL1",
				"1TEXT1"	=> 	"1TEXT1",
				"1TEXT2"	=> 	"1TEXT2",
				"1TEXT3"	=> 	"1TEXT3",
				"1TEXT4"	=> 	"1TEXT4",
				"1TEXT5"	=> 	"1TEXT5",
				"Flete_R"	=> 	"Flete_R",
				"comi_ass"	=> 	"comi_ass");					
				$array_name 	= array(
				"ID_G"		=> 	"Carta1",
				"HIDE1"		=> 	"HIDE1",
				"TOTAL1"	=> 	"TOTAL1",
				"1TEXT1"	=> 	"1TEXT1",
				"1TEXT2"	=> 	"1TEXT2",
				"1TEXT3"	=> 	"1TEXT3",
				"1TEXT4"	=> 	"1TEXT4",
				"1TEXT5"	=> 	"1TEXT5",
				"Flete_R"	=> 	"flete_r",
				"comi_ass"	=> 	"comi");	
				$array_inter 	= array(
				"ID_G"		=> 	"",
				"HIDE1"		=> 	"",
				"TOTAL1"	=> 	"",
				"1TEXT1"	=> 	"",
				"1TEXT2"	=> 	"",
				"1TEXT3"	=> 	"",
				"1TEXT4"	=> 	"",
				"1TEXT5"	=> 	"",
				"Flete_R"	=> 	"Flete Real",
				"comi_ass"	=> 	"Comision");	
				$array_none	= array('','','','','','','','','','');//10
				$array_size 	= array(
				"ID_G"		=> 	"4",
				"HIDE1"		=> 	"2",
				"TOTAL1"	=> 	"15",
				"1TEXT1"	=> 	"15",
				"1TEXT2"	=> 	"15",
				"1TEXT3"	=> 	"15",
				"1TEXT4"	=> 	"15",
				"1TEXT5"	=> 	"15",
				"Flete_R"	=> 	"15",
				"comi_ass"	=> 	"15");	
				
			}
			if($tb==$tb7){//viaticos
				$traducion="auto";
				$array_mysql	= array(ID_G	,HIDE2,TOTAL2,"2TEXT1","2TEXT2","2TEXT3","2TEXT4","2TEXT5");
				$array_none	= array('','','','','','','','');//8
				$array_name 	= array(Carta1	,HIDE2,TOTAL2,"2TEXT1","2TEXT2","2TEXT3","2TEXT4","2TEXT5");
				
			}
			if($tb==$tb8){//diesel
				$traducion="auto";
				$array_mysql	= array(ID_G	,HIDE3,TOTAL3,"3TEXT1","3TEXT2","3TEXT3","3TEXT4","3TEXT5","3TEXT6","3TEXT7",presio_d);
				$array_none	= array('','','','','','','','','','','');//11
				$array_name 	= array(Carta1	,HIDE3,TOTAL3,"3TEXT1","3TEXT2","3TEXT3","3TEXT4","3TEXT5","3TEXT6","3TEXT7",presio_d);
				
			}
			if($tb==$tb10){//facturas
				$traducion="auto";
				$array_mysql	= array(ID_G	,HIDE5,TOTAL5,"5TEXT1","5TEXT2","5TEXT3","5TEXT4","5TEXT5");
				$array_none		= array('','','','','','','','');//8
				$array_name 	= array(Carta1	,HIDE5,TOTAL5,"5TEXT1","5TEXT2","5TEXT3","5TEXT4","5TEXT5");
				
			}
			if($tb==$tb11){//ryr
				$traducion="auto";
				$array_mysql	= array(ID_G	,HIDE6,TOTAL6,"6TEXT1","6TEXT2","6TEXT3","6TEXT4","6TEXT5","6TEXT6","6TEXT7","6TEXT8","6TEXT9","6TEXT10");
				$array_none		= array('','','','','','','','','','','','','');//13
				$array_name 	= array(Carta1	,HIDE6,TOTAL6,"6TEXT1","6TEXT2","6TEXT3","6TEXT4","6TEXT5","6TEXT6","6TEXT7","6TEXT8","6TEXT9","6TEXT10");
			}
			if($tb==$tb12){//guias
				$traducion="auto";
				$array_mysql	= array(ID_G	,HIDE7,TOTAL7,"7TEXT1","7TEXT2","7TEXT3","7TEXT4","7TEXT5");
				$array_none	= array('','','','','','','','');//8
				$array_name 	= array(Carta1	,HIDE7,TOTAL7,"7TEXT1","7TEXT2","7TEXT3","7TEXT4","7TEXT5");
				
			}
			if($tb==$tb13){//maniobras
				$traducion="auto";
				$array_mysql	= array(ID_G	,HIDE8,TOTAL8,"8TEXT1","8TEXT2","8TEXT3","8TEXT4","8TEXT5","8TEXT6");
				$array_none	= array('','','','','','','','','');//9
				$array_name 	= array(Carta1	,HIDE8,TOTAL8,"8TEXT1","8TEXT2","8TEXT3","8TEXT4","8TEXT5","8TEXT6");
				
			}
			if($tb==$tb14){//fletes_c
				$traducion="auto";
				$array_mysql	= array(ID_G	,"1TEXT1","1TEXT2","1TEXT3","1TEXT4","1TEXT5");
				$array_none	= array('','','','','','');//6
				$array_name 	= array(Carta1	,"1TEXT_C1","1TEXT_C2","1TEXT_C3","1TEXT_C4","1TEXT_C5");
				
			}
			if($tb==$tb15){//viaticos_c
				$traducion="auto";
				$array_mysql	= array(ID_G	,"2TEXT1","2TEXT2","2TEXT3","2TEXT4","2TEXT5");
				$array_none	= array('','','','','','');//6
				$array_name 	= array(Carta1	,"2TEXT_C1","2TEXT_C2","2TEXT_C3","2TEXT_C4","2TEXT_C5");
				
			}
			if($tb==$tb16){//diesel
				$traducion="auto";
				$array_mysql	= array(ID_G	,"3TEXT1","3TEXT2","3TEXT3","3TEXT4","3TEXT5","3TEXT6","3TEXT7");
				$array_none			= array('','','','','','','','');//8
				$array_name 	= array(Carta1	,"3TEXT_C1","3TEXT_C2","3TEXT_C3","3TEXT_C4","3TEXT_C5","3TEXT_C6","3TEXT_C7");
			}
			if($tb==$tb17){//facturas_c
				$traducion="auto";
				$array_mysql	= array(ID_G	,"5TEXT1","5TEXT2","5TEXT3","5TEXT4","5TEXT5");
				$array_none		= array('','','','','','');//8
				$array_name 	= array(Carta1	,"5TEXT_C1","5TEXT_C2","5TEXT_C3","5TEXT_C4","5TEXT_C5");
				
			}
			if($tb==$tb18){//ryr_c
				$traducion="auto";
				$array_mysql	= array(ID_G	,"6TEXT1","6TEXT2","6TEXT3","6TEXT4","6TEXT5","6TEXT6","6TEXT7","6TEXT8","6TEXT9","6TEXT10");					
				$array_none	= array('','','','','','','','','','','');//11
				$array_name 	= array(Carta1	,"6TEXT_C1","6TEXT_C2","6TEXT_C3","6TEXT_C4","6TEXT_C5","6TEXT_C6","6TEXT_C7","6TEXT_C8","6TEXT_C9","6TEXT_C10");
			}
			if($tb==$tb19){//guias
				$traducion="auto";
				$array_mysql	= array(ID_G	,"7TEXT1","7TEXT2","7TEXT3","7TEXT4","7TEXT5");
				$array_none	= array('','','','','','');//6
				$array_name 	= array(Carta1	,"7TEXT_C1","7TEXT_C2","7TEXT_C3","7TEXT_C4","7TEXT_C5");
				
			}
			if($tb==$tb20){//maniobras
				$traducion="auto";
				$array_mysql	= array(ID_G	,"8TEXT1","8TEXT2","8TEXT3","8TEXT4","8TEXT5","8TEXT6");
				$array_none		= array('','','','','','','');//7
				$array_name 	= array(Carta1	,"8TEXT_C1","8TEXT_C2","8TEXT_C3","8TEXT_C4","8TEXT_C5","8TEXT_C6");
				
			}
			if($tb==$tb21){//fechas
				$traducion="manual";
				$array_mysql	= array(
				"ID_G"	=> 	"Carta1",
				"D"		=> 	"D",
				"M"		=>	"M",
				"A"		=>	"A",
				"D_r"	=>	"D_r",
				"M_r"	=>	"M_r",
				"A_r"	=>	"A_r",
				"D_c"	=>	"D_c",
				"M_c"	=>	"M_c",
				"A_c"	=>	"A_c",
				"inicio"=>	"inicio");
				
				$array_name 	= array(
				"ID_G"	=> 	"Carta1",
				"D"		=> 	"D",
				"M"		=>	"M",
				"A"		=>	"A",
				"D_r"	=>	"D_r",
				"M_r"	=>	"M_r",
				"A_r"	=>	"A_r",
				"D_c"	=>	"D_c",
				"M_c"	=>	"M_c",
				"A_c"	=>	"A_c",
				"inicio"=>	"inicio");
				$array_inter 	= array(
				"ID_G"	=> 	"Carta 1",
				"D"		=> 	"01-31",
				"M"		=>	"01-12",
				"A"		=>	"2015",
				"D_r"	=>	"01-31",
				"M_r"	=>	"01-12",
				"A_r"	=>	"2031",
				"D_c"	=>	"Auto",
				"M_c"	=>	"Auto",
				"A_c"	=>	"Auto",
				"inicio"=>	"inicio");
				$array_none	= array('','','','','','','','','','','');//11
				$array_size 	= array(
				"ID_G"	=> 	"4",
				"D"		=> 	"2",
				"M"		=>	"2",
				"A"		=>	"4",
				"D_r"	=>	"2",
				"M_r"	=>	"2",
				"A_r"	=>	"4",
				"D_c"	=>	"2",
				"M_c"	=>	"2",
				"A_c"	=>	"4",
				"inicio"=>	"10");
				
			}
			if($tb==$tb22){//km
				$traducion="manual";
				$array_mysql	= array(
				"ID_G"	=> 	"ID_G",
				"KM_S"	=> 	"KM_S",
				"KM_E"	=>	"KM_E");					
				$array_name 	= array(
				"ID_G"	=> 	"Carta1",
				"KM_S"	=> 	"km_i",
				"KM_E"	=>	"km_f");
				$array_inter 	= array(
				"ID_G"	=> 	"Carta 1",
				"KM_S"	=> 	"Kilometraje de inicio",
				"KM_E"	=>	"Kilometraje de Final");
				$array_none	= array('','','');//11
				$array_size 	= array(
				"ID_G"	=> 	"4",
				"KM_S"	=> 	"10",
				"KM_E"	=>	"10");
				
			}
			if($tb==$tb23){//update1
				$traducion="auto";
				$array_mysql	= array(ID_G	,actua_km);
				$array_name 	= array(Carta1	,km_i);
				
			}
			if($tb==$tb24){//casetas_c_via
				$traducion="auto";
				$array_mysql	= array(ID_G	,
				"TEXT1","TEXT2","TEXT3","TEXT4","TEXT5",
				"TEXT6","TEXT7","TEXT8","TEXT9","TEXT10",
				"TEXT11","TEXT12","TEXT13","TEXT14","TEXT15",
				"TEXT16","TEXT17","TEXT18","TEXT19","TEXT20"
				);
				$array_name 	= array(Carta1	,
				"9TEXT_C1","9TEXT_C2","9TEXT_C3","9TEXT_C4","9TEXT_C5",
				"9TEXT_C6","9TEXT_C7","9TEXT_C8","9TEXT_C9","9TEXT_C10",
				"9TEXT_C11","9TEXT_C12","9TEXT_C13","9TEXT_C14","9TEXT_C15",
				"9TEXT_C16","9TEXT_C17","9TEXT_C18","9TEXT_C19","9TEXT_C20");
				$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
				$array_none	= array('','','','','','','','','','','','','','','','','','','','','');//21
				
			}
			if($tb==$tb25){//choferes
				$traducion		="auto";
				$array_mysql	= array(ID_Ch	,Nombre_Ch,Edad,Direccion, Celular,ulti_viaje,Estatus,N_Fact,inicio,fin);
				$array_name 	= array(ID_Ch	,chofer,Edad,Direccion,Celular,ulti_viaje,Estatus,N_Fact,inicio,fin);
				$array_none		= array('1','','','','','','','','','');//7
				$array_insert	= array('1','','','','','','','','','');
				$array_update	= array('1','','','','','1','1','1','1','1');
				$array_size		= array(2,50,2,25,10,4,5,15,15);				
			}
		
			
		}
		if($db==$db4){
			$tb1=despacho;
			$tb2=estados_de_tanque;
			$tb3=tanques;
			if($tb==$tb1){//despacho
				
				$traducion		="auto";
				$array_mysql	= array(ID_G		,fecha,placas,operador,medidor_inicio,medidor_final,total_despachado,despachado_por);
				$array_name		= array(ID_G	,fecha,placas,chofer,medidor_inicio,medidor_final,total_despachado,nombre);
				$array_none		= array('','','','','','','','');//3
				$array_insert	= array('','','','','','','','');
				$array_update	= array('','','','','','','','');
				$array_size		= array(50,25,25);
				$datos_encontrados=true;
			}
			if($tb==$tb3){//tanques
				
				$traducion		="auto";
				$array_mysql	= array(ID_G	,max_level,act_level);
				$array_name		= array(ID_G_tanque	,Capacidad,level_actua);
				$array_none		= array('','','');//5
				$array_insert	= array('','','');
				$array_update	= array('','','');
				$array_size		= array(50,25,25);
				$datos_encontrados=true;
			}
		}
		if(empty($array_type))$array_type='';
		if(empty($array_id))$array_id='';
		if(empty($array_class))$array_class='';
		if(empty($array_valida))$array_valida='';
		if(empty($array_size))$array_size='';
		if(empty($array_inter))$array_inter='';
		$res			= array(
		"version"	=> "tablas_v2::info",
		"db"	=> $db,
		"tb"	=> $tb,
		"tradu"	=> $traducion,
		"mysql"	=> $array_mysql,
		"none"	=> $array_none,
		"insert"=> $array_insert,//elementos omitidos en los sql 
		"update"=> $array_update,//elementos omitidos en los sql 
		"name"	=> $array_name,
		"inter"	=> $array_inter,
		"size"	=> $array_size,
		"type"	=> $array_type,
		"id"	=> $array_id,
		"clas"	=> $array_class,
		"valid"	=> $array_valida,
		"datos"	=> $datos_encontrados
		);
		return $res;
	}
	
}
?>