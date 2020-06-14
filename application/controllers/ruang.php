<?php
    class Ruang extends CI_Controller{
        function __construct(){
            parent:: __construct();
            $this->load->model('m_ruang');

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
            $data["judul"] = "RUANG";
            $data["content"] = "v_ruang";
            $data["data"] = $this->m_ruang->showAll();
    
            $this->load->view('default', $data);
        }

        function add(){
            $data["judul"] = "TAMBAH TAMBAH RUANG";
            $data["content"] = "v_ruang_add";
    
            $this->load->view('default', $data);
        }

        function add_execute(){
            $submit = $this->input->post('submit_ruang');
            $kode_ruang = $this->input->post('kode_ruang');
            $nama_ruang = $this->input->post('nama_ruang');
            $keterangan = $this->input->post('keterangan');

            if(isset($submit)){
                $cek = $this->db->query("
                    SELECT * FROM ruang WHERE kode_ruang = '".$kode_ruang."';
                ");
                if($cek->num_rows() > 0){
                    $cek_row = $cek->row_array();
                    $kode_ruang = $cek_row["kode_ruang"];
                    $nama_ruang = $cek_row["nama_ruang"];

                    $this->alert(
                        'Peringatan!! - Kode ruang : '.$kode_ruang.'. Sudah Terdaftar, Dengan Nama ruang : '.$nama_ruang.'',
                        'alert-warning',
                        'ruang/add'
                    );
                }else{
                    $data = [
                        "id_ruang" => NULL,
                        "kode_ruang" => $kode_ruang,
                        "nama_ruang" => $nama_ruang,
                        "keterangan" => $keterangan
                    ];

                    $insert = $this->db->insert("ruang", $data);
                    if($this->db->affected_rows() > 0){
                        $this->alert(
                            'Data ruang Kode : '.$kode_ruang.'. Berhasil Ditambahkan',
                            'alert-success',
                            'ruang'
                        );
                    }else{
                        $this->alert(
                            'Data ruang Kode : '.$kode_ruang.'. Gagal Ditambahkan',
                            'alert-danger',
                            'ruang/add'
                        );
                    }
                }
            }else{
                show_404();
            }
        }

        function update($id_ruang){
            $cek = $this->m_ruang->cekID($id_ruang);
            if($cek->num_rows() > 0){
                $data['row'] = $cek->row_array();
                $data['judul'] = "EDIT ruang BARANG";
                $data['content'] = "v_ruang_update";
                
                $this->load->view('default', $data);
            }else{
                show_404();
            }
        }

        function update_execute(){
            $submit = $this->input->post('submit_ruang');
            $id_ruang = $this->input->post('id_ruang');
            $kode_ruang = $this->input->post('kode_ruang');
            $nama_ruang = $this->input->post('nama_ruang');
            $keterangan = $this->input->post('keterangan');

            if(isset($submit)){
                $cek = $this->db->query("
                    SELECT * FROM ruang WHERE kode_ruang = '".$kode_ruang."';
                ");
                if($cek->num_rows() == 0){
                    show_404();
                }else{
                    $data = [
                        "nama_ruang" => $nama_ruang,
                        "keterangan" => $keterangan
                    ];
//Query
                    $this->db->where("kode_ruang", $kode_ruang);
                    $update = $this->db->update("ruang", $data);
//Cek masuk tidak             
                    if($this->db->affected_rows() > 0){
                        $this->alert(
                            'Data ruang Kode : '.$kode_ruang.'. Berhasil Diperbaharui',
                            'alert-success',
                            'ruang/update/'.$id_ruang
                        );
                    }else{
                        $this->alert(
                            'Data ruang Kode : '.$kode_ruang.'. Gagal Diperbaharui',
                            'alert-danger',
                            'ruang/update/'.$id_ruang
                        );
                    }
                }
            }else{
                show_404();
            }
        }

        function hapus($id_ruang){
            $check = $this->db->query("SELECT * FROM ruang WHERE id_ruang = ".$id_ruang."");

            if($check->num_rows()>0){
                $this->db->where("id_ruang", $id_ruang);
                $result = $this->db->delete("ruang");

                if($result){
                    echo '<script>
                        alert("Data Berhasil Dihapus !");
                        window.location = "'.site_url('ruang').'"                
                    </script>'; 
                }else{
                    echo '<script>
                        alert("Data Gagal Dihapus !");
                        window.location = "'.site_url('ruang').'"                
                    </script>';
                }
            }else{
                show_404();
            }

        }
    }


?>
