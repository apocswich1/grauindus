<?php
function getField($campo,$datos,$ing)
	{
		$listo=false;
		foreach ($ing as $key => $value) {

		//print_r(strrpos($key,$campo));
		if (strpos($key,$campo) !== false && strrpos($key,$campo)<2 && (strlen($key)<=strlen($campo))) {
			//print_r($value);//do something with the page count
			$listo=true;
			print_r($value);
			}
			
		}
	
		if($listo) return "";

		foreach ($datos as $key => $value) {

		//print_r(strrpos($key,$campo));
		if (strpos($key,$campo) !== false && strrpos($key,$campo)<2 && (strlen($key)<=strlen($campo))) {
			print_r($value);//do something with the page count  	
			//return $value;
			}
			
		}
		
			//print_r($datos->$campo);
		
		//$datos_tmp=$datos;
		//$ing_tmp=array_values($ing);
		//var_dump($datos[0]);
		// if ($ing==null))
		// {
			// print_r($datos[$campo]);
		// }else{
			// print_r($ing[$campo]);
		// }
	}
        $usuario=$this->usuarios_model->getUsuariosPorId($fotomecanica->quien);
  
?>
<?php $this->layout->element('admin_mensaje_validacion'); ?>
<style>
    .ir-arriba {
	/*display:none;*/
	padding:20px;
	background:#024959;
	font-size:20px;
	color:#fff;
	cursor:pointer;
	position: fixed;
	bottom:20px;
	right:20px;
}
.ir-arriba2 {
	/*display:none;*/
	padding:20px;
	background:#024959;
	font-size:20px;
	color:#fff;
	cursor:pointer;
	position: fixed;
	top:20px;
	right:20px;
}


#grupos{
    width: 800px;
    z-index: 9000;
    margin-top:-160px;
    position: absolute;
    margin-left: 920px;
}
#grupos table{
    font-size: 11px;
    width: 580px;
}

#grupos table tr td{
    padding: 3px;
    border:1px solid #eeeeee;
}

#grupos .title{
    text-align:center; color:white; font-weight: bold; background-color: #004c68;
}
</style>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/>">Cotizaciones &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>cotizaciones/search_cot/<?php echo $id?>">Volver&gt;&gt;</a></li>
      <li>Revisión Fotomecánica</li>
    </ol>
   <!-- /Migas -->
   <!-- Indicador de colores -->
   <div>
        <span style="color: #ff0000; font-size: 12px;"><B>Activo</B></span>->        
        <span style="color: #2fa4e7; font-size: 12px;"><B>Pendiente</B></span>->
        <span style="color: orange; font-size: 12px;"><B>Pendiente por Liberar</B> </span>->
        <span style="color: green; font-size: 12px;"><B>Liberado</B> </span>->
        <span style="color: black; font-size: 12px;"><B>No corresponde</B> </span>        
    </div>
   <!-- /fin de indicador de colores -->
        <?php  $trazadosing=$this->trazados_model->getTrazadosPorId($datos->trazado); ?>
	<div class="page-header"><h3>Revisión Fotomecánica</h3></div>
        <?php if($fotomecanica->estado==1){ ?>   
        <div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Revisión Fotomecánica ya fue liberada en la fecha: <?php echo $datos->fecha?> por <?php echo $usuario->nombre;?></div>
        <?php } //elseif($fotomecanica->estado==0){ ?>        
        <!--<div style="background-color: #00d6ec; color:white; width: 100%;">&nbsp;&nbsp;Revisión Ingeniería ya fue Guardada en la fecha: <?php echo $datos->fecha?>. por <?php echo $usuario->nombre;?></div>-->
        <?php //} ?>  
        <?php if($datos->ot_antigua!=""){ ?>        
        <div style="background-color: red; color:white; width: 100%;">&nbsp;&nbsp;Orden Migrada de Sistema Viejo: <?php echo $datos->fecha?>...</div>
        <?php } ?>  
