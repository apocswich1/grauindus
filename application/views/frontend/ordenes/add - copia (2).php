<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Emisión Orden de Producción</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Emisión Orden de Producción ( Cotización N° <?php echo $id?> )</h3></div>
	 <p>
         <ul>
        <?php
         if($datos->id_cliente==3000)
        {
            $cliente=$datos->nombre_cliente;
        }else
        {
            $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
            $cliente=$cli->razon_social;
        }
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        ?>
            <li>Cliente : <b><?php echo $cliente?></b></li>
            <li>Cotización N° : <b><?php echo $id?></b></li>
            <li>Fecha : <b><?php echo fecha($datos->fecha)?></b></li>
            <li>Vendedor : <b><?php echo $vendedor->nombre?></b></li>
            <?php
            if($orden->estado=='1')
            {
                ?>
                <li>Fué enviado un mail a <strong><?php echo $vendedor->nombre?></strong> con fecha <strong><?php echo fecha($orden->fecha)?></strong></li>
                <?php
            }
            ?>
        </ul>
    </p>
     <?php
     if(sizeof($orden)==0)
     {
        ?>
        <?php
     }else
     {
        ?>
        
        <div class="control-group">
    		<label class="control-label" for="id_antiguo">Imprimir PDF de Orden de Producción</label>
    		<div class="controls">
	           <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $id?>/<?php echo $orden->id?>" class="btn btn-danger" target="_blank"><i class="icon-file"></i>PDF</a>
            </div>
	    </div> 
       
        <?php
     }
     ?>
     <?php
     if(sizeof($ordenDeCompra)>=1)
     {
        ?>
        <div class="control-group">
		<label class="control-label" for="id_antiguo">Archivo de Orden de Compra</label>
		<div class="controls">
            <a href="<?php echo base_url()?>public/uploads/cotizacion_orden_de_compra/<?php echo $ordenDeCompra->archivo?>" title="<?php echo $dato->nombre?>" target="_blank"><i class="icon-search"></i></a>
		</div>
	</div> 
        <?php
     }else
     {
        ?>
       <hr />
       <strong>NO HA SIDO CREADA AUN LA ORDEN DE COMPRA</strong>
       <hr />
        <?php
     }
     ?>
      
     <?php
     if(sizeof($orden)==0)
     {
        ?>
            <div class="control-group">
		<label class="control-label" for="usuario">Producto</label>
		<div class="controls">
            <?php
			if(sizeof($existeProducto)==0 and sizeof($existeProducto2)==0)
              {  
            ?>
		  <strong>Se va a crear el producto : <ins><?php echo $datos->producto?></ins> con el código <ins><?php echo $datos->id_cliente.'A'.$codigoNuevo ?></ins></strong>
		  <?php
			  }else{  
            ?>
			<strong>El producto ya existe: <ins><?php echo $datos->producto?></ins> con el código <ins><?php echo $existeProducto->codigo ?></ins></strong>
			<?php
			  }
			?>
			
			
			
		</div>
	</div>
        <?php
     }else
     {
        ?>
        <div class="control-group">
		<label class="control-label" for="usuario">Producto</label>
		<div class="controls">
		
            <select name="producto_id" class="chosen-select">
                <?php 
                foreach($productos as $producto)
                {
                    
                    /*
                    if($datos->producto_id==0)
                    {
                        $selected='';
                    }else
                    {
                        if($producto->id==$datos->producto_id)
                        {
                            $selected='selected="true"';
                        }else
                        {
                            $selected='';
                        }
                    }
                    if($datos->condicion_del_producto=='Repetición Con Cambios')
                    {
                           
                    }else
                    {
                        
                    }
                    */
                    if(sizeof($orden)==0)
                    {
                        if($datos->producto_id==0)
                        {
                            $selected='';
                        }else
                        {
                            if($producto->id==$datos->producto_id)
                            {
                                $selected='selected="true"';
                            }else
                            {
                                $selected='';
                            }
                        }
                    }else
                    {
                        if($producto->id==$orden->producto_id)
                            {
                                $selected='selected="true"';
                            }else
                            {
                                $selected='';
                            }
                    }
                    ?>
                    <option value="<?php echo $producto->id?>" <?php echo $selected?>><?php echo $producto->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
        <?php
     }
     ?>
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre Producto</label>
		<div class="controls">
			<input type="text" id="titulo" name="nombre_producto_normal" value="<?php echo $ing->producto?>" placeholder="nombre_producto" <?php if($datos->condicion_del_producto=='Repetición Con Cambios'){echo '';}else{echo 'readonly="true"';}?> /> <strong>(<?php echo $datos->condicion_del_producto?>)</strong>
		</div>
	</div>
    
    
     
    <div class="control-group">
		<label class="control-label" for="usuario">Valor</label>
		<div class="controls">
			<input type="text" id="titulo" name="valor" value="<?php echo $hoja->valor_empresa?>" readonly="true" />
		</div>
	</div>
   
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidades solicitadas</label>
		<div class="controls">
		      <ul class="list-group">
                  <li class="list-group-item">Cantidad 1 :<?php echo number_format($datos->cantidad_1,0,'','.');?> <?php if(sizeof($hoja)==0){}else{echo "($".number_format($hoja->valor_empresa,0,'','.').")";}?></li>
                  <li class="list-group-item">Cantidad 2 :<?php echo number_format($datos->cantidad_2,0,'','.');?> <?php if(sizeof($hoja)==0){}else{echo "($".number_format($hoja->valor_empresa_2,0,'','.').")";}?></li>
                  <li class="list-group-item">Cantidad 3 :<?php echo number_format($datos->cantidad_3,0,'','.');?> <?php if(sizeof($hoja)==0){}else{echo "($".number_format($hoja->valor_empresa_3,0,'','.').")";}?></li>
                  <li class="list-group-item">Cantidad 4 :<?php echo number_format($datos->cantidad_4,0,'','.');?> <?php if(sizeof($hoja)==0){}else{echo "($".number_format($hoja->valor_empresa_4,0,'','.').")";}?></li>
              </ul>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad Pedida</label>
		<div class="controls">
			<?php
            if(sizeof($orden)==0)
            {
                $cantidad_1=$datos->cantidad_1;
            }else
            {
                $cantidad_1=$orden->cantidad_pedida;
            }
            ?>
            <input type="text" id="titulo" name="cantidad_pedida" value="<?php echo $cantidad_1?>" placeholder="Cantidad Pedida"  onkeypress="return soloNumeros(event)" /> 
		</div>
	</div>
    
   <?php 
   switch($fotomecanica->estan_los_moldes)
   {
        case 'SI':
            ?>
            <div class="control-group">
        		<label class="control-label" for="usuario">  </label>
        		<div class="controls">
                <hr />
                    <ul>
                        <li><strong>MOLDE ANTIGUO</strong></li>
                        <li>Sólo se puede modificar molde, entre los ya existentes.</li>
                    </ul>
                <hr />
                </div>
            </div>
            <?php
        break; 
        case 'NO':
            ?>
            <div class="control-group">
        		<label class="control-label" for="usuario">  </label>
        		<div class="controls">
                <hr />
                    <ul>
                        <li><strong>MOLDE NUEVO</strong></li>
                        <!--<li>Sólo se puede modificar molde, entre los ya existentes.</li>-->
                    </ul>
                <hr />
                </div>
            </div>
            <?php
        break;
        case 'NO LLEVA':
            ?>
            <div class="control-group">
        		<label class="control-label" for="usuario">  </label>
        		<div class="controls">
                <hr />
                    <ul>
                        <li><strong>NO LLEVA MOLDE</strong></li>
                    </ul>
                <hr />
                </div>
            </div>
            <?php
		break;	
		case 'CLIENTE LO APORTA':
            ?>
            <div class="control-group">
        		<label class="control-label" for="usuario">  </label>
        		<div class="controls">
                <hr />
                    <ul>
                        <li><strong>CLIENTE LO APORTA</strong></li>
                    </ul>
                <hr />
                </div>
            </div>
            <?php
        break;
    ?>
    
    
    <?php }?>
   
    
   <div class="control-group">
		<label class="control-label" for="usuario">Están los moldes?  </label>
		<div class="controls">
			 <?php
            if(sizeof($orden)>=1 )
            {
                ?>
                <select name="estan_los_moldes" style="width: 100px;" >
                <option value="SI" <?php if($orden->estan_los_moldes=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($orden->estan_los_moldes=="NO" or $condicionFull=="Nuevo"){echo 'selected="selected"';}?>>NO</option>
                <option value="NO LLEVA" <?php if($orden->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>3000
				<option value="CLIENTE LO APORTA" <?php if($orden->estan_los_moldes=="CLIENTE LO APORTA"){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
            </select> 
            <?php
            if($orden->tiene_molde=='NO LLEVA' or $orden->tiene_molde=='CLIENTE LO APORTA')
            {
                ?>
                <select name="molde" class="chosen-select" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');">
                <?php
                $moldes=$this->moldes_model->getMoldes();
                foreach($moldes as $molde)
                {
                    ?>
                    <option value="<?php echo $molde->id?>" <?php if(8371==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                    <?php
                }
                ?>
                
            </select> 
            <span id="div_moldes"></span>
                <?php
            }else
            {
                ?>
                <select name="molde" class="chosen-select" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');">
                <?php
                $moldes=$this->moldes_model->getMoldes();
                foreach($moldes as $molde)
                {
                    ?>
                    <option value="<?php echo $molde->id?>" <?php if($orden->id_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                    <?php
                }
                ?>
                
            </select> 
            <span id="div_moldes"></span>
                <?php
            }
            ?>
            
            
                <?php
            }else
            {
                ?>

                <select name="estan_los_moldes" style="width: 100px;" onchange="estanLosMoldes2(this.value); ">
                <option value="SI" <?php if($fotomecanica->estan_los_moldes=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($fotomecanica->estan_los_moldes=="NO" or $condicionFull=="Nuevo"){echo 'selected="selected"';}?>>NO</option>
                <option value="NO LLEVA" <?php if($fotomecanica->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
				<option value="CLIENTE LO APORTA" <?php if($fotomecanica->estan_los_moldes=="CLIENTE LO APORTA"){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
            </select> 
            <div id="molde_select" style="display: <?php if($fotomecanica->estan_los_moldes=="SI"){echo 'block';}else{echo 'none';}?>;">
            <select name="molde" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');">
                <?php
                $moldes=$this->moldes_model->getMoldes();
                foreach($moldes as $molde)
                {
                    ?>
                    <option value="<?php echo $molde->id?>" <?php if($fotomecanica->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
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
    if(sizeof($orden->estan_los_moldes)==0)
    {
        ?>
        <div class="control-group" id="crea_molde" style="display: <?php if($fotomecanica->estan_los_moldes=="NO"){echo 'block';}else{echo 'none';}?>;>
		<label class="control-label" for="usuario"><strong>Nombre Molde sugerido por ingeniería</strong></label>
		<div class="controls">
			<input type="text" name="nombre_molde" placeholder="Nombre Molde sugerido por ingeniería" value="<?php echo $ing->nombre_molde?>" readonly="true" /> 
		</div>
	</div>
        <?php
    }else
    {
        ?>
        <input type="hidden" name="nombre_molde" value="<?php echo $ing->nombre_molde?>" /> 
        <?php
    }
    ?>
    
    
       <div class="control-group">
		<label class="control-label" for="usuario">Fecha Entrega</label>
		<div class="controls">
			<input type="date" id="titulo" name="fecha" value="<?php echo $orden->fecha?>" /> ( <?php echo invierte_fecha($datos->fecha)?> ) || ( <?php echo invierte_fecha($orden->fecha_despacho)?> ) 
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Forma Despacho</label>
		<div class="controls">
			<select name="tota_o_parcial" id="tota_o_parcial" onchange="fn_cb_totalOparcial(this.value,'cantidadesDespacho')">
                <option value="Total">Total</option>
                <option value="Parcial" <?php if($orden->tipo_entrega=="Parcial"){echo 'selected="true"';}?>>Parcial</option>
                <option value="despachos semanales">despachos semanales</option>
                <option value="despachos mensuales" <?php if($orden->tipo_entrega=="despachos mensuales"){echo 'selected="true"';}?>>despachos mensuales</option>
                <option value="despachos bimensuales" <?php if($orden->tipo_entrega=="despachos bimensuales"){echo 'selected="true"';}?>>despachos bimensuales</option>
                <option value="despachos trimestrales" <?php if($orden->tipo_entrega=="despachos trimestrales"){echo 'selected="true"';}?>>despachos trimestrales</option>
            </select>( <?php echo $datos->tota_o_parcial?> ) || ( <?php echo $orden->total_o_parcial?> ) 
		</div>
	</div>
    <div class="control-group" id="producto">
           <div id="cantidadesDespacho" style="display: none;">
		<label class="control-label" id = "lblCantidadesTotalParcial" for="usuario">Cantidades (Si es Parcial)</label>
		<div class="controls" >
                    
			<input type="text" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="0" /> - <input type="text" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="0" /> - <input type="text" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="0" />
                </div>
                </div>
        </div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Forma Pago</label>
		<div class="controls">
				<select name="forma_pago">
                <option value="0">Seleccione.....</option>
                <?php
                $formas=$this->clientes_model->getFormasPago();
                $f=$this->clientes_model->getFormasPagoPorId($orden->id_forma_pago);
                foreach($formas as $forma)
                {
                    ?>
                    <option value="<?php echo $forma->id?>" <?php if($orden->id_forma_pago==$forma->id){echo 'selected="true"';}?>><?php echo $forma->forma_pago?></option>
                    <?php
                }
                ?>
                
            </select> ( <?php echo $datos->forma_pago?> ) || ( <?php echo $f->forma_pago?> ) 
		</div>
	</div>
    
     
    <div class="control-group" id="rechazo" style="display: <?php if($orden->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $orden->glosa ?></textarea>
		</div>
	</div>
      
    <?php
     if(sizeof($orden)==0)
     {
        ?>
	<div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="id" value="<?php echo $id?>" />
			<input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="estado" />
			<input type="button" value="Guardar" class="btn <?php if($orden->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
		    <input type="button" value="Rechazar" class="btn <?php if($orden->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
            <input type="button" value="Liberar" class="btn <?php if($orden->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
            
		</div>
	</div>
    <?php
    }
    ?>
</form>

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
</div>
