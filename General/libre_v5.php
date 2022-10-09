<?php               //libreria iniciada el 10/12/2019 proceso de reinicio 
class inputs{
    public $propiedades;
    public $input;
    private $libre_v5;
    private $phpv;

    function __construct($phpv,$conexion,$Mod_propiedades){
        $this->libre_v5	=new libre_v5($phpv,$conexion,'');	
        $this->phpv=$phpv;
        $this->propiedades=array(
        "objeto"=>'input',#input,select,textarea
        "type"=>'text',#input,button,submit,date,datetime ect.
        "name"=>'',
        "value"=>'',
        "id"=>'',
        "class"=>'',#soportes para formato string o array 
        "readonly"=>false,#true o false
        "disabled"=>false,#true o false
        "title"=>'',
        "placeholder"=>'',
        "libre"=>'',
        "style"=>array(
            "background"=>'',
            "color"     =>'',
            ),
        );
        
    }
    public function crearInput(){
        #echo gettype($this->propiedades['style']);
        
                
        if(empty($this->propiedades['type']))           {$type='';}         else{$type  ="type='".$this->propiedades['type']."'";}
        if(empty($this->propiedades['name']))           {$name='';}         else{$name  ="name='".$this->propiedades['name']."'";}
        if(empty($this->propiedades['value']))          {$value='';}        else{$value ="value='".$this->propiedades['value']."'";}
        if(empty($this->propiedades['id']))             {$id='';}           else{$id    ="id='".$this->propiedades['id']."'";}
        if(empty($this->propiedades['class']))          {$class='';}        else{$class ="class='".$this->propiedades['class']."'";}
        if(empty($this->propiedades['title']))          {$title='';}        else{$title ="title='".$this->propiedades['title']."'";}
        if(empty($this->propiedades['libre']))          {$libre='';}        else{$libre ="libre='".$this->propiedades['libre']."'";}
        if(empty($this->propiedades['placeholder']))    {$placeholder='';}  else{$placeholder   ="placeholder='".$this->propiedades['placeholder']."'";}
        if($this->propiedades['disabled']==false)       {$disabled='';}     else{$disabled   ="disabled='disabled'";}
        if($this->propiedades['readonly']==false)       {$readonly='';}     else{$readonly   ="readonly='readonly'";}
        if(gettype($this->propiedades['style'])=='array'){
            $keys=$this->libre_v5->generador_key($this->propiedades['style']);
            $style='';
            for ($i=0; $i <count($keys) ; $i++) { 
                if(!empty($this->propiedades['style'][$keys[$i]])){
                    $style.=$keys[$i].':'.$this->propiedades['style'][$keys[$i]].';';
                }
            }
        }
        if(!empty($style)) {$style ="style='".$style."'";}
        switch ($this->propiedades['objeto']) {
            case 'input':                
                $this->input="<input ".$type.$name.$value.$id.$class.$title.$libre.$placeholder.$disabled.$readonly.$style."   >";
            break;
            case 'select':
            break;
            case 'textarea':
            break;

            
        }
    }
    public function view(){
        $this::crearInput();
        echo $this->input;
    }
    public function get(){        
        $this::crearInput();
        return $this->input;

    }
}
class Columna_automaticas{
    private $libre_v1;
    private $libre_v2;
    private $libre_v5;
    private $phpv;
    private $conexion;
    public $colunas_index=array();  #indice de columnas 
    public $colunas=array();        #columnas almacenadas mediante el name
    public $title=array();          #titlulos de la columnas almacenadas mediante el name
    public $Nombre='';
    public $name_memoria;
    #condiciones para que automaticamente se agrege otro renglon 
    public $columnas_requerida=array(); # si no se especifica, se interpreta que todas son obligatorias 
    public $formato_columna=array();          # si solo se permite, texto, numeros, fechas 
    public $verificasion_celdas=array(
        "vacios"=>array()
    );
    public $lista_auto_sumas=array();
    public $operaciones_math=array(
        "SumaTotal"=>array()
    );


