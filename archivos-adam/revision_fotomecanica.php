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
      <li>Revisión Fotomecánica</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Revisión Fotomecánica</h3></div>
    
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
            <li>Cliente : <b><?php echo $cliente?></b></li>
            <li>Cotización N° : <b><?php echo $id?></b></li>
            <li>Fecha : <b><?php echo fecha($datos->fecha)?></b></li>
            <li>Vendedor : <b><?php echo $vendedor->nombre?></b></li>
        </ul>
    </p>
	
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
	
	
  <div class="control-group">
		<label class="control-label" for="usuario">Identificacion del Producto</label>
		<div class="controls">
			
				<input style="width: 500px;" type="text" name="producto" onblur="ValidarNombreProducto();" value="<?php echo $ing->producto ?>"/>					
		</div>
  </div>
    <hr />
  <div class="control-group">
		<label class="control-label" for="usuario"><strong>PDF Fotomecánica</strong></label>
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
        ?>
			<select name="condicion_del_producto" >
                <?php
                foreach($condicions as $key=>$condicion)
                {
                    ?>
                     <option value="<?php echo $key?>" <?php if($condicionFull==$condicion and $condicion !=""){echo 'selected="selected"';}?>><?php if($condicionFull==$condicion){echo $condicion;} ?></option>
                    <?php
					if($condicionFull==$condicion)
					{break;}
                }
                ?>
               
            </select>
            <?php echo $datos->condicion_del_producto ?>
		</div>
	</div>
    
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
		<input readonly="true" type="text" name="hacer_troquel"  value="<?php  if($datos->condicion_del_producto=="Nuevo" and $ing->estan_los_moldes=="SI" ){echo 'NO';} if($datos->condicion_del_producto=="Nuevo" and $ing->estan_los_moldes=="NO" ){echo 'SI';} if($datos->condicion_del_producto=="Nuevo" and $ing->estan_los_moldes=="NO LLEVA" ){echo 'NO';} if($datos->condicion_del_producto=="Nuevo" and $ing->estan_los_moldes=="CLIENTE LO APORTA" ){echo 'NO';} /* ------ */ if($datos->condicion_del_producto=="Repetición Sin Cambios" and $ing->estan_los_moldes=="SI"){echo 'NO';} if($datos->condicion_del_producto=="Repetición Sin Cambios" and $ing->estan_los_moldes=="NO"){echo 'NO';} if($datos->condicion_del_producto=="Repetición Sin Cambios" and $ing->estan_los_moldes=="NO LLEVA"){echo 'NO';} if($datos->condicion_del_producto=="Repetición Sin Cambios" and $ing->estan_los_moldes=="CLIENTE LO APORTA"){echo 'NO';} /*-----*/  if($datos->condicion_del_producto=="Repetición Con Cambios" and $ing->estan_los_moldes=="SI"){echo 'NO';} if($datos->condicion_del_producto=="Repetición Con Cambios" and $ing->estan_los_moldes=="NO"){echo 'NO';}  if($datos->condicion_del_producto=="Repetición Con Cambios" and $ing->estan_los_moldes=="NO LLEVA"){echo 'NO';} if($datos->condicion_del_producto=="Repetición Con Cambios" and $ing->estan_los_moldes=="CLIENTE LO APORTA"){echo 'NO';}?>" />
		
		<?php
			}
		?>
		</div>
	</div> 
