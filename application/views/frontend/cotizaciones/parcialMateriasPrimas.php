<?php
$materialidad_1 = $this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_placa1);
$materialidad_2 = $this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
$materialidad_3 = $this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_liner3);
$materialidad_4 = "No Aplica";
$variable_cotizador = $this->variables_cotizador_model->getVariablesCotizadorPorId(24);
$variable_cotizador2 = $this->variables_cotizador_model->getVariablesCotizadorPorId(40);
$base_imprenta = $this->variables_cotizador_model->getVariablesCotizadorPorId(6);
$maquina="Máquina Roland 800";
$tamano1=$ing->tamano_a_imprimir_1;
$tamano2=$ing->tamano_a_imprimir_2;
$comision_agencia=$datos->comision_agencia;
$costo_comercial=$datos->costo_comercial;
$tapaPrecio3=$materialidad_3->precio;

if($hoja->impreso==1){
    $next="2";
}else{
    $next="";
}

$ancho = 72;
$largo = 102;

if ($tamano1 < $tamano2) {
    $anchomenor = $tamano1;
    $anchomayor = $tamano2;
} else {
    $anchomayor = $tamano1;
    $anchomenor = $tamano2;
}

if (($anchomenor <= $ancho) && ($anchomayor <= $largo)) {
    $condicionado = "Se Puede Imprimir afuera";
} else {
    $condicionado = "No Puede Imprimir afuera";
}
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
                $bar2 = number_format(((($cantidad/$unidades) - 1000) / 1000 * 1), 0, '', '');
            }
        }
    } else {
        $bar1 = 0;
        $bar2 = 0;
    }
    
    return array($bar1,$bar2);
}

//***********************Externo*************************************************/
if($fotomecanica->acabado_impresion_4 != "17" || $fotomecanica->acabado_impresion_5 != "17" || $fotomecanica->acabado_impresion_6 != "17") {

    if ($fotomecanica->acabado_impresion_4 != "No lleva" || $fotomecanica->acabado_impresion_5 != "No lleva" || $fotomecanica->acabado_impresion_6 != "No lleva") {

        if ($fotomecanica->acabado_impresion_4 != "" || $fotomecanica->acabado_impresion_5 != "" || $fotomecanica->acabado_impresion_6 != "") {

            $externo = 50;
        } else {

            $externo = 0;
        }
    }
}
//****************************Micromicro******************************************************/
if ($ing->materialidad_datos_tecnicos == "Onda a la Vista") {
    $canTotal2 = number_format(($datos->cantidad_1 / 1000), 0, "", "");
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
    $canTotal2 = number_format(($datos->cantidad_1 / 1000), 0, "", "");
    // echo $canTotal2;exit;
    if ($canTotal2 >= 1) {
        $cartulina = 30;
    } else {
        $cartulina = 0;
    }
} else {
    $cartulina = 0;
}
//****************************Funcion Emplacado******************************************************/
$mermaEmplacadoArray = $this->variables_cotizador_model->getVariablesCotizadorPorId(35);
function calcular_emplacado($cantidad,$unidades,$ing,$mermaEmplacadoArray){
if ($ing->materialidad_datos_tecnicos == "Sólo Cartulina") {
    $emplacado = 0;
    $emplacado_fijo = 0;
    $emplacado_merma = $mermaEmplacadoArray->precio;
} else {
    
    //$mermaEmplacadoArray = $this->variables_cotizador_model->getVariablesCotizadorPorId(35);
    $emplacado = $cantidad/$unidades; /* Valor x dividido por Unidad por pliego */

    $emplacado = $emplacado / 1000; /* Resultado de emplacado dividido por 1000 */

    $emplacado = ($emplacado * 1000) + 0.5; /* Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5 */

    $emplacado = $emplacado / 1000; /* emplacado dividido por 1000 */

    $emplacado = $emplacado + 0.499; /* emplacado mas 0.499: Resultado emplacado es en decimales */
    
    $Entero = number_format($emplacado,0, "",""); /* Guardar entero del emplacado */

    $emplacado_fijo = 50; /* Multiplicar entero del emplacado por 15 */
    $emplacado = $Entero * $mermaEmplacadoArray->precio; /* Multiplicar entero del emplacado por 15 */
    $emplacado_merma = $mermaEmplacadoArray->precio;
    
//    echo "<h1>".$emplacado."</h1>";       
//    echo "<h1>".$emplacado_fijo."</h1>";        exit();
}

return array('emplacado'=>$emplacado,'emplacado_fijo'=>$emplacado_fijo,'emplacado_merma'=>$emplacado_merma);

}

//****************************Troquelado******************************************************/
$mermaTroqueladoArray = $this->variables_cotizador_model->getVariablesCotizadorPorId(36);
function calculo_troquelado($cantidad,$unidades,$fotomecanica,$mermaTroqueladoArray,$ing,$datos){
if ($fotomecanica->estan_los_moldes == "NO LLEVA" || $fotomecanica->estan_los_moldes == "CLIENTE LO APORTA" || $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina') {
    $troquelado = 0;
    $troquelado_fijo = 0;
    $troquelado_merma = $mermaTroqueladoArray->precio; 
} else {
    if (($datos->cantidad_1 > 0) && ( $ing->unidades_por_pliego > 0)){
        $troquelado = $cantidad / $ing->unidades_por_pliego;
    }else{
    $troquelado = 0;}
    $troquelado = $troquelado / 1000; /* Resultado de emplacado dividido por 1000 */
    $troquelado = ($troquelado * 1000) + 0.5; /* Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5 */
    $troquelado = $troquelado / 1000; /* emplacado dividido por 1000 */
    $troquelado = $troquelado + 0.499; /* emplacado mas 0.499: Resultado emplacado es en decimales */
    $EnteroTroquelado = number_format($troquelado, 0, '', ''); /* Guardar entero del emplacado */
    $troquelado = $EnteroTroquelado * $mermaTroqueladoArray->precio; /* Multiplicar entero del emplacado por 15 */
    $troquelado_fijo = 40;
    $troquelado_merma = $mermaTroqueladoArray->precio;
}

return array('troquelado'=>$troquelado,'troquelado_fijo'=>$troquelado_fijo,'troquelado_merma'=>$troquelado_merma);
}
//****************************Formula Molde Troquel*************************************************/
if ($fotomecanica->condicion_del_producto == 'Nuevo') { //nuevo 
    if ($fotomecanica->estan_los_moldes == 'NO') {
        $variableTroquel = $this->variables_cotizador_model->getVariablesCotizadorPorId(9);
        $moldeTroquel = $variableTroquel->precio;
    } else if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
        $moldeTroquel = 0;
    } else if ($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA') {
        $moldeTroquel = 0;
    } else if ($fotomecanica->estan_los_moldes == 'MOLDE GENERICO') {
        if ($fotomecanica->numero_molde == 11 || $fotomecanica->numero_molde == 12 || $fotomecanica->numero_molde == 13 || $fotomecanica->numero_molde == 14 || $fotomecanica->numero_molde == 15) {
            $variableTroquel = $this->variables_cotizador_model->getVariablesCotizadorPorId(9);
            $moldeTroquel = $variableTroquel->precio;
        } else {
            $moldeTroquel = 0;
        }
    }
    if($hoja->molde_troquel!="" && $hoja->molde_troquel!=""){
        $moldeTroquel = $hoja->molde_troquel;
    }
}
if ($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') { //

    if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
        $variableTroquel = $this->variables_cotizador_model->getVariablesCotizadorPorId(9);

        $moldeTroquel = 0;
    }

    }

if ($fotomecanica->condicion_del_producto == 'Repetición Con Cambios' && $fotomecanica->numero_molde <> '11' && $fotomecanica->numero_molde <> '12' && $fotomecanica->numero_molde <> '13' && $fotomecanica->numero_molde <> '14' && $fotomecanica->numero_molde <> '15') { 
    $moldeTroquel = 0;
}else{
 if($hoja->molde_troquel<>"" && $hoja->molde_troquel<>""){
        $moldeTroquel = $hoja->molde_troquel;
    }else{
 $variableTroquel = $this->variables_cotizador_model->getVariablesCotizadorPorId(9);
    $moldeTroquel = $variableTroquel->precio;   }
}
if ($fotomecanica->condicion_del_producto == 'Producto Genérico') { //
    $moldeTroquel = 0;
}
if($hoja->molde_troquel>0){$moldeTroquel=$hoja->molde_troquel;} 

