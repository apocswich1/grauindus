           <div id="molde_select_cliente">
               <select name="molde_registrado" class="chosen-select" id="molde_registrado" style="width: 400px;" onchange="carga_ajax5('<?php echo base_url();?>moldes/detalle_ajax',this.value,'div_moldes')";>                
             <option value="0">Seleccione......</option>
                <?php
                foreach($moldes as $molde)
                {
                    ?>
                        <option value="<?php echo $molde->id; ?>"<?php if($datos_cotizacion->numero_molde==$molde->id ){ echo ' selected'; } ?>><?php echo 'Nro: '.$molde->id.' '.$molde->nombre; if($molde->archivo!=""){echo " Tiene Pdf";} ?></option>                
                    <?php
                }
                ?>                    
            </select>
            <span id="div_moldes2"></span>
           </div> 
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