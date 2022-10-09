    <?php

menu_array($menu_array);
function menu_array($array){
    
    $Primariakeys=array_keys($array);
    for ($i=0; $i <count($Primariakeys); $i++) { 
        $keys[$Primariakeys[$i]]=array_keys($array[$Primariakeys[$i]]);;
        $color=rand(100000, 999999);
        $color2=rand(100000, 999999);
        echo"<div style='background: #$color; padding: 15px ;' >";
            #echo $Primariakeys[$i];
            #echo $keys[$Primariakeys[$i]];
            /*
            for ($g=0; $g <count($keys[$Primariakeys[$i]]) ; $g++) { 
                $color=rand(100000, 999999);
                $color2=rand(100000, 999999);
                echo"<div style='background: #$color; padding: 15px ;' >";
                    if(gettype($keys[$Primariakeys[$i]][$g])=='string'){
                        echo $keys[$Primariakeys[$i]][$g];
                    }             
                    if(gettype($keys[$Primariakeys[$i]][$g])=='array'){
                        echo"contine submenu";
                    }    
                echo"</div>";
                
            }*/
            #echo $array[$Primariakeys[$i]];
        echo"</div>";
        
        echo('<pre>');
        print_r($keys[$Primariakeys[$i]]);
        echo('</pre>');  
        
    }
}
function SubMenu(){

}

?>