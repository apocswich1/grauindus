<?php
if(empty($datos->archivo))
{
     ?>
    <a href="javascript:void(0);" onclick="alert('No se ha subido el archivo de este molde');"><?php echo $datos->id?></a>
    <?php
}else
{
    ?>
    <a href="<?php echo base_url()?>public/uploads/<?php echo $datos->archivo?>" target="_blank"><?php echo $datos->id?></a>
    <?php
}
?>
