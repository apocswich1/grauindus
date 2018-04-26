<?php
$materialidad_1 = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
$materialidad_2 = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
$materialidad_3 = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
$materialidad_4 = "No Aplica";
$variable_cotizador = $this->variables_cotizador_model->getVariablesCotizadorPorId(24);
$variable_cotizador2 = $this->variables_cotizador_model->getVariablesCotizadorPorId(40);
$base_imprenta = $this->variables_cotizador_model->getVariablesCotizadorPorId(6);
/***************Materias primas******************/
//colores
function colores($color,$vb,$ae,$maquina){
if ($color > 3) {
    if ($maquina == "Máquina Roland 800") {
        if ($vb == 'SI' || $ae == 'NO') {
            $color1 = 0;
            $color2 = $color * 100;
        } else {
            $color1 = 0;
            $color2 = $color * 100;
        }
    } else {
        if ($vb == 'SI' || $ae == 'NO') {
            $color1 = 0;
            $color2 = $color * 100;
        } else {
            $color1 = 0;
            $color2 = $color * 100;
        }
    }
} else {
    if ($color == 0) {
        $color1 = 0;
        $color2 = 0;
    } elseif ($color >= 1 and $color <= 3) {
        if ($maquina == "Máquina Roland 800") {
            $color1 = 400;
            $color2 = 0;
        } else {
            //ultra
            $color1 = 400;
            $color2 = 0;
        }
    }
}

return array($color1,$color2);
}
//************cantidades*****************************************
function cantidad($cant,$unidades){
    $cantidad=$cant/$unidades;
    if ($cantidad > 5000) {
        $vecescan1 = ($cantidad) / 5000;
        if ($vecescan1 > 1) {
            $can1 = 30 * $vecescan1;
        } else {
            $can1 = 30;
        }
        if ($vecescan1 > 1) {
            //$entero=number_format(($cantidad_1/5000)+0.5,0,'','');
            $can2 = 50 * $vecescan1;
        } else {
            $can2 = 50;
        }
    } else {
        $can1 = 0;
        $can2 = 0;
    }

    return array($can1,$can2);    
}

//********************barniz*******************************/
function barniz($llevabarniz,$cantidad,$unidades){
    if (($llevabarniz != '') && ($llevabarniz != 'Nada')) {
        $cantidadBarniz = $cantidad - 1000;
        if ($cantidadBarniz < 1000) {
            if ($maquina == "Máquina Roland 800") {
                $bar1 = 100;
                $bar2 = 0;
            } else {
                $bar1 = 100;
                $bar2 = 0;
            }
        } else {
            $enteroBarniz = ($cantidad / $unidades);
            if ($enteroBarniz < 1000) {
                $bar1 = 100;
                $bar2 = 0;
            } else {
                $enteroBarniz = number_format((((($enteroBarniz / 1000) + 1) - 2) * 10), 0, '', '');
                $bar1 = 100;
                $bar2 = number_format((($cantidad - 1000) / 1000 * 1), 0, '', '');
            }
        }
    } else {
        $bar1 = 0;
        $bar2 = 0;
    }
    
    return array($bar1,$bar2);
}

//***********************Externo*************************************************/
if($fotomecanica->acabado_impresion_4 != "17" or $fotomecanica->acabado_impresion_5 != "17" or $fotomecanica->acabado_impresion_6 != "17") {

    if ($fotomecanica->acabado_impresion_4 != "No lleva" or $fotomecanica->acabado_impresion_5 != "No lleva" or $fotomecanica->acabado_impresion_6 != "No lleva") {

        if ($fotomecanica->acabado_impresion_4 != "" or $fotomecanica->acabado_impresion_5 != "" or $fotomecanica->acabado_impresion_6 != "") {

            $externo = 50;
        } else {

            $externo = 0;
        }
    }
}
//****************************Micromicro******************************************************/
if ($ing->materialidad_datos_tecnicos == "Onda a la Vista") {
    $canTotal2 = number_format($datos->cantidad_1 / 1000, 0, "", "");
    // echo $canTotal2;exit;
    if ($canTotal2 >= 1) {
        $micromicro = 30 * $canTotal2;
    } else {
        $micromicro = 0;
    }
} else {
    $micromicro = 0;
}
//****************************Cartulina******************************************************/
if ($ing->materialidad_datos_tecnicos == "Cartulina-cartulina") {
    $canTotal2 = number_format($datos->cantidad_1 / 1000, 0, "", "");
    // echo $canTotal2;exit;
    if ($canTotal2 >= 1) {
        $cartulina = 30 * $canTotal2;
    } else {
        $cartulina = 0;
    }
} else {
    $cartulina = 0;
}
//****************************Emplacado******************************************************/
if ($ing->materialidad_datos_tecnicos == "Sólo Cartulina") {
    $emplacado = 0;
    $emplacado_fijo = 0;
    $emplacado_merma = $mermaEmplacadoArray->precio;
} else {
    
    $mermaEmplacadoArray = $this->variables_cotizador_model->getVariablesCotizadorPorId(35);
    $emplacado = $datos->cantidad_1; /* Valor x dividido por Unidad por pliego */

    $emplacado = $emplacado / 1000; /* Resultado de emplacado dividido por 1000 */

    $emplacado = ($emplacado * 1000) + 0.5; /* Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5 */

    $emplacado = $emplacado / 1000; /* emplacado dividido por 1000 */

    $emplacado = $emplacado + 0.499; /* emplacado mas 0.499: Resultado emplacado es en decimales */
    
    $Entero = number_format($emplacado,0, "",""); /* Guardar entero del emplacado */

    $emplacado_fijo = 50; /* Multiplicar entero del emplacado por 15 */
    $emplacado = $Entero * $mermaEmplacadoArray->precio; /* Multiplicar entero del emplacado por 15 */
    $emplacado_merma = $mermaEmplacadoArray->precio;
}

