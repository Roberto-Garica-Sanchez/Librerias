function FocusToNext(e,elemento,name_next){
    var event = window.event ? window.event : e;    
	if (event.keyCode==13){
        if(name_next){
            if(document.getElementById(name_next)){document.getElementById(name_next).focus();}else{console.log('elemento no encontrado');
            }

        }

        event.preventDefault();
	}
}
//los sigientes elemento funciona pero son incompletos 
function EnterToTab(e,elemento) {
    var event = window.event ? window.event : e;
    EnterToTab.fields = EnterToTab.fields || GetIndexTab();
    var teclaCodigo=event.keyCode
    var tecla=String.fromCharCode(teclaCodigo); //obtengo la tecla pura 
    
    if(event.keyCode==13){//Preciona Tecla ENTER
       var tabinde = parseInt(elemento.getAttribute('tabindex'),10);
        console.log(tabinde);
        if ( tabinde+1 < EnterToTab.fields.length ){
            EnterToTab.fields[tabinde+1].focus();
            EnterToTab.fields[tabinde+1].focus();
           }
        event.keyCode=9;//simula Presionar TAB
    }
}
function GetIndexTab(){
    var res = [],//crea un array 
        inpts = document.getElementsByTagName('input'), // lee los elementos 
        i = inpts.length;                               // numenro de elementos
    while (i--){    // mientras hay elemtos 
        var tabinde = parseInt(inpts[i].getAttribute('tabindex'),10),
            txtType = inpts[i].getAttribute('type');
            res[tabinde] = inpts[i];
    }
    return res;
}

    window.onscroll = function (){  
        // En la variable scroll se almacena la posición cada vez que se mueve el scroll
        var scroll = document.documentElement.scrollTop || document.body.scrollTop;
        /*console.log(scroll);*/
        // Con este código puedes hacer que algo suceda entre la posición 300 y 400
        if(document.getElementsByName('menu1') &&  document.getElementById('Menu_pegajoso')){
            if(scroll < 124){
                /*conversion del conteneor del menu*/
                document.getElementById('Menu_pegajoso').className='pegado';
                /*conversion de los elementos del menu */
                    var Elementos=document.getElementsByName('menu1');
                    for (i=0;i<Elementos.length;i++){
                        if(Elementos[i].className=='Boton_menu_adactable_mediano1')
                            Elementos[i].className='Boton_menu_adactable_grande1';
                    } 
            
            }
         }
        if(document.getElementsByName('menu1') &&  document.getElementById('Menu_pegajoso')){
            if(scroll >= 124){
                document.getElementById('Menu_pegajoso').className='flotante';
                var Elementos=document.getElementsByName('menu1');
                for (i=0;i<Elementos.length;i++){
                    if(Elementos[i].className=='Boton_menu_adactable_grande1')
                        Elementos[i].className='Boton_menu_adactable_mediano1';
                } 
                
            }
        }
    }
    /*console.log(document.body.scrollHeight-window.innerHeight); */
