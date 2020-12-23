<?php               //libreria iniciada el 10/12/2019 proceso de reinicio 
class inputs{
    public $propiedades;
    public $input;
    private $libre_v5;
    function __construct($phpv,$conexion,$Mod_propiedades){
        $this->libre_v5	=new libre_v5($phpv,$conexion,'');	
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
            $this->colunas_index[]=$name;            
            $this->colunas[$name]=array(
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
                    "style"=>'',
                    "placeholder"=>'',
                    "libre"=>''
                )
            );         
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
    public function elimina_renglones(){
        $ultimo_renglon=$_POST[$this->name_memoria];
        $autorizacion_Elimina_renglon=true;
        $autorizacion_de_agregar=true;
        for ($d=$ultimo_renglon-1; $d >0 ; $d--) { #ciclo para los renglones omitiendo el ultimo 
            for ($i=0; $i<count($this->colunas_index) ; $i++) { #ciclo para recorer todas las columnas 
                $columnas=$this->colunas_index[$i];
                $celda=$this->colunas_index[$i].$d;
                if(empty($this->columnas_requerida)){                    
                    if ($this->verificasion_celdas['vacios'][$celda]==true){ #ningula columna espesificada, todas son obligatorias
                        $autorizacion_Elimina_renglon=false;
                    }
                }elseif(!empty($this->columnas_requerida)){                
                    if ($this->columnas_requerida[$columnas]==true 
                    and $this->verificasion_celdas['vacios'][$celda]==true){ #ningula columna espesificada, todas son obligatorias
                        #echo" desactiva ";
                        $autorizacion_Elimina_renglon=false;
                    }        
                }
                #echo"<br>";
            }
            if($autorizacion_Elimina_renglon==true){
                #echo" delet ";
                $_POST[$this->name_memoria]=$_POST[$this->name_memoria]-1;
            }
        }

    }
    public function add_renglon(){
        $ultimo_renglon=$_POST[$this->name_memoria];
        $autorizacion_de_agregar=true;
        for ($i=0; $i<count($this->colunas_index) ; $i++) { #ciclo para recorer todas las columnas 
            $columnas=$this->colunas_index[$i];
            $celda=$this->colunas_index[$i].$ultimo_renglon;
            if(empty($this->columnas_requerida)){
                if ($this->verificasion_celdas['vacios'][$celda]==false){ #ningula columna espesificada, todas son obligatorias
                    $autorizacion_de_agregar=false;
                }           
            }elseif(!empty($this->columnas_requerida)){                
                if ($this->columnas_requerida[$columnas]==true and $this->verificasion_celdas['vacios'][$celda]==false){ #ningula columna espesificada, todas son obligatorias
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
            for ($i=0; $i<count($this->colunas_index) ; $i++) { #presenta stodas las columnas 
                $celda=$this->colunas_index[$i].$d; 
                if ($this->verificasion_celdas['vacios'][$celda]==true){ #ningula columna espesificada, todas son obligatorias
                    $autorizacion_de_reacomodo=false;
                }           
            }
            if($autorizacion_de_reacomodo==true){
                $next=$d+1;
                if($next<$ultimo_renglon){
                    for ($i=0; $i<count($this->colunas_index) ; $i++) { #presenta stodas las columnas 
                        $celda=$this->colunas_index[$i].$d; 
                        $celda_next=$this->colunas_index[$i].$next; 
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
            $name_columna=$this->colunas_index[$d];
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
        $total=0;
        for ($i=0; $i <count($this->lista_auto_sumas) ; $i++) {  
            for ($d=1; $d <$ultimo_renglon; $d++) { 
                $celda=$this->lista_auto_sumas[$i].$d;
                if(is_numeric($_POST[$celda]))$total=$total+$_POST[$celda];
            }
            
            
            $this->operaciones_math['SumaTotal'][$this->lista_auto_sumas[$i]]=$total;
            
        }
        /*
        for ($i=0; $i<count($this->$array_auto) ; $i++) { #ciclo para recorer todas las columnas 
            $columnas=$this->colunas_index[$i];
            $celda=$this->colunas_index[$i].$ultimo_renglon;
            if(empty($this->columnas_requerida)){
                if ($this->verificasion_celdas['vacios'][$celda]==false){ #ningula columna espesificada, todas son obligatorias
                    $autorizacion_de_agregar=false;
                }           
            }elseif(!empty($this->columnas_requerida)){                
                if ($this->columnas_requerida[$columnas]==true and $this->verificasion_celdas['vacios'][$celda]==false){ #ningula columna espesificada, todas son obligatorias
                    $autorizacion_de_agregar=false;
                }    

            }
        }
        */

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
                                $propiedades['name']= $columna_actual.$d;
                                echo $this->libre_v5->inputArray($propiedades);                            
                            }
                            #auto sumas 
                            if(!empty($this->operaciones_math['SumaTotal'][$columna_actual])){
                                $propiedades['name']='';
                                $propiedades['value']= $this->operaciones_math['SumaTotal'][$columna_actual];
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
    private $phpv;
    private $conexion;
    private $paginacion;
    public function __construct($phpv,$conexion,$array){	
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);	
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
        #asigna el valor directamente desde el post
        if(empty($value) and !empty($name)and!empty($_POST[$name])){$value=$_POST[$name];}
        
        $res="<input type='$type' style='$style' $id  class='$class' name='$name' value='$value' 	title='$title' $libre >";
        return $res;
    }	
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
                    "height"
                    "display"
                ),
                "placeholder"=>'',
                "libre"=>'',


            )
        */
        #asigna el valor directamente desde el post
        
        if(empty($propiedades['value']) and !empty($propiedades['name'])and!empty($_POST[$propiedades['name']])){$propiedades['value']=$_POST[$propiedades['name']];}
        if(!empty($propiedades['readonly']) and $propiedades['readonly']=true )$propiedades['readonly']=" readonly='readonly'";else{$propiedades['readonly']='';}
        if(!empty($propiedades['disabled']) and $propiedades['disabled']=true)$propiedades['disabled']=" disabled='disabled'";else{$propiedades['disabled']='';}
        if(!empty($propiedades['style']) and gettype($propiedades['style'])=='array'){
            #### conversor de array con keys 
            #printw array_keys($propiedades['style']);
            #print_r(array_keys($propiedades['style']));
            $keys=array_keys($propiedades['style']);
            #echo count(array_keys($propiedades['style']));
            $style='';
            for ($i=0; $i <count($keys) ; $i++) { 
                $style.= $keys[$i].': '.$propiedades['style'][$keys[$i]].'; ';
                #echo $keys[$i];
            }
            $propiedades['style']= $style;
        }
        
        switch ($propiedades['objeto']) {
            case 'input':                
                $res="<input type='$propiedades[type]' style='$propiedades[style]' $propiedades[id]  class='$propiedades[class]' name='$propiedades[name]' value='$propiedades[value]' 	title='$propiedades[title]' $propiedades[disabled] $propiedades[readonly] $propiedades[libre] >";
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
                'Conte_princiapal'=>'Menu_central',
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
    
        echo"<div id='' class='".$class['Conte_princiapal']."'>";
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
                'Conte_princiapal'=>'Menu_central',
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

            );
        */ 
        $conta=count($elemento_menu);
        if(empty($otros_arrays['img_activa']))          {$otros_arrays['img_activa']='true';}
        if(empty($otros_arrays['memoria']))             {$otros_arrays['memoria']=array('Activa'=>'true','type'=>'hidden');} //ajuste de memoria defaul        
        if(empty($class['Conte_princiapal']))   {$class['Conte_princiapal']='Menu_central';}
        if(empty($class['marco']))              {$class['marco']='img_Cuadrado_auto';}
        if(empty($class['Div_Opcion']))         {$class['Div_Opcion']='Conte_Cuadrado_auto';}
        if(empty($class['img']))                {$class['img']='img_Cuadrado_auto';}

        echo"<div id='' class='".$class['Conte_princiapal']."'>";    
                    
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
                        $src=$otros_arrays['img_defaul'];//='img\defaul.jpg';
                        if(!empty($otros_arrays['img'][$x])){$src=$otros_arrays['img'][$x];}
                        if(!empty($otros_arrays['id'])){$id='id="'.$otros_arrays['id']."'";}else{$id='';}
                        if($otros_arrays['img_activa']=='true'){
                            echo"<button type='submit' class='".$class['img']."' name='$name_menu' value='$elemento_menu[$x]' $id>";
                                //echo"<img src='$src' class='".$class['img']."' onclick='javascript:document.form.submit();'>";
                                echo"<img src='$src' style='width: 100%;height: 100%;'>";
                            echo"</button>";
                        }
                        if(!empty($otros_arrays['icons'])){
                            $icons=$otros_arrays['icons'];
                            echo"<button type='submit' name='$name_menu' class='marco $class[marco]' value='$elemento_menu[$x]'>";
                            //echo"<button type='submit' class='".$class['img']."' name='$name_menu' value='$elemento_menu[$x]' $id>";
                                if($x<count($icons))echo"<i class='icon $icons[$x]' style=''></i>";
                            echo"</button>";
                        }                        
                        echo"<input type='submit' name='$name_menu' value='$elemento_menu[$x]' class='boton ".$class_boton."' $id>";
                    echo"</div>";
                }
            }     
            #echo"</div>";
        echo"</div>";
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
        echo"<div id='' class='".$class['Conte_princiapal']."'>";    
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
    public function menu_movil($elemento_menu,$class_menu){
        //$menu_lateral = new libre_v5();   
        //$elemento_menu=array('boton1');
        //$class_menu="Menu_movil_lateral";
        //echo $menu_lateral->menu_movil($elemento_menu,$class_menu);
        ob_start();
            echo"<div id='menu_movil' class='menu_movil'>";
                echo"<div class='contenido_menu_movil'>";
                
                    echo"<div id='boton_menu_movil' class='boton_menu_movil'>";
                        echo"<div class='barras'></div>";
                        echo"<div class='barras'></div>";
                        echo"<div class='barras'></div>";
                    echo"</div>";
                    $name_menu="menu_movil";
                    $class_menu_botones='botones_menu_movil';
                    $this::menu($name_menu,$elemento_menu,$class_menu_botones);
                    
                echo"</div>";

            echo"</div>";   
        $res = ob_get_contents();
        ob_end_clean();
        return $res;
    }
    public function despieges($despieges){
        /*
            $despieges=array(
                "name"=>'',
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
        if(!empty($despieges['style']))$style="style='".$despieges['style']."'";else $style='';
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
                    'Conte_princiapal'=>'',
                    'Div_Opcion'=>'',
                    'Boton'=>'',
                    'img'=>''
                );
            */
            #lista 
            $name_menu='Carpeta';
            $elemento_menu=$array['Archivos']['Carpetas'];
            $class=array(
                'Conte_princiapal'=>'',
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
                'Conte_princiapal'=>'',
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
}
class Explorador{
    public $URL_Actual;
    public $URL_NEW_HOME;
    public $URL_HOME;
    private $CARPETA_OPEN;
    private $DATOS_EN_LA_CARPETA;
    public function __construct($phpv,$conexion,$array){	
        $this->libre_v1	=new libre_v1();	
        $this->libre_v2	=new libre_v2($phpv,$conexion);	
        $this->phpv=$phpv;	
        $this->conexion=$conexion;	
        $this->URL_HOME=$_SERVER["DOCUMENT_ROOT"];	
        if(empty($this->URL_Actual)){
            $this->URL_Actual=$this->URL_HOME;
        }
    }   
    function OPEN_FOLDER(){
        $this->CARPETA_OPEN = opendir($this->URL_Actual); #Abre la ruta solicitada
    }
    function GET_FILES_FOLDER(){
        $THIS->DATOS_EN_LA_CARPETA[$this->URL_Actual]=array(
            "CARPETAS"=>array(),
            "ARCHIVOS"=>array()
        );
        $folder=array();
        $temp_archivos=array();
        while ($archivo = readdir($this->CARPETA_OPEN)){#extrae los archivo
            #echo$archivo;
            #echo"<br>";
            if (is_dir($archivo)){#CARPETAS
                $this->DATOS_EN_LA_CARPETA[$this->URL_Actual]["CARPETAS"][]=$archivo;
            }else{#ARCHIVOS
                $this->DATOS_EN_LA_CARPETA[$this->URL_Actual]["ARCHIVOS"][]=$archivo;

            }
        }
    }
    function VIEW_FILES_FOLDER($carpeta){
        if(empty($carpeta))$carpeta=$this->URL_Actual;
        for ($i=0; $i <count($this->DATOS_EN_LA_CARPETA[$carpeta]["CARPETAS"]) ; $i++) { 
            echo$this->DATOS_EN_LA_CARPETA[$carpeta]["CARPETAS"][$i];
            echo"<br>";
        }
        for ($i=0; $i <count($this->DATOS_EN_LA_CARPETA[$carpeta]["ARCHIVOS"]) ; $i++) { 
            echo $this->DATOS_EN_LA_CARPETA[$carpeta]["ARCHIVOS"][$i];
            echo"<br>";
        }
    }
    function SCANER(){
        
    }
}
?>