//****************************Troquelado******************************************************/
if ($fotomecanica->estan_los_moldes == "NO LLEVA" or $fotomecanica->estan_los_moldes == "CLIENTE LO APORTA" || $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina') {
    $troquelado = 0;
    $troquelado_fijo = 0;
    $troquelado_merma = $mermaTroqueladoArray->precio;
} else {

    $mermaTroqueladoArray = $this->variables_cotizador_model->getVariablesCotizadorPorId(36);
    if (($datos->cantidad_1 > 0) and ( $ing->unidades_por_pliego > 0))
        $troquelado = $datos->cantidad_1 / $ing->unidades_por_pliego;
    else
    $troquelado = 0;
    $troquelado = $troquelado / 1000; /* Resultado de emplacado dividido por 1000 */
    $troquelado = ($troquelado * 1000) + 0.5; /* Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5 */
    $troquelado = $troquelado / 1000; /* emplacado dividido por 1000 */
    $troquelado = $troquelado + 0.499; /* emplacado mas 0.499: Resultado emplacado es en decimales */
    $EnteroTroquelado = number_format($troquelado, 0, '', ''); /* Guardar entero del emplacado */
    $troquelado = $EnteroTroquelado * $mermaTroqueladoArray->precio; /* Multiplicar entero del emplacado por 15 */
    $troquelado_fijo = 40;
    $troquelado_merma = $mermaTroqueladoArray->precio;
}
//****************************Formula Costo monotapa x kilo*************************************************/
if ($materialidad_2->gramaje>0)
                                            $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
					else 	
                                            $costo_kilo=0;
