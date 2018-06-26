<?php 
$hoja=$this->cotizaciones_model->getHojaDeCostos2PorIdCotizacion($id);
//print_r($hoja);
//fecha de emision*****************************************************************************
if(sizeof($hoja)>0){$fecha_emision='<strong>(Guardada el '.fecha($hoja->fecha).')</strong>';}else{$fecha_emision=fecha($datos->fecha);}
//datos del encabezado *************************************************************************
$numero_costo=$id;
$orden_produccion=$orden->id_antiguo;
$numero_costo_antiguo=$datos->ot_antigua;
$fecha=fecha($datos->fecha);
$nombre=$cli->razon_social;
$direccion=$cli->direccion;
$telefono=$cli->telefono;
$vendedor=$vendedor->nombre;
$costeo=$user->nombre;
$email=$cli->correo;
$rut=$cli->rut;
$ciudad=$cli->ciudad;
$comuna=$cli->comuna;
$at=$cli->contacto;


if ($datos->cantidad_1 == "" || $datos->cantidad_1 == 0) {
    $datoscantidad1 = 1;
} else {
    $datoscantidad1 = $datos->cantidad_1;
}
if ($datos->cantidad_2 == "" || $datos->cantidad_2 == 0) {
    $datoscantidad2 = 1;
} else {
    $datoscantidad2 = $datos->cantidad_2;
}
if ($datos->cantidad_3 == "" || $datos->cantidad_3 == 0) {
    $datoscantidad3 = 1;
} else {
    $datoscantidad3 = $datos->cantidad_3;
}
if ($datos->cantidad_4 == "" || $datos->cantidad_4 == 0) {
    $datoscantidad4 = 1;
} else {
    $datoscantidad4 = $datos->cantidad_4;
}
$materialidad_1=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_placa1);
$materialidad_2=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
$materialidad_3=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_liner3);
$variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
$variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
$materialidad = $fotomecanica->materialidad_datos_tecnicos;
$nombre_producto = $ing->producto;
$cala_caucho = $fotomecanica->fot_cala_caucho;
$tapa = $materialidad_1->nombre;
$ondas = $materialidad_2->nombre;
$liner = $materialidad_3->nombre;
$colores = $fotomecanica->colores;
$reverso_tapa = $materialidad_1->reverso;
$reverso_onda = $materialidad_2->reverso;
$reverso_liner = $materialidad_3->reverso;
$barniz = $fotomecanica->fot_lleva_barniz;
$reserva_barniz = $fotomecanica->fot_reserva_barniz;
$unidad_pliego = $ing->unidades_por_pliego; 
$colores = $fotomecanica->colores;
$piezas_totales= $ing->piezas_totales_en_el_pliego;
$acabado=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_1);
$tamano1=$ing->tamano_a_imprimir_1;
$tamano2=$ing->tamano_a_imprimir_2;
$tamano = $tamano1." X ".$tamano2." cm";
//Descripcion Trabajos externos*******************************************************************
require('/parcialTrabajosEspeciales.php');
require('/parcialMateriasPrimas.php');
//datos de la descripcion del trabajo **********************************************************

echo "<br />";
echo "<br />";





if($acabado_1->caracteristicas==""){
$terminacion = "No Dispone";
}else{
$terminacion = $acabado_1->caracteristicas;    
}

//datos Tecnicos del trabajo **********************************************************
$materialidad = $fotomecanica->materialidad_datos_tecnicos;
$precio_tapa = $materialidad_1->precio;
$gramaje_tapa = $materialidad_1->gramaje;
$precio_onda = $materialidad_2->precio;
$gramaje_onda = $materialidad_2->gramaje;
$precio_liner = $materialidad_3->precio;
$gramaje_liner = $materialidad_3->gramaje;
$impresion = $fotomecanica->impresion;
$molde = "";

//Calculos para kilos de la onda
if (($materialidad_2->gramaje>0) && ($materialidad_3->gramaje>0) && ($materialidad_2->precio>0)){
$costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           		                                         
}else{ 	
$costo_kilo=0;
}

