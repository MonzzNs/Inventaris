<?php
    class M_ruang extends CI_Model{
        function showAll(){
            $result = $this->db->query("SELECT * FROM ruang ORDER BY id_ruang DESC;");
            return $result;
        }
        function cekID($id_ruang){
            $result = $this->db->query("
                SELECT * FROM ruang WHERE id_ruang = '".$id_ruang."'
            ");
    
            return $result;
        }
    
    }

?>