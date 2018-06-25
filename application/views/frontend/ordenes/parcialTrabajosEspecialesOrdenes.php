<?php

/***************procesos especiales******************/
    //valores de procesos especiales (Folia y cuno)
     $tesp1=$fotomecanica->folia1_proceso_seletec;
     $tesp2=$fotomecanica->folia2_proceso_seletec;
     $tesp3=$fotomecanica->folia3_proceso_seletec;
     $tesp4=$fotomecanica->cuno1_proceso_seletec;
     $tesp5=$fotomecanica->cuno2_proceso_seletec;
     
      $fv1=$fotomecanica->procesos_especiales_folia_valor;
      $fv2=$fotomecanica->procesos_especiales_folia_2_valor;
      $fv3=$fotomecanica->procesos_especiales_folia_3_valor;
      $cv1=$fotomecanica->procesos_especiales_cuno_valor;
      $cv2=$fotomecanica->procesos_especiales_cuno_2_valor;
      $tamano1=$ing->tamano_a_imprimir_1;
      $tamano2=$ing->tamano_a_imprimir_2;
    //inicializo variable cantidad de procesos especiales
    $procesosespeciales=0;
    $altura=0;
    //contabilizo variable cantidad de procesos especiales
    if($tesp1!=0){ $procesosespeciales++; $altura=1 + $altura;} //echo "procesos especiales:".$procesosespeciales;
    if($tesp2!=0){ $procesosespeciales++; $altura=1 + $altura;} //echo "procesos especiales:".$procesosespeciales;
    if($tesp3!=0){ $procesosespeciales++; $altura=1 + $altura;} //echo "procesos especiales:".$procesosespeciales;
    if($tesp4!=0){ $procesosespeciales++; $altura=1 + $altura;} //echo "procesos especiales:".$procesosespeciales;
    if($tesp5!=0){ $procesosespeciales++; $altura=1 + $altura;} //echo "procesos especiales:".$procesosespeciales;
    
    //Lleno los arrays de procesos especiales
    $folia1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_proceso_seletec);
    $folia2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia2_proceso_seletec);
    $folia3=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia3_proceso_seletec);
    $cuno1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno1_proceso_seletec);
    $cuno2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno2_proceso_seletec);
    
    //Lleno los arrays de costos fijos
    $cffolia1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_molde_selected);
    $cffolia2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia2_molde_selected);
    $cffolia3=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia3_molde_selected);
    $cfcuno1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno1_molde_selected);
    $cfcuno2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno2_molde_selected); 

      if($folia1->unidad_de_venta==5){$costo1=($folia1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($folia1->unidad_de_venta==9){$costo1=$folia1->valor_venta;}else{$costo1=$folia1->valor_venta*$datoscantidad1;}}
      if($cffolia1->unidad_de_venta==5){$costo11=($cffolia1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cffolia1->unidad_de_venta==9){$costo11=$cffolia1->valor_venta;}else{$costo11=$cffolia1->valor_venta*$datoscantidad1;}} 
      if($folia1->unidad_de_venta==5){$costo2=($folia2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($folia2->unidad_de_venta==9){$costo2=$folia2->valor_venta;}else{$costo2=$folia2->valor_venta*$datoscantidad1;}} 
      if($cffolia2->unidad_de_venta==5){$costo12=($cffolia2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cffolia2->unidad_de_venta==9){$costo12=$cffolia2->valor_venta;}else{$costo12=$cffolia2->valor_venta*$datoscantidad1;}} 
      if($folia3->unidad_de_venta==5){$costo3=($folia3->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($folia3->unidad_de_venta==9){$costo3=$folia3->valor_venta;}else{$costo3=$folia3->valor_venta*$datoscantidad1;}}
      if($cffolia3->unidad_de_venta==5){$costo13=($cffolia3->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cffolia3->unidad_de_venta==9){$costo13=$cffolia3->valor_venta;}else{$costo13=$cffolia3->valor_venta*$datoscantidad1;}}
      if($cuno1->unidad_de_venta==5){$costo4=($cuno1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cuno1->unidad_de_venta==9){$costo4=$cuno1->valor_venta;}else{$costo4=$cuno1->valor_venta*$datoscantidad1;}}
      if($cfcuno1->unidad_de_venta==5){$costo14=($cfcuno1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cfcuno1->unidad_de_venta==9){$costo14=$cfcuno1->valor_venta;}else{$costo14=$cfcuno1->valor_venta*$datoscantidad1;}}
      if($cuno2->unidad_de_venta==5){$costo5=($cuno2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cuno2->unidad_de_venta==9){$costo5=$cuno2->valor_venta;}else{$costo5=$cuno2->valor_venta*$datoscantidad1;}}
      if($cfcuno2->unidad_de_venta==5){$costo15=($cfcuno2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cfcuno2->unidad_de_venta==9){$costo15=$cfcuno2->valor_venta;}else{$costo15=$cfcuno2->valor_venta*$datoscantidad1;}}
      
      function calculo_tespeciales($folia1,$folia2,$folia3,$cffolia1,$cffolia2,$cffolia3,$cuno1,$cuno2,$cfcuno1,$cfcuno2,$ing,$datoscantidad1,$hoja){
          if($folia1->unidad_de_venta==5){$costo1=($folia1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($folia1->unidad_de_venta==9){$costo1=$folia1->valor_venta;}else{$costo1=$folia1->valor_venta*$datoscantidad1;}}
          if($cffolia1->unidad_de_venta==5){$costo11=($cffolia1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cffolia1->unidad_de_venta==9){$costo11=$cffolia1->valor_venta;}else{$costo11=$cffolia1->valor_venta*$datoscantidad1;}} 
          if($folia2->unidad_de_venta==5){$costo2=($folia2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($folia2->unidad_de_venta==9){$costo2=$folia2->valor_venta;}else{$costo2=$folia2->valor_venta*$datoscantidad1;}} 
          if($cffolia2->unidad_de_venta==5){$costo12=($cffolia2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cffolia2->unidad_de_venta==9){$costo12=$cffolia2->valor_venta;}else{$costo12=$cffolia2->valor_venta*$datoscantidad1;}} 
          if($folia3->unidad_de_venta==5){$costo3=($folia3->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($folia3->unidad_de_venta==9){$costo3=$folia3->valor_venta;}else{$costo3=$folia3->valor_venta*$datoscantidad1;}}
          if($cffolia3->unidad_de_venta==5){$costo13=($cffolia3->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cffolia3->unidad_de_venta==9){$costo13=$cffolia3->valor_venta;}else{$costo13=$cffolia3->valor_venta*$datoscantidad1;}}
          if($cuno1->unidad_de_venta==5){$costo4=($cuno1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cuno1->unidad_de_venta==9){$costo4=$cuno1->valor_venta;}else{$costo4=$cuno1->valor_venta*$datoscantidad1;}}
          if($cfcuno1->unidad_de_venta==5){$costo14=($cfcuno1->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cfcuno1->unidad_de_venta==9){$costo14=$cfcuno1->valor_venta;}else{$costo14=$cfcuno1->valor_venta*$datoscantidad1;}}
          if($cuno2->unidad_de_venta==5){$costo5=($cuno2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cuno2->unidad_de_venta==9){$costo5=$cuno2->valor_venta;}else{$costo5=$cuno2->valor_venta*$datoscantidad1;}}
          if($cfcuno2->unidad_de_venta==5){$costo15=($cfcuno2->valor_venta/$ing->unidades_por_pliego)*$datoscantidad1;}else{if($cfcuno2->unidad_de_venta==9){$costo15=$cfcuno2->valor_venta;}else{$costo15=$cfcuno2->valor_venta*$datoscantidad1;}}
          if($hoja->valor_externo==0 || $hoja->valor_externo==""){    
          return $costo1+$costo11+$costo2+$costo12+$costo3+$costo13+$costo4+$costo14+$costo5+$costo15;
          }else{    
          return $hoja->valor_externo;
          }
      }
      $externos_produccion_p1 = calculo_tespeciales($folia1, $folia2, $folia3, $cffolia1, $cffolia2, $cffolia3, $cuno1, $cuno2, $cfcuno1, $cfcuno2, $ing, $datoscantidad1,$hoja);
      $externos_produccion_p2 = calculo_tespeciales($folia1, $folia2, $folia3, $cffolia1, $cffolia2, $cffolia3, $cuno1, $cuno2, $cfcuno1, $cfcuno2, $ing, $datoscantidad2,$hoja);
      $externos_produccion_p3 = calculo_tespeciales($folia1, $folia2, $folia3, $cffolia1, $cffolia2, $cffolia3, $cuno1, $cuno2, $cfcuno1, $cfcuno2, $ing, $datoscantidad3,$hoja);
      $externos_produccion_p4 = calculo_tespeciales($folia1, $folia2, $folia3, $cffolia1, $cffolia2, $cffolia3, $cuno1, $cuno2, $cfcuno1, $cfcuno2, $ing, $datoscantidad4,$hoja);
      
      $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
      $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
      $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
      
      function calculo_acabados_impresion($fotomecanica,$acabado_4Array,$acabado_5Array,$acabado_6Array,$tamano1,$tamano2,$datoscantidad1,$ing){
          if($fotomecanica->acabado_impresion_4=="1700")
                                {   $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {   $altura=1 + $altura;
                                    
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
							
                                 
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datoscantidad1);
                                        $cantidad_4=$datoscantidad1;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datoscantidad1);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datoscantidad1);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datoscantidad1*$acabado_4Valor);
                                        $cantidad_4=$datoscantidad1;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta/$ing->unidades_por_pliego;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta/$ing->unidades_por_pliego)*$datoscantidad1;
                                        $cantidad_4=$datoscantidad1;
                                        
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datoscantidad1);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datoscantidad1);
                                        $cantidad_4=$datoscantidad1;                                        
                                    }
                                    
                                }
                                
                                if($fotomecanica->acabado_impresion_5=="1700")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {   $altura=1 + $altura;                                 
                                    
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datoscantidad1);                                      
                                        $cantidad_5=$datoscantidad1;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datoscantidad1);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datoscantidad1);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datoscantidad1*$acabado_5Valor);
                                        $cantidad_5=$datoscantidad1;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta/$ing->unidades_por_pliego;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta/$ing->unidades_por_pliego)*$datoscantidad1;
                                        $cantidad_5=$datoscantidad1;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datoscantidad1);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    { 
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        //$precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $precio_total_5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datoscantidad1);
                                        $cantidad_5=$datoscantidad1;
                                    }                                      
                                }    
                                
                                if($fotomecanica->acabado_impresion_6=="1700")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {   $altura=1 + $altura;
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                  
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datoscantidad1);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datoscantidad1);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datoscantidad1);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datoscantidad1*$acabado_6Valor);
                                        $cantidad_6=$datoscantidad1;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta/$ing->unidades_por_pliego;
                                        $precio_total_6=($acabado_6MedidaMasValorVenta/$ing->unidades_por_pliego)*$datoscantidad1;
                                        $cantidad_6=$datoscantidad1;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datoscantidad1);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datoscantidad1);
                                        $cantidad_6=$datoscantidad1;
                                    }                                      

                                }
                                    if($hoja->valor_externo==0 || $hoja->valor_externo==""){
                                    return $precio_total_4+$precio_total_5+$precio_total_6;}else{
                                    return 0;
                                    }
                                }
                                
      $externos_produccion_ac1 = calculo_acabados_impresion($fotomecanica, $acabado_4Array, $acabado_5Array, $acabado_6Array, $tamano1, $tamano2, $datoscantidad1, $ing);
      $externos_produccion_ac2 = calculo_acabados_impresion($fotomecanica, $acabado_4Array, $acabado_5Array, $acabado_6Array, $tamano1, $tamano2, $datoscantidad2, $ing);
      $externos_produccion_ac3 = calculo_acabados_impresion($fotomecanica, $acabado_4Array, $acabado_5Array, $acabado_6Array, $tamano1, $tamano2, $datoscantidad3, $ing);
      $externos_produccion_ac4 = calculo_acabados_impresion($fotomecanica, $acabado_4Array, $acabado_5Array, $acabado_6Array, $tamano1, $tamano2, $datoscantidad4, $ing);
      
      /****************************************************/
    //print_r($cffolia1);exit();

      $externos_produccion=0;
                             //    exit($fotomecanica->acabado_impresion_4."hollaaa");
				if($fotomecanica->acabado_impresion_4=="1700")
                                {   $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {   $altura=1 + $altura;
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
							
                                 
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datoscantidad1);
                                        $cantidad_4=$datoscantidad1;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datoscantidad1);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datoscantidad1);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datoscantidad1*$acabado_4Valor);
                                        $cantidad_4=$datoscantidad1;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta/$ing->unidades_por_pliego;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta/$ing->unidades_por_pliego)*$datoscantidad1;
                                        $cantidad_4=$datoscantidad1;
                                        
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datoscantidad1);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datoscantidad1);
                                        $cantidad_4=$datoscantidad1;                                        
                                    }
                                    
                                }
                                
                                if($fotomecanica->acabado_impresion_5=="1700")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {   $altura=1 + $altura;                                 
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datoscantidad1);                                      
                                        $cantidad_5=$datoscantidad1;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datoscantidad1);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datoscantidad1);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datoscantidad1*$acabado_5Valor);
                                        $cantidad_5=$datoscantidad1;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta/$ing->unidades_por_pliego;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta/$ing->unidades_por_pliego)*$datoscantidad1;
                                        $cantidad_5=$datoscantidad1;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datoscantidad1);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    { 
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        //$precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $precio_total_5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datoscantidad1);
                                        $cantidad_5=$datoscantidad1;
                                    }                                      
                                }    
                                
                                if($fotomecanica->acabado_impresion_6=="1700")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {   $altura=1 + $altura;
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                  
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datoscantidad1);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datoscantidad1);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datoscantidad1);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datoscantidad1*$acabado_6Valor);
                                        $cantidad_6=$datoscantidad1;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta/$ing->unidades_por_pliego;
                                        $precio_total_6=($acabado_6MedidaMasValorVenta/$ing->unidades_por_pliego)*$datoscantidad1;
                                        $cantidad_6=$datoscantidad1;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datoscantidad1);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datoscantidad1);
                                        $cantidad_6=$datoscantidad1;
                                    }                                      

                                } 
                                
                                
                                //echo $costo_unitario6;exit();
                                
?>