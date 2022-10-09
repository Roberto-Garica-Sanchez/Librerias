document.body.onload = function() {
	/*alert('La página terminó de cargar');*/
	DescargaDatabase_ajax();
}

function crearAjax			(){
  var objetoAjax=false;
  if(navigator.appName=="Microsoft Internet Explorer")
    objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
  else
    objetoAjax = new XMLHttpRequest();
  return(objetoAjax);
}
function consulta_v3(destino,send,conso,conte_res,tipo_conso,tipo_res,echo_conso,echo_res,Callback,opcion,elemento,carga,diagnostico,ajustes){	//sistema para cominicar con cualquier terminal 	
	if(!conso){console.log("Sin Consola");return;}
	if(tipo_conso=="inn"){

	if(!destino)	{console.log("Sin Destino");		return;}
	if(!send)		{console.log("Sin Send");		return;}
    if(!conte_res)	{console.log("Sin Destino");		return;}
    
	}
	if(tipo_conso=="value"){

	if(!destino)	{console.log("Sin Destino");		return;}
	if(!send)		{console.log("Sin Send");		return;}
    if(!conte_res)	{console.log("Sin Destino");		return;}
    
	}
	if(diagnostico!=''){

		console.log("..::Diagnostico Ajax::..");
		console.log("Destino				    : "+destino);
		console.log("Datos Envio			  : "+send);
		console.log("Consola				    : "+conso);
		console.log("Tipo					      : "+tipo_conso);
		console.log("Visualisar				  : "+echo_conso);
		console.log("Contenedor Respuesta	: "+conte_res);
		console.log("Tipo					      : "+tipo_res);
		console.log("Visualisar				  : "+echo_res);
		console.log("Opcion					    : "+opcion);
		console.log("Elemento				    : "+elemento);
		console.log("Carga					    : "+carga);
		console.log("SubRutina				  : "+Callback);
		
	}
	
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
			if(((ajax.readyState==1)||(ajax.readyState==2)||(ajax.readyState==3))&& (ajax.status == 200)){//Mientras esta en ejecucion la peticion 
				if(tipo_conso=="inn"){
					conso.innerHTML="<img src='../img/carga.gif'>";
				}
			}
			if((ajax.readyState==3)&& (ajax.status == 200)){
				var respuesta = document.createTextNode(ajax.responseText);
				var contesta=this.responseText;
				if(conte_res){//verifica si definio y existe la conte_res
					if(tipo_res=="inn"){															//si la contenedor es un Div
						if((contesta!="0")&&(contesta!="1")){										//si responde algo que no sea 1 o 0 
							if(echo_res=="echo_res"){conte_res.innerHTML=contesta;}						//imprime la respuesta en el contenedor si lo solicita 
						}				
						if(diagnostico!=''){
							console.log("conte_res Respuesta Ajax: "+contesta);
						}
						//if(Callback)Callback(destino,contesta,opcion,conso,res,elemento,carga);	//si definio una funcion
					}	
					if(tipo_res=="value"){															//si contenedor es un input
						if((contesta!="0")&&(contesta!="1")){										//si responde algo que no sea 1 o 0 
							if(echo_res=="echo_res"){conte_res.value=contesta;}							//imprime la respuesta en el contenedor si lo solicita 
						}
						if(diagnostico!=''){
							console.log("conte_res Respuesta Ajax: "+contesta);
						}
						//if(Callback)Callback(destino,contesta,opcion,conso,res,elemento,carga);	//si definio una funcion
					}
				}
			
			}			
			if((ajax.readyState==4)&& (ajax.status == 200)){
				conso.innerHTML="";
				var respuesta = document.createTextNode(ajax.responseText);
				var contesta=this.responseText;
				/*if(conso){//verifica si definio y existe la consola
					if(tipo_conso=="inn"){ //si la consola es un Div 
					
						if((contesta!="0")&&(contesta!="1")){										//si responde algo que no sea 1 o 0 
							if(echo_conso=="echo_conso"){
								conso.innerHTML+=contesta;
							}					//imprime la respuesta en la consola si lo solicita 
						}		
						if(diagnostico!=''){
							console.log("conso Respuesta Ajax: "+contesta);
						}	
						if(Callback)Callback(destino,contesta,opcion,conso,conte_res,elemento,carga);		//si definio una funcion
					}	
					if(tipo_conso=="value"){														//si la consola es un input 
						conso.innerHTML="";
						if((contesta!="0")&&(contesta!="1")){										//si responde algo que no sea 1 o 0 
							if(echo_conso=="echo_conso"){conso.value=contesta;}						//imprime la respuesta en la consola si lo solicita 
						}	
						if(diagnostico!=''){
							console.log("conso Respuesta Ajax: "+contesta);
						}				
						if(Callback)Callback(destino,contesta,opcion,conso,conte_res,elemento,carga);		//si definio una funcion
					}
				}
				*/
				if(conte_res){//verifica si definio y existe la conte_res
					if(tipo_res=="inn"){															//si la contenedor es un Div
						if((contesta!="0")&&(contesta!="1")){										//si responde algo que no sea 1 o 0 
							if(echo_res=="echo_res"){conte_res.innerHTML=contesta;}						//imprime la respuesta en el contenedor si lo solicita 
						}				
						if(diagnostico!=''){
							console.log("conte_res Respuesta Ajax: "+contesta);
						}
						//if(Callback)Callback(destino,contesta,opcion,conso,res,elemento,carga);	//si definio una funcion
					}	
					if(tipo_res=="value"){															//si contenedor es un input
						if((contesta!="0")&&(contesta!="1")){										//si responde algo que no sea 1 o 0 
							if(echo_res=="echo_res"){conte_res.value=contesta;}							//imprime la respuesta en el contenedor si lo solicita 
						}
						if(diagnostico!=''){
							console.log("conte_res Respuesta Ajax: "+contesta);
						}
						//if(Callback)Callback(destino,contesta,opcion,conso,res,elemento,carga);	//si definio una funcion
					}
				}
			}
		}
		ajax.open("POST","../windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga="+destino+"&js=1"+send);
  }	
	
}