//echo $fotomecanica->condicion_del_producto;
//****************************Formula Calculo Caucho*************************************************/
  $variableEmplacado = $this->variables_cotizador_model->getVariablesCotizadorPorId(39);
                     if ($fotomecanica->fot_lleva_barniz != 'Nada' && $fotomecanica->fot_lleva_barniz != '' && $fotomecanica->fot_reserva_barniz == 'Con Reserva') {
                         $otrosCaucho = $variableEmplacado->precio;
                     } else {
                         $otrosCaucho = 0;
                     }
                     if ($fotomecanica->fot_cala_caucho == 'Si') {
                         $otrosCaucho = 50000;
                     } else {
                         $otrosCaucho = 0;
                     }
                     
//****************************Formula Visto Bueno en Maquina*************************************************/
$vvm = $this->variables_cotizador_model->getVariablesCotizadorPorNombre('Visto Bueno en Maquina');
if($hoja->valor_bv_maquina == ''){ 
    if ($datos->vb_maquina=="SI"){ 
    $valor_bv_maquina=$vvm->precio; 
    }else{ 
    $valor_bv_maquina=0; 
    }}else{
    $valor_bv_maquina=$hoja->valor_bv_maquina;
    }
//****************************Formula No Acepta Excedentes*************************************************/
if($hoja->valor_acepeta_exce == '' || $hoja->valor_acepeta_exce == 0){ 
    if ($datos->acepta_excedentes=="SI"){ 
        $valor_acepeta_exce=0; 
    }else{ 
        if($hoja->valor_acepeta_exce==0 || $hoja->valor_acepeta_exce==""){
        $valor_acepeta_exce=100000; }else{
        $valor_acepeta_exce=$hoja->valor_acepeta_exce;    
        }
    }}else{
        $valor_acepeta_exce=$hoja->valor_acepeta_exce;
    }
//****************************Formula Costo monotapa x kilo*************************************************/
if ($materialidad_2->gramaje>0){
    $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
}else{ 	
      $costo_kilo=0;
}
//echo "======".$costo_kilo;
										
                                        if($materialidad_3->tipo == 14 &&  $materialidad_3->reverso == 'Blanca')//valdivia
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;
                                        }

                                        elseif($materialidad_3->tipo == 15 &&  $materialidad_3->reverso == 'Blanca')//maule
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 1 &&  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 5 &&  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 3 &&  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 4 &&  ($materialidad_3->reverso == 'Café' || $materialidad_3->reverso == 'Cafe')) // papel reverso cafe
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        else{
                                        $costo_kilo_obtenido=140;}
                                        $costo_mkilo=$costo_kilo+$costo_kilo_obtenido;
                                        //echo "<h1>" . $costo_mkilo . "</h1>";                                      
//****************************Formula Costo placa kilo*************************************************/
function costo_placa_kilo($cantidad,$unidades,$sum){
    if (($cantidad > 0) && ( $unidades > 0)){
    $costoPlacaKilo = ($cantidad / $unidades) + $sum;
    }else{
        $costoPlacaKilo = 0;
    }
    return $costoPlacaKilo;
}

//echo "-------".$ing->unidades_por_pliego;

$calcular_emplacado = calcular_emplacado($datos->cantidad_1,$ing->unidades_por_pliego, $ing,$mermaEmplacadoArray);
$calcular_emplacado2 = calcular_emplacado($datos->cantidad_2,$ing->unidades_por_pliego, $ing,$mermaEmplacadoArray);
$calcular_emplacado3 = calcular_emplacado($datos->cantidad_3,$ing->unidades_por_pliego, $ing,$mermaEmplacadoArray);
$calcular_emplacado4 = calcular_emplacado($datos->cantidad_4,$ing->unidades_por_pliego, $ing,$mermaEmplacadoArray);

$calcular_troquelado= calculo_troquelado($datos->cantidad_1,$ing->unidades_por_pliego, $fotomecanica,$mermaTroqueladoArray,$ing,$datos);
$calcular_troquelado2= calculo_troquelado($datos->cantidad_2,$ing->unidades_por_pliego, $fotomecanica,$mermaTroqueladoArray,$ing,$datos);
$calcular_troquelado3= calculo_troquelado($datos->cantidad_3,$ing->unidades_por_pliego, $fotomecanica,$mermaTroqueladoArray,$ing,$datos);
$calcular_troquelado4= calculo_troquelado($datos->cantidad_4,$ing->unidades_por_pliego, $fotomecanica,$mermaTroqueladoArray,$ing,$datos);

$variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
$valorEmplacado =($variableEmplacado->precio*$tamano1*$tamano2)/10000;

//calculo valores de colores cantidad 1,2,3,4
$colores2 = colores($fotomecanica->colores,$datos->vb_maquina,$datos->acepta_excedentes,$maquina);
//calculo valores de cant 1,2,3,4
$cantidad1 = cantidad($datos->cantidad_1,$ing->unidades_por_pliego);
$cantidad2 = cantidad($datos->cantidad_2,$ing->unidades_por_pliego);
$cantidad3 = cantidad($datos->cantidad_3,$ing->unidades_por_pliego);
$cantidad4 = cantidad($datos->cantidad_4,$ing->unidades_por_pliego);
//calculo valores de barnizz 1,2,3,4
$barnizz = barniz($fotomecanica->fot_lleva_barniz,$datos->cantidad_1,$ing->unidades_por_pliego);
$barnizz2 = barniz($fotomecanica->fot_lleva_barniz,$datos->cantidad_2,$ing->unidades_por_pliego);
$barnizz3 = barniz($fotomecanica->fot_lleva_barniz,$datos->cantidad_3,$ing->unidades_por_pliego);
$barnizz4 = barniz($fotomecanica->fot_lleva_barniz,$datos->cantidad_4,$ing->unidades_por_pliego);
//calculo valores externos de merma 1,2,3,4
$externo;
//calculo valores micromicro de merma 1,2,3,4
$micromicro;
//calculo valores cartulina de merma 1,2,3,4
$cartulina;
//calculo valores emplacado de merma 1,2,3,4
$emplacado = $calcular_emplacado['emplacado'];
$emplacado2 = $calcular_emplacado2['emplacado'];
$emplacado3 = $calcular_emplacado3['emplacado'];
$emplacado4 = $calcular_emplacado4['emplacado'];

//calculo valores troquelado de merma 1,2,3,4
$troquelado = $calcular_troquelado['troquelado'];
$troquelado2 = $calcular_troquelado2['troquelado'];
$troquelado3 = $calcular_troquelado3['troquelado'];
$troquelado4 = $calcular_troquelado4['troquelado'];

//calculo valores emplacado_fijo de merma 1,2,3,4
$emplacado_fijo = $calcular_emplacado['emplacado_fijo'];
$emplacado_fijo2 = $calcular_emplacado2['emplacado_fijo'];
$emplacado_fijo3 = $calcular_emplacado3['emplacado_fijo'];
$emplacado_fijo4 = $calcular_emplacado4['emplacado_fijo'];

//calculo valores troquelado_fijo de merma 1,2,3,4
$troquelado_fijo = $calcular_troquelado['troquelado_fijo'];;
$troquelado_fijo2 = $calcular_troquelado2['troquelado_fijo'];;
$troquelado_fijo3 = $calcular_troquelado3['troquelado_fijo'];;
$troquelado_fijo4 = $calcular_troquelado4['troquelado_fijo'];;

//cantidad totales de mermas
$sum=$colores2[0]+$colores2[1]+$cantidad1[0]+$barnizz[0]+$barnizz[1]+$externo+$micromicro+$cartulina+$emplacado+$troquelado+$emplacado_fijo+$troquelado_fijo;
$sum2=$colores2[0]+$colores2[1]+$cantidad2[0]+$barnizz2[0]+$barnizz2[1]+$externo+$micromicro+$cartulina+$emplacado2+$troquelado2+$emplacado_fijo2+$troquelado_fijo2;
$sum3=$colores2[0]+$colores2[1]+$cantidad3[0]+$barnizz3[0]+$barnizz3[1]+$externo+$micromicro+$cartulina+$emplacado3+$troquelado3+$emplacado_fijo3+$troquelado_fijo3;
$sum4=$colores2[0]+$colores2[1]+$cantidad4[0]+$barnizz4[0]+$barnizz4[1]+$externo+$micromicro+$cartulina+$emplacado4+$troquelado4+$emplacado_fijo4+$troquelado_fijo4;

