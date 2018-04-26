                <?php if ($datos->unidad_de_venta=='2') { ?>
                <!--KILO-->
                    <div id="<?php echo $div; ?>">
                        <input type="text" name="input_<?php echo $div; ?>"  value="0" />&nbsp;&nbsp;Kilos  
                    </div>
                <?php }     
                     elseif ($datos->unidad_de_venta=='1') { ?>
                <!--METRO-->                
                    <div id="<?php echo $div; ?>">
                        <input type="text" name="input_<?php echo $div; ?>"  value="0" />&nbsp;&nbsp;Metros  
                    </div>
                <?php }     
                     elseif ($datos->unidad_de_venta=='6') { ?>
                <!--CM2-->                   
                    <div id="<?php echo $div; ?>">
                        <input type="text" name="input_<?php echo $div; ?>"  value="0" />&nbsp;&nbsp;Cm2  
                    </div>
                <?php }     
                     elseif ($datos->unidad_de_venta=='10') { ?>
                <!--POR PAZADA-->                    
                    <div id="<?php echo $div; ?>">
                        <input type="text" name="input_<?php echo $div; ?>"  value="1" />&nbsp;&nbsp;Por Pasada  
                    </div>
                <?php }     
                     elseif ($datos->unidad_de_venta=='9') { ?>
                <!--MONTO FIJO-->                    
                    <div id="<?php echo $div; ?>">
                        <input type="text" name="input_<?php echo $div; ?>"  value="1" />&nbsp;&nbsp;Monto Fijo
                    </div>
                <?php }  ?> 
  