function Consultas_v4_array	(datos_array){
	var ajax=crearAjax();
	/*var carga=button.value;*/
	if(ajax){
		ajax.onreadystatechange = function(){
		  var divres=document.getElementById("style_co_centro");
		  if(((ajax.readyState==3) || (ajax.readyState==4)  )&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			var contesta=this.responseText;
			/*console.log(respuesta);*/
			if ( document.getElementById(datos_array['Contenedores']['Respuesta']['Id'])) {
				/*Inputs */
				if('undefined' != typeof document.getElementById(datos_array['Contenedores']['Respuesta']['Id']).value){
					document.getElementById(datos_array['Contenedores']['Respuesta']['Id']).value=contesta;
					/*console.log( document.getElementById(datos_array['Contenedores']['Respuesta']['Id']).value);*/

				}
				/*DIV */
				if('undefined' != typeof document.getElementById(datos_array['Contenedores']['Respuesta']['Id']).innerHTML){					
					document.getElementById(datos_array['Contenedores']['Respuesta']['Id']).innerHTML=contesta;
					/*console.log( document.getElementById(datos_array['Contenedores']['Respuesta']['Id']).innerHTML);*/
					
				}
				
			}
			//if(Callback)Callback(destino,contesta,opcion,conso,conte_res,elemento,carga);		//si definio una funcion
		  }else{
			/*divres.innerHTML="Cargando ...";*/
			/*datos_array['URL']*/
			/*console.log("Cargando");*/
		  }
		}
		ajax.open("POST","//localhost/"+datos_array['URL'],true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		if(typeof datos_array['Datos_send']!= 'undefined'){
			/*console.log(datos_array['Datos_send'].length);*/
			ajax.send(datos_array['Datos_send']);
			
		}else{
			/*console.log("no existe la variable ");*/
			ajax.send("");

		}
		/*ajax.send("win_carga="+carga+"&js=1");*/
  }
}
function DescargaDatabase_ajax(){
	if ( document.getElementById("Database")) {
		if ( document.getElementById("listas_Database")|| document.getElementById("listas_desplegable_Database")){
			var formato;
			var Contenedor;
			if(document.getElementById("listas_Database"))			  {formato="lista_text"; 		Contenedor=document.getElementById("listas_Database").id;}
			if(document.getElementById("listas_desplegable_Database")){formato="lista_desplegable";	Contenedor=document.getElementById("listas_desplegable_Database").id;}
			/*console.log(formato);*/
			var array_Consultas_v4={
				URL:"Librerias/APP/APP.php",			
				Datos_send:"ProcessMySql=Get_list_Database&formato="+formato,
				Contenedores:{
					Respuesta:{
						Id:Contenedor,
						name:"Menu_Princial",
						tipo:"",
						
					},
					Load:{
						Id:"",
						name:"",
						tipo:"",					
					},
				}

			}
				Consultas_v4_array(array_Consultas_v4);
		}
	}

}
function DescargaTablas_ajax(){	
	if ( document.getElementById("Tablas")) {
		if (document.getElementById("listas_Tablas") || document.getElementById("listas_desplegable_Tablas")){
			var formato;
			var Contenedor;
			if(document.getElementById("listas_Tablas"))			  	{formato="lista_text"; 			Contenedor=document.getElementById("listas_Tablas").id;}
			if(document.getElementById("listas_desplegable_Tablas"))	{formato="lista_desplegable";	Contenedor=document.getElementById("listas_desplegable_Tablas").id;}
			if(document.getElementById("Seletor_database"))				{
				Selector_db=document.getElementById("Seletor_database");
				var selectedOption = Selector_db.options[Selector_db.selectedIndex];
				var array_Consultas_v4={
					URL:"Librerias/APP/APP.php",			
					Datos_send:"ProcessMySql=Get_list_Tablas&Database_select="+selectedOption.text+"&formato="+formato,
					Contenedores:{
						Respuesta:{
							Id:Contenedor,
							name:"Columnas de tabla",
							tipo:"",
							
						},
						Load:{
							Id:"",
							name:"",
							tipo:"",					
						},
					}

				}
				if(Selector_db.text!='Selecione Base de datos'){
					Consultas_v4_array(array_Consultas_v4);

				}

			}else{
				
				console.log('Select tablas No encontrado');
			}
			
		}
	}
}
function DescargaColumnas_ajax(){//#interna	
	if ( document.getElementById("Columnas")) {
		if (document.getElementById("listas_Columnas") || document.getElementById("listas_desplegable_Columnas")){
			var formato;
			var Contenedor;
			if(document.getElementById("listas_Columnas"))			  	{formato="lista_text"; 			Contenedor=document.getElementById("listas_Columnas").id;}
			if(document.getElementById("listas_desplegable_Columnas"))	{formato="lista_desplegable";	Contenedor=document.getElementById("listas_desplegable_Columnas").id;}
			if(document.getElementById("Seletor_database") &&document.getElementById("Selector_Tabla")){
				var Selector_db=document.getElementById("Seletor_database");
				var selectedOption_db = Selector_db.options[Selector_db.selectedIndex];
				var Selector_tb=document.getElementById("Selector_Tabla");
				var selectedOption_tb = Selector_tb.options[Selector_tb.selectedIndex];
				//console.log(selectedOption_db.text);
				//console.log(selectedOption_tb.text);
				/*console.log(Selector_db);*/
				var array_Consultas_v4={
					URL:"Librerias/APP/APP.php",			
					Datos_send:"ProcessMySql=Get_list_Columnas&Database_select="+selectedOption_db.text+"&Tabla_select="+selectedOption_tb.text+"&formato="+formato,
					Contenedores:{
						Respuesta:{
							Id:Contenedor,
							name:"Columnas de Columnas",
							tipo:"",
							
						},
						Load:{
							Id:"",
							name:"",
							tipo:"",					
						},
					}

				}
				if(selectedOption_db.text!="Selecione Base de Datos" && selectedOption_tb.text!="Selecione Tabla"){
					Consultas_v4_array(array_Consultas_v4);
				}

			}else{
				
				console.log('Select No encontrado');
			}
		}
	}

}
function desplegable_text_busqueda(SelectElemento){//#externa
	if ( document.getElementById(SelectElemento.id)) {
		//console.log('entro');
		var Elemento=document.getElementById(SelectElemento.id);
		var NameColumna=SelectElemento.name;
		//console.log(Elemento.getAttribute("Tabla-solicita"));
		//console.log(Elemento.getAttribute("Columna-solicita"));
		//Elemento.setAttribute("Tabla-name", "Valor para ese atributo");
		//console.log(Elemento);
		//console.log(Elemento.getAttribute("Tabla-solicita"));
		//console.log(Elemento.getAttribute("Columna-solicita"));
		//console.log(Elemento.getAttribute("tabla-emisora"));
		//console.log(Elemento.value);
		var Selector_db	=Elemento.getAttribute("Seletor_database");
		var tablaEmi	=Elemento.getAttribute("tabla-emisora");
		var ColumnaEmi	=Elemento.getAttribute("Columna-emisora");
		var tabla		=Elemento.getAttribute("Tabla-solicita");
		var columna		=Elemento.getAttribute("Columna-solicita");
		var ValorBuscar	=Elemento.value;
		//console.log(tablaEmi);
		//console.log("ProcessMySql=desplegable_text_busqueda&Database="+Selector_db+"&ColumnaEmisora="+ColumnaEmi+"&TablaEmisora="+tablaEmi+"&Tabla="+tabla+"&Columna="+columna+"&value="+ValorBuscar);
		var array_Consultas_v4={
			URL:"Librerias/APP/APP.php",			
			Datos_send:"ProcessMySql=desplegable_text_busqueda&Database="+Selector_db+"&ColumnaEmisora="+ColumnaEmi+"&TablaEmisora="+tablaEmi+"&Tabla="+tabla+"&Columna="+columna+"&value="+ValorBuscar,
			Contenedores:{
				Respuesta:{
					Id:"Conte_lista_"+columna,
					name:"Columnas de Columnas",
					tipo:"",
					
				},
				Load:{
					Id:"",
					name:"",
					tipo:"",					
				},
			}

		}
		Consultas_v4_array	(array_Consultas_v4);
	}else{
		console.log('elemento No encontrado');
	}
}
function textoBusqueda(SelectElemento){
	if ( document.getElementById(SelectElemento.id)) {
		var Elemento=document.getElementById(SelectElemento.id);
		var NameColumna=SelectElemento.name;
		//console.log(Elemento.getAttribute("Tabla-solicita"));
		//console.log(Elemento.getAttribute("Columna-solicita"));
		//Elemento.setAttribute("Tabla-name", "Valor para ese atributo");
		//console.log(Elemento);
		//console.log(Elemento.getAttribute("Tabla-solicita"));
		//console.log(Elemento.getAttribute("Columna-solicita"));
		//console.log(Elemento.value);
		
		var tabla		=Elemento.getAttribute("Tabla-solicita");
		var columna		=Elemento.getAttribute("Columna-solicita");
		var Selector_db	=Elemento.getAttribute("Seletor_database");
		var ValorBuscar	=Elemento.value;
		/*console.log("ProcessMySql=textoBusqueda&Database="+Selector_db+"&Tabla="+tabla+"&Columna="+columna+"&value="+ValorBuscar);*/
			
		var array_Consultas_v4={
			URL:"Librerias/APP/APP.php",			
			Datos_send:"ProcessMySql=textoBusqueda&Database="+Selector_db+"&Tabla="+tabla+"&Columna="+columna+"&value="+ValorBuscar,
			Contenedores:{
				Respuesta:{
					Id:"Conte_lista_"+columna,
					name:"Columnas de Columnas",
					tipo:"",
					
				},
				Load:{
					Id:"",
					name:"",
					tipo:"",					
				},
			}

		}
		Consultas_v4_array	(array_Consultas_v4);
	}else{
		console.log('elemento No encontrado');
	}
}
function verificar_formulario(){

}