<?php

class cotizaciones_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
    public function getCotizacionesPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                //->select("id,ot_migrada,ot_antigua,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                ->select("*")
                ->from("cotizaciones")
                ->where("id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0)")
                ->order_by("id","desc")
               // ->limit($porpagina,$pagina)
                //->limit($porpagina,$pagina)
                ->get();
               // echo $this->db->last_query();exit;
                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("cotizaciones")
                ->where("id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0)")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getCotizacionesPaginacion2($pagina,$porpagina,$quehago)
    {
//         switch($quehago)
//        {
//            case 'limit':
//                $query=$this->db
//                //->select("id,ot_migrada,ot_antigua,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
//                ->select("*")
//                ->from("cotizaciones")
//                ->where("id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0)")
//                ->order_by("id","desc")
//                ->limit($porpagina,$pagina)
//               // ->limit(10,$pagina)
//                ->get();
//               // echo $this->db->last_query();exit;
//                
//               if ($query->num_rows > 0)
//                    return $query->result();
//                else
//                    return FALSE;
//                break;
//            case 'cuantos':
//              $query=$this->db
//                ->select("id")
//                ->from("cotizaciones")
//                ->where("id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0)")
//                ->count_all_results();
//                return $query;
//            break;
//        }
           switch($quehago)
        {
            case 'limit':
                $query=$this->db
                //->select("id,ot_migrada,ot_antigua,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                ->select("*")
                ->from("cotizaciones")
                ->where("id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0)")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                //->limit($porpagina,$pagina)
                ->get();
               // echo $this->db->last_query();exit;
                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("cotizaciones")
                ->where("id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0)")
                ->count_all_results();
                return $query;
            break;
        }
    }
    
    function get_alumnos($porpagina,$segmento)
  {
//    $query=$this->db
//                ->select("*")
//                ->from("cotizaciones")
//                ->where("id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0)")
//                ->order_by("id","desc")
//                ->limit($porpagina,$segmento)
//                ->get();
//               echo $this->db->last_query();exit; 
//               if ($query->num_rows > 0)
//                    return $query->result();
//                else
//                    return FALSE;
        $query = $this->db->get('cotizaciones',$porpagina,$segmento);
        
    if( $query->num_rows > 0 )
      return $query->result();
    else
      return FALSE;
  }
 
  function get_total_alumnos(){
    $query=$this->db
                ->select("id")
                ->from("cotizaciones")
                ->where("id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0)")
                ->count_all_results();
                return $query;
  }
    
    
    public function getCotizaconSearchPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("cl.razon_social,co.id as id,co.*")
                ->from("cotizaciones as co")
                ->join("clientes cl","co.id_cliente=cl.id","inner")
                //->where("co.id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0 AND estado <> 3 AND estado <> 4 AND estado <> 1)")
                ->where("co.id NOT IN(select id_cotizacion from orden_de_produccion where estado <> 0)")
                ->like('upper(co.producto)',strtoupper($buscar),'both')                    
                ->or_like('upper(co.ot_migrada)',strtoupper($buscar),'both')
                ->or_like('upper(co.id_antiguo)',strtoupper($buscar),'both')                    
                ->or_like('upper(co.id)',strtoupper($buscar),'both')                    
                ->or_like('upper(cl.razon_social)',strtoupper($buscar),'both')                    
                ->order_by("co.id","desc")
              //  ->limit($porpagina,$pagina)
                ->get();
              //  echo $this->db->last_query();
                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("co.id")
                ->from("cotizaciones as co")
                ->join("clientes cl","co.id_cliente=cl.id","inner")
                ->like('upper(co.producto)', strtoupper($buscar), 'both') 
                ->or_like('upper(co.ot_migrada)', strtoupper($buscar), 'both')
                ->or_like('upper(co.id_antiguo)',strtoupper($buscar),'both')                    
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getCotizaconSearchUnaPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("cl.razon_social,co.id as id,co.*")
                ->from("cotizaciones as co")
                ->join("clientes cl","co.id_cliente=cl.id","inner")
                //->where("co.id not in (select id_cotizacion from orden_de_produccion where estado <> 2 AND estado <> 0 AND estado <> 3 AND estado <> 4 AND estado <> 1)")
                ->where("co.id NOT IN(select id_cotizacion from orden_de_produccion where estado <> 0)")               
                ->like('upper(co.id)',strtoupper($buscar),'both')                    
                ->get();
               // echo $this->db->last_query();
                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("co.id")
                ->from("cotizaciones as co")
                ->join("clientes cl","co.id_cliente=cl.id","inner")  
                ->where("co.id NOT IN(select id_cotizacion from orden_de_produccion where estado <> 0)")               
                ->like('upper(co.id)',strtoupper($buscar),'both')      
                ->count_all_results();
                return $query;
            break;
        }
    }

    