    public function __construct($phpv,$conexion,$array){	
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);	
        $this->libre_v5	=new libre_v5($phpv,$conexion,$array);	
        $this->phpv=$phpv;	
        $this->conexion=$conexion;	
        if(!empty($array['name'])){
            $this->Nombre= $array['name'];
            $this->begin_memoria();
        }
    }
    public function add_columna($name){
        if(!array_key_exists($name,$this->colunas)){ 
            #verifica que no existe una columna identica, si no hay coincidencia agrega una nueva columna con ese nombre
            $propiedades=array(
                    "objeto"=>'input',#input,select,textarea
                    "type"=>'input',#input,button,submit,date,datetime ect.
                    "name"=>'',
                    "value"=>'',
                    "id"=>'',
                    "class"=>'',#soportes para formato string o array 
                    "readonly"=>false,#true o false
                    "disabled"=>false,#true o false
                    "title"=>'',
                    "style"=>'',
                    "placeholder"=>'',
                    "libre"=>''
            );
                    
            #echo('<pre>');
            #print_r($propiedades);
            #echo('</pre>'); 
            $this->colunas_index[]=$name;            
            $this->colunas[$name]=array(
                "name"=>$name,
                "memoria"=>array(
                    "Activa"=>false,
                    "propiedades"=>$propiedades  
                ),
                "reemplazo"=>array(
                    "memoria"=>array(
                        "Activa"=>false,
                        "propiedades"=>$propiedades  
                    ),  
                    "input"=>array(
                        "Activa"=>false,
                        "propiedades"=>$propiedades  
                    ),  
                ),
                "propiedades"=>$propiedades         
            );        
            #$this->colunas[$name]['memoria']['propiedades']['type']='hidden';
            #echo('<pre>');
            #print_r($this->colunas[$name]);
            #echo('</pre>');  
            $this->title[$name]=array(
                "name"=>$name,
                "propiedades"=>array(
                    "objeto"=>'input',#input,select,textarea
                    "type"=>'input',#input,button,submit,date,datetime ect.
                    "name"=>'',
                    "value"=>'',
                    "id"=>'',
                    "class"=>'',#soportes para formato string o array 
                    "readonly"=>false,#true o false
                    "disabled"=>false,#true o false
                    "title"=>'',
                    "style"=>array(
                        "width"=>'',
                        "height"=>'',
                        "display"=>''
                    ),
                    "placeholder"=>'',
                    "libre"=>''
                )
            );
            $this->operaciones_math['SumaTotal'][$name]='';
        }
        
    }
    public function columnas_requeridas($array){
        if(gettype($this->columnas_requerida)!='array'){echo"se requiere un array 'columna'=>'boolean'";}
        $this->columnas_requerida=$array;
    }
    private function Control_de_renglones(){
        ##realiza una comprobacion buscando colunas principales
        ##que sera el nucleo central de las funciones de auto agregado de datos 
        ##si no se detecta ninguna columna obligatoria, se tomara como que todas son obligatorias 
        
        ## revisa que las celdas no esten vacias, si estan las ordena
        $this-> comprueba_vacias();
        $this-> add_renglon();
        $this-> ordena_renglones();
        $this-> elimina_renglones();
        $this-> autoSuma();
        if (!empty($this->formato_columna) and(count($this->formato_columna)>=1)){#columnas especificasdas                     
        }else{# todas las columnas 
            
        }
    }
    public function inset_dato($array_inset_dato){
        /*
        echo('<pre>');
        print_r($array_inset_dato);
        echo('</pre>'); 
        */
        $this-> comprueba_vacias();
        $this-> add_renglon();
        $this-> ordena_renglones();
        $this-> elimina_renglones();
        $columna_index=$array_inset_dato['ControlDatos']['Index'];
        $array_busca=array(
            "Columna"=>$columna_index,
            "ValorBusca"=>$array_inset_dato['Datos'][$columna_index],
        );
        #### validad que los datos no se repitan 
        $busca=$this->Busca($array_busca);
        if($busca==false){

            for ($d=0; $d <count($this->colunas_index) ; $d++){ 
                $ultimo_renglon=$_POST[$this->name_memoria];
                $name_columna=$this->Nombre.'_'.$this->colunas_index[$d];
                $celda=$name_columna.$ultimo_renglon;  
                $_POST[$celda]=$array_inset_dato['Datos'][$this->colunas_index[$d]];
            }
        }


    }
    public function delect_dato($array_delect_dato){
        #echo('<pre>');
        #print_r($array_delect_dato);
        #echo('</pre>'); 
        
        $this-> comprueba_vacias();
        $this-> add_renglon();
        $this-> ordena_renglones();
        $this-> elimina_renglones();
        $columna_index=$array_delect_dato['ControlDatos']['Index'];
        $array_busca=array(
            "Columna"=>$columna_index,
            "ValorBusca"=>$array_delect_dato['Datos'],
        );
        #### validad que los datos no se repitan 
        $busca=$this->Busca2($array_busca);
        if($busca['Busqueda']==true){
            $name_columna=$this->Nombre.'_'.$array_busca['Columna'];
            for ($d=0; $d <count($busca['Posiciones']) ; $d++) {
                for ($i=0; $i<count($this->colunas_index) ; $i++) { #ciclo para recorer todas las columnas 
                    $columnas=$this->colunas_index[$i];
                    $celda=$this->Nombre.'_'.$this->colunas_index[$i].$busca['Posiciones'][$d];
                    $_POST[$celda]='';
                    
                }
            }
        }



    }
    public function update_dato($array_update_dato){}
    public function Busca2($array_busca){
        /*
            $array_busca=array(
                "Columna"=>array(),
                "ValorBusca"=>array(),
                "GETPosiciones"=>false
            );
        */
        $res=false;
        $contador=0;
        $Posiciones=array();
        $name_columna=$this->Nombre.'_'.$array_busca['Columna'];
        for ($i=1; $i<=$_POST[$this->name_memoria]; $i++){ 
            $celda=$name_columna.$i;        
            if(!empty($_POST[$celda]) and $_POST[$celda]==$array_busca['ValorBusca']){
                $Posiciones[]=$i;
                $contador++;
                $res=true;                
            }
        }
        $res_busqueda=array(
            "Busqueda"=>$res,
            "coincidencias"=>$contador,
            "Posiciones"=>$Posiciones
        );
        return $res_busqueda;
    }
    public function Busca($array_busca){
        /*
            $array_busca=array(
                "Columna"=>array(),
                "ValorBusca"=>array(),
                "GETPosiciones"=>false
            );
        */
        $res_busqueda=false;
        /*
        echo('<pre>');
        print_r($array_busca);
        echo('</pre>'); 
        echo $array_busca['Columna'];
        */
        $name_columna=$this->Nombre.'_'.$array_busca['Columna'];
        for ($i=1; $i<=$_POST[$this->name_memoria]; $i++){ 
            $celda=$name_columna.$i;        
            if(!empty($_POST[$celda]) and $_POST[$celda]==$array_busca['ValorBusca']){
                return $res_busqueda=true;                
            }
        }
        return $res_busqueda;
    }
    public function elimina_renglones(){
        $ultimo_renglon=$_POST[$this->name_memoria];
        $autorizacion_Elimina_renglon=true;
        $autorizacion_de_agregar=true;
        for ($d=$ultimo_renglon-1; $d >0 ; $d--) { #ciclo para los renglones omitiendo el ultimo 
            for ($i=0; $i<count($this->colunas_index) ; $i++) { #ciclo para recorer todas las columnas 
                $columnas=$this->colunas_index[$i];
                #$celda=$this->colunas_index[$i].$d;
                $celda=$this->Nombre.'_'.$this->colunas_index[$i].$d;
                if(empty($this->columnas_requerida)){                    
                    if ($this->verificasion_celdas['vacios'][$celda]==true){ #ningula columna espesificada, todas son obligatorias
                        $autorizacion_Elimina_renglon=false;
                    }
                }elseif(!empty($this->columnas_requerida)){                
                    if (isset($this->columnas_requerida[$columnas]) and $this->columnas_requerida[$columnas]==true 
                    and $this->verificasion_celdas['vacios'][$celda]==true){ #ningula columna espesificada, todas son obligatorias
                        #echo" desactiva ";
                        $autorizacion_Elimina_renglon=false;
                    }        
                }
                #echo"<br>";
            }
            if($autorizacion_Elimina_renglon==true){
                $_POST[$this->name_memoria]=$_POST[$this->name_memoria]-1;
            }
        }

    }
    public function add_renglon(){
        $ultimo_renglon=$_POST[$this->name_memoria];
        $autorizacion_de_agregar=true;
        for ($i=0; $i<count($this->colunas_index) ; $i++) { #ciclo para Recorrer todas las columnas 
            $columnas=$this->colunas_index[$i];
            #$celda=$this->colunas_index[$i].$ultimo_renglon;
            $celda=$this->Nombre.'_'.$this->colunas_index[$i].$ultimo_renglon;
            if(empty($this->columnas_requerida)){#validacion de todas las columnas 
                #echo"validacion general";
                if ($this->verificasion_celdas['vacios'][$celda]==false){ #ningula columna espesificada, todas son obligatorias
                    $autorizacion_de_agregar=false;
                }           
            }elseif(!empty($this->columnas_requerida)){#valida algunas columnas    
                #echo"validacion especidica ";
                if (isset($this->columnas_requerida[$columnas]) and $this->columnas_requerida[$columnas]==true and $this->verificasion_celdas['vacios'][$celda]==false){ #ningula columna espesificada, todas son obligatorias

                    $autorizacion_de_agregar=false;
                }    

            }
        }
        if($autorizacion_de_agregar==true){
            #echo"<br>add<br>";
            $_POST[$this->name_memoria]=$_POST[$this->name_memoria]+1;
        }
    
    }    
    public function ordena_renglones(){
        $ultimo_renglon=$_POST[$this->name_memoria];
        # autorizacion_de_reacomodo se encarga de 
        $autorizacion_de_reacomodo=true;
        
        for ($d=1; $d <$ultimo_renglon; $d++) { 
            $autorizacion_de_reacomodo=true;
            /*
            echo('<pre>');
            print_r($this->colunas_index);
            echo('</pre>');
            */
            for ($i=0; $i<count($this->colunas_index) ; $i++) { #presenta todas las columnas 
                $celda=$this->Nombre.'_'.$this->colunas_index[$i].$d; 
                /*
						echo('<pre>');
						print_r($this->verificasion_celdas['vacios']);
						echo('</pre>');   
                        echo $celda;
                        */
                if ($this->verificasion_celdas['vacios'][$celda]==true){ #ningula columna espesificada, todas son obligatorias
                    $autorizacion_de_reacomodo=false;
                }           
            }
            if($autorizacion_de_reacomodo==true){
                $next=$d+1;
                if($next<$ultimo_renglon){
                    for ($i=0; $i<count($this->colunas_index) ; $i++) { #presenta todas las columnas 
                        $celda=$this->Nombre.'_'.$this->colunas_index[$i].$d; 
                        $celda_next=$this->Nombre.'_'.$this->colunas_index[$i].$next; 
                        #$celda=$this->Nombre.'_'.$this->colunas_index[$i].$d; 
                        $_POST[$celda]= $_POST[$celda_next];
                        $_POST[$celda_next]='';
                        $this-> comprueba_vacias();
                    }
                }
            }           
        }

    }
    private function comprueba_vacias(){        
        for ($d=0; $d <count($this->colunas_index) ; $d++){        
            #$name_columna=$this->colunas_index[$d];
            $name_columna=$this->Nombre.'_'.$this->colunas_index[$d];
            for ($i=1; $i<=$_POST[$this->name_memoria]; $i++){ 
                $celda=$name_columna.$i;
                
                if(empty($_POST[$celda])){$ope=false;}else{$ope=true;};
                $this->verificasion_celdas['vacios'][$celda]=$ope;
                
            }
        }
    }

    private function begin_memoria(){
        if(empty($this->Nombre))echo"Error M00";
        $name=$this->name_memoria=$this->Nombre.'_memoria';
        if(empty($_POST[$name]) or !is_numeric($_POST[$name])){$_POST[$name]=1;}
        
    }
    public function view_memoria(){
        $id=$name=$this->name_memoria;
        echo$this->libre_v5-> input('hidden',$name,'',$id,'','','','');
    }
    public function contro_lista_autoSuma($array_autoSuma){
        $this->lista_auto_sumas=$array_autoSuma;
        
    }
    public function autoSuma(){
        $ultimo_renglon=$_POST[$this->name_memoria];    
        
        for ($i=0; $i <count($this->lista_auto_sumas) ; $i++) { #recore las columnas que estan siendo autosuma
            $total=0;
            for ($d=1; $d <$ultimo_renglon; $d++) { 
                $celda=$this->Nombre.'_'.$this->lista_auto_sumas[$i].$d;
                if(is_numeric($_POST[$celda]))$total=$total+$_POST[$celda];
            }    
            $this->operaciones_math['SumaTotal'][$this->lista_auto_sumas[$i]]=$total;
            
        }

    }
    public function view(){        
        $this->Control_de_renglones();
        #titulos
        echo"<div style=''>";
            $this->view_memoria();
            for ($i=0; $i <count($this->colunas_index) ; $i++) { //columnas 
                echo"<div style='float: left;     width: min-content;'>";
                    $columna_actual=$this->colunas_index[$i];
                    #title
                        if(!empty($this->title[$columna_actual])){
                            $propiedades= $this->title[$columna_actual]['propiedades'];
                            #campos obligatorios 
                            if(!empty($this->columnas_requerida[$columna_actual]) and $this->columnas_requerida[$columna_actual]=='true')
                            $propiedades['value']=$propiedades['value'].'*';
                            echo $this->libre_v5->inputArray($propiedades);
                        }
                    #Renglones 
                        echo"<div>";                    
                            $renglones_de_columna=$_POST[$this->name_memoria];
                            for ($d=1; $d <=$renglones_de_columna; $d++) {   
                                $propiedades= $this->colunas[$columna_actual]['propiedades'];
                                #echo('<pre>');
                                #print_r($this->colunas[$columna_actual]);
                                #echo('</pre>');    
                                #memoria                     
                                    if($this->colunas[$columna_actual]['memoria']['Activa']==true){
                                        $memoria_propiedades=$this->colunas[$columna_actual]['memoria']['propiedades'];
                                        $memoria_propiedades['name']= $this->Nombre.'_'.$columna_actual.$d;      
                                        echo $this->libre_v5->inputArray($memoria_propiedades);    
                                    }  
                                #### imput
                                    $propiedades['name']= $this->Nombre.'_'.$columna_actual.$d;  
                                    if($this->colunas[$columna_actual]['reemplazo']['input']['Activa']==true)   {                                        
                                        if(!empty($_POST[$propiedades['name']])){
                                            $propiedades['value']=$_POST[$propiedades['name']];  
                                        }else{
                                            $propiedades['value']=' ';
                                        }
                                        $propiedades['name']=$this->colunas[$columna_actual]['reemplazo']['input']['propiedades']['name'];
                                    }                      
                                    echo $this->libre_v5->inputArray($propiedades);                    
                            }
                            #auto sumas 
                                $this->operaciones_math['SumaTotal'];   
                                #and is_numeric(($this->operaciones_math['SumaTotal'][$columna_actual]))
                                if(isset($this->operaciones_math['SumaTotal']) and is_numeric($this->operaciones_math['SumaTotal'][$columna_actual])){
                                    
                                    $propiedades['name']='Total_'.$this->Nombre;
                                    
                                    #$propiedades['value']= $this->operaciones_math['SumaTotal'][$columna_actual];
                                    $_POST[$propiedades['name']]=$this->operaciones_math['SumaTotal'][$columna_actual];
                                    echo $this->libre_v5->inputArray($propiedades);      
                                    
                                }
                        echo"</div>";


                echo"</div>";
            }
        echo"</div>";
    }
}
class libre_v5{ 
    private $memorias;   
    private $libre_v1;
    private $libre_v2;
	private $Ares_v1;
    private $phpv;
    private $conexion;
    private $paginacion;
    private $Menu_movil;
    public function __construct($phpv,$conexion,$array){	
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);	
		$this->Ares_v1	=new Ares_v1();		
        $this->phpv=$phpv;	
        $this->conexion=$conexion;	
    }    
    public function generador_key($array){
        $res=array();
        foreach ($array as $key => $value) {
            $res[]=$key;
        }
        return $res;
    }
    public function input($type,$name,$value,$id,$class,$title,$libre,$style){
        if (empty($class))		$class="buttonDefaul";           //class definida previamente para la pagina web			
        if ($class=='none')$class='';
        if(!empty($id))$id="id='$id'"; else $id='';
        #if(!empty($title))$title="title='$title'"; else $title='';
        #asigna el valor directamente desde el post
        if(empty($value) and !empty($name)and!empty($_POST[$name])){$value=$_POST[$name];}
        if($type=='datetime-local'){
            #echo"datatime-";
            $posicion_coincidencia = strpos($_POST[$name],'T');
            if($posicion_coincidencia==0){
                $_POST[$propiedades['name']][10]='T';
            }

        }
        if($type=='date' ){
             $type;
            #echo $libre.=' data-date-format="yyyy-MM-dd" ';
            #data-date-format="YYYY-MM-DD"
        }
        $res="<input type='$type' style='$style' $id  class='$class' name='$name' value='$value' 	title='$title' $libre >";
        return $res;
    }	
    /*
    
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
				if(!empty($_POST[$name]) and  $_POST[$name]==$datos[$descarga]){
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
     */
    public function inputArray($propiedades){
        #$propiedades=array();
  
        /*
            $propiedades=array(
                "objeto"=>'input',#input,select,textarea
                "type"=>'input',#input,button,submit,date,datetime ect.
                "name"=>'',
                "value"=>'',
                "id"=>'',
                "class"=>'',#soportes para formato string o array 
                "readonly"=>false,#true o false
                "disabled"=>false,#true o false
                "title"=>'',
                "style"=>array(
                    "width"=>'',
                    "height"=>'',
                    "display"=>'',
                ),
                "placeholder"=>'',
                "libre"=>'',
                "autofocus"=>''	

            );
        */
        #asigna el valor directamente desde el post
        
        if(empty($propiedades['value']) and !empty($propiedades['name'])and!empty($_POST[$propiedades['name']])){$propiedades['value']=$_POST[$propiedades['name']];}
        #if(isset($propiedades['value']))    {$_POST[$propiedades['name']]=$propiedades['value'];}
        if(!empty($propiedades['readonly']) and $propiedades['readonly']=true )$propiedades['readonly']=" readonly='readonly'";else{$propiedades['readonly']='';}
        if(!empty($propiedades['disabled']) and $propiedades['disabled']=true)$propiedades['disabled']=" disabled='disabled'";else{$propiedades['disabled']='';}
        
        #### class
            if(!empty($propiedades['class']) and gettype($propiedades['class'])=='array'){
                if(count($propiedades['class'])==0)$propiedades['class']='';
                $class='';
                for ($i=0; $i <count($propiedades['class']) ; $i++) { 
                    $class.= " ".$propiedades['class'][$i].' ';
                }
                $propiedades['class']= $class;
            }else{                
                if(gettype($propiedades['class'])=='array' and count($propiedades['class'])==0)$propiedades['class']='';
            }
        #### Style
        
				#echo('<pre>');
				#print_r($propiedades['style']);
				#echo('</pre>');
            if(!empty($propiedades['style']) and gettype($propiedades['style'])=='array'){
                if(count($propiedades['style'])==0)$propiedades['style']='';
                $keys=array_keys($propiedades['style']);# recupera las keys automaticamente
                $style='';
                for ($i=0; $i <count($keys) ; $i++) { 
                    $style.= $keys[$i].': '.$propiedades['style'][$keys[$i]].'; ';
                }
                $propiedades['style']= $style;
            }else{                
                if(gettype($propiedades['style'])=='array' and count($propiedades['style'])==0)$propiedades['style']='';
            }
        #### js   
            if(isset($propiedades['js'])and !empty($propiedades['js']) and gettype($propiedades['js'])=='array'){
                if(count($propiedades['js'])==0)$propiedades['js']='';
                $Names_eventos=array_keys($propiedades['js']);# recupera las keys automaticamente
                $EventoJS='';
                for ($i=0; $i <count($Names_eventos) ; $i++) { 
                    $Evento_selecionado=$Names_eventos[$i];
                    $ConjuntoDeFuncionesDeEvento='';
                    
                    if(gettype($propiedades['js'][$Evento_selecionado])=='string'){     
                        $ConjuntoDeFuncionesDeEvento=$propiedades['js'][$Evento_selecionado];
                        $EventoJS.=" ".$Evento_selecionado.'="'.$ConjuntoDeFuncionesDeEvento.'" ';
                    }
                    if(gettype($propiedades['js'][$Evento_selecionado])=='array'){                   
                        $Name_function=array_keys($propiedades['js'][$Evento_selecionado]);# recupera las keys automaticamente                
                        for ($g=0; $g <count($Name_function); $g++) { 
                            $selecionFuncionDeEvento=$Name_function[$g];
                            $ConjuntoDeFuncionesDeEvento.=$propiedades['js'][$Evento_selecionado][$selecionFuncionDeEvento].' ';
                        }         
                        $EventoJS.=' '.$Evento_selecionado.'="'.$ConjuntoDeFuncionesDeEvento.'" '; 
                        
                    }
                }
                $propiedades['js']=$EventoJS;
            }else{
                if(!isset($propiedades['js'])){$propiedades['js']='';}
                if(isset($propiedades['js'])and gettype($propiedades['js'])=='array' and count($propiedades['js'])==0)$propiedades['js']='';
            } 
        #### style data
        if($propiedades['type']=='date'){
            #data-date-format="YYYY-MM-DD"
            $propiedades['libre']['data-date-format']="YYYY-MM-DD";
        }
        if($propiedades['type']=='datetime-local'){
            #echo"datatime-";
            $posicion_coincidencia = strpos($propiedades['value'],'T');
            if($posicion_coincidencia==0){
                $propiedades['value'][10]='T';
            }
            #echo$propiedades['value'];
        }
        #### libre
            #echo('<pre>');
            #print_r($propiedades['libre']);
            #echo('</pre>');   
            if(!empty($propiedades['libre']) and gettype($propiedades['libre'])=='array'){
                $keys=array_keys($propiedades['libre']);# recupera las keys automaticamente
                $libre='';
                for ($i=0; $i <count($keys) ; $i++) { 
                    $libre.= $keys[$i].'="'.$propiedades['libre'][$keys[$i]].'" ';
                }
                $propiedades['libre']= $libre;
            }else{                
                if(isset($propiedades['libre']) and gettype($propiedades['libre'])=='array' and count($propiedades['libre'])==0)$propiedades['libre']='';
            }
        #####presenta datos
            #echo $propiedades['libre'];
            #echo('<pre>');
            #print_r($propiedades['libre']);
            #echo('</pre>');   
            switch ($propiedades['objeto']) {
                case 'input':                
                    $res="<input type='$propiedades[type]' style='$propiedades[style]' id='$propiedades[id]' class='$propiedades[class]' name='$propiedades[name]' value='$propiedades[value]' 	title='$propiedades[title]' $propiedades[disabled] $propiedades[readonly] $propiedades[js] $propiedades[libre] >";
                break;
                case 'select':
                break;
                case 'textarea':
                break; 

                
            }
        return $res;
    }
    public function memorias($array){
        /*
            array(
                'name'=>$name,
            )
            */
        static $memo;
        if(empty($memo))$memo=array();
        //if(empty($array['name'])){echo"nombre para memorai no definido ";}
        if(!empty($array['name'])){
            $res=$this->libre_v2->busca_array($memo,$array['name']);
            if($res==0){
                $memo=$this->libre_v2->add_array($memo,'',$array['name']);
            }
        }
        
        for ($x=0; $x <count($memo) ; $x++) { 
            if(!empty($_POST[$memo[$x]]))$_SESSION[$memo[$x]]=$_POST[$memo[$x]];#eliminar este diseño es muycomplicado
            
        }
        
    }
    public function menu($name_menu,$elemento_menu,$class,$otros_arrays){
        /*
            $name_menu="";
            $elemento_menu=array('','','','');          
            $class=array(
                'Conte_principal'=>'Menu_central',
                'Div_Opcion'=>'Conte_Cuadrado_auto',
                'Boton'=>'boton_Cuadrado_auto_claro',
                'img'=>'img_Cuadrado_auto'
            );
            $otros_arrays=array(
                'img_activa'=> 'true',
                'img_defaul'=>'../img/defaul.jpg',
                'img'=>array("","",'',"",""),
                'memoria'=>array('Activa'=>false,'type'=>'')

            );
        */ 
        #### memoria de la seccion actual ####
            if(empty($_POST[$name_menu])){
                if(!empty($_SESSION[$name_menu]))$_POST[$name_menu]=$_SESSION[$name_menu];
                else{
                    $_POST[$name_menu]=$elemento_menu[0];
                }
            }
        #### 
        if(empty($otros_arrays['img_activa']))          {$otros_arrays['img_activa']='true';}
        if(empty($otros_arrays['memoria']))             {$otros_arrays['memoria']=array('Activa'=>'true','type'=>'hidden');} //ajuste de memoria defaul        
        if(!empty($class)){
            $class=array(
                'Conte_principal'=>'Lateral',
                'Div_Opcion'=>'',
                'Boton'=>'Boton_menu1',
                'img'=>''
            );
        }
        echo"<div id='' class='".$class['Conte_principal']."'>";
            if($otros_arrays['memoria']['Activa']==true){#memoria para el menu designado
                $array['name']=$name_menu;
                $this->memorias($array);
                
                echo $this::input($otros_arrays['memoria']['type'],$name_menu,$_POST[$name_menu],'Memoria_'.$name_menu,"","","","");
            }
            if(gettype($elemento_menu)=='array'){   #dato ingresado es un array
                for($x=0; $x<count($elemento_menu); $x++){//_menu_div
                    if(!empty($otros_arrays['ocultar'][$elemento_menu[$x]])){#ocultarelemento 
                        #echo $otros_arrays['ocultar'][$elemento_menu[$x]];
                    }else{
                        if($_POST[$name_menu]==$elemento_menu[$x]){$class_boton="select_".$class['Boton'];}     else{$class_boton=$class['Boton'];}
                        if($_POST[$name_menu]==$elemento_menu[$x]){$class_div="select_".$class['Div_Opcion'];}  else{$class_div=$class['Div_Opcion'];}
                        
                        echo"<div id='' class='".$class_div."'>";                    
                        
                            $src=$otros_arrays['img_defaul'];//='img\defaul.jpg';
                            if(!empty($otros_arrays['img'][$x])){$src=$otros_arrays['img'][$x];}                        
                            if(!empty($otros_arrays['id'])){$id="id='".$otros_arrays['id']."'";}else{$id='';}
                            if($otros_arrays['img_activa']=='true'){
                                echo"<button type='submit' class='".$class['img']."' name='$name_menu' value='$elemento_menu[$x]'>";
                                    //echo"<img src='$src' class='".$class['img']."' onclick='javascript:document.form.submit();'>";
                                    echo"<img src='$src' style='width: 100%;height: 100%;'>";
                                echo"</button>";
                            }
                        
                            echo"<input type='submit' name='$name_menu' value='$elemento_menu[$x]' class='".$class_boton."' $id>";                   
                        
                        echo"</div>";
                    }
                }  
            }
            if(gettype($elemento_menu)=='double'){
                for($x=1; $x<=$elemento_menu; $x++){//_menu_div
                        if($_POST[$name_menu]==$x){$class_boton="select_".$class['Boton'];}     else{$class_boton=$class['Boton'];}
                        if($_POST[$name_menu]==$x){$class_div="select_".$class['Div_Opcion'];}  else{$class_div=$class['Div_Opcion'];}                        
                        echo"<div id='' class='".$class_div."'>";                    
                        
                            $src=$otros_arrays['img_defaul'];//='img\defaul.jpg';
                            if(!empty($otros_arrays['img'][$x]))    {$src=$otros_arrays['img'][$x];}                        
                            if(!empty($otros_arrays['id']))         {$id="id='".$otros_arrays['id']."'";}else{$id='';}
                            if($otros_arrays['img_activa']=='true'){
                                echo"<button type='submit' class='".$class['img']."' name='$name_menu' value='$x'>";
                                    //echo"<img src='$src' class='".$class['img']."' onclick='javascript:document.form.submit();'>";
                                    echo"<img src='$src' style='width: 100%;height: 100%;'>";
                                echo"</button>";
                            }
                        
                            echo"<input type='submit' name='$name_menu' value='$x' class='".$class_boton."' $id>";                   
                        
                        echo"</div>";
                    
                }  
            }
                          
        echo"</div>";
    }
    public function menu2($name_menu,$elemento_menu,$class,$otros_arrays){
        /*
            $name_menu="";
            $elemento_menu=array('','','','');          
            $class=array(
                'Conte_principal'=>'Menu_central',
                'Div_Opcion'=>'Conte_Cuadrado_auto',
                'Boton'=>'boton_Cuadrado_auto_claro',
                'img'=>'img_Cuadrado_auto'
            );
            $otros_arrays=array(
                'img_activa'=> 'true',
                'img_defaul'=>'../img/defaul.jpg',
                'img'=>array("","","","",""),                
                'icons'=>array(),
                'memoria'=>array('Activa'=>false,'type'=>'')
                'SubMenus'=array(),

            );
        */ 
        $conta=count($elemento_menu);
        if(empty($otros_arrays['img_activa']))          {$otros_arrays['img_activa']='true';}
        if(empty($otros_arrays['memoria']))             {$otros_arrays['memoria']=array('Activa'=>'true','type'=>'hidden');} //ajuste de memoria defaul        
        if(empty($class['Conte_principal']))   {$class['Conte_principal']='Menu_central';}
        if(empty($class['marco']))              {$class['marco']='img_Cuadrado_auto';}
        if(empty($class['Div_Opcion']))         {$class['Div_Opcion']='Conte_Cuadrado_auto';}
        if(empty($class['img']))                {$class['img']='img_Cuadrado_auto';}

        echo"<div id='' class='".$class['Conte_principal']."'>";    
                    
          echo "<div class='lista' id='bars'>";
            echo"<button type='submit' class='marco $class[marco]' >";
                echo"<i class='icon fas fa-bars'></i>";
            echo"</button>";
          echo"</div>";
          
            #### memoria del menu 
            if($otros_arrays['memoria']['Activa']==true){
                if(empty($_POST[$name_menu]))$_POST[$name_menu]='';
                $array['name']=$name_menu;
                echo $this::input($otros_arrays['memoria']['type'],$name_menu,$_POST[$name_menu],''.$name_menu,"","","","");
            }
            #echo"<div>";
            
            for($x=0; $x<$conta; $x++){//_menu_div
                if(!empty($otros_arrays['ocultar'][$elemento_menu[$x]])){//oculta Esta opcion  
                    #echo $otros_arrays['ocultar'][$elemento_menu[$x]];
                }else{
                    if(empty($_POST[$name_menu]))$_POST[$name_menu]=$elemento_menu[0];
                    if($_POST[$name_menu]==$elemento_menu[$x]){$class_boton="select_".$class['Boton'];}     else{$class_boton=$class['Boton'];}
                    if($_POST[$name_menu]==$elemento_menu[$x]){$class_div="select_".$class['Div_Opcion'];}  else{$class_div=$class['Div_Opcion'];}
                   
                    echo"<div id='' class='".$class_div."'>";    
                    if(!isset($otros_arrays['type']))  $otros_arrays['type']='submit';
                        $src=$otros_arrays['img_defaul'];//='img\defaul.jpg';
                        if(!empty($otros_arrays['img'][$x])){$src=$otros_arrays['img'][$x];}
                        if(!empty($otros_arrays['id'])){$id='id="'.$otros_arrays['id']."'";}else{$id='';}
                        if($otros_arrays['img_activa']=='true'){
                            echo"<button type='".$otros_arrays['type']."' class='".$class['img']."' name='$name_menu' value='$elemento_menu[$x]' $id>";
                                //echo"<img src='$src' class='".$class['img']."' onclick='javascript:document.form.submit();'>";
                                echo"<img src='$src' style='width: 100%;height: 100%;'>";
                            echo"</button>";
                        }
                        if(!empty($otros_arrays['icons'])){
                            $icons=$otros_arrays['icons'];
                            echo"<button type='".$otros_arrays['type']."' name='$name_menu' class='marco $class[marco]' value='$elemento_menu[$x]'>";
                            //echo"<button type='submit' class='".$class['img']."' name='$name_menu' value='$elemento_menu[$x]' $id>";
                                if($x<count($icons))echo"<i class='icon $icons[$x]' style=''></i>";
                            echo"</button>";
                        }                  
                        echo"<input type='".$otros_arrays['type']."' name='$name_menu' value='$elemento_menu[$x]' title='$elemento_menu[$x]' class='boton ".$class_boton."' $id>";
                        
                        if(!empty($otros_arrays['SubMenus'])){
                            echo gettype($otros_arrays['SubMenus']);
                        }
                        
                        
                    echo"</div>";
                }
            }     
            #echo"</div>";
        echo"</div>";
    }
    public function menu_array($array){
        echo"entro";
        
        $array=array(
            "Name_Menu"=>'',
            "Elementos"=>Array(
                "Casetas"=>array(
                    "Name_Menu"=>'',
                    "Elementos"=>Array()
                ),
                "Combustible",
                "Abonos",
                "Prestamos",
                "Arrastres"=>array(
                    "Name_Menu"=>'',
                    "Elementos"=>Array()
                ),
            )

        );
        
        
        echo('<pre>');
        print_r($array['Elementos']);
		echo('</pre>');   
        
        $keys=array_keys($array['Elementos']);


        echo('<pre>');
        print_r($keys);
		echo('</pre>');   

        for ($i=0; $i <count($keys); $i++) {             
            $color=rand(100000, 999999);
            $color2=rand(100000, 999999);
            echo"<div style='background: #$color; border: 2px solid #$color2;' >";
            echo$keys[$i];
                if(gettype($array['Elementos'][$keys[$i]])=="string"){
                    echo $array['Elementos'][$keys[$i]];
                }
                if(gettype($array['Elementos'][$keys[$i]])=="array"){
                    #menu_array($array['Elementos'][$keys[$i]]);
                    echo('<pre>');
                    print_r($array['Elementos'][$keys[$i]]);
                    echo('</pre>');
                }
                #menu_array($array)
            echo"</div>";
        }
        
    }
    
    public function paginado($name_menu,$elemento_menu,$class,$otros_arrays){
        /*
        */
        #### memoria de la seccion actual ####
            if(empty($_POST[$name_menu])){
                if(!empty($_SESSION[$name_menu]))$_POST[$name_menu]=$_SESSION[$name_menu];
                else{
                    $_POST[$name_menu]=$elemento_menu[0];
                }
            }
        #### 
        if(!empty($otros_arrays['id'])){$id="id='".$otros_arrays['id']."'";}else{$id='';}
        if(!empty($otros_arrays['pag_visibles'])){}else{$otros_arrays['pag_visibles']=5;}
        #Ajustes para la memoria  
        if(empty($otros_arrays['memoria']))             {$otros_arrays['memoria']=array('Activa'=>'true','type'=>'hidden');} //ajuste de memoria defaul        

        $despieges=array(
            "name"=>'ElementosEnPantalla',
            "Subtitulo"=>'',
            "Elementos"=>array(25,50,100),
            "TextComplemento"=>array(),
            "class"=>$class['paginado'],
            "style"=>'',
            "Excesiones"=>array(),
            "libre"=>''
        );
        if(empty($_POST['ElementosEnPantalla']))$_POST['ElementosEnPantalla']=25;#elementos por pagina por defaul        
        $paginas=round($elemento_menu/$_POST['ElementosEnPantalla'], 0, PHP_ROUND_HALF_UP);
        echo"<div id='' class='".$class['Conte_principal']."'>";    
            echo"<div style='float: left;'>";
                if(!empty($otros_arrays['detalles']['Ocultar'])){
                    echo'<br>Resultados:';  echo $this->input('text','',$elemento_menu,'','','','','');
                    echo"<br>Paginas: ".$paginas;
                    echo"<br>Elementos Por Pagina: ";
                #}else{
                    
                }
                echo $this->despieges($despieges);
            echo"<div style='float: left;'>";
                ##operacion de la memoria 
                if($otros_arrays['memoria']['Activa']==true){
                    $array['name']=$name_menu;
                    $this->memorias($array);
                    echo $this::input($otros_arrays['memoria']['type'],$name_menu,$_POST[$name_menu],'Memoria_'.$name_menu,"","","","");
                }       
                
                ####Control Del paginado 
                    #$_POST[$name_menu] #pagina Actual 
                    #$otros_arrays['pag_visibles']  #total de paginas a visualizar
                    ####inicial 
                    if($_POST[$name_menu]=='<<'){$_POST[$name_menu]=1;}
                    if($_POST[$name_menu]=='>>'){$_POST[$name_menu]=$paginas;}

                    $class_boton=$class['Boton'];
                    $pag_ante=$paginas-$otros_arrays['pag_visibles'];

                    if($_POST[$name_menu]<=$otros_arrays['pag_visibles']){
                        #echo"<input type='submit' name='$name_menu' value='>>' class='".$class_boton."' $id>";
                        $inicio=1;
                        $final=$otros_arrays['pag_visibles']*2;
                    }
                    ####intermedio
                    
                    if($_POST[$name_menu]>$otros_arrays['pag_visibles'] and $_POST[$name_menu]<= $pag_ante){
                        echo"<input type='submit' name='$name_menu' value='<<' class='".$class_boton."' $id>";
                        $inicio=$_POST[$name_menu]-$otros_arrays['pag_visibles'];
                        $final=$_POST[$name_menu]+$otros_arrays['pag_visibles'];
                    }
                    ####final 
                    if($_POST[$name_menu]>$pag_ante){
                        echo"<input type='submit' name='$name_menu' value='<<' class='".$class_boton."' $id>";
                        $inicio= $paginas-($otros_arrays['pag_visibles']*2);
                        $final=$paginas;                    
                    }
                ####
                for($x=$inicio; $x<=$final; $x++){//_menu_div
                #for($x=1; $x<=$paginas; $x++){//_menu_div
                    if($_POST[$name_menu]==$x){$class_boton="select_".$class['Boton'];}     else{$class_boton=$class['Boton'];}                                                    
                    echo"<input type='submit' name='$name_menu' value='$x' class='".$class_boton."' $id>";                   
                }   
                
                if($_POST[$name_menu]<=$otros_arrays['pag_visibles']){
                    echo"<input type='submit' name='$name_menu' value='>>' class='".$class_boton."' $id>";
                    
                }
                if($_POST[$name_menu]>$otros_arrays['pag_visibles'] and $_POST[$name_menu]<= $pag_ante){
                    echo"<input type='submit' name='$name_menu' value='>>' class='".$class_boton."' $id>";

                }
                if($_POST[$name_menu]>$pag_ante ){
                }
            echo"</div>";
        echo"</div>";
    }
    public function menu_movil($otros_arrays){
        /*
            $menu_lateral = new libre_v5();              
            $otros_arrays=array(
                'img_activa'=> 'true',
                'img_defaul'=>'../img/defaul.jpg',
                'img'=>array("","",'',"",""),
                'memoria'=>array('Activa'=>false,'type'=>''),
                $elemento_menu=>array(
                    "menu_movil"=>array(),
                    "menu"=>array(),
                ),
                'class'=>array(
                    "menu_movil"=>"Menu_movil_lateral",
                    "menu"=>array(
                        'Conte_principal'=>'Menu_central',
                        'Div_Opcion'=>'Conte_Cuadrado_auto',
                        'Boton'=>'boton_Cuadrado_auto_claro',
                        'img'=>'img_Cuadrado_auto'
                    )
                )
            );
            echo $menu_lateral->menu_movil($otros_arrays);
        */
        ob_start();
            echo"<div id='menu_movil' class='menu_movil'>";
                echo"<div class='contenido_menu_movil'>";
                
                    echo"<div id='boton_menu_movil' class='boton_menu_movil'>";
                        echo"<div class='barras'></div>";
                        echo"<div class='barras'></div>";
                        echo"<div class='barras'></div>";
                    echo"</div>";
                    $name_menu="menu_movil";
                    $class_menu_botones['Conte_principal']='botones_menu_movil';
                    
                    $this::menu($name_menu,$otros_arrays['elemento_menu']['menu_movil'],$class_menu_botones,$otros_arrays);
                    
                echo"</div>";

            echo"</div>";   
        $res = ob_get_contents();
        ob_end_clean();
        $this->Menu_movil=$res;
        return $res;
    }
    public function view_menu_movil(){
        echo $this->Menu_movil;
    }
    public function despliegre_mysql_array($propiedades){
        /*
        
             $Desplieges_operador=array(
                "objeto"=>'input',#input,select,textarea
                "type"=>'input',#input,button,submit,date,datetime ect.
                "name"=>'',
                "value"=>'',
                "id"=>'',
                "class"=>'',#soportes para formato string o array 
                "readonly"=>false,#true o false
                "disabled"=>false,#true o false
                "title"=>'',
                "style"=>array(
                    "width"=>'',
                    "height"=>'',
                    "display"=>'',
                ),
                "placeholder"=>'',
                "libre"=>'',
                "autofocus"=>'',
                'type'=>'despliegre_mysql',
                'database'=>'almacen',
                "tabla"=>'Operadores',
                "Operacion"=>array(  
                    'SELECT'=>array(
                        "Activar"		=>'true',
                        "getColumnas"	=>array('*'),
                        "ByOrder"		=>array(
                            "Columna"	=>'nombre',
                            "ASC-DESC"	=>'DESC'
                        ),
                    )
                ) ,
                'interfaces'=>array(
                    "ColumnasAMostrar"=>array('Nombre'),
                    "ColumnasAOcultar"=>array(),
                    "ValoresAOcultar"=>array(
                        'SCHEMA_NAME'=>array(
                            'information_schema','mysql','login','phpmyadmin','test','performance_schema'
                        ),
                    ),
                    "TextColumna"=>array(
                        #"SCHEMA_NAME"=>'Base De Datos',
                    )
                )
            );
        */
        #asigna el valor directamente desde el post
        
        if(empty($propiedades['value']) and !empty($propiedades['name'])and!empty($_POST[$propiedades['name']])){$propiedades['value']=$_POST[$propiedades['name']];}
        if(!empty($propiedades['readonly']) and $propiedades['readonly']=true )$propiedades['readonly']=" readonly='readonly'";else{$propiedades['readonly']='';}
        if(!empty($propiedades['disabled']) and $propiedades['disabled']=true)$propiedades['disabled']=" disabled='disabled'";else{$propiedades['disabled']='';}
        
        #### class
            if(!empty($propiedades['class']) and gettype($propiedades['class'])=='array'){
                if(count($propiedades['class'])==0)$propiedades['class']='';
                $class='';
                for ($i=0; $i <count($propiedades['class']) ; $i++) { 
                    $class.= " ".$propiedades['class'][$i].' ';
                }
                $propiedades['class']= $class;
            }else{                
                if(gettype($propiedades['class'])=='array' and count($propiedades['class'])==0)$propiedades['class']='';
            }
        #### Style
            if(!empty($propiedades['style']) and gettype($propiedades['style'])=='array'){
                if(count($propiedades['style'])==0)$propiedades['style']='';
                $keys=array_keys($propiedades['style']);# recupera las keys automaticamente
                $style='';
                for ($i=0; $i <count($keys) ; $i++) { 
                    $style.= $keys[$i].': '.$propiedades['style'][$keys[$i]].'; ';
                }
                $propiedades['style']= $style;
            }else{                
                if(gettype($propiedades['style'])=='array' and count($propiedades['style'])==0)$propiedades['style']='';
            }
        #### js   
            if(isset($propiedades['js'])and !empty($propiedades['js']) and gettype($propiedades['js'])=='array'){
                if(count($propiedades['js'])==0)$propiedades['js']='';
                $Names_eventos=array_keys($propiedades['js']);# recupera las keys automaticamente
                $EventoJS='';
                for ($i=0; $i <count($Names_eventos) ; $i++) { 
                    $Evento_selecionado=$Names_eventos[$i];
                    $ConjuntoDeFuncionesDeEvento='';
                    
                    if(gettype($propiedades['js'][$Evento_selecionado])=='string'){     
                        $ConjuntoDeFuncionesDeEvento=$propiedades['js'][$Evento_selecionado];
                        $EventoJS.=" ".$Evento_selecionado.'="'.$ConjuntoDeFuncionesDeEvento.'" ';
                    }
                    if(gettype($propiedades['js'][$Evento_selecionado])=='array'){                   
                        $Name_function=array_keys($propiedades['js'][$Evento_selecionado]);# recupera las keys automaticamente                
                        for ($g=0; $g <count($Name_function); $g++) { 
                            $selecionFuncionDeEvento=$Name_function[$g];
                            $ConjuntoDeFuncionesDeEvento.=$propiedades['js'][$Evento_selecionado][$selecionFuncionDeEvento].' ';
                        }         
                        $EventoJS.=' '.$Evento_selecionado.'="'.$ConjuntoDeFuncionesDeEvento.'" '; 
                        
                    }
                }
                $propiedades['js']=$EventoJS;
            }else{
                if(!isset($propiedades['js'])){$propiedades['js']='';}
                if(isset($propiedades['js'])and gettype($propiedades['js'])=='array' and count($propiedades['js'])==0)$propiedades['js']='';
            } 
        #### style data
            if($propiedades['type']=='date'){
                $propiedades['libre']['data-date-format']="YYYY-MM-DD";
            }
        #### libre  
            if(!empty($propiedades['libre']) and gettype($propiedades['libre'])=='array'){
                $keys=array_keys($propiedades['libre']);# recupera las keys automaticamente
                $libre='';
                for ($i=0; $i <count($keys) ; $i++) { 
                    $libre.= $keys[$i].'="'.$propiedades['libre'][$keys[$i]].'" ';
                }
                $propiedades['libre']= $libre;
            }else{                
                if(isset($propiedades['libre']) and gettype($propiedades['libre'])=='array' and count($propiedades['libre'])==0)$propiedades['libre']='';
            }
        #####presenta datos
        $GeneraSql=array(
            "tabla"=>'',
            "Operacion"=>array(  
                'viewSQL'=>'',     
                'SELECT'=>array(
                    "Activar"		=>'true',
                    "getColumnas"	=>array(),
                    "BuscaColumnas"	=>array(),
                    "BuscaDatos"	=>array(),
                    "Condiciones"	=>array(),
                    "LIMIT"			=>array(
                        "Elementos"=>'',
                        "posicion"=>''
                    ),
                    "ByOrder"		=>array(
                        "Columna"	=>'Columna',
                        "ASC-DESC"	=>'DESC'
                    ),
                ), 
            )
        );
        $ComGeneraSql=array_merge($GeneraSql,$propiedades);
        
        #echo('<pre>');
        #print_r($ComGeneraSql);
        #echo('</pre>');
        $this->libre_v2->db($ComGeneraSql['database'],$this->conexion,$this->phpv);
        $this->Ares_v1->GeneraSql($ComGeneraSql);
        #$this->Ares_v1->viewSql();
        $sql=$this->Ares_v1->getSql();
        $consu=$this->libre_v2->ejecuta($this->conexion,$sql,$this->phpv);
        $this->libre_v2->mysql_da_se($consu,0,$this->phpv);
        $NumerosDeResultados=$this->libre_v2->mysql_nu_ro($consu,$this->phpv);
        $format='';
        echo "<select id='$propiedades[id]' class='$propiedades[class]' name='$propiedades[name]' $propiedades[js] $propiedades[libre] style='$propiedades[style]'>";		#crea el objeto
            if($NumerosDeResultados==0){
                #echo "<option> Ningun Elemento Registrado</option>";
            }else{
                #echo "<option>$NumerosDeResultados Resultados</option>";
            }
            #echo "<option>".$ComGeneraSql['interfaces']['ColumnasAMostrar']."</option>";
                if(gettype($ComGeneraSql['interfaces']['ColumnasAMostrar'])=='array'){
                    $columnasAMostrar   =$ComGeneraSql['interfaces']['ColumnasAMostrar'];
                    $TextColumna        =$ComGeneraSql['interfaces']['TextColumna'];
                    for ($i=0; $i <count($columnasAMostrar) ; $i++) { 
                        ####revisas sis tiene el texto cambiado la columan sino presenta el nombre de la columna 
                        if(isset($TextColumna [$columnasAMostrar[$i]])){
                            $format.=$TextColumna[$columnasAMostrar[$i]];
                            if($i+1<count($TextColumna)){$format.=" - ";}

                        }else{
                            $format.=$columnasAMostrar[$i];
                            if($i+1<count($columnasAMostrar)){$format.=" - ";}
                        }
                    }
                    echo "<option title='$format' value=''>$format</option>";
                }
            if(gettype($ComGeneraSql['interfaces']['ColumnaValue'])=='array'){
                $ColumnaValue   =$ComGeneraSql['interfaces']['ColumnaValue'][0];
            }
			while($datos= $this->libre_v2->mysql_fe_ar($consu,$this->phpv,'')){
                
                $columnasAMostrar   =$ComGeneraSql['interfaces']['ColumnasAMostrar'];
                $ColumnasAOcultar   =$ComGeneraSql['interfaces']['ColumnasAOcultar'];
                $TextColumna        =$ComGeneraSql['interfaces']['TextColumna'];
                
                $format='';
                $ocultarrenglon=false;
                for ($i=0; $i <count($columnasAMostrar) ; $i++) { 

                    if(isset($ComGeneraSql['interfaces']['ValoresAOcultar'][$columnasAMostrar[$i]])){
                        $ValoresAOcultar   =$ComGeneraSql['interfaces']['ValoresAOcultar'][$columnasAMostrar[$i]];
                        #Ocultar Renglones
                            if(in_array($datos[$columnasAMostrar[$i]],$ValoresAOcultar)){
                                #echo "<option  selected>Oculta</option>";
                                $ocultarrenglon=true;
                            }else{
                                #echo "<option  selected>Continua</option>";
                            }
                    }
                    
                    ####revisas sis tiene el texto cambiado la columan sino presenta el nombre de la columna 
                   
                        #$format.=$columnasAMostrar[$i];
                        $format.=$datos[$columnasAMostrar[$i]];
                        if($i+1<count($columnasAMostrar)){$format.=" - ";}
                   
                }
                if( $ocultarrenglon==true)continue;
                $select='';
                if(isset($_POST[$propiedades['name']]) and !empty($_POST[$propiedades['name']])){
                    
                    if($_POST[$propiedades['name']]==$datos[$ColumnaValue]){
                        $select="selected";
                    }
                }
                echo "<option title='$format'value='$datos[$ColumnaValue]' $select>$format</option>";
                #$datos[$ColumnaValue]
            }
			#$this->mysql_da_se($consu,0,$phpv);
			#if($this->mysql_nu_ro($consu,$phpv)==0){$res=$res."<OPTION value=''>Ningun Dato Registrado</OPTION>";}
			#$EXISTE_OPCION='false';
			#$this->mysql_da_se		($consu,0,$phpv);
			#while($datos= $this->mysql_fe_ar($consu,$phpv,'')){
        echo "</select>";
       /*
        echo('<pre>');
        print_r($propiedades);
        echo('</pre>');
         echo('<pre>');
        print_r($GeneraSqlm);
        echo('</pre>');
        */
    }
    /*    
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
				if(!empty($_POST[$name]) and  $_POST[$name]==$datos[$descarga]){
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
    */
    public function despieges($despieges){
        /*
            $despieges=array(
                "name"=>'',
                'id=>'',
                "Subtitulo"=>'',
                "Elementos"=>array(),
                "TextComplemento"=>array(),
                "class"=>'',
                "style"=>'',
                "Excesiones"=>array(),
                "libre"=>''
            );
        */        
        
        if(!empty($despieges['name']))$name="name='".$despieges['name']."'";else $name='';
        if(!empty($despieges['id']))$id="id='".$despieges['id']."'";else $id='';
        if(isset($despieges['style']) and !empty($despieges['style']))$style="style='".$despieges['style']."'";else $style='';
        if(empty($despieges['class']))$despieges['class']="Medio";
        if(empty($despieges['libre']))$despieges['libre']='';
        $res="<select ".$name." ".$id." class='".$despieges['class']."' ".$style." title='' ".$despieges['libre'].">";
            if(!empty($despieges['Subtitulo']))$res=$res."<option value='".$despieges['name']."'>".$despieges['Subtitulo']."</option>";
            if(!empty($despieges['Elementos']))
            for ($x=0; $x <count($despieges['Elementos']); $x++) { 
                $complemento='';
                $elemento=$despieges['Elementos'][$x];
                if(!empty($despieges['TextComplemento']) and gettype($despieges['TextComplemento'])=='array')
                for ($y=0; $y <count($despieges['TextComplemento']) ; $y++) { 
                    $complemento=$complemento." - ".$despieges['TextComplemento'][$y];
                }                
                if(!empty($despieges['name']) and !empty($_POST[$despieges['name']]) and $_POST[$despieges['name']]==$elemento){$set='selected';}else{$set='';}
                $Excesiones='false';
                if(!empty($despieges['Excesiones']) and gettype($despieges['Excesiones'])=='array'){
                    for ($y=0; $y < count($despieges['Excesiones']); $y++) { 
                        if($despieges['Excesiones'][$y]==$elemento){#omitir elemento
                            $Excesiones='true';
                        }
                    }
                }
                if($Excesiones=='false'){
                    $res=$res."<option value='".$elemento."' $set>".$elemento.$complemento."</option>";    
                }
            }else{
                $res=$res."<option >Ningun Dato</option>";    
            }      
        $res=$res.'</select>';
        return $res;
    }
    public function formato_num($numero){
        $res=number_format($numero,2);
        return $res;
    }
    public function tablas_array($array){
        /*
            $array=array(
                "columnas"=>2,
                "renglones"=>'auto',
                "elementos"=>array(      
                    "Columnas_name"=>array(
                        'A'=>'Abonos',
                        'B'=>'Depositos',
                    ),
                    "Columnas_Title"=>array(
                    ),  
                    "ELEMENTOS"=>array(
                        #'A'=>array('contador','input','input')
                        'A'=>array(
                            array(# numerador (1->n)
                                'type'=>'numerador',
                                'inicio'=>1,
                                'tabindex'=>'none'
                            ),
                            array(# numerador (1->n)
                                'type'=>'input',
                                'name'=>''
                            ),
                            array(# numerador (1->n)
                                'type'=>'input',
                                'name'=>'comentarios',                        
                                'tabindex'=>'none'
                            )
                        ),
                        'B'=>array(
                            array(# numerador (1->n)
                                'type'=>'numerador',
                                'inicio'=>1,                        
                                'tabindex'=>'none'
                            ),
                            array(# numerador (1->n)
                                'type'=>'input',
                                'name'=>'',
                            ),
                            array(# numerador (1->n)
                                'type'=>'input',
                                'name'=>'comentarios',
                                'tabindex'=>'none'
                            )
                        )

                    ),            
                ),
                "class"=>array(
                    "principal"=>""

                )
            );
        */
        #if($array['class']['principal'])
        $elementos=$array['elementos'];
        $class=$array['class'];
        #styles
            if(empty($class['principal'])){
                $class['principal']='background: #343434; width: auto; height: auto; overflow: hidden;max-width: 100vw;color:dodgerblue float: left;';
            }
            if(empty($class['secundarios'])){
                $class['secundarios']='float: left;border: solid #f9f9f9;border-width: 1px; width: min-content;margin: 3.5px;padding: 3px;';
            }
            
        echo"<div  style=   '$class[principal]'>";
            if(gettype($array['columnas'])=='string')$array['columnas']= count($elementos['ELEMENTOS']);
            if(!empty($array['titulo_tablas']))echo$array['titulo_tablas'];
            #ciclo para desplegar las columnas
            for ($o=1; $o<=$array['columnas'] ; $o++) { 
                $LETRA=chr(64 + $o);
                echo"<div style='$class[secundarios]'>";
                    echo"<div class='colores_paleta2a'>";  
                    #titulo de la columna
                        if(!empty($elementos['Columnas_name'] and !empty($elementos['Columnas_name'][$LETRA]))){
                            echo$elementos['Columnas_name'][$LETRA];                            
                        }               
                    #titulos de el renglon si es con un diseño especial 
                        if(!empty($elementos['Columnas_Title'][$LETRA]) and gettype($elementos['Columnas_Title'][$LETRA])=='array'){                           
                            for ($i=0; $i <count($elementos['Columnas_Title'][$LETRA]); $i++) { 
                                echo $elementos['Columnas_Title'][$LETRA][$i];
                            }
                        }
                        elseif(!empty($elementos['Columnas_name']) and gettype($elementos['ELEMENTOS'])=='string'){
                            echo$elementos['Columnas_name'][$LETRA];                            
                        }
                        echo"</div>";
                        echo"<div class='colores_paleta2a'>";
                                                
                    #control para la generacion de renglones (automatico o manual)
                        #control Manual de los renglones 
                            if(gettype($array['renglones'])=='integer'){
                                $renglones=$array['renglones'];
                            }
                        #control automatico
                            if(gettype($array['renglones'])=='string' and $array['renglones']=='auto'){
                                #define y establese la memoria que contiene el numero de renglones que tiene la columnas
                                #asi mismo ordena y ajusta las celdas automaticamente 
                                $name_memoria='memoria'.$LETRA;
                                if(empty($_POST[$name_memoria])){ #inicialica la memoria 
                                    $_POST[$name_memoria]=1;
                                }else{#ajusta las celdas
                                    $Celdas_vacias=0;
                                    #recomoda las celdas si hay celdas vacias 
                                    for ($i=1; $i <=$_POST[$name_memoria]; $i++) { 
                                        $Celda=chr(64 + $o).$i;
                                        #si hay una celda vacia en medio de todas las celdas y las reacomodad 
                                        if($i<=$_POST[$name_memoria] and empty($_POST[$Celda])){
                                            #obtiene la siguiente celda con datos
                                            for ($k=$i; $k <=$_POST[$name_memoria]; $k++) { 
                                                $Celda_busca=chr(64 + $o).$k;
                                                if(!empty($_POST[$Celda_busca])){
                                                    #pasa el valor de la siguiente celda con informacion a la actual 
                                                    $_POST[$Celda]=$_POST[$Celda_busca]; 
                                                    #borra el valor de la siguiente celda 
                                                    $_POST[$Celda_busca]='';
                                                    break;
                                                    
                                                }                             
                                            }
                                        }                            
                                    }
                                    #cuenta las celdad vacias 
                                    if($_POST[$name_memoria]>1){
                                        for ($i=1; $i <=$_POST[$name_memoria]; $i++) { 
                                            #cuenta cuantas celdas estan vacias 
                                            $Celda_busca=chr(64 + $o).$i;
                                            if(empty($_POST[$Celda_busca]))$Celdas_vacias++;
                                        }
                                        if($Celdas_vacias>0){
                                            $_POST[$name_memoria]=$_POST[$name_memoria]-($Celdas_vacias);
                                        }
                                    }
                                    #revisa la ultima celdad que este ocuparar para poder agregar una nueva al final
                                    $ultima_celda=chr(64 + $o).$_POST[$name_memoria];
                                    if(!empty($_POST[$ultima_celda])){
                                        $_POST[$name_memoria]=$_POST[$name_memoria]+1;
                                    }             
                                }
                                
                                echo $this->input('hidden',$name_memoria,$_POST[$name_memoria],'','','','','');
                                $renglones=$_POST[$name_memoria];
                            }
                    
                    #ciclo para desplegar los renglones 
                    for ($i=1; $i <=$renglones; $i++) { 
                        $Celda=chr(64 + $o).$i;
                        #cada renglon esta diseñada para soportar uno o mas o elementos dentro
                        
                        #verifica si hay mas de un elemento por cada celda 
                            if(!empty($elementos['ELEMENTOS']) and gettype($elementos['ELEMENTOS'])=='array'){
                                #recore cada elementos dentro de las celdas 
                                for ($u=0; $u <count($elementos['ELEMENTOS'][$LETRA]) ; $u++) { 
                                    $obj=$elementos['ELEMENTOS'][$LETRA][$u];                                   
                                    if(!empty($obj['tabindex']) and $obj['tabindex']=='none'){
                                        $libre='tabindex="-1"';
                                    }else{$libre='';}
                                    if(gettype($obj)=='array'){
                                        
                                        switch ($obj['type']) {
                                            case 'numerador':                            
                                                $style='width: 30px;text-align: center;';
                                                echo $this->input('text','',$i,'','','',$libre,$style);
                                            break;                                        
                                            case 'input':
                                                $name=$obj['name'].$Celda;
                                                if(!empty($obj['style'])){$style=$obj['style'];}else{$style='';}
                                                if(empty($_POST[$name]))$_POST[$name]='';
                                                echo $this->input('text',$name,$_POST[$name],'','','',$libre,$style);
                                            break;
                                            case'select':
                                                $name=$obj['name'].$Celda;
                                                if(!empty($obj['style'])){$style=$obj['style'];}else{$style='';}
                                                echo"<select name='$name'>";
                                                for ($i=0; $i <=count($elementos) ; $i++) { 
                                                    echo"<option value='".$elemento[$i]."' $set>".$elemento[$i]."</option>";   
                                                }
                                                echo"</select>";
                                            break;   
                                        }
                                    }
                                    if(gettype($obj)=='string'){
                                        echo $obj;
                                    }
                                }
                            }
                            elseif(!empty($elementos['ELEMENTOS']) and gettype($elementos['ELEMENTOS'])=='string'){
                                echo$elementos['ELEMENTOS'];
                            }
                        echo"<br>";
                    }                    
                    echo"</div>";
                echo"</div>";
            }
        echo"</div>";
    }
    public function popmenu($array){
        /*
            $array=array(
                "elementos"=>array(
                    "origen"=>$elemento,
                    "menu"=>array(
                            "type"=>'mysql'
                            "consu",$popmenu,
                            "columnas"=>array()
                        )
                ),
                "class"=>array(
                    "origen"=>""
                ),
                "style"=>array(
                    "origen"=>""
                )

            )
        */
        $elemento=$array['elementos'];
        $class=$array['class'];
        $style=$array['style'];
        #SELECT DISTINCT(CHOFER) FROM `folio`    
        if(empty($class['origen']) and empty($style['origen'])){$style['origen']="float: left;";}else{$style['origen']='';}
        if(!empty($style['origen']))$style['origen']="style='$style[origen]'";
        if(!empty($class['origen']))$class['origen']="class='$class[origen]'";

        echo"<div $style[origen] $class[origen]>";
            echo $elemento['origen'];
            #echo"<div class='popmenu'>";
            echo"<div >";
            #echo $elemento['menu'];
            
            if(gettype( $elemento['menu'])=='String'){}
            if(gettype( $elemento['menu'])=='array'){
                if(empty($elemento['menu']['type'])){}              #cuando es un array simple 
                if(!empty($elemento['menu']['type']) and $elemento['menu']['type']=='mysql'){#una datos mysql 
                    #echo"<div >";
                        while($datos=$this->libre_v2->mysql_fe_ar		($elemento['menu']['consu'],$this->phpv,'')){
                            $value=$datos[$elemento['menu']['columna']];
                            echo $this->input('submit','',$value,'','','','',''); #control Externo
                            
                            echo"<br>";
                        }
                    #echo"<br>";
                }
            }
            echo"</div>";
        echo"</div>";
    }
    
}
class Consola{ 
    private $libre_v1;
    private $libre_v2;
    private $libre_v5;
    private $phpv;
    private $conexion;
    public function __construct($phpv,$conexion,$array){	
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);	
        $this->libre_v5	=new libre_v5($phpv,$conexion,'');
        $this->phpv=$phpv;	
        $this->conexion=$conexion;	
        
    }    
    
}
class Excel{
    /*
        $Archivo_excel= new Excel();
        $Archivo_excel->cargar_excel($nombreArchivo);
        $Archivo_excel->setDatosExcel();
        $datos=$Archivo_excel->getDatosExcel();	
        echo count($datos['values']);
        echo $datos['values']["E14"];
        
        $this->Datos_excel=array(
            "Renglones"=>$numRows,
            "Columnas"=>$columnas,
            "volumen"=>$volumen,
            "values"=>array(),
            "formulas"=>array()
        );
        */
    private  $Datos_excel;	
    public function getDatosExcel(){
        return $this->Datos_excel;
    }	
    public function cargar_excel($nombreArchivo){	//alamcena la informacion del archivo de excel en una array
        $objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);	
    
