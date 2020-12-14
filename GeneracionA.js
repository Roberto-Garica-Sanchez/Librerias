
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

		if(!destino)	  {console.log("Sin Destino");		return;}
		if(!send)		    {console.log("Sin Send");		return;}
    if(!conte_res)	{console.log("Sin Destino");		return;}
    
	}
	if(tipo_conso=="value"){

		if(!destino)	  {console.log("Sin Destino");		return;}
		if(!send)		    {console.log("Sin Send");		return;}
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