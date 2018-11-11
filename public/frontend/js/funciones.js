function enviaSelect(vista,valor)
{
    if(valor==0)
    {
        return false;
    }
    switch(vista)
    {
        case 'cotizaciones':
            window.location=webroot+"cotizaciones/search1/"+valor;
        break;
        case 'usuarios':
            switch(valor)
            {
                case '1':
                    window.location=webroot+"usuarios/";
                break;
                 case '2':
                    window.location=webroot+"usuarios/vendedores";
                break;
            }
        break;
        case 'clientes':
            switch(valor)
            {
                case '1':
                    window.location=webroot+"clientes/";
                break;
                 case '2':
                    window.location=webroot+"clientes/activos";
                break;
                case '3':
                    window.location=webroot+"clientes/no_activos";
                break;
            }
        break;
        case 'clientes_cotizacion':
            window.location=webroot+"cotizaciones/clientes/"+valor;
        break;
        case 'materiales':
            switch(valor)
            {
                case '1':
                    window.location=webroot+"materiales/tipo/1";
                break;
                 case '2':
                     window.location=webroot+"materiales/tipo/2";
                break;
                case '3':
                     window.location=webroot+"materiales/tipo/3";
                break;
                case '4':
                     window.location=webroot+"materiales/tipo/4";
                break;
            }
        break;
        case 'productos':
            window.location=webroot+"productos/por_cliente/"+valor;
        break;
        case 'productos_tipo':
            window.location=webroot+"productos/por_tipo/"+valor;
        break;
        case 'molde_tipo':
            window.location=webroot+"moldes/search_tipo/"+valor;
        break;        
    }
}
function descripcion_piezas(idselect,iddetalle){
var piezas_adicionales = document.getElementById(idselect);
var titulo = piezas_adicionales.options[piezas_adicionales.selectedIndex].getAttribute('descripcion');
var s = document.createElement('a');
s.innerHTML = titulo;
document.getElementById(idselect).parentElement.append(s);
}

function redondeo2decimales(numero)
{
var flotante = parseFloat(numero);
var resultado = Math.round(flotante*100)/100;
return resultado;
}
function sumaGrameje()
{
     var valor=document.form.onda.value;
     var uno=document.form.gramaje.value;
     
     uno=parseInt(uno) ;
     var dos=document.form.gramaje2.value;
     dos=parseInt(dos) ;
     var precio1=document.form.precio_onda.value;
     var precio2=document.form.precio_liner.value;
     precio1=parseInt(precio1);
     precio2=parseInt(precio2);
     suma=uno+dos;
     //alert("valor="+valor+"\n"+"uno="+uno+"\n"+"dos="+dos+"\n"+"suma="+suma);
      //calculo el gramaje
      if(valor=="Microcorrugado")
      {
        g=uno*1.3+dos;
      }else
        {
        g=uno*1.37+dos;
        }
                              
     document.form.gramaje_real.value=g;
     //calculo el precio
     gramaje1=uno*1.3;
     
     total=gramaje1+dos;
     
     total1=gramaje1/total*precio1;
     total2=dos/total*precio2;
     //alert("total1="+total1+"\ntotal2="+total2);
     total3=total1+total2+140;
     document.form.precio.value=redondeo2decimales(total3);
     
     
}
 function carga_ajax5(ruta,valor1,div) 
        {
           
           //alert(valor1 );
           $.post(ruta,{valor1:valor1},function(resp)
           {
                $("#"+div+"").html(resp);
           });
           return false;
           
        }

 function carga_ajax_cambio_molde(ruta,valor1,div) 
        {
           
           $("#nm").val(valor1);
           $.post(ruta,{valor1:valor1},function(resp)
           {
               var myObj = $.parseJSON(resp);
               $("#tamano_1").val(myObj.ancho_bobina);
               $("#tamano_2").val(myObj.largo_bobina);
               document.form.tamano_cuchillo_1.value=myObj.cuchillocuchillo;
               document.form.tamano_cuchillo_2.value=myObj.cuchillocuchillo2;
               document.form.ccac_1.value=(parseInt(Math.round(($("#tamano_1").val()-myObj.cuchillocuchillo)*10)));
               document.form.ccac_2.value=(parseInt(Math.round(($("#tamano_2").val()-myObj.cuchillocuchillo2)*10)));
               /*document.form.tamano_1.value=myObj.ancho_bobina;*/
               /*document.form.tamano_2.value=myObj.largo_bobina;*/
               $("#anumeromolde").html(myObj.id);
               $("#anombremolde").html(myObj.nombre);
               $("input[name=nombre_molde]").val(myObj.nombre);
               $("#texto_nm_sugerido").html("Nombre Molde:");
               document.form.unidades_por_pliego_molde.value=myObj.unidades_productos_completos;
               document.form.piezas_totales_molde.value=myObj.piezas_totales;
               document.form.mcm1.value=myObj.medidas_de_las_cajas;
               document.form.mcm2.value=myObj.medidas_de_las_cajas_2;
               document.form.mcm3.value=myObj.medidas_de_las_cajas_3;
               document.form.mcm4.value=myObj.medidas_de_las_cajas_4;
               document.form.mdlc.value=myObj.medidas_de_las_cajas;
               document.form.mdlc2.value=myObj.medidas_de_las_cajas_2;
               document.form.mdlc3.value=myObj.medidas_de_las_cajas_3;
               document.form.mdlc4.value=myObj.medidas_de_las_cajas_4;
               $("#unidades_por_pliego").val(myObj.unidades_productos_completos);
               $("#piezas_totales_en_el_pliego").val(myObj.piezas_totales);
               $("#medidas_de_las_cajas").val(myObj.medidas_de_las_cajas);
               $("#medidas_de_las_cajas_2").val(myObj.medidas_de_las_cajas_2);
               $("#medidas_de_las_cajas_3").val(myObj.medidas_de_las_cajas_3);
               $("#medidas_de_las_cajas_4").val(myObj.medidas_de_las_cajas_4);
               document.form.abobina.value=myObj.ancho_bobina;
               document.form.lbobina.value=myObj.largo_bobina;
               document.form.largo_molde_1.value=myObj.ancho_bobina;
               document.form.largo_molde_2.value=myObj.largo_bobina;
               document.form.numero_de_molde.value=myObj.id;
               document.form.cucu1.value=myObj.cuchillocuchillo;
               document.form.cucu2.value=myObj.cuchillocuchillo2;
               document.form.ccm1.value=myObj.cuchillocuchillo;
               document.form.ccm2.value=myObj.cuchillocuchillo2;
               $("select[name=rango_gramajes]").val(myObj.rango_gramaje);
               if(parseInt($("#tamano_1").val()) > parseInt($("#tamano_2").val())){
                $('#etiquetacontralafibra').html('<label style="background-color:blue; color:#fff; font-size:weight; text-align:center"><h4 style="color:#fff">Impresion contra la fibra</h4></label>');
                }else{
                $('#etiquetacontralafibra').html('');    
                }
           });
           return false;
           
        }   
function enviaSelect2(valor)
{
    if(valor>=1)
    {
        window.location=webroot+"materiales/tipo/"+valor;
    }
}
function enviaClientesProductos(id)
{
    if(id>=1)
    {
        window.location=webroot+"productos_asociados/clientes/"+id;
    }
}
function carga_ajax(ruta,valor1,valor2,div) 
        {
//           alert(ruta );
           $.post(ruta,{valor1:valor1,valor2:valor2},function(resp)
           {
                $("#"+div+"").html(resp);
           });
        }

function carga_ajax_revision_fotomecanica(ruta,valor1,valor2) 
        {
//           alert(ruta );
           $.post(ruta,{valor1:valor1,valor2:valor2},function(resp)
           {
                ///$("#"+div+"").html(resp);
                $('.mensaje').show();
           });
        }
        
function rechazoCotizacion(ruta,valor1,valor2,valor3) 
        {
         //  alert(ruta+' id:'+valor1+' Nro:'+valor2+' Glosa:'+valor3 );
           $.post(ruta,{valor1:valor1,valor2:valor2,valor3:valor3},function(resp)
           {
              // alert(resp);
                $("#liberar").css("visibility","hidden");
                $("#mensajeajaxarriba").html(resp);
                $("#mensajeajax").html(resp);
           });
        }
function carga_ajax15(ruta,valor1,valor2,valor3,div) 
        {
         //  alert(ruta );
           $.post(ruta,{valor1:valor1,valor2:valor2,valor3:valor3},function(resp)
           {
                $("#"+div+"").html(resp);
           });
        }
		
function carga_ajax16(ruta,valor1,valor2,valor3,valor4,div) 
        {
          // alert(ruta );
           $.post(ruta,{valor1:valor1,valor2:valor2,valor3:valor3,valor4:valor4},function(resp)
           {
                $("#"+div+"").html(resp);
           });
        }
		
function carga_ajax3(ruta,valor1,valor2,div) 
        {
           if(valor1==3000)
           {
             $("#"+div+"").html("");
             return false;
           }
          // alert(ruta );
           $.post(ruta,{valor1:valor1,valor2:valor2},function(resp)
           {
                $("#"+div+"").html(resp);
           });
        }   
 function carga_ajax4(ruta,valor1,div) 
        {
            var materialidad=parseInt(valor1);
            if (materialidad==3)
            {
                document.getElementById("div_materialidad_2").style.display='none';
                document.form.materialidad_2.value="0";     
                document.getElementById("div_materialidad_3").style.display='block';                   
            }
            else if (materialidad==4)
            {
                document.getElementById("div_materialidad_2").style.display='none';
                document.form.materialidad_2.value="0";        
                document.getElementById("div_materialidad_3").style.display='none';
                document.form.materialidad_3.value="0";                        
            }            
            else
            {
                document.getElementById("div_materialidad_2").style.display='block';  
                document.getElementById("div_materialidad_3").style.display='block';                  
            }
           $.post(ruta,{valor1:valor1},function(resp)
           {
                $("#"+div+"").html(resp);
           });            
        } 
    
function carga_ajax2(ruta,valor1,div) 
        {
           //alert(valor1);
           if(valor1==0)
           {
                $.post(ruta,{valor1:valor1,valor2:3000},function(resp)
                   {
                        $("#"+div+"").html(resp);
                   });
           }else
           {
               //alert(document.form.cliente.value);
               $.post(ruta,{valor1:valor1,valor2:document.form.cliente.value},function(resp)
               {
                    $("#"+div+"").html(resp);
               });
              
           }
        }        
