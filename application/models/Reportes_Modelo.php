<?php
class Reportes_Modelo extends CI_Model {
    
    public function totalDeRegistros()
    {
        return $this->db->query(
            "select * from reportes_de_proyectos"
         )->result();
    }
    
    public function obtener($idReporte) {
        $this->db->or_where_in('id_reporte', $idReporte);
        return $this->db->get('reportes_de_proyectos')->row();
    }
    
    public function agregar($reporte)
    {
        $identificadores = [];
        
        $this->db->insert('reportes_de_proyectos', $reporte);
        $idReporte = $this->db->insert_id();
        
        if (!empty($this->db->error()->code)) {
            return ['error' => $this->db->error()];
        }
        
        return $this->obtener($idReporte);
    }
        
    public function eliminar($idReporte)
    {
        $reportePorEliminar = $this->obtener($idReporte);
        
        $this->db->or_where_in('id_reporte', $idReporte);
        $this->db->delete('reportes_de_proyectos');
        
        return $reportePorEliminar;
    }
}