//informacion especial
if(sizeof($hoja)>0){
if($hoja->impreso==1){
    $estatus = 1;
    $mensaje_estatus = "Esta hoja de costos no puede ser modificada debido a que ya fue liberada y los cambios "
            . "que se realicen sobre la misma, solo seran de forma provisional para simular otros valores en el calculo.";
    $mensaje_fecha = "Grabada el ".fecha($hoja->fecha);
    $franja = "#4db562";
}else{
    $estatus = 0;
    $mensaje_estatus = "Hoja guardada, esperando para ser modificada o liberada.";
    $mensaje_fecha = "Grabada el ".fecha($hoja->fecha);
    $franja = "#428bca";
}}else{
    $estatus = 2;
    $mensaje_estatus = "Hoja sin ninguna modificacion, esperando para ser guardada.";
    $mensaje_fecha = "Cotizacion creada el ".fecha($datos->fecha);
    $franja = "grey";
}
//echo "<h1>c1" . $colores2[0] . "</h1>";
//echo "<h1>c2" . $colores2[1] . "</h1>";
//echo "<h1>ca" . $cantidad1[0] . "</h1>";
//echo "<h1>ba" . $barnizz[0] . "</h1>";
//echo "<h1>ba" . $barnizz[1] . "</h1>";
//echo "<h1>ex" . $externo . "</h1>";
//echo "<h1>mi" . $micromicro . "</h1>";
//echo "<h1>ca" . $cartulina . "</h1>";
//echo "<h1>em" . $emplacado . "</h1>";
//echo "<h1>tr" . $troquelado . "</h1>";
//echo "<h1>ef" . $emplacado_fijo . "</h1>";
//echo "<h1>tf" . $troquelado_fijo . "</h1>";
//echo "<h1>" . $sum . "</h1>";
//echo "<h1>-----qqqqqqqqq--------</h1>";

//calculos para costo placa kilo
$costoPlacaKilo = costo_placa_kilo($datos->cantidad_1, $ing->unidades_por_pliego, $sum);
$costoPlacaKilo2 = costo_placa_kilo($datos->cantidad_2, $ing->unidades_por_pliego, $sum2);
$costoPlacaKilo3 = costo_placa_kilo($datos->cantidad_3, $ing->unidades_por_pliego, $sum3);
$costoPlacaKilo4 = costo_placa_kilo($datos->cantidad_4, $ing->unidades_por_pliego, $sum4);

$variableCostoPlacaKilo=$costoPlacaKilo;
$variableCostoPlacaKilo2=$costoPlacaKilo2;
$variableCostoPlacaKilo3=$costoPlacaKilo3;
$variableCostoPlacaKilo4=$costoPlacaKilo4;

$tapaGramaje=$materialidad_1->gramaje;
$tapaPrecio=$materialidad_1->precio;
//*****************formula valor placa kilo******************************
$valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
$valorPlacaKilo2=($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje)/10000000;
$valorPlacaKilo3=($costoPlacaKilo3*$tamano1*$tamano2*$tapaGramaje)/10000000;
$valorPlacaKilo4=($costoPlacaKilo4*$tamano1*$tamano2*$tapaGramaje)/10000000;
//*****************formula total placa kilo******************************
$totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
$totalPlacaKilo2=$valorPlacaKilo2*$tapaPrecio;
$totalPlacaKilo3=$valorPlacaKilo3*$tapaPrecio;
$totalPlacaKilo4=$valorPlacaKilo4*$tapaPrecio;
/*****************formula corte 7%***********************************/
$corte = $totalPlacaKilo*7/100;
$corte2 = $totalPlacaKilo2*7/100;
$corte3 = $totalPlacaKilo3*7/100;
$corte4 = $totalPlacaKilo4*7/100;
/**************Formula Calculo Onda Kilo y placa kilo**************************************/
if ($materialidad_2->gramaje > 0){
    $GramosMetroCuadrado = $materialidad_2->gramaje + ($materialidad_2->gramaje * ($variable_cotizador->precio / 100)) + $materialidad_3->gramaje;
}else{
    $GramosMetroCuadrado = 0;
}
$recargoGramosDeAlmidon = $this->variables_cotizador_model->getVariablesCotizadorPorId(30);
$GramosMetroCuadrado = $GramosMetroCuadrado + $recargoGramosDeAlmidon->precio;

if ($materialidad_2->gramaje > 0){
    $costo_kilo = ((($materialidad_2->gramaje * ($materialidad_2->precio / 1000) + (($materialidad_2->gramaje * ($variable_cotizador->precio / 100) * $materialidad_2->precio / 1000)) + $materialidad_3->gramaje * $materialidad_3->precio / 1000) / ($materialidad_2->gramaje + ($materialidad_2->gramaje * ($variable_cotizador->precio / 100)) + $materialidad_3->gramaje))) * 1000;
}else{
    $costo_kilo = 0;
}
$tapaGramaje3=$materialidad_3->gramaje;
//echo "-------------".$costo_kilo;
function calculo_onda_kilo($cantidad,$unidades,$materialidad,$GramosMetroCuadrado,$tamano1,$tamano2,$emplacado,$troquelado,$maquina,$costo_kilo){
if ($maquina == "Máquina Roland 800") {
    if (($cantidad > 0) && ( $unidades > 0)){
        $costoOndaKilo = ((($cantidad / $unidades) * 1.04) + 100) + 4;
    }else{
        $costoOndaKilo = 0;
    }
}else{
    if (($cantidad > 0) && ( $unidades > 0)){
        $costoOndaKilo = ((($cantidad / $unidades) * 1.04) + 100) + 4;
    }else{
        $costoOndaKilo = 0;
    }
}
//echo "-------------".$costoOndaKilo;
if ($materialidad == 'Sólo Cartulina') {
    $costoOndaKilo = 0;
    $valorOndaKilo = 0;
    $totalOndaKilo = 0;
    $valorCorte = 0;
} else {
    $valorOndaKilo = ($costoOndaKilo * $tamano1 * $tamano2 * $GramosMetroCuadrado) / 10000000;
    $totalOndaKilo = $valorOndaKilo * $costo_kilo;
    $valorCorte=$costoOndaKilo*4.5;
    //echo "---------------".$valorOndaKilo."-----".$costo_kilo;
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
//echo "--------------".$totalOndaKilo;
return array('costoOndaKilo'=>$costoOndaKilo,'valorOndaKilo'=>$valorOndaKilo,'totalOndaKilo'=>$totalOndaKilo,'valorCorte'=>$valorCorte);
}

function calculo_placa_kilo($cantidad,$unidades,$materialidad,$colores,$tapaGramaje3,$onda,$tamano1,$tamano2,$tapaPrecio3,$variableCostoPlacaKilo){
if ($materialidad == 'Cartulina-cartulina') {
    $costoPlacaKilo2 = ($cantidad / $unidades);
    $cuatro_por_ciento = ($costoPlacaKilo2 / 100) * 4;

    if ($cuatro_por_ciento >= 1 && $cuatro_por_ciento <= 100) {
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
    $nombre_tapa_u_onda="Total Kilos Liner (Respaldo):";
    $totalMerma = $totalPlacaKilo2;
    if($variableCostoPlacaKilo<$costoPlacaKilo2){
        $costoPlacaKilo2 = $variableCostoPlacaKilo;
    }
    return array($nombre_tapa_u_onda,$costoPlacaKilo2,$valorPlacaKilo2,$totalPlacaKilo2,$totalMerma);
} else {
    $nombre_tapa_u_onda="Total Kilos Onda:";
    $valorOndaKilo=$onda['valorOndaKilo'];
    $costoOndaKilo=$onda['costoOndaKilo'];
    $totalOndaKilo=$onda['totalOndaKilo'];
    $totalMerma = $onda['totalOndaKilo'];
    if($variableCostoPlacaKilo<$costoOndaKilo){
        $costoOndaKilo = $variableCostoPlacaKilo;
    }
    return array($nombre_tapa_u_onda,$costoOndaKilo,$valorOndaKilo,$totalOndaKilo,$totalMerma);
}
}

//**************************Formula para el barniz**********************************//
if (($fotomecanica->fot_lleva_barniz == 'Nada') || ($fotomecanica->fot_lleva_barniz == '')) {
    $barniz = 0;
    $tbarniz = $fotomecanica->fot_lleva_barniz;
    
} else {
    $barniz = 1;
    $tbarniz = $fotomecanica->fot_lleva_barniz;
}

//**************************Formula para el montaje molde**********************************//
if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
    $variableMontajeMoldeTroquel = 0;
    $totalMontajeMolde = 0;
} else {
    $variableRecargoMontaje = $this->variables_cotizador_model->getVariablesCotizadorPorId(31);
    $variableMontajeMoldeTroquel = $this->variables_cotizador_model->getVariablesCotizadorPorId(10);
    $totalMontajeMolde = $variableMontajeMoldeTroquel->precio * 1.5;
}
//**************************Calculos para la pre impresion**********************************//
$arte=$this->variables_cotizador_model->getVariablesCotizadorPorId(1);
$plancha_metal=$this->variables_cotizador_model->getVariablesCotizadorPorId(2);
$copiado=$this->variables_cotizador_model->getVariablesCotizadorPorId(3);
$peliculasPreImpresion = $this->variables_cotizador_model->getVariablesCotizadorPorId(4);
$peliculasVariable = $this->variables_cotizador_model->getVariablesCotizadorPorId(28);
$cantidadPeliculas = $ing->tamano_a_imprimir_1 * $ing->tamano_a_imprimir_2 * $fotomecanica->colores * $peliculasVariable->precio;
$montajePreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(5);
 if($fotomecanica->condicion_del_producto == 'Repetición Con Cambios') //
 { $cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->numero_color_modificado;}else{
   $cantidadMontaje=0;  
 }
$cromalinVariable = $this->variables_cotizador_model->getVariablesCotizadorPorId(22);
$variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);