function formatear(valor,id)
{
    //alert(dar_formato(valor));
    document.getElementById(id).value=dar_formato(valor);
}        
function eliminar(url)
{
    if(confirm("Realmente desea eliminar este registro?"))
    {
        window.location=url;
    }
}
function alpha(e) 
         {
         key = e.keyCode || e.which;
           tecla = String.fromCharCode(key).toLowerCase();
           //alert(key);
           letras = " ÃƒÂ¡ÃƒÂ©ÃƒÂ­ÃƒÂ³ÃƒÂºabcdefghijklmnÃƒÂ±opqrstuvwxyz";
           //especiales = [8,37,39,46];
            especiales = [8,39,46,241,225,233,237,243,250];
           tecla_especial = false
           for(var i in especiales){
                if(key == especiales[i]){
                    tecla_especial = true;
                    break;
                }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
}

function soloNumeros(evt)
{
	key = (document.all) ? evt.keyCode :evt.which;
	//alert(key);
    if(key==17)return false;
	/* digitos,del, sup,tab,arrows*/
	return ((key >= 48 && key <= 57) || key == 8 || key == 127 || key == 9 || key==0);
}


function soloNumerosConPuntos(evt)
{
	key = (document.all) ? evt.keyCode :evt.which;
	//alert(key);
    if(key==17)return false;
	/* digitos,del, sup,tab,arrows*/
	return ((key >= 48 && key <= 57) || key == 8 || key == 127 || key == 9 || key==0 || key==46);
}

function soloNumerosConPuntosYComas(evt)
{
	key = (document.all) ? evt.keyCode :evt.which;
	//alert(key);
    if(key==17)return false;
	/* digitos,del, sup,tab,arrows*/
	document.getElementById(valorAcabado).value = document.getElementById(valorAcabado).value.replace('.',',') 
	return ((key >= 48 && key <= 57) || key == 8 || key == 127 || key == 9 || key==0 || key==188);
}

function espacio_a_guiones(cadena,campo)

{
    
    cadena= cadena.replace(/\s/g,"-");
//alert(cadena);
    document.getElementById(campo).value=cadena;    

}
function cambiaFolia()
{
    var form=document.form;
    if(form.folia.value=="NO")
    {
        form.folia1_proceso_seletec.value = 0;               
        document.getElementById("folia1_proceso").style.display='none';        
        document.getElementById('folia_se_a').style.display='none';
        document.getElementById('folia1_molde_selected').style.display='none';
//        document.getElementById('folia_se_b').style.display='block';
        document.form.folia1_proceso_seletec.value=0; 
        document.form.folia_se.value=0;          
        form.folia_se.value="No Lleva";
        return false;
    }else
    {
        document.getElementById('folia1_proceso').style.display='block';       
        document.getElementById('folia_se_a').style.display='block';
        document.getElementById('folia1_molde_selected').style.display='block';
//        document.getElementById('folia_se_b').style.display='none';
        form.folia_se.value="Nuevo";
        return false;
    }
}
function cambiaFolia2()
{
    var form=document.form;
    
    if(form.folia_2.value=="NO")
    {
        form.folia2_proceso_seletec.selectedIndex = 0;             
        document.getElementById('folia2_proceso').style.display='none';         
        document.getElementById('folia_se_2_a').style.display='none';
        document.getElementById('folia_se_2_b').style.display='block';
        document.getElementById('folia2_molde_selected').style.display='none';
        form.folia_se_2.value="No Lleva";
        document.form.folia2_proceso_seletec.value=0;    
        document.form.folia_se_2.value=0;          
        return false;
    }else
    {
        document.getElementById('folia2_proceso').style.display='block';         
        document.getElementById('folia_se_2_a').style.display='block';
        document.getElementById('folia_se_2_b').style.display='none';
        document.getElementById('folia2_molde_selected').style.display='block';
        form.folia_se_2.value="Nuevo";
        return false;
    }
}

function cambiaFoliaFot2()
{
    var form=document.form;
    
    if(form.folia_2.value=="NO")
    {
        form.folia2_proceso_seletec.selectedIndex = 0;             
        document.getElementById('folia2_proceso').style.display='none';         
        document.getElementById('folia_se_2_a').style.display='none';
        //document.getElementById('folia_se_2_b').style.display='block';
        document.getElementById('folia2_molde_selected').style.display='none';
        form.folia_se_2.value="No Lleva";
        document.form.folia2_proceso_seletec.value=0;    
        document.form.folia_se_2.value=0;          
        return false;
    }else
    {
        document.getElementById('folia2_proceso').style.display='block';         
        document.getElementById('folia_se_2_a').style.display='block';
      //  document.getElementById('folia_se_2_b').style.display='none';
        document.getElementById('folia2_molde_selected').style.display='block';
        form.folia_se_2.value="Nuevo";
        return false;
    }
}
function cambiaFolia3()
{
    var form=document.form;
    if(form.folia_3.value=="NO")
    {
        form.folia3_proceso_seletec.selectedIndex = 0;             
        document.getElementById('folia3_proceso').style.display='none';         
        document.getElementById('folia_se_3_a').style.display='none';
        document.getElementById('folia_se_3_b').style.display='block';
        document.getElementById('folia3_molde_selected').style.display='none';
        form.folia_se_3.value="No Lleva";
        document.form.folia3_proceso_seletec.value=0;   
        document.form.folia_se_3.value=0;           
        return false;
    }else
    {
        document.getElementById('folia3_proceso').style.display='block';         
        document.getElementById('folia_se_3_a').style.display='block';
        document.getElementById('folia_se_3_b').style.display='none';
        document.getElementById('folia3_molde_selected').style.display='block';
        form.folia_se_3.value="Nuevo";
        return false;
    }
}
function cambiaFoliaFot3()
{
    var form=document.form;
    if(form.folia_3.value=="NO")
    {
        form.folia3_proceso_seletec.selectedIndex = 0;             
        document.getElementById('folia3_proceso').style.display='none';         
        document.getElementById('folia_se_3_a').style.display='none';
        document.getElementById('folia3_molde_selected').style.display='none';
        form.folia_se_3.value="No Lleva";
        document.form.folia3_proceso_seletec.value=0;   
        document.form.folia_se_3.value=0;           
        return false;
    }else
    {
        document.getElementById('folia3_proceso').style.display='block';         
        document.getElementById('folia_se_3_a').style.display='block';
        document.getElementById('folia3_molde_selected').style.display='block';
        form.folia_se_3.value="Nuevo";
        return false;
    }
}
function cambiaCuno()
{
    var form=document.form;
    if(form.cuno.value=="NO")
    {
        form.cuno1_proceso_seletec.selectedIndex = 0;             
        document.getElementById('cuno1_proceso').style.display='none';          
        document.getElementById('cuno_se_a').style.display='none';
        document.getElementById('cuno_se_b').style.display='block';
        document.getElementById('cuno1_molde_selected').style.display='none';
        form.folia_se.value="No Lleva";
        document.form.cuno1_proceso_seletec.value=0;  
        document.form.cuno_se.value=0;            
        return false;
    }else
    {
        document.getElementById('cuno1_proceso').style.display='block';          
        document.getElementById('cuno_se_a').style.display='block';
        document.getElementById('cuno_se_b').style.display='none';
        document.getElementById('cuno1_molde_selected').style.display='block';
        form.cuno_se.value="Nuevo";
        return false;
    }
}
function cambiaCunoFot()
{
    var form=document.form;
    if(form.cuno.value=="NO")
    {
        form.cuno1_proceso_seletec.selectedIndex = 0;             
        document.getElementById('cuno1_proceso').style.display='none';          
        document.getElementById('cuno_se_a').style.display='none';
        document.getElementById('cuno1_molde_selected').style.display='none';
        form.folia_se.value="No Lleva";
        document.form.cuno1_proceso_seletec.value=0;  
        document.form.cuno_se.value=0;            
        return false;
    }else
    {
        document.getElementById('cuno1_proceso').style.display='block';          
        document.getElementById('cuno_se_a').style.display='block';
        document.getElementById('cuno1_molde_selected').style.display='block';
        form.cuno_se.value="Nuevo";
        return false;
    }
}
function cambiaCunoIng()
{
    var form=document.form;
    if(form.cuno.value=="NO")
    {
        form.cuno1_proceso_seletec.selectedIndex = 0;             
        document.getElementById('cuno1_proceso').style.display='none';          
        document.getElementById('cuno_se_a').style.display='none';     
        document.getElementById('cuno1_molde_selected').style.display='none';
        form.folia_se.value="No Lleva";
        document.form.cuno1_proceso_seletec.value=0;  
        document.form.cuno_se.value=0;            
        return false;
    }else
    {
        document.getElementById('cuno1_proceso').style.display='block';          
        document.getElementById('cuno_se_a').style.display='block';
        document.getElementById('cuno1_molde_selected').style.display='block';
        form.cuno_se.value="Nuevo";
        return false;
    }
}
function cambiaCuno2()
{
    var form=document.form;
   if(form.cuno_2.value=="NO")
    {
        form.cuno2_proceso_seletec.selectedIndex = 0;             
        document.getElementById('cuno2_proceso').style.display='none';          
        document.getElementById('cuno_se_2_a').style.display='none';
        document.getElementById('cuno_se_2_b').style.display='block';
        document.getElementById('cuno2_molde_selected').style.display='none';
        
        form.folia_se.value="No Lleva";
        document.form.cuno2_proceso_seletec.value=0;    
        document.form.cuno_se_2.value=0;                     
        return false;
    }else
    {
        document.getElementById('cuno2_proceso').style.display='block';          
        document.getElementById('cuno_se_2_a').style.display='block';
        document.getElementById('cuno_se_2_b').style.display='none';
        document.getElementById('cuno2_molde_selected').style.display='block';
        form.cuno_se_2.value="Nuevo";
        return false;
    }
}
function cambiaCunoFot2()
{
    var form=document.form;
   if(form.cuno_2.value=="NO")
    {
        form.cuno2_proceso_seletec.selectedIndex = 0;             
        document.getElementById('cuno2_proceso').style.display='none';          
        document.getElementById('cuno_se_2_a').style.display='none';
        document.getElementById('cuno2_molde_selected').style.display='none';
        
        form.folia_se.value="No Lleva";
        document.form.cuno2_proceso_seletec.value=0;    
        document.form.cuno_se_2.value=0;                     
        return false;
    }else
    {
        document.getElementById('cuno2_proceso').style.display='block';          
        document.getElementById('cuno_se_2_a').style.display='block';
        document.getElementById('cuno2_molde_selected').style.display='block';
        form.cuno_se_2.value="Nuevo";
        return false;
    }
}
function validaParcial()
{
    var can_despacho_1=parseInt(document.form.can_despacho_1.value);
    var can_despacho_2=parseInt(document.form.can_despacho_2.value);
    var can_despacho_3=parseInt(document.form.can_despacho_3.value);
    var suma=can_despacho_1+can_despacho_2+can_despacho_3;
    //alert(suma);
    if(suma>100)
    {
        alert("la suma de las cantidades no debe sumar mas de 100");
        document.form.can_despacho_1.value="";
        document.form.can_despacho_2.value="";
        document.form.can_despacho_3.value="";
        document.form.can_despacho_1.focus();
        return false;
    }
}
function tipoPegado()
{
    var tipo_de_pegado1=document.form.tipo_de_pegado1.value;
    if(tipo_de_pegado1=="No Lleva")
    {
        document.getElementById("pegado").style.display="none";
    }else
    {
        document.getElementById("pegado").style.display="block";
    }
}
function tamano1NoMasDe100()
{
    var tamano_1=parseInt(document.form.tamano_1.value);
    if(tamano_1>100)
    {
        document.form.tamano_1.value="";
        document.form.tamano_1.focus();
        return false;
    }
}
function tamano2NoMasDe100()
{
    var tamano_1=parseInt(document.form.tamano_1.value);
    var tamano_2=parseInt(document.form.tamano_2.value);    
    var tamano_C2=parseInt(document.form.tamano_cuchillo_2.value);    
    if (tamano_2!='')
    {
        if(tamano_2>141)
        {          
            alert("El tamaño del Largo no puede ser mayor a 144");
            document.form.tamano_2.value="";
            document.form.tamano_2.focus();
            return false;
        }        
    }
    if(tamano_1!='')
    {
        if (tamano_1>100)
        {        
            alert("El tamaño del Ancho no puede ser mayor a 100");
            document.form.tamano_1.value="";
            document.form.tamano_1.focus();
            return false;
        }            
    }    
//    if ((tamano_1!='') && (tamano_2!=''))  
//    {
//        if (tamano_1>tamano_2)  
//        {            
//            alert(" El tamaño del Ancho no puede ser mayor al tamaño Largo");
//            document.form.tamano_2.value="";
//            document.form.tamano_2.focus();    
//            return false;        
//        }        
//    }
    if ((tamano_2!='') && (tamano_C2!=''))  
    {
        if ((tamano_2-tamano_C2) < 1)  
        {            
            alert(" Debe haber un minimo de 1 cm en la distancia cuchillo a cuchillo del Largo");
            document.form.tamano_2.value="";
            document.form.tamano_2.focus();    
            return false;        
        }        
    }
}
function cuchillo()
{
    var tamano_1=parseInt(document.form.tamano_1.value);
    var tamano_2=parseInt(document.form.tamano_2.value);
    var tamano_cuchillo_1=parseInt(document.form.tamano_cuchillo_1.value);
    var tamano_cuchillo_2=parseInt(document.form.tamano_cuchillo_2.value);
    //|| tamano_cuchillo_1 >tamano_2 || tamano_cuchillo_2 >tamano_1 || tamano_cuchillo_2 >tamano_2
   // alert(tamano_cuchillo_1);return false;
    if(tamano_cuchillo_1 > tamano_1 )
    {
        alert("Distancia cuchillo a cuchillo debe ser menor que tamaño a imprimir");
        document.form.tamano_cuchillo_1.value="";
        document.form.tamano_cuchillo_1.focus();
        return false;
    }
    if(tamano_cuchillo_1 == tamano_1 )
    {
        alert("Distancia cuchillo a cuchillo debe ser menor que tamaño a imprimir");
        //document.form.tamano_cuchillo_1.value=tamano_1-1;
        document.form.tamano_cuchillo_1.value=0;
        //document.form.tamano_cuchillo_1.focus();
        return false;
    }
    if(tamano_cuchillo_2 > tamano_2 )
    {
        alert("Distancia cuchillo a cuchillo debe ser menor que tamaño a imprimir");
        document.form.tamano_cuchillo_2.value="";
        document.form.tamano_cuchillo_2.focus();
        return false;
    }
    if(tamano_cuchillo_2 == tamano_2 )
    {
        alert("Distancia cuchillo a cuchillo debe ser menor que tamaño a imprimir");
        //document.form.tamano_cuchillo_2.value=tamano_2-1;
        document.form.tamano_cuchillo_2.value=0;
        //document.form.tamano_cuchillo_2.focus();
        return false;
    }
}
function enviarCliente()
{
    var cliente=document.form.cliente.value;
    window.location=webroot+"cotizaciones/buscar2_respuesta/"+cliente;
}
function liberar(valor)
{
    document.form.indicador.value=valor;
    document.form.submit();
}
function llamarDetalleCondicion(id)
{
    var id_cliente=document.form.cliente.value;
    id_cliente=parseInt(id_cliente);
    if (id_cliente==0)
    {
        document.form.condicion_del_producto.value='0';
        document.form.cliente.value='0';        
        alert('Seleccione un Cliente para elegir una repetición');
        return false;
    }
    if(id==0)
    {
        document.getElementById("productos_asociados").innerHTML='';
        document.form.producto.value='';
        document.form.producto_id=0;
        return false;
    }
    if(id==1)
    {
        document.getElementById("div_condicion").style.display='block';
        document.getElementById("productos_asociados").style.display='block';        
        carga_ajax(webroot+'productos/ajax',document.form.cliente.value,'ll1','productos_asociados');
    }
    /*if(id==2)
    {
        document.getElementById("div_condicion").style.display='block';
        carga_ajax(webroot+'productos/ajax',document.form.cliente.value,document.form.condicion_del_producto.value,'productos_asociados');
    }*/
	/*else
    {
        document.getElementById("div_condicion").style.display='none';
        document.getElementById("productos_asociados").innerHTML='';
        document.form.producto.value='';
        document.form.producto_id=0;
    }*/
    if(id==3)
    {
        document.getElementById("div_condicion").style.display='block';
        carga_ajax(webroot+'productos/ajaxProductosGenericos',document.form.cliente.value,'ss','productos_asociados');
    }
}
function asignaNombreProductoSolicitudDeCotizacion(valor,id)
{
    document.form.producto.value=valor;
    document.form.producto_id.value=id;
}
function cambiaBuscador(id)
{
    if(id==1)
    {
        document.getElementById("numero").style.display='none';
        document.getElementById("termino").style.display='block';
        document.getElementById("op").style.display='none';
		document.getElementById("NMolde").style.display='none';
		document.getElementById("NomMolde").style.display='none';
		document.getElementById("tipomolde").style.display='none';
		document.getElementById("NomProducto").style.display='none';
		document.getElementById("NProducto").style.display='none';
        return false;   
    }
    if(id==2)
    {
        document.getElementById("numero").style.display='block';
        document.getElementById("termino").style.display='none';
        document.getElementById("op").style.display='none';
		document.getElementById("NMolde").style.display='none';
		document.getElementById("NomMolde").style.display='none';
		document.getElementById("tipomolde").style.display='none';
		document.getElementById("NomProducto").style.display='none';
		document.getElementById("NProducto").style.display='none';
        return false;   
    }
    if(id==3)
    {
        document.getElementById("numero").style.display='none';
        document.getElementById("termino").style.display='none';
        document.getElementById("op").style.display='block';
		document.getElementById("NMolde").style.display='none';
		document.getElementById("NomMolde").style.display='none';
		document.getElementById("tipomolde").style.display='none';
		document.getElementById("NomProducto").style.display='none';
		document.getElementById("NProducto").style.display='none';
        return false;   
    }
	if(id==4)
    {
        document.getElementById("numero").style.display='none';
        document.getElementById("termino").style.display='none';
        document.getElementById("op").style.display='none';
		document.getElementById("NMolde").style.display='block';
		document.getElementById("NomMolde").style.display='none';
		document.getElementById("tipomolde").style.display='block';
		document.getElementById("NomProducto").style.display='none';
		document.getElementById("NProducto").style.display='none';
        return false;   
    }
	if(id==5)
    {
        document.getElementById("numero").style.display='none';
        document.getElementById("termino").style.display='none';
        document.getElementById("op").style.display='none';
		document.getElementById("NMolde").style.display='none';
		document.getElementById("NomMolde").style.display='block';
		document.getElementById("tipomolde").style.display='block';
		document.getElementById("NomProducto").style.display='none';
		document.getElementById("NProducto").style.display='none';
        return false;   
    }
		if(id==6)
    {
        document.getElementById("numero").style.display='none';
        document.getElementById("termino").style.display='none';
        document.getElementById("op").style.display='none';
		document.getElementById("NMolde").style.display='none';
		document.getElementById("NomMolde").style.display='none';
		document.getElementById("tipomolde").style.display='none';
		document.getElementById("NomProducto").style.display='block';
		document.getElementById("NProducto").style.display='none';
        return false;   
    }
		if(id==7)
    {
        document.getElementById("numero").style.display='none';
        document.getElementById("termino").style.display='none';
        document.getElementById("op").style.display='none';
		document.getElementById("NMolde").style.display='none';
		document.getElementById("NomMolde").style.display='none';
		document.getElementById("tipomolde").style.display='none';
		document.getElementById("NomProducto").style.display='none';
		document.getElementById("NProducto").style.display='block';
        return false;   
    }
}


function aceptaExcedentes()
{
    var form=document.form;
    if(form.acepta_excedentes.value=="SI")
    {
        form.acepta_excedentes_extra.value="Acepta excedentes mas o menos 10%";
        document.getElementById('acepta_excedentes').innerHTML="Acepta excedentes mas o menos 10%";
        return false;
    }
    if(form.acepta_excedentes.value=="NO")
    {
        document.getElementById('acepta_excedentes').innerHTML="Acepta pagar extra por cantidad exacta";
        form.acepta_excedentes_extra.value="Acepta pagar extra por cantidad exacta";
        return false;
    }
}
function detalleDeMuestra()
{
    var form=document.form;
    //alert(form.solicita_muestra.value);
    if(form.solicita_muestra.value=="SI")
    {
        document.getElementById("div_muestra").style.display='block';
       
    }
}
function bloqueo()
{
    var form=document.form;
    //alert(form.solicita_muestra.value);
    if(form.estado.value=="2")
    {
        document.getElementById("div_bloqueo").style.display='block';
    }else
    {
        document.getElementById("div_bloqueo").style.display='none';
    }
}
function enviaCorreo(url)
{
    if(document.formcorreo.mensaje.value==0)
    {
        document.formcorreo.mensaje.value='';
        document.formcorreo.mensaje.focus();
        return false;
    }
        document.formcorreo.url.value=url;
        document.formcorreo.submit();
}
function enviarFotomecanica(valor)
{
    if(valor=="1")
    {
        if(confirm("Realmente desea liberar?"))
        {
            document.form.estado_fotomecanica.value=valor;
        document.form.submit();
        }
    }
    
    
}
function sbif()
{
    document.form.dolar.value=document.form.dolar_actual.value;
    document.form.uf.value=document.form.uf_actual.value;
    document.form.submit();
}
function LiberarSolitiaMuestra(url)
{
    if(confirm("Realmente desea liberar este registro?"))
    {
        window.location=url;
    }
}
function guardarFormulario(valor)
{
    var form=document.form;
    form.estado.value=valor;
    form.submit();
}
function guardarFormularioAdd(valor)
{
  //  alert(valor);
    var form=document.form;
    form.estado.value=valor;
    if(valor=='2')
    {
        document.getElementById('rechazo').style.display='block';
    }else
    {
        document.getElementById('rechazo').style.display='none';
    }
    if(valor=='2' && form.glosa.value=='')
    {
        alert("Debe indicar por qué rechaza");
        form.glosa.value="";
        form.glosa.focus();
        return false;
    }
    
    if(valor=='3')
    {
        form.estado.value=valor;
    }
    
    
    
    if(document.form.estatus_trazado){
      if(form.estatus_trazado.value=="Provisorio"){
        //var confirm = confirm("Desea continuar con el trazado como provisorio ??");
        if(confirm("Desea continuar con el trazado como provisorio ??")){
        form.submit();
        }
      }else{
      form.submit();
      }
    }else{
      form.submit();
    }
}
function guardarFormularioAddconfirm(valor)
{
    
    var form=document.form;
    form.estado.value=valor;
    if(valor=='2')
    {
        document.getElementById('rechazo').style.display='block';
    }else
    {
        document.getElementById('rechazo').style.display='none';
    }
    if(valor=='2' && form.glosa.value=='')
    {
        alert("Debe indicar por qué rechaza");
        form.glosa.value="";
        form.glosa.focus();
        return false;
    }
    
    if(valor=='3')
    {
        form.estado.value=valor;
    }
    
    
    
    form.submit();
}
function guardarFormularioAdd3(valor)
{
  //  alert(valor);
    var form=document.form;
    var fot_lleva_barniz=document.form.fot_lleva_barniz.value;
    //var piezas = document.form.piezas_totales_en_el_pliego.value;
    //var unidades = document.form.unidades_por_pliego.value;
        
      /*  if(parseInt(piezas)<parseInt(unidades)){
            alert("Las piezas totales en el pliego no pueden ser menor a unidades por pliego");
            return false;
        }*/
    form.estado.value=valor;
    if(valor=='2')
    {
        document.getElementById('rechazo').style.display='block';
    }else
    {
        document.getElementById('rechazo').style.display='none';
    }
    if(valor=='2' && form.glosa.value=='')
    {
        alert("Debe indicar por qué rechaza");
        form.glosa.value="";
        form.glosa.focus();
        return false;
    }
    
    if(valor=='3')
    {
        form.estado.value=valor;
    }
    
    if(fot_lleva_barniz=="" || fot_lleva_barniz=="No Se"){
            alert("Debe indicar si lleva barniz");
            return false;
    }
       
    
    form.submit();
}
function guardarFormularioAdd2(valor)
{
  //  alert(valor);
    var form=document.form;
    var t1 = document.getElementById('tamano_1').value;
    var t2 = document.getElementById('tamano_2').value;
    
    form.estado.value=valor;
    if(valor=='2')
    {
        document.getElementById('rechazo').style.display='block';
    }else
    {
        document.getElementById('rechazo').style.display='none';
    }
    if(valor=='2' && form.glosa.value=='')
    {
        alert("Debe indicar por qué rechaza");
        form.glosa.value="";
        form.glosa.focus();
        return false;
    }
    
    if(t1==="" || t1===0 && t2==="" || t2===0){
        alert("Debe tener un tamaño valido para la cartulina");
        return false;
    }
    
    if(valor=='3')
    {
        form.estado.value=valor;
    }
    
    
    var ing_lleva_barniz = document.getElementById('ing_lleva_barniz').value;
    var materialidad = document.getElementById('materialidad').value;
    var materialidad1 = document.getElementById('mate1').value;
    var materialidad2 = document.getElementById('mate2').value;
    var materialidad3 = document.getElementById('mate3').value;
    
    var t1 = document.getElementById('tamano_1').value;
    var t2 = document.getElementById('tamano_2').value;
    
    if(t1==="" || t1===0 && t2==="" || t2===0){
        alert("Debe tener un tamaño valido para la cartulina");
        return false;
    }
    
    if(ing_lleva_barniz==""){
            alert("Debe indicar si lleva barniz");
            return false;
    }
    
    if(valor == 1 && document.getElementById('cdproducto').innerHTML=="Repetición Con Cambios"){
        //var tienecolormodificado = document.getElementById('tiene_color_modificado_ing').value;
        //var numerocolormodificado = document.getElementById('numero_color_modificado_ing').value;
        var tienecolormodificado = $("#tiene_color_modificado_ing").val();
        var numerocolormodificado = $("#numero_color_modificado_ing").val();
        if((tienecolormodificado=="" || typeof tienecolormodificado=="undefined")){
           // alert(numerocolormodificado);
        alert("Debe guardar primero y luego indicar cuantos colores cambia para poder liberar por ser repeticion con cambios");
        return false;
    }}

    if(materialidad=="" || materialidad=="0"){
            alert("Debe completar la materialidad");
    }
    
    if(materialidad==1 || materialidad==2){
        if(materialidad1=="0" || materialidad2=="0" || materialidad3=="0"){
            alert("Debe completar el tipo de material segun la materialidad seleccionada");
      
        }else{
            form.submit();
        }
    }
    if(materialidad==3){
        if(materialidad1=="0" || materialidad3=="0"){
            alert("Debe completar el tipo de material segun la materialidad seleccionada");
      
        }else{
            form.submit();
        }
    }
    if(materialidad==4){
        if(materialidad1=="0"){
            alert("Debe completar el tipo de material segun la materialidad seleccionada");
      
        }else{
            form.submit();
        }
    }
    
}

function comparacion(valor){
 
    document.getElementById('crearlo').value = valor;
    $('#crearlo2').val(valor);
    
    var unidades_por_pliego_ing = $("#unidades_por_pliego_ing").val();
    var uppm = $("#unidades_por_pliego_molde").val();
    var piezas_totales_ing = $("#piezas_totales_ing").val();
    var ptmolde = $("#piezas_totales_molde").val();
    var ccm1 = $("#ccm1").val();
    var ccm2 = $("#ccm2").val();
    var cci1 = $("#cci1").val();
    var cci2 = $("#cci2").val();
    var ancho_ing_1 = $("#ancho_ing_1").val();
    var largo_ing_2 = $("#largo_ing_2").val();
    
    var upcm = $("#upcm").val();
    var ptm = $("#ptm").val();
    var uppi = $("#unidades_por_pliego").val();
    var pti = $("#piezas_totales_en_el_pliego").val();
    var cucu1 = $("#cucu1").val();
    var cucu2 = $("#cucu2").val();
    var largomolde1 = $("#largo_molde_1").val();
    var largomolde2 = $("#largo_molde_2").val();
    var abobina = $("#abobina").val();
    var lbobina = $("#lbobina").val();
    var tamano1 = $("#tamano_1").val();
    var tamano2 = $("#tamano_2").val();
    var mcm1 = $("#mcm1").val();
    var mcm2 = $("#mcm2").val();
    var mcm3 = $("#mcm3").val();
    var mcm4 = $("#mcm4").val();
    var mdlc = $("#mdlc").val();
    var mdlc2 = $("#mdlc2").val();
    var mdlc3 = $("#mdlc3").val();
    var mdlc4 = $("#mdlc4").val();
    var mdlci = $("#medidas_de_las_cajas").val();
    var mdlci2 = $("#medidas_de_las_cajas_2").val();
    var mdlci3 = $("#medidas_de_las_cajas_3").val();
    var mdlci4 = $("#medidas_de_las_cajas_4").val();
    var tamano_cuchillo1 = $("input[name=tamano_cuchillo_1]").val();
    var tamano_cuchillo2 = $("input[name=tamano_cuchillo_2]").val();
    
        
    $("#unidades_por_pliego_ing").val(uppi);
    $("#piezas_totales_ing").val(pti);
    $("#cci1").val(tamano_cuchillo1);
    $("#cci2").val(tamano_cuchillo2);
    $("#ancho_ing_1").val(tamano1);
    $("#largo_ing_2").val(tamano2);
    $("#mci1").val(mdlci);
    $("#mci2").val(mdlci2);
    $("#mci3").val(mdlci3);
    $("#mci4").val(mdlci4);
        
    if(upcm != uppi){
           var a = 1;
           $("#uno").addClass("error");
           $(".unocheck").hide();
    }else{
        var a = 0;
        $(".unocheck").show();
        $("#uno").removeClass("error");
        }
    if(uppm != uppi){
           var a = 1;
           $("#uno").addClass("error");
           $(".unocheck").hide();
    }else{
        var a = 0;
        $(".unocheck").show();
        $("#uno").removeClass("error");
        }

    if(ptmolde != pti){
        var b = 1;
           $("#dos").addClass("error");
           $(".doscheck").hide();
    }else{
    $(".doscheck").show();
    $("#dos").removeClass("error");
    var b = 0;
        }
        
    if((cucu1 != tamano_cuchillo1) || (ccm1 != tamano_cuchillo1) || (cucu2 != tamano_cuchillo2) || (ccm2 != tamano_cuchillo2)){
           var c = 1;
           $("#cuatro").addClass("error");
           $(".cuatrocheck").hide();
    }else{
    var c = 0;
    $(".cuatrocheck").show();
    $("#cuatro").removeClass("error");
    }
    
/*   if(ccm1 != tamano_cuchillo1){
           var c = 1;
           $("#cuatro").addClass("error");
           $(".cuatrocheck").hide();
    }else{
    var c = 0;
    $(".cuatrocheck").show();
    $("#cuatro").removeClass("error");
    }

    if(cucu2 != tamano_cuchillo2){
           var d = 1;
           $("#cuatro").addClass("error");
           $(".cuatrocheck").hide();
    }else{
    var d = 0;
    $(".cuatrocheck").show();
    $("#cuatro").removeClass("error");
        }
    if(ccm2 != tamano_cuchillo2){
           var d = 1;
           $("#cuatro").addClass("error");
           $(".cuatrocheck").hide();
    }else{
    var d = 0;
    $(".cuatrocheck").show();
    $("#cuatro").removeClass("error");
        }*/
    /*alert(abobina+'-'+tamano1);
    alert(tamano1+'-'+largomolde1);
    alert(lbobina+'-'+tamano2);
    alert(tamano2+'-'+largomolde2);*/
    
    if((abobina != tamano1) || (tamano1 != largomolde1) || (lbobina != tamano2) || (tamano2 != largomolde2)){
           var e = 1;
           $("#cinco").addClass("error");
           $(".cincocheck").hide();
    }else{
    var e = 0;
    $(".cincocheck").show();
    $("#cinco").removeClass("error");
        }
/*    if(tamano1 != largomolde1){
           var e = 1;
           $("#cinco").addClass("error");
           $(".cincocheck").hide();
    }else{
    var e = 0;
    $(".cincocheck").show();
    $("#cinco").removeClass("error");
        }
    if(lbobina != tamano2){
           var f = 1;
           $("#cinco").addClass("error");
           $(".cincocheck").hide();
    }else{
    var f = 0;
    $(".checkcinco").show();
    $("#cinco").removeClass("error");
        }
    if(tamano2 != largomolde2){
           var f = 1;
           $("#cinco").addClass("error");
           $(".cincocheck").hide();
    }else{
    var f = 0;
    $(".checkcinco").show();
    $("#cinco").removeClass("error");
        }
     */
    /*alert(mdlc+'-'+mdlci);
    alert(mdlc2+'-'+mdlci2);
    alert(mdlc3+'-'+mdlci3);
    alert(mdlc4+'-'+mdlci4);*/
    if((mdlc != mdlci) || (mdlc2 != mdlci2) || (mdlc3 != mdlci3) || (mdlc4 != mdlci4) || (mcm1 != mdlci) || (mcm2 != mdlci2) || (mcm3 != mdlci3) || (mcm4 != mdlci4)){
           var g = 1;
           $("#tres").addClass("error");
           $(".trescheck").hide();
    }else{
    var g = 0;
    $(".trescheck").show();
    $("#tres").removeClass("error");
}

    /*if((mcm1 != mdlci) || (mcm2 != mdlci2) || (mcm3 != mdlci3) || (mcm4 != mdlci4)){
           var g = 1;
           $("#tres").addClass("error");
           $(".trescheck").hide();
    }else{
    var g = 0;
    $(".trescheck").show();
    $("#tres").removeClass("error");
    }*/
       
    var total = a+b+c+e+g;
    
    if($("#cp").val()=='Nuevo' && $("#nm").val()==1 || $("#nm").val()=='' || $("#nm").val()==11 || $("#nm").val()==12 || $("#nm").val()==13 || $("#nm").val()==14 || $("#nm").val()==15){
        $("#modificarmolde").hide();
        $("#crearlo2").show();
        $("#crearlo").hide();
    }else{
    if(total>0){
        $("#modificarmolde").show();
        $("#crearlo").hide();
        $("#crearlo2").hide();
    }else{
        guardarFormularioAdd2($("#crearlo").val());
        $("#guardar").removeAttr('data-toggle');
        $("#liberar").removeAttr('data-toggle');
        $("#modificarmolde").hide();
        $("#crearlo").show();
        $("#crearlo2").hide();
    }
}
}          


 
function guardarFormularioAddo(valor)
{
    document.getElementById('crearlo').value = valor;
    document.getElementById('crearlo2').value = valor;
}
function rechazarFormularioAdd(id)
{
    var glosa = document.getElementById('contenido6').value;   
    var estado = 2;
     if(glosa=='')
    {
        document.getElementById('rechazo').style.display='block';
        alert("Debe indicar por qué rechaza");
        return false;
    }else
    {    
        rechazoCotizacion(webroot+'cotizaciones/rechazar_cotizacion',id,estado,glosa);
    }
        
    
}
function fn_cb_totalOparcial(id,div)
{
    if(id=="Total")
    {
        document.getElementById(div).style.display='none';
    }else
    {
        document.getElementById(div).style.display='block';
    }
}
function creaMolde(id)
{
    switch(id)
    {
        case 'SI':
            document.getElementById("elije_molde").style.display='none';
            document.getElementById("crea_molde").style.display='block';
        break;
        case 'NO':
            document.getElementById("elije_molde").style.display='block';
            document.getElementById("crea_molde").style.display='none';
        break;
    }
}
function hacerTroquelIngenieria(id)//81486954 //27151987 13350 2014 // 
{
    if(id=="NO")
    {
        document.getElementById("metros_de_cuchillo").readOnly = true;
    }else
    {
        document.getElementById("metros_de_cuchillo").readOnly = false;
    }
    
}
function pegadoyAdhesivos2(id)//81486954 //27151987 13350 2014 // 
{
    //alert(id);
    
    if(id=="2")//Latex Consigomismo
    {
        document.getElementById("lleva_aletas").style.display = "block";
        document.getElementById("total_aplicaciones_adhesivo").style.display = "block";
    }else
    {
        document.getElementById("lleva_aletas").style.display = "none";
        document.getElementById("total_aplicaciones_adhesivo").style.display = "none";
    }
    
}
function pegadoyAdhesivos(id)
{
    
    if(id=="3")
    {
        document.getElementById("pegado_manual").style.display = "block";
    }else
    {
        document.getElementById("pegado_manual").style.display = "none";
    }
    if(id=="2")
    {
        document.getElementById("lleva_aletas").style.display = "block";
        document.getElementById("total_aplicaciones_adhesivo").style.display = "block";
    }else
    {
        document.getElementById("lleva_aletas").style.display = "none";
        document.getElementById("total_aplicaciones_adhesivo").style.display = "none";
    }
    
}
function alpha_con_numeros(e){
       key = e.keyCode || e.which;
     
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " Ã¡Ã©Ã­Ã³ÃºabcdefghijklmnÃ±opqrstuvwxyz1234567890";
     
        especiales = [8,39,45,46,241,225,233,237,243,250,9,13,64];
       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
function llevaBarnizFotomecanica2()
{
    var lleva_barniz=document.form.lleva_barniz.value;
    var acabado_impresion_1=document.form.acabado_impresion_1.value;
    if(acabado_impresion_1=='100')
    {
        document.getElementById('reserva_barniz').style.display='block';
        document.form.reserva_barniz.value='SI';
        document.form.lleva_barniz.value='SI';
        return false;
       
    }else
    {
        document.getElementById('reserva_barniz').style.display='none';
        document.form.lleva_barniz.value='NO';
        return false;
    }
}
function llevaBarnizFotomecanica()
{
    var lleva_barniz=document.form.lleva_barniz.value;
    if(lleva_barniz=='SI')
    {
        document.getElementById('reserva_barniz').style.display='block';
        document.form.reserva_barniz.value='SI';
        return false;
    }else
    {
        document.getElementById('reserva_barniz').style.display='none';
        document.form.reserva_barniz.value='NO';
        return false;
    }
}
function moldeparaingenieria()
{
    var estan_los_moldes=document.form.estan_los_moldes.value;
    var hacer_troquel=document.form.hacer_troquel.value;
    var lleva_troquelado=document.form.lleva_troquelado.value;
    if(lleva_troquelado=='NO')
    {
        document.form.estan_los_moldes.value='NO';
        document.form.hacer_troquel.value='NO';
        document.form.molde.value ='8371';
        document.getElementById('estan_los_moldes').style.display='none';
        document.getElementById('hacer_troquel').style.display='none';
        document.getElementById('crea_molde').style.display='none';
        return false;
    }else
    {
        document.getElementById('estan_los_moldes').style.display='block';
        document.getElementById('hacer_troquel').style.display='block';
        document.getElementById('crea_molde').style.display='block';
        return false;
    }
}

function llevafondo(id)
{

    if(id=='SI')
    {
        document.form.troquel_por_atras.value='NO';
	document.form.troquel_por_atras.disabled = false;
         $("select[name=troquel_por_atras] option[value='SI']").attr("disabled",true);
        return false;
    }else if(id=='NO')
    {
		document.form.troquel_por_atras.value='SI';
		document.form.troquel_por_atras.disabled = false;
                $("select[name=troquel_por_atras] option[value='SI']").attr("disabled",false);
	        return false;
    }else{
        document.form.troquel_por_atras.value='';
		document.form.troquel_por_atras.disabled = false;
                $("select[name=troquel_por_atras] option[value='SI']").attr("disabled",false);
	        return false;
    }
}
function igualar()
{	
	
        if(document.form.igualar_direccion.checked == true)
      {
        alert("Sausage goes well with peppers.");
      }
}  


function colores_barniz(id)
{	

    if(id >= '1')
    {
        document.form.lleva_barniz.value='SI';
        return false;
    }
}


function nuevaParaTroquel()
{
    var lleva_troquelado=document.form.lleva_troquelado.value;
    var hacer_troquel=document.form.hacer_troquel.value;
    var estan_los_moldes=document.form.estan_los_moldes.value;
    if(lleva_troquelado=='SI' || hacer_troquel=='SI')
    {
        document.form.estan_los_moldes.value='NO';
    }else
    {
        document.form.estan_los_moldes.value='SI';
    }
}
function procesosInternos()
{
    var acabado_impresion_1=document.form.acabado_impresion_1.value;
    var acabado_impresion_2=document.form.acabado_impresion_2.value;
    var acabado_impresion_3=document.form.acabado_impresion_3.value;
    if(acabado_impresion_1==acabado_impresion_2)
    {
        alert("No se pueden repetir los acabados internos");
        document.form.acabado_impresion_1.value='16';
        document.form.acabado_impresion_2.value='16';
        document.form.acabado_impresion_3.value='16';
        document.getElementById('kilos_externo_1').style.display='none';          
        document.getElementById('kilos_externo_2').style.display='none';          
        document.getElementById('kilos_externo_3').style.display='none';   
        document.form.input_variable_externo_1.value='0';        
        document.form.input_variable_externo_2.value='0';   
        document.form.input_variable_externo_3.value='0';           
        return false;
    }
    if(acabado_impresion_1==acabado_impresion_3)
    {
        alert("No se pueden repetir los acabados internos");
        document.form.acabado_impresion_1.value='16';
        document.form.acabado_impresion_2.value='16';
        document.form.acabado_impresion_3.value='16';
        document.getElementById('kilos_externo_1').style.display='none';          
        document.getElementById('kilos_externo_2').style.display='none';          
        document.getElementById('kilos_externo_3').style.display='none';   
        document.form.input_variable_externo_1.value='0';        
        document.form.input_variable_externo_2.value='0';   
        document.form.input_variable_externo_3.value='0';           
        return false;
    }
    if(acabado_impresion_3==acabado_impresion_2)
    {
        alert("No se pueden repetir los acabados internos");
        document.form.acabado_impresion_1.value='16';
        document.form.acabado_impresion_2.value='16';
        document.form.acabado_impresion_3.value='16';
        document.getElementById('kilos_externo_1').style.display='none';          
        document.getElementById('kilos_externo_2').style.display='none';          
        document.getElementById('kilos_externo_3').style.display='none';   
        document.form.input_variable_externo_1.value='0';        
        document.form.input_variable_externo_2.value='0';   
        document.form.input_variable_externo_3.value='0';           
        return false;
    }
}

function BuscarMoldesRegistradosCliente(valor_campo,div) 
{
    if(valor_campo!='')
    {    
        carga_ajax_BuscarFormaPagoCliente(webroot+'cotizaciones/BuscarMoldesRegistradosCliente',valor_campo,div);
    }
}


function procesosExternos()
{
    var acabado_impresion_4=document.form.acabado_impresion_4.value;
    var acabado_impresion_5=document.form.acabado_impresion_5.value;
    var acabado_impresion_6=document.form.acabado_impresion_6.value;
    if(acabado_impresion_4==acabado_impresion_5 && acabado_impresion_4!="")
    {
        alert("No se pueden repetir los acabados externos");
        document.form.acabado_impresion_4.value='17';
        document.form.acabado_impresion_5.value='17';
        document.form.acabado_impresion_6.value='17';
        document.getElementById('kilos_externo_4').style.display='none';          
        document.getElementById('kilos_externo_5').style.display='none';          
        document.getElementById('kilos_externo_6').style.display='none';   
        document.form.input_variable_externo_4.value='0';        
        document.form.input_variable_externo_5.value='0';   
        document.form.input_variable_externo_6.value='0';           
        return false;
    }
    if(acabado_impresion_4==acabado_impresion_6 && acabado_impresion_4!="")
    {
        alert("No se pueden repetir los acabados externos");
        document.form.acabado_impresion_4.value='17';
        document.form.acabado_impresion_5.value='17';
        document.form.acabado_impresion_6.value='17';
        document.getElementById('kilos_externo_4').style.display='none';          
        document.getElementById('kilos_externo_5').style.display='none';          
        document.getElementById('kilos_externo_6').style.display='none';   
        document.form.input_variable_externo_4.value='0';        
        document.form.input_variable_externo_5.value='0';   
        document.form.input_variable_externo_6.value='0';         
        return false;
    }
    if(acabado_impresion_6==acabado_impresion_5 && acabado_impresion_6!="")
    {
        alert("No se pueden repetir los acabados externos");
        document.form.acabado_impresion_4.value='17';
        document.form.acabado_impresion_5.value='17';
        document.form.acabado_impresion_6.value='17';
        document.getElementById('kilos_externo_4').style.display='none';          
        document.getElementById('kilos_externo_5').style.display='none';          
        document.getElementById('kilos_externo_6').style.display='none';   
        document.form.input_variable_externo_4.value='0';        
        document.form.input_variable_externo_5.value='0';   
        document.form.input_variable_externo_6.value='0';         
        return false;
    }
}


function estanLosMoldess(id)
{
    if(id=='NO')
    {
        document.form.molde_registrado.value="0";  
        document.form.molde_generico.value="0";
        document.form.select_estan_los_moldes_genericos.value="NO";
        document.form.select_estan_los_moldes_no_genericos_clientes.value="NO";        
        document.form.select_estan_los_moldes.value="NO";          
        document.getElementById('div_estan_los_moldes').style.display='block';
        document.getElementById('div_estan_los_moldes_generico').style.display='none';
        document.getElementById('div_estan_los_moldes_clientes').style.display='none';
    }
    else if (id=='MOLDE GENERICO')
    {

        document.form.molde_registrado.value="0";        
        document.form.select_estan_los_moldes_genericos.value="SI";
        document.form.select_estan_los_moldes_no_genericos_clientes.value="NO";        
        document.form.select_estan_los_moldes.value="MOLDE GENERICO";          
        document.getElementById('div_estan_los_moldes').style.display='none';
        document.getElementById('div_estan_los_moldes_generico').style.display='block';
        document.getElementById('div_estan_los_moldes_clientes').style.display='none'; 
    }
    else if (id=='SI')
    {

        document.form.molde_registrado.value="0";        
        document.form.select_estan_los_moldes_genericos.value="SI";
        document.form.select_estan_los_moldes_no_genericos_clientes.value="NO";        
        document.form.select_estan_los_moldes.value="MOLDE GENERICO";          
        document.getElementById('div_estan_los_moldes').style.display='none';
        document.getElementById('div_estan_los_moldes_generico').style.display='block';
        document.getElementById('div_estan_los_moldes_clientes').style.display='none'; 
    }
    else if (id=='MOLDE REGISTRADOS DEL CLIENTE')
    {

        document.form.molde_generico.value="0";
        document.form.select_estan_los_moldes_genericos.value="NO";
        document.form.select_estan_los_moldes_no_genericos_clientes.value="SI";        
        document.form.select_estan_los_moldes.value="MOLDE REGISTRADOS DEL CLIENTE";    
        document.getElementById('div_estan_los_moldes').style.display='none';
        document.getElementById('div_estan_los_moldes_generico').style.display='none';
        document.getElementById('div_estan_los_moldes_clientes').style.display='block';  
    }      
}
function estanLosMoldesPropia(id)
{
    if(id=='NO')
    {
        document.form.molde_registrado.value="0";  
        document.form.molde_generico.value="0";
/*        document.form.select_estan_los_moldes_genericos.value="NO";*/
 /*       document.form.select_estan_los_moldes_no_genericos_clientes.value="NO";        */
        document.form.select_estan_los_moldes.value="NO";          
        document.getElementById('div_estan_los_moldes').style.display='block';
        document.getElementById('div_estan_los_moldes_generico').style.display='none';
        document.getElementById('div_estan_los_moldes_clientes').style.display='none';
        document.getElementById('distanciacc').style.display='block';
        document.getElementById('calccac').style.display='block';
        document.getElementById('lacortar').style.display='block';
        document.getElementById('rccac').style.display='block';
        document.getElementById('distancia_en_molde').style.display='block';
        document.getElementById('lacortar2').style.display='none';
        document.getElementById('botones2').style.display='block';
        document.getElementById('botones').style.display='none';
        document.getElementById('cdproducto').innerHTML='Nuevo';
    }
    else if(id=='NO LLEVA')
    {
        document.form.molde_registrado.value="0";  
        document.form.molde_generico.value="0";
        document.form.hay_que_troquelar.value="NO";
        document.form.tamano_cuchillo_1.value="";
        document.form.tamano_cuchillo_2.value="";
        document.form.ccac_1.value="";
        document.form.ccac_2.value="";
     /*   document.form.select_estan_los_moldes_genericos.value="NO";*/
     /*   document.form.select_estan_los_moldes_no_genericos_clientes.value="NO";        */
        document.form.nombre_molde.value="";          
        document.form.select_estan_los_moldes.value="NO LLEVA";          
        document.getElementById('div_estan_los_moldes').style.display='block';
        document.getElementById('div_estan_los_moldes_generico').style.display='none';
        document.getElementById('div_estan_los_moldes_clientes').style.display='none';
        document.getElementById('distanciacc').style.display='none';
        document.getElementById('calccac').style.display='none';
        document.getElementById('lacortar').style.display='none';
        document.getElementById('rccac').style.display='none';
        document.getElementById('distancia_en_molde').style.display='none';
        document.getElementById('lacortar2').style.display='block';
        document.getElementById('botones2').style.display='block';
        document.getElementById('botones').style.display='none';
        document.getElementById('cdproducto').innerHTML='Nuevo';
    }
    else if (id=='MOLDE GENERICO')
    {
        document.form.molde_registrado.value="0"; 
        document.form.hay_que_troquelar.value="SI";
     /*   document.form.select_estan_los_moldes_genericos.value="SI";*/
     /*   document.form.select_estan_los_moldes_no_genericos_clientes.value="NO";        */
        document.form.select_estan_los_moldes.value="MOLDE GENERICO";          
        document.getElementById('div_estan_los_moldes').style.display='block';
        document.getElementById('div_estan_los_moldes_generico').style.display='block';
        document.getElementById('div_estan_los_moldes_clientes').style.display='none'; 
        document.getElementById('distanciacc').style.display='block';
        document.getElementById('calccac').style.display='block';
        document.getElementById('lacortar').style.display='block';
        document.getElementById('rccac').style.display='block';
        document.getElementById('distancia_en_molde').style.display='block';
        document.getElementById('lacortar2').style.display='none';
        document.getElementById('botones').style.display='block';
        document.getElementById('botones2').style.display='none';
        document.getElementById('cdproducto').innerHTML='Repetición Con Cambios';
    }
    else if (id=='SI')
    {

        document.form.molde_registrado.value="0";   
        document.form.hay_que_troquelar.value="SI";
   /*     document.form.select_estan_los_moldes_genericos.value="SI";*/
   /*     document.form.select_estan_los_moldes_no_genericos_clientes.value="NO";        */
        document.form.select_estan_los_moldes.value="MOLDE GENERICO";          
        document.getElementById('div_estan_los_moldes').style.display='block';
        document.getElementById('div_estan_los_moldes_generico').style.display='block';
        document.getElementById('div_estan_los_moldes_clientes').style.display='none'; 
        document.getElementById('distanciacc').style.display='block';
        document.getElementById('calccac').style.display='block';
        document.getElementById('lacortar').style.display='block';
        document.getElementById('rccac').style.display='block';
        document.getElementById('distancia_en_molde').style.display='block';
        document.getElementById('lacortar2').style.display='none';
        document.getElementById('botones').style.display='block';
        document.getElementById('botones2').style.display='none';
        document.getElementById('cdproducto').innerHTML='Repetición Con Cambios';
    }
    else if (id=='MOLDE REGISTRADOS DEL CLIENTE')
    {
        document.form.molde_generico.value="0";
        document.form.hay_que_troquelar.value="SI";
    /*    document.form.select_estan_los_moldes_genericos.value="NO";*/
    /*    document.form.select_estan_los_moldes_no_genericos_clientes.value="SI";        */
        document.form.select_estan_los_moldes.value="MOLDE REGISTRADOS DEL CLIENTE";    
        document.getElementById('div_estan_los_moldes').style.display='block';
        document.getElementById('div_estan_los_moldes_generico').style.display='none';
        document.getElementById('div_estan_los_moldes_clientes').style.display='block';  
        document.getElementById('distanciacc').style.display='block';
        document.getElementById('calccac').style.display='block';
        document.getElementById('lacortar').style.display='block';
        document.getElementById('rccac').style.display='block';
        document.getElementById('distancia_en_molde').style.display='block';
        document.getElementById('lacortar2').style.display='none';
        document.getElementById('botones').style.display='block';
        document.getElementById('botones2').style.display='none';
    }      
    else if (id=='CLIENTE LO APORTA')
    {
        document.form.molde_generico.value="0";
        document.form.hay_que_troquelar.value="SI";
   /*     document.form.select_estan_los_moldes_genericos.value="NO";*/
    /*    document.form.select_estan_los_moldes_no_genericos_clientes.value="NO";        */
        document.form.select_estan_los_moldes.value="CLIENTE LO APORTA";    
        document.getElementById('div_estan_los_moldes').style.display='block';
        document.getElementById('div_estan_los_moldes_generico').style.display='none';
        document.getElementById('div_estan_los_moldes_clientes').style.display='block';  
        document.getElementById('distanciacc').style.display='block';
        document.getElementById('calccac').style.display='block';
        document.getElementById('lacortar').style.display='block';
        document.getElementById('rccac').style.display='block';
        document.getElementById('distancia_en_molde').style.display='block';
        document.getElementById('lacortar2').style.display='none';
        document.getElementById('botones').style.display='block';
        document.getElementById('botones2').style.display='none';
    }      
}

function estanLosMoldes2(id)
{
    if(id=='NO')
    {
        document.getElementById('molde_select').style.visibility='hidden';
        document.getElementById('crea_molde').style.display='block';
		document.getElementById('metroDeCuchillo').style.display='block';
        return false;
    }
    if(id=='SI')
    {
		document.getElementById('molde_select').style.visibility='initial';
        document.getElementById('crea_molde').style.display='none';
		document.getElementById('metroDeCuchillo').style.display='none';
        return false; 
    }
    if(id=='NO LLEVA' || id=='CLIENTE LO APORTA')
    {
        document.getElementById('molde_select').style.visibility='hidden';
        document.getElementById('crea_molde').style.display='none';
		document.getElementById('metroDeCuchillo').style.display='none';
        return false; 
    }
}


function cotizaciones_grupales(id)
{
	
    if(id=='NO')
    {
		document.getElementById('grupales').style.visibility='hidden';
		document.getElementById('grupales_numero_cotizacion').style.visibility='hidden';   
        return false;
    }
	
	if(id=='SI')
    {
		document.getElementById('grupales').style.visibility='hidden';
		document.getElementById('grupales_numero_cotizacion').style.visibility='initial';   
        return false;
    }
	
    if(id=='Primera')
    {        
	document.getElementById('grupales').style.visibility='initial';   
	document.getElementById('grupales_numero_cotizacion').style.visibility='hidden';   
        return false; 
    }

}

/***************órdenes de producción anexas************************/
function listaOrdenes(ruta,valor1,valor2,valor3,div)
{
    //var valor1=parseInt(valor1) ;
    if(valor1=='NO')
    {
        document.getElementById(div).innerHTML='';
        return false;
    }
    carga_ajax15(ruta,valor1,valor2,valor3,div);
}
function hayEnStock(id)
{
    if(id=='NO')
    {
        document.getElementById('stock_2').style.display='block';
        document.getElementById('stock_1').style.display='none';
        if(document.form.stock_opciones.value=='comprar')
        {
            document.getElementById('stock_3').style.display='block';
        }else
        {
            document.getElementById('stock_3').style.display='none';
        }
        return false;
    }else
    {
        document.getElementById('stock_1').style.display='block';
        document.getElementById('stock_2').style.display='none';
        document.getElementById('stock_3').style.display='none';
        return false;
    }
}
function hayEnStock2(id)
{
    if(id=='comprar')
    {
        document.getElementById('stock_3').style.display='block';
        return false;
    }else
    {
        document.getElementById('stock_3').style.display='none';
        return false;
    }
}
function verificarCosto()
{
    var vf, ve, vc1, vc2, r1=1;
    var vf2, ve2, vc3, vc4, r2=1;
    var vf3, ve3, vc5, vc6, r3=1;
    var vf4, ve4, vc7, vc8, r4=1;
    
    vf = document.getElementById('vf1').value;    
    ve = document.getElementById('ve1').value;    
    vf2 = document.getElementById('vf2').value;    
    ve2 = document.getElementById('ve2').value;    
    vf3 = document.getElementById('vf3').value;    
    ve3 = document.getElementById('ve3').value;    
    vf4 = document.getElementById('vf4').value;    
    ve4 = document.getElementById('ve4').value;    

    if (vf > ve){
        vc2 = vf * 0.03;
        vc1 = vf - ve;
        if (vc1 > vc2) {
            if (confirm('Está seguro de que desea continuar con este margen de valor empresa? Solamente se guardara la hoja de costos.')) {
           //     form.submit();
           //     prevent.default;
           r1 = 1;
            }else{
              r1=0;  
            }
         //   prevent.default;
        }
    }
        if(vf < ve){
            vc2 = vf * 0.20;
            vc1 = ve - vf;
            if (vc1 > vc2) {
            if (confirm('Está seguro de que desea continuar con este margen superior a 20% entre valor financiero y valor empresa?  Solamente se guardara la hoja de costos.')) {
            //    form.submit();
              //  prevent.default;
              r1=1;
            }else{
              r1=0;  
            }
          //  prevent.default;
        }
        }
        
        
        if (vf2 > ve2){
        vc4 = vf2 * 0.03;
        vc3 = vf2 - ve2;
        if (vc3 > vc4) {
            if (confirm('Está seguro de que desea continuar con este margen de valor empresa 2?  Solamente se guardara la hoja de costos.')) {
           //     form.submit();
           //     prevent.default;
           r2=1;
            }else{
              r2=0;  
            }
         //   prevent.default;
        }
    }
    
    
     if(vf2 < ve2){
            vc4 = vf2 * 0.20;
            vc3 = ve2 - vf2;
            if (vc3 > vc4) {
            if (confirm('Está seguro de que desea continuar con este margen superior a 20% entre valor financiero2 y valor empresa2?  Solamente se guardara la hoja de costos.')) {
            //    form.submit();
              //  prevent.default;
              r2=1;
            }else{
              r2=0;  
            }
          //  prevent.default;
        }
        }
        
        if (vf3 > ve3){
        vc6 = vf3 * 0.03;
        vc5 = vf3 - ve3;
        if (vc5 > vc6) {
            if (confirm('Está seguro de que desea continuar con este margen de valor empresa 3?  Solamente se guardara la hoja de costos.')) {
           //     form.submit();
           //     prevent.default;
           r3=1;
            }else{
              r3=0;  
            }
         //   prevent.default;
        }
    }
    
    
     if(vf3 < ve3){
            vc6 = vf3 * 0.20;
            vc5 = ve3 - vf3;
            if (vc5 > vc6) {
            if (confirm('Está seguro de que desea continuar con este margen superior a 20% entre valor financiero2 y valor empresa3?  Solamente se guardara la hoja de costos.')) {
            //    form.submit();
              //  prevent.default;
              r3=1;
            }else{
              r3=0;  
            }
          //  prevent.default;
        }
        }
        
    
    if (vf4 > ve4){
        vc8 = vf4 * 0.03;
        vc7 = vf4 - ve4;
        if (vc7 > vc7) {
            if (confirm('Está seguro de que desea continuar con este margen de valor empresa 4?  Solamente se guardara la hoja de costos.')) {
           //     form.submit();
           //     prevent.default;
           r4=1;
            }else{
              r4=0;  
            }
         //   prevent.default;
        }
    }
    
    
     if(vf4 < ve4){
            vc8 = vf4 * 0.20;
            vc7 = ve4 - vf4;
            if (vc7 > vc8) {
            if (confirm('Está seguro de que desea continuar con este margen superior a 20% entre valor financiero2 y valor empresa4?  Solamente se guardara la hoja de costos.')) {
            //    form.submit();
              //  prevent.default;
              r4=1;
            }else{
              r4=0;  
            }
          //  prevent.default;
        }
        }
    
    //alert(r1+'-'+r2+'-'+r3+'-'+r4);
    if(r1==1 && r2==1 && r3==1 && r4==1 || $r4==1){
        form.submit();
    }
         
}

function distanciakm(x){
    if(x=='SI'){
        $("#distanciadiv").show();
    }else{
        $("#distanciadiv").hide();
    }
}

function verificarCosto2()
{
    var vf2, ve2, vc3, vc4, r1;
    
    vf2 = document.getElementById('vf2').value;    
    ve2 = document.getElementById('ve2').value;    
   

    if (vf2 > ve2){
        vc4 = vf2 * 0.03;
        vc3 = vf2 - ve2;
        if (vc3 > vc4) {
            if (confirm('Está seguro de que desea continuar con este margen de valor empresa?  Solamente se guardara la hoja de costos.')) {
           //     form.submit();
           //     prevent.default;
            }
         //   prevent.default;
        }
    }
        if(vf2 < ve2){
            vc4 = vf2 * 0.20;
            vc3 = ve2 - vf2;
            if (vc3 > vc4) {
            if (confirm('Está seguro de que desea continuar con este margen superior a 20% entre valor financiero y valor empresa?  Solamente se guardara la hoja de costos.')) {
            //    form.submit();
              //  prevent.default;
            }
          //  prevent.default;
        }
        }
    
  
}

function guardarHCP()
{
    $("#copia").val(0);
    $("#imprimir").val(0);
    
    form.submit();
    
    //verificarCosto2();

}
function guardarHC()
{
    $("#copia").val(0);
    $("#imprimir").val(0);
    
    verificarCosto();
    
    //verificarCosto2();

}

function guardarHCI(vf,ve)
{
    $("#copia").val(0);
    $("#imprimir").val(1);
    
    verificarCosto(vf, ve);
    
    if(confirm('Está seguro de que desea guardar e Imprimir la Hoja de Costos?'))
        form.submit();
    {window.print();
    }
}

function guardarHCIP()
{
    $("#copia").val(0);
    $("#imprimir").val(1);
    
    if(confirm('Está seguro de que desea guardar e Imprimir la Hoja de Costos?'))
        form.submit();
    {window.print();
    }
}
function guardarHCI2(vf,ve)
{
    $("#copia").val(0);
    $("#imprimir").val(1);
    
    
    if(confirm('Está seguro de que desea Imprimir la Hoja de Costos?'))
    {
        window.print();
       // form.submit();
    }
    
}
//verificarCosto(document.getElementById('vf1').value,document.getElementById('ve1').value);
function copiarHC()
{
    $("#copia").val(1);
    if(confirm('Está seguro de que desea copiar la Hoja de Costos?'))
    {
        form.submit();
    }
}
function copiarHCP()
{
    $("#copia").val(1);
    if(confirm('Está seguro de que desea copiar la Hoja de Costos?'))
    {
        form.submit();
    }
}

function printDiv2(x) 
{alert(x);
  javascript:print('http://localhost/trabajo/public/frontend/js'+x);
}

function imprentaProgramacion(id)
{
    if(id=='Externo')
    {
        document.getElementById('proveedor').style.display='block';
        return false;
    }else
    {
        document.getElementById('proveedor').style.display='none';
        return false;
    }
}
function condicionParaMoldes(id)
{
    
    if(id=='1')
    {
        document.form.estan_los_moldes.value='SI';
        document.getElementById('molde_select').style.display='block';
        return false;
    }else
    {
        document.form.estan_los_moldes.value='NO';
        document.getElementById('molde_select').style.display='none';
        return false;
    }
	
}
	
	function ValidarNombreProducto()
		{	
		document.getElementById("div_condicion").style.display='block';
		carga_ajax(webroot+'productos/validarNombreProductoExistente',document.form.producto.value,'Nuevo','productos_asociados');		
		 /*if(confirm(''))
			{

			}*/
		}
	
	
	function ValidarCantidadesDeAcuerdoRangoMargenCotizados(id)
		{	
		//document.getElementById("div_condicion").style.display='block';
		//alert("I am an alert box! "+id);
		carga_ajax(webroot+'cotizaciones/validarCantidadesMargen',document.form.cantidad_de_cajas.value,id,'cantidades_margen');		
		
		}

		
		
	function ValidarPreciosDeAcuerdoRangoMargenCotizados(id)
		{	
		//carga_ajax(webroot+'cotizaciones/validarValoresMargen',document.form.cantidad_de_cajas.value,id,'Confirma_precio');		
		carga_ajax15(webroot+'cotizaciones/validarValoresMargen',document.form.cantidad_de_cajas.value,id,document.form.precio.value,'Confirma_precio');	
		}	
		
		
		
	function ValidarCantidadesDeAcuerdoRangoMargenCotizadosOP(id)
		{	
		//document.getElementById("div_condicion").style.display='block';
		//alert("I am an alert box! "+id);
		carga_ajax(webroot+'cotizaciones/validarCantidadesMargen',document.form.cantidad_pedida.value,id,'cantidades_margen');		
		
		}		
		
					
	function ValidarPreciosDeAcuerdoRangoMargenCotizadosOP(id)
		{	
		//carga_ajax(webroot+'cotizaciones/validarValoresMargen',document.form.cantidad_de_cajas.value,id,'Confirma_precio');		
		carga_ajax15(webroot+'cotizaciones/validarValoresMargen',document.form.cantidad_pedida.value,id,document.form.valor.value,'Confirma_precio');	
		}	
		
function condicionParaMoldesGenericos(id)
{
    
    if(id=='MOLDE GENERICO')
    {
        document.form.estan_los_moldes.value="SI";
		document.getElementById("estan_los_moldes_generico").style.display='block';
		document.getElementById("molde_select").style.display='block';
		document.getElementById("estan_los_moldes").style.display='none';
        return false;
    }
	
	if(id=='NO')
    {
        document.form.estan_los_moldes1.value="NO";
		document.getElementById("estan_los_moldes_generico").style.display='none';
		document.getElementById("molde_select").style.display='none'
		
        document.getElementById("estan_los_moldes").style.display='block';
        return false;
    }
	
}		





function llamarlink(id)
{      
		var idd = id;
		//id2 = id;
	//	document.getElementById("link3").innerHTML =id2;	
		//document.getElementById("link3").innerHTML =id;
		//document.getElementById("link2").style.display='block';	   
        return false;   	
		
}


function Repajax(id)
{
	if(id >= 1)
    {
        carga_ajax(webroot+'productos/ajaxlink',id,'ll1','productos_asociados2');
		
	}
}

function Repajax2(id)
{
	if(id >= 1)
    {
        carga_ajax(webroot+'productos/ajaxlink',id,'ll1','productos_asociados3');
		
	}
}

		
function ClienteFaltaDatos()
{
  alert('El cliente no contiene Todos los datos o NO esta Activo: Primero complete los datos de contacto antes de emitir la O.C');
}	
		
		
		
function cromalin(id)
{
    $("#notificacion_colores").html("<strong>Total de Colores:"+(id)+" </strong>");  
    if(id >= 4)
    {
        //document.getElementById("dir").checked = true;
        document.getElementById("dir").disabled  = true;
        document.getElementById("dir").value  = 'SI';
        return false;
    }else
    {
        //document.getElementById("dir").checked = false;
        document.getElementById("dir").disabled  = false;
        document.getElementById("dir").value  = 'NO';
        return false;
    }
}
	

function PiezasTotales(id)
{   
   // alert('id es '+id);
   
	var b = document.getElementById("unidades_por_pliego").value;
    //alert('id es '+b);
    if(id < b)
    {
		alert('Piezas totales en el pliego no puede ser menor a Unidades por pliego ');
		//document.piezas_totales_en_el_pliego.value = b;	
		document.getElementById("piezas_totales_en_el_pliego").value = b;
        return false;
    }	
}

function validar_listado()
		{	
		
		
				id2 =document.getElementById("modulo_lista").value;
				//carga_ajax(webroot+'produccion/validarListadoProduccionPorModulo',document.getElementById("nop").value,id2,'cuerpo_listado');		
				carga_ajax16(webroot+'produccion/validarListadoProduccionPorModulo',document.getElementById("nop").value,id2,document.getElementById("Buscar_estado").value,document.getElementById("vendedor").value,'cuerpo_listado');		
					
				if(id2=='Bodega Trato pegado')
				{        
					document.getElementById("titulo1").style.display='block';
					document.getElementById("desde").style.display='block';
					document.getElementById("hasta").style.display='block';
					document.getElementById("operadores").style.display='block';
					return false;
				}else{
					document.getElementById("titulo1").style.display='none';
					document.getElementById("desde").style.display='none';
					document.getElementById("hasta").style.display='none';
					document.getElementById("operadores").style.display='none';
					document.getElementById("Buscar_estado1").style.display='none';
					document.getElementById("Buscar_estado1").style.display='none';
					document.getElementById("vendedor1").style.display='none';
				}
				
				
				if(id2=='Listado Control Cartulina' || id2=='Listado Control Onda' || id2=='Listado Control Liner' || id2=='Listado Bobinado Cartulina')
				{        
					document.getElementById("Buscar_estado1").style.display='block';
					document.getElementById("vendedor1").style.display='block';
				
					return false;
				}
		
	}

	
	

function Parcial(id)
{
    
    if(id=='Parcial')
    {        
		document.getElementById("totaloparcial").style.display='block';
		
		document.getElementById("btnliberar").disabled = true;
		document.getElementById("btnparcial").disabled = false;
        return false;
    }else{
		document.getElementById("totaloparcial").style.display='none';
		
		document.getElementById("btnliberar").disabled = false;
		document.getElementById("btnparcial").disabled = true;
	}

}	



function validar_fechas_bodega()
		{	
				if(document.getElementById("modulo_lista").value =='Bodega Trato pegado')
				{        
			      carga_ajax16(webroot+'produccion/validarListadoProduccionPorModulo',document.getElementById("fecha1").value,document.getElementById("modulo_lista").value,document.getElementById("fecha2").value,document.getElementById("operador").value,'cuerpo_listado');		
			
					
					return false;
				}else{
				
				}
		
		}



//control cartulina Estado seleccion de gramaje
function ControlGranajeSeleccionado(id)
{
  //carga_ajax(webroot+'produccion/BuscarKilosCartulina',id,document.getElementById("gramaje_seleccionado").value,'hola');	
	   carga_ajax15(webroot+'produccion/BuscarKilosCartulina',id,document.getElementById("gramaje_seleccionado").value,document.getElementById("ancho_seleccionado_de_bobina").value,'hola');			
}	
function ControlGranajeSeleccionado2(id)
{
  //carga_ajax(webroot+'produccion/BuscarKilosCartulina',id,document.getElementById("gramaje_seleccionado").value,'hola');	
	   carga_ajax15(webroot+'produccion/BuscarKilosCartulina',id,document.getElementById("gramaje_seleccionado2").value,document.getElementById("ancho_seleccionado_de_bobina2").value,'hola');			
}	

function ControlGranajeSeleccionado3(id)
{
  //carga_ajax(webroot+'produccion/BuscarKilosCartulina',id,document.getElementById("gramaje_seleccionado").value,'hola');  
     carga_ajax15(webroot+'produccion/BuscarKilosCartulina',id,document.getElementById("gramaje_seleccionado3").value,document.getElementById("ancho_seleccionado_de_bobina3").value,'hola');     
} 


//control onda Estado seleccion de gramaje
function ControlGramajeSeleccionadoOnda(id)
{
	    //alert('id es '+document.getElementById("gramaje_seleccionado").value);
	  //carga_ajax(webroot+'produccion/BuscarKilosOnda',id,document.getElementById("gramaje_seleccionado").value,'hola');	
      carga_ajax15(webroot+'produccion/BuscarKilosOnda',id,document.getElementById("gramaje_seleccionado").value,document.getElementById("ancho_seleccionado_de_bobina").value,'hola');			
}	

//control Liner Estado seleccion de gramaje
function ControlGramajeSeleccionadoLiner(id)
{
	    //alert('id es '+document.getElementById("gramaje_seleccionado").value);
	  //carga_ajax(webroot+'produccion/BuscarKilosOnda',id,document.getElementById("gramaje_seleccionado").value,'hola');	
      carga_ajax15(webroot+'produccion/BuscarKilosLiner',id,document.getElementById("gramaje_seleccionado").value,document.getElementById("ancho_seleccionado_de_bobina").value,'hola');			
}






function ValidarPegado(id)
{
    
    if(id=='NO')
    {        
		document.getElementById("lleva_aletas").style.display="block";
		document.getElementById("doblado").style.display="block";
		document.getElementById("empaquetado").style.display="block";
		document.getElementById("tamano_pieza_a_empaquetar").style.display="block";
		
		document.getElementById("adhesivo").style.display="none";
		document.getElementById("total_aplicaciones_adhesivo").style.display="none";
		document.getElementById("pegado_manual").style.display="none";
		document.getElementById("pegado_puntos").style.display="none";
		document.getElementById("cm_pegado_puntos").style.display="none";
		document.getElementById("tipo_fondo").style.display="none";
		document.getElementById("es_para_maquina").style.display="none";
		
		

    }else{
	    document.getElementById("lleva_aletas").style.display="none";
		document.getElementById("doblado").style.display="none";
		document.getElementById("empaquetado").style.display="none";
		document.getElementById("tamano_pieza_a_empaquetar").style.display="none";
		
		
		document.getElementById("adhesivo").style.display="block";
		document.getElementById("total_aplicaciones_adhesivo").style.display="block";
		document.getElementById("pegado_manual").style.display="block";
		document.getElementById("pegado_puntos").style.display="block";
		document.getElementById("cm_pegado_puntos").style.display="block";
		document.getElementById("tipo_fondo").style.display="block";
		document.getElementById("es_para_maquina").style.display="block";
		
	}

}
/*Validamos rut en el formulario clientes Ing Jaime Suarez*/
function ValidarRut(rut)
{	
    carga_ajax(webroot+'clientes/validarRut',document.form.rut.value,rut,'rut');		
}

function iradespacho(id)
{	
    var s = document.getElementById('despacho').getAttribute('dato');
   // alert(id+s);
     window.location=webroot+'produccion/guia_despachos/'+id+'/'+s;
    
}
function iradespacho2(id)
{	
    var s = document.getElementById('despacho1').getAttribute('dato');
   // alert(id+s);
     window.location=webroot+'produccion/guia_despachos/'+id+'/'+s;
    
}


/*FOMULARIO COTIZACIONES  Ing Jaime Suarez*/

/*Busca la forma de pago del cliente  Ing Jaime Suarez*/

function carga_ajax_BuscarFormaPagoCliente(ruta,valor,div) 
{
   $.post(ruta,{valor:valor},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}

function carga_ajax_productos_extras(ruta,valor,div) 
{
    //alert(webroot+ruta);
   $("#reporte").val(valor);
   $("#rutareporte").val(ruta);
   
   $.post(webroot+ruta,{valor:valor},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}

function carga_ajax_productos_extras_gen(ruta,valor,div) 
{
    //alert(webroot+ruta);
   $("#reporte").val(valor);
   $("#rutareporte").val(ruta);
   
   $.post(webroot+ruta,{valor:valor},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}

function desbloquear_orden(valor) 
{
    if($("#password").val()=="789789"){
  var boton = '<input type="button" value="Liberar" class="btn btn-warning" onclick="guardarFormularioAdd(1);" />';
  $("#mensajeorden").html(boton);
  $("#exampleModal").hide();
  $(".modal-backdrop").remove();
  $("#candado").hide();
}else{
    $("#password").val('');
    alert('Su clave es invalida');
    $("#mensajevalidacion").text('Su clave es invalida');
}
}

function BuscarFormaPagoCliente(valor_campo,div)
{  
    if(valor_campo!='')
    {    
        carga_ajax_BuscarFormaPagoCliente(webroot+'cotizaciones/BuscarFormaPagoCliente',valor_campo,div);
    }
}

/*Busca el vendedor asignado al cliente  Ing Jaime Suarez*/

function carga_ajax_BuscarVendedorCliente(ruta,valor,div) 
{
   $.post(ruta,{valor:valor},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}

function BuscarBuscarVendedorCliente(valor_campo,div)
{  
    if(valor_campo!='')
    {      
        carga_ajax_BuscarVendedorCliente(webroot+'cotizaciones/BuscarBuscarVendedorCliente',valor_campo,div);
    }    
}

function ver_archivo_cliente()
{
  if (document.getElementById('cliente_entrega_1').checked) 
  {
        document.getElementById('archivo_cliente').style.display='block';
  } else {
        document.getElementById('archivo_cliente').style.display='none';
  }
}


function ver_informacion(id) 
{
    var e = document.getElementById(id);
    if (e.style.display == 'block' || e.style.display=='')
    {
        e.style.display = 'none';
        $("#segunda_bobina_adicional_kilos").val(0);
        $("#tercera_bobina_adicional_kilos").val(0);
        $("#cuarta_bobina_adicional_kilos").val(0);
    }
    else 
    {
        e.style.display = 'block';
    }
}

function ver_informacion_bobinas(id) 
{
    var e = document.getElementById(id);
    e.style.display = 'block';
}


/*Busca Acabado Impresión Externo es de tipo kilo  Ing Jaime Suarez*/
function carga_ajax_obtenerInfo(valor,div) 
{
   var ruta=webroot+'cotizaciones/ajax_obtenerInfo';
   document.getElementById(div).style.display='block';   
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}


function carga_ajax_obtenerInfoProcesos(valor,div) 
{
    
   var ruta=webroot+'cotizaciones/ajax_obtenerInfoProcesos';
   document.getElementById(div).style.display='block';   
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}

function carga_ajax_obtenerInfoPiezas(valor,div) 
{
   var ruta=webroot+'cotizaciones/ajax_obtenerInfoPiezas';
   document.getElementById(div).style.display='block';   
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}

function carga_ajax_obtenerInfoTrabajosInternos(valor,div) 
{
   var ruta=webroot+'cotizaciones/ajax_obtenerInfoTrabajosInternos';
   document.getElementById(div).style.display='block';   
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}

function carga_ajax_obtenerKilos(valor,div) 
{
   var ruta=webroot+'cotizaciones/ajax_obtenerKilos';
   document.getElementById(div).style.display='block';   
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}


function hoja_cost_campo() { 

    if(!confirm("Desea Actualizar la Cantidad?")) { 

           if(!confirm(" Esta seguro?.")) {return false;} 
              else {
//               alert("hola");
               return false;
             }   

      }

}

function costoadicional() { 
$("#valormio").html();
    alert($(this));
}

function carga_ajax_obtenerGramaje(valor,div) 
{
    if(valor=="no_hay"){
       // alert(valor);
        $("#gramaje_seleccionado").val("0");
        $("#kilos_bobina_seleccionada").val("0");
        $("#ancho_seleccionado_de_bobina").val("0");
        $("#hay_que_bobinar").val("");
        $("#bobinar_ancho_cartulina1").val("");
        $("#bobinar_ancho_cartulina2").val("");
        $("#bobinar_ancho_cartulina3").val("");
        $("#segunda_bobina_adicional_ancho").val("");
        $("#segunda_bobina_adicional_kilos").val("");
        $("#tercera_bobina_adicional_ancho").val("");
        $("#tercera_bobina_adicional_ancho").val("");
        $("#cuarta_bobina_adicional_ancho").val("");
        $("#cuarta_bobina_adicional_ancho").val("");
        $("#kilos_orden_a_bobinar").val("");
        $("#total_metros").val("");
        $("#unidades_por_pliego").val("");
        $("#numero_de_bobina").val("");
        $("#total_de_bobinas").val("");
        $("#quien_sabe_ubicacion_de_la_bobina").val("");
    }else{
        
   var ruta=webroot+'produccion/ajax_obtenerGramaje';
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
    }
}
function carga_ajax_obtenerGramaje2(valor,div) 
{
    if(valor=="no_hay"){
       // alert(valor);
        $("#gramaje_seleccionado").val("0");
        $("#kilos_bobina_seleccionada").val("0");
        $("#ancho_seleccionado_de_bobina").val("0");
        $("#hay_que_bobinar").val("");
        $("#bobinar_ancho_cartulina1").val("");
        $("#bobinar_ancho_cartulina2").val("");
        $("#bobinar_ancho_cartulina3").val("");
        $("#segunda_bobina_adicional_ancho").val("");
        $("#segunda_bobina_adicional_kilos").val("");
        $("#tercera_bobina_adicional_ancho").val("");
        $("#tercera_bobina_adicional_ancho").val("");
        $("#cuarta_bobina_adicional_ancho").val("");
        $("#cuarta_bobina_adicional_ancho").val("");
        $("#kilos_orden_a_bobinar").val("");
        $("#total_metros").val("");
        $("#unidades_por_pliego").val("");
        $("#numero_de_bobina").val("");
        $("#total_de_bobinas").val("");
        $("#quien_sabe_ubicacion_de_la_bobina").val("");
    }else{
   var ruta=webroot+'produccion/ajax_obtenerGramaje2';
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
    }
}

function carga_ajax_obtenerGramaje3(valor,div) 
{
    if(valor=="no_hay"){
       // alert(valor);
        $("#gramaje_seleccionado").val("0");
        $("#kilos_bobina_seleccionada").val("0");
        $("#ancho_seleccionado_de_bobina").val("0");
        $("#hay_que_bobinar").val("");
        $("#bobinar_ancho_cartulina1").val("");
        $("#bobinar_ancho_cartulina2").val("");
        $("#bobinar_ancho_cartulina3").val("");
        $("#segunda_bobina_adicional_ancho").val("");
        $("#segunda_bobina_adicional_kilos").val("");
        $("#tercera_bobina_adicional_ancho").val("");
        $("#tercera_bobina_adicional_ancho").val("");
        $("#cuarta_bobina_adicional_ancho").val("");
        $("#cuarta_bobina_adicional_ancho").val("");
        $("#kilos_orden_a_bobinar").val("");
        $("#total_metros").val("");
        $("#unidades_por_pliego").val("");
        $("#numero_de_bobina").val("");
        $("#total_de_bobinas").val("");
        $("#quien_sabe_ubicacion_de_la_bobina").val("");
    }else{
   var ruta=webroot+'produccion/ajax_obtenerGramaje3';
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
    }
}



function lleva_mica(valor,div) 
{
   var ruta=webroot+'produccion/ajax_obtenerGramaje';
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}


function CalculoIngenieria()
{
     var unidad_de_conversion=document.form.unidad_de_conversion.value;
     var valor_venta=document.form.valor_venta.value;
     unidad_de_conversion=parseInt(unidad_de_conversion) ;
     valor_venta=parseInt(valor_venta);     
     if ((unidad_de_conversion>0)&&(valor_venta>0))
     {         
        document.form.calculo_ingenieria.value=(valor_venta/unidad_de_conversion);
     }
 }


function migrar()
{
    alert("Proceso de migracion puede tardar unos minutos espere...");
 }


function multiplicarPliegos()
{
     var cantidad_a_imprimir=document.form.cantidad_a_imprimir.value;
     var total_pliegos_buenos=document.form.total_pliegos_buenos.value;
     cantidad_a_imprimir=parseInt(cantidad_a_imprimir);
     total_pliegos_buenos=parseInt(total_pliegos_buenos);     
     if ((cantidad_a_imprimir>=0)&&(total_pliegos_buenos>=0))
     {         
        document.form.total_pliegos_malos.value=(cantidad_a_imprimir-total_pliegos_buenos);
     }
 }


function llevaFondoCotizacion(id)
{
    if(id=='NO')
    {
        document.getElementById('fondo_select').style.display='block';
    }else
    {
        document.form.proceso_fondo.value="";          
        document.getElementById('fondo_select').style.display='none';
        var e = document.getElementById('que_es_esto');
        if (e.style.display == 'block' || e.style.display=='')
        {
            e.style.display = 'none';
        }        
    }
}


function calculo_ccac()
{
    var tamano_cuchillo_1=document.form.tamano_cuchillo_1.value;
    var tamano_1=document.form.tamano_1.value;
    var tamano_cuchillo_2=document.form.tamano_cuchillo_2.value;
    var tamano_2=document.form.tamano_2.value;  
    var lleva_fondo_negro=document.form.lleva_fondo_negro.value;
    var fondo_otro_color=document.form.fondo_otro_color.value;
    
    if((lleva_fondo_negro=='NO') || (fondo_otro_color=='NO'))    //es menor a 29
    {
        if((tamano_cuchillo_1!='') && (tamano_cuchillo_2!=''))
        {
            if((tamano_1!='') && (tamano_2!=''))
            {
                total_medida1=(tamano_1-tamano_cuchillo_1)*10;
                total_medida2=(tamano_2-tamano_cuchillo_2)*10;
                document.form.ccac_1.value=total_medida1;
                document.form.ccac_2.value=total_medida2;
                if (total_medida1<=6)
                {
                    div="msg_imagen_impresion";
                    $("#"+div+"").html("<strong>Distancia CCAC Invalida</strong>");

                } 
                if ((total_medida1>6) && (total_medida1<=19))
                {                
                    if ((total_medida1>6) && (total_medida1<=11))
                    {
                        div="msg_imagen_impresion";
                        $("#"+div+"").html("<strong>Tipo de Troquelado: Manual</strong>"); 
//                        alert("Troquelado Manual"); 
                     }
                    if (total_medida1>11)
                    {
                        div="msg_imagen_impresion";
                        $("#"+div+"").html("<strong>Tipo de Troquelado: Automatico</strong>"); 

                    }
                }
                else
                {
                    div="msg_imagen_impresion";
                    $("#"+div+"").html("<strong>Tipo de Troquelado: Automatico</strong>"); 

                }                    
                    
            }
        }        
    }
    else 
    {
        if((tamano_cuchillo_1!='') && (tamano_cuchillo_2!=''))
        {
            if((tamano_1!='') && (tamano_2!=''))
            {
                total_medida1=(tamano_1-tamano_cuchillo_1)*10;
                total_medida2=(tamano_2-tamano_cuchillo_2)*10;
                document.form.ccac_1.value=total_medida1;
                document.form.ccac_2.value=total_medida2;   
                var ccacminima = $("#ccac_o").val();
                if (total_medida1< $("#ccac_o").val())
                {
//                    document.form.tamano_cuchillo_1.value=0;    
//                    document.form.tamano_cuchillo_2.value=0;  
//                    document.form.ccac_1.value=0;                      
//                    document.form.ccac_2.value=0;
                    div="msg_imagen_impresion";
                   /* $("#"+div+"").html("<strong>El calculo ccac no puede ser menor a "+ccacminima);    */
                   // $("#ccacmin").html('<h4 style="color:green">Distancia '+ccacminima+'</h4>');
                   // alert("El calculo ccac no puede ser menor a "+ccacminima);                     
                }
            }
        }
    }        
        
        
}

function calculos_ccac()
{
    var tamano_cuchillo_1=document.form.tamano_cuchillo_1.value;
    var tamano_1=document.form.tamano_1.value;
    var tamano_cuchillo_2=document.form.tamano_cuchillo_2.value;
    var tamano_2=document.form.tamano_2.value;  
    var lleva_fondo_negro=document.form.lleva_fondo_negro.value;
    var fondo_otro_color=document.form.fondo_otro_color.value;
    
    if((lleva_fondo_negro=='NO') || (fondo_otro_color=='NO'))    //es menor a 29
    {
        if((tamano_cuchillo_1!='') && (tamano_cuchillo_2!=''))
        {
            if((tamano_1!='') && (tamano_2!=''))
            {
                total_medida1=(tamano_1-tamano_cuchillo_1)*10;
                total_medida2=(tamano_2-tamano_cuchillo_2)*10;
                document.form.ccac_1.value=total_medida1;
                document.form.ccac_2.value=total_medida2;
                if (total_medida1<=6)
                {
                    div="msg_imagen_impresion";
                    $("#"+div+"").html("<strong>Distancia CCAC Invalida</strong>");

                } 
                if ((total_medida1>6) && (total_medida1<=19))
                {                
                    if ((total_medida1>6) && (total_medida1<=11))
                    {
                        div="msg_imagen_impresion";
                        $("#"+div+"").html("<strong>Tipo de Troquelado: Manual</strong>"); 
//                        alert("Troquelado Manual"); 
                     }
                    if (total_medida1>11)
                    {
                        div="msg_imagen_impresion";
                        $("#"+div+"").html("<strong>Tipo de Troquelado: Automatico</strong>"); 

                    }
                }
                else
                {
                    div="msg_imagen_impresion";
                    $("#"+div+"").html("<strong>Tipo de Troquelado: Automatico</strong>"); 

                }                    
                    
            }
        }        
    }
    else 
    {
        if((tamano_cuchillo_1!='') && (tamano_cuchillo_2!=''))
        {
            if((tamano_1!='') && (tamano_2!=''))
            {
                total_medida1=(tamano_1-tamano_cuchillo_1)*10;
                total_medida2=(tamano_2-tamano_cuchillo_2)*10;
                document.form.ccac_1.value=total_medida1;
                document.form.ccac_2.value=total_medida2;   
                if (total_medida1<29)
                {
                    document.form.tamano_cuchillo_1.value=0;    
                    document.form.tamano_cuchillo_2.value=0;  
                    document.form.ccac_1.value=0;                      
                    document.form.ccac_2.value=0;
                    div="msg_imagen_impresion";
                    $("#"+div+"").html("<strong>No puede ser menor a 29 Tiene fondo</strong>");                     
                }
            }
        }
    }        
        
        
}

function msg_fondo()
{
    var lleva_fondo_negro=document.form.lleva_fondo_negro.value;
    var fondo_otro_color=document.form.fondo_otro_color.value;
    var imagen_impresion=document.form.imagen_impresion.value;    
    if((lleva_fondo_negro=='SI') || (fondo_otro_color=='SI'))
    {
        div="msg_lleva_fondo_negro";
        $("#"+div+"").html("<strong>No puede ser menor a 29 Tiene fondo</strong>");
    }
    else if((lleva_fondo_negro=='NO') && (fondo_otro_color=='NO') && (imagen_impresion=='AL CORTE'))
    {
        div="msg_lleva_fondo_negro";
        $("#"+div+"").html("<strong>No puede ser menor a 20 Tiene fondo</strong>");
    }    
    else
    {
        div="msg_lleva_fondo_negro";
        $("#"+div+"").html("");        
    }
}

function Hay_Que_Bobinar_Carutlina(id)
{
    var tamano_a_imprimir_2=document.form.tamano_a_imprimir_2.value;     
    if(id=='NO')
    {
        document.getElementById('ancho_bobina_seleccionado_bobinar').style.display='none';
         document.form.bobinar_ancho_cartulina1.value=0;
         document.form.bobinar_ancho_cartulina2.value=0;
         document.form.bobinar_ancho_cartulina3.value=0; 
         document.form.kilos_orden_a_bobinar.value=0;
         document.form.bobinar_ancho_cartulina1.value=0;         
    }
    else
    {
     if (tamano_a_imprimir_2<=0)
     {
        document.form.hay_que_bobinar.value='Seleccione';         
        alert("Tamaño a imprimir Tiene que ser mayor que cero");
        return false;          
     }
     else
     {
        document.getElementById('ancho_bobina_seleccionado_bobinar').style.display='block';
     }     
        
        
    }
}

function Hay_Que_Bobinar_Liner(id)
{
    if(id=='Directo para Producción')
    {
        document.getElementById('ancho_bobina_seleccionado_bobinar').style.display='none';
        document.form.bobinar_ancho_liner.value=0;
    }else
    {
        document.getElementById('ancho_bobina_seleccionado_bobinar').style.display='block';
    }
}

function cortes_de_bobina()
{
     var ccac1=document.form.ccac1.value;
     var gramaje_placa=document.form.gramaje.value;     
     var can_imprimir=document.form.can_imprimir.value;    
     var can_maxima_primer_corte=document.form.ancho_seleccionado_de_bobina.value;     
     var can_minima_primer_corte=document.form.can_minima_primer_corte.value;
     var ancho_seleccionado_de_bobina=document.form.ancho_seleccionado_de_bobina.value;
     var gramaje_seleccionado=document.form.gramaje_seleccionado.value;
     
     ancho_seleccionado_de_bobina=parseInt(ancho_seleccionado_de_bobina);
     gramaje_seleccionado=parseInt(gramaje_seleccionado);  

    if ((ancho_seleccionado_de_bobina<300)  || (ancho_seleccionado_de_bobina>2500) || (ancho_seleccionado_de_bobina==""))
    {
           document.form.ancho_seleccionado_de_bobina.value=300;      
           document.form.ancho_seleccionado_de_bobina.focus();  
           alert("Ancho Seleccionado de Bobina no puede ser menor a 300 ni mayor a 2500 Cms"); 
           return false;
    }  
    if ((gramaje_seleccionado<90)  || (gramaje_seleccionado>500)  || (gramaje_seleccionado==""))
    {
           document.form.gramaje_seleccionado.value=90;
           document.form.gramaje_seleccionado.focus();  
           alert("Gramaje Seleccionado no puede ser menor a 90 ni mayor a 500"); 
           return false;
    }         

    if (can_minima_primer_corte >0)
    {     
        document.form.bobinar_ancho_cartulina2.readOnly = false;
        var bobinar_ancho_cartulina1=document.form.bobinar_ancho_cartulina1.value;
        var bobinar_ancho_cartulina2=document.form.bobinar_ancho_cartulina2.value;
        var bobinar_ancho_cartulina3=document.form.bobinar_ancho_cartulina3.value;
        var ccac1=document.form.ccac1.value;
        //var gramaje_placa=document.form.gramaje_placa.value;  
        var can_imprimir=document.form.can_imprimir.value;          
        var can_minima_primer_corte=document.form.can_minima_primer_corte.value;
        //var can_maxima_primer_corte=document.form.can_maxima_primer_corte.value;          
             
        ccac1=parseInt(ccac1);     
        gramaje_placa=parseInt(gramaje_placa);
        can_imprimir=parseInt(can_imprimir);
        can_minima_primer_corte=parseInt(can_minima_primer_corte);
        can_maxima_primer_corte=parseInt(can_maxima_primer_corte);        
        bobinar_ancho_cartulina1=parseInt(bobinar_ancho_cartulina1);
        bobinar_ancho_cartulina2=parseInt(bobinar_ancho_cartulina2);
        bobinar_ancho_cartulina3=parseInt(bobinar_ancho_cartulina3);
        var ancho_minimo=can_minima_primer_corte-ccac1+20;
        div="msg_bobinas1";
        $("#"+div+"").html("<string>Maximo de Distancia de Corte no puede ser Menor a los :"+(ancho_minimo)+" (Mms)</strong>");     
        if ((bobinar_ancho_cartulina1<ancho_minimo)  ||  (bobinar_ancho_cartulina1 > can_maxima_primer_corte))
        {
           document.form.bobinar_ancho_cartulina1.value=0;
           document.form.bobinar_ancho_cartulina2.value=0;
           document.form.bobinar_ancho_cartulina3.value=0;           
           document.form.kilos_orden_a_bobinar.value=0;
           document.form.kilos_bobina_seleccionada.focus();            
           alert("Error de Ancho de Bobina, El primer Corte no puede ser Menor a: "+ancho_minimo+" (Mms)  y no pueder ser mayor a: "+can_maxima_primer_corte+" (Mms)");
           return false;
        } 
        else
        {
           if (bobinar_ancho_cartulina1>0)
           {
               var total_kilos_bobinas=(bobinar_ancho_cartulina1/10)*can_imprimir*100*gramaje_placa/10000000;
               document.form.kilos_orden_a_bobinar.value=total_kilos_bobinas;
               var restante_bobina=can_maxima_primer_corte-bobinar_ancho_cartulina1;
               if (restante_bobina>0)
               {
                document.form.bobinar_ancho_cartulina2.value=restante_bobina;
                document.form.bobinar_ancho_cartulina3.value=0;          
                
               }                   
           }      
           else document.form.kilos_orden_a_bobinar.value=0;

        }     
     } 
    else
    {    
           document.form.bobinar_ancho_cartulina1.value=0;
           document.form.kilos_orden_a_bobinar.value=0;
           
    }      
 }
 
 
function  reiniciar_calculos_bobinas_cortes()
{   
    var div="msg_bobinas1";
    var div2="msg_bobinas2";
    var div3="msg_bobinas3";      
    document.getElementById('otras_bobinas').style.display='none';
    document.form.bobinar_ancho_cartulina2.value=0;
    document.form.bobinar_ancho_cartulina3.value=0;
    document.form.kilos_orden_a_bobinar.value=0;   
    document.form.bobinar_ancho_cartulina2.readOnly = false;
    document.form.bobinar_ancho_cartulina3.readOnly = true;
    $("#"+div+"").html("");         
    $("#"+div3+"").html("");         
    $("#"+div2+"").html("");     
    
}     


function  limpiar_cortes_control_cartulina()
{   
     var ancho_seleccionado_de_bobina=document.form.ancho_seleccionado_de_bobina.value;
     ancho_seleccionado_de_bobina=parseInt(ancho_seleccionado_de_bobina);
     if (ancho_seleccionado_de_bobina>2500)
     {
         alert("Ancho seleccionado de bobina no pueder ser a 2500 Mms");
         document.form.ancho_seleccionado_de_bobina.value=0;         
     }
    document.form.bobinar_ancho_cartulina1.value=0;
    document.form.bobinar_ancho_cartulina2.value=0;
    document.form.bobinar_ancho_cartulina3.value=0;
    document.form.kilos_orden_a_bobinar.value=0;  
   return false;
}    
 
function sumar_bobina_control_cartulina()
{
     var ancho_seleccionado_de_bobina=document.form.ancho_seleccionado_de_bobina.value;
     var kilos_bobina_seleccionada=document.form.kilos_bobina_seleccionada.value;
     var tamano_cuchillo_2=document.form.tamano_cuchillo_2.value;     


     var tamano_a_imprimir_2=document.form.tamano_a_imprimir_2.value;
     var can_imprimir=document.form.can_imprimir.value;

     var bobinar_ancho_cartulina1=document.form.bobinar_ancho_cartulina1.value;
     var bobinar_ancho_cartulina2=document.form.bobinar_ancho_cartulina2.value;
     var bobinar_ancho_cartulina3=document.form.bobinar_ancho_cartulina3.value;
     var gramaje_seleccionado=document.form.gramaje_seleccionado.value;



     var ccac1=document.form.ccac1.value;
     var can_minima_primer_corte=document.form.can_minima_primer_corte.value;
    
             
     ccac1=parseInt(ccac1);     
     can_minima_primer_corte=parseInt(can_minima_primer_corte);
     var ancho_minimo=can_minima_primer_corte-ccac1+20;
     ancho_seleccionado_de_bobina=parseInt(ancho_seleccionado_de_bobina);
     gramaje_seleccionado=parseInt(gramaje_seleccionado);  


    if ((ancho_seleccionado_de_bobina<300)  || (ancho_seleccionado_de_bobina>2500) || (ancho_seleccionado_de_bobina==""))
    {
           document.form.ancho_seleccionado_de_bobina.value=300;      
           document.form.ancho_seleccionado_de_bobina.focus();  
           alert("Ancho Seleccionado de Bobina no puede ser menor a 300 ni mayor a 2500 Cms"); 
           return false;
    }     
    if ((gramaje_seleccionado<90)  || (gramaje_seleccionado>500)  || (gramaje_seleccionado==""))
    {
           document.form.gramaje_seleccionado.value=90;
           document.form.gramaje_seleccionado.focus();  
           alert("Gramaje Seleccionado no puede ser menor a 90 ni mayor a 500"); 
           return false;
    }    

     tamano_a_imprimir_2=parseInt(tamano_a_imprimir_2);
     can_imprimir=parseInt(can_imprimir);     
     kilos_bobina_seleccionada=parseInt(kilos_bobina_seleccionada);  
     tamano_cuchillo_2=parseInt(tamano_cuchillo_2);
     bobinar_ancho_cartulina1=parseInt(bobinar_ancho_cartulina1);     
     bobinar_ancho_cartulina2=parseInt(bobinar_ancho_cartulina2);
     bobinar_ancho_cartulina3=parseInt(bobinar_ancho_cartulina3);
     document.form.bobinar_ancho_cartulina1.value=bobinar_ancho_cartulina1;
     document.form.bobinar_ancho_cartulina2.value=bobinar_ancho_cartulina2;
     document.form.bobinar_ancho_cartulina3.value=bobinar_ancho_cartulina3;     
     bobina_total=bobinar_ancho_cartulina1+bobinar_ancho_cartulina2+bobinar_ancho_cartulina3;

     if (gramaje_seleccionado<=0)
     {
         alert("Gramaje Seleccionado Tiene que ser mayor que cero");
         return false;       
     }      

     if (ancho_seleccionado_de_bobina<=0)
     {
         alert("Ancho de la bobina Seleccionada Tiene que ser mayor que cero");
         return false;      
     } 

     if (kilos_bobina_seleccionada<=0)
     {
         alert("Kilos de la bobina Seleccionada Tiene que ser mayor que cero");
         return false;          
     }        



     if (bobinar_ancho_cartulina1>0)
     {
         div="msg_bobinas1";
         var html="<strong>Total Restante Recomendado 2do Corte: "+(ancho_seleccionado_de_bobina-bobinar_ancho_cartulina1)+" (Mms)</strong>";
         var kilos_bobina_1er_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(bobinar_ancho_cartulina1));
         html+="</br><strong>Kilos de la Bobina a Bobinar 1er Corte: "+kilos_bobina_1er_corte.toFixed(2)+" Kg</strong>";
         html+="</br><strong>Metros Lineales de la Bobina a Bobinar 1er Corte: "+(((kilos_bobina_1er_corte)/(bobinar_ancho_cartulina1*gramaje_seleccionado))*1000000).toFixed(2)+" Mtrs</strong>";
         html+="</br><strong>Metros Lineales de la Orden : "+((tamano_a_imprimir_2*can_imprimir)/100).toFixed(2)+" Mtrs</strong>";
         html+="</br><strong>Total de Cortes de la Orden  : "+can_imprimir+" Piezas</strong>";
         var cortes_por_bobina_1=((((kilos_bobina_1er_corte)/(bobinar_ancho_cartulina1*gramaje_seleccionado))*1000000)/(tamano_a_imprimir_2/100));
         html+="</br><strong>Total de Cortes Cartulina del Primer Corte : "+cortes_por_bobina_1.toFixed(2)+" Piezas</strong>";
         if (can_imprimir>cortes_por_bobina_1)
            var cortes_restantes_1=can_imprimir-cortes_por_bobina_1;
         else
            var cortes_restantes_1=0;
         html+="</br><strong>Total de Faltantes : "+cortes_restantes_1.toFixed(2)+" Piezas</strong>";
         if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_1er_corte)/(bobinar_ancho_cartulina1*gramaje_seleccionado))*1000000))
         { 
             html+="</br><strong><font color='red'>Bobina 1er Corte Insuficiente</font></strong>";   
             ver_informacion_bobinas('otras_bobinas');             
         }
         else
          html+="</br><strong><font color='green'>Bobina 1er Corte Cubre la Producción</font></strong>";         
      
         if (bobinar_ancho_cartulina1>1000)
         html+="</br><strong><font color='red'>Corte de Bobina superior a los 1000 (Mms)</font></strong>";  
    
    
         $("#"+div+"").html(html);
//         document.form.bobinar_ancho_cartulina2.value=(ancho_seleccionado_de_bobina-bobinar_ancho_cartulina1);          
        
 
             
        if (bobinar_ancho_cartulina1==ancho_seleccionado_de_bobina)
        {
          document.form.bobinar_ancho_cartulina2.readOnly = true;
        }
        else if (bobinar_ancho_cartulina1<ancho_seleccionado_de_bobina)
        {
          document.form.bobinar_ancho_cartulina2.readOnly = false;
        }   
        else if (bobinar_ancho_cartulina1>ancho_minimo)    
        {
          document.form.bobinar_ancho_cartulina2.readOnly = false;
        }           
     }
     //if (bobinar_ancho_cartulina2>0)
     if (bobinar_ancho_cartulina2>0)
     {  
        if (bobinar_ancho_cartulina2 <= ancho_seleccionado_de_bobina) 
        { 
            div2="msg_bobinas2";
            div3="msg_bobinas3";        
            var html2="<strong>Total Restante Recomendado 3er Corte: "+(ancho_seleccionado_de_bobina-bobinar_ancho_cartulina1-bobinar_ancho_cartulina2)+" (Mms)</strong>";
            if (bobinar_ancho_cartulina3 == 0)
            {
              document.form.bobinar_ancho_cartulina3.value=(ancho_seleccionado_de_bobina-bobinar_ancho_cartulina1-bobinar_ancho_cartulina2);  
            }  
            if (document.form.bobinar_ancho_cartulina3.value>0)
            {
              document.form.bobinar_ancho_cartulina3.value=(ancho_seleccionado_de_bobina-bobinar_ancho_cartulina1-bobinar_ancho_cartulina2);  
              var html3="<strong>Total Restante:"+(ancho_seleccionado_de_bobina-(bobinar_ancho_cartulina1+bobinar_ancho_cartulina2+bobinar_ancho_cartulina3))+"</strong>";          
              var kilos_bobina_3er_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(document.form.bobinar_ancho_cartulina3.value));
              html3+="</br><strong>Kilos de la Bobina a Bobinar 3er Corte: "+kilos_bobina_3er_corte.toFixed(2)+" Kg</strong>";
              html3+="</br><strong>Metros Lineales de la Bobina a Bobinar 3er Corte: "+(((kilos_bobina_3er_corte)/(gramaje_seleccionado*document.form.bobinar_ancho_cartulina3.value))*1000000).toFixed(2)+" Mtrs</strong>";
    //         var kilos_bobina_3do_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(document.form.bobinar_ancho_cartulina3.value));
    //aqui
            // mo existe al recargar
              var kilos_bobina_2do_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(document.form.bobinar_ancho_cartulina2.value));
              var cortes_por_bobina_2=((((kilos_bobina_2do_corte)/(bobinar_ancho_cartulina2*gramaje_seleccionado))*1000000)/(tamano_a_imprimir_2/100));
              if (cortes_restantes_1>cortes_por_bobina_2)
                var cortes_restantes_2=cortes_restantes_1-cortes_por_bobina_2;
              else
                var cortes_restantes_2=0;
            // fin del no existe al recargar


              var cortes_por_bobina_3=((((kilos_bobina_3er_corte)/(document.form.bobinar_ancho_cartulina3.value*gramaje_seleccionado))*1000000)/(tamano_a_imprimir_2/100));
              html3+="</br><strong>Total de Cortes Cartulina del Segundo Corte : "+cortes_por_bobina_3.toFixed(2)+" Piezas</strong>";     
              if (cortes_restantes_2>cortes_por_bobina_3)
                var cortes_restantes_3=cortes_restantes_2-cortes_por_bobina_3;
              else
                var cortes_restantes_3=0;
              html3+="</br><strong>Total de Faltantes : "+cortes_restantes_3.toFixed(2)+" Piezas</strong>";     
              if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_3er_corte)/(document.form.bobinar_ancho_cartulina3.value*gramaje_seleccionado))*1000000)) 
              {
                  html3+="</br><strong><font color='red'>Con Bobina de 3er Corte Insuficiente</font></strong>";                 
                  ver_informacion_bobinas('otras_bobinas');
              }            
              $("#"+div3+"").html(html3);          
            }          

             var kilos_bobina_2do_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(document.form.bobinar_ancho_cartulina2.value));
             html2+="</br><strong>Kilos de la Bobina a Bobinar 2do Corte: "+kilos_bobina_2do_corte.toFixed(2)+" Kg</strong>";
             html2+="</br><strong>Metros Lineales de la Bobina a Bobinar 2do Corte: "+(((kilos_bobina_2do_corte)/(gramaje_seleccionado*document.form.bobinar_ancho_cartulina2.value))*1000000).toFixed(2)+" Mtrs</strong>";
             //alert("(((("+kilos_bobina_2do_corte+")/("+bobinar_ancho_cartulina2+"*"+gramaje_seleccionado+"))*1000000)/("+tamano_a_imprimir_2+"/100))");
             var cortes_por_bobina_2=((((kilos_bobina_2do_corte)/(bobinar_ancho_cartulina2*gramaje_seleccionado))*1000000)/(tamano_a_imprimir_2/100));
             html2+="</br><strong>Total de Cortes Cartulina del Segundo Corte : "+cortes_por_bobina_2.toFixed(2)+" Piezas</strong>";     
             if (cortes_restantes_1>=cortes_por_bobina_2)
                var cortes_restantes_2=cortes_restantes_1-cortes_por_bobina_2;
             else
                var cortes_restantes_2=0;
             html2+="</br><strong>Total de Faltantes : "+cortes_restantes_2.toFixed(2)+" Piezas</strong>";             
             var metros_lineales_orden=(tamano_a_imprimir_2*can_imprimir)/100;
             var metros_lineales_primer_corte=(((kilos_bobina_1er_corte)/(bobinar_ancho_cartulina1*gramaje_seleccionado))*1000000);
             var metros_leales_segundo_corte=(((kilos_bobina_2do_corte)/(gramaje_seleccionado*document.form.bobinar_ancho_cartulina2.value))*1000000);
             //html2+="</br><strong>Metros Lineales de la Orden 2do Corte: "+(((kilos_bobina_2do_corte)/(gramaje_seleccionado*bobinar_ancho_cartulina2))*1000000).toFixed(2)+" Mtrs</strong>";
             if ((metros_lineales_primer_corte+metros_leales_segundo_corte)>=metros_lineales_orden)
              {
                //if ((document.form.bobinar_ancho_cartulina2.value<=1000) && (document.form.bobinar_ancho_cartulina2.value>=ancho_minimo))
                if (document.form.bobinar_ancho_cartulina2.value>=ancho_minimo)
                {
                  if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_1er_corte)/(bobinar_ancho_cartulina1*gramaje_seleccionado))*1000000))
                    html2+="</br><strong><font color='green'>Con Bobina de 2do Corte Cubre la Producción</font></strong>";         
                }
                else
                {
                  if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_1er_corte)/(bobinar_ancho_cartulina1*gramaje_seleccionado))*1000000)) 
                  {
                    html2+="</br><strong><font color='red'>Con Bobina de 2do Corte Insuficiente</font></strong>";                 
                    ver_informacion_bobinas('otras_bobinas');
                  }             
                }
              }
             else
             { 
                  if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_1er_corte)/(bobinar_ancho_cartulina1*gramaje_seleccionado))*1000000)) 
                  {
                    html2+="</br><strong><font color='red'>Con Bobina de 2do Corte Insuficiente</font></strong>";                 
                    ver_informacion_bobinas('otras_bobinas');
                  } 
             }
             if (bobinar_ancho_cartulina2>1000)
                 html2+="</br><strong><font color='red'>Corte de Bobina superior a los 1000 (Mms)</font></strong>";         
             $("#"+div2+"").html(html2);


           // $("#"+div3+"").html("<strong>Total Restante:"+(ancho_seleccionado_de_bobina-(bobinar_ancho_cartulina1+bobinar_ancho_cartulina2+bobinar_ancho_cartulina3)))+"</strong>";

            if ((bobinar_ancho_cartulina1+bobinar_ancho_cartulina2)<ancho_seleccionado_de_bobina)
                document.form.bobinar_ancho_cartulina3.readOnly = false;
        }
     else
     {
        div2="msg_bobinas2";
        div3="msg_bobinas3";           
        $("#"+div3+"").html("");         
        $("#"+div2+"").html("");
        document.form.bobinar_ancho_cartulina3.readOnly = true;
        document.form.bobinar_ancho_cartulina3.value=0;
        if (ancho_minimo>bobinar_ancho_cartulina2)
        {
           document.form.bobinar_ancho_cartulina2.value=0;          
           reiniciar_calculos_bobinas_cortes();
           document.form.kilos_bobina_seleccionada.focus();  
           alert("Error de Ancho de Bobina, El Segundo Corte no puede ser Menor a: "+ancho_minimo+" (Mms)");
           return false;
        }
        if (bobinar_ancho_cartulina2 > ancho_seleccionado_de_bobina)
        {
           document.form.bobinar_ancho_cartulina2.value=0;          
           reiniciar_calculos_bobinas_cortes();
           document.form.kilos_bobina_seleccionada.focus();  
           alert("Error de Ancho de Bobina, El Segundo Corte no puede ser Mayor a: "+ancho_seleccionado_de_bobina+" (Mms)");
           return false;
        }        
        return false;
     }        
     }




     if (bobina_total>ancho_seleccionado_de_bobina)
     {
         document.form.bobinar_ancho_cartulina1.value=0;
         document.form.bobinar_ancho_cartulina2.value=0;
         document.form.bobinar_ancho_cartulina3.value=0;     
         document.form.kilos_orden_a_bobinar.value=0;    
         document.form.bobinar_ancho_cartulina2.readOnly = true;
         document.form.bobinar_ancho_cartulina3.readOnly = true;
        //$("#"+div+"").html("");         
        $("#"+div3+"").html("");         
        $("#"+div2+"").html("");         
         alert("Error de Ancho de Bobina, La suma de los 3 Cortes no puede ser Mayor a: "+ancho_seleccionado_de_bobina);
     }    
 } 
 
