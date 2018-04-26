<?php if ( $this->session->flashdata('ControllerMessage') != '' OR isset($error) AND $error != NULL ) {?>
<div class="well"><button type="button" class="close" data-dismiss="alert">x</button>
    <?php
    // echo $this->session->flashdata('ControllerMessage');
    if($this->session->flashdata('ControllerMessage')=="Registro guardado exitosamente.")
    {
        ?>
      <div class="alert alert-success">  <?php echo $this->session->flashdata('ControllerMessage');?></div>
        <?php
    }else
    {
        echo $this->session->flashdata('ControllerMessage');
    }
	if(isset($error) AND $error != NULL ){
		 echo '<div class="alert alert-success">'.$error["error"].'</div>';
	}
    ?>
</div>
<?php } ?>
<?php
	$validation_error = validation_errors('<li>', '</li>');
	if($validation_error != ""){
		echo '<div class="well well-small"><button type="button" class="close" data-dismiss="alert">x</button><ul>'.$validation_error.'</ul></div>';
	}
?>

