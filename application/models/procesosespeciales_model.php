<?php

class procesosespeciales_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
        
    public function getProcesosEspeciales()
    {
        $query=$this->db->query("select * from procesosespeciales order by nombre_procesp asc");
                return $query;
    }
    
 public function getProveedoresPaginacion($pagina,$porpagina,$quehago)
    {
//         switch($quehago)
//        {
//            case 'limit':
//                $query=$this->db
//                ->select("id,nombre,telefono,correo,rubro,fecha_creacion,contacto")
//                ->from("proveedores")
//                ->order_by("id","desc")
//                ->limit($porpagina,$pagina)
//                ->get();
//                return $query->result();
//            break;
//            case 'cuantos':
//              $query=$this->db
//               ->select("id,nombre,telefono,correo,rubro,fecha_creacion")
//                ->from("proveedores")
//                ->count_all_results();
//                return $query;
//            break;
//        }
      switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.quien,a.cuando,a.costo_compra")
                ->from("procesosespeciales as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->order_by("a.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
              ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc")
                ->from("procesosespeciales as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getProveedores()
    {
        $query=$this->db
                ->select("id,nombre,telefono,correo,rubro,fecha_creacion,contacto")
                ->from("proveedores")
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    public function getProveedoresPorId($id)
    {
          $query=$this->db
                ->select("id,nombre,telefono,correo,rubro,fecha_creacion,contacto")
                ->from("proveedores")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();
    }
    public function getDetalleProcesosPorId($id)
    {
          $query=$this->db
                ->select("p.*,a.nombre AS proveedor_nombre_1,s.nombre AS proveedor_nombre_2,u.unidades_de_venta as unv")
                ->from("acabados2 p")
                ->join("unidades_de_venta u","p.unidad_de_venta = u.id","left")
                ->join("proveedores a","a.id = p.proveedor_1","left")
                ->join("proveedores s","s.id = p.proveedor_2","left")
                ->where(array("p.id"=>$id))
                ->get();
                //echo $this->db->last_query();
                return $query->row();
    }
    
     public function insertar($data=array())
    {
         $this->db->insert("proveedores",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("proveedores",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('proveedores');
        return true;
    }
    
    public function getProcesosEspecialesCotizacion()
    {
         $query=$this->db
                ->select("*")
                ->from("acabados2")
                ->where(array('procesos_especiales'=>1))
                ->get();
                 //echo $this->db->last_query();exit;
                return $query->result();
    }    
    
    
   
}