function sumar_bobina_liner()
{
     var ccac1=document.form.ccac1.value;
     var gramaje_placa=document.form.gramaje_liner.value;     
     var can_imprimir=document.form.can_imprimir.value;     
     var bobinar_ancho_liner=document.form.bobinar_ancho_liner.value;
     if (bobinar_ancho_liner >0)
     {
        var bobinar_ancho_cartulina1=document.form.bobinar_ancho_cartulina1.value;
        var bobinar_ancho_cartulina2=document.form.bobinar_ancho_cartulina2.value;
        var bobinar_ancho_cartulina3=document.form.bobinar_ancho_cartulina3.value;
        var ancho_seleccionado_de_bobina=document.form.ancho_seleccionado_de_bobina.value;        
        ccac1=parseInt(ccac1);     
        gramaje_placa=parseInt(gramaje_placa);
        can_imprimir=parseInt(can_imprimir);
        bobinar_ancho_liner=parseInt(bobinar_ancho_liner);
        bobinar_ancho_cartulina1=parseInt(bobinar_ancho_cartulina1);
        bobinar_ancho_cartulina2=parseInt(bobinar_ancho_cartulina2);
        bobinar_ancho_cartulina3=parseInt(bobinar_ancho_cartulina3);
        var ancho_maximo=bobinar_ancho_liner-ccac1+20;
        div="msg_bobinas1";
      
        $("#"+div+"").html("<string>Maximo de Distancia de Corte no puede ser Menor a los :"+(ancho_maximo)+" (Mms)</strong>");     
        if (((bobinar_ancho_cartulina1<ancho_maximo)  ||  (bobinar_ancho_cartulina1 > bobinar_ancho_liner)) && (bobinar_ancho_cartulina1>0))
        {
            document.form.bobinar_ancho_cartulina1.value=ancho_seleccionado_de_bobina;
            document.form.bobinar_ancho_cartulina2.value=0;
            document.form.bobinar_ancho_cartulina3.value=0;     
            document.form.kilos_orden_a_bobinar.value=0;    
            document.form.bobinar_ancho_cartulina2.readOnly = false;
            document.form.bobinar_ancho_cartulina3.readOnly = false;     
            alert("Error de Ancho de Bobina, El primer Corte no puede ser Menor a: "+ancho_maximo+" (Mms)  y no pueder ser mayor a: "+bobinar_ancho_liner+" (Mms)");
           return false;
        } 
        else
        {
           if (bobinar_ancho_cartulina1>0)
           {
               var total_kilos_bobinas=(bobinar_ancho_cartulina1/10)*can_imprimir*100*(gramaje_placa/10000000);
               document.form.kilos_orden_a_bobinar.value=total_kilos_bobinas;
           }      
           else document.form.kilos_orden_a_bobinar.value=0;
        } 
     }
    else
    {    
           document.form.bobinar_ancho_cartulina1.value=0;
    }     
 }
 


