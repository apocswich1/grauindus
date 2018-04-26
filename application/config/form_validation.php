<?php
/**
 * Reglas de validacion para formularios
 * este es el que finciona ingjjsg
 */
$config = array(
	/**
	 * Logueo
	 */
	'logueo'
		=> array(
			
            array('field' => 'rut','label' => 'RUT','rules' => 'required|is_string|trim|xss_clean|max_length[20]|esRut'),
			array('field' => 'pass','label' => 'Contraseña','rules' => 'required|is_string|trim|xss_clean|max_length[100]')
            ),
     /**
	 * ad_usuario
	 */
	'ad_usuario'
		=> array(
			
            array('field' => 'perfil','label' => 'Perfil','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'cargo','label' => 'Cargo','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'rut','label' => 'RUT','rules' => 'required|is_string|trim|xss_clean|max_length[20]|esRut'),
			array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|xss_clean|valid_email'),
            array('field' => 'tel','label' => 'Teléfono','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'pass','label' => 'Contraseña','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'pass2','label' => 'Repetir Contraseña','rules' => 'required|is_string|trim|xss_clean|max_length[100]|matches[pass]'),
            ),
            /**
	 * edit_usuario
	 */
	'edit_usuario'
		=> array(
			
            array('field' => 'perfil','label' => 'Perfil','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'cargo','label' => 'Cargo','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'rut','label' => 'RUT','rules' => 'required|is_string|trim|xss_clean|max_length[20]|esRut'),
			array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|xss_clean|valid_email'),
            array('field' => 'tel','label' => 'Teléfono','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'pass','label' => 'Contraseña','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'pass2','label' => 'Repetir Contraseña','rules' => 'is_string|trim|xss_clean|max_length[100]|matches[pass]'),
             ),
    /**
	 * ad_cliente
	 */
	'ad_cliente'
		=> array(
			array('field' => 'forma_pago','label' => 'Forma de Pago','rules' => 'required|trim|xss_clean|validaSelect'),
			array('field' => 'vendedor','label' => 'Vendedor','rules' => 'required|trim|xss_clean|validaSelect'),                    
                        array('field' => 'rut','label' => 'RUT','rules' => 'required|is_string|trim|xss_clean|max_length[20]|esRut|is_unique[clientes.rut]'),
			array('field' => 'razon','label' => 'Razón Social','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                        array('field' => 'nom','label' => 'Nombre Fantasía','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                        array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|xss_clean|valid_email'),
                        array('field' => 'tel','label' => 'Teléfono','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            
            ),
    
	'edit_cliente'
		=> array(
			array('field' => 'forma_pago','label' => 'Forma de Pago','rules' => 'required|trim|xss_clean|validaSelect'),
			array('field' => 'vendedor','label' => 'Vendedor','rules' => 'required|trim|xss_clean|validaSelect'),                    
			array('field' => 'razon','label' => 'Razón Social','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                        array('field' => 'nom','label' => 'Nombre Fantasía','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                        array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|xss_clean|valid_email'),
                        array('field' => 'tel','label' => 'Teléfono','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            
            ),    
            /**
	 * ad_vendedor
	 */
	'ad_vendedor'
		=> array(
            array('field' => 'comision','label' => 'Comisión','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'rut','label' => 'RUT','rules' => 'required|is_string|trim|xss_clean|max_length[20]|esRut'),
            array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|xss_clean|valid_email'),
            array('field' => 'tel','label' => 'Teléfono','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'cel','label' => 'Celular','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'situacion','label' => 'Situación Laboral','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'region','label' => 'Región','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
            array('field' => 'ciudad','label' => 'Ciudad','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
            array('field' => 'comuna','label' => 'Comuna','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
            array('field' => 'dir','label' => 'Dirección','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            
            ),
            /**
	 * ad_forma_pago
	 */
	'ad_forma_pago'
		=> array(
			array('field' => 'nom','label' => 'Forma de Pago','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'dias','label' => 'Días','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),
'ad_rubro'
		=> array(
			array('field' => 'nom','label' => 'rubro','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),
    /**
	 * ad_unidad_de_compra
	 */
	'ad_unidad_de_compra'
		=> array(
			array('field' => 'nom','label' => 'Unidad de Compra','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),            ),
    
    
                /**
	 * productos
	 */
	'productos'
		=> array(
			array('field' => 'tipo','label' => 'Tipo de Producto','rules' => 'required|trim|xss_clean|validaSelect'),
            ),    
    
                /**
	 * ad_unidad_de_uso
	 */
	'ad_unidad_de_uso'
	=> array(
            array('field' => 'nom','label' => 'Unidad de Compra','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'unidad_venta','label' => 'Unidad Venta','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'factor_conv','label' => 'Factor Conversión','rules' => 'is_string|trim|xss_clean|max_length[100]'),                    
            array('field' => 'unidad_uso','label' => 'Unidad de Uso','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),    
   /**
	 * ad_unidad_de_venta
	 */
	'ad_unidad_de_venta'
		=> array(
			array('field' => 'nom','label' => 'Unidad de Venta','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),
     /**
	 * ad_piezas_adicionales
	 */
	'ad_piezas_adicionales'
		=> array(
			array('field' => 'nom','label' => 'Piezas Adicionales','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                        array('field' => 'unidad_de_compra','label' => 'Unidad de Compra','rules' => 'required|trim|xss_clean|validaSelect'),
                        array('field' => 'id_proveedor1','label' => 'Proveedor 1','rules' => 'required|trim|xss_clean|validaSelect'),
                        array('field' => 'id_proveedor2','label' => 'Proveedor 2','rules' => 'required|trim|xss_clean|validaSelect'),
                        array('field' => 'valor_compra','label' => 'Valor de Compra','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                        array('field' => 'unidad_de_venta','label' => 'Unidad de Venta','rules' => 'required|trim|xss_clean|validaSelect'),
                        array('field' => 'unidad_de_conversion','label' => 'Unidad de Conversión','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                        array('field' => 'valor_venta','label' => 'Valor de Venta','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                        array('field' => 'calculo_ingenieria','label' => 'Calculo ingenieria','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                        array('field' => 'id_user','label' => 'Quien lo modifico','rules' => 'required|trim|xss_clean|validaSelect'),
                        array('field' => 'fecha_modificacion','label' => 'Fecha Modificacion','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),                    
            ),
    /**
	 * ad_contacto_cliente
	 */
	'ad_contacto_cliente'
		=> array(
			array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
           array('field' => 'tel','label' => 'Teléfono','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|xss_clean|valid_email'),
            ),        
       /**
	 * ad_producto_asociado
	 */
	'ad_producto_asociado'
		=> array(
			array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
           array('field' => 'des','label' => 'Descripción','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),      
    /**
	 * ad_proveedores
	 */
	'ad_proveedores'
		=> array(
			array('field' => 'nom','label' => 'Proveedor','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
           array('field' => 'telefono','label' => 'Teléfono','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'correo','label' => 'E-Mail','rules' => 'required|is_string|trim|xss_clean|valid_email'),
            array('field' => 'rubro','label' => 'Rubro','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'rut','label' => 'RUT','rules' => 'required|is_string|trim|xss_clean|max_length[20]|esRut|is_unique[proveedores.rut]'),
            ),
   /**
	 * ad_materiales
	 */
	'ad_materiales'
		=> array(
			array('field' => 'tipo','label' => 'Tipo Material','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'proveedor','label' => 'Proveedor','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'codigo','label' => 'Código','rules' => 'required|is_string|trim|xss_clean|max_length[100]|is_unique[materiales.codigo]'),
            array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
           array('field' => 'reverso','label' => 'Reverso','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'procedencia','label' => 'Procedencia','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'gramaje','label' => 'Gramaje','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'ancho','label' => 'Ancho','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'unidad_de_compra','label' => 'Unidad de Compra','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'precio','label' => 'Peso','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            ),
            /**
	 * edit_materiales
	 */
	'edit_materiales'
		=> array(
			array('field' => 'tipo','label' => 'Tipo Material','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'proveedor','label' => 'Proveedor','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'codigo','label' => 'Código','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
           array('field' => 'reverso','label' => 'Reverso','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'procedencia','label' => 'Procedencia','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'gramaje','label' => 'Gramaje','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'ancho','label' => 'Ancho','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'unidad_de_compra','label' => 'Unidad de Compra','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'precio','label' => 'Peso','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            ),
     
     /**
	 * ad_monotapas
	 */
	'ad_monotapas'
		=> array(
            
            array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'codigo','label' => 'Código','rules' => 'required|is_string|trim|xss_clean|max_length[100]|is_unique[materiales_monotapas.codigo]'),
            array('field' => 'tapa','label' => 'Tapa, Papel o Cartulina, para onda ','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'gramaje','label' => 'Gramaje Onda','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'onda','label' => 'Onda','rules' => 'required|trim|xss_clean'),
            array('field' => 'tapa2','label' => 'Tapa, Papel o Cartulina, para liner ','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'gramaje2','label' => 'Gramaje Liner','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            //array('field' => 'liner','label' => 'Liner','rules' => 'required|trim|xss_clean'),
            ),
            /**
	 * edit_monotapas
	 */
	'edit_monotapas'
		=> array(
            
            array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'codigo','label' => 'Código','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'tapa','label' => 'Tapa, Papel o Cartulina, para onda ','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'gramaje','label' => 'Gramaje Onda','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'onda','label' => 'Onda','rules' => 'required|trim|xss_clean'),
            array('field' => 'tapa2','label' => 'Tapa, Papel o Cartulina, para liner ','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'gramaje2','label' => 'Gramaje Liner','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            //array('field' => 'liner','label' => 'Liner','rules' => 'required|trim|xss_clean'),
            ),
            
    /**
	 * ad_insumo
	 */
	'ad_insumo'
		=> array(
            array('field' => 'proveedor1','label' => 'Proveedor 1','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'codigo','label' => 'Código','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'nom','label' => 'Material','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
           array('field' => 'caracteristica','label' => 'Caracteristicas','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'unidad_de_compra','label' => 'Unidad de Compra','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'unidad_de_venta','label' => 'Unidad de Venta','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'precio1','label' => 'Precio 1','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'precio2','label' => 'Precio 2','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'precio3','label' => 'Precio 3','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            ),
             /**
	 * ad_cotizacion
	 */
	'ad_cotizacion'
		=> array(
            
           //array('field' => 'cliente','label' => 'Cliente','rules' => 'required|trim|xss_clean|validaSelect'),
           array('field' => 'producto','label' => 'Descripción del Producto','rules' => 'required|trim|xss_clean|max_length[1000]'),
           array('field' => 'datos_tecnicos','label' => 'Datos Técnicos','rules' => 'required|trim|xss_clean|validaSelect'),
           array('field' => 'can1','label' => 'Cantidad 1','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'forma_pago','label' => 'Forma de Pago','rules' => 'required|trim|xss_clean'),
            ),
            /**
	 * ad_cotizacion2
	 */
	'ad_cotizacion2'
		=> array(
            
           array('field' => 'cliente','label' => 'Cliente','rules' => 'required|trim|xss_clean|validaSelect'),
           array('field' => 'producto','label' => 'Descripción del Producto','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'nombre_cliente','label' => 'Nombre Cliente','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'datos_tecnicos','label' => 'Datos Técnicos','rules' => 'required|trim|xss_clean|validaSelect'),
           array('field' => 'can1','label' => 'Cantidad 1','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'forma_pago','label' => 'Forma de Pago','rules' => 'required|trim|xss_clean'),
            ),
          /**
	 * ad_cotizacion_ingenieria
	 */
	'ad_cotizacion_ingenieria'
		=> array(
            
           array('field' => 'producto','label' => 'Descripción de Producto','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'unidades_por_pliego','label' => 'Unidades por Pliego','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'piezas_totales_en_el_pliego','label' => 'Piezas totales en el pliego','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'tamano_1','label' => 'Tamaño a imprimir','rules' => 'required|trim|xss_clean|max_length[100]'), 
            array('field' => 'tamano_2','label' => 'Tamaño a imprimir','rules' => 'required|trim|xss_clean|max_length[100]'),
            array('field' => 'tamano_cuchillo_1','label' => 'Distancia cuchillo a cuchillo','rules' => 'required|trim|xss_clean|max_length[100]'), 
            array('field' => 'tamano_cuchillo_2','label' => 'Distancia cuchillo a cuchillo','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'datos_tecnicos','label' => 'Datos Técnicos','rules' => 'required|trim|xss_clean|validaSelect'),
          // array('field' => 'ing_lleva_barniz','label' => 'Tipo de Barniz','rules' => 'required|trim|xss_clean|validaSelect'),
            ),
             /**
	 * ad_cotizacion_ingenieria2
	 */
	'ad_cotizacion_ingenieria2'
		=> array(
            
           array('field' => 'producto','label' => 'Descripción de Producto','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'unidades_por_pliego','label' => 'Unidades por Pliego','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'piezas_totales_en_el_pliego','label' => 'Piezas totales en el pliego','rules' => 'required|trim|xss_clean|max_length[100]'),
           //array('field' => 'metros_de_cuchillo','label' => 'Metros de Cuchillo','rules' => 'required|trim|xss_clean|max_length[100]'),
            array('field' => 'tamano_1','label' => 'Tamaño a imprimir','rules' => 'required|trim|xss_clean|max_length[100]'), 
            array('field' => 'tamano_2','label' => 'Tamaño a imprimir','rules' => 'required|trim|xss_clean|max_length[100]'),
            array('field' => 'tamano_cuchillo_1','label' => 'Distancia cuchillo a cuchillo','rules' => 'required|trim|xss_clean|max_length[100]'), 
            array('field' => 'tamano_cuchillo_2','label' => 'Distancia cuchillo a cuchillo','rules' => 'required|trim|xss_clean|max_length[100]'),
           array('field' => 'datos_tecnicos','label' => 'Datos Técnicos','rules' => 'required|trim|xss_clean|validaSelect'),
         //   array('field' => 'ing_lleva_barniz','label' => 'Tipo de Barniz','rules' => 'required|trim|xss_clean|validaSelect'),
            ),
              /**
        
              /**
	 * ad_cotizacion_fotomecanina
	 */
	'ad_cotizacion_fotomecanina'
		=> array(
            
           array('field' => 'condicion_del_producto','label' => 'Condición del Producto','rules' => 'required|trim|xss_clean'),
           array('field' => 'fot_lleva_barniz','label' => 'Lleva n Barniz','rules' => 'required|trim|xss_clean'),
           //array('field' => 'fot_reserva_barniz','label' => 'Reserva Barniz','rules' => 'required|trim|xss_clean'),
            ),
                  /**
	 * ad_variables_cotizador
	 */
	'ad_variables_cotizador'
		=> array(
            
            array('field' => 'nom','label' => 'Nombre','rules' => 'required|trim|xss_clean|max_length[100]'),
            array('field' => 'precio','label' => 'Precio','rules' => 'required|trim|xss_clean|numeric'),
            ),
                     /**
	 * ad_servicio
	 */
	'ad_servicio'
		=> array(
            
            array('field' => 'servicio','label' => 'Servicio','rules' => 'required|trim|xss_clean|max_length[100]'),
            array('field' => 'precio','label' => 'Precio','rules' => 'required|trim|xss_clean|numeric'),
            ),
               /**
	 * ad_finanza
	 */
	'ad_finanza'
		=> array(
            
            array('field' => 'uf','label' => 'Unidad de Fomento (UF)','rules' => 'required|trim|xss_clean|max_length[100]'),
            array('field' => 'dolar','label' => 'Dólar','rules' => 'required|trim|xss_clean|max_length[100]'),
            ),
      /**
	 * ad_impresion_presupuesto
	 */
	'ad_impresion_presupuesto'
		=> array(
            
            array('field' => 'precio_real','label' => 'Precio Empresa','rules' => 'required|trim|xss_clean|max_length[100]'),
            ),
    /**
	 * ad_cotizacion_presupuesto
	 */
	'ad_cotizacion_presupuesto'
		=> array(
            
            array('field' => 'costo_pegado','label' => 'Costo Pegado','rules' => 'required|trim|xss_clean|max_length[100]'),
            array('field' => 'margen','label' => 'Margen','rules' => 'required|trim|xss_clean|max_length[100]'),
            //array('field' => 'costos_adicionales','label' => 'Costos Adicionales','rules' => 'required|trim|xss_clean|max_length[100]'),
            //array('field' => 'valor_costos_adicionales','label' => 'Valor Costos Adicionales','rules' => 'required|trim|xss_clean|max_length[100]'),
            ),
  /**
	 * ad_orden_de_produccion
	 */
	'ad_orden_de_produccion'
		=> array(
            
            array('field' => 'fecha_despacho','label' => 'Fecha Despacho','rules' => 'required|trim|xss_clean|max_length[100]'),
            array('field' => 'persona_que_firma','label' => 'Persona que Firma orden de compra','rules' => 'required|trim|xss_clean|max_length[100]'),
            array('field' => 'numero_orden','label' => 'Número de Orden de Compra','rules' => 'required|trim|xss_clean|max_length[100]'),
            ),
            /**
	 * add_archivo_cliente_cotizacion
	 */
	'add_archivo_cliente_cotizacion'
		=> array(
			
            array('field' => 'nom','label' => 'Cliente','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            ),
             /**
	 * add_acabado
	 */
	'add_acabado'
		=> array(
			
            array('field' => 'proveedor1','label' => 'Proveedor 1','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'proveedor2','label' => 'Proveedor 2','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'codigo','label' => 'Código','rules' => 'required|is_string|trim|xss_clean|max_length[100]|is_unique[acabados2.codigo]'),
            array('field' => 'caracteristica','label' => 'Características','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            
            array('field' => 'tipo','label' => 'Tipo','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'unidad_de_compra','label' => 'Unidad de Compra','rules' => 'is_string|trim|xss_clean|validaSelect'),
            array('field' => 'unidad_de_venta','label' => 'Unidad de Venta','rules' => 'is_string|trim|xss_clean|validaSelect'),
            array('field' => 'valor_venta','label' => 'Valor Venta','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),
              /**
	 * edit_acabado
	 */
	'edit_acabado'
		=> array(
			
           array('field' => 'proveedor1','label' => 'Proveedor 1','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'proveedor2','label' => 'Proveedor 2','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'codigo','label' => 'Código','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'caracteristica','label' => 'Características','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            
            array('field' => 'tipo','label' => 'Tipo','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'unidad_de_compra','label' => 'Unidad de Compra','rules' => 'is_string|trim|xss_clean|validaSelect'),
            array('field' => 'unidad_de_venta','label' => 'Unidad de Venta','rules' => 'is_string|trim|xss_clean|validaSelect'),
            array('field' => 'valor_venta','label' => 'Valor Venta','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),
            /**
	 * ad_orden_de_compra
	 */
	'ad_orden_de_compra'
		=> array(
            array('field' => 'orden_de_compra','label' => 'Orden de Compra Cliente','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'precio','label' => 'Confirma Precio','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'forma_pago','label' => 'Forma de Pago','rules' => 'required|trim|xss_clean|validaSelect'),
            //array('field' => 'horario_despacho','label' => 'Horario Despacho','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            //array('field' => 'obs1','label' => 'Forma de Facturar Distinta al Estándard','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            //array('field' => 'obs2','label' => 'Condicones especiales para la cobranza','rules' => 'is_string|trim|xss_clean|max_length[100]'),
            ),
            /**
	 * ad_proceso
	 */
	'ad_proceso'
		=> array(
			array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'precio','label' => 'Precio','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
           array('field' => 'des','label' => 'Descripción','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),
              /**
	 * ad_molde
	 */
	'ad_molde'
		=> array(
			//array('field' => 'num','label' => 'Número','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'nombrecliente','label' => 'Nombre Cliente','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
//            array('field' => 'nombrecliente2','label' => 'Nombre Cliente 2','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
//            array('field' => 'tamano_caja','label' => 'Tamaño Caja','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
//            array('field' => 'tamano_cuchillo_1','label' => 'Distancia cuchillo a cuchillo','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
//            array('field' => 'tamano_cuchillo_2','label' => 'Distancia cuchillo a cuchillo','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
//            array('field' => 'ancho_bobina','label' => 'Ancho Bobina','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
//            array('field' => 'largo_bobina','label' => 'Largo Bobina','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'fecha_creacion','label' => 'Fecha de Creación','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
                    
            ),
       /**
	 * add_fast_track
	 */
	'add_fast_track'
		=> array(
	    array('field' => 'cliente','label' => 'Cliente que solicita','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
            array('field' => 'cantidad','label' => 'Cantidad','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'materiales','label' => 'Materiales Cliente','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'quien_solicita','label' => 'Empresa solicitante','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
            //array('field' => 'quien_autoriza','label' => 'Quién Autoriza','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'quien_externo','label' => 'Qué Cliente externo es','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
            array('field' => 'contacto','label' => 'Contacto de empresa solicitante','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'contacto_empresa_ejecutante','label' => 'Contacto de empresa ejecutante','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ), 
            /**
	 * add_maquina
	 */
	'add_maquina'
		=> array(
		    array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'des','label' => 'Descripción','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'tamano_maximo','label' => 'Tamaño Máximo','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'tamano_minimo','label' => 'Tamaño Máximo','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'colores','label' => 'Colores','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
            array('field' => 'velocidad','label' => 'Velocidad','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'tiempo_de_postura','label' => 'Tiempo de Postura','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'ancho_maximo','label' => 'Tamaño Mínimo','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'ancho_minimo','label' => 'Tamaño Mínimo','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),  
         /**
	 * add_orden_de_trabajo_nueva
	 */
	'add_orden_de_trabajo_nueva'
		=> array(
            array('field' => 'valor','label' => 'Valor Cotizado','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'cantidad_pedida','label' => 'Cantidad Pedida','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'forma_pago','label' => 'Forma de Pago','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
           
            ),    
            /**
	 * buscar
	 */
	'buscar'
		=> array(
			
            array('field' => 'cliente','label' => 'Cliente','rules' => 'required|trim|xss_clean|validaSelect'),
            ),
         /**
	 * add_datos_tecnicos
	 */
	'add_datos_tecnicos'
		=> array(
			array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),
    /**
	 * solicita_muestra
	 */
	'solicita_muestra'
		=> array(
            array('field' => 'datos_tecnicos','label' => 'Datos Técnicos','rules' => 'required|trim|xss_clean|validaSelect'),
            array('field' => 'des','label' => 'Descripción','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'medidas_de_las_cajas','label' => 'Medidas de la Caja','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'medidas_de_las_cajas_2','label' => 'Medidas de la Caja','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'medidas_de_las_cajas_3','label' => 'Medidas de la Caja','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'medidas_de_las_cajas_4','label' => 'Medidas de la Caja','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),
            /**
	 * estado_cotizacion
	 */
	'estado_cotizacion'
		=> array(
            
            array('field' => 'glosa','label' => 'Glosa','rules' => 'required|is_string|trim|xss_clean'),
            ),
   /**
	 * add_adhesivo
	 */
	'add_adhesivo'
		=> array(
			
             array('field' => 'nom','label' => 'Nombre','rules' => 'required|is_string|trim|xss_clean|max_length[100]|is_unique[acabados2.codigo]'),
             array('field' => 'codigo','label' => 'Código','rules' => 'required|is_string|trim|xss_clean|max_length[100]|is_unique[acabados2.codigo]'),
             array('field' => 'proveedor1','label' => 'Proveedor 1','rules' => 'required|trim|xss_clean|validaSelect'),
             array('field' => 'proveedor2','label' => 'Proveedor 2','rules' => 'required|trim|xss_clean|validaSelect'),
             array('field' => 'precio','label' => 'Precio','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
             array('field' => 'fecha_compra','label' => 'Fecha de Compra','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),
   /**
	 * control_cartulina
	 */
	'control_cartulina'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'dimensionar_a_ancho','label' => 'Dimensionar a: Ancho','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'dimensionar_a_largo','label' => 'Dimensionar a: Largo','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ancho_de_bobina','label' => 'Ancho de Bobina','rules' => 'required|trim|xss_clean'),
             array('field' => 'gramaje','label' => 'Gramaje','rules' => 'required|trim|xss_clean'),
             //array('field' => 'total_pliegos','label' => 'Total Pliegos','rules' => 'required|trim|xss_clean'),
             //array('field' => 'total_kilos','label' => 'Total Kilos','rules' => 'required|trim|xss_clean'),
             array('field' => 'gramaje','label' => 'Proveedor 2','rules' => 'required|trim|xss_clean'),
             array('field' => 'unidades_por_pliego','label' => 'Unidades por Pliego','rules' => 'required|trim|xss_clean'),
             array('field' => 'descripcion_de_la_tapa','label' => 'Descripción de la Tapa','rules' => 'required|trim|xss_clean'),
             array('field' => 'numero_de_bobina','label' => 'Número de Bobina','rules' => 'required|trim|xss_clean'),
             array('field' => 'total_de_bobinas','label' => 'Total de Bobinas','rules' => 'required|trim|xss_clean'),
             array('field' => 'quien_sabe_ubicacion_de_la_bobina','label' => 'Quién sabe ubicación de la Bobina','rules' => 'required|trim|xss_clean|validaSelect'),
            ),
      /**
	 * control_papel
	 */
	'control_papel'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ancho_a_usar_onda','label' => 'Ancho a usar onda','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'gramaje_onda','label' => 'Gramaje Onda','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ubicacion_onda','label' => 'Ubicación Onda','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'preguntar_a_onda','label' => 'Preguntar a (Onda)','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'numero_bobina_onda','label' => 'Número de Bobina Onda','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'para_bobinado','label' => 'Para Bobinado','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ancho_de_bobina','label' => 'Ancho de Bobina','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ancho_a_usar_liner','label' => 'Ancho a usar liner','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'gramaje_liner','label' => 'Gramaje Liner','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ubicacion_liner','label' => 'Ubicación Liner','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'preguntar_a_liner','label' => 'Preguntar a (Liner)','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'numero_bobina_liner','label' => 'Número de Bobina Liner','rules' => 'required|is_string|trim|xss_clean'),
            ),   
            
	  /**
		* control_onda
	 */
	'control_onda'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ancho_a_usar_onda','label' => 'Ancho a usar onda','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'gramaje_onda','label' => 'Gramaje Onda','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ubicacion_onda','label' => 'Ubicación Onda','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'preguntar_a_onda','label' => 'Preguntar a (Onda)','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'numero_bobina_onda','label' => 'Número de Bobina Onda','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'para_bobinado','label' => 'Para Bobinado','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ancho_de_bobina','label' => 'Ancho de Bobina','rules' => 'required|is_string|trim|xss_clean'),

            ),   
            
      /**		
		/**
		* control_liner
	 */
	'control_liner'
		=> array(
             array('field' => 'para_bobinado','label' => 'Para Bobinado','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ancho_de_bobina','label' => 'Ancho de Bobina','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ancho_a_usar_liner','label' => 'Ancho a usar liner','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'gramaje_liner','label' => 'Gramaje Liner','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'ubicacion_liner','label' => 'Ubicación Liner','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'preguntar_a_liner','label' => 'Preguntar a (Liner)','rules' => 'required|is_string|trim|xss_clean'),
             array('field' => 'numero_bobina_liner','label' => 'Número de Bobina Liner','rules' => 'required|is_string|trim|xss_clean'),
            ),   
            
      /**	
      /**
	 * confeccion_molde_troquel
	 */
	'confeccion_molde_troquel'
		=> array(
			
             array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'is_string|trim|xss_clean'),
            
            ),   
              /**
	 * produccion_bobinado
	 */
	'produccion_bobinado'
		=> array(
			
             array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'is_string|trim|xss_clean'),
            //array('field' => 'numero_de_bobina','label' => 'Número de bobina','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'ancho_de_bobina_madre','label' => 'Ancho de bobina madre','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'ancho_sobrante','label' => 'Ancho sobrante','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'kilos_sobrantes','label' => 'Kilos sobrantes','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'origen','label' => 'Origen','rules' => 'required|is_string|trim|xss_clean'),
            ), 
         /**
	 * corte_cartulina
	 */
	'corte_cartulina'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'ancho_bobina','label' => 'Ancho de bobina','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'largo_a_cortar','label' => 'Largo a cortar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_pliegos_a_cortar','label' => 'Total pliegos a cortar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_kilos','label' => 'Total kilos','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'numero_de_tarimas','label' => 'Número de tarimas','rules' => 'required|is_string|trim|xss_clean'),
            ), 
    /**
	 * produccion_corrugado
	 */
	'produccion_corrugado'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'onda_a_usar','label' => 'Onda a usar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'ancho_de_onda_a_usar','label' => 'Ancho onda a usar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'liner_a_usar','label' => 'Liner a usar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'ancho_de_liner_a_usar','label' => 'Ancho Liner a usar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'tamano_a_fabricar','label' => 'Tamaño a fabricar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'tamano_1','label' => 'Tamaño (Ancho)','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'tamano_2','label' => 'Tamaño (Largo)','rules' => 'required|is_string|trim|xss_clean'),
           // array('field' => 'tamano_cuchillo_1','label' => 'Tamaño Cuchillo 1','rules' => 'required|is_string|trim|xss_clean'),
           // array('field' => 'tamano_cuchillo_2','label' => 'Tamaño Cuchillo 2','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'pinza','label' => 'Pinza','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'reverso_a_usar','label' => 'Reverso a usar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_pliegos_a_fabricar','label' => 'Total pliegos a fabricar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_pliegos_producidos','label' => 'Total pliegos fabricados','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_tarimas_producidas','label' => 'Total tarimas fabricadas','rules' => 'required|is_string|trim|xss_clean'),
            ),
   /**
	 * impresion_produccion
	 */
	'impresion_produccion'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_pliegos_buenos','label' => 'Total pliegos buenos','rules' => 'required|is_string|trim|xss_clean'),
//            array('field' => 'impresion_para_trabajo','label' => 'Impresión para trabajo','rules' => 'required|is_string|trim|xss_clean'),
//            array('field' => 'impresion_para_trabajo','label' => 'Impresión para trabajo','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'largo_de_pinza','label' => 'Largo de Pinza','rules' => 'required|is_string|trim|xss_clean'),
   //  array('field' => 'largo_de_pinza_gato','label' => 'Largo de Pinza del Gato','rules' => 'required|is_string|trim|xss_clean'),                    
            array('field' => 'largo_de_pinza_gato_derecho','label' => 'Largo de Pinza Gato Derecho','rules' => 'required|is_string|trim|xss_clean'),                    
            array('field' => 'largo_de_pinza_gato_izquierdo','label' => 'Largo de Pinza Gato Izquierdo','rules' => 'required|is_string|trim|xss_clean'),                    
            array('field' => 'largo_de_pinza_por_cola','label' => 'Largo de Pinza por Cola','rules' => 'required|is_string|trim|xss_clean'),                    
            ),
             /**
	 * servicios_post_imprenta
	 */
	'servicios_post_imprenta'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'descripcion_trabajo_externo','label' => 'Descripción trabajo externo','rules' => 'required|is_string|trim|xss_clean'),
           // array('field' => 'direccion_proveedor','label' => 'Dirección proveedor','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'horario_proveedor','label' => 'Horario proveedor','rules' => 'required|is_string|trim|xss_clean'),
           // array('field' => 'despachador','label' => 'Despachador','rules' => 'required|is_string|trim|xss_clean'),
           // array('field' => 'camion_de_despacho','label' => 'Camión de despacho','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'chofer','label' => 'Chofer','rules' => 'required|is_string|trim|xss_clean'),
            ),
     /**
	 * produccion_emplacado
	 */
	'produccion_emplacado'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_pliegos_buenos','label' => 'Descripción trabajo externo','rules' => 'required|is_string|trim|xss_clean'),
            ),
   /**
	 * produccion_troquelado
	 */
	'produccion_troquelado'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'numero_molde_troquel','label' => 'Número molde troquel','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_pliegos_a_troquelar','label' => 'Total pliegos a troquelar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_pliegos_buenos','label' => 'Total pliegos buenos','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'merma','label' => 'Merma','rules' => 'required|is_string|trim|xss_clean'),
            ),
     /**
	 * produccion_talleres_externos
	 */
	'produccion_talleres_externos'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'descripcion_trabajo_externo','label' => 'Descripción trabajo externo','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'direccion_proveedor','label' => 'Dirección proveedor','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'horario_proveedor','label' => 'Horario proveedor','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'despachador','label' => 'Despachador','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'camion_de_despacho','label' => 'Camión de despacho','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'chofer','label' => 'Chofer','rules' => 'required|is_string|trim|xss_clean'),
            ),
    /**
	 * imprenta_programacion
	 */
	'imprenta_programacion'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'procesos_adicionales','label' => 'Procesos adicionales','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'proveedor','label' => 'Proveedor','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
            ),
   /**
	 * produccion_desgajado
	 */
	'produccion_desgajado'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'numero_de_pliegos','label' => 'Número de pliegos','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'unidades_de_caja_por_pliego','label' => 'Unidades de caja por pliego','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_piezas_por_pliego','label' => 'Total piezas por pliego','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_cajas_a_entregar','label' => 'Total cajas a entregar','rules' => 'required|is_string|trim|xss_clean'),
          //  array('field' => 'merma','label' => 'Merma','rules' => 'required|is_string|trim|xss_clean'),
            ),
   /**
	 * produccion_pegado
	 */
	'produccion_pegado'
		=> array(
			
             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_cajas_recibidas','label' => 'Total cajas recibidas','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'para_pegado','label' => 'Para pegado','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'empaquetado','label' => 'Empaquetado','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'cantidad_cajas_buenas','label' => 'Cantidad cajas buenas','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'codigo_del_producto','label' => 'Código del producto','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'cantidad_a_empaquetar','label' => 'Cantidad a empaquetar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_palet','label' => 'Total palet','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'cantidad_por_palet','label' => 'Cantidad por palet','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'medidas_del_palet','label' => 'Medidas del palet','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'entrega_parcial_o_total','label' => 'Entrega parcial o total','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'cantidad_pendiente','label' => 'Cantidad pendiente','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'numero_orden_de_compra','label' => 'Número de orden de compra','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'numero_orden_de_compra','label' => 'Número de orden de compra','rules' => 'required|is_string|trim|xss_clean'),
            ),
   /**
	 * produccion_bodega
	 */
	'produccion_bodega'
		=> array(
			
            array('field' => 'fecha_de_entrega','label' => 'Fecha de entrega','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'ingreso_a_bodega','label' => 'Ingreso a Bodega','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'cantidad_de_cajas','label' => 'Cantidad de cajas','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'precio_venta','label' => 'Precio de venta','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'unidades_por_paquete_oficial','label' => 'Unidades por paquete oficial','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'unidades_paquete_efectivo','label' => 'Unidades por paquete efectivas que trae este ingreso','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_de_ingresos','label' => 'Total de ingresos','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'total_cajas_ingresadas','label' => 'Total de cajas ya ingresadas','rules' => 'required|is_string|trim|xss_clean'),
            //array('field' => 'listado_ingresos_cantidades','label' => 'Listado de los ingresos con sus cantidades','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'cantidades_a_ingresar','label' => 'Cantidad a ingresar','rules' => 'required|is_string|trim|xss_clean'),
            array('field' => 'total_cajas_pendientes','label' => 'Total de cajas pendientes','rules' => 'required|is_string|trim|xss_clean'),
            ),
    
	'ad_proceso_especiales'
            => array(
            array('field' => 'id_proveedores','label' => 'Proveedores','rules' => 'required|is_string|trim|xss_clean|validaSelect'),
            array('field' => 'nombre_procesp','label' => 'Nombre Proceso','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'ancho','label' => 'Ancho','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'largo','label' => 'Largo','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'tipo','label' => 'Tipo','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            array('field' => 'precio','label' => 'Precio','rules' => 'required|is_string|trim|xss_clean|max_length[100]'),
            ),    
);

