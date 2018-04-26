<h3>Modificar datos Hoja de Costos N° <?php echo number_format($id,0,'','.') ?></h3>

<hr style="width:1000px;" />
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

    
    <div class="control-group">
		<label class="control-label" for="usuario">Están los moldes?</label>
		<div class="controls">
			 <?php
            if(sizeof($fotomecanica)>=1)
            {
                ?>
                <select name="estan_los_moldes" style="width: 100px;">
                <option value="SI" <?php if($fotomecanica->estan_los_moldes=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($fotomecanica->estan_los_moldes=="NO" or $condicionFull=="Nuevo"){echo 'selected="selected"';}?>>NO</option>
                <option value="NO LLEVA" <?php if($fotomecanica->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
            </select> 
            <select name="molde" class="chosen-select" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');">
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
                <?php
            }else
            {
                ?>

                <select name="estan_los_moldes" style="width: 100px;">
                <option value="SI" <?php if($ing->estan_los_moldes=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($ing->estan_los_moldes=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="NO LLEVA" <?php if($ing->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
            </select> 
            <select name="molde" class="chosen-select" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');">
                <?php
                $moldes=$this->moldes_model->getMoldes();
                foreach($moldes as $molde)
                {
                    ?>
                    <option value="<?php echo $molde->id?>" <?php if($ing->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                    <?php
                }
                ?>
                
            </select> 
                <?php
            }
                ?>
            
            <span id="div_moldes"></span>
		</div>
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
         <input type="hidden" name="url" value="<?php echo base_url()."cotizaciones/hoja_de_costos2/".$id."/".$pagina;?>" />
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