<script>
function nextOnEnter2(obj,e){
    e = e || event;
    // we are storing all input fields with tabindex attribute in 
    // a 'static' field of this function using the external function
    // getTabbableFields
    nextOnEnter.fields = nextOnEnter.fields || getTabbableFields();
    if (e.keyCode === 13) {
        // first, prevent default behavior for enter key (submit)
        if (e.preventDefault){
            e.preventDefault();
        } else if (e.stopPropagation){    
          e.stopPropagation();
        } else {   
          e.returnValue = false;
        }
       // determine current tabindex
       var tabi = parseInt(obj.getAttribute('tabindex'),10);
       // focus to next tabindex in line
       if ( tabi+1 < nextOnEnter.fields.length ){
         nextOnEnter.fields[tabi+1].focus();
        }
    }
}
</script>
<label class="control-label" for="usuario">Producto</label>
		<div class="controls">
			<select onkeypress="nextOnEnter2(this,event);"  name="producto">
                <option value="0">Seleccione......</option>
                <?php
                foreach($datos as $dato)
                {
                    ?>
                    <option value="<?php echo $dato->producto?>"><?php echo $dato->producto?></option>
                    <?php
                }
                ?>
                <option value="2000">Otro</option>
            </select>
            <input type="text" onkeypress="nextOnEnter2(this,event);"  name="producto2" placeholder="Descripción del Producto" />
		</div>