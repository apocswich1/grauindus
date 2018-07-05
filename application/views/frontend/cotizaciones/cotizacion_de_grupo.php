<?php
//print_r($grupo);exit();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($datos->id_cliente==3000)
        {
            $cliente=strtoupper($datos->nombre_cliente);
            $correo="";
            $direccion="";
            $ciudad="";
            $comuna="";
            $rut="";
            $telefono="";

        }else
        {
            $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
            $cliente= strtoupper($cli->razon_social);
            $correo=$cli->correo;
            $direccion=$cli->direccion;
            $ciudad=$cli->ciudad;
            $comuna=$cli->comuna;
            $rut=$cli->rut;
            $telefono=$cli->telefono;
            $contacto=$this->clientes_model->geContactosClientePorIdUltimo($datos->id_cliente);
            $nombre_contacto= $cli->contacto_cliente;
        }
 $cuerpo='<!doctype html>
			<html> 
            <head>
            <meta charset="utf-8" />
            <title>..:: Control de Gestión - Empresas Grau ::..</title>
	<meta charset="utf-8" />
      	<link rel="shortcut icon" href="<?php echo base_url()?>public/backend/img/favicon.ico" />
        <meta name="language" content="Spanish" />
        <meta name="copyright" content="www.cesarcancino.com" />
        <meta name="designer" content="César Cancino Zapata" />
        <meta name="author" content="www.cesarcancino.com" />      
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>bootstrap/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>bootstrap/estilos.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/backend/fancybox/jquery.fancybox.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/frontend/css/prism.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/frontend/css/chosen.css" />

        <script type="text/javascript" src="<?php echo base_url()?>public/backend/fancybox/jquery.fancybox.js"></script>
        <script type="text/javascript" src="http://localhost/trabajo/public/frontend/js/funciones.js"></script>
<style type="text/css">
    body{
    margin:100px 0 auto;
    }
    .tabla
    {
      //   border: #000099; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; width: 1000px;
    }
</style>
        <style>
            body {
  background: rgb(204,204,204); 
}
.container{
padding: 20px 20px 20px 20px;
width:1000px;
height:1350px;
margin:0 auto;
background-color:#fff;
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
  
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}

.menulateral{
border-shadows:10 10 10 10 5px 5px 5px 5px;
background-color:#ffffff;
position:fixed;
height:450px;
width:260px;
float:left;
}

.menulateral tr{
height:40px;
}

select{
width:250px;
}

        </style>
<script>

function llenartapa(x){
document.getElementById("placa").innerHTML = x;
}
function llenaronda(x){
document.getElementById("onda").innerHTML = x;
}
function llenarliner(x){
document.getElementById("liner").innerHTML = x;
}
function llenarcolores(x){
if(x==0){
document.getElementById("colores").innerHTML = "Sin impresion";
}else{
document.getElementById("colores").innerHTML = "Impreso a "+x+" colores";
}}

function printDiv() 
{

  var divToPrint=document.getElementById("menulateral");
  var imprimir=document.getElementById("imprimir");
  divToPrint.style.display = "none";
  imprimir.style.display = "none";
  window.print();
  divToPrint.style.display = "";
  imprimir.style.display = "";
}