function asignar_producto()
{
    var items=document.form.asignar.value;
    if(items=='SI')
    {
         document.getElementById('combo_cliente').style.display='block';
    }else
    {
        document.getElementById('combo_cliente').style.display='none';
    }
}

function validar_ancho_bobina_seleccionada()
{      
    var ancho_bobina_seleccionada2=document.form.ancho_de_bobina.value; 
    
   if (document.form.ancho_seleccionado_de_bobina.value>ancho_bobina_seleccionada2)  
    {
      alert("No puedes ingresar un valor menor al Ancho de la bobina cotizada "); 
    } 
  }

function validar_kilos_bobina_seleccionada()
{
    var items=document.form.hay_que_bobinar.value;
    var kilos_bobina_seleccionada=document.form.kilos_bobina_seleccionada.value; 

    
    if((items=='SI') && (kilos_bobina_seleccionada==''))
    {
        document.form.hay_que_bobinar.value='Seleccione';         
        alert("No puedes Bobinar si Kilos de la Bobina Seleccionada esta Vacio");
    }
    else if((items=='SI') && (kilos_bobina_seleccionada==0))
    {
        document.form.hay_que_bobinar.value='Seleccione';         
        alert("No puedes Bobinar si Kilos de la Bobina Seleccionada esta Vacio");
    } 
    
}