if ($maquina == "Máquina Roland 800") {
    $recargoPlanchaArray = $this->variables_cotizador_model->getVariablesCotizadorPorId(26);
    $recargoPlancha = $recargoPlanchaArray->precio;
    $valorParaPlanchaMetal = 1;
}else{
    $recargoPlanchaArray = $this->variables_cotizador_model->getVariablesCotizadorPorId(26);
    $recargoPlancha = $recargoPlanchaArray->precio;
    $valorParaPlanchaMetal = 1;
}


$cantidadCopiado=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz))+(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz))*$recargoPlancha/100*$valorParaPlanchaMetal;

//variables cromalin
if ($datos->impresion_hacer_cromalin == 'SI') {
    if($fotomecanica->colores >= 4){
    $cromalin = $cromalinVariable->precio;
    $coloresCromalin = 1;
    }else{
         $cromalin = 0;
    $coloresCromalin = 0;
    }
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
    $arte=$this->variables_cotizador_model->getVariablesCotizadorPorId(1);
    $cantidadArte=$fotomecanica->colores*$arte->precio;
    
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
//    echo $barniz;
//    echo $fotomecanica->colores;
//    exit();
    $coloresArte = 0;
    $coloresPlanchaMetal = $fotomecanica->colores + $barniz;
    $coloresCopiado = $fotomecanica->colores;
    $coloresPeliculas = $barniz + $fotomecanica->numero_color_modificado;
    $coloresMontaje = $fotomecanica->numero_color_modificado;
    $cantidadArte = 0;
    if($fotomecanica->numero_color_modificado=="" || $fotomecanica->numero_color_modificado==0){
        $cantidadPeliculas = $ing->tamano_a_imprimir_1 * $ing->tamano_a_imprimir_2 * $fotomecanica->colores * $peliculasVariable->precio;
    }else{
        $cantidadPeliculas = $ing->tamano_a_imprimir_1 * $ing->tamano_a_imprimir_2 * $fotomecanica->numero_color_modificado * $peliculasVariable->precio;
    }
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
if($fotomecanica->condicion_del_producto=='Repetición Con Cambios'){   
$montajePI= $montajePreImpresion->precio;
$cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->numero_color_modificado;
}else{   
$montajePI= $montajePreImpresion->precio;
$cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->colores;
}

}

//$cantidadArte=$fotomecanica->colores*$arte->precio;
$onda = calculo_onda_kilo($datos->cantidad_1,$ing->unidades_por_pliego,$fotomecanica->materialidad_datos_tecnicos,$GramosMetroCuadrado,$tamano1,$tamano2,$emplacado,$troquelado,$maquina,$costo_mkilo);
$onda2 = calculo_onda_kilo($datos->cantidad_2,$ing->unidades_por_pliego,$fotomecanica->materialidad_datos_tecnicos,$GramosMetroCuadrado,$tamano1,$tamano2,$emplacado,$troquelado,$maquina,$costo_mkilo);
$onda3 = calculo_onda_kilo($datos->cantidad_3,$ing->unidades_por_pliego,$fotomecanica->materialidad_datos_tecnicos,$GramosMetroCuadrado,$tamano1,$tamano2,$emplacado,$troquelado,$maquina,$costo_mkilo);
$onda4 = calculo_onda_kilo($datos->cantidad_4,$ing->unidades_por_pliego,$fotomecanica->materialidad_datos_tecnicos,$GramosMetroCuadrado,$tamano1,$tamano2,$emplacado,$troquelado,$maquina,$costo_mkilo);


$placa = calculo_placa_kilo($datos->cantidad_1,$unidad_pliego,$materialidad,$colores,$tapaGramaje3,$onda,$tamano1,$tamano2,$tapaPrecio3,$variableCostoPlacaKilo);
$placa2 = calculo_placa_kilo($datos->cantidad_2,$unidad_pliego,$materialidad,$colores,$tapaGramaje3,$onda2,$tamano1,$tamano2,$tapaPrecio3,$variableCostoPlacaKilo2);
$placa3 = calculo_placa_kilo($datos->cantidad_3,$unidad_pliego,$materialidad,$colores,$tapaGramaje3,$onda3,$tamano1,$tamano2,$tapaPrecio3,$variableCostoPlacaKilo3);
$placa4 = calculo_placa_kilo($datos->cantidad_4,$unidad_pliego,$materialidad,$colores,$tapaGramaje3,$onda4,$tamano1,$tamano2,$tapaPrecio3,$variableCostoPlacaKilo4);
//print_r($placa);exit();
$totalMateriaPrima = $totalPlacaKilo + $corte + $placa[4] + (($placa[4]*10)/100);
$totalMateriaPrima2 = $totalPlacaKilo2 + $corte2 + $placa2[4] + (($placa2[4]*10)/100);
$totalMateriaPrima3 = $totalPlacaKilo3 + $corte3 + $placa3[4] + (($placa3[4]*10)/100);
$totalMateriaPrima4 = $totalPlacaKilo4 + $corte4 + $placa4[4] + (($placa4[4]*10)/100);

$cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz))+((($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz)))*$recargoPlancha/100*$valorParaPlanchaMetal;

//total emplacado 1
if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina'){
$totalEmplacado = 0;                        
}else{
$totalEmplacado = $valorEmplacado*$placa[1];
}
//total emplacado 2
if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina'){
$totalEmplacado2 = 0;                        
}else{
$totalEmplacado2 = $valorEmplacado*$placa2[1];
}
//total emplacado 3
if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina'){
$totalEmplacado3 = 0;                        
}else{
$totalEmplacado3 = $valorEmplacado*$placa3[1];
}
//total emplacado 4
if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina'){
$totalEmplacado4 = 0;                        
}else{
$totalEmplacado4 = $valorEmplacado*$placa4[1];
}

//total troquelado 1
if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
    $variableTroquelado = $this->variables_cotizador_model->getVariablesCotizadorPorId(11);
    $totalTroquelado = 0;
} else {
    $variableTroquelado = $this->variables_cotizador_model->getVariablesCotizadorPorId(11);
    $totalTroquelado = ($placa[1] * $variableTroquelado->precio) * 1.5;
}
//total troquelado 2
if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
    $variableTroquelado = $this->variables_cotizador_model->getVariablesCotizadorPorId(11);
    $totalTroquelado2 = 0;
} else {
    $variableTroquelado = $this->variables_cotizador_model->getVariablesCotizadorPorId(11);
    $totalTroquelado2 = ($placa2[1] * $variableTroquelado->precio) * 1.5;
}
//total troquelado 3
if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
    $variableTroquelado = $this->variables_cotizador_model->getVariablesCotizadorPorId(11);
    $totalTroquelado3 = 0;
} else {
    $variableTroquelado = $this->variables_cotizador_model->getVariablesCotizadorPorId(11);
    $totalTroquelado3 = ($placa3[1] * $variableTroquelado->precio) * 1.5;
}
//total troquelado 4
if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
    $variableTroquelado = $this->variables_cotizador_model->getVariablesCotizadorPorId(11);
    $totalTroquelado4 = 0;
} else {
    $variableTroquelado = $this->variables_cotizador_model->getVariablesCotizadorPorId(11);
    $totalTroquelado4 = ($placa4[1] * $variableTroquelado->precio) * 1.5;
}

