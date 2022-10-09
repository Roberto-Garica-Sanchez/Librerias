<?php
	if((!empty($config_all)<>1)and(!empty($_POST['js'])<>1))	{
		
		//echo"<LINK REL='STYLESHEET' HREF='../estilo.css' />";
		//echo"<LINK REL='STYLESHEET' HREF='../conte_v1.css' />";
		//echo"<script type='text/javascript' language='javascript' src='../libre_v1.js'></script> ";		
		//echo"<script type='text/javascript' language='javascript' src='../libre_v2.js'></script> ";		
	}
	$config_all=1;

	class libre_v1	{			
		function div				($style,$libre,$conte)																			{
			if (($style=='')&&($libre=='')){$style="width: 100px; height: 100px; background: yellowgreen;";}
			$res="<div style='$style' $libre>$conte</div>";
			return $res;
		}
		function select				($sel_name,$sel_style,$sel_libre,$sel_conta,$sel_value,$sel_visual,$sel_title,$sel_libre2)	{
			$res="<select name='$sel_name' class='Medio' style='$sel_style' $sel_libre>";
				for($x=0; $x<=$sel_conta; $x++){
					if($_POST[$sel_name]==$sel_value[$x])$sel_libre2[$x]=" selected";
					$res=$res."<option value='$sel_value[$x]'  title='$sel_title[$x]' $sel_libre2[$x]>$sel_visual[$x]</option>";
				}
			$res=$res."</select>";
			return $res;
		}
		function focuas_a			($limite,$to)																				{	
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
		function login				($host,$user,$pass,$db,$phpv)																{
			//$user		°usuario con que Se Realica login en la bd
			//$host		°Como "localhost" o "192.168.1.x"
			//$conexion °que entrega la funcion "login"
			//$php 		°Vesion de php que Ejecuta El Servidor 	
			if ($phpv=="")  	{echo"[lg]version de php no Definidad";}
			if ($phpv=='php5')	{$conexion=mysql_connect($host,$user,$pass)  or die("[Ln]". mysql_error());}
			if ($phpv=='php7')	{$conexion=mysqli_connect($host,$user,$pass,$db) or die("[Ln]". mysqli_error());}
			return $conexion;
		}
		function ejecuta			($conexion,$res,$phpv)																		{
			if ($res=="")		{echo"[ejecuta]Sin Res para Ejecutar ";	exit;}
			if ($conexion=="") 	{echo"[ejecuta]Sin Conexion ".$res;		exit;}
			if ($phpv=="")		{echo"[ejecuta]Sin Version ".$res;		exit;}
			if ($phpv=='php5') 	{$resu=mysql_query($res,$conexion) or die("\r<br>Error Query php=$phpv\r<br>$res<br>".mysql_error($conexion));}
			if ($phpv=='php7') 	{$resu=mysqli_query($conexion,$res)or die("\r<br>Error Query php=$phpv\r<br>$res<br>".mysqli_error($conexion));}
			return $resu;
		}
		function mysql_da_se		($res,$posicion,$phpv)																		{
			if ($posicion=="")	{$posicion=0;}
			if ($res=="")		{echo"[da_se]Sin 'Res' para mysql_da_se";exit;} 
			if ($phpv=="")  	{echo"[da_se]version de php no Definidad";}
			if ($phpv=='php5')	{mysql_data_seek($res,$posicion);}
			if ($phpv=='php7')	{mysqli_data_seek($res,$posicion);}	
		}
		function mysql_fe_ar		($res,$phpv)																				{
			if ($res=="")		{echo"[fe_ar]Sin 'Res' para mysql_fe_ar";exit;}
			if ($phpv=="")  	{echo"[fe_ar]version de php no Definidad";}
			if ($phpv=='php5') 	{$res=mysql_fetch_array($res);}
			if ($phpv=='php7')	{$res=mysqli_fetch_array($res);}
			return $res;
		}
		function mysql_cl			($conexion,$phpv)																			{	
			if ($conexion=="") 	{echo"[cl] Conecion no existente";}
			if ($phpv=="")  	{echo"[cl]version de php no Definidad";}
			if ($phpv=='php5')	{mysql_close($conexion);}
			if ($phpv=='php7')	{mysqli_close($conexion);}
		}
		function input2				($type2,$name,$title,$value,$style,$id,$libre,$class)										{
			if ($class=='')		$class='Medio';
			if(empty($id)){$id="id='$id'";}
			$d="<input type='$type2' 		style='$style' $id class='$class' name='$name' value='$value' 	title='$title' $libre >";
			if($type2=='label')$d="<label 	style='$style' $id class='$class' name='$name' 				title='$title' $libre >$value</label>";
			if($type2=='tarea')$d="<textarea 	style='$style' $id class='$class' name='$name'					title='$title' $libre >$value</textarea>";
			return $d;
		}
		function consulta			($tabla,$conexion,$col_espe,$espe,$orde,$dire,$phpv,$buscar)								{ 
			$consulta="SELECT * FROM ".$tabla;
			if (($espe<>'') and ($col_espe<>''))					{ $consulta="SELECT * FROM $tabla WHERE $col_espe='$espe'";}
			if (($espe<>'') and ($col_espe<>'') and ($buscar<>''))	{ $consulta="SELECT * FROM $tabla WHERE $col_espe LIKE  '$espe'";}
			if ($dire<>'')		$dire='DESC';
			if ($dire=='')		$dire='ASC';
			if ($orde<>'')		{$consulta=$consulta." ORDER BY $orde $dire";}
			$res=$consulta;
			$consu=libre_v1::ejecuta($conexion,$res,$phpv);
			return $consu;
		}
		function compro				($com,$col,$var,$consu,$conexion,$phpv,$todos)												{//Genera lentitud -> estado opsoleto 
			$verifcaion=false;
			$res=$consu;
			libre_v1::mysql_da_se($res,0,$phpv);
			while($dato=libre_v1::mysql_fe_ar($res,$phpv)){
				if ($dato[$col]==$com){$verifcaion=true; break;}
			}
			/*
			echo "<".$verifcaion.">";
			echo $var;
			echo('<pre>');
			print_r($dato);
			echo('</pre>'); 
			*/
			if(isset($var) and !empty($var) and $var!='' and $verifcaion)$verifcaion=$dato[$var];
			if(isset($todos)and !empty($todos) and $verifcaion){$verifcaion=$dato;}
			return $verifcaion;
		}
		function despliegre_mysql	($name,$name2,$consu,$descarga,$phpv,$libre,$className,$dataset,$set)												{
			$res=$consu;
			if($className=="")$class="class='Medio'";
			if($className<>"")$class="class='$className'";
			$d="<select $class name='$name' $libre>";
			if($name2<>'')$d=$d."<OPTION value='$name'>$name2</OPTION>";
				libre_v1::mysql_da_se($res,0,$phpv);
				while($datos= libre_v1::mysql_fe_ar($res,$phpv)){$set='';		
					if(isset($_POST[$name])and $datos[$descarga]==$_POST[$name]){$set='style="background: #3172b1;" selected';}
					if($dataset<>""){if($datos[$dataset]==$set){$set='style="background: #3172b1;"selected';}}
					$d=$d."<option value='
					$datos[$descarga]
					' $set>
					$datos[$descarga]
					</option>";
				}
			$d=$d."</select>";
			return $d;
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
			if($type<>'hidden'){
			echo"
				<tr >
					<td >$x</td >
					<td ><input type='$type1' name='$n1' value='$v1' title='$title1' Class='Medio' $focus1 maxlength='$max1' style='$style1'>	</td >
					<td ><input type='$type2' name='$n2' value='$v2' title='$title2' Class='Medio' $focus2 maxlength='$max2' style='$style2'>	</td >
				</tr >";
			}
			if($type=='hidden'){echo"<tr ><td>$x</td><td >$name1</td ><td >$name2</td ></tr >";}
		}
		function presenta2			($hidden,$name1,$name2,$type,$style,$borra,$consu){
			if(!isset($_POST[$hidden]))$_POST[$hidden]=1;
			for($x=1; $x<=$_POST[$hidden]; $x++){
				$Name1=$name1.$x;
				$Name2=$name2.$x;
				#if (($_POST[$Name1]=='')and($_POST[$Name2]=='')and($_POST[$hidden]>1)){$_POST[$hidden]=$_POST[$hidden]-1;}
				if (
					empty($_POST[$Name1])and
					empty($_POST[$Name2])and
					isset($_POST[$hidden])and 
					($_POST[$hidden]>1))
					{$_POST[$hidden]=$_POST[$hidden]-1;}
			}
			if (!isset($total)){$total=0;}

			for($x=1; $x<=$_POST[$hidden]; $x++){
				$y=$x+1;
				$Name1=$name1.$x;
				$Name2=$name2.$x;
				$Name3=$name1.$y;
				$Name4=$name2.$y;
				if (!empty($borra) and($_POST[$Name1]==$borra))	{$_POST[$Name1]='';$_POST[$Name2]='';}
				if ((($_POST[$Name1]=='')or($_POST[$Name1]=='0'))and($_POST[$Name2]=='')){$_POST[$Name1]=$_POST[$Name3];$_POST[$Name2]=$_POST[$Name4];$_POST[$Name3]='';$_POST[$Name4]='';}
					echo"<input type='$type' class='Medio' name='$Name1' value='$_POST[$Name1]' style='$style'>
					<input type='$type' class='Medio' name='$Name2' value='$_POST[$Name2]' style='$style'>";
				$total=$total+floatval($_POST[$Name2]);
			}
			return round($total,2);
		}
		function Presenta3			($id,$style,$style_title,$title,$col1,$col2,$t0,$t1,$t2,$repite,$limite,$name1,$name2,$name3,$n_r1,$n_r2,$title1,$title2,$max1,$max2,$style1,$style2,$d1,$d2,$final){
			if ($col1==''){$col1='Comentarios';}
			if ($col2==''){$col2='Importe';}
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
				if ($t0=='')$t0='hidden';
				if (($t0=='hidden')and($t1=='hidden'))	{$c1=$c1.input2('button','','',$v1,'text-align: left;');}
				if (($t0=='hidden')and($t2=='hidden'))	{$c2=$c2.input2('button','','',$v2,'text-align: left;');}
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
		function espe_tab_insert	($tabla,$v0,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$n0,$n1,$n2,$n3,$n4,$n5,$n6,$n7,$n8,$n9,$n10,$n11,$n12,$n13,$n14,$n15,$n16,$n17,$n18,$n19,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$n20,$n21,$n22,$n23,$n24,$n25,$n26,$n27,$n28,$n29,$v20,$v21,$v22,$v23,$v24,$v25,$v26,$v27,$v28,$v29){
			$d="INSERT INTO $tabla ($n0";
			IF ($n1<>'')	$d=$d.",$n1";	IF ($n2<>'')	$d=$d.",$n2";	IF ($n3<>'')	$d=$d.",$n3";	IF ($n4<>'')	$d=$d.",$n4";	IF ($n5<>'')	$d=$d.",$n5";
			IF ($n6<>'')	$d=$d.",$n6";	IF ($n7<>'')	$d=$d.",$n7";	IF ($n8<>'')	$d=$d.",$n8";	IF ($n9<>'')	$d=$d.",$n9";	IF ($n10<>'')	$d=$d.",$n10";
			IF ($n11<>'')	$d=$d.",$n11";	IF ($n12<>'')	$d=$d.",$n12";	IF ($n13<>'')	$d=$d.",$n13";	IF ($n14<>'')	$d=$d.",$n14";	IF ($n15<>'')	$d=$d.",$n15";
			IF ($n16<>'')	$d=$d.",$n16";	IF ($n17<>'')	$d=$d.",$n17";	IF ($n18<>'')	$d=$d.",$n18";	IF ($n19<>'')	$d=$d.",$n19";	IF ($n20<>'')	$d=$d.",$n20";
			IF ($n21<>'')	$d=$d.",$n21";	IF ($n22<>'')	$d=$d.",$n22";	IF ($n23<>'')	$d=$d.",$n23";	IF ($n24<>'')	$d=$d.",$n24";	IF ($n25<>'')	$d=$d.",$n25";
			IF ($n26<>'')	$d=$d.",$n26";	IF ($n27<>'')	$d=$d.",$n27";	IF ($n28<>'')	$d=$d.",$n28";	IF ($n29<>'')	$d=$d.",$n29";	IF ($n30<>'')	$d=$d.",$n30";
			$d=$d.") VALUE ('$v0'";
			IF ($n1<>'')	$d=$d.",'$v1'";	IF ($n2<>'')	$d=$d.",'$v2'";	IF ($n3<>'')	$d=$d.",'$v3'";	IF ($n4<>'')	$d=$d.",'$v4'";	IF ($n5<>'')	$d=$d.",'$v5'";
			IF ($n6<>'')	$d=$d.",'$v6'";	IF ($n7<>'')	$d=$d.",'$v7'";	IF ($n8<>'')	$d=$d.",'$v8'";	IF ($n9<>'')	$d=$d.",'$v9'";	IF ($n10<>'')	$d=$d.",'$v10'";
			IF ($n11<>'')	$d=$d.",'$v11'";IF ($n12<>'')	$d=$d.",'$v12'";IF ($n13<>'')	$d=$d.",'$v13'";IF ($n14<>'')	$d=$d.",'$v14'";IF ($n15<>'')	$d=$d.",'$v15'";
			IF ($n16<>'')	$d=$d.",'$v16'";IF ($n17<>'')	$d=$d.",'$v17'";IF ($n18<>'')	$d=$d.",'$v18'";IF ($n19<>'')	$d=$d.",'$v19'";IF ($n20<>'')	$d=$d.",'$v20'";
			IF ($n21<>'')	$d=$d.",'$v21'";IF ($n22<>'')	$d=$d.",'$v22'";IF ($n23<>'')	$d=$d.",'$v23'";IF ($n24<>'')	$d=$d.",'$v24'";IF ($n25<>'')	$d=$d.",'$v25'";
			IF ($n26<>'')	$d=$d.",'$v26'";IF ($n27<>'')	$d=$d.",'$v27'";IF ($n28<>'')	$d=$d.",'$v28'";IF ($n29<>'')	$d=$d.",'$v29'";IF ($n30<>'')	$d=$d.",'$v30'";
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
		function menu				($style,$libre,$name,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$script_input)			{	
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
			if(!isset($_POST[$name]))$_POST[$name]=$v1;
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
			$conte=	libre_v1::input2('hidden',$name,'',$_POST[$name],'','','','');
			if($v1<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v1,"",$d1 ,''.$script_input,' ');
			if($v2<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v2,"",$d2 ,''.$script_input,' ');
			if($v3<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v3,"",$d3 ,''.$script_input,' ');
			if($v4<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v4,"",$d4 ,''.$script_input,' ');
			if($v5<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v5,"",$d5 ,''.$script_input,' ');
			if($v6<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v6,"",$d6 ,''.$script_input,' ');
			if($v7<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v7,"",$d7 ,''.$script_input,' ');
			if($v8<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v8,"",$d8 ,''.$script_input,' ');
			if($v9<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v9,"",$d9 ,''.$script_input,' ');
			if($v10<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v10,"",$d10);
			if($v11<>'')$conte=$conte.	libre_v1::input2('button',$name,'',$v11,"",$d11);
			$res=	libre_v1::div($style,$libre,$conte);
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
					
					if (($array_type[$x]=='text')||($array_type[$x]=='hidden')||($array_type[$x]=='button')){	$d=input2('hidden',$array_name[$x],$array_title[$x],$array_value[$x],$array_style[$x],$array_id[$x],$array_libre[$x],$array_class[$x]).input2($array_type[$x],$array_name[$x],$array_title[$x],$array_value[$x],$array_style[$x],$array_id[$x],$array_libre[$x],$array_class[$x]);	}
					if ($array_type[$x]=='textarea')	{														$d="<textarea name='$array_name[$x]' title='$array_title[$x]' style='$array_style[$x]' id='$array_id[$x]' class='$array_class[$x]' $array_libre[$x]>$array_value[$x]</textarea>";	}
					if ($array_type[$x]=='Estatus')	{				$d=objeto::Estatus('','ver');}
					if ($array_type[$x]=='Fecha_re')	{				$d=objeto::Fecha_re();}
					if ($array_type[$x]=='N_Fact')	{				$d=objeto::N_Fact();}
					
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
			$conte=$conte.libre_v1::input2('button',$name,'',$actuador	,'position: absolute; right: 5px; width: 20px;',"act".$name,"onclick='windows($name);'");//,'onclick="windows(this);"'
			
			$libre="id='$name' class='$class'";
			$res		=libre_v1::div					($style,$libre,$conte);
			return $res;
		}
		function tran				($name1,$name2,$dato){
			for($x=1; $x<=20; $x++){
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
		function Auto_veri($conexion,$phpv,$interfa)	{
			libre_v1::db							(empresa,$conexion,$phpv);	
			$consu5	= libre_v1::consulta			(folio,$conexion	,'','','ID_G','1'	,$phpv,'');
			libre_v1::mysql_da_se					($consu5,0,$phpv);	
			if($interfa<>""){
				while($datos=libre_v1::mysql_fe_ar		($consu5,$phpv)){	
					echo"<div style='float: left; position: relative;background: blue; margin: 1px;'>";
						echo"<div>";
							echo libre_v1::input2(text,'','',Folios,'width: 50px; text-align: center;','','',botones_submenu);
							echo libre_v1::input2(text,'','',$datos[ID_G],'width: 50px; background: #248ec1; color: white;text-align: center;','','',botones_submenu);
						
						$tb 	= array(folio,abo_acu,casetas,casetas_c,casetas_via,casetas_c_via,disel,disel_c,fechas,fletes,fletes_c,facturas,facturas_c,viaticos,viaticos_c,ryr,ryr_c,guias,guias_c,maniobras,maniobras_c,km,update1,choferes);
						$estatus=Bien; 
						$color=green;
						for($x=0; $x<=21; $x++){
							$res= libre_v1::verificador($datos[ID_G],$tb[$x],$conexion,$phpv);
							//if(($res==0)and($repara==si))libre_v2::guarda_indivi($datos[ID_G],$tb[$x],'echo',$conexion,$phpv);
							if($res==0)libre_v2::guarda_indivi($datos[ID_G],$tb[$x],'ejecuta',$conexion,$phpv);
							if($res==0){$estatus="Reparada"; $color=orange;}
						}	
						echo libre_v1::input2(text,'','','Estatus:',"background: $color; color: white; width: 50px;",'','',botones_submenu);
						echo libre_v1::input2(text,'','',$estatus,"background: $color; color: white; width: 50px;",'','',botones_submenu);
						echo"</div>";
					echo"</div>";
				}
			}
			if($interfa==""){
				while($datos=libre_v1::mysql_fe_ar		($consu5,$phpv)){	
						$tb 	= array(folio,abo_acu,casetas,casetas_c,casetas_via,casetas_c_via,disel,disel_c,fechas,fletes,fletes_c,facturas,facturas_c,viaticos,viaticos_c,ryr,ryr_c,guias,guias_c,maniobras,maniobras_c,km,update1,choferes);
						$estatus='Bien'; 
						for($x=0; $x<=21; $x++){
							$res= libre_v1::verificador($datos[ID_G],$tb[$x],$conexion,$phpv);
							if(($res==0)and($repara==si))libre_v2::guarda_indivi($datos[ID_G],$tb[$x],'ejecuta',$conexion,$phpv);
							if($res==0){$estatus="mal";}
						}	
						if($estatus=="mal")echo"<br>".$datos[ID_G];
				}
			}
		}
		function manua_veri($Carta,$conexion,$phpv)		{
			echo"<div>";
				echo libre_v1::input2(text,'','',Folios);
				echo libre_v1::input2(text,'','',$Carta);
			echo"</div>";
			echo"<div>";
			$tb 	= array(folio,abo_acu,casetas,casetas_c,casetas_via,casetas_c_via
			,disel,disel_c,fechas,fletes,fletes_c,facturas,facturas_c,viaticos,viaticos_c,ryr
			,ryr_c,guias,guias_c,maniobras,maniobras_c,km,update1,choferes);
			$estatus=Bien;
			for($x=0; $x<=21; $x++){
				$res="";
				echo"<br>";
				$res= libre_v1::verificador($Carta,$tb[$x],$conexion,$phpv);
				//if(($res==0)and($repara==si))libre_v2::guarda_indivi($Carta,$tb[$x],'ejecuta',$conexion,$phpv);
				if($res==0)libre_v2::guarda_indivi($datos[ID_G],$tb[$x],'ejecuta',$conexion,$phpv);
				if($res==0){$estatus="Reparada";}
				echo libre_v1::input2(text,'','',$tb[$x]);
				echo libre_v1::input2(text,'','',$res);
			}	
			echo"<br>";
			echo libre_v1::input2(text,'','',Estatus);
			echo libre_v1::input2(text,'','',$estatus);
			echo"</div>";
			
		}
		function verificador($Carta,$tb,$conexion,$phpv){		
				$consu	= libre_v1::consulta		($tb,$conexion,ID_G,$Carta,'',''	,$phpv,'');
				$datos=libre_v1::mysql_fe_ar		($consu,$phpv);
				if($datos[ID_G]==""){$res=0;}
				if($datos[ID_G]<>""){$res=1;}
				return $res;
		}
	}

/*
	if($tablas_v1<>1)		{$tablas_v1=1;	
		class tablas_v1	{
			function info($db,$tb){
				$db1=empresa;
				$db2=login;
				if($db==$db1){
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
						$array_mysql 	= array(ID_G		,CLIENTE	,PLACAS		,CHOFER		,Descripcion	,Revisado		,Difer_1	,Carta1		,Carta2		,Carta3		,Carta4		,N_Cuenta	,sueldo		,isr);
						$array_name 	= array(Carta1		,cliente	,placas		,chofer		,come			,CambRevi		,dif1		,Carta1		,Carta2		,Carta3		,Carta4		,n_c		,sueldo		,isr);
						$array_text 	= array("Codigo G"	,Cliente	,Unidad		,''			,Descripcion	,Estado			,Diferencia	,"Carta 1"	,"SubCarta 2"	,"SubCarta 3"	,"SubCarta 4"	,"Nuemro"	,Sueldo		,Retencion);
						$array_size 	= array("4"			,"25"		,"6"		,"25"		,"200"			,"5"			,"15"		,"4"		,"4"		,"4"		,"4"		,"4"		,"10"		,"10");
						
					}
					if($tb==$tb2){//abo_acu
						$array_mysql	= array(ID_G,add_en,Hide_ac,ID_ac1,ID_ac2,ID_ac3,ID_ac4,ID_ac5,ac1,ac2,ac3,ac4,ac5	,Hide_ab,ab1,ab2,ab3,ab4,ab5,ab_Com1,ab_Com2,ab_Com3,ab_Com4,ab_Com5,dif1,Totalac,Totalab,Total_Total,rete);
						$array_name		= array(Carta1,add_en,Hide_ac,ID_ac1,ID_ac2,ID_ac3,ID_ac4,ID_ac5,ac1,ac2,ac3,ac4,ac5,Hide_ab,ab1,ab2,ab3,ab4,ab5,ab_Com1,ab_Com2,ab_Com3,ab_Com4,ab_Com5,dif1,Totalac,Totalab,Total_Total,isr);
						$array_size		= array(4,4,4,4,4,4,4,4,15,15,15,15,15,4,15,15,15,15,15,30,30,30,30,30,10,15,15,15,10);
						
					}
					if($tb==$tb3){//casetas
						$array_mysql	= array(ID_G,HIDE4,TOTAL4,"4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20");
						$array_name 	= array(Carta1,HIDE4,TOTAL4,"4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20");
						$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
						
					}
					if($tb==$tb4){//casetas_c
						$array_mysql	= array(ID_G	,"4TEXT1","4TEXT2","4TEXT3","4TEXT4","4TEXT5","4TEXT6","4TEXT7","4TEXT8","4TEXT9","4TEXT10","4TEXT11","4TEXT12","4TEXT13","4TEXT14","4TEXT15","4TEXT16","4TEXT17","4TEXT18","4TEXT19","4TEXT20");
						$array_name 	= array(Carta1	,"4TEXT_C1","4TEXT_C2","4TEXT_C3","4TEXT_C4","4TEXT_C5","4TEXT_C6","4TEXT_C7","4TEXT_C8","4TEXT_C9","4TEXT_C10","4TEXT_C11","4TEXT_C12","4TEXT_C13","4TEXT_C14","4TEXT_C15","4TEXT_C16","4TEXT_C17","4TEXT_C18","4TEXT_C19","4TEXT_C20");
						$array_size		= array(4		,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
						
					}
					if($tb==$tb5){//casetas_via
						$array_mysql	= array(ID_G	,HIDE,TOTAL		,"TEXT1","TEXT2","TEXT3","TEXT4","TEXT5","TEXT6","TEXT7","TEXT8","TEXT9"			,"TEXT10","TEXT11","TEXT12","TEXT13","TEXT14","TEXT15","TEXT16","TEXT17","TEXT18","TEXT19","TEXT20");
						$array_name 	= array(Carta1	,HIDE9,TOTAL9	,"4TEXT_VIA1","4TEXT_VIA2","4TEXT_VIA3","4TEXT_VIA4","4TEXT_VIA5","4TEXT_VIA6","4TEXT_VIA7","4TEXT_VIA8","4TEXT_VIA9","4TEXT_VIA10","4TEXT_VIA11","4TEXT_VIA12","4TEXT_VIA13","4TEXT_VIA14","4TEXT_VIA15","4TEXT_VIA16","4TEXT_VIA17","4TEXT_VIA18","4TEXT_VIA19","4TEXT_VIA20");
						$array_size		= array(4,2,5	,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
						
					}
					if($tb==$tb6){//fletes
						$array_mysql	= array(ID_G	,HIDE1,TOTAL1,"1TEXT1","1TEXT2","1TEXT3","1TEXT4","1TEXT5",Flete_R,comi_ass);
						$array_name 	= array(Carta1	,HIDE1,TOTAL2,"1TEXT1","1TEXT2","1TEXT3","1TEXT4","1TEXT5",flete_r,comi);
						
					}
					if($tb==$tb7){//viaticos
						$array_mysql	= array(ID_G	,HIDE2,TOTAL2,"2TEXT1","2TEXT2","2TEXT3","2TEXT4","2TEXT5");
						$array_name 	= array(Carta1	,HIDE2,TOTAL2,"2TEXT1","2TEXT2","2TEXT3","2TEXT4","2TEXT5");
						
					}
					if($tb==$tb8){//diesel
						$array_mysql	= array(ID_G	,HIDE3,TOTAL3,"3TEXT1","3TEXT2","3TEXT3","3TEXT4","3TEXT5","3TEXT6","3TEXT7",presio_d);
						$array_name 	= array(Carta1	,HIDE3,TOTAL3,"3TEXT1","3TEXT2","3TEXT3","3TEXT4","3TEXT5","3TEXT6","3TEXT7",presio_d);
						
					}
					if($tb==$tb10){//facturas
						$array_mysql	= array(ID_G	,HIDE5,TOTAL5,"5TEXT1","5TEXT2","5TEXT3","5TEXT4","5TEXT5");
						$array_name 	= array(Carta1	,HIDE5,TOTAL5,"5TEXT1","5TEXT2","5TEXT3","5TEXT4","5TEXT5");
						
					}
					if($tb==$tb11){//ryr
						$array_mysql	= array(ID_G	,HIDE6,TOTAL6,"6TEXT1","6TEXT2","6TEXT3","6TEXT4","6TEXT5","6TEXT6","6TEXT7","6TEXT8","6TEXT9","6TEXT10");
						$array_name 	= array(Carta1	,HIDE6,TOTAL6,"6TEXT1","6TEXT2","6TEXT3","6TEXT4","6TEXT5","6TEXT6","6TEXT7","6TEXT8","6TEXT9","6TEXT10");
					}
					if($tb==$tb12){//guias
						$array_mysql	= array(ID_G	,HIDE7,TOTAL7,"7TEXT1","7TEXT2","7TEXT3","7TEXT4","7TEXT5");
						$array_name 	= array(Carta1	,HIDE7,TOTAL7,"7TEXT1","7TEXT2","7TEXT3","7TEXT4","7TEXT5");
						
					}
					if($tb==$tb13){//maniobras
						$array_mysql	= array(ID_G	,HIDE8,TOTAL8,"8TEXT1","8TEXT2","8TEXT3","8TEXT4","8TEXT5","8TEXT6");
						$array_name 	= array(Carta1	,HIDE8,TOTAL8,"8TEXT1","8TEXT2","8TEXT3","8TEXT4","8TEXT5","8TEXT6");
						
					}
					if($tb==$tb14){//fletes_c
						$array_mysql	= array(ID_G	,"1TEXT1","1TEXT2","1TEXT3","1TEXT4","1TEXT5");
						$array_name 	= array(Carta1	,"1TEXT_C1","1TEXT_C2","1TEXT_C3","1TEXT_C4","1TEXT_C5");
						
					}
					if($tb==$tb15){//viaticos_c
						$array_mysql	= array(ID_G	,"2TEXT1","2TEXT2","2TEXT3","2TEXT4","2TEXT5");
						$array_name 	= array(Carta1	,"2TEXT_C1","2TEXT_C2","2TEXT_C3","2TEXT_C4","2TEXT_C5");
						
					}
					if($tb==$tb16){//diesel
						$array_mysql	= array(ID_G	,"3TEXT1","3TEXT2","3TEXT3","3TEXT4","3TEXT5","3TEXT6","3TEXT7");
						$array_name 	= array(Carta1	,"3TEXT_C1","3TEXT_C2","3TEXT_C3","3TEXT_C4","3TEXT_C5","3TEXT_C6","3TEXT_C7");
						
					}
					if($tb==$tb17){//facturas_c
						$array_mysql	= array(ID_G	,"5TEXT1","5TEXT2","5TEXT3","5TEXT4","5TEXT5");
						$array_name 	= array(Carta1	,"5TEXT_C1","5TEXT_C2","5TEXT_C3","5TEXT_C4","5TEXT_C5");
						
					}
					if($tb==$tb18){//ryr_c
						$array_mysql	= array(ID_G	,"6TEXT1","6TEXT2","6TEXT3","6TEXT4","6TEXT5","6TEXT6","6TEXT7","6TEXT8","6TEXT9","6TEXT10");
						$array_name 	= array(Carta1	,"6TEXT_C1","6TEXT_C2","6TEXT_C3","6TEXT_C4","6TEXT_C5","6TEXT_C6","6TEXT_C7","6TEXT_C8","6TEXT_C9","6TEXT_C10");
					}
					if($tb==$tb19){//guias
						$array_mysql	= array(ID_G	,"7TEXT1","7TEXT2","7TEXT3","7TEXT4","7TEXT5");
						$array_name 	= array(Carta1	,"7TEXT_C1","7TEXT_C2","7TEXT_C3","7TEXT_C4","7TEXT_C5");
						
					}
					if($tb==$tb20){//maniobras
						$array_mysql	= array(ID_G	,"8TEXT1","8TEXT2","8TEXT3","8TEXT4","8TEXT5","8TEXT6");
						$array_name 	= array(Carta1	,"8TEXT_C1","8TEXT_C2","8TEXT_C3","8TEXT_C4","8TEXT_C5","8TEXT_C6");
						
					}
					if($tb==$tb21){//fechas
						$array_mysql	= array(ID_G	,D,M,A ,D_r,M_r,A_r ,D_c,M_c,A_c,inicio);
						$array_name 	= array(Carta1	,D,M,A ,D_r,M_r,A_r ,D_c,M_c,A_c,inicio);
						
					}
					if($tb==$tb22){//km
						$array_mysql	= array(ID_G	,KM_S,KM_E);
						$array_name 	= array(Carta1	,km_i,km_f);
						
					}
					if($tb==$tb23){//update1
						$array_mysql	= array(ID_G	,actua_km);
						$array_name 	= array(Carta1	,km_i);
						
					}
					if($tb==$tb24){//casetas_c_via
						$array_mysql	= array(ID_G	,"TEXT1","TEXT2","TEXT3","TEXT4","TEXT5","TEXT6","TEXT7","TEXT8","TEXT9"							,"TEXT10","TEXT11","TEXT12","TEXT13","TEXT14","TEXT15","TEXT16","TEXT17","TEXT18","TEXT19","TEXT20");
						$array_name 	= array(Carta1	,
						"4TEXT_VIA_C1","4TEXT_VIA_C2","4TEXT_VIA_C3","4TEXT_VIA_C4","4TEXT_VIA_C5",
						"4TEXT_VIA_C6","4TEXT_VIA_C7","4TEXT_VIA_C8","4TEXT_VIA_C9"	,"4TEXT_VIA_C10",
						"4TEXT_VIA_C11","4TEXT_VIA_C12","4TEXT_VIA_C13","4TEXT_VIA_C14","4TEXT_VIA_C15",
						"4TEXT_VIA_C16","4TEXT_VIA_C17","4TEXT_VIA_C18","4TEXT_VIA_C19","4TEXT_VIA_C20");
						$array_size		= array(4,2,5,"5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5","5");
						
					}
					if($tb==$tb25){//choferes
						$array_mysql	= array(ID_Ch	,Nombre_Ch,Edad,Direccion, Celular,ulti_viaje,Estatus,N_fact);
						$array_name 	= array(Clave	,Operador,Edad,Direccion,"Celular Asignado","Ultima Carta Porte","Total De Facturas ");
						$array_size		= array(2,50,2,25,10,4,1,5);
						
					
					}
				}
				$array_config	= array(
				"db"	=> $db,
				"tb"	=> $tb,
				);
				$res			= array(
				"config"=> $array_config,
				"mysql"	=> $array_mysql,
				"name"	=> $array_name,
				"text"	=> $array_text,
				"size"	=> $array_size,
				"type"	=> $array_type,
				"id"	=> $array_id,
				"clas"	=> $array_class,
				"valid"	=> $array_valida
				);
				return $res;
			}
		}

	}
	if($mysql_v1<>1)		{$mysql_v1=1;	class mysql_v1	{

				function Tabla_info		($db,$tabla){
					$db0=login;
					$db1=empresa;
					$db2=almacen;
					if($db==$db1){
						$tabla1=folio;
						$tabla2=clientes2;
						$tabla3=choferes2;
						$tabla4=placas2;		
						if($tabla==$tabla1)		{//folio
							$array_mysql 	= array(ID_G		,CLIENTE	,PLACAS		,Descripcion	,Revisado	,Difer_1	,Carta1		,Carta2		,Carta3		,Carta4		,N_Cuenta	,sueldo	,isr);
							$array_text 	= array("Codigo G"	,Cliente	,Unidad		,Descripcion	,Estado		,Diferencia	,"Carta 1"	,"Carta 2"	,"Carta 3"	,"Carta 4"	,"Nuemro"	,Sueldo	,Retencion);
							$array_type 	= array(""			,""			,""			,textarea		,""			,""			,""			,""			,""			,""			,""			,""		,"");
							$array_id 		= array(""			,""			,""			,comenta		,""			,""			,""			,""			,""			,""			,""			,""		,"");
							$array_class	= array(""			,""			,""			,Medio			,""			,""			,""			,""			,""			,""			,""			,""		,"");
							$array_valida	= array(1			,1			,1			,2				,2			,2			,1			,2			,2			,2			,2			,2		,"");
						
						}
						if($tabla==$tabla2)		{//Clientes2
							$array_mysql 	= array(ID_G		,Nombre_Cl	,Fecha_re	,Destino		,N_fact		);
							$array_text 	= array(Clave		,Cliente	,Fecha 		,Destino		,"N° Facturas");
							$array_type 	= array(""			,""			,Fecha_re			,""		,N_Fact);
							$array_id 		= array(""			,""			,""			,""				,"");
							$array_class	= array(""			,""			,""			,""				,"");
							$array_valida	= array(1			,1			,2			,1				,2);
						
						}
						if($tabla==$tabla3)		{//choferes2
							$array_config 	= array("Estatus" => 6, "Index"=>1 );
							$array_mysql 	= array(ID_G		,Nombre_Ch	,Edad		,Direccion		,Celular 		,ulti_viaje 	,Estatus	,N_fact);
							$array_text 	= array(Clave		,Chofer		,Edad 		,Domicilio		,"N° Celular"	,"Total Viajes"	,Estatus	,"Facturas ASG."	);
							$array_type 	= array(""			,""			,""			,""				,""				,hidden			,Estatus	,hidden		);
							$array_id 		= array(""			,""			,""			,""				,""				,""				,""			,""		);
							$array_class	= array(""			,""			,""			,""				,""				,""				,""			,""		);
							$array_valida	= array(1			,1			,1			,1				,2				,2				,2			,2);
						
						}
						if($tabla==$tabla4)		{// placas
							$array_mysql 	= array(ID_G		,Placas		,Marca		,Modelo			,N_eco			,Color			,N_fact);
							$array_text 	= array(Clave		,Placas		,Marca 		,Modelo			,"N° Economico"	,Color			,"Facturas ASG.");
							$array_type 	= array(""			,""			,""			,""				,""				,""				,"");
							$array_id 		= array(""			,""			,""			,""				,""				,""				,"");
							$array_class	= array(""			,""			,""			,""				,""				,""				,"");
							$array_valida	= array(1			,1			,1			,1				,2				,1				,2);
						
						}
					}			
					if($db==$db2){
						$tabla1=folio;	
						$tabla2=proveedores;
						if($tabla==$tabla1)		{
							$array_mysql 	= array(ID_G		,nombre	,cantidad	,descripcion,marca	,medidas,capacidad,costo	,provedor	,come		,posicion	,uni_min);
							$array_text 	= array("Codigo G"	,Nombre	,Cantidad	,Descripcion,Marca	,Medidas,Capasidad,Costo	,Proveedor	,Comentario	,Posicion	,"Uni. Min.");
							$array_type 	= array(""			,""		,""			,textarea	,""		,""		,""		,""		,""			,textarea	,""			,"");
							$array_id 		= array(""			,""		,""			,comenta	,""		,""		,""		,""		,""			,comenta	,""			,"");
							$array_class	= array(""			,""		,""			,Medio		,""		,""		,""		,""		,""			,Medio		,""			,"");
							$array_valida	= array(1			,1		,2			,2			,2		,2		,2		,1		,1			,2			,1			,2);
						}
						if($tabla==$tabla2)		{
							$array_mysql 	= array(ID_G		,nombre		,apodo				,direccion	,cuidad	,colonia	,codigo	,telefono	,email	,ID_fot		,come		);
							$array_text 	= array("Codigo G"	,Proveedor	,Apodo				,Direccion	,Cuidad	,Colonia	,Codigo ,Telefono	,Correo ,Imagen		,Comentario	);
							$array_type 	= array(""			,""			,""					,""			,""		,""			,""		,""			,""		,hidden		,textarea	);
							$array_id 		= array(""			,""			,""					,""			,""		,""			,""		,""			,""		,""			,comenta	);
							$array_class	= array(""			,""			,""					,""			,""		,""			,""		,""			,""		,""			,Medio		);
							$array_valida	= array(1			,1			,2					,2			,2		,2			,2		,2			,2		,2			,2			);
						}
					}
						$res=	array(
							"config"=> $array_config,
							"mysql"	=> $array_mysql,
							"text"	=> $array_text,
							"type"	=> $array_type,
							"id"	=> $array_id,
							"clas"	=> $array_class,
							"valid"	=> $array_valida
							
						);
						return $res;
						
				}
				function insert			($array,$conexion,$phpv){
					if($array[mysql]<>"")	$conta=count($array[mysql]);
					$mysql	= $array[mysql];
					$name	= $array[name];
					$config	= $array[config];
					for($x=0; $x<$conta; $x++){
						$value[$x]=$_POST[$name[$x]];
					}
					$res="INSERT INTO $config[tb] (";
						for($x=0; $x<$conta; $x++){if($x>0){$res=$res.",";}$res=$res."$mysql[$x]";}
					$res=$res.") VALUE (";
						for($x=0; $x<$conta; $x++){if($x>0){$res=$res.",";}$res=$res."'$value[$x]'";}
					$res=$res.")";
			
					return $res;
				}
				function Update			($base,$tabla,$array_mysql,$conexion,$phpv){
											$conta=count($array_name);
					if($array_mysql<>"")	$conta=count($array_mysql);
					for($x=0; $x<$conta; $x++){
						if($array_mysql[$x]<>"")	$array_name[$x]=$array_mysql[$x];
						if($array_value[$x]=="")	$array_value[$x]=$_POST[$array_name[$x]];
						if(($array_valida[$x]<>"")&&($array_value[$x]==""))$valida=false;
						
					}
					db($base,$conexion,$phpv);
						$col_espe	=	$array_mysql[0];
						$espe		=	$_POST[$array_name[0]];	
						$orde		=	"";
						$dire		=	1;
						$buscar		=	1;
						$consu=consulta($tabla,$conexion,$col_espe,$espe,$orde,$dire,$phpv,$buscar);
						$dato=mysql_fe_ar($consu,$phpv);
						
						$res="UPDATE $tabla SET $array_mysql[0]='".$_POST[$array_name[0]]."'";
						for($x=1; $x<$conta; $x++){$res=$res.",$array_mysql[$x]='".$_POST[$array_name[$x]]."'";}
						$res=$res." WHERE $array_mysql[0]='".$_POST[$array_name[0]]."'";
						if(($_POST[operador]=="Guardar")&&($_POST[$array_name[0]]==$dato[ID_G])){ejecuta($conexion,$res,$phpv); //echo$res;
							$_POST[operador]="Modificar";
							
						}
				}
				function Delete			($base,$tabla,$array_mysql,$conexion,$phpv){
											$conta=count($array_name);
					if($array_mysql<>"")	$conta=count($array_mysql);
					for($x=0; $x<$conta; $x++){
						if($array_mysql[$x]<>"")	$array_name[$x]=$array_mysql[$x];
						if($array_value[$x]=="")	$array_value[$x]=$_POST[$array_name[$x]];
						if(($array_valida[$x]<>"")&&($array_value[$x]==""))$valida=false;
						
					}
					db($base,$conexion,$phpv);
						$col_espe	=	$array_mysql[0];
						$espe		=	$_POST[$array_name[0]];	
						$orde		=	"";
						$dire		=	1;
						$buscar		=	1;
						$consu		=	consulta($tabla,$conexion,$col_espe,$espe,$orde,$dire,$phpv,$buscar);
						$dato		=	mysql_fe_ar($consu,$phpv);
						$col_espe	=	$array_mysql[0];
						$espe		=	$_POST[$array_name[0]];
						$res="DELETE FROM $tabla  WHERE $col_espe='$espe'";
						if(($_POST[operador]=="Eliminar")&&($_POST[$array_name[0]]==$dato[ID_G])){ejecuta($conexion,$res,$phpv);//Echo$res;
							$_POST[operador]="Limpia";
						}
				} 
			}
	}
	if($objeto<>1)		{$objeto=1;		class objeto	{
				function Despliege		($base,$tabla,$conexion,$phpv,$coluna,$array_mysql,$array_name){
					db($base,$conexion,$phpv);
						$col_espe	=	"";//$array_mysql[0];
						$espe		=	"";//$_POST[$array_name[0]];	
						$orde		=	"";
						$dire		=	1;
						$buscar		=	1;
						$consu		=	consulta($tabla,$conexion,$col_espe,$espe,$orde,$dire,$phpv,$buscar);
										mysql_da_se($consu,0,$phpv);
					
					$res=$res."<select class='Medio' name='$name' $libre>";
					if($name2<>'')$res=$res."<OPTION value='$name'>$name2</OPTION>";
						while($datos= mysql_fe_ar($consu,$phpv)){$set='';		
							if($datos[$descarga]==$_POST[$name]){$set='selected';}
							$res=$res."<option value='$datos[$descarga]' $set>$datos[$descarga]</option>";
						}
					$res=$res."</select>";
					return $res;
				}
				function Conte_Centro	($style,$libre,$conte){
					if($libre==""){$libre="id='Conte-pri'";}
					$res=div($style,$libre,$conte);
					return $res;
				}
				function Conte_Info		($base,$tabla,$conexion,$phpv,$size,$style,$title,$id,$libre,$class,$array_text,$array_mysql,$array_type,$array_name,$array_title,$array_value,$array_style,$array_id,$array_libre,$array_class,$array_valida){
					$style_red="border-right-width: 5px;border-right-color: red;	border-bottom-right-radius: 5px;border-top-right-radius: 5px;box-shadow: 1px 1px 1px red;";
					$style_gre="border-right-width: 5px;border-right-color: green;	border-bottom-right-radius: 5px;border-top-right-radius: 5px;box-shadow: 1px 1px 1px green;";
					$style_ora="border-right-width: 5px;border-right-color: orange;	border-bottom-right-radius: 5px;box-shadow: 1px 1px 1px orange;";
					if($size==""){$style="background: rgba(5, 72, 108, 0.67) none repeat scroll 0% 0%; width: 220px; left: 780px; color: white; position: absolute;";}
											$conta=count($array_name);
					if($array_mysql<>"")	$conta=count($array_mysql);
					$array_name=$array_mysql;
					for($x=0; $x<$conta; $x++){if($array_valida[$x]==1)$array_style[$x]=$array_style[$x].$style_ora;}
					if($_POST[$array_name[0]]<>""){//verifica que no existente 	
						db($base,$conexion,$phpv);
						$col_espe	=	$array_mysql[0];
						$espe		=	$_POST[$array_name[0]];	
						$orde		=	"";
						$dire		=	1;
						$buscar		=	1;
						$consu=consulta($tabla,$conexion,$col_espe,$espe,$orde,$dire,$phpv,$buscar);
						$dato=mysql_fe_ar($consu,$phpv);
						if(($dato[$array_mysql[0]]<>"")and($_POST[operador]==Actualizar))$array_type[0]='button';
						if(($dato[$array_mysql[0]]<>"")and($_POST[operador]<>Actualizar)){
							for($x=0; $x<$conta; $x++){
								$_POST[$array_name[$x]]=$dato[$array_mysql[$x]];
								$array_type[$x]='button';
							}
						}
					}
					$res=tablero_array	($size,$style,$title,$id,$libre,$class,$array_text,$array_mysql,$array_type,$array_name,$array_title,$array_value,$array_style,$array_id,$array_libre,$array_class);
					return $res;
				}
				function Conte_Opera	($base,$tabla,$conexion,$phpv,$array_text,$array_mysql,$array_type,$array_name,$array_title,$array_value,$array_style,$array_id,$array_libre,$array_class,$array_valida){
					if($size==""){$style="background: rgba(5, 72, 108, 0.67) none repeat scroll 0% 0%; width: 220px; left: 780px; top: 400px; color: white; position: absolute;";}
											$conta=count($array_name);
					if($array_mysql<>"")	$conta=count($array_mysql);
					$valida=true;
					for($x=0; $x<$conta; $x++){
						if($array_mysql[$x]<>"")	$array_name[$x]=$array_mysql[$x];
						if($array_value[$x]=="")	$array_value[$x]=$_POST[$array_name[$x]];
						if(($array_valida[$x]=="1")&&($array_value[$x]==""))$valida=false;
					}
					if($_POST[$array_name[0]]<>""){//verifica que no existente 	
						db($base,$conexion,$phpv);
						$col_espe	=	$array_mysql[0];
						$espe		=	$_POST[$array_name[0]];	
						$orde		=	"";
						$dire		=	1;
						$buscar		=	1;
						$consu=consulta($tabla,$conexion,$col_espe,$espe,$orde,$dire,$phpv,$buscar);
						$dato=mysql_fe_ar($consu,$phpv);
					}
					$name=operador;
					$v1=Nuevo;
					if ($dato[ID_G]==$_POST[$array_name[0]])	$v2=Modificar;
					if ($dato[ID_G]==$_POST[$array_name[0]])	$v3=Eliminar;
					if ($dato[ID_G]==$_POST[$array_name[0]])	$v4=Actualizar;
																$v5=Guardar;
																$v6=Vaciar;
					if ($_POST[$array_name[0]]==""){$_POST[$name]=$v1;$v2="";$v3="";$v4="";$v6="";}
					if ($valida==false){$v5="";}
					if (($dato[ID_G]==$_POST[$array_name[0]])and($_POST[operador]<>Actualizar))$v5="";	
					$res=menu($style,$libre,$name,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10);
					return $res;
					
				}
				function Conte_Consu	($base,$tabla,$conexion,$phpv,$array_text,$array_mysql,$array_type,$array_name,$array_title,$array_value,$array_style,$array_id,$array_libre,$array_class,$array_valida){	
					$style0="background: rgba(5, 72, 108, 0.67) 				none repeat scroll 0% 0%; overflow: auto; overflow-x:hidden; position: absolute; left: 115px; height: 28px; width: 664px; top: 0px;";
											$conta=count($array_name);
					if($array_mysql<>"")	$conta=count($array_mysql);
					if ($_POST[D_i]==''){$_POST[D_i]=1;}
					if ($_POST[M_i]==''){$_POST[M_i]=date("m");}
					if ($_POST[A_i]==''){$_POST[A_i]=date("Y");}
					if ($_POST[D_f]==''){$_POST[D_f]=31;}
					if ($_POST[M_f]==''){$_POST[M_f]=date("m");}
					if ($_POST[A_f]==''){$_POST[A_f]=date("Y");}
					
					$libre=' onLoad=consulta(); onChange=consulta();';
					$n1="Inicio	".input2(hidden,D_i,'',$_POST[D_i]).despieges(D_i,Dia,1,31,$libre,D_i_des).input2(hidden,M_i,'',$_POST[M_i]).despieges(M_i,Mes,1,12,$libre,M_i_des).input2(hidden,A_i,'',$_POST[A_i]).despieges(A_i,Año,2015,2030,$libre,A_i_des);
					$n2="Fin	".input2(hidden,D_f,'',$_POST[D_f]).despieges(D_f,Dia,1,31,$libre,D_f_des).input2(hidden,M_f,'',$_POST[M_f]).despieges(M_f,Mes,1,12,$libre,M_f_des).input2(hidden,A_f,'',$_POST[A_fs]).despieges(A_f,Año,2015,2030,$libre,A_f_des);
					for($x=1; $x<$conta; $x++){
						if($array_type[$x]==Estatus)		$n3=objeto::Estatus('',Select);
					}
					$title="<table><tr><td>$n1</td><td>$n2</td><td>$n3</td><td>$n4</td></tr></table>";
					$res= div($style0,$libre,$title);
					//------------------------------------------------------
					$style1="background: rgba(5, 72, 108, 0.67) 				none repeat scroll 0% 0%; overflow: auto; overflow-x:hidden; position: absolute; left: 115px; height: 28px; width: 664px; top: 28px;";
					
					//----------------------------------------------------
					db($base,$conexion,$phpv);
					$consu=consulta($tabla,$conexion,'','','',1,$phpv);
					mysql_da_se($consu,0,$phpv);
					$conte="<table><tr>";
					for($x=0; $x<$conta; $x++){
						$d=input2('button',$array_text[$x],"",$array_text[$x]);				
						$conte=$conte."<td>$d</td>";
					}
					$conte=$conte."</tr>";
					while($dato=mysql_fe_ar($consu,$phpv)){	
						$c="";
						$Est=1;
						for($x=1; $x<$conta; $x++){
							if($array_type[$x]==Estatus)	{
								$Est=objeto::Estatus		($dato[$array_mysql[$x]],Identi);
							}

							$d=input2('button',$array_mysql[$x],"",$dato[$array_mysql[$x]]);
							if($array_type[$x]==textarea){$d="<textarea name='$array_name[$x]' title='$array_title[$x]' style='$array_style[$x]' id='$array_id[$x]' class='$array_class[$x]' $array_libre[$x]>$array_value[$x]</textarea>";}
							
							$c=$c."<td>$d</td>";
						}
						$r="<tr>";
						if($Est==3)$r="<tr bgcolor='#343434'>";
						$d=input2(submit,ID_G,"",$dato[ID_G]);
						$r=$r."<td>$d</td>".$c;
						$r=$r."</tr>";
						if($Est==2){$r="";}
						$conte=$conte.$r;
					}
					$conte=$conte."</table>";
					if($style=="")$style="color: white; background: rgba(5, 72, 108, 0.67)	none repeat scroll 0% 0%; overflow: auto; overflow-x: auto; position: absolute; left: 115px; height: 542px; width: 664px; top: 56px;";
					$libre='id="resultado"';
					$res=$res.div($style,$libre,$conte);
					return $res;
				}
				function Conte_Consola	($base,$tabla,$conexion,$phpv,$array_text,$array_mysql,$array_type,$array_name,$array_title,$array_value,$array_style,$array_id,$array_libre,$array_class,$array_valida){
											$conta=count($array_name);
					if($array_mysql<>"")	$conta=count($array_mysql);
					$valida=true;
					for($x=0; $x<$conta; $x++){
						if($array_mysql[$x]<>"")	$array_name[$x]=$array_mysql[$x];
						if($array_value[$x]=="")	$array_value[$x]=$_POST[$array_name[$x]];
						if(($array_valida[$x]<>"")&&($array_value[$x]==""))$valida=false;
					}
					if($_POST[$array_name[0]]<>""){//verifica que no existente 	
						db($base,$conexion,$phpv);
						$col_espe	=	$array_mysql[0];
						$espe		=	$_POST[$array_name[0]];	
						$orde		=	"";
						$dire		=	1;
						$buscar		=	1;
						$consu=consulta($tabla,$conexion,$col_espe,$espe,$orde,$dire,$phpv,$buscar);
						$dato=mysql_fe_ar($consu,$phpv);
					}
					if ($_POST[operador]==Vaciar){
						for($x=0; $x<$conta; $x++){
							$_POST[$array_name[$x]]="";
						}
					}
					if (($dato[ID_G]==$_POST[$array_name[0]])and($_POST[operador]<>Actualizar)and($_POST[operador]<>Guardar))$_POST[operador]=Modificar;
					
				}
				function Estatus		($dato,$menu){
					$Estatus1=Activo;
					$Estatus2=Inactivo;
					$name=menu_Estatus;
					$name2=Estatus;
					if($menu==ver){
						$res=input2(hidden,$name2,"",$_POST[$name2]);
						$sel_visual[0]=$Estatus1;	$sel_value[0]=$Estatus1;
						$sel_visual[1]=$Estatus2;	$sel_value[1]=$Estatus2;
						$res=$res.select($name2,$sel_style,"title=''",1,$sel_value,$sel_visual,$sel_title,$sel_libre2);
					}
					
					if ($dato<>""){
						$res=1;																//elemento activo por antiguedad
						if ($dato==$Estatus1){$res=1;}										//elemento activo por ajuste
						if (($dato==$Estatus2)and($_POST[$name]==Ocultar)){$res=2;}			//elemento oculto 
						if (($dato==$Estatus2)and($_POST[$name]==Mostrar)){$res=3;}			//elemento visible
						
					}
					if ($menu=="Identi"){
						$res=1;
						if ($dato==$Estatus1){$res=1;}
						if (($dato==$Estatus2)and($_POST[$name]==Ocultar)){$res=2;}	
						if (($dato==$Estatus2)and($_POST[$name]==Mostrar)){$res=3;}	
						
					}
					if ($menu=="Select"){
						$res=input2(hidden,$name,"",$_POST[$name]);
						$sel_visual[0]=$sel_value[0]=Ocultar;
						$sel_visual[1]=$sel_value[1]=Mostrar;
						$res=select($name,$sel_style,"title='Elemento Inactivos'",1,$sel_value,$sel_visual,$sel_title,$sel_libre2);
					}
					return $res;
				}	
				function Fecha_re		(){
					if($_POST[Fecha_re]=="")$_POST[Fecha_re]=date("d/m/Y");
					$res=		input2(hidden,Fecha_re,"",$_POST[Fecha_re]);
					$res=$res.	input2('button',Fecha_re,"",$_POST[Fecha_re]);
					return $res;
				}
				function N_Fact			(){
					if($_POST[N_Fact]=="")$_POST[N_Fact]=0;
					$res=		input2(hidden,N_Fact,"",$_POST[N_Fact]);
					$res=$res.	input2('button',N_Fact,"",$_POST[N_Fact]);
					return $res;
				}
				function Lista_mysql	($base,$tabla,$conexion,$phpv,$array,$col,$style){
						//recive datos de la tabla 
						$array_config	=	$array[config];
						$array_text		=	$array[text];
						$array_mysql	=	$array[mysql];
						$array_type		=	$array[type];
						$array_id		=	$array[id];
						$array_class	=	$array[clas];
						$array_valida	=	$array[valid];
						$conta=count($array_mysql);
						$array_name=$array_mysql;
						//Descarga datos 
						db($base,$conexion,$phpv);
						$col_espe	=	'';
						$espe		=	'';
						$orde		=	$array_mysql[$col];
						$dire		=	'';
						$buscar		=	'';
						$consu=consulta($tabla,$conexion,$col_espe,$espe,$orde,$dire,$phpv,$buscar);
						//extructura
						$name=$array_mysql[$col];
						$style="width: 114px;";
						$conte=$conte.	objeto::Select_array_mysql($name,$style,$libre,$col,$consu,$phpv,$array);	
						$style="width: 115px; height: 270px; background: black; top: 25px; position: absolute;  overflow-y: auto; overflow-x: hidden;";
						mysql_da_se		($consu,0,$phpv);
						while($dato=mysql_fe_ar($consu,$phpv)){	
							$Est=1;
							$Est=objeto::Estatus		($dato[$array_config[Estatus]],Identi);
							
							$libre="";
							if($Est==3)										{$libre="background: #343434; color: white;";}
							if($_POST[$name]==$dato[$col])					{$libre='background: black; color: green; box-shadow: 2px 2px green;';}
							if(($Est==3)&&($_POST[$name]==$dato[$col]))		{$libre="background: black; color: red; box-shadow: 2px 2px red;";}
							if(($Est==3)or($Est==1))$res=$res.input2(submit,$name,'',$dato[$col],$libre.' width: 95px;')."<br>";
							
						}
						$conte=$conte.	div($style,$libre,$res);		
						$style="posicion: absolute; width: 115px; height: 300px; background: RGBA(0, 0, 0, 0.76);";
						$res=div($style,$libre,$conte);
					return $res;
				}
				function Select_array($name,$style,$libre,$array_value,$array_title,$array_visua,$array_libre){
					$res=		"<select name='$name' class='Medio' style='$style' $libre>";
					$conta=count($array_name);
					for($x=0; $x<$conta; $x++){
						if($_POST[$name]==$array_value[$x]){$array_libre[$x]=$array_libre[$x]." selected=''";}
						$res=$res."<option value='$array_value[$x]'  title='$array_title[$x]' $array_libre[$x]>$array_visual[$x]</option>";
					}
					$res=$res.	"</select>";	
					return $res;
				}
				function Select_array_mysql($name,$style,$libre,$col,$consu,$phpv,$array){
					
						$array_config	=	$array[config];
						$array_text		=	$array[text];
						$array_mysql	=	$array[mysql];
						$array_type		=	$array[type];
						$array_id		=	$array[id];
						$array_class	=	$array[clas];
						$array_valida	=	$array[valid];
					
					$res=$res.		"<select name='$name' id='$name' title='$_POST[$name]' value='$_POST[$name]' class='Medio' style='$style' $libre>";
					mysql_da_se		($consu,0,$phpv);
					while($dato=mysql_fe_ar($consu,$phpv)){	
					$libre_set="";
						if($_POST[$name]==$dato[$col]){$libre_set="  style='background: #343434; color: white;' selected";}
						$Est=1;
						$Est=objeto::Estatus		($dato[$array_config[Estatus]],Identi);
						
						
						if($Est==3)										{$libre_set="style='background: #343434; color: white;'";}
						if($_POST[$name]==$dato[$col])					{$libre_set="style='background: black; color: green; box-shadow: 2px 2px green;'";}
						if(($Est==3)&&($_POST[$name]==$dato[$col]))		{$libre_set="style='background: black; color: red; box-shadow: 2px 2px red;'";}
						if(($Est==3)or($Est==1))
							$res=$res."<option value='$dato[$col]'  title='$dato[$col]' $array_libre[$x] $libre_set>$dato[$col]</option>";
					}
					$res=$res.	"</select>";	
					return $res;
				}
			} 	


	}
*/
$libre_v1=1;
?>