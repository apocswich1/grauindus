<?php

class piezas_adicionales_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
        
    public function getPiezasAdicionalesPorLive($valor)
    {
           $query=$this->db
                ->select("id,piezas_adicionales,unidad_de_venta,unidad_de_compra,unidad_de_conversion,calculo_ingenieria,valor_venta,valor_compra")
                ->from("piezas_adicionales")
               ->like('piezas_adicionales', $valor, 'both')
                ->get();
                return $query->row();
    }
    
    public function getValorPiezasPorNombre($nombre)
    {
          $query=$this->db
                ->select("u.unidades_de_venta AS unv,a.valor_venta")
                ->from("piezas_adicionales as a")
                ->join("unidades_de_venta as u","u.id=a.unidad_de_venta","inner")                
                ->where("a.piezas_adicionales LIKE'%$nombre%'")
                ->get();
           //echo $this->db->last_query();exit;
                return $query->row();
    }
           
   public function getPiezasAdicionales()
    {
         $query=$this->db
                ->select("id,piezas_adicionales,unidad_de_venta,fecha_modificacion,id_user,unidad_de_compra,unidad_de_conversion,calculo_ingenieria,valor_venta,valor_compra,id_proveedor1,id_proveedor2")
                ->from("piezas_adicionales")
                ->order_by("id","desc")
                ->get();
                return $query->result();
    }
    
    
    public function getPiezasAdicionalesPorId($id)
    {
           $query=$this->db
                ->select("id,piezas_adicionales,unidad_de_venta,fecha_modificacion,id_user,unidad_de_compra,unidad_de_conversion,calculo_ingenieria,valor_venta,valor_compra,id_proveedor1,id_proveedor2")
                ->from("piezas_adicionales")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();
    }
   
   
   public function getPiezasAdicionalesPorNombre($id)
    {
           $query=$this->db
                ->select("id,piezas_adicionales,unidad_de_venta,unidad_de_compra,unidad_de_conversion,calculo_ingenieria,valor_venta,valor_compra")
                ->from("piezas_adicionales")
                ->where(array("piezas_adicionales"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }
    

   public function getPiezasAdicionalesPorNombreHojaCosto($id)
    {
           $query=$this->db
                ->select("a.id,piezas_adicionales,a.unidad_de_venta,a.unidad_de_compra,a.unidad_de_conversion,a.calculo_ingenieria,a.valor_venta,a.valor_compra,uv.unidad_uso as unv,uc.unidad_uso as unc")
                ->from("piezas_adicionales as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")                   
                ->where(array("piezas_adicionales"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }    
    
    public function getPiezasAdicionalesPorLive2($valor)
    {
           $query=$this->db
                ->select("id,piezas_adicionales,unidad_de_venta,unidad_de_compra,unidad_de_conversion,calculo_ingenieria,valor_venta,valor_compra,id_proveedor1,id_proveedor2")
                ->from("piezas_adicionales")
               ->like('piezas_adicionales', $valor, 'both')
                ->get();
                return $query->row();
    }    

    
     public function insertar($data=array())
    {
         $this->db->insert("piezas_adicionales",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("piezas_adicionales",$data);
        return true;
    }
    
     public function insertar_ordenes($data=array())
    {
         $this->db->insert("ordenes_compras_piezas_adicionales",$data);
        return true;
        
    }
    public function update_ordenes($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("ordenes_compras_piezas_adicionales",$data);
        return true;
    }

    
    public function getPiezasAdicionalesOrdenCompra($id)
    {
           $query=$this->db
                ->select("*")
                ->from("ordenes_compras_piezas_adicionales")
                ->where(array("id_cotizacion"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
           
                return $query->row();
    }    
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('piezas_adicionales');
        return true;
    }

    public function getPiezasAdicionalesOrdenCompraPorProveedores($id)
    {
           $query=$this->db
                ->select("*")
                ->from("ordenes_compras_piezas_adicionales")
                ->where(array("id_cotizacion"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }      
    
    
    public function getUnidadesUsoPieza($id)
    {
           $query=$this->db
                ->select("uv.unidad_uso as unv")
                ->from("piezas_adicionales as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")                   
                ->where(array("piezas_adicionales"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                $array=$query->row();
                return $array->unv;
    }   
    
   public function getPiezasAdicionalesPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,piezas_adicionales,unidad_de_venta,fecha_modificacion,id_user,unidad_de_compra,unidad_de_conversion,calculo_ingenieria,valor_venta,valor_compra,id_proveedor1,id_proveedor2")
                ->from("piezas_adicionales")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id,piezas_adicionales,unidad_de_venta,fecha_modificacion,id_user,unidad_de_compra,unidad_de_conversion,calculo_ingenieria,valor_venta,valor_compra,id_proveedor1,id_proveedor2")
                ->from("piezas_adicionales")
                ->order_by("id","desc")
                ->count_all_results();
                return $query;
            break;
        }
    }    
    
    public function getPiezasAdicionalesSearchPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,piezas_adicionales,unidad_de_venta,fecha_modificacion,id_user,unidad_de_compra,unidad_de_conversion,calculo_ingenieria,valor_venta,valor_compra,id_proveedor1,id_proveedor2")
                ->from("piezas_adicionales")
                ->like('upper(piezas_adicionales)', strtoupper($buscar), 'both')
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
//                echo $this->db->last_query();
                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id,piezas_adicionales,unidad_de_venta,fecha_modificacion,id_user,unidad_de_compra,unidad_de_conversion,calculo_ingenieria,valor_venta,valor_compra,id_proveedor1,id_proveedor2")
                ->from("piezas_adicionales")
                ->like('upper(piezas_adicionales)', strtoupper($buscar), 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }    
    
//    public function getPiezasAdicionalesOrdenCompraPorProveedores($id,$id_proveedor)
//    {
//        $sql = "select * from ordenes_compras_piezas_adicionales where id_cotizacion=".$id." and (id_proveedor1=".$id_proveedor." or id_proveedor2=".$id_proveedor." or id_proveedor3=".$id_proveedor.")";
//        $query=$this->db->query($sql);
////  
////        return $query;
//                //echo $this->db->last_query();exit;
//                return $query->row();   
//    }    
    
}