//total desgajado
$variableDesgajado = $this->variables_cotizador_model->getVariablesCotizadorPorId(12);
if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
    $totalDesgajado = 0;
} else {
    $totalDesgajado = $ing->piezas_totales_en_el_pliego * $variableDesgajado->precio * 1.5 * $placa[1];
}
//total desgajado
//$variableDesgajado = $this->variables_cotizador_model->getVariablesCotizadorPorId(12);
if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
    $totalDesgajado2 = 0;
} else {
    $totalDesgajado2 = $ing->piezas_totales_en_el_pliego * $variableDesgajado->precio * 1.5 * $placa2[1];
}
//total desgajado
//$variableDesgajado = $this->variables_cotizador_model->getVariablesCotizadorPorId(12);
if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
    $totalDesgajado3 = 0;
} else {
    $totalDesgajado3 = $ing->piezas_totales_en_el_pliego * $variableDesgajado->precio * 1.5 * $placa3[1];
}
//total desgajado
//$variableDesgajado = $this->variables_cotizador_model->getVariablesCotizadorPorId(12);
if ($fotomecanica->estan_los_moldes == 'NO LLEVA') {
    $totalDesgajado4 = 0;
} else {
    $totalDesgajado4 = $ing->piezas_totales_en_el_pliego * $variableDesgajado->precio * 1.5 * $placa4[1];
}
//echo $variablePegado->precio; exit();
//formula calculo del pegado
function calculo_pegado($datos,$presupuesto,$cantidad,$variablePegado,$hoja){
     if(sizeof($hoja)==0) { 
       if ($datos->pegado_migrado == null || $datos->pegado_migrado == '' || $datos->pegado_migrado == 0) {
                $pegado_migrado = 8;
        } else {
            $pegado_migrado = $datos->pegado_migrado;
        }
    } else {
        if($hoja->pegado=="" || $hoja->pegado=="0" || $hoja->pegado==null ){    
        $pegado_migrado = 8;
        }else{    
        $pegado_migrado = $hoja->pegado;
        }
    }
    $totalPegado = $cantidad * $pegado_migrado * $variablePegado->precio;
    
    if($totalPegado>150000 && $totalPegado<=235000){
        $totalPegado = 150000; 
     }else{
        if($totalPegado<150000){
            $totalPegado = $totalPegado; 
        }else{
            if($totalPegado >235000){
               $totalPegado=$cantidad*$pegado_migrado*1.45;
            }
        }
    }
    
    
    return array('pegado_migrado'=>$pegado_migrado,'totalPegado'=>$totalPegado);
}
$pegado1 = calculo_pegado($datos,$presupuesto,$datos->cantidad_1,$variablePegado,$hoja);
$pegado2 = calculo_pegado($datos,$presupuesto,$datos->cantidad_2,$variablePegado,$hoja);
$pegado3 = calculo_pegado($datos,$presupuesto,$datos->cantidad_3,$variablePegado,$hoja);
$pegado4 = calculo_pegado($datos,$presupuesto,$datos->cantidad_4,$variablePegado,$hoja);

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
    if (($cantidad > 0) && ( $unidades > 0)) {
        $tiraje = $cantidad / $unidades;
    } else {
        $tiraje = 0;
    }

    if ($tiraje < 4000) {
    $tiraje2 = "Menos de 4.000";
    $factor_rango = $factor_rangos1->precio;
} elseif ($tiraje > 4000 && $tiraje < 10000) {
    $tiraje2 = "4.001 a 10.000";
    $factor_rango = $factor_rangos2->precio;
} else {
    $tiraje2 = "Más de 10.000";
    $factor_rango = $factor_rangos3->precio;
}

return $factor_rango;
}
$factor_rango = factor_rango($datos->cantidad_1, $ing->unidades_por_pliego,$factor_rangos1,$factor_rangos2,$factor_rangos3,$fotomecanica);
$factor_rango2 = factor_rango($datos->cantidad_2, $ing->unidades_por_pliego,$factor_rangos1,$factor_rangos2,$factor_rangos3,$fotomecanica);
$factor_rango3 = factor_rango($datos->cantidad_3, $ing->unidades_por_pliego,$factor_rangos1,$factor_rangos2,$factor_rangos3,$fotomecanica);
$factor_rango4 = factor_rango($datos->cantidad_4, $ing->unidades_por_pliego,$factor_rangos1,$factor_rangos2,$factor_rangos3,$fotomecanica);

//*************formula para el tiraje*************************
$recargo800Array = $this->variables_cotizador_model->getVariablesCotizadorPorId(34);
$base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
function tiraje($cantidad,$unidades,$sum,$recargo800Array,$barniz,$base_imprenta,$factor_rango,$fotomecanica,$maquina,$hojaTiraje){
if ($maquina == "Máquina Roland 800") {
     $tira1 = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio ) * ($fotomecanica->colores + $barniz);
     $tira2 = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio) * ($fotomecanica->colores + $barniz) * (1 * $recargo800Array->precio / 100);
     if($hojaTiraje=="" || $hojaTiraje==0){
     $tiraje = $tira1 + $tira2;   }else{
         $tiraje = $hojaTiraje;
     }
} else {
    //$tiraje = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio ) * ($fotomecanica->colores + $barniz);
     $tira1 = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio ) * ($fotomecanica->colores + $barniz);
     $tira2 = ((($cantidad / $unidades) + $sum) * $factor_rango + $base_imprenta->precio) * ($fotomecanica->colores + $barniz) * (1 * $recargo800Array->precio / 100);
      if($hoja->tiraje1=="" || $hoja->tiraje1==0){
     $tiraje = $tira1 + $tira2;   }else{
         $tiraje = $hoja->tiraje1;
     }
     //$tiraje = $tira1 + $tira2;   
}


//echo "<h1>" . $cantidad. "</h1>";
//echo "<h1>" . $unidades . "</h1>";
//echo "<h1>" . $fotomecanica->colores. "</h1>";
//echo "<h1>" . $base_imprenta->precio. "</h1>";
//echo "<h1>" . $factor_rango . "</h1>";
//echo "<h1>" . $sum . "</h1>";
//echo "<h1>" . $recargo800Array->precio . "</h1>";
//echo "<h1>" . $tira1 . "</h1>";
//echo "<h1>" . $tira2 . "</h1>";                                         
//exit();
return $tiraje;
}

$tiraje = tiraje($datos->cantidad_1, $ing->unidades_por_pliego, $sum, $recargo800Array, $barniz, $base_imprenta,$factor_rango,$fotomecanica,$maquina,$hoja->tiraje1);
$tiraje2 = tiraje($datos->cantidad_2, $ing->unidades_por_pliego, $sum2, $recargo800Array, $barniz, $base_imprenta,$factor_rango2,$fotomecanica,$maquina,$hoja->tiraje2);
$tiraje3 = tiraje($datos->cantidad_3, $ing->unidades_por_pliego, $sum3, $recargo800Array, $barniz, $base_imprenta,$factor_rango3,$fotomecanica,$maquina,$hoja->tiraje3);
$tiraje4 = tiraje($datos->cantidad_4, $ing->unidades_por_pliego, $sum4, $recargo800Array, $barniz, $base_imprenta,$factor_rango4,$fotomecanica,$maquina,$hoja->tiraje4);

/*
echo "--------------------".$datos->cantidad_1."<br>";
echo "--------------------".$ing->unidades_por_pliego."<br>";
echo "--------------------".$sum."<br>";
echo "--------------------".$recargo800Array->precio."<br>";
echo "--------------------".$barniz."<br>";
echo "--------------------".$base_imprenta->precio."<br>";
echo "--------------------".$factor_rango."<br>";
echo "--------------------".$fotomecanica->colores."<br>";
*/
//echo "--------------------".$totalEmplacado."<br>";
//*********************Formula para el despacho******************************//
$mdt=$ing->materialidad_datos_tecnicos;
$retiro=$datos->retira_cliente;
$fuerasantiago=$datos->despacho_fuera_de_santiago;
$distancia=$datos->distancia;