function aclaratoria(x){
//alert(x);
if(x!=""){
document.getElementById("aclaratoria1").innerHTML = "Nota: "+x;
}else{
document.getElementById("aclaratoria1").innerHTML = "";
}
}
</script>
            </head>
			<body>
                        
    <div class="menulateral" id="menulateral">
    <table width="100%">
    <th colspan="2" style="text-align:center; background-color:#444; color:#fff;">
    <span>Modificacion de Detalles</span>
    </th>
    <tr>
    <td>Colores:
    <select style="width:100px" onchange="llenarcolores(this.value);">
    <option>0</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    </select>
    </td>
    </tr>
    <tr>
    <td colspan="2">Tapa</td>
    </tr>
    <tr>
    <td colspan="2" style="text-align:left">
    <select name="materialidad_1" onchange="llenartapa(this.value);">
    <option value="0">Seleccione......</option>';
    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa){
                    if (sizeof($ing)>0) {                 
                     $cuerpo.="<option value='$tapa->nombre'"; 
                         if($ing->materialidad_1==$tapa->nombre){
                              $cuerpo.='selected="true">';
                             
                         }
                          $cuerpo.="> $tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso )</option>";
                        } else {
                     $cuerpo.="<option value='$tapa->nombre'"; 
                         if($ing->materialidad_1==$tapa->nombre){
                             $cuerpo.='selected="true">';
                     
                             }
                              $cuerpo.="$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso )</option>";
                     }
                    }
    $cuerpo.='</select></td>
    </tr>
    <tr>
    <td colspan="2">Onda</td>
    </tr>
    <tr>
    <td colspan="2" style="text-align:left">
    <select name="materialidad_1" onchange="llenaronda(this.value);">
    <option value="0">Seleccione......</option>';
    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa){
                    if (sizeof($ing)>0) {                 
                     $cuerpo.="<option value='$tapa->nombre'"; 
                         if($ing->materialidad_1==$tapa->nombre){
                              $cuerpo.='selected="true">';
                             
                         }
                          $cuerpo.="> $tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso )</option>";
                        } else {
                     $cuerpo.="<option value='$tapa->nombre'"; 
                         if($ing->materialidad_1==$tapa->nombre){
                             $cuerpo.='selected="true">';
                     
                             }
                              $cuerpo.="$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso )</option>";
                     }
                    }
    $cuerpo.='</select></td>
    </tr>
    <tr>
    <td colspan="2">Liner</td>
    </tr>
    <tr>
    <td colspan="2" style="text-align:left">
    <select name="materialidad_1" onchange="llenarliner(this.value);">
    <option value="0">Seleccione......</option>';
    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa){
                    if (sizeof($ing)>0) {                 
                     $cuerpo.="<option value='$tapa->nombre'"; 
                         if($ing->materialidad_1==$tapa->nombre){
                              $cuerpo.='selected="true">';
                             
                         }
                          $cuerpo.="> $tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso )</option>";
                        } else {
                     $cuerpo.="<option value='$tapa->nombre'"; 
                         if($ing->materialidad_1==$tapa->nombre){
                             $cuerpo.='selected="true">';
                     
                             }
                              $cuerpo.="$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso )</option>";
                     }
                    }
    $cuerpo.='</select></td>
    </tr>
    <tr>
    <td>Aclaratoria: </td>
    </tr>
    <tr>
    <td><textarea id="texto" onkeyup="aclaratoria(this.value)" onkeypress="aclaratoria(this.value)" value=""/></textarea>
    </tr>
    </table>
    </div>
    <div class="container" id="container">';
         
    $cuerpo.='<table style="width: 1000px;">';
    $cuerpo.='
    <tr>
        <td colspan="3" style="text-align: center;"><h1>Cartonajes GRAU</h1></td>
    </tr>
