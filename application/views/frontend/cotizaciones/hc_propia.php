<?php 
//fecha de emision*****************************************************************************
if(sizeof($hoja)>0){$fecha_emision='<strong>(Guardada el '.fecha($hoja->fecha).')</strong>';}
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

//datos de la descripcion del trabajo **********************************************************
$materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
$materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
$materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
$tamano1=$ing->tamano_a_imprimir_1;
$tamano2=$ing->tamano_a_imprimir_2;
$nombre_producto = $ing->producto;
$cala_caucho = $fotomecanica->fot_cala_caucho;
$tapa = $fotomecanica->materialidad_1;
$onda = $fotomecanica->materialidad_2;
$liner = $fotomecanica->materialidad_3;
$colores = $fotomecanica->colores;
$reverso_tapa = $materialidad_1->reverso;
$reverso_onda = $materialidad_2->reverso;
$reverso_liner = $materialidad_3->reverso;
$barniz = $fotomecanica->fot_lleva_barniz;
$tamano = $tamano1." X ".$tamano2." cm";
$reserva_barniz = $fotomecanica->fot_reserva_barniz;
$unidad_pliego = $ing->unidades_por_pliego; 
$colores = $fotomecanica->colores;
$piezas_totales= $ing->piezas_totales_en_el_pliego;
$acabado=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_1);
$tamano1=$ing->tamano_a_imprimir_1;
$tamano2=$ing->tamano_a_imprimir_2;
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
$impresion = "";
$molde = "";
$costo_monotapa_por_kilo = "";
$costo_monotapa_por_m2 = "";
$gramos_onda_por_m2 = "";
$maquina="Máquina Roland 800";

//Descripcion Trabajos externos*******************************************************************
require('/parcialTrabajosEspeciales.php');
require('/parcialMateriasPrimas.php');

//echo "-----------------".$datos->vb_maquina;
//echo "-----------------".$datos->acepta_excedentes;
//echo "-----------------".$colores2[0];
//echo "-----------------".$colores2[1];

//echo "<pre>".print_r($placa)."</pre>";
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
    </style>