function guardarOrdenCompraPiezas() 
{
   var div="prueba";
   var id=document.form.id_registro.value;
   var empresa=document.form.empresa.value;
   var envia=document.form.envia.value;
   var recibe=document.form.recibe.value;
   var tipo_despacho=document.form.tipo_despacho.value;
   var tipo_seccion=document.form.tipo_seccion.value;
   if (id=='')
   {
       alert("Debe seleccionar un Registro Valido");
       return;       
   }     
   if (tipo_despacho=='')
   {
       alert("Debe seleccionar un Tipo de Despacho, No puede estar Vacio");
       return;       
   }  
   if (empresa==0)
   {
       alert("Debe seleccionar una Empresa, No puede estar Vacio");
       return;       
   }   
   if (tipo_seccion=='')
   {
       alert("Debe seleccionar una Sección, No puede estar Vacio");
       return;       
   }      
   if (envia=='')
   {
       alert("Debe seleccionar un responsable de la emisión de la Orden de Compra");
       return;       
   }   
   if (recibe=='')
   {
       alert("Debe seleccionar un responsable de la recepción de la Orden de Compra");
       return;       
   }     
   var piezas_adicionales1=document.form.piezas_adicionales1.value;
   var piezas_adicionales2=document.form.piezas_adicionales2.value;
   var piezas_adicionales3=document.form.piezas_adicionales3.value;    
   var proveedor1=document.form.proveedor1.value;
   var proveedor2=document.form.proveedor2.value;
   var proveedor3=document.form.proveedor3.value;     
   var cantidad1=document.form.cantidad1.value;
   var cantidad2=document.form.cantidad2.value;
   var cantidad3=document.form.cantidad3.value;        
   var precio_referencia_1=document.form.precio_referencia_1.value;
   var precio_referencia_2=document.form.precio_referencia_2.value;
   var precio_referencia_3=document.form.precio_referencia_3.value;
   var precio1=document.form.precio1.value;
   var precio2=document.form.precio2.value;
   var precio3=document.form.precio3.value;   
//   if ((piezas_adicionales1==piezas_adicionales2)  || (piezas_adicionales1==piezas_adicionales3))
//   {   alert("Piezas Repetidas"); 
//       return;
//   }    
//   if ((piezas_adicionales2==piezas_adicionales1)  || (piezas_adicionales2==piezas_adicionales3))
//   {    alert("Piezas Repetidas");  
//       return;
//   }    
//   if ((piezas_adicionales3==piezas_adicionales1)  || (piezas_adicionales3==piezas_adicionales2))
//   {   alert("Piezas Repetidas"); 
//       return;
//   }
   var ruta=webroot+'ordenes/guardarOrdenCompraPiezas';
   $.post(ruta,{piezas_adicionales1:piezas_adicionales1,piezas_adicionales2:piezas_adicionales2,piezas_adicionales3:piezas_adicionales3,proveedor1:proveedor1,proveedor2:proveedor2,proveedor3:proveedor3,cantidad1:cantidad1,cantidad2:cantidad2,cantidad3:cantidad3,precio1:precio1,precio2:precio2,precio3:precio3,div:div,id:id,precio_referencia_1:precio_referencia_1,precio_referencia_2:precio_referencia_2,precio_referencia_3:precio_referencia_3,empresa:empresa,envia:envia,recibe:recibe,tipo_despacho:tipo_despacho,tipo_seccion:tipo_seccion},function(resp)
   {
       alert("Orden de Compra guardada con exito")
       var arreglo = [proveedor1,proveedor2,proveedor3];
       proveedores=remover_repetidos(arreglo);
       //console.log(proveedores);
      // for (x=0;x<proveedores.length;x++){
           ruta2=webroot+'ordenes/pdf_orden_de_compra_piezas/'+id+'/944/'+proveedores[0]+'/'+proveedores[1]+'/'+proveedores[2];
           
           window.open(ruta2);
      // }       
   });
}