if($materialidad_3->tipo == 14 &&  $materialidad_3->reverso == 'Blanca')//valdivia
{
     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
}
if($materialidad_3->tipo == 15 &&  $materialidad_3->reverso == 'Blanca')//maule
{
     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
}
if($materialidad_3->tipo == 1 &&  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
{
     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
}
if($materialidad_3->tipo == 5 &&  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
{
     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
}
if($materialidad_3->tipo == 3 &&  $materialidad_3->reverso == 'Blanco') // papel reverso blanco/ white top
{
     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
}
if($materialidad_3->tipo == 4 && ($materialidad_3->reverso == 'Café' || $materialidad_3->reverso == 'Cafe')) // papel reverso cafe
{
  $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
}

$costo_kilo=$costo_kilo+$recargoCostoKilo->precio;

$costo_monotapa_por_kilo = $costo_kilo;

//calculos para gramos metros cuadrados de la onda
if ($materialidad_2->gramaje>0){
    $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
}else{ 	
    $GramosMetroCuadrado=0;  
}
$recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
$GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
//***********************************************************************
//calculos para costo monotapa metros cuadrados
if ($materialidad_2->gramaje>0){
    //$costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
    $costoMonotapaPorMetro2=($costo_kilo*$GramosMetroCuadrado)/1000;
}else{ 	
    $costoMonotapaPorMetro2=0;    
}

//echo "<h1>" . $materialidad_2->gramaje . "</h1>";
//echo "<h1>" . $materialidad_2->precio . "</h1>";
//echo "<h1>" . $materialidad_3->precio . "</h1>";
//echo "<h1>" . $variable_cotizador->precio . "</h1>";
//exit();
$costo_monotapa_por_m2 = $costoMonotapaPorMetro2;
$gramos_onda_por_m2 = "";
$maquina="Máquina Roland 800";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- JQuery -->
        <script src="<?php echo base_url(); ?>public/assets/Jquery/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/bootstrap-3.3.7-dist/css/bootstrap.css"></script>
    <script src="<?php echo base_url(); ?>public/assets/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/font-awesome-4.7.0/css/font-awesome.css" />
    <!-- Fancybox -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/fancybox-2.1.7/source/jquery.fancybox.css" />
    <script src="<?php echo base_url(); ?>public/assets/fancybox-2.1.7/source/jquery.fancybox.pack.js" ></script>
    <!-- Datatables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/Datatables/datatables.css" />
    <script src="<?php echo base_url(); ?>public/assets/Datatables/datatables.js" ></script>
    <!-- Jszip -->
    <script src="<?php echo base_url(); ?>public/assets/Jszip/dist/jszip.js" ></script>
    <!--   Jquery Table2Excel   -->
    <script src="<?php echo base_url(); ?>public/assets/jquery-table2excel-master/dist/jquery.table2excel.js" ></script>
    <!-- Datepicker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/datepicker/css/datepicker.css" />
    <script src="<?php echo base_url(); ?>public/assets/datepicker/js/bootstrap-datepicker.js" ></script>
    <!--  Custom CSS y JS-->
    <!-- CUSTOM JS -->
    <script type="text/javascript">var webroot = '<?php echo base_url(); ?>';</script>
    <!--<script src="<?php echo base_url(); ?>public/js/functions.js"></script>-->
    <script src="<?php echo base_url(); ?>public/frontend/js/funciones.js"></script>
    <script src="<?php echo base_url(); ?>public/frontend/js/ValidacionesTemporales.js"></script>

    <style type="text/css">
        @media print{
            .titulo{background-color:#444 !important; color:#ffffff !important; font-weight: bold !important; text-align: center !important;}
        }
         /*td{ -webkit-print-color-adjust:exact !important;}*/
       
        .font_awesome { font-family: fontawesome; }
        .titulo{background-color:#444; color:#ffffff; font-weight: bold; text-align: center;}
        body{font-size: 12px;
        margin: -5px -25px -25px -25px;}
        
        table{font-size: 12px;}
    
        .ir-arriba {
	/*display:none;*/
        opacity: 0.4;
        width: 60px;
	height: 60px;
        padding:15px 25px;
	background:#024959;
	font-size:20px;
	color:#fff;
	cursor:pointer;
	position: fixed;
	bottom:20px;
	right:20px;
        border-radius:50px;
}
.ir-arriba2 {
	/*display:none;*/
        opacity: 0.4;
	width: 60px;
	height: 60px;
        padding:15px 25px;
	background:#024959;
	font-size:20px;
	color:#fff;
	cursor:pointer;
	position: fixed;
	top:20px;
	right:20px;
        border-radius:50px;
}

.ir-arriba:hover,.ir-arriba2:hover {
    opacity: 1;
}

.crecer:hover{
    padding-top: 0px;
    -webkit-transition: width 0.3s; /* Safari */
    transition: 0.3s;
}

.crecer{
    padding-top: 10px;
    -webkit-transition: width 0.4s; /* Safari */
    transition: 0.4s;
}

    </style>
</head>
<body>
    <?php //echo "aaaaaaaaaa".$sum;//my code is here  ?>
    <?php //echo "aaaaaaaaaa".$tamano1;//my code is here  ?>
    <?php //echo "aaaaaaaaaa".$tamano2;//my code is here  ?>
    <?php //echo "aaaaaaaaaa".$tapaGramaje;//my code is here  ?>
    <?php //echo "aaaaaaaaaa".$colores2[0]."<br />";?>
    <?php //echo "aaaaaaaaaa".$colores2[1]."<br />";?>
    <?php //echo "aaaaaaaaaa".$cantidad[0]."<br />";?>
    <?php //echo "aaaaaaaaaa".$barnizz[0]."<br />";?>
    <?php //echo "aaaaaaaaaa".$barnizz[1]."<br />";?>
    <?php //echo "aaaaaaaaaa".$esterno."<br />";?>
    <?php //echo "aaaaaaaaaa".$micromicro."<br />";?>
    <?php //echo "aaaaaaaaaa".$cartulina."<br />";?>
    <?php //echo "aaaaaaaaaa".$emplacado."<br />";?>
    <?php //echo "aaaaaaaaaa".$troquelado."<br />";?>
    <?php //echo "aaaaaaaaaa".$emplacado_fijo."<br />";?>
    <?php //echo "aaaaaaaaaa".$troquelado_fijo."<br />";?>
    <?php //echo "aaaaaaaaaa".$costoPlacaKilo."<br />";?>
    <?php //print_r($onda)."<br />";?>
    <form name="form" id="form" method="post" action="<?php echo base_url();?>hoja/save2"> 
    <div class="container" style="height:780px; background-color: white">
        <span class="ir-arriba2 icon-arrow-up">↓</span>
        <span class="ir-arriba icon-arrow-up">↑</span>
        <div style="height: 120px">
            <table class="table">
                <tr>
                    <td style="width: 220px">
                        <img src="<?php echo base_url(); ?>public/frontend/images/logo-cartonajes-web.jpg" style="width: 150px; float: left" />
                    </td>
                    <td>
                        <h1>Hoja de Costos <a href="<?php echo base_url()?>cotizaciones/search_cot/<?php echo $id?>" title="Regresar a la Cotizacion"><?php echo $id ?></a></h1>
                    </td>
                    <td>
                        <b> Fecha: </b><?php echo $fecha_emision; ?>
                        <br /><br />
                        <b>Estado del Producto:</b> <span style="font-size: 16px; color:#000; background-color: #4db562" class="label"><?php echo $fotomecanica->condicion_del_producto  ?></span>
                        <br /><br />
                        <?php if($fotomecanica->numero_molde==21){ ?>
                        <b>Numero de Trazado:</b><a href="../../../ trazados/edit/<?php echo $datos->trazado;?>/0"><span style="font-size: 16px; color:#000; background-color: #4db562" class="label"><?php echo $datos->trazado ?></span></a>
                        <?php }else{ ?>
                        <b>Numero de Molde:</b><a href="../../../moldes/edit/<?php echo $fotomecanica->numero_molde;?>/0"> <span style="font-size: 16px; color:#000; background-color: #4db562" class="label"><?php echo $fotomecanica->numero_molde ?></span></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php if (sizeof($copias)>0){
                         foreach ($copias as $value) {
                           echo "<tr><td colspan='5' ><a href='".base_url()."cotizaciones/hoja_de_costos/".$value->id_cotizacion."'>".$value->id_cotizacion."-".$value->codigo_duplicado."</a></td></tr>";
                         }
                        }else{
                            echo "<tr><td colspan='5' align='right'>No Hay Copias Recientes</td></tr>";
                        } ?>
            </table>
        </div>
        <div style="height: 180px">
            <table class="table table-condensed">
                <tr>
                    <td colspan="6" class="titulo" style="width: 100%;"><b>Datos de la Hoja de Costos</b></td>
                </tr>
                <tr>
                    <td style="width: 15%"><b>Fecha:</b></td>
                    <td style="width: 35%"><?php echo $fecha ?></td>
                    <td style="width: 15%"><b>Costeo:</b></td>
                    <td style="width: 35%"><?php echo $costeo ?></td>
                </tr>
                <tr>
                    <td style="width: 15%"><b>Nombre:</b></td>
                    <td style="width: 35%"><?php echo $nombre ?></td>
                    <td style="width: 15%"><b>E-mail:</b></td>
                    <td style="width: 35%"><?php echo $email ?></td>
                </tr>
                <tr>
                    <td style="width: 15%"><b>Direccion:</b></td>
                    <td style="width: 35%"><?php echo $direccion ?></td>
                    <td style="width: 15%"><b>Rut:</b></td>
                    <td style="width: 35%"><?php echo $rut ?></td>
                </tr>
                <tr>
                    <td style="width: 15%"><b>Telefono:</b></td>
                    <td style="width: 35%"><?php echo $telefono ?></td>
                    <td style="width: 15%"><b>Ciudad:</b></td>
                    <td style="width: 35%"><?php echo $ciudad ?></td>
                </tr>
                <tr>
                    <td style="width: 15%"><b>Vendedor:</b></td>
                    <td style="width: 35%"><?php echo $vendedor ?><a href='<?php echo base_url()."hoja$next/cambio_vendedor/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar Vendedor"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                    <td style="width: 15%"><b>Comuna:</b></td>
                    <td style="width: 35%"><?php echo $comuna ?></td>
                </tr>
                <tr>
                    <td style="width: 15%"><b>At:</b></td>
                    <td style="width: 35%"><?php echo $at ?></td>
                    <td style="width: 15%"></td>
                    <td style="width: 35%"></td>
                </tr>
            </table>
        </div><br />
        <!------------------------Descripcion del trabajo-------------------------------------------->
        <div style="height: 230px">
            <table class="table table-condensed">
                <tr>
                    <td colspan="6" class="titulo" style="width: 100%"><b>Descripcion del Trabajo</b></td>
                </tr>
                <tr>
                    <td style="width: 20%"><b>Nombre Producto: </b></td>
                    <td colspan="5" style="width: 80%"><?php echo $nombre_producto ?></td>
                </tr>
                <tr>
                    <td style="width: 10%"><b>Tapa:</b></td>
                    <td style="width: 20%"><?php echo $tapa ?></td>
                    <td style="width: 15%"><b>Reverso Tapa:</b></td>
                    <td style="width: 10%"><?php echo $reverso_tapa ?></td>
                    <td style="width: 15%"><b>Barniz:</b></td>
                    <td style="width: 20%"><?php echo $tbarniz; ?><a href='<?php echo base_url()."hoja$next/cambio_barniz/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar barniz"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                </tr>
                <?php if($materialidad!="Cartulina-cartulina"){ ?>
                <tr>
                    <td style="width: 10%"><b>Onda:</b></td>
                    <td style="width: 20%"><?php echo $ondas ?></td>
                    <td style="width: 15%"><b>Reverso Onda:</b></td>
                    <td style="width: 10%"><?php echo $reverso_onda ?></td>
                    <td style="width: 15%"><b>Reserva Barniz:</b></td>
                    <td style="width: 20%"><?php echo $reserva_barniz ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td style="width: 10%"><b>Liner:</b></td>
                    <td style="width: 20%"><?php echo $liner ?></td>
                    <td style="width: 15%"><b>Reverso Liner:</b></td>
                    <td style="width: 10%"><?php echo $reverso_liner ?></td>
                    <td style="width: 15%"><b>Cala Caucho:</b></td>
                    <td style="width: 20%"><?php echo $cala_caucho ?></td>
                </tr>
                <tr>
                    <td style="width: 10%"><b>Tamaño:</b></td>
                    <td style="width: 20%"><?php echo $tamano ?></td>
                    <td style="width: 15%"><b>Unidad / Pliego:</b></td>
                    <td style="width: 10%"><?php echo $unidad_pliego ?></td>
                    <td style="width: 15%"><b>Colores: </b></td>
                    <td style="width: 20%"><?php echo $colores ?></td>
                </tr>
                <tr>
                    <td style="width: 10%"><b>Piezas Totales en Pliego<br />(Para Desgajado )</b></td>
                    <td style="width: 20%"><?php echo $piezas_totales ?></td>
                    <td style="width: 15%"><b>Terminacion:</b></td>
                    <td style="width: 10%"><?php echo $terminacion ?></td>
                    <td style="width: 15%"><b></b></td>
                    <td style="width: 20%"></td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Descripcion del trabajo-------------------------------------------->
        
        <!------------------------Datos Tecnicos del trabajo-------------------------------------------->
        <div style="height: 240px">
            <table class="table table-condensed">
                <tr>
                    <td class="" style="width: 50%">
                        <div style="height: 250px">
                            <table class="table table-condensed">
                                <tr>
                                    <td colspan="8" class="titulo" style="width: 100%"><b>Datos Tecnicos</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"><b>Materialidad: </b></td>
                                    <td colspan="7" style="width: 80%"><?php echo $materialidad ?><a href='<?php echo base_url()."hoja$next/materialidad/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar Materialidad"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><b>Tapa:</b></td>
                                    <td style="width: 20%"><?php echo $tapa ?></td>
                                    <td style="width: 15%"><b>Gramaje:</b></td>
                                    <td style="width: 15%"><?php echo $gramaje_tapa ?></td>
                                    <td style="width: 15%"><b>Precio:</b></td>
                                    <td style="width: 15%"><?php echo $precio_tapa ?></td>
                                    <td style="width: 15%"><b>Reverso:</b></td>
                                    <td style="width: 20%"><?php echo $reverso_tapa ?></td>
                                </tr>
                                <?php if($materialidad!="Cartulina-cartulina"){ ?>
                                <tr>
                                    <td style="width: 10%"><b>Onda:</b></td>
                                    <td style="width: 20%"><?php echo $ondas ?></td>
                                    <td style="width: 15%"><b>Gramaje:</b></td>
                                    <td style="width: 15%"><?php echo $gramaje_onda ?></td>
                                    <td style="width: 15%"><b>Precio:</b></td>
                                    <td style="width: 15%"><?php echo $precio_onda ?></td>
                                    <td style="width: 15%"><b>Reverso:</b></td>
                                    <td style="width: 20%"><?php echo $reverso_onda ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td style="width: 10%"><b>Liner:</b></td>
                                    <td style="width: 20%"><?php echo $liner ?></td>
                                    <td style="width: 15%"><b>Gramaje:</b></td>
                                    <td style="width: 15%"><?php echo $gramaje_liner ?></td>
                                    <td style="width: 15%"><b>Precio:</b></td>
                                    <td style="width: 15%"><?php echo $precio_liner ?></td>
                                    <td style="width: 15%"><b>Reverso:</b></td>
                                    <td style="width: 20%"><?php echo $reverso_liner ?></td>
                                </tr>
                                <?php if($materialidad!="Cartulina-cartulina"){ ?>
                                <tr>
                                    <td style="width: 10%"><b>Costo * Kilo:</b></td>
                                    <td style="width: 20%"><?php echo number_format($costo_monotapa_por_kilo,0,'','.') ?></td>
                                    <td colspan="2" style="width: 20%"><b>Gramos * M2 Monotapa:</b></td>
                                    <td style="width: 15%"><?php echo number_format($GramosMetroCuadrado,0,'','.') ?></td>
                                    <td colspan="2" style="width: 15%"><b>Costo M. M2:</b></td>
                                    <td style="width: 15%"><?php echo number_format($costoMonotapaPorMetro2,0,'','.') ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td style="width: 10%"><b>Impresion:</b></td>
                                    <td style="width: 20%"><?php echo $impresion ?></td>
                                    <td colspan="2" style="width: 20%"><b></b></td>
                                    <td style="width: 15%"></td>
                                    <td colspan="2" style="width: 15%"><b></b></td>
                                    <td style="width: 20%"></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <!------------------------Datos trabajos externos-------------------------------------------->
                    <td class="" style="width: 50%">
                        <div style="height: 250px">
                            <table class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr>
                                    <td colspan="9" class="titulo" style="width: 100%">Informacion Complementaria de la Hoja de Costos</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; color:#fff; font-weight: bold; text-align: center; background-color:<?php echo $franja;?> " colspan="6">
                                        <?php echo $mensaje_estatus;?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; color:#fff; font-weight: bold; text-align: center; background-color:<?php echo $franja;?> " colspan="6">
                                        <?php echo $mensaje_fecha;?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><h5><b>Cantidad Piezas:</b></h5></td>
                                    <td style="width: 15%"><h5><?php echo $datoscantidad1 ?></h5></td>
                                    <td style="width: 25%"><h5><b>Cantidad Pliegos:</b></h5></td>
                                    <td style="width: 15%"><h5><?php echo $datoscantidad1 /$unidad_pliego ?></h5></td>
                                </tr>
<!--                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color 1-2-3</b></td>
                                    <td style="width: 15%"><?php //echo $colores2[0] ?></td>
                                    <td style="width: 15%"><?php //echo $colores2[0] ?></td>
                                    <td style="width: 25%">Por color</td>
                                    <td style="width: 15%"><?php //echo $colores2[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color > 3</b></td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 25%"><b></b></td>
                                    <td style="width: 15%"><?php //echo $colores2[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cantidad</b></td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 25%">Cantidad > 5.000 * c/5.000</td>
                                    <td style="width: 15%"><?php// echo $cantidad1[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Barniz</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Primeros 1.000</td>
                                    <td style="width: 15%"><?php //echo $barnizz[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Por cada 1.000 extra</td>
                                    <td style="width: 15%"><?php// echo $barnizz[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Trabajo Externo</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php //echo $externo ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Micro/Micro</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php //echo $micromicro; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cart/Cart</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php //echo $cartulina; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Tamanos Normales</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 15%">0</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Emplacado</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php //echo $emplacado_fijo; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php //echo $emplacado; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Troquelado</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php// echo $troquelado_fijo; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php //echo $troquelado; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Merma</b></td>
                                    <td style="width: 15%"><?php //echo "<b>".$sum."<b>"; ?></td>
                                </tr>-->
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Datos Tecnicos del trabajo-------------------------------------------->
        <!------------------------Descripcion del trabajo externo-------------------------------------------->
        <?php  if($altura==1){
            $height='300px';
        }else if($altura==2){
            $height='320px';
        }else if($altura==3){
            $height='340px';
        }else if($altura==4){
            $height='360px';
        }else if($altura==5){
            $height='380px';
        } ?>
        <div style="height: <?php echo $height?>; margin-top: 30px">
            <table class="table table-condensed" border="1">
                <tr>
                    <td colspan="10" class="titulo" style="width: 100%"><b>Descripcion de Trabajos</b></td>
                </tr>
                <tr>
                    <td style="width: 20%"><b>Trabajos Externos</b></td>
                    <td style="width: 10%"><b>Unidad de Uso</b></td>
                    <td style="width: 10%"><b>Cantidad</b></td>
                    <td style="width: 10%"><b>Ancho</b></td>
                    <td style="width: 10%"><b>Largo</b></td>
                    <td style="width: 10%"><b>M2</b></td>
                    <td style="width: 10%"><b>V.Unit M2</b></td>
                    <td style="width: 10%"><b>C.Unit</b></td>
                    <td style="width: 10%"><b>Unit. P</b></td>
                    <td style="width: 30%"><b>Total</b></td>
                </tr>
                <?php if($procesosespeciales>0 && $tesp1 != 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($folia1->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $folia1->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $folia1->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $folia1->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $folia1->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if(str_replace("�", "ñ", ucwords(strtolower($folia1->caracteristicas)))=="Folia (golpe)"){echo $folia1->valor_venta/$ing->unidades_por_pliego; }else{echo $folia1->valor_venta; } ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego ?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if($folia1->unidad_de_venta==5){$costo1=($folia1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($folia1->unidad_de_venta==9){$costo1=$folia1->valor_venta;}else{$costo1=$folia1->valor_venta*$datoscantidad1;}} echo number_format($costo1,0,'','.');  ?>&nbsp;</td></tr>
                
               <?php } ?>        
               <?php if($procesosespeciales>0 && sizeof($cffolia1) > 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($cffolia1->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $cffolia1->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cffolia1->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cffolia1->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $cffolia1->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if(str_replace("�", "ñ", ucwords(strtolower($cffolia1->caracteristicas)))=="Folia (golpe)"){echo $cffolia1->valor_venta/$ing->unidades_por_pliego; }else{if(str_replace("�", "ñ", ucwords(strtolower($cffolia1->caracteristicas)))=="Cuno Pasada"){echo $cffolia1->valor_venta/$ing->unidades_por_pliego; }else{echo $cffolia1->valor_venta;}} ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego ?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if($cffolia1->unidad_de_venta==5){$costo11=($cffolia1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cffolia1->unidad_de_venta==9){$costo11=$cffolia1->valor_venta;}else{$costo11=$cffolia1->valor_venta*$datoscantidad1;}} echo number_format($costo11,0,'','.');  ?>&nbsp;</td></tr>
                
               <?php } ?>        
               <?php if($procesosespeciales>0 && $tesp2 != 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($folia2->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $folia2->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $folia2->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $folia2->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $folia2->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if(str_replace("�", "ñ", ucwords(strtolower($folia2->caracteristicas)))=="Folia (golpe)"){echo $folia2->valor_venta/$ing->unidades_por_pliego; }else{echo $folia2->valor_venta; } ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if($folia1->unidad_de_venta==5){$costo2=($folia2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($folia2->unidad_de_venta==9){$costo2=$folia2->valor_venta;}else{$costo2=$folia2->valor_venta*$datoscantidad1;}}  ?>&nbsp;</td></tr>
               <?php } ?>
               <?php if($procesosespeciales>0 && sizeof($cffolia2) > 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($cffolia2->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $cffolia2->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cffolia2->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cffolia2->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $cffolia2->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if(str_replace("�", "ñ", ucwords(strtolower($cffolia2->caracteristicas)))=="Folia (golpe)"){echo $cffolia2->valor_venta/$ing->unidades_por_pliego; }else{if(str_replace("�", "ñ", ucwords(strtolower($cffolia2->caracteristicas)))=="Cuno Pasada"){echo $cffolia2->valor_venta/$ing->unidades_por_pliego; }else{echo $cffolia2->valor_venta;}} ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego ?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if($cffolia2->unidad_de_venta==5){$costo12=($cffolia2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cffolia2->unidad_de_venta==9){$costo12=$cffolia2->valor_venta;}else{$costo12=$cffolia2->valor_venta*$datoscantidad1;}} echo number_format($costo12,0,'','.');  ?>&nbsp;</td></tr>
                
               <?php } ?>     
               <?php if($procesosespeciales>0 && $tesp3 != 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($folia3->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $folia3->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $folia3->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $folia3->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $folia3->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if(str_replace("�", "ñ", ucwords(strtolower($folia3->caracteristicas)))=="Folia (golpe)"){echo $folia3->valor_venta/$ing->unidades_por_pliego; }else{echo $folia3->valor_venta; } ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego?>&nbsp;</td>                   
                    <td style="width: 30%">&nbsp;<?php  if($folia3->unidad_de_venta==5){$costo3=($folia3->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($folia3->unidad_de_venta==9){$costo3=$folia3->valor_venta;}else{$costo3=$folia3->valor_venta*$datoscantidad1;}}  ?>&nbsp;</td></tr>
               <?php } ?>
               <?php if($procesosespeciales>0 && sizeof($cffolia3) > 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($cffolia3->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $cffolia3->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cffolia3->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cffolia3->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $cffolia3->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if(str_replace("�", "ñ", ucwords(strtolower($cffolia3->caracteristicas)))=="Folia (golpe)"){echo $cffolia3->valor_venta/$ing->unidades_por_pliego; }else{if(str_replace("�", "ñ", ucwords(strtolower($cffolia3->caracteristicas)))=="Cuno Pasada"){echo $cffolia3->valor_venta/$ing->unidades_por_pliego; }else{echo $cffolia3->valor_venta;}} ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego ?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if($cffolia3->unidad_de_venta==5){$costo13=($cffolia3->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cffolia3->unidad_de_venta==9){$costo13=$cffolia3->valor_venta;}else{$costo13=$cffolia3->valor_venta*$datoscantidad1;}} echo number_format($costo13,0,'','.');  ?>&nbsp;</td></tr>
                
               <?php } ?> 
               <?php if($procesosespeciales>0 && $tesp4 != 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($cuno1->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $cuno1->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cuno1->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cuno1->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $cuno1->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if(str_replace("�", "ñ", ucwords(strtolower($cuno1->caracteristicas)))=="Folia (golpe)"){echo $cuno1->valor_venta/$ing->unidades_por_pliego; }else{echo $cuno1->valor_venta; } ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if($cuno1->unidad_de_venta==5){$costo4=($cuno1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cuno1->unidad_de_venta==9){$costo4=$cuno1->valor_venta;}else{$costo4=$cuno1->valor_venta*$datoscantidad1;}}  ?>&nbsp;</td></tr>
               <?php } ?>        
               <?php if($procesosespeciales>0 && sizeof($cfcuno1) > 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($cfcuno1->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $cfcuno1->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cfcuno1->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cfcuno1->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $cfcuno1->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if(str_replace("�", "ñ", ucwords(strtolower($cfcuno1->caracteristicas)))=="Folia (golpe)"){echo $cfcuno1->valor_venta/$ing->unidades_por_pliego; }else{if(str_replace("�", "ñ", ucwords(strtolower($cfcuno1->caracteristicas)))=="Cuno Pasada"){echo $cfcuno1->valor_venta/$ing->unidades_por_pliego; }else{echo $cfcuno1->valor_venta;}} ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego ?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if($cfcuno1->unidad_de_venta==5){$costo14=($cfcuno1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cfcuno1->unidad_de_venta==9){$costo14=$cfcuno1->valor_venta;}else{$costo14=$cfcuno1->valor_venta*$datoscantidad1;}} echo number_format($costo14,0,'','.');  ?>&nbsp;</td></tr>
                
               <?php } ?> 
               <?php if($procesosespeciales>0 && $tesp5 != 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($cuno2->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $cuno2->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cuno2->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cuno2->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $cuno2->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cuno2->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if($cuno2->unidad_de_venta==5){$costo5=($cuno2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cuno2->unidad_de_venta==9){$costo5=$cuno2->valor_venta;}else{$costo5=$cuno2->valor_venta*$datoscantidad1;}}  ?>&nbsp;</td></tr>
               <?php } ?>        
               <?php if($procesosespeciales>0 && sizeof($cfcuno2) > 0){ ?>
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($cfcuno2->caracteristicas)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $cfcuno2->unv ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $datoscantidad1; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cfcuno2->ancho; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  echo $cfcuno2->largo; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  echo $cfcuno2->valor_venta; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if(str_replace("�", "ñ", ucwords(strtolower($cfcuno2->caracteristicas)))=="Folia (golpe)"){echo $cfcuno2->valor_venta/$ing->unidades_por_pliego; }else{if(str_replace("�", "ñ", ucwords(strtolower($cfcuno2->caracteristicas)))=="Cuno Pasada"){echo $cfcuno2->valor_venta/$ing->unidades_por_pliego; }else{echo $cfcuno2->valor_venta;}} ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego ?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if($cfcuno2->unidad_de_venta==5){$costo15=($cfcuno2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cfcuno2->unidad_de_venta==9){$costo15=$cfcuno2->valor_venta;}else{$costo15=$cfcuno2->valor_venta*$datoscantidad1;}} echo number_format($costo15,0,'','.');  ?>&nbsp;</td></tr>
                
               <?php } ?>        
               <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo str_replace("�", "ñ", ucwords(strtolower($acabado_4)));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $acabado_4UnidadVentaNombre?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($cantidad_4!="") echo $cantidad_4; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_4UnidadVentaNombre!="") echo $tamano1; else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_4UnidadVentaNombre!="") echo $tamano2; else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_4UnidadVentaNombre!="") echo (($tamano1*$tamano2)/10000); else echo ""; ?>&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_4Valor>0) echo number_format($acabado_4Valor,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($costo_unitario4>0){ echo number_format($costo_unitario4,0,'','.'); }else{ echo "";} ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if ($precio_total_4>0) echo number_format($precio_total_4,0,'','.'); else echo ""; ?>&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo ucwords(strtolower($acabado_5));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $acabado_5UnidadVentaNombre?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($cantidad_5!="") echo $cantidad_5; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_5UnidadVentaNombre!="") echo $tamano1; else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_5UnidadVentaNombre!="") echo $tamano2; else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_5UnidadVentaNombre!="") echo (($tamano1*$tamano2)/10000); else echo ""; ?>&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_5Valor>0) echo number_format($acabado_5Valor,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($costo_unitario5>0) echo number_format($costo_unitario5,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if ($precio_total_5>0) echo number_format($precio_total_5,0,'','.'); else echo ""; ?>&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 10%">&nbsp;&nbsp;<?php echo ucwords(strtolower($acabado_6));?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $acabado_6UnidadVentaNombre?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($cantidad_6!="") echo $cantidad_6; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_6UnidadVentaNombre!="") echo $tamano1; else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_6UnidadVentaNombre!="") echo $tamano2; else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_6UnidadVentaNombre!="") echo (($tamano1*$tamano2)/10000); else echo ""; ?>&nbsp;</td>												
                    <td style="width: 10%">&nbsp;<?php  if ($acabado_6Valor>0) echo number_format($acabado_6Valor,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php  if ($costo_unitario6>0){ echo number_format($costo_unitario6,0,'','.'); }else{ echo "";} ?>&nbsp;</td>
                    <td style="width: 10%">&nbsp;<?php echo $ing->unidades_por_pliego?>&nbsp;</td>
                    <td style="width: 30%">&nbsp;<?php  if ($precio_total_6>0) echo number_format($precio_total_6,0,'','.'); else echo ""; ?>&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 20%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 30%"></td>
                </tr>
                <tr>
                    <td style="width: 30%" colspan="9"><strong>&nbsp;&nbsp;Total Precio de Trabajos Externos</strong></td>
                    <td><?php if($hoja->valor_externo!=0){ $externos_produccion=$externos_produccion+$hoja->valor_externo+$costo1+$costo2+$costo3+$costo4+$costo5+$costoa1+$costoa2+$costoa3+$costoa4+$costoa5+$costo11+$costo12+$costo13+$costo14+$costo15; echo number_format($hoja->valor_externo,0,'','.');}else{  $externos_produccion=$precio_total_4+$precio_total_5+$precio_total_6+$costo1+$costo2+$costo3+$costo4+$costo5+$costoa1+$costoa2+$costoa3+$costoa4+$costoa5+$costo11+$costo12+$costo13+$costo14+$costo15; echo number_format($externos_produccion,0,'','.');} ?>&nbsp;&nbsp;
                    <a href='<?php echo base_url()."hoja$next/trabajos_externos/$id/4"; ?>' class='fancybox fancybox.ajax' title="Modificar cantidad 4"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a> 
                    <input type="hidden" name="valor_externo" value="<?php if($hoja->valor_externo!=0){ echo number_format($hoja->valor_externo,0,'','.');}else{ echo number_format($externos_produccion,0,'','.');} ?>" /></td>
                    <!--<a href="<?php //echo base_url()?>hoja/trabajos_externos/<?php //echo $id?>/4" class="fancybox fancybox.ajax"><img src="<?php //echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>-->
                </tr>  
<!--                <tr>
                    <td colspan="9" style="width: 90%"><b>Total Precio de Trabajos Externos</b></td>
                    <td style="width: 10%"></td>
                </tr>-->
                <tr>
                    <td style="width: 20%"><b>Piezas Adicionales</b></td>
                    <td style="width: 10%"><b>Unidad de Uso</b></td>
                    <td style="width: 10%"><b>Cantidad</b></td>
                    <td style="width: 10%"><b>Ancho</b></td>
                    <td style="width: 10%"><b>Largo</b></td>
                    <td style="width: 10%"><b></b></td>
                    <td style="width: 10%"><b>M2</b></td>
                    <td style="width: 10%"><b>V.Unit M2</b></td>
                    <td style="width: 10%"><b>C.Unit</b></td>
                    <td style="width: 10%"><b>Total</b></td>
                </tr>
                <tr>
                    <td style="width: 20%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"><b></b></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                </tr>
                <tr>
                    <td style="width: 20%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"><b></b></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                </tr>
                <tr>
                    <td style="width: 20%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"><b></b></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                </tr>
                <tr>
                    <td colspan="9" style="width: 90%"><b>Total Precio de Piezas Adicionales</b></td>
                    <td style="width: 10%"></td>
                </tr>
                <tr>
                    <td colspan="9" style="width: 90%"><b>Total Externos</b></td>
                    <td style="width: 10%"><?php if($hoja->valor_externo!=0 && $hoja->valor_externo!=""){ echo number_format($hoja->valor_externo,0,'','.');}else{ echo number_format($externos_produccion,0,'','.');} ?></td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Descripcion del trabajo externo-------------------------------------------->
         <!------------------------Datos de materias primas-------------------------------------------->
        <div style="height: 1000px; margin-top: 20px">
            <table class="table table-condensed">
                <tr>
                    <td class="" style="width: 50%">
                        <div style="height: 250px">
                            <table class="table table-condensed" border="1">
                                <tr>
                                    <td colspan="8" class="titulo" style="width: 100%"><b>Datos de Materias Primas y Pre Impresion</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%"><b>Materias Primas</b></td>
                                    <td style="width: 25%"><b>Cant / Pliego</b></td>
                                    <td style="width: 25%"><b>Valor $</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Total Kilos Tapa:<?php echo number_format($valorPlacaKilo,0,'','.');?></td>
                                    <td style="width: 25%"><?php echo number_format($costoPlacaKilo,0,'','.')?></td>
                                    <td style="width: 25%"><?php echo number_format($totalPlacaKilo,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Corte 7%:</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php echo number_format($corte,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%"><?php if($materialidad == 'Cartulina-cartulina'){echo $placa[0].":".number_format($placa[2],0,'','.');}else{echo $placa[0].":".number_format($placa[2],0,'','.');} ?></td>
                                    <td style="width: 25%"><?php if($materialidad == 'Cartulina-cartulina'){echo number_format($placa[1],0,'','.');}else{echo number_format($placa[1],0,'','.');} ?></td>
                                    <td style="width: 25%"><?php if($materialidad == 'Cartulina-cartulina'){echo number_format($placa[2]*$costo_mkilo,0,'','.');}else{echo number_format($placa[2]*$costo_mkilo,0,'','.');} ?></td></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Merma 10%</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php if($materialidad == 'Cartulina-cartulina'){echo number_format(($placa[4]*10)/100,0,'','.');}else{echo number_format(($placa[4]*10)/100,0,'','.');} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Varios</td>
                                    <td style="width: 25%">0</td>
                                    <td style="width: 25%">0</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Materia Prima</b></td>
                                    <td style="width: 25%"><?php if($materialidad == 'Cartulina-cartulina'){echo number_format($totalMateriaPrima,0,'','.');}else{echo number_format($totalMateriaPrima,0,'','.');}?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="width: 100%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%"><b>Pre Impresion</b></td>
                                    <td style="width: 25%"><b>Cant / Pliego</b></td>
                                    <td style="width: 25%"><b>Valor $</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Arte:<?php echo $coloresArte?></td>
                                    <td style="width: 25%"><?php echo number_format($arte->precio,0,'','.')?></td>
                                    <td style="width: 25%"><?php echo number_format($cantidadArte,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Planchametal:<?php echo $coloresPlanchaMetal?></td>
                                    <td style="width: 25%"><?php echo number_format($plancha_metal->precio,0,'','.')?></td>
                                    <td style="width: 25%"><?php echo number_format($cantidadPlantaMetal,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Copiado:<?php echo $coloresCopiado?></td>
                                    <td style="width: 25%"><?php echo number_format($copiado->precio,0,'','.')?></td>
                                    <td style="width: 25%"><?php echo number_format($cantidadCopiado,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Peliculas:<?php echo $coloresPeliculas?></td>
                                    <td style="width: 25%"><?php echo $peliculasPI; ?></td>
                                    <td style="width: 25%"><?php echo $cantidadPeliculas; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Montaje:<?php echo $coloresMontaje;?></td>
                                    <td style="width: 25%"><?php echo number_format($montajePI,0,'','.')?></td>
                                    <td style="width: 25%"><?php echo number_format($cantidadMontaje,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Cromalin:<?php echo $coloresCromalin?></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php echo number_format($cromalin,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Pre Impresion</b></td>
                                    <td style="width: 25%"><?php echo number_format($totalPreImpresion,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="width: 100%"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="titulo" style="width: 100%"><b>Totales</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Materia Prima</b></td>
                                    <td style="width: 25%"><?php if($materialidad == 'Cartulina-cartulina'){echo number_format($totalMateriaPrima,0,'','.');}else{echo number_format($totalMateriaPrima,0,'','.');}?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Pre Impresion</b></td>
                                    <td style="width: 25%"><?php echo number_format($totalPreImpresion,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Produccion</b></td>
                                    <td style="width: 25%"><?php echo number_format($totalProduccion,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Costos Varios</b></td>
                                    <td style="width: 25%"><?php echo number_format($totalCostosVarios,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Sub Total</b></td>
                                    <td style="width: 25%"><?php echo number_format($subtotal1,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="titulo" style="width: 100%"><b>Agregados (Comision Agencia, Costo Comercial)</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Comision Agencia</b></td>
                                    <td style="width: 25%"><?php echo number_format($totalComisionAgencia,0,'','.');?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Costo Comercial</b></td>
                                    <td style="width: 25%"><?php echo number_format($totalCostoComercial,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total</b></td>
                                    <td style="width: 25%"><?php echo number_format($total1,0,'','.')?></td>
                                </tr>
                                <tr style="border-width: 0px;">
                                    <td colspan="3" style="width: 100%; height: 40px; border-left: hidden; border-right: hidden"></td>
                                </tr>
                                <tr>
                                    <td  class="titulo" style="width: 50%"><b>Valor por Cantidades Cotizadas</b></td>
                                    <td  class="titulo" style="width: 25%"><b>Valor Financiado</b></td>
                                    <td  class="titulo" style="width: 25%"><b>Valor Empresa</b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="width: 50%">
                                        <a href='#' data-toggle="modal" data-target="#myModal" title="Detalle" onclick="return info('c1')"><img style="padding-left:7px; width:20px" src="<?php echo base_url();?>public/frontend/images/006-papel.png" /></a>
                                    <b>Cantidad 1: </b><?php if($datos->cantidad_1=="" || $datos->cantidad_1==0 || $datos->cantidad_1==1){echo "0";}else{echo $datos->cantidad_1;} ?>
                                    <a href='<?php echo base_url()."hoja$next/cantidad/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar Cantidad 1"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a>
                                    </td>
                                    <td style="width: 25%"><?php echo number_format($valorFinanciado1,0,'','.')?></td>
                                    <td style="width: 25%"><?php echo number_format($valorEmpresa1,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="width: 50%">
                                    <a href='#' data-toggle="modal" data-target="#myModal" title="Detalle" onclick="return info('c2')"><img style="padding-left:7px; width:20px" src="<?php echo base_url();?>public/frontend/images/006-papel.png" /></a>
                                    <b>Cantidad 2: </b><?php if($datos->cantidad_2=="" || $datos->cantidad_2==0 || $datos->cantidad_2==1){echo "0";}else{echo $datos->cantidad_2;} ?>
                                    <a href='<?php echo base_url()."hoja$next/cantidad2/$id/2"; ?>' class='fancybox fancybox.ajax' title="Modificar cantidad 2"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a>
                                    </td>
                                    <td style="width: 25%"><?php if($datos->cantidad_2=="" || $datos->cantidad_2==0 || $datos->cantidad_2==1){ echo "0";}else{echo number_format($valorFinanciado2,0,'','.');}?></td>
                                    <td style="width: 25%"><?php if($datos->cantidad_2=="" || $datos->cantidad_2==0 || $datos->cantidad_2==1){ echo "0";}else{echo number_format($valorEmpresa2,0,'','.');}?>
                                    <a href='<?php echo base_url()."hoja$next/valor_empresa_2/$id/2"; ?>' class='fancybox fancybox.ajax' title="Modificar valor empresa 2"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="width: 50%">
                                    <a href='#' data-toggle="modal" data-target="#myModal" title="Detalle" onclick="return info('c3')"><img style="padding-left:7px; width:20px" src="<?php echo base_url();?>public/frontend/images/006-papel.png" /></a>
                                    <b>Cantidad 3: </b><?php if($datos->cantidad_3=="" || $datos->cantidad_3==0 || $datos->cantidad_3==1){echo "0";}else{echo $datos->cantidad_3;} ?>
                                    <a href='<?php echo base_url()."hoja$next/cantidad3/$id/3"; ?>' class='fancybox fancybox.ajax' title="Modificar cantidad 3"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a>
                                    </td>
                                    <td style="width: 25%"><?php if($datos->cantidad_3=="" || $datos->cantidad_3==0 || $datos->cantidad_3==1){ echo "0";}else{echo number_format($valorFinanciado3,0,'','.');}?></td>
                                    <td style="width: 25%"><?php if($datos->cantidad_3=="" || $datos->cantidad_3==0 || $datos->cantidad_3==1){ echo "0";}else{echo number_format($valorEmpresa3,0,'','.');}?>
                                    <a href='<?php echo base_url()."hoja$next/valor_empresa_3/$id/3"; ?>' class='fancybox fancybox.ajax' title="Modificar valor empresa 3"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="width: 50%">
                                        <a href='#'  data-toggle="modal" data-target="#myModal" title="Modificar vb en maquina" onclick="return info('c4')"><img style="padding-left:7px; width:20px" src="<?php echo base_url();?>public/frontend/images/006-papel.png" /></a>
                                    <b>Cantidad 4: </b><?php if($datos->cantidad_4=="" || $datos->cantidad_4==0 || $datos->cantidad_4==1){echo "0";}else{echo $datos->cantidad_4;} ?>
                                    <a href='<?php echo base_url()."hoja$next/cantidad4/$id/4"; ?>' class='fancybox fancybox.ajax' title="Modificar cantidad 4"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a>
                                    </td>
                                    <td style="width: 25%"><?php if($datos->cantidad_4=="" || $datos->cantidad_4==0 || $datos->cantidad_4==1){ echo "0";}else{echo number_format($valorFinanciado4,0,'','.');}?></td>
                                    <td style="width: 25%"><?php if($datos->cantidad_4=="" || $datos->cantidad_4==0 || $datos->cantidad_4==1){ echo "0";}else{echo number_format($valorEmpresa4,0,'','.');}?>
                                    <a href='<?php echo base_url()."hoja$next/valor_empresa_4/$id/4"; ?>' class='fancybox fancybox.ajax' title="Modificar valor empresa 4"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <!------------------------Datos de calculo de produccion-------------------------------------------->
                    <td class="" style="width: 50%">
                        <div style="height: 250px">
                            <table class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr>
                                    <td colspan="9" class="titulo" style="width: 100%"><b>Calculos de Produccion</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%"><b>Produccion</b></td>
                                    <td style="width: 25%"><b>Unitario</b></td>
                                    <td style="width: 25%"><b>Valor $</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Tiraje (<?php  echo $condicionado; ?>)</td>
                                    <td style="width: 25%"><?php echo $factor_rango ?></td>
                                    <td style="width: 25%"><?php echo number_format($tiraje,0,'','.')?><a href='<?php echo base_url()."hoja$next/tiraje1/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar Tiraje"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Complemento</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php echo number_format($complemento,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Externos</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php if($hoja->valor_externo!=0){ echo number_format($hoja->valor_externo,0,'','.');}else{ echo number_format($externos_produccion,0,'','.');} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Costos por Lacado</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php echo number_format($lacado1,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Corte</td>
                                    <td style="width: 25%">4.5</td>
                                    <td style="width: 25%"><?php echo number_format($onda['valorCorte'],0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Emplacado</td>
                                    <td style="width: 25%"><?php echo number_format($valorEmplacado,0,'','.')?></td>
                                    <td style="width: 25%"><?php echo number_format($totalEmplacado,0,'','.') ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Montaje Molde</td>
                                    <td style="width: 25%"><?php echo number_format($variableMontajeMoldeTroquel->precio,0,'','.')?></td>
                                    <td style="width: 25%"><?php echo number_format($totalMontajeMolde,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Troquelado</td>
                                    <td style="width: 25%"><?php echo $variableTroquelado->precio?></td>
                                    <td style="width: 25%"><?php echo number_format($totalTroquelado,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Desgajado</td>
                                    <td style="width: 25%"><?php echo $variableDesgajado->precio?></td>
                                    <td style="width: 25%"><?php echo number_format($totalDesgajado,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Pegado (Minimo 1)</td>
                                    <td style="width: 25%"><?php if(sizeof($hoja)==0){ echo $pegado1['pegado_migrado']; }else{ if($hoja->pegado=="" || $hoja->pegado=="0" || $hoja->pegado==null ){echo $pegado1['pegado_migrado'];}else{ echo $hoja->pegado; }} ?></td>
                                    <td style="width: 25%"><?php if($pegado1['totalPegado']>150000 && $pegado1['totalPegado']<=235000){
                                                                    $pegado_1 = 150000; 
                                                                    echo number_format(150000,0,'','.');
                                                                 }else{
                                                                    if($pegado1['totalPegado']<150000){
                                                                        $pegado_1 = $pegado1['totalPegado']; 
                                                                        echo number_format($pegado1['totalPegado'],0,'','.');
                                                                    }else{
                                                                        if($pegado1['totalPegado']>235000){
                                                                           $pegado1['totalPegado']=$datos->cantidad_1*$pegado1['pegado_migrado']*1.45;
                                                                           $pegado_1=$datos->cantidad_1*$pegado1['pegado_migrado']*1.45;
                                                                           echo number_format($pegado1['totalPegado'],0,'','.');
                                                                        }
                                                                    }
                                                            }?>
                                                    <?php if ($datos->pegado_migrado==null){?> <strong> (Pegado de Cotizacion = 0 )</strong><?php } ?><a href='<?php echo base_url()."hoja$next/pegado/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar Pegado"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Despacho</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%">0</td>
                                </tr>
                                <?php if($fotomecanica->numero_molde!="" && ($fotomecanica->numero_molde!="11" && $fotomecanica->numero_molde!="12" && $fotomecanica->numero_molde!="13" && $fotomecanica->numero_molde!="14" && $fotomecanica->numero_molde!="15" && $fotomecanica->numero_molde!="1" && $fotomecanica->numero_molde!="21")){ $numeromolde="( Nro: ".$fotomecanica->numero_molde." )"; }else{
                                    if($fotomecanica->numero_molde==21){
                                        $numeromolde="( Trazado: ".$datos->trazado." )";
                                    }else{
                                        $numeromolde="( Nro: ".$fotomecanica->numero_molde." )";
                                    }
                                } ?>
                                <tr>
                                    <td style="width: 50%">Molde Troquel <?php echo $numeromolde; ?></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php echo number_format($moldeTroquel,0,'','.')?><a href='<?php echo base_url()."hoja$next/molde_troquel/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar Molde Troquel"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Caucho Calado</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php echo number_format($otrosCaucho,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Piezas Adicionales</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%">0</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">VB en Maquina <?php echo "(".$datos->vb_maquina.")";  ?></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php echo number_format($valor_bv_maquina,0,'','.')?><a href='<?php echo base_url()."hoja$next/visto_bueno/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar vb en maquina"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">No Acepta Excedentes <?php echo "(".$datos->acepta_excedentes.")";  ?></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php echo number_format($valor_acepeta_exce,0,'','.')?><a href='<?php echo base_url()."hoja$next/acepta_excedentes/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar Excedentes"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Detalle Despacho (
                                        <?php 
                                        if($datos->retira_cliente=="" || $datos->retira_cliente == "NO") {
                                            echo "Nuestra cuenta";
                                        } else {
                                            echo "Cuenta del cliente";
                                        }
                                        ?>)
                                    </td>
                                    <td style="width: 25%"><?php echo $des[1]; ?> Palets</td>
                                    <td style="width: 25%"><?php echo $des[0]; ?><a href='<?php echo base_url()."hoja$next/despacho/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar detalle despacho"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="width: 75%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Produccion</b></td>
                                    <td style="width: 25%"><?php echo number_format($totalProduccion,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="titulo" style="width: 100%"><b>Costos Varios</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Costo Venta</b></td>
                                    <td style="width: 25%"><?php echo number_format($costoVentaValor1,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Costo Administracion</b></td>
                                    <td style="width: 25%"><?php echo number_format($costoAdministracion1,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Costo Adicional por Unidad</b></td>
                                    <td style="width: 25%"><?php echo number_format($costoAdicionalPorUnidad,0,'','.')?><a href='<?php echo base_url()."hoja$next/costo_adicional/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar costo adicional"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Costos Varios</b></td>
                                    <td style="width: 25%"><?php echo number_format($totalCostosVarios,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="width: 75%"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="titulo" style="width: 100%"><b>Valores</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Valor Por</b></td>
                                    <td style="width: 25%"><?php echo $datos->cantidad_1/$ing->unidades_por_pliego ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Costo Directo Unitario</b></td>
                                    <td style="width: 25%"><?php echo number_format($totalValorUnitario1,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Valor Final (Margen: <?php echo number_format($margen,0,'','.');?> %)</b></td>
                                    <td style="width: 25%"><?php echo number_format($valorFinal1['valor_final'],0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Valor Financiado </b><?php echo $forma_pago->forma_pago?> (<?php echo $forma_pago->dias?>)<a href='<?php echo base_url()."hoja$next/forma_pago/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar forma de pago"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a><?php echo $text_cantidad_justa; ?></td>
                                    <td style="width: 25%"><?php echo number_format($valorFinanciado1,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Valor Empresa</b></td>
                                    <td style="width: 25%"><?php echo number_format($valorEmpresa1,0,'','.')?><a href='<?php echo base_url()."hoja$next/valor_empresa/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar valor empresa"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Dias de Entrega</b></td>
                                    <td style="width: 25%"><?php echo number_format($dias_de_entrega,0,'','.')?><a href='<?php echo base_url()."hoja$next/dias/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar dias de entrega"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Margen</b></td>
                                    <td style="width: 25%"><?php echo number_format($margen,0,'','.')?><a href='<?php echo base_url()."hoja$next/margen/$id/$pagina"; ?>' class='fancybox fancybox.ajax' title="Modificar margen"><img style="padding-left:7px; width:18px" src="<?php echo base_url();?>public/frontend/images/005-dibujar.png" /></a></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Datos Tecnicos produccion-------------------------------------------->
        <!------------------------tabla patron de mermas cantidad 1-------------------------------------------->
        <div style="height: 480px">
            <table class="table table-condensed">
                <tr>
                    <td class="" style="width: 50%">
                        <div style="height: 250px">
                            <table class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr>
                                    <td colspan="9" class="titulo" style="width: 100%"><b>Tabla de Patrón de MERMAS Microonda TIPO E + Tapa por <?php echo $datos->cantidad_1; ?> = <?php echo ($datos->cantidad_1 / $ing->unidades_por_pliego); ?> Pliegos</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Imprenta</b></td>
                                    <td style="width: 15%">Roland 800</td>
                                    <td style="width: 15%">Roland 800</td>
                                    <td style="width: 25%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color 1-2-3</b></td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                    <td style="width: 25%">Por color</td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color > 3</b></td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 25%"><b></b></td>
                                    <td style="width: 15%"><?php echo $colores2[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cantidad</b></td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 25%">Cantidad > 5.000 * c/5.000</td>
                                    <td style="width: 15%"><?php echo $cantidad1[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Barniz</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $barnizz[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">01<b></b></td>
                                    <td style="width: 15%">01<b></b></td>
                                    <td style="width: 25%">Por cada 1.000 extra</td>
                                    <td style="width: 15%"><?php echo $barnizz[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Trabajo Externo</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $externo ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Micro/Micro</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $micromicro; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cart/Cart</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $cartulina; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Tamanos Normales</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 15%">0</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Emplacado</b></td>
                                    <td style="width: 15%">50<b></b></td>
                                    <td style="width: 15%">50<b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $emplacado_fijo; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">5<b></b></td>
                                    <td style="width: 15%">5<b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php echo $emplacado; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Troquelado</b></td>
                                    <td style="width: 15%">40<b></b></td>
                                    <td style="width: 15%">40<b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $troquelado_fijo; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">4<b></b></td>
                                    <td style="width: 15%">4<b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php echo $troquelado; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Merma</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$sum."<b>"; ?></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <!------------------------tabla patron de mermas cantidad 2-------------------------------------------->
                    <td class="" style="width: 50%">
                        <div style="height: 250px">
                            <table class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr>
                                    <td colspan="9" class="titulo" style="width: 100%"><b>Tabla de Patrón de MERMAS Microonda TIPO E + Tapa por <?php if($datos->cantidad_2=="" || $datos->cantidad_2==0 || $datos->cantidad_2==1){echo "0";}else{echo $datos->cantidad_2;} ?> = <?php if($datos->cantidad_2=="" || $datos->cantidad_2==0 || $datos->cantidad_2==1){echo "0";}else{echo $datos->cantidad_2 / $ing->unidades_por_pliego;} ?> Pliegos</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Imprenta</b></td>
                                    <td style="width: 15%">Roland 800</td>
                                    <td style="width: 15%">Roland 800</td>
                                    <td style="width: 25%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color 1-2-3</b></td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                    <td style="width: 25%">Por color</td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color > 3</b></td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 25%"><b></b></td>
                                    <td style="width: 15%"><?php echo $colores2[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cantidad</b></td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 25%">Cantidad > 5.000 * c/5.000</td>
                                    <td style="width: 15%"><?php echo $cantidad2[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Barniz</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $barnizz2[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">01<b></b></td>
                                    <td style="width: 15%">01<b></b></td>
                                    <td style="width: 25%">Por cada 1.000 extra</td>
                                    <td style="width: 15%"><?php echo $barnizz2[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Trabajo Externo</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $externo ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Micro/Micro</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $micromicro; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cart/Cart</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $cartulina; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Tamanos Normales</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 15%">0</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Emplacado</b></td>
                                    <td style="width: 15%">50<b></b></td>
                                    <td style="width: 15%">50<b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $emplacado_fijo2; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">5<b></b></td>
                                    <td style="width: 15%">5<b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php echo $emplacado2; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Troquelado</b></td>
                                    <td style="width: 15%">40<b></b></td>
                                    <td style="width: 15%">40<b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $troquelado_fijo2; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">4<b></b></td>
                                    <td style="width: 15%">4<b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php echo $troquelado2; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Merma</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$sum2."<b>"; ?></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Datos Tecnicos del trabajo-------------------------------------------->
        <!------------------------tabla patron de mermas cantidad 3-------------------------------------------->
        <div style="height: 540px">
            <table class="table table-condensed">
                <tr>
                    <td class="" style="width: 50%">
                        <div style="height: 250px">
                            <table class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr>
                                    <td colspan="9" class="titulo" style="width: 100%"><b>Tabla de Patrón de MERMAS Microonda TIPO E + Tapa por <?php if($datos->cantidad_3=="" || $datos->cantidad_3==0 || $datos->cantidad_3==1){echo "0";}else{echo $datos->cantidad_3;} ?> = <?php if($datos->cantidad_3=="" || $datos->cantidad_3==0|| $datos->cantidad_3==1){echo "0";}else{echo $datos->cantidad_3 / $ing->unidades_por_pliego;} ?> Pliegos</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Imprenta</b></td>
                                    <td style="width: 15%">Roland 800</td>
                                    <td style="width: 15%">Roland 800</td>
                                    <td style="width: 25%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color 1-2-3</b></td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                    <td style="width: 25%">Por color</td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color > 3</b></td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 25%"><b></b></td>
                                    <td style="width: 15%"><?php echo $colores2[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cantidad</b></td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 25%">Cantidad > 5.000 * c/5.000</td>
                                    <td style="width: 15%"><?php echo $cantidad3[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Barniz</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $barnizz3[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">01<b></b></td>
                                    <td style="width: 15%">01<b></b></td>
                                    <td style="width: 25%">Por cada 1.000 extra</td>
                                    <td style="width: 15%"><?php echo $barnizz3[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Trabajo Externo</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $externo ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Micro/Micro</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $micromicro; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cart/Cart</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $cartulina; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Tamanos Normales</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 15%">0</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Emplacado</b></td>
                                    <td style="width: 15%">50<b></b></td>
                                    <td style="width: 15%">50<b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $emplacado_fijo3; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">5<b></b></td>
                                    <td style="width: 15%">5<b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php echo $emplacado3; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Troquelado</b></td>
                                    <td style="width: 15%">40<b></b></td>
                                    <td style="width: 15%">40<b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $troquelado_fijo3; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">4<b></b></td>
                                    <td style="width: 15%">4<b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php echo $troquelado3; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Merma</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$sum3."<b>"; ?></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <!------------------------tabla patron de mermas cantidad 4-------------------------------------------->
                    <td class="" style="width: 50%">
                        <div style="height: 250px">
                            <table class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr>
                                    <td colspan="9" class="titulo" style="width: 100%"><b>Tabla de Patrón de MERMAS Microonda TIPO E + Tapa por <?php if($datos->cantidad_4=="" || $datos->cantidad_4==0 || $datos->cantidad_4==1){echo "0";}else{echo $datos->cantidad_4;} ?> = <?php if($datos->cantidad_4=="" || $datos->cantidad_4==0|| $datos->cantidad_4==1){echo "0";}else{echo $datos->cantidad_4 / $ing->unidades_por_pliego;} ?> Pliegos</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Imprenta</b></td>
                                    <td style="width: 15%">Roland 800</td>
                                    <td style="width: 15%">Roland 800</td>
                                    <td style="width: 25%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color 1-2-3</b></td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                    <td style="width: 25%">Por color</td>
                                    <td style="width: 15%"><?php echo $colores2[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Color > 3</b></td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 15%">150</td>
                                    <td style="width: 25%"><b></b></td>
                                    <td style="width: 15%"><?php echo $colores2[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cantidad</b></td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 15%">30</td>
                                    <td style="width: 25%">Cantidad > 5.000 * c/5.000</td>
                                    <td style="width: 15%"><?php echo $cantidad4[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Barniz</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">Primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $barnizz4[0] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">01<b></b></td>
                                    <td style="width: 15%">01<b></b></td>
                                    <td style="width: 25%">Por cada 1.000 extra</td>
                                    <td style="width: 15%"><?php echo $barnizz4[1] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Trabajo Externo</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $externo ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Micro/Micro</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $micromicro; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Cart/Cart</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%">una sola vez</td>
                                    <td style="width: 15%"><?php echo $cartulina; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Tamanos Normales</b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 15%"><b></b></td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 15%">0</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Emplacado</b></td>
                                    <td style="width: 15%">50<b></b></td>
                                    <td style="width: 15%">50<b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $emplacado_fijo4; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">5<b></b></td>
                                    <td style="width: 15%">5<b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php echo $emplacado4; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b>Troquelado</b></td>
                                    <td style="width: 15%">40<b></b></td>
                                    <td style="width: 15%">40<b></b></td>
                                    <td style="width: 25%">Los primeros 1.000</td>
                                    <td style="width: 15%"><?php echo $troquelado_fijo4; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px"><b></b></td>
                                    <td style="width: 15%">4<b></b></td>
                                    <td style="width: 15%">4<b></b></td>
                                    <td style="width: 25%">Por cada 1.000</td>
                                    <td style="width: 15%"><?php echo $troquelado4; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Merma</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$sum4."<b>"; ?></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Datos Tecnicos del trabajo-------------------------------------------->
        <!------------------------Inputs de insumo para hoja de costos----------------------------------------->
        <input type="hidden" id="valor_empresa" name="valor_empresa" value="<?php echo $valorEmpresa1 ?>">
        <input type="hidden" id="valor_empresa2" name="valor_empresa2" value="<?php echo $valorEmpresa2 ?>">
        <input type="hidden" id="valor_empresa3" name="valor_empresa3" value="<?php echo $valorEmpresa3 ?>">
        <input type="hidden" id="valor_empresa4" name="valor_empresa4" value="<?php echo $valorEmpresa4 ?>">
        <input type="hidden" id="pegado" name="pegado" value="<?php echo $pegado1['pegado_migrado']; ?>">
        <input type="hidden" id="costo_adicional" name="costo_adicional" value="<?php echo $costoAdicionalPorUnidad; ?>">
        <input type="hidden" id="dias_de_entrega" name="dias_de_entrega" value="<?php echo $dias_de_entrega; ?>">
        <input type="hidden" id="margen" name="margen" value="<?php echo $margen; ?>">
<!--        <input type="hidden" id="valor_acabado_1" name="valor_acabado_1" value="<?php //echo ""; ?>">
        <input type="hidden" id="valor_acabado_2" name="valor_acabado_2" value="<?php //echo ''; ?>">
        <input type="hidden" id="valor_acabado_3" name="valor_acabado_3" value="<?php //echo ''; ?>">-->
        <input type="hidden" id="placa_kilo" name="placa_kilo" value="<?php echo $valorPlacaKilo; ?>">
        <input type="hidden" id="onda_kilo" name="onda_kilo" value="<?php echo $placa[2]; ?>">
        <input type="hidden" id="gramos_metro_cuadrado" name="gramos_metro_cuadrado" value="<?php echo $GramosMetroCuadrado; ?>">
        <input type="hidden" id="total_pliegos" name="total_pliegos" value="<?php echo $valorPlacaKilo; ?>">
        <input type="hidden" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        <input type="hidden" id="total_merma" name="total_merma" value="<?php echo $sum; ?>">
        <input type="hidden" id="total_merma2" name="total_merma2" value="<?php echo $sum2; ?>">
        <input type="hidden" id="total_merma3" name="total_merma3" value="<?php echo $sum3; ?>">
        <input type="hidden" id="total_merma4" name="total_merma4" value="<?php echo $sum4; ?>">
        <input type="hidden" id="piezas_adicionales1" name="piezas_adicionales1" value="<?php echo $piezasAdicionales; ?>">
        <input type="hidden" id="piezas_adicionales2" name="piezas_adicionales2" value="<?php echo $piezasAdicionales; ?>">
        <input type="hidden" id="piezas_adicionales3" name="piezas_adicionales3" value="<?php echo $piezasAdicionales; ?>">
        <input type="hidden" id="kilos_placa" name="kilos_placa" value="<?php echo $valorPlacaKilo; ?>">
        <input type="hidden" id="kilos_onda" name="kilos_onda" value="<?php echo $placa[2]; ?>">
        <input type="hidden" id="kilos_liner" name="kilos_liner" value="<?php echo ''; ?>">
        <input type="hidden" id="fecha_act" name="fecha_act" value="<?php echo $hoja->fecha_act; ?>">
        <!--<input type="hidden" id="valor_externo" name="valor_externo" value="<?php //echo $externos_produccion; ?>">-->
        <input type="hidden" id="valor_pieza" name="valor_pieza" value="<?php echo ""; ?>">
        <input type="hidden" id="valor_extra" name="valor_extra" value="<?php echo $valor_extra; ?>">
        <input type="hidden" id="valor_vb_maquina" name="valor_vb_maquina" value="<?php echo $valor_bv_maquina; ?>">
        <input type="hidden" id="valor_acepta_exce" name="valor_acepta_exce" value="<?php echo $valor_acepeta_exce; ?>">
        <input type="hidden" id="impreso" name="impreso" value="<?php echo $hoja->impreso; ?>">
        <input type="hidden" id="codigo_duplicado" name="codigo_duplicado" value="<?php echo $hoja->codigo_duplicado; ?>">
        <input type="hidden" id="tiraje1" name="tiraje1" value="<?php echo $tiraje; ?>">
        <input type="hidden" id="tiraje2" name="tiraje2" value="<?php echo $tiraje2; ?>">
        <input type="hidden" id="tiraje3" name="tiraje3" value="<?php echo $tiraje3; ?>">
        <input type="hidden" id="tiraje4" name="tiraje4" value="<?php echo $tiraje4; ?>">
        <input type="hidden" id="proveedor1" name="proveedor1" value="<?php echo $hoja->proveedor1; ?>">
        <input type="hidden" id="proveedor2" name="proveedor2" value="<?php echo $hoja->proveedor2; ?>">
        <input type="hidden" id="proveedor3" name="proveedor3" value="<?php echo $hoja->proveedor3; ?>">
        <input type="hidden" id="proveedor4" name="proveedor4" value="<?php echo $hoja->proveedor4; ?>">
        <input type="hidden" id="molde_troquel" name="molde_troquel" value="<?php echo ''; ?>">
        <input type="hidden" id="imprimir" name="imprimir" value="<?php echo '0'; ?>">
        <input type="hidden" id="copia" name="copia" value="<?php echo '0'; ?>">
        <input type="hidden" id="numerocopia" value="<?php echo $id ?>" name="numerocopia" />
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="url" value="<?php echo base_url()?><?php echo $this->uri->uri_string();?>" />
        
        <!------------------------Detalles de Calculo-------------------------------------------->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Detalle de Calculo Variables</h4>
                    </div>
                    <div class="modal-body">
                        <table id="c1" style="display:none" class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr><td colspan="9" class="titulo" style="width: 100%"><b>Variables Calculo Produccion 1</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Lacado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$lacado1."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Complemento</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$complemento."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Valor Corte</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$onda['valorCorte']."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Emplacado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalEmplacado."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Montaje Molde</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalMontajeMolde."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Troquelado</b></td>
                                    <td style="width: 15%"><?php if($totalTroquelado!=""){echo "<b>".$totalTroquelado."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Pegado</b></td>
                                    <td style="width: 15%"><?php if($pegado_1!=""){echo "<b>".$pegado_1."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Despacho</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$des[0]."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Tiraje</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$tiraje."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Molde Troquel</b></td>
                                    <td style="width: 15%"><?php if($moldeTroquel!=""){echo "<b>".$moldeTroquel."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Desgajado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalDesgajado."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Externos Produccion</b></td>
                                    <td style="width: 15%"><?php if($externos_produccion!=""){echo "<b>".$externos_produccion."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Otros Caucho</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$otrosCaucho."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Piezas Adicioonales</b></td>
                                    <td style="width: 15%"><?php if($TotalPiezasAdicionales!=""){echo "<b>".$TotalPiezasAdicionales."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Valor Extra</b></td>
                                    <td style="width: 15%"><?php if($valor_extra!=""){echo "<b>".$valor_extra."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>VB Maquina</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$valor_bv_maquina."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Acepta Excedentes</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$valor_acepeta_exce."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Produccion</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalProduccion."<b>"; ?></td>
                                </tr>
                            </table>
                        <table id="c2" style="display:none" class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr><td colspan="9" class="titulo" style="width: 100%"><b>Variables Calculo Produccion 2</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Lacado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$lacado2."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Complemento</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$complemento2."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Valor Corte</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$onda2['valorCorte']."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Emplacado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalEmplacado2."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Montaje Molde</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalMontajeMolde."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Troquelado</b></td>
                                    <td style="width: 15%"><?php if($totalTroquelado2!=""){echo "<b>".$totalTroquelado2."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Pegado</b></td>
                                    <td style="width: 15%"><?php if($pegado_2!=""){echo "<b>".$pegado_2."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Despacho</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$des2[0]."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Tiraje</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$tiraje2."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Molde Troquel</b></td>
                                    <td style="width: 15%"><?php if($moldeTroquel!=""){echo "<b>".$moldeTroquel."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Desgajado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalDesgajado2."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Externos Produccion</b></td>
                                    <td style="width: 15%"><?php if($externos_produccion2!=""){echo "<b>".$externos_produccion2."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Otros Caucho</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$otrosCaucho."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Piezas Adicioonales</b></td>
                                    <td style="width: 15%"><?php if($TotalPiezasAdicionales2!=""){echo "<b>".$TotalPiezasAdicionales2."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Valor Extra</b></td>
                                    <td style="width: 15%"><?php if($valor_extra!=""){echo "<b>".$valor_extra."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>VB Maquina</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$valor_bv_maquina."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Acepta Excedentes</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$valor_acepeta_exce."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Produccion</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalProduccion2."<b>"; ?></td>
                                </tr>
                            </table>
                        <table id="c3" style="display:none" class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr><td colspan="9" class="titulo" style="width: 100%"><b>Variables Calculo Produccion 3</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Lacado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$lacado3."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Complemento</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$complemento3."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Valor Corte</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$onda3['valorCorte']."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Emplacado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalEmplacado3."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Montaje Molde</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalMontajeMolde."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Troquelado</b></td>
                                    <td style="width: 15%"><?php if($totalTroquelado3!=""){echo "<b>".$totalTroquelado3."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Pegado</b></td>
                                    <td style="width: 15%"><?php if($pegado_3!=""){echo "<b>".$pegado_3."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Despacho</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$des3[0]."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Tiraje</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$tiraje3."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Molde Troquel</b></td>
                                    <td style="width: 15%"><?php if($moldeTroquel!=""){echo "<b>".$moldeTroquel."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Desgajado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalDesgajado3."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Externos Produccion</b></td>
                                    <td style="width: 15%"><?php if($externos_produccion3!=""){echo "<b>".$externos_produccion3."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Otros Caucho</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$otrosCaucho."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Piezas Adicioonales</b></td>
                                    <td style="width: 15%"><?php if($TotalPiezasAdicionales3!=""){echo "<b>".$TotalPiezasAdicionales3."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Valor Extra</b></td>
                                    <td style="width: 15%"><?php if($valor_extra!=""){echo "<b>".$valor_extra."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>VB Maquina</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$valor_bv_maquina."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Acepta Excedentes</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$valor_acepeta_exce."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Produccion</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalProduccion3."<b>"; ?></td>
                                </tr>
                            </table>
                        <table id="c4" style="display:none" class="table table-condensed table-bordered" style="border-width: 2px">
                                <tr><td colspan="9" class="titulo" style="width: 100%"><b>Variables Calculo Produccion 4</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Lacado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$lacado4."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Complemento</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$complemento4."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Valor Corte</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$onda4['valorCorte']."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Emplacado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalEmplacado4."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Montaje Molde</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalMontajeMolde."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Troquelado</b></td>
                                    <td style="width: 15%"><?php if($totalTroquelado4!=""){echo "<b>".$totalTroquelado4."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Pegado</b></td>
                                    <td style="width: 15%"><?php if($pegado_4!=""){echo "<b>".$pegado_4."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Despacho</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$des4[0]."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Tiraje</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$tiraje4."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Molde Troquel</b></td>
                                    <td style="width: 15%"><?php if($moldeTroquel!=""){echo "<b>".$moldeTroquel."<b>";}else{echo "<b>0</b>";} ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Desgajado</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalDesgajado4."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Externos Produccion</b></td>
                                    <td style="width: 15%"><?php if($externos_produccion4!=""){echo "<b>".$externos_produccion4."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Otros Caucho</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$otrosCaucho."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Piezas Adicioonales</b></td>
                                    <td style="width: 15%"><?php if($TotalPiezasAdicionales4!=""){echo "<b>".$TotalPiezasAdicionales4."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Valor Extra</b></td>
                                    <td style="width: 15%"><?php if($valor_extra!=""){echo "<b>".$valor_extra."<b>";}else{echo "<b>0</b>";}  ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>VB Maquina</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$valor_bv_maquina."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Acepta Excedentes</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$valor_acepeta_exce."<b>"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height:5px" colspan="4"><b>Total Produccion</b></td>
                                    <td style="width: 15%"><?php echo "<b>".$totalProduccion4."<b>"; ?></td>
                                </tr>
                            </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <table style="width: 300px;font-size: 14px;text-align: center;border: 1px solid;">
                        <tr>
                            <td><b>Grabada el <?php echo fecha($hoja->fecha); ?></b></td>
                        </tr>
                        <?php if (sizeof($copias)>0){
                         foreach ($copias as $value) {
                           echo "<tr><td><br /><a href='".base_url()."cotizaciones/hoja_de_costos/".$value->id_cotizacion."'>".$value->id_cotizacion."-".$value->codigo_duplicado."</a></td></tr>";
                         }
                        }else{
                            echo "<tr><td><br />No Hay Copias Recientes</td></tr>";
                        } ?>
                    </table>
        <!------------------------tabla de acciones-------------------------------------------->
        <div style="height: 200px;">
            <table class="table table-condensed" style=" margin: 0 auto; width: 500px">
                <tr>
                    <?php if($hoja->impreso==1){ ?>
                    <td style="width: 10%; height:5px">
                        <a href="javascript:void(0);" onclick="copiarHCP();" title="Duplicar Hoja de Costos"><img width="80px" class="crecer" src="<?php echo base_url();?>public/frontend/images/007-hoja.png" /></a>
                    </td>
                    <?php } ?>
                    <td style="width: 10%; height:5px">
                        <a href="javascript:void(0);"   onclick="guardarHCIP()" title="Bloquear y Liberar Hoja de Costos"><img  class="crecer" width="80px" src="<?php echo base_url();?>public/frontend/images/002-bloquear.png" /></a>
                    </td>
                    <td style="width: 10%; height:5px">
                        <a href="<?php echo base_url()?>cotizaciones/search_cot/<?php echo $id?>" title="Regresar a la Cotizacion"><img  class="crecer" width="80px" src="<?php echo base_url();?>public/frontend/images/003-grafico.png" /></a>
                    </td>
                    <td style="width: 10%; height:5px">
                        <a href="<?php echo base_url();?>hoja<?php echo $next ?>/cambios/<?php echo $id?>" class="fancybox fancybox.ajax" title="Historial de Cambios en Hoja de Costos"><img  class="crecer" width="80px" src="<?php echo base_url();?>public/frontend/images/006-papel.png" /></a>
                    </td>
                    <?php if($hoja->impreso == "" || $hoja->impreso == 0){?>
                    <td style="width: 10%; height:5px">
                        <a href="javascript:void(0);" onclick="guardarHCP();"  title="Guardar Hoja de Costos"><img  class="crecer" width="80px" src="<?php echo base_url();?>public/frontend/images/004-tecnologia.png" /></a>
                    <input type="hidden" name="url" value="<?php echo base_url()?><?php echo $this->uri->uri_string();?>" />
                    </td>
                    <?php } ?>
                </tr>
            </table>
        </div>
        <!------------------------fin de tabla de acciones-------------------------------------------->
    </div>
    </form>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/backend/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
        	$(".fancybox").fancybox({
        		openEffect	: 'none',
        		closeEffect	: 'none'
        	});
            
        });
/****************Funciones para modal*******************/        
function info(x){  
if(x=='c1'){
$("#c1").show();
$("#c2").hide();
$("#c3").hide();
$("#c4").hide();
}
if(x=='c2'){
$("#c2").show();
$("#c1").hide();
$("#c3").hide();
$("#c4").hide();
}
if(x=='c3'){
$("#c3").show();
$("#c1").hide();
$("#c2").hide();
$("#c4").hide();
}
if(x=='c4'){
$("#c4").show();
$("#c1").hide();
$("#c3").hide();
$("#c2").hide();
}

}

$('.ir-arriba').click(function(){
 $('body, html').animate({
  scrollTop: '0px'
 }, 300);
 });
 
$('.ir-arriba2').click(function(){
 $('body, html').animate({
  scrollTop: '3700px'
 }, 300);
});
</script>
</html>