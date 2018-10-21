<?php

if(sizeof($ing)>0){
    if($ing->numero_molde!="" && $ing->numero_molde!=11 && $ing->numero_molde!=12 && $ing->numero_molde!=13 && $ing->numero_molde!=14 && $ing->numero_molde!=15 && $ing->numero_molde!=1 && $ing->numero_molde!=21){
    $etiquetamolde="SI";
    }else{
    if($ing->estan_los_moldes=="NO"){ $etiquetamolde="NO"; }
    if($ing->estan_los_moldes=="SI"){ $etiquetamolde="SI"; }
    if($ing->estan_los_moldes=="MOLDE GENERICO"){ $etiquetamolde="SI"; }
    if($ing->estan_los_moldes=="NO LLEVA"){ $etiquetamolde="NO"; }
    if($ing->estan_los_moldes=="NO (HAY QUE FABRICAR)"){ $etiquetamolde="NO"; }
    if($ing->estan_los_moldes=="CLIENTE LO APORTA)"){ $etiquetamolde="NO"; }
    if($ing->estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE)"){ $etiquetamolde="SI"; }}
}else{ 
    if($datos->estan_los_moldes=="NO"){ $etiquetamolde="NO"; }
    if($datos->estan_los_moldes=="SI"){ $etiquetamolde="SI"; }
    if($datos->estan_los_moldes=="MOLDE GENERICO"){ $etiquetamolde="SI"; }
    if($datos->estan_los_moldes=="NO LLEVA"){ $etiquetamolde="NO"; }
    if($datos->estan_los_moldes=="NO (HAY QUE FABRICAR)"){ $etiquetamolde="NO"; }
    if($datos->estan_los_moldes=="CLIENTE LO APORTA)"){ $etiquetamolde="NO"; }
    if($datos->estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE)"){ $etiquetamolde="SI"; }
} 

?>

<?php if(sizeof($ing)>0){ ?>
    <div class="control-group" id="div_estan_los_moldes">
    <label class="control-label" for="usuario">Están los moldes?</label>
    <div class="controls">
      <select name="select_estan_los_moldes" style="width: 300px;" onchange="estanLosMoldesPropia(this.value);">
        <option value="">Seleccione.....</option>
        <option value="SI" <?php if($ing->estan_los_moldes=="SI"){echo 'selected="selected"';}?>>SI</option>
        <option value="NO" <?php if($ing->estan_los_moldes=="NO" && ($ing->numero_molde=="" || $ing->numero_molde=="1" || $ing->numero_molde=="21")){echo 'selected="selected"'; }?>>NO (HAY QUE FABRICAR)</option>
        <option value="MOLDE GENERICO" <?php if($ing->estan_los_moldes=="NO" && $ing->numero_molde!="" && $ing->numero_molde!=1 && $ing->numero_molde!=21){echo 'selected="selected"';}?>>MOLDE GENERICO</option>
        <option value="NO LLEVA"<?php if($ing->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
        <option value="CLIENTE LO APORTA" <?php if($ing->estan_los_moldes=="CLIENTE LO APORTA"){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
        <option value="MOLDE GENERICO" <?php if($ing->estan_los_moldes=="MOLDE GENERICO"){echo 'selected="selected"';}?>>MOLDE GENERICO</option>
        <option value="MOLDE REGISTRADOS DEL CLIENTE" <?php if($ing->estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE"){echo 'selected="selected"';}?>>MOLDE REGISTRADOS DEL CLIENTE</option>
      </select>  
    </div>
    </div>
    <?php //echo $ing->numero_molde; //my code is here ?>
<div class="control-group" id="div_estan_los_moldes_generico" <?php if($datos->estan_los_moldes=="NO" && $datos->numero_molde!="" && $datos->numero_molde!=1 && $datos->numero_molde!=11 && $datos->numero_molde!=12 && $datos->numero_molde!=13 && $datos->numero_molde!=14 && $datos->numero_molde!=15 && $datos->numero_molde!=21 ){ echo "style='display:block'"; }else{ echo "style='display:none'"; } ?>>
            <div class="controls">
                <div id="molde_select">
                    <select name="molde_generico" class="chosen-select" id="molde_generico" style="width: 400px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');carga_ajax_cambio_molde('<?php echo base_url();?>moldes/detalle_ajax_cambio_molde',this.value,'div_moldes')";>
                        <?php foreach($moldes as $molde) { ?>
                            <option value="<?php echo $molde->id?>" <?php if($ing->numero_molde==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>) <?php if($molde->archivo!=""){ echo 'Tiene Pdf'; } ?></option>
                        <?php } ?>
                    </select> 
                    <span id="div_moldes"></span>
                </div> <?php if($moldes2->razon_social!=""){echo "Propietario: ".$moldes2->razon_social;} ?>
            </div>
    </div>

<div class="control-group" id="div_estan_los_moldes_generico" <?php if($datos->estan_los_moldes=="MOLDE GENERICO" || $datos->estan_los_moldes=="SI" ){ echo "style='display:block'"; }else{ echo "style='display:none'"; } ?>>
            <div class="controls">
                <div id="molde_select">
                    <select name="molde_generico" class="chosen-select" id="molde_generico" style="width: 400px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');carga_ajax_cambio_molde('<?php echo base_url();?>moldes/detalle_ajax_cambio_molde',this.value,'div_moldes')";>
                        <?php foreach($moldes as $molde) { ?>
                            <option value="<?php echo $molde->id?>" <?php if($numero_moldes==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>) <?php if($molde->archivo!=""){ echo 'Tiene Pdf'; } ?></option>
                        <?php } ?>
                    </select> 
                    <span id="div_moldes"></span>
                </div> <?php if($moldes2->razon_social!=""){echo "Propietario: ".$moldes2->razon_social;} ?>
            </div>
    </div>

    <div class="control-group" id="div_estan_los_moldes_clientes" <?php if($estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE")  { echo 'style="display: block;"'; } else { echo 'style="display: none;"';} ?>>
		<div class="controls">
                    <div id="molde_select_cliente">
                          <select name="molde_registrado" id="molde_registrado"  class="chosen-select" style="width: 600px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');carga_ajax_cambio_molde('<?php echo base_url();?>moldes/detalle_ajax_cambio_molde',this.value,'div_moldes')">
                            <option value="0">Seleccione......</option>
                              <?php
                              $error_molde=false;                              
                              if (sizeof($moldes_clientes)>0) 
                              {                                 
                                foreach($moldes_clientes as $molde)
                                {
                                    ?>
                                    <option value="<?php echo $molde->id?>" <?php if($numero_moldes==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                                    <?php
                                }
                              }  else { $error_molde=true; }?>                                
                          </select> 
                          <span id="div_moldes2"></span>
                          <?php if ($error_molde) { ?>
                                    <div style="background-color: #b13b28; color:white; width: 100%;">&nbsp;&nbsp;Error en el Molde Pertenece a otro Cliente, o no esta activo, no se grabaran los moldes!!</div>
                          <?php } ?>                              
                    </div> <?php if($moldes2->razon_social!=""){echo "Propietario: ".$moldes2->razon_social;} ?>                   
		</div>
        </div>       
<?php }else{ ?>
    <div class="control-group" id="div_estan_los_moldes">
    <label class="control-label" for="usuario">Están los moldes?</label>
    <div class="controls">
      <select name="select_estan_los_moldes" style="width: 300px;" onchange="estanLosMoldesPropia(this.value);">
        <option value="">Seleccione.....</option>
        <option value="SI" <?php if($datos->estan_los_moldes=="SI"){echo 'selected="selected"';}?>>SI</option>
        <option value="NO" <?php if($datos->estan_los_moldes=="NO"){echo 'selected="selected"';}?>>NO (HAY QUE FABRICAR)</option>
        <option value="NO LLEVA"<?php if($datos->estan_los_moldes=="NO LLEVA"){echo 'selected="selected"';}?>>NO LLEVA</option>
        <option value="CLIENTE LO APORTA" <?php if($datos->estan_los_moldes=="CLIENTE LO APORTA"){echo 'selected="selected"';}?>>CLIENTE LO APORTA</option>
        <option value="MOLDE GENERICO" <?php if($datos->estan_los_moldes=="MOLDE GENERICO"){echo 'selected="selected"';}?>>MOLDE GENERICO</option>
        <option value="MOLDE REGISTRADOS DEL CLIENTE" <?php if($datos->estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE"){echo 'selected="selected"';}?>>MOLDE REGISTRADOS DEL CLIENTE</option>
      </select>  
    </div>
    </div>
    
<div class="control-group" id="div_estan_los_moldes_generico" <?php if($datos->estan_los_moldes=="MOLDE GENERICO" || $datos->estan_los_moldes=="SI" ){ echo "style='display:block'"; }else{ echo "style='display:none'"; } ?>>
        <!--<label class="control-label" for="usuario">Moldes Genericos</label>-->
            <div class="controls">
<!--            	<select name="select_estan_los_moldes_genericos" style="width: 600px;" onchange="estanLosMoldes(this.value);">
                    <option value="SI" <?php// if($etiquetamolde=='SI'){echo 'selected="selected"';}?>>SI</option> 
                    <option value="NO" <?php// if($etiquetamolde=='NO'){echo 'selected="selected"';}?>>NO</option>
                </select> -->
                <div id="molde_select">
                    <select name="molde_generico" class="chosen-select" id="molde_generico" style="width: 400px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');carga_ajax_cambio_molde('<?php echo base_url();?>moldes/detalle_ajax_cambio_molde',this.value,'div_moldes')";>
                        <?php foreach($moldes as $molde) { ?>
                            <option value="<?php echo $molde->id?>" <?php if($numero_moldes==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>) <?php if($molde->archivo!=""){ echo 'Tiene Pdf'; } ?></option>
                        <?php } ?>
                    </select> 
                    <span id="div_moldes"></span>
                </div> <?php if($moldes2->razon_social!=""){echo "Propietario: ".$moldes2->razon_social;} ?>
            </div>
    </div>

    <div class="control-group" id="div_estan_los_moldes_clientes" <?php if($estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE")  { echo 'style="display: block;"'; } else { echo 'style="display: none;"';} ?>>
		<!--<label class="control-label" for="usuario">Moldes del Cliente</label>-->
		<div class="controls">
<!--			<select name="select_estan_los_moldes_no_genericos_clientes" style="width: 300px;" class="chosen-select" onchange="estanLosMoldes(this.value);">
                        <option value="SI" <?php if($etiquetamolde=='SI'){echo 'selected="selected"';}?>>SI</option> 
                        <option value="NO" <?php if($etiquetamolde=='NO'){echo 'selected="selected"';}?>>NO</option>
                    </select> -->
                    <div id="molde_select_cliente">
                          <select name="molde_registrado" id="molde_registrado"  class="chosen-select" style="width: 600px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes');carga_ajax_cambio_molde('<?php echo base_url();?>moldes/detalle_ajax_cambio_molde',this.value,'div_moldes')">
                            <option value="0">Seleccione......</option>
                              <?php
                              $error_molde=false;                              
                              if (sizeof($moldes_clientes)>0) 
                              {                                 
                                foreach($moldes_clientes as $molde)
                                {
                                    ?>
                                    <option value="<?php echo $molde->id?>" <?php if($numero_moldes==$molde->id){echo 'selected="selected"';}?>><?php echo $molde->nombre?> (N° <?php echo $molde->numero?>)</option>
                                    <?php
                                }
                              }  else { $error_molde=true; }?>                                
                          </select> 
                          <span id="div_moldes2"></span>
                          <?php if ($error_molde) { ?>
                                    <div style="background-color: #b13b28; color:white; width: 100%;">&nbsp;&nbsp;Error en el Molde Pertenece a otro Cliente, o no esta activo, no se grabaran los moldes!!</div>
                          <?php } ?>                              
                    </div> <?php if($moldes2->razon_social!=""){echo "Propietario: ".$moldes2->razon_social;} ?>                   
		</div>
        </div>       
<?php } ?>