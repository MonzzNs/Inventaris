<?php
    class M_pengembalian extends CI_Model{

        public function view(){
            $this->db->select('*');
            $this->db->from('peminjaman');
            $this->db->join('inventaris', 'inventaris.id_inventaris = peminjaman.id_inventaris');
            $this->db->join('pegawai', 'pegawai.id_pegawai = peminjaman.id_pegawai');
            $this->db->where('status_peminjaman', 'Dipinjam');
            
            // $this->db->get();
            return $this->db->get(); // Tampilkan semua data
        }

        function cariData($keyword){
            $this->db->select('*');
            $this->db->from('peminjaman');
            $this->db->join('inventaris', 'inventaris.id_inventaris = peminjaman.id_inventaris');
            $this->db->join('pegawai', 'pegawai.id_pegawai = peminjaman.id_pegawai');
            $this->db->like('nama', $keyword);
            $this->db->or_like('nama_pegawai', $keyword);
            $this->db->or_like('tanggal_pinjam', $keyword);
            $this->db->or_like('tanggal_kembali', $keyword);
            $this->db->or_like('jumlah', $keyword);
            $this->db->where('status_peminjaman', 'Dipinjam');
            
            $result = $this->db->get();
            
            return $result; 
        }

        function cekStok($in, $totalStok){
            $data = ['jumlah' => $totalStok];

            $this->db->where('id_inventaris', $in);
            $update = $this->db->update('inventaris', $data);
        }
          
    }
?>
