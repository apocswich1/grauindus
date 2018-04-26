<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php // echo $control->ancho_de_bobina; ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <?php
      switch($tipo)
      {
        case '1':
            ?>
            <li><a href="<?php echo base_url()?>produccion/cotizaciones/<?php echo $pagina?>">Órdenes de Producción &gt;&gt;</a></li>
            <li>Bobinado Cartulina - Orden de Producción N° <?php echo $orden->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Bobinado Cartulina - Fast Track N° <?php echo $id?></li>
            <?php
        break;
      }
      ?>
      
      
    </ol>
   <!-- /Migas -->
    <?php
      switch($tipo)
      {
        case '1':
            ?>
            <div class="page-header"><h3>Bobinado Cartulina - Orden de Producción N° <?php echo $orden->id?></h3></div>
            <ul>
                <?php
                $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                $cliente=$cli->razon_social;
                $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
                if($orden->tiene_molde=='NO')
                {
                    $moldeNuevo='Molde Antiguo';
                }else
                {
                    $moldeNuevo='Molde nuevo';
                }
                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
                $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
                $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);
				
				
				
				$hayparcial=$this->produccion_model->getParcialControlCartulina($id);
				$hayparcial2=$this->produccion_model->getParcialBobinadoCartulinaSuma($id);
                ?>
                    <li>Cliente : <b><?php echo $cliente?></b></li>
                    <li>Descripción : <b><?php echo $datos->producto?></b></li>
                    <li>Fecha Liberación fotomecánica : <strong><?php echo fecha($fotomecanica->cuando)?></strong></li>
                    <li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li>
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url()?>public/uploads/moldes/<?php echo $molde->archivo?>" target="_blank"><?php echo $fotomecanica2->numero_molde?></a> (<?php echo $moldeNuevo?>)</li>
                    <li>Molde por revés o al derecho : <?php echo $fotomecanica2->troquel_por_atras?></li>
                    <?php if(!empty($ing->archivo)){?> 
                    <li>PDF trazado de Ingeniería <a href='<?php echo base_url(); ?>public/uploads/pdf_trazado/<?php echo $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                        <?php
                    }?>
                    <?php if(!empty($fotomecanica2->pdf_imagen)){?> 
                    <li>PDF imagen <a href='<?php echo base_url(); ?>public/uploads/produccion/fotomecanica/<?php echo $fotomecanica2->pdf_imagen ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                    <?php }else
                    {
                        ?>
                        <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                        <?php
                    }?>
                    <li>
                        <?php
                        if(sizeof($control_cartulina)==0)
                           {
                               ?>
                               Situación : <strong>Pendiente</strong>
                               <?php
                                
                           }else
                           {
                             switch($control->situacion)
                             {
                                case 'Liberada':
                                    ?>
                                    Situación : <strong>Liberada el <?php echo fecha_con_hora($fotomecanica->fecha_liberada);?></strong>
                                    <?php
                                break;
                                case 'Activa':
                                    ?>
                                    Situación : <strong>Activa el <?php echo fecha_con_hora($fotomecanica->fecha_activa);?></strong>
                                    <?php
                                break;
                             }
                           }
                        ?>
                    </li>
                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Bobinado Cartulina - Fast Track N° <?php echo $id?></h3></div>
            <ul>
                <?php
                 $cliente=$this->clientes_model->getClientePorId($datos->cliente);
                ?>
                    <li>Cliente : <b><?php echo $cliente->razon_social?></b></li>
                    <li>Descripción : <b><?php echo $datos->descripcion?></b></li>
                </ul>
                <hr />
            <?php
        break;
      }
      ?>
	<p>
         
    </p>
	
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción cartulina</label>
		<div class="controls">
            <input type="text" name="descripcion_cartulina" value="<?php echo $materialidad_1->nombre;?>" readonly="true" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Microcorrugado o Corrugado</label>
		<div class="controls">
            <input type="text" name="datos_tecnicos" value="<?php echo $fotomecanica2->materialidad_datos_tecnicos;?>" readonly="true" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho seleccionado de cartulina</label>
		<div class="controls">
            <input type="text" name="ancho_seleccionado_cartulina" value="<?php echo $control_cartulina->ancho_seleccionado_de_bobina;?>" readonly="true" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho a bobinar</label>
		<div class="controls">
            <input type="text" name="ancho_a_bobinar" value="<?php if ($control->ancho_de_bobina!='') echo $control->ancho_de_bobina; else echo $control_cartulina->bobinar_ancho_cartulina; ?>" readonly="true" />
            <?php if ($control->ancho_de_bobina=='') echo "Ancho Seleccionado en Control Cartulina: ".$control_cartulina->bobinar_ancho_cartulina; ?>
           </div>
	</div>
    

    <div class="control-group">
		<label class="control-label" for="usuario">Medida final pliego a cortar</label>
		<div class="controls">
            <input type="text" name="medida_final_pliego_a_cortar" value="<?php echo $control_cartulina->ancho_seleccionado_de_bobina;?>" readonly="true" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario"><strong>Gramaje seleccionado</strong></label>
		<div class="controls">
            <input type="text" name="gramaje_seleccionado" value="<?php echo $control_cartulina->gramaje_seleccionado;?>" readonly="true" />
       </div>
	</div>
    
    <div class="control-group" style="display:none">
		<label class="control-label" for="usuario">Total pliegos para la orden</label>
		<div class="controls">
            <input type="text" name="total_pliegos_para_la_orden" value="<?php echo $hoja->total_pliegos;?>" readonly="true" />
       </div>
	</div>
    <?php
    //$totalKilosBobinar=($control_cartulina->dimensionar_a_ancho*$control_cartulina->dimensionar_a_largo*$control_cartulina->gramaje_seleccionado*$hoja->total_pliegos)/10000000;
    ?>
    <div class="control-group">
		<label class="control-label" for="usuario">Total kilos a bobinar</label>
		<div class="controls">
            <input type="text" name="total_kilos_a_bobinar" value="<?php echo $control_cartulina->total_kilos;?>" readonly="true" />
       </div>
	</div>
	
	
            	<?php
				if(sizeof($hayparcial->sum)==0)
				{
					
				}else
				{
				?>
						<div class="control-group">
							<label class="control-label" for="usuario"><strong>Total kilos a bobinar seleccionados</strong></label>
							<div class="controls">
								<input type="text" name="total_kilos" value="<?php echo $hayparcial->sum;?>" readonly="true" />
								
				<?php
				
				if($hayparcial->sum >= 1 and $hayparcial2->sum >= 1)
				{
					$pendiente = $hayparcial->sum - $hayparcial2->sum;					
				}else
				{
					if($hayparcial2->sum >= 1)
					{
						$pendiente = $hayparcial->sum - $hayparcial2->sum;	
					}else
					{
						$pendiente = $hayparcial->sum;	
					}
				}

					if($control->estado == 1)
					{}
					else{
					if($pendiente > 0)
					{
				?>
					<input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.$pendiente;?>" readonly="true" />				
						 
	
				<?php
					}
				  }
				?>
					  </div>
						</div>
				<?php
				}
				?>
				
				
				

    <div class="control-group">
		<label class="control-label" for="usuario">Total bobinas</label>
		<div class="controls">
            <input type="text" name="total_bobinas" value="<?php echo $control_cartulina->total_de_bobinas;?>" readonly="true" />
       </div>
	</div>
    
    
		<div class="control-group">
			<label class="control-label" for="usuario">Total o parcial <strong style="color: red;">(*)</strong></label>
			<div class="controls">
				<select name="total_o_parcial" onchange="Parcial(this.value)" >
					<option value="Total"   <?php if($control->total_o_parcial=='Total'){echo 'selected="true"';}  ?>>Total</option>
					<option value="Parcial" <?php if($control->total_o_parcial=='Parcial'){echo 'selected="true"';}?>>Parcial</option>
				</select>
			</div>
		</div>
		
		
	<div class="control-group" id="totaloparcial" style="<?php if($control->total_o_parcial=='Parcial'){echo 'display: block';}else{ echo 'display: none';}?>;">
		<label class="control-label" for="usuario">Total de Kilos Parciales</label>
			<div class="controls">
				<input type="text" name="total_kilos" />
				<?php
				
					if($hayparcial->sum >= 1 and $hayparcial2->sum >= 1)
				{
					$pendiente1 = $hayparcial->sum - $hayparcial2->sum;					
				}else
				{
					if($hayparcial2->sum >= 1)
					{
						$pendiente1 = $hayparcial->sum - $hayparcial2->sum;	
					}else
					{
						$pendiente1 = $hayparcial->sum;	
					}
				}
				
				if($control->estado == 1)
				{}else{
				if(sizeof($hayparcial2->sum)==0)
				{
					?>
					<input type="text" name="total_kilos_a_bobinar" value="<?php echo $hayparcial->sum;?>" readonly="true" />
					<?php
				}else
				{
				?>
					<input type="text" name="total_kilosParciales" value="<?php echo 'Pendientes : '.$pendiente1;?>" readonly="true" />		
				<?php
				
				}
				}
				?>
		   </div>
	</div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Operador <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="operador">
                <?php
                foreach($usuarios2 as $usuario2)
                {
                    ?>
                    <option value="<?php echo $usuario2->id?>" <?php if($control->operador==$usuario2->id){echo 'selected="true"';}?>><?php echo $usuario2->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ayudante <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="ayudante">
                <?php
                foreach($usuarios as $usuario)
                {
				   
				
				   
                    ?>
                     <option value="<?php echo $usuario->id?>" <?php if($control->operador==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option> 
					
                    <?php
               }
			   
			   
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group" id="rechazo" style="display: <?php if($control->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control->glosa?></textarea>
		</div>
	</div>
    
    
    
    
	<div class="control-group">
		<div class="form-actions">
		
            <input type="hidden" name="tipo" value="<?php echo $tipo?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="id" value="<?php echo $id?>" />
            <input type="hidden" name="id_cliente" value="<?php if($tipo==1){echo $datos->id_cliente;}else{echo $datos->cliente;}?>" />
			<input type="hidden" name="indicador" />
            <input type="hidden" name="estado" />
			<?php
			if($control->estado == 1)
			{echo 'Bobinado Cartulina Liberado';}
			else{
					?>
					<input type="button" value="Guardar" class="btn <?php if($control->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
					
					
					<?php
					if($control_cartulina->estado == 1)
					{
					?>
					<input type="button" value="Liberar" class="btn <?php if($control->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" id='btnliberar'/>
					<?php
					}
					?>
					
					<input type="button" value="Parcial" class="btn <?php if($control->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" id='btnparcial'/>
					<input type="button" value="Rechazar" class="btn <?php if($control->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
			<?php
			}
			?>
			
		</div>
	</div>
</form>

<script type="text/javascript">
     jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        //document.form.cliente.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
</div>
