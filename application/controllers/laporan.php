<?php
    Class Laporan extends CI_Controller{
        function __construct(){
            parent:: __construct();
            $this->load->model('m_inventaris');
            $this->load->model('m_peminjaman');
            if($this->session->userdata('login') != TRUE){
                echo"
                    <script>
                        alert('Login Dulu !');
                        window.location = '".site_url('login')."';
                    </script>
                ";
            }
        }

        function index(){
            $data["judul"] = "LAPORAN BARANG";
            $data["content"] = "v_laporan";
    
            $this->load->view('default', $data);
        }

        function pdfInventaris(){
            $mpdf = new \Mpdf\Mpdf();

            $tglAwal = $this->input->post('awal');
            $tglAkhir = $this->input->post('akhir');

            $data['data'] = $this->m_inventaris->laporan($tglAwal, $tglAkhir);
            $result = $this->load->view('laporan_inventaris',$data,true);

            $mpdf->WriteHTML($result);
            $mpdf->Output();
        }

        function pdfPeminjaman(){
            $mpdf = new \Mpdf\Mpdf();

            $tglAwal = $this->input->post('awal');
            $tglAkhir = $this->input->post('akhir');

            $data['data'] = $this->m_peminjaman->laporan($tglAwal, $tglAkhir);
            $result = $this->load->view('v_laporan_pinjam',$data,true);

            $mpdf->WriteHTML($result);
            $mpdf->Output();
        }
    }
?>