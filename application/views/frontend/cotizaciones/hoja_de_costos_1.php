<?php
    $tamano1=$ing->tamano_a_imprimir_1;
    $tamano2=$ing->tamano_a_imprimir_2;
 
    if($tamano1==60 and $tamano2>100)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==70 and $tamano2>120)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==80 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==90 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1>90 and $tamano2>60)
    {
        $maquina="Máquina Roland 800";
    }else
    {
        $maquina="Máquina Roland 800";
    }
    /**	
       * validaciones mermas
       * */
       
       if($fotomecanica->colores>3)
        {
            if($maquina=="Máquina Roland 800")
            {
				if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
				{
				    $color1=0;
					$color2= $fotomecanica->colores*150;				
				}else{			
                    $color1=0;
                    $color2= $fotomecanica->colores*100;
				}
            }else
            {
				//ultra
				
				
				if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
				{
				    $color1=0;
					$color2= $fotomecanica->colores*150;				
				}else{			
                    $color1=0;
                    $color2= $fotomecanica->colores*100;
				}

            }
        }else
        {
			  if($fotomecanica->colores == 0)
				{
					$color1=0;
					$color2=0;
				}elseif($fotomecanica->colores >= 1 and $fotomecanica->colores <= 3)
				{	
						if($maquina=="Máquina Roland 800")
						{
						   $color1= 400;
						   $color2=0;
						}else
						{
							//ultra
						   $color1= 300;
						   $color2=0;
						}
				}
        }
       // echo $ing->unidades_por_pliego;exit;
         
         $canTotal=number_format($datos->cantidad_1/5000,0,"","")-1;//6000 1
         //echo $canTotal;exit;
         $cantidad_1=$datos->cantidad_1/$ing->unidades_por_pliego;
         //echo $cantidad_1;exit;

         if($datos->cantidad_1/$ing->unidades_por_pliego>5000)
         {
         
			$vecescan1 = ($datos->cantidad_1/$ing->unidades_por_pliego) / 5000;
			
			 if($vecescan1 >1)
            {
				   $can1= 100 * $vecescan1;
			}else{
				
				   $can1=100;
			}
			
			
             if($vecescan1 >1)
            {
                //$entero=number_format(($cantidad_1/5000)+0.5,0,'','');
                $can2= 50 * $vecescan1;
            }else
            {
                $can2=50;
            }
                
            
         }else
         {
            $can1=0;
            $can2=0;
         }
        
        
        $barniz=substr($fotomecanica->acabado_impresion_1,0,6);
        //echo $barniz;exit;
         if($fotomecanica->lleva_barniz=='SI')
         {
            $cantidadBarniz=$datos->cantidad_1-1000;
            if($cantidadBarniz<1000)
            {
                if($maquina=="Máquina Roland 800")
                {
                    //$bar1=150;
                    $bar1=100;
                    $bar2=0;
                }else
                {
                    $bar1=100;
                    $bar2=0;
                }
            }else
            {
			
               //echo $datos->cantidad_1/$ing->unidades_por_pliego;exit;
               $enteroBarniz=($datos->cantidad_1/$ing->unidades_por_pliego);
			   if($enteroBarniz < 2000)
			   {
				//$bar1=150;
				$bar1=100;
                $bar2=0;   
			   }else
			   {
               $enteroBarniz=(((number_format($enteroBarniz,0,'','')/1000)+0.5)-2)*10;
               //echo $enteroBarniz;exit;   
               //$bar1=150;
               $bar1=100;
               $bar2=$enteroBarniz;
			   }
            }
            
            
         }else
         {
                $bar1=0;
                $bar2=0;
         }
		 

		
		
		
        if($datos->procesos_especiales_folia=="SI")
        {
            $folia=25;
        }else
        {
            $folia=0;
        }
 
		$acabado_nombre4=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
		$acabado_nombre5=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
		$acabado_nombre6=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
		
		
		if(strstr($acabado_nombre4->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }

		if(strstr($acabado_nombre5->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
		if(strstr($acabado_nombre6->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
		if($laca == null)
		{
			$laca=0;
		}
		
		
		if(strstr($acabado_nombre4->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        } 
		
		if(strstr($acabado_nombre5->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        }
		
         if(strstr($acabado_nombre6->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        }
		
		
		
		if($acabado_nombre4->tipo == 'Externo' and $acabado_nombre4->id != 17)
        {
			//echo $acabado_nombre4->tipo;
            $numeros_de_acabados=1;			
        }else
        {
        } 
		
		if($acabado_nombre5->tipo == 'Externo' and $acabado_nombre5->id != 17)
        {
			//echo $acabado_nombre5->tipo;
            $numeros_de_acabados=2;		
        }else
        {
        } 
		
         if($acabado_nombre6->tipo == 'Externo' and $acabado_nombre6->id != 17)
        {
			//echo $acabado_nombre6->tipo;
            $numeros_de_acabados=3;	
        }else
        {
        } 
		
		 if($numeros_de_acabados >= 2)
        {
            $termolaminado=0;
        }
		
		if($fotomecanica->acabado_impresion_4!="17" or $fotomecanica->acabado_impresion_5!="17" or $fotomecanica->acabado_impresion_6!="17")
        {
			/*if($termolaminado == 50)
			{
				  $externo=0;
			}else{
            $externo=50;
			}*/
			$externo=50;
			
        }else
        {
            $externo=0;
        }
		
       // echo $ing->materialidad_datos_tecnicos;exit;
        if($ing->materialidad_datos_tecnicos=="Onda a la Vista")
        {
             $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
          // echo $canTotal2;exit;
            if($canTotal2>=1)
            {
                $micromicro=30*$canTotal2;
            }else
            {
                $micromicro=0;
            }
        }else
        {
            $micromicro=0;
        }
         if($ing->materialidad_datos_tecnicos=="Cartulina-cartulina")
        {
             $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
          // echo $canTotal2;exit;
            if($canTotal2>=1)
            {
                $cartulina=30*$canTotal2;
            }else
            {
                $cartulina=0;
            }
        }else
        {
            $cartulina=0;
        }
        if($ing->materialidad_datos_tecnicos=="Sólo Cartulina")
        {
           $emplacado=0;
        }else
        {
            $mermaEmplacadoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(35);
            $emplacado= $datos->cantidad_1  / $ing->unidades_por_pliego; /*Valor x dividido por Unidad por pliego*/
            $emplacado= $emplacado / 1000; /*Resultado de emplacado dividido por 1000*/                                       
            $emplacado= ($emplacado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                                  
            $emplacado= $emplacado/ 1000; /*emplacado dividido por 1000*/                   
            $emplacado = $emplacado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
            $Entero = number_format($emplacado,0,'',''); /* Guardar entero del emplacado*/                         
            $emplacado = $Entero * $mermaEmplacadoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        if($fotomecanica->estan_los_moldes=="NO LLEVA" or $fotomecanica->estan_los_moldes=="CLIENTE LO APORTA" or $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
        {
            $troquelado=0;
        }else
        {
            $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
            $troquelado= $datos->cantidad_1  / $ing->unidades_por_pliego; /*Valor x dividido por Unidad por pliego*/
            $troquelado= $troquelado / 1000; /*Resultado de emplacado dividido por 1000*/                                                              
            $troquelado= ($troquelado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          
            $troquelado= $troquelado/ 1000; /*emplacado dividido por 1000*/                      
            $troquelado = $troquelado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
            $EnteroTroquelado = number_format($troquelado,0,'',''); /* Guardar entero del emplacado*/                          
            $troquelado = $EnteroTroquelado * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        $sum=$color1+$color2+$can1+$can2+$bar1+$bar2+$laca+$folia+$termolaminado+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
        if(sizeof($hoja)>=1)
                                        {
                                            $arreglo55=array
                                                (
                                                    "total_merma"=>$sum,
                                                );
                                                $this->db->where('id', $hoja->id);
                                                $this->db->update("hoja_de_costos_datos",$arreglo55);
                                        }
       /**
        * fin validaciones mermas
        * */ 

       $tiraje=$datos->cantidad_1/$ing->unidades_por_pliego;
       if($tiraje<4000)
       {
         $tiraje2="Menos de 4.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(17);
         $factor_rango=$factor_rangos->precio;
       }elseif($tiraje>4000 and $tiraje<=9999)
       {
         $tiraje2="4.001 a 9.999";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(18);
         $factor_rango=$factor_rangos->precio;
       }else
       {
        $tiraje2="Más de 10.000";
        $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(19);
         $factor_rango=$factor_rangos->precio;
       }
       /**
                             * pre impresión
                             * */
                             if($fotomecanica->lleva_barniz=='SI')
                                        {
                                            $barniz3=1;
                                        }else
                                        {
                                            $barniz3=0;
                                        }
                             //echo $barniz3;exit;
                             if($maquina=="Máquina Roland 800")
                                {
                                    $recargoPlanchaArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(26);
                                    $recargoPlancha=$recargoPlanchaArray->precio;
                                    $valorParaPlanchaMetal=1;
                                }else
                                {
                                    $recargoPlancha=0;
                                    $valorParaPlanchaMetal=0;
                                }
                             //echo $valorParaPlanchaMetal;exit;
                             $arte=$this->variables_cotizador_model->getVariablesCotizadorPorId(1);
                             $cantidadArte=$fotomecanica->colores*$arte->precio;
							
                             $plancha_metal=$this->variables_cotizador_model->getVariablesCotizadorPorId(2);
							 
                             $cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))+(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
                             //echo $plancha_metal->precio;exit;
                             //$cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*1));
                             
                             $copiado=$this->variables_cotizador_model->getVariablesCotizadorPorId(3);
                             $cantidadCopiapo=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))+(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
                              //$cantidadCopiapo=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3));
                             $peliculasPreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(4);
                             $peliculasVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(28);
                             $cantidadPeliculas=$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$fotomecanica->colores*$peliculasVariable->precio;
                             $montajePreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(5);
                             $cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->colores;
                             if($datos->impresion_hacer_cromalin=='SI')
                             {
                                $cromalinVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(22);
                                $cromalin=$cromalinVariable->precio;
                                $coloresCromalin=1;
                             }else
                             {
                                $cromalin=0;
                                $coloresCromalin=0;
                             }
                             
									
									
					if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
					{
									$coloresArte= $barniz3 + $fotomecanica->colores;
                                    $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
                                    //$coloresPlanchaMetal=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
                                    $coloresCopiado=$fotomecanica->colores+$barniz3;
                                    //$coloresCopiado=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
                                    $coloresPeliculas=$barniz3 +$fotomecanica->colores;
                                    $coloresMontaje=$barniz3 +$fotomecanica->colores;
                    }
					
					if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
					{
                
									$coloresArte= 0;
                                    $coloresPlanchaMetal= 0;
                                    $coloresCopiado=0;
                                    $coloresPeliculas=0;
                                    $coloresMontaje=0;
									
									$cantidadArte = 0;
									// se cobra $cantidadPlantaMetal = 0;
									// se cobra $cantidadCopiapo = 0;
									$cantidadPeliculas = 0;
									// se cobra $cantidadMontaje = 0;
									
                    }					
				    
					if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
					{
						//ver cambio de peliculas con fotomecanicas y validar
								    $coloresArte= 0;
                                    $coloresPlanchaMetal= 0;
                                    $coloresCopiado=0;
                                    $coloresPeliculas=0;
                                    $coloresMontaje=0;
                    }
					if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
					{
									$coloresArte= 0;
                                    $coloresPlanchaMetal= 0;
                                    $coloresCopiado=0;
                                    $coloresPeliculas=0;
                                    $coloresMontaje=0;
                    }
									
								//if($maquina=="Máquina Roland 800")
                                //{	
                                    /*$coloresArte= $barniz3 + $fotomecanica->colores;
                                    $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
                                    //$coloresPlanchaMetal=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
                                    $coloresCopiado=$fotomecanica->colores+$barniz3;
                                    //$coloresCopiado=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
                                    $coloresPeliculas=$barniz3 +$fotomecanica->colores;
                                    $coloresMontaje=$barniz3 +$fotomecanica->colores;*/
                                //}
                                /*else{
                                    $coloresArte=$fotomecanica->colores;
                                    $coloresPlanchaMetal=$fotomecanica->colores;
                                    $coloresCopiado=$fotomecanica->colores;
                                    $coloresPeliculas=$fotomecanica->colores;
                                    $coloresMontaje=$fotomecanica->colores;
                                }*/
                             $costoVenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(15);
                             $costoAdministracion=$this->variables_cotizador_model->getVariablesCotizadorPorId(16);
                             $totalPreImpresion=$cantidadArte+$cantidadPlantaMetal+$cantidadCopiapo+$cantidadPeliculas+$cantidadMontaje+$cromalin;
?>
<!DOCTYPE html>
<html>
    <head>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>public/backend/fancybox/jquery.fancybox.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/frontend/js/funciones.js"></script>
        <script type="text/javascript">var ruta='<?php echo base_url();?>';</script>
        <script type="text/javascript">
        $(document).ready(function() {
        	$(".fancybox").fancybox({
        		openEffect	: 'none',
        		closeEffect	: 'none'
        	});
            
        });
        </script>
    </head>
    <body>
    <form name="form" method="post" action="<?php echo base_url();?>hoja/save"> 
     <div class="container fuente">
    
            <header>
            
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones</a></li>
              <li class="active">Hoja de Costos <?php if(sizeof($hoja)>0){echo '<strong>(Guardada el '.fecha($hoja->fecha).')</strong>';}?></li>
            </ol>
                 <?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
                <div>
                <h1><span id="titulo">Cartonajes Grau LTDA.</span> &nbsp;&nbsp;&nbsp; Hoja de Costos <?php if(sizeof($hoja)>0){echo '<span style="font-size: 13px;"><strong>(Guardada el '.fecha($hoja->fecha).')</strong><span>';}?>
               
                </h1>
                </div>
                <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
<!--                <div id="numero_de_costo">
                Número de Costo : <?php //echo $id?> || Orden de Producción : <?php //echo $orden->id_antiguo?>
                </div>-->
                <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                <div id="datos_basicos">
                    <!--tabla HTML-->
                    <table border="0">
                        <tr>
                                 <td class="celda_1" colspan="5" bgcolor="#D4D1D1"><strong>Número de Costo : </strong><?php echo $id?> || Orden de Producción : <?php echo $orden->id_antiguo?></td>
                        </tr>                           
                        <tr>
                            <td class="celda_1"  bgcolor="#D4D1D1">&nbsp;Fecha <span class="derecha">:</span></td>
                            <td class="celda_2">&nbsp;<?php echo fecha($datos->fecha)?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4" bgcolor="#D4D1D1">&nbsp;Costeo <span class="derecha">:</span></td>
                            <td class="celda_5">&nbsp;<?php echo $user->nombre?></td>
                        </tr>
                        <tr>
                            <td class="celda_1"  bgcolor="#D4D1D1">&nbsp;Nombre <span class="derecha">:</span></td>
                            <td class="celda_2">&nbsp;<?php echo $cli->razon_social?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4"  bgcolor="#D4D1D1">&nbsp;E-Mail <span class="derecha">:</span></td>
                            <td class="celda_5">&nbsp;<?php echo $cli->correo?></td>
                        </tr>
                        <tr>
                            <td class="celda_1" bgcolor="#D4D1D1">&nbsp;Dirección <span class="derecha">:</span></td>
                            <td class="celda_2">&nbsp;<?php echo $cli->direccion?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4" bgcolor="#D4D1D1">&nbsp;RUT <span class="derecha">:</span></td>
                            <td class="celda_5">&nbsp;<?php echo esRut($cli->rut)?></td>
                        </tr>
                        <tr>
                            <td class="celda_1"  bgcolor="#D4D1D1">&nbsp;Teléfono <span class="derecha">:</span></td>
                            <td class="celda_2">&nbsp;<?php echo $cli->telefono?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4" bgcolor="#D4D1D1">&nbsp;Ciudad <span class="derecha">:</span></td>
                            <td class="celda_5">&nbsp;<?php echo $cli->ciudad?></td>
                        </tr>
                        <tr>
                            <td class="celda_1" bgcolor="#D4D1D1">&nbsp;Vendedor <span class="derecha">:</span></td>
                            <td class="celda_2">&nbsp;<?php echo $vendedor->nombre?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4" bgcolor="#D4D1D1">&nbsp;Comuna <span class="derecha">:</span></td>
                            <td class="celda_5">&nbsp;<?php echo $cli->comuna?></td>
                        </tr>
                        <tr>
                            <td class="celda_1" bgcolor="#D4D1D1">&nbsp;</td>
                            <td class="celda_2">&nbsp;</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4" bgcolor="#D4D1D1">&nbsp;AT <span class="derecha">:</span></td>
                            <td class="celda_5">&nbsp;<?php echo $cli->contacto?></td>
                        </tr>
                        <tr>
                                 <td class="celda_1" colspan="5"><strong>&nbsp;Descripción del Trabajo :</strong> <?php echo $ing->producto.', Impreso a '.$fotomecanica->colores.' colores, Barniz:'.$fotomecanica->lleva_barniz.', En Placa'.$fotomecanica->materialidad_1.' onda: '.$fotomecanica->materialidad_2.' liner: '.$fotomecanica->materialidad_3.' Tamaño: '.$ing->medidas_de_la_caja.'X'.$ing->medidas_de_la_caja_2.'X'.$ing->medidas_de_la_caja_3.'X'.$ing->medidas_de_la_caja_4 ?></td>
                        </tr> 
                        <tr>
                                 <td class="celda_1" colspan="5" ><strong>&nbsp;<?php echo '<strong>Estado del producto: '.$fotomecanica->condicion_del_producto.'</strong>';?></strong></td>
                        </tr>     
                        <tr>
                                 <td class="celda_1" colspan="5">
                                     &nbsp;Ancho : <?php echo $tamano1?> Cm </br>
                                     &nbsp;Largo : <?php echo $tamano2?> Cm</br> 
                                     &nbsp;Unidad/Pliego : <?php echo $ing->unidades_por_pliego?></br> 
                                     &nbsp;Colores : <?php echo $fotomecanica->colores?> <a href="<?php echo base_url()?>hoja/colores_fotomecanica/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></br> 
                                     &nbsp;Piezas Totales en el Pliego(Para Desgajado) : <?php echo $ing->piezas_totales_en_el_pliego?></br> 
                                     &nbsp;Terminación : <?php $acabado_1=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_1);echo $acabado_1->caracteristicas?></br> 
                                     &nbsp;Barniz Acuoso: <?php echo $fotomecanica->lleva_barniz?>  <a href="<?php echo base_url()?>hoja/datos_fotomecanica/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                     &nbsp;Trabajo_Externo: <?php if($externo==0){echo 'NO';}else{echo 'SI';}?></td></br> 
                        </tr>        
                        <tr>
                                 <td class="celda_1" colspan="5"><strong>&nbsp;Valor por : <?php echo number_format($datos->cantidad_1,0,"",".")?> <a href="<?php echo base_url()?>hoja/cantidad/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></strong></td>
                        </tr>         
                        <tr>
                            <td class="celda_1" colspan="5">
                                <?php
                                 switch($fotomecanica->materialidad_datos_tecnicos)
                                  {
                                    case 'Microcorrugado':
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        if ($materialidad_2->precio>0) $materialidad_precio2=($materialidad_2->precio/1000); else $materialidad_precio2=0;
                                        if ($materialidad_3->precio>0) $materialidad_precio3=($materialidad_3->precio/1000); else $materialidad_precio3=0;
                                        if ($materialidad_2->gramaje>0) $materialidad_gramaje2=($materialidad_2->gramaje/1000); else $materialidad_gramaje2=0;
                                        
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
										
										
										
                                        if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                        }

                                        if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                        }


                                        if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                        }


                                        if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                        }

                                        if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                        }


                                        if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                        }

                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                        if($fotomecanica->lleva_barniz=='SI')
                                        {
                                            $barniz2=1;
                                        }else
                                        {
                                            $barniz2=0;
                                        }

                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        if(sizeof($hoja)>=1)
                                        {
                                            $arreglo54=array
                                                (
                                                    "gramos_metro_cuadrado"=>$GramosMetroCuadrado,
                                                );
                                                $this->db->where('id', $hoja->id);
                                                $this->db->update("hoja_de_costos_datos",$arreglo54);
                                        }
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'SI':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO LLEVA MOLDE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }
                                       
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        $ondaGramaje=$materialidad_2->gramaje;
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;
                                       ?>
                                       <a href="<?php echo base_url()?>hoja/materialidad/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                       <br />
                                        <span>&nbsp;<strong>Datos técnicos: </strong></span> Microcorrugado
                                        <br />
					<?php $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1) ?>
                                        <span>&nbsp;<strong>Tapa: </strong></span> <?php echo $tapa->materiales_tipo?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
					<?php $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2) ?>
                                        <span>&nbsp;<strong>Onda: </strong></span> <?php echo $monda->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <br />
					<?php $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>&nbsp;<strong>Liner: </strong></span> <?php echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_3->precio?>  / <strong>Reverso:</strong> <?php echo $materialidad_3->reverso?>
                                        <br />
                                        <!-- GR/ONDA <?php //echo $formula?>
                                        <br /> -->
                                        &nbsp;<strong>Costo Monotapa por Kilo: </strong><?php echo number_format($costo_kilo,0,'','.')?> &nbsp; GRAMOS ONDA M2 <?php echo $GramosMetroCuadrado?> &nbsp; COSTO MONOTAPA POR M2 <?php echo $costoMonotapaPorMetro2?>
                                        <br />
                                        &nbsp;<strong>Impresión : </strong><?php echo $fotomecanica->impresion?> <a href="<?php echo base_url()?>hoja/impresion/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                        <br />
                                        &nbsp;<strong>Forma de Pago : </strong><?php echo $forma_pago->forma_pago?> <a href="<?php echo base_url()?>hoja/forma_pago/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                        <br />
                                        <br />
                                        &nbsp;<strong>Molde : </strong><?php echo $moldeNombre?> <!--
<a href="<?php echo base_url()?>hoja/moldes/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
-->
                                        <?php
                                    break;
                                    case 'Corrugado'://la misma
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
										
                                        if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                        }

                                        if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                        }


                                        if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                        }


                                        if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                        }

                                        if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco/ white top
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                        }


                                        if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                        }
                                        //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
										
										
										
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                        if($fotomecanica->lleva_barniz=='SI')
                                        {
                                            $barniz2=1;
                                        }else
                                        {
                                            $barniz2=0;
                                        }
                                        /*
                                        if($maquina=="Máquina Roland 800")
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(30/100);   
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                        }else
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(0/100);   
                                            //$valorParaPlanchaMetal
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$BASE_imprenta->precio)*($fotomecanica->colores+$barniz2)*($valorParaPlanchaMetal*$recargor800/100);
                                        }
                                          */
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
										
										 if(sizeof($hoja)>=1)
                                        {
                                            $arreglo54=array
                                                (
                                                    "gramos_metro_cuadrado"=>$GramosMetroCuadrado,
                                                );
                                                $this->db->where('id', $hoja->id);
                                                $this->db->update("hoja_de_costos_datos",$arreglo54);
                                        }
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
										
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        $ondaGramaje=$materialidad_2->gramaje;
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;                      
                                        ?>
					<a href="<?php echo base_url()?>hoja/materialidad/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                         <br />
                                        <span>&nbsp;<strong>Datos técnicos: </strong></span> Corrugado
                                        <br />
                                        <span>&nbsp;<strong>Tapa: </strong></span> <?php echo $fotomecanica->materialidad_1?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
                                        <?php $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2) ?>
                                        <span>&nbsp;<strong>Onda: </strong></span> <?php echo  $monda->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <br />
                                        <?php $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>&nbsp;<strong>Liner: </strong></span> <?php echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_3->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_3->reverso?>
                                        <br />
                                       <!-- GR/ONDA <?php //echo $formula?>
                                        <br /> -->
                                        &nbsp;<strong>Costo Monotapa por Kilo: </strong><?php echo number_format($costo_kilo,0,'','.')?> &nbsp; GRAMOS ONDA M2 <?php echo $GramosMetroCuadrado?> &nbsp; COSTO MONOTAPA POR M2 <?php echo $costoMonotapaPorMetro2?>
                                        <br />
                                        &nbsp;<strong>Impresión : </strong><?php echo $fotomecanica->impresion?>
                                        <br >
                                        &nbsp;<strong>Molde : </strong><?php echo $moldeNombre?>
                                        <?php
                                    break;
                                    case 'Cartulina-cartulina': //Cartulina cartulina
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3="No Aplica";;
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
										
                                        //$formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+0*0/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0)))*1000;           
                                       //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
                                        $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                        if($fotomecanica->lleva_barniz=='SI')
                                        {
                                            $barniz2=1;
                                        }else
                                        {
                                            $barniz2=0;
                                        }
                                        
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+0*0/1000);
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
										
                                        $tapaNombre2=$materialidad_2->nombre;
                                        $tapaGramaje2=$materialidad_2->gramaje;
                                        $tapaFecha2=$materialidad_2->fecha_ultima_actualizacion;
                                        $tapaPrecio2=$materialidad_2->precio;
                     
                                        ?>
                                        <span>&nbsp;<strong>Datos técnicos: </strong> </span> Cartulina - Cartulina
                                        <br />
                                        <span>&nbsp;<strong>Tapa: </strong> </span> <?php echo $fotomecanica->materialidad_1?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
                                        <span>&nbsp;<strong>Tapa (Respaldo): </strong> </span> <?php echo $fotomecanica->materialidad_2?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <!--<br />
                                        <?php //$mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>Liner: </span> <?php //echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php //echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php //echo $materialidad_3->precio?>
                                        <br />
                                        GR/ONDA <?php echo $formula?> -->
                                        <br />
                                        &nbsp;<strong>Impresión : </strong><?php echo $fotomecanica->impresion?>
                                        <br >
                                        &nbsp;Molde : <?php echo $moldeNombre?>
                                        <?php
                                        
                                    break;
                                    case 'Sólo Cartulina':
									
					$materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        //$materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        //$materialidad_3="No Aplica";;
                                        //$materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        //$formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        //$costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+0*0/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0)))*1000;           
                                       //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
                                        $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $costo_kilo=0;
                                        if($fotomecanica->lleva_barniz=='SI')
                                        {
                                            $barniz2=1;
                                        }else
                                        {
                                            $barniz2=0;
                                        }
                                        
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+0*0/1000);
                                       if($fotomecanica->estan_los_moldes=='SI')
                                       {
                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
                                       }else
                                       {
                                            $moldeNombre="Nuevo";
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
										
                                        $tapaNombre2=$materialidad_2->nombre;
                                        $tapaGramaje2=$materialidad_2->gramaje;
                                        $tapaFecha2=$materialidad_2->fecha_ultima_actualizacion;
                                        $tapaPrecio2=$materialidad_2->precio;
                     
                                        ?>
                                        <span><strong>&nbsp;<strong>Datos técnicos: </strong> </span> Sólo Cartulina
                                        <br />
                                        <span><strong>&nbsp;Tapa: </strong> </span> <?php echo $fotomecanica->materialidad_1?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
                                        <span><strong>&nbsp;<strong>Tapa (Respaldo): </strong></strong> </span> <?php echo $fotomecanica->materialidad_2?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <!--<br />
                                        <?php //$mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>Liner: </span> <?php //echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php //echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php //echo $materialidad_3->precio?>
                                        <br />
                                        GR/ONDA <?php echo $formula?> -->
                                        <br />
                                        &nbsp;<strong>Impresión : </strong><?php echo $fotomecanica->impresion?>
                                        <br >
                                        &nbsp;<strong>Molde : </strong><?php echo $moldeNombre?>
                                        <?php	
                                    break;
                                    case 'Se solicita proposición':
                                        
                                    break;
                                  }  
                                ?>                                
                            </td>
                        </tr>                            
                    </table>
                    <!--/fin tabla HTML-->
                    <!--separador 20-->
                    <!--<div class="separador_20"></div>-->
                    <!--/separador 20-->
