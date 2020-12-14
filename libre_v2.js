
function consulta_v2(destino,send,conso,conte_res,tipo_conso,tipo_res,echo_conso,echo_res,Callback,opcion,elemento,carga,diagnostico,ajustes){	//sistema para cominicar con cualquier terminal 
	
	if(!conso)		{console.log("Sin Consola");return;}
	if(tipo_conso=="inn"){
		if(!destino)	{console.log("Sin Destino");		return;}
		if(!send)		{console.log("Sin Send");			return;}
		if(!conte_res)	{console.log("Sin Destino");		return;}
	}
	if(tipo_conso=="value"){
		if(!destino)	{console.log("Sin Destino");		return;}
		if(!send)		{console.log("Sin Send");		return;}
		if(!conte_res)	{console.log("Sin Destino");		return;}
	}
	if(diagnostico!=''){
		console.log("..::Diagnostico Ajax::..");
		console.log("Destino				: "+destino);
		console.log("Datos Envio			: "+send);
		console.log("Consola				: "+conso);
		console.log("Tipo					: "+tipo_conso);
		console.log("Visualisar				: "+echo_conso);
		console.log("Contenedor Respuesta	: "+conte_res);
		console.log("Tipo					: "+tipo_res);
		console.log("Visualisar				: "+echo_res);
		console.log("Opcion					: "+opcion);
		console.log("Elemento				: "+elemento);
		console.log("Carga					: "+carga);
		console.log("SubRutina				: "+Callback);
		
	}
	
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
			if((ajax.readyState==2)&& (ajax.status == 200)){
				if(tipo_conso=="inn"){
					conso.innerHTML="<img src='../img/carga.gif'>";
				}
			}			
			if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
				conso.innerHTML="";
				var respuesta = document.createTextNode(ajax.responseText);
				var contesta=this.responseText;
				if(conso){//verifica si definio y existe la consola
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
		if(send!="NULL")ajax.send("win_carga="+destino+"&js=1"+send);
		if(send=="NULL")ajax.send("win_carga="+destino+"&js=1");
  }	
	
}
function consulta_v3(destino,send,conso,conte_res,tipo_conso,tipo_res,echo_conso,echo_res,Callback,opcion,elemento,carga,diagnostico,ajustes){	//sistema para cominicar con cualquier terminal 
	
	if(!conso)		{console.log("Sin Consola");return;}
	if(tipo_conso=="inn"){
		if(!destino)	{console.log("Sin Destino");		return;}
		if(!send)		{console.log("Sin Send");			return;}
		if(!conte_res)	{console.log("Sin Destino");		return;}
	}
	if(tipo_conso=="value"){
		if(!destino)	{console.log("Sin Destino");		return;}
		if(!send)		{console.log("Sin Send");			return;}
		if(!conte_res)	{console.log("Sin Destino");		return;}
	}
	if(diagnostico!=''){
		console.log("..::Diagnostico Ajax::..");
		console.log("Destino				: "+destino);
		console.log("Datos Envio			: "+send);
		console.log("Consola				: "+conso);
		console.log("Tipo					: "+tipo_conso);
		console.log("Visualisar				: "+echo_conso);
		console.log("Contenedor Respuesta	: "+conte_res);
		console.log("Tipo					: "+tipo_res);
		console.log("Visualisar				: "+echo_res);
		console.log("Opcion					: "+opcion);
		console.log("Elemento				: "+elemento);
		console.log("Carga					: "+carga);
		console.log("SubRutina				: "+Callback);
		
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
				if(conso){//verifica si definio y existe la consola
					if(tipo_conso=="inn"){ //si la consola es un Div 
						console.log(typeof(contesta));
						console.log(contesta);
						//if()
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
		ajax.open("POST","../Cliente_de_legado_Ares/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga="+destino+"&js=1"+send);
  }	
	
}
function windows(destino,respuesta,opcion,consola,res,elemento,carga_aux){
	if(!opcion){opcion="defaul";}
	if(destino=="genera_reportes"){
		
		if(opcion=="defaul"){			
			if(respuesta=="0"){
				
			}
			if(respuesta=="1"){
				
			}
			console.log(respuesta);
		}
		
	}
	if(destino=="Registra_arrastre"){
		if(opcion=="defaul"){			
			send="&chofer="+chofer.value;
			consulta_v2('gene_list_arras',send,divArrastrar,divArrastrar,"inn","inn",'no','echo_res','','','','','','');
			calcula_update();
			resConsola.innerHTML="Cambio Guardado Automaticamente <br> Cuenta Arrastrada Agregada";
			Consola.className="Consola";	
			if(respuesta=="0"){//Cuenta disponible para guardar
				
			}
			if(respuesta=="1"){//el numero de cuenta ya existe 
				
			}
		}
		
	}
	if(destino=="Elimina_arrastre"){
		if(opcion=="defaul"){			
			if(respuesta=="0"){//Cuenta disponible para guardar 
				console.log(respuesta);
			}
			if(respuesta=="1"){//el numero de cuenta ya existe 
				send="&chofer="+chofer.value;
				consulta_v2('gene_list_arras',send,divArrastrar,divArrastrar,"inn","inn",'no','echo_res','','','','','','');
				resConsola.innerHTML="Cambio Guardado Automaticamente <br> Cuenta Arrastrada Eliminada";
				Consola.className="Consola";	
			}
		}
		
	}
	
}
function crearAjax			(){
   var objetoAjax=false;
   if(navigator.appName=="Microsoft Internet Explorer")
     objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
   else
     objetoAjax = new XMLHttpRequest();
   return(objetoAjax);
}
function menu				(){
	var sub=document.getElementById("submenu");
	if(sub.className=='submenu')		{sub.className="submenuhidden";}else
	if(sub.className=='submenuhidden')	{sub.className="submenu";}
}
function automenu			(elemento){
	res=true;
	if(document.getElementById("noselet")){//elementos normales
		deselect	=document.getElementById("noselect");
		
	}
	else{
		console.log("automenu no encontro a noselect");
		res=false
	}
	if(document.getElementById("selet")){//mentos selecionados 
		select	=document.getElementById("selet");
	}
	else{
		console.log("automenu no encontro a select");
		res=false
	}
	if(res==true){
		select.id="noselet";
		elemento.id="selet";
		
	}
}
function cambia_co_centro	(button){
	var ajax=crearAjax();
	var carga=button.value;
	if(document.getElementById( "id_I"))
	{id_I.id="idI";}
	button.id="id_I";
	
	if(ajax){
		ajax.onreadystatechange = function(){
		  var divres=document.getElementById("style_co_centro");
		  if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			divres.innerHTML = this.responseText;
			
		  }else{
			divres.innerHTML="<img style='background: #ffffff;box-shadow: inset 0px 0px 5px black;position: absolute;left: 50%;top: 50%;'src='../img/carga.gif'>";
		  }
		}
		ajax.open("POST","windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga="+carga+"&js=1");
  }
}
function Maysall(elemento)			{
	elemento.value=elemento.value.slice(0).toUpperCase();//+ elemento.value.slice(1);
}
function MaysPrimera(string)		{
  return string.charAt(0).toUpperCase() + string.slice(1);
}
function ElemMaysPrim(elemento)		{
	elemento.value=elemento.value.charAt(0).toUpperCase()+ elemento.value.slice(1);
	
}
function mueveReloj()				{ 
	
	var fecha	=document.getElementById("fecha");	
	var idia	=document.getElementById("idia");	
	var imes	=document.getElementById("imes");	
	var iano	=document.getElementById("iano");
	
	var reloj	=document.getElementById("reloj");	
	var ihora	=document.getElementById("ihora");	
	var imin	=document.getElementById("iminuto");	
	
	
   	var momentoActual = new Date();
   	var hora 	=('0' + momentoActual.getHours()).slice(-2);
   	var minuto 	=('0' + momentoActual.getMinutes()).slice(-2); 
   	var segundo =('0' + momentoActual.getSeconds()).slice(-2);
	
   	var dia = momentoActual.getDate(); 
   	var mes = ('0' + (momentoActual.getMonth()+1)).slice(-2); 
   	var ano = momentoActual.getFullYear(); 


   	FechaImprimible = dia + " / " + mes + " / " + ano; 
   	horaImprimible = hora + " : " + minuto + " : " + segundo; 
	
	fecha.value = FechaImprimible; 
	idia.value=dia;
	imes.value=mes;
	iano.value=ano;
	ihora.value=hora;
	imin.value=minuto;
	reloj.value = horaImprimible; 

   	setTimeout("mueveReloj()",1000); 
} 
function login()					{
	var send;
		send=
			"&usuario="+usuario.value
			+"&pass="+pass.value
			;
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
			res_log.value="...";
		  if((ajax.readyState==4)&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			var res=this.responseText;
			if(res=="1"){res_log.value=""; conectar();		}
			if(res=="2"){res_log.value="El Usuario No Existe";	user.value ="";}
			if(res=="3"){res_log.value="Contraseña Incorrecta";	user.value ="";}
		  }
		}
		ajax.open("POST","windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga=login&js=1"+send);
  }	
	
}
function conectar()					{
	var send;
		send=
			"&usuario="+usuario.value
			+"&pass="+pass.value
			;
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
		  if((ajax.readyState==4)&& (ajax.status == 200)){
			var res=this.responseText
			user	.value = this.responseText;	
			exi		.style.display='block';			
			usuario	.style.display='none';
			pass	.style.display='none';
			logi	.style.display='none';
			lateral	.style.display='block';
			submenu.className="submenuhidden";
			style_co_centro	.style.display='block';
		  }
		}
		ajax.open("POST","windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga=conectar&js=1"+send);
  }	
	
}
function desconectar()				{
	console.log("Seccion Cerrada");
	usuario.value="";
	visual_tag.innerHTML="";
	tag.value='';
	div_centro.style.display='none';
	sub_menu.style.display='none';
	envia_formulario();
}
function consulta(destino,send,conso,res,tipo_conso,tipo_res,Callback,opcion,elemento,carga){	//sistema para cominicar con cualquier terminal 
	if(tipo_conso)
	if(!conso)		{console.log("Sin Consola");return;}
	if(tipo_conso=="inn"){
		if(!destino)	{conso.innerHTML="Sin Destino";		return;}
		if(!send)		{conso.innerHTML="Sin Send";		return;}
		if(!res)		{conso.innerHTML="Sin Destino";		return;}
	}
	if(tipo_conso=="value"){
		if(!destino)	{conso.value="Sin Destino";		return;}
		if(!send)		{conso.value="Sin Send";		return;}
		if(!res)		{conso.value="Sin Destino";		return;}
	}
	
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
		  /*if((ajax.readyState==3)&& (ajax.status == 200) &&(cargando!="")){
			  if(tipo_conso=="inn"){
				  conso.innerHTML="<img src='../img/carga.gif'>";
			  }
		  }*/
		  if((ajax.readyState==4)&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			var contesta=this.responseText;
			if(tipo_conso=="inn"){
				if((contesta!="0")&&(contesta!="1")){res.innerHTML=contesta; }
				if(Callback)Callback(destino,contesta,opcion,conso,res,elemento,carga);
			}	
			if(tipo_conso=="value"){
				if((contesta!="0")&&(contesta!="1")){res.value=contesta;}
				if(Callback)Callback(destino,contesta,opcion,conso,res,elemento,carga);
			}
		  }
		}
		ajax.open("POST","windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga="+destino+"&js=1"+send);
  }	
	
}
function comentariosA		(input){
	var consola	=document.getElementById("Consola");
	var res		=document.getElementById("resConsola");
	var centro	=document.getElementById("style_co_centro");
	var	name_c	="";
	var	name1=0;
	res.innerHTML ="Comentario ";
	for(x=1;x<=9; x++){
		for(y=1; y<=20; y++){
			name1=x+"TEXT"+y;
			if(x==9){
				
			}
			if(name1==input.id){
				name_c=x+"TEXT_C"+y;
				if(x==9){
					name_c="4TEXT_VIA_C"+y;	
				}
			}
		}
	}
	var come=document.getElementById(name_c);
	res.innerHTML +="<br><TEXTAREA id='"+name_c+"' onkeyup='editText(this);' style='box-shadow: 1px 1px 1px #1387ff;'>"+come.value+"</TEXTAREA>";
	consola.className="Consola";	
}
function ventanas			(elemento){
	//var consola	=document.getElementById();
	if(elemento.className==elemento.id){elemento.className='min';}else
	if(elemento.className=='min'){elemento.className=elemento.id;}
	
}
function verifica(elemento,tipo,actua,difeteneA,difetene_rango1,difetene_rango2){
	var res=true;
	if(tipo=="value"){
		if(elemento.value==difeteneA){res=false;}/*
		if((difetene_rango1!='')&&(difetene_rango2!='')){
			console.log(elemento.value);
			console.log(difetene_rango1);
			console.log(difetene_rango2);
		//	if((elemento.value>=difetene_rango1)&&(elemento.value<=difetene_rango2)){console.log("ok");}else{res=false;console.log("2"+res);}
		}*/
		if(res==true){
			if(actua=="input"){elemento.style.boxShadow="";}
			if(actua=="back"){elemento.style.background="";elemento.style.color="";}
			if(actua=="box"){elemento.style.boxShadow="";}
		}
		if(res==false){
			if(actua=="input"){elemento.style.boxShadow="inset red 0px 0px 5px 3px";}
			if(actua=="back"){elemento.style.background="pink";elemento.style.color="black";}
			if(actua=="box"){elemento.style.boxShadow="inset red 0px 0px 5px 3px";}
		}
	}
	return res;
	
}
function editText			(input){
	if(document.getElementById(input.id)){
		var text=document.getElementById(input.id);
		text.value=input.value;
	}else{
		console.log("Elemento no encontrado");
	}
}
function calcula_update		(){
	var x,y;
	//saca la suma de todas las columnas de la tabla general 
	for(x=1;x<=9; x++){
		var total=0,name1=0,input,canti=0,t_name="TOTAL"+x;		
		if(document.getElementById(t_name)){
			var totalx=document.getElementById(t_name);
			for(y=1; y<=20; y++){
				name1=x+"TEXT"+y;			
				input=document.getElementById(name1);
				canti=parseFloat(input.value);
				if(canti>=0)total=total+canti;
			}
			totalx.value=total.toFixed(2);
			total=0;
		}	
	}
	for(y=1; y<=1; y++){name1="ac"+y;
		canti=0;
		if(document.getElementById(name1)){
			input=document.getElementById(name1);
			if(input.value==''){}else{canti=parseFloat(input.value);}
			if(input.value==''){}else{total=total+canti;}
		}else{
			//console.log('Elemento no encontrado');
			return false;
		}
	}	
	document.getElementById("Totalac").value=total.toFixed(2);
	total=0;
	for(y=1; y<=5; y++){name1="ab"+y;			
		canti=0;
		input=document.getElementById(name1);
		if(input.value==''){}else{canti=parseFloat(input.value);}
		if(input.value==''){}else{total=total+canti;}
	}	
	document.getElementById("Totalab").value=total.toFixed(2);
	calculadora();
}
function calculadora		(){	
	/*
	+"&D_i="+D_i.value
	+"&M_i="+M_i.value
	+"&A_i="+A_i.value
	+"&D_f="+D_f.value
	+"&M_f="+M_f.value
	+"&A_f="+A_f.value
	*/
	//if('2020_06_29')

g_t			=	parseFloat(TOTAL4.value)+parseFloat(TOTAL5.value)+parseFloat(TOTAL6.value)+parseFloat(TOTAL7.value)+parseFloat(TOTAL8.value);	//casetas+facturas+ryr+guias+maniobras
comicion	=	parseFloat(TOTAL1.value)*0.15;   										//comicion pre-definida (para chofer)
if(comi.value!='')	{comicion=TOTAL1.value*(comi.value/100);} 							//comicion variada	(para chofer)
rete		=((comicion*7.5)/100);
viaticos	=TOTAL2.value;																//Isr
t_g			=g_t;																		//gatos_total+comision
dif1		=TOTAL2.value-(t_g+rete);	
dif2		=parseFloat(TOTAL2.value)-g_t;												//viaticos-gatos_total
var chofer_neto	=comicion-rete;
comision	=parseFloat(Flete_R.value)*0.0928;											//Flete_Real * 0.0928	
t_d_g		=parseFloat(TOTAL3.value)+t_g+chofer_neto+parseFloat(TOTAL9.value);			//diesel+total_gatos+comision
neto		=parseFloat(Flete_R.value)-t_d_g;
re			=parseFloat(Flete_R.value)*0.01;
re			=neto/re;

G_T.value			= g_t.toFixed(2);
G_T2.value			= g_t.toFixed(2);
CHOFER.value		= comicion.toFixed(2);
ISR.value			= rete.toFixed(2);
VIATICOS2.value		= viaticos;
VIATICOS.value		= viaticos;
DIF_TV.value		= dif1.toFixed(2);
DIF_TV2.value		= dif1.toFixed(2);
DIF_VIA_GSC.value	= dif2.toFixed(2);
flete_r2.value		= Flete_R.value;
T_G_F.value			= t_d_g.toFixed(2);
NETO_CARRO.value	= neto.toFixed(2);
RENDIMIENTO.value	= re.toFixed(2);


Totalac2.value=Totalac.value;
Totalab2.value=Totalab.value;
var total=dif1+parseFloat(Totalac.value)+parseFloat(Totalab.value);
Total_Total.value=total.toFixed(2);

	
}
function menu1				(elemento){
	menu1_sel.value=elemento.name;
	if(elemento.name=="gene_actual")	{
		gene_actual.style.display="block";
		gene_combustible.style.display="none";
		gene_arrastre.style.display="none";
		gene_list_arras.style.display="none";
		
	}
	if(elemento.name=="gene_combustible")	{
		gene_actual.style.display="none";
		gene_combustible.style.display="block";
		gene_arrastre.style.display="none";
		gene_list_arras.style.display="none";
		
	}
	if(elemento.name=="gene_arrastre")		{
		gene_actual.style.display="none";
		gene_combustible.style.display="none";
		gene_arrastre.style.display="block";
		gene_list_arras.style.display="block";
		
	}
}
function elimi_arra(elemento){
	send=
		"&ID_G_arrastra="+elemento.value+
		"&ejecuta=si"+
		"&ID_G="+Carta1.value;
	consulta_v2('Elimina_arrastre',send,resConsola,ac1,"inn","value",'no','echo_res',windows,'','','','','');
	
	if(elemento.id=="ID_ac1"){elemento.value="";ac1.value="";}
	if(elemento.id=="ID_ac2"){elemento.value="";ac2.value="";}
	if(elemento.id=="ID_ac3"){elemento.value="";ac3.value="";}
	if(elemento.id=="ID_ac4"){elemento.value="";ac4.value="";}
	if(elemento.id=="ID_ac5"){elemento.value="";ac5.value="";}
}
function add_arrastra		(elemento){
	var ajax=crearAjax();
	var name="ID_ac";
	var res;
	var x;
	res=document.getElementById(name+1);
	if(res.value==""){
		res.value=elemento.value;
		send=
			"&ID_G_arrastra="+elemento.value+
			"&ejecuta=si"+
			"&ID_G="+Carta1.value;
		consulta_v2('Registra_arrastre',send,resConsola,ac1,"inn","value",'no','echo_res',windows,'','','','','');
	}
	
	
}
/*function libre_v2_reportes(){
	//verifica(D,"value","input",'','1','31');
	peticion=true;
	if ((D.value>=1)&&(D.value<=31))			{D.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;D.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((M.value>=1)&&(M.value<=12))			{M.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;M.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((A.value>=2015)&&(A.value<=2030))		{A.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;A.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((D_r.value>=1)&&(D_r.value<=31))		{D_r.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;D_r.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((M_r.value>=1)&&(M_r.value<=12))		{M_r.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;M_r.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((A_r.value>=2015)&&(A_r.value<=2030))	{A_r.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;A_r.style.boxShadow="inset red 0px 0px 5px 3px";}
	
	if(peticion==true){
		for(x=0; x<formato.length; x++){			
			if(formato[x].checked){formato_select=formato[x].value;}
		}
		send="&D="+D.value
			+"&M="+M.value
			+"&A="+A.value
			+"&D_r="+D_r.value
			+"&M_r="+M_r.value
			+"&chofer="+chofer.value
			+"&placas="+placas.value
			+"&cliente="+cliente.value
			
			+"&formato="+formato_select
			+"&sueldo="+sueldos.checked
			+"&isr="+isr.checked
			+"&abonos="+abonos.checked
			+"&acumulados="+acumulados.checked
			+"&casetas="+casetas.checked
			+"&via_pass="+via_pass.checked
			+"&diesel="+diesel.checked
			+"&facturas="+facturas.checked
			+"&flete_r="+Flete_R.checked
			+"&fletes="+fletes.checked
			+"&guias="+guias.checked
			+"&ryr="+ryr.checked
			+"&maniobras="+maniobras.checked
			+"&viaticos="+viatico.checked
			
			+"&A_r="+A_r.value;
		//consulta(destino,send,conso,res,tipo_conso,tipo_res,echo_conso,echo_res,Callback,opcion,elemento,carga)
		//consulta_v2('genera_reportes',send,resConsola,ac1,"inn","value",'echo_conso','echo_res',windows);
		consulta_v2('genera_reportes',send,consola_reportes,res_reportes,"inn","inn",'no','echo_res');
	}
	
}
*/
function reportes(){
	
	var peticion=true;
	var c=document.getElementById("chofer");
	var p=document.getElementById("placas");
	var cl=document.getElementById("cliente");
	var d=document.getElementById("D");
	var m=document.getElementById("M");
	var a=document.getElementById("A");
	var d_r=document.getElementById("D_r");
	var m_r=document.getElementById("M_r");
	var a_r=document.getElementById("A_r");
	/*var deta=document.getElementById("detallado").checked;
	var list=document.getElementById("lista").checked;*/
	var C=c.value;
	var P=p.value;
	var CL=cl.value;
	var D=d.value;
	var M=m.value;
	var A=a.value;
	var D_r=d_r.value;
	var M_r=m_r.value;
	var A_r=a_r.value;
	//if (deta){deta=1;}else{deta=0;}
	//if (list){list=1;}else{list=0;}
	if ((D>=1)&&(D<=31))			{d.className="Medio";}else{peticion=false;d.className="error";}
	if ((M>=1)&&(M<=12))			{m.className="Medio";}else{peticion=false;m.className="error";}
	if ((A>=2015)&&(A<=2030))		{a.className="Medio";}else{peticion=false;a.className="error";}
	if ((D_r>=1)&&(D_r<=31))		{d_r.className="Medio";}else{peticion=false;d_r.className="error";}
	if ((M_r>=1)&&(M_r<=12))		{m_r.className="Medio";}else{peticion=false;m_r.className="error";}
	if ((A_r>=2015)&&(A_r<=2030))	{a_r.className="Medio";}else{peticion=false;a_r.className="error";}

	var ajax=crearAjax();
	if((ajax)&&(peticion==true)){
		send="&C="+C+"&P="+P+"&CL="+CL+"&D="+D+"&M="+M+"&A="+A+"&D_r="+D_r+"&M_r="+M_r+"&A_r="+A_r;
		consulta_v3("genera_reportes",send,reportes,reportes,"inn","inn",'echo_conso','echo_res',windows,'','','','','');
		/*
		ajax.onreadystatechange = function(){
			var divres=document.getElementById("reportes");
			if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
				divres.innerHTML = this.responseText;
			}else{
				divres.innerHTML="Cargando ...";
			}
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//ajax.send("win_carga=reportes&js=1&C="+C+"&P="+P+"&CL="+CL+"&D="+D+"&M="+M+"&A="+A+"&D_r="+D_r+"&M_r="+M_r+"&A_r="+A_r+"&Deta="+deta+"&List="+list,true);
		ajax.send("win_carga=reportes&js=1&C="+C+"&P="+P+"&CL="+CL+"&D="+D+"&M="+M+"&A="+A+"&D_r="+D_r+"&M_r="+M_r+"&A_r="+A_r,true);
		*/
	}
}
function Reporte2(){// en actualizacion remplazo de "libre_v2_reportes()" 
	peticion=true;
	if ((D_i.value>=1)&&(D_i.value<=31))			{D_i.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;D_i.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((M_i.value>=1)&&(M_i.value<=12))			{M_i.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;M_i.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((A_i.value>=2015)&&(A_i.value<=2030))		{A_i.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;A_i.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((D_f.value>=1)&&(D_f.value<=31))			{D_f.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;D_f.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((M_f.value>=1)&&(M_f.value<=12))			{M_f.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;M_f.style.boxShadow="inset red 0px 0px 5px 3px";}
	if ((A_f.value>=2015)&&(A_f.value<=2030))		{A_f.style.boxShadow="inset #0089ff  0px 0px 5px 3px";}else{peticion=false;A_f.style.boxShadow="inset red 0px 0px 5px 3px";}
	send=	"&D_i="+D_i.value
			+"&M_i="+M_i.value
			+"&A_i="+A_i.value
			+"&D_f="+D_f.value
			+"&M_f="+M_f.value
			+"&chofer="+chofer.value
			+"&placas="+placas.value
			+"&cliente="+cliente.value
			+"&A_f="+A_f.value;
			/*
			//+"&formato="+formato_select
			+"&sueldo="+sueldos.checked
			+"&isr="+isr.checked
			+"&abonos="+abonos.checked
			+"&acumulados="+acumulados.checked
			+"&casetas="+casetas.checked
			+"&via_pass="+via_pass.checked
			+"&diesel="+diesel.checked
			+"&facturas="+facturas.checked
			//+"&flete_r="+Flete_R.checked
			+"&fletes="+fletes.checked
			+"&guias="+guias.checked
			+"&ryr="+ryr.checked
			+"&maniobras="+maniobras.checked
			+"&viaticos="+viatico.checked
			*/
	consulta_v3("genera_reportes",send,Datos_conso,Datos_res,"inn","inn",'echo_conso','echo_res',windows,'','','','','');
}
function calcu_combustible(){
	crome_t.value=crome_f.value-crome_i.value;
	
}
function cambia_co_centro2(elemento){
	destino=elemento.value;
	//menu();
	sub_menu.style.display="none";
	consulta_v2(destino,send,div_centro,div_centro,"inn","inn",'echo_conso','echo_res','','','','','','');
}
function diagnostico2(elemento){
  if(elemento.value=="Actual"){
	destino="diagnostico1";
	  
  }
  if(elemento.value=="Todos"){	  
	destino="diagnostico0";
  }
	consulta_v3(destino,send,Datos_conso,Datos_res,"inn","inn","echo_conso","echo_res",'','','','','','');
}
function cierra(elemento){
	elemento.style.display="none";
}
function carga_arrastrados(){
	send="&chofer="+CHOFER.value;
	consulta_v2('gene_list_arras',send,divArrastrar,divArrastrar,"inn","inn",'no','echo_res','','','','','','');
}
function load(){	
	//Obtenemos el UserAgent
	var useragent = navigator.userAgent||navigator.vendor||window.opera;
	//Creamos una variable para detectar los móviles
	var ismobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|zh-cn|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(useragent)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(useragent.substr(0,4));
	
	//if(ismobile==true)alert("telefono");
	//if(ismobile==false)alert("No es celular");
	
	if(id_s.value=="Cuentas"){
		if(id_I.value=="Altas"){
			if(sub1=="Operadores"){
				send="&id_I="+id_I.value
					+"&chofer="+chofer.value;
				destino="load_Cuentas";
				consulta_v3(destino,send,Consola,datos_vinculo,"inn","inn","","echo_res",'','','','','','');
			}
		}
		if(id_I.value=="Folder"){
			send=
			 "&D_i="+D_i.value
			+"&M_i="+M_i.value
			+"&A_i="+A_i.value
			+"&D_f="+D_f.value
			+"&M_f="+M_f.value
			+"&A_f="+A_f.value
			+"&chofer_b="+chofer.value
			+"&placas_b="+placas.value
			+"&cliente_b="+cliente.value
			+"&Carta1="+Carta1.value;
				
			destino="Folder";
			//consulta_v3(destino,send,conso,conte_res,tipo_conso,tipo_res,echo_conso,echo_res,Callback,opcion,elemento,carga,diagnostico,ajustes)
			consulta_v3(destino,send,Datos_conso,Datos_res,"inn","inn","echo_conso ","echo_res",'','','','','s','');
		}
		if(id_I.value=="Reporte"){
			//genera_reporte();
			//Reporte2();
			
		}
	}
}

function genera_reporte(){
	send="&actuador=totales"
	+"&D_i="+D_i.value
	+"&M_i="+M_i.value
	+"&A_i="+A_i.value
	+"&D_f="+D_f.value
	+"&M_f="+M_f.value
	+"&A_f="+A_f.value
	+"&chofer="+chofer.value
	+"&placas="+placas.value
	+"&cliente="+cliente.value;
	//destino="descarga_datos_reporte";
	//destino="genera_reportes";
	destino="ares1";
	
	consulta_v3(destino,send,Datos_conso,datos_info,"inn","inn","echo_conso ","echo_res",'','','','','','');
}
function descarga_datos_reporte(elemento){
	send="&actuador=unico"
		+"&ID_G="+elemento.value;
		
	destino="descarga_datos_reporte";
	consulta_v3(destino,send,Datos_conso,datos_info,"inn","inn","echo_conso ","echo_res",'','','','','','');
}

//codigo de uso general
function envia_formulario()	{
	formu1.submit();
}

//compatible para cuentas annie 

function celda_a_editor(elemento){	
	/* envia la informacion del comentario de la celda a el edicio */
	if(document.getElementById('comentario_compartido') && document.getElementById(elemento.title)){
		var come_compartidos=document.getElementById('comentario_compartido')
		come_compartidos.name=elemento.title;
		come_compartidos.value=document.getElementById(elemento.title).value;
	}else{
		console.log('un elemento no fue encontrado');
	}	
}
function Editor_a_celda(input){
	/*cuando el editor detecta cambios en el comentario actualiza el comentario en la celda */
	if(document.getElementById(input.name)){
		var celda_comentario=document.getElementById(input.name);
		celda_comentario.value=input.value;
		/*box-shadow: inset 0px 0px 0px 1px #55bfd0;*/
		var nombre_de_elcomentario=input.name;
		let nombre_columna = nombre_de_elcomentario.substring(0, 5);
		let n_celda = nombre_de_elcomentario.substring(7, 9);
		var name_celda=nombre_columna+n_celda;
		
		if(document.getElementById(name_celda)){ /*busca la celda  */
			celda=document.getElementById(name_celda);
			if(input.value == null || input.value.length > 0){/*revisa que no este vacia la celda */
				celda.style='box-shadow: inset 0px 0px 0px 1px #55bfd0;';
			}else{
				celda.style='';
			}
		}
	}
}
function valida_n(e,elemento,Callback,name_next){
    tecla = (document.all) ? e.keyCode : e.which;
	//console.log(tecla);
	if (tecla==13){
		//console.log("enter");
		if(Callback)Callback();
		if(elemento){elemento.focus();}
		if(name_next){document.getElementById(name_next).focus();}
	}
    if (tecla==8){
        return true;
    }
    patron =/[0-9]/;
	
    tecla_final = String.fromCharCode(tecla);
	res=true;
	actua=patron.test(tecla_final);if(actua==false){res=false;}
	if(tecla_final=="."){res=true;}
    return res;
}
function mueve_diba_text	(e,input){
	tecla = (document.all) ? e.keyCode : e.which;
	var event = window.event ? window.event : e;
	var focus_in=input.id;
	var focus_to;
	var focus_id= String(focus_in);
	var largo=focus_id.length;
	var col=focus_id[0];
	var reg=focus_id[5];
	if (largo==7)var reg=focus_id[5]+focus_id[6];
	
	if(event.keyCode==37){
		col=parseFloat(col)-1;
		focus_to=col+"TEXT"+reg;
		document.getElementById(focus_to).focus();
	}
	if(event.keyCode==38){
		reg=parseFloat(reg)-1;
		focus_to=col+"TEXT"+reg;
		document.getElementById(focus_to).focus();
	}
	if(event.keyCode==39){
		col=parseFloat(col)+1;
		focus_to=col+"TEXT"+reg;
		document.getElementById(focus_to).focus();
	}
	if(event.keyCode==40){
		reg=parseFloat(reg)+1;
		focus_to=col+"TEXT"+reg;
		document.getElementById(focus_to).focus();
	}; 
	
}