<?php

class monotapas_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
 public function getMonotapasPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_tapa,codigo,nombre,onda,gramaje_onda,gramaje_liner,liner,gramaje,id_tapa_2,precio,estado,quien,cuando")
                ->from("materiales_monotapas")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
             $query=$this->db
                ->select("id,codigo,nombre,onda,gramaje_onda,liner,gramaje_liner")
                ->from("materiales_monotapas")
                ->count_all_results();
                return $query;
            break;
        }
    }
    
    public function getMonotapasSelect()
    {
        $query=$this->db
                ->select("id,id_tapa,codigo,nombre,onda,gramaje_onda,gramaje_liner,liner,gramaje,id_tapa_2,precio,estado")
                ->from("materiales_monotapas")
                ->where(array("estado"=>1))
                ->order_by("nombre","asc")
                ->get();
                return $query->result();
    }
   
    public function getMonotapaPorNombre($id)
    {
        $query=$this->db
                ->select("id,id_tapa,codigo,nombre,onda,gramaje_onda,gramaje_liner,liner,gramaje,id_tapa_2,precio,estado")
                ->from("materiales_monotapas")
                ->where(array("nombre"=>$id))
                ->get();
                return $query->row();
    }
    public function getMonotapaPorId($id)
    {
        $query=$this->db
                ->select("id,id_tapa,codigo,nombre,onda,gramaje_onda,gramaje_liner,liner,gramaje,id_tapa_2,precio,estado")
                ->from("materiales_monotapas")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();
    }
    
     public function insertar($data=array())
    {
         $this->db->insert("materiales_monotapas",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("materiales_monotapas",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('materiales_monotapas');
        return true;
    }
     public function getMaterialesTipoPapel()
    {
         $query=$this->db
                ->select("id,materiales_tipo_papel")
                ->from("materiales_tipo_papel")
                ->get();
                return $query->result();
    }
    
   
}