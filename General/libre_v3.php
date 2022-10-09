<?php
class validaciones{
	private $Ares_v1;
	private $libre_v1;
	private $libre_v2;
	private $libre_v4;
	private $libre_v5;
	private $phpv;
	private $conexion;
	private $database;
	private $tabla;

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
	public function vacio(){
		
	}
	public function columnas($database,$tabla){
		if(!empty($database))	$this->database	=$database;
		if(!empty($tabla))		$this->tabla	=$tabla;
		$tabla="COLUMNS";
		$getColumnas        = array('*') ;
		$BuscaColumnas      = array('TABLE_SCHEMA','TABLE_NAME') ;
		$BuscaDatos         = array($this->database,$this->tabla);
		$array=array(
			"tabla"=>$tabla,
			"Operacion"=>
			array(      'SELECT'=>array(
				"Activar"	=>'true',//'false'
				"LIKE"		=>'false',//'false'
				"getColumnas"    =>$getColumnas,//array()
				"BuscaColumnas"  =>$BuscaColumnas,//array()
				"BuscaDatos"     =>$BuscaDatos//array()

				)
			)			
		);
		$this->Ares_v1->GeneraSql($array);
		$sql=$this->Ares_v1->viewSql();
		$this->libre_v4->KeyColumnUsege($this->database,$this->tabla);
		$columnaId=$this->libre_v4->getKeyColumnUsege();
		
		$this->libre_v4->Columnas($this->database,$this->tabla);
		$columnas=$this->libre_v4->getColumnas();
		$CamposVacios=$this->libre_v2->crea_array('');

		for ($x=0; $x <count($columnas) ; $x++) { 
			if($columnaId!=$columnas[$x]){//verifica que lacolumnas no sea una ID o primaria 
				$estatus='true';
				if(empty($_POST[$columnas[$x]])){$estatus='false';}
				
				$CamposVacios=$this->libre_v2->add_array($CamposVacios,$columnas[$x],$estatus);
			}
			
		}
		//echo count($vericasion);
		//var_dump($CamposVacios);
		$verifi=array(
			'CamposVacios'=>$CamposVacios
		);
		
	}

}
class subRutinas_combustible{	
	private $Ares_v1;
	private $libre_v2;
	private $libre_v5;
	private $subRutinas_combustible;
	private $phpv;
	private $conexion;
	
	public function __construct($phpv,$conexion){	
		$this->Ares_v1	=new Ares_v1();
		$this->libre_v5	=new libre_v5($phpv,$conexion,'');
		$this->libre_v2	=new libre_v2($phpv,$conexion);
		
		$this->phpv=$phpv;	
		$this->conexion=$conexion;	
	}
	public function ventana_rapida($array){
		#consulta los datos de el tanque 
			$array=array(
				"tabla"=>'tanques',
				"Operacion"=>
				array(     'SELECT'=>array(
						"Activar"	=>'true',
						"LIKE"		=>'falses',
						"getColumnas"	=>array('*'),
						"BuscaColumnas"	=>array('Nombre'),
						"BuscaDatos"	=>array('Auto Abasto'),
					),
				)
			);
			$this->Ares_v1->GeneraSql($array);
			$sql=$this->Ares_v1->getSql($array);
			$this->libre_v2->db('combustible',$this->conexion,$this->phpv);

		if ($Respuesta_sql=mysqli_query($this->conexion, $sql)) {
			$datos=$this->libre_v2-> mysql_fe_ar($Respuesta_sql,$this->phpv,'');
			$NivelActual=$datos['NivelActual'];
		}else{
			$NivelActual=0;
		}
		echo"<div class='formularios'>";
			echo"<div class='titulos'>Combustible Restante</div>";
			echo $this->libre_v5->input('button','','Litros Restantes','','Diseno_botones2','','','');
			echo $this->libre_v5->input('button','',$NivelActual,'','Diseno_botones3','','','');
		echo"</div>";
		ob_start();  
		$Interface_de_usuario = ob_get_contents();

        ob_end_clean();
		return array(
			"Interface_de_usuario"=>$Interface_de_usuario,
		);
	}
    function Control_repostaje_tanque($array){
		##EL PROGRAMA BUSCA COMPRA DE COMBUSTIBLE PARA EL TANQUE 
        /*
            $array=array(
                "tanque"=>$tanque,
                "FechaInicio"=>'',
                "Fechafinal"=>''
            );
        */
		if(empty($array['Fechafinal'])){$array['Fechafinal']=date("Y-m-d");}
		
        $sql="SELECT * FROM repostajes_tanques WHERE IDTanque='".$array['tanque']."' AND Fecha >'".$array['FechaInicio']."' AND  Fecha <='".$array['Fechafinal']."' ORDER BY Fecha ASC";#DESC
        #$sql="SELECT * FROM repostajes_tanques WHERE IDTanque='".$array['tanque']."' AND Fecha BETWEEN '".$array['FechaInicio']."' and '".$array['Fechafinal']."' ORDER BY Fecha ASC ";
        $res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
        $conta=mysqli_affected_rows($this->conexion);
        $Primera='false';
        $PrimerRepostaje='';
        $RepostajesFechas=array();
        while ($datos=$this->libre_v2->mysql_fe_ar		($res,$this->phpv,'')) {
            if( $datos['Fecha']>=$array['FechaInicio'] and $Primera=='false'){
                $PrimeroRepostaje=$datos['Fecha'];
                $Primera='true';
            }
            $RepostajesFechas[]=$datos['Fecha'];
        }
        return array(
            "PrimerRepostaje"=>$PrimerRepostaje,
            "Contador"=>$conta,
            "Fechas"=>$RepostajesFechas
        );

	}
	