//                                        echo $materialidad_3->tipo."======".$materialidad_3->reverso;
										
                                        if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                        {
//                                                echo "1==============";
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;
                                        }

                                        elseif($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        else
                                        $costo_kilo_obtenido=140;
                                        $costo_mkilo=$costo_kilo+$costo_kilo_obtenido;

//****************************Formula Costo placa kilo*************************************************/
function costo_placa_kilo($cantidad,$unidades,$sum){
    if (($cantidad > 0) and ( $unidades > 0))
        $costoPlacaKilo = ($cantidad / $unidades) + $sum;
    else
        $costoPlacaKilo = 0;
    
    return $costoPlacaKilo;
}

$colores2 = colores($fotomecanica->colores,$datos->vb_maquina,$datos->acepta_excedentes,$maquina);
$cantidad1 = cantidad($datos->cantidad_1,$ing->unidades_por_pliego);
$cantidad2 = cantidad($datos->cantidad_2,$ing->unidades_por_pliego);
$cantidad3 = cantidad($datos->cantidad_3,$ing->unidades_por_pliego);
$cantidad4 = cantidad($datos->cantidad_4,$ing->unidades_por_pliego);
$barnizz = barniz($fotomecanica->fot_lleva_barniz,$datos->cantidad_1,$ing->unidades_por_pliego);
$externo;
$micromicro;
$cartulina;
$emplacado;
$troquelado;
$emplacado_fijo;
$troquelado_fijo;

$sum=$colores2[0]+$colores2[1]+$cantidad1[0]+$barnizz[0]+$barnizz[1]+$externo+$micromicro+$cartulina+$emplacado+$troquelado+$emplacado_fijo+$troquelado_fijo;

$costoPlacaKilo = costo_placa_kilo($datos->cantidad_1, $ing->unidades_por_pliego, $sum);
$tapaGramaje=$materialidad_1->gramaje;
 $tapaPrecio=$materialidad_1->precio;
//*****************formula valor placa kilo******************************
$valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
//*****************formula total placa kilo******************************
$totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
/*****************formula corte 7%***********************************/
$corte = $totalPlacaKilo*7/100;
/**************Formula Calculo Onda Kilo y placa kilo**************************************/
if ($materialidad_2->gramaje > 0)
    $GramosMetroCuadrado = $materialidad_2->gramaje + ($materialidad_2->gramaje * ($variable_cotizador->precio / 100)) + $materialidad_3->gramaje;
else
    $GramosMetroCuadrado = 0;
$recargoGramosDeAlmidon = $this->variables_cotizador_model->getVariablesCotizadorPorId(30);
$GramosMetroCuadrado = $GramosMetroCuadrado + $recargoGramosDeAlmidon->precio;

if ($materialidad_2->gramaje > 0)
    $costo_kilo = ((($materialidad_2->gramaje * ($materialidad_2->precio / 1000) + (($materialidad_2->gramaje * ($variable_cotizador->precio / 100) * $materialidad_2->precio / 1000)) + $materialidad_3->gramaje * $materialidad_3->precio / 1000) / ($materialidad_2->gramaje + ($materialidad_2->gramaje * ($variable_cotizador->precio / 100)) + $materialidad_3->gramaje))) * 1000;
else
    $costo_kilo = 0;

$tapaGramaje3=$materialidad_3->gramaje;

function calculo_onda_kilo($cantidad,$unidades,$materialidad,$GramosMetroCuadrado,$tamano1,$tamano2,$emplacado,$troquelado,$maquina,$costo_kilo){
if ($maquina == "Máquina Roland 800") {
    if (($cantidad > 0) and ( $unidades > 0))
        $costoOndaKilo = ((($cantidad / $unidades) * 1.04) + 100) + 4;
    else
        $costoOndaKilo = 0;
}
//echo "-----".$costoOndaKilo;
if ($materialidad == 'Sólo Cartulina') {
    $costoOndaKilo = 0;
    $valorOndaKilo = 0;
    $totalOndaKilo = 0;
    $valorCorte = 0;
} else {
    $valorOndaKilo = ($costoOndaKilo * $tamano1 * $tamano2 * $GramosMetroCuadrado) / 10000000;
    //echo "-----".$totalOndaKilo = $valorOndaKilo * $costo_kilo;
    $valorCorte = $costoOndaKilo * 4.5;
}
$costoOndaKilo1 = ((($cantidad / $unidades) * 1.04) + 100) + 4;
$costoOndaKilo2 = (($cantidad / $unidades) + $emplacado + $troquelado);

if ($costoOndaKilo1 > $costoOndaKilo2) {
    $costoOndaKilo = $costoOndaKilo1;
}
if ($costoOndaKilo1 < $costoOndaKilo2) {
    $costoOndaKilo = $costoOndaKilo2;
}

return array('costoOndaKilo'=>$costoOndaKilo,'valorOndaKilo'=>$valorOndaKilo,'totalOndaKilo'=>$totalOndaKilo,'valorCorte'=>$valorCorte);
}

function calculo_placa_kilo($cantidad,$unidades,$materialidad,$colores,$tapaGramaje3,$onda){
if ($materialidad == 'Cartulina-cartulina') {
    $costoPlacaKilo2 = ($cantidad / $unidades);
    $cuatro_por_ciento = ($costoPlacaKilo2 / 100) * 4;

    if ($cuatro_por_ciento >= 1 and $cuatro_por_ciento <= 100) {
        if ($colores == 0) {
            $agregado_a_apliegos = 25;
        } else {
            $agregado_a_apliegos = 100;
        }
    }

    if ($cuatro_por_ciento > 100) {
        $agregado_a_apliegos = $cuatro_por_ciento;
    }
    $costoPlacaKilo2 = $costoPlacaKilo2 + $agregado_a_apliegos;
    $valorPlacaKilo2 = ($costoPlacaKilo2 * $tamano1 * $tamano2 * $tapaGramaje3) / 10000000;
    $totalPlacaKilo2 = $valorPlacaKilo2 * $tapaPrecio3;
    $nombre_tapa_u_onda="Tapa Kilo (Respaldo):";
    $totalMerma = $totalPlacaKilo2;
    
    return array($nombre_tapa_u_onda,$costoPlacaKilo2,$valorPlacaKilo2,$totalPlacaKilo2,$totalMerma);
} else {
    $nombre_tapa_u_onda="Onda Kilo:";
    $valorOndaKilo=$onda['valorOndaKilo'];
    $costoOndaKilo=$onda['costoOndaKilo'];
    $totalOndaKilo=$onda['totalOndaKilo'];
    $totalMerma = $onda['totalOndaKilo'];
    
    return array($nombre_tapa_u_onda,$costoOndaKilo,$valorOndaKilo,$totalOndaKilo,$totalMerma);
}
}

//**************************Formula para el barniz**********************************//
if (($fotomecanica->fot_lleva_barniz == 'Nada') || ($fotomecanica->fot_lleva_barniz == '')) {
    $barniz = 0;
} else {
    $barniz = 1;
}
//**************************Calculos para la pre impresion**********************************//
$arte=$this->variables_cotizador_model->getVariablesCotizadorPorId(1);
$plancha_metal=$this->variables_cotizador_model->getVariablesCotizadorPorId(2);
$copiado=$this->variables_cotizador_model->getVariablesCotizadorPorId(3);
$peliculasPreImpresion = $this->variables_cotizador_model->getVariablesCotizadorPorId(4);
$peliculasVariable = $this->variables_cotizador_model->getVariablesCotizadorPorId(28);
$cantidadPeliculas = $ing->tamano_a_imprimir_1 * $ing->tamano_a_imprimir_2 * $fotomecanica->colores * $peliculasVariable->precio;
$montajePreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(5);
$cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->colores;
$cromalinVariable = $this->variables_cotizador_model->getVariablesCotizadorPorId(22);

if ($maquina == "Máquina Roland 800") {
    $recargoPlanchaArray = $this->variables_cotizador_model->getVariablesCotizadorPorId(26);
    $recargoPlancha = $recargoPlanchaArray->precio;
    $valorParaPlanchaMetal = 1;
}
$cantidadCopiado=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz))+(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz))*$recargoPlancha/100*$valorParaPlanchaMetal;