        $objPHPExcel->setActiveSheetIndex(0);	//Asigno la hoja de calculo activa
        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Obtengo el numero de filas del archivo
        $columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();   //Obtengo el numero de columnas del archivo
        $volumen = $objPHPExcel->setActiveSheetIndex(0)->calculateWorksheetDimension();   //Obtengo el numero de columnas del archivo
        
        //$Datos_excel=array(
        $this->Datos_excel=array(
            "Renglones"=>$numRows,
            "Columnas"=>$columnas,
            "volumen"=>$volumen,
            "values"=>array(),
            "formulas"=>array()
        );
        
        for ($xonta = 1; $xonta <= $numRows; $xonta++) {//almacena la informacion en arrays 		
            for ($x=65; $x<=90; $x++) { //falta amplar la pacasidad de cactura de datos lla que este solo puede procesar de A hasta Z
                $letra=chr($x);	//a to Z
                $cell = $objPHPExcel->getActiveSheet()->getCell($letra.$xonta); #obtengo la celda 
                $InvDate= $cell->getValue();                                    #obtengo el valor de la celda
                //$InvDate = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate)); 
                

                if(PHPExcel_Shared_Date::isDateTime($cell)){
                    $fecha = date($format="Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate)); 
                    $this->Datos_excel['values'][$letra.$xonta]=$fecha;
                }else{
                    #echo $objPHPExcel->getActiveSheet()->getStyle($letra.$xonta)->getNumberFormat();#->setFormatCode('YY-MM-DD'); 
                    $valor=$objPHPExcel->getActiveSheet()->getCell($letra.$xonta)->getCalculatedValue();
                    $this->Datos_excel['values'][$letra.$xonta]=$valor;
                }
                

                $this->Datos_excel['formulas'][$letra.$xonta]=$objPHPExcel->getActiveSheet()->getCell($letra.$xonta)->getValue();
                if($letra==$columnas)break;
            }	
        }
    }
    public function setDatosExcel(){            
        echo '<br><table border=1>';
            echo"<tr>";
                echo"<td></td>";	
                for ($x=65; $x<=90; $x++) {
                    $letra=chr($x);		

                        echo"<td>$letra</td>";		
                    if($letra==$this->Datos_excel['Columnas'])break;
                }	
            echo"</tr>";                
            for ($xonta = 1; $xonta <= $this->Datos_excel['Renglones']; $xonta++) {		                        
                echo '<tr>';
                echo '<td>'. $xonta.'</td>';
                for ($x=65; $x<=90; $x++) {
                    $letra=chr($x);	
                    echo '<td>'. $this->Datos_excel['values'][$letra.$xonta].'</td>';
                if($letra==$this->Datos_excel['Columnas'])break;
                }
                echo '</tr>';
                //$sql = "INSERT INTO productos (nombre, precio, existencia) VALUES('$nombre','$precio','$existencia')";
                //$result = $mysqli->query($sql);
            }
        echo '</table>';
    }
}
class Archivos{  
    private $libre_v1;
    private $libre_v2;
    private $libre_v4;
    private $libre_v5;
    private $phpv;
    private $conexion;
    public function __construct($phpv,$conexion,$array){	
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);	
        $this->libre_v4= new libre_v4($phpv,$conexion); 
        $this->libre_v5= new libre_v5($phpv,$conexion,'');
        #$this->Columna_automaticas= new Columna_automaticas($phpv,$conexion,'');
        $this->folders=array();
        $this->archivos=array();
        $this->phpv=$phpv;	
        $this->conexion=$conexion;	
    }   
    function BarraExplorador($array){
        echo"<div>";
            #$this->libre_v5->input($type,$name,$value,$id,$class,$title,$libre,$style);
            echo"<i class='fas fa-folder'></i>";
            echo $this->libre_v5->input('submit','Operadores','Back','','','','','');
        echo"</div>";
    }
    function Explorador($array){ 
        /*
            $array=array(
                "URL_HOME"=>"",
                "URL_RELATIVA"=>$URL_RELATIVA
                
            );
        */
        
        
        $URL=$_SERVER["DOCUMENT_ROOT"].$array['URL_RELATIVA']; 
        if(empty($_POST['URL_RELATIVA']))$_POST['URL_RELATIVA']='';
        echo $this->libre_v5->input('text','URL_RELATIVA',$_POST['URL_RELATIVA'],'','','','','');
        $dire_open = opendir($URL); #Abre la ruta solicitada
        $temp_folders=array();
        $temp_archivos=array();
        while ($archivo = readdir($dire_open)){#extrae los archivo
            echo$archivo;
            echo"<br>";
            #almacena los datos dependiendo si es archivo o un folder 
            /*
            #folders
                
                #if (is_dir($archivo) and ($archivo!="." and $archivo!="..")){
                if (is_dir($archivo)){
                    $temp_folders[]=$archivo;
                }
            #Archivos
                elseif($archivo!="." and $archivo!=".."){
                    $temp_archivos[]=$archivo;
                }else{
                    echo$archivo;
                }
            */
        }     

    }
    function Explorar($array){
        static $RUTA=array();
        #control de acesos a carpetas 
            if(!$this->libre_v2->busca_array($RUTA,$_POST['Carpeta'])){
                    echo"agregar Carpeta";
                    $RUTA=$this->libre_v2->add_array($RUTA,'',$_POST['Carpeta']);
             }
            

        /*
            $array=array(
                "URL_RELATIVA"=>$URL_RELATIVA
            );
        */
        $URL=$_SERVER["DOCUMENT_ROOT"].$array['URL_RELATIVA'];
        #chdir (string $directory)#camvia a un directorio 
        echo"<br> actual:".getcwd(); #ruta actual
        echo"<br>";
        /*
        $partes_ruta = pathinfo($URL);
        echo"<br>dirname: ".$partes_ruta['dirname'];
        echo"<br>base name: ".$partes_ruta['basename'];
        echo"<br>file: ".$partes_ruta['extension'], "\n";
        echo"<br>filemane: ".$partes_ruta['filename']; // desde PHP 5.2.0
        echo"<br>";
        */
        #mueve entre las carpetas
        /*
        if(!empty($_POST['Carpeta'])){
            chdir($_POST['Carpeta']);#cambia el directorio
            if(!empty($_POST['Operadores']))
            switch ($_POST['Operadores']) {
                case 'Back': #regresa a la carpeta anterior 
                    chdir('.');
                break;
            }

        }*/
        echo"<br>";
        #$archivos = scandir($URL, 0);  # 0 desendente, 1 acendente, SCANDIR_SORT_NONE sin ordenanr 
        #print_r($archivos);            #imprime los datos obteneidos  

        $dire_open = opendir($URL); #Abre la ruta solicitada
        $temp_folders=array();
        $temp_archivos=array();
            while ($archivo = readdir($dire_open)){#extrae los archivo
                #almacena los datos dependiendo si es archivo o un folder 
                #folders
                    
                    #if (is_dir($archivo) and ($archivo!="." and $archivo!="..")){
                    if (is_dir($archivo)){
                       $temp_folders[]=$archivo;
                    }
                #Archivos
                    elseif($archivo!="." and $archivo!=".."){
                        $temp_archivos[]=$archivo;
                    }else{
                        echo$archivo;
                    }
            }                        
            
        if(!empty($array['URL_RELATIVA'])){
            $this->folders[$array['URL_RELATIVA']]=$temp_folders;        
            $this->archivos[$array['URL_RELATIVA']]=$temp_archivos;
        }
        return array(
            "Carpetas"=>$temp_folders,
            "Archivos"=>$temp_archivos
        );
    }
    function viewExplorar($array){
        /*
        $array=array(
            "class"=>array(
                "Contenedor"=>$Conte
            ),
            "Archivos"=>$archivos
        );
        */
        if(!empty($array['class']['Contenedor']))$classDiv="class='".$array['class']['Contenedor']."'";else$classDiv='';
        echo"<div ".$classDiv.">";
        
            #Carpetas
            /*
                $class=array(
                    'Conte_principal'=>'',
                    'Div_Opcion'=>'',
                    'Boton'=>'',
                    'img'=>''
                );
            */
            #lista 
            $name_menu='Carpeta';
            $elemento_menu=$array['Archivos']['Carpetas'];
            $class=array(
                'Conte_principal'=>'',
                'Div_Opcion'=>'opcion_lista',
                'Boton'=>'boton_lista',
                'img'=>'img_lista'
            );
            $otros_arrays=array(
                'img_activa'=> 'true',
                'img_defaul'=>'../img/folder3.png',

                'img'=>array(),
                'memoria'=>array('Activa'=>true,'type'=>'hidden')
            );
            $this->libre_v5->menu($name_menu,$elemento_menu,$class,$otros_arrays);
            $name_menu='Archivos';
            $elemento_menu=$array['Archivos']['Archivos'];
            $class=array(
                'Conte_principal'=>'',
                'Div_Opcion'=>'opcion_lista',
                'Boton'=>'boton_lista',
                'img'=>'img_lista'
            );
            $otros_arrays=array(
                'img_activa'=> 'true',
                'img_defaul'=>'../img/excel.png',

                'img'=>array(),
                'memoria'=>array('Activa'=>true,'type'=>'hidden')
            );
            $this->libre_v5->menu($name_menu,$elemento_menu,$class,$otros_arrays);
        echo"</div>";
    }
    function print_array($array){ 
        $res=false;
        for($x=0; $x<count($array); $x++){
            echo $array[$x];
            echo "<br>";
        }
    }
}/*
class Explorador_Carpetas{
    private $URL_HOME_SERVER;
    private $URL_HOME_ALTERNO;
    private $URL_HOME_NEW;
    private $URL_NAVEGATION;
    private $URL_WORK;
    private $Lista_De_Elementos;
    
    public function __construct($phpv,$conexion,$array){	
       /* $array=array(
            "New_Home"=>"",
        );
    *
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);
        
        $this->phpv=$phpv;	
        $this->conexion=$conexion;	
        
        $this->URL_HOME_SERVER      =$_SERVER["DOCUMENT_ROOT"];
        $this->URL_HOME_ALTERNO     =$_SERVER["DOCUMENT_ROOT"]."/archivos_subidos/";
        if(isset($array['New_Home'])){
            $this->URL_HOME_NEW     =$_SERVER["DOCUMENT_ROOT"]."/".$array['New_Home']."/";
        }
        $this->URL_WORK             =$_SERVER["DOCUMENT_ROOT"];
    }   
    public function Control_URL_WORK(){
        if(!empty($this->URL_HOME_NEW)) $this->URL_WORK=$this->URL_HOME_NEW;
        if(empty($this->URL_WORK )){
            $this->URL_WORK =$this->URL_HOME_SERVER;
        }
    }
    public function ScaneURL($array){
        if(isset($array)and isset($array['URL_Scane'])and$array['URL_Scane']!=''){

            $dire=$this->URL_HOME_SERVER."/".$array['URL_Scane'];
        }else{
            $dire=$this->URL_HOME_SERVER;
        }
        
        $ficheros=scandir($dire);
        echo('<pre>');
        print_r($ficheros);
        echo('</pre>');


    }
    public function GeneraLista_De_Elementos(){
       
        #$FICHEROS_DE_TRABAJO=scandir($this->URL_WORK);
        #echo('<pre>');
        #print_r($FICHEROS_DE_TRABAJO);
        #echo('</pre>');
        
        $FILES_WORK = opendir($this->URL_WORK);  
        $Lista_De_Elementos=Array(
            "URL"=>$this->URL_WORK,
            "Carpetas"=>Array(),
            "Archivos"=>Array(),
        );
        while ($elemento = readdir($FILES_WORK)){
            if(is_dir($this->URL_WORK."/".$elemento)){
                $Lista_De_Elementos["Carpetas"][]=$elemento;
            }
            if(is_file($this->URL_WORK."/".$elemento )){
                $Lista_De_Elementos["Archivos"][]=$elemento;

            }
        }
        $this->Lista_De_Elementos=$Lista_De_Elementos;
    }
    public function getLista_De_Elementos(){
        return $this->Lista_De_Elementos;
    }
    public function viewLista_De_Elementos(){
        echo('<pre>');
        print_r($this->Lista_De_Elementos);
        echo('</pre>');
    }

}
*/
class Explorar_carpetas{
    private $URL_ACTUAL;
    private $URL_HOME;
    private $URL_Cascada;
    
