<?php
    class Dashboard extends CI_Controller{
        function __construct(){
            parent:: __construct();
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
            $data["judul"] = "Dashboard";
            $data["content"] = "v_dashboard";

            $this->load->view('default', $data);
        }
    }


?>