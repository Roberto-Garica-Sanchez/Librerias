//console.log(focus_a);
var indexado="";
function mueve_diba			(e,input){
	var divres=document.getElementById("Calculos"); 
	var event = window.event ? window.event : e;
	//tecla = (document.all) ? e.keyCode : e.which;
	//console.log(event);
	var focus_in=input.id;
	if(event.keyCode==37){
		focus_a=focus_in-1;	
		document.getElementById(focus_a).focus()
	}
	if(event.keyCode==38){
		focus_a=focus_in-10;	
		document.getElementById(focus_a).focus(); 
	}
	if(event.keyCode==39){
		focus_a=parseFloat(focus_in)+1;
		document.getElementById(focus_a).focus(); 
	}
	if(event.keyCode==40){
		focus_a=parseFloat(focus_in)+10;
		document.getElementById(focus_a).focus(); 
	}
	if(event.keyCode==13){
		focus_a=parseFloat(focus_in)+10;
		document.getElementById(focus_a).focus(); 
	}

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

function calcula_update		(){
	var x,y;
	for(x=1;x<=9; x++){
		var total;
		var	name1=0,input,canti=0,t_name;
		total=0;
		t_name="TOTAL"+x;
		var total_conte=document.getElementById(t_name);
		for(y=1; y<=20; y++){
			name1=x+"TEXT"+y;			
			input=document.getElementById(name1);
			canti=parseFloat(input.value);
			if(canti>=0)total=total+canti;
		}
		total_conte.value=total.toFixed(2);
		total=0;
	}
	for(y=1; y<=5; y++){name1="ac"+y;
		canti=0;
		input=document.getElementById(name1);
		if(input.value==''){}else{canti=parseFloat(input.value);}
		if(input.value==''){}else{total=total+canti;}
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
function windows			(div){
	var name=div.id;
	var actname="act"+name;
	var divname="div"+name;
	var input=document.getElementById(actname); 
	if (input.value=="x"){input.value="-";div.className="min";}else
	if (input.value=="-"){input.value="x";div.className="div"+name;}
}
function ventanas			(elemento){
	//var consola	=document.getElementById();
	if(elemento.className==elemento.id){elemento.className='min';}else
	if(elemento.className=='min'){elemento.className=elemento.id;}
	
}
function ventanas2			(elemento){
	var name1=elemento.id+"_mini";
	var name2=elemento.id;
	
	if(elemento.className==elemento.id)	{elemento.className=name1;}else
	if(elemento.className==name1)		{elemento.className=name2;}
	
}
function crearAjax			(){
   var objetoAjax=false;
   if(navigator.appName=="Microsoft Internet Explorer")
     objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
   else
     objetoAjax = new XMLHttpRequest();
   return(objetoAjax);
}
function cambia_co_centro	(button){
	var ajax=crearAjax();
	var carga=button.value;
	if(ajax){
		ajax.onreadystatechange = function(){
		  var divres=document.getElementById("style_co_centro");
		  if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			divres.innerHTML = this.responseText;
			
		  }else{
			divres.innerHTML="Cargando ...";
		  }
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga="+carga+"&js=1");
  }
}
/*function calculadora		(){
console.log("libre_v1 -> calculadora");
	var COMI		=parseFloat(document.getElementById("comi").value);
	var FLETES		=parseFloat(document.getElementById("TOTAL1").value);
	var VIATICOS	=parseFloat(document.getElementById("TOTAL2").value);
	var DIESEL		=parseFloat(document.getElementById("TOTAL3").value);
	var CASETAS		=parseFloat(document.getElementById("TOTAL4").value);
	var FACTURAS	=parseFloat(document.getElementById("TOTAL5").value);
	var RYR			=parseFloat(document.getElementById("TOTAL6").value);
	var GUIAS		=parseFloat(document.getElementById("TOTAL7").value);
	var MANIOBRAS	=parseFloat(document.getElementById("TOTAL8").value);
	var VIA_PASS	=parseFloat(document.getElementById("TOTAL9").value);
	var ARRASTRADO	=parseFloat(document.getElementById("Totalac").value);
	var ABONOS		=parseFloat(document.getElementById("Totalab").value);
	var Flete_R		=parseFloat(document.getElementById("flete_r").value);
	var KM_I		=parseFloat(document.getElementById("km_i").value);
	var KM_F		=parseFloat(document.getElementById("km_f").value);
	var PRECIO_D	=parseFloat(document.getElementById("presio_d").value);
	var G_T			=CASETAS+FACTURAS+RYR+GUIAS+MANIOBRAS;	
	if(COMI==''){var CHOFER		=FLETES*0.15;}else{ var CHOFER		=FLETES*(COMI/100);}
	var T_G			=G_T;
	var COMICIONES	=Flete_R*0.0928;
	var DIF_VIA_GSC	=VIATICOS-G_T;
	var ISR			=((COMICIONES*7.5)/100);
	var chofer_neto=COMICIONES-ISR;
	var T_G_F		=T_G+DIESEL+chofer_neto+VIA_PASS;
	var RENDIMIENTO	=NETO_CARRO/(Flete_R*0.01);
	var DIF_TV		=VIATICOS+ISR-T_G;
	var TOTALTOTAL	=ARRASTRADO+ABONOS+DIF_TV;
	var Total_km	=KM_F-KM_I;
	var T_L			=(DIESEL/PRECIO_D)
	var KM_L		=(Total_km/T_L);
	
	document.getElementById("G_T").value		=G_T.toFixed(2);
	document.getElementById("G_T2").value		=G_T.toFixed(2);
	document.getElementById("CHOFER").value		=CHOFER.toFixed(2);
	document.getElementById("chofer_neto").value		=chofer_neto.toFixed(2);
	document.getElementById("flete_r2").value	=Flete_R.toFixed(2);
	document.getElementById("VIATICOS").value	=VIATICOS.toFixed(2);
	document.getElementById("VIATICOS2").value	=VIATICOS.toFixed(2);
	document.getElementById("DIF_VIA_GSC").value=DIF_VIA_GSC.toFixed(2);
	document.getElementById("T_G_F").value		=T_G_F.toFixed(2);
	document.getElementById("NETO_CARRO").value	=NETO_CARRO.toFixed(2);
	document.getElementById("RENDIMIENTO").value=RENDIMIENTO.toFixed(2);
	document.getElementById("ISR").value		=ISR.toFixed(2);
	document.getElementById("DIF_TV").value		=DIF_TV.toFixed(2);
	document.getElementById("DIF_TV2").value	=DIF_TV.toFixed(2);
	document.getElementById("Total_Total").value=TOTALTOTAL.toFixed(2);
	document.getElementById("Total_km").value	=Total_km.toFixed(2);
	document.getElementById("t_l").value		=T_L.toFixed(2);
	document.getElementById("km_l").value		=KM_L.toFixed(2);
	
	
}
*/
function desca_arrasta		(elemento){
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
			var divres=document.getElementById("divArrastrar");
			if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
				var respuesta = document.createTextNode(ajax.responseText);
				divres.innerHTML = this.responseText;
			}else{
				divres.innerHTML="Cargando ...";
			}
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga=arrastrar&js=1&chofer="+elemento.value);
	}
}
/*function add_arrastra		(elemento){
	var ajax=crearAjax();
	var name="ID_ac";
	var res;
	var x;
	for(x=1; x<=5; x++){
		res=document.getElementById(name+x);
		if(res.value==""){
			res.value=elemento.value;
			actua_arrastra(elemento,res.id); 
			break;
		}
		if(res.value==elemento.value){break;}
	}
	
}*/
function inser_arrastra		(new_valor){
	
	for(y=1; y<=5; y++){
		name1="ac"+y;
		canti=0;
		input=document.getElementById(name1);
		if(input.value==''){}else{canti=parseFloat(input.value);}
		if(input.value==''){}else{total=total+canti;}
	}	
	
}
function reportes			(){
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
	}
}
function reportes2			(){
	var ajax=crearAjax();
	if(ajax){
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
		ajax.send("win_carga=reportes2&js=1",true);
	}
}
function menu_left			(elemento){
	var ajax=crearAjax();
	var actuador=false;
	if (elemento.name=="choferes")	{actuador=true;}
	if (elemento.name=="cuentas")	{actuador=true;}
	
	if((ajax)&&(actuador)){
		ajax.onreadystatechange = function(){
			var divres=document.getElementById("style_co_left");
			if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
				divres.innerHTML = this.responseText;
			}else{
				divres.innerHTML="Cargando ...";
			}
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		if(elemento.name=="choferes")		ajax.send("win_carga=menu_left&js=1&operador=choferes",true);
		if(elemento.name=="cuentas")	ajax.send("win_carga=menu_left&js=1&operador=cuentas&chofer="+elemento.value,true);
	}
}
function actua_arrastra		(elemento,name){
	var y=name[5];
	var name2="ac"+y;
	var ajax=crearAjax();
	if((ajax)&&(elemento.value)){
		ajax.onreadystatechange = function(){
			var divres=document.getElementById(name2);
			//console.log(divres);
			if((ajax.readyState==4)&& (ajax.status == 200)){
				var respuesta = document.createTextNode(ajax.responseText);
				divres.value=this.responseText;
				calcula_update();
			}else{
				
				divres.value="Cargando...";	
			}
			
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga=des_arras&js=1&ID_G="+elemento.value);
	}
	
}
function descarga_cuenta	(elemento){
	var ajax=crearAjax();
	if((ajax)&&(elemento.value)){
		ajax.onreadystatechange = function(){
			var divres=document.getElementById("style_co_centro");
			if((ajax.readyState==4)&& (ajax.status == 200)){
				var respuesta = document.createTextNode(ajax.responseText);
				divres.innerHTML=this.responseText;
				//if(ajax.sta){}
			}else{
				
				divres.innerHTML="Cargando...";	
			}			
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga=Nuevo&js=1&ID_G="+elemento.value);
	}
}
function menu				(){
	var sub=document.getElementById("submenu");
	if(sub.className=='submenu')	{sub.className="submenuhidden";}else
	if(sub.className=='submenuhidden'){sub.className="submenu";}
}
function cambia				(elemento)  {
	if(elemento.name=='Cliente_de_legado')			{setTimeout("location.href='Cliente_de_legado0'", 80);}
	if(elemento.name=='Cliente_de_legado/admin')	{setTimeout("location.href='Cliente_de_legado/admin'", 80);}
	if(elemento.name=='admin')						{setTimeout("location.href='admin'", 80);}
	if(elemento.name=='admin2')						{setTimeout("location.href='admin2'", 80);}
	if(elemento.name=='mysql')						{setTimeout("location.href='mysql'", 80);}
}
function revi				(){
	var cam=document.getElementById("Revisado");Revisado
	var rev=document.getElementById("CambRevi");
	if(rev.value=='Pendiente')	{rev.value="Revisado"; }else
	if(rev.value=='Revisado')	{rev.value="Pendiente";}
	if(cam.value=='1')	{cam.value="0";}else
	if((cam.value=='0')||(cam.value==""))	{cam.value="1";}
}
function folder				(){
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
	var C=c.value;
	var P=p.value;
	var CL=cl.value;
	var D=d.value;
	var M=m.value;
	var A=a.value;
	var D_r=d_r.value;
	var M_r=m_r.value;
	var A_r=a_r.value;
	if ((D>=1)&&(D<=31))			{d.className="Medio";}else{peticion=false;d.className="error";}
	if ((M>=1)&&(M<=12))			{m.className="Medio";}else{peticion=false;m.className="error";}
	if ((A>=2015)&&(A<=2030))		{a.className="Medio";}else{peticion=false;a.className="error";}
	if ((D_r>=1)&&(D_r<=31))		{d_r.className="Medio";}else{peticion=false;d_r.className="error";}
	if ((M_r>=1)&&(M_r<=12))		{m_r.className="Medio";}else{peticion=false;m_r.className="error";}
	if ((A_r>=2015)&&(A_r<=2030))	{a_r.className="Medio";}else{peticion=false;a_r.className="error";}
	
	var ajax=crearAjax();
	if((ajax)&&(peticion==true)){
		ajax.onreadystatechange = function(){
			var divres=document.getElementById("folder");
			if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
				divres.innerHTML = this.responseText;
			}else{
				divres.innerHTML="Cargando ...";
			}
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga=folder&js=1&C="+C+"&P="+P+"&CL="+CL+"&D="+D+"&M="+M+"&A="+A+"&D_r="+D_r+"&M_r="+M_r+"&A_r="+A_r,true);
	}
}
function Elim				(elemento){
	Consola.className="Consola";
	if(elemento){
		if(elemento.value=="Confirmar"){
			resConsola.innerHTML="Proceso de Eliminado";
			sql=delet("abo_acu"			,"ID_G",Carta1.value);	
			sql=delet("km"				,"ID_G",Carta1.value);		
			sql=delet("fechas"			,"ID_G",Carta1.value);		
			sql=delet("abo_acu"			,"ID_G",Carta1.value);
			sql=delet("fletes"			,"ID_G",Carta1.value);
			sql=delet("viaticos"		,"ID_G",Carta1.value);
			sql=delet("disel"			,"ID_G",Carta1.value);
			sql=delet("casetas"			,"ID_G",Carta1.value);
			sql=delet("facturas"		,"ID_G",Carta1.value);
			sql=delet("ryr"				,"ID_G",Carta1.value);
			sql=delet("guias"			,"ID_G",Carta1.value);
			sql=delet("maniobras"		,"ID_G",Carta1.value);
			sql=delet("casetas_via"		,"ID_G",Carta1.value);
			sql=delet("fletes_c"		,"ID_G",Carta1.value);
			sql=delet("viaticos_c"		,"ID_G",Carta1.value);
			sql=delet("disel_c"			,"ID_G",Carta1.value);
			sql=delet("casetas_c"		,"ID_G",Carta1.value);
			sql=delet("facturas_c"		,"ID_G",Carta1.value);	
			sql=delet("ryr_c"			,"ID_G",Carta1.value);
			sql=delet("guias_c"			,"ID_G",Carta1.value);
			sql=delet("maniobras_c"		,"ID_G",Carta1.value);
			sql=delet("casetas_c_via"	,"ID_G",Carta1.value);
			delet_arrastradas();
			sql=delet("folio"			,"ID_G",Carta1.value);	
			
		}
		if(elemento.value=="Cancelar"){
			resConsola.innerHTML="";
		}
	}
	if(!elemento){
		var send="win_carga=Eliminar&js=1";
	}
	if(send){
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
		  if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			resConsola.innerHTML = this.responseText;
			
		  }else{
			resConsola.innerHTML="Cargando ...";
		  }
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send(send);
	}
	}
}
function grafico			(){	//fuera de servicio 
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
	var C=c.value;
	var P=p.value;
	var CL=cl.value;
	var D=d.value;
	var M=m.value;
	var A=a.value;
	var D_r=d_r.value;
	var M_r=m_r.value;
	var A_r=a_r.value;
	if ((D>=1)&&(D<=31))			{d.className="Medio";}else{peticion=false;d.className="error";}
	if ((M>=1)&&(M<=12))			{m.className="Medio";}else{peticion=false;m.className="error";}
	if ((A>=2015)&&(A<=2030))		{a.className="Medio";}else{peticion=false;a.className="error";}
	if ((D_r>=1)&&(D_r<=31))		{d_r.className="Medio";}else{peticion=false;d_r.className="error";}
	if ((M_r>=1)&&(M_r<=12))		{m_r.className="Medio";}else{peticion=false;m_r.className="error";}
	if ((A_r>=2015)&&(A_r<=2030))	{a_r.className="Medio";}else{peticion=false;a_r.className="error";}
	var ajax=crearAjax();
	if((ajax)&&(peticion==true)){
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
		ajax.send("win_carga=graficos&js=1&C="+C+"&P="+P+"&CL="+CL+"&D="+D+"&M="+M+"&A="+A+"&D_r="+D_r+"&M_r="+M_r+"&A_r="+A_r,true);
	}
}
function anti_enter			(e) {	//fuera de servicio 
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
} 
function detalles			(){
	if(!document.getElementById("reporte1")){

	console.log("no exite"); 

	}else{
	$div=document.getElementById("reporte1")
	$div.id="reporte0";
	console.log("exite");
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
			//if(x==9){name1="4TEXT_VIA"+y;}
			if(name1==input.name){name_c=x+"TEXT_C"+y;}
		}
	}
	var come=document.getElementById(name_c);
	res.innerHTML +="<br><TEXTAREA id='"+name_c+"' onkeyup='editText(this);' style='box-shadow: 1px 1px 1px #1387ff;'>"+come.value+"</TEXTAREA>";
	consola.className="Consola";	
}
function editText			(input){
	var text	=document.getElementById(input.id);
	text.value=input.value;
}
function seletauto			(elemento,id1,id2){
	var botones =document.getElementsByClassName(elemento.className);
	for(x=0; x<botones.length; x++){
		var data=botones[x];
		botones[x].id=id1;
	}
	elemento.id=id2;
	//console.log(botones.length);
}
function sel_folder			(button){
	var ajax=crearAjax();
	var selet=button.value;
	if(ajax){
		ajax.onreadystatechange = function(){
		  var divres=document.getElementById("res_folder");
		  if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			divres.innerHTML = this.responseText;
			//div.appendChild(respuesta);
		  }else{
			//divres.innerHTML="<img src='espera2.gif' style='position: absolute; width: 25px; left: 330px; '></img >";
			divres.innerHTML="Cargando ...";
		  }
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("win_carga=folder&js=1&selet="+selet);
	}
}
function n_cuenta			(elemento){	
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
		  var divres=document.getElementById("n_c");
		  if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			divres.value = this.responseText;
			//div.appendChild(respuesta);
		  }else{
			//divres.innerHTML="<img src='espera2.gif' style='position: absolute; width: 25px; left: 330px; '></img >";
			divres.value="Cargando ...";
		  }
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		
		ajax.send("win_carga=n_cuenta&js=1&chofer="+elemento.value);
  }
}
function verificador		(elemento){
	
	var verifi=false;
	if ((elemento.id=='Carta1')||(elemento.id=='Carta2')||(elemento.id=='Carta3')||(elemento.id=='Carta4')){
		verifi	=true;
		id		="conte_"+elemento.id;
		conte	=document.getElementById(id);
		enviar	="win_carga=verificador&js=1&elemento="+elemento.id+"&dato="+elemento.value;
	}
	
	if ((elemento.id=='km_i')||(elemento.id=='km_f')){
		id		="conte_"+elemento.id;
		conte	=document.getElementById(id);
		var km_t=km_f.value-km_i.value;
		if((km_f.value>km_i.value)&&(km_t>=600))	{conte_km_i.style="background: green;";	conte_km_f.style="background: green;";}else
		{conte_km_i.style="background: red;";	conte_km_f.style="background: red;";}
	}
	if(verifi==true){
		var ajax=crearAjax();
		if(ajax){
			ajax.onreadystatechange = function(){
			var divres	=conte;
			var consola	=document.getElementById("Consola");
			var res		=document.getElementById("resConsola");
			consola.className="Consola";	
			  if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
				var respuesta = document.createTextNode(ajax.responseText);
				divres.style = this.responseText;
				//res.innerHTML="Verificado  ...";
			  }else{
				//divres.innerHTML="<img src='espera2.gif' style='position: absolute; width: 25px; left: 330px; '></img >";
				//res.innerHTML="Cargando ...";
			  }
			}
			ajax.open("POST","/admin2/windows.php",true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		
			ajax.send(enviar);
	  }
	}
	
}
function verificador2		(){
	$sql="SELECT * FROM folio WHERE Carta1 = "+Carta1.value+" OR Carta2 = "+Carta1.value+" OR Carta3 = "+Carta1.value+" OR Carta4 = "+Carta1.value+" ORDER BY ID_G DESC ";
	if(sql){
	var datos="win_carga=Ejecutor&js=1&sql="+sql;
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
		  if((ajax.readyState==4)&&(ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			//if(this.responseText!='1'){resConsola.innerHTML+=this.responseText;}
		  }
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		
		ajax.send(datos);
	}
	}
}
function fechero			(dato){
	if(   ((A.value>=2015)&&(A.value<=2030))
		&&((M.value>=01)&&(M.value<=12))
		&&((D.value>=01)&&(D.value<=31))
		){		
			var fecha_re;
			fecha_re=A.value.padStart(2, "0")+M.value.padStart(2, "0")+D.value.padStart(2, "0");
			fecha.value=fecha_re;
			conte_fechai.style="background: #4ff14f;";
	}else{
		conte_fechai.style="background: yellow;";
	}
	if(   ((A_r.value>=2015)&&(A_r.value<=2030))
		&&((M_r.value>=01)&&(M_r.value<=12))
		&&((D_r.value>=01)&&(D_r.value<=31))
		){
			var fecha_re;
			fecha_re=A_r.value.padStart(2, "0")+M_r.value.padStart(2, "0")+D_r.value.padStart(2, "0");
			fecha_r.value=fecha_re;
			conte_fechaf.style="background: #4ff14f;";
	}else{
		conte_fechaf.style="background: yellow;";
	}
	if(
		  ((A.value>=2015)&&(A.value<=2030))
		&&((M.value>=01)&&(M.value<=12))
		&&((D.value>=01)&&(D.value<=31))
		&&((A_r.value>=2015)&&(A_r.value<=2030))
		&&((M_r.value>=01)&&(M_r.value<=12))
		&&((D_r.value>=01)&&(D_r.value<=31))
		&&(fecha_r.value>fecha.value)
	){		
			conte_fechai.style="background: green;";
			conte_fechaf.style="background: green;";
	}
}
function verifi				(){
	var graba=true;
	var error='';
	if(cliente.value=='cliente')							{graba=false;error+="<br>No Selecionado Cliente";}
	if(chofer.value=='chofer')								{graba=false;error+="<br>No Selecionado Operador";}
	if(placas.value=='placas')								{graba=false;error+="<br>No Selecionada Unidad";}
	if(conte_Carta1.style.background=='red')				{graba=false;error+="<br>Carta 1 Porte Existente";}
	if(conte_Carta1.style.background=='')					{graba=false;error+="<br>Carta 1 Porte Falta";}
	if(conte_Carta2.style.background=='red')				{graba=false;error+="<br>Carta 2 Porte Existente";}
	if(conte_Carta3.style.background=='red')				{graba=false;error+="<br>Carta 3 Porte Existente";}
	if(conte_Carta4.style.background=='red')				{graba=false;error+="<br>Carta 4 Porte Existente";}
	if(conte_km_i.style.background=='red')					{graba=false;error+="<br>Irracional Kilometraje Inicio";}
	if(conte_km_i.style.background=='')						{graba=false;error+="<br>Falta Kilometraje Inicio";}
	if(conte_km_f.style.background=='red')					{graba=false;}
	if(conte_km_f.style.background=='')						{graba=false;error+="<br>Falta Kilometraje Final";}
	if(conte_fechai.style.background=='yellow')				{graba=false;error+="<br>Datos Incorrectos en Fecha Inicial";}
	if(conte_fechai.style.background=='rgb(79, 241, 79)')	{graba=false;error+="<br>Irracional Fecha De Salida Con Fecha Llegada";}
	if(conte_fechai.style.background=='')					{graba=false;error+="<br>Falta Fecha De Salida";}
	if(conte_fechaf.style.background=='yellow')				{graba=false;error+="<br>Datos Incorrectos en Fecha Final";}
	if(conte_fechaf.style.background=='rgb(79, 241, 79)')	{graba=false;}
	if(conte_fechaf.style.background=='')					{graba=false;error+="<br>Falta Fecha De Llegada";}
	if(Error!=''){
		Consola.className="Consola";
		resConsola.innerHTML=error;	
	}
	if(graba==true){res=graba;}
	if(graba==false){res=error;}
	return res;
}
function guarda2			(){	
	var guarda=verifi();
	Consola.className="Consola";
	if (guarda==true){
		var sql;
		var res;
				
		sql=build_insert("empresa","km");		
		sql=build_insert("empresa","fechas");		
		sql=build_insert("empresa","abo_acu");
		sql=build_insert2("empresa","fletes");
		sql=build_insert2("empresa","viaticos");
		sql=build_insert2("empresa","disel");
		sql=build_insert2("empresa","casetas");
		sql=build_insert2("empresa","facturas");
		sql=build_insert2("empresa","ryr");
		sql=build_insert2("empresa","guias");
		sql=build_insert2("empresa","maniobras");
		sql=build_insert2("empresa","casetas_via");
		sql=build_insert2("empresa","fletes_c");
		sql=build_insert2("empresa","viaticos_c");
		sql=build_insert2("empresa","disel_c");
		sql=build_insert2("empresa","casetas_c");
		sql=build_insert2("empresa","facturas_c");	
		sql=build_insert2("empresa","ryr_c");
		sql=build_insert2("empresa","guias_c");
		sql=build_insert2("empresa","maniobras_c");
		sql=build_insert2("empresa","casetas_c_via");
		update_esepe("choferes","N_fact",n_c.value,"Nombre_Ch",chofer.value);
		update_arrastradas('','si');
		sql=build_insert("empresa","folio");
		
	}
}
function beta(){
	Consola.className="Consola";
	resConsola.innerHTML=update_arrastradas('','si');
}
function update_arrastradas(noquema,NOTI){
	var res="";
	if(ID_ac1.value)res+=update_esepe("abo_acu","add_en",Carta1.value,"ID_G",ID_ac1.value,noquema,NOTI);
	if(ID_ac2.value)res+=update_esepe("abo_acu","add_en",Carta1.value,"ID_G",ID_ac2.value,noquema,NOTI);
	if(ID_ac3.value)res+=update_esepe("abo_acu","add_en",Carta1.value,"ID_G",ID_ac3.value,noquema,NOTI);
	if(ID_ac4.value)res+=update_esepe("abo_acu","add_en",Carta1.value,"ID_G",ID_ac4.value,noquema,NOTI);
	return res;
	
}
function delet_arrastradas(noquema,NOTI){
	var res="";
	if(ID_ac1.value)res+=update_esepe("abo_acu","add_en",Carta1.value,"ID_G",ID_ac1.value,noquema,NOTI,1);
	if(ID_ac2.value)res+=update_esepe("abo_acu","add_en",Carta1.value,"ID_G",ID_ac2.value,noquema,NOTI,1);
	if(ID_ac3.value)res+=update_esepe("abo_acu","add_en",Carta1.value,"ID_G",ID_ac3.value,noquema,NOTI,1);
	if(ID_ac4.value)res+=update_esepe("abo_acu","add_en",Carta1.value,"ID_G",ID_ac4.value,noquema,NOTI,1);
	return res;
	
}
function elimi_arra(elemento){
	if(elemento.id=="ID_ac1"){elemento.value="";ac1.value="";}
	if(elemento.id=="ID_ac2"){elemento.value="";ac2.value="";}
	if(elemento.id=="ID_ac3"){elemento.value="";ac3.value="";}
	if(elemento.id=="ID_ac4"){elemento.value="";ac4.value="";}
	if(elemento.id=="ID_ac5"){elemento.value="";ac5.value="";}
}
function send(sql,tb,NOTI)	{
	if(sql==""){
		resConsola.innerHTML="Falta Sql Para envio ";
		return "";
	}
	var datos="win_carga=Ejecutor&js=1&sql="+sql;
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
		  if((ajax.readyState==4)&&(ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			if(this.responseText=='1'){resConsola.innerHTML+="<br>"+tb+": ok";}
			if(this.responseText!='1'){resConsola.innerHTML+="<br>"+tb+": Error";}
			if((this.responseText!='1')&&(NOTI=="si")){resConsola.innerHTML+=this.responseText;}
			
		  }
		}
		ajax.open("POST","/admin2/windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		
		ajax.send(datos);
  }
}
function build_insert(db,tb,quema){
	Consola.className="Consola";
	var folio=info(db,tb);
	var sql='';
	sql+="INSERT INTO "+tb+" ("+folio[0][0];
	for(x=1; x<folio[0].length; x++){
		var elemento=folio[0][x];
		sql+=","+elemento;	
	}
	sql+=") VALUE ('"+folio[1][0].value;
	for(x=1; x<folio[1].length; x++){
		var elemento=folio[1][x];
		sql+="','"+elemento.value;	
	}	
	sql+="')";	
	if(!quema)send(sql,tb);
	return sql;
}
function build_insert2(db,tb){
	Consola.className="Consola";
	var folio=info(db,tb);
	var sql='';
	sql+="INSERT INTO "+tb+" ("+folio[0][0];
	for(x=1; x<folio[0].length; x++){
		var elemento=folio[0][x];
		sql+=","+elemento;	
	}
	sql+=") VALUE ('"+document.getElementById(folio[1][0]).value;
	for(x=1; x<folio[1].length; x++){
		var elemento=folio[1][x];
		sql+="','"+document.getElementById(elemento).value;	
	}	
	sql+="')";	
	send(sql,tb);
	return sql;
}
function delet(tb,col,dato){
	var sql="DELETE FROM "+tb+"  WHERE "+col+"='"+dato+"'";
	send(sql,tb);
	return sql;
}
function update_esepe(tb,n,v,col,dato,noquema,NOTI,tipo){
	var sql;
	if(tipo){
		sql="UPDATE "+tb+" SET ";
		sql+=n+"=''";
		sql+=" WHERE "+col+"='"+dato+"'";	
		if(!noquema)send(sql,tb,NOTI);	
	}
	if(!tipo){
		sql="UPDATE "+tb+" SET ";
		sql+=n+"='"+v+"'";
		sql+=" WHERE "+col+"='"+dato+"'";	
		if(!noquema)send(sql,tb,NOTI);
	}
	return sql;
}
function redirec(elemento){
	if(elemento.name=='inicio')setTimeout("location.href='../index.php'", 80);
}
function diagnostico1(elemento){
	var ajax=crearAjax();
	if(ajax){
		ajax.onreadystatechange = function(){
		  if(((ajax.readyState==3)||(ajax.readyState==4))&& (ajax.status == 200)){
			var respuesta = document.createTextNode(ajax.responseText);
			Diagnostico1.innerHTML = this.responseText;
			
		  }else{
			Diagnostico1.innerHTML="Cargando ...";
		  }
		}
		ajax.open("POST","../windows.php",true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
			if(elemento.name!="Auto")var send="win_carga=diagnostico1&js=1&Carta="+elemento.value;
			if(elemento.name=="Auto")var send="win_carga=diagnostico0&js=1";
		ajax.send(send);
  }
	
}

function info(db,tb){
	if(db=="empresa"){
		if(tb=="folio")			{//folio
			var mysql= ["ID_G"		,"CLIENTE"	,"PLACAS"	,"CHOFER"	,"Descripcion"	,"Revisado"		,"Difer_1"		,"Carta1"	,"Carta2"	,"Carta3"	,"Carta4"	,"N_Cuenta"	,"sueldo"	,"isr"];
			var id 	 = [Carta1	,cliente	,placas	,chofer	,come			,CambRevi		,DIF_TV		,Carta1	,Carta2	,Carta3	,Carta4	,n_c		,CHOFER	,ISR];
			
		}
		if(tb=="abo_acu")		{//abo_acu
			var mysql= ["ID_G","add_en","Hide_ac","ID_ac1","ID_ac2","ID_ac3","ID_ac4","ID_ac5","ac1","ac2","ac3","ac4","ac5","Hide_ab","ab1","ab2","ab3","ab4","ab5","ab_Com1","ab_Com2","ab_Com3","ab_Com4","ab_Com5","dif1","Totalac","Totalab","Total_Total","rete"];
			var id 	 = [Carta1,add_en,Hide_ac,ID_ac1,ID_ac2,ID_ac3,ID_ac4,ID_ac5,ac1,ac2,ac3,ac4,ac5,Hide_ab,ab1,ab2,ab3,ab4,ab5,ab_Com1,ab_Com2,ab_Com3,ab_Com4,ab_Com5,DIF_TV,Totalac,Totalab,Total_Total,ISR];
			
		}
		if(tb=="fletes")		{//fletes
			mysql	= ["ID_G","HIDE1","TOTAL1","1TEXT1","1TEXT2","1TEXT3","1TEXT4","1TEXT5","Flete_R","comi_ass"];
			id 		= ["Carta1","HIDE1","TOTAL1","1TEXT1","1TEXT2","1TEXT3","1TEXT4","1TEXT5","flete_r","comi"];
			
		}
		if(tb=="viaticos")		{//viaticos
			mysql	= ["ID_G"	,"HIDE2","TOTAL2","2TEXT1","2TEXT2","2TEXT3","2TEXT4","2TEXT5"];
			id 		= ["Carta1"	,"HIDE2","TOTAL2","2TEXT1","2TEXT2","2TEXT3","2TEXT4","2TEXT5"];
			
		}
		if(tb=="disel")		{//diesel
			mysql	= ["ID_G"	,"HIDE3","TOTAL3","3TEXT1","3TEXT2","3TEXT3","3TEXT4","3TEXT5","3TEXT6","3TEXT7","presio_d"];
			id 		= ["Carta1"	,"HIDE3","TOTAL3","3TEXT1","3TEXT2","3TEXT3","3TEXT4","3TEXT5","3TEXT6","3TEXT7","presio_d"];
			
		}
		if(tb=="casetas")		{//casetas
			var mysql	= ["ID_G","HIDE4","TOTAL4","4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20"];
			var id	 	= ["Carta1","HIDE4","TOTAL4","4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20"];
					
		}
		if(tb=="facturas")		{//facturas
			mysql	=["ID_G"	,"HIDE5","TOTAL5","5TEXT1","5TEXT2","5TEXT3","5TEXT4","5TEXT5"];
			id 		=["Carta1"	,"HIDE5","TOTAL5","5TEXT1","5TEXT2","5TEXT3","5TEXT4","5TEXT5"];
			
		}
		if(tb=="ryr")			{//ryr
			mysql	=["ID_G"	,"HIDE6","TOTAL6","6TEXT1","6TEXT2","6TEXT3","6TEXT4","6TEXT5","6TEXT6","6TEXT7","6TEXT8","6TEXT9","6TEXT10"];
			id 		=["Carta1"	,"HIDE6","TOTAL6","6TEXT1","6TEXT2","6TEXT3","6TEXT4","6TEXT5","6TEXT6","6TEXT7","6TEXT8","6TEXT9","6TEXT10"];
		}
		if(tb=="guias")			{//guias
			mysql	=["ID_G"	,"HIDE7","TOTAL7","7TEXT1","7TEXT2","7TEXT3","7TEXT4","7TEXT5"];
			id 		=["Carta1"	,"HIDE7","TOTAL7","7TEXT1","7TEXT2","7TEXT3","7TEXT4","7TEXT5"];
			
		}
		if(tb=="maniobras")		{//maniobras
			mysql	=["ID_G"	,"HIDE8","TOTAL8","8TEXT1","8TEXT2","8TEXT3","8TEXT4","8TEXT5","8TEXT6"];
			id 		=["Carta1"	,"HIDE8","TOTAL8","8TEXT1","8TEXT2","8TEXT3","8TEXT4","8TEXT5","8TEXT6"];
			
		}
		if(tb=="casetas_via")	{//casetas_via
			mysql	=["ID_G"	,"HIDE","TOTAL","TEXT1","TEXT2","TEXT3","TEXT4","TEXT5","TEXT6","TEXT7","TEXT8","TEXT9"			,"TEXT10","TEXT11","TEXT12","TEXT13","TEXT14","TEXT15","TEXT16","TEXT17","TEXT18","TEXT19","TEXT20"];
			id		=["Carta1"	,"TOTAL9","HIDE9","9TEXT1","9TEXT2","9TEXT3","9TEXT4","9TEXT5","9TEXT6","9TEXT7","9TEXT8","9TEXT9"	,"9TEXT10","9TEXT11","9TEXT12","9TEXT13","9TEXT14","9TEXT15","9TEXT16","9TEXT17","9TEXT18","9TEXT19","9TEXT20"];
		
		}
		if(tb=="fletes_c")		{//fletes_c
			mysql	=["ID_G"	,"1TEXT1","1TEXT2","1TEXT3","1TEXT4","1TEXT5"];
			id 		=["Carta1"	,"1TEXT_C1","1TEXT_C2","1TEXT_C3","1TEXT_C4","1TEXT_C5"];
			
		}
		if(tb=="viaticos_c")	{//viaticos_c
			mysql	=["ID_G"	,"2TEXT1","2TEXT2","2TEXT3","2TEXT4","2TEXT5"];
			id 		=["Carta1"	,"2TEXT_C1","2TEXT_C2","2TEXT_C3","2TEXT_C4","2TEXT_C5"];
			
		}
		if(tb=="disel_c")		{//diesel_c
			mysql	=["ID_G"	,"3TEXT1","3TEXT2","3TEXT3","3TEXT4","3TEXT5","3TEXT6","3TEXT7"];
			id 		=["Carta1"	,"3TEXT_C1","3TEXT_C2","3TEXT_C3","3TEXT_C4","3TEXT_C5","3TEXT_C6","3TEXT_C7"];
			
		}	
		if(tb=="casetas_c")		{//casetas_c
			mysql	=["ID_G"	,"4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20"];
			id 		=["Carta1"	,"4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20"];
		
		}
		if(tb=="facturas_c")	{//facturas_c
			mysql	=["ID_G"	,"5TEXT1","5TEXT2","5TEXT3","5TEXT4","5TEXT5"];
			id 		=["Carta1"	,"5TEXT_C1","5TEXT_C2","5TEXT_C3","5TEXT_C4","5TEXT_C5"];
			
		}
		if(tb=="ryr_c")			{//ryr_c
			mysql	=["ID_G"	,"6TEXT1","6TEXT2","6TEXT3","6TEXT4","6TEXT5","6TEXT6","6TEXT7","6TEXT8","6TEXT9","6TEXT10"];
			id 		=["Carta1"	,"6TEXT_C1","6TEXT_C2","6TEXT_C3","6TEXT_C4","6TEXT_C5","6TEXT_C6","6TEXT_C7","6TEXT_C8","6TEXT_C9","6TEXT_C10"];
		}
		if(tb=="guias_c")		{//guias_c
			mysql	=["ID_G"	,"7TEXT1","7TEXT2","7TEXT3","7TEXT4","7TEXT5"];
			id 		=["Carta1"	,"7TEXT_C1","7TEXT_C2","7TEXT_C3","7TEXT_C4","7TEXT_C5"];
			
		}
		if(tb=="maniobras_c")	{//maniobras_c
			mysql	=["ID_G"	,"8TEXT1","8TEXT2","8TEXT3","8TEXT4","8TEXT5","8TEXT6"];
			id 		=["Carta1"	,"8TEXT_C1","8TEXT_C2","8TEXT_C3","8TEXT_C4","8TEXT_C5","8TEXT_C6"];
			
		}
		if(tb=="fechas")		{//fechas
			mysql	=["ID_G"	,"D","M","A","D_r","M_r","A_r","D_c","M_c","A_c","inicio"];
			id 		=[Carta1	,D,M,A ,D_r,M_r,A_r ,D_c,M_c,A_c,fecha];
			
		}
		if(tb=="km")			{//km
			mysql	=["ID_G"	,"KM_S","KM_E"];
			id 		=[Carta1	,km_i,km_f];
			
		}
		if(tb=="update1")		{//update1
			mysql	=["ID_G","actua_km"];
			id 		=["Carta1"	,"km_i"];
			
		}
		if(tb=="casetas_c_via"){//casetas_via
			mysql	=["ID_G"	,"TEXT1","TEXT2","TEXT3","TEXT4","TEXT5","TEXT6","TEXT7","TEXT8","TEXT9"			,"TEXT10","TEXT11","TEXT12","TEXT13","TEXT14","TEXT15","TEXT16","TEXT17","TEXT18","TEXT19","TEXT20"];
			id		=["Carta1"	,"9TEXT_C1","9TEXT_C2","9TEXT_C3","9TEXT_C4","9TEXT_C5","9TEXT_C6","9TEXT_C7","9TEXT_C8","9TEXT_C9"	,"9TEXT_C10","9TEXT_C11","9TEXT_C12","9TEXT_C13","9TEXT_C14","9TEXT_C15","9TEXT_C16","9TEXT_C17","9TEXT_C18","9TEXT_C19","9TEXT_C20"];
		
		}
		/*
		if(tb==tb25){//choferes
			mysql	=["ID_Ch"	,"Nombre_Ch","Edad","Direccion","Celular","ulti_viaje","Estatus","N_fact"];
			id 		=["Clave"	,"Operador","Edad","Direccion","Celular Asignado","Ultima Carta Porte","Total De Facturas"];
					
		}*/
	}
	var res=[mysql,id];
	return res;

}
