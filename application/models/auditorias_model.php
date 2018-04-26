<?php

class auditorias_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getAuditoriasPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("*")
                ->from("auditoria as a")
                ->join("cotizaciones as c","c.id=a.id_cotizacion","inner")
                ->order_by("a.id_cotizacion","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
              ->select("*")
                ->from("auditoria as a")
                ->join("cotizaciones as c","c.id=a.id_cotizacion","inner")
                ->order_by("a.id_cotizacion","desc")
                ->limit($porpagina,$pagina)
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
    
	public function getAuditorias()
	{
	  $this->load->database();
                $query=$this->db
                ->select("*")
                ->from("auditoria")
                ->order_by("id_transaccion","asc")
                ->get();
                return $query;
	}
	
         public function insertarAuditoria($data=array())
    {
         $this->db->insert("auditoria",$data);
        // $this->db->last_query();exit;
        return true;
        
        }
        public function getAuditoriasPorIdCotizacion($id)
	{
	  $this->load->database();
                $query=$this->db
                ->select("*")
                ->from("auditoria a")
                ->where(array("a.id_cotizacion"=>$id))
                ->order_by("id_transaccion","desc")
                ->limit(1)
                ->get();
                 //echo $this->db->last_query();//exit;
                return $query->row();
	}
}