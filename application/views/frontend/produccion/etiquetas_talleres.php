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
            <?php for($i=1;$i<=6;$i++){?>
            <div class="divp">  
                <div class="imagen">    
                <img width="120px" src="public/frontend/images/Logo-Tendencia-web.png" />
                </div>
                <div class="ot">    
                    <div>OT</div>
                    <div>18761</div>
                </div>
                <div class="codigo">    
                    <div>CODIGO</div>
                    <div>18761A032</div>
                </div>
                <div class="titulo">    
                    ENVASES DE MICROCORRUGADO
                </div>
                <div class="cliente">    
                    Cliente:
                </div>
                <div class="nombre_cliente">    
                    COCESA
                </div>
                <div class="articulo">    
                    Articulo:
                </div>
                <div class="nombre_articulo">    
                    CAJA THHN - FLEX CHICA WY2-00
                </div>
                <div class="paquete">    
                    Paquete de:
                </div>
                <div class="cantidad">    
                    <span style="font-size: 32px">100</span> Unidades
                </div>
                <div class="fecha">    
                    <?php echo $fecha;?>
                </div>
            </div>
            <?php }?>
        </div>
    </body>