<?php

class proveedores_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
  
        
    public function getProcesosEspeciales()
    {
        $query=$this->db->query("select * from procesosespeciales order by nombre_procesp asc");
                return $query->result();
    }
 
 public function getProveedoresPaginacionPorSearch($pagina,$porpagina,$quehago,$valor)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("p.id,p.nombre,p.telefono,p.correo,r.rubro,ru.rubro as rubro2,p.fecha_creacion,p.contacto,p.rut,p.banco")
                ->from("proveedores p")
                ->join("rubros r","p.rubro=r.id",'left')
                ->join("rubros ru","p.rubro2=ru.id",'left')
                ->like('p.nombre', $valor, 'both')
                ->or_like('r.rubro', $valor, 'both')
                ->or_like('ru.rubro', $valor, 'both')
                ->or_like('p.rut', $valor, 'both')
                ->or_like('p.banco', $valor, 'both')
                ->or_like('p.correo', $valor, 'both')
                ->order_by("p.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
//                echo $this->db->last_query();exit;
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("p.id,p.nombre,p.telefono,p.correo,r.rubro,ru.rubro as rubro2,p.fecha_creacion,p.contacto,p.rut,p.banco")
                ->from("proveedores p")
                ->join("rubros r","p.rubro=r.id",'left')
                ->join("rubros ru","p.rubro2=ru.id",'left')
                ->like('p.nombre', $valor, 'both')
                ->or_like('r.rubro', $valor, 'both')
                ->or_like('ru.rubro', $valor, 'both')
                ->or_like('p.rut', $valor, 'both')
                ->or_like('p.correo', $valor, 'both')
                ->or_like('p.banco', $valor, 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }   
    
 public function getProveedoresPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("p.id,p.nombre,p.telefono,p.correo,r.rubro,ru.rubro as rubro2,p.fecha_creacion,p.contacto,p.rut,p.banco")
                ->from("proveedores p")
                ->join("rubros r","p.rubro=r.id",'left')
                ->join("rubros ru","p.rubro2=ru.id",'left')
                ->order_by("p.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
		//		echo $this->db->last_query();
				
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
               ->select("p.id,p.nombre,p.telefono,p.correo,r.rubro,p.fecha_creacion,p.contacto,p.rut,p.banco")
                 ->from("proveedores p")
                ->join("rubros r","p.rubro=r.id",'left')
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getProveedores()
    {
        $query=$this->db
                ->select("id,nombre,telefono,correo,rubro,rubro2,direccion,horario,fecha_creacion,contacto,rut,banco")
                ->from("proveedores")
                ->order_by("id","desc")
                ->get();
                return $query->result();
                //echo $this->db->last_query();exit();
    }
    public function getProveedoresPorRubro($rubro)
    {
        $query=$this->db
                ->select("id,nombre,telefono,correo,rubro,fecha_creacion,contacto,rut,banco")
                ->from("proveedores")
                ->where(array("rubro"=>$rubro))
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    public function getProveedoresPorId($id)
    {
          $query=$this->db
                ->select("rut,id,nombre,telefono,correo,rubro,rubro2,fecha_creacion,contacto,id_forma_pago,num_cuenta,tipo_cuenta,razon_social,titular_cuenta,direccion,horario,banco")
                ->from("proveedores")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();
    }
    
    public function getProveedoresTodoPorId($id)
    {
          $query=$this->db
                ->select("p.rut,p.id,p.nombre,p.telefono,p.correo,p.rubro,p.fecha_creacion,f.forma_pago,p.contacto,p.id_forma_pago,p.num_cuenta,p.tipo_cuenta,p.razon_social,p.titular_cuenta,p.banco")
                ->from("proveedores p")
                ->join("formas_pago f","p.id_forma_pago=f.id",'left')
                ->where(array("p.id"=>$id))
                ->get();
                return $query->row();
    }
    public function getProveedoresPorNombreClave($id)
    {
          $query=$this->db
                ->select("p.rut,p.id,p.nombre,p.telefono,p.correo,p.rubro,p.fecha_creacion,f.forma_pago,p.contacto,p.id_forma_pago,p.num_cuenta,p.tipo_cuenta,p.razon_social,p.titular_cuenta,p.banco")
                ->from("proveedores p")
                ->join("formas_pago f","p.id_forma_pago=f.id",'left')
                ->where("p.nombre like'%$id%'")
                ->get();
     //     echo $this->db->last_query();
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
    
    public function getProveedores2()
    {
        $query=$this->db
                ->select("id,nombre,telefono,correo,rubro,fecha_creacion,contacto,rut")
                ->from("proveedores")
                ->order_by("id","desc")
                ->get();
                return $query->row();
    }    
    
}