    function Busca_repostajes_tanques($array_brt){
        /*
            $array_brt=array(
                "tanque"=>$tanque,
                "NivelDetanque"=>,
                "FechaInicio"=>'',
                "Fechafinal"=>''
            );
        */
        # obtiene la fechas del siguente repostaje despues de esta 
        $sql="SELECT * FROM repostajes_tanques WHERE IDTanque='".$array_brt['tanque']."' AND Fecha > '".$array_brt['FechaInicio']."'  ORDER BY Fecha ASC ";
        $res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
        $getFechafinal=$this->libre_v2->mysql_fe_ar		($res,$this->phpv,'');
        if(empty($array_brt['Fechafinal']))$array_brt['Fechafinal']=$getFechafinal['Fecha'];
            
        #obtiene las lisa de tanques aparti de las fechas establecidas 
        if(empty($array_bru['Fechafinal'])){$array_brt['Fechafinal']=date("Y-m-d");}
        $sql="SELECT * FROM repostajes_tanques WHERE IDTanque='".$array_brt['tanque']."' AND Fecha BETWEEN '".$array_brt['FechaInicio']."' and '".$array_brt['Fechafinal']."' ORDER BY Fecha ASC ";
        $res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
        //$datos_repostaje_tanque=$this->libre_v2->consulta('repostajes_tanques',$this->conexion,'IDTanque',$tanque,'Fecha','desendente',$this->phpv,'','');
        $Contador=mysqli_affected_rows($this->conexion);
        $fecha_previa='';
        $calculo_de_combustible=0;
               
        ob_start();   
        echo"<br>";
            echo"<div class='Contenedor_auto2'>";
            echo"Repostajes Encontrados: ";            
            echo $this->libre_v5->input('text','',$Contador,'','Medio','','','width: 100px;');       
            $fechaPrevia='';
            $nuevoNivel=$array_brt['NivelDetanque'];
            while ($RepostajesTanques=$this->libre_v2->mysql_fe_ar		($res,$this->phpv,'')) {
                $nuevoNivel= $nuevoNivel+$RepostajesTanques['Litros_Resividos'];
                echo"<p style='background: greenyellow; color: black;'>Repostaje Tanque</p>";
                echo"<br>Resividos: ";
                echo $this->libre_v5->input('text','',$RepostajesTanques['Fecha'],'','Medio','','','width: 100px;');
                echo"<br>Litros Resividos: ";            
                echo $this->libre_v5->input('text','',$RepostajesTanques['Litros_Resividos'],'','Medio','','','width: 100px;');
                echo"<br>Nuevo nivel: ";            
                echo $this->libre_v5->input('text','',$nuevoNivel,'','Medio','','','width: 100px;');
                echo"<br>";
                
                #obtiene la proxima fecha 
                    $sql="SELECT * FROM repostajes_tanques WHERE IDTanque='".$array_brt['tanque']."' AND Fecha > '".$RepostajesTanques['Fecha']."'  ORDER BY Fecha ASC ";
                    $Proxima=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
                    $ProximaFecha=$this->libre_v2->mysql_fe_ar		($Proxima,$this->phpv,'');
                    
                
                if(empty($fechaPrevia)){$fechaPrevia=$RepostajesTanques['Fecha']; }
                #else{   if(!empty($fechaPrevia))$fechaPrevia=$RepostajesTanques['Fecha'];}
                if($fechaPrevia!=$ProximaFecha['Fecha'])$fechAproxima=$ProximaFecha['Fecha'];
                if($fechaPrevia==$ProximaFecha['Fecha'])$fechAproxima="";
                $array_bru=array(
                    "Tanque"=>$array_brt['tanque'],
                    "Unidad"=>'',
                    "LitrosRestantes"=>$nuevoNivel,#$RepostajesTanques['Litros_Resividos'],
                    "FechaInicio"=>$fechaPrevia,
                    "Fechafinal"=>$fechAproxima
				);
				$fechaCierre=$fechaPrevia;
                $fechaPrevia=$fechAproxima;
                $Respotajes=$this->Busca_repostajes_unidades($array_bru);
                $nuevoNivel=$nuevoNivel-$Respotajes['SumaConsumo'];
                echo"<p style='background: orangered; color: black;'>Repostaje Unidades</p>";
                
                echo"<br>Repostaje a Unidades: ";            
                echo $this->libre_v5->input('text','',$Respotajes['Contador'],'','Medio','','','width: 100px;');
                echo"<br>Litros Consumidos: ";
                echo $this->libre_v5->input('text','',$Respotajes['SumaConsumo'],'','Medio','','','width: 100px;color: red;');
                echo"<br>Litros Restantes: ";
				echo $this->libre_v5->input('text','',$nuevoNivel,'','Medio','','','width: 100px;');
				echo "<br>".$Respotajes['Interface_de_usuario'];
                $fecha_previa=$RepostajesTanques['Fecha'];
                echo "<br>";
            }
            echo"</div>";
        
        $Interface_de_usuario = ob_get_contents();
        ob_end_clean();
        return array(
            "Interface_de_usuario"=>$Interface_de_usuario,
            "Contador"=>$Contador,
			"NuevoNivel"=>$nuevoNivel,
			"FechaCierre"=>$fechaCierre
			
        );
	}
	
