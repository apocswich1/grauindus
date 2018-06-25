<?php
if ($this->session->userdata('perfil') != 2) {
    ?>
    <div class="control-group">
        <label class="control-label" for="usuario"><strong>PDF Trazado Ingeniería</strong></label>
        <div class="controls">
            <?php if ($moldes2->archivo == "" && $trazadosing->archivo == "") { if($datos->numero_molde == "21"){?>
                <a href='#'>No Lleva Archivo de Trazado Ingenieria</a>
            <?php }else{ ?>
                <a href='#'>No Existe Archivo de Trazado Ingenieria</a>
            <?php } } else {
                if ($trazadosing->archivo == "") { //echo $moldes2->id?>
                    <a href='<?php echo base_url() . $this->config->item('direccion_pdf') . $moldes2->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>    
                    <?php } else { ?>
                    <a href='<?php echo base_url() . $this->config->item('direccion_pdf') . $trazadosing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i><?php echo $trazadosing->numero ?></a>        
            <?php } } ?>
        </div>
    </div>
<?php } ?>
<hr />