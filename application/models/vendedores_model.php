<?php

class vendedores_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getVendedoresPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("c.id,c.rut,c.nombre,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.situacion_laboral,c.fecha_ingreso,c.comision,c.estado,r.region,ci.nombre as ciudad,co.nombre as comuna")
                ->from("vendedores as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                ->order_by("c.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("c.id")
                ->from("vendedores as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                ->count_all_results();
                return $query;
            break;
        }
    }
    
    public function getVendedoresSelect()
    {
         $query=$this->db
                ->select("c.id,c.rut,c.nombre,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.situacion_laboral,c.fecha_ingreso,c.comision,c.estado,r.region,ci.nombre as ciudad,co.nombre as comuna")
                ->from("vendedores as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                ->order_by("c.id","desc")
                ->get();
                return $query->result();
    }
    
    public function getVendedorPorId($id)
    {
          $query=$this->db
                ->select("c.id,c.rut,c.nombre,c.id_region,c.id_ciudad,c.id_comuna,c.direccion,c.correo,c.telefono,c.celular,c.situacion_laboral,c.fecha_ingreso,c.comision,c.estado,r.region,ci.nombre as ciudad,co.nombre as comuna,id_vendedor")
                ->from("vendedores as c")
                ->join("region as r","c.id_region=r.id","inner")
                ->join("ciudades as ci","c.id_ciudad=ci.id","inner")
                ->join("comuna as co","c.id_comuna=co.id","inner")
                ->where(array("c.id"=>$id))
                ->get();
                return $query->row();
    }
    
    public function getNombreVendedorPorId($id)
    {
          $query=$this->db
                ->select("c.id,c.rut,c.nombre")
                ->from("vendedores as c")
                ->where(array("c.id"=>$id))
                ->get();
                return $query->row();
    }
   
     public function insertar($data=array())
    {
         $this->db->insert("vendedores",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("vendedores",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('vendedores');
        return true;
    }
    
    
}