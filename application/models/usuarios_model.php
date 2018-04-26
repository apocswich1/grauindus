<?php

class usuarios_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
    public function getUsuarios()
    {
        $query=$this->db
        ->select("u.id,u.nombre,u.correo,u.rut,u.pass,u.telefono,u.id_cargo,u.id_perfil,p.perfil,c.cargo,u.fecha_ingreso")
        ->from("usuarios as u")
        ->join("perfiles as p","p.id =u.id_perfil","inner")
        ->join("cargos as c","c.id =u.id_cargo","inner")
        ->order_by("id", "desc")
        ->get();
        //echo $this->db->last_query();exit;
        return $query->result(); 
    }
     public function getVendedores()
    {
        $query=$this->db
        ->select("u.id,u.nombre,u.correo,u.rut,u.pass,u.telefono,u.id_cargo,u.id_perfil,p.perfil,c.cargo,u.fecha_ingreso")
        ->from("usuarios as u")
        ->join("perfiles as p","p.id =u.id_perfil","inner")
        ->join("cargos as c","c.id =u.id_cargo","inner")
        ->where(array("id_cargo"=>"2"))
        ->order_by("id", "desc")
        ->get();
        //echo $this->db->last_query();exit;
        return $query->result(); 
    }
    public function getAdministradores()
    {
        $query=$this->db
        ->select("u.id,u.nombre,u.correo,u.rut,u.pass,u.telefono,u.id_cargo,u.id_perfil,p.perfil,c.cargo,u.fecha_ingreso")
        ->from("usuarios as u")
        ->join("perfiles as p","p.id =u.id_perfil","inner")
        ->join("cargos as c","c.id =u.id_cargo","inner")
        ->where(array("id_perfil"=>"1"))
        ->order_by("id", "desc")
        ->get();
        //echo $this->db->last_query();exit;
        return $query->result(); 
    }
    public function getUsuariosPorTipo($tipo)
    {
        $query=$this->db
        ->select("u.id,u.nombre,u.correo,u.rut,u.pass,u.telefono,u.id_cargo,u.id_perfil,p.perfil,c.cargo,u.fecha_ingreso")
        ->from("usuarios as u")
        ->join("perfiles as p","p.id =u.id_perfil","inner")
        ->join("cargos as c","c.id =u.id_cargo","inner")
        ->where(array("id_perfil"=>$tipo))
        ->order_by("id", "desc")
        ->get();
        //echo $this->db->last_query();exit;
        return $query->result(); 
    }
    public function getPerfiles()
    {
        $query=$this->db
        ->select("id,perfil")
        ->from("perfiles")
        ->get();
        //echo $this->db->last_query();exit;
        return $query->result(); 
    }
     public function getCargos()
    {
        $query=$this->db
        ->select("id,cargo")
        ->from("cargos")
        ->get();
        //echo $this->db->last_query();exit;
        return $query->result(); 
    }
	public function logueo($rut,$pass)
    {
        $query=$this->db
        ->select("id,nombre,correo,rut,pass,telefono,id_cargo,id_perfil,fecha_ingreso")
        ->from("usuarios")
        ->where(array("rut"=>$rut,"pass"=>$pass))
         ->get();
        //echo $this->db->last_query();exit;
        return $query->row(); 
    }
    public function getUsuariosPorId($id)
    {
        $where=array("id"=>$id);
        $query=$this->db
        ->select("id,nombre,correo,rut,pass,telefono,id_cargo,id_perfil,fecha_ingreso")
        ->from("usuarios")
        ->where($where)
        ->get();
        //echo $this->db->last_query()."<br>";
        return $query->row();
    }
   
    public function insertar($data=array())
    {
         $this->db->insert("usuarios",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("usuarios",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('usuarios');
        return true;
    }
}