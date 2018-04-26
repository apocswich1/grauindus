<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Solicita Muestra</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Solicita Muestra</h3></div>
    
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
            <li>Cliente : <?php echo $cliente?></li>
            <li>Cotización número : <?php echo $id?></li>
            <li>Fecha : <?php echo fecha($datos->fecha)?></li>
            <li>Vendedor : <?php echo $vendedor->nombre?><input type="hidden" name="vendedor_nombre" value="<?php echo $vendedor->nombre?>" /><input type="hidden" name="vendedor_correo" value="<?php echo $vendedor->correo?>" /></li>
        </ul>
    </p>
	<hr />
    

    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Medidas de la caja</label>
		<div class="controls">
			L <input type="text" name="medidas_de_las_cajas" placeholder="L" value="<?php echo $ing->medidas_de_la_caja?>" style="width: 50px;" />
           A <input type="text" name="medidas_de_las_cajas_2" placeholder="A" value="<?php echo $ing->medidas_de_la_caja_2?>" style="width: 50px;" />
           H <input type="text" name="medidas_de_las_cajas_3" placeholder="H" value="<?php echo $ing->medidas_de_la_caja_3?>" style="width: 50px;" />
           AT <input type="text" name="medidas_de_las_cajas_4" placeholder="AT" value="<?php echo $ing->medidas_de_la_caja_4?>" style="width: 50px;" />
		</div>
	</div>
     
    
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
            <?php echo $datos->materialidad_datos_tecnicos?> - <?php echo $ing->materialidad_datos_tecnicos?>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?> - <?php echo $ing->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?> - <?php echo $ing->materialidad_3?>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?> - <?php echo $ing->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?> - <?php echo $ing->materialidad_3?>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"  <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?> - <?php echo $ing->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?> - <?php echo $ing->materialidad_2?>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
            case 'Onda a la Vista ( Micro/Micro )'://5
                ?>
                     <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$datos->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?> - <?php echo $ing->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?> - <?php echo $ing->materialidad_3?>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?> - <?php echo $ing->materialidad_2?>
    		</div>
    	</div>
        
        <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_3" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_3?> - <?php echo $ing->materialidad_3?>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>"  <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_1?> - <?php echo $ing->materialidad_1?>
    		</div>
    	</div>
        
         <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
    			<select name="materialidad_2" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo $datos->materialidad_2?> - <?php echo $ing->materialidad_2?>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                         <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
            case 'Onda a la Vista ( Micro/Micro )'://5
                ?>
                     <div class="control-group">
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    			<select name="materialidad_1" class="chosen-select">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->nombre?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->nombre==$fotomecanica->materialidad_2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
            
        }
        ?>    
    </div>
        <?php
    }
        ?>
     <!--/materialidad-->
    
    
    
     <div class="control-group">
		<label class="control-label" for="usuario">Descripción</label>
		<div class="controls">
			<textarea id="contenido5" name="des" placeholder="Observaciones"><?php echo $datos->detalle_de_muestra?></textarea>
		</div>
	</div>
    
    
    
    
      
    
    <div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
    
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
        document.form.cliente.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>
