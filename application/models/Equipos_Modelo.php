<?php

class Equipos_Modelo extends CI_Model
{
    
    public function obtener($idEquipo)
    {
        $this->db->or_where_in('id_equipo', $idEquipo);
        return $this->db->get('equipos_por_reporte')->row();
    }
    
    public function obtenerPorReporte(string $idReporte)
    {
        $this->db->or_where_in('id_reporte', $idReporte);
        return $this->db->get('equipos_por_reporte')->result();
    }
    
    public function agregar($descripcionDeEquipo)
    {
        $this->db->insert('equipos_por_reporte', $descripcionDeEquipo);
        $idEquipo = $this->db->insert_id();
        
        if (!empty($this->db->error()['code'])) {
            return ['error' => $this->db->error()];
        }
        
        return $this->obtener($idEquipo);
    }
    
    public function eliminar($idEquipo)
    {
        $equipo = $this->obtener($idEquipo);
        
        $this->db->or_where_in('id_equipo', $idEquipo);
        $this->db->delete('equipos_por_reporte');

        if (!empty($this->db->error()['code'])) {
            return ['error' => $this->db->error()];
        }
        
        return $equipo;
    }
}