';        
 $cuerpo.='<tr>
        <td>
            RUT : 79.897.500-5
        <td style="text-align:center">
            <span style="text-decoration:underline; text-align:center">PRESUPUESTO</span> N° '.$id.'</td><br /><br /><br />
        <td colspan="2">
            <span style="text-decoration:underline;">Fecha:</span> '.
 fecha(date('Y-m-d')).'
        </td><br /><br /><br />
    </tr>'; 
     $cuerpo.='    <tr>
        <td colspan="2">
            SEÑORES
            <br />
            '.$cliente.'
        </td>
    </tr>'; 
     if(sizeof($nombre_contacto!="")){
     $cuerpo.='    <tr>
        <td colspan="2">
            ATENCION Sr(a): '.$nombre_contacto.'
        </td>
     </tr>'; }
    $cuerpo.='<tr>
        <td colspan="2">
             &nbsp;
        </td>
    </tr>';    
     $cuerpo.='
        <tr>
        <td>
             '.utf8_decode($direccion).', '.utf8_decode($comuna).', '.utf8_decode($ciudad).'
        </td>
        </tr>
        <tr>
        <td>
        Rut : '.esRut($rut).'
        </td>
    </tr>';     
    $cuerpo.='    <tr>
        <td colspan="2">
             FONO : '.$telefono.'
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              AT : '.$contacto->nombre.'
        </td>
    </tr>';    
     $cuerpo.='    <tr>
        <td colspan="2">
             <br />
             DE NUESTRA CONSIDERACIÓN:
             <br / >
             Tenemos el agrado, de acuerdo a las condiciones estipuladas a continuación, cotizarle lo siguiente:
        </td>
    </tr>';     
  	$cuerpo.='</table>';
    $cuerpo.='<table class="tabla">';
     $cuerpo.='    <tr>
        <td style="width: 150px;">
            UNIDADES
        </td>
        <td style="width: 300px;">
        DETALLE DE GRUPO
        </td>
        <td style="width: 150px; text-align:center">
        VALOR UNITARIO
        </td>
    </tr>';  
     
     if($fotomecanica->colores=="" || $fotomecanica->colores==0)
            $colores="Sin impresion de colores";
    else
            $colores="Impreso a ".$fotomecanica->colores." colores";
    
    if($fotomecanica->fot_lleva_barniz=="" || $fotomecanica->fot_lleva_barniz=="Nada")
            $barniz=",";
    else
            $barniz=$fotomecanica->fot_lleva_barniz.",";
    
    if($fotomecanica->materialidad_1=="" || $fotomecanica->materialidad_1==NULL){
            $placa=",";
            $gramaje="";
    }else{
            $placa=explode(" ",$fotomecanica->materialidad_1);
            $placa[0]="en ".$placa[0].",";
            $gramaje=" ".intval(preg_replace('/[^0-9]+/', '', $fotomecanica->materialidad_1), 10)." gramos,";
    }
    
    if($grupo->idc_01!="" || $grupo->idc_01!=0){
        
    }
    
    $materialidad = $fotomecanica->materialidad_datos_tecnicos;
    $tipodematerial=$this->materiales_model->getMaterialesNombreTipo($fotomecanica->id_mat_placa1);   
    $materialidaduno=$this->materiales_model->getMaterialesReversoPorId($fotomecanica->id_mat_placa1);   
    $reversoliner=$this->materiales_model->getMaterialesReversoPorId($fotomecanica->id_mat_liner3);   
    //echo $fotomecanica->materialidad_1."-".$fotomecanica->materialidad_2."-".$fotomecanica->materialidad_3;
    //echo $materialidaduno->tipomaterial; exit();
    //echo $fotomecanica->materialidad_3;
    //print_r($reversoliner);exit();
    if($reversoliner=="")
    $reversoliner=" ";   
    else
    $reversoliner="Reverso ".$reversoliner->reverso;   
    
    if($hoja->gramos_metro_cuadrado=="")
    $gmc=" ";   
    else
    $gmc=", ".$hoja->gramos_metro_cuadrado." gramos";
    
    //medidas de la caja
    $tamano1=$ing->medidas_de_la_caja;
    $tamano2=$ing->medidas_de_la_caja_2;
    $tamano3=$ing->medidas_de_la_caja_3;
    $tamano4=$ing->medidas_de_la_caja_4;
    
    
    if(($tamano1 != 0) && ($tamano1 != "")){
        if($tamano4=="" || $tamano4 == 0){
        $tamano=", Medidas ".$tamano1." x ".$tamano2." x ".$tamano3." cms.";    
        }else{
        $tamano=", Medidas ".$tamano1." x ".$tamano2." x ".$tamano3." x ".$tamano4." cms.";    
        }
    }else{
        $tamano="";
    }
    //print_r($hoja);
    $cuerpo.='<tr>
        <td colspan="3"><hr /></td></tr>';
     $cuerpo.='    <tr>
        <td style="width: 150px;">
            '.number_format($datos->cantidad_1,0,'','.').'
        </td>
        <td style="width: 300px; font-size:18px;">
            '.$grupo->grupo.' <span id="colores">'.$composicion.'</span>
        </td>
        <td style="width: 150px; text-align:center">$
        '.number_format($hoja->valor_empresa,0,'','.').'
        </td>
    </tr>'; 
    if($datos->cantidad_2>1)
    {
       $cuerpo.='    <tr>
        <td style="width: 150px;">
            '.number_format($datos->cantidad_2,0,'','.').'
        </td>
        <td style="width: 300px;">
            ""'.$ing->qproducto.'
        </td>
        <td style="width: 150px; text-align:center">
        $ '.number_format($hoja->valor_empresa_2,0,'','.').'
        </td>
    </tr>';  
    }
    if($datos->cantidad_3>1)
    {
    $cuerpo.='    <tr>
        <td style="width: 150px;">
            '.number_format($datos->cantidad_3,0,'','.').'
        </td>
        <td style="width: 300px;">
            ""'.$ing->qproducto.'
        </td>
        <td style="width: 150px; text-align:center">
        $ '.number_format($hoja->valor_empresa_3,0,'','.').'
        </td>
    </tr>'; 
    }
    if($datos->cantidad_4>1)
    {
    $cuerpo.='    <tr>
        <td style="width: 150px;">
            '.number_format($datos->cantidad_4,0,'','.').'
        </td>
        <td style="width: 300px;">
            '.$ing->producto.'
        </td>
        <td style="width: 150px; text-align:center">
        $ '.number_format($hoja->valor_empresa_4,0,'','.').'
        </td>
    </tr>'; 
    }
    $cuerpo.='<tr>
        <td colspan="3">
            <br /><br /><br /><br />
        </td>
        </tr>'; 
    //print_r($ing);exit();
    
    if($fotomecanica->colores=="" || $fotomecanica->colores==0)
            $colores="Sin impresion de colores";
    else
            $colores="Impreso a ".$fotomecanica->colores." colores";
    
    if($fotomecanica->fot_lleva_barniz=="" || $fotomecanica->fot_lleva_barniz=="Nada")
            $barniz=",";
    else
            $barniz=$fotomecanica->fot_lleva_barniz.",";
    
    if($fotomecanica->materialidad_1=="" || $fotomecanica->materialidad_1==NULL){
            $placa=",";
            $gramaje="";
    }else{
            $placa=explode(" ",$fotomecanica->materialidad_1);
            $placa[0]="en ".$placa[0].",";
            $gramaje=" ".intval(preg_replace('/[^0-9]+/', '', $fotomecanica->materialidad_1), 10)." gramos,";
    }
    
    $materialidad = $fotomecanica->materialidad_datos_tecnicos;
    $materialidaduno=$this->materiales_model->getMaterialesReversoPorNombre($fotomecanica->materialidad_1);   
    $reversoliner=$this->materiales_model->getMaterialesReversoPorNombre($fotomecanica->materialidad_3);   
    //echo $fotomecanica->materialidad_1."-".$fotomecanica->materialidad_2."-".$fotomecanica->materialidad_3;
    //echo $materialidaduno->tipomaterial; exit();
    //echo $fotomecanica->materialidad_3;
   // print_r($materialidaduno);exit();
    if($reversoliner=="")
    $reversoliner=" ";   
    else
    $reversoliner="Reverso ".$reversoliner->reverso;   
    
    if($hoja->gramos_metro_cuadrado=="")
    $gmc=" ";   
    else
    $gmc=", ".$hoja->gramos_metro_cuadrado." gramos";
    
    //medidas de la caja
    $tamano1=$ing->medidas_de_la_caja;
    $tamano2=$ing->medidas_de_la_caja_2;
    $tamano3=$ing->medidas_de_la_caja_3;
    $tamano4=$ing->medidas_de_la_caja_4;
    
//    if($tamano1 == "" || $tamano2 == "" || $tamano3 == "" || $tamano4 == ""){
//        $tamano="";
//    }else{
//        $tamano=", Medidas ".$tamano1." x ".$tamano2." x ".$tamano3." x ".$tamano4." cms";
//    }
    
    if(($tamano1 != 0) && ($tamano1 != "")){
        if($tamano4=="" || $tamano4 == 0){
        $tamano=", Medidas ".$tamano1." x ".$tamano2." x ".$tamano3." cms.";    
        }else{
        $tamano=", Medidas ".$tamano1." x ".$tamano2." x ".$tamano3." x ".$tamano4." cms.";    
        }
    }else{
        $tamano="";
    }
    
    
        
    $cuerpo3.='<tr>
        <td colspan="3">
            <div style="font-size:22px">
                <span id="colores">'.$colores.'</span>, '.$barniz.' <span id="placa">'.$materialidaduno->tipomaterial.'</span>'.$gramaje.' <span id="onda"></span><span id="liner"></span> '.$materialidad.', '.$reversoliner.''.$tamano.'
                </div>
        </td>
        </tr>'; 
    $cuerpo.='<tr>
        <td colspan="3">
            <div style="font-size:18px">
                <span id="aclaratoria1"></span>
                </div>
        </td>
        </tr>'; 
        $cuerpo.='</table>';
        $cuerpo.='<table class="tabla">';
     $cuerpo.='<tr>
        <td colspan="3"><hr /></td></tr>';
    $cuerpo.='    <tr>
        <td>
            <span style="text-decoration:underline;; font-weight: bold;">CONDICIONES DE VENTA</spaN>
        </td>
        <td>
        &nbsp;
        </td>
        <td>
        &nbsp;
        </td>
    </tr>'; 

    $cuerpo.='<tr>
        <td colspan="3"><hr /></td></tr>';
        $forma_pago=$this->clientes_model->getFormasPagoPorId($datos->forma_pago);
        $trazadosing=$this->trazados_model->getTrazadosPorId($datos->trazado);
        if(sizeof($trazadosing)){
            $trazado = "- TRAZADO DEL PRODUCTO DE ACUERDO A LAS<BR />&nbsp; INDICACIONES DEL CLIENTE";
        }
        if($datos->envasado==""){
            $formap="Paquetes";
        }else{
            $formap=$datos->envasado;
        }
    $cuerpo.='    
	<tr>
        <td>
            - PRECIOS NETOS MÁS I.V.A
            <br />
            - FORMA DE PAGO : '.$forma_pago->forma_pago.'
            <br />
            - VARIACIONES DE CANTIDAD +-10%
            <br />
            '.$trazado.'
        </td>
        <td>
        &nbsp;
        </td>
        <td>
        - FORMA DE ENTREGA : '.$formap.'
            <br />
            - PLAZO DE ENTREGA : 20 Días
            <br />
            - VALIDEZ DE PRESUPUESTO, 30 Días
            <br / >
            - PUESTO EN SANTIAGO
        </td>
    </tr>';   
  
    if($datos->numero_molde=="21"){
        $trazadomolde="Trazado: ".$datos->trazado;
    }else{
        $trazadomolde="Molde: ".$datos->numero_molde;
    }
    $cuerpo.='    
	<tr>
        <td>
        </td>
		
        <td>
        </td>
		
        <td>
        <strong>- Condición del Producto: '.$fotomecanica->condicion_del_producto.' ('.$trazadomolde.')</strong>
        </td>
    </tr>';   
  

$cuerpo.='</table>';

    $productos="";
        if($productosGrauSpa!='')
	{   
            foreach ($productosGrauSpa as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}
        if($productosGrauLtda!='')        
	{        
            foreach ($productosGrauLtda as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}       
        if($productosMicrobox!='')        
	{              
            foreach ($productosMicrobox as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}   
        if($productosPubligrafika!='')        
	{
            foreach ($productosPubligrafika as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}  

        if($productosTenspa!='')        
	{                
            foreach ($productosTenspa as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}   

//        if ($productos=="")
//        {
//             $cuerpo.='<tr><td colspan="4"><strong>No hay productos Registrados en Almacen</strong></td></tr>';
//        }
//        else $cuerpo.=$productos;
        
    $cuerpo.='</table>';
     $cuerpo.='<br/>';     
    $cuerpo.='<table>';
     $cuerpo.='<tr>
        <td style=" text-align: center;">
            <strong>En espera de una favorable acogida a la presente, atentamente</strong>
        </td>
        </tr>'; 
    $cuerpo.='</table>';
    
    $cuerpo.='<table>';
     $cuerpo.='<tr>
        <td colspan="3">
            <hr />
            <br />
        </td>
        </tr>'; 
    $cuerpo.='    <tr>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper ($vendedor->nombre).'
            <br />
            ________________________________
            <br />
            <center><span style="font-style: oblique; font-weight: bold;">EJECUTIVO COMERCIAL</span></center>
        </td>
         <td>
            &nbsp;
            <br />
            __________________________________________________________
            <br />
            <center><span style="font-style: oblique; font-weight: bold;">ACEPTADO</span></center>
        </td>
         <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           ENRIQUE GRAU A.
            <br />
            ________________________________
            <br />
           <center> <span style="font-style: oblique; font-weight: bold;">GERENCIA COMERCIAL</span></center>
        </td>
    </tr>'; 
    $cuerpo.='<tr>
        <td colspan="3">
            <br /><br /><br />
        </td>
        </tr>'; 
        $cuerpo.='<tr>
        <td colspan="3" style=" text-align: center; ">
            JUAN FRANCISCO RIVAS 9435 FONOS : 22 495 9500
            <br />
            LA CISTERNA - SANTIAGO <br />
            WWW.GRAUINDUS.CL
        </td>
           
        </td>
        </tr>'; 
    
    $cuerpo.='</table><br /><br />
        <table style="width:100%"><tr>
        <td style="text-align:center">
<input type="button" name="imprimir" value="Imprimir" id="imprimir" onclick="printDiv()"/>
</td></tr></table>';
    
      $cuerpo.='</body></html>';
/********************Segunda Pagina***************************/
$cuerpo2='<!doctype html>
			<html> 
            <head>
            <meta charset="utf-8" />
            
<style type="text/css">
    .tabla
    {
         border: #000099; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; width: 1200px;
    }
</style>
            </head>
			<body>';

  $cuerpo2.='<table style="width: 1000px;">';
          
 $cuerpo2.='    <tr>
        <td colspan="2">
            RUT : 79.897.500-5
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="text-decoration:underline;">PRESUPUESTO</span> N° '.$id.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
 fecha(date('Y-m-d')).'
        </td><br /><br /><br />
    </tr>';   
     $cuerpo2.='    <tr>
        <td colspan="2">
            SEÑORES
            <br />
            '.$cliente.'
        </td>
    </tr>'; 
    $cuerpo2.='    <tr>
        <td colspan="2">
             &nbsp;
        </td>
    </tr>';    
     $cuerpo2.='    <tr>
        <td colspan="2">
             '.$direccion.', '.$comuna.', '.$ciudad.'
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Rut : '.esRut($rut).'
        </td>
    </tr>';     
    $cuerpo2.='    <tr>
        <td colspan="2">
             FONO : '.$telefono.'
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              AT : '.$contacto->nombre.'
        </td>
    </tr>';    
         
  	$cuerpo2.='</table>';

    $cuerpo2.='<table style="width: 1000px;">';
 $cuerpo2.='<tr>
        <td colspan="3"><hr /></td></tr>';
    $cuerpo2.='    <tr>
        <td>
            <span style="text-decoration:underline;; font-weight: bold;">PRODUCTOS REGISATRADOS EN ALMACEN</spaN>
        </td>
        <td>
        &nbsp;
        </td>
        <td>
        &nbsp;
        </td>
    </tr>'; 
$cuerpo2.='</table>';


$cuerpo2.='<table class="tabla">';
    $cuerpo2.='<tr>
        <td>
            <strong>CODIGO</strong>
        </td>
        <td>
            <strong>DESCRIPCIÓN</strong>
        </td>
        <td>
            <strong>UNIDAD</strong>
        </td>
        <td>
            <strong>COSTO</strong>
        </td>        
    </tr>'; 
    $productos="";
        if($productosGrauSpa!='')
	{   
            foreach ($productosGrauSpa as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}
        if($productosGrauLtda!='')        
	{        
            foreach ($productosGrauLtda as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}       
        if($productosMicrobox!='')        
	{              
            foreach ($productosMicrobox as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}   
        if($productosPubligrafika!='')        
	{
            foreach ($productosPubligrafika as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}  

        if($productosTenspa!='')        
	{                
            foreach ($productosTenspa as $valor)
                {
                    $productos.='<tr>';            
                    $productos.='<td>'.$valor["CodProd"].'<br></td>';
                    $productos.='<td>'.$valor["DesProd"].'<br></td>'; 
                    $productos.='<td>'.$valor["CodUMed"].'<br></td>'; 
                    $productos.='<td>'.$valor["CostoUnitario"].'<br></td>'; 
                    $productos.='</tr>';  
                }
	}   

        if ($productos=="")
        {
             $cuerpo2.='<tr><td colspan="4"><strong>No hay productos Registrados en Almacen</strong></td></tr>';
        }
        else $cuerpo2.=$productos;
        
    $cuerpo2.='</table>    
</div>        
</body>
</html>';
     $cuerpo2.='<br/>'; 
     
     
     echo $cuerpo;