<?php $glosa=$this->produccion_model->getFotomecanicaGlosa($datos->id);?>
   <!-- /fin de indicador de colores -->
	<?php if($fotomecanica->estado==2){ ?>        
        <div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Revisión Fotomecánica Rechazó por: <?php echo $glosa->glosa;?></div>
        <?php }?>        
         <span class="ir-arriba2 icon-arrow-up">↓</span>
    <p> <div id="mensajeajaxarriba" class="control-group"></div>
         <ul>
        <?php
         if($datos->id_cliente==3000)
        {
            $cliente=$datos->nombre_cliente;
        }else
        {
            $cli=$this->clientes_model->getClientePorIdBasico($datos->id_cliente);
            $cliente=$cli->razon_social;
        }
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        ?>
            <li>Cliente : <b><?php echo $cliente?></b></li>
            <li>Cotización N° : <b><?php echo $id?></b></li>
            <li>Fecha : <b><?php echo fecha($datos->fecha)?></b></li>
            <li>Vendedor : <b><?php echo $vendedor->nombre?></b></li>
            <li>Retira Cliente: <?php if($datos->retira_cliente=='NO'){echo "No, Lo Despacha la Empresa";}else{echo "Si, Retira el Cliente";}?></li>
            <li>Despacho Fuera de Santiago: <?php if($datos->despacho_fuera_de_santiago=='SI'){echo "SI";}else{echo "NO";}?></li>
            <li>Distancia: <?php if($datos->despacho_fuera_de_santiago=='SI'){
     switch ($datos->distancia) {
         case 1:
             echo "50 - 120 Km";
             break;
         
         case 2:
             echo "121 - 200 Km";
             break;
         
         case 3:
             echo "201 - 400 Km";
             break;
         
         case 4:
             echo "400 o mas Km";
             break;

         default:
             break;
     }               
            }else{
                echo "NO";
                
            }?>
            </li>
            <li>Total o Parcial: <?php if($datos->tota_o_parcial=='Parcial'){
                echo "Parcial";
            }else{
                echo "Total";
            }
            ?>
            </li>
            <?php if($datos->tota_o_parcial=='Parcial'){
                echo "<li>Despachos: ".$datos->cantidad_de_despachos." Despachos</li>";
            }
            ?>
            </li>
        </ul>
    
	
	   <div id="div_condicion" style="display: none;">
     <div class="control-group">
		<!--<label class="control-label" for="usuario">Detalle de Cambios</label> -->
		<div class="controls">
			<!--<textarea id="contenido4" name="detalle_cambios" placeholder="Observaciones"><?php //echo set_value('detalle_cambios'); ?></textarea>-->
			
		</div>
	</div>
   </div>
	
	
	   <!--productos asociados--> 
   <div id="productos_asociados">


   </div>
   <!--productos asociados--> 
  <!-------------Logica de Grupos------------------------ >
     <?php 
        $existegrupo=$this->grupos_model->getExisteGrupo($id);
        $numero_en_grupo = 0;
        if(sizeof($existegrupo)>0){
            if($existegrupo->idc_01!="" || $existegrupo->idc_01!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo1=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_01);
                if(sizeof($cotgrupo1)>0){
                    $detallecotgrupo1 = "<tr>";
                    $detallecotgrupo1.= "<td align='center'>$cotgrupo1->id_cotizacion</td>";
                    $detallecotgrupo1.= "<td>$cotgrupo1->producto | C1:$cotgrupo1->cantidad_1,P1:$cotgrupo1->valor_empresa | C2:$cotgrupo1->cantidad_2,P2:$cotgrupo1->valor_empresa_2 | C3:$cotgrupo1->cantidad_3,P3:$cotgrupo1->valor_empresa_3 | C4:$cotgrupo1->cantidad_4,P4:$cotgrupo1->valor_empresa_4</td>";
                    $detallecotgrupo1.= "<td>$cotgrupo1->fecha</td>";
                    $detallecotgrupo1.= "<tr>";
                }else{
                    $detallecotgrupo1.= "<tr><td align='center'>$existegrupo->idc_01 </td><td colspan='2' align='center' align='center'>La cotizacion Nro: $existegrupo->idc_01 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            
            if($existegrupo->idc_02!="" || $existegrupo->idc_02!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo2=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_02);
                if(sizeof($cotgrupo2)>0){
                    $detallecotgrupo2 = "<tr>";
                    $detallecotgrupo2.= "<td align='center'>$cotgrupo2->id_cotizacion</td>";
                    $detallecotgrupo2.= "<td>$cotgrupo2->producto | C1:$cotgrupo2->cantidad_1,P1:$cotgrupo2->valor_empresa | C2:$cotgrupo2->cantidad_2,P2:$cotgrupo2->valor_empresa_2 | C3:$cotgrupo2->cantidad_3,P3:$cotgrupo2->valor_empresa_3 | C4:$cotgrupo2->cantidad_4,P4:$cotgrupo2->valor_empresa_4</td>";
                    $detallecotgrupo2.= "<td>$cotgrupo2->fecha</td>";
                    $detallecotgrupo2.= "<tr>";
                }else{
                    $detallecotgrupo2.= "<tr><td align='center'>$existegrupo->idc_02 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_02 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_03!="" || $existegrupo->idc_03!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo3=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_03);
                if(sizeof($cotgrupo3)>0){
                    $detallecotgrupo3 = "<tr>";
                    $detallecotgrupo3.= "<td align='center'>$cotgrupo3->id_cotizacion</td>";
                    $detallecotgrupo3.= "<td>$cotgrupo3->producto | C1:$cotgrupo3->cantidad_1,P1:$cotgrupo3->valor_empresa | C2:$cotgrupo3->cantidad_2,P2:$cotgrupo3->valor_empresa_2 | C3:$cotgrupo3->cantidad_3,P3:$cotgrupo3->valor_empresa_3 | C4:$cotgrupo3->cantidad_4,P4:$cotgrupo3->valor_empresa_4</td>";
                    $detallecotgrupo3.= "<td>$cotgrupo3->fecha</td>";
                    $detallecotgrupo3.= "<tr>";
                }else{
                    $detallecotgrupo3.= "<tr><td align='center'>$existegrupo->idc_03 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_03 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_04!="" || $existegrupo->idc_04!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo4=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_04);
                if(sizeof($cotgrupo4)>0){
                    $detallecotgrupo4 = "<tr>";
                    $detallecotgrupo4.= "<td align='center'>$cotgrupo4->id_cotizacion</td>";
                    $detallecotgrupo4.= "<td>$cotgrupo4->producto | C1:$cotgrupo4->cantidad_1,P1:$cotgrupo4->valor_empresa | C2:$cotgrupo4->cantidad_2,P2:$cotgrupo4->valor_empresa_2 | C3:$cotgrupo4->cantidad_3,P3:$cotgrupo4->valor_empresa_3 | C4:$cotgrupo4->cantidad_4,P4:$cotgrupo4->valor_empresa_4</td>";
                    $detallecotgrupo4.= "<td>$cotgrupo4->fecha</td>";
                    $detallecotgrupo4.= "<tr>";
                }else{
                    $detallecotgrupo4.= "<tr><td align='center'>$existegrupo->idc_04 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_04 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_05!="" || $existegrupo->idc_05!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo5=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_05);
                if(sizeof($cotgrupo5)>0){
                    $detallecotgrupo5 = "<tr>";
                    $detallecotgrupo5.= "<td align='center'>$cotgrupo5->id_cotizacion</td>";
                    $detallecotgrupo5.= "<td>$cotgrupo5->producto | C1:$cotgrupo5->cantidad_1,P1:$cotgrupo5->valor_empresa | C2:$cotgrupo5->cantidad_2,P2:$cotgrupo5->valor_empresa_2 | C3:$cotgrupo5->cantidad_3,P3:$cotgrupo5->valor_empresa_3 | C4:$cotgrupo5->cantidad_4,P4:$cotgrupo5->valor_empresa_4</td>";
                    $detallecotgrupo5.= "<td>$cotgrupo5->fecha</td>";
                    $detallecotgrupo5.= "<tr>";
                }else{
                    $detallecotgrupo5.= "<tr><td align='center'>$existegrupo->idc_05 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_05 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_06!="" || $existegrupo->idc_06!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo6=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_06);
                if(sizeof($cotgrupo6)>0){
                    $detallecotgrupo6 = "<tr>";
                    $detallecotgrupo6.= "<td align='center'>$cotgrupo6->id_cotizacion</td>";
                    $detallecotgrupo6.= "<td>$cotgrupo6->producto | C1:$cotgrupo6->cantidad_1,P1:$cotgrupo6->valor_empresa | C2:$cotgrupo6->cantidad_2,P2:$cotgrupo6->valor_empresa_2 | C3:$cotgrupo6->cantidad_3,P3:$cotgrupo6->valor_empresa_3 | C4:$cotgrupo6->cantidad_4,P4:$cotgrupo6->valor_empresa_4</td>";
                    $detallecotgrupo6.= "<td>$cotgrupo6->fecha</td>";
                    $detallecotgrupo6.= "<tr>";
                }else{
                    $detallecotgrupo6.= "<tr><td align='center'>$existegrupo->idc_06 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_06 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_07!="" || $existegrupo->idc_07!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo7=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_07);
                if(sizeof($cotgrupo7)>0){
                    $detallecotgrupo7 = "<tr>";
                    $detallecotgrupo7.= "<td align='center'>$cotgrupo7->id_cotizacion</td>";
                    $detallecotgrupo7.= "<td>$cotgrupo7->producto | C1:$cotgrupo7->cantidad_1,P1:$cotgrupo7->valor_empresa | C2:$cotgrupo7->cantidad_2,P2:$cotgrupo7->valor_empresa_2 | C3:$cotgrupo7->cantidad_3,P3:$cotgrupo7->valor_empresa_3 | C4:$cotgrupo7->cantidad_4,P4:$cotgrupo7->valor_empresa_4</td>";
                    $detallecotgrupo7.= "<td>$cotgrupo7->fecha</td>";
                    $detallecotgrupo7.= "<tr>";
                }else{
                    $detallecotgrupo7.= "<tr><td align='center'>$existegrupo->idc_07 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_07 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_08!="" || $existegrupo->idc_08!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo8=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_08);
                if(sizeof($cotgrupo8)>0){
                    $detallecotgrupo8 = "<tr>";
                    $detallecotgrupo8.= "<td align='center'>$cotgrupo8->id_cotizacion</td>";
                    $detallecotgrupo8.= "<td>$cotgrupo8->producto | C1:$cotgrupo8->cantidad_1,P1:$cotgrupo8->valor_empresa | C2:$cotgrupo8->cantidad_2,P2:$cotgrupo8->valor_empresa_2 | C3:$cotgrupo8->cantidad_3,P3:$cotgrupo8->valor_empresa_3 | C4:$cotgrupo8->cantidad_4,P4:$cotgrupo8->valor_empresa_4</td>";
                    $detallecotgrupo8.= "<td>$cotgrupo8->fecha</td>";
                    $detallecotgrupo8.= "<tr>";
                }else{
                    $detallecotgrupo8.= "<tr><td align='center'>$existegrupo->idc_08 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_08 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_09!="" || $existegrupo->idc_09!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo9=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_09);
                if(sizeof($cotgrupo9)>0){
                    $detallecotgrupo9 = "<tr>";
                    $detallecotgrupo9.= "<td align='center'>$cotgrupo9->id_cotizacion</td>";
                    $detallecotgrupo9.= "<td>$cotgrupo9->producto | C1:$cotgrupo9->cantidad_1,P1:$cotgrupo9->valor_empresa | C2:$cotgrupo9->cantidad_2,P2:$cotgrupo9->valor_empresa_2 | C3:$cotgrupo9->cantidad_3,P3:$cotgrupo9->valor_empresa_3 | C4:$cotgrupo9->cantidad_4,P4:$cotgrupo9->valor_empresa_4</td>";
                    $detallecotgrupo9.= "<td>$cotgrupo9->fecha</td>";
                    $detallecotgrupo9.= "<tr>";
                }else{
                    $detallecotgrupo9.= "<tr><td align='center'>$existegrupo->idc_09 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_09 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_10!="" || $existegrupo->idc_10!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo10=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_10);
                if(sizeof($cotgrupo10)>0){
                    $detallecotgrupo10 = "<tr>";
                    $detallecotgrupo10.= "<td align='center'>$cotgrupo10->id_cotizacion</td>";
                    $detallecotgrupo10.= "<td>$cotgrupo10->producto | C1:$cotgrupo10->cantidad_1,P1:$cotgrupo10->valor_empresa | C2:$cotgrupo10->cantidad_2,P2:$cotgrupo10->valor_empresa_2 | C3:$cotgrupo10->cantidad_3,P3:$cotgrupo10->valor_empresa_3 | C4:$cotgrupo10->cantidad_4,P4:$cotgrupo10->valor_empresa_4</td>";
                    $detallecotgrupo10.= "<td>$cotgrupo10->fecha</td>";
                    $detallecotgrupo10.= "<tr>";
                }else{
                    $detallecotgrupo10.= "<tr><td align='center'>$existegrupo->idc_010 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_010 aun no tiene Hoja de Costos</td><tr>";
                }
            }
        }  
        
        ?>
        <?php if(sizeof($existegrupo)>0) { ?>
    <!-------------Fin de Logica de Grupos----------------->
 <div class="control-group">
         <div id="grupos">
            
             <table class="" style="border:1px solid #eeeeee">
                <tr>
                    <td colspan="3" class="title">Esta cotizacion pertenece a un grupo</td>
                </tr>
                <tr>
                    <td style="width:500px;" colspan="2"><b>Nombre de Grupo:</b> <?php echo $existegrupo->grupo; ?></td>
                    <td><b>Cantidad:</b> <?php echo $numero_en_grupo;  ?></td>
                </tr>
                <tr>
                    <td class="title" colspan="3" >Productos</td>
                </tr>
                <tr>
                    <td colspan="" style="text-align:center"><b>Nro</b></td>
                    <td colspan="" style="text-align:center"><b>Detalle de Cotizacion</b></td>
                    <td colspan="" style="text-align:center" ><b>Fecha</b></td>
                </tr>
                    <?php if($detallecotgrupo1!=""){echo $detallecotgrupo1; } ?>
                    <?php if($detallecotgrupo2!=""){echo $detallecotgrupo2; } ?>
                    <?php if($detallecotgrupo3!=""){echo $detallecotgrupo3; } ?>
                    <?php if($detallecotgrupo4!=""){echo $detallecotgrupo4; } ?>
                    <?php if($detallecotgrupo5!=""){echo $detallecotgrupo5; } ?>
                    <?php if($detallecotgrupo6!=""){echo $detallecotgrupo6; } ?>
                    <?php if($detallecotgrupo7!=""){echo $detallecotgrupo7; } ?>
                    <?php if($detallecotgrupo8!=""){echo $detallecotgrupo8; } ?>
                    <?php if($detallecotgrupo9!=""){echo $detallecotgrupo9; } ?>
                    <?php if($detallecotgrupo10!=""){echo $detallecotgrupo10; } ?>
    </table>
        </div>
    </div>
        <?php } ?>    
	
  
	<?php  if( $this->session->userdata('perfil')!=2) { ?>
                <!-- se muestra solo si la orden esta liberada de produccion -->
                <?php //if ($fotomecanica->estado=="1"){ ?>  
                <div class="control-group">
                              <!--<label class="control-label" for="usuario"><strong>PDF Trazado Fotomecánica</strong></label>-->
                              <label class="control-label" for="usuario"><strong>Imagen Final a Imprimir</strong><br>(Cuando es repeticion)</label>
                              <div class="controls">
                                      <?php if ($fotomecanica->archivo==""){ ?>
                                            <a href='#'>No Existe Archivo</a>
                                      <?php }  else { ?>
                                                <a href='<?php echo base_url().$this->config->item('direccion_pdf').$archivo_pro->pdf_imagen ?>' target="_blank"><i class="icon-search"></i></a>
                                      <?php } ?>

                              </div>
                              
                      </div>
    
           <?php //} ?>    
	<?php }?>
    <hr />	
	
	 <?php
				// if( $this->session->userdata('perfil')!=2)
				//	{
         $moldes2=$this->moldes_model->getMoldesPorId($datos->numero_molde);    
		?>
        <?php include('plantilla_trazado_ingenieria.php'); ?>
<!--  <div class="control-group">
		<label class="control-label" for="usuario"><strong>PDF Trazado Ingeniería</strong></label>
		<div class="controls">
                        <?php //if ($ing->archivo==""){ if($trazadosing->archivo!=""){ ?>
                          <a href='<?php // echo base_url().$this->config->item('direccion_pdf').$trazadosing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
                        <?php //}else{ ?>
			      <a href='#'>No Existe Archivo</a>
                        <?php //} }else{ if($trazadosing->archivo!=""){ ?>
                                  <a href='<?php // echo base_url().$this->config->item('direccion_pdf').$trazadosing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i><?php echo $trazadosing->numero; ?></a>
                              <?php //}else{ ?>
                                  <a href='<?php // echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
                              <?php //}}?>
				  
		</div>
	</div>-->
	
	<?php //}?>
    <hr />	
	<?php
				 if( $this->session->userdata('perfil')!=2)
					{
		?>
    <div class="control-group">
        <label class="control-label" for="usuario"><strong>PDF Archivo de Información Digital (Cliente)
</strong></label>
		<div class="controls">
            <?php
                            
             $archivo_cliente=$this->cotizaciones_model->getArchivoClientePorCotizacion($id);
            ?>
			<?php if ($archivo_cliente->archivo==""){ ?>
			      <a href='#'>No Existe Archivo</a>
		    <?php }
			      else{ ?>
				  <a href='<?php echo base_url().$this->config->item('direccion_pdf').$archivo_cliente->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
				  <?php } ?>
				  <?php //var_dump($ing); ?>
		</div>
	</div>
	
	<?php }?>
    <hr />	
  <div class="control-group">
		<label class="control-label" for="usuario">Identificacion del Producto</label>
		<div class="controls">
		    <?php if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios'){ ?>
                    <input readonly="readonly" style="width: 500px;" type="text" name="producto" onblur="ValidarNombreProducto();" value="<?php echo $ing->producto ?>"/>					
                    <?php }else{ ?>
                    <input style="width: 500px;" type="text" name="producto" onblur="ValidarNombreProducto();" value="<?php echo $ing->producto ?>"/>					
                    <?php } ?>
                </div>
  </div>
    <hr />
    <input type="hidden" name="nm" id="nm" value="<?php echo $ing->numero_molde ?>"/>
    <input type="hidden" name="existe_trazado" id="existe_trazado" value="<?php echo $datos->existe_trazado?>"/>
  <div class="control-group">
		<label class="control-label" for="usuario">Condición del Producto</label>
		<div class="controls">
        <?php 
        $condicions=array("Nuevo","Repetición Sin Cambios","Repetición Con Cambios","Producto Genérico");
        if(sizeof($fotomecanica)==0)
        {
            $condicionFull=$datos->condicion_del_producto;
        }else
        {
            $condicionFull=$fotomecanica->condicion_del_producto;
        }
        ?><?php //echo $ing->numero_molde //my code is here  ?>
	    <select name="condicion_del_producto" >
                <?php
                if($ing->numero_molde!=1 && $ing->numero_molde!=11 && $ing->numero_molde!=12 && $ing->numero_molde!=13 && $ing->numero_molde!=14 && $ing->numero_molde!=15 && $ing->numero_molde!=21){
                    echo "<option value='Repetición Con Cambios' selected='selected'>Repetición Con Cambios</option>";
                    echo "<option value='Repetición Sin Cambios'>Repetición Sin Cambios</option>";
                    echo "<option value='Nuevo'>Nuevo</option>";
                }else{
                foreach($condicions as $condicion)
                {
                    ?>
                     <option value="<?php echo $condicion?>" <?php if($condicionFull==$condicion && $condicion !=""){echo 'selected="selected"';}?>><?php echo $condicion; ?></option>
                    <?php
                }}
                ?>
               
            </select>
            <?php echo $datos->condicion_del_producto ?>
		</div>
	</div>
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades Cotizadas</label><!--onkeypress="nextOnEnter(this,event);"-->
		<div class="controls">
                    <?php  if (sizeof($datos)>0) {   ?>
                    <input type="text" readonly="readonly" id="can1" name="can1" style="width: 100px;" id="can1" onkeypress="return soloNumeros(event)" placeholder="Cantidad 1" value="<?php echo $datos->cantidad_1?>" /> - <input type="text"  readonly="readonly" id="can2" name="can2" id="can2" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 2" value="<?php echo $datos->cantidad_2?>" /> - <input type="text" readonly="readonly"  name="can3" id="can3" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 3" value="<?php echo $datos->cantidad_3?>" /> - <input type="text"  readonly="readonly" name="can4" id="can4" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 4" value="<?php echo $datos->cantidad_4?>" />
                    <?php } ?>                        
		</div>
	</div> 
    <h3>Impresion <strong style="color: red;">(*)</strong></h3>
    <div class="control-group">
		<label class="control-label" for="usuario">Visto Bueno <strong>(VB)</strong> en Maquina</label>
		<div class="controls">    
			<input style="width: 200px;" type="text" name="vb_maquina" placeholder="Visto Bueno en Maquina" value="<?php echo $datos->vb_maquina?>" readonly="true"/> 
		</div>
	</div>
	
	
	
	<?php// print_r($datos);exit(); ?>
     <div class="control-group">
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
			<select name="colores" onchange="colores_barniz(this.value);llevaBarnizFotomecanica();">
                <?php
                if($fotomecanica->colores=='')
                {
                    $colores=$ing->colores;
                }else
                {
                    $colores=$fotomecanica->colores;
                }
                for($i=0;$i<9;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if($colores==$i){echo 'selected="selected"';}?>><?php echo $i?></option>
                    <?php
                }
                ?>
                
                
            </select>
            <?php echo $ing->colores ?>
		</div>
	</div>
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Metálicos o Fluor</label>
		<div class="controls">
			<select name="colores_metalicos">
                <?php
                if(sizeof($fotomecanica)==0)
                {
                    $coloresmetalicos=$datos->impresion_metalicos;
                }else
                {
                    $coloresmetalicos=$fotomecanica->colores_metalicos;
                }
                for($i=0;$i<3;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if($coloresmetalicos==$i){echo 'selected="selected"';}?>><?php echo $i?></option>
                    <?php
                }
                ?>
                
                
            </select>
            <?php echo $datos->impresion_metalicos ?>
		</div>
	</div>
   <?php if($datos->condicion_del_producto=="Repetición Con Cambios"){ ?>
    <?php if(sizeof($fotomecanica>0) && $fotomecanica->tiene_color_modificado=="SI"){?>
    <div class="control-group">
        <label class="control-label" for="usuario">Tiene Algun Color Modificado<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="tiene_color_modificado">
            <option value="" <?php echo set_value_select($fotomecanica,'tiene_color_modificado',$fotomecanica->tiene_color_modificado,'');?>>Seleccione</option>
            <option value="NO" <?php echo set_value_select($fotomecanica,'tiene_color_modificado',$fotomecanica->tiene_color_modificado,'NO');?>>NO</option>
            <option value="SI" <?php echo set_value_select($fotomecanica,'tiene_color_modificado',$fotomecanica->tiene_color_modificado,'SI');?>>SI</option>
            </select>
        </div>
    </div>
    <div class="control-group" <?php if($fotomecanica->tiene_color_modificado<>'SI'){echo 'hidden=true'; }?> id="numero_color_modificado">
        <label class="control-label" for="usuario">Numero de Colores<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="numero_color_modificado">
            <option value="" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'');?>>Seleccione</option>
            <option value="1" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'1');?>>1</option>
            <option value="2" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'2');?>>2</option>
            <option value="3" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'3');?>>3</option>
            <option value="4" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'4');?>>4</option>
            <option value="5" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'5');?>>5</option>
            <option value="6" <?php echo set_value_select($fotomecanica,'numero_color_modificado',$fotomecanica->numero_color_modificado,'6');?>>6</option>
            </select>
        </div>
    </div>
    <?php }else{ ?>
   <div class="control-group">
        <label class="control-label" for="usuario">Tiene Algun Color Modificado<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="tiene_color_modificado">
            <option value="" <?php echo set_value_select($ing,'tiene_color_modificado',$ing->tiene_color_modificado,'');?>>Seleccione</option>
            <option value="NO" <?php echo set_value_select($ing,'tiene_color_modificado',$ing->tiene_color_modificado,'NO');?>>NO</option>
            <option value="SI" <?php echo set_value_select($ing,'tiene_color_modificado',$ing->tiene_color_modificado,'SI');?>>SI</option>
            </select>
        </div>
    </div>
    <div class="control-group" <?php if($ing->tiene_color_modificado<>'SI' && $_POST['tiene_color_modificado']<>'SI'){echo 'hidden=true'; }?> id="numero_color_modificado_ing">
        <label class="control-label" for="usuario">Numero de Colores<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="numero_color_modificado">
             <?php if (sizeof($ing)>0)  { ?>
            <option value="" <?php if($ing->numero_color_modificado==""){echo "selected='selected'";} ?>>Seleccione</option>
            <option value="1" <?php if($ing->numero_color_modificado=="1"){echo "selected='selected'";} ?>>1</option>
            <option value="2" <?php if($ing->numero_color_modificado=="2"){echo "selected='selected'";} ?>>2</option>
            <option value="3" <?php if($ing->numero_color_modificado=="3"){echo "selected='selected'";} ?>>3</option>
            <option value="4" <?php if($ing->numero_color_modificado=="4"){echo "selected='selected'";} ?>>4</option>
            <option value="5" <?php if($ing->numero_color_modificado=="5"){echo "selected='selected'";} ?>>5</option>
            <option value="6" <?php if($ing->numero_color_modificado=="6"){echo "selected='selected'";} ?>>6</option>
             <?php } else { ?>
            <option value="" <?php echo set_value_select($ing,'numero_color_modificado',$ing->numero_color_modificado,'');?><?php if($_POST['numero_color_modificado']==""){echo "selected=selected";} ?>>Seleccione</option>
            <option value="1" <?php echo set_value_select($ing,'numero_color_modificado',$ing->numero_color_modificado,'1');?><?php if($_POST['numero_color_modificado']=="1"){echo "selected=selected";} ?>>1</option>
            <option value="2" <?php echo set_value_select($ing,'numero_color_modificado',$ing->numero_color_modificado,'2');?><?php if($_POST['numero_color_modificado']=="2"){echo "selected=selected";} ?>>2</option>
            <option value="3" <?php echo set_value_select($ing,'numero_color_modificado',$ing->numero_color_modificado,'3');?><?php if($_POST['numero_color_modificado']=="3"){echo "selected=selected";} ?>>3</option>
            <option value="4" <?php echo set_value_select($ing,'numero_color_modificado',$ing->numero_color_modificado,'4');?><?php if($_POST['numero_color_modificado']=="4"){echo "selected=selected";} ?>>4</option>
            <option value="5" <?php echo set_value_select($ing,'numero_color_modificado',$ing->numero_color_modificado,'5');?><?php if(isset($_POST["fondo_otro_color"]) && ($_POST['numero_color_modificado']=="5")){echo "selected=selected";} ?>>5</option>
            <option value="6" <?php echo set_value_select($ing,'numero_color_modificado',$ing->numero_color_modificado,'6');?><?php if($_POST['numero_color_modificado']=="6"){echo "selected=selected";} ?>>6</option>
            <?php }  ?>
            </select>
        </div>
    </div>
   <?php } }?>
     <div class="control-group">
		<label class="control-label" for="usuario">Impresión</label>
		<div class="controls">
			<select name="impresion">
                <option value="Interna" <?php if($fotomecanica->impresion=="Interna"){echo 'selected="selected"';}?>>Interna</option>
                <option value="Externa" <?php if($fotomecanica->impresion=="Externa"){echo 'selected="selected"';}?>>Externa</option>
                <option value="NO" <?php if($fotomecanica->impresion=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
            
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Están las películas?</label>
		<div class="controls">
			<select name="estan_las_peliculas" style="width: 100px;">
                <option value="SI" <?php if($fotomecanica->estan_las_peliculas=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($fotomecanica->estan_las_peliculas=="NO" or $condicionFull=="Nuevo"){echo 'selected="selected"';}?>>NO</option>
            </select> 
            
        
		</div>
	</div>
     <!--********************combos de barniz - agregado pot ehndz**********************-->
     <?php if($reving->ing_lleva_barniz != '' && $fotomecanica->fot_lleva_barniz == ''){?>
         <div class="control-group">
		<label class="control-label" for="usuario">Tipo de Barniz</label>
		<div class="controls">
		<select name="fot_lleva_barniz" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($reving)>0) {   ?>
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if($reving->ing_lleva_barniz=="Barniz Acuoso Brillante (Standar)"){echo 'selected="true"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if($reving->ing_lleva_barniz=="Barniz Acuoso Mate"){echo 'selected="true"';}?>>Barniz Acuoso Mate</option>
                                <option value="Barniz Sobre Impresion" <?php if($reving->ing_lleva_barniz=="Barniz Sobre Impresion"){echo 'selected="true"';}?>>Barniz Sobre Impresión</option>                    
                                <option value="Laca UV" <?php if($reving->ing_lleva_barniz=="Laca UV"){echo 'selected="true"';}?>>Laca UV</option>                    
                                <option value="No Se" <?php if($reving->ing_lleva_barniz=="No Se"){echo 'selected="true"';}?>>No Se</option>                    
                                <option value="Nada" <?php if($reving->ing_lleva_barniz=="Nada"){echo 'selected="true"';}?>>Nada</option>                    
                        <?php } else {?>                    
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if(($_POST["fot_lleva_barniz"])=="Barniz Acuoso Brillante (Standar)"){echo 'selected="selected"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if(($_POST["fot_lleva_barniz"])=="Barniz Acuoso Mate"){echo 'selected="selected"';}?>>Barniz Acuoso Mate</option>
                                <option value="Barniz Sobre Impresion" <?php if(($_POST["fot_lleva_barniz"])=="Barniz Sobre Impresion"){echo 'selected="selected"';}?>>Barniz Sobre Impresión</option>
                                <option value="Laca UV" <?php if(($_POST["fot_lleva_barniz"])=="Laca UV"){echo 'selected="selected"';}?>>Laca UV</option>
                                <option value="Nada" <?php if(($_POST["fot_lleva_barniz"])=="Nada"){echo 'selected="selected"';}?>>Nada</option>
                                <option value="No Se" <?php if(($_POST["fot_lleva_barniz"])=="No Se"){echo 'selected="selected"';}?>>No Se</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
<div class="control-group" id="fot_reserva_barniz" <?php if($reving->ing_reserva_barniz==""){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Reserva</label>
		<div class="controls">
                    <select name="fot_reserva_barniz" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($reving)>0) {   ?>
                                <option value="Con Reserva" <?php if($reving->ing_reserva_barniz=="Con Reserva"){echo 'selected="true"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if($reving->ing_reserva_barniz=="Sin Reserva"){echo 'selected="true"';}?>>Sin Reserva</option>                    
                        <?php } else {?>                    
                                <option value="Con Reserva" <?php if(($_POST["fot_reserva_barniz"])=="Con Reserva"){echo 'selected="selected"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if(($_POST["fot_reserva_barniz"])=="Sin Reserva"){echo 'selected="selected"';}?>>Sin Reserva</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
<div class="control-group"  id="fot_cala_caucho" <?php if($reving->ing_cala_caucho==""){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Cala Caucho</label>
		<div class="controls">
		<select name="fot_cala_caucho" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($reving)>0) {   ?>
                                <option value="Si" <?php if($reving->ing_cala_caucho=="Si"){echo 'selected="true"';}?>>Si</option>
                                <option value="No" <?php if($reving->ing_cala_caucho=="No"){echo 'selected="true"';}?>>No</option>                    
                        <?php } else {?>                    
                                <option value="Si" <?php if(($_POST["fot_cala_caucho"])=="Si"){echo 'selected="selected"';}?>>Si</option>
                                <option value="No" <?php if(($_POST["fot_cala_caucho"])=="No"){echo 'selected="selected"';}?>>No</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
     <?php }else{ ?>
         <div class="control-group">
		<label class="control-label" for="usuario">Tipo de Barniz</label>
		<div class="controls">
		<select name="fot_lleva_barniz" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($fotomecanica)>0) {   ?>
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if($fotomecanica->fot_lleva_barniz=="Barniz Acuoso Brillante (Standar)"){echo 'selected="true"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if($fotomecanica->fot_lleva_barniz=="Barniz Acuoso Mate"){echo 'selected="true"';}?>>Barniz Acuoso Mate</option>
                                <option value="Barniz Sobre Impresion" <?php if($fotomecanica->fot_lleva_barniz=="Barniz Sobre Impresion"){echo 'selected="true"';}?>>Barniz Sobre Impresión</option>                    
                                <option value="Laca UV" <?php if($fotomecanica->fot_lleva_barniz=="Laca UV"){echo 'selected="true"';}?>>Laca UV</option>                    
                                <option value="No Se" <?php if($fotomecanica->fot_lleva_barniz=="No Se"){echo 'selected="true"';}?>>No Se</option>                    
                                <option value="Nada" <?php if($fotomecanica->fot_lleva_barniz=="Nada"){echo 'selected="true"';}?>>Nada</option>                    
                        <?php } else {?>                    
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if(($_POST["fot_lleva_barniz"])=="Barniz Acuoso Brillante (Standar)"){echo 'selected="selected"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if(($_POST["fot_lleva_barniz"])=="Barniz Acuoso Mate"){echo 'selected="selected"';}?>>Barniz Acuoso Mate</option>
                                <option value="Barniz Sobre Impresion" <?php if(($_POST["fot_lleva_barniz"])=="Barniz Sobre Impresion"){echo 'selected="selected"';}?>>Barniz Sobre Impresión</option>
                                <option value="Laca UV" <?php if(($_POST["fot_lleva_barniz"])=="Laca UV"){echo 'selected="selected"';}?>>Laca UV</option>
                                <option value="No Se" <?php if(($_POST["fot_lleva_barniz"])=="No Se"){echo 'selected="selected"';}?>>No Se</option>
                                <option value="Nada" <?php if(($_POST["fot_lleva_barniz"])=="Nada"){echo 'selected="selected"';}?>>Nada</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
<div class="control-group" id="fot_reserva_barniz" <?php if($fotomecanica->fot_reserva_barniz==""){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Reserva</label>
		<div class="controls">
                    <select name="fot_reserva_barniz" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($fotomecanica)>0) {   ?>
                                <option value="Con Reserva" <?php if($fotomecanica->fot_reserva_barniz=="Con Reserva"){echo 'selected="true"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if($fotomecanica->fot_reserva_barniz=="Sin Reserva"){echo 'selected="true"';}?>>Sin Reserva</option>                    
                        <?php } else {?>                    
                                <option value="Con Reserva" <?php if(($_POST["fot_reserva_barniz"])=="Con Reserva"){echo 'selected="selected"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if(($_POST["fot_reserva_barniz"])=="Sin Reserva"){echo 'selected="selected"';}?>>Sin Reserva</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
<div class="control-group"  id="fot_cala_caucho" <?php if($fotomecanica->fot_cala_caucho==""){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Cala Caucho</label>
		<div class="controls">
		<select name="fot_cala_caucho" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($fotomecanica)>0) {   ?>
                                <option value="Si" <?php if($fotomecanica->fot_cala_caucho=="Si"){echo 'selected="true"';}?>>Si</option>
                                <option value="No" <?php if($fotomecanica->fot_cala_caucho=="No"){echo 'selected="true"';}?>>No</option>                    
                        <?php } else {?>                    
                                <option value="Si" <?php if(($_POST["fot_cala_caucho"])=="Si"){echo 'selected="selected"';}?>>Si</option>
                                <option value="No" <?php if(($_POST["fot_cala_caucho"])=="No"){echo 'selected="selected"';}?>>No</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
    <?php }
         ?>
   
   
   <!--***********************************************************-->
<h3>Troquelado <strong style="color: red;">(*)</strong></h3>
   <div class="control-group">
		<label class="control-label" for="tamano_pliego">Tamaño del Pliego</label>
		<div class="controls">

		<?php
		if(sizeof($fotomecanica)>0)
                {
		?>
                    <input type="text" id="tamano_pliego" name="tamano_pliego"  value="<?php echo $ing->tamano_a_imprimir_1.' x '.$ing->tamano_a_imprimir_2; ?>" />
		<?php
                }
		else
                {
		?>
                    <input type="text" id="tamano_pliego" name="tamano_pliego"  value="<?php echo $ing->tamano_a_imprimir_1.' x '.$ing->tamano_a_imprimir_2; ?>" />
		<?php
		}                
		?>
		</div>
	</div> 
   
<?php
            
//echo $reving->ing_lleva_barniz."<br />";
//echo $reving->ing_reserva_barniz."<br />";
//echo $reving->ing_cala_caucho."<br />";
//echo "-----------------------------------------<br />";
//echo $fotomecanica->fot_lleva_barniz."<br />";
//echo $fotomecanica->fot_reserva_barniz."<br />";
//echo $fotomecanica->fot_cala_caucho."<br />";
?>
      
    
    <?php
//    $estan="NO";
    if(sizeof($fotomecanica)>0)
    {
        if ($fotomecanica->estan_los_moldes!='')
        {$numero_moldes=$fotomecanica->numero_molde;
            $estan_los_moldes=$fotomecanica->estan_los_moldes;
            if ($estan_los_moldes=='MOLDE GENERICO'){
                $estan="SI";
            }else{
                if ($estan_los_moldes=='MOLDE REGISTRADOS DEL CLIENTE'){
                    $estan="SI";                    
                }else{ $estan="NO"; 
            $numero_moldes=$fotomecanica->numero_molde;        
        }}}
    }
    else
    {
        if ($ing->estan_los_moldes!='')
        {
            $estan_los_moldes=$ing->estan_los_moldes;
            if ($estan_los_moldes=='MOLDE GENERICO'){ $estan="SI";
            }elseif ($estan_los_moldes=='MOLDE REGISTRADOS DEL CLIENTE'){ $estan="SI";                    
            }else{ $estan="NO";             
            $numero_moldes=$ing->numero_molde;      
            }
        }else {
            if(($datos->estan_los_moldes=="NO") || ($datos->estan_los_moldes=="NO LLEVA"))
            {
                $estan_los_moldes="NO"; 
                $estan="NO";
            }            
            else
            {                
                if ($datos->estan_los_moldes!='')
                {
                    $estan_los_moldes=$datos->estan_los_moldes;
                    if ($estan_los_moldes=='MOLDE GENERICO') $estan="SI";
                    elseif ($estan_los_moldes=='MOLDE REGISTRADOS DEL CLIENTE') $estan="SI";                    
                    else $estan="NO";             
                    $numero_moldes=$datos->numero_molde;      
                }  
            }
        }
    }
   
    $moldes=$this->moldes_model->getMoldes2();
    $moldes_clientes=$this->moldes_model->getMoldesClientes($datos->id_cliente);    
    ?>
   
   <?php // print_r($ing);?>
    <div class="control-group" id="div_hay_que_troquelar">
		<label class="control-label" for="usuario">Hay que Troquelar?</label>
		<div class="controls">
			<select name="hay_que_troquelar" style="width: 100px;" onchange="">
                        <?php
                        if($fotomecanica->hay_que_troquelar=="" && $ing->hay_que_troquelar!=""){
                            
                         if (sizeof($ing)>0)  { ?>
                            <option value="SI" <?php if($ing->hay_que_troquelar=='SI'){echo 'selected="true"';}?>>SI</option> 
                            <option value="NO" <?php if($ing->hay_que_troquelar=="NO"){echo 'selected="true"';}?>>NO</option>
                            <option value="NO SE" <?php if($ing->hay_que_troquelar=="NO SE"){echo 'selected="true"';}?>>NO SE</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(($_POST["hay_que_troquelar"])=='SI'){echo 'selected="selected"';}?>>SI</option> 
                            <option value="NO" <?php if(($_POST["hay_que_troquelar"])=='NO'){echo 'selected="selected"';}?>>NO</option>
                            <option value="NO SE" <?php if(($_POST["hay_que_troquelar"])=='NO SE'){echo 'selected="selected"';}?>>NO SE</option>
                        <?php }  
                        }else{
                            //if (sizeof($fotomecanica)>0)  { 
                            if (sizeof($ing)>0)  { ?>
                            <option value="SI" <?php if($ing->hay_que_troquelar=='SI'){echo 'selected="true"';}?>>SI</option> 
                            <option value="NO" <?php if($ing->hay_que_troquelar=="NO"){echo 'selected="true"';}?>>NO</option>
                            <option value="NO SE" <?php if($ing->hay_que_troquelar=="NO SE"){echo 'selected="true"';}?>>NO SE</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(($_POST["hay_que_troquelar"])=='SI'){echo 'selected="selected"';}?>>SI</option> 
                            <option value="NO" <?php if(($_POST["hay_que_troquelar"])=='NO'){echo 'selected="selected"';}?>>NO</option>
                            <option value="NO SE" <?php if(($_POST["hay_que_troquelar"])=='NO SE'){echo 'selected="selected"';}?>>NO SE</option>
                        <?php }
                        }
                        ?>   
                        </select> </div>
        </div>
        <div class="control-group">
		<label class="control-label" for="id_antiguo">Lleva troquelado</label>
		<div class="controls">

		<?php
		if(sizeof($fotomecanica)>0)
                {
		?>
                    <input  type="text" id="lleva_troquelado" name="lleva_troquelado"  value="<?php if($fotomecanica->lleva_troquelado!=""){echo $fotomecanica->lleva_troquelado;}else{echo "aa";} ?>" />
		<?php
                }
		elseif(sizeof($ing)>0)
                {
		?>
                    <input readonly="true" type="text" id="lleva_troquelado" name="lleva_troquelado"  value="<?php echo $ing->lleva_troquelado; ?>" />
		<?php
		}
		else
                {
		?>
                    <input readonly="true" type="text" id="lleva_troquelado" name="lleva_troquelado"  value="NO SE SABE" />
		<?php
		}                
		?>
		</div>
	</div> 
    
    <div class="control-group" id="hacer_troquel" style="display: block;">
		<label class="control-label" for="id_antiguo">Hacer Troquel</label>
		<div class="controls">
		<?php
		if(sizeof($fotomecanica)>0)
                {
		?>
                    <input type="text" id="hacer_troquel2" name="hacer_troquel"  value="<?php echo $fotomecanica->hacer_troquel; ?>" />
		<?php
                }
		elseif(sizeof($ing)>0)
                {
		?>
                    <input type="text" id="hacer_troquel2" name="hacer_troquel"  value="<?php echo $ing->hacer_troquel; ?>" />
		<?php
		}
		else
                {
		?>
                    <input type="text" id="hacer_troquel2" name="hacer_troquel"  value="NO SE SABE" />
		<?php
		} 
                
                
		?>
 		</div>
	</div>
         <?php $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde) ?>
         <div class="control-group" id="producto">
       <!-----------------------------------------------Contenido en Mantenimiento------------------------------------------------------<br /><br />-->
       <?php include('parcialMoldesTrazadosFotomecanica.php'); ?>
       <!------------------------------------------------------------------------------------------------------------------------------------------->
        </div>
<!--        <div class="control-group" id="div_estan_los_moldes" <?php //if($estan!='NO') { echo 'style="display: none;"'; } else { echo 'style="display: block;"';} ?>>
		<label class="control-label" for="usuario">Están los moldes?</label>
		<div class="controls">
			<select name="select_estan_los_moldes" style="width: 300px;" onchange="estanLosMoldes(this.value);condicionParaMoldesGenericos(this.value);">
                    <select name="select_estan_los_moldes" style="width: 300px;" onchange="estanLosMoldes(this.value);">
                        <option value="NO" <?php //if($estan_los_moldes=="CLIENTE LO APORTA") {echo 'selected="selected"';}?>>NO</option>
                        <option value="NO LLEVA" <?php //if($estan_los_moldes=="NO LLEVA") {echo 'selected="selected"';}?>>NO LLEVA</option>
                        <option value="CLIENTE LO APORTA" <?php //if($estan_los_moldes=="CLIENTE LO APORTA") {echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
                        <option value="MOLDE GENERICO" <?php //if($estan_los_moldes=="MOLDE GENERICO") {echo 'selected="selected"';}?>>MOLDE GENERICO</option>
                        <option value="MOLDE REGISTRADOS DEL CLIENTE" <?php //if($estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE") {echo 'selected="selected"';}?>>MOLDE REGISTRADOS DEL CLIENTE</option>
                    </select> 
		</div>
	</div>-->
	
<!--	<div class="control-group" id="div_estan_los_moldes_generico" <?php //if($estan_los_moldes=="MOLDE GENERICO") { echo 'style="display: block;"'; } else { echo 'style="display: none;"';} ?>>
		<label class="control-label" for="usuario">Moldes Genéricos</label>
		<div class="controls">
			<select name="select_estan_los_moldes_genericos" style="width: 600px;" onchange="estanLosMoldes(this.value);">
                        <option value="NO" <?php //if($estan=='NO'){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php //if($estan=='SI'){echo 'selected="selected"';}?>>SI</option> 
                    </select> 
                    <div id="molde_select">
                          <select name="molde_generico" id="molde_generico" style="width: 400px;" onchange="carga_ajax5('<?php// echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes')";>
                              <?php
                             // foreach($moldes as $molde)
                             // {
                                  ?>
                                  <option value="<?php //echo $molde->id?>" <?php //if($numero_moldes==$molde->id){echo 'selected="selected"';}?>><?php //echo $molde->nombre?> (N° <?php //echo $molde->numero?>)</option>
                                  <?php
                             // }
                              ?>
                          </select> 
                          <span id="div_moldes"></span>
                    </div>
		</div>
        </div>-->
    
    
<!--	<div class="control-group" id="div_estan_los_moldes_clientes" <?php// if($estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE")  { echo 'style="display: block;"'; } else { echo 'style="display: none;"';} ?>>
		<label class="control-label" for="usuario">Moldes del Cliente</label>
		<div class="controls">
			<select name="select_estan_los_moldes_no_genericos_clientes" style="width: 300px;" onchange="estanLosMoldes(this.value);">
                        <option value="SI" <?php //if($estan=='SI'){echo 'selected="selected"';}?>>SI</option> 
                        <option value="NO" <?php //if($estan=='NO'){echo 'selected="selected"';}?>>NO</option>
                    </select> 
                    <div id="molde_select_cliente">
                          <select name="molde_registrado" id="molde_registrado" style="width: 600px;" onchange="carga_ajax5('<?php// echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes')";>
                            <option value="0">Seleccione......</option>
                              <?php
                           //   foreach($moldes_clientes as $molde)
                           //   {
                           //       ?>
                                  <option value="<?php// echo $molde->id?>" <?php //if($numero_moldes==$molde->id){echo 'selected="selected"';}?>><?php// echo $molde->nombre?> (N° <?php// echo $molde->numero?>)</option>
                                  <?php
                            //  }
                              ?>
                          </select> 
                          <span id="div_moldes2"></span>
                    </div>                    
		</div>
        </div>     -->
    
    
    <h3>Trabajos Internos</h3>        
    
    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión interno 1</label>
	<div class="controls">
            <?php
            if($fotomecanica->acabado_impresion_1=='')
            {
                if($ing->acabado_impresion_1=='')
                {
                   $aca1=$datos->impresion_acabado_impresion_1;        
                }
                else 
                {
                   $aca1=$ing->acabado_impresion_1;                       
                }
            }
            else
            {
                $aca1=$fotomecanica->acabado_impresion_1;
            }
            ?>
            
            <select name="acabado_impresion_1" onchange="carga_ajax_obtenerKilos(this.value,'variable_externo_1'); carga_ajax_obtenerInfoTrabajosInternos(this.value,'infoPrecio1')" style="width: 500px;"><!--onchange="llevaBarnizFotomecanica2();"-->
                <option value="">Seleccione......</option>                            
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($aca1==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select><a href="#" id="infoPrecio1"></a>
            <?php  $variable1=$this->acabados_model->getAcabadosPorId2($aca1); ?> 
            </br>
            <div id="variable_externo_1" <?php if($fotomecanica->input_variable_externo_1==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_1"  value="<?php echo $fotomecanica->input_variable_externo_1; ?>" />&nbsp;&nbsp;  <?php echo $variable1 ?>
            </div>            
	</div>
    </div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 2</label>
		<div class="controls">
            <?php
            if($fotomecanica->acabado_impresion_2=='')
            {
                if($ing->acabado_impresion_2=='')
                {
                   $aca2=$datos->impresion_acabado_impresion_2;        
                }
                else 
                {
                   $aca2=$ing->acabado_impresion_2;                       
                }
            }
            else
            {
                $aca2=$fotomecanica->acabado_impresion_2;
            }
            ?>                    
                <select name="acabado_impresion_2" onchange="carga_ajax_obtenerKilos(this.value,'variable_externo_2'); carga_ajax_obtenerInfoTrabajosInternos(this.value,'infoPrecio2')" style="width: 500px;">
                <option value="">Seleccione......</option>                            
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($aca2==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select><a href="#" id="infoPrecio2"></a>
            <?php  $variable2=$this->acabados_model->getAcabadosPorId2($aca2); ?> 
            </br>
            <div id="variable_externo_2" <?php if($fotomecanica->input_variable_externo_2==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_2"  value="<?php echo $fotomecanica->input_variable_externo_2; ?>" />&nbsp;&nbsp;  <?php echo $variable2 ?>   
            </div>                    
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 3</label>
		<div class="controls">
            <?php
            if($fotomecanica->acabado_impresion_3=='')
            {
                if($ing->acabado_impresion_3=='')
                {
                   $aca3=$datos->impresion_acabado_impresion_3;        
                }
                else 
                {
                   $aca3=$ing->acabado_impresion_3;                       
                }
            }
            else
            {
                $aca3=$fotomecanica->acabado_impresion_3;
            }
            ?>                      

		<select name="acabado_impresion_3" onchange="procesosInternos();carga_ajax_obtenerKilos(this.value,'variable_externo_3'); carga_ajax_obtenerInfoTrabajosInternos(this.value,'infoPrecio3')"  style="width: 500px;">
                <option value="">Seleccione......</option>                         
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($aca3==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select><a href="#" id="infoPrecio3"></a>
            <?php  $variable3=$this->acabados_model->getAcabadosPorId2($aca3); ?> 
            </br>
            <div id="variable_externo_3" <?php if($fotomecanica->input_variable_externo_3==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_3"  value="<?php echo $fotomecanica->input_variable_externo_3; ?>" />&nbsp;&nbsp;<?php echo $variable3 ?>    
            </div>                    
		</div>
	</div>
            <?php 
            if($aca1!=""){$var1=1;}else{$var1=0;} 
            if($aca2!=""){$var2=1;}else{$var2=0;} 
            if($aca3!=""){$var3=1;}else{$var3=0;} 
            $acaInt=$var1+$var2+$var3;
            ?>
    <input type="text" id="conteo" value="<?php echo $acaInt ?>" name="conteo" readonly="true" />
    <input id="uno" value="<?php echo $var1 ?>" name="conteo1" type="hidden" />
    <input id="dos" value="<?php echo $var2 ?>" name="conteo2" type="hidden" />
    <input id="tres" value="<?php echo $var3 ?>" name="conteo3" type="hidden" />
    
    <h3>Trabajos Externos</h3>    
    
    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión Externo 1</label>
	<div class="controls">
            <?php
            if($fotomecanica->acabado_impresion_4=='')
            {
                if($ing->acabado_impresion_4=='')
                {
                   $aca4=$datos->impresion_acabado_impresion_4;        
                }
                else 
                {
                   $aca4=$ing->acabado_impresion_4;                       
                }
            }
            else
            {
                $aca4=$fotomecanica->acabado_impresion_4;
            }
            ?>              
    
            <select name="acabado_impresion_4" class="chosen-select" onchange="procesosExternos();carga_ajax_obtenerKilos(this.value,'variable_externo_4');carga_ajax_obtenerInfo(this.value,'infoNueva');"  style="width: 500px;">
                <option value="">Seleccione......</option>                     
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($aca4==$externo->id){echo 'selected="selected"';}?>><?php echo strtoupper($externo->caracteristicas).' ( VALOR: '.$externo->valor_venta.' ) '.$externo->unv ?></option>
                <?php
                }
                ?>
            </select><a href='#' id="infoNueva"></a>
            <?php  $variable4=$this->acabados_model->getAcabadosPorId2($aca4); ?> 
            </br>
            <div id="variable_externo_4" <?php if($fotomecanica->input_variable_externo_4==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_4"  value="<?php echo $fotomecanica->input_variable_externo_4; ?>" />&nbsp;&nbsp;  <?php echo $variable4 ?>   
            </div>
	</div>
    </div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 2</label>
		<div class="controls">
            <?php
            if($fotomecanica->acabado_impresion_5=='')
            {
                if($ing->acabado_impresion_5=='')
                {
                   $aca5=$datos->impresion_acabado_impresion_5;        
                }
                else 
                {
                   $aca5=$ing->acabado_impresion_5;                       
                }
            }
            else
            {
                $aca5=$fotomecanica->acabado_impresion_5;
            }
            ?>                       
                    <select name="acabado_impresion_5" class="chosen-select" onchange="procesosExternos();carga_ajax_obtenerKilos(this.value,'variable_externo_5');carga_ajax_obtenerInfo(this.value,'infoNueva2');"  style="width: 500px;">
                <option value="">Seleccione......</option>                     
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($aca5==$externo->id){echo 'selected="selected"';}?>><?php echo strtoupper($externo->caracteristicas).' ( VALOR: '.$externo->valor_venta.' ) '.$externo->unv ?></option>
                <?php
                }
                ?>
            </select><a href='#' id="infoNueva2"></a>
            <?php  $variable5=$this->acabados_model->getAcabadosPorId2($aca5); ?> 
            </br>
            <div id="variable_externo_5" <?php if($fotomecanica->input_variable_externo_5==0)  { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_5"  value="<?php echo $fotomecanica->input_variable_externo_5; ?>" /> &nbsp;&nbsp; <?php echo $variable5 ?>   
            </div>            
		</div>
	</div>
    
       <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 3</label>
		<div class="controls">
            <?php
            if($fotomecanica->acabado_impresion_6=='')
            {
                if($ing->acabado_impresion_6=='')
                {
                   $aca6=$datos->impresion_acabado_impresion_6;        
                }
                else 
                {
                   $aca6=$ing->acabado_impresion_6;                       
                }
            }
            else
            {
                $aca6=$fotomecanica->acabado_impresion_6;
            }
            ?>                      

                    <select name="acabado_impresion_6" class="chosen-select" onchange="procesosExternos();carga_ajax_obtenerKilos(this.value,'variable_externo_6');carga_ajax_obtenerInfo(this.value,'infoNueva3');"  style="width: 500px;">
                <option value="">Seleccione......</option>                     
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($aca6==$externo->id){echo 'selected="selected"';}?>><?php echo strtoupper($externo->caracteristicas).' ( VALOR: '.$externo->valor_venta.' ) '.$externo->unv ?></option>
                <?php
                }
                ?>
            </select><a href='#' id="infoNueva3"></a>
            <?php  $variable6=$this->acabados_model->getAcabadosPorId2($aca6); ?> 
            </br>
            <div id="variable_externo_6" <?php if($fotomecanica->input_variable_externo_6==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_6"  value="<?php echo $fotomecanica->input_variable_externo_6; ?>" /> &nbsp;&nbsp;<?php echo $variable6 ?>   
            </div>               
		</div>
	</div>
    <?php 
            if($aca4!=""){$var1=1;}else{$var1=0;} 
            if($aca5!=""){$var2=1;}else{$var2=0;} 
            if($aca6!=""){$var3=1;}else{$var3=0;} 
            $acaExt=$var1+$var2+$var3;
            ?>
    <input type="text" id="conteo2" value="<?php echo $acaExt ?>" name="conteo2" readonly="true" />
    <input id="cuatro" value="<?php echo $var1 ?>" name="conteo4" type="hidden" />
    <input id="cinco" value="<?php echo $var2 ?>" name="conteo5" type="hidden" />
    <input id="seis" value="<?php echo $var3 ?>" name="conteo6" type="hidden" />
    <h3>Procesos Especiales</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia</label>
		<div class="controls">
                    <select name="folia" style="width: 100px;" onchange="cambiaFolia_Cotizacion(); cambiaFolia();">
                        <?php
                        if(sizeof($ing)==0)
                        {
                            $procesos_especiales=$datos->procesos_especiales_folia;
                            ?>
                            <option value="NO" <?php if($datos->procesos_especiales_folia=="NO"){echo 'selected="true"';}?>>NO</option>
                            <option value="SI" <?php if($datos->procesos_especiales_folia=="SI"){echo 'selected="true"';}?>>SI</option>
                            <?php
                        }else
                        {
                            $procesos_especiales=$ing->procesos_especiales_folia;
                            ?>
                            <option value="NO" <?php if($ing->procesos_especiales_folia=="NO"){echo 'selected="true"';}?>>NO</option>
                            <option value="SI" <?php if($ing->procesos_especiales_folia=="SI"){echo 'selected="true"';}?>>SI</option>
                            <?php            
                        }
                        ?>
                    </select> 
                    <span id="folia_se_a" style="display: <?php if($procesos_especiales=='SI'){echo 'block';}else{echo 'none';}?>;">
                        <select name="folia_se" id="folia_se" onchange="repeticion(this);">
                        <?php
                        if(sizeof($ing)==0)
                        {
                        ?>
                            <option value="Nuevo" <?php if($datos->procesos_especiales_folia_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                            <option value="Repetición" <?php if($datos->procesos_especiales_folia_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                
                        <?php
                        }else
                        {
                        ?>
                            <option value="Nuevo" <?php if($ing->procesos_especiales_folia_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                            <option value="Repetición" <?php if($ing->procesos_especiales_folia_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                        <?php
                        }
                        ?>
                    </select>
                    </span>
                    <div id="folia1_proceso" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (golpe): &nbsp;</strong>                      
                        <select name="folia1_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt1');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="pt1"></a>            
                    </div><br>
                    <div id="folia1_molde_selected" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia1_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm1');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="ptm1"></a>            
                    </div>
		</div>                
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia 2</label>
		<div class="controls">
		<select name="folia_2" style="width: 100px;" onchange="cambiaFolia2_Cotizacion(); cambiaFolia2();">
                <?php
                if(sizeof($ing)==0)
                {
                    $procesos_especiales2=$datos->procesos_especiales_folia_2;
                    ?>
                    <option value="NO" <?php if($datos->procesos_especiales_folia_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_folia_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales2=$ing->procesos_especiales_folia_2;
                    ?>
                    <option value="NO" <?php if($ing->procesos_especiales_folia_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($ing->procesos_especiales_folia_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                </select> 
                <span id="folia_se_2_a" style="display: <?php if($procesos_especiales2=='SI'){echo 'block';}else{echo 'none';}?>;">
                <select name="folia_se_2">
                <?php
                    if(sizeof($ing)==0)
                    {
                    ?>
                        <option value="Nuevo" <?php if($datos->procesos_especiales_folia_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if($datos->procesos_especiales_folia_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                                          
                    <?php
                    }else
                    {
                    ?>
                        <option value="Nuevo" <?php if($ing->procesos_especiales_folia_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if($ing->procesos_especiales_folia_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                    }
                    ?>
                </select>
                </span><div id="folia2_proceso" style="display:<?php if($procesos_especiales2=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                   
                        <select name="folia2_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt2');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();    
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="pt2"></a>            
                    </div><br>
                    <div id="folia2_molde_selected" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia2_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm2');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="ptm2"></a>            
                    </div>
		</div>                
	</div>
    
    <div class="control-group">
            <label class="control-label" for="usuario">Folia 3</label>
            <div class="controls">
		<select name="folia_3" style="width: 100px;" onchange="cambiaFolia3_Cotizacion(); cambiaFolia3();">
                <?php
                if(sizeof($ing)==0)
                {
                    $procesos_especiales3=$datos->procesos_especiales_folia_3;
                ?>
                    <option value="NO" <?php if($datos->procesos_especiales_folia_3=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_folia_3=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php
                }else
                {
                    $procesos_especiales3=$ing->procesos_especiales_folia_3;
                ?>
                    <option value="NO" <?php if($ing->procesos_especiales_folia_3=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($ing->procesos_especiales_folia_3=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php            
                }
                ?>
                </select> 
                <span id="folia_se_3_a" style="display: <?php if($procesos_especiales3=='SI'){echo 'block';}else{echo 'none';}?>;">
                <select name="folia_se_3">
                <?php
                    if(sizeof($ing)==0)
                    {
                    ?>
                        <option value="Nuevo" <?php if($datos->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if($datos->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                                           
                    <?php
                    }else
                    {
                    ?>
                        <option value="Nuevo" <?php if($ing->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if($ing->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                    }
                    ?>
                </select>
                </span><div id="folia3_proceso" style="display:<?php if($procesos_especiales3=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                          
                    <select name="folia3_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt3'); cambiaFolia3()">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia3_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia3_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="pt3"></a>            
                    </div><br>
                    <div id="folia3_molde_selected" style="display:<?php if($procesos_especiales3=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia3_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm3');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia3_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia3_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="ptm3"></a>            
                    </div>
		</div>                
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño</label>
		<div class="controls">
		<select name="cuno" style="width: 100px;" onchange="cambiaCunoIng();">
                <?php
                if(sizeof($ing)==0)
                {
                    $procesos_especiales4=$datos->procesos_especiales_cuno;
                ?>
                    <option value="NO" <?php if($datos->procesos_especiales_cuno=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_cuno=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php
                }else
                {
                    $procesos_especiales4=$ing->procesos_especiales_cuno;
                ?>
                    <option value="NO" <?php if($ing->procesos_especiales_cuno=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($ing->procesos_especiales_cuno=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php            
                }
                ?>
                
                
            </select> 
            <span id="cuno_se_a" style="display: <?php if($procesos_especiales4=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="cuno_se">
                <?php
                if(sizeof($ing)==0)
                {
                ?>
                    <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($datos->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                                         
                <?php
                }else
                {
                ?>
                    <option value="Nuevo" <?php if($ing->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($ing->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php
                }
                ?>
            </select>
            </span><div id="cuno1_proceso" style="display:<?php if($procesos_especiales4=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                        
                        <select name="cuno1_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt4');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt4"></a>            
                    </div><br>         
                <div id="cuno1_molde_selected" style="display:<?php if($procesos_especiales4=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (molde):&nbsp; </strong>                        
                        <select name="cuno1_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm4');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->cuno1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm4"></a>            
                    </div>         
                 
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño 2</label>
		<div class="controls">
		<select name="cuno_2" style="width: 100px;" onchange="cambiaCuno2();">
                <?php
                if(sizeof($ing)==0)
                {
                    $procesos_especiales5=$datos->procesos_especiales_cuno_2;
                    ?>
                    <option value="NO" <?php if($datos->procesos_especiales_cuno_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_cuno_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales5=$ing->procesos_especiales_cuno_2;
                    ?>
                    <option value="NO" <?php if($ing->procesos_especiales_cuno_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($ing->procesos_especiales_cuno_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                
                
            </select> 
            <span id="cuno_se_2_a" style="display: <?php if($procesos_especiales5=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="cuno_se_2">
            <?php
                if(sizeof($ing)==0)
                {
                ?>
                    <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($datos->procesos_especiales_cuno_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                                          
                <?php
                }else
                {
                ?>
                    <option value="Nuevo" <?php if($ing->procesos_especiales_cuno_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($ing->procesos_especiales_cuno_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php
                }
                ?>
            </select>
            </span><div id="cuno2_proceso" style="display:<?php if($procesos_especiales5=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                          
                        <select name="cuno2_proceso_seletec" style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt5');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt5"></a>            
                    </div><br>         
                <div id="cuno2_molde_selected" style="display:<?php if($procesos_especiales5=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (molde):&nbsp; </strong>                        
                        <select name="cuno2_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm5');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->cuno2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm5"></a>            
                    </div>         
                 
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Lleva Fondo Negro</label>
		<div class="controls">
			<select id="lleva_fondo_negro" name="lleva_fondo_negro" style="width: 100px;" onchange="llevafondo(this.value);">
                <option value="">Seleccione......</option>  
                <?php if(sizeof($fotomecanica)>0) { ?>
                <option value="NO" <?php if($fotomecanica->lleva_fondo_negro=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php if($fotomecanica->lleva_fondo_negro=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php } elseif(sizeof($ing)>0) { ?>
                <option value="NO" <?php if($ing->lleva_fondo_negro=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php if($ing->lleva_fondo_negro=="SI"){echo 'selected="selected"';}?>>SI</option>                
                <?php  } else { ?>
                <option value="NO" <?php if($datos->tiene_fondo=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php if($datos->tiene_fondo=="SI"){echo 'selected="selected"';}?>>SI</option>                
                <?php } ?>                
            </select> 
        
		</div>
	</div>

	
	    <?php
	 if($ing->estan_los_moldes!="NO LLEVA")
		{
			?>
		   <div class="control-group">
				<label class="control-label" for="usuario">Lleva Troquel por atrás</label>
				<div class="controls">
					<select name="troquel_por_atras" style="width: 150px;">
                                                <option value="">Seleccione......</option>                                                 
						<option value="NO" <?php if(sizeof($fotomecanica) >= 1){if($fotomecanica->troquel_por_atras=="NO"){echo 'selected="selected"';}}else{if($ing->troquel_por_atras=="NO"){echo 'selected="selected"';}}?>>Por adelante</option>
						<option value="SI" <?php if(sizeof($fotomecanica) >= 1){if($fotomecanica->troquel_por_atras=="SI"){echo 'selected="selected"';}}else{if($ing->troquel_por_atras=="SI"){echo 'selected="selected"';}}?>>Por atrás</option>
					</select> 	
                    <?php
					if($ing->troquel_por_atras=="NO"){echo 'Revisión de ingeniería: Por adelante';};
					if($ing->troquel_por_atras=="SI"){echo 'Revisión de ingeniería: Por atrás';};
					?>
				</div>
			</div>			
			<?php
			
		}
	else{
	?>
   <div class="control-group">
				<label class="control-label" for="usuario">Lleva Troquel por atrás</label>
				<div class="controls">
			<input type="text" name="troquel_por_atras" placeholder="troquel_por_atras" readonly="true" value="<?php echo 'NO' ?>" /> 
    	</div>
			</div>
	<?php
			}
	?>

		   <div class="control-group">
				<label class="control-label" for="usuario">Lleva Fondo Otro Color</label>
				<div class="controls">
					<select name="fondo_otro_color" style="width: 150px;" >
                                        <?php 
                                        if(sizeof($fotomecanica)>0)
                                        {
                                            ?>
                                            <option value="NO" <?php if($fotomecanica->fondo_otro_color=="NO"){echo 'selected="true"';}?>>NO</option>
                                            <option value="SI" <?php if($fotomecanica->fondo_otro_color=="SI"){echo 'selected="true"';}?>>SI</option>
                                            <?php
                                        }
                                        elseif(sizeof($ing)>0)
                                        {
                                            ?>
                                            <option value="NO" <?php if($ing->fondo_otro_color=="NO"){echo 'selected="true"';}?>>NO</option>
                                            <option value="SI" <?php if($ing->fondo_otro_color=="SI"){echo 'selected="true"';}?>>SI</option>
                                            <?php
                                        }else                                       
                                        {
                                            ?>
                                            <option value="NO" <?php if($datos->fondo_otro_color=="NO"){echo 'selected="true"';}?>>NO</option>
                                            <option value="SI" <?php if($datos->fondo_otro_color=="SI"){echo 'selected="true"';}?>>SI</option>
                                            <?php            
                                        } ?>                                           
					</select> 	
				</div>
			</div>			
    

   <!--materialidad-->
   
    <h3>Materialidad <strong style="color: red;">(*)</strong></h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
		<select style="width: 400px;" name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');">
                <option value="">Seleccione.....</option>
                <?php
                $datosTecnicos=$this->datos_tecnicos_model->getDatosTecnicos();
                if (sizeof($fotomecanica)>0) {  
                    switch($fotomecanica->materialidad_datos_tecnicos)
                    {                
                        case 'Microcorrugado': $datos_tecnicos=1; break;
                        case 'Corrugado': $datos_tecnicos=2; break;
                        case 'Cartulina-cartulina': $datos_tecnicos=3; break;
                        case 'Sólo Cartulina': $datos_tecnicos=4; break;
                        case 'Onda a la Vista (MicroCorrugado/Corrugado)': $datos_tecnicos=5; break;
                        case 'otro': $datos_tecnicos=6; break;
                        case 'Se solicita proposición': $datos_tecnicos=7; break;
                        case 'Onda a la Vista (Corrugado/Corrugado)': $datos_tecnicos=9; break;
                        case 'Onda a la Vista (MicroCorrugado/MicroCorrugado)': $datos_tecnicos=10; break; 
                    }
                }
                if (sizeof($ing)>0) {  
                    switch($ing->materialidad_datos_tecnicos)
                    {                
                        case 'Microcorrugado': $datos_tecnicos=1; break;
                        case 'Corrugado': $datos_tecnicos=2; break;
                        case 'Cartulina-cartulina': $datos_tecnicos=3; break;
                        case 'Sólo Cartulina': $datos_tecnicos=4; break;
                        case 'Onda a la Vista (MicroCorrugado/Corrugado)': $datos_tecnicos=5; break;
                        case 'otro': $datos_tecnicos=6; break;
                        case 'Se solicita proposición': $datos_tecnicos=7; break;
                        case 'Onda a la Vista (Corrugado/Corrugado)': $datos_tecnicos=9; break;
                        case 'Onda a la Vista (MicroCorrugado/MicroCorrugado)': $datos_tecnicos=10; break; 
                    }
                }                
                else 
                {
                    switch($datos->materialidad_datos_tecnicos)
                    {                
                        case 'Microcorrugado': $datos_tecnicos=1; break;
                        case 'Corrugado': $datos_tecnicos=2; break;
                        case 'Cartulina-cartulina': $datos_tecnicos=3; break;
                        case 'Sólo Cartulina': $datos_tecnicos=4; break;
                        case 'Onda a la Vista (MicroCorrugado/Corrugado)': $datos_tecnicos=5; break;
                        case 'otro': $datos_tecnicos=6; break;
                        case 'Se solicita proposición': $datos_tecnicos=7; break;
                        case 'Onda a la Vista (Corrugado/Corrugado)': $datos_tecnicos=9; break;
                        case 'Onda a la Vista (MicroCorrugado/MicroCorrugado)': $datos_tecnicos=10; break; 
                    }
                }
                foreach($datosTecnicos as $datosTecnico){ ?>                
                    <option value="<?php echo $datosTecnico->id?>" <?php if($datos_tecnicos==$datosTecnico->id){echo 'selected="true"';}?>><?php echo $datosTecnico->datos_tecnicos?></option>
                <?php } ?>
                </select>
		</div>
	</div>
    
    <div id="materialidad">
    
          <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    		<select name="materialidad_1"  class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa){
                    if (sizeof($fotomecanica)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($fotomecanica->id_mat_placa1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php }                    
                    elseif (sizeof($ing)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($ing->id_mat_placa1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } else { ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php }
                    }
                    ?>
                </select>
                    <a style="text-decoration: none">
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos)>0) { 
                         if($datos->id_mat_placa1==$tapa->id){ echo "$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso)";
                     } 
                    }}
                    ?>
                </a>
                    |                    <a style="text-decoration: none">
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos)>0) { 
                         if($ing->id_mat_placa1==$tapa->id){ echo "$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso)";
                     } 
                    }}
                    ?>
                </a>
    		</div>
    	</div>
        <?php 
            if (sizeof($fotomecanica)>0) {  
               if ($fotomecanica->materialidad_datos_tecnicos=="Cartulina-cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($fotomecanica->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                
            }        
            elseif (sizeof($ing)>0) {  
               if ($ing->materialidad_datos_tecnicos=="Cartulina-cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($ing->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                
            }
            elseif (sizeof($datos)>0) 
            {
               if ($datos->materialidad_datos_tecnicos=="Cartulina-cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($datos->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                
            }
            else
            {
               if ($_POST["datos_tecnicos"]==3) 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($_POST["datos_tecnicos"]==4) 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                 
            }            
        ?>
                <div class="control-group" id="div_materialidad_2" <?php echo $div_materialidad2; ?>>
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
                    <select name="materialidad_2"  class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($fotomecanica)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($fotomecanica->id_mat_onda2==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } 
                    elseif (sizeof($ing)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($ing->id_mat_onda2==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } else { ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_onda2==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php }
                    }
                    ?>
                </select>
                    <a style="text-decoration: none">
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos)>0) { 
                         if($datos->id_mat_onda2==$tapa->id){ echo "$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso)";
                     } 
                    }}
                    ?>
                </a>
                    |                    <a style="text-decoration: none">
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos)>0) { 
                         if($ing->id_mat_onda2==$tapa->id){ echo "$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso)";
                     } 
                    }}
                    ?>
                </a>
    		</div>
    	</div>
        
        <?php 
            if (sizeof($fotomecanica)>0) {  
               if ($fotomecanica->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }        
            elseif (sizeof($ing)>0) {  
               if ($ing->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }
            elseif (sizeof($datos)>0) 
            {
               if ($datos->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }
            else
            {
               if ($_POST["datos_tecnicos"]==4) 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }            
        ?>        
                <div class="control-group" id="div_materialidad_3" <?php echo $div_materialidad3; ?>>
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
                    <select name="materialidad_3" class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($fotomecanica)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($fotomecanica->id_mat_liner3==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php }                        
                    elseif (sizeof($ing)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($ing->id_mat_liner3==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php } else { ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_liner3==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php }
                    }
                    ?>                    
                </select>
                    <a style="text-decoration: none">
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos)>0) { 
                         if($datos->id_mat_liner3==$tapa->id){ echo "$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso)";
                     } 
                    }}
                    ?></a>
|                    <a style="text-decoration: none">
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos)>0) { 
                         if($ing->id_mat_liner3==$tapa->id){ echo "$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso)";
                     } 
                    }}
                    ?>
                </a>
    		</div>
    	</div>
        
    <input type="hidden" name="materialidad_4" value="No Aplica" />         
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
        

    
    <h3>Piezas Adicionales</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
                    <select name="piezas_adicionales" class="chosen-select" onchange="carga_ajax_obtenerInfoPiezas(this.value,'infoPrecioP1');">
                <option value="0">No lleva.....</option>
                 <?php
                if($fotomecanica->piezas_adicionales=='')
                {
                    if($ing->piezas_adicionales=='')
                    {
                        $piezas_adicionales=$datos->piezas_adicionales;
                    }else
                    {
                        $piezas_adicionales=$ing->piezas_adicionales;
                    }
                }else
                {
                    $piezas_adicionales=$fotomecanica->piezas_adicionales;
                }
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($piezas_adicionales==$pieza->piezas_adicionales){echo 'selected="true"';}?>><?php echo $pieza->piezas_adicionales.' Precio:'.$pieza->valor_venta ?></option>
                    <?php
                }
                ?>
                </select><a href="#" id="infoPrecioP1"></a><a style="color:#BBBBBB"> [<?php echo $ing->piezas_adicionales; ?>] </a>
		</div>
	</div>
    
	 <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 2</label>
		<div class="controls">
                    <select name="piezas_adicionales2" class="chosen-select" onchange="carga_ajax_obtenerInfoPiezas(this.value,'infoPrecioP2');">
                <option value="0">No lleva.....</option>
                 <?php
                if($fotomecanica->piezas_adicionales2=='')
                {
                    if($ing->piezas_adicionales2=='')
                    {
                        $piezas_adicionales2=$datos->piezas_adicionales2;
                    }else
                    {
                        $piezas_adicionales2=$ing->piezas_adicionales2;
                    }
                }else
                {
                    $piezas_adicionales2=$fotomecanica->piezas_adicionales2;
                }                 
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($piezas_adicionales2==$pieza->piezas_adicionales){echo 'selected="true"';}?>><?php echo $pieza->piezas_adicionales.' Precio:'.$pieza->valor_venta ?></option>
                    <?php
                }
                ?>
                        </select><a href="#" id="infoPrecioP2"></a><a style="color:#BBBBBB"> [<?php echo $ing->piezas_adicionales2; ?>] </a>
		</div>
	</div>
	
		 <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 3</label>
		<div class="controls">
                    <select name="piezas_adicionales3" class="chosen-select" onchange="carga_ajax_obtenerInfoPiezas(this.value,'infoPrecioP3');">
                <option value="0">No lleva.....</option>
                 <?php
                if($fotomecanica->piezas_adicionales3=='')
                {
                    if($ing->piezas_adicionales3=='')
                    {
                        $piezas_adicionales3=$datos->piezas_adicionales3;
                    }else
                    {
                        $piezas_adicionales3=$ing->piezas_adicionales3;
                    }
                }else
                {
                    $piezas_adicionales3=$fotomecanica->piezas_adicionales3;
                }                      
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($piezas_adicionales3==$pieza->piezas_adicionales){echo 'selected="true"';}?>><?php echo $pieza->piezas_adicionales.' Precio:'.$pieza->valor_venta ?></option>
                    <?php
                }
                ?>
                </select><a href="#" id="infoPrecioP3"></a><a style="color:#BBBBBB"> [<?php echo $ing->piezas_adicionales3; ?>] </a>
		</div>
	</div>
	
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Detalle Piezas Adicionales</label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
			<input type="text" name="detalle_piezas_adicionales" placeholder="Detalle Piezas Adicionales" value="<?php echo $ing->detalle_piezas_adicionales?>" />
                    <?php } else { ?>   
			<input type="text" name="detalle_piezas_adicionales" placeholder="Detalle Piezas Adicionales" value="<?php echo $_POST["detalle_piezas_adicionales"]?>" />
                    <?php }  ?>                      
         
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Piezas Adicionales</label>
		<div class="controls">
                 <?php
                 if(sizeof($ing)>0)
                    {
                        $comentario_piezas_adicionales=strip_tags($ing->comentario_piezas_adicionales);
                    }elseif(sizeof($datos)>0)
                    {
                        $comentario_piezas_adicionales=strip_tags($datos->comentario_piezas_adicionales);
                    } 
                    else {
                        $comentario_piezas_adicionales=$_POST["comentario_piezas_adicionales"];
                    }
                    ?>                    
                    <textarea id="contenido5" name="comentario_piezas_adicionales" placeholder="Observaciones"><?php echo $comentario_piezas_adicionales?></textarea>
		</div>
	</div>
    
    
    

   <!--/materialidad-->
     <h3>Procesos Especiales</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia</label>
		<div class="controls">
		<select name="folia" style="width: 100px;" onchange="cambiaFolia();">
                <?php
                if(sizeof($fotomecanica)==0)
                {
                    $procesos_especiales=$datos->procesos_especiales_folia;
                    ?>
                    <option value="NO" <?php if($datos->procesos_especiales_folia=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_folia=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales=$fotomecanica->procesos_especiales_folia;
                    ?>
                    <option value="NO" <?php if($fotomecanica->procesos_especiales_folia=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($fotomecanica->procesos_especiales_folia=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                
                
            </select> 
            <span id="folia_se_a" style="display: <?php if($procesos_especiales=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="folia_se" id="folia_se">
            <option value="0">Seleccione......</option>
                
            <?php
                if(sizeof($fotomecanica)==0)
                {
                    ?>
                    
                <option value="Nuevo" <?php if($datos->procesos_especiales_folia_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_folia_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                }else
                {
                    ?>
                    
                <option value="Nuevo" <?php if($fotomecanica->procesos_especiales_folia_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($fotomecanica->procesos_especiales_folia_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                }
                    ?>
                
                
            </select>
            </span>
                    <div id="folia1_proceso" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (golpe): &nbsp;</strong>                      
                        <select name="folia1_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt1');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt1"></a>            
                    </div><br>
                    <div id="folia1_molde_selected" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia1_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm1');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm1"></a>            
                    </div>
		</div>                
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia 2</label>
		<div class="controls">
			<select name="folia_2" style="width: 100px;" onchange="cambiaFoliaFot2();">
                <?php
                if(sizeof($fotomecanica)==0)
                {
                    $procesos_especiales2=$datos->procesos_especiales_folia_2;
                    ?>
                    <option value="NO" <?php if($datos->procesos_especiales_folia_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_folia_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales2=$fotomecanica->procesos_especiales_folia_2;
                    ?>
                    <option value="NO" <?php if($fotomecanica->procesos_especiales_folia_2=="NO"){echo 'selected="true"';}?>>NO</option>
                <option value="SI" <?php if($fotomecanica->procesos_especiales_folia_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                
                
            </select> 
            <span id="folia_se_2_a" style="display: <?php if($procesos_especiales2=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="folia_se_2">
            <option value="0">Seleccione......</option>
            <?php
                if(sizeof($fotomecanica)==0)
                {
                    ?>
                    
                <option value="Nuevo" <?php if($datos->procesos_especiales_folia_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_folia_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                }else
                {
                    ?>
                    
                <option value="Nuevo" <?php if($fotomecanica->procesos_especiales_folia_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($fotomecanica->procesos_especiales_folia_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                }
                    ?>
                
                
            </select>
            </span>
                    <div id="folia2_proceso" style="display:<?php if($procesos_especiales2=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                   
                        <select name="folia2_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt2');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                               foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }
                            }
                            ?>
                        </select><a id="pt2"></a>            
                    </div><br>
                    <div id="folia2_molde_selected" style="display:<?php if($procesos_especiales2=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia2_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm2');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm2"></a>            
                    </div>
		</div>                
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia 3</label>
		<div class="controls">
			<select name="folia_3" style="width: 100px;" onchange="cambiaFoliaFot3();">
                <?php
                if(sizeof($fotomecanica)==0)
                {
                    $procesos_especiales3=$datos->procesos_especiales_folia_3;
                    ?>
                    <option value="NO" <?php if($datos->procesos_especiales_folia_3=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_folia_3=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales3=$fotomecanica->procesos_especiales_folia_3;
                    ?>
                    <option value="NO" <?php if($fotomecanica->procesos_especiales_folia_3=="NO"){echo 'selected="true"';}?>>NO</option>
                <option value="SI" <?php if($fotomecanica->procesos_especiales_folia_3=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                
                
            </select> 
            <span id="folia_se_3_a" style="display: <?php if($procesos_especiales3=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="folia_se_3">
            <option value="0">Seleccione......</option>
            <?php
                if(sizeof($fotomecanica)==0)  {  ?>
                <option value="Nuevo" <?php if($datos->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php } else {  ?>
                <option value="Nuevo" <?php if($fotomecanica->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($fotomecanica->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php } ?>
            </select>
            </span>
                    <div id="folia3_proceso" style="display:<?php if($procesos_especiales3=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                          
                        <select name="folia3_proceso_seletec"  style="width: 500px;"  onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt3');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia3_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia3_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt3"></a>            
                    </div><br>
                    <div id="folia3_molde_selected" style="display:<?php if($procesos_especiales3=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia3_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm3');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia3_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->folia3_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm3"></a>            
                    </div>
		</div>                
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño</label>
		<div class="controls">
			<select name="cuno" style="width: 100px;" onchange="cambiaCunoFot();">
                <?php
                if(sizeof($fotomecanica)==0)
                {
                    $procesos_especiales4=$datos->procesos_especiales_cuno;
                    ?>
                    <option value="NO" <?php if($datos->procesos_especiales_cuno=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_cuno=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales4=$fotomecanica->procesos_especiales_cuno;
                    ?>
                    <option value="NO" <?php if($fotomecanica->procesos_especiales_cuno=="NO"){echo 'selected="true"';}?>>NO</option>
                <option value="SI" <?php if($fotomecanica->procesos_especiales_cuno=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                
                
            </select> 
            <span id="cuno_se_a" style="display: <?php if($procesos_especiales4=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="cuno_se">
            <option value="0">Seleccione......</option>
            <?php if(sizeof($fotomecanica)==0)  {  ?>
                <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php } else { ?>
                <option value="Nuevo" <?php if($fotomecanica->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($fotomecanica->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php  } ?>
            </select>
            </span>
                    <div id="cuno1_proceso" style="display:<?php if($procesos_especiales4=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                        
                        <select name="cuno1_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt4');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt4"></a>            
                    </div><br>                  
                    <div id="cuno1_molde_selected" style="display:<?php if($procesos_especiales4=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (molde):&nbsp; </strong>                        
                        <select name="cuno1_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm4');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm4"></a>            
                    </div>                  
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño 2</label>
		<div class="controls">
		<select name="cuno_2" style="width: 100px;" onchange="cambiaCunoFot2();">
                <?php
                if(sizeof($fotomecanica)==0)
                {
                    $procesos_especiales5=$datos->procesos_especiales_cuno_2;
                    ?>
                    <option value="NO" <?php if($datos->procesos_especiales_cuno_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_cuno_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales5=$fotomecanica->procesos_especiales_cuno_2;
                    ?>
                    <option value="NO" <?php if($fotomecanica->procesos_especiales_cuno_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($fotomecanica->procesos_especiales_cuno_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                
                
            </select> 
            <span id="cuno_se_2_a" style="display: <?php if($procesos_especiales5=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="cuno_se_2">
            <option value="0">Seleccione......</option>
            <?php
                if(sizeof($fotomecanica)==0)
                {
                ?>
                    <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($datos->procesos_especiales_cuno_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php
                }else
                {
                ?>
                    <option value="Nuevo" <?php if($fotomecanica->procesos_especiales_cuno_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($fotomecanica->procesos_especiales_cuno_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php
                }
                ?>
                
                
            </select>
            </span>
                    <div id="cuno2_proceso" style="display:<?php if($procesos_especiales5=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                          
                        <select name="cuno2_proceso_seletec" style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt5');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt5"></a>            
                    </div><br>                  
                    <div id="cuno2_molde_selected" style="display:<?php if($procesos_especiales5=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (molde):&nbsp; </strong>                        
                        <select name="cuno2_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm5');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($fotomecanica)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$fotomecanica->cuno2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm5"></a>            
                    </div>                  
		</div>
	</div>
    
        <h3>PDF de Imagen</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ingrese PDF de la Imagen (No Obligatorio)</label>
		<div class="controls">
			<input type="file" id="file" name="file" />
                        <?php if ($archivo_cliente->archivo!=""){ ?>   
			<div id="nomarch" style="background-color: #ec5c00; color:white; width: 30%;">&nbsp;&nbsp;Archivo Ya fue Cargado con Exito...</div>
                        <?php  } else { ?>  
			<div id="nomarch">Seleccione el Archivo...</div>                        
                        <?php  }  ?>                          
		</div>
	</div>
	
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios</label>
		<div class="controls">
                        <?php if (sizeof($fotomecanica)>0)  { ?>
                            <textarea id="desctec" name="obs" placeholder="Observaciones"><?php echo $fotomecanica->comentarios; ?></textarea>
                        <?php } else { ?>
                            <textarea id="desctec" name="obs" placeholder="Observaciones"><?php echo $_POST["desctec"]; ?></textarea>
                        <?php }  ?>                    
		</div>
	</div>
             <?php
                if(sizeof($fotomecanica)==0)
                {
                ?>
                    <div class="control-group">
                            <label class="control-label" for="usuario">Descripcion Técnica</label>
                            <div class="controls">
                                    <textarea id="contenido4" name="desctec" placeholder="Descripcion técnica"><?php echo $fotomecanica->desctec; ?></textarea>
                            </div>
                    </div>
		<?php
                }else
                {
                ?>
                    <div class="control-group">
                            <label class="control-label" for="usuario">Descripcion Técnica</label>
                            <div class="controls">
                                    <textarea id="contenido4" name="desctec" placeholder="Descripcion técnica"><?php echo $ing->producto.', Impreso a '.$fotomecanica->colores.' colores, Barniz:'.$fotomecanica->reserva_barniz.', En Placa'.$fotomecanica->materialidad_1.' onda: '.$fotomecanica->materialidad_2.' liner: '.$fotomecanica->materialidad_3.' Tamaño de la Caja: '.$ing->medidas_de_la_caja.'X'.$ing->medidas_de_la_caja_2.'X'.$ing->medidas_de_la_caja_3.'X'.$ing->medidas_de_la_caja_4 ?></textarea>
                            </div>
                    </div>    
		<?php
                }
                 ?>
	<!-- Comentarios al vendedor solo al guardar -->
				<?php
                if(sizeof($fotomecanica)==0)
                {
                ?>
                    <div class="control-group">
                            <label class="control-label" for="usuario"><strong>Guardar con comentarios al vendedor</strong></label>
                            <div class="controls">
                                    <textarea id="contenido4" name="guardar_con_comentarios" placeholder="<?php echo 'Estimado '.$vendedor->nombre.': ' ?>"></textarea>
                            </div>
                    </div>
		<?php
                }else
                {
                ?>
                    <div class="control-group">
                            <label class="control-label" for="usuario"><strong>Guardar con comentarios al vendedor</strong></label>
                            <div class="controls">
                                    <textarea id="contenido4" name="guardar_con_comentarios" placeholder="Guardar Comentarios"><?php echo $fotomecanica->guardar_con_comentarios ?></textarea>
                            </div>
                    </div>    
		<?php
                }
                ?>
	
	
	
     <div class="control-group" id="rechazo" style="display: <?php if($fotomecanica->estado!='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo getField("glosa",$datos,$ing) ?></textarea>
		</div>
                
	</div>
    <?php
    $orden=$this->orden_model->getOrdenesPorCotizacion($id);
    $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
    if( sizeof($orden)==0 and $ordenDeCompra->estado == 0 or $ordenDeCompra->estado == 2 )
    {
//        if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') {	   ?>
<!--                <div class="control-group">
                        <div class="form-actions">
                                <strong>NO SE PUEDE GRABAR PORQUE ES UNA REPETICION SIN CAMBIOS</strong>
                        </div>
                </div>-->
        <?php // } else { ?>	
            <div class="control-group">
                <div class="form-actions">
                    <input type="hidden" name="id" value="<?php echo $id?>" />
                    <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
                    <input type="hidden" name="estado" />
                    <?php
                    if( $this->session->userdata('perfil')!=2) { ?>
                           <?php if(sizeof($hoja)>0 && $ing->archivo!=""){ ?>  
                        <input type="button" value="Guardar" class="btn <?php if($fotomecanica->estado==0){echo 'btn-warning';}?>" disabled="disabled" onclick="guardarFormularioAdd3('0');"/>
                        <?php }else{ ?>  
                        <input type="button" value="Guardar" class="btn <?php if($fotomecanica->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd3('0');"/>
                        <?php }?>  
                           <!--<input type="button" value="Guardar" class="btn <?php// if($fotomecanica->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />-->
                           <input type="button" value="Rechazar" class="btn <?php if($fotomecanica->estado==2){echo 'btn-warning';}?>"  onclick="rechazarFormularioAdd3(<?php echo $id ?>);" />
                           <?php 
                                if($ing->estado==2){ ?>
                                <a style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Esta cotización se encuentra rechazada&nbsp;&nbsp;</a>   
                                <?php }else{
                                if ($datos->ot_antigua=="") { ?>
                                <?php if ((!empty($ing->archivo) && empty($fotomecanica->archivo))) { ?>
                                <input type="button" value="Liberar" id="liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd3('1');" />
                                 <?php }else{
                                     if($molde->archivo!=""){ ?>
                                         <input type="button" value="Liberar" id="liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd3('1');"/>
                                     <?php }
                                 } ?>
                           <?php }// else {?>
                                <input type="button" value="Liberar"  id="liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd3('1');" />
                                <?php }// } ?>                                
                    <?php } ?>
                </div>
            </div>
        <?php
//            }
    } else { ?>
        
            <div class="control-group">
                <div class="form-actions">
                 <input type="hidden" name="id" value="<?php echo $id?>" />
                 <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
                 <input type="hidden" name="estado" />
                 <?php $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde) ?>
                 <?php
                 if( $this->session->userdata('perfil')!=2) {  ?>
                    <?php if(sizeof($hoja)>0){ ?>  
                        <input type="button" value="Guardar" class="btn <?php if($fotomecanica->estado==0){echo 'btn-warning';}?>" disabled="disabled" onclick="guardarFormularioAdd('0');"/>
                        <?php }else{ ?>  
                        <input type="button" value="Guardar" class="btn <?php if($fotomecanica->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');"/>
                        <?php }?>  
                        <!--<input type="button" value="Guardar" class="btn <?php //if($fotomecanica->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />-->
                        <input type="button" value="Rechazar" class="btn <?php if($fotomecanica->estado==2){echo 'btn-warning';}?>" onclick="rechazarFormularioAdd(<?php echo $id ?>);" />
                        <?php 
                        if($ing->estado==2){ ?>
                         <div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Esta cotización se encuentra rechazada</div>   
                        <?php }else{
                        if (!empty($ing->archivo)) { ?>
                        <input type="button" value="Liberar"  id="liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
                        <?php }?>
                        <?php }?>
                <?php } ?>
                </div>
            </div>        
		<div class="control-group">
                    <div class="form-actions">
                        <strong>NO SE PUEDE GRABAR PORQUE YA FUE ECHA LA ORDEN DE COMPRA</strong>
                    </div>
                </div>
<?php }  ?>
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Revisión Ingeniería</li>
    </ol>
    <span class="ir-arriba icon-arrow-up">↑</span>
    <div id="mensajeajax" class="control-group"></div>
</div>
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
<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        //document.form.cliente.focus();
        }
            
    );
  
    
</script>
<script type="text/javascript">

function nameFormatter(value, row) {
	var icon = row.id % 2 === 0 ? 'glyphicon-star' : 'glyphicon-star-empty'

	return '<i class="glyphicon ' + icon + '"></i> ' + value;
}

function priceFormatter(value) {
	// 16777215 == ffffff in decimal
	var color = '#'+Math.floor(Math.random() * 6777215).toString(16);
	return '<div  style="color: ' + color + '">' +
			'<i class="glyphicon glyphicon-usd"></i>' +
			value.substring(1) +
			'</div>';
}

	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
 
	$(window).scroll(function(){
//		if( $(this).scrollTop() > 0 ){
//			$('.ir-arriba').slideDown(300);
//		} else {
//			$('.ir-arriba').slideUp(300);
//		}
	});
        
	$('.ir-arriba2').click(function(){
		$('body, html').animate({
			scrollTop: '4700px'
		}, 300);
	});
 
	$(window).scroll(function(){
//		if( $(this).scrollTop() > 0 ){
//			$('.ir-arriba2').slideUp(300);
//		} else {
//			$('.ir-arriba2').slideDown(300);
//		}
	});
        
        //alert($("select[name=hay_que_troquelar]").val());
            
     
    
</script>
<script type="text/javascript">
//$(document).ready(()=>{
//       if($("select[name=hay_que_troquelar]").val()=="NO"){
//     $("select[name=select_estan_los_moldes] option[value='NO LLEVA']").attr("selected","true");
//     $("#lleva_troquelado").val("NO");
//     $("#hacer_troquel2").val("NO"); 
//    }else{
//        if($("select[name=hay_que_troquelar]").val()=="SI" && $("input[name=nm]").val()==""){
//            $("select[name=select_estan_los_moldes]").val("");
//            $("select[name=select_estan_los_moldes] option[value='NO LLEVA']").removeAttr("selected");
//            $("#lleva_troquelado").val("SI");
//            $("#hacer_troquel2").val("SI"); 
//        }else{
//            if($("select[name=hay_que_troquelar]").val()=="SI" && $("input[name=nm]").val()!==""){
//                $("select[name=select_estan_los_moldes]").val("SI");
//                $("select[name=select_estan_los_moldes] option[value='NO LLEVA']").removeAttr("selected");
//                $("#lleva_troquelado").val("SI");
//                if($("input[name=nm]").val()=="21" || ($("input[name=existe_trazado]").val()=="SI")){
//                 $("#hacer_troquel2").val("SI");
//                    }else{
//                 $("#hacer_troquel2").val("NO");       
//                    }
//                /*$("#hacer_troquel2").val("NO"); */
//            }
//        }
//     }
//});
</script>