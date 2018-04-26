<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Usted no tiene acceso a ese módulo, póngase en contacto con ega@grauindus.cl </h3></div>
<p>
    <img src="<?php echo base_url()?>public/backend/images/accesodenegado.png" />
</p>









