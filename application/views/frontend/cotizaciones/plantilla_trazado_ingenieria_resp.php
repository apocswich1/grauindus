 <?php
    if ($this->session->userdata('perfil') != 2) {
        ?>
    <div class="control-group">
            <label class="control-label" for="usuario"><strong>PDF Trazado Ingeniería</strong></label>
            <div class="controls">
                    <?php //echo $ing->archivo;// print_r($trazadosing) //my code is here ?>
                <?php if ($ing->archivo == "") {
                    if($moldes2->archivo == "" && $trazadosing->archivo==""){ ?>
                    <a href='#'>No Existe Archivo de Trazado Ingenieria</a>
                    <?php }else{ if($trazadosing->archivo==""){ ?>
                    <a href='<?php echo base_url() . $this->config->item('direccion_pdf') . $moldes2->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>    
                    <?php }else{ ?>
                    <a href='<?php echo base_url() . $this->config->item('direccion_pdf') . $trazadosing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i><?php echo $trazadosing->numero  ?></a>        
                    <?php } }}else{ if ($ing->archivo == "") { ?>
                    <a href='<?php echo base_url() . $this->config->item('direccion_pdf') . $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
                    <?php }else{ if($trazadosing->archivo==""){ ?>
                    <a href='<?php echo base_url() . $this->config->item('direccion_pdf') . $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
                    <?php }else{ ?> 
                    <a href='<?php echo base_url() . $this->config->item('direccion_pdf') . $trazadosing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i><?php echo $trazadosing->numero  ?></a>            
                    <?php }}} ?>
                <?php //var_dump($ing); ?>
            </div>
        </div>
    <?php } ?>
    <hr />

