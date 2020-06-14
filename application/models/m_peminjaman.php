<?php
    class M_peminjaman extends CI_Model{
        function showAll(){
            $result = $this->db->query('SELECT * FROM peminjaman
                                        JOIN inventaris ON inventaris.id_inventaris = peminjaman.id_inventaris
                                        JOIN pegawai ON pegawai.id_pegawai = peminjaman.id_pegawai');

            return $result;
        }

        function barang(){
            $result = $this->db->query('SELECT * FROM inventaris');

            return $result->result();
        }

        function pegawai(){
            $result = $this->db->query('SELECT * FROM pegawai');

            return $result->result();
        }

        function cekJumlah($barang){
            $result = $this->db->query('SELECT jumlah FROM inventaris
                                        WHERE id_inventaris = '.$barang.'');
            return $result->result();
        }

        function decreaseStok($hasilStok, $barang){
            $data = ['jumlah' => $hasilStok];

            $this->db->where('id_inventaris', $barang);
            $update = $this->db->update('inventaris', $data);
        }

        function getPeminjaman($id){
            $result = $this->db->SELECT('*')
                               ->FROM('peminjaman')
                               ->JOIN('inventaris' , 'inventaris.id_inventaris = peminjaman.id_inventaris')
                               ->JOIN('pegawai' , 'pegawai.id_pegawai = peminjaman.id_pegawai')
                               ->WHERE('peminjaman.id_peminjaman' , $id)
                               ->GET();        
            return $result->row_array();
        }

        function laporan($tglAwal, $tglAkhir){
            // $this->db->where("tanggal_register >=", $tglAwal);
            // $this->db->where("tanggal_register <=", $tglAkhir);

            $result = $this->db->SELECT('*')
                               ->FROM('peminjaman')
                               ->JOIN('inventaris' , 'inventaris.id_inventaris = peminjaman.id_inventaris')
                               ->JOIN('pegawai' , 'pegawai.id_pegawai = peminjaman.id_pegawai')
                               ->WHERE('tanggal_pinjam >=', $tglAwal)
                               ->WHERE('tanggal_pinjam <=', $tglAkhir)
                               ->GET();
            return $result;
        }
    }
?>