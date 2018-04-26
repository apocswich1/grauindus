 <div class="breadcrumb-bg">
      
     <div class="buscador">

                  <div class="breadcrumb">Estás aquí­: <a href="<?php echo base_url()?>">Inicio</a> / <?php echo $id?></div>   

            

            

          </div>

      
        <div class="ver_cats">
     
        <a href="#" class="ver-categorias">Ver Categorias [+]</a>
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