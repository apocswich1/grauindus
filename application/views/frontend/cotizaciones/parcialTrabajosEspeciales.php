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
    
    //inicializo variable cantidad de procesos especiales
    $procesosespeciales=0;
    
    //contabilizo variable cantidad de procesos especiales
    if($tesp1!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    if($tesp2!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    if($tesp3!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    if($tesp4!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    if($tesp5!=0){ $procesosespeciales++; } //echo "procesos especiales:".$procesosespeciales;
    
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
              
    //Totalizo el monto de procesos especiales
    $totaltrabajosespeciales=$folia1->valor_venta+$folia2->valor_venta+$folia3->valor_venta+$cuno1->valor_venta+$cuno2->valor_venta;
    /****************************************************/
?>