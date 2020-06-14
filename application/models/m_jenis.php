<?php
    class M_jenis extends CI_Model{
        function showAll(){
            $result = $this->db->query("SELECT * FROM jenis ORDER BY id_jenis DESC;");
            return $result;
        }
        function cekID($id_jenis){
            $result = $this->db->query("
                SELECT * FROM jenis WHERE id_jenis = '".$id_jenis."'
            ");
    
            return $result;
        }
    
    }

?>