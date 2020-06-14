<?php
    class Pengembalian extends CI_Controller{
        function __construct(){
            parent:: __construct();

            $this->load->model('m_pengembalian');
            if($this->session->userdata('login') != TRUE){
                echo"
                    <script>
                        alert('Login Dulu !');
                        window.location = '".site_url('login')."';
                    </script>
                ";
            }
        }

        function alert($alert, $alert_type, $url=NULL){
            $this->session->set_userdata('alert_error', $alert);
            $this->session->set_userdata('alert_error_type', $alert_type);
        
            if(!empty($url)){redirect($url);}
        }

        function index(){
            $data["judul"] = "PENGEMBALIAN BARANG";
            $data["content"] = "v_pengembalian";
            $data["data"] = $this->m_pengembalian->view();
            $this->load->view('default', $data);
        }

        function cari(){
            $keyword = $this->input->post('keyword');

            $data['judul'] = 'PENGEMBALIAN BARANG';
            $data["content"] = "v_pengembalian";
            $data['data']  = $this->m_pengembalian->cariData($keyword);

            $this->load->view('default', $data);
        }

        function execute($id){
            $in = $this->uri->segment(6);
            $j1 = $this->uri->segment(5);
            $j2 = $this->uri->segment(4);

            $stok = (int)$j1;
            $jmlP = (int)$j2;

            $totalStok = $stok + $jmlP;
            $tambahStok = $this->m_pengembalian->cekStok($in, $totalStok);

            $data = ['status_peminjaman' => 'Dikembalikan',
                    'tanggal_kembali' => date('Y-m-d')];

            $this->db->where('id_peminjaman', $id);
            $this->db->update('peminjaman', $data);

            if($this->db->affected_rows() > 0){
                $this->alert(
                    'Data Barang Berhasil Dikembalikan',
                    'alert-success',
                    'pengembalian'
                );
            }else{
                $this->alert(
                    'Data Barang Gagal Dikembalikan',
                    'alert-danger',
                    'pengembalian'
                );
            }    
        
        }
    }
?>
