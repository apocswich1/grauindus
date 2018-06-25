<h3>Modificar datos Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

    
    
   <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
            <?php
            $materialidads=$this->datos_tecnicos_model->getDatosTecnicos();
            ?>
			<select name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');" >
                <?php
                foreach($materialidads as $key => $materialidad)
                {
                    ?>
                    <option value="<?php echo $materialidad->id?>" <?php if($fotomecanica->materialidad_datos_tecnicos==$materialidad->datos_tecnicos){echo 'selected="selected"';}?>><?php echo $materialidad->datos_tecnicos?></option>
                    <?php
					if($fotomecanica->materialidad_datos_tecnicos==$materialidad->datos_tecnicos)
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
                    $tapas=$this->materiales_model->getMaterialesSelect();
                    foreach($tapas as $tapa)
                    {
                        ?>
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_placa1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->id?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_onda2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_liner3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_placa1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_onda2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_liner3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                         <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>"  <?php if($tapa->id==$fotomecanica->id_mat_placa1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                         <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_onda2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                         <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_placa1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_placa1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_onda2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_liner3){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->materialidad_4){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_placa1){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
                        <option value="<?php echo $tapa->id?>" title="Gramaje <?php echo $tapa->gramaje?>" <?php if($tapa->id==$fotomecanica->id_mat_onda2){echo 'selected="selected"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->nombre?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
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
     <div class="control-group">
		<label class="control-label" for="usuario">Justifique el cambio</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa" placeholder="Justificación"></textarea>
		</div>
	</div>
    <hr />
      <div class="control-group">
		<div class="form-actions">
         <input type="hidden" name="id" value="<?php echo $id?>" />
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/hoja_de_costos_propia/".$id."/".$pagina;?>" />
			<input type="submit" value="Guardar" class="btn btn-default" />
		   
		</div>
	</div>
    
</div>
 <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/frontend/css/prism.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/frontend/css/chosen.css" />
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