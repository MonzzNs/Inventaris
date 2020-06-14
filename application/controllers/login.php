<?php
    class Login extends CI_Controller{
        function __construct(){
            parent:: __construct();
            $this->load->model('m_login');

        }

        function index(){
            if($this->session->userdata('login') == TRUE){
                echo"
                    <script>
                        alert('Anda Sudah Login!');
                        window.location = '".site_url('dashboard')."';
                    </script>
                ";
            }else{
                $this->load->view('v_login');
            }
        }

        function execute(){
            $user = $this->input->post('username');
            $pass = $this->input->post('password');

            $checkUser = $this->m_login->checkUser($user);
            $checkPass = $this->m_login->checkPass($pass);
            if($checkUser->num_rows() < 1){
                echo"
                    <script>
                        alert('Username Tidak Ditemukan');
                        window.history.back();
                    </script>
                ";
            }elseif($checkPass->num_rows() < 1){
                echo"
                    <script>
                        alert('Password Yang Anda Masukkan Salah');
                        window.history.back();
                    </script>
                ";
            }else{
                $row = $checkUser->row_array();

                $this->session->set_userdata("id_level", $row['id_level']);
                $this->session->set_userdata("nama", $row['nama_petugas']);
                $this->session->set_userdata("id_petugas", $row['id_petugas']);
                $this->session->set_userdata("login", TRUE);

                echo"
                    <script>
                        alert('Login Berhasil');
                        window.location = '".site_url('dashboard')."';
                    </script>
                ";
            }
        }

        function destroy(){
            $this->session->sess_destroy();
            echo"
            <script>
                alert('Berhasil LogOut');
                window.location = '".site_url('login')."';
            </script>
            ";

        }
    }
?>