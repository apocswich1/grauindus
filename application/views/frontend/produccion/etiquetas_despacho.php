<?php
setlocale(LC_ALL,'es_ES');
$fecha = date("Y-m-d");
//$fecha = fecha($fecha);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="spanish"/>
<title>Orden de Produccion :: Talleres Externos</title>
</head>

    <body>
        <div id="dina4">
            <?php for($i=1;$i<=8;$i++){?>
            <div class="divp">  
                <div class="imagen">    
                    <img width="110px" src="<?php echo $logo; ?>" />
                </div>
                <div class="ot">    
                    <div>OT</div>
                    <div><?php echo $producto->ot; ?></div>
                </div>
                <div class="codigo">    
                    <div>CODIGO</div>
                    <div><?php echo $codigoproducto; ?></div>
                </div>
                <div class="titulo">    
                    ENVASES DE MICROCORRUGADO
                </div>
                <div class="cliente">    
                    Cliente:
                </div>
                <div class="nombre_cliente">    
                    <?php echo $producto->razon_social; ?>
                </div>
                <div class="articulo">    
                    Articulo:
                </div>
                <div class="nombre_articulo">    
                    <?php echo $producto->producto; ?>
                </div>
                <div class="paquete">    
                    Paquete de: 
                </div>
                <div class="cantidad">    
                    <span style="font-size: 32px"><?php echo $paquetede; ?></span> Unidades
                </div>
                <div class="fecha">    
                    <?php echo date('d-m-Y'); ?>
                </div>
            </div>
            <?php }?>
        </div>
    </body>