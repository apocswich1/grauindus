<?php

class adhesivos_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getAdhesivosPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,nombre,codigo,proveedor1,proveedor2,precio,fecha_compra,estado")
                ->from("adhesivos")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
              ->select("id")
                ->from("adhesivos")
                ->count_all_results();
                return $query;
            break;
        }
    }
    

    public function getAdhesivos()
    {
        $this->load->database();
  
        
                $query=$this->db
                ->select("id,nombre,codigo,proveedor1,proveedor2,precio,fecha_compra,estado")
                ->from("adhesivos")
                ->where(array("estado"=>"0"))
                ->order_by("id","desc")
                ->get();
                return $query->result();
        
    }

    public function getAdhesivosPorId($id)
    {
          $query=$this->db
                ->select("id,nombre,codigo,proveedor1,proveedor2,precio,fecha_compra")
                ->from("adhesivos")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    
       
     public function insertar($data=array())
    {
       //  array $datos = ("nombre_procesp"->$data['proceso']);
 
     //  $this->db->query("insert into procesosespeciales(nombre_procesp) values($data)");
         $this->db->insert("adhesivos",$data);
        return true;
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("adhesivos",$data);
        return true;
    }
    
    public function delete($id)
    {
	   try{
	   
			$this->db->where('id', $id);
			$this->db->delete('adhesivos');
		}
		catch(Exception $e)
		{
			return false;
		}
        return true;
    }
   
}