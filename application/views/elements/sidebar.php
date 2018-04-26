<div class="grid_3" id="sidebar">
    <div class="degrade-1">
 
     <ul id="sidebar_widgets" class="sidebar_widgets">
       
                      
                         <li class="widget">
          <div class="whitebox">
            <h4>Redes Sociales</h4>
             <div class="padding-10">
            <div class="feedlist">
            <ul>

	<li><a href="https://www.facebook.com/macul" title="S&iacute;gueme en Facebook" target="_blank"><img src="http://www.cesarcancino.com/images/facebook.png"></a></li> 
	<li><a href="https://twitter.com/vivamacul" title="S&iacute;gueme en Twitter" target="_blank"><img src="http://www.cesarcancino.com/images/twitter.png"></a></li> 
	<li><a href="http://www.youtube.com/channel/UCBKacyguc6XEubyCvS2E-4w" title="S&iacute;gueme en Youtube" target="_blank"><img src="http://www.cesarcancino.com/images/youtube.png"></a></li> 
	
	<li><a href="https://plus.google.com/u/0/110532493253629856178/posts?hl=es_ES" title="S&iacute;gueme en Google Plus" target="_blank"><img src="http://www.cesarcancino.com/images/google+.png"></a></li>
	
</ul>
            </div>                    	<div class="clear"></div>
          </div>
          </div>
        </li>
        <?php
        switch ($this->uri->segment(1)) 
        {
            case 'categoria':
              $tipo_nodo=2;
              $registro=$ide_registro;
            break;
            case 'sub_categoria':
              $tipo_nodo=3;
              $registro=$ide_registro;
            break;
            case 'nodos':
              $tipo_nodo=4;
              $registro=$ide_registro;
            break;
          
          default:
            $tipo_nodo=1;
            $registro=0;
            break;
        }
        $banner_sidebar=$this->generic_model->getBannerRandomSidebar(2,$tipo_nodo,$registro);
        if(sizeof($banner_sidebar)>=1)
        {
          foreach ($banner_sidebar as $banner_sidebars) 
          {
            # code...
          
          ?>
          <li class="widget">
          <div class="whitebox">
            <h4>Publicidad</h4>
             <div class="padding-10">
             <?php
    
    switch ($banner_sidebars->target) 
    {
       case '1':
          $target="_self";
        break;
        case '2':
          $target="_blank";
        break;
      
    }
    ?>
    <a href="<?php echo $banner_sidebars->link?>" target="<?php echo $target?>">
<img src="<?php echo base_url()?>public/uploads/banner/<?php echo $banner_sidebars->foto?>" width="200"  />
    </a>
          </div>
        </li>

          <?php
        }
      }
        ?>
                 

                             <li class="widget">
          <div class="whitebox">
            <h4>Últimas publicaciones</h4>
             <div class="padding-10">
            <div class="reg">
                <ul>
                <?php
                $datos=$this->nodos_model->getUltimosNodosSidebar();
                foreach($datos as $dato)
                {
                    ?>
                    <li>
                        <a href="<?php echo base_url()?>nodos/detalle/<?php echo $dato->seo_slug?>" title="<?php echo ucfirst($dato->titulo)?>"><?php echo ucfirst($dato->titulo)?></a>
                    </li>
                    <?php
                }
                ?>
                    
                </ul>
            </div>                    	<div class="clear"></div>
          </div>
          </div>
        </li>
                                <li class="widget">
          <div class="whitebox">
            <h4>Síguenos en Facebook</h4>
            <div class="padding-10">
          	<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FMacul%2F1378554165760564&amp;width=200&amp;height=200&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=true&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:200px;" allowTransparency="true"></iframe>
<div class="clear"></div>
          </div>
          </div>
        </li>
                
        	          </ul> 
   </div>
  </div>