<?php 
    class Peminjaman extends CI_Controller{
        function __construct(){
            parent:: __construct();
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

        function alert($alert, $alert_type, $url=NULL){
            $this->session->set_userdata('alert_error', $alert);
            $this->session->set_userdata('alert_error_type', $alert_type);
        
            if(!empty($url)){redirect($url);}
        }

        function index(){
            $data["judul"] = "PEMINJAMAN BARANG";
            $data["content"] = "v_peminjaman";
            $data["data"] = $this->m_peminjaman->showAll();
    
            $this->load->view('default', $data);
        }

        function add(){
            $data["judul"] = "FORM PINJAM BARANG";
            $data['content'] = "v_pinjam_add";
            $data["data"] = $this->m_peminjaman->barang();
            $data["data2"] = $this->m_peminjaman->pegawai();

            $this->load->view('default', $data);
        }

        function add_execute(){
            $submit = $this->input->post('submit');
            $tanggal = $this->input->post('tanggal');
            $barang = $this->input->post('barang');
            $jumlah = $this->input->post('jumlah');
            $pegawai = $this->input->post('pegawai');

            $cekJumlah = $this->m_peminjaman->cekJumlah($barang);
            foreach($cekJumlah as $cek){
                $jumlah2 =  $cek->jumlah;
            }
            $int = (int)$jumlah2;
            if($jumlah > $int){
                $this->alert(
                    'Jumlah Barang Melebihi Stok !, Stok Barang: '.$jumlah2.'',
                    'alert-danger',
                    'peminjaman/add'
                );
            }else{
                $hasilStok = $int - $jumlah;
                $this->m_peminjaman->decreaseStok($hasilStok, $barang);
                if(isset($submit)){
                    $data = [
                        "id_peminjaman" => NULL,
                        "tanggal_pinjam" => $tanggal,
                        "status_peminjaman" => "Dipinjam",
                        "id_pegawai" => $pegawai,
                        "jumlah_pinjam" => $jumlah,
                        "id_inventaris" => $barang
                    ];
    
                        $insert = $this->db->insert("peminjaman", $data);
                        if($this->db->affected_rows() > 0){
                            $this->alert(
                                'Data Peminjaman Berhasil Ditambahkan',
                                'alert-success',
                                'peminjaman/add'
                            );
                        }else{
                            $this->alert(
                                'Data Peminjaman Gagal Ditambahkan',
                                'alert-danger',
                                'peminjaman/add'
                            );
                        }    
                }else{
                    show_404();
                }
            }
        }

        function edit($id){
            $data["judul"] = "Edit Data Inventaris";
			$data["content"] = "v_pinjam_edit";
			
			$data["result"] = $this->m_peminjaman->getPeminjaman($id);
						
			$this->load->view("default", $data);
        }

        function edit_execute(){
            $submit = $this->input->post('submit');
            $tanggal = $this->input->post('tanggal');
            $jumlah = $this->input->post('jumlah');
            $jumlahAwal = $this->input->post('jumlahA');
            $stok = $this->input->post('stok');
            $barang = $this->input->post('id_inventaris');
            $id = $this->input->post('id');

            $jumlah2 = (int)$jumlahAwal;
            $stok2 = (int)$stok;
            $total = $jumlah2 + $stok2;

            
            $jumlahInt = (int)$jumlah;
            if($jumlahInt > $total){
                $this->alert(
                    'Jumlah Barang Melebihi Stok !, Stok Barang: '.$total.'',
                    'alert-danger',
                    'peminjaman/edit/'.$id.''
                );
            }else{
                $hasilStok = $total - $jumlahInt;
                $this->m_peminjaman->decreaseStok($hasilStok, $barang);
                if(isset($submit)){
                    $data = [
                        "tanggal_pinjam" => $tanggal,
                        "jumlah_pinjam" => $jumlah,
                    ];
                        $where = $this->db->where('id_peminjaman', $id);
                        $insert = $this->db->update("peminjaman", $data);
                        if($this->db->affected_rows() > 0){
                            $this->alert(
                                'Data Peminjaman Berhasil Diubah',
                                'alert-success',
                                'peminjaman/add'
                            );
                        }else{
                            $this->alert(
                                'Data Peminjaman Gagal Diubah',
                                'alert-danger',
                                'peminjaman/add'
                            );
                        }    
                }else{
                    show_404();
                }

            }
            
        }

        function hapus($id){
            $check = $this->db->query("
                SELECT * FROM peminjaman WHERE id_peminjaman = '". $id ."';
            ");
            $check2 = $this->db->SELECT('*')
                               ->FROM('peminjaman')
                               ->WHERE('id_peminjaman', $id)
                               ->WHERE('status_peminjaman', 'Dikembalikan')
                               ->GET();
    
            if($check->num_rows() > 0){
                
                if($check2->num_rows() > 0){
                    $this->db->where("id_peminjaman", $id);
                    $result = $this->db->delete("peminjaman");
                    if($result){
                            echo '<script>
                        alert("Data berhasil dihapus !");
                        window.location = "'.site_url('peminjaman').'";
                        </script>';
                    }else{
                            echo '<script>
                        alert("Data gagal dihapus !");
                        window.location = "'.site_url('peminjaman').'";
                        </script>';
                    }
                }else{
                    echo '<script>
                        alert("Barang Harus Berstatus DIKEMBALIKAN Untuk Dapat Dihapus !");
                        window.location = "'.site_url('peminjaman').'";
                        </script>';
                }   
    
            }else{
                show_404();
            }
        }

    }

?>
