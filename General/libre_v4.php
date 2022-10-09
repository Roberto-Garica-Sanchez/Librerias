<?php
if(!include_once("libre_v1.php")){echo"Error De Carga libre v1";}
if(!include_once("libre_v2.php")){echo"Error De Carga libre v2";}

/*
if(!empty($_POST['Soft_version'])=='Ares'){	
	if(($_POST[name2set]=="Nuevo")or($_POST[name2set]=="Modificar")){
		echo"<div id='consola_guarda' class='consola_guarda'style=''>";
			echo "<div onclick='ventanas2(consola_guarda);'style='z-index: 1; position: absolute; width: 20px; height: 17px; background: #ada7a7; float: right; right: 0px; text-align: center;top: 0px;' >X</div>";
			//datos De Configuracion y db
			$db='empresa';
			$array=descarga_db($db,$conexion,$phpv);
			$tb=$array[tablas];
			$colum=$array[columnas];
			$id=$_POST[Carta1];
			$array_deseado	= array(folio,abo_acu,casetas,casetas_c,casetas_via,casetas_c_via,disel,disel_c,fechas,fletes,fletes_c,facturas,facturas_c,viaticos,viaticos_c,ryr,ryr_c,guias,guias_c,maniobras,maniobras_c,km);
			//$array_deseado	= array(km);
			$res_VER_TB2=Verifica_en_tablas2($id,$tb,$array,$array_deseado,$conexion,$phpv);
			Repara_en_tabla($id,'','',$array,$res_VER_TB2,$db,$conexion,$phpv);		//incluse proceso insert	
			Updates($db,$id,$array,$array_deseado,$conexion,$phpv);
			echo"<div style='position: absolute;top: 5px;right: 5px;height: 570px;width: 370px;background: #000000c2;color: white;overflow-y: auto;overflow-x: hidden;'>";
			//---//Actua($id,$conexion,$phpv);
			actua2($id,$conexion,$phpv,1);
			echo"</div>";
		echo"</div>";
	}
	if($_POST[name2set]=="Altas"){
		if($_POST[sub1]=="Operadores"){
			if(($_POST[operador]=="Guardar")and(($grava==true)or($guarda==true))){
				$systm[diagnostico]=false;
				$res=Ares_v1::genera_sql(Nombre_Ch,insert,choferes,$db,$conexion,$phpv,$systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
				$res=Ares_v1::genera_sql(Nombre_Ch,update,choferes,$db,$conexion,$phpv,$systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
				
			}
			if($_POST[operador]=="Guardar Cambios"){
				$systm[diagnostico]=false;
				$res=Ares_v1::genera_sql(Nombre_Ch,update,choferes,$db,$conexion,$phpv,$systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
				///$resc=$resc.$res[sql];//presenda el sql en la consola asignada 
			}
		}
		if($_POST[sub1]=="Vehiculos"){
			if($_POST[operador]=="Guardar"){
				$systm[diagnostico]=false;
				$res=Ares_v1::genera_sql(Placas,insert,placas,$db,$conexion,$phpv,$systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
				$res=Ares_v1::genera_sql(Placas,update,placas,$db,$conexion,$phpv,$systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
			}
			if($_POST[operador]=="Guardar Cambios"){
				$systm[diagnostico]=false;
				$res=Ares_v1::genera_sql(Placas,update,placas,$db,$conexion,$phpv,$systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
			}
			
		}
		if($_POST[sub1]==Clientes){
			if($_POST[operador]=="Guardar"){
				$systm[diagnostico]=false;
				$res=Ares_v1::genera_sql(Nombre_Cl,insert,clientes,$db,$conexion,$phpv,$systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
				$res=Ares_v1::genera_sql(Nombre_Cl,update,clientes,$db,$conexion,$phpv,$systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
			}
			if($_POST[operador]=="Guardar Cambios"){
				$systm[diagnostico]=false;
				$res=Ares_v1::genera_sql(Nombre_Cl,update,clientes,$db,$conexion,$phpv,$systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
			}
		}
	}
	if($_POST[Menu1]=='Combustible'){
		if($_POST[name2set]==Ajustes){
			if($_POST[sub1]==Tanques){	
				if($_POST[operador]=="Guardar"){
					$systm[diagnostico]=false;
					$res=Ares_v1::genera_sql(ID_G,insert,tanques,$db_combustible,$conexion,$phpv,$systm);
					libre_v2::ejecuta($conexion,$res[sql],$phpv);
					
					$res=Ares_v1::genera_sql(ID_G,update,tanques,$db_combustible,$conexion,$phpv,$systm);
					libre_v2::ejecuta($conexion,$res[sql],$phpv);
				}
				if($_POST[operador]=="Guardar Cambios"){
					$systm[diagnostico]=false;
					
					$res=Ares_v1::genera_sql(ID_G,update,tanques,$db_combustible,$conexion,$phpv,$systm);
					libre_v2::ejecuta($conexion,$res[sql],$phpv);
				}
			}
			
		}
		if($_POST[name2set]==Estados){
				if($_POST[operador]=="Guardar"){
					$Consola[open]=true;
					$systm[diagnostico]=false;
					$res=Ares_v1::genera_sql(ID_G,insert,despacho,$db_combustible,$conexion,$phpv,$systm);
					libre_v2::ejecuta($conexion,$res[sql],$phpv);
					$res=Ares_v1::genera_sql(ID_G,update,despacho,$db_combustible,$conexion,$phpv,$systm);
					libre_v2::ejecuta($conexion,$res[sql],$phpv);
				}
		}
	}
}
*/

class libre_v4{
	//$VarName=new libre_v4($phpv,$conexion);
	private $libre_v1;
	private $libre_v2;
	private $Ares_v1;
	private $phpv;
	private $conexion;
	private $database;
	private $tabla;

	private $EstructuraDB;
	private $listaDb;
	private $listaTB;
	private $Datos_tabla;
	private $Columnas;
	private $ColumnasUNI;
	private $KeyColumnUsege;
	private $ExtraColumns;

	private $DATA_TYPE;
	private $CHARACTER_MAXIMUM_LENGTH;
	private $COLUMN_TYPE;
	private $COLUMN_KEY;
	private $EXTRA;

	Private $CRUCE_DE_DATOS;