function calcularDespacho($uno, $dos, $retiro, $materialidad, $fuerasantiago, $distancia) {
    switch ($distancia) {
        case 1:
            $monto=15000;
            break;
        case 2:
            $monto=24000;
            break;
        case 3:
            $monto=30000;
            break;
        case 4:
            $monto=45000;
            break;

        default:
            break;
    }
    
    if ($materialidad == 'Microcorrugado' || $materialidad == 'Corrugado') {
        $palets = round(($uno + $dos) / 250);
        if ($palets < 5) {
            $palets = 5;
        }
        if ($retiro == 'SI') {
            $costodespacho = $palets * 1500;
        } else {
            $costodespacho = $palets * 7500;
        }
    } else {
        if ($materialidad == 'Cartulina-cartulina' || $materialidad == 'Sólo Cartulina') {
            $palets = round(($uno + $dos) / 500);
            if ($palets < 5) {
                $palets = 5;
            }
            if ($retiro == 'SI') {
                $costodespacho = $palets * 1500;
            } else {
                $costodespacho = $palets * 7500;
            }
        }
    }
    
    if($fuerasantiago=='SI'){
        $complemento= $palets*$monto;
    }else{
        $complemento= 0;
    }
    
    $costodespacho=$costodespacho+$complemento;
    return array($costodespacho, $palets);
}

if($mdt=='Cartulina-cartulina' || $mdt=='Sólo Cartulina'){
    $des = calcularDespacho($valorPlacaKilo, $placa[2], $retiro, $mdt, $fuerasantiago, $distancia);  
}else{
    $des = calcularDespacho($valorPlacaKilo, $placa[2], $retiro, $mdt, $fuerasantiago, $distancia);
}

if($mdt=='Cartulina-cartulina' || $mdt=='Sólo Cartulina'){
    $des2 = calcularDespacho($valorPlacaKilo2, $placa2[2], $retiro, $mdt, $fuerasantiago, $distancia);  
}else{
    $des2 = calcularDespacho($valorPlacaKilo2, $placa2[2], $retiro, $mdt, $fuerasantiago, $distancia);
}

if($mdt=='Cartulina-cartulina' || $mdt=='Sólo Cartulina'){
    $des3 = calcularDespacho($valorPlacaKilo3, $placa3[2], $retiro, $mdt, $fuerasantiago, $distancia);  
}else{
    $des3 = calcularDespacho($valorPlacaKilo3, $placa3[2], $retiro, $mdt, $fuerasantiago, $distancia);
}

if($mdt=='Cartulina-cartulina' || $mdt=='Sólo Cartulina'){
    $des4 = calcularDespacho($valorPlacaKilo4, $placa4[2], $retiro, $mdt, $fuerasantiago, $distancia);  
}else{
    $des4 = calcularDespacho($valorPlacaKilo4, $placa4[2], $retiro, $mdt, $fuerasantiago, $distancia);
}


//*********************Formula para el complemento******************************//
$variableComplemento = $this->variables_cotizador_model->getVariablesCotizadorPorId(32);

$valorTiraje = $variableComplemento->precio - $tiraje;
$valorTiraje2 = $variableComplemento->precio - $tiraje2;
$valorTiraje3 = $variableComplemento->precio - $tiraje3;
$valorTiraje4 = $variableComplemento->precio - $tiraje4;

$variableComplemento->precio;

$tiraje;
if ($valorTiraje > 0) {
    if ($fotomecanica->colores == 0) {
        $complemento = 0;
    } else {
        $complemento = $valorTiraje;
    }
} else {
    $complemento = 0;
}

$tiraje2;
if ($valorTiraje2 > 0) {
    if ($fotomecanica->colores == 0) {
        $complemento2 = 0;
    } else {
        $complemento2 = $valorTiraje2;
    }
} else {
    $complemento2 = 0;
}

$tiraje3;
if ($valorTiraje3 > 0) {
    if ($fotomecanica->colores == 0) {
        $complemento3 = 0;
    } else {
        $complemento3 = $valorTiraje3;
    }
} else {
    $complemento3 = 0;
}

$tiraje4;
if ($valorTiraje4 > 0) {
    if ($fotomecanica->colores == 0) {
        $complemento4 = 0;
    } else {
        $complemento4 = $valorTiraje4;
    }
} else {
    $complemento4 = 0;
}
//*******************************************************************************//

//*********************Formula costos por lacado******************************//
 function lacado($fotomecanica,$cantidad,$unidades){
     if($fotomecanica->fot_lleva_barniz=='Laca UV'){
        $costosporlacado=(35000+(52*($cantidad/$unidades)));
        }else{
        $costosporlacado=0;
        }
 return $costosporlacado;
 }
$lacado1 = lacado($fotomecanica,$datos->cantidad_1,$ing->unidades_por_pliego);
$lacado2 = lacado($fotomecanica,$datos->cantidad_2,$ing->unidades_por_pliego);
$lacado3 = lacado($fotomecanica,$datos->cantidad_3,$ing->unidades_por_pliego);
$lacado4 = lacado($fotomecanica,$datos->cantidad_4,$ing->unidades_por_pliego);
//***************************Calculo Pegado 1****************************//
if ($pegado1['totalPegado'] > 150000 && $pegado1['totalPegado'] <= 235000) {
    $pegado_1v = 150000;
} else {
    if ($pegado1['totalPegado'] < 150000) {
        $pegado_1v = $pegado1['totalPegado'];
    } else {
        if ($pegado1['totalPegado'] > 235000) {
            $pegado1['totalPegado'] = $datos->cantidad_1 * $pegado1['pegado_migrado'] * 1.45;
            $pegado_1v = $datos->cantidad_1 * $pegado1['pegado_migrado'] * 1.45;

        }
    }
}
//***************************Calculo Pegado 2****************************//
if ($pegado2['totalPegado'] > 150000 && $pegado2['totalPegado'] <= 235000) {
    $pegado_2v = 150000;
} else {
    if ($pegado2['totalPegado'] < 150000) {
        $pegado_2v = $pegado2['totalPegado'];
    } else {
        if ($pegado2['totalPegado'] > 235000) {
            $pegado2['totalPegado'] = $datos->cantidad_2 * $pegado2['pegado_migrado'] * 1.45;
            $pegado_2v = $datos->cantidad_2 * $pegado2['pegado_migrado'] * 1.45;
        }
    }
}
//***************************Calculo Pegado 3****************************//
if ($pegado3['totalPegado'] > 150000 && $pegado3['totalPegado'] <= 235000) {
    $pegado_3v = 150000;
} else {
    if ($pegado3['totalPegado'] < 150000) {
        $pegado_3v = $pegado3['totalPegado'];
    } else {
        if ($pegado3['totalPegado'] > 235000) {
            $pegado3['totalPegado'] = $datos->cantidad_3 * $pegado3['pegado_migrado'] * 1.45;
            $pegado_3v = $datos->cantidad_3 * $pegado3['pegado_migrado'] * 1.45;
        }
    }
}
//***************************Calculo Pegado 4****************************//
if ($pegado4['totalPegado'] > 150000 && $pegado4['totalPegado'] <= 235000) {
    $pegado_4v = 150000;
} else {
    if ($pegado4['totalPegado'] < 150000) {
        $pegado_4v = $pegado4['totalPegado'];
    } else {
        if ($pegado4['totalPegado'] > 235000) {
            $pegado4['totalPegado'] = $datos->cantidad_4 * $pegado4['pegado_migrado'] * 1.45;
            $pegado_4v = $datos->cantidad_4 * $pegado4['pegado_migrado'] * 1.45;
        }
    }
}