function guardarOrdenCompraTrabajosExternos() 
{
   var div="prueba";
   var id=document.form.id.value;   
   var empresa=document.form.empresa.value;   
   var envia=document.form.envia.value; 
   var recibe=document.form.recibe.value;    
   var tipo_despacho=document.form.tipo_despacho.value;  
   var fecha_entrega=document.form.fecha_entrega.value; 
   alert(fecha_entrega);
   var array_fecha_entrega = fecha_entrega.split("-");
   fecha_entrega = array_fecha_entrega[0] + "-" + array_fecha_entrega[1]+ "-" + array_fecha_entrega[2];     
   var tipo_seccion=document.form.tipo_seccion.value;     
   var cantidad_1=document.form.input_variable_externo_4.value;     
   var cantidad_2=document.form.input_variable_externo_5.value;  
   var cantidad_3=document.form.input_variable_externo_6.value;    
 
   if (id=='')
   {
       alert("Debe seleccionar un Registro Valido");
       return;       
   }     
   if (tipo_despacho=='')
   {
       alert("Debe seleccionar un Tipo de Despacho, No puede estar Vacio");
       return;       
   }  
   if (empresa==0)
   {
       alert("Debe seleccionar una Empresa, No puede estar Vacio");
       return;       
   }   
   if (tipo_seccion=='')
   {
       alert("Debe seleccionar una Sección, No puede estar Vacio");
       return;       
   }      
   if (envia=='')
   {
       alert("Debe seleccionar un responsable de la emisión de la Orden de Compra");
       return;       
   }   
   if (recibe=='')
   {
       alert("Debe seleccionar un responsable de la recepción de la Orden de Compra");
       return;       
   }     
   var id_acabado_externo_1=document.form.id_acabado_externo_1.value;
   var id_acabado_externo_2=document.form.id_acabado_externo_2.value;
   var id_acabado_externo_3=document.form.id_acabado_externo_3.value;
   var proveedor1=document.form.id_proveedor_acabado_1.value;
   var proveedor2=document.form.id_proveedor_acabado_2.value;
   var proveedor3=document.form.id_proveedor_acabado_3.value;     
   var precio_referencia_1=document.form.precio_referencia_1.value;
   var precio_referencia_2=document.form.precio_referencia_2.value;
   var precio_referencia_3=document.form.precio_referencia_3.value;
   var precio1=document.form.precio1.value;
   var precio2=document.form.precio2.value;
   var precio3=document.form.precio3.value;   
   if ((id_acabado_externo_1==id_acabado_externo_2)  || (id_acabado_externo_1==id_acabado_externo_3))
   {   alert("Trabajos Externos Repetidos"); 
       return;
   }    
   if ((id_acabado_externo_2==id_acabado_externo_1)  || (id_acabado_externo_2==id_acabado_externo_3))
   {    alert("Trabajos Externos Repetidos");  
       return;
   }    
   if ((id_acabado_externo_3==id_acabado_externo_1)  || (id_acabado_externo_3==id_acabado_externo_2))
   {   alert("Trabajos Externos Repetidos"); 
       return;
   }
   var ruta=webroot+'ordenes/guardarOrdenCompraTrabajosExternos';
   $.post(ruta,{proveedor1:proveedor1,proveedor2:proveedor2,proveedor3:proveedor3,precio1:precio1,precio2:precio2,precio3:precio3,div:div,id:id,precio_referencia_1:precio_referencia_1,precio_referencia_2:precio_referencia_2,precio_referencia_3:precio_referencia_3,empresa:empresa,envia:envia,recibe:recibe,tipo_despacho:tipo_despacho,tipo_seccion:tipo_seccion,id_acabado_externo_1:id_acabado_externo_1,id_acabado_externo_2:id_acabado_externo_2,id_acabado_externo_3:id_acabado_externo_3,cantidad_1:cantidad_1,cantidad_2:cantidad_2,cantidad_3:cantidad_3,fecha_entrega:fecha_entrega},function(resp)
   {
       alert("Orden de Compra guardada con exito")
       var arreglo = [proveedor1,proveedor2,proveedor3];
       proveedores=remover_repetidos(arreglo);
       for (x=0;x<proveedores.length;x++){
           ruta2=webroot+'ordenes/pdf_orden_de_compra_trabajos_externos/'+id+'/944/'+proveedores[x];
           window.open(ruta2);
       }       
   });
}

function remover_repetidos(arr) {
    var obj = {};
    var ret_arr = [];
    for (var i = 0; i < arr.length; i++) {
        obj[arr[i]] = true;
    }
    for (var key in obj) {
        ret_arr.push(key);
    }
    return ret_arr;
}
	

function invalidarCheck()
{
   var cantidad_especifica=document.form.cantidad_especifica.value;
    cantidad_especifica=parseInt(cantidad_especifica);   
    if ((cantidad_especifica=='')  || (cantidad_especifica==0))
    {
        document.getElementById("cantidad_a_empaquetar_a_criterio").checked=true;
        document.form.cantidad_especifica.value="0"        

    }
    else
    {
        document.getElementById("cantidad_a_empaquetar_a_criterio").checked = false;        
    }
}


function invalidarCantidadaEmpaquetar()
{
   var cantidad_especifica=document.form.cantidad_especifica.value;
    cantidad_especifica=parseInt(cantidad_especifica);   
    if ((cantidad_especifica!='')  || (cantidad_especifica>0))
    {
      if(document.form.cantidad_a_empaquetar_a_criterio.checked == true)
      {
        document.form.cantidad_especifica.value="0";    
      } 
    }
}

function cambiaFolia_Cotizacion()
{
    var form=document.form;
    if(form.folia.value=="NO")
    {
        form.folia_se.value = "Nuevo";               
        document.getElementById('folia_se_a').style.display='none';
        return false;
    }else
    {
        document.getElementById('folia_se_a').style.display='block';
        form.folia_se.value="Nuevo";
        return false;
    }
}
function cambiaFolia2_Cotizacion()
{
    var form=document.form;
    
    if(form.folia_2.value=="NO")
    {
        form.folia_se_2.value = "Nuevo";             
        document.getElementById('folia_se_2_a').style.display='none';
        document.getElementById('folia2_molde_selected').style.display='none';
        return false;
    }else
    {
        document.getElementById('folia_se_2_a').style.display='block';
        document.getElementById('folia2_molde_selected').style.display='block';
        form.folia_se_2.value="Nuevo";
        return false;
    }
}
function cambiaFolia3_Cotizacion()
{
    var form=document.form;
    if(form.folia_3.value=="NO")
    {
        form.folia_se_3.value = "Nuevo";             
        document.getElementById('folia_se_3_a').style.display='none';
        document.getElementById('folia3_molde_selected').style.display='none';
        return false;
    }else
    {
        document.getElementById('folia_se_3_a').style.display='block';
        document.getElementById('folia3_molde_selected').style.display='block';
        form.folia_se_3.value="Nuevo";
        return false;
    }
}
function cambiaCuno_Cotizacion()
{
    var form=document.form;
    if(form.cuno.value=="NO")
    {
        form.cuno_se.value = "Nuevo";            
        document.getElementById('cuno_se_a').style.display='none';
        document.getElementById('cuno1_molde_selected').style.display='none';
        return false;
    }else
    {
        document.getElementById('cuno_se_a').style.display='block';
        document.getElementById('cuno1_molde_selected').style.display='block';
        form.cuno_se.value="Nuevo";
        return false;
    }
}
function cambiaCuno2_Cotizacion()
{
    var form=document.form;
   if(form.cuno_2.value=="NO")
    {
        form.cuno_se_2.value = "Nuevo";            
        document.getElementById('cuno_se_2_a').style.display='none';
        document.getElementById('cuno2_molde_selected').style.display='none';
        return false;
    }else
    {
        document.getElementById('cuno_se_2_a').style.display='block';
        document.getElementById('cuno2_molde_selected').style.display='block';
        form.cuno_se_2.value="Nuevo";
        return false;
    }
}

                
                
           
function mostrarTextoPiezaEspecial(value,id)
{
    if (value='SI')
    {
        ver_informacion(id);
    }
    else
    {
        var e = document.getElementById(id);
        if (e.style.display == 'block' || e.style.display=='')
        {
            e.style.display = 'none';
        } 
    }
}       

           
function cambiar_estado_cotizacion(value)
{
    if (value==0)
    {
        document.form.estado.value="0";        
    }
    else if (value==1)
    {
        document.form.estado.value="1"; 
    }
    else if (value==1)
    {
        document.form.estado.value="2"; 
    }    
} 

function habiltarCaja(id1,id2)
{
    var cantidad=document.getElementById(id1).value;
    valor = parseInt(cantidad) 
    if (!isNaN(valor)) { 
       document.getElementById(id2).readOnly = false;
    }else{ 
        return false;
    }     
} 


function validarEntero(valor){ 
      //intento convertir a entero. 
      //si era un entero no le afecta, si no lo era lo intenta convertir 
      
       valor = parseInt(valor) 

      //Compruebo si es un valor numérico 
      if (isNaN(valor)) { 
         //entonces (no es numero) devuelvo el valor cadena vacia 
         return "" 
      }else{ 
         //En caso contrario (Si era un número) devuelvo el valor 
         return valor 
      } 
}

function comprueba_extension(formulario, archivo) { 
   alert(archivo);
   extensiones_permitidas = new Array(".pdf"); 
   mierror = ""; 
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
      alert(extension);
      permitida = false; 
      for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
      } 
      if (!permitida) 
      { 
        mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
      }
      else
        formulario.submit(); 
   alert (mierror); 
   return false; 
}  


function recetear_cliente_add_cotizacion() { 
    if (document.form.condicion_del_producto.value==1)
    {
        document.getElementById("productos_asociados").style.display='none';
        document.form.condicion_del_producto.value=0;         
        if(typeof document.getElementById("rep2")!=="undefined"){ 
            document.form.rep2.value=0;  
        }   
        if(typeof document.getElementById("rep")!=="undefined"){ 
            document.form.rep2.value=0; 
        }   
    }
 
   return false; 
}  

function update_rut_ajax_Migracion(valor,id) 
{
   var ruta=webroot+'migracion/update_rut_ajax';
   var div_migrar=id+"_div";
   $.post(ruta,{valor:valor,id:id},function(resp)
   {    
       var dato=resp.replace("↵", "");
       dato=dato.trim();
       if (dato=='N')
       {
        alert("Rut no Valido");
       }
       else
       {
          alert("Rut cambiado con exito");  
          //document.getElementById(div_migrar).style.display='block';                  
       }
   });
}


function Valida_Rut( Objeto )
{
	var tmpstr = "";
	var intlargo = Objeto.value
	if (intlargo.length> 0)
	{
		crut = Objeto.value
		largo = crut.length;
		if ( largo <2 )
		{
			alert('rut inválido')
			Objeto.focus()
			return false;
		}
		for ( i=0; i <crut.length ; i++ )
		if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' )
		{
			tmpstr = tmpstr + crut.charAt(i);
		}
		rut = tmpstr;
		crut=tmpstr;
		largo = crut.length;
 
		if ( largo> 2 )
			rut = crut.substring(0, largo - 1);
		else
			rut = crut.charAt(0);
 
		dv = crut.charAt(largo-1);
 
		if ( rut == null || dv == null )
		return 0;
 
		var dvr = '0';
		suma = 0;
		mul  = 2;
 
		for (i= rut.length-1 ; i>= 0; i--)
		{
			suma = suma + rut.charAt(i) * mul;
			if (mul == 7)
				mul = 2;
			else
				mul++;
		}
 
		res = suma % 11;
		if (res==1)
			dvr = 'k';
		else if (res==0)
			dvr = '0';
		else
		{
			dvi = 11-res;
			dvr = dvi + "";
		}
 
		if ( dvr != dv.toLowerCase() )
		{
			alert('El Rut Ingreso es Invalido')
			Objeto.focus()
			return false;
		}
		alert('El Rut Ingresado es Correcto!')
		Objeto.focus()
		return true;
	}
}

function carga_ajax_Migrar_sv(id) 
{
   var ruta=webroot+'migracion/ajax_registro';
   $.post(ruta,{id:id},function(resp)
   {
        alert(resp);
   });
}

function crear_grupo_cotizacion() 
{
    var date = new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate();
    var arreglo = {};
    var cant = 0;
    var nombre = $("#nombregrupo").val();
    for(var i = 1;i<10;i++){
    if($("#nro"+i).val()!=""){
    arreglo['idc_0'+i]=$("#nro"+i).val(); cant++;}} 
    if($("#nro10").val()!=""){
    arreglo['idc_10']=$("#nro10").val();}
    arreglo['grupo']=nombre;
    arreglo['fecha_creacion']=date;
    arreglo['cant']=cant;
   var ruta=webroot+'cotizaciones/ajax_crear_grupo';
   $.post(ruta,{arreglo:arreglo},function(resp)
   {
        if(resp==='<span id="span" hidden="true" style="margin-left: 10px;padding-right: 20px; padding-left: 20px; color:white; background-color:green">Grupo creado con exito!!</span>'){
        //alert();
        $("#crear").text("Actualizar");
        $("#crear").removeClass("btn-primary");
        $("#crear").addClass("btn-success");
        }else{
        $("#link_grupo").text("Visualizar Grupo");
        $("#crear").text("Actualizar");    
        }
        $("#span").remove();
        $("#mensaje_grupo").append(resp);
        $("#span").fadeIn(1000,"linear");
        $("#span").delay( 6000 ).fadeOut(1000,"linear");
   });
}

function carga_ajax_vigencia(id) 
{
   window.location=webroot+'produccion/cotizacionesVigencia/'+id;
}

function carga_ajax_vendedor(id) 
{
   window.location=webroot+'produccion/cotizaciones_vendedor/'+id;
}
//funcion enviar datos de revision ot


function  verificar_color()
{   
     var colores=document.form.colores.value;
     var colores_metalicos=document.form.colores_metalicos.value;     
     colores=parseInt(colores);
     colores_metalicos=parseInt(colores_metalicos);     
     if (colores_metalicos>colores)
     {
         alert("Colores metalicos no puede ser Mayor al numero de colores");
         document.form.colores_metalicos.value=0;         
     }
   return false;
}    

function validacion_gramaje_control_cartulina()
{
    var gramaje_seleccionado=document.form.gramaje_seleccionado.value;
    gramaje_seleccionado=parseInt(gramaje_seleccionado);   
    if ((gramaje_seleccionado<90)  || (gramaje_seleccionado>500)  || (gramaje_seleccionado==""))
    {
           document.form.gramaje_seleccionado.value=90;
           document.form.gramaje_seleccionado.focus();  
           alert("Gramaje Seleccionado no puede ser menor a 90 ni mayor a 500"); 
           return false;
    }
}

function validacion_ancho_bobina_seleccionada_control_cartulina()
{
    var ancho_seleccionado_de_bobina=document.form.ancho_seleccionado_de_bobina.value;
    if (ancho_seleccionado_de_bobina=="")
    {
           document.form.ancho_seleccionado_de_bobina.value=800;      
           document.form.ancho_seleccionado_de_bobina.focus();  
           alert("Ancho Seleccionado de Bobina no puede ser menor a 80 Cms ni mayor a 250 Cms"); 
           return false;
    }  
    ancho_seleccionado_de_bobina=parseInt(ancho_seleccionado_de_bobina);   
    if ((ancho_seleccionado_de_bobina<800)  || (ancho_seleccionado_de_bobina>2500))
    {
           document.form.ancho_seleccionado_de_bobina.value=800;      
           document.form.ancho_seleccionado_de_bobina.focus();  
           alert("Ancho Seleccionado de Bobina no puede ser menor a 80 Cms ni mayor a 250 Cms"); 
           return false;
    }

}

function validacion_ancho_bobina_seleccionada_control_cartulina2()
{
    var ancho_seleccionado_de_bobina2=document.form.ancho_seleccionado_de_bobina2.value;
    if (ancho_seleccionado_de_bobina2=="")
    {
           document.form.ancho_seleccionado_de_bobina2.value=800;      
           document.form.ancho_seleccionado_de_bobina2.focus();  
           alert("Ancho Seleccionado de Bobina2  no puede ser menor a 80 Cms ni mayor a 250 Cms"); 
           return false;
    }  
    ancho_seleccionado_de_bobina2=parseInt(ancho_seleccionado_de_bobina2);   
    if ((ancho_seleccionado_de_bobina2<800)  || (ancho_seleccionado_de_bobina2>2500))
    {
           document.form.ancho_seleccionado_de_bobina2.value=800;      
           document.form.ancho_seleccionado_de_bobina2.focus();  
           alert("Ancho Seleccionado de Bobina 2 no puede ser menor a 80 Cms ni mayor a 250 Cms"); 
           return false;
    }
    
}

function validacion_ancho_bobina_seleccionada_control_cartulina3()
{
    var ancho_seleccionado_de_bobina3=document.form.ancho_seleccionado_de_bobina3.value;
    if (ancho_seleccionado_de_bobina3=="")
    {
           document.form.ancho_seleccionado_de_bobina3.value=800;      
           document.form.ancho_seleccionado_de_bobina3.focus();  
           alert("Ancho Seleccionado de Bobina 3 no puede ser menor a 80 Cms ni mayor a 250 Cms"); 
           return false;
    }  
    ancho_seleccionado_de_bobina3=parseInt(ancho_seleccionado_de_bobina3);   
    if ((ancho_seleccionado_de_bobina3<800)  || (ancho_seleccionado_de_bobina3>2500))
    {
           document.form.ancho_seleccionado_de_bobina3.value=800;      
           document.form.ancho_seleccionado_de_bobina3.focus();  
           alert("Ancho Seleccionado de Bobina 3 no puede ser menor a 80 Cms ni mayor a 250 Cms"); 
           return false;
    }
    
}
  /*
function validacion_ancho_seleccionado_de_bobina_control_cartulina()
{
    var ancho_seleccionado_de_bobina=document.form.ancho_seleccionado_de_bobina.value;
    ancho_seleccionado_de_bobina=parseInt(ancho_seleccionado_de_bobina);   
    if ((ancho_seleccionado_de_bobina<300)  || (ancho_seleccionado_de_bobina>2500) || (ancho_seleccionado_de_bobina==""))
    {
           document.form.ancho_seleccionado_de_bobina.value=300;      
           document.form.ancho_seleccionado_de_bobina.focus();  
           alert("Ancho Seleccionado de Bobina no puede ser menor a 300 ni mayor a 2500 Cms"); 
           return false;
    }
    if (ancho_seleccionado_de_bobina>1000)
    {
        Hay_Que_Bobinar_Carutlina('SI');
    }
}*/

function validacion_kilos_bobina_seleccionada_control_cartulina()
{
    var kilos_bobina_seleccionada=document.form.kilos_bobina_seleccionada.value;
    if (kilos_bobina_seleccionada=="")
    {
           document.form.kilos_bobina_seleccionada.value=200;      
           document.form.kilos_bobina_seleccionada.focus();  
           alert("Kilos Seleccionado de Bobina no puede ser menor a 200 ni mayor a 3000 Cms"); 
           return false;
    }  
    kilos_bobina_seleccionada=parseInt(kilos_bobina_seleccionada);   
    if ((kilos_bobina_seleccionada<200)  || (kilos_bobina_seleccionada>3000))
    {
           document.form.kilos_bobina_seleccionada.value=200;      
           document.form.kilos_bobina_seleccionada.focus();  
           alert("Kilos Seleccionado de Bobina no puede ser menor a 200 ni mayor a 3000 Cms"); 
           return false;
    }
}