</head>
<body>
    <div class="container" style="height:780px; background-color: white">
        <div style="height: 120px">
            <table class="table">
                <tr>
                    <td style="width: 220px">
                        <img src="<?php echo base_url(); ?>public/frontend/images/logo-cartonajes-web.jpg" style="width: 150px; float: left" />
                    </td>
                    <td>
                        <h1>Hoja de Costos</h1>
                    </td>
                    <td>
                        <b> Fecha: </b><?php echo $fecha_emision; ?>
                        <br /><br />
                        <b>Estado del Producto:</b> <span style="font-size: 16px;" class="label label-success">Repeticion sin Cambios</span>
                    </td>
                </tr>
            </table>
        </div>
        <div style="height: 210px">
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
                    <td style="width: 35%"><?php echo $vendedor ?></td>
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
        </div>
        <!------------------------Descripcion del trabajo-------------------------------------------->
        <div style="height: 250px">
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
                    <td style="width: 20%"><?php echo $reverso_tapa ?></td>
                    <td style="width: 15%"><b>Barniz:</b></td>
                    <td style="width: 20%"><?php echo $barniz ?></td>
                </tr>
                <tr>
                    <td style="width: 10%"><b>Onda:</b></td>
                    <td style="width: 20%"><?php echo $onda ?></td>
                    <td style="width: 15%"><b>Reverso Onda:</b></td>
                    <td style="width: 20%"><?php echo $reverso_onda ?></td>
                    <td style="width: 15%"><b>Reserva Barniz:</b></td>
                    <td style="width: 20%"><?php echo $reserva_barniz ?></td>
                </tr>
                <tr>
                    <td style="width: 10%"><b>Liner:</b></td>
                    <td style="width: 20%"><?php echo $liner ?></td>
                    <td style="width: 15%"><b>Reverso Liner:</b></td>
                    <td style="width: 20%"><?php echo $reverso_liner ?></td>
                    <td style="width: 15%"><b>Cala Caucho:</b></td>
                    <td style="width: 20%"><?php echo $cala_caucho ?></td>
                </tr>
                <tr>
                    <td style="width: 10%"><b>Tamaño:</b></td>
                    <td style="width: 20%"><?php echo $tamano ?></td>
                    <td style="width: 15%"><b>Unidad / Pliego:</b></td>
                    <td style="width: 20%"><?php echo $unidad_pliego ?></td>
                    <td style="width: 15%"><b>Colores: </b></td>
                    <td style="width: 20%"><?php echo $colores ?></td>
                </tr>
                <tr>
                    <td style="width: 10%"><b>Piezas Totales en Pliego<br />(Para Desgajado )</b></td>
                    <td style="width: 20%"><?php echo $piezas_totales ?></td>
                    <td style="width: 15%"><b>Terminacion:</b></td>
                    <td style="width: 20%"><?php echo $terminacion ?></td>
                    <td style="width: 15%"><b></b></td>
                    <td style="width: 20%"></td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Descripcion del trabajo-------------------------------------------->
        
        <!------------------------Datos Tecnicos del trabajo-------------------------------------------->
        <div style="height: 250px">
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
                                    <td colspan="7" style="width: 80%"><?php echo $materialidad ?></td>
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
                                <tr>
                                    <td style="width: 10%"><b>Onda:</b></td>
                                    <td style="width: 20%"><?php echo $onda ?></td>
                                    <td style="width: 15%"><b>Gramaje:</b></td>
                                    <td style="width: 15%"><?php echo $gramaje_onda ?></td>
                                    <td style="width: 15%"><b>Precio:</b></td>
                                    <td style="width: 15%"><?php echo $precio_onda ?></td>
                                    <td style="width: 15%"><b>Reverso:</b></td>
                                    <td style="width: 20%"><?php echo $reverso_onda ?></td>
                                </tr>
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
                                <tr>
                                    <td style="width: 10%"><b>Costo * Kilo:</b></td>
                                    <td style="width: 20%"><?php echo $costo_monotapa_por_kilo ?></td>
                                    <td colspan="2" style="width: 20%"><b>Costo * M2:</b></td>
                                    <td style="width: 15%"><?php echo $reverso_liner ?></td>
                                    <td colspan="2" style="width: 15%"><b>Costo Onda M2:</b></td>
                                    <td style="width: 15%"><?php echo $cala_caucho ?></td>
                                </tr>
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
                                    <td colspan="9" class="titulo" style="width: 100%"><b>Trabajos Externos</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><b>Trabajo</b></td>
                                    <td style="width: 20%"><b>Uni.Uso</b></td>
                                    <td style="width: 15%"><b>Cant</b></td>
                                    <td style="width: 20%"><b>Ancho</b></td>
                                    <td style="width: 15%"><b>Largo</b></td>
                                    <td style="width: 20%"><b>M2</b></td>
                                    <td style="width: 20%"><b>V Unit m2</b></td>
                                    <td style="width: 20%"><b>C.Unit</b></td>
                                    <td style="width: 20%">Total</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><b>Onda:</b></td>
                                    <td style="width: 20%"><?php echo $onda ?></td>
                                    <td style="width: 15%"><b>Reverso Onda:</b></td>
                                    <td style="width: 20%"><?php echo $reverso_onda ?></td>
                                    <td style="width: 15%"><b>Reserva Barniz:</b></td>
                                    <td style="width: 20%"><?php echo $reserva_barniz ?></td>
                                    <td style="width: 20%"><?php echo $reserva_barniz ?></td>
                                    <td style="width: 20%"><?php echo $reserva_barniz ?></td>
                                    <td style="width: 20%">100000</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><b>Liner:</b></td>
                                    <td style="width: 20%"><?php echo $liner ?></td>
                                    <td style="width: 15%"><b>Reverso Liner:</b></td>
                                    <td style="width: 20%"><?php echo $reverso_liner ?></td>
                                    <td style="width: 15%"><b>Cala Caucho:</b></td>
                                    <td style="width: 20%"><?php echo $cala_caucho ?></td>
                                    <td style="width: 20%"><?php echo $cala_caucho ?></td>
                                    <td style="width: 20%"><?php echo $cala_caucho ?></td>
                                    <td style="width: 20%"><?php echo $cala_caucho ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><b>Tamaño:</b></td>
                                    <td style="width: 20%"><?php echo $tamano ?></td>
                                    <td style="width: 15%"><b>Unidad / Pliego:</b></td>
                                    <td style="width: 20%"><?php echo $unidad_pliego ?></td>
                                    <td style="width: 15%"><b>Colores: </b></td>
                                    <td style="width: 20%"><?php echo $colores ?></td>
                                    <td style="width: 20%"><?php echo $colores ?></td>
                                    <td style="width: 20%"><?php echo $colores ?></td>
                                    <td style="width: 20%"><?php echo $colores ?></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Datos Tecnicos del trabajo-------------------------------------------->
        <!------------------------Descripcion del trabajo externo-------------------------------------------->
        
        <div style="height: 300px; margin-top: 70px">
            <table class="table table-condensed" border="1">
                <tr>
                    <td colspan="9" class="titulo" style="width: 100%"><b>Descripcion de Trabajos</b></td>
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
                    <td style="width: 10%"><b>Total</b></td>
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
                </tr>
                <tr>
                    <td colspan="8" style="width: 90%"><b>Total Precio de Trabajos Externos</b></td>
                    <td style="width: 10%"></td>
                </tr>
                <tr>
                    <td style="width: 20%"><b>Piezas Adicionales</b></td>
                    <td style="width: 10%"><b>Unidad de Uso</b></td>
                    <td style="width: 10%"><b>Cantidad</b></td>
                    <td style="width: 10%"><b>Ancho</b></td>
                    <td style="width: 10%"><b>Largo</b></td>
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
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>
                </tr>
                <tr>
                    <td colspan="8" style="width: 90%"><b>Total Precio de Piezas Adicionales</b></td>
                    <td style="width: 10%"></td>
                </tr>
                <tr>
                    <td colspan="8" style="width: 90%"><b>Total Externos</b></td>
                    <td style="width: 10%"></td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Descripcion del trabajo externo-------------------------------------------->
         <!------------------------Datos de materias primas-------------------------------------------->
        <div style="height: 250px; margin-top: 30px">
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
                                    <td style="width: 50%">Tapa Kilo:<?php echo number_format($valorPlacaKilo,0,'','.');?></td>
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
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Costos Varios</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total</b></td>
                                    <td style="width: 25%"></td>
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
                                    <td style="width: 50%">Tiraje</td>
                                    <td style="width: 25%"><?php echo $factor_rango ?></td>
                                    <td style="width: 25%"><?php echo number_format($tiraje,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Complemento</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"><?php echo number_format($complemento,0,'','.')?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Externos</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Costos por Lacado</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Corte</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Emplacado</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Montaje Molde</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Troquelado</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Desgajado</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Pegado</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Despacho</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Molde Troquel</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Caucho</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Piezas Adicionales</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">VB en Maquina</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">No Acepta Excedentes</td>
                                    <td style="width: 25%"></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="width: 75%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Produccion</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="titulo" style="width: 100%"><b>Costos Varios</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Costo Venta</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Onda Kilo</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Costo Administracion</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Costo Adicional por Unidad</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Total Costos Varios</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="width: 75%"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="titulo" style="width: 100%"><b>Valores</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Valor Por</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Valor Final</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Valor Financiado 60 Dias</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Valor Empresa</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Dias de Entrega</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Valor Unitario</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 75%"><b>Margen</b></td>
                                    <td style="width: 25%"></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!------------------------Fin de Datos Tecnicos produccion-------------------------------------------->
    </div>
</body>
</html>