    public function __construct($phpv,$conexion,$array){	
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);
        
        $this->phpv=$phpv;	
        $this->conexion=$conexion;	
        $this->URL_HOME=$_SERVER["DOCUMENT_ROOT"]."/archivos_subidos/";
        $this->URL_ACTUAL='';
        $this->URL_Cascada='';
    }   
    public function control_de_ruta(){   
        $subCarpetas=$this->getElementosMemoria();
        if(isset($_POST['Select_Carpeta'])){
            #verifica que no exista lla en memoria 
            echo $posicion=array_search($_POST['Select_Carpeta'], $subCarpetas);
            echo gettype($posicion);
            if(gettype($posicion)=='boolean'and $posicion==false){
                echo "false";
                $this->add_memoria();
            }
            if(gettype($posicion)=='boolean'and $posicion==true){
                echo"treu ";
            }
        }     
        $subCarpetas=$this->getElementosMemoria();
        $this->URL_Cascada='';
        $this->URL_ACTUAL='';
        for ($i=0; $i <count($subCarpetas) ; $i++) { 
            $this->URL_Cascada.=$subCarpetas[$i]."/";
            $this->URL_ACTUAL.=$subCarpetas[$i]."/";
        }
        if(isset($_POST['selector_URL'])){
            if($_POST['selector_URL']=='Home'){
                #regresa a la carpeta home 
                $this->URL_ACTUAL='';
            }else{
                #verifica que en que posicion de lpuntero esta para luego pasarlo a la url 
                #busca posicion
                echo $posicion=array_search($_POST['selector_URL'], $subCarpetas);
                #Reposiciona                        
                $this->URL_Cascada='';
                $this->URL_ACTUAL='';
                for ($i=0; $i <=$posicion ; $i++) { 
                    $this->URL_Cascada.=$subCarpetas[$i]."/";
                    $this->URL_ACTUAL.=$subCarpetas[$i]."/";
                }
            }

        }
        $this->view_memoria_de_ruta();
    }
    function add_memoria(){
        if(!isset($_POST['memoria_carpetas']))$_POST['memoria_carpetas']=0;
        $_POST['memoria_carpetas']++;
        $cont=$_POST['memoria_carpetas'];
        $_POST['Carpeta_selet'.$cont]=$_POST['Select_Carpeta'];
    }
    
    function view_memoria_de_ruta(){        
        echo $this->libre_v2->input2('hidden','memoria_carpetas','','','','','','');
        if(isset($_POST['memoria_carpetas']) ){
            for ($i=1; $i <=$_POST['memoria_carpetas']; $i++) { 
                echo $this->libre_v2->input2('hidden','Carpeta_selet'.$i,'','','','','','alin_left');
            }
        }
    }
    function getElementosMemoria(){
        $elementos=array();
        if(isset($_POST['memoria_carpetas']) ){
            for ($i=1; $i <=$_POST['memoria_carpetas']; $i++) { 
                #echo $this->libre_v2->input2('text','Carpeta_selet'.$i,'','','','','','alin_left');
                $elementos[]=$_POST['Carpeta_selet'.$i];
            }
        }
        return $elementos;
    }
    function viewElementosMemoria(){
        
        echo('<pre>');
        print_r($this->getElementosMemoria());
        echo('</pre>');
    }
    function getURL(){        
        if(!empty($this->URL_Cascada)){
            $URL=$this->URL_HOME.$this->URL_Cascada;
        }else{
            $URL=$this->URL_HOME;
        }
        return $URL;
    }
    function viewURL(){
        echo $this->getURL();
    }
    public function view_control_rutas(){
        echo"<div>";
            echo $this->libre_v2->input2('button','',"HOME","HOME",'','','','design_gris back_blue1 shado_azul_claro1 PX_wd_gra');
            echo $this->libre_v2->input2('button','',$this->URL_ACTUAL,$this->URL_ACTUAL,'','','','design_gris back_blue1 shado_azul_claro1 PX_wd_gra');

        echo"</div>";
    }
    public function view_files_carpeta(){
        #echo $this->URL_HOME;
        #echo"<br>";
        #echo $this->URL_Cascada;/
        if(!empty($this->URL_Cascada)){
            $URL=$this->URL_HOME.$this->URL_ACTUAL;
        }else{
            $URL=$this->URL_HOME;
        }

        $ficheros=scandir($URL);
        
        echo"<div id='VentanaUrl'style='position: relative;overflow: hidden;width: 100%;max-width: 700px;float: left;'>";
            echo"<div id='URLs'style='position: relative;background: #292a2d;padding: 5px;border: solid;border-color: #676767;'>";
                $elementosURL=$this->getElementosMemoria();
                echo $this->libre_v2->input2('button','','','>','width: min-content;','','','design_gris back_blue1 shado_azul_claro1 PX_wd_gra');                
                echo $this->libre_v2->input2('submit','selector_URL','','Home','width: min-content;','','','design_gris back_blue1 shado_azul_claro1 PX_wd_gra');

                for ($i=0; $i <count($elementosURL) ; $i++) { 
                    
                    echo $this->libre_v2->input2('button','','','>','width: min-content;','','','design_gris back_blue1 shado_azul_claro1 PX_wd_gra');
                    echo $this->libre_v2->input2('submit','selector_URL','',$elementosURL[$i],'width: min-content;','','','design_gris back_blue1 shado_azul_claro1 PX_wd_gra');

                }            
            echo"</div>";
            echo"<div id='Carpetas' style='position: relative;float: left;background: #292a2d;height: 200px;overflow: auto;padding: 5px;border: solid;border-color: #676767;'>";
                #echo $this->libre_v2->input2('text','Select_Archivo',$this->URL_Cascada,$this->URL_Cascada,'width: 500px;float:left;','','','design_azul1 back_blue1 shadow_azul_claro1 PX_wd_gra txt_le');
                $dir = opendir($URL);        
                while ($elemento = readdir($dir)){
                    if( $elemento != "." && $elemento != ".."){
                        if(is_dir($URL."/".$elemento)){
                            echo $this->libre_v2->input2('submit','Select_Carpeta',$elemento,$elemento,' width:500px;float:left;','','','design_gris back_blue1 shado_azul_claro1 PX_wd_gra txt_le');                   
                        }                              
                    }
                }
                $dir = opendir($URL);
                while ($elemento = readdir($dir)){
                    if( $elemento != "." && $elemento != ".."){                
                        if(is_file($URL."/".$elemento )){                    
                            echo $this->libre_v2->input2('submit','Select_Archivo',$elemento,$elemento,'width: 500px;float:left;','','','design color_transparent back_blue1 shadow_azul_claro1 PX_wd_gra txt_le');                 
                            
                        }                
                    }
                }
            echo"</div>";
        echo"</div>";
    }
}
class Procesador_ArchivosYurl{
    private $URL_workin;
    private $URL_HOME;
    private $URL_SERVER;
    private $URL_Cascada;
    #$array_Procesador_ArchivosYurl=array(
        #""
    #}
        