function validar_kilos_bobina_seleccionada_Onda()
{
    var items=document.form.hay_que_bobinar.value;
    var kilos_bobina_seleccionada=document.form.kilos_bobina_seleccionada.value;    
    if((items=='SI') && (kilos_bobina_seleccionada==''))
    {
        document.form.hay_que_bobinar.value='Seleccione';         
        alert("No puedes Bobinar si Kilos de la Bobina Seleccionada esta Vacio");
    }
    else if((items=='SI') && (kilos_bobina_seleccionada==0))
    {
        document.form.hay_que_bobinar.value='Seleccione';         
        alert("No puedes Bobinar si Kilos de la Bobina Seleccionada esta Vacio");
    }    
}

function Hay_Que_Bobinar_Onda(id)
{
    var tamano_a_imprimir_2=document.form.tamano_a_imprimir_2.value;     
    if(id=='NO')
    {
        document.getElementById('ancho_bobina_seleccionado_bobinar').style.display='none';
         document.form.bobinar_ancho_cartulina1.value=0;
         document.form.bobinar_ancho_cartulina2.value=0;
         document.form.bobinar_ancho_cartulina3.value=0; 
         document.form.kilos_orden_a_bobinar.value=0;
         document.form.bobinar_ancho_cartulina1.value=0;         
    }
    else
    {
     if (tamano_a_imprimir_2<=0)
     {
        document.form.hay_que_bobinar.value='NO';         
        alert("Tamaño a imprimir Tiene que ser mayor que cero");
        return false;          
     }
     else
     {
        document.getElementById('ancho_bobina_seleccionado_bobinar').style.display='block';
     }     
        
        
    }    
}

function validacion_kilos_bobina_seleccionada_control_Onda()
{
    var kilos_bobina_seleccionada=document.form.kilos_bobina_seleccionada.value;
    if (kilos_bobina_seleccionada=="")
    {
           document.form.kilos_bobina_seleccionada.value=200;      
           document.form.kilos_bobina_seleccionada.focus();  
           alert("Kilos Seleccionado de Bobina no puede ser menor a 200 ni mayor a 3000 Cms"); 
           return false;
    }  
    kilos_bobina_seleccionada=parseInt(kilos_bobina_seleccionada);   
    if ((kilos_bobina_seleccionada<200)  || (kilos_bobina_seleccionada>3000))
    {
           document.form.kilos_bobina_seleccionada.value=200;      
           document.form.kilos_bobina_seleccionada.focus();  
           alert("Kilos Seleccionado de Bobina no puede ser menor a 200 ni mayor a 3000 Cms"); 
           return false;
    }
}


function  reiniciar_calculos_bobinas_cortes_onda()
{   
    var div="msg_bobinas1";
    var div2="msg_bobinas2";
    var div3="msg_bobinas3";      
    document.getElementById('otras_bobinas').style.display='none';
    document.form.bobinar_ancho_onda1.value=0;
    document.form.bobinar_ancho_onda2.value=0;
    document.form.bobinar_ancho_onda3.value=0;
    document.form.kilos_orden_a_bobinar.value=0;   
    document.form.bobinar_ancho_onda2.readOnly = false;
    document.form.bobinar_ancho_onda3.readOnly = true;
    $("#"+div+"").html("");         
    $("#"+div3+"").html("");         
    $("#"+div2+"").html("");     
    
}  

function validacion_ancho_seleccionado_de_bobina_control_Onda()
{
    var ancho_seleccionado_de_bobina=document.form.ancho_seleccionado_de_bobina.value;
    ancho_seleccionado_de_bobina=parseInt(ancho_seleccionado_de_bobina);   
    if ((ancho_seleccionado_de_bobina<300)  || (ancho_seleccionado_de_bobina>2500) || (ancho_seleccionado_de_bobina==""))
    {
           document.form.ancho_seleccionado_de_bobina.value=300;      
           document.form.ancho_seleccionado_de_bobina.focus();  
           alert("Ancho Seleccionado de Bobina no puede ser menor a 300 ni mayor a 2500 Cms"); 
           return false;
    }
}

function cortes_de_bobina_Onda()
{
     var ccac1=document.form.ccac1.value;
     var gramaje_placa=document.form.gramaje.value;     
     var can_imprimir=document.form.can_imprimir.value;    
     var can_maxima_primer_corte=document.form.ancho_seleccionado_de_bobina.value;     
     var can_minima_primer_corte=document.form.can_minima_primer_corte.value;
     var ancho_seleccionado_de_bobina=document.form.ancho_seleccionado_de_bobina.value;
     var gramaje_seleccionado=document.form.gramaje_seleccionado.value;
     
     ancho_seleccionado_de_bobina=parseInt(ancho_seleccionado_de_bobina);
     gramaje_seleccionado=parseInt(gramaje_seleccionado);  

    if ((ancho_seleccionado_de_bobina<300)  || (ancho_seleccionado_de_bobina>2500) || (ancho_seleccionado_de_bobina==""))
    {
           document.form.ancho_seleccionado_de_bobina.value=300;      
           document.form.ancho_seleccionado_de_bobina.focus();  
           alert("Ancho Seleccionado de Bobina no puede ser menor a 300 ni mayor a 2500 Cms"); 
           return false;
    }  
    if ((gramaje_seleccionado<90)  || (gramaje_seleccionado>500)  || (gramaje_seleccionado==""))
    {
           document.form.gramaje_seleccionado.value=90;
           document.form.gramaje_seleccionado.focus();  
           alert("Gramaje Seleccionado no puede ser menor a 90 ni mayor a 500"); 
           return false;
    }         

    if (can_minima_primer_corte >0)
    {     
        document.form.bobinar_ancho_onda2.readOnly = false;
        var bobinar_ancho_onda1=document.form.bobinar_ancho_onda1.value;
        var bobinar_ancho_onda2=document.form.bobinar_ancho_onda2.value;
        var bobinar_ancho_onda3=document.form.bobinar_ancho_onda3.value;
        var ccac1=document.form.ccac1.value;
        //var gramaje_placa=document.form.gramaje_placa.value;  
        var can_imprimir=document.form.can_imprimir.value;          
        var can_minima_primer_corte=document.form.can_minima_primer_corte.value;
        //var can_maxima_primer_corte=document.form.can_maxima_primer_corte.value;          
             
        ccac1=parseInt(ccac1);     
        gramaje_placa=parseInt(gramaje_placa);
        can_imprimir=parseInt(can_imprimir);
        can_minima_primer_corte=parseInt(can_minima_primer_corte);
        can_maxima_primer_corte=parseInt(can_maxima_primer_corte);        
        bobinar_ancho_onda1=parseInt(bobinar_ancho_onda1);
        bobinar_ancho_onda2=parseInt(bobinar_ancho_onda2);
        bobinar_ancho_onda3=parseInt(bobinar_ancho_onda3);
        var ancho_minimo=can_minima_primer_corte-ccac1+20;
        div="msg_bobinas1";
        $("#"+div+"").html("<string>Maximo de Distancia de Corte no puede ser Menor a los :"+(ancho_minimo)+" (Mms)</strong>");     
        if ((bobinar_ancho_onda1<ancho_minimo)  ||  (bobinar_ancho_onda1 > can_maxima_primer_corte))
        {
           document.form.bobinar_ancho_onda1.value=0;
           document.form.bobinar_ancho_onda2.value=0;
           document.form.bobinar_ancho_onda3.value=0;           
           document.form.kilos_orden_a_bobinar.value=0;
           document.form.kilos_bobina_seleccionada.focus();            
           alert("Error de Ancho de Bobina, El primer Corte no puede ser Menor a: "+ancho_minimo+" (Mms)  y no pueder ser mayor a: "+can_maxima_primer_corte+" (Mms)");
           return false;
        } 
        else
        {
           if (bobinar_ancho_onda1>0)
           {
               var total_kilos_bobinas=(bobinar_ancho_onda1/10)*can_imprimir*100*gramaje_placa/10000000;
               document.form.kilos_orden_a_bobinar.value=total_kilos_bobinas;
               var restante_bobina=can_maxima_primer_corte-bobinar_ancho_onda1;
               if (restante_bobina>0)
               {
                document.form.bobinar_ancho_onda2.value=restante_bobina;
                document.form.bobinar_ancho_onda3.value=0;          
                
               }                   
           }      
           else document.form.kilos_orden_a_bobinar.value=0;

        }     
     } 
    else
    {    
           document.form.bobinar_ancho_onda1.value=0;
           document.form.kilos_orden_a_bobinar.value=0;
           
    }      
 }
 
 function sumar_bobina_control_Onda()
{
     var ancho_seleccionado_de_bobina=document.form.ancho_seleccionado_de_bobina.value;
     var kilos_bobina_seleccionada=document.form.kilos_bobina_seleccionada.value;
     var tamano_cuchillo_2=document.form.tamano_cuchillo_2.value;     


     var tamano_a_imprimir_2=document.form.tamano_a_imprimir_2.value;
     var can_imprimir=document.form.can_imprimir.value;

     var bobinar_ancho_onda1=document.form.bobinar_ancho_onda1.value;
     var bobinar_ancho_onda2=document.form.bobinar_ancho_onda2.value;
     var bobinar_ancho_onda3=document.form.bobinar_ancho_onda3.value;
     var gramaje_seleccionado=document.form.gramaje_seleccionado.value;



     var ccac1=document.form.ccac1.value;
     var can_minima_primer_corte=document.form.can_minima_primer_corte.value;
    
             
     ccac1=parseInt(ccac1);     
     can_minima_primer_corte=parseInt(can_minima_primer_corte);
     var ancho_minimo=can_minima_primer_corte-ccac1+20;
     ancho_seleccionado_de_bobina=parseInt(ancho_seleccionado_de_bobina);
     gramaje_seleccionado=parseInt(gramaje_seleccionado);  


    if ((ancho_seleccionado_de_bobina<300)  || (ancho_seleccionado_de_bobina>2500) || (ancho_seleccionado_de_bobina==""))
    {
           document.form.ancho_seleccionado_de_bobina.value=300;      
           document.form.ancho_seleccionado_de_bobina.focus();  
           alert("Ancho Seleccionado de Bobina no puede ser menor a 300 ni mayor a 2500 Cms"); 
           return false;
    }     
    if ((gramaje_seleccionado<90)  || (gramaje_seleccionado>500)  || (gramaje_seleccionado==""))
    {
           document.form.gramaje_seleccionado.value=90;
           document.form.gramaje_seleccionado.focus();  
           alert("Gramaje Seleccionado no puede ser menor a 90 ni mayor a 500"); 
           return false;
    }    

     tamano_a_imprimir_2=parseInt(tamano_a_imprimir_2);
     can_imprimir=parseInt(can_imprimir);     
     kilos_bobina_seleccionada=parseInt(kilos_bobina_seleccionada);  
     tamano_cuchillo_2=parseInt(tamano_cuchillo_2);
     bobinar_ancho_onda1=parseInt(bobinar_ancho_onda1);     
     bobinar_ancho_onda2=parseInt(bobinar_ancho_onda2);
     bobinar_ancho_onda3=parseInt(bobinar_ancho_onda3);
     document.form.bobinar_ancho_onda1.value=bobinar_ancho_onda1;
     document.form.bobinar_ancho_onda2.value=bobinar_ancho_onda2;
     document.form.bobinar_ancho_onda3.value=bobinar_ancho_onda3;     
     bobina_total=bobinar_ancho_onda1+bobinar_ancho_onda2+bobinar_ancho_onda3;

     if (gramaje_seleccionado<=0)
     {
         alert("Gramaje Seleccionado Tiene que ser mayor que cero");
         return false;       
     }      

     if (ancho_seleccionado_de_bobina<=0)
     {
         alert("Ancho de la bobina Seleccionada Tiene que ser mayor que cero");
         return false;      
     } 

     if (kilos_bobina_seleccionada<=0)
     {
         alert("Kilos de la bobina Seleccionada Tiene que ser mayor que cero");
         return false;          
     }        



     if (bobinar_ancho_onda1>0)
     {
         div="msg_bobinas1";
         var html="<strong>Total Restante Recomendado 2do Corte: "+(ancho_seleccionado_de_bobina-bobinar_ancho_onda1)+" (Mms)</strong>";
         var kilos_bobina_1er_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(bobinar_ancho_onda1));
         html+="</br><strong>Kilos de la Bobina a Bobinar 1er Corte: "+kilos_bobina_1er_corte.toFixed(2)+" Kg</strong>";
         html+="</br><strong>Metros Lineales de la Bobina a Bobinar 1er Corte: "+(((kilos_bobina_1er_corte)/(bobinar_ancho_onda1*gramaje_seleccionado))*1000000).toFixed(2)+" Mtrs</strong>";
         html+="</br><strong>Metros Lineales de la Orden : "+((tamano_a_imprimir_2*can_imprimir)/100).toFixed(2)+" Mtrs</strong>";
         html+="</br><strong>Total de Cortes de la Orden  : "+can_imprimir+" Piezas</strong>";
         var cortes_por_bobina_1=((((kilos_bobina_1er_corte)/(bobinar_ancho_onda1*gramaje_seleccionado))*1000000)/(tamano_a_imprimir_2/100));
         html+="</br><strong>Total de Cortes Onda del Primer Corte : "+cortes_por_bobina_1.toFixed(2)+" Piezas</strong>";
         if (can_imprimir>cortes_por_bobina_1)
            var cortes_restantes_1=can_imprimir-cortes_por_bobina_1;
         else
            var cortes_restantes_1=0;
         html+="</br><strong>Total de Faltantes : "+cortes_restantes_1.toFixed(2)+" Piezas</strong>";
         if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_1er_corte)/(bobinar_ancho_onda1*gramaje_seleccionado))*1000000))
         { 
             html+="</br><strong><font color='red'>Bobina 1er Corte Insuficiente</font></strong>";   
             ver_informacion('otras_bobinas');
         }
         else
          html+="</br><strong><font color='green'>Bobina 1er Corte Cubre la ProducciÃ³n</font></strong>";         
         $("#"+div+"").html(html);
