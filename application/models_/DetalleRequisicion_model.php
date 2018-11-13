<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class DetalleRequisicion_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function nuevo_registro($articulo,$medida,$cantidad,$proyecto,$comentarios,$folio,$id_requisicion)
	{
		
		$data = array(
			'articulo'			=>	$articulo,
			'medida'			=>	$medida,
			'cantidad'			=>  $cantidad,
			'proyecto'			=>  $proyecto,
			'comentarios'		=>  $comentarios,
			'folio'				=>  $folio,
			'requesicion_id' 	=>  $id_requisicion			
		);

		if($this->db->insert('detalle_requisicion',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function borrar_registros_previos($idre){

		$this->db->where('requesicion_id', $idre);
   		$this->db->delete('detalle_requisicion');
   		return $this->db->affected_rows(); 			
	}
}