<!--                    <div id="numero_de_costo">
                    Descripción del trabajo
                    </div>-->
                    <!--separador 20-->
                    <!--<div class="separador_20"></div>-->
                    <!--/separador 20-->
                    <!--<div>-->
                        
						<?php // echo $ing->producto.', Impreso a '.$fotomecanica->colores.' colores, Barniz:'.$fotomecanica->lleva_barniz.', En Placa'.$fotomecanica->materialidad_1.' onda: '.$fotomecanica->materialidad_2.' liner: '.$fotomecanica->materialidad_3.' Tamaño: '.$ing->medidas_de_la_caja.'X'.$ing->medidas_de_la_caja_2.'X'.$ing->medidas_de_la_caja_3.'X'.$ing->medidas_de_la_caja_4 ?>
                    <!--</div>-->
                    <!--<div class="separador_10"></div>-->
<!--                    <div id="maquina">
                        <?php /*echo $maquina*/ /*echo 'Maquina Ralond 800';*/ // echo '<strong><h6>Estado del producto: '.$fotomecanica->condicion_del_producto.'</h6></strong>';?>
                    </div>-->
                    <!--separador 20-->
                    <!--<div class="separador_20"></div>-->
                    <!--/separador 20-->
                    <!--/separador 20-->
                    <div>
                        <!--materialidad-->
                       

            <!--/materialidad-->
                    </div>
                    <div class="separador_10"></div>
                    <div>   
                        
                        
                        
                        
                                  
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    <!--trabajos externos-->
               <table border="0" width="800">
               <tr>
                        <td class="celda_5" colspan="16" bgcolor="#D4D1D1">Trabajos Internos</td>
               </tr>                     
               <tr>
                        <td class="celda_5">&nbsp;&nbsp; </td>
                        <td class="celda_5">&nbsp;Unidad&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;Ancho&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;Largo&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;Cantidad&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Medida&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Unitario&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Total&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Empresa&nbsp;</td>
               </tr>                        
                <?php
                if($fotomecanica->acabado_impresion_1!="16")
                {
                    $acabado_1Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_1);
                    $acabado_1=ucwords(strtolower($acabado_1Array->caracteristicas)); // Nombre acabado
                    $acabado_1UnidadVentaNombre=ucwords(strtolower($acabado_1Array->unv)); //Nombre unidad de venta
                    $acabado_1Valor=$acabado_1Array->valor_venta; // ej: 52
                    $acabado_1MedidaMasValorVenta=($tamano1*$tamano2*$acabado_1Valor)/10000; // (ancho x largo x valor venta) /10000									
                    $acabado_1CostoFijo=$acabado_1Array->costo_fijo;		
                    if ($acabado_1Array->unidad_de_venta == '1') //mt2
                    {
                        $acabado_1Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                        $precio_total_1=$acabado_1Unitario*$acabado_1MedidaMasValorVenta;
                    }
                    if ($acabado_1Array->unidad_de_venta == '2') //kilos
                    {
                        if ($acabado_1Array->unidad_de_venta==2)
                        {
                            $kilos=$fotomecanica->input_variable_externo_1;
                            $acabado_1Unitario = $acabado_1Valor;
                            $precio_total_1 = ($kilos*$acabado_1Valor);
                        }
                        else $precio_total_1="0 kilos";
                    }
                    if ($acabado_1Array->unidad_de_venta == '3') //cm2
                    {
                        $acabado_1Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                        $precio_total_1=$acabado_1Unitario*(($tamano1*$tamano2*$acabado_1Valor)/1000000);                        
                    }                    
                    if ($acabado_1Array->unidad_de_venta == '4') //por pasada o golpe
                    {
                        $acabado_1Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                        $precio_total_1=$acabado_1Unitario*$acabado_1Valor;
                    }									
                }

                if($fotomecanica->acabado_impresion_2!="16")
                {
                    $acabado_2Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_2);