//         document.form.bobinar_ancho_cartulina2.value=(ancho_seleccionado_de_bobina-bobinar_ancho_cartulina1);          
         
     }
     //if (bobinar_ancho_cartulina2>0)
     if ((bobinar_ancho_onda2>0) && (bobinar_ancho_onda2>=ancho_minimo) && (bobinar_ancho_onda2 <= ancho_seleccionado_de_bobina))
     {     
        div2="msg_bobinas2";
        div3="msg_bobinas3";        
        var html2="<strong>Total Restante Recomendado 3er Corte: "+(ancho_seleccionado_de_bobina-bobinar_ancho_onda1-bobinar_ancho_onda2)+" (Mms)</strong>";
        if (bobinar_ancho_onda3==0)
        {
          document.form.bobinar_ancho_onda3.value=(ancho_seleccionado_de_bobina-bobinar_ancho_onda1-bobinar_ancho_onda2);  
        }  
        if (document.form.bobinar_ancho_onda3.value>0)
        {
          document.form.bobinar_ancho_onda3.value=(ancho_seleccionado_de_bobina-bobinar_ancho_onda1-bobinar_ancho_onda2);  
          var html3="<strong>Total Restante:"+(ancho_seleccionado_de_bobina-(bobinar_ancho_onda1+bobinar_ancho_onda2+bobinar_ancho_onda3))+"</strong>";          
          var kilos_bobina_3er_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(document.form.bobinar_ancho_onda3.value));
          html3+="</br><strong>Kilos de la Bobina a Bobinar 3er Corte: "+kilos_bobina_3er_corte.toFixed(2)+" Kg</strong>";
          html3+="</br><strong>Metros Lineales de la Bobina a Bobinar 3er Corte: "+(((kilos_bobina_3er_corte)/(gramaje_seleccionado*document.form.bobinar_ancho_onda3.value))*1000000).toFixed(2)+" Mtrs</strong>";
//         var kilos_bobina_3do_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(document.form.bobinar_ancho_cartulina3.value));
//aqui
        // mo existe al recargar
          var kilos_bobina_2do_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(document.form.bobinar_ancho_onda2.value));
          var cortes_por_bobina_2=((((kilos_bobina_2do_corte)/(bobinar_ancho_onda2*gramaje_seleccionado))*1000000)/(tamano_cuchillo_2/100));
          if (cortes_restantes_1>cortes_por_bobina_2)
            var cortes_restantes_2=cortes_restantes_1-cortes_por_bobina_2;
          else
            var cortes_restantes_2=0;
        // fin del no existe al recargar


          var cortes_por_bobina_3=((((kilos_bobina_3er_corte)/(document.form.bobinar_ancho_onda3.value*gramaje_seleccionado))*1000000)/(tamano_cuchillo_2/100));
          html3+="</br><strong>Total de Cortes Onda del Segundo Corte : "+cortes_por_bobina_3.toFixed(2)+" Piezas</strong>";     
          if (cortes_restantes_2>cortes_por_bobina_3)
            var cortes_restantes_3=cortes_restantes_2-cortes_por_bobina_3;
          else
            var cortes_restantes_3=0;
          html3+="</br><strong>Total de Faltantes : "+cortes_restantes_3.toFixed(2)+" Piezas</strong>";     
          if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_3er_corte)/(document.form.bobinar_ancho_onda3.value*gramaje_seleccionado))*1000000)) 
          {
              html3+="</br><strong><font color='red'>Con Bobina de 3er Corte Insuficiente</font></strong>";                 
              ver_informacion('otras_bobinas');
          }            
          $("#"+div3+"").html(html3);          
        }          

         var kilos_bobina_2do_corte=((kilos_bobina_seleccionada/ancho_seleccionado_de_bobina)*(document.form.bobinar_ancho_onda2.value));
         html2+="</br><strong>Kilos de la Bobina a Bobinar 2do Corte: "+kilos_bobina_2do_corte.toFixed(2)+" Kg</strong>";
         html2+="</br><strong>Metros Lineales de la Bobina a Bobinar 2do Corte: "+(((kilos_bobina_2do_corte)/(gramaje_seleccionado*document.form.bobinar_ancho_onda2.value))*1000000).toFixed(2)+" Mtrs</strong>";
         var cortes_por_bobina_2=((((kilos_bobina_2do_corte)/(bobinar_ancho_onda2*gramaje_seleccionado))*1000000)/(tamano_cuchillo_2/100));
         html2+="</br><strong>Total de Cortes Onda del Segundo Corte : "+cortes_por_bobina_2.toFixed(2)+" Piezas</strong>";     
         if (cortes_restantes_1>cortes_por_bobina_2)
            var cortes_restantes_2=cortes_restantes_1-cortes_por_bobina_2;
         else
            var cortes_restantes_2=0;
         html2+="</br><strong>Total de Faltantes : "+cortes_restantes_2.toFixed(2)+" Piezas</strong>";             
         var metros_lineales_orden=(tamano_a_imprimir_2*can_imprimir)/100;
         var metros_lineales_primer_corte=(((kilos_bobina_1er_corte)/(bobinar_ancho_onda1*gramaje_seleccionado))*1000000);
         var metros_leales_segundo_corte=(((kilos_bobina_2do_corte)/(gramaje_seleccionado*document.form.bobinar_ancho_onda2.value))*1000000);
         //html2+="</br><strong>Metros Lineales de la Orden 2do Corte: "+(((kilos_bobina_2do_corte)/(gramaje_seleccionado*bobinar_ancho_cartulina2))*1000000).toFixed(2)+" Mtrs</strong>";
         if ((metros_lineales_primer_corte+metros_leales_segundo_corte)>=metros_lineales_orden)
          {
            if ((document.form.bobinar_ancho_onda2.value<=1000) && (document.form.bobinar_ancho_onda2.value>=ancho_minimo))
            {
              if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_1er_corte)/(bobinar_ancho_onda1*gramaje_seleccionado))*1000000))
                html2+="</br><strong><font color='green'>Con Bobina de 2do Corte Cubre la ProducciÃ³n</font></strong>";         
            }
            else
            {
              if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_1er_corte)/(bobinar_ancho_onda1*gramaje_seleccionado))*1000000)) 
              {
                html2+="</br><strong><font color='red'>Con Bobina de 2do Corte Insuficiente</font></strong>";                 
                ver_informacion('otras_bobinas');
              }             
            }
          }
         else
         { 
              if (((tamano_a_imprimir_2*can_imprimir)/100)>(((kilos_bobina_1er_corte)/(bobinar_ancho_onda1*gramaje_seleccionado))*1000000)) 
              {
                html2+="</br><strong><font color='red'>Con Bobina de 2do Corte Insuficiente</font></strong>";                 
                ver_informacion('otras_bobinas');
              } 
         }
         if (bobinar_ancho_onda2>1000)
             html2+="</br><strong><font color='red'>Corte de Bobina superior a los 1000 (Mms)</font></strong>";         
         $("#"+div2+"").html(html2);


       // $("#"+div3+"").html("<strong>Total Restante:"+(ancho_seleccionado_de_bobina-(bobinar_ancho_cartulina1+bobinar_ancho_cartulina2+bobinar_ancho_cartulina3)))+"</strong>";
           
        if ((bobinar_ancho_onda1+bobinar_ancho_onda2)<ancho_seleccionado_de_bobina)
            document.form.bobinar_ancho_cartulina3.readOnly = false;
     }
     else
     {
        $("#"+div3+"").html("");         
        $("#"+div2+"").html("");
        document.form.bobinar_ancho_onda3.readOnly = true;
        document.form.bobinar_ancho_onda3.value=0;
        if (ancho_minimo>bobinar_ancho_onda2)
        {
           document.form.bobinar_ancho_onda2.value=0;          
           reiniciar_calculos_bobinas_cortes_onda();
           document.form.kilos_bobina_seleccionada.focus();  
           alert("Error de Ancho de Bobina, El Segundo Corte no puede ser Menor a: "+ancho_minimo+" (Mms)");
           return false;
        }
        if (bobinar_ancho_onda2 > ancho_seleccionado_de_bobina)
        {
           document.form.bobinar_ancho_onda2.value=0;          
           reiniciar_calculos_bobinas_cortes_onda();
           document.form.kilos_bobina_seleccionada.focus();  
           alert("Error de Ancho de Bobina, El Segundo Corte no puede ser Mayor a: "+ancho_seleccionado_de_bobina+" (Mms)");
           return false;
        }        
        return false;
     }



     if (bobina_total>ancho_seleccionado_de_bobina)
     {
         document.form.bobinar_ancho_onda1.value=0;
         document.form.bobinar_ancho_onda2.value=0;
         document.form.bobinar_ancho_onda3.value=0;     
         document.form.kilos_orden_a_bobinar.value=0;    
         document.form.bobinar_ancho_onda2.readOnly = true;
         document.form.bobinar_ancho_onda3.readOnly = true;
        $("#"+div+"").html("");         
        $("#"+div3+"").html("");         
        $("#"+div2+"").html("");         
         alert("Error de Ancho de Bobina, La suma de los 3 Cortes no puede ser Mayor a: "+ancho_seleccionado_de_bobina);
     }    
 } 
 
 $(document).ready(function(){
 
    $("#tamano_1").on("keyup",function(){
        var a = $(this).val();
        var largo = $("#tamano_2").val();
        var tamano1 = $("#tamano_cuchillo_1").val();
        $.post(webroot+"cotizaciones/medidas",{ancho:a,largo:largo},function(resp)
        {
        var myObj = $.parseJSON(resp);
        a = myObj[0];
        largo = myObj[1];
        $("#tamano_1").val(a);
        $("#tamano_2").val(largo);
        });
            $("#ccac_1").val((parseInt(a)-parseInt(tamano1))*10);    
    });
    
    $("#tamano_2").on("keyup",function(){
        var a = $(this).val();
        var ancho = $("#tamano_1").val();
        var tamano2 = $("#tamano_cuchillo_2").val();

        $.post(webroot+"cotizaciones/medidas",{ancho:ancho,largo:a},function(resp)
        {
        var myObj = $.parseJSON(resp);
        a = myObj[1];
        ancho = myObj[0];
        $("#tamano_1").val(ancho);
        $("#tamano_2").val(a);
        });
            
            $("#ccac_2").val((parseInt(a)-parseInt(tamano2))*10);    
    });      

$('select[name=trazados]').on('change',()=>{
    var texto = $("select[name=trazados] option:selected").text(); 
    let cond = $('select[name=condicion_del_producto]').val();
    let nombre = $('input[name=producto]').val();
    //alert(cond);
    if(cond==0 && nombre==""){    //alert();
    $('input[name=producto]').val(texto);
    }
});
 
$("#reporte").on('click', function(){
    var valor = $(this).val();
    var cadena = $("#rutareporte").val();
    
    if(cadena==="productos/ajax_extra_productos"){
        var tipo = 1;
    }else{
        var tipo = 2;
    }
     
     if(tipo==1){
     var ruta = webroot + 'productos/reporte1';    
     }else{
     var ruta = webroot + 'productos/reporte2';        
     }
     var ruta = webroot + 'productos/reporte3';        
     
     window.location.href = ruta+"/"+valor+"/";
});
     
$("#buscar_index2").on('click',function(){
    var valor =$("#buscar_text").val();
    var ruta=webroot+"cotizaciones/searchop/";
     
   $.post(ruta,{id:valor},function(resp)
   {
       $("#buscar_index").val(resp);
        alert(resp);
   });
});  

$("#volver_a_cotizacion").on('click',function(){
    var valor =$("#buscar_text").val();
    var ruta=webroot+"cotizaciones/search";
    window.location.href = ruta+"/"+valor+"/";
});     
     
$("#cantidades_a_ingresar").on('keyup',function(){
    var valor = $(this).val();
    $("#despacho").attr('dato',valor);
    $("#despacho1").attr('dato',valor);
});     
     

$("select[class=comprobacion]").change(function(){ 
  var FN = $("#lleva_fondo_negro").val();
  var CF = $("#imprimir_contra_la_fibra").val();
  var II = $("#imagen_impresion").val();
  var ccac_1 = $("#ccac_1").val();
  var ccac;
  var cal_ccac;
  
  if(II=='NO' && FN=='' && CF == 'SI'){
      ccac='CCAC: 45mm'
      cal_ccac=45;}
  if(II=='NO' && FN=='' && CF == 'SI'){
      ccac='CCAC: 45mm'
      cal_ccac=45;}
  if(II=='NO' && FN=='' && CF == 'NO'){//valor por omisiòn sera 25
      ccac='CCAC: 25mm'
      cal_ccac=25;}
  if(II=='' && FN=='SI' && CF == 'NO'){
      ccac='CCAC: 25mm'
      cal_ccac=25;}
  if(II=='CO' && FN=='SI' && CF == 'NO'){
      ccac='CCAC: 25mm'
      cal_ccac=25;}
  if(II=='CO' && FN=='' && CF == 'SI'){
      ccac='CCAC: 45mm'
      cal_ccac=45;}
  if(II=='' && FN=='' && CF == 'NO'){//valor por omisiòn sera 25
      ccac='CCAC: 25mm'
      cal_ccac=25;}
  if(II=='' && FN=='' && CF == 'SI'){
      ccac='CCAC: 45mm'
      cal_ccac=45;}
  if(II=='' && FN=='' && CF == ''){ //valor por omisiòn sera 45
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='CE' && FN=='SI' && CF == ''){
      ccac='CCAC: 45mm'
      cal_ccac=25;}
  if(II=='CE' && FN=='SI' && CF == 'NO'){
      ccac='CCAC: 25mm'
      cal_ccac=25;}
  if(II=='CO' && FN=='SI' && CF == ''){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='' && FN=='NO' && CF == ''){//valor por omisiòn sera 45
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='NO' && FN=='SI' && CF == ''){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='CO' && FN=='' && CF == ''){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='CO' && FN=='SI' && CF == 'SI'){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='CE' && FN=='SI' && CF == 'SI'){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='CO' && FN=='NO' && CF == 'NO'){
      ccac='CCAC: 20mm'
  cal_ccac=20;}
  if(II=='CO' && FN=='' && CF == 'NO'){
      ccac='CCAC: 25mm'
  cal_ccac=25;}
  if(II=='CO' && FN=='NO' && CF == ''){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='CE' && FN=='' && CF == ''){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='CE' && FN=='NO' && CF == ''){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='CE' && FN=='NO' && CF == 'NO'){
      ccac='CCAC: 10mm'
  cal_ccac=10;}
  if(II=='CE' && FN=='' && CF == 'NO'){
      ccac='CCAC: 25mm'
  cal_ccac=25;}
  if(II=='' && FN=='NO' && CF == 'NO'){//valor por omisiòn sera 20
      ccac='CCAC: 20mm'
  cal_ccac=20;}
  if(II=='' && FN=='SI' && CF == ''){
      ccac='CCAC: 45mm'
  cal_ccac=25;}
  if(II=='' && FN=='NO' && CF == 'SI'){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='' && FN=='SI' && CF == 'SI'){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='NO' && FN=='SI' && CF == 'SI'){
      ccac='CCAC: 45mm'
  cal_ccac=45;}
  if(II=='NO' && FN=='' && CF == ''){//valor por omisiòn sera 45
      ccac='CCAC: 45mm'
      cal_ccac=45;}
  if(II=='CO' && FN=='NO' && CF == 'SI'){
      ccac='CCAC: 45mm'
      cal_ccac=45;}
  if(II=='CE' && FN=='' && CF == 'SI'){
      ccac='CCAC: 45mm'
      cal_ccac=45;}
  if(II=='CE' && FN=='NO' && CF == 'SI'){
      ccac='CCAC: 45mm'
      cal_ccac=45;}
  
   $("#valorccac").text(ccac);
   $("#ccac_o").val(cal_ccac);
  var ccac_o = $("#ccac_o").val();
    var msg = "El calculo CCAC1:"+ccac_1+" No puede ser menor a "+ccac_o+". Modifique el ancho a cortar.";
   
   if(ccac_1 < cal_ccac){
   $("#msgccac").text(msg);
   //$("#tamano_1").focus();
   }else{
   $("#msgccac").text('');
   }
        
});
 
 $("#ancho_seleccionado_de_bobina").on('blur',function () {
      var value = $(this).val();
      if(value > 1000){
      $("select[name=hay_que_bobinar] option[value='SI']").attr("selected",true);
      }      
 });
 
 $("select[name=tiene_color_modificado]").change(function(){
     var colorOption = $(this).val();
     //alert(colorOption);
     if(colorOption == "SI"){
         $("#numero_color_modificado").show(500);
     }else{
         $("select[name=numero_color_modificado]").val("");
         $("#numero_color_modificado").hide(500);
     }
 });
 
 $("select[name=tiene_color_modificado_ing]").change(function(){
     var colorOption = $(this).val();
     //alert(colorOption);
     if(colorOption == "SI"){
         $("#numero_color_modificado_ing").show(500);
     }else{
         $("select[name=numero_color_modificado_ing]").val("");
         $("#numero_color_modificado_ing").hide(500);
     }
 });
 //funciones para combos del barniz
 $("select[name=lleva_barniz]").change(function(){
     var valorOption = $(this).val();
     if(valorOption == "" || valorOption == "Nada" || valorOption == "No Se"){
         $("select[name=reserva_barniz]").val("");
         $("select[name=cala_caucho]").val("");
         $("#reserva_barniz").hide(500);
         $("#cala_caucho").hide(500);
     }else{
         $("#reserva_barniz").show(500);
     }
});
 
// $("select[name=ing_lleva_barniz]").change(function(){alert();
//     var valorOption = $(this).val();
//     if(valorOption == "" || valorOption == "Nada"){
//         $("select[name=ing_reserva_barniz]").val("");
//         $("select[name=ing_cala_caucho]").val("");
//         $("#ing_reserva_barniz").hide(500);
//         $("#ing_cala_caucho").hide(500);
//     }else{
//         $("#ing_reserva_barniz").show(500);
//     }
// });


 $("#ing_lleva_barniz").change(function(){
   
//     var valorOption = $(this).val();
//     if(valorOption == "" || valorOption == "Nada"){
//         $("select[name=ing_reserva_barniz]").val("");
//         $("select[name=ing_cala_caucho]").val("");
//         $("#ing_reserva_barniz").hide(500);
//         $("#ing_cala_caucho").hide(500);
//     }else{
//         $("#ing_reserva_barniz").show(500);
//     }
 });
 
 
 $("select[name=fot_lleva_barniz]").change(function(){
     var valorOption = $(this).val();
     if(valorOption == "" || valorOption == "Nada"){
         $("select[name=fot_reserva_barniz]").val("");
         $("select[name=fot_cala_caucho]").val("");
         $("#fot_reserva_barniz").hide(500);
         $("#fot_cala_caucho").hide(500);
     }else{
         $("#fot_reserva_barniz").show(500);
     }
 });
 
 $("select[name=reserva_barniz]").change(function(){
     var valorOption = $(this).val();
     //alert(valorOption);
     if(valorOption == "Con Reserva"){
         $("#cala_caucho").show(500);
     }else{
         $("select[name=cala_caucho]").val("");
         $("#cala_caucho").hide(500);
     }
 });
 
 $("select[name=ing_reserva_barniz]").change(function(){
     var valorOption = $(this).val();
     //alert(valorOption);
     if(valorOption == "Con Reserva"){
         $("#ing_cala_caucho").show(500);
     }else{
         $("select[name=ing_cala_caucho]").val("");
         $("#ing_cala_caucho").hide(500);
     }
 });
 
 $("select[name=fot_reserva_barniz]").change(function(){
     var valorOption = $(this).val();
     //alert(valorOption);
     if(valorOption == "Con Reserva"){
         $("#fot_cala_caucho").show(500);
     }else{
         $("select[name=fot_cala_caucho]").val("");
         $("#fot_cala_caucho").hide(500);
     }
 });
 //fin de funciones para combos del barniz

$("select[name=acabado_impresion_1]").change(function(){
     var valorOption = $(this).val();
     var conteo=0;
     var v1=0;
     var v2=0;
     var v3=0;
     if((valorOption != "") && (valorOption != 16)){
     $("#uno").val(1);    
     }else{
     $("#uno").val(0);    
     }
     var v1=parseInt($("#uno").val());
     var v2=parseInt($("#dos").val());
     var v3=parseInt($("#tres").val());
     var valor1=v1+v2+v3;
     $("#conteo").val(valor1+' Trabajos Internos');    
 });
 $("select[name=acabado_impresion_2]").change(function(){
     var valorOption = $(this).val();
     var conteo=0;
     var v1=0;
     var v2=0;
     var v3=0;
     if((valorOption != "") && (valorOption != 16)){
     $("#dos").val(1);    
     }else{
     $("#dos").val(0);    
     }
     var v1=parseInt($("#uno").val());
     var v2=parseInt($("#dos").val());
     var v3=parseInt($("#tres").val());
     var valor1=v1+v2+v3;
     $("#conteo").val(valor1+' Trabajos Internos');
 });
 $("select[name=acabado_impresion_3]").change(function(){
     var valorOption = $(this).val();
     var conteo=0;
     var v1=0;
     var v2=0;
     var v3=0;
     if((valorOption != "") && (valorOption != 16)){
     $("#tres").val(1);    
     }else{
     $("#tres").val(0);    
     }
     var v1=parseInt($("#uno").val());
     var v2=parseInt($("#dos").val());
     var v3=parseInt($("#tres").val());
     var valor1=v1+v2+v3;
     $("#conteo").val(valor1+' Trabajos Internos');
 });
 //trabajos externos
 $("select[name=acabado_impresion_4]").change(function(){
     var valorOption2 = $(this).val();
     var conteo2=0;
     var v4=0;
     var v5=0;
     var v6=0;
     if((valorOption2 != "") && (valorOption2 != 17)){
     $("#cuatro").val(1);    
     }else{
     $("#cuatro").val(0);    
     }
     var v4=parseInt($("#cuatro").val());
     var v5=parseInt($("#cinco").val());
     var v6=parseInt($("#seis").val());
     var valor2=v4+v5+v6;
     $("#conteo2").val(valor2+' Trabajos Externos');    
 });
 $("select[name=acabado_impresion_5]").change(function(){
     var valorOption2 = $(this).val();
     var conteo2=0;
     var v4=0;
     var v5=0;
     var v6=0;
     if((valorOption2 != "") && (valorOption2 != 17)){
     $("#cinco").val(1);    
     }else{
     $("#cinco").val(0);    
     }
     var v4=parseInt($("#cuatro").val());
     var v5=parseInt($("#cinco").val());
     var v6=parseInt($("#seis").val());
     var valor2=v4+v5+v6;
     $("#conteo2").val(valor2+' Trabajos Externos');
 });
 $("select[name=acabado_impresion_6]").change(function(){
     var valorOption2 = $(this).val();
     var conteo2=0;
     var v4=0;
     var v5=0;
     var v6=0;
     if((valorOption2 != "") && (valorOption2 != 17)){
     $("#seis").val(1);    
     }else{
     $("#seis").val(0);    
     }
     var v4=parseInt($("#cuatro").val());
     var v5=parseInt($("#cinco").val());
     var v6=parseInt($("#seis").val());
     var valor2=v4+v5+v6;
     $("#conteo2").val(valor2+' Trabajos Externos');

 });
 
 $("#btnparcial").on('click',function(){
        
    });
    
// $("#cantidades_a_ingresar").on('keyup',function(){
//        var a =$('#cantidad_de_cajas').val();
//        var c =$('#total_cajas_pendientes').val();
//        var b =$('#cantidades_a_ingresar').val();
//        $('#total_cajas_pendientes').val(c-b);
//    });
// $("#cantidades_a_ingresar").on('keydown',function(){
//        var a =$('#cantidad_de_cajas').val();
//        var c =$('#total_cajas_pendientes').val();
//        var b =$('#cantidades_a_ingresar').val();
//        $('#total_cajas_pendientes').val(c-b);
//    });
    
});
//
//$("document").ready(function(){
//var int1 = $("#uno").val();
//var int2 = $("#dos").val();
//var int3 = $("#tres").val();
//if(int1!="" && int1!=16){var uno=1;}else{var uno=0;}
//if(int2!="" && int1!=16){var dos=1;}else{var dos=0;}
//if(int3!="" && int1!=16){var tres=1;}else{var tres=0;}
//var totalInt = uno+'-'+dos+'-'+tres;
//
//alert(totalInt);
//});

function asignar_num(x){
    $("#num_cotizacion").val(x);
}

function generar() {
    var valor1 = $("input:text[name=cantidad_uno]").val();
    var valor2 = $("input:text[name=cantidad_dos]").val();
    var valor3 = $("input:text[name=cantidad_tres]").val();
    var valor4 = $("input:text[name=cantidad_cuatro]").val();
    var num = $("#num_cotizacion").val();
    
    if (valor1 == "0") {
        $("#etiqueta_uno").text("Su valor no puede ser 0!!!");
        return false;
    }else{
        if (valor1 == "") {
        $("#etiqueta_uno").text("Su valor no puede ser vacio!!!");
        return false;
        }else{
            if (valor2 == "0") {
        $("#etiqueta_dos").text("Su valor no puede ser 0!!!");
    }
    if (valor3 == "0") {
        $("#etiqueta_tres").text("Su valor no puede ser 0!!!");
    }
    if (valor4 == "0") {
        $("#etiqueta_cuatro").text("Su valor no puede ser 0!!!");
    }
    if (valor2 == "" || valor2 == "0") {
        $("input:text[name=cantidad_dos]").val(1);
    }
    if (valor3 == "") {
        $("input:text[name=cantidad_tres]").val(1);
    }
    if (valor4 == "") {
        $("input:text[name=cantidad_cuatro]").val(1);
    }
              var ruta = webroot + 'cotizaciones/ajax_recotizar';
            //document.getElementById(div).style.display = 'block';
            $.post(ruta, {valor1: valor1,valor2: valor2,valor3: valor3,valor4: valor4,num: num}, function (resp)
            {//alert(resp);
                //$("#centrar").attr('display','block');
                //$("#" + div + "").html(resp);
                $('.modal').modal('hide');
                $('.centrar').text(resp).show();                                                        
                $('.centrar').animate({
                               'margin-top':'-130px',
                               'opacity':'1'
                    },1200);
                $('.centrar').animate({
                               'opacity':'1'
                    },3400);
                $('.centrar').animate({
                               'opacity':'0'
                    },400);
                $('.centrar').animate({
                               'opacity':'1'
                    },400);
                $('.centrar').animate({
                               'opacity':'0'
                    },400);
                $('.centrar').animate({
                               'opacity':'1'
                    },400);
                $('.centrar').animate({
                               'opacity':'0'
                    },200);
                $('.centrar').show('false');   
                //alert(resp);
            });
        }    
    } 
    
}

// ultima funcion agrgada injssg 17/09/2017
function verificar_estatus_cliente(valor,div) 
{
  // alert(valor);
   alert("Verificando Cliente espere.");    
   var ruta=webroot+'ordenes/ajax_obtener_estatus_cliente';
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}


/*function verificar_estatus_cliente(valor,div) 
{
   alert("Verificando Cliente espere.");    
   var ruta=webroot+'ordenes/ajax_obtener_estatus_cliente';
   $.post(ruta,{valor:valor,div:div},function(resp)
   {
        $("#"+div+"").html(resp);
   });
}*/


function verificaAnchoSeleccionadoDeBobina(valor) 
{
    if (valor>900){
        setTimeout(Hay_Que_Bobinar_Carutlina('NO'),10000);  
        document.form.hay_que_bobinar.value='NO';            
    }       
}


    
    function repeticion(uno){
        var a = $(uno).parent().siblings('select').attr('name');
       // alert(a);
    }
    
    
function llenar_datos_proveedor(valor){
   var ruta=webroot+'ordenes/ajax_obtener_proveedor';
   $.post(ruta,{valor:valor},function(resp)
   {
       var resp1 = resp.split("|");
       
        $("#direccion_proveedor").val(resp1[0]);
        $("#horario_proveedor").val(resp1[1]);
        
   });
}

function llenar_etiquetas_proveedor(valor,id){
   var ruta=webroot+'ordenes/ajax_obtener_proveedor';
   $.post(ruta,{valor:valor},function(resp)
   {
       var resp1 = resp.split("|");
        $("#cantidad"+id).attr("disabled",false);
        $("#direccion"+id).text(" "+resp1[0]);
        $("#horario"+id).text(" "+resp1[1]);
        $("#idireccion"+id).val(" "+resp1[0]);
        $("#ihorario"+id).val(" "+resp1[1]);
   });
}


function btn_parcial(valor){
    if(valor=="parcial"){
    $("#btnparcial").show(1000);
    $("#total").hide(1000);
    }else{
    $("#btnparcial").hide(1000);
    $("#total").show(1000);
    $("#adicionales").html("");
    }
}

function llenar_proveedor(){
   var ruta=webroot+'ordenes/ajax_llenar_proveedor';
   var arreglo = [];
   var i = 0;
   var id=$('.adicional').length;
   id=parseInt(id)+1;
   $('.cantidad').each(function(index,element){
           arreglo[i]=$(this).attr('numero');
           i++;
   }); 
   id=id+'';
 while(arreglo.includes(id)===true){
    id=parseInt(id)-1;
    id=id+'';
}
   $.post(ruta,{id:id },function(resp)
   {
      $("#adicionales").append(resp);
   var regla=$('.adicional').length;
        $("#regla").val(regla);
   });
   
}
function llenar_proveedor2(id,x,c){
    if(c==""){
        c=0;
    }
    if(x==""){
        x=0;
    }
    var ruta=webroot+'ordenes/ajax_llenar_proveedor';
   $.post(ruta,{id:id },function(resp)
   {
      $("#adicionales").append(resp);
   var regla=$('.adicional').length;
        $("#regla").val(regla);
        $('#proveedor'+id).val(x).change();
        $('#cantidad'+id).val(c);
   });
   
}

function foco(){
    $('#cantidad1').focus();
}
function comprobar_monto(valor){
 
       var disp = $("input[name=cantidad_a_pegar]").val();
       var porcentaje = (disp*20)/100;
       var disptotal=parseInt(disp)+parseInt(porcentaje);
       var monto = $("input[name=cantidad_a_pegar]").val();
       var total=0;
       var input = valor;
       $('.cantidad').each(function(index,element){
           total= parseInt(total) + parseInt(this.value);
       }); 
       //var montototal = parseInt(monto) + total;
       var montototal = total;
       
       if(montototal > disptotal){
          alert("Debe corregir las cantidades (exceden la cantidad maxima + 20%)");
          return false;
          foco();
       }
}
    
    function eliminar_elemento(btn){
        for(var i=0;i<=2;i++){
         $(btn).parent().parent().after().siblings('div').eq(0).remove();
        }
         $(btn).parent().parent().after().remove();
         comprobar_monto();
         var regla=$('.adicional').length;
        $("#regla").val(regla);
    }
    function revision_ot() {
          var todo_correcto = true;
         
          if(document.getElementById('coment1').value.length < 4 ){
            todo_correcto = false;
          }else {
              var recepcion_ot = document.getElementById('recepcion_ot').value;
              var comentario_rechazo = document.getElementById('coment1').value;
              var fecha_rechazada_recepcion_OT = document.getElementById('fecha_rechazada_recepcion_OT').value;
              var id_cotizacion_rechazo = document.getElementById('id_cotizacion_rechazo').value;
              var tipo = document.getElementById('tipo').value;
              var id_nodo = document.getElementById('id_nodo').value;
          }
          if(!todo_correcto){
            alert('El campo Observacion debe tener minimo 4 caracteres');
          }else {
            var ruta = webroot+'produccion/ajaxguardar/';    
            $.post(ruta,{id_nodo:id_nodo,comentario_rechazo:comentario_rechazo,fecha_rechazada_recepcion_OT:fecha_rechazada_recepcion_OT,recepcion_ot:recepcion_ot,id_cotizacion_rechazo:id_cotizacion_rechazo,tipo:tipo},function(resp){
              $("#texto_notificado").html(resp);
              $("#texto_notificado").addClass('span_fecha_rechazado_verde');
              $("#id_boton_rechazar").hide();
            });
          }
          return todo_correcto;
        }
    function mostraria(x){
        if(x=="SI"){
        $("#ocultillo").show();
        }else{
        $("#ocultillo").hide();
        }
    }
    function recepcionado(x){
        if(x=="SI"){
        $("#fecha_recepcionada").show();
        }else{
        $("#fecha_recepcionada").hide();
        }
    }
    function otra_bobina(x){
        var tb1=$("#kilos_bobina_seleccionada").val();
        var tb2=$("#total_kilos").val();
        
        if(x=="NO"){
        if(parseInt(tb1)<parseInt(tb2)){
        $("#bobina_adicional").show();
        $("#numero_de_bobina2_div").show();
        }else{
        $("#bobina_adicional").hide();    
        $("#numero_de_bobina2_div").hide();    
        }
        }else{
        $("#bobina_adicional").hide();
        $("#numero_de_bobina2_div").hide();
        }
    }
    
    
    function totalbobinas(){
        var tk = parseInt($("#total_kilos").val());
        var b1 = parseInt($("#kilos_bobina_seleccionada").val());
        var b2 = parseInt($("#kilos_bobina_seleccionada2").val());
        var b3 = parseInt($("#segunda_bobina_adicional_kilos").val());
        var b4 = parseInt($("#tercera_bobina_adicional_kilos").val());
        var b5 = parseInt($("#cuarta_bobina_adicional_kilos").val());
        if($("#kilos_bobina_seleccionada").val()===""){b1=0;}
        if($("#kilos_bobina_seleccionada2").val()===""){b2=0;}
        if($("#segunda_bobina_adicional_kilos").val()===""){b3=0;}
        if($("#tercera_bobina_adicional_kilos").val()===""){b4=0;}
        if($("#cuarta_bobina_adicional_kilos").val()===""){b5=0;}
        var tg = b1+b2+b3+b4+b5;
        if(tg<tk){
        $("#bobina_adicional").show();
        }else{
        $("#kilos_bobina_seleccionada2").val(0);
        $("#bobina_adicional").hide();
        }
    }
    
    function reversar(x){
        $("#nro_orden_modal").html(x);
        $("#numero_op").val(x);
    }
    
        function colocar(x,c){
        document.getElementById('nro_de_cotizacion_despacho').innerHTML = x;
        document.getElementById('numero_ctd').value = x;
       // alert(x);
    }
        function colocar2(x,c){
        document.getElementById('nro_de_cotizacion').innerHTML = x;
        document.getElementById('numero_ct').value = x;
       // alert(x);
    }
    
    function alertpdf(){
  if(parseInt($("#file")[0].files[0].size)>1024000){
  $("#etiquetapdf").text("El archivo no puede ser procesado porque sobrepasa de 1MB");
  $("#file").val("");
  $("#fileerror").val("1");
  }
  };
  
  function generar_fabricacion(x) {
      // $("#generar").on("click",function(){ 
      
      
                    var tipo = x;
                    if(tipo == 1){
                    var num = $("#idmolde").val();    
		    var valor1 = $("#motivo1").val();
                    }else{
                    if(tipo == 2){
                    var num = $("#idmolde2").val();    
		    var valor1 = $("#motivo2").val();
                    }}
                    
                    if (valor1 == "") {
                        alert("Debe indicar un motivo!!!");
                        return false;
                    }
                    
                    
            var ruta = webroot + 'moldes/instruccion';
            
//            $.post(ruta, {valor1: valor1,valor2: valor2,num : num}, function (resp)
//            {alert();
//                $('.modal').modal('hide');
//            }); 
            window.location.href = ruta+"/"+valor1+"/"+num+"/"+tipo;
  
}

function cambiobarniz(x){
 var valorOption = x.value;
    if(valorOption == "" || valorOption == "Nada" || valorOption == "No Se"){
         $("select[name=reserva_barniz]").val("");
         $("select[name=cala_caucho]").val("");
         $("#ing_reserva_barniz").hide(500);
         $("#ing_cala_caucho").hide(500);
     }else{
         $("#ing_reserva_barniz").show(500);
     }
}

function cambioreserva(x){

     var valorOption = x.value;
     //alert(valorOption);
     if(valorOption == "Con Reserva"){
         $("#ing_cala_caucho").show(500);
     }else{
         $("select[name=ing_cala_caucho]").val("");
         $("#ing_cala_caucho").hide(500);
     }

}