//    public function getCotizaconSearchPaginacion($pagina,$porpagina,$quehago,$buscar)
//    {
//        switch($quehago)
//        {
//            case 'limit':
//                $query=$this->db
//                ->select("*")
//                ->from("cotizaciones as co")
//                ->join("clientes cl","co.id_cliente=cl.id","inner")
//                ->like('upper(co.producto)', strtoupper($buscar), 'both')
//                ->or_like('upper(cl.razon_social)', strtoupper($buscar), 'both')
//                ->or_like('upper(co.ot_migrada)', strtoupper($buscar), 'both')
//                ->or_like('co.id_antiguo', strtoupper($buscar), 'both')
//                ->or_like('co.id', strtoupper($buscar), 'both')                    
//                ->order_by("co.id","desc")
//                ->limit($porpagina,$pagina)
//                ->get();
////                echo $this->db->last_query();
//                
//                return $query->result();
//            break;
//            case 'cuantos':
//              $query=$this->db
//                ->select("*")
//                ->from("cotizaciones as co")
//                ->join("clientes cl","co.id_cliente=co.id","inner")
//                ->like('upper(co.producto)', strtoupper($buscar), 'both')
//                ->or_like('upper(cl.razon_social)', strtoupper($buscar), 'both')
//                ->or_like('upper(co.ot_migrada)', strtoupper($buscar), 'both')
//                ->or_like('co.id_antiguo', strtoupper($buscar), 'both')
//                ->or_like('co.id', strtoupper($buscar), 'both')     
//                ->count_all_results();
//                return $query;
//            break;
//        }
//    }    
	
	public function getCotizacionesPorVendedorPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("cot.id,cot.id_usuario,cot.id_cliente,cot.nombre_cliente,cot.id_vendedor,cot.condicion_del_producto,cot.producto,cantidad_1,cot.cantidad_2,cot.cantidad_3,cot.cantidad_4,cot.acepta_excedentes,cot.precio_1,cot.precio_2,cot.precio_3,cot.precio_4,cot.comentario_medidas,cot.piezas_adicionales,cot.comentario_piezas_adicionales,cot.comentario_piezas_adicionales,cot.materialidad_datos_tecnicos,cot.materialidad_eleccion,cot.materialidad_1,cot.materialidad_2,cot.materialidad_solicita_muestra,cot.impresion_colores,cot.impresion_metalicos,cot.impresion_acabado_impresion_1,cot.impresion_acabado_impresion_2,cot.impresion_acabado_impresion_3,cot.impresion_acabado_impresion_4,cot.impresion_hacer_cromalin,cot.procesos_especiales_folia,cot.procesos_especiales_folia_valor,cot.procesos_especiales_cuno,cot.procesos_especiales_cuno_valor,cot.producto_se_entrega_armado,cot.tiene_desgajado,cot.montaje_pieza_especial,cot.pegado_instrucciones,cot.cantidad_especifica,envasado,cot.despacho_fuera_de_santiago,cot.retira_cliente,tota_o_parcial,cot.can_despacho_1,cot.can_despacho_2,cot.can_despacho_3,cot.forma_pago,cot.comision_agencia,cot.costo_comercial,cot.cliente_entrega_1,cot.fecha,cot.estado,cot.fecha_de_liberacion_de_producto_ingenieria,cot.fecha_de_liberacion_de_producto_fotomecanica")
                ->from("cotizaciones as cot")
				->join("clientes as cli","cli.id = cot.id_cliente")
                ->where(array("cli.id_vendedor"=>$this->session->userdata('id')))
                ->order_by("id","desc")
               // ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("cot.id,cot.id_usuario,cot.id_cliente,cot.nombre_cliente,cot.id_vendedor,cot.condicion_del_producto,cot.producto,cantidad_1,cot.cantidad_2,cot.cantidad_3,cot.cantidad_4,cot.acepta_excedentes,cot.precio_1,cot.precio_2,cot.precio_3,cot.precio_4,cot.comentario_medidas,cot.piezas_adicionales,cot.comentario_piezas_adicionales,cot.comentario_piezas_adicionales,cot.materialidad_datos_tecnicos,cot.materialidad_eleccion,cot.materialidad_1,cot.materialidad_2,cot.materialidad_solicita_muestra,cot.impresion_colores,cot.impresion_metalicos,cot.impresion_acabado_impresion_1,cot.impresion_acabado_impresion_2,cot.impresion_acabado_impresion_3,cot.impresion_acabado_impresion_4,cot.impresion_hacer_cromalin,cot.procesos_especiales_folia,cot.procesos_especiales_folia_valor,cot.procesos_especiales_cuno,cot.procesos_especiales_cuno_valor,cot.producto_se_entrega_armado,cot.tiene_desgajado,cot.montaje_pieza_especial,cot.pegado_instrucciones,cot.cantidad_especifica,envasado,cot.despacho_fuera_de_santiago,cot.retira_cliente,tota_o_parcial,cot.can_despacho_1,cot.can_despacho_2,cot.can_despacho_3,cot.forma_pago,cot.comision_agencia,cot.costo_comercial,cot.cliente_entrega_1,cot.fecha,cot.estado,cot.fecha_de_liberacion_de_producto_ingenieria,cot.fecha_de_liberacion_de_producto_fotomecanica")
                ->from("cotizaciones as cot")
				->join("clientes as cli","cli.id = cot.id_cliente")
                ->where(array("cli.id_vendedor"=>$this->session->userdata('id')))
                ->count_all_results();
                return $query;
            break;
        }
    }
	
    public function getCotizacionPorIdAntiguo($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizaciones")
                ->where(array("id_antiguo"=>$id))
                ->get();
//               echo $this->db->last_query();exit;
                return $query->row();
    }	
    public function getHojaDeCostosAltPorId($id)
    {
       $query=$this->db
                ->select("*")
                ->from("hoja_de_costos_alt")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                return $query->row();
    }	
    
    public function getCotizacionEnRojo($id)
    {
       $query=$this->db
                ->select("*")
                ->from("orden_de_produccion")
                ->where(array("id_cotizacion"=>$id))
                ->get();
//               echo $this->db->last_query();exit;
                return $query->row();
    }	
	
     public function getCotizacionesProduccionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                ->from("cotizaciones")
                ->where(array("estado"=>"0"))
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("cotizaciones")
                ->where(array("estado"=>"0"))
                ->count_all_results();
                return $query;
            break;
        }
    }
     public function getCotizacionesRepeticionPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         
      if($buscar!='Cotizaciones Rechazadas'){
        
        if ($buscar!='')
        {
            switch($quehago)
            {
                case 'limit':
                    $query=$this->db
                    ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                    ->from("cotizaciones")
                    ->where(array("condicion_del_producto"=>$buscar))
                    ->order_by("id","desc")
                    ->limit($porpagina,$pagina)
                    ->get();
                    return $query->result();
                break;
                case 'cuantos':
                  $query=$this->db
                    ->select("id")
                    ->from("cotizaciones")
                    ->where(array("condicion_del_producto"=>$buscar))
                    ->count_all_results();
                    return $query;
                break;
            }
        }
        else
        {
            switch($quehago)
            {
                case 'limit':
                    $query=$this->db
                    ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                    ->from("cotizaciones")
                    ->order_by("id","desc")
                    ->limit($porpagina,$pagina)
                    ->get();
                    return $query->result();
                break;
                case 'cuantos':
                  $query=$this->db
                    ->select("id")
                    ->from("cotizaciones")
                    ->count_all_results();
                    return $query;
                break;
            }
      }}else{
          if ($buscar!='' && $buscar=='Cotizaciones Rechazadas')
        {
              
            switch($quehago)
            {
                case 'limit':
                    $query=$this->db
                    ->select("c.id_cotizacion as id,a.id_usuario,a.id_cliente,a.nombre_cliente,a.id_vendedor,a.condicion_del_producto,a.producto,cantidad_1,a.cantidad_2,a.cantidad_3,a.cantidad_4,a.acepta_excedentes,a.precio_1,a.precio_2,a.precio_3,a.precio_4,a.comentario_medidas,a.piezas_adicionales,a.comentario_piezas_adicionales,a.comentario_piezas_adicionales,a.materialidad_datos_tecnicos,a.materialidad_eleccion,a.materialidad_1,a.materialidad_2,a.materialidad_solicita_muestra,a.impresion_colores,a.impresion_metalicos,a.impresion_acabado_impresion_1,a.impresion_acabado_impresion_2,a.impresion_acabado_impresion_3,a.impresion_acabado_impresion_4,a.impresion_hacer_cromalin,a.procesos_especiales_folia,a.procesos_especiales_folia_valor,a.procesos_especiales_cuno,a.procesos_especiales_cuno_valor,a.producto_se_entrega_armado,a.tiene_desgajado,a.montaje_pieza_especial,a.pegado_instrucciones,a.cantidad_especifica,a.envasado,a.despacho_fuera_de_santiago,a.retira_cliente,a.tota_o_parcial,a.can_despacho_1,a.can_despacho_2,a.can_despacho_3,a.forma_pago,a.comision_agencia,a.costo_comercial,a.cliente_entrega_1,a.fecha,c.estado,a.fecha_de_liberacion_de_producto_ingenieria,a.fecha_de_liberacion_de_producto_fotomecanica")
                    //->select("id_cotizacion as id,cotizaciones.id as idc,c.*")
                    ->from("cotizaciones a")
                   // ->from("cotizaciones")
                    ->join("cotizacion_ingenieria c","c.id_cotizacion=a.id","right")
                    ->where(array("c.estado"=>2))
                    ->order_by("c.id_cotizacion","desc")
                    ->limit($porpagina,$pagina)
                    ->get();
                      //echo $this->db->last_query();exit;
                    return $query->result();
                break;
                case 'cuantos':
                  $query=$this->db
                    ->select("c.id_cotizacion as id")
                    ->from("cotizaciones as a")
                    ->join("cotizacion_ingenieria c","c.id_cotizacion=a.id","right")
                    ->where(array("c.estado"=>2))
                    ->count_all_results();
                    return $query;
                break;
            }
        }
        else
        {
            switch($quehago)
            {
                case 'limit':
                    $query=$this->db
                    ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                    ->from("cotizaciones")
                    ->order_by("id","desc")
                    ->limit($porpagina,$pagina)
                    ->get();
                    return $query->result();
                break;
                case 'cuantos':
                  $query=$this->db
                    ->select("id")
                    ->from("cotizaciones")
                    ->count_all_results();
                    return $query;
                break;
            }
      }
      }            
            
    }
     public function getCotizacionesPorClientePaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,numero_molde,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica,trazado")
                ->from("cotizaciones")
                ->where(array("id_cliente"=>$buscar))
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("cotizaciones")
                ->where(array("id_cliente"=>$buscar))
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getCotizacionesPorClienteUltima($id)
    {
        $query=$this->db
                ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                ->from("cotizaciones")
                ->where(array("id_cliente"=>$id))
                ->order_by("id","desc")
                ->limit(1)
                ->get();
               // echo $this->db->last_query();exit;
                return $query->row();
    }
     public function getCotizacionesPorCliente2($id)
    {
        $query=$this->db
                ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                ->from("cotizaciones")
                ->where(array("id_cliente"=>$id))
                ->order_by("id","desc")
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();
    }
    public function getCotizacionesSearchPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                ->from("cotizaciones")
                ->like('nombre_cliente', $buscar, 'both')
                ->or_like('producto', $buscar, 'both')
                ->or_like('id', $buscar, 'both')
                ->or_like('id_antiguo', $buscar, 'both')
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("cotizaciones")
                ->like('nombre_cliente', $buscar, 'both')
                ->or_like('producto', $buscar, 'both')
                ->or_like('id', $buscar, 'both')
                ->or_like('id_antiguo', $buscar, 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getCotizacionesBuscarPaginacion($pagina,$porpagina,$quehago,$cliente,$condicion,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                ->from("cotizaciones")
                ->like('id_cliente', $cliente, 'both')
                ->or_like('condicion_del_producto', $condicion, 'both')
                ->or_like('producto', $buscar, 'both')
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("cotizaciones")
                ->like('id_cliente', $cliente, 'both')
                ->or_like('condicion_del_producto', $condicion, 'both')
                ->or_like('producto', $buscar, 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getCotizacionesBuscarPorNumeroOidAntiguoPaginacion($pagina,$porpagina,$quehago,$cliente,$condicion,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
                ->from("cotizaciones")
                ->like('id', $buscar, 'both')
                ->or_like('id_antiguo', $buscar, 'both')
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("cotizaciones")
                ->like('id', $buscar, 'both')
                ->or_like('id_antiguo', $buscar, 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }
     public function getMaterialesPaginacionPorTipo($pagina,$porpagina,$quehago,$tipo)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.procedencia,m.gramaje,m.ancho,m.peso_kilos,m.valor_en_dolares,p.nombre as proveedor,mt.materiales_tipo")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.tipo"=>$tipo))
                ->order_by("m.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("m.id")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.tipo"=>$tipo))
                ->count_all_results();
                return $query;
            break;
        }
    }
    
     public function obtenerMaximoId()
     {
       $query=$this->db
                ->select("MAX(id) as id_max")
                ->from("cotizaciones")
                ->get();
                return $query->row();          
     }
     
     public function obtenerMaximoIdCopias($id)
     {
       $query=$this->db
                ->select("id_cotizacion,codigo_duplicado")
                ->from("hoja_de_costos_datos")
                ->like("codigo_duplicado",$id,"both")
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();          
     }
    
    public function getCotizacionPorId($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizaciones")
                ->where(array("id"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
    public function getCotizacion2PorId($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizaciones_cambios")
                ->where(array("id"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
    public function getCotizacionPorClienteDiezRegistros($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizaciones")
                ->where(array("id_cliente"=>$id))
                ->limit(10)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
     public function getCotizacionPorCliente($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizaciones")
                ->where(array("id_cliente"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
     public function getCotizacionPorBusquedaGeneral($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizaciones")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }    
    public function getAcabadosInternosCotizacionPorId($id)
    {
         
		// SELECT nombre_acabado
// FROM acabados a
// INNER JOIN  `acabados-cotizaciones` ac ON a.id_acabado = ac.acabados_id_acabado
// WHERE
        $sql = "select nombre_acabado from acabados a inner join `acabados-cotizaciones` ac "
                ."on a.id_acabado = ac.acabados_id_acabado where a.categoria_acabado = 'Interno' "
                ."and ac.cotizaciones_id =".$id;
        
		//var_dump($sql);
		
        $query=$this->db->query($sql);
  
        return $query;
//       $query=$this->db
//             ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
//                ->from("cotizaciones")
//                ->where(array("id"=>$id))
//                ->get();
//                //echo $this->db->last_query();exit;
//                return $query->row();   
    }
    
    public function getAcabadosExternosCotizacionPorId($id)
    {
	
	$sql = "select nombre_acabado from acabados a inner join `acabados-cotizaciones` ac "
                ."on a.id_acabado = ac.acabados_id_acabado where a.categoria_acabado = 'Externo' "
                ."and ac.cotizaciones_id =".$id;
				
       // $sql = "select nombre_acabado from acabados as a,grau.`acabados-cotizaciones` as ac "
       //         ."where a.id_acabado = ac.acabados_id_acabado and a.categoria_acabado = 'Externo' "
       //         ."and ac.cotizaciones_id =".$id;
        
        $query=$this->db->query($sql);
  
        return $query;

//       $query=$this->db
//                ->select("id,id_usuario,id_cliente,nombre_cliente,id_vendedor,condicion_del_producto,producto,cantidad_1,cantidad_2,cantidad_3,cantidad_4,acepta_excedentes,precio_1,precio_2,precio_3,precio_4,comentario_medidas,piezas_adicionales,comentario_piezas_adicionales,comentario_piezas_adicionales,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,materialidad_solicita_muestra,impresion_colores,impresion_metalicos,impresion_acabado_impresion_1,impresion_acabado_impresion_2,impresion_acabado_impresion_3,impresion_acabado_impresion_4,impresion_hacer_cromalin,procesos_especiales_folia,procesos_especiales_folia_valor,procesos_especiales_cuno,procesos_especiales_cuno_valor,producto_se_entrega_armado,tiene_desgajado,montaje_pieza_especial,pegado_instrucciones,cantidad_especifica,envasado,despacho_fuera_de_santiago,retira_cliente,tota_o_parcial,can_despacho_1,can_despacho_2,can_despacho_3,forma_pago,comision_agencia,costo_comercial,cliente_entrega_1,fecha,estado,fecha_de_liberacion_de_producto_ingenieria,fecha_de_liberacion_de_producto_fotomecanica")
//                ->from("cotizaciones")
//                ->where(array("id"=>$id))
//                ->get();
//                //echo $this->db->last_query();exit;
//                return $query->row();
    }
    public function getHojaDeCostosPorIdCotizacion($id)
    {
       $query=$this->db
                ->select("*")
                ->from("hoja_de_costos_datos")
                ->where(array("id_cotizacion"=>$id))
		->order_by("id","desc")
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
    public function getHojaDeCostosPorIdCotizacionMatriz($id)
    {
       $query=$this->db
                ->select("c.producto,c.cantidad_1,c.cantidad_2,c.cantidad_3,c.cantidad_4,c.fecha,h.*")
                ->from("hoja_de_costos_datos h")
                ->join("cotizaciones c","c.id=h.id_cotizacion","inner")
                ->where(array("h.id_cotizacion"=>$id))
		->order_by("h.id","desc")
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
    public function getHojaDeCostos2PorIdCotizacion($id)
    {
       $query=$this->db
                ->select("*")
                ->from("hoja_de_costos_cambios")
                ->where(array("id_cotizacion"=>$id))
		->order_by("id","desc")
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
    public function getCotizacionIngenieriaPorIdCotizacion($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizacion_ingenieria")
                ->where(array("id_cotizacion"=>$id))
				->order_by("id","desc")
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
    public function getCotizacionIngenieria2PorIdCotizacion($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizacion_ingenieria_cambios")
                ->where(array("id_cotizacion"=>$id))
				->order_by("id","desc")
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
     public function getCotizacionFotomecanicaPorIdCotizacion($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizacion_fotomecanica")
                ->where(array("id_cotizacion"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
     public function getCotizacionFotomecanica2PorIdCotizacion($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizacion_fotomecanica_cambios")
                ->where(array("id_cotizacion"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
     public function getCotizacionImpresionPresupuestoPorIdCotizacion($id)
    {
       $query=$this->db
                ->select("id,id_usuario,id_cotizacion,precio_final,dias_entrega")
                ->from("cotizacion_impresion_presupuesto")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    public function updateImpresionPresupuesto($data=array(),$id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->update("cotizacion_impresion_presupuesto",$data);
        return true;
    }
    public function insertarImpresionPresupuesto($data=array())
    {
         $this->db->insert("cotizacion_impresion_presupuesto",$data);
        return true;
        
    }
    public function getCotizacionesPorCliente($id)
    {
        $query=$this->db
                ->select("id,id_usuario,id_cliente,id_vendedor,fecha,cantidad_1,cantidad_2,cantidad_3,cantidad_4,precio_1,precio_2,precio_3,precio_4,producto")
                ->from("cotizaciones")
                ->where(array("id_cliente"=>$id))
                ->limit(4)
                ->order_by("id","desc")
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
    
     public function insertar($data=array())
    {
        $query =  $this->db->insert("cotizaciones",$data);
        if($query)
            return $this->db->insert_id();
        else
        return false;
        
    }
    
    public function getOrdenesProveedoresPorNombre($nombre,$id)
    {
        $query=$this->db
                ->select("")
                ->from("ordenes_proveedores")
                ->where(array("nombre"=>$nombre,"id_cotizacion"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    
     public function getOrdenesProveedores($id)
    {
        $query=$this->db
                ->select("*")
                ->from("ordenes_proveedores")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
     
    public function insertar_ordenes_proveedores($data=array())
    {
        $query =  $this->db->insert("ordenes_proveedores",$data);
        if($query)
            return $this->db->insert_id();
        else
        return false;
        
    }
    
    public function delete_ordenes_proveedores($id)
    {
        $this->db->where('id_cotizacion', $id);
         $this->db->delete("ordenes_proveedores");
         return true;
    }
     
    public function insertar_bl($data=array())
    {
        $query =  $this->db->insert("cot_bl",$data);
        if($query)
            return $this->db->insert_id();
        else
        return false;
    }
    public function insertar_ing_bl($data=array())
    {
        $query =  $this->db->insert("cot_ing_bl",$data);
        if($query)
            return $this->db->insert_id();
        else
        return false;
    }
    public function insertar_fot_bl($data=array())
    {
        $query =  $this->db->insert("cot_fot_bl",$data);
        if($query)
            return $this->db->insert_id();
        else
        return false;
    }
    public function insertar_oc_bl($data=array())
    {
        $query =  $this->db->insert("cot_oc_bl",$data);
        if($query)
            return $this->db->insert_id();
        else
        return false;
    }
    public function insertar_op_bl($data=array())
    {
        $query =  $this->db->insert("cot_op_bl",$data);
        if($query)
            return $this->db->insert_id();
        else
        return false;
    }
    public function insertar_hc_bl($data=array())
    {
        $query =  $this->db->insert("cot_hc_bl",$data);
        if($query)
            return $this->db->insert_id();
        else
        return false;
    }
 
       public function insertarEstadoCotizacion($data=array())
    {
       $query = $this->db->insert("estado_cotizacion",$data); 
       return true;
    }
    
    public function insertarCotizacionesAcabados($data=array())
    {
       $query = $this->db->insert("acabados-cotizaciones",$data); 
       return true;
    }
    
     public function insertarIngenieria($data=array())
    {
         $this->db->insert("cotizacion_ingenieria",$data);
        //echo $this->db->last_query();
//         exit;
        return true;
        
    }
    
    
     public function insertarArchivoCliente_RevisionIngenieria($data=array())
    {
         $this->db->insert("cotizacion_archivo_cliente",$data);
        return true;
        
    }   
    
     public function insertarArchivosGrupos($data=array())
    {
         $this->db->insert("archivo_cotizacion_grupal",$data);
        return true;
    }    
    
	//21/01/2017
	public function insertarCotizacionesGrupales($data=array())
    {
         $this->db->insert("cotizaciones_grupales",$data);
        return true;
        
    }
	
    public function getCotizacionesGrupalesPorId($id)
    {
         $query=$this->db
                ->select("id")
                ->from("cotizaciones_grupales")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    public function getArchivoCotizacionGrupalPorId($id)
    {
         $query=$this->db
                ->select("*")
                ->from("archivo_cotizacion_grupal")
                ->where(array("id_grupo"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
     public function UpdateArchivoCotizacionGrupalPorId($data,$id)
    {
         $this->db->where('id_grupo', $id);
         $this->db->update("archivo_cotizacion_grupal",$data);
         //echo $this->db->last_query();exit;
        return true;
    }
    
    public function getArchivosCotizacionesGrupalesPorId($id)
    {
         $query=$this->db
                ->select("*")
                ->from("archivo_cotizacion_grupal")
                ->where(array("id_grupo"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
	
	public function getCotizacionesGrupalesPorIdCotizacionPrimera($id)
    {
         $query=$this->db
                ->select("*")
                ->from("cotizaciones_grupales")
                ->where(array("cotizacion_1"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
	
	//------------------------------
      public function insertarFotomecanica($data=array())
    {
         $this->db->insert("cotizacion_fotomecanica",$data);
        return true;
        
    }
	
	  public function insertarHojaDeCosto($data=array())
    {
         $this->db->insert("hoja_de_costos_datos",$data);
        return true;
        
    }
	
     public function getCotizacionCotizacionPrespuestoPorIdCotizacion($id)
    {
       $query=$this->db
                ->select("id,id_usuario,id_cotizacion,costo_pegado,margen,costos_adicionales,valor_costos_adicionales,costos_adicionales2,valor_costos_adicionales2,comentarios,se_considera_repeticion_sin_costo,fecha,identificacion_de_trabajo")
                ->from("cotizaciones_presupuesto")
                ->where(array("id_cotizacion"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
    public function getCambiosHojaDeCostos($id)
    {
       $query=$this->db
                ->select("h.id,h.id_cotizacion,h.seccion,h.glosa,h.quien,h.cuando,u.nombre")
                ->from("hoja_de_costos as h")
                ->where(array("h.id_cotizacion"=>$id))
                ->join("usuarios as u","u.id=h.quien","inner")
                ->order_by("h.id","desc")
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
     public function insertarCotizacionPrespuesto($data=array())
    {
         $this->db->insert("cotizaciones_presupuesto",$data);
        return true;
        
    }
    public function updateCotizacionPrespuesto($data=array(),$id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->update("cotizaciones_presupuesto",$data);
        return true;
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("cotizaciones",$data);
        return true;
    }
    public function update_ingenieria($data=array(),$id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->update("cotizacion_ingenieria",$data);
        return true;
    }    
    public function update_fotomecanica($data=array(),$id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->update("cotizacion_fotomecanica",$data);
        return true;
    }    
    public function delete($id)
    {
         $data = array("estado"=>1);
         $this->db->where('id', $id);
         $this->db->update("cotizaciones",$data);
        return true;
    }
    public function delete_bl($id)
    {
         $this->db->where('id', $id);
         $this->db->delete("cotizaciones");
         
         return true;
    }
    public function delete_fot_bl($id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->delete("cotizacion_fotomecanica");
         return true;
    }
    public function delete_ing_bl($id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->delete("cotizacion_ingenieria");
         return true;
    }
    public function delete_oc_bl($id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->delete("cotizaciones_orden_de_compra");
         return true;
    }
    public function delete_hc_bl($id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->delete("hoja_de_costos_datos");
         return true;
    }
    public function delete_op_bl($id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->delete("orden_de_produccion");
         return true;
    }
     public function getMaterialesTipo()
    {
         $query=$this->db
                ->select("id,materiales_tipo")
                ->from("materiales_tipo")
                ->get();
                return $query->result();
    }
     public function getMaterialesTipoPorId($id)
    {
         $query=$this->db
                ->select("id,materiales_tipo")
                ->from("materiales_tipo")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    /**
     * piezas adicionales
     * */
     public function getPiezasAdicionales()
    {
         $query=$this->db
                ->select("p.id,p.piezas_adicionales,u.unidades_de_venta,p.valor_venta")
                ->from("piezas_adicionales as p")
                ->join("unidades_de_venta as u","u.id=p.unidad_de_venta","inner")
                ->get();
         //echo $this->db->last_query();exit();
                return $query->result();
    }

    public function getCotizacionPorOt_antigua($ot_antigua)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizaciones")
                ->where(array("ot_antigua"=>$ot_antigua))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }    
    
	
	  public function getMoldesPorId($id)
    {
		//,nombrecliente,tamano_caja,cuchillocuchillo,abobina,lbobina,fecha
         $query=$this->db
                ->select("m.idmolde,m.nombremolde,nombrecliente,tamano_caja,cuchillocuchillo,abobina,lbobina,fecha")
                ->from("moldes_grau as m")
                ->where(array("m.idmolde"=>$id))
                ->get();
                return $query->row();		
    }
    /**
     *archivos de clientes 
     **/
     public function getArchivoClientePorCotizacion($id)
    {
         //,nombrecliente,tamano_caja,cuchillocuchillo,abobina,lbobina,fecha
         $query=$this->db
                ->select("id,id_cotizacion,archivo,fecha")
                ->from("cotizacion_archivo_cliente")
                ->where(array("id_cotizacion"=>$id))
                ->get();
          //echo $this->db->last_query();exit;
                return $query->row();		
    }
    public function getArchivoClientePorId($id)
    {
		//,nombrecliente,tamano_caja,cuchillocuchillo,abobina,lbobina,fecha
         $query=$this->db
                ->select("id,id_cotizacion,archivo,fecha")
                ->from("cotizacion_archivo_cliente")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();		
    }

    public function getCampoArchivoClientePorId($id)
    {
		//,nombrecliente,tamano_caja,cuchillocuchillo,abobina,lbobina,fecha
         $query=$this->db
                ->select("archivo")
                ->from("cotizacion_archivo_cliente")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                return $query->row();		
    }    
    
    public function delete_archivo_cliente($id)
    {
	   try{
	   
			$this->db->where('id_cotizacion', $id);
			$this->db->delete('cotizacion_archivo_cliente');
		}
		catch(Exception $e)
		{
			return false;
		}
        return true;
    }    
    
    
    /**
     * órdenes de compra
     * */
      public function getOrdenDeCompraPorId($id)
    {
		 $query=$this->db
                ->select("nota,id,id_usuario,id_cotizacion,estado,orden_de_compra_cliente,precio,id_forma_pago,fecha_despacho,horario_despacho,total_o_parcial,cantidad_1,cantidad_2,cantidad_3,obs_facturar,obs_condiciones_cobranza,fecha")
                ->from("cotizaciones_orden_de_compra")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();		
    }
     public function getOrdenDeCompraPorCotizacion($id)
    {
		 $query=$this->db
                ->select("nombre_producto_cliente,nota,fecha_orden_cliente,fecha_despacho_solicitado_cliente,id,fecha,id_usuario,id_cotizacion,estado,orden_de_compra_cliente,precio,id_forma_pago,fecha_despacho,horario_despacho,total_o_parcial,cantidad_1,cantidad_2,cantidad_3,obs_facturar,obs_condiciones_cobranza,fecha,archivo,cantidad_de_cajas,cantidad_pedida,tiene_molde,id_molde,nombre_producto,codigo_de_compra_cliente,proveedores")
                ->from("cotizaciones_orden_de_compra")
                ->where(array("id_cotizacion"=>$id))
                ->get();
           //     echo $this->db->last_query()."<br>";exit();
                return $query->row();		
    }
   
	  public function getSolicitaMuestraPorCotizacion($id)
    {
		 $query=$this->db
                ->select("id,id_cotizacion,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,descripcion,medidas_de_la_caja,medidas_de_la_caja_2,medidas_de_la_caja_3,medidas_de_la_caja_4,estado")
                ->from("solicita_muestra")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                //echo $this->db->last_query()."<br>";
                return $query->row();		
    }
	public function getSolicitaMuestraPorId($id)
    {
		 $query=$this->db
                ->select("id,id_cotizacion,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,descripcion,medidas_de_la_caja,medidas_de_la_caja_2,medidas_de_la_caja_3,medidas_de_la_caja_4,estado,quien,cuando")
                ->from("solicita_muestra")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query()."<br>";
                return $query->row();		
    }
	public function getCotizacionesSolicitanMuestraPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_cotizacion,materialidad_datos_tecnicos,materialidad_eleccion,materialidad_1,materialidad_2,descripcion,medidas_de_la_caja,medidas_de_la_caja_2,medidas_de_la_caja_3,medidas_de_la_caja_4,estado,quien,cuando")
                ->from("solicita_muestra")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("solicita_muestra")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getEstadoCotizacion($id)
    {
		 $query=$this->db
                ->select("id,id_usuario,id_cotizacion,glosa,estado,fecha")
                ->from("cotizacion_estado")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                return $query->row();		
    }
	
	   public function getOrdenDeProduccionPorCotizacion($id)
    {
		 $query=$this->db
                ->select("id,id_cotizacion,valor,estado,fecha_entrega,tipo_entrega,can_despacho_1,can_despacho_2,can_despacho_3,id_forma_pago,quien_autoriza,fecha,estado,cantidad_pedida,tiene_molde,id_molde,nombre_producto_normal,producto_id,id_antiguo,nombre_molde,estan_los_moldes,quien,cuando,glosa,fecha_20_dias")
                ->from("orden_de_produccion")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                //echo $this->db->last_query()."<br>";
                return $query->row();		
    }

	

	   public function getValoresCotizadasHojaDeCosto($id)
    {
		        $query=$this->db
                ->select("*")
                ->from("hoja_de_costos_datos")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                //echo $this->db->last_query()."<br>";
                return $query->row();		
    }
	
	
	     public function getCotizacionesPorMolde($pagina,$porpagina,$quehago,$cliente,$buscar,$condicion_del_producto)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("cotizaciones.id as id,cotizaciones.fecha,cotizaciones.producto,cotizaciones.id_cliente,cotizaciones.condicion_del_producto")
                ->from("cotizaciones as cotizaciones")
                ->join("cotizacion_ingenieria as cotizacion_ingenieria","cotizaciones.id=cotizacion_ingenieria.id_cotizacion","inner")
                ->join("moldes_grau as moldes_grau","moldes_grau.id = cotizacion_ingenieria.numero_molde")
                ->where(array("cotizaciones.id_cliente"=>$cliente , "cotizaciones.condicion_del_producto"=>$condicion_del_producto))
				->like('moldes_grau.nombre ', $buscar, 'both')
                ->order_by("cotizaciones.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                 ->select("cotizaciones.id")
                ->from("cotizaciones as cotizaciones")
                ->join("cotizacion_ingenieria as cotizacion_ingenieria","cotizaciones.id=cotizacion_ingenieria.id_cotizacion","inner")
                ->join("moldes_grau as moldes_grau","moldes_grau.id = cotizacion_ingenieria.numero_molde")
                ->where(array("cotizaciones.id_cliente"=>$cliente , "cotizaciones.condicion_del_producto"=>$condicion_del_producto))
				->like('moldes_grau.nombre ', $buscar, 'both')
                ->order_by("cotizaciones.id","desc")
                ->count_all_results();
                return $query;
            break;
			
//			SELECT cotizaciones.id, cotizacion_ingenieria.numero_molde, moldes_grau.nombre FROM cotizaciones
//			INNER JOIN cotizacion_ingenieria
//			ON cotizaciones.id = cotizacion_ingenieria.id_cotizacion
//			INNER JOIN moldes_grau
//			ON moldes_grau.id = cotizacion_ingenieria.numero_molde
//			where cotizaciones.id_cliente = 973 and
//			moldes_grau.nombre like '%nuevo%'
        }
    }
	
		     public function getCotizacionesPorMoldeNumero($pagina,$porpagina,$quehago,$cliente,$buscar,$condicion_del_producto)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("cotizaciones.id as id,cotizaciones.fecha,cotizaciones.producto,cotizaciones.id_cliente,cotizaciones.condicion_del_producto")
                ->from("cotizaciones as cotizaciones")
                ->join("cotizacion_ingenieria as cotizacion_ingenieria","cotizaciones.id=cotizacion_ingenieria.id_cotizacion","inner")
                ->join("moldes_grau as moldes_grau","moldes_grau.id = cotizacion_ingenieria.numero_molde","inner")
                ->where(array("cotizaciones.id_cliente"=>$cliente , "cotizacion_ingenieria.numero_molde"=>$buscar , "cotizaciones.condicion_del_producto"=>$condicion_del_producto))
				//->like('moldes_grau.id', $buscar, 'both')
                ->order_by("cotizaciones.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
				//echo $this->db->last_query()."<br>";
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                 ->select("cotizaciones.id")
                ->from("cotizaciones as cotizaciones")
                ->join("cotizacion_ingenieria as cotizacion_ingenieria","cotizaciones.id=cotizacion_ingenieria.id_cotizacion","inner")
                ->join("moldes_grau as moldes_grau","moldes_grau.id = cotizacion_ingenieria.numero_molde","inner")
                ->where(array("cotizaciones.id_cliente"=>$cliente , "moldes_grau.id"=>$buscar , "cotizaciones.condicion_del_producto"=>$condicion_del_producto))
				//->like('moldes_grau.id', $buscar, 'both')
                ->order_by("cotizaciones.id","desc")
                ->count_all_results();
                return $query;
            break;
        }
    }
	
	
	public function getCotizacionesPorCliente3($id)
    {
        $query=$this->db
                ->select("id,id_usuario,id_cliente,id_vendedor,fecha,cantidad_1,cantidad_2,cantidad_3,cantidad_4,precio_1,precio_2,precio_3,precio_4,producto,numero_molde")
                ->from("cotizaciones")
                ->where(array("id_cliente"=>$id))
                //->limit(10)
                ->order_by("id","desc")
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
	
    public function getCotizacionesPorClienteViejas($id)
    {      
	$sql = "SELECT * FROM cotizaciones c, productos p where c.id=p.id_cotizacion and c.id_cliente=".$id." ORDER BY c.id DESC";
        $query=$this->db->query($sql);
        return $query->result();
    }
    
    public function getCotizacionesPorClienteViejasSinPoductos($id)
    {      
	$sql = "SELECT * FROM cotizaciones where id_cliente=".$id." and id not in (select id_cotizacion from productos) ORDER BY id DESC";
        //exit($sql);
        $query=$this->db->query($sql);
        return $query->result();
    }
    
    
    public function getCotizacionesPorClienteNuevasOT($id)
    {
        $query=$this->db
                ->select("co.id,oc.id AS ot,co.ot_migrada,co.id_cliente,co.ot_antigua,oc.precio,co.cantidad_1,oc.fecha,co.producto,p.codigo")
                ->from("cotizaciones co")
                ->join("productos p","co.id = p.id_cotizacion","left")
                ->join("clientes l","co.id_cliente = l.id","inner")
                ->join("cotizaciones_orden_de_compra oc","oc.id_cotizacion = co.id","inner")
                ->join("orden_de_produccion op","op.id_cotizacion = co.id","inner")
                ->where("co.id_cliente = $id and oc.fecha > '2016-12-31'")
                ->order_by("co.fecha","asc")
                ->get();
              //  echo $this->db->last_query();exit;
                return $query->result();
    }
    
    public function getCotizacionesPorClienteCotizadas($id)
    {
        $query=$this->db
                ->select("co.id, co.ot_migrada,co.producto,co.id_cliente, co.ot_antigua, h.valor_empresa AS precio, co.cantidad_1, h.fecha")
                ->from("cotizaciones co")
                ->join("productos p","co.id = p.id_cotizacion","left")
                ->join("clientes l","co.id_cliente = l.id","inner")
                ->join("hoja_de_costos_datos h","h.id_cotizacion = co.id","inner")
                ->where("co.id_cliente = $id and h.fecha > '2016-12-31' and co.id not in(select id_cotizacion from orden_de_produccion)")
                ->order_by("h.fecha","asc")
                ->get();
              //  echo $this->db->last_query();exit;
                return $query->result();
    }
    
    public function getCotizacionesPorClienteLast($id)
    {
        $query=$this->db
                ->select("od.precio as precio_final,od.fecha as fecha_ult,c.fecha,c.ot_migrada as ot_migrada,od.id as numero_ot,c.precio_migrado,c.ot_antigua,l.razon_social,h.valor_empresa,c.id,c.id_usuario,c.id_cliente,c.id_vendedor,c.cantidad_1,c.cantidad_2,c.cantidad_3,c.cantidad_4,c.precio_1,c.precio_2,c.precio_3,c.precio_4,c.producto,c.numero_molde")
                ->from("cotizaciones c")
                ->join("hoja_de_costos_datos h","c.id = h.id_cotizacion","left")
                ->join("clientes l","c.id_cliente = l.id","inner")
                ->join("cotizaciones_orden_de_compra od","c.id = od.id_cotizacion","left")
                ->where(array("c.id_cliente"=>$id))
                //->order_by("c.id","desc")
                ->order_by("od.fecha","desc")
              //  ->limit(20)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
    }
    public function getCotizacionesPorClienteLast2($id)
    { 
        $query=$this->db
                ->select("oc.id as ot,c.ot_migrada,h.valor_empresa as precio2,c.id_cliente,c.ot_migrada,c.ot_antigua,c.precio_migrado as precio,c.id,c.fecha,c.cantidad_1,c.producto")
                ->from("cotizaciones c")
                ->join("clientes l","c.id_cliente = l.id","inner")
                ->join("hoja_de_costos_datos h","h.id_cotizacion = c.id","left")
                ->join("cotizaciones_orden_de_compra oc","oc.id_cotizacion = c.id","left")
                ->where(array("c.id_cliente"=>$id))
                //->order_by("c.id","desc")
                ->order_by("c.fecha","desc")
                //->limit(20)
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();
    }
	
	
	//Para hoja de costo: distintas cantidades a cotizar
	//Para Orden de Compra confirmar cantidad 
	public function CantidadPorXXX($id,$cantidadxxx,$tipoCantidad)
	{
		
	    if($cantidadxxx > 0)
		{
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $cotizacionPresupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $user=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
        $presupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $forma_pago=$this->clientes_model->getFormasPagoPorNombre($datos->forma_pago);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
        $orden=$this->orden_model->getOrdenesPorCotizacion($id);
	
	
	
    $tamano1=$ing->tamano_a_imprimir_1;
    $tamano2=$ing->tamano_a_imprimir_2;
    
    if($tamano1==60 && $tamano2>100)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==70 && $tamano2>120)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==80 && $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==90 && $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1>90 && $tamano2>60)
    {
        $maquina="Máquina Roland 800";
    }else
    {
        $maquina="Máquina Roland Ultra";
    }
    /**
       * validaciones mermas
       * */
       
        if($fotomecanica->colores>3)
        {
            if($maquina=="Máquina Roland 800")
            {
               $color1=0;
               $color2= $fotomecanica->colores*150;
            }else
            {
               $color1=0;
               $color2= $fotomecanica->colores*100;
            }
        }else
        {
            if($maquina=="Máquina Roland 800")
            {
               $color1= 400;
               $color2=0;
            }else
            {
               $color1= 300;
               $color2=0;
            }
            
        }
       // echo $ing->unidades_por_pliego;exit;
         if ($cantidadxxx>0)
            $canTotal=number_format($cantidadxxx/5000,0,"","")-1;//6000 1
         else 
            $canTotal=number_format(0,0,"","")-1;//6000 1
         //echo $canTotal;exit;
         if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))
            $cantidad_1=$cantidadxxx/$ing->unidades_por_pliego;
         else $cantidad_1=0;
         //echo $cantidad_1;exit;
         if ($datos->cantidad_2>0)
            $cantidadTotal_2=number_format($datos->cantidad_2/5000,0,"","");
         else 
            $cantidadTotal_2=number_format(0,0,"","");
         if ($datos->cantidad_3>0)
            $cantidadTotal_3=number_format($datos->cantidad_3/5000,0,"","");
         else 
            $cantidadTotal_3=number_format(0,0,"","");          

         if ($datos->cantidad_4>0)
            $cantidadTotal_4=number_format($datos->cantidad_4/5000,0,"","");
         else 
            $cantidadTotal_4=number_format(0,0,"","");           
        if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))
        {
            if($cantidadxxx/$ing->unidades_por_pliego>5000)
            {
               $can1=150;
               if($can1==150)
               {
                   $entero=number_format(($cantidad_1/5000)+0.5,0,'','');
                   $can2=(($entero)-2)*75;
               }else
               {
                   $can2=0;
               }
            }else
            {
               $can1=0;
               $can2=0;
            }
        }
        else
        {
           $can1=0;
           $can2=0;
        }             
             
        $barniz=substr($fotomecanica->acabado_impresion_1,0,6);
        //echo $barniz;exit;
         if($fotomecanica->lleva_barniz=='SI')
         {
            $cantidadBarniz=$cantidadxxx-1000;
            if($cantidadBarniz<1000)
            {
                if($maquina=="Máquina Roland 800")
                {
                    $bar1=150;
                    $bar2=0;
                }else
                {
                    $bar1=100;
                    $bar2=0;
                }
            }else
            {
               if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))
                   $enteroBarniz=($cantidadxxx/$ing->unidades_por_pliego);
               else 
                   $enteroBarniz=0;
               $enteroBarniz=(((number_format($enteroBarniz,0,'','')/1000)+0.5)-2)*10;
               //echo $enteroBarniz;exit;   
               $bar1=150;
               $bar2=$enteroBarniz;
            }
            
	}else
        {
                $bar1=0;
                $bar2=0;
        }
		 
	if($datos->procesos_especiales_folia=="SI")
        {
            $folia=25;
        }else
        {
            $folia=0;
        }
		 
		 
        $acabado_nombre4=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
	$acabado_nombre5=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
	$acabado_nombre6=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
		
		
	if(strstr($acabado_nombre4->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }

	if(strstr($acabado_nombre5->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
	if(strstr($acabado_nombre6->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
        if($laca == null)
        {
                $laca=0;
        }

		
	if(strstr($acabado_nombre4->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        } 
		
	if(strstr($acabado_nombre5->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
        }
		
        if(strstr($acabado_nombre6->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
        }
        if($acabado_nombre4->tipo == 'Externo' and $acabado_nombre4->id != 17)
        {
			//echo $acabado_nombre4->tipo;
            $numeros_de_acabados=1;			
        }

        if($acabado_nombre5->tipo == 'Externo' and $acabado_nombre5->id != 17)
        {
            $numeros_de_acabados=2;		
        } 
		
        if($acabado_nombre6->tipo == 'Externo' and $acabado_nombre6->id != 17)
        {
            $numeros_de_acabados=3;	
        }
		
        if($numeros_de_acabados >= 2)
        {
            $termolaminado=0;
        }
		
	if($fotomecanica->acabado_impresion_4!="17" or $fotomecanica->acabado_impresion_5!="17" or $fotomecanica->acabado_impresion_6!="17")
        {
            if($termolaminado == 50)
            {
                $externo=0;
            }else{
                $externo=50;
            }
        }else
        {
            $externo=0;
        }
		
       // echo $ing->materialidad_datos_tecnicos;exit;
        if($ing->materialidad_datos_tecnicos=="Onda a la Vista")
        {
             $canTotal2=number_format($cantidadxxx/1000,0,"","");
          // echo $canTotal2;exit;
            if($canTotal2>=1)
            {
                $micromicro=30*$canTotal2;
            }else
            {
                $micromicro=0;
            }
        }else
        {
            $micromicro=0;
        }
         if($ing->materialidad_datos_tecnicos=="Cartulina-cartulina")
        {
             $canTotal2=number_format($cantidadxxx/1000,0,"","");
          // echo $canTotal2;exit;
            if($canTotal2>=1)
            {
                $cartulina=30*$canTotal2;
            }else
            {
                $cartulina=0;
            }
        }else
        {
            $cartulina=0;
        }
        if($ing->materialidad_datos_tecnicos=="Sólo Cartulina")
        {
           $emplacado=0;
        }else
        {
            $mermaEmplacadoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(35);
             
            if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))
                $emplacado= $cantidadxxx  / $ing->unidades_por_pliego; /*Valor x dividido por Unidad por pliego*/
            else 
                $emplacado=0;             
            $emplacado= $emplacado / 1000; /*Resultado de emplacado dividido por 1000*/                                       
            $emplacado= ($emplacado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                                  
            $emplacado= $emplacado/ 1000; /*emplacado dividido por 1000*/                   
            $emplacado = $emplacado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
            $Entero = number_format($emplacado,0,'',''); /* Guardar entero del emplacado*/                         
            $emplacado = $Entero * $mermaEmplacadoArray->precio;
	}
        if($ing->lleva_troquelado=="NO")
        {
            $troquelado=0;
        }else
        {
				
	  $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
          if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))
              $troquelado= $cantidadxxx  / $ing->unidades_por_pliego; /*Valor x dividido por Unidad por pliego*/
          else
              $troquelado=0;
          $troquelado= $troquelado / 1000; /*Resultado de emplacado dividido por 1000*/                                                              
          $troquelado= ($troquelado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          
          $troquelado= $troquelado/ 1000; /*emplacado dividido por 1000*/                      
          $troquelado = $troquelado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
          $EnteroTroquelado = number_format($troquelado,0,'',''); /* Guardar entero del emplacado*/                          
          $troquelado = $EnteroTroquelado * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        $sum=$color1+$color2+$can1+$can2+$bar1+$bar2+$laca+$folia+$termolaminado+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
        if(sizeof($hoja)>=1 and $tipoCantidad == 1)
        {
            $arreglo55=array
                (
                    "total_merma"=>$sum,
                );
//                $this->db->where('id', $hoja->id);
//                $this->db->update("hoja_de_costos_datos",$arreglo55);
        }
       /**
        * fin validaciones mermas
        * */ 
       if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))
            $tiraje=$cantidadxxx/$ing->unidades_por_pliego;
       else $tiraje=0;
       if($tiraje<4000)
       {
         $tiraje2="Menos de 4.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(17);
         $factor_rango=$factor_rangos->precio;
       }elseif($tiraje>4000 and $tiraje<=10000)
       {
         $tiraje2="4.001 a 10.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(18);
         $factor_rango=$factor_rangos->precio;
       }else
       {
        $tiraje2="Más de 10.000";
        $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(19);
         $factor_rango=$factor_rangos->precio;
       }
       /**
        * pre impresión
        * */
        if($fotomecanica->lleva_barniz=='SI')
        {
            $barniz3=1;
        }else
        {
            $barniz3=0;
        }
        //echo $barniz3;exit;
        if($maquina=="Máquina Roland 800")
        {
               $recargoPlanchaArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(26);
               $recargoPlancha=$recargoPlanchaArray->precio;
               $valorParaPlanchaMetal=1;
        }else
        {
               $recargoPlancha=0;
               $valorParaPlanchaMetal=0;
        }
        //echo $valorParaPlanchaMetal;exit;
        $arte=$this->variables_cotizador_model->getVariablesCotizadorPorId(1);
        $cantidadArte=$fotomecanica->colores*$arte->precio;

        $plancha_metal=$this->variables_cotizador_model->getVariablesCotizadorPorId(2);

        $cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))+(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
        //echo $plancha_metal->precio;exit;
        //$cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*1));

        $copiado=$this->variables_cotizador_model->getVariablesCotizadorPorId(3);
        $cantidadCopiapo=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))+(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
         //$cantidadCopiapo=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3));
        $peliculasPreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(4);
        $peliculasVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(28);
        $cantidadPeliculas=$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$fotomecanica->colores*$peliculasVariable->precio;
        $montajePreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(5);
        $cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->colores;
        if($datos->impresion_hacer_cromalin=='SI')
        {
           $cromalinVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(22);
           $cromalin=$cromalinVariable->precio;
           $coloresCromalin=1;
        }else
        {
           $cromalin=0;
           $coloresCromalin=0;
        }
        if($maquina=="Máquina Roland 800")
        {
            $coloresArte=$fotomecanica->colores;
            $coloresPlanchaMetal=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
            $coloresCopiado=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
            $coloresPeliculas=$fotomecanica->colores;
            $coloresMontaje=$fotomecanica->colores;
        }else
        {
            $coloresArte=$fotomecanica->colores;
            $coloresPlanchaMetal=$fotomecanica->colores;
            $coloresCopiado=$fotomecanica->colores;
            $coloresPeliculas=$fotomecanica->colores;
            $coloresMontaje=$fotomecanica->colores;
        }
                    $costoVenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(15);
                    $costoAdministracion=$this->variables_cotizador_model->getVariablesCotizadorPorId(16);
                    $totalPreImpresion=$cantidadArte+$cantidadPlantaMetal+$cantidadCopiapo+$cantidadPeliculas+$cantidadMontaje+$cromalin;		
                    switch($fotomecanica->materialidad_datos_tecnicos)
                    {
                        case 'Indefinido':
                            $materialidad_1=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_placa1);
                            $materialidad_2=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
                            $materialidad_3=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_liner3);
//                           $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
//                            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
//                            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                            $materialidad_4="No Aplica";
                            $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                            $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                            $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                            $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                            if ($materialidad_2->gramaje>0)
                                $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
                            else 
                                $costo_kilo=0;

                            if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                            {
                                     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                            }

                            if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                            {
                                     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                            }


                            if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                            {
                                     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                            }


                            if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                            {
                                     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                            }

                            if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                            {
                                     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                            }


                            if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                            {
                                     $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                            }

                            $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                            if($fotomecanica->lleva_barniz=='SI')
                            {
                                $barniz2=1;
                            }else
                            {
                                $barniz2=0;
                            }

                            if($maquina=="Máquina Roland 800")
                             {
                                $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                $tiraje=$tira1+$tira2;
                                //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                             }else
                             {
                                $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  

                             }    
                             // por orden del señor enrique se cambio el gramaje ya no se calcula si no que se obtiene de la materialidad directamente
//                            $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
//                            $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
//                            $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                            if ($materialidad_2->gramaje>0)
                                $GramosMetroCuadrado=$materialidad_2->gramaje;
                            else 
                                $GramosMetroCuadrado=0;                             
                            
                            if(sizeof($hoja)>=1 and $tipoCantidad == 1)
                            {
                                $arreglo54=array
                                    (
                                        "gramos_metro_cuadrado"=>$GramosMetroCuadrado,
                                    );
                                    $this->db->where('id', $hoja->id);
                                    $this->db->update("hoja_de_costos_datos",$arreglo54);
                            }
                            if ($materialidad_2->gramaje>0)
                                $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                            else 
                                $costoMonotapaPorMetro2=0;                              
                           switch($fotomecanica->estan_los_moldes)
                           {
                              case 'NO':
                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                              break;
                              case 'SI':
                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                              break;
                              case 'NO LLEVA':
                                $moldeNombre="<strong>NO LLEVA MOLDE</strong>";
                              break;
                              case 'CLIENTE LO APORTA':
                                $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                              break;
                           }

                            $tapaNombre=$materialidad_1->nombre;
                            $tapaGramaje=$materialidad_1->gramaje;
                            $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                            $tapaPrecio=$materialidad_1->precio;
                            $ondaNombre=$materialidad_2->nombre;
                            $ondaGramaje=$materialidad_2->gramaje;
                            $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                            $ondaPrecio=$materialidad_2->precio;
                            $linerNombre=$materialidad_3->nombre;
                            $linerGramaje=$materialidad_3->gramaje;
                            $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                            $linerPrecio=$materialidad_3->precio;

                                                                     break;                                    
                        case 'Microcorrugado':
                            $materialidad_2=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
                            
                            
                            
                           $materialidad_1=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_placa1);
                            $materialidad_2=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
                            $materialidad_3=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_liner3);
//                           $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
//                            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
//                            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                            $materialidad_4="No Aplica";
                            $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                            $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                            $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                            $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
//                            echo $materialidad_2->gramaje."esteee";
                            $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
//                            echo  $costo_kilo.'=((('.$materialidad_2->gramaje.'*('.$materialidad_2->precio.'/1000)+(('.$materialidad_2->gramaje.'*('.$variable_cotizador->precio.'/100)*'.$materialidad_2->precio.'/1000))+'.$materialidad_3->gramaje.'*'.$materialidad_3->precio.'/1000)/('.$materialidad_2->gramaje.'++('.$materialidad_2->gramaje.'*('.$variable_cotizador->precio.'/100))+'.$materialidad_3->gramaje.')))*1000';           



                                                                    if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                                                    }

                                                                    if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                                                    }


                                                                    if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                                                    }


                                                                    if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                                    }

                                                                    if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                                    }


                                                                    if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                                                    }

                            $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                            if($fotomecanica->lleva_barniz=='SI')
                            {
                                $barniz2=1;
                            }else
                            {
                                $barniz2=0;
                            }

                            if($maquina=="Máquina Roland 800")
                             {
                                $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                $tiraje=$tira1+$tira2;
                                //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                             }else
                             {
                                $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  

                             }    
                            $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                            $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                            $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                            if(sizeof($hoja)>=1 and $tipoCantidad == 1)
                            {
                                $arreglo54=array
                                    (
                                        "gramos_metro_cuadrado"=>$GramosMetroCuadrado,
                                    );
                                    $this->db->where('id', $hoja->id);
                                    $this->db->update("hoja_de_costos_datos",$arreglo54);
                            }
                            $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                           switch($fotomecanica->estan_los_moldes)
                           {
                              case 'NO':
                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                              break;
                              case 'SI':
                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                              break;
                              case 'NO LLEVA':
                                $moldeNombre="<strong>NO LLEVA MOLDE</strong>";
                              break;
                              case 'CLIENTE LO APORTA':
                                $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                              break;
                           }

                            $tapaNombre=$materialidad_1->nombre;
                            $tapaGramaje=$materialidad_1->gramaje;
                            $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                            $tapaPrecio=$materialidad_1->precio;
                            $ondaNombre=$materialidad_2->nombre;
                            $ondaGramaje=$materialidad_2->gramaje;
                            $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                            $ondaPrecio=$materialidad_2->precio;
                            $linerNombre=$materialidad_3->nombre;
                            $linerGramaje=$materialidad_3->gramaje;
                            $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                            $linerPrecio=$materialidad_3->precio;

                                                                     break;
                        case 'Corrugado'://la misma
                             //$materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->id_mat_placa1);
                             $materialidad_1=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_placa1);
                            //$materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->id_mat_onda2);
                            $materialidad_2=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
                            //print_r($materialidad_2);exit();
                            //$materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->id_mat_liner3);
                            $materialidad_3=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_liner3);
//                            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
//                            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
//                            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                            $materialidad_4="No Aplica";
                            $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                            $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                            $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                            $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                            //echo $materialidad_2->gramaje."sss";exit;
                            $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           

                                                                    if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                                                    }

                                                                    if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                                                    }


                                                                    if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                                                    }


                                                                    if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                                    }

                                                                    if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco/ white top
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                                    }


                                                                    if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                                                    {
                                                                             $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                                                    }
                            //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);



                            $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                            if($fotomecanica->lleva_barniz=='SI')
                            {
                                $barniz2=1;
                            }else
                            {
                                $barniz2=0;
                            }
                            /*
                            if($maquina=="Máquina Roland 800")
                            {
                                $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(30/100);   
                                $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                            }else
                            {
                                $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(0/100);   
                                //$valorParaPlanchaMetal
                                $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$BASE_imprenta->precio)*($fotomecanica->colores+$barniz2)*($valorParaPlanchaMetal*$recargor800/100);
                            }
                              */
                            if($maquina=="Máquina Roland 800")
                             {
                                $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                $tiraje=$tira1+$tira2;
                                //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                             }else
                             {
                                $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  

                             }    
                            $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                            $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                            $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                            $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                           if($fotomecanica->estan_los_moldes=='SI')
                           {
                                $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                $moldeNombre=$molde->nombre." N°".$molde->numero;
                           }else
                           {
                                $moldeNombre="Nuevo";
                           }
                            $tapaNombre=$materialidad_1->nombre;
                            $tapaGramaje=$materialidad_1->gramaje;
                            $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                            $tapaPrecio=$materialidad_1->precio;
                            $ondaNombre=$materialidad_2->nombre;
                            $ondaGramaje=$materialidad_2->gramaje;
                            $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                            $ondaPrecio=$materialidad_2->precio;
                            $linerNombre=$materialidad_3->nombre;
                            $linerGramaje=$materialidad_3->gramaje;
                            $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                            $linerPrecio=$materialidad_3->precio;      

                    break;
                        case 'Cartulina-cartulina':
//                            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
//                            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                             $materialidad_1=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_placa1);
                            $materialidad_2=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
                            $materialidad_3="No Aplica";;
                            $materialidad_4="No Aplica";
                            $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                            $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                            $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);

                            //$formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                            //echo $materialidad_2->gramaje."sss";exit;
                            if (($materialidad_2->gramaje>0) and ($materialidad_2->precio>0))
                                $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+0*0/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0)))*1000;           
                            else
                                $costo_kilo=0;
                           //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
                            $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                            $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                            if($fotomecanica->lleva_barniz=='SI')
                            {
                                $barniz2=1;
                            }else
                            {
                                $barniz2=0;
                            }

                            if($maquina=="Máquina Roland 800")
                             {
                                $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                $tiraje=$tira1+$tira2;
                                //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                             }else
                             {
                                $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  

                             }    
                            $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0;
                            // por odery modificacion del Señor enrique
                            $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);

                            $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                            $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+0*0/1000);
                           if($fotomecanica->estan_los_moldes=='SI')
                           {
                                $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
                                $moldeNombre=$molde->nombre." N°".$molde->numero;
                           }else
                           {
                                $moldeNombre="Nuevo";
                           }
                            $tapaNombre=$materialidad_1->nombre;
                            $tapaGramaje=$materialidad_1->gramaje;
                            $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                            $tapaPrecio=$materialidad_1->precio;
                            $ondaNombre=$materialidad_2->nombre;
                            $ondaGramaje=$materialidad_2->gramaje;
                            $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                            $ondaPrecio=$materialidad_2->precio;
                            $linerNombre=$materialidad_3->nombre;
                            $linerGramaje=$materialidad_3->gramaje;
                            $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                            $linerPrecio=$materialidad_3->precio;           

                        break;
                        case 'Sólo Cartulina':
//                         $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                            $materialidad_1=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_placa1);
                            $materialidad_2="No Aplica";
                            $materialidad_3="No Aplica";
                            $materialidad_4="No Aplica";

                        break;
                        case 'Onda a la Vista ( Micro/Micro )':
//                            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
//                            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
//                            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
//                            $materialidad_4=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_4);
                             $materialidad_1=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_placa1);
                            $materialidad_2=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
                            $materialidad_3=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_liner3);
                            $materialidad_4=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda4);

                        break;
                        case 'Otro':
//                            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
//                            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                             $materialidad_1=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_placa1);
                            $materialidad_2=$this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
                            $materialidad_3="No Aplica";
                            $materialidad_4="No Aplica";

                        break;
                        case 'Se solicita proposición':

                        break;
                    }  
				
				
                    if($fotomecanica->acabado_impresion_4=="17")
                    {
                            $acabado_4="No Lleva";
                            $acabado_4Valor="&nbsp;";
                            $acabado_4MedidaMasValorVenta="&nbsp;";
                            $acabado_4Unitario="&nbsp;";
                            $acabado_4UnidadVentaNombre="&nbsp;";
                    }else
                    {
                            $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                            $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                            $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                            $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                            $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                            $acabado_4CostoFijo=$acabado_4Array->costo_fijo;		
                            if ($acabado_4Array->unidad_de_venta == '1' /*== '1'and sizeof($hoja->valor_acabado_1)==0*/) //mt2
                            {
                                    //(cf/(total cajas/unidad pliego))+((ancho x largo x valor venta)/10.000)
                                    $acabado_4Unitario = ($acabado_4CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+($acabado_4MedidaMasValorVenta);
                            }
                            if ($acabado_4Array->unidad_de_venta == '4') //por pasada
                            {
                                    $acabado_4Unitario = (($acabado_4CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+ $acabado_4Valor);
                            }									
                    }
								
                    if($fotomecanica->acabado_impresion_5=="17")
                    {
                        $acabado_5="No Lleva";
                        $acabado_5Valor="&nbsp;";
                        $acabado_4MedidaMasValorVenta="&nbsp;";
                        $acabado_5Unitario="&nbsp;";
                        $acabado_5UnidadVentaNombre="&nbsp;";
                    }else
                    {
                        $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                        $acabado_5=$acabado_5Array->caracteristicas;
                        $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                        $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                        $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                        $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                        if ($acabado_5Array->unidad_de_venta == '1' /*== '1'and sizeof($hoja->valor_acabado_1)==0*/) //mt2
                        {
                                //(cf/(total cajas/unidad pliego))+((ancho x largo x valor venta)/10.000)
                                $acabado_5Unitario = ($acabado_5CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+($acabado_5MedidaMasValorVenta);
                        }
                        if ($acabado_5Array->unidad_de_venta == '4') //por pasada
                        {
                                $acabado_5Unitario = (($acabado_5CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+ $acabado_5Valor);
                        }
                    }    
                    if($fotomecanica->acabado_impresion_6=="17")
                    {
                        $acabado_6="No Lleva";
                        $acabado_6Valor="&nbsp;";
                        $acabado_4MedidaMasValorVenta="&nbsp;";
                        $acabado_6Unitario="&nbsp;";
                        $acabado_6UnidadVentaNombre="&nbsp;";
                    }else
                    {
                        $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                        $acabado_6=$acabado_6Array->caracteristicas;
                        $acabado_6UnidadVentaNombre=$acabado_Array->unv; //Nombre unidad de venta
                        $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                        $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                        $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                        if ($acabado_6Array->unidad_de_venta == '1' /*== '1'and sizeof($hoja->valor_acabado_1)==0*/) //mt2
                        {
                                //(cf/(total cajas/unidad pliego))+((ancho x largo x valor venta)/10.000)
                                $acabado_6Unitario = ($acabado_6CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+($acabado_6MedidaMasValorVenta);
                        }
                        if ($acabado_6Array->unidad_de_venta == '4') //por pasada
                        {
                                $acabado_6Unitario = (($acabado_6CostoFijo/($datos->cantidad_1/$ing->unidades_por_pliego))+ $acabado_6Valor);

                        }
                    }       
				
                    if($ing->piezas_adicionales == 'NO LLEVA')
                    {
                        $piezaAdacionalNom1 ="No Lleva";
                        $piezaAdacionalValor1="&nbsp;";
                        $piezaAdacionalTotal1="&nbsp;";
                        $piezaAdacionalEmpresa1="&nbsp;";
                    }else
                    {
                        $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombre($ing->piezas_adicionales);
                        $piezaAdacionalNom1 = $piezasAdicionales->piezas_adicionales;
                        $piezaAdacionalValor1= $piezasAdicionales->valor_venta;
                        $piezaAdacionalTotal1 = $datos->cantidad_1 * $piezaAdacionalValor1;
                        $piezaAdacionalEmpresa1= $hoja->piezas_adicionales1;
                    }
								
                    if($ing->piezas_adicionales2 == 'NO LLEVA')
                    {
                        $piezaAdacionalNom2 ="No Lleva";
                        $piezaAdacionalValor2="&nbsp;";
                        $piezaAdacionalTotal2="&nbsp;";
                        $piezaAdacionalEmpresa2="&nbsp;";
                    }else
                    {
                        $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombre($ing->piezas_adicionales2);
                        $piezaAdacionalNom2 = $piezasAdicionales->piezas_adicionales;
                        $piezaAdacionalValor2= $piezasAdicionales->valor_venta;
                        $piezaAdacionalTotal2= $datos->cantidad_1 * $piezaAdacionalValor2;
                        $piezaAdacionalEmpresa2= $hoja->piezas_adicionales2;
                    }
								
                    if($ing->piezas_adicionales3 == 'NO LLEVA')
                    {
                        $piezaAdacionalNom3 ="No Lleva";
                        $piezaAdacionalValor3="&nbsp;";
                        $piezaAdacionalTotal3="&nbsp;";
                        $piezaAdacionalEmpresa3="&nbsp;";
                    }else
                    {
                        $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombre($ing->piezas_adicionales3);
                        $piezaAdacionalNom3 = $piezasAdicionales->piezas_adicionales;
                        $piezaAdacionalValor3 =  $piezasAdicionales->valor_venta;
                        $piezaAdacionalTotal3= $datos->cantidad_1 * $piezaAdacionalValor3;;
                        $piezaAdacionalEmpresa3= $hoja->piezas_adicionales3;
                    }
				
                    if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))
                        $costoPlacaKilo=($cantidadxxx/$ing->unidades_por_pliego)+$sum;
                    else $costoPlacaKilo=$sum;
                    $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                    $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							/*
                             if(sizeof($hoja)>=1 and $tipoCantidad == 1)
                            {
                                $arreglo5=array
                                (
                                    "placa_kilo"=>$costoPlacaKilo,
                                    "total_pliegos"=>$valorPlacaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo5);
                            }
							*/
							/*
							 if(sizeof($hoja)>=1 and $tipoCantidad == 1)
                            {
                                $arreglokilo1=array
                                (
                                    "kilos_placa"=>$valorPlacaKilo,
                                 
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo1);
                            }
				*/
		    $variableComplemento=$this->variables_cotizador_model->getVariablesCotizadorPorId(32);
                    $valorTiraje=$variableComplemento->precio-$tiraje;
                    if($valorTiraje>0)
                    {
                        $complemento=$valorTiraje;
                    }else
                    {
                        $complemento=0;
                    }

                    if($hoja->valor_acabado_1 >= 1 )
                    {
                        $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_1;
                    }else
                    {       
                        if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))
                            $externos_produccion = $externos_produccion +(($acabado_4Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
                    }
								  
                    if($hoja->valor_acabado_2 >= 1 )
                    {
                        $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_2;
                    }else
                    {
                        if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))
                            $externos_produccion = $externos_produccion + (($acabado_5Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
                    }
                    if($hoja->valor_acabado_3 >= 1 )
                    {
                        $externos_produccion = $datos->cantidad_1 * $hoja->valor_acabado_3;
                    }else
                    {
                        if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))                        
                            $externos_produccion = $externos_produccion + (($acabado_6Unitario * $datos->cantidad_1)/$ing->unidades_por_pliego);
                    }
										
                    if($maquina=="Máquina Roland 800")
                    {
                        if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))                        
                            $costoOndaKilo=((($cantidadxxx/$ing->unidades_por_pliego)*1.04)+100)+4;
                        else
                            $costoOndaKilo=0;

                    }else
                    {
                        if (($cantidadxxx>0) and ($ing->unidades_por_pliego>0))                         
                            $costoOndaKilo=(($cantidadxxx/$ing->unidades_por_pliego)+100)+4;
                        else
                            $costoOndaKilo=0;                            
                    }
                    $valorOndaKilo=(($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000)*1.37;
//                    echo "valorOndaKilo=(".$costoOndaKilo."*".$tamano1."*".$tamano2."*".$GramosMetroCuadrado.")/10000000";
                    $totalOndaKilo=$valorOndaKilo*$costo_kilo;
                    $valorCorte=$costoOndaKilo*4.5;
                    $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
                    $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
                    $totalEmplacado=$valorEmplacadado*$costoOndaKilo;
				
                    if($fotomecanica->estan_los_moldes == 'NO')
                    {
                        $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                        $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                        $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                    }elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
                    {
                        $variableMontajeMoldeTroquel=0;
                        $totalMontajeMolde=0;
                    }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
                    {
                        $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                        $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                        $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                    }

                    if($fotomecanica->estan_los_moldes == 'NO')
                    {
                        $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                        $totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
                    }elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
                    {
                            $variableTroquelado=0;
                            $totalTroquelado=0;
                    }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
                    {
                        $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                        $totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
                    }

                    $variableDesgajado=$this->variables_cotizador_model->getVariablesCotizadorPorId(12);
                    $totalDesgajado=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOndaKilo;

                    $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                    $totalPegado=$cantidadxxx*$hoja->pegado*$variablePegado->precio;				
										
										
                    if(sizeof($hoja->pegado)>=1)
                     {
                        $divisionPegado=$hoja->pegado/2;
                        $totalDespacho=$divisionPegado*$cantidadxxx;
                     }
                     else
                     {
                        $divisionPegado=$presupuesto->costo_pegado/2;
                        $totalDespacho=$divisionPegado*$cantidadxxx;	 
                     }

                    if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
                    {
                        if($fotomecanica->estan_los_moldes == 'NO')
                        {
                                $variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                $moldeTroquel=$variableTroquel->precio;
                        }elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
                        {
                                $moldeTroquel=0;
                        }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
                        {
                                $moldeTroquel=0;
                        }
                    }
					
                    if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
                    {
                        $moldeTroquel=0;

                    }					

                    if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
                    {
                        $moldeTroquel=0;
                    }
                    if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
                    {
                        $moldeTroquel=0;
                    }
					
					
					
                    if($fotomecanica->lleva_barniz == 'SI' and $fotomecanica->reserva_barniz == 'SI')
                    {
                        $otrosCaucho = 80000; 
                    }else
                    {
                        $otrosCaucho = 0;
                    }
                    if($piezaAdacionalEmpresa1 != 0)
                    {
                        $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa1;
                    }
                    else
                    {
                        $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal1;
                    }
                    if($piezaAdacionalEmpresa2 != 0)
                    {
                        $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa2;
                    }
                    else
                    {
                        $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal2;
                    }
                    if( $piezaAdacionalEmpresa3 != 0)
                    {
                        $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa3;
                    }
                    else
                    {
                        $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal3;
                    }			
                    $totalProduccion=$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales;
                    $costoVentaValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;				
                    $costoAdministracionValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoAdministracion->precio)/100;				
                    $totalCostosVarios=$costoAdministracionValor+$costoVentaValor+$hoja->costo_adicional;				
										
                    if(sizeof($hoja)>=1 and $tipoCantidad == 1)
                    {
                        $arreglo6=array
                        (
                            "onda_kilo"=>$costoOndaKilo,
                        );
//                                exit(print_r($arreglo6));                                
                        $this->db->where('id', $hoja->id);
                        $this->db->update("hoja_de_costos_datos",$arreglo6);
                    }
				
                    if(sizeof($hoja)>=1 and $tipoCantidad == 1)
                    {

                        $arreglokilo2=array
                        (
                            "kilos_onda"=>$valorOndaKilo,
                        );
//                        exit(print_r($arreglokilo2));
                        $this->db->where('id', $hoja->id);
                        $this->db->update("hoja_de_costos_datos",$arreglokilo2);
                    }
				
		    $totalMateriaPrima=$totalOndaKilo+$totalPlacaKilo;
                    $totalMateriaPrima2=$totalOndaKilo+$totalPlacaKilo;
                    $totalTotal=$totalMateriaPrima2+$totalPreImpresion+$totalProduccion+$totalCostosVarios;
                    $totalValorUnitario=$totalTotal/$cantidadxxx;
                           // $totalValorUnitario2=$totalTotal/$datos->cantidad_2;
                            //$totalValorUnitario3=$totalTotal/$datos->cantidad_3;
                            //$totalValorUnitario4=$totalTotal/$datos->cantidad_4;
                    $valorFinal=(($totalValorUnitario/(100-$hoja->margen))/100)*10000;
                          //  $valorFinal2=(($totalValorUnitario2/(100-$presupuesto->margen))/100)*10000;
                          //  $valorFinal3=(($totalValorUnitario3/(100-$presupuesto->margen))/100)*10000;
                          //  $valorFinal4=(($totalValorUnitario4/(100-$presupuesto->margen))/100)*10000;
						  
						  
						  
				
				 $vcostoFinanciero=$this->variables_cotizador_model->getVariablesCotizadorPorId(33);
                            $recargoPorCantidadJusta=$this->variables_cotizador_model->getVariablesCotizadorPorId(37);
                            $valorFinanciado=$valorFinal*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                           // $valorFinanciado2=$valorFinal2*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                           // $valorFinanciado3=$valorFinal3*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                            //$valorFinanciado4=$valorFinal4*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                            if($datos->acepta_excedentes=='NO')
                            {
                                $valorFinanciado=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado);
                              //  $valorFinanciado2=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado2);
                              //  $valorFinanciado3=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado3);
                             //   $valorFinanciado4=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado4);
                            }
				
				
				  if(sizeof($hoja)==0)
                                {
                                    $valorEmpresa=$valorFinanciado;
                                }else
                                {
                                    $valorEmpresa=$hoja->valor_empresa;
                                }
				
				
				
				    if(sizeof($hoja)==0)
                                {
                                    $valorEmpresa2=number_format($valorFinanciado2,0,'','.');
                                    $valorEmpresa3=number_format($valorFinanciado3,0,'','.');
                                    $valorEmpresa4=number_format($valorFinanciado4,0,'','.');
                                }else
                                {
                                    $valorEmpresa2=$hoja->valor_empresa_2;
                                    $valorEmpresa3=$hoja->valor_empresa_3;
                                    $valorEmpresa4=$hoja->valor_empresa_4;
                                }
							


				return $valorFinal;
		}
			return 0;	
				
				
	}//Fin
        
    public static function getCotizacionIngenieriaPorIdCotizacion2($id)
    {
       $query=$this->db
                ->select("*")
                ->from("cotizacion_ingenieria")
                ->where(array("id_cotizacion"=>$id))
				->order_by("id","desc")
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }        

    public function getMolde($id)
    {
       $query=$this->db
                ->select("mg.*")
                ->from("cotizaciones_orden_de_compra as cc")
                ->join("moldes_grau mg ","mg.id = cc.id_molde","inner")
                ->where(array("mg.id"=>$id))
               ->get();
               // echo $this->db->last_query();
                
                return $query->row();
    }         
	


    public function getOndaCompleto($nombre)
    {        
       $query=$this->db
                ->select("mt.materiales_tipo as tipo, m.nombre, m.reverso, m.gramaje")
                ->from("materiales as m")
                ->join("materiales_tipo mt","mt.id = m.tipo","left")
                ->where(array("m.nombre"=>$nombre))
                ->get();
                //echo $this->db->last_query();exit;
                $datos = $query->row();
                $dat = $datos->nombre.' '.$datos->tipo.' '.$datos->reverso.' '.$datos->gramaje;
                return $dat;  
    }   

    public function getOndaCompletoCartulina($id)
    {        
       $query=$this->db
                ->select("mt.materiales_tipo as tipo, m.nombre, m.reverso, m.gramaje")
                ->from("materiales as m")
                ->join("materiales_tipo mt","mt.id = m.tipo","left")
                ->where(array("m.id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                $datos = $query->row();
                $dat = $datos->nombre.' '.$datos->tipo.' '.$datos->reverso.' '.$datos->gramaje;
                return $dat;  
    }       	
}