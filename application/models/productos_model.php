<?php

class productos_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
    public function getProductosPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
         {
            case 'limit':
                $sql = "select co.numero_molde AS molde,m.archivo,                                      CASE WHEN p.codigo IS NULL THEN c.id ELSE p.codigo END AS codigo,
CASE WHEN p.codigo IS NULL THEN c.fecha ELSE p.cuando END AS cuando,
CASE WHEN p.codigo IS NULL THEN c.producto ELSE p.nombre END AS nombre,
CASE WHEN p.codigo IS NULL THEN c.id ELSE p.id_cotizacion END AS id_cotizacion,
c.fecha,c.id,c.id_cliente,p.cuando,p.id,p.tipo, pt.productos_tipo,cl.razon_social from cotizaciones as c 
                left join productos p on p.id_cotizacion=c.id
                left join cotizaciones co on p.id_cotizacion=co.id
                left join moldes_grau m on m.id=co.numero_molde
                left join productos_tipo pt on pt.id=p.tipo
                left join clientes cl on cl.id=c.id_cliente
                order by cuando desc
                limit $porpagina";
                //echo $sql;exit;
                $query = $this->db->query($sql);
                $query = $query->result();
              //  echo $this->db->last_query();exit();
                return $query;
            break;
            case 'cuantos':
              $sql="cotizaciones as c 
                left join productos p on p.id_cotizacion=c.id
                left join productos_tipo pt on pt.id=p.tipo";
                $query = $this->db->count_all_results($sql);
                return $query;
            break;
        }
    }
    public function getProductosPaginacion_anterior($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("p.cuando,p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                //->group_by("p.codigo")
                ->order_by("p.cuando","desc")
                ->limit($porpagina,$pagina)
                ->get();
              //  echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
               // ->group_by("p.codigo")
                ->count_all_results();
                return $query;
            break;
        }
    }
    
    public function getCantidadProductosPorCliente($id){
        $query=$this->db
                ->select("*")
                ->from("productos")
                ->like("codigo",$id,"both")
                ->count_all_results();
                //->get();
        //echo $this->db->last_query();
        return $query;
    }
    public function getUltimoNumeroProductosPorCliente($id){
        $query=$this->db
                ->select("codigo")
                ->from("productos p")
                ->like("p.codigo",$id,"both")
                ->order_by("codigo","desc")
                ->limit(1)
                ->get();
        return $query->row();
    }

        public function getProductosPorClientePaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->like('p.codigo', $buscar, 'both')
                ->order_by("p.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
             //   echo $this->db->last_query();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->like('p.codigo', $buscar, 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }
     public function getProductosPorTipoPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->where(array('p.tipo'=>$buscar))
                ->order_by("p.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->where(array('p.tipo'=>$buscar))
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getProductosSearchPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                 $sql = "select CASE WHEN p.codigo IS NULL THEN c.id ELSE p.codigo END AS codigo,
CASE WHEN p.codigo IS NULL THEN c.fecha ELSE p.cuando END AS cuando,
CASE WHEN p.codigo IS NULL THEN c.producto ELSE p.nombre END AS nombre,
CASE WHEN p.codigo IS NULL THEN c.id ELSE p.id_cotizacion END AS id_cotizacion,
c.fecha,c.id,c.id_cliente,p.cuando,p.id,p.tipo,cl.razon_social,pt.productos_tipo from cotizaciones as c 
                left join productos p on p.id_cotizacion=c.id
                left join productos_tipo pt on pt.id=p.tipo
                left join clientes cl on cl.id=c.id_cliente
                where p.codigo like'%$buscar%' or
                    p.nombre like'%$buscar%' or
                            c.id like'%$buscar%' or
                                cl.razon_social like'%$buscar%' or
                                c.producto like'%$buscar%' or
                        p.cuando like'%$buscar%'
                order by cuando desc
                limit $porpagina";
               // echo $sql;exit;
                $query = $this->db->query($sql);
                $query = $query->result();
                return $query;
                
                $query=$this->db
                ->select("p.cuando,p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->like('upper(p.codigo)', strtoupper($buscar), 'both')
                ->or_like('upper(p.nombre)', strtoupper($buscar), 'both')
                ->or_like('upper(p.cuando)', strtoupper($buscar), 'both')
               // ->group_by("p.codigo")
                ->order_by("p.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
//                echo $this->db->last_query();
                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->like('upper(p.codigo)', strtoupper($buscar), 'both')
                ->or_like('upper(p.nombre)', strtoupper($buscar), 'both')
                ->or_like('upper(p.cuando)', strtoupper($buscar), 'both')
               // ->group_by("p.codigo")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getProductosSearchPaginacion_anterior($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("p.cuando,p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->like('upper(p.codigo)', strtoupper($buscar), 'both')
                ->or_like('upper(p.nombre)', strtoupper($buscar), 'both')
                ->or_like('upper(p.cuando)', strtoupper($buscar), 'both')
               // ->group_by("p.codigo")
                ->order_by("p.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
//                echo $this->db->last_query();
                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->like('upper(p.codigo)', strtoupper($buscar), 'both')
                ->or_like('upper(p.nombre)', strtoupper($buscar), 'both')
                ->or_like('upper(p.cuando)', strtoupper($buscar), 'both')
               // ->group_by("p.codigo")
                ->count_all_results();
                return $query;
            break;
        }
    }
    
    public function getProductosDatosExtras($x)
    {
         $query=$this->db
                ->select("co.precio_migrado,co.ot_migrada,co.producto as nombre_producto,oc.id,oc.id_cotizacion,oc.precio,o.producto_id,p.codigo,oc.fecha,co.cantidad_1")
                ->from("orden_de_produccion o")
                ->join("cotizaciones_orden_de_compra oc","o.id_cotizacion = oc.id_cotizacion","inner")
                ->join("productos p","p.id = o.producto_id","inner")
                ->join("cotizaciones co","co.id = oc.id_cotizacion","left")
                ->like("p.codigo",$x,"both")
                ->get();
              //  echo $this->db->last_query();exit();
                return $query->result();
    }
    
    public function getProductosDatosExtras2($x)
    {
         $query=$this->db
               // ->select("h.precio,c.id_cliente,c.id,c.ot_migrada,c.ot_antigua,c.precio_migrado,c.producto,c.cantidad_1,c.fecha,c.cantidad_1,cl.razon_social")
                ->select("c.precio_migrado,oc.id as ot,c.ot_migrada,c.producto as nombre_producto,h.valor_empresa as precio,c.id_cliente,c.id,c.ot_migrada,c.ot_antigua,c.producto,c.cantidad_1,c.fecha,c.cantidad_1,cl.razon_social")
                ->from("cotizaciones c")
                ->join("cotizaciones_orden_de_compra oc","c.id = oc.id_cotizacion","left")
                ->join("clientes cl","cl.id = c.id_cliente","left")
                ->join("hoja_de_costos_datos h","h.id_cotizacion = c.id","left")
                ->like("c.id",$x,"both")
                ->get();
               // echo $this->db->last_query();exit();
                return $query->result();
    }
    
    public function getProductos()
    {
         $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->get();
                //echo $this->db->last_query();
                return $query->result();
    }
    public function getProductosPorCliente($id)
    {
         $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->like('p.codigo', $id, 'both')
                ->get();
//                echo $this->db->last_query();
                return $query->result();
    }
    public function getProductosPorCotizacion($id)
    {
         $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->like('p.id_cotizacion', $id, 'both')
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }    
    public function getProductosPorId($id)
    {
         $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->where(array('p.id'=>$id))
                ->get();
//                echo $this->db->last_query();
//                exit;
                return $query->row();
    }
	 public function getTiposProducto()
    {
         $query=$this->db
                ->select("id,productos_tipo,letra")
                ->from("productos_tipo")
                ->get();
                //echo $this->db->last_query();
                return $query->result();
    }
   public function insertar($data=array())
    {
        $this->db->insert("productos",$data);
        return $this->db->insert_id();
     
        
    }
    
    public function update($data=array(),$id)
    {
//        exit("hola");
         $this->db->where('id', $id);
         $this->db->update("productos",$data);
//                echo $this->db->last_query();
         
        return true;
    }    
	
	  public function getProductosPorNombre($nombre)
    {
         $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->where(array('p.nombre'=>$nombre))
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }
	
	 public function getProductosPorGenericos($id)
    {
         $query=$this->db
                ->select("p.id,p.id_cotizacion,p.codigo,p.nombre")
                ->from("productos as p")
				->where(array('p.tipo'=>2))
				->order_by("p.id","desc")
                ->get();
//                echo $this->db->last_query();
                return $query->result();
    }
	 public function getProductosPorCliente2($id)
    {
         $query=$this->db
                ->select("count(*),max(productos.id) as id,max(productos.id_cotizacion) as id_cotizacion,max(productos.codigo) as codigo,productos.nombre,productos.tipo,cotizaciones.condicion_del_producto,cotizaciones.numero_molde")
                ->from("productos as productos")
                ->join("cotizaciones as cotizaciones","cotizaciones.id=productos.id_cotizacion","inner")
		->where(array('cotizaciones.id_cliente'=>$id , 'productos.tipo'=>1))
                ->group_by("productos.nombre")
                ->order_by("productos.id_cotizacion","desc")
//			    ->limit(10)
                ->get();
  //           echo $this->db->last_query();
                return $query->result();
    }
    
    public function getFilaProductosPorCliente($id)
    {
         $query=$this->db
                ->select("p.id,p.id_cotizacion,ct.id_cliente,cl.razon_social")
                ->from("productos as p")
                ->join("cotizaciones ct","ct.id=p.id_cotizacion","inner")
                ->join("clientes cl","cl.id=ct.id_cliente","inner")                 
                ->like('p.id', $id, 'both')
                ->get();
//             echo $this->db->last_query();
         
                return $query->row();
    }  
    
    public function getFilaEmisionOrdenProductos($id)
    {
         $query=$this->db
                ->select("op.id, op.id_cotizacion")
                ->from("productos as p")
                ->join("orden_de_produccion op","p.id=op.producto_id","inner")
                ->like('op.producto_id', $id, 'both')
                ->get();
//             echo $this->db->last_query();
                return $query->row();
    }     
    
    public function getProductosPorClienteVista($id)
    {
         $query=$this->db
                ->distinct()
                ->select("*")
                ->from("productos_clientes as p")
                ->where(array('p.id'=>$id))
                ->get();
//                echo $this->db->last_query();
//                exit;
                return $query->result();
    }    
    
    public function getProductosPorClienteRow($id)
    {
         $query=$this->db
                ->distinct()
                ->select("p.id, p.codigo,p.nombre,p.tipo,pt.productos_tipo")
                ->from("productos as p")
                ->join("productos_tipo pt","pt.id=p.tipo","inner")
                ->like('p.codigo', $id, 'both')
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }   
    
    
    public function getProductosPorClienteCotizacionRow($id)
    {
         $query=$this->db
                ->distinct()
                ->select("p.id_cotizacion")
                ->from("productos as p")
                ->like('p.codigo', $id, 'both')
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }    
    
    public function getProductosPorClienteVistaRow($id_producto)
    {
         $query=$this->db
                ->distinct()
                ->select("p.razon_social")
                ->from("productos_clientes as p")
                ->like('p.codigo_prod_antiguo', $id_producto, 'both')
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }      
    
    public function getProductos_Genericos_ClientesVista($id)
    {
         $query=$this->db
                ->distinct()
                ->select("*")
                ->from("productos_genericos_clientes as p")
                ->where(array('p.id'=>$id))
                ->get();
//                echo $this->db->last_query();
//                exit;
                return $query->result();
    }    
    public function getProductoporCodigoMigracion($id)
    {
         $query=$this->db
                ->select("id,id_cotizacion,codigo,nombre,tipo")
                ->from("productos")
                ->like('codigo', $id, 'both')
                ->get();
//                echo $this->db->last_query();
                return $query->row();
    }    
	
	
}