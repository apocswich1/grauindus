<?php

class productos_asociados_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
 public function getProductosAsociadosPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_cliente,nombre,descripcion")
                ->from("cientes_productos_asociados")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
               ->select("id")
                ->from("cientes_productos_asociados")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getProductosAsociados()
    {
        $query=$this->db
                ->select("id,id_cliente,nombre,descripcion")
                ->from("cientes_productos_asociados")
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    public function getProductosAsociadosPorId($id)
    {
          $query=$this->db
                ->select("id,id_cliente,nombre,descripcion")
                ->from("cientes_productos_asociados")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();
    }
     public function getProductosAsociadosPorCliente($id_cliente)
    {
          $query=$this->db
                ->select("id,id_cliente,nombre,descripcion")
                ->from("cientes_productos_asociados")
                ->where(array("id_cliente"=>$id_cliente))
                ->get();
                return $query->result();
    }
     public function insertar($data=array())
    {
         $this->db->insert("cientes_productos_asociados",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("cientes_productos_asociados",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('cientes_productos_asociados');
        return true;
    }
   
}