<?php

class Despachos_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getDespachosPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("despacho d")
                ->order_by("d.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
              ->select("*")
                ->from("despacho as d")
                ->count_all_results();
                return $query;
            break;
        }
    }
    
    public function getAcabadosSearchPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.quien,a.cuando,a.costo_compra")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->like('upper(a.caracteristicas)', strtoupper($buscar), 'both')
                ->or_like('upper(a.codigo)', strtoupper($buscar), 'both')
                ->order_by("a.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
//                echo $this->db->last_query();
                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.quien,a.cuando,a.costo_compra")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->like('upper(a.caracteristicas)', strtoupper($buscar), 'both')
                ->or_like('upper(a.codigo)', strtoupper($buscar), 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }    
    
	public function getDespachos()
	{
	 // $this->load->database();
  
        
                $query=$this->db
                ->select("*")
                ->from("despacho")
                ->order_by("id","asc")
                ->get();
                return $query;
	}

    public function getDespachosPorId($id)
    {
          $query=$this->db
                ->select("*")
                ->from("despacho as d")
                ->where(array("d.id_nodo"=>$id))
                ->get();
         // echo $this->db->last_query();exit;
                return $query->result();
    }
    
    public function getDespachosUltimoRegistro($id)
    {
          $query=$this->db
                ->select("*")
                ->from("despacho as d")
                ->where(array("d.id_nodo"=>$id))
                ->order_by("id","desc")
                ->limit(1)
                ->get();
         // echo $this->db->last_query();exit;
                return $query->row();
    }
    
    
     public function insertar($data=array())
    {
         $this->db->insert("despacho",$data);
        return true;
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("despacho",$data);
        return true;
    }
    
    public function delete($id)
    {
	   try{
	   
			$this->db->where('id', $id);
			$this->db->delete('despacho');
		}
		catch(Exception $e)
		{
			return false;
		}
        return true;
    }
}