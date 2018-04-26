
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
?>
<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Revisión Ingeniería</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Revisión Ingeniería</h3></div>
    
    <p>
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
            <li>Cliente : <?php echo $cliente?></li>
            <li>Cotización número : <?php echo $id?></li>
            <li>Fecha : <?php echo fecha($datos->fecha)?></li>
            <li>Vendedor : <?php echo $vendedor->nombre?></li>
            <li>Liberado: <?php echo $datos->fecha?></li>
        </ul>
    </p>
	
    <div class="control-group">
		<label class="control-label" for="usuario"><strong>PDF Fotomecánic</strong>a</label>
		<div class="controls">
			<?php if ($fotomecanica->archivo==""){ ?>
			      <a href='#'>No Existe Archivo de Trazado</a>
		    <?php }
			      else{ ?>
				  <a href='<?php echo base_url(); ?>public/uploads/cotizacion_archivo_fotomecanica/<?php echo $fotomecanica->archivo ?>' target="_blank"><i class="icon-search"></i></a>
				  <?php } ?>
				  <?php //var_dump($ing); ?>
		</div>
	</div>
    <hr />	
  <div class="control-group">
		<label class="control-label" for="usuario"><strong>PDF Ingeniería</strong></label>
		<div class="controls">
			<?php if ($ing->archivo==""){ ?>
			      <a href='#'>No Existe Archivo de Trazado</a>
		    <?php }
			      else{ ?>
				  <a href='<?php echo base_url(); ?>public/uploads/pdf_trazado/<?php echo $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
				  <?php } ?>
				  <?php //var_dump($ing); ?>
		</div>
	</div>
    <hr />	
    <div class="control-group">
        <label class="control-label" for="usuario"><strong>Archivo Cliente</strong></label>
		<div class="controls">
            <?php
             $archivo_cliente=$this->cotizaciones_model->getArchivoClientePorCotizacion($id);
            ?>
			<?php if ($archivo_cliente->archivo==""){ ?>
			      <a href='#'>No Existe Archivo de Trazado</a>
		    <?php }
			      else{ ?>
				  <a href='<?php echo base_url(); ?>public/uploads/cotizacion_archivo_cliente/<?php echo $archivo_cliente->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
				  <?php } ?>
				  <?php //var_dump($ing); ?>
		</div>
	</div>
    <hr />	

    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">OP Asociadas <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <select name="cantidad_ordenes" onchange="listaOrdenes('<?php echo base_url()?>ordenes/listado_cotizaciones',this.value,'<?php echo $datos->id_cliente?>','<?php echo $id?>','ordenes_de_producción');">
                       <option value="NO" <?php if($ing->cantidad_ordenes=='NO'){echo 'selected="true"';}?>>NO</option>
                       <option value="SI" <?php if($ing->cantidad_ordenes=='SI'){echo 'selected="true"';}?>>SI</option>
                    </select>
		</div>
	</div>
    
    <!--órdenes de producción asociadas-->
    <div id="ordenes_de_producción" class="control-group"></div>
    <!--/órdenes de producción asociadas-->
    
	
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
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Descripción del Producto, se debe revisar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input style="width: 500px;" type="text" name="producto" placeholder="Descripción del Producto" onblur="ValidarNombreProducto();" value="<?php echo getField('producto',$datos,$ing)?>" onkeypress="return alpha_con_numeros(event)" /><a style="color:#BBBBBB"> [<?php echo $datos->producto ?>] </a>
           
		</div>
	</div>
  
  
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Medidas de la caja <strong>(centímetros)</strong></label>
		<div class="controls">
		   L  <input type="text" name="medidas_de_las_cajas"   id="medidas_de_las_cajas"   placeholder="L"  value="<?php echo getField('medidas_de_la_caja',$datos,$ing)?>"   style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas',Formato);" />
           A  <input type="text" name="medidas_de_las_cajas_2" id="medidas_de_las_cajas_2" placeholder="A"  value="<?php echo getField('medidas_de_la_caja_2',$datos,$ing)?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas_2',Formato);"/>
           H  <input type="text" name="medidas_de_las_cajas_3" id="medidas_de_las_cajas_3" placeholder="H"  value="<?php echo getField('medidas_de_la_caja_3',$datos,$ing)?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas_3',Formato);"/>
           AT <input type="text" name="medidas_de_las_cajas_4" id="medidas_de_las_cajas_4" placeholder="AT" value="<?php echo getField('medidas_de_la_caja_4',$datos,$ing)?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDecimales('medidas_de_las_cajas_4',Formato);"/>
		</div>
	</div>
    
   
    
    <div class="control-group">
		<label class="control-label" for="usuario">Largo y Ancho 1</label>
		<div class="controls">
			ALETA<input type="text" name="aleta_pegado" placeholder="Aleta Pegado" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo getField('aleta_pegado',$datos,$ing) ?>" style="width: 50px;" />
            L<input type="text" name="largo_1" placeholder="Largo 1" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo getField('largo_1',$datos,$ing) ?>" style="width: 50px;" />
            A<input type="text" name="ancho_1" placeholder="Ancho 1" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo getField('ancho_1',$datos,$ing) ?>" style="width: 50px;" />
            H<input type="text" name="largo_2" placeholder="Largo 2" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo getField('largo_2',$datos,$ing) ?>" style="width: 50px;" />
            AT<input type="text" name="ancho_2" placeholder="Ancho 2" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo getField('ancho_2',$datos,$ing) ?>" style="width: 50px;" />
            <?php if(sizeof($ing)>0){?> Total suma : <?php echo number_format($ing->suma_largo_aleta,0,'','.')?> <?php }?>
		</div>
	</div>
    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Largo total de la caja</label>
		<div class="controls">
			<input type="text" name="largo_total_de_la_caja" placeholder="Largo total de la caja" onkeypress="return soloNumeros(event)" value="<?php echo getField('largo_total_de_la_caja',$datos,$ing) ?>" />
		</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Unidades por pliego <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="unidades_por_pliego" placeholder="Unidades por pliego" id="unidades_por_pliego" onkeypress="return soloNumeros(event)" value="<?php echo getField('unidades_por_pliego',$datos,$ing) ?>" /><a style="color:#BBBBBB"> [<?php echo number_format($datos->unidades_por_pliego,0,'','.')?>] </a>
         
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="id_antiguo">Lleva troquelado</label>
		<div class="controls">

		<?php
		if(sizeof($ing) == 0)
            {
		?>
		<input readonly="true" type="text" name="hacer_troquel"  value="<?php if($datos->estan_los_moldes=="SI"){echo 'SI';} if($datos->estan_los_moldes=="NO"){echo 'SI';} if($datos->estan_los_moldes=="NO LLEVA"){echo 'NO';} if($datos->estan_los_moldes=="CLIENTE LO APORTA"){echo 'SI';} ?>" />
        <!--
		<select name="lleva_troquelado" onchange="moldeparaingenieria(this.value);">
                    <option value="SI" <?php //if($ing->lleva_troquelado=="SI"){echo 'selected="true"';}?>>SI</option>
                    <option value="NO" <?php //if($ing->lleva_troquelado=="NO"){echo 'selected="true"';}?>>NO</option>
                    
        </select>
	    -->
		<?php
			}
			elseif(sizeof($ing)>= 1)
            {
		?>
		<input readonly="true" type="text" name="hacer_troquel"  value="<?php if($ing->estan_los_moldes=="SI"){echo 'SI';} if($ing->estan_los_moldes=="NO"){echo 'SI';} if($ing->estan_los_moldes=="NO LLEVA"){echo 'NO';} if($ing->estan_los_moldes=="CLIENTE LO APORTA"){echo 'SI';} ?>" />
		
		
		
		<?php
			}
		?>
		</div>
	</div> 
    
    <div class="control-group" id="hacer_troquel" style="display: block;">
		<label class="control-label" for="id_antiguo">Hacer Troquel</label>
		<div class="controls">
		
		<?php
		if(sizeof($ing) == 0)
		   {
		?>

			<input readonly="true" type="text" name="hacer_troquel"  value="<?php if($datos->estan_los_moldes=="SI"){echo 'SI';} if($datos->estan_los_moldes=="NO"){echo 'SI';} if($datos->estan_los_moldes=="NO LLEVA"){echo 'NO';} if($datos->estan_los_moldes=="CLIENTE LO APORTA"){echo 'NO';} ?>" />

		<?php
			}elseif(sizeof($ing)>= 1)
            {
		?>
		<input readonly="true" type="text" name="hacer_troquel"  value="<?php if($ing->estan_los_moldes=="NO" and $datos->condicion_del_producto=="Nuevo"){echo 'SI';} if($ing->estan_los_moldes=="SI" and $datos->condicion_del_producto=="Nuevo"){echo 'NO';} if($datos->condicion_del_producto=="Repetición Sin Cambios"){echo 'NO';}if($ing->estan_los_moldes=="NO LLEVA"){echo 'NO';} if($ing->estan_los_moldes=="CLIENTE LO APORTA"){echo 'NO';} ?>" />
		
		<?php
			}
		?>
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
						<option value="NO" <?php if($ing->troquel_por_atras=="NO"){echo 'selected="selected"';}?>>Por adelante</option>
						<option value="SI" <?php if($ing->troquel_por_atras=="SI"){echo 'selected="selected"';}?>>Por atrás</option>
					</select> 			
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
	
    <div class="control-group" id="estan_los_moldes" style="display: block;">
		<label class="control-label" for="usuario">Están los moldes?</label>
		<div class="controls">
			 <?php
			 // Ing Ya guardada
            if(sizeof($ing)>= 1)
            {
				?>
						<select name="estan_los_moldes1" style="width: 100px;" onchange="estanLosMoldes2(this.value);">
						
						<option value="NO" <?php if($ing->estan_los_moldes=="NO" and $datos->condicion_del_producto=="Nuevo"){echo 'selected="selected"';}?>>NO</option>
						<option value="SI" <?php if($ing->estan_los_moldes=="SI" ){echo 'selected="selected"';}?>>SI</option>
						<option value="NO LLEVA" <?php if($ing->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
						<option value="CLIENTE LO APORTA" <?php if($ing->estan_los_moldes=="CLIENTE LO APORTA"){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
						</select> 
						
						
					<div id="molde_select" style="visibility: <?php if($ing->estan_los_moldes=="SI"){echo 'initial';}else{echo 'hidden';}?>">
			  
					   <?php $moldes=$this->moldes_model->getMoldes(); ?>
							<select class="chosen-select" name="molde_si" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');">
								<?php
								
								foreach($moldes as  $molde)
								{
									?>
									<option value="<?php echo $molde->id?>" <?php if($ing->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
									<?php
								}
								?>
								
							</select> 
					<span id="div_moldes"></span>
					</div>
                <?php
            }else //Ing sin guardar
            {
                ?>

                <select name="estan_los_moldes0" style="width: 100px;" onchange="estanLosMoldes2(this.value);">
                <option value="SI" <?php if($datos->estan_los_moldes=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->estan_los_moldes=="NO" or $condicionFull=="Nuevo"){echo 'selected="selected"';}?>>NO</option>
                <option value="NO LLEVA" <?php if($datos->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
                <option value="CLIENTE LO APORTA" <?php if($datos->estan_los_moldes=="CLIENTE LO APORTA"){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
            </select> 
            <div id="molde_select" style="visibility: hidden">
			<?php $moldes=$this->moldes_model->getMoldes(); ?>
            <select class="chosen-select" name="molde_si" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');" >
                <?php
                
                foreach($moldes as  $molde)
                {
                    ?>
                    <option value="<?php echo $molde->id?>" <?php if($datos->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                    <?php
                }
                ?>
                
            </select> 
            <span id="div_moldes"></span>
            </div>
                <?php
            }
                ?>
            
            
		</div>
	</div>
    <?php
    if(sizeof($ing)==0)
    {
        ?>
        <div class="control-group" id="crea_molde" style="display: <?php if($datos->estan_los_moldes=="NO" and $datos->condicion_del_producto=="Nuevo"){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario"><strong>Nombre Molde sugerido:</strong><strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input style="width: 400px;"type="text" name="nombre_molde" placeholder="Nombre Molde sugerido" value="<?php echo $ing->nombre_molde?>" /> 
		</div>
		</div>
        <?php
    }
	elseif(sizeof($ing)>=1)
    {
        ?>
        <div class="control-group" id="crea_molde" style="display: <?php if($ing->estan_los_moldes=="NO" and $datos->condicion_del_producto=="Nuevo"){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario"><strong>Nombre Molde sugerido;</strong><strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input style="width: 400px;" type="text" name="nombre_molde" placeholder="Nombre Molde sugerido" value="<?php echo $ing->nombre_molde?>" /> 
		</div>
	</div>
        <?php
    }
    ?>
    
    
   <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Piezas totales en el pliego ( para desgajado )<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="piezas_totales_en_el_pliego" placeholder="piezas totales en el pliego (para desgajado)" id="piezas_totales_en_el_pliego" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id); PiezasTotales(this.value);" value="<?php echo getField('piezas_totales_en_el_pliego',$datos,$ing) ?>" /><a style="color:#BBBBBB"> [<?php echo number_format($datos->piezas_totales_en_el_pliego,0,'','.')?>] </a>
         
		</div>
	</div>


    
    <div class="control-group" id="metroDeCuchillo" style="display: <?php if($datos->estan_los_moldes=="NO" and $datos->condicion_del_producto!="Repetición Sin Cambios"){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Metros de cuchillo</label>
		<div class="controls">
			<input type="text" name="metros_de_cuchillo" id="metros_de_cuchillo" placeholder="Metros de cuchillo" id="metros_de_cuchillo" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo getField('metros_de_cuchillo',$datos,$ing) ?>" /><a style="color:#BBBBBB"> [<?php echo $datos->metros_de_cuchillo?>] </a>
         
		</div>
	</div>
    
	
	
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Tamaño a imprimir <strong>Ancho por Largo </strong>(largo a cortar) :<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="tamano_1" style="width: 100px;" id="tamano_1" onkeypress="return soloNumerosConPuntos(event)"  value="<?php echo getField('tamano_a_imprimir_1',$datos,$ing) ?>" placeholder="0" onblur="tamano1NoMasDe100(); funcionDecimales('tamano_1',Formato);" /> X <input type="text" name="tamano_2" id="tamano_2" style="width: 100px;" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo getField('tamano_a_imprimir_2',$datos,$ing) ?>" placeholder="0" onblur="tamano2NoMasDe100(); funcionDecimales('tamano_2',Formato);" /> Cms.<a style="color:#BBBBBB"> [<?php echo $datos->tamano_a_imprimir_1." X ".$datos->tamano_a_imprimir_2." Cms"?>] </a> 
		</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Distancia cuchillo a cuchillo<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="tamano_cuchillo_1" style="width: 100px;"  value="<?php echo getField('tamano_cuchillo_1',$datos,$ing) ?>" placeholder="0" onblur="cuchillo();" onkeypress="return soloNumerosConPuntos(event)" /> X <input type="text" name="tamano_cuchillo_2" style="width: 100px;" value="<?php echo getField('tamano_cuchillo_2',$datos,$ing) ?>" placeholder="0" onblur="cuchillo();" onkeypress="return soloNumerosConPuntos(event)" /> Cms. 
		</div>
	</div>
    
    
  
    
    <h3>Materialidad<strong style="color: red;">(*)</strong></h3>
    
    
    
    <!--materialidad-->
    <?php
    if(sizeof($ing)==0)
    {
        ?>
        <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
            <?php
            $materialidads=$this->datos_tecnicos_model->getDatosTecnicos();
            $datos_tecnicos=$datos->materialidad_datos_tecnicos;
            ?>
			<select name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');" class="chosen-select">
                <?php
                foreach($materialidads as $key => $materialidad)
                {
                    ?>
                    <option value="<?php echo $materialidad->id?>" <?php if($datos->materialidad_datos_tecnicos==$materialidad->datos_tecnicos){echo 'selected="selected"';}?>><?php echo $materialidad->datos_tecnicos?></option>
                    <?php
                }
                ?>
                
               
             
            </select>
            <?php if($datos->materialidad_datos_tecnicos == 'Se solicita proposición'){ echo '<h4><strong style="color: red;">'.$datos->materialidad_datos_tecnicos.'</strong></h4>';}else{ echo $datos->materialidad_datos_tecnicos;}?>
		</div>
	</div>
    
    <div id="materialidad">
        <?php
        switch($datos->materialidad_datos_tecnicos)
        {
            case 'Microcorrugado'://1
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                 <?php 
				$tapas=$this->materiales_model->getMaterialesSelectCartulina();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_1)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                     <?php 
				$tapas=$this->materiales_model->getMaterialesSelectOnda();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_2)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                  <?php 
				$tapas=$this->materiales_model->getMaterialesSelectLiner();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_3)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
    <input type="hidden" name="materialidad_4" value="No Aplica" />         
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
                <?php
            break;
            case 'Corrugado'://2
                 ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                  <?php 
				$tapas=$this->materiales_model->getMaterialesSelectCartulina();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_1)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                 <?php 
				$tapas=$this->materiales_model->getMaterialesSelectOnda();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_2)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php 
				$tapas=$this->materiales_model->getMaterialesSelectLiner();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_3)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
    <input type="hidden" name="materialidad_4" value="No Aplica" />         
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
                <?php
            break;
            case 'Cartulina-cartulina'://3
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"  <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                      <?php 
				$tapas=$this->materiales_model->getMaterialesSelectCartulina();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_1)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                      <?php 
				$tapas=$this->materiales_model->getMaterialesSelectCartulina();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_2)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
    <input type="hidden" name="materialidad_3" value="No Aplica" /> 
    <input type="hidden" name="materialidad_4" value="No Aplica" /> 
    <input type="hidden" name="materialidad_eleccion" value="tapa_tapa" />
                <?php
            break;
            case 'Sólo Cartulina'://4
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_2" value="No Aplica" />   
    <input type="hidden" name="materialidad_3" value="No Aplica" /> 
    <input type="hidden" name="materialidad_4" value="No Aplica" />
    <input type="hidden" name="materialidad_eleccion" value="tapa_tapa" />
                <?php
            break;
            case 'Onda a la Vista (MicroCorrugado/Corrugado)'://5
                ?>
                     <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner 2</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Onda 2</label>
    		<div class="controls">
    			<select name="materialidad_4" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_4?>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_eleccion" value="mono_mono" />
                <?php
            break;
            case 'Otro'://6
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">MonoTapa</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                   <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?>
    		</div>
    	</div>
    <input type="hidden" name="materialidad_3" value="No Aplica" /> 
    <input type="hidden" name="materialidad_4" value="No Aplica" />
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
                <?php
            break;
            case 'Se solicita proposición'://7
                ?>
                <input type="hidden" name="materialidad_1" value="No Aplica" /> 
                <input type="hidden" name="materialidad_2" value="No Aplica" /> 
                <input type="hidden" name="materialidad_3" value="No Aplica" /> 
                <input type="hidden" name="materialidad_4" value="No Aplica" /> 
                <?php
            break;
            case 'Onda a la Vista (Corrugado/Corrugado)'://5
                ?>
                     <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner 2</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Onda 2</label>
    		<div class="controls">
    			<select name="materialidad_4" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_4?>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_eleccion" value="mono_mono" />
                <?php
            break;
			case 'Onda a la Vista (MicroCorrugado/MicroCorrugado)'://5
                ?>
                     <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner 2</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Onda 2</label>
    		<div class="controls">
    			<select name="materialidad_4" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_4?>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_eleccion" value="mono_mono" />
                <?php
            break;
        }
        ?>    
    </div>
        <?php
    }else
    {
        ?>
         <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
            <?php
            $materialidads=$this->datos_tecnicos_model->getDatosTecnicos();
            ?>
			<select name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');" class="chosen-select">
                <?php
                foreach($materialidads as $key => $materialidad)
                {
                    ?>
                    <option value="<?php echo $materialidad->id?>" <?php if($ing->materialidad_datos_tecnicos==$materialidad->datos_tecnicos){echo 'selected="selected"';}?>><?php echo $materialidad->datos_tecnicos?></option>
                    <?php
                }
                ?>
                
               
             
            </select>
            <?php echo $datos->materialidad_datos_tecnicos?>
		</div>
	</div>
    
    <div id="materialidad">
        <?php
        switch($ing->materialidad_datos_tecnicos)
        {
            case 'Microcorrugado'://1
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                      <?php 
				$tapas=$this->materiales_model->getMaterialesSelectCartulina();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_1)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>1
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                     <?php 
				$tapas=$this->materiales_model->getMaterialesSelectOnda();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_2)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                 <?php 
				$tapas=$this->materiales_model->getMaterialesSelectLiner();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_3)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
    <input type="hidden" name="materialidad_4" value="No Aplica" />         
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
                <?php
            break;
            case 'Corrugado'://2
                 ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                 <?php 
				$tapas=$this->materiales_model->getMaterialesSelectCartulina();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_1)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                 <?php 
				$tapas=$this->materiales_model->getMaterialesSelectOnda();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_2)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                   <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                 <?php 
				$tapas=$this->materiales_model->getMaterialesSelectLiner();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_3)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
    <input type="hidden" name="materialidad_4" value="No Aplica" />         
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
                <?php
            break;
            case 'Cartulina-cartulina'://3
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"  <?php if($tapa->nombre==$ing->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                 <?php 
				$tapas=$this->materiales_model->getMaterialesSelectCartulina();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_1)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                 <?php 
				$tapas=$this->materiales_model->getMaterialesSelectCartulina();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_2)
							{
								
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.')';
							
							}			
					}
				?>
    		</div>
    	</div>
    <input type="hidden" name="materialidad_3" value="No Aplica" /> 
    <input type="hidden" name="materialidad_4" value="No Aplica" /> 
    <input type="hidden" name="materialidad_eleccion" value="tapa_tapa" />
                <?php
            break;
            case 'Sólo Cartulina'://4
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_2" value="No Aplica" />   
    <input type="hidden" name="materialidad_3" value="No Aplica" /> 
    <input type="hidden" name="materialidad_4" value="No Aplica" />
    <input type="hidden" name="materialidad_eleccion" value="tapa_tapa" />
                <?php
            break;
            case 'Onda a la Vista (MicroCorrugado/Corrugado)'://5
                ?>
                     <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner 2</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Onda 2</label>
    		<div class="controls">
    			<select name="materialidad_4" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_4?>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_eleccion" value="mono_mono" />
                <?php
            break;
            case 'Otro'://6
                ?>
                <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">MonoTapa</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$ing->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?>
    		</div>
    	</div>
    <input type="hidden" name="materialidad_3" value="No Aplica" /> 
    <input type="hidden" name="materialidad_4" value="No Aplica" />
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
                <?php
            break;
            case 'Se solicita proposición'://7
                ?>
                <input type="hidden" name="materialidad_1" value="No Aplica" /> 
                <input type="hidden" name="materialidad_2" value="No Aplica" /> 
                <input type="hidden" name="materialidad_3" value="No Aplica" /> 
                <input type="hidden" name="materialidad_4" value="No Aplica" /> 
                <?php
            break;
                      case 'Onda a la Vista (Corrugado/Corrugado)'://5
                ?>
                     <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner 2</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Onda 2</label>
    		<div class="controls">
    			<select name="materialidad_4" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_4?>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_eleccion" value="mono_mono" />
                <?php
            break;
			case 'Onda a la Vista (MicroCorrugado/MicroCorrugado)'://5
                ?>
                     <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner 2</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectLiner();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Onda 2</label>
    		<div class="controls">
    			<select name="materialidad_4" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_4?>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_eleccion" value="mono_mono" />
                <?php
            break;  
        }
        ?>    
    </div>
        <?php
    }
        ?>
    
     <!--/materialidad-->
    
    <h3>Piezas Adicionales</h3>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
			<select name="piezas_adicionales">
                <option value="0">Seleccione.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    if(sizeof($ing)==0)
                    {
                        $piezas_adicionales=$datos->piezas_adicionales;
                    }else
                    {
                        $piezas_adicionales=$ing->piezas_adicionales;
                    }
                   
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($piezas_adicionales==$pieza->piezas_adicionales){echo 'selected="true"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select><a style="color:#BBBBBB"> [<?php echo $ing->piezas_adicionales; ?>] </a>
		</div>
	</div>
    
	 <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 2</label>
		<div class="controls">
			<select name="piezas_adicionales2">
                <option value="0">Seleccione.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    if(sizeof($ing)==0)
                    {
                        $piezas_adicionales=$datos->piezas_adicionales2;
                    }else
                    {
                        $piezas_adicionales=$ing->piezas_adicionales2;
                    }
                   
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($piezas_adicionales==$pieza->piezas_adicionales){echo 'selected="true"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select><a style="color:#BBBBBB"> [<?php echo $ing->piezas_adicionales2; ?>] </a>
		</div>
	</div>
	
		 <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 3</label>
		<div class="controls">
			<select name="piezas_adicionales3">
                <option value="0">Seleccione.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    if(sizeof($ing)==0)
                    {
                        $piezas_adicionales=$datos->piezas_adicionales3;
                    }else
                    {
                        $piezas_adicionales=$ing->piezas_adicionales3;
                    }
                   
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($piezas_adicionales==$pieza->piezas_adicionales){echo 'selected="true"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
            </select><a style="color:#BBBBBB"> [<?php echo $ing->piezas_adicionales3; ?>] </a>
		</div>
	</div>
	
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Detalle Piezas Adicionales</label>
		<div class="controls">
			<input type="text" name="detalle_piezas_adicionales" placeholder="Detalle Piezas Adicionales" value="<?php echo $ing->detalle_piezas_adicionales?>" />
         
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Piezas Adicionales</label>
		<div class="controls">
			<textarea id="contenido5" name="comentario_piezas_adicionales" placeholder="Observaciones"><?php echo $ing->comentario_piezas_adicionales?></textarea>
		</div>
	</div>
    
    
    <h3>Pegado</h3>
    
      
    <div class="control-group">
		<label class="control-label" for="usuario">Pegado</label>
		<div class="controls">
     
			<select name="pegado" onchange="ValidarPegado(this.value)">
                <option value="SI" <?php if($ing->pegado=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($ing->pegado=="NO"){echo 'selected="selected"';}?>>NO</option>
                
            </select>
            <br />
		</div>
	</div>
    
    
    <div class="control-group" id="adhesivo">
		<label class="control-label" for="id_antiguo">Adhesivos</label>
		<div class="controls">
		    <select name="adhesivo" onchange="pegadoyAdhesivos2(this.value)">
                   <?php
                   foreach($adhesivos as $adhesivo)
                   {
                    ?>
                        <option value="<?php echo $adhesivo->id?>" <?php if($ing->id_adhesivo==$adhesivo->id){echo 'selected="selected"';}?>><?php echo $adhesivo->nombre?> (<?php echo $adhesivo->codigo?>)</option>
                    <?php
                   }
                   ?>
            </select>
	
		</div>
	</div> 
    
     <div class="control-group" style="display: <?php if($ing->id_adhesivo==2){echo 'block';}?>;" id="lleva_aletas">
		<label class="control-label" for="usuario">Lleva aletas dobladas</label>
		<div class="controls">
			<select name="lleva_aletas">
                <option value="SI" <?php if($ing->lleva_aletas=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($ing->lleva_aletas=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
		</div>
	</div>
    
    <div class="control-group" style="display: <?php if($ing->id_adhesivo==2){echo 'block';}?>;" id="total_aplicaciones_adhesivo">
		<label class="control-label" for="usuario">Total de aplicaciones con este adhesivo</label>
		<div class="controls">
                <input type="text" name="total_aplicaciones_adhesivo" value="<?php echo $ing->total_aplicaciones_adhesivo?>" placeholder="Total de aplicaciones con este adhesivo" />
            
		</div>
	</div>
    
     
    
    <div class="control-group" id="doblado">
		<label class="control-label" for="usuario">Doblado</label>
		<div class="controls">
     
			<select name="doblado">
               <option value="SI" <?php if($ing->doblado=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($ing->doblado=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select>
            <br />
		</div>
	</div>
    
    <div class="control-group" id="empaquetado">
		<label class="control-label" for="usuario">Empaquetado</label>
		<div class="controls">
     
			<select name="empaquetado">
               <option value="SI" <?php if($ing->empaquetado=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($ing->empaquetado=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select>
            <br />
		</div>
	</div>
    
    <div class="control-group" id="pegado_manual">
		<label class="control-label" for="usuario">Pegado Manual</label>
		<div class="controls">
     
			<select name="tipo_pegado">
                <option value="Pegado manual" <?php if($ing->tipo_pegado=="Pegado manual"){echo 'selected="selected"';}?>>Pegado manual</option>
                <option value="Pegado máquina" <?php if($ing->tipo_pegado=="Pegado máquina"){echo 'selected="selected"';}?>>Pegado automático</option>
                
            </select>
		</div>
	</div>
    
    <div class="control-group" id="pegado_puntos">
		<label class="control-label" for="usuario">Pegado puntos</label>
		<div class="controls">
     
			<select name="pegado_puntos">
                 <option value="1 punto" <?php if($ing->tipo_de_pegado=="1 punto"){echo 'selected="selected"';}?>>1 Punto</option>
                <option value="2 punto" <?php if($ing->tipo_de_pegado=="2 punto"){echo 'selected="selected"';}?>>2 Punto</option>
                <option value="3 punto" <?php if($ing->tipo_de_pegado=="3 punto"){echo 'selected="selected"';}?>>3 Punto</option>
                <option value="4 punto" <?php if($ing->tipo_de_pegado=="4 punto"){echo 'selected="selected"';}?>>4 Punto</option>
            </select>
		</div>
	</div>
    
    <div class="control-group" id="cm_pegado_puntos">
		<label class="control-label" for="usuario">Centímetros de línea de pegado</label>
		<div class="controls">
            <input type="text" name="pegado_cantidad_puntos" value="<?php echo $ing->pegado_cantidad_puntos?>" />
		</div>
	</div>
    
    <div class="control-group" id="tipo_fondo">
		<label class="control-label" for="usuario">Tipo fondo</label>
		<div class="controls">
     
			<select name="tipo_fondo">
                <option value="Automático" <?php if($ing->tipo_fondo=="Automático"){echo 'selected="selected"';}?>>Automático</option>
                <option value="Americano" <?php if($ing->tipo_fondo=="Americano"){echo 'selected="selected"';}?>>Americano</option>
                <option value="De solapa" <?php if($ing->tipo_fondo=="De solapa"){echo 'selected="selected"';}?>>De solapa</option>
                <option value="Otro" <?php if($ing->tipo_fondo=="Otro"){echo 'selected="selected"';}?>>Otro</option>
            </select>
            
		</div>
	</div>
    
    <div class="control-group"  id="tamano_pieza_a_empaquetar">
		<label class="control-label" for="usuario">Tamaño de pieza a empaquetar</label>
		<div class="controls">
			<input type="text" name="tamano_pieza_a_empaquetar_ancho" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo getField('tamano_pieza_a_empaquetar_ancho',$datos,$ing) ?>" placeholder="0" /> X <input type="text" name="tamano_pieza_a_empaquetar_largo" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo getField('tamano_pieza_a_empaquetar_largo',$datos,$ing) ?>" placeholder="0" /> 
		</div>
	</div>
    
    <div class="control-group" id="es_para_maquina">
		<label class="control-label" for="usuario">Es para máquina?</label>
		<div class="controls">
			<select name="es_una_maquina">
                <option value="NO" <?php if($ing->es_una_maquina=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php if($ing->es_una_maquina=="SI"){echo 'selected="selected"';}?>>SI</option>
                
            </select>
		</div>
	</div>
     <h3>Otros datos</h3>
    
    
    
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Es impresión compartida? (% porcentaje de cada producto)</label>
		<div class="controls">
			<input type="text" name="impresion_compartida" placeholder="Es impresión compartida? (% porcentaje de cada producto)" id="impresion_compartida" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $ing->impresion_compartida?>" />
         
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">El producto final contiene otras cotizaciones?</label>
		<div class="controls">
			<select name="contiene_otras_cotizaciones" style="width: 100px;">
                 <option value="NO" <?php if($ing->contiene_otras_cotizaciones=="NO"){echo 'selected="selected"';}?>>NO</option>
                 <option value="SI" <?php if($ing->contiene_otras_cotizaciones=="SI"){echo 'selected="selected"';}?>>SI</option>
                
            </select> 
            <input type="text" name="numero_cotizacion" placeholder="Número cotización" onkeypress="return soloNumeros(event)" value="<?php echo $ing->numero_cotizacion?>" />
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Trabajos adicionales</label>
		<div class="controls">
			<select name="trabajos_adicionales" style="width: 100px;">
                 <option value="NO" <?php if($ing->trabajos_adicionales=="NO"){echo 'selected="selected"';}?>>NO</option>
                 <option value="SI" <?php if($ing->trabajos_adicionales=="SI"){echo 'selected="selected"';}?>>SI</option>
               
            </select> 
            <input type="text" name="trabajos_adicionales_glosa" placeholder="Especifique Trabajos" value="<?php echo $ing->trabajos_adicionales_glosa?>" />
        
		</div>
	</div>
    
    <h3>Ingrese PDF de trazado</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ingrese PDF del trazado</label>
		<div class="controls">
			<input type="file" id="file" name="file" />  
			<div id="nomarch"></div>
		</div>
	</div>
    
    <div class="control-group" id="rechazo" style="display: <?php if($ing->estado=='2'){echo 'block';}else{echo 'none';}?>;"> 
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa" placeholder="Observaciones"><?php echo getField("glosa",$datos,$ing) ?></textarea>
		</div>
	</div>
	
	 <?php
	 //Usuario 
				 if( $this->session->userdata('perfil')!=2)
					{
	 ?>
	
	
    <?php
    $orden=$this->orden_model->getOrdenesPorCotizacion($id);
    $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
    if( sizeof($orden)==0 and $ordenDeCompra->estado == 0 or $ordenDeCompra->estado == 2 )
    {
        	if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios')
		{		
        ?>
			<div class="control-group">
				<div class="form-actions">
					<strong>NO SE PUEDE GRABAR PORQUE ES UNA REPETICION SIN CAMBIOS</strong>
				</div>
			</div>
		<?php
		}else
		{
		?>	
    <div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
        <input type="hidden" name="estado" />
		
		
			<input type="button" value="Guardar" class="btn <?php if($ing->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
		    <?php
            //if(sizeof($hoja)==0)
           // {
                ?>
                <input type="button" value="Rechazar" class="btn <?php if($fotomecanica->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
                <?php
          //  }
            ?>
            <input type="button" value="Liberar" class="btn <?php if($ing->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
        </div>
	</div>
    <?php
		}
    }else
    {
        ?>
        <div class="control-group">
            <div class="form-actions">
                <strong>NO SE PUEDE GRABAR PORQUE YA FUE ECHA LA ORDEN DE COMPRA</strong>
            </div>
        </div>
        <?php
    }
    ?>
    
	 <?php
	 //Usuario 
	}
	 ?>
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
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>

<script type="text/javascript">


 var Formato = /^\s*-?[1-9]\d*(\.\d{1,2})?\s*$/;

 function funcionDecimales(id, restrictionType) 
 {

  var evaluar = document.getElementById(id).value;
  
  if(evaluar!=='')
  {
   if(restrictionType.test(evaluar)){
     <!-- alert('Correcto!'); -->
   }else{
    <!-- alert('Malo'); -->	
        document.getElementById(id).value = "";
   }
  }
  return;
    
 }
 
  
 </script>
 
 <script type="text/javascript">
         
    window.onload =  ValidarPegado(document.getElementsByName("pegado"));
    window.onload =  estanLosMoldes2(<?php $ing->estan_los_moldes; ?>);
    window.onload =  carga_ajax5("<?php echo base_url();?>moldes/detalle_ajax","<?php echo $ing->numero_molde;?>","div_moldes");
	

</script>
 
 
 