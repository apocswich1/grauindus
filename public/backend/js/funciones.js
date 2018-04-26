jQuery(document).ready(function($)
{
	'use strict'
    	/**
	 * lightbox imagenes
	 */
	//$('.fullsize').fancybox();
	/**
	 * Confirmacion de eliminar
	 */
     /*
	$('a[href*="/delete/"]').on('click', function(evento)
	{
		return confirm('¿Eliminar este registro?');
	});
    */

 });
 function eliminar(url)
 {
    if(confirm("Realmente desea eliminar este registro?"))
    {
        window.location=url;
    }
 }
 function confirmar(url)
 {
    if(confirm("Realmente desea modificar el acceso a este registro?"))
    {
        window.location=url;
    }
 }
 function carga_ajax(ruta,valor1,valor2,div) 
        {
          // alert(ruta );
           $.post(ruta,{valor1:valor1,valor2:valor2},function(resp)
           {
                $("#"+div+"").html(resp);
           });
        }
        function envia_select(url,id)
        {
            if(id >=1)
            {
                window.location=url+"/"+id;
            }
        }
        function seteaEstadoMensaje(div)
        {
            document.getElementById(div).innerHTML='<i class="icon-ok"></i>';
        }
        
        function ocultar(id){
document.getElementById(id).style.display="none";
}
function mostrar(id){
ocultar("pagos");
ocultar("promociones");
ocultar("contactos");
document.getElementById(id).style.display="block";
}