<?php

class insumos_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
 
    public function getInsumosPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,codigo,material,caracteristicas,unidad_de_compra,unidad_de_venta,precio1,precio2,proveedor_1,proveedor_2,proveedor_3,quien,cuando")
                ->from("insumos")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id")
                ->from("insumos")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getInsumosPorId($id)
    {
         $query=$this->db
                ->select("i.id,i.codigo,i.material,i.caracteristicas,i.unidad_de_compra,i.unidad_de_venta,i.precio1,i.precio2,i.proveedor_1,i.proveedor_2,i.proveedor_3,u.unidad_uso as unidad,i.fecha_ultima_actualizacion")
                ->from("insumos as i")
                ->join("unidades_de_uso as u","u.id=i.unidad_de_compra","inner")
                ->where(array("i.id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
     public function insertar($data=array())
    {
         $this->db->insert("insumos",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("insumos",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('insumos');
        return true;
    }
   
   
}