//                    print_r($acabado_2Array);
                    $acabado_2=ucwords(strtolower($acabado_2Array->caracteristicas));
                    $acabado_2UnidadVentaNombre=ucwords(strtolower($acabado_2Array->unv)); //Nombre unidad de venta
                    $acabado_2Valor=$acabado_2Array->valor_venta; // ej: 52
                    $acabado_2MedidaMasValorVenta=($tamano1*$tamano2*$acabado_2Valor)/10000; // (ancho x largo x valor venta) /10000									
                    $acabado_2CostoFijo=$acabado_2Array->costo_fijo;		
                    if ($acabado_2Array->unidad_de_venta == '1') //mt2
                    {
                        $acabado_2Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                        $precio_total_2=$acabado_2Unitario*$acabado_2MedidaMasValorVenta;
                    }
                    if ($acabado_2Array->unidad_de_venta == '2') //kilos
                    {
                        if ($acabado_2Array->unidad_de_venta==2)
                        {
                            $kilos=$fotomecanica->input_variable_externo_2;
                            $acabado_2Unitario = $acabado_2Valor;
                            $precio_total_2 = ($kilos*$acabado_2Valor);
                        }
                        else $precio_total_2="0 kilos";
                    }
                    if ($acabado_2Array->unidad_de_venta == '3') //cm2
                    {
                        $acabado_2Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                        $precio_total_2=$acabado_2Unitario*(($tamano1*$tamano2*$acabado_2Valor)/1000000);                        
                    }                    
                    if ($acabado_2Array->unidad_de_venta == '4') //por pasada o golpe
                    {
                        $acabado_2Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                        $precio_total_2=$acabado_2Unitario*$acabado_2Valor;
                    }	
                }    
                if($fotomecanica->acabado_impresion_3!="16")
                {
                    $acabado_3Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_3);
                    $acabado_3=ucwords(strtolower($acabado_3Array->caracteristicas));
                    $acabado_3UnidadVentaNombre=ucwords(strtolower($acabado_3Array->unv)); //Nombre unidad de venta
                    $acabado_3Valor=$acabado_3Array->valor_venta; // ej: 52
                    $acabado_3CostoFijo=$acabado_3Array->costo_fijo;		
                    if ($acabado_3Array->unidad_de_venta == '1') //mt2
                    {
                        $acabado_3Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                        $precio_total_3=$acabado_3Unitario*$acabado_3MedidaMasValorVenta;
                    }
                    if ($acabado_3Array->unidad_de_venta == '2') //kilos
                    {
                        if ($acabado_3Array->unidad_de_venta==2)
                        {
                            $kilos=$fotomecanica->input_variable_externo_3;
                            $acabado_3Unitario = $acabado_3Valor;
                            $precio_total_3 = ($kilos*$acabado_3Valor);
                        }
                        else $precio_total_3="0 kilos";
                    }
                    if ($acabado_3Array->unidad_de_venta == '3') //cm2
                    {
                        $acabado_3Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                        $precio_total_3=$acabado_3Unitario*(($tamano1*$tamano2*$acabado_3Valor)/1000000);                        
                    }                    
                    if ($acabado_3Array->unidad_de_venta == '4') //por pasada o golpe
                    {
                        $acabado_3Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                        $precio_total_3=$acabado_3Unitario*$acabado_3Valor;
                    }	

                }           
                if ($fotomecanica->acabado_impresion_1!="17")
                {
               ?>
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $acabado_1?></td>
                        <td class="celda_5">&nbsp;<?php echo $acabado_1UnidadVentaNombre?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano1;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano2;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php echo $acabado_1Unitario;?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $acabado_1UnidadVentaNombre?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo number_format($acabado_1Valor,0,'','.');?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <?php if($hoja->valor_acabado_1 == '0' || sizeof($hoja) == 0) { ?>                        
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_1,0,'','.'); ?>&nbsp;</td>
                        <?php } else { ?>
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_1,0,'','.'); ?>&nbsp;</td></td>
                        <?php }  ?>                    
                        <td class="celda_3"></td>
                        <?php  if($fotomecanica->acabado_impresion_1 !="17") { ?>
                            <td><?php if($hoja->valor_acabado_1 != '0'){echo $hoja->valor_acabado_1;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_1?>" /></td>
                        <?php } else { ?>
                            <td class="celda_3">0</td>
                        <?php }  ?>                              
                </tr>
                <?php }     
                if ($fotomecanica->acabado_impresion_2!="17")
                {
               ?>           
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $acabado_2?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;<?php echo $acabado_2UnidadVentaNombre;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano1;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano2;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php echo $acabado_2Unitario;?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $acabado_2UnidadVentaNombre?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo number_format($acabado_2Valor,0,'','.');?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <?php if($hoja->valor_acabado_2 == '0' || sizeof($hoja) == 0) { ?>                        
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_2,0,'','.'); ?>&nbsp;</td>
                        <?php } else { ?>
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_2,0,'','.'); ?>&nbsp;</td>
                        <?php }  ?>                    
                        <td class="celda_3"></td>
                        <?php  if($fotomecanica->acabado_impresion_2 !="17") { ?>
                            <td><?php if($hoja->valor_acabado_2 != '0'){echo $hoja->valor_acabado_2;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_2?>" /></td>
                        <?php } else { ?>
                            <td class="celda_3">0</td>
                        <?php }  ?>                              
                </tr>                
                <?php }     
                if ($fotomecanica->acabado_impresion_3!="17")
                {
               ?>   
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $acabado_3?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;<?php echo $acabado_3UnidadVentaNombre;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano1;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano2;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php echo $acabado_3Unitario;?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $acabado_3UnidadVentaNombre;?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><?php echo number_format($acabado_3Valor,0,'','.');?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <?php if($hoja->valor_acabado_3 == '0' || sizeof($hoja) == 0) { ?>                        
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_3,0,'','.'); ?>&nbsp;</td>
                        <?php } else { ?>
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_3,0,'','.'); ?>&nbsp;</td></td>
                        <?php }  ?>                    
                        <td class="celda_3"></td>
                        <?php  if($fotomecanica->acabado_impresion_3 !="17") { ?>
                            <td><?php if($hoja->valor_acabado_3 != '0'){echo $hoja->valor_acabado_3;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_3?>" /></td>
                        <?php } else { ?>
                            <td class="celda_3">0</td>
                        <?php }  ?>                              
                </tr>                  
                <?php }  ?>                     
                  <!--/trabajos externos--> 

               <tr>
                        <td class="celda_5" colspan="16" bgcolor="#D4D1D1">Trabajos Externos</td>
               </tr>     
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;</td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;Unidad&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;Ancho&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;Largo&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;Cantidad&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Medida&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Unitario&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Total&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Empresa&nbsp;</td>
                    </tr>                        
                        <?php
				if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="No Lleva1";
                                    $acabado_4Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_4Unitario="&nbsp;";
                                    $acabado_4UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