//variables cromalin
if ($datos->impresion_hacer_cromalin == 'SI') {
    $cromalin = $cromalinVariable->precio;
    $coloresCromalin = 1;
} else {
    $cromalin = 0;
    $coloresCromalin = 0;
}

if ($fotomecanica->condicion_del_producto == 'Nuevo') { //nuevo 
    $coloresArte = $barniz + $fotomecanica->colores;
    $coloresPlanchaMetal = $fotomecanica->colores + $barniz;
    $coloresCopiado = $fotomecanica->colores + $barniz;
    $coloresPeliculas = $barniz + $fotomecanica->colores;
    $coloresMontaje = $barniz + $fotomecanica->colores;
}

if ($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') { //
    $coloresArte = 0;
    $coloresPlanchaMetal = $fotomecanica->colores + $barniz;
    $coloresCopiado = $fotomecanica->colores;
    $coloresPeliculas = 0;
    $coloresMontaje = 0;
    $cantidadArte = 0;
    $cantidadPeliculas = 0;
    $cantidadMontaje = 0;
    $cromalin = 0;
}
if ($fotomecanica->condicion_del_producto == 'Repetición Con Cambios') { //
    //ver cambio de peliculas con fotomecanicas y validar
    $coloresArte = 0;
    $coloresPlanchaMetal = $fotomecanica->colores + $barniz;
    $coloresCopiado = $fotomecanica->colores;
    $coloresPeliculas = 0;
    $coloresMontaje = 0;
    $cantidadArte = 0;
    $cantidadPeliculas = 0;
}
if ($fotomecanica->condicion_del_producto == 'Producto Genérico') { //
    $coloresArte = 0;
    $coloresPlanchaMetal = 0;
    $coloresCopiado = 0;
    $coloresPeliculas = 0;
    $coloresMontaje = 0;
}

//variables peliculas
if($fotomecanica->condicion_del_producto=='Repetición Sin Cambios'){
$peliculasPI = 0;
$cantidadPeliculas = 0;
}else{
$peliculasPI = number_format($peliculasPreImpresion->precio,0,'','.');
}
//variables montaje
if($fotomecanica->condicion_del_producto=='Repetición Sin Cambios'){
$montajePI= '0';
$cantidadMontaje=0;
}else{
$montajePI= number_format($montajePreImpresion->precio,0,'','.');
$cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->colores;
}