	public function __construct($phpv,$conexion){	
		$this->libre_v1	=new libre_v1();	
		$this->libre_v2	=new libre_v2($phpv,$conexion);	
		$this->libre_v5	=new libre_v5($phpv,$conexion,'');	
		
		$this->Ares_v1	=new Ares_v1();	
		$this->phpv=$phpv;	
		$this->conexion=$conexion;	
	}
	############################################################3
	public function auto_sql_insert($tb,$name_array,$id){
		if ($id=='')		{echo"<br>[auto_sql_insert]Sin id		";	exit;}
		if ($tb=='')		{echo"<br>[auto_sql_insert]Sin tablas tb";	exit;}
		if ($name_array==''){echo"<br>[auto_sql_insert]Sin name_array";	exit;}
		//if($id<>''){//Crea una Celda vacia
			$sql="INSERT INTO ".$tb." (".$name_array[0];
			for($x=1; $x<count($name_array); $x++){
				$sql=$sql.",".$name_array[$x];
			}
			$sql=$sql.") VALUE ('".$id;
			for($x=1; $x<count($name_array); $x++){
				$sql=$sql."','";
			}
			$sql=$sql."')";
		//}
		return $sql;
	}
	public function RelacionDeTablas($buscaDB,$buscaTabla){	
		$this->database=$buscaDB;
		$this->tabla=$buscaTabla;
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		### todas las relaciones
			$tabla="INNODB_SYS_FOREIGN";
			$getColumnas        = array('*') ;
			$BuscaColumnas      = array('FOR_NAME','REF_NAME') ;
			
			$BuscaDatos         = array("%$buscaTabla%","%$buscaTabla%");
			$Condiciones        = array('');
			$array['All']=array(
				"tabla"=>$tabla,
				"Operacion"=>
				array('SELECT'=>array(
						"Activar"	=>'true',
						"LIKE"		=>'true',
						"getColumnas"	=>$getColumnas,
						"BuscaColumnas"	=>$BuscaColumnas,
						"BuscaDatos"	=>$BuscaDatos,
						"Condiciones"	=>$Condiciones,
						"JOIN"=>array(
							'Inner Join'=>Array(
								'ColumnaUnion'=>'ID',	
								'vinculos'=>array(
									'tabla'=>array('INNODB_SYS_FOREIGN_COLS'),
									'columna'=>array('ID'),
									
								)
							),
							'Left outer Join'=>Array(),

						)
						
					)
				)
			);
			$this->Ares_v1->GeneraSql($array['All']);
			$sql['All']		=$this->Ares_v1->getSql();
			$array['All']	=$this->libre_v2->ejecuta($this->conexion,$sql['All'],$this->phpv);
		### Recibido
			$this->database=$buscaDB;
			$this->tabla=$buscaTabla;
		
			$tabla="INNODB_SYS_FOREIGN";
			$getColumnas        = array('*') ;
			$BuscaColumnas      = array('FOR_NAME') ;
			
			$BuscaDatos         = array("%$buscaTabla%");
			$Condiciones        = array('');
			$array['Recibe']=array(
				"tabla"=>$tabla,
				"Operacion"=>
				array('SELECT'=>array(
						"Activar"	=>'true',
						"LIKE"		=>'true',
						"getColumnas"	=>$getColumnas,
						"BuscaColumnas"	=>$BuscaColumnas,
						"BuscaDatos"	=>$BuscaDatos,
						"Condiciones"	=>$Condiciones,
						"JOIN"=>array(
							'Inner Join'=>Array(
								'ColumnaUnion'=>'ID',	
								'vinculos'=>array(
									'tabla'=>array('INNODB_SYS_FOREIGN_COLS'),
									'columna'=>array('ID'),
									
								)
							),
							#'Left outer Join'=>Array(),

						)
						
					)
				)
			);
			$this->Ares_v1->GeneraSql($array['Recibe']);
			$sql['Recibe']		=$this->Ares_v1->getSql();
			$array['Recibe']	=$this->libre_v2->ejecuta($this->conexion,$sql['Recibe'],$this->phpv);
		### Enviados
			$this->database=$buscaDB;
			$this->tabla=$buscaTabla;
			$tabla="INNODB_SYS_FOREIGN";
			$getColumnas        = array('*') ;
			$BuscaColumnas      = array('REF_NAME') ;
			
			$BuscaDatos         = array("%$buscaTabla%");
			$Condiciones        = array('');
			$array['Envios']=array(
				"tabla"=>$tabla,
				"Operacion"=>
				array('SELECT'=>array(
						"Activar"	=>'true',
						"LIKE"		=>'true',
						"getColumnas"	=>$getColumnas,
						"BuscaColumnas"	=>$BuscaColumnas,
						"BuscaDatos"	=>$BuscaDatos,
						"Condiciones"	=>$Condiciones,
						"JOIN"=>array(
							'Inner Join'=>Array(
								'ColumnaUnion'=>'ID',	
								'vinculos'=>array(
									'tabla'=>array('INNODB_SYS_FOREIGN_COLS'),
									'columna'=>array('ID'),
									
								)
							),
							'Left outer Join'=>Array(),

						)
						
					)
				)
			);		
			$this->Ares_v1->GeneraSql($array['Envios']);
			$sql['Envios']		=$this->Ares_v1->getSql();
			$array['Envios']	=$this->libre_v2->ejecuta($this->conexion,$sql['Envios'],$this->phpv);
		
		$ralaciones['INFO']=array(
			"TABLA"=>$this->tabla,
			"DATABASE"=>$this->database
		);
		$ralaciones['Envios']=array();
		$ralaciones['Recibe']=array();
		$ralaciones['All']=array();
		while ($datos=$this->libre_v2->mysql_fe_ar		($array['Envios'],$this->phpv,'')) {
			$RECIBE=explode("/",$datos['FOR_NAME']);
			$ENVIA=explode("/",$datos['REF_NAME']);
			
			$ralaciones['Envios'][]=array(
				"Recibe"=>array(
					"database"=>$RECIBE[0],
					"tabla"=>$RECIBE[1],
					"columna"=>$datos['FOR_COL_NAME']
				),
				"Envia"=>array(
					"database"=>$ENVIA[0],
					"tabla"=>$ENVIA[1],
					"columna"=>$datos['REF_COL_NAME']
				)
			);
			/*
			$ralaciones['Envios'][$RECIBE[1]]=array(
				"Recibe"=>array(
					"database"=>$RECIBE[0],
					"tabla"=>$RECIBE[1],
					"columna"=>$datos['FOR_COL_NAME']
				),
				"Envia"=>array(
					"database"=>$ENVIA[0],
					"tabla"=>$ENVIA[1],
					"columna"=>$datos['REF_COL_NAME']
				)
			);
			*/

		}
		while ($datos=$this->libre_v2->mysql_fe_ar		($array['Recibe'],$this->phpv,'')) {
			
			$RECIBE=explode("/",$datos['FOR_NAME']);
			$ENVIA=explode("/",$datos['REF_NAME']);
			
			$ralaciones['Recibe'][]=array(
				"Recibe"=>array(
					"database"=>$RECIBE[0],
					"tabla"=>$RECIBE[1],
					"columna"=>$datos['FOR_COL_NAME']
				),
				"Envia"=>array(
					"database"=>$ENVIA[0],
					"tabla"=>$ENVIA[1],
					"columna"=>$datos['REF_COL_NAME']
				)
			);
			/*
			$ralaciones['Recibe'][$ENVIA[1]]=array(
				"Recibe"=>array(
					"database"=>$RECIBE[0],
					"tabla"=>$RECIBE[1],
					"columna"=>$datos['FOR_COL_NAME']
				),
				"Envia"=>array(
					"database"=>$ENVIA[0],
					"tabla"=>$ENVIA[1],
					"columna"=>$datos['REF_COL_NAME']
				)
			);
			*/
		}
		/*
        echo('<pre>');
        print_r($ralaciones);
		echo('</pre>');     
		*/  
		$this->CRUCE_DE_DATOS=$ralaciones;
	}
	public function VIEW_RelacionDeTablas(){
        echo('<pre>');
        print_r($this->CRUCE_DE_DATOS);
		echo('</pre>');
	}
	public function VIEW_RelacionDeTablas_ENVIOS(){
        echo('<pre>');
        print_r($this->CRUCE_DE_DATOS['Envios']);
		echo('</pre>');   
        return $this->CRUCE_DE_DATOS['Envios'];		
	}
	public function GET_RelacionDeTablas_ENVIOS(){        
        return $this->CRUCE_DE_DATOS['Envios'];		
	}
	public function VIEW_RelacionDeTablas_RECIBE(){
        echo('<pre>');
        print_r($this->CRUCE_DE_DATOS['Recibe']);
		echo('</pre>');       
        return $this->CRUCE_DE_DATOS['Recibe'];		
	}
	public function GET_RelacionDeTablas_RECIBE(){        
        return $this->CRUCE_DE_DATOS['Recibe'];		
	}
	public function VIEW_RelacionDeTablas_INFO(){
        echo('<pre>');
        print_r($this->CRUCE_DE_DATOS['INFO']);
		echo('</pre>');   
        return $this->CRUCE_DE_DATOS['INFO'];		
	}
	public function GET_RelacionDeTablas_INFO(){        
        return $this->CRUCE_DE_DATOS['INFO'];		
	}
	public function SEARCH_RelacionDeTablas_BY_COLUMN_IN_ENVIOS($DATO_COLUMN){
		
	}
	public function SEARCH_RelacionDeTablas_BY_COLUMN_IN_RECIBE($DATO_COLUMN){
		$this->CRUCE_DE_DATOS['Recibe']; 
		$registro_coincidente='false';
		for ($i=0; $i <count($this->CRUCE_DE_DATOS['Recibe']) ; $i++) { 	
			$cadena=$this->CRUCE_DE_DATOS['Recibe'][$i]['Recibe'];
			$clave = array_search($DATO_COLUMN, $cadena);
			if(!empty($clave)){$registro_coincidente=$i;}
			
		} 
		if(is_numeric($registro_coincidente)){
		//if($registro_coincidente!='false'){
			return $this->CRUCE_DE_DATOS['Recibe'][$registro_coincidente];
		}else{
			return false;
		}
	}
	#############################
	public function Columnas_Avanzado($buscaDB,$buscaTabla){	
		$this->database=$buscaDB;
		$this->tabla=$buscaTabla;
		
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		$tabla="COLUMNS";
		$getColumnas        = array('*') ;
		$BuscaColumnas      = array('TABLE_SCHEMA','TABLE_NAME') ;
		$BuscaDatos         = array($buscaDB,$buscaTabla);
		
		$array=array(
			"tabla"=>$tabla,
			"Operacion"=>
			array(  'INSERT'=>array(
					"Activar"    =>'false'
				),      'SELECT'=>array(
					"Activar"		=>'true',//'false'
					"LIKE"			=>'false',//'false'
					"getColumnas"	=>$getColumnas,//array()
					"BuscaColumnas"	=>$BuscaColumnas,//array()
					"BuscaDatos"	=>$BuscaDatos,//array()

				),      'UPDATE'=>array(
					"Activar"	=>'false'
				),      'DELETE'=>array(
					"Activar"	=>'false'
				)
			)
		);
		$this->Ares_v1->GeneraSql($array);
		#$this->Ares_v1->viewSql($array);
		$sql=$this->Ares_v1->getSql();
		$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
		$DATOS_TABLA=array(
			'COLUMN_NAME'=>array(),
			'DATA_TYPE'=>array(),
			'CHARACTER_MAXIMUM_LENGTH'=>array(),
			'COLUMN_TYPE'=>array(),
			'COLUMN_KEY'=>array(),
			'EXTRA'=>array()
		);
		
		while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
			$DATOS_TABLA['COLUMN_NAME'][]				=$datos['COLUMN_NAME'];
			$DATOS_TABLA['DATA_TYPE'][]					=$datos['DATA_TYPE'];
			$DATOS_TABLA['CHARACTER_MAXIMUM_LENGTH'][]	=$datos['CHARACTER_MAXIMUM_LENGTH'];
			$DATOS_TABLA['COLUMN_TYPE'][]				=$datos['COLUMN_TYPE'];
			$DATOS_TABLA['COLUMN_KEY'][]				=$datos['COLUMN_KEY'];
			$DATOS_TABLA['EXTRA'][]						=$datos['EXTRA'];
		}
		$this->Datos_tabla=$DATOS_TABLA;
		$this->DATA_TYPE=$DATOS_TABLA['DATA_TYPE'];
		$this->CHARACTER_MAXIMUM_LENGTH=$DATOS_TABLA['CHARACTER_MAXIMUM_LENGTH'];
		$this->COLUMN_TYPE=$DATOS_TABLA['COLUMN_TYPE'];
		$this->COLUMN_KEY=$DATOS_TABLA['COLUMN_KEY'];
		$this->EXTRA=$DATOS_TABLA['EXTRA'];
		$this->Columnas=$DATOS_TABLA['COLUMN_NAME'];
		return $DATOS_TABLA;
	}
	public function Columnas($buscaDB,$buscaTabla){	
		$this->database=$buscaDB;
		$this->tabla=$buscaTabla;
		//$res= $this->EstructuraDB['columnas'][$tablaDeseada];
		//return $res;
		
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		$tabla="COLUMNS";
		$getColumnas        = array('COLUMN_NAME') ;
		$BuscaColumnas      = array('TABLE_SCHEMA','TABLE_NAME') ;
		$BuscaDatos         = array($buscaDB,$buscaTabla);
		
		$array=array(
			"tabla"=>$tabla,
			"Operacion"=>
			array(  'INSERT'=>array(
					"Activar"    =>'false'
				),      'SELECT'=>array(
					"Activar"		=>'true',//'false'
					"LIKE"			=>'false',//'false'
					"getColumnas"	=>$getColumnas,//array()
					"BuscaColumnas"	=>$BuscaColumnas,//array()
					"BuscaDatos"	=>$BuscaDatos,//array()

				),      'UPDATE'=>array(
					"Activar"	=>'false'
				),      'DELETE'=>array(
					"Activar"	=>'false'
				)
			)
		);
		$this->Ares_v1->GeneraSql($array);
		$sql=$this->Ares_v1->getSql();
		$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);


		$columnas	=$this->libre_v2->crea_array('');
		while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
			$busca=$this->libre_v2->busca_array($columnas,$datos['COLUMN_NAME']);//busca si existe la tabla 
			if(!$busca){//tabla no registrada
				$columnas		=$this->libre_v2->add_array($columnas,'',$datos['COLUMN_NAME']);	//Agrega la nueva tabla 
			}	
		}
		$this->Columnas=$columnas;
		return $columnas;
	}
	public function GetColumnas(){
		return $this->Columnas;
	}
	public function viewColumnas(){
		if(count($this->Columnas)>0)
		for ($x=0; $x < count($this->Columnas); $x++) { 
			echo $this->Columnas[$x];
			echo"<br>";
		}
	}
	public function GetDatos_tabla(){
		return $this->Datos_tabla;
	}
	public function viewDatos_tabla(){
		if(count($this->Datos_tabla)>0)
		for ($x=0; $x < count($this->Datos_tabla); $x++) { 
			echo $this->Datos_tabla[$x];
			echo"<br>";
		}
	}
	#####################################
	public function ListaDb(){
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		$res=$this->libre_v2->consulta('SCHEMATA',$this->conexion,'TABLE_SCHEMA','','','',$this->phpv,'',false);
		$DB	=$this->libre_v2->crea_array('');
		while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
			$busca=$this->libre_v2->busca_array($DB,$datos['SCHEMA_NAME']);//busca si existe la tabla 
			if(!$busca){//tabla no registrada
				$DB		=$this->libre_v2->add_array($DB,'',$datos['SCHEMA_NAME']);	//Agrega la nueva tabla 
			}	
			//echo$datos['SCHEMA_NAME'];
			//echo"<br>";
		}
		$this->ListaDb=$DB;
	}
	public function getListaDb(){
		return $this->ListaDb;
	}	
	public function viewListaDb(){
		for ($x=0; $x<count($this->ListaDb); $x++) { 
			echo$this->ListaDb[$x];
			echo"<br>";
		}
	}	
	
	public function ListaTB($DB){
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		$res=$this->libre_v2->consulta('TABLES',$this->conexion,'TABLE_SCHEMA',$DB,'','',$this->phpv,'',false);
		$tables	=$this->libre_v2->crea_array('');
		while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
			$busca=$this->libre_v2->busca_array($tables,$datos['TABLE_NAME']);//busca si existe la tabla 
			if(!$busca){//tabla no registrada
				$tables		=$this->libre_v2->add_array($tables,'',$datos['TABLE_NAME']);	//Agrega la nueva tabla 
			}	
		}
		$this->listaTB=$tables;
	}
	public function getListaTB(){ 
		return $this->listaTB;
	}
	public function viewListaTB(){
		for ($x=0; $x < count($this->listaTB) ; $x++) { 
			echo$this->listaTB[$x];
			echo"<br>";
		}
	}

	public function KeyColumnUsege($buscaDB,$buscaTabla){
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		$tabla="KEY_COLUMN_USAGE";
		$getColumnas        = array('COLUMN_NAME') ;
		$BuscaColumnas      = array('TABLE_SCHEMA','TABLE_NAME') ;
		$BuscaDatos         = array($buscaDB,$buscaTabla);
		
		$array=array(
			"tabla"=>$tabla,
			"Operacion"=>
			array(      'SELECT'=>array(
					"Activar"		=>'true',//'false'
					"LIKE"			=>'false',//'false'
					"getColumnas"	=>$getColumnas,//array()
					"BuscaColumnas"	=>$BuscaColumnas,//array()
					"BuscaDatos"	=>$BuscaDatos,//array()

				)
			)
		);
		$this->Ares_v1->GeneraSql($array);
		$sql=$this->Ares_v1->getSql();
		$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
		$this->libre_v2->mysql_nu_ro		($res,$this->phpv);
		$datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'');
		if($datos<=0){
			echo"La tabla no cuenta con PRIMARY KEY<br>".$sql;
			$this->KeyColumnUsege=false;
			exit;
		}
		$this->KeyColumnUsege=$datos['COLUMN_NAME'];
	}
	
	public function ConsuColumnasUnicas($buscaDB,$buscaTabla){
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		$tabla				="COLUMNS";
		$getColumnas        = array('TABLE_SCHEMA','TABLE_NAME','COLUMN_KEY','COLUMN_NAME') ;
		$BuscaColumnas      = array('TABLE_SCHEMA','TABLE_NAME','COLUMN_KEY') ;
		$BuscaDatos         = array($buscaDB,$buscaTabla,'UNI');
		
		$array=array(
			"tabla"=>$tabla,
			"Operacion"=>
			array(      'SELECT'=>array(
					"Activar"		=>'true',//'false'
					"LIKE"			=>'false',//'false'
					"getColumnas"	=>$getColumnas,//array()
					"BuscaColumnas"	=>$BuscaColumnas,//array()
					"BuscaDatos"	=>$BuscaDatos,//array()
				)
			)
		);
		$this->Ares_v1->GeneraSql($array);
		#$sql=$this->Ares_v1->viewSql();
		$sql=$this->Ares_v1->getSql();
		
		$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
		$this->libre_v2->mysql_nu_ro		($res,$this->phpv);
		#$datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'');
		$resultados_consu=$this->libre_v2->mysql_nu_ro($res,$this->phpv);
		if($resultados_consu==0){
			$this->ColumnasUNI=false;
		}else
		if($resultados_consu==1){
			$datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'');
			$this->ColumnasUNI=$datos['COLUMN_NAME'];
		}else{
			
			$Lista_colunas_unicas=Array();
			while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){			
				$Lista_colunas_unicas[]=$datos['COLUMN_NAME'];

			}
			$this->ColumnasUNI=$Lista_colunas_unicas;

		}
		#while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){			
		#	echo('<pre>');
		#	print_r($datos);
		#	echo('</pre>'); 
		#}
		#$this->KeyColumnUsege=$datos['COLUMN_NAME'];
		#*/
	}
	public function viewConsuColumnasUnicas(){
		echo $this->ColumnasUNI;
	}
	public function getConsuColumnasUnicas(){
		return $this->ColumnasUNI;
	}
	public function getKeyColumnUsege(){ 
		return $this->KeyColumnUsege;
	}
	public function viewKeyColumnUsege(){
		echo $this->KeyColumnUsege;
	}	
	
	public function chanseDatos($array){
		if(!empty($array['database'])) $this->database=$array['database'];
		if(!empty($array['tabla'])) $this->database=$array['tabla'];
	}

	public function ExtraColumns($buscaDB,$buscaTabla){//auto_increment
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		$tabla="COLUMNS";
		$getColumnas        = array('EXTRA','COLUMN_NAME') ;
		$BuscaColumnas      = array('TABLE_SCHEMA','TABLE_NAME') ;
		$BuscaDatos         = array($buscaDB,$buscaTabla);
		
		$array=array(
			"tabla"=>$tabla,
			"Operacion"=>
			array(  'INSERT'=>array(
					"Activar"    =>'false'
				),      'SELECT'=>array(
					"Activar"		=>'true',//'false'
					"LIKE"			=>'false',//'false'
					"getColumnas"	=>$getColumnas,//array()
					"BuscaColumnas"	=>$BuscaColumnas,//array()
					"BuscaDatos"	=>$BuscaDatos,//array()

				),
			)
		);
		$this->Ares_v1->GeneraSql($array);
		#$this->Ares_v1->viewSql();
		$sql=$this->Ares_v1->getSql();
		$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
		$this->libre_v2->mysql_nu_ro		($res,$this->phpv);
		
		#echo('<pre>');
		#print_r($res);
		#echo('</pre>'); 
		$Extra=array();
		while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
			if(!empty($datos['EXTRA'])){
				$this->ExtraColumns=$this->libre_v2->add_array($Extra,'',$datos['COLUMN_NAME']);	//Agrega la nueva tabla 
			}
			
				#echo('<pre>');
				#print_r($datos);
				#echo('</pre>'); 			
		}
	#$this->ExtraColumns=$Extra;
	}	
	public function getExtraColumns(){
		return $this->ExtraColumns;
	}

	public function ColunasInPost($ColunasInPost){
		/*
			$ColunasInPost=array(
				"Columnas a transferir"=>array(
					"columna"=> $_POST[name],
				)
			)
		*/
		#consulta valores en _POST que Coincidan Con las Columnas de la tabla
		$Valores=$this->libre_v2->crea_array('');	
				
			#echo('<pre>');
			#print_r($ColunasInPost);
			#echo('</pre>');  
			
		for ($x=0; $x <count($this->Columnas); $x++) { 
			#si el POST ya contiene alguin valor
				### traducion de name en _POST[name]
				
				if(!empty($ColunasInPost) and !empty($ColunasInPost['Columnas a transferir'][$this->Columnas[$x]])){
					$name=$ColunasInPost['Columnas a transferir'][$this->Columnas[$x]];
				}else{
					$name=$this->Columnas[$x];
				}
			if(isset($_POST[$name])){#verifica que este indexados
				/*
					echo gettype($_POST[$this->Columnas[$x]]);
					echo $this->Columnas[$x];
					echo $_POST[$this->Columnas[$x]];
				*/
				#tiene un valor 
					if(!empty($_POST[$name])){
						$res=$_POST[$name];
					}
				#es nulo 
				#esta vacio o 0 				
					if($_POST[$name]=='0'){				
						$res=$_POST[$name]=0;
					}else		
					if(empty($_POST[$name])){# si El POST no contiene valores y no es 0 esta vacio
						$res=$_POST[$name]='';
					}
			}else{				
				#esta vacio o 0 	
				if(empty($_POST[$name])){# si El POST no contiene valores y no es 0 esta vacio
					$res=$_POST[$name]='';
				}else		
				if($_POST[$name]=='0'){				
					$res=$_POST[$name]='0';
				}	
			}
			$Valores		=$this->libre_v2->add_array($Valores,'',$res);
				
		}
		return $Valores;
	}
	public function DataToPost($array_DataToPost){	
		/*
			$array_DataToPost=array(
				"getColumnas"=>array(),
				"BuscaColumnas"=>"",
				"BuscaDatos"=>"",
				"Columnas a transferir"=>array(
					"columna"=>nombre POST asignado $_POST[name],
				)
			);
		*/
		#descarga los datos de la db y los almacena el variables post 
		if(empty($this->database)){echo"base de base de datos no definida";exit;}
		if(empty($this->tabla)){echo"base de tabla no definida";exit;} 

		$this->libre_v2->db($this->database,$this->conexion,$this->phpv);
		$this->ExtraColumns($this->database,$this->tabla);
		if(isset($this->ExtraColumns) and  count($this->ExtraColumns)>0){
			$ID_BUSCA=$this->ExtraColumns[0];
		}else{
			$this->KeyColumnUsege($this->database,$this->tabla);			
			
			if(!empty($this->KeyColumnUsege)){
				$ID_BUSCA=$this->KeyColumnUsege;
		
			}
		}
		/*
			if(count($this->ExtraColumns)>0){
				$ID_BUSCA=$this->ExtraColumns[0];
			}else
			if(count($this->ExtraColumns)==0){
				$this->KeyColumnUsege($this->database,$this->tabla);			
				#$this->getKeyColumnUsege();
				if(!empty($this->KeyColumnUsege)){
					$ID_BUSCA=$this->KeyColumnUsege;
			
				}
			}
		 */
		if(is_array($array_DataToPost)){
			$ID_BUSCA=$array_DataToPost['BuscaColumnas'];
			$id=$array_DataToPost['BuscaDatos'];
			$columnas_descarga=$array_DataToPost['getColumnas'];

		}else{
			$id=$array_DataToPost;
			$columnas_descarga='*';
		}
		$getColumnas        = $columnas_descarga;
		$BuscaColumnas      = array($ID_BUSCA);
		$BuscaDatos         = array($id);
		
		$array_GeneraSql=array(
			"tabla"=>$this->tabla,
			"Operacion"=>array(
				'SELECT'=>array(
					"Activar"		=>'true',//'false'
					"LIKE"			=>'false',//'false'
					"getColumnas"	=>$getColumnas,//array()
					"BuscaColumnas"	=>$BuscaColumnas,//array()
					"BuscaDatos"	=>$BuscaDatos,//array()

				)
			)
		);
		$this->Ares_v1->GeneraSql($array_GeneraSql);
		#$this->Ares_v1->viewSql();
		$sql=	$this->Ares_v1->getSql();
		
		$this->libre_v2->db($this->database,$this->conexion,$this->phpv);
		$res=	$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
				$this->libre_v2->mysql_nu_ro($res,$this->phpv);
		
		#transfiere los datos a los datos de la consulta a POST
			$datos=	$this->libre_v2->mysql_fe_ar($res,$this->phpv,'');
			$resultados_consulta=$this->libre_v2->mysql_nu_ro($res,$this->phpv);
			/*			
				echo('<pre>');
				print_r($datos);
				echo('</pre>');  
				echo('<pre>');
				print_r($array_DataToPost["Columnas a transferir"]);
				echo('</pre>');  
			*/		
			for ($x=0; $x <count($this->Columnas) ; $x++) { 
				$columna=$this->Columnas[$x];
			
				if(!empty($datos[$columna])){
					if(isset($array_DataToPost["Columnas a transferir"][$columna])){
						$columna=$array_DataToPost["Columnas a transferir"][$columna];
						$columna_sql=$this->Columnas[$x]; 
						/*
							echo$columna_sql=$this->Columnas[$x];
							echo"=>";
							echo$datos[$columna_sql];
						*/
						if(!empty($datos[$columna_sql])){
							$_POST[$columna]=$datos[$columna_sql];
						}else{
							$_POST[$columna]='';
						}
					}else{
						
					$_POST[$columna]=$datos[$columna];
					}
				}else{
					$_POST[$columna]='';
				}
			}
			/*
				if(!empty($array_DataToPost["Columnas a transferir"])){					
					$keys=array_keys($array_DataToPost["Columnas a transferir"]);
					for ($x=0; $x <count($keys) ; $x++) { 
						$columna=$array_DataToPost["Columnas a transferir"][$keys[$x]];
						echo$columna_sql=$this->Columnas[$x];
						echo"=>";
						echo$datos[$keys[$x]];
						echo"<br>";
						if(!empty($datos[$keys[$x]])){
							$_POST[$columna]=$datos[$keys[$x]];
						}else{
							$_POST[$columna]='0';
						}
					}
				}else{				
					for ($x=0; $x <count($this->Columnas) ; $x++) { 
						ECHO $columna=$this->Columnas[$x];
						echo"=>";
						if(!empty($datos[$columna])){
							ecoh$_POST[$columna]=$datos[$columna];
						}else{
							$_POST[$columna]='';
						}
					}
				}
			*/
		$res_array=array(
			"Resultado de consulta"=>$resultados_consulta
		);
		return $res_array;
	}
	public function ColunasInPostClear($ColunasInPostClear){
		if(!isset($ColunasInPostClear)){
			$Valores=$this->libre_v2->crea_array('');
			if(empty($this->Columnas))"Columnas no descargadas";

			for ($x=0; $x <count($this->Columnas); $x++) { 
				$name=$this->Columnas[$x];
				$res=$_POST[$name]='';
				$Valores		=$this->libre_v2->add_array($Valores,'',$res);
			}
			return $Valores;
		}
		if(isset($ColunasInPostClear)){
			/*
			echo('<pre>');
			print_r($ColunasInPostClear);
			echo('</pre>');
			*/
			for ($i=0; $i <count($this->Columnas) ; $i++) { 
				$name=$this->Columnas[$i];
				if(isset($ColunasInPostClear["Columnas a transferir"][$name])){
					$name=$ColunasInPostClear["Columnas a transferir"][$name];
				}
				
				$_POST[$name]='';
			}

		}			
			#echo('<pre>');
			#print_r($datos);
			#echo('</pre>');  

	}
	
	public function ColunasInPost_traduccion($array){	
		#$array['TRADUCION']=ARRRAY();
		$Valores=$this->libre_v2->crea_array('');
		for ($x=0; $x <count($this->Columnas); $x++) { 
			#si el POST ya contiene alguin valor
			if(isset($_POST[$this->Columnas[$x]])){#verifica que este indexados
				/*
				echo gettype($_POST[$this->Columnas[$x]]);
				echo $this->Columnas[$x];
				echo $_POST[$this->Columnas[$x]];
				*/
				#tiene un valor 
					if(!empty($_POST[$this->Columnas[$x]])){
						$res=$_POST[$this->Columnas[$x]];
					}
				#es nulo 
				#esta vacio o 0 				
					if($_POST[$this->Columnas[$x]]=='0'){				
						$res=$_POST[$this->Columnas[$x]]=0;
					}else		
					if(empty($_POST[$this->Columnas[$x]])){# si El POST no contiene valores y no es 0 esta vacio
						$res=$_POST[$this->Columnas[$x]]='';
					}
			}else{				
				#esta vacio o 0 	
				if(empty($_POST[$this->Columnas[$x]])){# si El POST no contiene valores y no es 0 esta vacio
					$res=$_POST[$this->Columnas[$x]]='';
				}else		
				if($_POST[$this->Columnas[$x]]=='0'){				
					$res=$_POST[$this->Columnas[$x]]='0';
				}	
			}
			$Valores		=$this->libre_v2->add_array($Valores,'',$res);
				
		}
		return $Valores;

	}
	public function arrayToPost($array){
		
	}
	########################### Descontinuadas 

	function Verifica_en_tablas	($id,$tb,$conexion,$phpv){	
			if($tb=='')$tb= array(
			folio,
			abo_acu,
			casetas,
			casetas_c,
			casetas_via,
			casetas_c_via,
			disel,
			disel_c,
			fechas,
			fletes,
			fletes_c,
			facturas,
			facturas_c,
			viaticos,
			viaticos_c,
			ryr,
			ryr_c,
			guias,
			guias_c,
			maniobras,
			maniobras_c,
			km,
			);
		
		for($x=0; $x<=21; $x++){
			
			$res= Verifica_existe($id,$tb[$x],$conexion,$phpv);
			if($res==0){Echo"id: $id  tabla:  $tb[$x]   reparar";}
			
		}	

	}
	function Verifica_en_tablas2($id,$tb,$array,$array_deseado,$conexion,$phpv){//verifica en todas las tabla que exista. si no devulve un array con la tablas que no existen 
		echo"<div style='position: relative;background: #000000c2;margin: 1px 5px;left: 0px;width: 805px;padding: 5px;height: 180px;overflow-y: auto; overflow-x: hidden;'>";
		if($_POST[name2set]==Nuevo)		echo libre_v1::input2(text,'','',"Verificando Disponiblilidad",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
		if($_POST[name2set]==Modificar)	echo libre_v1::input2(text,'','',"Verificando Estado",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
		if($tb==''){
			if($array[version]=="descarga_db"){//compatibilidad con [descarga_db]
				$tb=$array[tablas];
				$colum=$array[columnas];
			}
		}
		if ($conexion=="") 	{echo"[Verifica_en_tablas2]Sin Conexion ";	exit;}
		if ($phpv=="")		{echo"[Verifica_en_tablas2]Sin Version	";	exit;}
		if ($id=='')		{echo"[Verifica_en_tablas2]Sin id		";	exit;}
		if ($tb=='')		{echo"[Verifica_en_tablas2]Sin tablas tb";	exit;}
		$array_error=array();
		$array_bien=array();
		for($x=0; $x<count($tb); $x++){
			$deseado=false;
			for($y=0; $y<count($array_deseado); $y++){//ciclo para ver si esta tabla es una de las que se quiere revisar 
				if($tb[$x]==$array_deseado[$y]){$deseado=true; break;}
			}
			if($deseado==true){							//si la tabla es para verificar 
				$res = Verifica_existe($id,$tb[$x],$conexion,$phpv);		
				if($_POST[name2set]==Nuevo){
					echo"<div style='float: left;margin: 1px 1px;background: #ffffffb5;width: 260px;'>";
					if($res==0){
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"OK",'background: #34374b; color: #00ff00;text-align: center;width: 50px;margin: 0px .5px;');
					}
					if($res==1){
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"X",'background: #34374b; color: #ff0000;text-align: center;width: 50px;margin: 0px .5px;');
					}
					echo"</div>";
				}
				if($_POST[name2set]==Modificar){
					echo"<div style='float: left;margin: 1px 1px;background: #ffffffb5;width: 260px;'>";
					if($res==1){
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"OK",'background: #34374b; color: #00ff00;text-align: center;width: 50px;margin: 0px .5px;');
					}
					if($res==0){
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"X",'background: #34374b; color: #ff0000;text-align: center;width: 50px;margin: 0px .5px;');
					}
					echo"</div>";
				}
				if($_POST[name2set]==Modificar){
					
				}
				if($res==0){//almacena las datos que tiene errores 
					$array_error[]=$tb[$x];
				}
				if($res==1){//almacena las datos que esten bien 
					$array_bien[]=$tb[$x];
				}
			}
		}
		$array_res= array(
		"version"	=> "Verifica_en_tablas2",
		"mal"	=> $array_error,
		"bien"		=> $array_bien
		);
		if($_POST[name2set]==Nuevo){
			if(count($array_error)<22)	echo libre_v1::input2(text,'','',"Conflicto de Datos Detectada",'width: 100%;text-align: center;margin: 0px 1px;background: #e6b220;color: black;');
		}
		if($_POST[name2set]==Modificar){
			if(count($array_error)<>0)	echo libre_v1::input2(text,'','',"Perdida de Dato Detectada",'width: 100%;text-align: center;margin: 0px 1px;background: #e6b220;color: black;');
		}
		echo"</div>";
		return $array_res;//devulve un array con todas las tabla que faltan de crear 
	}
	function Verifica_existe	($id,$tb,$conexion,$phpv){	//consulta si exista una elemento en una tabla 	
			$consu	= libre_v1::consulta		($tb,$conexion,ID_G,$id,'',''	,$phpv,'');
			$datos	= libre_v1::mysql_fe_ar		($consu,$phpv);
			if($datos[ID_G]==""){$res=0;}
			if($datos[ID_G]<>""){$res=1;}
			return $res;
	}
	function Repara_en_tabla	($id,$tb,$colum,$array,$array_deseado,$db,$conexion,$phpv){//Repara las tablas [agrega en cada tabla faltante un nuevo renglon]
		echo"<div style='color: white;position: relative;background: #000000c2;margin: 1px 5px;left: 0px;width: 805px;padding: 5px;height: 180px;overflow-y: auto; overflow-x: hidden;'>";
		//echo"<div style='color: white;position: relative;background: #000000c2;margin: 1px 5px;left: 0px;width: 1203px;padding: 5px;height: 300px;overflow-y: auto;overflow-x: hidden;'>";
		if($_POST[name2set]==Nuevo){	
			echo libre_v1::input2(text,'','',"Abilitando Campos",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
			$array_deseado=$array_deseado[mal];
		}
		if($_POST[name2set]==Modificar){
			echo libre_v1::input2(text,'','',"Correcion De Errores",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
			$array_deseado=$array_deseado[mal];
		}
		if($array[version]=="descarga_db"){//compatibilidad con [descarga_db]
			if($tb=='')		$tb=$array[tablas];
			if($colum=='')	$colum=$array[columnas];
		}
		if ($array_deseado=="") {echo"[Repara_en_tabla] Sin 'array_deseado' ";	exit;}
		if ($conexion=="") 		{echo"[Repara_en_tabla] Sin Conexion ";	exit;}
		if ($phpv=="")			{echo"[Repara_en_tabla] Sin Version	";	exit;}
		if ($id=='')			{echo"[Repara_en_tabla] Sin id		";	exit;}
		if ($tb=='')			{echo"[Repara_en_tabla] Sin tablas tb";	exit;}
		
		$datos_Systm[datos_mysql]	= descarga_db		($db,$conexion,$phpv);	//descarga los datos de mysql
		$systm[diagnostico]=false;
		for($x=0; $x<count($tb); $x++){
			$deseado=false;
			for($y=0; $y<count($array_deseado); $y++){//ciclo para ver si esta tabla es una de las que se quiere revisar 
				
				if($tb[$x]==$array_deseado[$y]){$deseado=true;}
			}
			if($deseado==true){
				if($_POST[name2set]==Nuevo){
				$res=Ares_v1::genera_sql(ID_G,insert,$tb[$x],$db,$conexion,$phpv,$systm,'',$datos_Systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
				$res=Ares_v1::genera_sql(ID_G,update,$tb[$x],$db,$conexion,$phpv,$systm,'',$datos_Systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
				}
				
				if($_POST[name2set]==Modificar){
				//$res=Ares_v1::genera_sql(ID_G,update,$tb[$x],$db,$conexion,$phpv,$systm,'',$datos_Systm);
				//libre_v2::ejecuta($conexion,$res[sql],$phpv);
				}
				//-- post_actualizacion---
				//echo"<br>". $res=auto_sql_insert($tb[$x],$colum[$tb[$x]],$id);
				//libre_v2::ejecuta($conexion,$res,$phpv);// crea el renglon faltante 
				//if($_POST[name2set]==Modificar)libre_v2::ejecuta($conexion,$res,$phpv);// crea el renglon faltante 
						
				if($_POST[name2set]==Nuevo){
					echo"<div style='float: left;margin: 1px 1px;background: #ffffffb5;width: 260px;'>";
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"OK",'background: #34374b; color: #00ff00;text-align: center;width: 50px;margin: 0px .5px;');
					echo"</div>";
				}
				if($_POST[name2set]==Modificar){
					echo"<div style='float: left;margin: 1px 1px;background: #ffffffb5;width: 260px;'>";
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"OK",'background: #34374b; color: #00ff00;text-align: center;width: 50px;margin: 0px .5px;');
					echo"</div>";
				}
				
			}
		}
		$array_res= array(
		"version"	=> "Verifica_en_tablas2",
		"mal"		=> $array_error,
		"bien"		=> $array_bien
		);
		echo"</div>";
		return $array_res;
	}
	function Updates			($db,$id,$array,$array_deseado,$conexion,$phpv){
		echo"<div style='position: relative;background: #000000c2;margin: 1px 5px;left: 0px;width: 805px;padding: 5px;height: 180px;overflow-y: auto; overflow-x: hidden;'>";
		echo libre_v1::input2(text,'','',"Proceso De Guardado",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
		echo"<br>";
		//verificacion de arranque
		$close=false;
		if($db=="")					{echo"<br>[Updates] sin DB ";$close=true;}
		if($id=="")					{echo"<br>[Updates] sin ID ";$close=true;}
		if($array=="")				{echo"<br>[Updates] sin ARRAY ";$close=true;}
		if($array_deseado=="")		{echo"<br>[Updates] sin ARRAY DESEADO";$close=true;}
		if($conexion=="")			{echo"<br>[Updates] sin CONEXION";$close=true;}
		if($phpv=="")				{echo"<br>[Updates] sin PHPV";$close=true;}
		if($close==true){exit;}
		//configuraciones
		if($array[version]=="descarga_db"){//compatibilidad con [descarga_db]
			if($tb=='')		$tb=$array[tablas];
			if($colum=='')	$colum=$array[columnas];
		}
		if($tb=="")					{echo"<br>[Updates] sin TB";$close=true;}
		if($colum=="")				{echo"<br>[Updates] sin COLUM";$close=true;}
		if($close==true){exit;}
		$datos_Systm[datos_mysql]	= descarga_db		($db,$conexion,$phpv);	//descarga los datos de mysql
		$systm[diagnostico]=false;	
		
		for($x=0;$x<count($tb); $x++){//presenta todas la tablas 
			$tabla_actual=$tb[$x];
			$deseado=false;
			for($y=0; $y<count($array_deseado); $y++){//ciclo para ver si esta tabla es una de las que se quiere revisar 
				if($tabla_actual==$array_deseado[$y]){$deseado=true;}
			}
			if($deseado==true){	
				echo"<div style='float: left;margin: 1px 1px;background: #ffffffb5;width: 260px;'>";
				echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
				echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
				//descarga datos de la tabla actual
				
				$columnas=$colum[$tabla_actual];//descarga las colunas de la tabla
				$dato_traductor=tablas_v2::info($db,$tabla_actual);
				$array_exencion=$dato_traductor[none];		
				
				$tipo_traducion=$dato_traductor[tradu];
				$array_traductor=$dato_traductor[name];
				//echo libre_v1::input2(text,'','',"Colunas",'margin: 0px .5px;');
				//echo libre_v1::input2(text,'','',count($columnas),'margin: 0px .5px;');
				//echo"<br>";	
				//echo libre_v1::input2(text,'','',"Colunas tradu",'margin: 0px .5px;');
				//echo libre_v1::input2(text,'','',count($array_traductor),'margin: 0px .5px;');
				//echo"<br>";	
				//echo libre_v1::input2(text,'','',"Tipo De tradu",'margin: 0px .5px;');
				//echo libre_v1::input2(text,'','',$tipo_traducion,'margin: 0px .5px;');
				//echo"<br>";	
				//echo libre_v1::input2(text,'','',"Col"			,' width: 70px;margin: 0px .5px;');
				//echo libre_v1::input2(text,'','',"Val"			,' width: 70px;margin: 0px .5px;');
				//echo libre_v1::input2(text,'','',"Col tradu"	,' width: 70px;margin: 0px .5px;');
				//echo libre_v1::input2(text,'','',"Val tradu"	,' width: 70px;margin: 0px .5px;');
				//echo"<br>";
				for($y=0; $y<count($columnas);$y++){//presnta las colunas de la tabla
					$columna_actual=$columnas[$y];
					if($tipo_traducion=="auto"){
						//echo libre_v1::input2(text,'','',$array_traductor[$y]			,' width: 70px;margin: 0px .5px;');
						//echo libre_v1::input2(text,'','',$_POST[$array_traductor[$y]]	,' width: 70px;margin: 0px .5px;');
					}
					if($tipo_traducion=="manual"){					
						$columna_actual_tradu=$array_traductor[$columna_actual];
						//echo libre_v1::input2(text,'','',$columna_actual_tradu			,' width: 70px;margin: 0px .5px;');
						//echo libre_v1::input2(text,'','',$_POST[$columna_actual_tradu]	,' width: 70px;margin: 0px .5px;');
					}
				}
				//PROCESO UPDATE
				
				//$sql=array_update($id,ID_G,$tabla_actual,$columnas,$array_traductor,$tipo_traducion,$array_exencion);
				//if($tabla_actual=="casetas_via")echo$sql;
				//libre_v2::ejecuta($conexion,$sql,$phpv);
						
				$res=Ares_v1::genera_sql(ID_G,update,$tb[$x],$db,$conexion,$phpv,$systm,'',$datos_Systm);
				libre_v2::ejecuta($conexion,$res[sql],$phpv);
				echo libre_v1::input2(text,'','',"OK",'background: #34374b; color: #00ff00;text-align: center;width: 50px;margin: 0px .5px;');
				echo"</div>";
				
			}
		}
		echo"</div>";
	}
	function Update_en_tabla	($db,$id,$tb,$array,$array_traductor,$conexion,$phpv){//function muerta
		//informacion operativa 
		//este bloque se encarga de prosesar solamente la informacion y variables de una sola tabla 
		//verificacion de arranque
		
		$close=false;
			if($db=="")					{echo"<br>[Update_en_tabla] sin DB ";$close=true;}
			if($id=="")					{echo"<br>[Update_en_tabla] sin ID ";$close=true;}
			if($array=="")				{echo"<br>[Update_en_tabla] sin ARRAY ";$close=true;}
			if($array_deseado=="")		{echo"<br>[Update_en_tabla] sin ARRAY DESEADO";$close=true;}
			//if($array_traductor=="")	{echo"<br>[Update_en_tabla] sin ARRAY TRADUCTOR";$close=true;}
			if($conexion=="")			{echo"<br>[Update_en_tabla] sin CONEXION";$close=true;}
			if($phpv=="")				{echo"<br>[Update_en_tabla] sin PHPV";$close=true;}
			if($close==true){exit;}
		//configuraciones 
		libre_v1::db($db,$conexion,$phpv);
		$array_traductor=tablas_v1::info($db,$tb);
		
	}
	function array_update($id,$name_id,$tb,$array_name,$array_value,$tipo,$array_exencion){
		//verificacion de arranque
		//añadir execiones 
		//for($x=0;$x=<count($array_value))
			
		$close=false;	
		if($id=="")					{echo"<br>[array_update] sin ID ";$close=true;}
		if($name_id=="")			{echo"<br>[array_update] sin NAME_ID ";$close=true;}
		if($array_name=="")			{echo"<br>[array_update] sin ARRAY NAME ";$close=true;}
		if($array_value=="")		{echo"<br>[array_update] sin ARRAY VALUE";$close=true;}
		if($close==true){exit;}
		//
		if($array_value[version]=="tablas_v2::info"){//compatibilidad
			$tipo=			$array_value[tradu];
			$array_value=	$array_value[name];
		}
		if($tipo=="auto"){
			//verifica que el id exista en el array_name 
			$igual=false;
			for($x=0; $x<count($array_name); $x++){
				if($array_name[$x]==$name_id){$igual=true; break;}
			}
			if($igual==false){echo"<br>[array_update] sql_id($name_id) no coincide con el sql_principal($array_name)";exit;}
			
		}
		if($tipo=="manual"){
			
		}
		if(count($array_name)<>count($array_value)){//verifica que el array_name se igual de largo que el array_ value
			echo"<br>[array_update] Diferencia entre los array de name(".count($array_name).") y value ".count($array_value);
		}
		if(count($array_name)<>count($array_exencion)){//verifica que el array_name se igual de largo que el array_ value
			echo"<br>[array_update] Diferencia entre los array de exencion(".count($array_exencion).") y value ".count($array_value);
		}
		if($tipo=="auto"){
			$res="UPDATE $tb SET ".$array_name[0]."='".$_POST[$array_value[0]]."'";
				for($x=1; $x<count($array_name); $x++){
				if($array_exencion[$x]<>1){
					$res=$res.",".$array_name[$x]."='".$_POST[$array_value[$x]]."'";
				}
			}	
			$res=$res." WHERE $name_id='$id'";
		}
		
		if($tipo=="manual"){
			$res="UPDATE $tb SET ".$array_name[0]."='".$_POST[$array_value[$array_name[0]]]."'";
			for($x=1; $x<count($array_name); $x++){
				if($array_exencion[$array_name[$x]]<>1){
					$res=$res.",".$array_name[$x]."='".$_POST[$array_value[$array_name[$x]]]."'";
				}
			}	
			$res=$res." WHERE $name_id='$id'";
			
		}
		return $res;
	}
	function actua2($carta,$conexion,$phpv,$inteface){
		echo libre_v1::input2(text,'','',"Actualizando Cuentas Vinculadas($carta)",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
		
		//datos de la cueta actual 
		$consu24_actua		= libre_v1::consulta(abo_acu,$conexion,ID_G,$carta,'','',$phpv,'','');//descarga los datos de la cuenta actual 
		$abo_acu_actua		= libre_v1::mysql_fe_ar($consu24_actua,$phpv);//empaqueta los datos 
		//datos en la cuenta arrastrada 
		$consu24_arras		= libre_v1::consulta(abo_acu,$conexion,ID_G,$abo_acu_actua[add_en],'','',$phpv,'','');//descarga los datos de la cuenta actual 
		$abo_acu_arras		= libre_v1::mysql_fe_ar($consu24_arras,$phpv);//empaqueta los datos 
		//RECALCULACION DE 
		for($x=1; $x<=5; $x++){$N="ac".$x;$total_acu=$total_acu+$abo_acu_actua[$N];}//calcula total acu_actual 
		for($x=1; $x<=5; $x++){$N="ab".$x;$total_ab=$total_ab+$abo_acu_actua[$N];}//calcula total acu_actual 
		$dif1=$abo_acu_actua[dif1];	//valor actual 
		
		$total_recalculado=round($dif1+$total_acu+$total_ab,2);//recalculado 
		
		if($total_recalculado==$abo_acu_actua[Total_Total]){$style_total_recalculado="background: green;";}else{//si existe diferencia
			$actua_saldos=1;
			$style_total_recalculado="background: red;";
		}
		$calculo_dif=$abo_acu_actua[Total_Total]-$total_recalculado;
		//correcion 
		
		if($abo_acu_actua[add_en]==""){$estado2="Libre";}else{$estado2=$abo_acu_actua[add_en];}
		if($estado2<>"Libre"){//revisa si esta vinculado
			for($x=1; $x<=5; $x++){//busca la posicion del vinculo entre actual y arrastrante
				$N1="ID_ac".$x;
				$N2="ac".$x;
				if($abo_acu_arras[$N1]==$carta){$posicion=$N1;break;}
			}
			if($abo_acu_arras[$N2]==$abo_acu_actua[Total_Total]){$totales_dif=0;}else{$totales_dif=1;}//detecta si hay diferencia entre actual y arrastrado
			if($totales_dif==1){$style_estado1="background: red;";$estado1="Diferencia de saldos";}//interfacez
			if($totales_dif==0){$style_estado1="background: green;";$estado1="Bien";}//indica el estado el vinculo 
		}
		if($actua_saldos==1){
			$sql=libre_v2::espe_tab_update	(abo_acu,"ID_G",$carta,Total_Total,$total_recalculado);//actualizar saldo total_total en la cuenta actual 
			libre_v2:: ejecuta($conexion,$sql,$phpv);		
			if($estado2<>Libre){
				$sql=libre_v2::espe_tab_update	(abo_acu,"ID_G",$estado2,$N2,$total_recalculado);//actualiza en la cuenta arrastrada 
				libre_v2:: ejecuta($conexion,$sql,$phpv);
			}
			$estado3="En Correcion";
		}
		
		if($inteface=="1"){
			echo libre_v1::input2(text,'','',Actual);
			echo"<br>";
			echo libre_v1::input2(text,'','',"Total Final Registrado ");
			echo libre_v1::input2(text,'','',$abo_acu_actua[Total_Total],"background: orange;");
			echo"<br>";
			echo libre_v1::input2(text,'','',"Actual ");
			echo libre_v1::input2(text,'','',$dif1);
			echo"<br>";
			echo libre_v1::input2(text,'','',"Total Acumulado");
			echo libre_v1::input2(text,'','',$total_acu);
			echo"<br>";
			echo libre_v1::input2(text,'','',"Total Abono");
			echo libre_v1::input2(text,'','',$total_ab);
			echo"<br>";
			echo libre_v1::input2(text,'','',"Total Recalculado");
			echo libre_v1::input2(text,'','',$total_recalculado,$style_total_recalculado);
			if($estado3<>"")echo libre_v1::input2(text,'','',$estado3,"background: #3fff00");
			
			echo"<br>";
			echo libre_v1::input2(text,'','',"dif Recalculado");
			echo libre_v1::input2(text,'','',$calculo_dif);
			echo"<br>";
			echo"<div style='background: #005aff;width: 220px; padding: 5px 0px 5px 5px;'>";
			echo libre_v1::input2(text,'','',"Arrastrada en: $estado2",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
			echo"<br>";
			echo libre_v1::input2(text,'','',"Arrastrada en: ");
			echo libre_v1::input2(text,'','',$estado2);
			echo"<br>";
			echo libre_v1::input2(text,'','',"Posicion en: ");
			echo libre_v1::input2(text,'','',$N1);
			echo"<br>";
			echo libre_v1::input2(text,'','',"Total arrastrado: ");
			echo libre_v1::input2(text,'','',$abo_acu_arras[$N2]);
			echo"<br>";
			echo libre_v1::input2(text,'','',"Estado De Vinculo: ");
			echo libre_v1::input2(text,'','',$estado1,$style_estado1);
			echo"</div>";
			//verifica estado de cuenta 
			//repara la cuenta si  esta mal
		}
		if($abo_acu_actua[add_en]<>"")actua2($abo_acu_actua[add_en],$conexion,$phpv,$inteface);
		
	}
	function Actua($carta,$conexion,$phpv){
		$close=false;
		if ($conexion==''){echo"<br>No Hay Conexion [Actua]";$close=true;}
		if($close==true){exit;}
		echo libre_v1::input2(text,'','',"Actualizando Cuentas Vinculadas($carta)",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
		$consu24=libre_v1::consulta(abo_acu,$conexion,ID_G,$carta,'','',$phpv,'','');//descarga los datos de la cuenta actual 
		$c0='';
		$c0=libre_v1::mysql_fe_ar($consu24,$phpv,"Actua->busca add_en");//enpaqueta los datos 
		$fec_fin=$_POST[A_r].libre_v1::zero($_POST[M_r]).libre_v1::zero($_POST[D_r]);
		echo "<br>";
		if($c0[add_en]=='')echo"<br>Arrastrada en: Libre";
		if($c0[add_en]<>''){//si existe un vinvulo re-calcula valres 	$c0[add_en]
			echo"<br>Arrastrada en: $c0[add_en]";
			//actualiza el total actual en la cuenta en la que esta siendo arrastrada
			//$consu=libre_v1::consulta('abo_acu',$conexion,ID_G,$c0);
			$consu1=libre_v1::consulta(abo_acu,$conexion,ID_G,$c0[add_en],'','',$phpv,'','');//Descarga la cuenta donde esta siendo arrastrada
			$c1=libre_v1::mysql_fe_ar		($consu1,$phpv,"");
			echo"<br>Total: ".$c1=$c1[Total_Total];
			for($x=1; $x<=5; $x++){
				$N1=ID_ac.$x;
				$N2=ac.$x;
				$consu2=libre_v1::consulta(abo_acu,$conexion,ID_G,$c0[add_en],'','',$phpv,'','');//Descarga la cuenta donde esta siendo arrastrada
				$c2=libre_v1::mysql_fe_ar		($consu2,$phpv,"");
				$consu3=libre_v1::consulta(abo_acu,$conexion,ID_G,$c2[$N1],'','',$phpv,'','');//Descarga la cuenta donde esta siendo arrastrada
				$c3=libre_v1::mysql_fe_ar		($consu3,$phpv,"Actua->busca IDac");
				echo"<br> $N1: ". $c2[$N1].	" -> ". $c2[$N2];
				echo"<br> ID : ". $c2[$N1].	" -> ". $c2[$N2];
				/*if ($c2<>''){
					echo "Posicion: $N1 \r saldo   : $c2 ";
					if ($c2<>$c1){
						echo'>Guardar saldo<';
						$tabla=abo_acu;
						$n_id=ID_G;$id=$c0;
						$n_modificando=ID_G;$v_modificando=$c0;
						$n1=$N2;	$v1=$c1;	
						include('espe_tab.php');
						IF (($grava==1)&&($_POST[Grava]==Guardar)&&($fec_fin>=20160601)){
							echo"\r".$res;
							MYSQL_QUERY($res,$conexion)or die("Error \r$res\r".mysql_error($conexion));
						}*
					}
				}*/
			}
			
			Actua($c0[add_en],$conexion,$phpv);
		}
		
		
		/*$c0='';
			$c0=libre_v1::compro($carta,ID_G,add_en,$consu24,$conexion);
			$fec_fin=$_POST[A_r].libre_v1::zero($_POST[M_r]).libre_v1::zero($_POST[D_r]);
			IF($c0<>''){
				if ($conexion<>'')$consu24=consulta('abo_acu',$conexion);
				$c1=libre_v1::compro($carta,ID_G,Total_Total,$consu24,$conexion);//total de cuenta actual
				print"Cuenta  : $carta \r";
				print"Saldo   : $c1 \r";
				print"--------------\r";
				print"Arras en: $c0 \r";
				$consu24=libre_v1::consulta('abo_acu',$conexion,ID_G,$c0);//descarga datos de abonos
				for($x=1; $x<=5; $x++){
					$N1=ID_ac.$x;
					$N2=ac.$x;
					$c2=libre_v1::compro($carta,$N1,$N2,$consu24,$conexion);
					if ($c2<>''){
						echo "Posicion: $N1 \r saldo   : $c2 ";
						if ($c2<>$c1){
							echo'>Guardar saldo<';
							$tabla=abo_acu;
							$n_id=ID_G;$id=$c0;
							$n_modificando=ID_G;$v_modificando=$c0;
							$n1=$N2;	$v1=$c1;	
							include('espe_tab.php');
							IF (($grava==1)&&($_POST[Grava]==Guardar)&&($fec_fin>=20160601)){
								echo"\r".$res;
								MYSQL_QUERY($res,$conexion)or die("Error \r$res\r".mysql_error($conexion));
							}
						}
					}
				}	
				$total=0;
				for($y=1; $y<=5;$y++){
					$N1=ID_ac.$y;
					$N2=ac.$y;
					$consu24=consulta('abo_acu',$conexion,ID_G,$c0);
					while($dato=mysql_fetch_array($consu24)){
						$total=$total+$dato[$N2];
					}
				}
				$consu5=libre_v1::consulta('folio'			   ,$conexion,ID_G,$c0);
				$consu6=libre_v1::consulta('fletes'	           ,$conexion,ID_G,$c0);
				$consu7=libre_v1::consulta('viaticos'	           ,$conexion,ID_G,$c0);
				$consu8=libre_v1::consulta('disel'	           ,$conexion,ID_G,$c0);
				$consu9=libre_v1::consulta('casetas'	           ,$conexion,ID_G,$c0);
				$consu10=libre_v1::consulta('facturas'	       ,$conexion,ID_G,$c0);
				$consu11=libre_v1::consulta('ryr'		           ,$conexion,ID_G,$c0);
				$consu12=libre_v1::consulta('guias'	           ,$conexion,ID_G,$c0);
				$consu13=libre_v1::consulta('maniobras'	       ,$conexion,ID_G,$c0);
				
				$total1=libre_v1::compro($c0,ID_G,TOTAL1		,$consu6,$conexion);
				$comi_a=libre_v1::compro($c0,ID_G,comi_ass	,$consu6,$conexion);
				$total2=libre_v1::compro($c0,ID_G,TOTAL2		,$consu7,$conexion);
				$total4=libre_v1::compro($c0,ID_G,TOTAL4		,$consu9,$conexion);
				$total5=libre_v1::compro($c0,ID_G,TOTAL5		,$consu10,$conexion);
				$total6=libre_v1::compro($c0,ID_G,TOTAL6		,$consu11,$conexion);
				$total7=libre_v1::compro($c0,ID_G,TOTAL7		,$consu12,$conexion);
				$total8=libre_v1::compro($c0,ID_G,TOTAL8		,$consu13,$conexion);
				$dif=	libre_v1::compro($c0,ID_G,Difer_1		,$consu5,$conexion);
				$sue=	libre_v1::compro($c0,ID_G,sueldo		,$consu5,$conexion);
				$cac=	libre_v1::compro($c0,ID_G,Totalac		,$consu24,$conexion);
				$cab=	libre_v1::compro($c0,ID_G,Totalab		,$consu24,$conexion);
				$tot=	libre_v1::compro($c0,ID_G,Total_Total	,$consu24,$conexion);
				
				$g_t=$total4+$total5+$total6+$total7+$total8;
				$c=$total1*0.15;    if($comi_a<>'')$c=$total1*($comi_a/100);
				$rete=($c*7.5)/100;
				$t_g=   round($g_t+$c,2);
				$dif2=  round($total2-$t_g+$rete,2);
				$t1=$total+$dif2;
				$dif1=  round($cab+$t1,2);
				echo"\r----------------";
				echo"\rSue            de $c0 : $sue ";
				echo"\rG_T            de $c0 : $g_t ";
				echo"\rCh             de $c0 : $c ";
				echo"\rRe             de $c0 : $rete ";
				echo"\rT_G            de $c0 : $t_g ";
				echo"\rDif_cal        de $c0 : $dif2 ";
				echo"\r----------------";
				echo"\rFlete          de $c0 : $total1 ";
				echo"\rViaticos       de $c0 : $total2 ";
				echo"\rCasetas        de $c0 : $total4 ";
				echo"\rFacturas       de $c0 : $total5 ";
				echo"\rRyR            de $c0 : $total6 ";
				echo"\rGuias          de $c0 : $total7 ";
				echo"\rManiobras      de $c0 : $total8 ";
				echo"\rComi           de $c0 : $comi_a ";
				echo"\r----------------\r";
				echo"\rDifer1         de $c0 : $dif ";
				echo"\rcalcu Arastedo de $c0 : $total ";
				echo"\rTotal Abonado  de $c0 : $cab ";
				echo"\rTotalTotal     de $c0 : $tot ";
				echo"\rTotal calcu           : $dif1";
				if ($c<>$sue){
					echo"\r>Guardar Sueldo<";
					$tabla=folio;
					$n_id=ID_G;$id=$c0;
					$n_modificando=ID_G;$v_modificando=$c0;
					$n1=sueldo;	$v1=$c;	
					include('espe_tab.php');
					IF (($grava==1)&&($_POST[Grava]==Guardar)&&($fec_fin>=20160601)){
						echo"\r".$res;
						MYSQL_QUERY($res,$conexion)or die("Error \r$res\r".mysql_error($conexion));
					}
				}
				if ($tot<>$dif1){
					echo"\r>Guardar Total<";
					$tabla=abo_acu;
					$n_id=ID_G;$id=$c0;
					$n_modificando=ID_G;$v_modificando=$c0;
					$n1=Total_Total;	$v1=$dif1;	
					include('espe_tab.php');
					IF (($grava==1)&&($_POST[Grava]==Guardar)&&($fec_fin>=20160601)){
						echo"\r".$res;
						MYSQL_QUERY($res,$conexion)or die("Error \r$res\r".mysql_error($conexion));
					}
				}
				echo"\r----------------\r";
				Actua($c0,$grava,$conexion);
			}
		*/
	}
	function calculadora_cuentas($cuenta,$type,$conexion,$phpv,$inteface){
		if($type=="sql"){
			$consu_abo_acu		= libre_v1::consulta	(abo_acu,$conexion,ID_G,$carta,'','',$phpv,'','');		//descarga los datos de la cuenta actual 
			$datos_abo_acu		= libre_v1::mysql_fe_ar	($consu_abo_acu,$phpv);									//empaqueta los datos 
			$consu_casetas		= libre_v1::consulta	(casetas,$conexion,ID_G,$carta,'','',$phpv,'','');		//descarga los datos de la cuenta actual 
			$datos_casetas		= libre_v1::mysql_fe_ar	($consu_casetas,$phpv);									//empaqueta los datos 
			$consu_casetas_via	= libre_v1::consulta	(casetas_via,$conexion,ID_G,$carta,'','',$phpv,'','');	//descarga los datos de la cuenta actual 
			$datos_casetas_via	= libre_v1::mysql_fe_ar	($consu_casetas_via,$phpv);								//empaqueta los datos 
			$consu_disel		= libre_v1::consulta	(disel,$conexion,ID_G,$carta,'','',$phpv,'','');		//descarga los datos de la cuenta actual 
			$datos_disel		= libre_v1::mysql_fe_ar	($consu_disel,$phpv);									//empaqueta los datos		
			$consu_fechas		= libre_v1::consulta	(fechas,$conexion,ID_G,$carta,'','',$phpv,'','');		//descarga los datos de la cuenta actual 
			$datos_fechas		= libre_v1::mysql_fe_ar	($consu_fechas,$phpv);		
			$consu_facturas		= libre_v1::consulta	(facturas,$conexion,ID_G,$carta,'','',$phpv,'','');		//descarga los datos de la cuenta actual 
			$datos_facturas		= libre_v1::mysql_fe_ar	($consu_facturas,$phpv);								//empaqueta los datos 		
			$consu_fletes		= libre_v1::consulta	(fletes,$conexion,ID_G,$carta,'','',$phpv,'','');		//descarga los datos de la cuenta actual 
			$datos_fletes		= libre_v1::mysql_fe_ar	($consu_fletes,$phpv);									//empaqueta los datos 
			$consu_folio		= libre_v1::consulta	(folio,$conexion,ID_G,$carta,'','',$phpv,'','');		//descarga los datos de la cuenta actual 
			$datos_folio		= libre_v1::mysql_fe_ar	($consu_folio,$phpv);									//empaqueta los datos 		
			$consu_km			= libre_v1::consulta	(km,$conexion,ID_G,$carta,'','',$phpv,'','');			//descarga los datos de la cuenta actual 
			$datos_km			= libre_v1::mysql_fe_ar	($consu_km,$phpv);										//empaqueta los datos 		
			$consu_maniobras	= libre_v1::consulta	(maniobras,$conexion,ID_G,$carta,'','',$phpv,'','');	//descarga los datos de la cuenta actual 
			$datos_maniobras	= libre_v1::mysql_fe_ar	($consu_maniobras,$phpv);								//empaqueta los datos 		
			$consu_ryr			= libre_v1::consulta	(ryr,$conexion,ID_G,$carta,'','',$phpv,'','');			//descarga los datos de la cuenta actual 
			$datos_ryr			= libre_v1::mysql_fe_ar	($consu_ryr,$phpv);										//empaqueta los datos 		
			$consu_viaticos		= libre_v1::consulta	(viaticos,$conexion,ID_G,$carta,'','',$phpv,'','');		//descarga los datos de la cuenta actual 
			$datos_viaticos		= libre_v1::mysql_fe_ar	($consu_viaticos,$phpv);								//empaqueta los datos 
			
			$total1	=$datos_casetas[TOTAL1];
			$total2	=$datos_casetas[TOTAL2];
			$total2	=$datos_casetas[TOTAL3];
			$total4	=$datos_casetas[TOTAL4];
			$total4_via=$datos_casetas_via[TOTAL];
			$total5	=$datos_casetas[TOTAL5];
			$total6	=$datos_casetas[TOTAL6];
			$total7	=$datos_casetas[TOTAL7];
			$total8	=$datos_casetas[TOTAL8];
			$total9	=$datos_casetas[TOTAL9];
			$total10=$datos_casetas[TOTAL10];
			$comi	=$datos_fletes[comi_ass];
			$Flete_R=$datos_fletes[Flete_R];
			$g_t=$total4+$total5+$total6+$total7+$total8;	//casetas+facturas+ryr+guias+maniobras
			
			$c=$total1*0.15;   
			if($comi<>'')$c=$total1*($comi/100); 			//comicion variada	(para chofer)
			$rete=($c*7.5)/100;								//Isr
			$t_g=   round($g_t+$c,2);						//gatos_total+comision
			$dif1=  round($total2-$t_g+$rete,2);			//viaticos-total_gastos+retencion
			$dif2=  round($total2-$g_t,2);					//viaticos-gatos_total
			$dif3=$dif1+$total10;							//dif1+ acumulado
			$pre_d=$dif1+$total10;							// ??? esta mal ??? repetido con el anterior
			$dif4=$pre_d+$total9;	
			$comi=  round($Flete_R*0.0928,2);		//Flete_Real * 0.0928		
			$t_d_g= round($total3+$t_g+$comi+$total4_via,2);//diesel+total_gatos+comision
			$n_c=   round($Flete_R-$t_d_g,2);		
			$re=    round($Flete_R*0.01,2);			
			$re=    round($n_c/$re,2);
		}
		/*							
		$km_t=	round($_POST[km_f]-$_POST[km_i],2);
		*/
		$res			= array(
			"version"	=> "calculadora_cuentas",
			"g_t"		=> $t_g
		);
		return $res;
	}
}
class Gestion_Datos_Vinculados{
	  
    private $libre_v1;
    private $libre_v2;
    private $libre_v4;
    private $phpv;
    private $conexion;
    private $paginacion;
    private $Menu_movil;
    public function __construct($phpv,$conexion,$array){	
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);	
        $this->libre_v4	=new libre_v4($phpv,$conexion);	
        $this->phpv=$phpv;	
        $this->conexion=$conexion;	
    }   
}

class inface{
	private $Ares_v1;
	private $libre_v1;
	private $libre_v2;
	private $libre_v4;
	private $libre_v5;
	private $phpv;
	private $conexion;
	private $database;
	private $tabla;
	private $array_consulta;
	private $datos_consulta_tabla;
	private $sql_consulta_tabla;

	public function __construct($database,$tabla,$phpv,$conexion){
		$this->database	=$database;
		$this->tabla	=$tabla;
		$this->Ares_v1	=new Ares_v1();		
		$this->libre_v1	=new libre_v1();	
		$this->libre_v2	=new libre_v2($phpv,$conexion);	
		$this->libre_v4	=new libre_v4($phpv,$conexion);	
		$this->libre_v5	=new libre_v5($phpv,$conexion,'');
		$this->phpv=$phpv;	
		$this->conexion=$conexion;	
	}
	public function Control_Consulta($array_consulta){
		$this->array_consulta=$array_consulta;
		/*
		$this->array_consulta=array(
			"tabla"=>$this->tabla,
			"Operacion"=>
			array('SELECT'=>array(
					"Activar"	=>'true',//'false'
					"LIKE"		=>'false',//'false'
					"getColumnas"	=>array('*'),
					"BuscaColumnas"	=>false,
					"BuscaDatos"	=>false,
					"ByOrder"		=>$ByOrder
					
				)
			)
		);
		*/
	}
	public function Consulta_tabla(){
		$this->libre_v2->db($this->database,$this->conexion,$this->phpv);
		#echo('<pre>');
		#print_r($this->array_consulta);
		#echo('</pre>'); 
		$this->Ares_v1->GeneraSql($this->array_consulta);
		#$this->Ares_v1->viewSql();
		$this->sql_consulta_tabla=$this->Ares_v1->getSql();
		$this->datos_consulta_tabla=$this->libre_v2->ejecuta($this->conexion,$this->sql_consulta_tabla,$this->phpv);
		/*echo"<div  class='Elementos_lista'>";         
				for ($x=0; $x < count($columnas); $x++) { 
					$libre='';
					if($columnas[$x]==$key){
						$CLASS=$class['id'];
					}else{
						$CLASS=$class['casilla'];
					}
					$type='submit';
					if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){$type='date';$libre='disabled';}
					echo $this->libre_v5->input($type,'',$columnas[$x],'',$CLASS,'',$libre,'');
				}			
			echo"</div>";
			
			$ByOrder='';
			if(!empty($array['lista']['ByOrder']))$ByOrder=$array['lista']['ByOrder'];
			#descarga los datos de la lista a presentar 
			$array=array(
				"tabla"=>$this->tabla,
				"Operacion"=>
				array('SELECT'=>array(
						"Activar"	=>'true',//'false'
						"LIKE"		=>'false',//'false'
						"getColumnas"	=>array('*'),
						"BuscaColumnas"	=>false,
						"BuscaDatos"	=>false,
						"ByOrder"		=>$ByOrder
						
					)
				)
			);
			$this->Ares_v1->GeneraSql($array);
			$sql=$this->Ares_v1->getSql();
			$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
			#mysqli_data_seek($res,0);                                                          //inicia revisar lso datos desde la parte superior 
			#presentas los registros de las lista 
			while ($fila = mysqli_fetch_array($res)) {         
				echo"<div class='Elementos_lista'>";
				for ($x=0; $x < count($columnas); $x++) { 
					$type='submit';
					$name='';
					$libre='';
					if($columnas[$x]==$key){
						$name='Descargar';
						$CLASS=$class['id'];
					}else{
						$CLASS=$class['casilla'];
						$libre='disabled';
					}
					if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){$libre='disabled';}
					if(empty($fila[$columnas[$x]])){$fila[$columnas[$x]]=" ";}
					echo $this->libre_v5->input($type,$name,$fila[$columnas[$x]],'',$CLASS,'',$libre,'');
				}
				echo"</div>";
			}
			*/
	}
	public function view_Consulta_tabla(){
		/*$tabla_consulta='Repostajes_unidades';
			$database_consulta='combustible';
			$Consulta_tabla= new inface($database_consulta,$tabla_consulta,$phpv,$conexion);
			$array_consulta=array(
				"tabla"=>$tabla_consulta,
				"Operacion"=>array(
					'SELECT'=>array(
						"Activar"	=>'true',
						"LIKE"		=>'falses',
						#"getColumnas"	=>array('*'),
						"getColumnas"	=>array('Contador_Inicio','Total_Despachado'),
						"BuscaColumnas"	=>array(),
						"BuscaDatos"	=>array(),
						"Condiciones"	=>array(),
						
					)
				),
				'Consulta_especifica'=>array(
					"name_boton_descarga"=>'',
				),
				'class'=>array(
					'columnaFija'=>'Diseno_botones1',
					'casilla'=>'Diseno_botones1',
					'id'=>'Diseno_boton_id'
				),
				'Div_principal'=>''
			);
			$Consulta_tabla->Control_Consulta($array_consulta);
			$Consulta_tabla->Consulta_tabla();
			$Consulta_tabla->view_Consulta_tabla();
		*/
		$Div_principal=			$this->array_consulta['Div_principal'];
		$class=					$this->array_consulta['class'];
		$Consulta_especifica=	$this->array_consulta['Consulta_especifica'];
		$columnas=				$this->array_consulta['Operacion']['SELECT']['getColumnas'];
					$this->libre_v4->KeyColumnUsege($this->database,$this->tabla);
		$key= 					$this->libre_v4->getKeyColumnUsege();
		
		if($columnas[0]=='*'){
			$this->libre_v4->Columnas($this->database,$this->tabla);
			$columnas=$this->libre_v4->GetColumnas();
		}
		#### presenta cabezeras
			#echo"<div style='position: relative;float: left; margin:0px 0px 2px 0px; '>";
			echo"<div  class='Elementos_lista'  style='min-width: max-content;'>";
				for ($x=0; $x < count($columnas); $x++) { 
					$libre='';
					if($columnas[$x]==$key){
						$CLASS=$class['id'];
					}else{
						$CLASS=$class['casilla'];
					}
					$type='submit';
					#echo('<pre>');
					#print_r($this->array_consulta['CambiosColumnas']['TextColumna']);
					#echo('</pre>'); 
					
					$nombre_columna=$columnas[$x];
					if(!empty($this->array_consulta['CambiosColumnas']['TextColumna'])) {
						$cambio_texto_columnas=$this->array_consulta['CambiosColumnas']['TextColumna'];
						if(!empty($cambio_texto_columnas[$columnas[$x]])){
							$nombre_columna=$cambio_texto_columnas[$columnas[$x]];
						}
					}
					if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){$type='date';$libre='disabled';}
					echo $this->libre_v5->input($type,'',$nombre_columna,'',$CLASS,'',$libre,'');
				}	
			echo"</div>";
		#### presentacion de los datos encontrados 
			if(!empty($Div_principal)){
				echo $Div_principal;
			}else{
				echo"<div style='position: relative;float: left;overflow: auto;height: 185px;width: max-content;'>";
			}	
			echo "<div id='Conte_lista'>";
				while ($fila = mysqli_fetch_array($this->datos_consulta_tabla)) {         
					echo"<div class='Elementos_lista'>";					
						for ($x=0; $x < count($columnas); $x++) { 
							$type='submit';
							$name='';
							$libre='';
							if($columnas[$x]==$key){
								if(!empty($Consulta_especifica['name_boton_descarga'])){$name=$Consulta_especifica['name_boton_descarga'];}
								else{$name='Descargar';}
								
								$CLASS=$class['id'];
							}else{
								$CLASS=$class['casilla'];
								$libre='disabled';
							}
							if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){$libre='disabled';}
							if(empty($fila[$columnas[$x]])){$fila[$columnas[$x]]=" ";}
							echo $this->libre_v5->input($type,$name,$fila[$columnas[$x]],'',$CLASS,'',$libre,'');
						}
					echo"</div>";
				}
			echo"</div>";
		echo"</div>";
	}
    public function Interface_de_usuario2($array){
		/*		
			$Repostaje= new inface($database,$tabla,$phpv,$conexion);
			if(empty($view))$view='';
			if(empty($validacionFormularo))$validacionFormularo='';
			$TextColumna=array();
			####
				$ColumnasEspeciales=array();
				$Cambios=array(
					'Columna'=>array(
						'type'=>'despliegre_mysql',
						'database'=>'information_schema',
						"tabla"=>'COLUMNS',
						"Operacion"=>array(  
							'SELECT'=>array(
								"Activar"		=>'true',
								"getColumnas"	=>array('DISTINCT COLUMN_NAME'),
								"BuscaColumnas"	=>array('TABLE_NAME'),
								"BuscaDatos"	=>array($_POST['Tabla']),
								"ByOrder"		=>array(
									"Columna"	=>'COLUMN_NAME',
									"ASC-DESC"	=>'DESC'
								),
							)
						) ,
						"js"=>array(
							"onchange"=>array(
								"envia_formulario();",
							)
						),
						'interfaces'=>array(
							"ColumnasAMostrar"=>array('COLUMN_NAME'),
							"ColumnasAOcultar"=>array(),
							"ColumnaValue"=>array('COLUMN_NAME'),
							"ValoresAOcultar"=>array(
								'SCHEMA_NAME'=>array(
								),
							),
							"TextColumna"=>array(
								"COLUMN_NAME"=>'Columnas',
							)
						)
					)
				);
				$ColumnasEspeciales=array_merge($ColumnasEspeciales,$Cambios);								
			####
			$array=array(
				'tipo'=>array('formulario'=>'','lista'=>''),
				'class'=>array(
					'columnaFija'=>'',
					'casilla'=>'',
					'id'=>''
				),
				'style'=>array(
					'columna'=>' width:100%;',
					'TAG'=>	' width:200px;'
				)
            	'viewValidacion'=>'false',         
				'validacionFormularo'=>$validacionFormularo,
				'CambiosColumnas'=>array(
					'TextColumna'=>$TextColumna,                   
					'ColumnasEspeciales'=>$ColumnasEspeciales       
				),
				"Interfaces"=>array(
					"tablas_relacionadas"=>array(
						"Columnas_a_descargar"=>array(
							"Placas"=>'Placas',
							"Cliente"=>'Nombre',
							"Operador"=>'Nombre',
							"Tanque"=>'Nombre',
						)
					)
				),
				"Ocultar_columanas"=>array(

				),
				'ValoresAColumnas'=>array(
					'Fecha'=>array(
						'tipo'=>'Forzado',
						'valor'=>date("Y-m-d\TH-i")
					),
					'FechaCaptura'=>array(
						'tipo'=>'Forzado',
						'valor'=>date("Y-m-d")
					)
				),
				"lista"=>array(
					"ByOrder"=>array(
						"Columna"	=>'Fecha',
						"ASC-DESC"	=>'DESC'
					)
				)
			);
			$Repostaje->Interface_de_usuario($array); 
		*/ 
		
        #echo('<pre>');
        #print_r($array);
		#echo('</pre>');
		#### Configuraciones de arranque 
			static $index;
			if(empty($index))$index=1;
			$class=$array['class'];
			$red=' inset 0px 0px 0px 2px #b93939';
			$cielo=' inset 0px 0px 0px 2px #0080cc;';
			$orange=' inset 0px 0px 0px 2px orange;';

			$this->libre_v4->Columnas_Avanzado($this->database,$this->tabla);
			$this->libre_v4->RelacionDeTablas($this->database,$this->tabla);
			$this->libre_v4->KeyColumnUsege($this->database,$this->tabla);
			
			$this->libre_v4->ConsuColumnasUnicas($this->database,$this->tabla);
			$this->libre_v4->getConsuColumnasUnicas();

			$this->libre_v2->db($this->database,$this->conexion,$this->phpv);
			$datos_tabla	= $this->libre_v4->GetDatos_tabla();
			$key			= $this->libre_v4->getKeyColumnUsege();##columna primaria key
			$columnas		= $this->libre_v4->getColumnas();
			$values			= $this->libre_v4->ColunasInPost('');

				/*
				echo('<pre>');
				print_r($datos_tabla);
				echo('</pre>');
				*/
		#### Formulario
			/*
				if(isset($array['tipo']['formulario']) and $array['tipo']['formulario']=='true'){	
					for ($x=0; $x < count($columnas); $x++) { 
						#if(!empty($array['Oculta']) and !isset($array['Oculta'][$columnas[$x]])){
							if(!empty($array['Ocultar_columanas']) and isset($array['Ocultar_columanas'][$columnas[$x]])){continue;}

							$libre='';
							$style='';
							$maxlength='';
							#$js='onKeypress="return anti_enter(event);" onkeyup="EnterToTab(event,this);" ';
							if($x+1<count($columnas)){
								$next="'".$columnas[$x+1]."'";
								$js='onKeypress="return anti_enter(event);" onkeyup="FocusToNext(event,this,'.$next.');"';
							}
							############# asigna el focus 
								$colum=$this->libre_v4->getColumnas()[$x];
								if($columnas[$x]==$key){#$libre='readonly="readonly"';
								}else{
									$libre="tabindex='".$index."'"; 
									if($index==1){$libre=$libre.' autofocus ';}
									$index++;
								}
							############# indicadores de campos(vacios, valores invalidos o valore diferentes )
								if(!empty($array['viewValidacion']) and $array['viewValidacion']=='true' and !empty($array['validacionFormularo'])){	
									#echo array_keys($array['validacionFormularo']);
									#echo $array['validacionFormularo']['Valores_No_validos'][$columnas[$x]];
									if($array['validacionFormularo']['Campos_vacios']		[$columnas[$x]]==false)		{$style=$cielo;}
									if($array['validacionFormularo']['Valores_No_validos']	[$columnas[$x]]==false)		{$style=$red;}
									if($array['validacionFormularo']['noDefaul']			[$columnas[$x]]==false)		{$style=$orange;}
									if($array['validacionFormularo']['ColumnasRepetidas']	[$columnas[$x]]==false)		{$style=$orange;}
									if(gettype($array['validacionFormularo']['Error_especifico'][$columnas[$x]])=='string'){$style=$red;}
								}
							############# Comprueba	 si no existe una columna de texto cambiada 
								if(!empty($array['CambiosColumnas']['TextColumna'][$columnas[$x]])){
									$colum=$array['CambiosColumnas']['TextColumna'][$columnas[$x]];
								}
							#### titles
								echo $this->libre_v5->input('button','',$colum,'',$class['columnaFija'],'','disabled','');
							#### inputs
								$colum=$this->libre_v4->getColumnas()[$x];
							#### columnas espacial por database
								if(!empty($datos_tabla)){
									## limitador de caracteres 
										if($datos_tabla['CHARACTER_MAXIMUM_LENGTH']>0){
											$libre=$libre.$maxlength="maxlength='".$datos_tabla['CHARACTER_MAXIMUM_LENGTH'][$x]."'";
										}
									##	formato
										$type='text';
										#echo $datos_tabla['DATA_TYPE'][$x];
										if($datos_tabla['DATA_TYPE'][$x]=='varchar')	{$type='text';}
										if($datos_tabla['DATA_TYPE'][$x]=='date')		{$type='date';}
										if($datos_tabla['DATA_TYPE'][$x]=='int')		{$type='number';}
										if($datos_tabla['DATA_TYPE'][$x]=='float')		{$type='number';}
										if($datos_tabla['DATA_TYPE'][$x]=='smallint')	{$type='number';}
										if($datos_tabla['DATA_TYPE'][$x]=='tinyint')	{$type='number';}
										if($datos_tabla['DATA_TYPE'][$x]=='mediumint')	{$type='number';}
										if($datos_tabla['DATA_TYPE'][$x]=='time')		{$type='time';}
										if($datos_tabla['DATA_TYPE'][$x]=='timestamp')	{$type='date';$libre=$libre.'step="1"';}
										if($datos_tabla['DATA_TYPE'][$x]=='enum')		{$type='desplegable';						
											$res=$datos_tabla['COLUMN_TYPE'][$x];
											preg_match("/^enum\(\'(.*)\'\)$/", $res, $matches);
											$Options = explode("','", $matches[1]);
													
										}
								}
							#### JS para busqueda en base de datos(autoComplemento)

							#### Tablas Relacionadas
								$datos_cruzados=$this->libre_v4->SEARCH_RelacionDeTablas_BY_COLUMN_IN_RECIBE($colum);					
								if(gettype($datos_cruzados)!='NULL' and gettype($datos_cruzados)!='boolean'){
									
									#echo('<pre>');
									#print_r($datos_cruzados);
									#echo('</pre>');  
									#echo$datos_cruzados['Envia']['columna'];
									#echo "<br>";
									#	echo $this->tabla;
									#if($datos_cruzados['Recibe']['database']==$this->database and $datos_cruzados['Recibe']['tabla']==$this->tabla ){
									if($datos_cruzados['Recibe']['tabla']==$this->tabla ){
											
										$libre="style='".$style."' ".$js." id='".$colum."'";
										$tabla=$datos_cruzados['Envia']['tabla'];
										$database=$datos_cruzados['Envia']['database'];
										$getColumnas        = array('*') ;
										$BuscaColumnas      = array() ;
										$BuscaDatos         = array();
										
										$consulta=array(
											"tabla"=>$tabla,
											"Operacion"=>
											array('SELECT'=>array(
													"Activar"	=>'true',
													"LIKE"		=>'falses',
													"getColumnas"	=>$getColumnas,
													"BuscaColumnas"	=>$BuscaColumnas,
													"BuscaDatos"	=>$BuscaDatos,
												),
											)
										);
										if(isset($array['Tablas Relacionadas'][$columnas[$x]]['ByOrder'])){
											$consulta['Operacion']['SELECT']["ByOrder"]=$array['Tablas Relacionadas'][$columnas[$x]]['ByOrder'];
											
										}
										
										#echo('<pre>');
										#print_r($consulta);
										#echo('</pre>');  
										
										$this->Ares_v1->GeneraSql($consulta);
										
										$sql=$this->Ares_v1->getSql();
										#$this->Ares_v1->viewSql();
						
										$this->libre_v2->db($database,$this->conexion,$this->phpv);
										$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
										$type='despliegre_mysql';
										$this->libre_v4->KeyColumnUsege($database,$tabla);
										
										$columna_index_tablas= $this->libre_v4->getKeyColumnUsege();
											#Echo('<pre>');
											#print_r($array['Interfaces']);
											#echo('</pre>');   
											#echo $columnas[$x];
										
										#### asigna la columna(s) que se descargaran de tablas relacionadas 
										if(isset($array['Interfaces']['tablas_relacionadas']['Columnas_a_descargar']) and isset($array['Interfaces']['tablas_relacionadas']['Columnas_a_descargar'][$columnas[$x]])){							
											$atributoColumna['DatosMostrar']=$array['Interfaces']['tablas_relacionadas']['Columnas_a_descargar'][$columnas[$x]];
										}else{
											$atributoColumna['DatosMostrar']=$datos_cruzados['Envia']['columna'];
											#$atributoColumna['DatosMostrar']=$columna_index_tablas;
										}  
										#echo $this->libre_v2-> despliegre_mysql($colum,$colum,$atributoColumna['ConsultaMysql'],$atributoColumna['DatosMostrar'],$this->phpv,$libre,$class['casilla'],'','');		
									}
								}
								
							#### Comprueba si no existe una columna especial manualmente
								if(!empty($array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]])){
									$atributoColumna=$array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]];
									switch ($atributoColumna['type']) {
										case 'despliegre':
											//echo $this->libre_v2-> despieges($colum,'',$inicio,$fin,$libre,$id);
											$despieges=array(
												"name"=>$colum,
												"id"=>$colum,
												"Elementos"=>$atributoColumna['ListaDeDatos'],
												"TextComplemento"=>'',
												"class"=>$class['casilla'],
												"style"=>$style,
												"libre"=>$libre.$js.$colum
											);			
											echo $this->libre_v5->despieges($despieges);
										break;
										case 'despliegre_mysql':
											$libre="style='".$style."' ".$js." id='".$colum."'";
											echo $this->libre_v2-> despliegre_mysql($colum,$colum,$atributoColumna['ConsultaMysql'],$atributoColumna['DatosMostrar'],$this->phpv,$libre,$class['casilla'],'','');		
										break;
										case 'data':
											$type='date';
											echo $this->libre_v5->input($type,$colum,$values[$x],$colum,$class['casilla'],'',$libre.$js,$style);
										break;
									}
								}else{#### ejecuta Codigo Normal
									if(empty($type))$type='text';
									if($colum=='Fecha' or $colum=='fecha'){$type='date';}
									switch ($type) {
										case 'desplegable':
											$despieges=array(
												"name"=>$colum,
												"id"=>$colum,
												"Elementos"=>$Options,
												"TextComplemento"=>'',
												"class"=>$class['casilla'],
												"style"=>$style,
												"libre"=>$libre.$js.$colum
											);											
											echo $this->libre_v5->despieges($despieges);
										break;
										case 'despliegre_mysql':								
											$libre="style='".$style."' ".$js." id='".$colum."'";
											echo $this->libre_v2-> despliegre_mysql($colum,$colum,$res,$atributoColumna['DatosMostrar'],$this->phpv,$libre,$class['casilla'],'','');		
										break;
										
										default:
											echo $this->libre_v5->input($type,$colum,$values[$x],$colum,$class['casilla'],'',$libre.$js,$style);
										break;
									}
								}
						#}
					}
				}
			*/
		
			if(isset($array['tipo']['formulario']) and $array['tipo']['formulario']=='true'){	
				   
				for ($x=0; $x < count($columnas); $x++) { 
					if(!empty($array['Ocultar_columanas']) and isset($array['Ocultar_columanas'][$columnas[$x]])){continue;}
					####Delaracion de Variables
						$js='';
						$libre='';
						$style='';
						$propiedades=array(
							"objeto"=>'input',#input,select,textarea
							"type"=>'input',#input,button,submit,date,datetime ect.
							"name"=>$columnas[$x],
							"value"=>'',
							"id"=>$columnas[$x],
							"class"=>array($class['casilla']),#soportes para formato string o array 
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
						$Atributos['title']=array(
							"objeto"=>'input',#input,select,textarea
							"type"=>'button',#input,button,submit,date,datetime ect.
							"name"=>'',
							"value"=>$columnas[$x],
							"id"=>'',
							"class"=>array($class['columnaFija']),#soportes para formato string o array $class['columnaFija']
							"readonly"=>false,#true o false
							"disabled"=>true,#true o false
							"title"=>'',
							"style"=>array(
								"float"=>"left",
								"width"=>"",
								"background"=>'',
								"box-shadow"=>"",
							),
							"placeholder"=>'',
							"js"=>array(
							),
							"libre"=>array(						
							),
							"autofocus"=>''
						);
						
					#### Control de focus mediante tecla enter
						if($x+1<count($columnas)){
							$SigienteColumna="'".$columnas[$x+1]."'";
							$propiedades['js']['onKeypress']='return anti_enter(event);';####anular la tecla enter deve ser la ultima ya que canselas todas las demas funciones 
							$propiedades['js']['onkeyup']=Array(
								'FocusToNext(event,this,'.$SigienteColumna.');',
								'return anti_enter(event);',							####anular la tecla enter deve ser la ultima ya que canselas todas las demas funciones 
							);
						}
					
					#### Desactiva la columna primare que (ID en si mayor parte de las base de datos)
						if($columnas[$x]==$key){#Verifica si las columna es la primera key
							#$propiedades['libre'][]='readonly="readonly"';
							$propiedades['libre']['readonly']='readonly';
						}
					#### Control de focus  
						#### verifica si la columna esta vacia
							if($array['validacionFormularo']['Campos_vacios'][$columnas[$x]]==false and $propiedades['autofocus']==''){
								
								$propiedades['libre']['autofocus']='autofocus';	
							}

							#$propiedades['tabindex']='';
							#if($index==1){
							#	$propiedades['autofocus']=$index;	
							#}
							#$index++;	
							### requiere mejora para detectar casillas vacias						

					#### Control de Indicadores para estado de casillas (Vacias,Repetidad,Inalidas)
						#### indicadores de campos(vacios, valores invalidos o valore diferentes )
						
							#echo('<pre>');
							#print_r($array['validacionFormularo']['ColumnasRelacionadas']);
							#echo('</pre>');   
							if(!empty($array['viewValidacion']) and $array['viewValidacion']=='true' and !empty($array['validacionFormularo'])){	
							
								if($array['validacionFormularo']['Campos_vacios']		[$columnas[$x]]==false)		{$style=$cielo;}
								if($array['validacionFormularo']['Valores_No_validos']	[$columnas[$x]]==false)		{$style=$red;}
								if($array['validacionFormularo']['noDefaul']			[$columnas[$x]]==false)		{$style=$orange;}
								if(isset($array['validacionFormularo']['ColumnasRelacionadas']) and  $array['validacionFormularo']['ColumnasRelacionadas']	[$columnas[$x]]==false)		{$style=$red;}
								if(isset($array['validacionFormularo']['ColumnasRepetidas']) and  $array['validacionFormularo']['ColumnasRepetidas']	[$columnas[$x]]==false)		{$style=$orange;}
								if(gettype($array['validacionFormularo']['Error_especifico'][$columnas[$x]])=='string'){$style=$red;}
								
								$propiedades['style']['box-shadow']=$style;
							}
						#### Cambio de Texto de Las Columnas 
							if(!empty($array['CambiosColumnas']['TextColumna'][$columnas[$x]])){
								$Atributos['title']['value']=$array['CambiosColumnas']['TextColumna'][$columnas[$x]];
							}
					######## Presenta en la interfaces
						#### titles
							echo $this->libre_v5->inputArray($Atributos['title']);
						#### columnas especiales por database
							if(!empty($datos_tabla)){
								## limitador de caracteres 
									if($datos_tabla['CHARACTER_MAXIMUM_LENGTH']>0){
										$libre=$libre.$maxlength="maxlength='".$datos_tabla['CHARACTER_MAXIMUM_LENGTH'][$x]."'";
									}
								##	formato
									$type='text';
									if($datos_tabla['DATA_TYPE'][$x]=='varchar')	{$type='text';}
									if($datos_tabla['DATA_TYPE'][$x]=='date')		{$type='date';}
									if($datos_tabla['DATA_TYPE'][$x]=='datetime')	{$type='datetime-local';}
									if($datos_tabla['DATA_TYPE'][$x]=='int')		{$type='number';}
									if($datos_tabla['DATA_TYPE'][$x]=='float')		{$type='text'; }
									if($datos_tabla['DATA_TYPE'][$x]=='smallint')	{$type='number';}
									if($datos_tabla['DATA_TYPE'][$x]=='tinyint')	{$type='number';}
									if($datos_tabla['DATA_TYPE'][$x]=='mediumint')	{$type='number';}
									if($datos_tabla['DATA_TYPE'][$x]=='time')		{$type='time';}
									if($datos_tabla['DATA_TYPE'][$x]=='timestamp')	{$type='date';$libre=$libre.'step="1"';}
									if($datos_tabla['DATA_TYPE'][$x]=='enum')		{$type='desplegable';						
										$res=$datos_tabla['COLUMN_TYPE'][$x];
										preg_match("/^enum\(\'(.*)\'\)$/", $res, $matches);
										$Options = explode("','", $matches[1]);
												
									}
							}
						#### Busqueda en datos internos(datos repetidos UNICOS)  [se genera super posicion]
							$columnasUnicas=$this->libre_v4->getConsuColumnasUnicas();
							if(gettype($columnasUnicas)=='array'){
								if(in_array($columnas[$x],$columnasUnicas)){
									$type='textoBusqueda';
								}
							}
							if(gettype($columnasUnicas)=='string'){
								if($columnas[$x]==$columnasUnicas)
								 	$type='textoBusqueda';
							}
						#### Tablas Relacionadas(busqueda de datos )			[se requiere una version mejorada que combien las funciones]				 
							$colum=$this->libre_v4->getColumnas()[$x];
							$datos_cruzados=$this->libre_v4->SEARCH_RelacionDeTablas_BY_COLUMN_IN_RECIBE($colum);
							if(gettype( $datos_cruzados)=='array')	{
								$type='Columna_relacionada_tabla';
							} 
						#### Comprueba si no tiene valores predefinidos para la columna
							if(isset($array['ValoresAColumnas'][$columnas[$x]])){
								switch ($array['ValoresAColumnas'][$columnas[$x]]['tipo']) {
									case 'inicial':
										#echo 'inicial';
										if(isset($_POST[$propiedades['name']]) and empty($_POST[$propiedades['name']])){
											#$_POST[$propiedades['name']];
											$propiedades['value']=$array['ValoresAColumnas'][$columnas[$x]]['valor'];
										}
									break;
									case 'Forzado':
										#echo'forzado';
											$propiedades['value']=$array['ValoresAColumnas'][$columnas[$x]]['valor'];
									break;
									
								}
								#echo('<pre>');
								#print_r($array['ValoresAColumnas'][$columnas[$x]]);
								#echo('</pre>');
							}
						#### Comprueba si no existe una columna especial manualmente
							/*
								if(!empty($array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]])){
									$atributoColumna=$array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]];
									switch ($atributoColumna['type']) {
										case 'despliegre':
											//echo $this->libre_v2-> despieges($colum,'',$inicio,$fin,$libre,$id);
											$despieges=array(
												"name"=>$colum,
												"id"=>$colum,
												"Elementos"=>$atributoColumna['ListaDeDatos'],
												"TextComplemento"=>'',
												"class"=>$class['casilla'],
												"style"=>$style,
												"libre"=>$libre.$js.$colum
											);			
											echo $this->libre_v5->despieges($despieges);
										break;
										case 'despliegre_mysql':
											$libre="style='".$style."' ".$js." id='".$colum."'";
											echo $this->libre_v2-> despliegre_mysql($colum,$colum,$atributoColumna['ConsultaMysql'],$atributoColumna['DatosMostrar'],$this->phpv,$libre,$class['casilla'],'','');		
										break;
										case 'data':
											$type='date';
											echo $this->libre_v5->input($type,$colum,$values[$x],$colum,$class['casilla'],'',$libre.$js,$style);
										break;
									}
								}
							*/
							if(isset($array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]])){
								$columnas_especiales=$array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]];
								
								#$datos_cruzados=$array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]]['DatosCruzados'];
								
								$type=$columnas_especiales['type'];
								#$propiedades=$columnas_especiales['propiedades'];
							}
							
						####
							if(empty($type))$type='text';
							if($colum=='Fecha' or $colum=='fecha'){$type='date';}
							#echo$type;
							
							#$propiedades['js']['onChange']='envia_formulario();';
							switch ($type) {#despliegre
								case 'despliegre':
									$datos_lista=$array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]];
									$js="onChange='envia_formulario();'";
									$despieges=array(
										"name"=>$colum,
										"id"=>$colum,
										"Elementos"=>$datos_lista['ListaDeDatos'],
										"TextComplemento"=>'',
										"class"=>$class['casilla'],
										"style"=>$style,
										"libre"=>$libre.$js.$colum
									);											
									echo $this->libre_v5->despieges($despieges);
								break;
								#case 'despliegre_mysql':
								#	$libre="style='".$style."' ".$js." id='".$colum."'";
								#	echo $this->libre_v2-> despliegre_mysql($colum,$colum,$Datos_tabla_emisora,$atributoColumna['DatosMostrar'],$this->phpv,$libre,$class['casilla'],'','');		
								#break;	
								case'textoBusqueda':
									$array_textoBusqueda=array(
										"Columna_name"=>$colum,
										"Atributos"=>$propiedades,
										"Database"=>$this->database,
										"tabla"=>$this->tabla,

										#"ColumnasAMostrar"=>array('Nombre'),
									);
									echo $this->textoBusqueda($array_textoBusqueda);

								break;
								case'Columna_relacionada_tabla':
									$array_desplegable_text_busqueda=array(
										"Columna_name"=>$colum,
										"tabla"=>$this->tabla,
										"DatosCruzados"=>$datos_cruzados,
										"Atributos"=>$propiedades,
										#"ColumnasAMostrar"=>array('Nombre'),
										
									);
									echo $this->desplegable_text_busqueda($array_desplegable_text_busqueda);
								break;		
								case 'despliegre_mysql':									
									$despliegre_mysql_array=array_merge($propiedades,$columnas_especiales);								
									$this->libre_v5->despliegre_mysql_array($despliegre_mysql_array);
								break;	
								case 'despliegre_mysql2':	
									$array_desplegable_text_busqueda=array(
										"Columna_name"=>$colum,
										"tabla"=>$this->tabla,
										"DatosCruzados"=>$datos_cruzados,
										"Atributos"=>$propiedades,										
									);													
									echo $this->desplegable_text_busqueda($array_desplegable_text_busqueda);
								break;								
								default:
									$propiedades['type']=$type;
									echo $this->libre_v5->inputArray($propiedades);
								break;
							}
							
					
				}
			}
		#### Lista
			if(isset($array['tipo']['lista']) and $array['tipo']['lista']=='true'){	
				#Presentas Las cabezeras
				/*
					echo"<div  class='Elementos_lista'  style='min-width: max-content;'>";         
						for ($x=0; $x < count($columnas); $x++) {							
							if(isset($array["Ocultar_columanas"][$columnas[$x]]) and $array["Ocultar_columanas"][$columnas[$x]]=='true') continue;						
							$libre='';
							if($columnas[$x]==$key){
								$CLASS=$class['id'];
							}else{
								$CLASS=$class['columnaFija'];
							}
							############# Comprueba	 si no existe una columna de texto cambiada 
								if(!empty($array['CambiosColumnas']['TextColumna'][$columnas[$x]])){
									$columna_presenta=$array['CambiosColumnas']['TextColumna'][$columnas[$x]];
								}else{
									$columna_presenta=$columnas[$x];
								}
							$type='submit';
							if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){$type='date';$libre='disabled';}
							echo $this->libre_v5->input($type,'Control_'.$columnas[$x],$columna_presenta,'',$CLASS,$columna_presenta,$libre,'');
						}			
					echo"</div>";
						*/
			#### Cabezera 
				#### Busquedas
					echo"<div id='Control_busqueda' style='position: relative;min-height: 20px;'>";
						echo $this->libre_v2->input2('text','Buscar_lista','','','width: 75%;background: white; color:black;','','placeholder="Buscar En Registros"','Celdas Medio botones_submenu');
						echo $this->libre_v2->input2('submit','Operadores_listas','','Buscar','width: 25%; ','','','Celdas Medio botones_submenu');
					echo"</div>";	

				$ByOrder='';
				## asigna orden de forma predeterminada (INICIO DE MEMROAIS )
					if(!empty($array['lista']['ByOrder']))$ByOrder=$array['lista']['ByOrder'];
					## asignacion de orden por usuarip 
					#if(isset($_POST['OrdenaLista_'.$this->tabla])){
					#	echo$_POST['OrdenaLista_'.$this->tabla];
					#}
				### genera la memoria de control de orden
				#if(isset($_POST['OrdenaLista_'.$this->tabla]) or isset($_POST['memoOrdenaLista_'.$this->tabla]) ){
				if(isset($_POST['OrdenaLista_'.$this->tabla]) ){
					$_POST['memoOrdenaLista_'.$this->tabla]=$_POST['OrdenaLista_'.$this->tabla];
					#echo$_POST['memoOrdenaLista_'.$this->tabla];
					#echo$_POST['OrdenaLista_'.$this->tabla];
					#echo"entro";
					if(!isset($_POST['direcOrdenaLista_'.$this->tabla]))$_POST['direcOrdenaLista_'.$this->tabla]='DESC';
					#### detecta cuand o selecionan una columna para ordenar 
					if($_POST['direcOrdenaLista_'.$this->tabla]=='DESC' and ($_POST['OrdenaLista_'.$this->tabla]==$_POST['memoOrdenaLista_'.$this->tabla] )){
						$_POST['direcOrdenaLista_'.$this->tabla]='ASC';
					}elseif($_POST['direcOrdenaLista_'.$this->tabla]=='ASC' and ($_POST['OrdenaLista_'.$this->tabla]==$_POST['memoOrdenaLista_'.$this->tabla] )){
						$_POST['direcOrdenaLista_'.$this->tabla]='DESC';
					}
					#if(isset($_POST['OrdenaLista_'.$this->tabla])){
					#	$_POST['memoOrdenaLista_'.$this->tabla]=$_POST['OrdenaLista_'.$this->tabla];
					#}

					
					if(!isset($_POST['direcOrdenaLista_'.$this->tabla])){$_POST['direcOrdenaLista_'.$this->tabla]='DESC';}
					#echo $this->libre_v5->input('text','memoOrdenaLista_'.$this->tabla,'','','','','','');					
					#echo $this->libre_v5->input('text','direcOrdenaLista_'.$this->tabla,'','','','','','');					
				}
				if(isset($_POST['memoOrdenaLista_'.$this->tabla])){
					echo $this->libre_v5->input('hidden','memoOrdenaLista_'.$this->tabla,'','','','','','');					
					echo $this->libre_v5->input('hidden','direcOrdenaLista_'.$this->tabla,'','','','','','');
		
					$ByOrder=array(
						"Columna"	=>$_POST['memoOrdenaLista_'.$this->tabla],
						"ASC-DESC"	=>$_POST['direcOrdenaLista_'.$this->tabla]
					);
				}
				##'OrdenaLista_'.$this->tabla
				#### consulta Global
					$array_GeneraSql=array(
						"tabla"=>$this->tabla,
						"Operacion"=>
						array('SELECT'=>array(
								"Activar"	=>'true',//'false'
								"LIKE"		=>'false',//'false'
								"getColumnas"	=>array('*'),
								"BuscaColumnas"	=>false,
								"BuscaDatos"	=>false,
								"ByOrder"		=>$ByOrder
								
							)
						)
					);
					$this->Ares_v1->GeneraSql($array_GeneraSql);
					$sql=$this->Ares_v1->getSql();
					#$this->Ares_v1->viewSql();
					$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);     
					$resultados_totales=$this->libre_v2->mysql_nu_ro($res,$this->phpv);
				#### Consulta Especifica
					$resultados_busqueda='Ninguna Busqueda';
					if(isset($_POST['Buscar_lista'])and !empty($_POST['Buscar_lista'])) {
						#Busqueda en cualquier lugar
							$array_busqueda=array() ;
							for ($i=0; $i <count($columnas) ; $i++) { 
								$array_busqueda[]=$_POST['Buscar_lista'];
							}
							$array_GeneraSql=array(
								"tabla"=>$this->tabla,
								"Operacion"=>
								array('SELECT'=>array(
										"Activar"		=>'true',//'false'
										"LIKE"			=>'true',//'false'
										"%"				=>'true',
										"getColumnas"	=>array('*'),
										"BuscaColumnas"	=>$columnas,
										"BuscaDatos"	=>$array_busqueda,
										"LOWER"			=>'true',
										#"ByOrder"		=>array(
										#	"Columna"	=>'Columna',
										#	"ASC-DESC"	=>'DESC'
										#),
										
									)
								)
							);
							
							#echo('<pre>');
							#print_r($columnas);
							#echo('</pre>');
							$this->Ares_v1->GeneraSql($array_GeneraSql);
							$sql=$this->Ares_v1->getSql();
							#$this->Ares_v1->viewSql();     
							$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);     
							$resultados_busqueda=$this->libre_v2->mysql_nu_ro($res,$this->phpv);
					}
				####
				echo "<div id='NumerosdeRegistros' style='position: relative;	float: left;	width: 100%;'>";
					#### Numero de registros totales
						echo"<div  style=' float: left; min-width: 250px;'>";
						echo $this->libre_v5->input('button','','Total de Registros','','Diseno_botones2','','','width:80%;');
						echo $this->libre_v5->input('button','',$resultados_totales,'','Diseno_botones3','','','width:20%;');

							#echo"<label class='Celdas Medio  Diseno_botones2  Diseno_botones2 ' style='width:20%;'>Total de Registros</label>";
							#echo"<label class='Celdas Medio  Diseno_botones3 ' style='width:20%;'>$resultados_totales</label>";
						echo"</div>";
					#### Numero de registros en busqueda
						echo"<div style=' float: left; min-width: 250px;'>";
							echo $this->libre_v5->input('button','','Registros de busqueda','','Diseno_botones2','','','width:80%;');
							echo $this->libre_v5->input('button','',$resultados_busqueda,'','Diseno_botones3','','','width:20%;');
							#echo"<label class='Celdas Medio  Diseno_botones2 ' style='width:20%;'>Registros de busqueda </label>";
							#echo"<label class='Celdas Medio botones_submenu' style='width:20%;'>$resultados_busqueda</label>";
						echo"</div>";
				echo"</div>";
				#### Titles
				echo"<div  class='Elementos_lista oculta_table'  style='min-width: max-content;'>";
				
				         
					for ($x=0; $x < count($columnas); $x++) { 
						#if(isset($array["Ocultar_columanas"][$columnas[$x]])=='true')break;
						$libre='';
						####control class para el primare KEY
							if($columnas[$x]==$key){
								$CLASS=$class['id'];
							}else{
								$CLASS=$class['casilla'];
							}
						$type='submit';
						if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){
							#$type='date';
							$libre='disabled';
						}
						if(isset($array['style'][$columnas[$x]]))$style=$array['style'][$columnas[$x]];else$style='';
						echo $this->libre_v5->input($type,'OrdenaLista_'.$this->tabla,$columnas[$x],'',$CLASS,'',$libre,$style);
					}			
				echo"</div>";
			//inicia revisar lso datos desde la parte superior 
			#### listas de datos
			
					echo "<div id='Conte_lista' stlye='width: max-content;'>";
						while ($fila = mysqli_fetch_array($res)) {   #### Cabezera 
							echo"<div class='Contenedor_elementos'>";
								echo"<div  class='Elementos_lista oculta_escritorio'  >";         
									for ($x=0; $x < count($columnas); $x++) { 
										$libre='';
										if($columnas[$x]==$key){
											$CLASS=$class['id'];
										}else{
											$CLASS=$class['casilla'];
										}
										$type='submit';
										if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){
											#$type='date';
											$libre='disabled ';

										}
										if(isset($array['style'][$columnas[$x]]))$style=$array['style'][$columnas[$x]];else$style='';
										echo $this->libre_v5->input($type,'',$columnas[$x],'',$CLASS,'',$libre,$style);
									}			
								echo"</div>";      
								echo"<div class='Elementos_lista' style='width: max-content;'>";
									for ($x=0; $x < count($columnas); $x++) { 
										
										#if(isset($array["Ocultar_columanas"][$columnas[$x]]) and $array["Ocultar_columanas"][$columnas[$x]]=='true')break;
										$type='submit';
										$name='';
										$libre='';
										if($columnas[$x]==$key){
											$name='Descargar';
											$CLASS=$class['id'];
										}else{
											$CLASS=$class['casilla'];
											$libre='disabled';
										}
										if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){$libre='disabled';}
										if(empty($fila[$columnas[$x]])){$fila[$columnas[$x]]=" ";}
										if(isset($array['style'][$columnas[$x]]))$style=$array['style'][$columnas[$x]];else$style='';
										echo $this->libre_v5->input($type,$name,$fila[$columnas[$x]],'',$CLASS,$fila[$columnas[$x]],$libre,$style);
									}
								echo"</div>";
							echo"</div>";
						}
					echo"</div>";
		
			}
	}
	public function Interface_de_usuario($array){
		echo "Procesos transferidos";
	}
	public function textoBusqueda($array){#interna
        /*
            $array_textoBusqueda=array(
                "Columna_name"=>$colum,
                "tabla"=>$this->tabla,
                "DatosCruzados"=>$datos_cruzados,
                "Atributos"=>$propiedades,
				"ColumnasAMostrar"=>array(),
                
            );
         */
		$array_title["Atributos"]['title']=array(
			"objeto"=>'input',#input,select,textarea
			"type"=>'button',#input,button,submit,date,datetime ect.
			"name"=>'',
			"value"=>'Busqueda Interna',#busca en una tabla relacionada
			"id"=>'',
			"class"=>array('Diseno_botones3'),#soportes para formato string o array 
			"readonly"=>false,#true o false
			"disabled"=>false,#true o false
			"title"=>'',
			"style"=>array(
				"width"=>"100%",
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
		$array['Atributos']['style']['width']="100%";
		$array['Atributos']['class'][]="Activapopmenu2";
		if(gettype($array['Atributos']['js'])=='array'){
			if(isset($array['Atributos']['js']['onkeyup']) and count($array['Atributos']['js'])	>0){		
				array_unshift($array['Atributos']['js']['onkeyup'],"textoBusqueda(this);");
				#echo"al inicio";
			}else{
				$array['Atributos']['js']['onkeyup'][]="textoBusqueda(this);";
				#echo"al final";
			}
		}
		
		$array['Atributos']['libre']['Seletor_database']=$array['Database'];
		$array['Atributos']['libre']['Tabla-solicita']=$array['tabla'];
		$array['Atributos']['libre']['Columna-solicita']=$array['Columna_name'];
		   

		echo "<div style='float: left; width: 65%;'>";
            echo "<div class='Activapopmenu2'>";
               echo $this->libre_v5->inputArray($array["Atributos"]);
            echo "</div>";
			echo"<div class='popmenu2' style='color: Black;' id='Conte_lista_".$array["Columna_name"]."'>";
				
            	echo "<div class='popmenu2_opction' id='Conte_lista_".$array["Columna_name"]."'>";	
					$AtributosBotones=$array['Atributos'];
					
					$AtributosBotones['class'][]="Diseno_botones3_option";
					$GeneraSql=array(
						"tabla"=>$array['tabla'],
						"Operacion"=>
						array(  
							'viewSQL'=>'',    
							'SELECT'=>array(
								"Activar"		=>'true',
								"LIKE"			=>'true',
								"LOWER"			=>'true',
								"getColumnas"	=>array('*'),
								#"BuscaColumnas"	=>array(),
								#"BuscaDatos"	=>$BuscaDatos,
								#"Condiciones"	=>$Condiciones,
							),
						)
					);
					$this->Ares_v1->GeneraSql($GeneraSql);
					$sql=$this->Ares_v1->getSql();
					#$this->Ares_v1->ViewSql();
					$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
					echo  $this->libre_v5->inputArray($array_title["Atributos"]['title']);
					while($datos= $this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
						if(!empty($array['ColumnasAMostrar']) and (count($array['ColumnasAMostrar'])<=0)){
							echo"Requiere Expancionsb";
						}
						$AtributosBotones['value']=$datos[$array['Columna_name']];
						$AtributosBotones['type']='submit';
						$AtributosBotones['id']="";
						
						echo $this->libre_v5->inputArray($AtributosBotones);
					}	
				echo "</div>";
			echo "</div>";
			
		echo "</div>";

	}
	function desplegable_text_busqueda($array){#externa
        /*
            $array_desplegable_text_busqueda=array(
                "Columna_name"=>$colum,
                "tabla"=>$this->tabla,
                "DatosCruzados"=>$datos_cruzados,
                "Atributos"=>$propiedades,
				"ColumnasAMostrar"=>array(),
                
            );
         */
		
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
				"width"=>"100%",
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
		$array['Atributos']['style']['width']="100%";
		#    echo "<br>";
       	#echo('<pre>');
    	#print_r($array['Atributos']['js']);
		#echo('</pre>');
		#echo count($array['Atributos']['js']);
		if(gettype($array['Atributos']['js'])=='array'){
			if(isset($array['Atributos']['js']['onkeyup']) and count($array['Atributos']['js'])	>0){		
				array_unshift($array['Atributos']['js']['onkeyup'],"desplegable_text_busqueda(this);");
			}else{
				$array['Atributos']['js']['onkeyup'][]="desplegable_text_busqueda(this);";
			}
		}
		$array['Atributos']['libre']['Seletor_database']=$array['DatosCruzados']['Envia']['database'];
		$array['Atributos']['libre']['Tabla-Emisora']=$array['DatosCruzados']['Envia']['tabla'];
		$array['Atributos']['libre']['Columna-Emisora']=$array['DatosCruzados']['Envia']['columna'];
		$array['Atributos']['libre']['Tabla-solicita']=$array['DatosCruzados']['Recibe']['tabla'];
		$array['Atributos']['libre']['Columna-solicita']=$array['DatosCruzados']['Recibe']['columna'];
		   

		echo "<div style='float: left;     width: 65%;'>";
            echo "<div class='Activapopmenu2'>";
               echo $this->libre_v5->inputArray($array["Atributos"]);
            echo "</div>";
			echo"<div class='popmenu2' style='color: Black;' >";
			
            	echo "<div class='popmenu2_opction' id='Conte_lista_".$array['DatosCruzados']['Recibe']['columna']."'>";	

					$DatosTablaEmisora=$array['DatosCruzados']['Envia'];
					$AtributosBotones=$array['Atributos'];
					$AtributosBotones['class'][]=" Activapopmenu2 ";	
					$AtributosBotones['class'][]="Diseno_botones3_option";
					$GeneraSql=array(
						"tabla"=>$DatosTablaEmisora['tabla'],
						"Operacion"=>
						array(  
							'viewSQL'=>'',    
							'SELECT'=>array(
								"Activar"		=>'true',
								"LIKE"			=>'true',
								"LOWER"			=>'true',
								"getColumnas"	=>array('*'),
								#"BuscaColumnas"	=>array(),
								#"BuscaDatos"	=>$BuscaDatos,
								#"Condiciones"	=>$Condiciones,
								"ByOrder"		=>array(
									"Columna"	=>$DatosTablaEmisora['columna'],
									"ASC-DESC"	=>'ASC'
								),
							),
						)
					);
					$this->Ares_v1->GeneraSql($GeneraSql);
					$sql=$this->Ares_v1->getSql();
					#$this->Ares_v1->ViewSql();
					$this->libre_v2->db($DatosTablaEmisora['database'],$this->conexion,$this->phpv);
					$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
					echo  $this->libre_v5->inputArray($array_title["Atributos"]['title']);
					while($datos= $this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
						if(!empty($array['ColumnasAMostrar']) and (count($array['ColumnasAMostrar'])<=0)){
							echo"Requiere Expancionsb";
						}
						$AtributosBotones['value']=$datos[$DatosTablaEmisora['columna']];
						$AtributosBotones['type']='submit';
						#$array["Atributos"]['style']='width: 100%;box-shadow: inset 0px -2px 1px -1px rebeccapurple;background: white;color: black;border-bottom-width: 3px;border-bottom-color: red;';
						$AtributosBotones['id']="";
						echo $this->libre_v5->inputArray($AtributosBotones);
					}
				echo "</div>";
			echo "</div>";
			
		echo "</div>";
	}
	/*
    public function Interface_de_usuario($array){
		/*
			$Repostaje= new inface($database,$tabla,$phpv,$conexion);
			if(empty($view))$view='';
			if(empty($validacionFormularo))$validacionFormularo='';
			$TextColumna=array();
			$ColumnasEspeciales=array();
			$array=array(
				'tipo'=>array('formulario'=>'','lista'=>''),
				'class'=>array(
					'columnaFija'=>'',
					'casilla'=>'',
					'id'=>''
				),
				'validacionFormularo'=>$validacionFormularo,
				'CambiosColumnas'=>array(
					'TextColumna'=>$TextColumna,                     //remplaza el nombre de una columna contador_inicial -> Inicio de Contador 
					'ColumnasEspeciales'=>$ColumnasEspeciales       //si se activa es te puede ingresar algo diferente a text
				),
				"lista"=>array(
					"ByOrder"=>array(
						"Columna"	=>'Fecha',
						"ASC-DESC"	=>'DESC'
					)
				)
				"Ocultar_columanas"=>array(

				)
			);
			$Repostaje->Interface_de_usuario($array);  
		/
			
			static $index;
			if(empty($index))$index=1;
			$class=$array['class'];
			$red='box-shadow: inset 0px 0px 0px 2px #b93939';
			$cielo='box-shadow: inset 0px 0px 0px 2px #0080cc;';
			$orange='box-shadow: inset 0px 0px 0px 2px orange;';

			$this->libre_v4->Columnas($this->database,$this->tabla);
			$this->libre_v4->KeyColumnUsege($this->database,$this->tabla);
			$this->libre_v2->db($this->database,$this->conexion,$this->phpv);
			$key	= $this->libre_v4->getKeyColumnUsege();
			$columnas= $this->libre_v4->getColumnas();
			$values= $this->libre_v4->ColunasInPost('');
			
		if($array['tipo']['formulario']=='true'){
			
			for ($x=0; $x < count($columnas); $x++) { 
				$libre='';
				$style='';
				#$js='onKeypress="return anti_enter(event);" onkeyup="EnterToTab(event,this);" ';
				if($x+1<count($columnas)){
					$next="'".$columnas[$x+1]."'";
					$js='onKeypress="return anti_enter(event);" onkeyup="FocusToNext(event,this,'.$next.');"';
				}
				$colum=$this->libre_v4->getColumnas()[$x];
				if($columnas[$x]==$key){$libre='readonly="readonly"';}else{
					$libre="tabindex='".$index."'"; 
					if($index==1){$libre=$libre.' autofocus ';}
					$index++;
				}
				############# indicadores de campos(vacios, valores invalidos o valore diferentes )
				
				if(!empty($array['viewValidacion']) and $array['viewValidacion']=='true' and !empty($array['validacionFormularo'])){	
					#echo array_keys($array['validacionFormularo']);
					#echo $array['validacionFormularo']['Valores_No_validos'][$columnas[$x]];
					if($array['validacionFormularo']['Campos_vacios'][$columnas[$x]]==false)		{$style=$cielo;}
					if($array['validacionFormularo']['Valores_No_validos'][$columnas[$x]]==false)	{$style=$red;}
					if($array['validacionFormularo']['noDefaul'][$columnas[$x]]==false)				{$style=$orange;}
					if(gettype($array['validacionFormularo']['Error_especifico'][$columnas[$x]])=='string'){$style=$red;}
					
				}
				############# Comprueba	 si no existe una columna de texto cambiada 
					if(!empty($array['CambiosColumnas']['TextColumna'][$columnas[$x]])){
							$colum=$array['CambiosColumnas']['TextColumna'][$columnas[$x]];
						
					}
				#columnas
					echo $this->libre_v5->input('button','',$colum,'',$class['columnaFija'],'','disabled','');
				#input
					$colum=$this->libre_v4->getColumnas()[$x];
					# Comprueba si no existe una columna especial 		
					if(!empty($array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]])){		#verifica si ingreso algun dato para cambia las columnas Actual
						$atributoColumna=$array['CambiosColumnas']['ColumnasEspeciales'][$columnas[$x]];
						switch ($atributoColumna['type']) {
							case 'despliegre':
								//echo $this->libre_v2-> despieges($colum,'',$inicio,$fin,$libre,$id);
								$despieges=array(
									"name"=>$colum,
									"id"=>$colum,
									"Elementos"=>$atributoColumna['ListaDeDatos'],
									"TextComplemento"=>'',
									"class"=>$class['casilla'],
									"style"=>$style,
									"libre"=>$libre.$js.$colum
								);			
								echo $this->libre_v5->despieges($despieges);
							break;
							case 'despliegre_mysql':
								$libre="style='".$style."' ".$js." id='".$colum."'";
								echo $this->libre_v2-> despliegre_mysql($colum,$colum,$atributoColumna['ConsultaMysql'],$atributoColumna['DatosMostrar'],$this->phpv,$libre,$class['casilla'],'','');		
							break;
							case 'data':
								$type='date';
								echo $this->libre_v5->input($type,$colum,$values[$x],$colum,$class['casilla'],'',$libre.$js,$style);
							break;
						}
					}
				############# ejecuta Codigo Normal
				else{
					$type='input';
					if($colum=='Fecha' or $colum=='fecha'){$type='date';}
					
					echo $this->libre_v5->input($type,$colum,$values[$x],$colum,$class['casilla'],'',$libre.$js,$style);
				}
			}
		}
		if($array['tipo']['lista']=='true'){	
			#### Cabezera 
			echo"<div  class='Elementos_lista oculta_table'  style='min-width: max-content;'>";         
				for ($x=0; $x < count($columnas); $x++) { 
					#if(isset($array["Ocultar_columanas"][$columnas[$x]])=='true')break;
					$libre='';
					if($columnas[$x]==$key){
						$CLASS=$class['id'];
					}else{
						$CLASS=$class['casilla'];
					}
					$type='submit';
					if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){$type='date';$libre='disabled';}
					echo $this->libre_v5->input($type,'',$columnas[$x],'',$CLASS,'',$libre,'');
				}			
			echo"</div>";
			$ByOrder='';
			if(!empty($array['lista']['ByOrder']))$ByOrder=$array['lista']['ByOrder'];
			#descarga los datos de la lista a presentar 
			$array=array(
				"tabla"=>$this->tabla,
				"Operacion"=>
				array('SELECT'=>array(
						"Activar"	=>'true',//'false'
						"LIKE"		=>'false',//'false'
						"getColumnas"	=>array('*'),
						"BuscaColumnas"	=>false,
						"BuscaDatos"	=>false,
						"ByOrder"		=>$ByOrder
						
					)
				)
			);
			$this->Ares_v1->GeneraSql($array);
			$sql=$this->Ares_v1->getSql();
			$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
			#mysqli_data_seek($res,0);                                                          //inicia revisar lso datos desde la parte superior 
			#presentas los registros de las lista 
				#echo "<div id='conte_lista' style='overflow: auto;min-height: 50px;max-height: 500px;min-width: max-content;'>";
				echo "<div id='conte_lista' >";
					while ($fila = mysqli_fetch_array($res)) {   #### Cabezera 
						echo"<div class='Contenedor_elementos'>";
							echo"<div  class='Elementos_lista oculta_escritorio'  >";         
								for ($x=0; $x < count($columnas); $x++) { 
									$libre='';
									if($columnas[$x]==$key){
										$CLASS=$class['id'];
									}else{
										$CLASS=$class['casilla'];
									}
									$type='submit';
									if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){$type='date';$libre='disabled';}
									echo $this->libre_v5->input($type,'',$columnas[$x],'',$CLASS,'',$libre,'');
								}			
							echo"</div>";      
							echo"<div class='Elementos_lista'>";
								for ($x=0; $x < count($columnas); $x++) { 
									
									#if(isset($array["Ocultar_columanas"][$columnas[$x]]) and $array["Ocultar_columanas"][$columnas[$x]]=='true')break;
									$type='submit';
									$name='';
									$libre='';
									if($columnas[$x]==$key){
										$name='Descargar';
										$CLASS=$class['id'];
									}else{
										$CLASS=$class['casilla'];
										$libre='disabled';
									}
									if($columnas[$x]=='Fecha' or $columnas[$x]=='fecha'){$libre='disabled';}
									if(empty($fila[$columnas[$x]])){$fila[$columnas[$x]]=" ";}
									echo $this->libre_v5->input($type,$name,$fila[$columnas[$x]],'',$CLASS,'',$libre,'');
								}
							echo"</div>";
						echo"</div>";
					}
				echo"</div>";
		}
	}
	*/
	public function menuHorizontal($name_menu,$elemento_menu,$otros_arrays){		
		
		if(empty($otros_arrays['ocultar']))$otros_arrays['ocultar']='';
		$class=array(
			'Conte_principal'=>'Lateral',
			'Div_Opcion'=>'',
			'Boton'=>'Boton_menu1',
			'img'=>''
		);
		$otros_arrays=array(
			'img_activa'=> 'false',
			'img_defaul'=>'/img/defaul.jpg',
			'img'=>array(),
			'memoria'=>array('Activa'=>true,'type'=>'hidden'),
			'ocultar'=>$otros_arrays['ocultar']
		);
		$this->libre_v5->menu($name_menu,$elemento_menu,$class,$otros_arrays);
	}
	
    
}
class interfas{
	private $Ares_v1;
	private $libre_v1;
	private $libre_v2;
	private $libre_v4;
	private $libre_v5;
	private $phpv;
	private $conexion;
	private $database;
	private $tabla;
	private $array_consulta;
	private $datos_consulta_tabla;
	private $sql_consulta_tabla;
	/*
	$interfas=array(
		"database"=>$database,
		"tabla"=>$tabla,
		"phpv"=>$phpv,
		"conexion"=>$conexion,
	);
	*/
	public function __construct($interfas){
		$this->database	=$interfas['database'];
		$this->tabla	=['tabla'];
		$this->Ares_v1	=new Ares_v1();		
		$this->libre_v1	=new libre_v1();	
		$this->libre_v2	=new libre_v2($interfas['phpv'],$interfas['conexion']);	
		$this->libre_v4	=new libre_v4($interfas['phpv'],$interfas['conexion']);	
		$this->libre_v5	=new libre_v5($interfas['phpv'],$interfas['conexion'],'');
		$this->phpv=$interfas['phpv'];	
		$this->conexion=$interfas['conexion'];
	}
	
	public function control_ventana($array){
		$name_div_conte=$array['name'];
		$style_name_div_conte='style_'.$name_div_conte;
			#### cambios memoria
				if(empty($array['memoria']['type'])){$array['memoria']['type']='hidden';}
			#### cambios boton 
				#### funcion switch
				if(empty($_POST[$style_name_div_conte]))$_POST[$style_name_div_conte]='block';
				if(!empty($_POST[$name_div_conte])){
					if($_POST[$style_name_div_conte]=='block'){
						$DIV_style_display='none';
					}else{
						$DIV_style_display='block';
					}
				}else{
					$DIV_style_display=$_POST[$style_name_div_conte];
				}
			#### presenta 
			#echo$this->libre_v5->input($memoria['type'],$style_name_div_conte,$DIV_style_display,$style_name_div_conte,'','','','float: right;width: max-content');
			echo$this->libre_v5->input('button',$name_div_conte,$array['value'],'','','','onclick="OcultarDIV(this);"','float: right;width: max-content');
	}
}
class ProcesosMysql{
	private $libre_v1;
	private $libre_v2;
	private $phpv;
	private $conexion;
	private $database;
	private $lista_db;
	private $lista_tablas;
	private $lista_columnas;
	private $tabla;
	public function __construct($phpv,$conexion){	
		$this->libre_v1	=new libre_v1();	
		$this->libre_v2	=new libre_v2($phpv,$conexion);	
		$this->Ares_v1	=new Ares_v1();	
		$this->phpv=$phpv;	
		$this->conexion=$conexion;	
	}
	public function lista_DB($array){
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		
		$GeneraSql_array=array(
			"tabla"=>'SCHEMATA',
			"Operacion"=>
			array(  
				'viewSQL'=>'false', 
				'SELECT'=>array(
					"Activar"	=>'true',
					"LIKE"		=>'falses',
					"getColumnas"	=>array('SCHEMA_NAME'),
					"BuscaColumnas"	=>array(),
					"BuscaDatos"	=>array(),
					"Condiciones"	=>array(),
				),      
			)
		);
		$this->Ares_v1->GeneraSql($GeneraSql_array);
		$sql=$this->Ares_v1->getSql();
		$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
		$lista=array();
		while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
			$lista[]=$datos['SCHEMA_NAME'];
		}
		$this->lista_DB=$lista;
	}
	public function getlista_DB(){
		return $this->lista_DB;
	}
	public function viewlista_DB(){       
        echo('<pre>');
        print_r($this->lista_DB);
		echo('</pre>'); 
	}
	
	public function lista_Tablas($array){
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		
		$GeneraSql_array=array(
			"tabla"=>'TABLES',
			"Operacion"=>
			array(  
				'viewSQL'=>'false', 
				'SELECT'=>array(
					"Activar"	=>'true',
					"LIKE"		=>'falses',
					"getColumnas"	=>array('TABLE_NAME',),
					"BuscaColumnas"	=>array('TABLE_SCHEMA'),
					"BuscaDatos"	=>array($array['Database']),
					"Condiciones"	=>array(),
				),      
			)
		);
		$this->Ares_v1->GeneraSql($GeneraSql_array);
		$sql=$this->Ares_v1->getSql();
		$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
		$lista=array();
		while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
			$lista[]=$datos['TABLE_NAME'];
		}
		$this->lista_tablas=$lista;
	}
	public function getlista_Tablas(){
		return $this->lista_tablas;
	}
	public function viewlista_Tablas(){       
        echo('<pre>');
        print_r($this->lista_tablas);
		echo('</pre>'); 
	}

	public function lista_Columnas($array){
		/*
			$lista_Tablas=Array(
				"Database"=>$_POST['Database_select'],
				"Tabla"=>$_POST['Tabla_select'],
			);
		*/
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);		
		$GeneraSql_array=array(
			"tabla"=>'COLUMNS',
			"Operacion"=>
			array(  
				'viewSQL'=>'false', 
				'SELECT'=>array(
					"Activar"	=>'true',
					"LIKE"		=>'falses',
					"getColumnas"	=>array('COLUMN_NAME'),
					"BuscaColumnas"	=>array('TABLE_SCHEMA','TABLE_NAME'),
					"BuscaDatos"	=>array($array['Database'],$array['Tabla']),
					"Condiciones"	=>array(),
				),      
			)
		);
		$this->Ares_v1->GeneraSql($GeneraSql_array);
		$sql=$this->Ares_v1->getSql();
		$res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
		$lista=array();
		while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
			$lista[]=$datos['COLUMN_NAME'];
		}
		$this->lista_columnas=$lista;
	}
	public function getlista_Columnas(){
		return $this->lista_columnas;
	}
	public function viewlista_Columnas(){       
        echo('<pre>');
        print_r($this->lista_columnas);
		echo('</pre>'); 
	}

	public function descarga_db		($db,$conexion,$phpv,$arrays){//(procesos lento)descarga la informacion(tablas y sus columnas) de una base de datos 	
		$this->libre_v2->db('information_schema',$this->conexion,$this->phpv);
		$res=$this->libre_v2->consulta('COLUMNS',$this->conexion,'TABLE_SCHEMA',$db,'','',$this->phpv,'',false);
		$tb		=$this->libre_v2->crea_array('');
		$colum	=$this->libre_v2->crea_array('');
		$z=0;
		while($datos=$this->libre_v2->mysql_fe_ar($res,$this->phpv,'')){
			$busqueda_tabla=$this->libre_v2->busca_array($tb,$datos['TABLE_NAME']);//busca si existe la tabla 
			
			if(!$busqueda_tabla){//tabla no registrada -> crear nuevo dato 
				#add_array($array,$name,$new_dato)
				$tb		=$this->libre_v2->add_array($tb,'',$datos['TABLE_NAME']);	//Agrega la nueva tabla 
				$colum	=$this->libre_v2->add_array($colum,$datos['TABLE_NAME'],$datos['COLUMN_NAME']); //crea una subArray de Las columnas con id de la tabla columnas['folios']['id']
			}	
			
			if($busqueda_tabla){//tabla registrada -> busca el dato si existe 
				#$colum[$datos['TABLE_NAME']]
				$busqueda_columna=$this->libre_v2->busca_array($colum[$datos['TABLE_NAME']],$datos['COLUMN_NAME']);//busca si existe la columna 
				//if($busqueda_columna){}//ya existe la columna 
				if(!$busqueda_columna){//columna no existe-> agrega  
					$colum	=$this->libre_v2->add_array($colum,$datos['TABLE_NAME'],$datos['COLUMN_NAME']); //crea una subArray de Las columnas con id de la tabla columnas['folios']['id'
				}
			}
			
			
			$z++;
		}
		$res			= array(
			"version"	=> "descarga_db",
			"db"		=> $db,
			"tablas"	=> $tb,
			"columnas"	=> $colum
		);
		$this->EstructuraDB=$res;
		return $res;
	}
	public function ViewEstructuraDB	(){
		$array=$this->EstructuraDB;
		if(empty($array)){
			echo"error datos no encontrados";
			exit;
		}
		if(!empty($array)){
			$tb=$array['tablas'];
			$colum=$array['columnas'];
		}
		$style_gene="width: 70px; margin: 0px .5px; font-size: 10px; text-align: center;";
		echo $this->libre_v1->input2('text',"","","Base de Datos",$style_gene,'','','');
		echo $this->libre_v1->input2('text',"","",$array['db'],$style_gene,'','','');
		echo"<br>";
		echo $this->libre_v1->input2('text',"","","N tablas",$style_gene,'','','');
		echo $this->libre_v1->input2('text',"","",count($tb),$style_gene,'','','');
		echo"<br>";
		echo"<br>";
		for($x=0; $x<count($tb); $x++){			
			echo $this->libre_v1->input2('text',"","",$tb[$x],"width: 70px; margin: 0px .5px; font-size: 10px; text-align: center; ",'','','');
			echo"<br>";
			echo $this->libre_v1->input2('text',"","","N Columnas",$style_gene,'','','');
			echo $this->libre_v1->input2('text',"","",count($colum[$tb[$x]]),"width: 50px; margin: 0px .5px; font-size: 10px; text-align: center;",'','','');
			echo"<br>";
			for($y=0; $y<count($colum[$tb[$x]]); $y++){
				echo $this->libre_v1->input2('text',"","",$colum[$tb[$x]][$y],"width: 50px; margin: 0px .5px; font-size: 10px; text-align: center;",'','','');
			}
			echo"<br>";
			echo"<br>";
		}			
	}
	public function GetEstructuraDB(){
		return $this->EstructuraDB;
	}
	/**/
    function Update($array){
		/*
			array=array(
				"Sql"=>$sql
			);
		*/
		$Resgistros='';
		$error='';
		if ($this->libre_v2->ejecuta($this->conexion,$array['Sql'],$this->phpv)) {
			$Resgistros=mysqli_affected_rows($this->conexion);
		}else{
			$error=mysqli_error($this->conexion);       //si la instruciones estan mal el programa devulvera un error 
		}
		return array(
			"Registros"=>$Resgistros,
			"Error"=>$error
		);
    }
	function Verifica_existe	($conexion,$phpv,$Systm_datos,$Systm){	//consulta si exista una elemento en una tabla 	
	
		//$consu	= libre_v1::consulta		($Systm_datos[tb],$conexion,ID_G,$Systm_datos[id],'',''	,$phpv,$Systm[diagnostico]);
		$consu=libre_v2::consulta					($Systm_datos[tb],$conexion,$Systm_datos[name_id],$dato[id],$orde,$dire,$phpv,$buscar,$Systm[ver_sql]);
		$datos	= libre_v1::mysql_fe_ar		($consu,$phpv);
		if($datos[ID_G]==""){$res=0;}//no existe
		if($datos[ID_G]<>""){$res=1;}//si existe
		return $res;
	}
	function busca_en_tabla($conexion,$phpv,$Systm_datos){//verifica en todas las tabla que exista. si no devulve un array con la tablas que no existen 
		
		$function[close]=false;
		if ($conexion=="") 	{echo"<br>[Verifica_en_tablas2]Sin Conexion ";	$function[close]=true;}
		if ($phpv=="")		{echo"<br>[Verifica_en_tablas2]Sin Version	";	$function[close]=true;}
		if ($id=='')		{echo"<br>[Verifica_en_tablas2]Sin id		";	$function[close]=true;}
		if ($name_id=='')	{echo"<br>[Verifica_en_tablas2]Sin name id	";	$function[close]=true;}
		if ($tb=='')		{echo"<br>[Verifica_en_tablas2]Sin tablas tb";	$function[close]=true;}
		if ($db=='')		{echo"<br>[Verifica_en_tablas2]Sin tablas db";	$function[close]=true;}
		if ($function[close]==true){exit;}
		$systm[diagnostico]=true;
		/*
		echo"<div style='position: relative;background: #000000c2; color:white;margin: 1px 5px;left: 0px;width: 805px;padding: 5px;height: 180px;overflow-y: auto; overflow-x: hidden;'>";
		if($_POST[name2set]==Nuevo)		echo libre_v1::input2(text,'','',"Verificando Disponiblilidad",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
		if($_POST[name2set]==Modificar)	echo libre_v1::input2(text,'','',"Verificando Estado",'width: 100%;text-align: center;margin: 0px 1px;background: #102f41;color: white;');
		if($tb==''){
			if($array[version]=="descarga_db"){//compatibilidad con [descarga_db]
				$tb=$array[tablas];
				$colum=$array[columnas];
			}
		}
		$array_error=array();
		$array_bien=array();
		for($x=0; $x<count($tb); $x++){
			$deseado=false;
			for($y=0; $y<count($array_deseado); $y++){//ciclo para ver si esta tabla es una de las que se quiere revisar 
				if($tb[$x]==$array_deseado[$y]){$deseado=true; break;}
			}
			if($deseado==true){							//si la tabla es para verificar 
				$res = Verifica_existe($id,$tb[$x],$conexion,$phpv);		
				if($_POST[name2set]==Nuevo){
					echo"<div style='float: left;margin: 1px 1px;background: #ffffffb5;width: 260px;'>";
					if($res==0){
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"OK",'background: #34374b; color: #00ff00;text-align: center;width: 50px;margin: 0px .5px;');
					}
					if($res==1){
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"X",'background: #34374b; color: #ff0000;text-align: center;width: 50px;margin: 0px .5px;');
					}
					echo"</div>";
				}
				if($_POST[name2set]==Modificar){
					echo"<div style='float: left;margin: 1px 1px;background: #ffffffb5;width: 260px;'>";
					if($res==1){
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"OK",'background: #34374b; color: #00ff00;text-align: center;width: 50px;margin: 0px .5px;');
					}
					if($res==0){
						echo libre_v1::input2(text,'','',"Tabla",'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',$tb[$x],'margin: 0px .5px;');
						echo libre_v1::input2(text,'','',"X",'background: #34374b; color: #ff0000;text-align: center;width: 50px;margin: 0px .5px;');
					}
					echo"</div>";
				}
				if($_POST[name2set]==Modificar){
					
				}
				if($res==0){//almacena las datos que tiene errores 
					$array_error[]=$tb[$x];
				}
				if($res==1){//almacena las datos que esten bien 
					$array_bien[]=$tb[$x];
				}
			}
		}
		$array_res= array(
		"version"	=> "Verifica_en_tablas2",
		"mal"	=> $array_error,
		"bien"		=> $array_bien
		);
		if($_POST[name2set]==Nuevo){
			if(count($array_error)<22)	echo libre_v1::input2(text,'','',"Conflicto de Datos Detectada",'width: 100%;text-align: center;margin: 0px 1px;background: #e6b220;color: black;');
		}
		if($_POST[name2set]==Modificar){
			if(count($array_error)<>0)	echo libre_v1::input2(text,'','',"Perdida de Dato Detectada",'width: 100%;text-align: center;margin: 0px 1px;background: #e6b220;color: black;');
		}
		echo"</div>";
		return $array_res;//devulve un array con todas las tabla que faltan de crear */
	}

}
?>