//                                    print_r($acabado_4Array);
                                    $acabado_4=ucwords(strtolower($acabado_4Array->caracteristicas)); // Nombre acabado
                                    $acabado_4UnidadVentaNombre=ucwords(strtolower($acabado_4Array->unv)); //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;		
                                    if ($acabado_4Array->unidad_de_venta == '1') //mt2
                                    {
                                        $acabado_4Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                                        $precio_total_4=$acabado_4Unitario*$acabado_4MedidaMasValorVenta;
                                    }
                                    if ($acabado_4Array->unidad_de_venta == '2') //kilos
                                    {
                                        if ($acabado_4Array->unidad_de_venta==2)
                                        {
                                            $kilos=$fotomecanica->input_variable_externo_4;
                                            $acabado_4Unitario = $acabado_4Valor;
                                            $precio_total_4 = ($kilos*$acabado_4Valor);
                                        }
                                        else $precio_total_4="0 kilos";
                                    }
                                    if ($acabado_4Array->unidad_de_venta == '3') //cm2
                                    {
                                        $acabado_4Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                                        $precio_total_4=$acabado_4Unitario*(($tamano1*$tamano2*$acabado_4Valor)/1000000);                        
                                    }                    
                                    if ($acabado_4Array->unidad_de_venta == '4') //por pasada o golpe
                                    {
                                        $acabado_4Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                                        $precio_total_4=$acabado_4Unitario*$acabado_4Valor;
                                    }                            
                                }
								
                                if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="No Lleva";
                                    $acabado_5Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_5Unitario="&nbsp;";
                                    $acabado_5UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
//                                    print_r($acabado_5Array);
                                    $acabado_5=ucwords(strtolower($acabado_5Array->caracteristicas));
                                    $acabado_5UnidadVentaNombre=ucwords(strtolower($acabado_5Array->unv)); //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                    if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $acabado_5Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                                        $precio_total_5=$acabado_5Unitario*$acabado_5MedidaMasValorVenta;
                                    }
                                    if ($acabado_5Array->unidad_de_venta == '2') //kilos
                                    {
                                        if ($acabado_5Array->unidad_de_venta==2)
                                        {
                                            $kilos=$fotomecanica->input_variable_externo_5;
                                            $acabado_5Unitario = $acabado_5Valor;
                                            $precio_total_5 = ($kilos*$acabado_5Valor);
                                        }
                                        else $precio_total_5="0 kilos";
                                    }
                                    if ($acabado_5Array->unidad_de_venta == '3') //cm2
                                    {
                                        $acabado_5Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                                        $precio_total_5=$acabado_5Unitario*(($tamano1*$tamano2*$acabado_5Valor)/1000000);                        
                                    }                    
                                    if ($acabado_5Array->unidad_de_venta == '4') //por pasada o golpe
                                    {
                                        $acabado_5Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                                        $precio_total_5=$acabado_5Unitario*$acabado_5Valor;
                                    }
                                }    
                                if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="No Lleva";
                                    $acabado_6Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_6Unitario="&nbsp;";
                                    $acabado_6UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