//$cantidadArte=$fotomecanica->colores*$arte->precio;
$onda = calculo_onda_kilo($datos->cantidad_1,$ing->unidades_por_pliego,$fotomecanica->materialidad_datos_tecnicos,$GramosMetroCuadrado,$tamano1,$tamano2,$emplacado,$troquelado,$maquina,$costo_kilo);
$placa = calculo_placa_kilo($cantidad,$unidades,$materialidad,$colores,$tapaGramaje3,$onda);
$totalMateriaPrima = $totalPlacaKilo + $corte + $placa[4] + (($placa[4]*10)/100);
$cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz))+(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz))*$recargoPlancha/100*$valorParaPlanchaMetal;

//variable pre impresion
if ($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios'){
    $totalPreImpresion = $cantidadArte + $cantidadPlantaMetal + $cantidadCopiado + $cantidadPeliculas;
}else{
$totalPreImpresion = $cantidadArte + $cantidadPlantaMetal + $cantidadCopiado + $cantidadPeliculas + $cantidadMontaje + $cromalin;
}

//*********formula para factor de rango
$factor_rangos1 = $this->variables_cotizador_model->getVariablesCotizadorPorId(17);
$factor_rangos2 = $this->variables_cotizador_model->getVariablesCotizadorPorId(18);
$factor_rangos3 = $this->variables_cotizador_model->getVariablesCotizadorPorId(19);
function factor_rango($cantidad,$unidades,$factor_rangos1,$factor_rangos2,$factor_rangos3){
    if (($cantidad > 0) and ( $unidades > 0)) {
        $tiraje = $cantidad / $unidades;
    } else {
        $tiraje = 0;
    }

    if ($tiraje < 4000) {
    $tiraje2 = "Menos de 4.000";
    $factor_rango = $factor_rangos1->precio;
} elseif ($tiraje > 4000 and $tiraje < 10000) {
    $tiraje2 = "4.001 a 10.000";
    $factor_rango = $factor_rangos2->precio;
} else {
    $tiraje2 = "Más de 10.000";
    $factor_rango = $factor_rangos3->precio;
}

return $factor_rango;
}
$factor_rango = factor_rango($datos->cantidad_1, $ing->unidades_por_pliego,$factor_rangos1,$factor_rangos2,$factor_rangos3,$fotomecanica);

//*************formula para el tiraje*************************
$recargo800Array = $this->variables_cotizador_model->getVariablesCotizadorPorId(34);
$base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
function tiraje($cantidad,$unidades,$sum,$recargo800Array,$barniz,$base_imprenta,$factor_rango,$maquina){
if ($maquina == "Máquina Roland 800") {
     $tira1 = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio ) * ($fotomecanica->colores + $barniz);
     $tira2 = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio) * ($fotomecanica->colores + $barniz) * (1 * $recargo800Array->precio / 100);
     $tiraje = $tira1 + $tira2;   
} else {
    //$tiraje = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio ) * ($fotomecanica->colores + $barniz);
     $tira1 = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio ) * ($fotomecanica->colores + $barniz);
     $tira2 = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio) * ($fotomecanica->colores + $barniz) * (1 * $recargo800Array->precio / 100);
     $tiraje = $tira1 + $tira2;   
}
return $tiraje;
}
$tiraje = tiraje($datos->cantidad_1, $ing->unidades_por_pliego, $sum, $recargo800Array, $barniz, $base_imprenta,$factor_rango,$fotomecanica,$maquina);

//*********************Formula para el complemento******************************//
$variableComplemento = $this->variables_cotizador_model->getVariablesCotizadorPorId(32);
$valorTiraje = $variableComplemento->precio - $tiraje;
echo "------------------".$variableComplemento->precio;
echo "------------------".$tiraje;
if ($valorTiraje > 0) {
    if ($fotomecanica->colores == 0) {
        $complemento = 0;
    } else {
        $complemento = $valorTiraje;
    }
} else {
    $complemento = 0;
}
//*******************************************************************************//
//echo "<h1>------".$fotomecanica->colores."</h1>";
//echo "<h1>------".$ing->unidades_por_pliego."</h1>";
//echo "<h1>------".$datos->cantidad_1."</h1>";
//echo "<h1>------".$sum."</h1>";
//echo "<h1>------".$factor_rango."</h1>";
//echo "<h1>------".$recargo800Array->precio."</h1>";
//echo "<h1>------".$barniz."</h1>";
//echo "<h1>------".$base_imprenta->precio."</h1>";
//echo "<h1>------".$maquina."</h1>";
//$datos->cantidad_1 > 0) and ( $ing->unidades_por_pliego > 0
?>
