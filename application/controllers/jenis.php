<?php
    class Jenis extends CI_Controller{
        function __construct(){
            parent:: __construct();
            $this->load->model('m_jenis');

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
            $data["judul"] = "JENIS BARANG";
            $data["content"] = "v_jenis";
            $data["data"] = $this->m_jenis->showAll();
    
            $this->load->view('default', $data);
        }

        function add(){
            $data["judul"] = "TAMBAH JENIS BARANG";
            $data["content"] = "v_jenis_add";
    
            $this->load->view('default', $data);
        }

        function add_execute(){
            $submit = $this->input->post('submit_jenis');
            $kode_jenis = $this->input->post('kode_jenis');
            $nama_jenis = $this->input->post('nama_jenis');
            $keterangan = $this->input->post('keterangan');

            if(isset($submit)){
                $cek = $this->db->query("
                    SELECT * FROM jenis WHERE kode_jenis = '".$kode_jenis."';
                ");
                if($cek->num_rows() > 0){
                    $cek_row = $cek->row_array();
                    $kode_jenis = $cek_row["kode_jenis"];
                    $nama_jenis = $cek_row["nama_jenis"];

                    $this->alert(
                        'Peringatan!! - Kode Jenis : '.$kode_jenis.'. Sudah Terdaftar, Dengan Nama Jenis : '.$nama_jenis.'',
                        'alert-warning',
                        'jenis'
                    );
                }else{
                    $data = [
                        "id_jenis" => NULL,
                        "kode_jenis" => $kode_jenis,
                        "nama_jenis" => $nama_jenis,
                        "keterangan" => $keterangan
                    ];

                    $insert = $this->db->insert("jenis", $data);
                    if($this->db->affected_rows() > 0){
                        $this->alert(
                            'Data Jenis Kode : '.$kode_jenis.'. Berhasil Ditambahkan',
                            'alert-success',
                            'jenis/add'
                        );
                    }else{
                        $this->alert(
                            'Data Jenis Kode : '.$kode_jenis.'. Gagal Ditambahkan',
                            'alert-danger',
                            'jenis/add'
                        );
                    }
                }
            }else{
                show_404();
            }
        }

        function update_execute(){
            $submit = $this->input->post('submit_jenis');
            $id_jenis = $this->input->post('id_jenis');
            $kode_jenis = $this->input->post('kode_jenis');
            $nama_jenis = $this->input->post('nama_jenis');
            $keterangan = $this->input->post('keterangan');

            if(isset($submit)){
                $cek = $this->db->query("
                    SELECT * FROM jenis WHERE kode_jenis = '".$kode_jenis."';
                ");
                if($cek->num_rows() == 0){
                    show_404();
                }else{
                    $data = [
                        "nama_jenis" => $nama_jenis,
                        "keterangan" => $keterangan
                    ];
//Query
                    $this->db->where("kode_jenis", $kode_jenis);
                    $update = $this->db->update("jenis", $data);
//Cek masuk tidak             
                    if($this->db->affected_rows() > 0){
                        $this->alert(
                            'Data Jenis Kode : '.$kode_jenis.'. Berhasil Diperbaharui',
                            'alert-success',
                            'jenis/update/'.$id_jenis
                        );
                    }else{
                        $this->alert(
                            'Data Jenis Kode : '.$kode_jenis.'. Gagal Diperbaharui',
                            'alert-danger',
                            'jenis/update/'.$id_jenis
                        );
                    }
                }
            }else{
                show_404();
            }
        }

        function update($id_jenis){
            $cek = $this->m_jenis->cekID($id_jenis);
            if($cek->num_rows() > 0){
                $data['row'] = $cek->row_array();
                $data['judul'] = "EDIT JENIS BARANG";
                $data['content'] = "v_jenis_update";
                
                $this->load->view('default', $data);
            }else{
                show_404();
            }
        }

        function hapus($id_jenis){
            $check = $this->db->query("SELECT * FROM jenis WHERE id_jenis = ".$id_jenis."");

            if($check->num_rows()>0){
                $this->db->where("id_jenis", $id_jenis);
                $result = $this->db->delete("jenis");

                if($result){
                    echo '<script>
                        alert("Data Berhasil Dihapus !");
                        window.location = "'.site_url('jenis').'"                
                    </script>'; 
                }else{
                    echo '<script>
                        alert("Data Gagal Dihapus !");
                        window.location = "'.site_url('jenis').'"                
                    </script>';
                }
            }else{
                show_404();
            }

        }
    
    }
?>
