<div class="breadcrumb-bg">
      
      <div class="buscador">
                   
              <form method="post" action="<?php echo base_url();?>result" name="buscador" class="buscador-form">
              <input type="text"  name="buscar" class="input" onblur="this.value=(this.value=='') ? 'Buscar...' : this.value;" onfocus="this.value=(this.value=='Buscar...') ? '' : this.value;" value="Buscar..." /> 

              
             
              <select name='cat' id='cat' class='select' >
	<option value='0' selected='selected'>Todas las categorias</option>
	<?php
    $cats=$this->categorias_model->getCategorias();
    foreach($cats as $cat)
    {
        $subs=$this->categorias_model->getSubCategoriaPorIdCategoria($cat->id);
        ?>
        <option class="level-0" value="<?php echo $cat->id?>" title="<?php echo $cat->categoria?>"><?php echo $cat->categoria?></option>
	   
        <?php
        
        
    }
    ?>

    
	
	
</select>
              <input type="hidden" name="que_hago" value="0" />
              <input type="submit" name="submit" class="button buscar" value="Buscar" title="Buscar" />
            </form>
           
          </div>
      
        <div class="ver_cats">
     
        <a href="#" class="ver-categorias">Ver Categorías [+]</a>
      <ul>
         <?php
        $rands=$this->categorias_model->getCategoriasRand();
        foreach($rands as $rand)
        {
            ?>
            <li class="cathead"><a href="<?php echo base_url()?>categoria/detalle/<?php echo $rand->seo_slug?>"><?php echo ucfirst($rand->categoria)?></a></li>
            <?php
        }
        ?>
        
        </ul>     
      </div>

    </div>