$externos_produccion = $externos_produccion_ac1 + $externos_produccion_p1;
$externos_produccion2 = $externos_produccion_ac2 + $externos_produccion_p2;
$externos_produccion3 = $externos_produccion_ac3 + $externos_produccion_p3;
$externos_produccion4 = $externos_produccion_ac4 + $externos_produccion_p4;
//echo $pegado_1;
//exit();
//******************************Total Produccion Cantidad 1**********************//
//$totalProduccion=$lacado1+$complemento+$onda['valorCorte']+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$pegado_1v+$des[0]+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
$totalProduccion=$lacado1+$complemento+$onda['valorCorte']+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$pegado1['totalPegado']+$des[0]+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
//******************************Total Produccion Cantidad 2**********************//
$totalProduccion2=$lacado2+$complemento2+$onda2['valorCorte']+$totalEmplacado2+$totalMontajeMolde+$totalTroquelado2+$pegado2['totalPegado']+$des2[0]+$tiraje2+$moldeTroquel+$totalDesgajado2+$externos_produccion2+$otrosCaucho + $TotalPiezasAdicionales2 + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
//******************************Total Produccion Cantidad 2**********************//
$totalProduccion3=$lacado3+$complemento3+$onda3['valorCorte']+$totalEmplacado3+$totalMontajeMolde+$totalTroquelado3+$pegado3['totalPegado']+$des3[0]+$tiraje3+$moldeTroquel+$totalDesgajado3+$externos_produccion3+$otrosCaucho + $TotalPiezasAdicionales3 + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
//******************************Total Produccion Cantidad 2**********************//
$totalProduccion4=$lacado4+$complemento4+$onda4['valorCorte']+$totalEmplacado4+$totalMontajeMolde+$totalTroquelado4+$pegado4['totalPegado']+$des4[0]+$tiraje4+$moldeTroquel+$totalDesgajado4+$externos_produccion4+$otrosCaucho + $TotalPiezasAdicionales4 + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
//******************************Total costo venta valor1**********************//
if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
{
$costoVentaValor1=(($totalProduccion+$totalMateriaPrima+$totalPreImpresion)*0.17)/2;
}else{
//$costoVentaValor1=(($corte+(($placa[4]*10)/100)+$onda['valorCorte']+$costoPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;    
$costoVentaValor1=(($totalProduccion+$totalMateriaPrima+$totalPreImpresion)*0.17)/2;
}
//******************************Total costo venta valor2**********************//
if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
{
$costoVentaValor2=(($totalProduccion2+$totalMateriaPrima2+$totalPreImpresion)*0.17)/2;
}else{
//$costoVentaValor1=(($corte+(($placa[4]*10)/100)+$onda['valorCorte']+$costoPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;    
$costoVentaValor2=(($totalProduccion2+$totalMateriaPrima2+$totalPreImpresion)*0.17)/2;
}
//******************************Total costo venta valor3**********************//
if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
{
$costoVentaValor3=(($totalProduccion3+$totalMateriaPrima3+$totalPreImpresion)*0.17)/2;
}else{
//$costoVentaValor1=(($corte+(($placa[4]*10)/100)+$onda['valorCorte']+$costoPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;    
$costoVentaValor3=(($totalProduccion3+$totalMateriaPrima3+$totalPreImpresion)*0.17)/2;
}
//******************************Total costo venta valor4**********************//
if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
{
$costoVentaValor4=(($totalProduccion4+$totalMateriaPrima4+$totalPreImpresion)*0.17)/2;
}else{
//$costoVentaValor1=(($corte+(($placa[4]*10)/100)+$onda['valorCorte']+$costoPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;    
$costoVentaValor4=(($totalProduccion4+$totalMateriaPrima4+$totalPreImpresion)*0.17)/2;
}

if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
{
$costoAdministracion1=(($totalProduccion+$totalMateriaPrima+$totalPreImpresion)*0.17)/2;
}else{
$costoAdministracion1=(($totalProduccion+$totalMateriaPrima+$totalPreImpresion)*0.17)/2;
}
if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
{
$costoAdministracion2=(($totalProduccion2+$totalMateriaPrima2+$totalPreImpresion)*0.17)/2;
}else{
$costoAdministracion2=(($totalProduccion2+$totalMateriaPrima2+$totalPreImpresion)*0.17)/2;
}
if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
{
$costoAdministracion3=(($totalProduccion3+$totalMateriaPrima3+$totalPreImpresion)*0.17)/2;
}else{
$costoAdministracion3=(($totalProduccion3+$totalMateriaPrima3+$totalPreImpresion)*0.17)/2;
}
if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
{
$costoAdministracion4=(($totalProduccion4+$totalMateriaPrima4+$totalPreImpresion)*0.17)/2;
}else{
$costoAdministracion4=(($totalProduccion4+$totalMateriaPrima4+$totalPreImpresion)*0.17)/2;
}
$costoAdicionalPorUnidad=$hoja->costo_adicional;
$totalCostosVarios=(($totalProduccion+$totalMateriaPrima+$totalPreImpresion)*0.17)+$costoAdicionalPorUnidad;
$totalCostosVarios2=(($totalProduccion2+$totalMateriaPrima2+$totalPreImpresion)*0.17)+$costoAdicionalPorUnidad;
$totalCostosVarios3=(($totalProduccion3+$totalMateriaPrima3+$totalPreImpresion)*0.17)+$costoAdicionalPorUnidad;
$totalCostosVarios4=(($totalProduccion4+$totalMateriaPrima4+$totalPreImpresion)*0.17)+$costoAdicionalPorUnidad;

$subtotal1=$totalCostosVarios+$totalMateriaPrima+$totalPreImpresion+$totalProduccion;
$subtotal2=$totalCostosVarios2+$totalMateriaPrima2+$totalPreImpresion+$totalProduccion2;
$subtotal3=$totalCostosVarios3+$totalMateriaPrima3+$totalPreImpresion+$totalProduccion3;
$subtotal4=$totalCostosVarios4+$totalMateriaPrima4+$totalPreImpresion+$totalProduccion4;
/**********calculo comision agencia*********************/

function calculo_comision_agencia($comision_agencia,$total){
   if($comision_agencia=="SI"){
       $porcentaje = 20;
       $totalComisionAgencia=($total * $porcentaje)/100;
   }else{
       $totalComisionAgencia=0;
   } 
   return $totalComisionAgencia;
}

/**********calculo costo comercial*********************/

function calculo_costo_comercial($totalComisionAgencia,$subtotal){
   if($costo_comercial>0){
       $porcentaje = 1.5;
       $totalCostoComercial=(($costo_comercial*$porcentaje)*($totalComisionAgencia+$subtotal))/100;
   }else{
       $totalCostoComercial=0;
   } 
   return $totalCostoComercial;
}
$totalComisionAgencia = calculo_comision_agencia($comision_agencia,$subtotal1);
$totalCostoComercial = calculo_costo_comercial($totalComisionAgencia,$subtotal1);
$totalComisionAgencia2 = calculo_comision_agencia($comision_agencia,$subtotal2);
$totalCostoComercial2 = calculo_costo_comercial($totalComisionAgencia,$subtotal2);
$totalComisionAgencia3 = calculo_comision_agencia($comision_agencia,$subtotal3);
$totalCostoComercial3 = calculo_costo_comercial($totalComisionAgencia,$subtotal3);
$totalComisionAgencia4 = calculo_comision_agencia($comision_agencia,$subtotal4);
$totalCostoComercial4 = calculo_costo_comercial($totalComisionAgencia,$subtotal4);


$total1=$totalCostosVarios+$totalMateriaPrima+$totalPreImpresion+$totalProduccion+$totalComisionAgencia+$totalCostoComercial;
$total2=$totalCostosVarios2+$totalMateriaPrima2+$totalPreImpresion+$totalProduccion2+$totalComisionAgencia2+$totalCostoComercial2;
$total3=$totalCostosVarios3+$totalMateriaPrima3+$totalPreImpresion+$totalProduccion3+$totalComisionAgencia3+$totalCostoComercial3;
$total4=$totalCostosVarios4+$totalMateriaPrima4+$totalPreImpresion+$totalProduccion4+$totalComisionAgencia4+$totalCostoComercial4;
//echo "<h1>---" . $totalCostosVarios . "</h1>";
//echo "<h1>---" . $totalMateriaPrima . "</h1>";
//echo "<h1>---" . $totalPreImpresion . "</h1>";
//echo "<h1>---" . $totalProduccion . "</h1>";
//echo "<h1>---" . $totalComisionAgencia . "</h1>";
//echo "<h1>---" . $datoscantidad1 . "</h1>";
//echo "<h1>---" . $datoscantidad2 . "</h1>";
//echo "<h1>---" . $datoscantidad3 . "</h1>";
//echo "<h1>---" . $datoscantidad4 . "</h1>";
//exit();

$totalValorUnitario1=($total1/($datoscantidad1));
$totalValorUnitario2=($total2/($datoscantidad2));
$totalValorUnitario3=($total3/($datoscantidad3));
$totalValorUnitario4=($total4/($datoscantidad4));