    public function __construct($phpv,$conexion,$array){	
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);
        
        $this->phpv=$phpv;	
        $this->conexion=$conexion;	
        $this->URL_HOME=$_SERVER["DOCUMENT_ROOT"]."";
        $this->URL_SERVER=$_SERVER["DOCUMENT_ROOT"];
        $this->URL_workin='';
        $this->URL_Cascada='';
        $this->internalControlUrl('');
    } 
    public function getUrlworkin(){
        return $this->URL_workin;
    }
    public function viewUrlworkin(){
        echo  $this->URL_workin;
    }
    public function internalControlUrl($array){
        if(isset($array['URL_Cascada']) and !empty($array['URL_Cascada'])){
            $this->URL_Cascada=$array['URL_Cascada'];
        }
        

        #####
        if(!empty($this->URL_Cascada))$this->URL_workin=$_SERVER["DOCUMENT_ROOT"].$this->URL_Cascada;
        if(empty($this->URL_workin))$this->URL_workin=$this->URL_SERVER;
    }
      
    /*
    function memoria_navegadorCarpeta(){
        
    }
    function Open_Carpeta(){
        #### leer posicion actual
        #### verifica si solicita cambio 
        if(isset($_POST['SeletCarpeta']) and !empty($_POST['SeletCarpeta'])){

        }
    }
    function memoria_CarpetaActual(){
        
    }
    function memoria_ArchivoActual(){

    }
    */
    public function ScaneURL($array){       
       
        #$FICHEROS_DE_TRABAJO=scandir($this->URL_WORK);
        #echo('<pre>');
        #print_r($FICHEROS_DE_TRABAJO);
        #echo('</pre>');
        
        $FILES_WORK = opendir($this->URL_workin);  
        #echo('<pre>');
        #print_r($FILES_WORK);
        #echo('</pre>');
      
        $Lista_De_Elementos=Array(
            "URL"=>$this->URL_workin,
            "Carpetas"=>Array(),
            "Archivos"=>Array(),
        );
        while ($elemento = readdir($FILES_WORK)){
            if(is_dir($this->URL_workin."/".$elemento)){
                $Lista_De_Elementos["Carpetas"][]=$elemento;
            }
            if(is_file($this->URL_workin."/".$elemento )){
                $Lista_De_Elementos["Archivos"][]=$elemento;

            }
        }
        $this->Lista_De_Elementos=$Lista_De_Elementos;
        #echo('<pre>');
        #print_r($Lista_De_Elementos);
        #echo('</pre>');
    }
    function getElementosCarpeta(){
        return $this->Lista_De_Elementos;
    }
    function viewElementosCarpeta(){
        echo('<pre>');
        print_r($Lista_De_Elementos);
        echo('</pre>');
    }

}
?>