    function Busca_repostajes_unidades($array_bru){
        /*
            $array_bru=array(
                "Tanque"=>$tanque,
                "Unidad"=>$unidad,
                "LitrosRestantes"=>$LitrosRestantes,
                "FechaInicio"=>$fechainicio,
                "Fechafinal"=>$fechafinal
            );
        */        
        if(empty($array_bru['Fechafinal'])){$array_bru['Fechafinal']=date("Y-m-d");}
        
        #$sql="SELECT * FROM repostajes_unidades WHERE TanqueSurtidor='".$array_bru['Tanque']."' AND Fecha BETWEEN '".$array_bru['FechaInicio']."' and '".$array_bru['Fechafinal']."'  ORDER BY Fecha DESC";
        $sql="SELECT * FROM repostajes_unidades WHERE TanqueSurtidor='".$array_bru['Tanque']."' AND Fecha >='".$array_bru['FechaInicio']."' AND  Fecha <='".$array_bru['Fechafinal']."' ORDER BY Fecha DESC";
        $res=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
        $Contador=mysqli_affected_rows($this->conexion);       
        
        $SumaConsumo=0;
            #titles 
        ob_start();  
        echo"Periodo: ";
        echo $this->libre_v5->input('text','',$array_bru['FechaInicio'],'','Medio','','','width: 100px;');
        echo $this->libre_v5->input('text','',$array_bru['Fechafinal'],'','Medio','','','width: 100px;');
            echo"<br>";
            echo $this->libre_v5->input('button','',' ','','Diseno_boton_id','','','');
            echo $this->libre_v5->input('text','','Fecha','','Medio','','','width: 100px;');
            echo $this->libre_v5->input('text','','Placas','','Medio','','','width: 100px;');
            echo $this->libre_v5->input('text','','Total Despachado','','Medio','','','width: 100px;');
            echo $this->libre_v5->input('text','','Comb. Restante','','Medio','','','width: 100px;');
            echo'<br>';
            $x=1;
            echo"<div class='Contenedor_auto2_2'>";
            while ($RepostajesTanques=$this->libre_v2->mysql_fe_ar		($res,$this->phpv,'')) {
                #echo"Fecha: ".$RepostajesTanques['Fecha'];#."<br>";
                echo $this->libre_v5->input('button','',$x,'','Diseno_boton_id','','','');
                echo $this->libre_v5->input('text','',$RepostajesTanques['Fecha'],'','Medio','','','width: 100px;');
                echo $this->libre_v5->input('text','',$RepostajesTanques['Placas'],'','Medio','','','width: 100px;');
                echo $this->libre_v5->input('text','',$RepostajesTanques['Total_Despachado'],'','Medio','','','width: 100px;');
                $SumaConsumo=$SumaConsumo+$RepostajesTanques['Total_Despachado'];
                $LitrosRestantes=$array_bru['LitrosRestantes']-$SumaConsumo;
                echo $this->libre_v5->input('text','',$LitrosRestantes,'','Medio','','','width: 100px;');
                
                $x++;
                echo"<br>";
            }
            echo"</div>";
            
        $intreface = ob_get_contents();
        ob_end_clean();
        return array(
            "Interface_de_usuario"=>$intreface,
            "SumaConsumo"=>$SumaConsumo,
            "Contador"=>$Contador
        );
    }
}
?>