/***********calculo del margen*************************/
function calculo_margen($hoja,$datos){
    if (sizeof($hoja) == 0) {
        if ($datos->margen_migrado != 0 || $datos->margen_migrado != null) {
            $margen = $datos->margen_migrado;
        } else {
            $margen = "15";
        }
    } else {
        if ($hoja->margen == null) {
            $margen = '15';
        } else {
            $margen = $hoja->margen;
        }
    }
    return $margen;
}
$margen = calculo_margen($hoja,$datos);


/**********************calculo del valor final*********************/
function calculo_valor_final($hoja,$totalValorUnitario,$margen){
    //if ($hoja->margen!="") {
      //$valorFinal=($totalValorUnitario/((100-$hoja->margen)/100));
    //}else{ 
      //if($datos->margen_migrado!=0 || $datos->margen_migrado!=null){
        //$valorFinal=($totalValorUnitario/((100-$datos->margen_migrado)/100));       
        $valorFinal=($totalValorUnitario/((100-$margen)/100));       
      //}else{
       // $valorFinal=($totalValorUnitario/((100-15)/100));
      //}
  //}

    return array('valor_final'=>$valorFinal);
}

$valorFinal1 = calculo_valor_final($hoja,$totalValorUnitario1,$margen);
$valorFinal2 = calculo_valor_final($hoja,$totalValorUnitario2,$margen);
$valorFinal3 = calculo_valor_final($hoja,$totalValorUnitario3,$margen);
$valorFinal4 = calculo_valor_final($hoja,$totalValorUnitario4,$margen);

/*****************calculo valor financiado****************/
$vcostoFinanciero=$this->variables_cotizador_model->getVariablesCotizadorPorId(33);
$recargoPorCantidadJusta=$this->variables_cotizador_model->getVariablesCotizadorPorId(37);

function calculo_valor_financiado($vcostoFinanciero,$recargoPorCantidadJusta,$forma_pago,$valorFinal,$datos){ 
$valorFinanciado=$valorFinal*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
if($datos->acepta_excedentes=='NO')
{
    $valorFinanciado=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado);
}
return $valorFinanciado;
}

$valorFinanciado1 = calculo_valor_financiado($vcostoFinanciero,$recargoPorCantidadJusta,$forma_pago,$valorFinal1['valor_final'],$datos);
$valorFinanciado2 = calculo_valor_financiado($vcostoFinanciero,$recargoPorCantidadJusta,$forma_pago,$valorFinal2['valor_final'],$datos);
$valorFinanciado3 = calculo_valor_financiado($vcostoFinanciero,$recargoPorCantidadJusta,$forma_pago,$valorFinal3['valor_final'],$datos);
$valorFinanciado4 = calculo_valor_financiado($vcostoFinanciero,$recargoPorCantidadJusta,$forma_pago,$valorFinal4['valor_final'],$datos);


/************************Calculo cantidad Justa********************************/
function texto_cantidad_justa($datos){
if($datos->acepta_excedentes=='NO')
{
   $text_cantidad_justa=" Recargo por Cantidad Justa";    
}else{
   $text_cantidad_justa="";     
}
return $text_cantidad_justa;    
}
$text_cantidad_justa=texto_cantidad_justa($datos);
/************************Calculo valor Empresa********************************/
function calculo_valor_empresa($hoja,$fotomecanica,$datos,$valorFinanciado,$hoja_valor_empresa,$datos_precio_migrado){
    if (sizeof($hoja) == 0) {
        if (($fotomecanica->materialidad_datos_tecnicos == "Indefinido") || ($fotomecanica->materialidad_datos_tecnicos == "Microcorrugado") || ($fotomecanica->materialidad_datos_tecnicos == "Corrugado") || ($fotomecanica->materialidad_datos_tecnicos == "Cartulina-cartulina")) {
            if($datos_precio_migrado != 0 && $datos_precio_migrado!=""){
            $valorEmpresa = $datos_precio_migrado;
            }else{
                $valorEmpresa = $valorFinanciado;
            }
        } else {
            $valorEmpresa = $valorFinanciado;
        }
    } else {
        if (($fotomecanica->materialidad_datos_tecnicos == "Indefinido") || ($fotomecanica->materialidad_datos_tecnicos == "Microcorrugado") || ($fotomecanica->materialidad_datos_tecnicos == "Corrugado") || ($fotomecanica->materialidad_datos_tecnicos == "Cartulina-cartulina")) {
            $valorEmpresa = $datos_precio_migrado;
            if ($valorEmpresa == 0 || $valorEmpresa == "") {
                $valorEmpresa = $valorFinanciado;
            } else {
                $valorEmpresa = $datos_precio_migrado;
            }
        } else {
            $valorEmpresa = $valorFinanciado;
        }
        if($hoja_valor_empresa!=0 || $hoja_valor_empresa!=""){
            $valorEmpresa=$hoja_valor_empresa;
        }
    }
    return $valorEmpresa;
}

$valorEmpresa1=calculo_valor_empresa($hoja,$fotomecanica,$datos,$valorFinanciado1,$datos->valor_empresa,$datos->precio_migrado);

//exit();
$valorEmpresa2=calculo_valor_empresa($hoja,$fotomecanica,$datos,$valorFinanciado2,$datos->valor_empresa_2,$datos->precio_migrado2);
$valorEmpresa3=calculo_valor_empresa($hoja,$fotomecanica,$datos,$valorFinanciado3,$datos->valor_empresa_3,$datos->precio_migrado3);
$valorEmpresa4=calculo_valor_empresa($hoja,$fotomecanica,$datos,$valorFinanciado4,$datos->valor_empresa_4,$datos->precio_migrado4);

/**********************calculo dias de entrega************************/
function calculo_dias_de_entrega($hoja){
    if (sizeof($hoja) == 0) {
        $dias_de_entrega='20';
    } else {
        if($hoja->dias_de_entrega==0){$dias_de_entrega="20";}else{
        $dias_de_entrega=$hoja->dias_de_entrega;}
    }
    return $dias_de_entrega;
}

$dias_de_entrega=calculo_dias_de_entrega($hoja);



//calculos posteriores
if (sizeof($hoja) >= 1) {
    $arreglofecha = array
        (
        "fecha_act" => date("Y-m-d"),
    );
    $this->db->where('id', $hoja->id);
    $this->db->update("hoja_de_costos_datos", $arreglofecha);
}

// print_r($placa);
//echo "<h1>------".$costo_comercial."</h1>";
//echo "<h1>------".$comision_agencia."</h1>";
//echo "<h1>------".$recargoPorCantidadJusta->precio."</h1>";
//echo "<h1>------".$valorFinanciado1."</h1>";
//echo "<h1>------".$totalMateriaPrima."</h1>";
//echo "<h1>------".$totalPreImpresion."</h1>";exit();
//echo "<h1>------".(($placa[4]*10)/100)."</h1>";
//echo "<h1>------".$onda['valorCorte']."</h1>";
//echo "<h1>------".$costoPlacaKilo."</h1>";
//echo "<h1>------".$totalPreImpresion."</h1>";
//echo "<h1>------".$totalProduccion."</h1>";
//echo "<h1>------".$costoVenta->precio."</h1>";
//echo "<h1>------**********************</h1>";
//echo "<h1>------".$tiraje."</h1>";
//echo "<h1>------".$lacado1."</h1>";
//echo "<h1>------".$complemento."</h1>";
//echo "<h1>------".$totalEmplacado."</h1>";
//echo "<h1>------".$totalMontajeMolde."</h1>";
//echo "<h1>------".$totalTroquelado."</h1>";
//echo "<h1>------".$pegado_1."</h1>";
//echo "<h1>------".$des[0]."</h1>";
//echo "<h1>------".$moldeTroquel."</h1>";
//echo "<h1>------".$totalDesgajado."</h1>";
//echo "<h1>------".$otrosCaucho."</h1>";
//echo "<h1>------".$valor_bv_maquina."</h1>";
//echo "<h1>------".$valor_acepeta_exce."</h1>";
//echo "<h1>------".$recargo800Array->precio."</h1>";
//echo "<h1>------".$barniz."</h1>";
//echo "<h1>------".$base_imprenta->precio."</h1>";
//echo "<h1>------".$maquina."</h1>";
//$datos->cantidad_1 > 0) and ( $ing->unidades_por_pliego > 0
?>