//                                    print_r($acabado_6Array);
                                    $acabado_6=ucwords(strtolower($acabado_6Array->caracteristicas));
                                    $acabado_6UnidadVentaNombre=ucwords(strtolower($acabado_6Array->unv)); //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $acabado_6Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                                        $precio_total_6=$acabado_6Unitario*$acabado_6MedidaMasValorVenta;
                                    }
                                    if ($acabado_6Array->unidad_de_venta == '2') //kilos
                                    {
                                        if ($acabado_6Array->unidad_de_venta==2)
                                        {
                                            $kilos=$fotomecanica->input_variable_externo_4;
                                            $acabado_6Unitario = $acabado_6Valor;
                                            $precio_total_6 = ($kilos*$acabado_6Valor);
                                        }
                                        else $precio_total_6="0 kilos";
                                    }
                                    if ($acabado_6Array->unidad_de_venta == '3') //cm2
                                    {
                                        $acabado_6Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                                        $precio_total_6=$acabado_6Unitario*(($tamano1*$tamano2*$acabado_6Valor)/1000000);                        
                                    }                    
                                    if ($acabado_6Array->unidad_de_venta == '4') //por pasada o golpe
                                    {
                                        $acabado_6Unitario=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                                        $precio_total_6=$acabado_6Unitario*$acabado_6Valor;
                                    }
                                }  
                if ($fotomecanica->acabado_impresion_4!="17")
                {
               ?>
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $acabado_4?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;<?php echo $acabado_4UnidadVentaNombre;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano1;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano2;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php echo $acabado_4Unitario;?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $acabado_4UnidadVentaNombre?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><?php echo number_format($acabado_4Valor,0,'','.');?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <?php if($hoja->valor_acabado_1 == '0' || sizeof($hoja) == 0) { ?>                        
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_4,0,'','.'); ?>&nbsp;</td>
                        <?php } else { ?>
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_4,0,'','.');?>&nbsp;</td></td>
                        <?php }  ?>                    
                        <td class="celda_3"></td>
                        <?php  if($fotomecanica->acabado_impresion_4 !="17") { ?>
                            <td><?php if($hoja->valor_acabado_1 != '0'){echo $hoja->valor_acabado_1;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_1?>" /></td>
                        <?php } else { ?>
                            <td class="celda_3">0</td>
                        <?php }  ?>                              
                </tr>
                <?php }     
                if ($fotomecanica->acabado_impresion_5!="17")
                {
               ?>           
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $acabado_5?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;<?php echo $acabado_5UnidadVentaNombre;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano1;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano2;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php echo $acabado_5Unitario;?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $acabado_5UnidadVentaNombre?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><?php echo number_format($acabado_5Valor,0,'','.');?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <?php if($hoja->valor_acabado_2 == '0' || sizeof($hoja) == 0) { ?>                        
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_5,0,'','.'); ?>&nbsp;</td>
                        <?php } else { ?>
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_5,0,'','.'); ?>&nbsp;</td></td>
                        <?php }  ?>                    
                        <td class="celda_3"></td>
                        <?php  if($fotomecanica->acabado_impresion_5 !="17") { ?>
                            <td><?php if($hoja->valor_acabado_2 != '0'){echo $hoja->valor_acabado_2;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_2?>" /></td>
                        <?php } else { ?>
                            <td class="celda_3">0</td>
                        <?php }  ?>                              
                </tr>                
                <?php }     
                if ($fotomecanica->acabado_impresion_6!="17")
                {
               ?>   
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $acabado_6?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;<?php echo $acabado_6UnidadVentaNombre;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano1;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $tamano2;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php echo $acabado_6Unitario;?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $acabado_6UnidadVentaNombre?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><?php echo number_format($acabado_6Valor,0,'','.');?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <?php if($hoja->valor_acabado_3 == '0' || sizeof($hoja) == 0) { ?>                        
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_6,0,'','.'); ?>&nbsp;</td>
                        <?php } else { ?>
                            <td class="celda_3">&nbsp;<?php echo number_format($precio_total_6,0,'','.'); ?>&nbsp;</td></td>
                        <?php }  ?>                    
                        <td class="celda_3"></td>
                        <?php  if($fotomecanica->acabado_impresion_6 !="17") { ?>
                            <td><?php if($hoja->valor_acabado_3 != '0'){echo $hoja->valor_acabado_3;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_3?>" /></td>
                        <?php } else { ?>
                            <td class="celda_3">0</td>
                        <?php }  ?>                              
                </tr>                  
                <?php }  ?>                     
                  
                    
               <tr>
                        <td class="celda_5" colspan="16" bgcolor="#D4D1D1">Procesos Especiales</td>
               </tr>     
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;</td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;Ancho&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;Largo&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;Tipo&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Precio&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Cantidad&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Total&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Empresa&nbsp;</td>
                    </tr>                        
                        <?php   
				if($fotomecanica->folia1_proceso_seletec=="0")
                                {
                                    $acabado_4="No Lleva1";
                                    $acabado_4Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_4Unitario="&nbsp;";
                                    $acabado_4UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $proceso_especial_1Array=$this->procesos_especiales_model->getProcesosEspecialesEdit($fotomecanica->folia1_proceso_seletec);
                                    $proceso_especial_1Nombre=ucwords(strtolower($proceso_especial_1Array->nombre_procesp)); // Nombre acabado
//                                    $proceso_especial_1UnidadVentaNombre=ucwords(strtolower($acabado_4Array->unv)); //Nombre unidad de venta
                                    $proceso_especial_1Ancho=$proceso_especial_1Array->ancho; // ej: 52
                                    $proceso_especial_1Largo=$proceso_especial_1Array->largo; // ej: 52                                    
                                    $proceso_especial_1Tipo=$proceso_especial_1Array->tipo; // ej: 52    
                                    $proceso_especial_1Precio=$proceso_especial_1Array->precio; // ej: 52    
                                }
								
                                if($fotomecanica->folia2_proceso_seletec=="0")
                                {
                                    $acabado_5="No Lleva";
                                    $acabado_5Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_5Unitario="&nbsp;";
                                    $acabado_5UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $proceso_especial_2Array=$this->procesos_especiales_model->getProcesosEspecialesEdit($fotomecanica->folia2_proceso_seletec);
                                    $proceso_especial_2Nombre=ucwords(strtolower($proceso_especial_2Array->nombre_procesp)); // Nombre acabado
//                                    $proceso_especia2_1UnidadVentaNombre=ucwords(strtolower($acabado_4Array->unv)); //Nombre unidad de venta
                                    $proceso_especial_2Ancho=$proceso_especial_2Array->ancho; // ej: 52
                                    $proceso_especial_2Largo=$proceso_especial_2Array->largo; // ej: 52                                    
                                    $proceso_especial_2Tipo=$proceso_especial_2Array->tipo; // ej: 52    
                                    $proceso_especial_2Precio=$proceso_especial_2Array->precio; // ej: 52    
                                }    
                                if($fotomecanica->folia3_proceso_seletec=="0")
                                {
                                    $acabado_6="No Lleva";
                                    $acabado_6Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_6Unitario="&nbsp;";
                                    $acabado_6UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $proceso_especial_3Array=$this->procesos_especiales_model->getProcesosEspecialesEdit($fotomecanica->folia3_proceso_seletec);
                                    $proceso_especial_3Nombre=ucwords(strtolower($proceso_especial_3Array->nombre_procesp)); // Nombre acabado
//                                    $proceso_especia2_1UnidadVentaNombre=ucwords(strtolower($acabado_4Array->unv)); //Nombre unidad de venta
                                    $proceso_especial_3Ancho=$proceso_especial_3Array->ancho; // ej: 52
                                    $proceso_especial_3Largo=$proceso_especial_3Array->largo; // ej: 52                                    
                                    $proceso_especial_3Tipo=$proceso_especial_3Array->tipo; // ej: 52    
                                    $proceso_especial_3Precio=$proceso_especial_3Array->precio; // ej: 52  
                                }  
                                if($fotomecanica->cuno1_proceso_seletec=="0")
                                {
                                    $acabado_6="No Lleva";
                                    $acabado_6Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_6Unitario="&nbsp;";
                                    $acabado_6UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $proceso_especial_4Array=$this->procesos_especiales_model->getProcesosEspecialesEdit($fotomecanica->cuno1_proceso_seletec);
                                    $proceso_especial_4Nombre=ucwords(strtolower($proceso_especial_4Array->nombre_procesp)); // Nombre acabado
//                                    $proceso_especia2_1UnidadVentaNombre=ucwords(strtolower($acabado_4Array->unv)); //Nombre unidad de venta
                                    $proceso_especial_4Ancho=$proceso_especial_4Array->ancho; // ej: 52
                                    $proceso_especial_4Largo=$proceso_especial_4Array->largo; // ej: 52                                    
                                    $proceso_especial_4Tipo=$proceso_especial_4Array->tipo; // ej: 52    
                                    $proceso_especial_4Precio=$proceso_especial_4Array->precio; // ej: 52  
                                }  
                                if($fotomecanica->cuno2_proceso_seletec=="0")
                                {
                                    $acabado_6="No Lleva";
                                    $acabado_6Valor="&nbsp;";
                                    $acabado_4MedidaMasValorVenta="&nbsp;";
                                    $acabado_6Unitario="&nbsp;";
                                    $acabado_6UnidadVentaNombre="&nbsp;";
                                }else
                                {
                                    $proceso_especial_5Array=$this->procesos_especiales_model->getProcesosEspecialesEdit($fotomecanica->cuno2_proceso_seletec);
                                    $proceso_especial_5Nombre=ucwords(strtolower($proceso_especial_5Array->nombre_procesp)); // Nombre acabado
//                                    $proceso_especia2_1UnidadVentaNombre=ucwords(strtolower($acabado_4Array->unv)); //Nombre unidad de venta
                                    $proceso_especial_5Ancho=$proceso_especial_5Array->ancho; // ej: 52
                                    $proceso_especial_5Largo=$proceso_especial_5Array->largo; // ej: 52                                    
                                    $proceso_especial_5Tipo=$proceso_especial_5Array->tipo; // ej: 52    
                                    $proceso_especial_5Precio=$proceso_especial_5Array->precio; // ej: 52  
                                }                                  
                if ($fotomecanica->folia1_proceso_seletec!="0")
                {
               ?>
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $proceso_especial_1Nombre?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_1Ancho;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_1Largo;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php if(($proceso_especial_1Tipo=='1') && ($proceso_especial_1Tipo!='')) echo "Oro"; elseif (($proceso_especial_1Tipo=='2') && ($proceso_especial_1Tipo!='')) echo "Plata"; elseif (($proceso_especial_1Tipo=='3') && ($proceso_especial_1Tipo!='')) echo "Cobre";?>&nbsp;</td>
                        <td class="celda_3">&nbsp;&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="5" value="<?php echo $proceso_especial_1Precio; ?>" /></td>                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="0" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $proceso_especial_1Precio ?>&nbsp;</td>
                        <td class="celda_3"></td>
                        <td><?php if($hoja->valor_acabado_1 != '0'){echo $hoja->valor_acabado_1;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_1?>" /></td>
                </tr>
                <?php }     
                if ($fotomecanica->folia2_proceso_seletec!="0")
                {
               ?>           
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $proceso_especial_2Nombre?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_2Ancho;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_2Largo;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php if(($proceso_especial_2Tipo=='1') && ($proceso_especial_2Tipo!='')) echo "Oro"; elseif (($proceso_especial_2Tipo=='2') && ($proceso_especial_2Tipo!='')) echo "Plata"; elseif (($proceso_especial_2Tipo=='3') && ($proceso_especial_2Tipo!='')) echo "Cobre";?>&nbsp;</td>
                        <td class="celda_3">&nbsp;&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="5" value="<?php echo $proceso_especial_2Precio; ?>" /></td>                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="0" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $proceso_especial_2Precio ?>&nbsp;</td>
                        <td class="celda_3"></td>
                        <td><?php if($hoja->valor_acabado_1 != '0'){echo $hoja->valor_acabado_1;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_1?>" /></td>
                </tr>               
                <?php }     
                if ($fotomecanica->folia3_proceso_seletec!="0")
                {
               ?>   
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $proceso_especial_3Nombre?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_3Ancho;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_3Largo;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php if(($proceso_especial_3Tipo=='1') && ($proceso_especial_3Tipo!='')) echo "Oro"; elseif (($proceso_especial_3Tipo=='2') && ($proceso_especial_3Tipo!='')) echo "Plata"; elseif (($proceso_especial_3Tipo=='3') && ($proceso_especial_3Tipo!='')) echo "Cobre";?>&nbsp;</td>
                        <td class="celda_3">&nbsp;&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="5" value="<?php echo $proceso_especial_3Precio; ?>" /></td>                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="0" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $proceso_especial_3Precio ?>&nbsp;</td>
                        <td class="celda_3"></td>
                        <td><?php if($hoja->valor_acabado_1 != '0'){echo $hoja->valor_acabado_1;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_1?>" /></td>
                </tr>               
                <?php }     
                if ($fotomecanica->cuno1_proceso_seletec!="0")
                {
               ?>   
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $proceso_especial_4Nombre?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_4Ancho;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_4Largo;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php if(($proceso_especial_4Tipo=='1') && ($proceso_especial_4Tipo!='')) echo "Oro"; elseif (($proceso_especial_4Tipo=='2') && ($proceso_especial_4Tipo!='')) echo "Plata"; elseif (($proceso_especial_4Tipo=='3') && ($proceso_especial_4Tipo!='')) echo "Cobre";?>&nbsp;</td>
                        <td class="celda_3">&nbsp;&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="5" value="<?php echo $proceso_especial_4Precio; ?>" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="0" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $proceso_especial_4Precio ?>&nbsp;</td>
                        <td class="celda_3"></td>
                        <td><?php if($hoja->valor_acabado_1 != '0'){echo $hoja->valor_acabado_1;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_1?>" /></td>
                </tr>  
                <?php }     
                if ($fotomecanica->cuno2_proceso_seletec!="0")
                {
               ?>   
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $proceso_especial_5Nombre?></td>
                        <!--<td class="celda_5">&nbsp;</td>-->
                        <td class="celda_5">&nbsp;&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_5Ancho;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $proceso_especial_5Largo;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php if(($proceso_especial_5Tipo=='1') && ($proceso_especial_5Tipo!='')) echo "Oro"; elseif (($proceso_especial_5Tipo=='2') && ($proceso_especial_5Tipo!='')) echo "Plata"; elseif (($proceso_especial_5Tipo=='3') && ($proceso_especial_5Tipo!='')) echo "Cobre";?>&nbsp;</td>
                        <td class="celda_3">&nbsp;&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="5" value="<?php echo $proceso_especial_5Precio; ?>" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="0" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $proceso_especial_5Precio ?>&nbsp;</td>
                        <td class="celda_3"></td>
                        <td><?php if($hoja->valor_acabado_1 != '0'){echo $hoja->valor_acabado_1;} ?><a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acabado_1" value="<?php echo $hoja->valor_acabado_1?>" /></td>
                </tr>                  
                <?php }  ?>                                                
                                            
               <tr>
                        <td class="celda_5" colspan="16" bgcolor="#D4D1D1">Piezas Adicionales</td>
               </tr>     
               <tr>
                        <td class="celda_5"></td>
                        <td class="celda_5">&nbsp;Medida&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;Uso&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;Compra&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;Conversión&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Cálculo&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Venta&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Total&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;Empresa&nbsp;</td>
                    </tr>                        
                        <?php
				if($ing->piezas_adicionales=="")
                                {
                                    $piezas_adicionales_descripcion=""; 
                                    $piezas_adicionales_unidad_de_medida=""; 
                                    $piezas_adicionales_unidad_de_uso=""; 
                                    $piezas_adicionales_unidad_de_compra="";                                     
                                    $piezas_adicionales_unidad_de_conversion="";                                        
                                    $piezas_adicionales_calculo_ingenieria=""; 
                                }else
                                {
                                    $piezas_adicionales_Array=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive($ing->piezas_adicionales);
                                    $piezas_adicionales_descripcion=ucwords(strtolower($piezas_adicionales_Array->piezas_adicionales)); 
                                    $piezas_adicionales_unidad_de_medida=$piezas_adicionales_Array->unidad_de_medida; 
                                    $piezas_adicionales_unidad_de_uso=$piezas_adicionales_Array->unidad_de_uso; 
                                    $piezas_adicionales_unidad_de_compra=$piezas_adicionales_Array->unidad_de_compra;                                
                                    $piezas_adicionales_unidad_de_conversion=$piezas_adicionales_Array->unidad_de_conversion;                                           
                                    $piezas_adicionales_calculo_ingenieria=$piezas_adicionales_Array->calculo_ingenieria;                                         
                                }
								
				if($ing->piezas_adicionales2=="")
                                {
                                    $piezas_adicionales_descripcion2=""; 
                                    $piezas_adicionales_unidad_de_medida2=""; 
                                    $piezas_adicionales_unidad_de_uso2=""; 
                                    $piezas_adicionales_unidad_de_compra2="";                                     
                                    $piezas_adicionales_unidad_de_conversion2="";                                        
                                    $piezas_adicionales_calculo_ingenieria2=""; 
                                }else
                                {
                                    $piezas_adicionales_Array2=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive($ing->piezas_adicionales2);
                                    $piezas_adicionales_descripcion2=ucwords(strtolower($piezas_adicionales_Array2->piezas_adicionales)); 
                                    $piezas_adicionales_unidad_de_medida2=$piezas_adicionales_Array2->unidad_de_medida; 
                                    $piezas_adicionales_unidad_de_uso2=$piezas_adicionales_Array2->unidad_de_uso; 
                                    $piezas_adicionales_unidad_de_compra2=$piezas_adicionales_Array2->unidad_de_compra;                                
                                    $piezas_adicionales_unidad_de_conversion2=$piezas_adicionales_Array2->unidad_de_conversion;                                           
                                    $piezas_adicionales_calculo_ingenieria2=$piezas_adicionales_Array2->calculo_ingenieria;                                         
                                } 
				if($ing->piezas_adicionales3=="")
                                {
                                    $piezas_adicionales_descripcion3=""; 
                                    $piezas_adicionales_unidad_de_medida3=""; 
                                    $piezas_adicionales_unidad_de_uso3=""; 
                                    $piezas_adicionales_unidad_de_compra3="";                                     
                                    $piezas_adicionales_unidad_de_conversion3="";                                        
                                    $piezas_adicionales_calculo_ingenieria3=""; 
                                }else
                                {
                                    $piezas_adicionales_Array3=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive($ing->piezas_adicionales3);
                                    $piezas_adicionales_descripcion3=ucwords(strtolower($piezas_adicionales_Array3->piezas_adicionales)); 
                                    $piezas_adicionales_unidad_de_medida3=$piezas_adicionales_Array3->unidad_de_medida; 
                                    $piezas_adicionales_unidad_de_uso3=$piezas_adicionales_Array3->unidad_de_uso; 
                                    $piezas_adicionales_unidad_de_compra3=$piezas_adicionales_Array3->unidad_de_compra;                                
                                    $piezas_adicionales_unidad_de_conversion3=$piezas_adicionales_Array3->unidad_de_conversion;                                           
                                    $piezas_adicionales_calculo_ingenieria3=$piezas_adicionales_Array3->calculo_ingenieria;                                         
                                }
                if ($ing->piezas_adicionales!="")
                {
               ?>
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $piezas_adicionales_descripcion; ?></td>
                        <td class="celda_5">&nbsp;unidad</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $piezas_adicionales_unidad_de_medida;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $piezas_adicionales_unidad_de_uso;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php echo $piezas_adicionales_unidad_de_compra?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $piezas_adicionales_unidad_de_conversion?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="<?php echo $piezas_adicionales_calculo_ingenieria; ?>" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="<?php echo $piezas_adicionales_calculo_ingenieria; ?>" />&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="<?php echo $piezas_adicionales_calculo_ingenieria; ?>" /></td>                 
                              
                </tr>
                 <?php }  ?>                 
                <?php 
                if ($ing->piezas_adicionales2!="")
                {
               ?>           
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $piezas_adicionales_descripcion2; ?></td>
                        <td class="celda_5">&nbsp;unidad</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $piezas_adicionales_unidad_de_medida2;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $piezas_adicionales_unidad_de_uso2;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php echo $piezas_adicionales_unidad_de_compra2?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $piezas_adicionales_unidad_de_conversion2?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="<?php echo $piezas_adicionales_calculo_ingenieria2; ?>" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="<?php echo $piezas_adicionales_calculo_ingenieria2; ?>" />&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="<?php echo $piezas_adicionales_calculo_ingenieria2; ?>" /></td>                                
                </tr>                
                <?php }     
                if ($ing->piezas_adicionales3!="")
                {
               ?>   
               <tr>
                        <td class="celda_5">&nbsp;&nbsp;<?php echo $piezas_adicionales_descripcion3; ?></td>
                        <td class="celda_5">&nbsp;unidad</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $piezas_adicionales_unidad_de_medida3;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>
                        <td class="celda_5">&nbsp;<?php echo $piezas_adicionales_unidad_de_uso3;?>&nbsp;</td>
                        <td class="celda_5">&nbsp;</td>												
                        <td class="celda_3">&nbsp;<?php echo $piezas_adicionales_unidad_de_compra3?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3">&nbsp;<?php echo $piezas_adicionales_unidad_de_conversion3?>&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="<?php echo $piezas_adicionales_calculo_ingenieria3; ?>" /></td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="<?php echo $piezas_adicionales_calculo_ingenieria3; ?>" />&nbsp;</td>
                        <td class="celda_3">&nbsp;</td>
                        <td class="celda_3"><input type="text" name="" size="3" value="<?php echo $piezas_adicionales_calculo_ingenieria3; ?>" /></td>                                
                </tr>                  
                <?php }  ?>                                                
                                            
                </table>
                                                           
                    </div>                           
                    <div class="separador_10"></div>
                    <div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">MAT.PRIMAS</td>
                                <td class="celda_3">CANT/PLIEGO</td>
                                <td class="celda_3">VALOR $</td>
                                <td class="celda_3">PRODUCCIÓN</td>
                                <td class="celda_3">UNITARIO</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="6"><hr class="hr_punteada" /></td>
                            </tr>
                        <?php
                            $costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							
                             if(sizeof($hoja)>=1 and $hoja->fecha)
                            {
                                $arreglo5=array
                                (
                                    "placa_kilo"=>$costoPlacaKilo,
                                    "total_pliegos"=>$valorPlacaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo5);
                            }
							
							
							
							 if(sizeof($hoja)>=1)
                            {
                                $arreglokilo1=array
                                (
                                    "kilos_placa"=>$valorPlacaKilo,
                                 
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo1);
                            }
                        ?>
                        <tr>
                                <td class="celda_3">TAPA KILO  :<?php echo number_format($valorPlacaKilo,0,'','.');/*echo $sum;*/?></td>
                                <td class="celda_3"><?php echo number_format($costoPlacaKilo,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($totalPlacaKilo,0,'','.')?></td>
                                <td class="celda_3 valign_top padding_left_10" colspan="3" rowspan="30">
                                    <!--producción-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td class="celda_33">TIRAJE</td>
                                            <td class="celda_33"><?php echo $factor_rango?></td>
                                            <td class="celda_33"><?php echo number_format($tiraje,0,'','.')?></td>
                                        </tr>
                                  <?php
                                  $variableComplemento=$this->variables_cotizador_model->getVariablesCotizadorPorId(32);
                                        $valorTiraje=$variableComplemento->precio-$tiraje;
										
                                        if($valorTiraje>0)
                                        {
											if($fotomecanica->colores == 0)
											{
												$complemento=0;
											}else{
											 $complemento=$valorTiraje;	
											}
                                            
											
                                        }else
                                        {
                                            $complemento=0;
                                        }
                                  ?>  
								  
								  
								  <?php
								  
								  
								   // $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_1;
								  
								  if($hoja->valor_acabado_1 >= 1 )
								  {
									  $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_1;
								  }else
								  {
									  $externos_produccion = $externos_produccion +(($acabado_4Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
								  }
								  
						      	  if($hoja->valor_acabado_2 >= 1 )
								  {
									    $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_2;
								  }else
								  {
									  $externos_produccion = $externos_produccion + (($acabado_5Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
								  }
								  if($hoja->valor_acabado_3 >= 1 )
								  {
									  $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_3;
								  }else
								  {
									  $externos_produccion = $externos_produccion + (($acabado_6Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
								  }
										
								  
								  ?>
								  
                    <tr>
                                            <td class="celda_33">COMPLEMENTO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($complemento,0,'','.')?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">EXTERNOS</td>
                                            <td class="celda_33">&nbsp;</td>

                                            <td class="celda_33"><?php echo number_format($externos_produccion,0,'','.');?></td>
                                        </tr>
                    <?php
                    if($maquina=="Máquina Roland 800")
                                            {
                                                $costoOndaKilo=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                                                
                                            }else
                                            {
                                                $costoOndaKilo=(($datos->cantidad_1/$ing->unidades_por_pliego)+100)+4;
                                                
                                            }
											if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
											{
												$costoOndaKilo=0;
												$valorOndaKilo=0;
												$totalOndaKilo=0;
												$valorCorte=0;
										
											}else{
                                            $valorOndaKilo=($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000;
                                            $totalOndaKilo=$valorOndaKilo*$costo_kilo;
                                        $valorCorte=$costoOndaKilo*4.5;
											}
                    ?>
                    <tr>
                                            <td class="celda_33">CORTE</td>
                                            <td class="celda_33">4.5</td>
                                            <td class="celda_33"><?php echo number_format($valorCorte,0,'','.')?></td>
                                        </tr>
                    <?php
                     $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
                                        $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
                                        $totalEmplacado=$valorEmplacadado*$costoOndaKilo;
                    ?>
                    <tr>
                                            <td class="celda_33">EMPLACADO</td>
                                            <td class="celda_33"><?php echo $valorEmplacadado?></td>
                                            <td class="celda_33"><?php echo number_format($totalEmplacado,0,'','.')?></td>
                                        </tr>
                    <?php

						if($fotomecanica->estan_los_moldes == 'NO' or $fotomecanica->estan_los_moldes == 'SI')
						{
										$variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                                        $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                                        $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
						}elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
						{
										$variableMontajeMoldeTroquel=0;
                                        $totalMontajeMolde=0;
						}elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
						{
										$variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                                        $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                                        $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
						}
					
					
		
					
					                    //$variableMontajeMoldeTroquel=0;
                                        //$totalMontajeMolde=0;
										// and sizeof($orden)==0
									    //$variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                                        //$variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                                        //$totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                    ?>
                    <tr>
                                            <td class="celda_33">MONTAJE MOLDE</td>
                                            <td class="celda_33"><?php echo number_format($variableMontajeMoldeTroquel->precio,0,'','.')?></td>
                                            <td class="celda_33"><?php echo number_format($totalMontajeMolde,0,'','.')?></td>
                                        </tr>
                    <?php
						if($fotomecanica->estan_los_moldes == 'NO' or $fotomecanica->estan_los_moldes == 'SI')
						{
						   $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                           $totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
						}elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
						{
							$variableTroquelado=0;
							$totalTroquelado=0;
						}elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
						{
						   $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                           $totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
						}
							//$variableTroquelado=0;
							//$totalTroquelado=0;
											
							//$variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                           //$totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
										
                    ?>
                    <tr>
                                            <td class="celda_33">TROQUELADO</td>
                                            <td class="celda_33"><?php echo $variableTroquelado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalTroquelado,0,'','.')?></td>
                    </tr>
                    <?php
                    $variableDesgajado=$this->variables_cotizador_model->getVariablesCotizadorPorId(12);
                                        $totalDesgajado=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOndaKilo;
                    ?>
                    <tr>
                                            <td class="celda_33">DESGAJADO</td>
                                            <td class="celda_33"><?php echo $variableDesgajado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalDesgajado,0,'','.')?></td>
                    </tr>
                    <?php
                    $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                        $totalPegado=$datos->cantidad_1*$hoja->pegado*$variablePegado->precio;
                    ?>
                     <tr>
                                            <td class="celda_33">PEGADO</td>
                                            <td class="celda_33"><?php if($hoja->pegado == ''){echo '30';}else{echo $hoja->pegado;}?><a href="<?php echo base_url()?>hoja/pegado/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php echo $hoja->pegado?>" /></td>
                                            <td class="celda_33"><?php echo number_format($totalPegado,0,'','.')?></td>
											
											
                     </tr>
                     <?php
					 if(sizeof($hoja->pegado)>=1)
					 {
						 $divisionPegado=$hoja->pegado/2;
                                        $totalDespacho=$divisionPegado*$datos->cantidad_1;
					 }
					 else
					 {
					$divisionPegado=$presupuesto->costo_pegado/2;
                                        $totalDespacho=$divisionPegado*$datos->cantidad_1;	 
					 }
					 
					 
                     
                     ?>
                     <tr>
                                            <td class="celda_33">DESPACHO</td>
                                            <td class="celda_33"><?php echo $divisionPegado?></td>
                                            <td class="celda_33"><?php echo number_format($totalDespacho,0,'','.')?></td>
                     </tr>
                     <?php
					 
					 	
					 
					 //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
					 
                    if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
					{
                         if($fotomecanica->estan_los_moldes == 'NO')
						{
								$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                $moldeTroquel=$variableTroquel->precio;
						}elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
						{
						        $moldeTroquel=0;
						}elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
						{
								$moldeTroquel=0;
						}
                    }
					
					if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
					{
                
						        $moldeTroquel=0;
				
                    }					
				    
					if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
					{

						        $moldeTroquel=0;
				
                    }
					if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
					{
						        $moldeTroquel=0;
                    }
									   // $moldeTroquel=0;
									   
									   //$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                      //$moldeTroquel=$variableTroquel->precio;
                                            
									   
                     ?>
                     <tr>
                                            <td class="celda_33">MOLDE TROQUEL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($moldeTroquel,0,'','.');?></td>
                                            <!-- <td class="celda_33"><?php //if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo '0';}else{echo number_format($moldeTroquel,0,'','.');}?></td> -->
                     </tr>
					 <?php
					 $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(39);
					 if($fotomecanica->lleva_barniz == 'SI' and $fotomecanica->reserva_barniz == 'SI')
					 {
						 $otrosCaucho = $variableEmplacado->precio; 
					 }else
					 {
						$otrosCaucho = 0;
					 }
					 
					 ?>
					 <tr>
                                            <td class="celda_33">CAUCHO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($otrosCaucho,0,'','.');?></td>
                                            
                       
                     </tr>
					 <?php
					 if($piezaAdacionalEmpresa1 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa1;

					 }
					 else
					 {
						 	$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal1;
						 
					 }
					 
					  if($piezaAdacionalEmpresa2 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa2;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal2;
						 
					 }
					 
					 
					  if( $piezaAdacionalEmpresa3 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa3;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal3;
						 
					 }
					 
					// $TotalPiezasAdicionales = $piezaAdacionalTotal1 + $piezaAdacionalTotal2 + $piezaAdacionalTotal3;
					 ?>
					 <tr>
                                            <td class="celda_33">PIEZAS ADICIONALES</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($TotalPiezasAdicionales,0,'','.');?></td>
                                            
                       
                     </tr>

                                            <td class="celda_33" colspan="3"><hr class="hr_punteada" /></td>
                     </tr>
                     <?php
                     $totalProduccion=$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales;
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalProduccion,0,'','.')?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33" colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33"><span class="subrayado">COSTOS VARIOS</span></td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                     </tr>
                     <?php
                      //$totalMateriaPrima    
                                        $costoVentaValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO VENTA</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($costoVentaValor,0,'','.')?></td>
                     </tr>
                     <?php
                      $costoAdministracionValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoAdministracion->precio)/100;
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO ADMINISTRACIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($costoAdministracionValor,0,'','.')?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo $hoja->costo_adicional?><a href="<?php echo base_url()?>hoja/costo_adicional/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="costo_adicional" value="<?php echo $hoja->costo_adicional?>" /></td>
                     </tr>
                     <?php
                      $totalCostosVarios=$costoAdministracionValor+$costoVentaValor+$hoja->costo_adicional;
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL COSTOS VARIOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalCostosVarios,0,'','.')?></td>
                                        </tr>
                                    </table>
                                    <!--/producción-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <?php
                            if(sizeof($hoja)>=1)
                            {
                                $arreglo6=array
                                (
                                    "onda_kilo"=>$costoOndaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo6);
                            }
							
							
							
                            ?>
                      <tr>
					  <?php
								if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									
									
							//$costoPlacaKilo2=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
							$costoPlacaKilo2 = ($datos->cantidad_1/$ing->unidades_por_pliego);
                            
							
							$dos_por_ciento = ($costoPlacaKilo2 / 100)* 2;
							
							if($costoPlacaKilo2 >= 1 and $costoPlacaKilo2 <= 100)
							{
								$agregado_a_apliegos = 100;
							}
							
							if($costoPlacaKilo2 > 100)
							{
								$agregado_a_apliegos = $dos_por_ciento;
							}
							$costoPlacaKilo2 = $costoPlacaKilo2 + $agregado_a_apliegos;
							$valorPlacaKilo2 = ($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje2)/10000000;
                            $totalPlacaKilo2 = $valorPlacaKilo2*$tapaPrecio2;
							
					  ?>
										<td class="celda_3">TAPA KILO (RESPALDO):<?php echo number_format($valorPlacaKilo2,0,'','.');?></td>
										<td class="celda_3"><?php echo number_format($costoPlacaKilo2,0,'','.')?></td>
										<td class="celda_3"><?php echo number_format($totalPlacaKilo2,0,'','.')?></td>
					 <?php		
								}
								else
								{
						?>		
                                <td class="celda_3">ONDA KILO <?php echo number_format($valorOndaKilo,0,'','.');?></td>
                                <td class="celda_3"><?php echo number_format($costoOndaKilo,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($totalOndaKilo,0,'','.')?></td>
								
							<?php
								}
							?>
                            </tr>
                            <!--
                            <tr>
                                <td class="celda_3">SEDAS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            -->
                            <tr>
                                <td class="celda_3">VARIOS</td>
                                <td class="celda_3">0</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <?php
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima= $totalPlacaKilo+$totalPlacaKilo2;
								}else
								{
									$totalMateriaPrima= $totalOndaKilo+$totalPlacaKilo;	
								}
                            
                            ?>
                      <tr>
                                <td class="celda_3"><span class="subrayado_top">TOTAL MATERIA PRIMA</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalMateriaPrima,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                      <tr>
                                <td class="celda_3">PRE-IMPRESIÓN</td>
                                <td class="celda_3">CANTIDAD</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <!--<td class="celda_3">ARTE <?php //echo $coloresArte?></td>-->
                                <td class="celda_3">ARTE <?php echo $coloresArte?></td>
                                <td class="celda_3"><?php echo number_format($arte->precio,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($cantidadArte,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">PLANCHAMETAL <?php echo $coloresPlanchaMetal?></td>
                                <td class="celda_3"><?php echo number_format($plancha_metal->precio,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($cantidadPlantaMetal,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">COPIADO <?php echo $coloresCopiado?></td>
                                <td class="celda_3"><?php echo number_format($copiado->precio,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($cantidadCopiapo,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">PELÍCULAS <?php echo $coloresPeliculas?></td>
                                <td class="celda_3"><?php if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo '0';}else{echo number_format($peliculasPreImpresion->precio,0,'','.');}?></td>
                                <td class="celda_3"><?php echo number_format($cantidadPeliculas,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">MONTAJE <?php echo $coloresMontaje?></td>
                                <td class="celda_3"><?php if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo '0';}else{echo number_format($montajePreImpresion->precio,0,'','.');}?></td>
                                <td class="celda_3"><?php echo number_format($cantidadMontaje,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">CROMALÍN <?php echo $coloresCromalin?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($cromalin,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRE-IMPRESIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalPreImpresion,0,'','.')?></td>
                            </tr>
                        </table>
                         <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6"><hr class="hr_punteada" /></td>
                            </tr>
                         <?php
						  	if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima2= $totalPlacaKilo+$totalPlacaKilo2;
								}else
								{
									$totalMateriaPrima2= $totalOndaKilo+$totalPlacaKilo;	
								}
                         ?>
                         <tr>
                                <td class="celda_3">TOTAL MATERIA PRIMA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalMateriaPrima2,0,'','.')?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRE-IMPRESIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalPreImpresion,0,'','.')?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRODUCCIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalProduccion,0,'','.')?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                         <?php
                          $totalTotal=$totalMateriaPrima2+$totalPreImpresion+$totalProduccion+$totalCostosVarios;
                          
                            $totalValorUnitario=$totalTotal/$datos->cantidad_1;
                            //$totalValorUnitario2=$totalTotal/$datos->cantidad_2;
                            //$totalValorUnitario3=$totalTotal/$datos->cantidad_3;
                            //$totalValorUnitario4=$totalTotal/$datos->cantidad_4;
							
                            $valorFinal=(($totalValorUnitario/(100-$hoja->margen))/100)*10000;

							 $valorFinal2xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_2,2);
							 $valorFinal3xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_3,3);
							 $valorFinal4xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_4,4);
							
                         ?>
                          <tr>
                                <td class="celda_3">TOTAL COSTOS VARIOS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalCostosVarios,0,'','.')?></td>
                                <td class="celda_3"><span class="subrayado">VALOR FINAL</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($valorFinal,0,'','.')?></td>
                                <!--
<td class="celda_3" colspan="3" rowspan="30">PRODUCCIÓN</td>
-->
                            </tr>
                <?php
                            $vcostoFinanciero=$this->variables_cotizador_model->getVariablesCotizadorPorId(33);
                            $recargoPorCantidadJusta=$this->variables_cotizador_model->getVariablesCotizadorPorId(37);
							
							
							//if($datos->acepta_excedentes=='SI')
                           // {
								$valorFinanciado=$valorFinal*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
								$valorFinanciado2=$valorFinal2xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
								$valorFinanciado3=$valorFinal3xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
								$valorFinanciado4=$valorFinal4xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							//}
							
                            if($datos->acepta_excedentes=='NO')
                            {
                                $valorFinanciado=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado);
                                $valorFinanciado2=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado2);
                                $valorFinanciado3=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado3);
                                $valorFinanciado4=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado4);
                            }
                ?>
							<tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                                <td class="celda_3">VALOR FINANCIADO <?php echo $forma_pago->forma_pago?> (<?php echo $forma_pago->dias?>)</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($valorFinanciado,0,'','.')?> <input type="hidden" name="valor_financiado" value="<?php echo $valorFinanciado?>" /> </td>
								
                            </tr>
                            <?php
                                if(sizeof($hoja)==0)
                                {
                                    $valorEmpresa=$valorFinanciado;
                                }else
                                {
                                    $valorEmpresa=$hoja->valor_empresa;
                                }
                            ?>
                <tr>
                                <td class="celda_3">TOTAL</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalTotal,0,'','.')?></td>
                                <td class="celda_3">VALOR EMPRESA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php if($valorEmpresa == '0'){echo number_format($valorFinanciado,0,'','.');}else{echo number_format($valorEmpresa,0,'','.');}?><a href="<?php echo base_url()?>hoja/valor_empresa/<?php echo $id?>/<?php echo $pagina?>/<?php echo $valorFinanciado;?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_empresa" value="<?php echo $valorEmpresa?>" /></td>
                            </tr>
                             <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">DÍAS DE ENTREGA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php if(sizeof($hoja)==0){echo '20';}else{echo $hoja->dias_de_entrega;}?><a href="<?php echo base_url()?>hoja/dias/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="dias_de_entrega" value="<?php echo $hoja->dias_de_entrega?>" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">VALOR UNITARIO</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalValorUnitario,0,'','.')?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MARGEN</td>
                                <td class="celda_3"><?php if($hoja->margen == null){echo '15';}else{echo $hoja->margen;}?> <a href="<?php echo base_url()?>hoja/margen/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="margen" value="<?php echo $hoja->margen?>" /></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                        </table>
                        <div class="separador_20">&nbsp;</div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">CANTIDAD 2</td>
                                <td class="celda_3"><?php if($datos->cantidad_2 == 1){ echo 0;}else{echo number_format($datos->cantidad_2,0,"",".");}?> <a href="<?php echo base_url()?>hoja/cantidad2/<?php echo $id?>/2" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                                <td class="celda_3">CANTIDAD 3</td>
                                <td class="celda_3"><?php if($datos->cantidad_3 == 1){ echo 0;}else{echo number_format($datos->cantidad_3,0,"",".");}?> <a href="<?php echo base_url()?>hoja/cantidad2/<?php echo $id?>/3" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                                <td class="celda_3">CANTIDAD 4</td>
                                <td class="celda_3"><?php if($datos->cantidad_4 == 1){ echo 0;}else{echo number_format($datos->cantidad_4,0,"",".");}?> <a href="<?php echo base_url()?>hoja/cantidad2/<?php echo $id?>/4" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                            </tr>
							<?php 
							 
							?>
							
                            <tr>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3"><?php if($datos->cantidad_2 == 1){ echo 0;}else{echo number_format($valorFinal2xxx,0,"",".");}?></td>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3"><?php if($datos->cantidad_3 == 1){ echo 0;}else{echo number_format($valorFinal3xxx,0,"",".");}?></td>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3"><?php if($datos->cantidad_4 == 1){ echo 0;}else{echo number_format($valorFinal4xxx,0,"",".");}?></td>
                            </tr>
                            <?php
								if(sizeof($hoja)==0)
                                {
                                    $valorEmpresa2=number_format($valorFinanciado2,0,'','.');
                                    $valorEmpresa3=number_format($valorFinanciado3,0,'','.');
                                    $valorEmpresa4=number_format($valorFinanciado4,0,'','.');
                                }else
                                {
                                    $valorEmpresa2=$hoja->valor_empresa_2;
                                    $valorEmpresa3=$hoja->valor_empresa_3;
                                    $valorEmpresa4=$hoja->valor_empresa_4;
                                }
								

								if($hoja->valor_empresa_2 == 0)
                                {
                                    $valorEmpresa_2=$valorFinanciado2;  
									
									$arregloVEmpresa=array
									(
										"valor_empresa_2"=>$valorEmpresa_2,
									);
									
									$this->db->where('id', $hoja->id);
									$this->db->update("hoja_de_costos_datos",$arregloVEmpresa);
                                }
								
								if($hoja->valor_empresa_3 ==0)
                                {                                    
                                    $valorEmpresa_3=$valorFinanciado3;  
									
									$arregloVEmpresa=array
									(
										"valor_empresa_3"=>$valorEmpresa_3,
									);
									
									$this->db->where('id', $hoja->id);
									$this->db->update("hoja_de_costos_datos",$arregloVEmpresa);                                  
                                }
								
								if($hoja->valor_empresa_4 ==0)
                                {
                                    $valorEmpresa_4=$valorFinanciado4;  
									
									$arregloVEmpresa=array
									(
										"valor_empresa_4"=>$valorEmpresa_4,
									);
									
									$this->db->where('id', $hoja->id);
									$this->db->update("hoja_de_costos_datos",$arregloVEmpresa);   
                                }
								
								
                            ?>
                            <input type="hidden" name="valor_empresa_2" value="<?php echo $valorEmpresa2?>" />
                            <input type="hidden" name="valor_empresa_3" value="<?php echo $valorEmpresa3?>" />
                            <input type="hidden" name="valor_empresa_4" value="<?php echo $valorEmpresa4?>" />
							<?php
							
							
							?>
							
                            <tr>
                                <td class="celda_3">VALOR FINANCIERO 2</td>
                                <td class="celda_3"><?php if($datos->cantidad_2 == 1){ echo 0;}else{echo number_format($valorFinanciado2,0,'','.');}?></td>
                                <td class="celda_3">VALOR FINANCIERO 3</td>
                                <td class="celda_3"><?php if($datos->cantidad_3 == 1){ echo 0;}else{echo number_format($valorFinanciado3,0,'','.');}?></td>
                                <td class="celda_3">VALOR FINANCIERO 4</td>
                                <td class="celda_3"><?php if($datos->cantidad_4 == 1){ echo 0;}else{echo number_format($valorFinanciado4,0,'','.');}?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">VALOR EMPRESA 2</td>
                                <td class="celda_3"><?php if($datos->cantidad_2 == 1){echo 0;}else{if( $valorEmpresa2 == 0){echo number_format($valorFinanciado2,0,'','.');}else{echo $valorEmpresa2;}}?> <a href="<?php echo base_url()?>hoja/valor_empresa_2/<?php echo $id?>/2" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                                <td class="celda_3">VALOR EMPRESA 3</td>
                                <td class="celda_3"><?php if($datos->cantidad_3 == 1){echo 0;}else{if( $valorEmpresa3 == 0){echo number_format($valorFinanciado3,0,'','.');}else{echo $valorEmpresa3;}}?> <a href="<?php echo base_url()?>hoja/valor_empresa_2/<?php echo $id?>/3" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                                <td class="celda_3">VALOR EMPRESA 4</td>
                                <td class="celda_3"><?php if($datos->cantidad_4 == 1){echo 0;}else{if( $valorEmpresa4 == 0){echo number_format($valorFinanciado4,0,'','.');}else{echo $valorEmpresa4;}}?> <a href="<?php echo base_url()?>hoja/valor_empresa_2/<?php echo $id?>/4" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
								 
                            </tr>
                        </table>
                        <div class="separador_10">&nbsp;</div>
                        <table id="tabla_detalle">
						
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MATERIAL</td>
                                <td class="celda_3">GRAMAJE</td>
                                <td class="celda_3">TOTAL PLIEGOS</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">TOTAL KILOS</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3"><?php echo $fotomecanica->materialidad_datos_tecnicos;?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
							<?php
									if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
										{
							?>				
											
							<tr>
                                <td class="celda_3">TAPA</td>
                                <td class="celda_3"><?php echo $tapaNombre?> (<?php echo number_format($tapaPrecio,0,'','.')?>)</td>
                                <td class="celda_3"><?php echo number_format($costoPlacaKilo,0,'','.') ?></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"><?php echo number_format($valorPlacaKilo,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">Tapa (Respaldo)</td>
                                <td class="celda_3"><?php echo $tapaNombre2?> (<?php echo number_format($tapaPrecio2,0,'','.')?>)</td>
                                <td class="celda_3"><?php echo number_format($costoPlacaKilo2,0,'','.') ?></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"><?php echo number_format($valorPlacaKilo2,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>				
											
							<?php				
										}else{
											
						if($fotomecanica->materialidad_datos_tecnicos == 'Corrugado')
						{
						$variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(25);
						}
						if($fotomecanica->materialidad_datos_tecnicos == 'Microcorrugado'){
						$variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);	
						}			
						
					  $cantidad_cajas = ($datos->cantidad_1 / $ing->unidades_por_pliego) + 104;					  
					  $kilosOnda =  ($tamano1 * $tamano2 * $ondaGramaje * $cantidad_cajas * (($variable_cotizador->precio * 10 + 1000)/1000)) / 10000000;
														

						$kilosLiner =  ($tamano1 * $tamano2 * $linerGramaje * $cantidad_cajas ) / 10000000;				

								
							 if(sizeof($hoja)>=1)
                            {
                                $arreglokilo2=array
                                (
                                    "kilos_onda"=>$kilosOnda,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo2);
								
								 $arreglokilo3=array
                                (
                                    "kilos_liner"=>$kilosLiner,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo3);
                            }
							
								
							?>				
										
										
										
							<tr>
                                <td class="celda_3">TAPA</td>
                                <td class="celda_3"><?php echo $tapaNombre?> (<?php echo number_format($tapaPrecio,0,'','.')?>)</td>
                                <td class="celda_3">pliego_tapa</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"><?php echo number_format($valorPlacaKilo,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">ONDA</td>
                                <td class="celda_3"><?php echo $ondaNombre?> (<?php echo number_format($ondaPrecio,0,'','.')?>)</td>
                                <td class="celda_3">pliego_onda</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"><?php echo number_format($kilosOnda,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">LINER</td>
                                <td class="celda_3"><?php echo $linerNombre?> (<?php echo number_format($linerPrecio,0,'','.')?>)</td>
                                <td class="celda_3">pliego_liner</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($kilosLiner,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>	
							<?php				
										}
							?>
                          
							<?php
									if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
										{
							?>	
							<tr>
                                <td class="celda_3">FECHA TAPA: <?php echo fecha_con_slash($tapaFecha)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA Tapa (Respaldo): <?php echo fecha_con_slash($tapaFecha2)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                            </tr>

							<?php
										}else{
							?>											
                            <tr>
                                <td class="celda_3">FECHA TAPA: <?php echo fecha_con_slash($tapaFecha)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA ONDA: <?php echo fecha_con_slash($ondaFecha)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA LINER: <?php echo fecha_con_slash($linerFecha)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">240</td>
                                <td class="celda_3">449.71</td>
                            </tr>
							
						<?php
						}
						?>		
                        </table>    
                        <div class="separador_20"></div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_2">
                                   <!--
 CANTIDAD 0 sss: 3.000 TOTAL $400.247
                                    <br />
                                    CANTIDAD 1 : 3.000 TOTAL $393.782
                                    <br />
                                    CANTIDAD 2 : 3.000 TOTAL
                                    <br />
                                    CANTIDAD 3 : 3.000 TOTAL
									
									
