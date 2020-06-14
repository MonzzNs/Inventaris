<?php
    class Inventaris extends CI_Controller{
        function __construct(){
            parent:: __construct();
            $this->load->model('m_inventaris');

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
            $data["judul"] = "INVENTARIS BARANG";
            $data["content"] = "v_inventaris";
            $data["data"] = $this->m_inventaris->showAll();
    
            $this->load->view('default', $data);
        }

        function add(){
            $data["judul"] = "TAMBAH INVENTARIS BARANG";
            $data["content"] = "v_inventaris_add";
            $data["jenis"] = $this->m_inventaris->dropdownJenis();
            $data["ruang"] = $this->m_inventaris->dropdownRuang();
    
            $this->load->view('default', $data);
        }
    
        function add_execute(){
            $submit = $this->input->post('submit_inventaris');
            $nama = $this->input->post('nama');
            $kondisi = $this->input->post('kondisi');
            $jumlah = $this->input->post('jumlah');
            $keterangan = $this->input->post('keterangan');
            $petugas = $this->session->userdata('id_petugas');

            $jenis = $this->input->post('jenis');
            $ruang = $this->input->post('ruang');

            if(isset($submit)){
                $kode_jenis = $this->m_inventaris->idJenis($jenis);
                $kode_ruang = $this->m_inventaris->idRuang($ruang);
                $lastId = $this->m_inventaris->lastId();

                $kode_inventaris = date("ymd")."-".$kode_jenis."-".$kode_ruang."-".$lastId;

                $data = [
                    "id_inventaris" => NULL,
                    "nama" => $nama,
                    "kondisi" => $kondisi,
                    "keterangan" => $keterangan,
                    "jumlah" => $jumlah,
                    "id_jenis" => $jenis,
                    "id_ruang" => $ruang,
                    "tanggal_register" => date("Y-m-d H:i:s"),
                    "kode_inventaris" => $kode_inventaris,
                    "id_petugas" => $petugas
                ];

                    $insert = $this->db->insert("inventaris", $data);
                    if($this->db->affected_rows() > 0){
                        $this->alert(
                            'Data Inventaris Kode : '.$kode_inventaris.'. Berhasil Ditambahkan',
                            'alert-success',
                            'inventaris'
                        );
                    }else{
                        $this->alert(
                            'Data Inventaris Kode : '.$kode_inventaris.'. Gagal Ditambahkan',
                            'alert-danger',
                            'inventaris/add'
                        );
                    }
                
            }else{
                show_404();
            }
        }

        function edit($id){
            $data["judul"] = "Edit Data Inventaris";
			$data["content"] = "v_inventaris_edit";
			
			$data["result"] = $this->m_inventaris->getInventaris($id);
			
			$data["jenis"] = $this->m_inventaris->dropdownJenis();
			$data["ruang"] = $this->m_inventaris->dropdownRuang();
			
			$this->load->view("default", $data);
        }

        function edit_execute(){
            $submit = $this->input->post("submit_inventaris");
			$nama = $this->input->post("nama");
			$kondisi = $this->input->post("kondisi");
			$keterangan = $this->input->post("keterangan");
			$jumlah = $this->input->post("jumlah");
			
			$id_inventaris = $this->input->post("id_inventaris");
			
			$jenis = $this->input->post("jenis");
			$ruang = $this->input->post("ruang");
			
			if( isset($submit) ) {
				$kode_jenis = $this->m_inventaris->idJenis($jenis);
				$kode_ruang = $this->m_inventaris->idRuang($ruang);
				$last_id = $this->m_inventaris->lastId();
				
				$kode_inventaris = 
					date("ymd")."-".$kode_jenis."-".$kode_ruang."-".$last_id;
				
				$data = [
                    "nama" => $nama,
                    "kondisi" => $kondisi,
                    "keterangan" => $keterangan,
					"jumlah" => $jumlah,
					"id_jenis" => $jenis,
					"id_ruang" => $ruang,
					"tanggal_register" => date("Y-m-d H:i:s"),
					"kode_inventaris" => $kode_inventaris,
					"id_petugas" => NULL
                ];
				$this->db->where("id_inventaris", $id_inventaris);
                $update = $this->db->update("inventaris", $data);

                if( $this->db->affected_rows() > 0 ) {
                    $this->alert(
                        'Data Inventaris Kode : '. $kode_inventaris .' Berhasil Ditambahkan',
                        'alert-success',
                        'inventaris/edit/' . $id_inventaris
                    );
                }else {
                    $this->alert(
                        'Data Inventaris Kode : '. $kode_inventaris .' Gagal Ditambahkan',
                        'alert-danger',
                        'inventaris/index'
                    );
                }
			}else{
				show_404();
			}
        }

        function hapus($id_inventaris){
	

            $check = $this->db->query("
            SELECT * FROM inventaris WHERE id_inventaris = '". $id_inventaris ."';
    
            ");
    
            if($check->num_rows() > 0){
    
            $this->db->where("id_inventaris", $id_inventaris);
            $result = $this->db->delete("inventaris");
            if($result){
                    echo '<script>
                alert("Data berhasil dihapus !");
                window.location = "'.site_url('inventaris').'";
                </script>';
            }else{
                    echo '<script>
                alert("Data gagal dihapus !");
                window.location = "'.site_url('inventaris').'";
                </script>';
            }
    
            }else{
                show_404();
            }
        }
    }
?>