<div class="control-group" id="estan_los_moldes" style="display: block;">
		<label class="control-label" for="usuario">Están los moldes?</label>
		<div class="controls">
			 <?php
            if(sizeof($ing)>= 1)
            {
				
				 $Detalle_Molde=$this->moldes_model->getMoldesPorId($ing->numero_molde);
                ?>
			

           	<input type="text" name="estan_los_moldes" value="<?php if($ing->estan_los_moldes=="SI" and $Detalle_Molde->tipo=="Genérico" ){echo 'SI';} if($ing->estan_los_moldes=="SI" and $datos->condicion_del_producto=="Repetición Con Cambios" ){echo 'SI';} if($ing->estan_los_moldes=="SI" and $datos->condicion_del_producto=="Repetición Sin Cambios" ){echo 'SI';}    if($ing->estan_los_moldes == "NO LLEVA"){echo 'NO LLEVA';} if($ing->estan_los_moldes=="CLIENTE LO APORTA"){echo 'CLIENTE LO APORTA';} if($ing->estan_los_moldes=="SI" and $datos->condicion_del_producto=="Producto Genérico"){echo 'SI';} if($ing->estan_los_moldes=="NO" and $datos->condicion_del_producto=="Nuevo" ){echo 'NO';} if($ing->estan_los_moldes=="SI" and $datos->condicion_del_producto=="Nuevo" ){echo 'SI';}?>"  readonly="true"/>					
			
			
            <div id="molde_select" style="display:  <?php if($ing->estan_los_moldes=="SI" and $datos->condicion_del_producto!="Nuevo"){echo 'block';}else{echo 'none';}?>;">
            <!--<select name="molde" onchange="carga_ajax5('<?php //echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');" disabled>-->
                <?php
                $moldes=$this->moldes_model->getMoldes();
                foreach($moldes as $molde)
                {
					if($ing->numero_molde==$molde->id){
                    ?>
					  <br>
					Numero: <input style="width: 90px;" type="text" name="molde" value="<?php if($ing->numero_molde==$molde->id){ echo $ing->numero_molde;} ?>"  readonly="true"/>		
					<br>
					Nombre Molde: <input style="width: 400px;" type="text" name="moldeNombrre" value="<?php if($ing->numero_molde==$molde->id){ echo $molde->nombre;} ?>"  readonly="true"/>		
                    <!--<option value="<?php //echo $molde->id?>" <?php //if($ing->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php //echo $molde->nombre?> (N° <?php //echo $molde->numero?>)</option>-->
                    <?php
					}
                }
                ?>
                
				<!--</select> -->
				<span id="div_moldes"></span>
				</div>
				
				<div id="molde_select" style="display:  <?php if($ing->estan_los_moldes=="SI" and $Detalle_Molde->tipo=="Genérico"){echo 'block';}else{echo 'none';}?>;">
            <!--<select name="molde" onchange="carga_ajax5('<?php //echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');" disabled>-->
                <?php
                $moldes=$this->moldes_model->getMoldes();
                foreach($moldes as $molde)
                {
					if($ing->numero_molde==$molde->id){
                    ?>
					  <br>
					Numero: <input style="width: 90px;" type="text" name="molde" value="<?php if($ing->numero_molde==$molde->id){ echo $ing->numero_molde;} ?>"  readonly="true"/>		
					<br>
					Nombre Molde Genérico: <input style="width: 400px;" type="text" name="moldeNombrre" value="<?php if($ing->numero_molde==$molde->id){ echo $molde->nombre;} ?>"  readonly="true"/>		
                    <!--<option value="<?php //echo $molde->id?>" <?php //if($ing->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php //echo $molde->nombre?> (N° <?php //echo $molde->numero?>)</option>-->
                    <?php
					}
                }
                ?>
                
				<!--</select> -->
				<span id="div_moldes"></span>
				</div>
				
				
                <?php
            }else
            {
                ?>

                <select name="estan_los_moldes" style="width: 100px;" onchange="estanLosMoldes2(this.value);">
                <option value="SI" <?php if($datos->estan_los_moldes=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->estan_los_moldes=="NO" or $condicionFull=="Nuevo"){echo 'selected="selected"';}?>>NO</option>
                <option value="NO LLEVA" <?php if($datos->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
                <option value="CLIENTE LO APORTA" <?php if($datos->estan_los_moldes=="CLIENTE LO APORTA"){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
            </select> 
            <div id="molde_select" style="display: <?php if($datos->estan_los_moldes=="SI"){echo 'block';}else{echo 'none';}?>;">
            <select name="molde" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');">
                <?php
                $moldes=$this->moldes_model->getMoldes();
                foreach($moldes as $molde)
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
					if($Detalle_Molde->tipo !="Genérico")
					{
					?>
					<div class="control-group" id="crea_molde" style="display: <?php if($datos->estan_los_moldes=="NO" and $datos->condicion_del_producto=="Nuevo"){echo 'block';} if($ing->estan_los_moldes == "NO LLEVA"){echo 'none';}  if($ing->estan_los_moldes == "CLIENTE LO APORTA"){echo 'none';}?>;">
					<label class="control-label" for="usuario"><strong>Nombre Molde sugerido:</strong></label>
					<div class="controls">
						<input style="width: 400px;" type="text" name="nombre_molde" placeholder="Nombre Molde sugerido" value="<?php echo $ing->nombre_molde?>" readonly="true" /> 
					</div>
					</div>
					<?php
					}
				}
				elseif(sizeof($ing)>=1)
				{
					if($Detalle_Molde->tipo !="Genérico")
					{
								if($ing->numero_molde > 2 and $ing->estan_los_moldes=="SI")
								{
									
									$moldes=$this->moldes_model->getMoldes();
									foreach($moldes as $molde)
									{
									if($ing->numero_molde==$molde->id)
										{
											?>
											<div class="controls">
												<br>
												Numero: <input style="width: 90px;" type="text" name="molde" value="<?php if($ing->numero_molde==$molde->id){ echo $ing->numero_molde;} ?>"  readonly="true"/>		
												<br>
												Nombre Molde: <input style="width: 400px;" type="text" name="moldeNombrre" value="<?php if($ing->numero_molde==$molde->id){ echo $molde->nombre;} ?>"  readonly="true"/>		
												<br>
											</div>				
											<?php
										}
									}
								}else
								{
										if($ing->estan_los_moldes!="NO LLEVA" and $ing->estan_los_moldes!="CLIENTE LO APORTA")
										{
											?>
												<div class="control-group" id="crea_molde" style="display:<?php 
												if($datos->estan_los_moldes == "NO LLEVA" or $datos->estan_los_moldes == "CLIENTE LO APORTA" or $datos->condicion_del_producto=="Repetición Con Cambios" or $datos->condicion_del_producto=="Repetición Sin Cambios" or $datos->condicion_del_producto=="Producto Genérico")
												{
													echo 'none';
												} 

												?>;">
												<label class="control-label" for="usuario"><strong>Nombre Molde sugerido;</strong></label>
												<div class="controls">
													<input style="width: 400px;" type="text" name="nombre_molde" placeholder="Nombre Molde sugerido" value="<?php echo $ing->nombre_molde?>" readonly="true"/> 
												</div>
												</div>
											<?php
										}
								}
					}
				}
    ?>
    
	
	
	<div class="control-group">
		<label class="control-label" for="usuario">Visto Bueno <strong>(VB)</strong> en Maquina</label>
		<div class="controls">    
			<input style="width: 50px;" type="text" name="vb_maquina" placeholder="Visto Bueno en Maquina" value="<?php echo $datos->vb_maquina?>" readonly="true"/> 
		</div>
	</div>
	
	
	
	
     <div class="control-group">
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
			<select name="colores">
                <?php
                if(sizeof($fotomecanica)==0)
                {
                    $colores=$datos->impresion_colores;
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
            <?php echo $datos->impresion_colores ?>
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
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 1</label>
		<div class="controls">
            <?php
            if(sizeof($fotomecanica)==0)
            {
               $aca1=$datos->impresion_acabado_impresion_1;   
            }else
            {
                $aca1=$fotomecanica->acabado_impresion_1;
            }
            ?>
			<select name="acabado_impresion_1"><!--onchange="llevaBarnizFotomecanica2();"-->
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($aca1==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            <?php $acabado1=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_1);echo $acabado1->caracteristicas;?> 
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 2</label>
		<div class="controls">
        <?php
            if(sizeof($fotomecanica)==0)
            {
               $aca2=$datos->impresion_acabado_impresion_2;   
            }else
            {
                $aca2=$fotomecanica->acabado_impresion_2;
            }
            ?>
			<select name="acabado_impresion_2">
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($aca2==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            <?php $acabado2=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_2);echo $acabado2->caracteristicas?>
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 3</label>
		<div class="controls">
        <?php
            if(sizeof($fotomecanica)==0)
            {
               $aca3=$datos->impresion_acabado_impresion_3;   
            }else
            {
                $aca3=$fotomecanica->acabado_impresion_3;
            }
            ?>
			<select name="acabado_impresion_3" onchange="procesosInternos();">
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($aca3==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            <?php $acabado3=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_3);echo $acabado3->caracteristicas?>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 1</label>
		<div class="controls">
        <?php
            if(sizeof($fotomecanica)==0)
            {
               $aca4=$datos->impresion_acabado_impresion_4;   
            }else
            {
                $aca4=$fotomecanica->acabado_impresion_4;
            }
            ?>
			<select name="acabado_impresion_4">
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($aca4==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            <?php $acabado4=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_4);echo $acabado4->caracteristicas?>
		</div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 2</label>
		<div class="controls">
        <?php
            if(sizeof($fotomecanica)==0)
            {
               $aca5=$datos->impresion_acabado_impresion_5;   
            }else
            {
                $aca5=$fotomecanica->acabado_impresion_5;
            }
            ?>
			<select name="acabado_impresion_5">
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($aca5==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            <?php $acabado5=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_5);echo $acabado5->caracteristicas?>
		</div>
	</div>
    
       <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 3</label>
		<div class="controls">
        <?php
            if(sizeof($fotomecanica)==0)
            {
               $aca6=$datos->impresion_acabado_impresion_6;   
            }else
            {
                $aca6=$fotomecanica->acabado_impresion_6;
            }
            ?>
			<select name="acabado_impresion_6" onchange="procesosExternos();">
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($aca6==$externo->id){echo 'selected="selected"';}?>><?php echo $externo->caracteristicas?></option>
                <?php
                }
                ?>
            </select>
            <?php $acabado6=$this->acabados_model->getAcabadosPorId($datos->impresion_acabado_impresion_6);echo $acabado6->caracteristicas?>
		</div>
	</div>
    <?php
	if(sizeof($fotomecanica) >= 1)
	{
	?>
     <div class="control-group">
		<label class="control-label" for="usuario">Lleva Barniz</label>
		<div class="controls">
			<select name="lleva_barniz" style="width: 100px;" onchange="llevaBarnizFotomecanica();">
                <option value="NO" <?php if($fotomecanica->lleva_barniz=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php if($fotomecanica->lleva_barniz=="SI"){echo 'selected="selected"';}?>>SI</option>
            </select> 
        
		</div>
	</div>
	
    <div class="control-group" id="reserva_barniz" style="display: <?php if($fotomecanica->reserva_barniz=="SI"){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Reserva Barniz</label>
		<div class="controls">
			<select name="reserva_barniz" style="width: 100px;">
                <option value="SI" <?php if($fotomecanica->reserva_barniz=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($fotomecanica->reserva_barniz=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
        
		</div>
	</div>
	<?php
	}else{
	?>
	
	<div class="control-group">
		<label class="control-label" for="usuario">Lleva Barniz</label>
		<div class="controls">
			<select name="lleva_barniz" style="width: 100px;" onchange="llevaBarnizFotomecanica();">
                <option value="NO" <?php if($datos->lleva_barniz=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php if($datos->lleva_barniz=="SI"){echo 'selected="selected"';}?>>SI</option>
            </select> 
        
		</div>
	</div>
	
    <div class="control-group" id="reserva_barniz" style="display: <?php if($datos->reserva_barniz=="SI" and $datos->lleva_barniz!="NO"){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Reserva Barniz</label>
		<div class="controls">
			<select name="reserva_barniz" style="width: 100px;">
                <option value="SI" <?php if($datos->reserva_barniz=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->reserva_barniz=="NO"){echo 'selected="selected"';}?>>NO</option>
            </select> 
        
		</div>
	</div>
	
	<?php
	}
	?>
	
	
	
	
    <div class="control-group">
		<label class="control-label" for="usuario">Lleva Fondo Negro</label>
		<div class="controls">
			<select name="lleva_fondo_negro" style="width: 100px;">
                <option value="NO" <?php if($fotomecanica->lleva_fondo_negro=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php if($fotomecanica->lleva_fondo_negro=="SI"){echo 'selected="selected"';}?>>SI</option>
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
					<select name="fondo_otro_color" style="width: 150px;">
						<option value="NO" <?php if(sizeof($fotomecanica) >= 1){if($fotomecanica->fondo_otro_color=="NO"){echo 'selected="selected"';}}?>>NO</option>
						<option value="SI" <?php if(sizeof($fotomecanica) >= 1){if($fotomecanica->fondo_otro_color=="SI"){echo 'selected="selected"';}}?>>SI</option>
					</select> 	
				</div>
			</div>			
    
    <h3>Materialidad</h3>
   <!--materialidad-->
    <?php
    if(sizeof($fotomecanica)==0)
    {
        ?>
        <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
            <?php
            $materialidads=$this->datos_tecnicos_model->getDatosTecnicos();
            $datos_tecnicos=$ing->materialidad_datos_tecnicos;
            ?>
			<select name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');" class="chosen-select">
                <?php
                foreach($materialidads as $key => $materialidad)
                {
                    ?>
                    <option value="<?php echo $materialidad->id?>" <?php if($ing->materialidad_datos_tecnicos==$materialidad->datos_tecnicos){echo 'selected="selected"';}?>><?php echo $materialidad->datos_tecnicos?></option>
					
                    <?php
					if($ing->materialidad_datos_tecnicos==$materialidad->datos_tecnicos and $datos->condicion_del_producto == 'Repetición Con Cambios')
					{break;}
                }
                ?>
                
               
             
            </select>
            <?php echo $datos->materialidad_datos_tecnicos?> - <?php echo $ing->materialidad_datos_tecnicos?>
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
                <?php //echo $datos->materialidad_1?>  <?php //echo $ing->materialidad_1?>
				
				   <?php 
				$tapas=$this->materiales_model->getMaterialesSelectCartulina();
				
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_1)
							{							
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}		

						
					}
				
				foreach($tapas as $tapa)
                    {
						
							if($tapa->nombre==$ing->materialidad_1)
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
                <?php //echo $datos->materialidad_2?>  <?php //echo $ing->materialidad_2?>
				
			   <?php 
				$tapas=$this->materiales_model->getMaterialesSelectOnda();
				
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_2)
							{							
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}	
						
					}
				
				foreach($tapas as $tapa)
                    {
							

							if($tapa->nombre==$ing->materialidad_2)
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
                <?php //echo $datos->materialidad_3?>  <?php //echo $ing->materialidad_3?>
				 <?php 
				$tapas=$this->materiales_model->getMaterialesSelectLiner();
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_3)
							{							
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}		
					}
				
				foreach($tapas as $tapa)
                    {

							if($tapa->nombre==$ing->materialidad_3)
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}		

					}
				foreach($tapas as $tapa)
                    {
					
							if($tapa->nombre==$ing->materialidad_1)
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}
					}
				
				foreach($tapas as $tapa)
                    {
								

							if($tapa->nombre==$ing->materialidad_2)
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}		
					}
				
				foreach($tapas as $tapa)
                    {
						

							if($tapa->nombre==$ing->materialidad_3)
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}
						
					}
				
				
				foreach($tapas as $tapa)
                    {
							if($tapa->nombre==$ing->materialidad_1)
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
						
						
					}
				
				foreach($tapas as $tapa)
                    {
						if($tapa->nombre==$datos->materialidad_2)
							{							
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}		

							if($tapa->nombre==$ing->materialidad_2)
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
                <?php echo $datos->materialidad_1?> - <?php echo $ing->materialidad_1?>
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
                <?php echo $datos->materialidad_1?> - <?php echo $ing->materialidad_1?>
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
                <?php echo $datos->materialidad_2?> - <?php echo $ing->materialidad_2?>
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
                <?php echo $datos->materialidad_3?> - <?php echo $ing->materialidad_3?>
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
                <?php echo $datos->materialidad_4?> - <?php echo $ing->materialidad_4?>
    		</div>
    	</div>
    
    <input type="hidden" name="materialidad_eleccion" value="mono_mono" />
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
                    <option value="<?php echo $materialidad->id?>" <?php if($fotomecanica->materialidad_datos_tecnicos==$materialidad->datos_tecnicos){echo 'selected="selected"';}?>><?php echo $materialidad->datos_tecnicos?></option>
                    <?php
					if($datos->materialidad_datos_tecnicos==$materialidad->datos_tecnicos and $datos->condicion_del_producto == 'Repetición Con Cambios' or $datos->condicion_del_producto == 'Repetición Sin Cambios')
					{break;}
                }
                ?>
                
               
             
            </select>
            <?php echo $datos->materialidad_datos_tecnicos?> - <?php echo $ing->materialidad_datos_tecnicos?>
		</div>
	</div>
    
    <div id="materialidad">
        <?php
        switch($fotomecanica->materialidad_datos_tecnicos)
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}					
					}
				
				foreach($tapas as $tapa)
                    {
							if($tapa->nombre==$ing->materialidad_1)
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}		
					}
				
				
				foreach($tapas as $tapa)
                    {
							if($tapa->nombre==$ing->materialidad_2)
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}							
					}
				
				foreach($tapas as $tapa)
                    {
							if($tapa->nombre==$ing->materialidad_3)
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}		

							if($tapa->nombre==$ing->materialidad_1)
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}							
					}
				
				foreach($tapas as $tapa)
                    {							
							if($tapa->nombre==$ing->materialidad_2)
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}							
					}
				
				foreach($tapas as $tapa)
                    {
							if($tapa->nombre==$ing->materialidad_3)
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
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"  <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}		
					}
				
				foreach($tapas as $tapa)
                    {
							if($tapa->nombre==$ing->materialidad_1)
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
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
							echo $tapa->gramaje.'('.$tapa->nombre.'- $'.$tapa->precio.') ('.$tapa->reverso.') -';						
							}
						
					}
				
				foreach($tapas as $tapa)
                    {
							if($tapa->nombre==$ing->materialidad_2)
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
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?> - <?php echo $ing->materialidad_1?>
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?> - <?php echo $ing->materialidad_1?>
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?> - <?php echo $ing->materialidad_2?>
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?> - <?php echo $ing->materialidad_3?>
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_4?> - <?php echo $ing->materialidad_4?>
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?> - <?php echo $ing->materialidad_1?>
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?> - <?php echo $ing->materialidad_2?>
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
            <select name="folia_se">
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
            <?php
                if(sizeof($fotomecanica)==0)
                {
                    ?>
                    <span id="folia_se_b" style="display: <?php if($datos->procesos_especiales_folia=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="folia_se" value="<?php echo $datos->procesos_especiales_folia_valor?>" readonly="true" />
                    </span>
                    <?php
                }else
                {
                    ?>
                    <span id="folia_se_b" style="display: <?php if($fotomecanica->procesos_especiales_folia=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="folia_se" value="<?php echo $fotomecanica->procesos_especiales_folia_valor?>" readonly="true" />
                    </span>
                    <?php
                }
                    ?>
            
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia 2</label>
		<div class="controls">
			<select name="folia_2" style="width: 100px;" onchange="cambiaFolia2();">
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
            <?php
                if(sizeof($fotomecanica)==0)
                {
                    ?>
                    <span id="folia_se_2_b" style="display: <?php if($datos->procesos_especiales_folia_2=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="folia_se_2" value="<?php echo $datos->procesos_especiales_folia_2_valor?>" readonly="true" />
                    </span>
                    <?php
                }else
                {
                    ?>
                    <span id="folia_se_2_b" style="display: <?php if($fotomecanica->procesos_especiales_folia_2=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="folia_se_2" value="<?php echo $fotomecanica->procesos_especiales_folia_2_valor?>" readonly="true" />
                    </span>
                    <?php
                }
                    ?>
            
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia 3</label>
		<div class="controls">
			<select name="folia_3" style="width: 100px;" onchange="cambiaFolia3();">
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
            <?php
                if(sizeof($fotomecanica)==0)
                {
                    ?>
                    
                <option value="Nuevo" <?php if($datos->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                }else
                {
                    ?>
                    
                <option value="Nuevo" <?php if($fotomecanica->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($fotomecanica->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                }
                    ?>
                
                
            </select>
            </span>
            <?php
                if(sizeof($fotomecanica)==0)
                {
                    ?>
                    <span id="folia_se_3_b" style="display: <?php if($datos->procesos_especiales_folia_3=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="folia_se_3" value="<?php echo $datos->procesos_especiales_folia_3_valor?>" readonly="true" />
                    </span>
                    <?php
                }else
                {
                    ?>
                    <span id="folia_se_3_b" style="display: <?php if($fotomecanica->procesos_especiales_folia_3=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="folia_se_3" value="<?php echo $fotomecanica->procesos_especiales_folia_3_valor?>" readonly="true" />
                    </span>
                    <?php
                }
                    ?>
            
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño</label>
		<div class="controls">
			<select name="cuno" style="width: 100px;" onchange="cambiaCuno();">
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
            <?php
                if(sizeof($fotomecanica)==0)
                {
                    ?>
                    
                <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($datos->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                }else
                {
                    ?>
                    
                <option value="Nuevo" <?php if($fotomecanica->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                <option value="Repetición" <?php if($fotomecanica->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                }
                    ?>
                
                
            </select>
            </span>
            <?php
                if(sizeof($fotomecanica)==0)
                {
                    ?>
                    <span id="cuno_se_b" style="display: <?php if($datos->procesos_especiales_cuno=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="cuno_se" value="<?php echo $datos->procesos_especiales_cuno_valor?>" readonly="true" />
                    </span>
                    <?php
                }else
                {
                    ?>
                    <span id="cuno_se_b" style="display: <?php if($fotomecanica->procesos_especiales_cuno=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="cuno_se" value="<?php echo $fotomecanica->procesos_especiales_cuno_valor?>" readonly="true" />
                    </span>
                    <?php
                }
                    ?>
            
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño 2</label>
		<div class="controls">
			<select name="cuno_2" style="width: 100px;" onchange="cambiaCuno2();">
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
            <?php
                if(sizeof($fotomecanica)==0)
                {
                    ?>
                    <span id="cuno_se_2_b" style="display: <?php if($datos->procesos_especiales_cuno_2=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="cuno_se_2" value="<?php echo $datos->procesos_especiales_cuno_2_valor?>" readonly="true" />
                    </span>
                    <?php
                }else
                {
                    ?>
                    <span id="cuno_se_2_b" style="display: <?php if($fotomecanica->procesos_especiales_cuno_2=='SI'){echo 'none';}else{echo 'block';}?>;">
                        <input type="text" name="cuno_se_2" value="<?php echo $fotomecanica->procesos_especiales_cuno_2_valor?>" readonly="true" />
                    </span>
                    <?php
                }
                    ?>
            
		</div>
	</div>
    
        <h3>PDF de Imagen</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ingrese PDF de la Imagen</label>
		<div class="controls">
			<input type="file" id="file" name="file" />
		</div>
	</div>
	
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios</label>
		<div class="controls">
			<textarea id="desctec" name="obs" placeholder="Observaciones"><?php echo $fotomecanica->comentarios; ?></textarea>
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
								<textarea id="contenido4" name="desctec" placeholder="Descripcion técnica"><?php echo $ing->producto.', Impreso a '.$fotomecanica->colores.' colores, Barniz:'.$fotomecanica->reserva_barniz.', En Placa'.$fotomecanica->materialidad_1.' onda: '.$fotomecanica->materialidad_2.' liner: '.$fotomecanica->materialidad_3.' Tamaño: '.$ing->medidas_de_la_caja.'X'.$ing->medidas_de_la_caja_2.'X'.$ing->medidas_de_la_caja_3.'X'.$ing->medidas_de_la_caja_4 ?></textarea>
							</div>
						</div>    
				<?php
                }
                 ?>
	
	
	
	
	
     <div class="control-group" id="rechazo" style="display: <?php if($fotomecanica->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo getField("glosa",$datos,$fotomecanica) ?></textarea>
		</div>
	</div>
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
				 <?php
				 if( $this->session->userdata('perfil')!=2)
					{
				 ?>
					<input type="button" value="Guardar" class="btn <?php if($fotomecanica->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
					<?php
					//if(sizeof($hoja)==0)
					//{
						?>
						<input type="button" value="Rechazar" class="btn <?php if($fotomecanica->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
						<?php
					//}
					?>
					<input type="button" value="Liberar" class="btn <?php if($fotomecanica->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
					
				<?php
					}
				?>
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



//$(document).ready(function() {
	 //$(".fancybox").fancybox({
		 //openEffect	: 'none',
		// closeEffect	: 'none'
	// });
    
 //});
</script>