-->    
                                </td>
                                <td class="celda_1">&nbsp;</td>
                                <td class="celda_60 valign_top" rowspan="5">
                                    <!--mermas-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td colspan="4">Tabla de Patrón de MERMAS Micronda TIPO E + Tapa</td>
                                        </tr>
                                        <tr>
                                            <td>Imprenta</td>
                                            <!--<td>Ultra</td>-->
                                            <td>Roland:800</td>
                                            <td>Roland:800</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Color 1-2-3</td>
                                            <td>300</td>
                                            <td>300</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo $color1?></td>
                                        </tr>
                                        <tr>
                                            <td>Color &gt; 3</td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td>* Color</td>
                                            <td><?php echo $color2?></td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php echo $can1?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php echo $can2?></td>
                                        </tr>
                                        <tr>
                                            <td>Barniz</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Primeros 1.000</td>
                                            <td><?php echo $bar1?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000 extra</td>
                                            <td><?php echo $bar2?></td>
                                        </tr>
                                        <tr>
                                            <td>Laca</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $laca?></td>
                                        </tr>
                                        <tr>
                                            <td>Folia</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $folia?></td>
                                        </tr>
                                        <tr>
                                            <td>Termolaminado</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $termolaminado?></td>
                                        </tr>
                                        <tr>
                                            <td>Trabajo externo</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>					
                                            <td><?php echo $externo?></td>
                                        </tr>
                                        <tr>
                                            <td>Micro/Micro</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $micromicro?></td>
                                        </tr>
                                        <tr>
                                            <td>Cart/Cart</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $cartulina?></td>
                                        </tr>
                                        <tr>
                                            <td>Tamaños Normales</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Emplacado</td>
                                            <td>015</td>
                                            <td>015</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $emplacado?></td>
                                        </tr>
                                        <tr>
                                            <td>Troquelado</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $troquelado?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><hr class="hr_punteada_corto" /></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo number_format($sum,0,'','.')?></td>
                                        </tr>
                                    </table>
                                    <!--/mermas-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2"></td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </header>
            <div class="separador_20"><hr /></div>
            <nav class="derecha">
                <ul id="menuhorizontal">
                    <?php 
					$hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
					if(sizeof($hoja) >= 1){
					?>
                     <li><a href="<?php echo base_url();?>cotizaciones/pdf/<?php echo $id?>" target="_blank" title="Exportar a PDF"><img src="<?php echo base_url();?>public/frontend/images/pdf.png" /> </li>
					<?php }?> 
                     <li><a href="<?php echo base_url();?>hoja/cambios/<?php echo $id?>" class="fancybox fancybox.ajax" title="Registro de cambios"><img src="<?php echo base_url();?>public/frontend/images/cambios.png" /> </li>
                     <li><a href="<?php echo base_url();?>cotizaciones/cotizacion_de_cliente/<?php echo $id?>" target="_blank" title="Cotización Cliente"><img src="<?php echo base_url();?>public/frontend/images/document.png" /> </li>
                     <li><a href="javascript:void(0);" onclick="guardarHC();" target="_blank" title="Guardar y Liberar"><img src="<?php echo base_url();?>public/frontend/images/save.png" /><input type="hidden" name="id" value="<?php echo $id?>" /><input type="hidden" name="url" value="<?php echo base_url()?><?php echo $this->uri->uri_string();?>" /> </li>
                     <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>"  title="Volver a Cotización"><img src="<?php echo base_url();?>public/frontend/images/back.png" /> </li>
                </ul>
                </nav>
                
        </div>
		
		<?php
		//Calculo para las demas cantidades
		//$prueba = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_2);
		//echo $prueba;
		?>
		
		
		
        <script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
</form>
    </body>
</html>  