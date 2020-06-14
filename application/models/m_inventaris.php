<?php
    class M_inventaris extends CI_Model{
        function showAll(){
            $result = $this->db->query(
                "SELECT * FROM inventaris
                JOIN jenis ON inventaris.id_jenis = jenis.id_jenis
                JOIN ruang ON inventaris.id_ruang = ruang.id_ruang
                ORDER BY id_inventaris DESC;"
            );
            return $result;
        }

        function dropdownJenis(){
            $query = $this->db->get("jenis");

            $data = [];
            foreach($query->result() as $row){
                $data[$row->id_jenis] = $row->nama_jenis;
            }
            return $data;
        }

        function dropdownRuang(){
            $query = $this->db->get("ruang");

            $data = [];
            foreach($query->result() as $row){
                $data[$row->id_ruang] = $row->nama_ruang;
            }
            return $data;
        }

        function idJenis($jenis){
            $this->db->where("id_jenis", $jenis);
             $result = $this->db->get("jenis");

             return $result->row()->kode_jenis;
        }

        function idRuang($ruang){
            $this->db->where("id_ruang", $ruang);
            $result = $this->db->get("ruang");

            return $result->row()->kode_ruang;
        }

        function lastId() {
            $query = $this->db->query("
               SELECT * FROM inventaris ORDER BY id_inventaris DESC LIMIT 1;
            ");
            return $query->row()->id_inventaris;
        }

        function getInventaris($id){
            $this->db->where("id_inventaris", $id);
            $result = $this->db->get("inventaris");
            return $result->row_array();
        
        }

        function cekID($id){
            $result = $this->db->query("
            SELECT * FROM inventaris
            WHERE id_inventaris = '".$id."';
            ");
            return $result;
        }

        function laporan($tglAwal, $tglAkhir){
            // $this->db->where("tanggal_register >=", $tglAwal);
            // $this->db->where("tanggal_register <=", $tglAkhir);

            $result = $this->db->SELECT('*')
                               ->FROM('inventaris')
                               ->JOIN('jenis', 'inventaris.id_jenis = jenis.id_jenis')
                               ->JOIN('ruang', 'inventaris.id_ruang = ruang.id_ruang')
                               ->WHERE('tanggal_register >=', $tglAwal)
                               ->WHERE('tanggal_register <=', $tglAkhir)
                               ->GET();
            return $result;
        }

    }
?>