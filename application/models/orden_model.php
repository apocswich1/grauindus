<?php

class orden_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}

     public function getOrdenesPaginaciond($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("orden_de_produccion")
                ->order_by("id","asc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
               ->select("*")
                ->from("orden_de_produccion")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getOrdenesAnterioresMoldeCliente($cliente,$molde)
    {
                $query=$this->db
                ->select("o.fecha,oc.id AS ot,o.id_molde,c.id,c.producto")
                ->from("orden_de_produccion o")
                ->join("cotizaciones c","c.id=o.id_cotizacion","inner")
                ->join("cotizaciones_orden_de_compra oc","oc.id_cotizacion=o.id_cotizacion","inner")
                ->where(array('c.id_cliente'=>$cliente,'o.id_molde'=>$molde))
                ->order_by("o.id","asc")
                ->get();
              //  echo $this->db->last_query();exit();
                return $query->result();
    }
    public function getOrdenesAnterioresCliente($cliente)
    {
                $query=$this->db
                ->select("o.fecha,oc.id AS ot,o.id_molde,c.id,c.producto")
                ->from("orden_de_produccion o")
                ->join("cotizaciones c","c.id=o.id_cotizacion","inner")
                ->join("cotizaciones_orden_de_compra oc","oc.id_cotizacion=o.id_cotizacion","inner")
                ->where("c.id_cliente = $cliente and c.fecha > '2016-12-31'")
                ->order_by("o.id","asc")
                ->limit(15)
                ->get();
              //  echo $this->db->last_query();exit();
                return $query->result();
    }
    public function getOrdenesAntiguasCliente($cliente)
    {           $vacio = "''";
                $query=$this->db
                ->select("id,ot_migrada,producto,fecha")
                ->from("cotizaciones c")
                ->where("c.id_cliente = $cliente and ot_migrada <> $vacio")
                ->order_by("c.id","asc")
                ->get();
              //  echo $this->db->last_query();exit();
                return $query->result();
    }
     public function getOrdenesConCotizacionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("oc.id as ot,c.id_vendedor,o.id as id_op,o.id_cotizacion as id,o.valor,o.fecha_entrega,o.tipo_entrega,o.id_forma_pago,o.fecha,o.quien_autoriza,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.can_despacho_1,o.can_despacho_2,o.can_despacho_3,o.id_forma_pago,o.quien_autoriza,o.fecha,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.nombre_producto_normal,o.producto_id,o.id_antiguo,c.id_cliente,c.condicion_del_producto,c.producto,c.fecha as fecha_cotizacion,v.id_vigencia as vigencia")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("cotizaciones_orden_de_compra as oc","c.id=oc.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
                //->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=o.id_cotizacion","left")
                ->where("o.estado <> 2 AND o.estado <> 0 AND o.estado <> 3 AND o.estado <> 4 AND o.id_cotizacion > 828")
                //->order_by("c.id","asc")
                ->order_by("ot","asc")
              //  ->limit($porpagina,$pagina)
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();
            break;
			
            case 'cuantos':
              $query=$this->db
               ->select("o.id as id_op")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
                ->where("o.estado <> 2 AND o.estado <> 0 AND o.estado <> 3 AND o.estado <> 4 AND o.id_cotizacion > 828")
               // ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=o.id_cotizacion","left")
                ->count_all_results();
		//echo $this->db->last_query();exit;
                return $query;

            break;
        }
    }
     public function getOrdenesConCotizacionPaginacionCerradas($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("oc.id as ot,c.id_vendedor,o.id as id_op,o.id_cotizacion as id,o.valor,o.fecha_entrega,o.tipo_entrega,o.id_forma_pago,o.fecha,o.quien_autoriza,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.can_despacho_1,o.can_despacho_2,o.can_despacho_3,o.id_forma_pago,o.quien_autoriza,o.fecha,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.nombre_producto_normal,o.producto_id,o.id_antiguo,c.id_cliente,c.condicion_del_producto,c.producto,c.fecha as fecha_cotizacion,v.id_vigencia as vigencia")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
                ->join("cotizaciones_orden_de_compra as oc","c.id=oc.id_cotizacion","inner")
                //->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=o.id_cotizacion","left")
                ->where("o.estado = 3 or o.estado = 4")
                //->order_by("c.id","asc")
                ->order_by("oc.id","asc")
              //  ->limit($porpagina,$pagina)
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();
            break;
			
            case 'cuantos':
              $query=$this->db
               ->select("o.id as id_op")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
               // ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=o.id_cotizacion","left")
                ->count_all_results();
		//echo $this->db->last_query();exit;
                return $query;

            break;
        }
    }
    
    public function getMontoOrdenesPorVendedor($vendedor){
        $query=$this->db
                ->select("sum(o.cantidad_pedida*o.valor) as monto")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
                ->join("usuarios as d","d.id=c.id_vendedor","inner")
                ->where("o.estado <> 2 AND o.estado <> 0 AND o.estado <> '3' AND o.estado <> '4' AND o.id_cotizacion > 828 AND c.id_vendedor='$vendedor'")
                ->order_by("c.id","asc")
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    
    public function getMontoOrdenes(){
        $query=$this->db
                ->select("sum(o.cantidad_pedida*o.valor) as monto")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
                ->join("usuarios as d","d.id=c.id_vendedor","inner")
                ->where("o.estado <> 2 AND o.estado <> 0 AND o.estado <> '3' AND o.estado <> '4' AND o.id_cotizacion > 828")
                ->order_by("c.id","asc")
                ->get();
               // echo $this->db->last_query();exit;
                return $query->row();
    }
    
     public function getOrdenesConCotizacionVendedorPaginacion($pagina,$porpagina,$quehago,$vendedor)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("o.estado,oc.id as ot,c.id_vendedor,d.nombre as vendedor,o.id as id_op,o.id_cotizacion as id,o.valor,o.fecha_entrega,o.tipo_entrega,o.id_forma_pago,o.fecha,o.quien_autoriza,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.can_despacho_1,o.can_despacho_2,o.can_despacho_3,o.id_forma_pago,o.quien_autoriza,o.fecha,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.nombre_producto_normal,o.producto_id,o.id_antiguo,c.id_cliente,c.condicion_del_producto,c.producto,c.fecha as fecha_cotizacion,v.id_vigencia as vigencia")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("cotizaciones_orden_de_compra as oc","c.id=oc.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
                ->join("usuarios as d","d.id=c.id_vendedor","inner")
                //->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=o.id_cotizacion","left")
                ->where("o.estado <> 2 AND o.estado <> 0 AND o.estado <> '3'  AND o.estado <> '4' AND o.id_cotizacion > 828 AND c.id_vendedor='$vendedor'")
                //->order_by("c.id","asc")
                ->order_by("ot","asc")
              //  ->limit($porpagina,$pagina)
                ->get();
                //echo "<pre>";
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
			
            case 'cuantos':
              $query=$this->db
               ->select("o.id as id_op")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("cotizaciones_orden_de_compra as oc","c.id=oc.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
                ->where("o.estado <> 2 AND o.estado <> 0  AND o.estado <> 3 AND o.estado <> 4 AND o.id_cotizacion > 828 AND c.id_vendedor=$vendedor")
               // ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=o.id_cotizacion","left")
                ->count_all_results();
		//echo $this->db->last_query();exit;
                return $query;

            break;
        }
    }
     public function getOrdenesConCotizacionVendedorPaginacionCerradas($pagina,$porpagina,$quehago,$vendedor)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("oc.id as ot,c.id_vendedor,d.nombre as vendedor,o.id as id_op,o.id_cotizacion as id,o.valor,o.fecha_entrega,o.tipo_entrega,o.id_forma_pago,o.fecha,o.quien_autoriza,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.can_despacho_1,o.can_despacho_2,o.can_despacho_3,o.id_forma_pago,o.quien_autoriza,o.fecha,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.nombre_producto_normal,o.producto_id,o.id_antiguo,c.id_cliente,c.condicion_del_producto,c.producto,c.fecha as fecha_cotizacion,v.id_vigencia as vigencia")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("cotizaciones_orden_de_compra as oc","c.id=oc.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
                ->join("usuarios as d","d.id=c.id_vendedor","inner")
                //->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=o.id_cotizacion","left")
                ->where("o.estado = 3 or o.estado = 4 AND c.id_vendedor='$vendedor' AND o.estado <> 0")
                //->order_by("c.id","asc")
                ->order_by("oc.id","asc")
              //  ->limit($porpagina,$pagina)
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();
            break;
			
            case 'cuantos':
              $query=$this->db
               ->select("o.id as id_op")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","c.id=v.id_cotizacion","left")
                ->where("o.estado = 3 or o.estado = 4 AND o.estado <> 0 AND c.id_vendedor=$vendedor")
               // ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=o.id_cotizacion","left")
                ->count_all_results();
		//echo $this->db->last_query();exit;
                return $query;

            break;
        }
    }
    
    public function getNumeroOt($id){
        $query=$this->db
                ->select("id as id_ot")
                ->from("cotizaciones_orden_de_compra")
                ->where(array("id_cotizacion"=>"$id"))
                ->get();
               // echo $this->db->last_query();exit;
                return $query->row();
    }

        public function getOrdenesConCotizacionPaginacionVigencia($pagina,$porpagina,$id,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("o.id as id_op,o.id_cotizacion as id,o.valor,o.fecha_entrega,o.tipo_entrega,o.id_forma_pago,o.fecha,o.quien_autoriza,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.can_despacho_1,o.can_despacho_2,o.can_despacho_3,o.id_forma_pago,o.quien_autoriza,o.fecha,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.nombre_producto_normal,o.producto_id,o.id_antiguo,c.id_cliente,c.condicion_del_producto,c.producto,c.fecha as fecha_cotizacion,v.id_vigencia as vigencia")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("vigencia_cotizacion v","v.id_cotizacion=c.id","left")
                ->where(array("v.id_vigencia"=>"$id"))
                ->order_by("o.id","desc")
                ->limit($porpagina)
                ->get();
                //echo $this->db->last_query();
                return $query->result();
            break;
			
            case 'cuantos':
              $query=$this->db
               ->select("o.id as id_op")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->join("vigencia_cotizacion as v","v.id_cotizacion=c.id","left")
                ->where(array("v.id_vigencia"=>$id))
                ->count_all_results();
		//echo $this->db->last_query();exit;
                return $query;

            break;
        }
    }
	
	
	 public function getOrdenesConCotizacionPaginacion2($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                 $query=$this->db
                ->select("o.id as id_op,o.id_cotizacion as id,o.valor,o.fecha_entrega,o.tipo_entrega,o.id_forma_pago,o.fecha,o.quien_autoriza,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.can_despacho_1,o.can_despacho_2,o.can_despacho_3,o.id_forma_pago,o.quien_autoriza,o.fecha,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.nombre_producto_normal,o.producto_id,o.id_antiguo,c.id_cliente,c.condicion_del_producto,c.producto,c.fecha as fecha_cotizacion,cli.razon_social,ve.nombre")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
				->join("clientes as cli","cli.id=c.id_cliente","inner")
				->join("vendedores as ve","ve.id=c.id_vendedor","inner")

                ->order_by("o.id","asc")
                ->limit($porpagina,$pagina)
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
               ->select("o.id as id_op")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
				->join("clientes as cli","cli.id=c.id_cliente","inner")
				->join("vendedores as ve","ve.id=c.id_vendedor","inner")

                ->count_all_results();
                return $query;
            break;
        }
    }
	
	  public function getOrdenesPorCotizacionEstado($id)
    {
         $query=$this->db
                ->select("*")
                ->from("produccion_fotomecanica")
                ->where(array("id_nodo"=>$id))
                ->get();
                 //echo $this->db->last_query();exit;
                return $query->row();
    }
	
    public function getCoprobarOrdenesPorCotizacion($id)
    {
         $query=$this->db
                ->select("*")
                ->from("orden_de_produccion")
                ->where(array("id_cotizacion"=>$id))
                ->get();
              //   echo $this->db->last_query();exit;
                return $query->row();
    }
	
	
    public function getOrdenesRelacionadasConCotizacionPorIdBuscar($pagina,$porpagina,$quehago,$id)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("o.id as id_op,o.id_cotizacion as id,o.valor,o.fecha_entrega,o.tipo_entrega,o.id_forma_pago,o.fecha,o.quien_autoriza,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.can_despacho_1,o.can_despacho_2,o.can_despacho_3,o.id_forma_pago,o.quien_autoriza,o.fecha,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.nombre_producto_normal,o.producto_id,o.id_antiguo,c.id_cliente,c.condicion_del_producto,c.producto,c.fecha as fecha_cotizacion")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->where(array("o.id"=>$id))
                ->order_by("o.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("o.id")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->where(array("o.id"=>$id))
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getOrdenesRelacionadasConCotizacionPorId($id)
    {
        $query=$this->db
                ->select("o.id,o.id_cotizacion,o.valor,o.fecha_entrega,o.tipo_entrega,o.id_forma_pago,o.fecha,o.quien_autoriza,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.can_despacho_1,o.can_despacho_2,o.can_despacho_3,o.id_forma_pago,o.quien_autoriza,o.fecha,o.estado,o.cantidad_pedida,o.tiene_molde,o.id_molde,o.nombre_producto_normal,o.producto_id,o.id_antiguo,c.id_cliente,c.condicion_del_producto,c.producto,c.fecha as fecha_cotizacion")
                ->from("orden_de_produccion as o")
                ->join("cotizaciones as c","c.id=o.id_cotizacion","inner")
                ->where(array("o.id"=>$id))
                ->get();
//                 echo $this->db->last_query();exit;
                return $query->row();
    }
     public function getOrdenesPorCotizacion($id)
    {
         $query=$this->db
                ->select("*")
                ->from("orden_de_produccion")
                ->where(array("id_cotizacion"=>$id))
                ->get();
//                 echo $this->db->last_query();exit;
                return $query->row();
    }
    
     public function getOrdenesPorCotizacion2($id)
    {
         $query=$this->db
                ->select("*")
                ->from("cotizaciones_orden_de_compra")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                 //echo $this->db->last_query();exit;
                return $query->row();
    }    
     public function getOrdenesPorClientePorId($id)
    {
         $query=$this->db
                ->select("op.id,op.id_cotizacion,op.valor,op.fecha_entrega,op.tipo_entrega,op.id_forma_pago,op.fecha,op.quien_autoriza,op.estado,op.cantidad_pedida,op.tiene_molde,op.id_molde,op.can_despacho_1,op.can_despacho_2,op.can_despacho_3,op.id_forma_pago,op.quien_autoriza,op.fecha,op.estado,op.cantidad_pedida,op.tiene_molde,op.id_molde,op.nombre_producto_normal,op.producto_id,c.producto")
                ->from("orden_de_produccion as op")
                ->join("cotizaciones as c","c.id=op.id_cotizacion","inner")
                ->where(array("c.id_cliente"=>$id))
                ->get();
                 //echo $this->db->last_query();exit;
                return $query->result();
    }
	
	
     public function getOrdenesPorId($id)
    {
         $query=$this->db
                ->select("*")
                ->from("orden_de_produccion")
                ->where(array("id"=>$id))
                ->get();
//                 echo $this->db->last_query();exit;
                return $query->row();
    }
    
     public function getOrdenesPorIdCotizacion($id)
    {
         $query=$this->db
                ->select("*")
                ->from("orden_de_produccion")
                ->where(array("id_cotizacion"=>$id))
                ->get();
//                 echo $this->db->last_query();exit;
                return $query->row();
    }    
	
	
       public function insertar($data=array())
    {
         $this->db->insert("orden_de_trabajo",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("orden_de_trabajo",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('orden_de_trabajo');
        return true;
    }
    
   public function countOrdenesPorClientePorIdParaProductosNuevos($id)
    {
		/*$this->db->select('count(*)');
$this->db->from('comments');
$this->db->where('level','4');
$query = $this->db->get();
echo $query->num_rows();
*/
         $query=$this->db
                ->select('c.id_cliente')
                ->from("productos pro")
                ->join("cotizaciones as c","c.id=pro.id_cotizacion","inner")
                ->where(array("c.id_cliente"=>$id))
                ->get();
                 //echo $this->db->last_query();exit;
			 //echo $query->num_rows();exit;
                return $query->num_rows();
    }
   
     public function getOrdenesDeCompraPorCotizacion($id)
    {
         $query=$this->db
                ->select("*")
                ->from("cotizaciones_orden_de_compra")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                 //echo $this->db->last_query();exit;
                return $query->row();
    }    
   
	
	
	
	  public function getOrdenesPorCotizacionListado($id)
    {
         $query=$this->db
                ->select("*")
                ->from("orden_de_produccion")
                ->where(array("id_cotizacion"=>$id))
                ->get();
                 //echo $this->db->last_query();exit;
                return $query->result();
    }
	
	  public function getOrdenesPorCotizacionPorId($id)
    {
         $query=$this->db
                ->select("op.id,op.id_cotizacion,op.valor,op.fecha_entrega,op.tipo_entrega,op.id_forma_pago,op.fecha,op.quien_autoriza,op.estado,op.cantidad_pedida,op.tiene_molde,op.id_molde,op.can_despacho_1,op.can_despacho_2,op.can_despacho_3,op.id_forma_pago,op.quien_autoriza,op.fecha,op.estado,op.cantidad_pedida,op.tiene_molde,op.id_molde,op.nombre_producto_normal,op.producto_id,c.producto")
                ->from("orden_de_produccion as op")
                ->join("cotizaciones as c","c.id=op.id_cotizacion","inner")
                ->where(array("op.id"=>$id))
                ->get();
                // echo $this->db->last_query();exit;
                return $query->row();
    }
	  public function getOrdenesPorCotizacionPorId2($id)
    {
         $query=$this->db
                ->select("op.id,op.id_cotizacion,op.valor,op.fecha_entrega,op.tipo_entrega,op.id_forma_pago,op.fecha,op.quien_autoriza,op.estado,op.cantidad_pedida,op.tiene_molde,op.id_molde,op.can_despacho_1,op.can_despacho_2,op.can_despacho_3,op.id_forma_pago,op.quien_autoriza,op.fecha,op.estado,op.cantidad_pedida,op.tiene_molde,op.id_molde,op.nombre_producto_normal,op.producto_id,c.producto")
                ->from("orden_de_produccion as op")
                ->join("cotizaciones as c","c.id=op.id_cotizacion","inner")
                ->where(array("op.id_cotizacion"=>$id))
                ->get();
                // echo $this->db->last_query();exit;
                return $query->row();
    }
    
    public function getUltimasOrdenes($id,$cot)
    {
         $query=$this->db 
                 ->select("producto_id,id AS op,id_cotizacion,nombre_producto_normal,fecha")
                ->from("orden_de_produccion")
                ->where("producto_id = $id and id_cotizacion <> $cot")
                ->get();
               // echo $this->db->last_query();exit();
                return $query->result();
    }
    
    public function getProductosClientesGRAUSPA($nombre)
    {
        $productos = array();
        $sql_GRAUSPA = "SELECT
                GR_iw_tsubgr.CodSubGr,
                GR_iw_tsubgr.DesSubGr,
                GR_iw_tprod.CodProd,
                GR_iw_tprod.DesProd,
                GR_iw_tprod.CodUMed,
                GR_iw_costop.CostoUnitario,
                GR_iw_costop.Stock,
                'GRAUSPA' AS empresa
            FROM
                GRAUSPA.softland.iw_tsubgr AS GR_iw_tsubgr
            INNER JOIN GRAUSPA.softland.iw_tprod AS GR_iw_tprod ON GR_iw_tsubgr.CodSubGr = GR_iw_tprod.CodSubGr
            
            LEFT JOIN (
                SELECT
                    CodProd,
                    MAX (Fecha) AS Fecha
                FROM
                    GRAUSPA.softland.iw_costop AS GR_iw_costop
                GROUP BY
                    CodProd
            ) AS GR_iw_costop_f ON GR_iw_tprod.CodProd = GR_iw_costop_f.CodProd
            
            LEFT JOIN GRAUSPA.softland.iw_costop AS GR_iw_costop ON GR_iw_costop_f.CodProd = GR_iw_costop.CodProd
            AND GR_iw_costop_f.Fecha = GR_iw_costop.Fecha
            
            WHERE
                GR_iw_tsubgr.DesSubGr LIKE '%".$nombre."%'";      
            $conn=odbc_connect('sqlserver_grauspa','sa','Softland809');
            if (!$conn)
              {exit("Connection Failed: " . $conn);}
            $sql=$sql_GRAUSPA;
            $i=0;
            $rs=odbc_exec($conn,$sql);
            if (!$rs)
              {exit("Error in SQL");}
                    while (odbc_fetch_row($rs))
                    {
                      $productos[$i]["CodSubGr"]=odbc_result($rs,"CodSubGr");       
                      $productos[$i]["DesSubGr"]=odbc_result($rs,"DesSubGr");    
                      $productos[$i]["CodProd"]=odbc_result($rs,"CodProd");    
                      $productos[$i]["DesProd"]=odbc_result($rs,"DesProd");       
                      $productos[$i]["CodUMed"]=odbc_result($rs,"CodUMed");    
                      $productos[$i]["CostoUnitario"]=odbc_result($rs,"CostoUnitario");  
                      $productos[$i]["Stock"]=odbc_result($rs,"Stock");  
                      $i++;
                    }
            odbc_close($conn);
            if ($productos)
                return $productos;
            else
                return '';
    }
    
    public function getProductosClientesGRAULTDA($nombre)
    {
        $productos = array();
         $sql_GRAULTDA = "SELECT
                GR_iw_tsubgr.CodSubGr,
                GR_iw_tsubgr.DesSubGr,
                GR_iw_tprod.CodProd,
                GR_iw_tprod.DesProd,
                GR_iw_tprod.CodUMed,
                GR_iw_costop.CostoUnitario,
                GR_iw_costop.Stock,
                'GRAULTDA' AS empresa
            FROM
                GRAULTDA.softland.iw_tsubgr AS GR_iw_tsubgr
            INNER JOIN GRAULTDA.softland.iw_tprod AS GR_iw_tprod ON GR_iw_tsubgr.CodSubGr = GR_iw_tprod.CodSubGr
            
            LEFT JOIN (
                SELECT
                    CodProd,
                    MAX (Fecha) AS Fecha
                FROM
                    GRAULTDA.softland.iw_costop AS GR_iw_costop
                GROUP BY
                    CodProd
            ) AS GR_iw_costop_f ON GR_iw_tprod.CodProd = GR_iw_costop_f.CodProd
            
            LEFT JOIN GRAULTDA.softland.iw_costop AS GR_iw_costop ON GR_iw_costop_f.CodProd = GR_iw_costop.CodProd
            AND GR_iw_costop_f.Fecha = GR_iw_costop.Fecha
            
            WHERE
                GR_iw_tsubgr.DesSubGr LIKE '%".$nombre."%'";   
//        exit;
            $conn=odbc_connect('sqlserver_graultda','sa','Softland809');
            if (!$conn)
              {exit("Connection Failed: " . $conn);}
            $sql=$sql_GRAULTDA;
            $i=0;
            $rs=odbc_exec($conn,$sql);
            if (!$rs)
              {exit("Error in SQL");}
                    while (odbc_fetch_row($rs))
                    {
                      $productos[$i]["CodSubGr"]=odbc_result($rs,"CodSubGr");       
                      $productos[$i]["DesSubGr"]=odbc_result($rs,"DesSubGr");    
                      $productos[$i]["CodProd"]=odbc_result($rs,"CodProd");    
                      $productos[$i]["DesProd"]=odbc_result($rs,"DesProd");       
                      $productos[$i]["CodUMed"]=odbc_result($rs,"CodUMed");    
                      $productos[$i]["CostoUnitario"]=odbc_result($rs,"CostoUnitario");  
                      $productos[$i]["Stock"]=odbc_result($rs,"Stock");  
                      $i++;
                    }
            odbc_close($conn);
            if ($productos)
                return $productos;
            else
                return '';
    }    

        
    public function getProductosClientesMICROBOX($nombre)
    {
        $productos = array();
        $sql_MICROBOX = "SELECT
                GR_iw_tsubgr.CodSubGr,
                GR_iw_tsubgr.DesSubGr,
                GR_iw_tprod.CodProd,
                GR_iw_tprod.DesProd,
                GR_iw_tprod.CodUMed,
                GR_iw_costop.CostoUnitario,
                GR_iw_costop.Stock,
                'MICROBOX' AS empresa
            FROM
                MICROBOX.softland.iw_tsubgr AS GR_iw_tsubgr
            INNER JOIN MICROBOX.softland.iw_tprod AS GR_iw_tprod ON GR_iw_tsubgr.CodSubGr = GR_iw_tprod.CodSubGr
            
            LEFT JOIN (
                SELECT
                    CodProd,
                    MAX (Fecha) AS Fecha
                FROM
                    MICROBOX.softland.iw_costop AS GR_iw_costop
                GROUP BY
                    CodProd
            ) AS GR_iw_costop_f ON GR_iw_tprod.CodProd = GR_iw_costop_f.CodProd
            
            LEFT JOIN MICROBOX.softland.iw_costop AS GR_iw_costop ON GR_iw_costop_f.CodProd = GR_iw_costop.CodProd
            AND GR_iw_costop_f.Fecha = GR_iw_costop.Fecha
            
            WHERE
                GR_iw_tsubgr.DesSubGr LIKE '%".$nombre."%'";           
            $conn=odbc_connect('sqlserver_graultda','sa','Softland809');
            if (!$conn)
              {exit("Connection Failed: " . $conn);}
            $sql=$sql_MICROBOX;
            $i=0;            
            $rs=odbc_exec($conn,$sql);
            if (!$rs)
              {exit("Error in SQL");}
                    while (odbc_fetch_row($rs))
                    {
                      $productos[$i]["CodSubGr"]=odbc_result($rs,"CodSubGr");       
                      $productos[$i]["DesSubGr"]=odbc_result($rs,"DesSubGr");    
                      $productos[$i]["CodProd"]=odbc_result($rs,"CodProd");    
                      $productos[$i]["DesProd"]=odbc_result($rs,"DesProd");       
                      $productos[$i]["CodUMed"]=odbc_result($rs,"CodUMed");    
                      $productos[$i]["CostoUnitario"]=odbc_result($rs,"CostoUnitario");  
                      $productos[$i]["Stock"]=odbc_result($rs,"Stock");  
                      $i++;
                    }
            odbc_close($conn);
            if ($productos)
                return $productos;
            else
                return '';
    }    

            
    public function getProductosClientesPUBLIGRAFIKA($nombre)
    {
        $productos = array();
        $sql_PUBLIGRAFIKA = "SELECT
                GR_iw_tsubgr.CodSubGr,
                GR_iw_tsubgr.DesSubGr,
                GR_iw_tprod.CodProd,
                GR_iw_tprod.DesProd,
                GR_iw_tprod.CodUMed,
                GR_iw_costop.CostoUnitario,
                GR_iw_costop.Stock,
                'PUBLIGRAFIKA' AS empresa
            FROM
                PUBLIGRAFIKA.softland.iw_tsubgr AS GR_iw_tsubgr
            INNER JOIN PUBLIGRAFIKA.softland.iw_tprod AS GR_iw_tprod ON GR_iw_tsubgr.CodSubGr = GR_iw_tprod.CodSubGr
            
            LEFT JOIN (
                SELECT
                    CodProd,
                    MAX (Fecha) AS Fecha
                FROM
                    PUBLIGRAFIKA.softland.iw_costop AS GR_iw_costop
                GROUP BY
                    CodProd
            ) AS GR_iw_costop_f ON GR_iw_tprod.CodProd = GR_iw_costop_f.CodProd
            
            LEFT JOIN PUBLIGRAFIKA.softland.iw_costop AS GR_iw_costop ON GR_iw_costop_f.CodProd = GR_iw_costop.CodProd
            AND GR_iw_costop_f.Fecha = GR_iw_costop.Fecha
            
            WHERE
                GR_iw_tsubgr.DesSubGr LIKE '%".$nombre."%'";   
            $conn=odbc_connect('sqlserver_graultda','sa','Softland809');
            if (!$conn)
              {exit("Connection Failed: " . $conn);}
            $sql=$sql_PUBLIGRAFIKA;
            $i=0;            
            $rs=odbc_exec($conn,$sql);
            if (!$rs)
              {exit("Error in SQL");}
                    while (odbc_fetch_row($rs))
                    {
                      $productos[$i]["CodSubGr"]=odbc_result($rs,"CodSubGr");       
                      $productos[$i]["DesSubGr"]=odbc_result($rs,"DesSubGr");    
                      $productos[$i]["CodProd"]=odbc_result($rs,"CodProd");    
                      $productos[$i]["DesProd"]=odbc_result($rs,"DesProd");       
                      $productos[$i]["CodUMed"]=odbc_result($rs,"CodUMed");    
                      $productos[$i]["CostoUnitario"]=odbc_result($rs,"CostoUnitario");  
                      $productos[$i]["Stock"]=odbc_result($rs,"Stock");  
                      $i++;
                    }
            odbc_close($conn);
            if ($productos)
                return $productos;
            else
                return '';
    }    

    public function getProductosClientesTENSPA($nombre)
    {
        $productos = array();
        $sql_TENSPA = "SELECT
                GR_iw_tsubgr.CodSubGr,
                GR_iw_tsubgr.DesSubGr,
                GR_iw_tprod.CodProd,
                GR_iw_tprod.DesProd,
                GR_iw_tprod.CodUMed,
                GR_iw_costop.CostoUnitario,
                GR_iw_costop.Stock,
                'TENSPA' AS empresa
            FROM
                TENSPA.softland.iw_tsubgr AS GR_iw_tsubgr
            INNER JOIN TENSPA.softland.iw_tprod AS GR_iw_tprod ON GR_iw_tsubgr.CodSubGr = GR_iw_tprod.CodSubGr
            
            LEFT JOIN (
                SELECT
                    CodProd,
                    MAX (Fecha) AS Fecha
                FROM
                    TENSPA.softland.iw_costop AS GR_iw_costop
                GROUP BY
                    CodProd
            ) AS GR_iw_costop_f ON GR_iw_tprod.CodProd = GR_iw_costop_f.CodProd
            
            LEFT JOIN TENSPA.softland.iw_costop AS GR_iw_costop ON GR_iw_costop_f.CodProd = GR_iw_costop.CodProd
            AND GR_iw_costop_f.Fecha = GR_iw_costop.Fecha
            
            WHERE
                GR_iw_tsubgr.DesSubGr LIKE '%".$nombre."%'";   
            $conn=odbc_connect('sqlserver_tenspa','sa','Softland809');
            if (!$conn)
              {exit("Connection Failed: " . $conn);}
            $sql=$sql_TENSPA;
            $i=0;            
            $rs=odbc_exec($conn,$sql);
            if (!$rs)
              {exit("Error in SQL");}
                    while (odbc_fetch_row($rs))
                    {
                      $productos[$i]["CodSubGr"]=odbc_result($rs,"CodSubGr");       
                      $productos[$i]["DesSubGr"]=odbc_result($rs,"DesSubGr");    
                      $productos[$i]["CodProd"]=odbc_result($rs,"CodProd");    
                      $productos[$i]["DesProd"]=odbc_result($rs,"DesProd");       
                      $productos[$i]["CodUMed"]=odbc_result($rs,"CodUMed");    
                      $productos[$i]["CostoUnitario"]=odbc_result($rs,"CostoUnitario");  
                      $productos[$i]["Stock"]=odbc_result($rs,"Stock");  
                      $i++;
                    }
            odbc_close($conn);
            if ($productos)
                return $productos;
            else
                return '';
    }    
	    
   public function getResumenControlCartulinaPorLiberar()
    {
       /*
        $sql = "SELECT oc.id AS ot,op.`fecha` AS fecha,cl.`razon_social`,i.`tamano_a_imprimir_1` AS ancho,i.`tamano_a_imprimir_2` AS largo,
                op.`cantidad_pedida` AS cantidad,h.`placa_kilo` AS kilos,i.`materialidad_datos_tecnicos` AS materialidad,cc.`situacion`,c.`producto`
                FROM orden_de_produccion op
                

                LEFT JOIN cotizaciones c ON c.`id` = op.`id_cotizacion`
                LEFT JOIN produccion_control_cartulina cc ON op.`id_cotizacion`=cc.`id_nodo`
                LEFT JOIN clientes cl ON cl.`id`=c.`id_cliente`
                LEFT JOIN cotizaciones_orden_de_compra oc ON oc.`id_cotizacion`=op.`id_cotizacion`
                LEFT JOIN cotizacion_ingenieria i ON i.`id_cotizacion` = op.`id_cotizacion`
                LEFT JOIN hoja_de_costos_datos h ON h.`id_cotizacion`=op.`id_cotizacion`
                WHERE op.estado <> 2 AND op.estado <> 0 AND op.estado <> '3' AND op.estado <> '4' AND op.`fecha`>'2017-12-12'";        
         */
        $query=$this->db
                ->select("oc.id AS ot,op.`fecha` AS fecha,cl.`razon_social`,i.`tamano_a_imprimir_1` AS ancho,i.`tamano_a_imprimir_2` AS largo,
                op.`cantidad_pedida` AS cantidad,h.`placa_kilo` AS kilos,i.`materialidad_datos_tecnicos` AS materialidad,cc.`situacion`,c.`producto`,  , m.`nombre` as cartulina, m.`gramaje`, m.reverso")
                ->from("orden_de_produccion op")
                ->join("cotizaciones as c","c.id=op.id_cotizacion","left")
                ->join("produccion_control_cartulina as cc ","op.id_cotizacion=cc.id_nodo","left")
                ->join("clientes as cl ","cl.id=c.id_cliente","left")
                ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=op.id_cotizacion","left")              
                ->join("cotizacion_ingenieria as i ","i.id_cotizacion = op.id_cotizacion","left")
                ->join("hoja_de_costos_datos as h","h.id_cotizacion=op.id_cotizacion","left")
                ->join("materiales as m ","m.id= c.id_mat_placa1","left")
                ->where("op.estado <> 2 AND op.estado <> 0 AND op.estado <> '3' AND op.estado <> '4' AND op.`fecha`>'2017-12-12'")
                ->order_by("oc.id","asc")
                ->get();
                         //echo $this->db->last_query();exit;

                return $query->result();
                
    }    	
    
    public function getDescripcionTrabajo($id){
        //$id = $id=6;
        $query=$this->db
                ->select("*")
                ->from("produccion_bodega")
                ->where(array("orden_de_trabajo"=>$id))
                ->get();
               // echo $query->row();exit;
                return $query->row();
    }    

    public function getListadoProgramaEmplacado(){
        //$id = $id=6;
        $query=$this->db
                ->select("i.id,
                            cl.razon_social,
                            oc.id AS ot,
                            c.producto, 
                            op.fecha AS fecha,
                            i.tamano_a_imprimir_1 AS ancho,
                            i.tamano_a_imprimir_2 AS largo,
                            m.nombre as liner,
                            i.unidades_por_pliego as unidad_pliego,
                            op.id_cotizacion as id_cotizacion,

                            op.cantidad_pedida AS cantidad,
                            i.materialidad_datos_tecnicos AS tipo,
                            m.gramaje, m.reverso,
                            i.tamano_cuchillo_1, i.tamano_cuchillo_2
                            ")
                ->from("orden_de_produccion op")
                ->join("cotizaciones as c","c.id = op.id_cotizacion","left")                
                ->join("clientes as cl","cl.id=c.id_cliente","left")                
                ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=op.id_cotizacion","left")                
                ->join("cotizacion_ingenieria as i","i.id_cotizacion = op.id_cotizacion","left")                
                ->join("hoja_de_costos_datos as h","h.id_cotizacion=op.id_cotizacion","left")                
                ->join("materiales as m","m.id= c.id_mat_liner3","left")      

                ->where("op.estado <> 2 AND op.estado <> 0 AND op.estado <> '3' AND op.estado <> '4' AND op.fecha>'2017-12-12'")
                ->order_by("oc.id","asc")

                ->get();

                //echo '<pre>';
                //print_r($query->result());
                //exit;
                return $query->result();
    }

    public function getListadoProgramaConfeccionMolde(){
        //$id = $id=6;
        $query=$this->db
                ->select("i.id,
                            cl.razon_social,
                            oc.id AS ot,
                            c.producto, 
                            op.fecha AS fecha,
                            i.tamano_a_imprimir_1 AS ancho,
                            i.tamano_a_imprimir_2 AS largo,
                            m.nombre as liner,
                            i.unidades_por_pliego as unidad_pliego,
                            op.id_cotizacion as id_cotizacion,

                            op.cantidad_pedida AS cantidad,
                            i.materialidad_datos_tecnicos AS tipo,
                            m.gramaje, m.reverso,
                            i.tamano_cuchillo_1, i.tamano_cuchillo_2
                            ")
                ->from("orden_de_produccion op")
                ->join("cotizaciones as c","c.id = op.id_cotizacion","left")                
                ->join("clientes as cl","cl.id=c.id_cliente","left")                
                ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=op.id_cotizacion","left")                
                ->join("cotizacion_ingenieria as i","i.id_cotizacion = op.id_cotizacion","left")                
                ->join("hoja_de_costos_datos as h","h.id_cotizacion=op.id_cotizacion","left")                
                ->join("materiales as m","m.id= c.id_mat_liner3","left")      

                ->where("op.estado <> 2 AND op.estado <> 0 AND op.estado <> '3' AND op.estado <> '4' AND op.fecha>'2017-12-12'")
                ->order_by("oc.id","asc")

                ->get();

                //echo '<pre>';
                //print_r($query->result());
                //exit;
                return $query->result();
    }   

    public function getOndaCotizacion($id_cotizacion){
        $query=$this->db
                ->select("cot.materialidad_2 as nombre, mat.gramaje, mat.reverso, mat.precio ")
                ->from("materiales mat")
                ->join("cotizaciones cot","mat.nombre = cot.materialidad_2","left")                
                ->where(array("cot.id"=>$id_cotizacion))
                ->get();

                return $query->row();
    }    
    
    public function getListadoProgramaFotomecanica(){
        //$id = $id=6;
        $query=$this->db
                ->select("oc.id AS ot, oc.fecha, cc.fecha_liberada,
                            cl.razon_social,c.producto,
                            c.condicion_del_producto as condicion, 
                            c.impresion_colores as colores,
                            i.tamano_a_imprimir_1 AS ancho,
                            i.tamano_a_imprimir_2 AS largo,
                            m.nombre as liner,
                            i.unidades_por_pliego as unidad_pliego,
                            i.materialidad_datos_tecnicos AS tipo,
                            op.cantidad_pedida AS cantidad,
                            m.gramaje, m.reverso,
                            c.id as id_cotizacion, cc.*
                            ")

                ->from("orden_de_produccion op")
                ->join("cotizaciones as c","c.id = op.id_cotizacion","left")                
                ->join("produccion_fotomecanica as cc","op.id_cotizacion=cc.id_nodo","left")                                
                ->join("clientes as cl","cl.id=c.id_cliente","left")                
                ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=op.id_cotizacion","left")                
                ->join("cotizacion_ingenieria as i","i.id_cotizacion = op.id_cotizacion","left")                
                ->join("hoja_de_costos_datos as h","h.id_cotizacion=op.id_cotizacion","left")                
                ->join("materiales as m","m.id= c.id_mat_liner3","left")                

                ->where("op.estado <> 2 AND op.estado <> 0 AND op.estado <> '3' AND op.estado <> '4' AND op.fecha>'2017-12-12'")
                ->order_by("oc.id","asc")

                ->get();

                //echo '<pre>';
                //print_r($query->last_result());
                //exit;
                return $query->result();
    }            

    public function getListadoProgramaTroquelado(){
        $query=$this->db
                ->select("oc.id AS ot, oc.fecha, cc.fecha_liberada,
                            cl.razon_social,c.producto,
                            c.condicion_del_producto as condicion, 
                            c.impresion_colores as colores,
                            i.tamano_a_imprimir_1 AS ancho,
                            i.tamano_a_imprimir_2 AS largo,
                            m.nombre as liner,
                            i.unidades_por_pliego as unidad_pliego,
                            i.materialidad_datos_tecnicos AS tipo,
                            op.cantidad_pedida AS cantidad,
                            m.gramaje, m.reverso,
                            c.id as id_cotizacion, cc.*
                            ")

                ->from("orden_de_produccion op")
                ->join("cotizaciones as c","c.id = op.id_cotizacion","left")                
                ->join("produccion_troquelado as cc","op.id_cotizacion=cc.id_nodo","left")                                
                ->join("clientes as cl","cl.id=c.id_cliente","left")                
                ->join("cotizaciones_orden_de_compra as oc","oc.id_cotizacion=op.id_cotizacion","left")                
                ->join("cotizacion_ingenieria as i","i.id_cotizacion = op.id_cotizacion","left")                
                ->join("hoja_de_costos_datos as h","h.id_cotizacion=op.id_cotizacion","left")                
                ->join("materiales as m","m.id= c.id_mat_liner3","left")                

                ->where("op.estado <> 2 AND op.estado <> 0 AND op.estado <> '3' AND op.estado <> '4' AND op.fecha>'2017-12-12'")
                ->order_by("oc.id","asc")

                ->get();

                //echo '<pre>';
                //print_r($query->last_result());
                //exit;
                return $query->result();
    }            
}