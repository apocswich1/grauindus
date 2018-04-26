<?php

class procesos_especiales_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
        
   public function getProcesosEspecialesPaginacion($pagina,$porpagina,$quehago)
    {
//         switch($quehago)
//        {
//            case 'limit':
//                $query=$this->db
//                ->select("a.id_procesp,a.nombre_procesp,a.ancho,a.largo,a.tipo,a.precio, pro.nombre as proveedor")
//                ->from("procesosespeciales as a")
//                ->join("proveedores as pro","pro.id=a.id_proveedores","inner")
//                ->order_by("a.id_procesp","desc")
//                ->limit($porpagina,$pagina)
//                ->get();
//                return $query->result();
//            break;
//            case 'cuantos':
//              $query=$this->db
//                ->select("a.id_procesp,a.nombre_procesp,a.ancho,a.largo,a.tipo,a.precio, pro.nombre as proveedor")
//                ->from("procesosespeciales as a")
//                ->join("proveedores as pro","pro.id=a.id_proveedores","inner")
//                ->order_by("a.id_procesp","desc")
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
  
    public function getProcesosEspecialesEdit($id)
    {
        $this->load->database();

                $query=$this->db
                ->select("*")
                ->from("procesosespeciales")
                ->where(array("id_procesp"=>$id))                        
                ->get();
//				echo $this->db->last_query();exit;
                return $query->row();
        
    }    

    public function getProcesosEspeciales()
    {
        $this->load->database();

                $query=$this->db
                ->select("*")
                ->from("procesosespeciales")
                ->order_by("nombre_procesp","asc")
                ->get();
                return $query;
        
    }

    public function getProcesosEspecialesPorId($id)
    {
//        exit($id);
          $query=$this->db
                ->select("nombre_procesp")
                ->from("procesosespeciales")
                ->where(array("id_procesp"=>$id))
                ->get();
// 				echo $this->db->last_query();exit;
                return $query->row();
    }
    
     public function insertar($data=array())
    {
       //  array $datos = ("nombre_procesp"->$data['proceso']);
 
     //  $this->db->query("insert into procesosespeciales(nombre_procesp) values($data)");
         $this->db->insert("procesosespeciales",$data);
        return true;
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id_procesp', $id);
         $this->db->update("procesosespeciales",$data);
        return true;
    }
    
    public function delete($id)
    {
        $this->db->where('id_procesp', $id);
        $this->db->delete('procesosespeciales');
        return true;
    }
   
}
