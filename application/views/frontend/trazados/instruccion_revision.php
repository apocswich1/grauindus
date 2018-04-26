<script type="text/javascript">
      $(function() { 
          $("#imprimir2").click(function() { alert();
              html2canvas($("#contenido"), {
                  onrendered: function(canvas) {
                      theCanvas = canvas;
                      document.body.appendChild(canvas);
                      /*
                      canvas.toBlob(function(blob) {
                        saveAs(blob, "Dashboard.png"); 
                      });
                      */
                  }
              });
          });
      });
    </script>
<?php 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 //print_r($datos);
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
        <script type="text/javascript" src="<?php echo base_url();?>public/frontend/js/funciones.js"></script>
<style type="text/css">
    body{
    margin:100px 0 auto;
    }
   
</style>
        <style>
            body {
 /* background: rgb(204,204,204); */
}
.container{
padding: 20px 20px 20px 20px;
width:1000px;
height:800px;
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

.menulateral tr{
height:40px;
}

select{
width:250px;
}

.encabezado{
border:1px solid;
width:900px;
margin:60px auto;
}

.encabezado th{
background-color:#e3e3e3;
}
.encabezado tr:nth-child(even) {background-color: #f2f2f2;}



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
  window.print();
}

function printDiv2(x) 
{
 javascript:print(x);
}

</script>
            </head>
			<body>';
    $cuerpo.='<div class="container" id="container"><br /><br />';
         
    $cuerpo.='<table style="width: 1000px;">';
    $cuerpo.='
    <tr>
        <td colspan="3" style="text-align: center;"><h1>Instruccion de Revision de Molde</h1></td>
    </tr>
</table>';  
 $fecha=fecha(date('Y-m-d'));
    $cuerpo.='<table class="encabezado">
        <tr><th colspan="2">Caracteristicas del Molde</th></tr>
        <tr>
        <td>Nro de Molde</td>
        <td>'.$datos->numero.'</td>
        </tr>
        <tr>
        <td>Fecha</td>
        <td>'. fecha_con_hora($datos->fecha).'</td>
        </tr>
        <tr>
        <td>Nombre Cliente</td>
        <td>'.$datos->razon_social.'</td>
        </tr>
        <tr>
        <td>Nombre de Molde</td>
        <td>'.$datos->nombre.'</td>
        </tr>
        <tr>
        <td>Tamaño de Molde</td>
        <td>'.$datos->tamano_caja.'</td>
        </tr>
        <tr>
        <td>Tipo de Molde</td>
        <td>'.$datos->tipo.'</td>
        </tr>
        <tr>
        <td>Ancho de Bobina</td>
        <td>'.$datos->ancho_bobina.'</td>
        </tr>
        <tr>
        <td>Largo de Bobina</td>
        <td>'.$datos->largo_bobina.'</td>
        </tr>
        <tr>
        <td>Distancia Cuchillo a Cuchillo</td>
        <td>'.$datos->cuchillocuchillo.' - '.$datos->cuchillocuchillo2.'</td>
        </tr>'; 
        $archivo="http://localhost/trabajo/public/uploads/$datos->archivo";
        

   
  	$cuerpo.='</table>';
    $cuerpo.='<table class="encabezado">
        <tr><th colspan="2">Motivo de la Revision</th></tr>
        <tr>
        <td>Motivo de la Revision:</td>
        <td>'.str_replace("%20", " ", $motivo).'</td>
        </tr>
        <tr>
        <td>Solicitado por:</td>
        <td>'.$this->session->userdata('nombre').'</td>
        </tr>';
    
    
          
    $cuerpo.='</table>';
  	$cuerpo.='</table>';
    $cuerpo2.='<table class="encabezado">
        <tr><th colspan="2">Grafica del Molde</th></tr>
        <tr>
        <td><embed width="900px" height="500px" src="'.$archivo.'"</embed></td>
        </tr>
        </tr>'; 
          
    $cuerpo.='</table>';
        
    $cuerpo.='<table align="center">';
     $cuerpo.='<tr>
        <td colspan="">
        <br />
        </td>
        </tr>'; 
        $cuerpo.='<tr>
        <td colspan="" style=" text-align: center; ">
            JUAN FRANCISCO RIVAS 9435 FONOS : 22 495 9500
            <br />
            LA CISTERNA - SANTIAGO <br />
            WWW.GRAUINDUS.CL
        </td>
        </tr>'; 
    
    $cuerpo.='</table><br /><br />
        <table style="width:100%"><tr>
        <td style="text-align:center">
<input type="button" name="imprimir" value="Imprimir" id="imprimir" onclick="printDiv()"/>
<input type="button" name="imprimir" value="Imprimir Trazado" id="imprimir2" onclick="window.open(\''.base_url().'public/uploads/'.$datos->archivo.'\',\'_blank\');"/>
</td></tr></table>';
    
      $cuerpo.='</body></html>';
/********************Segunda Pagina***************************/
    
     echo $cuerpo;
     ?>
<script src="<?php echo base_url();?>public/frontend/js/filesaver.js"></script>
<script src="<?php echo base_url();?>public/frontend/js/html2canvas.js"></script>