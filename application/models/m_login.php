<?php
    class M_login extends CI_Model{
        function checkUser($user){
            $id = $this->db->SELECT('*')
                           ->FROM('petugas')
                           ->WHERE('username',$user)
                           ->GET();
            return $id;
        }

        function checkPass($pass){
            $id = $this->db->SELECT('*')
                           ->FROM('petugas')
                           ->WHERE('password',MD5($pass))
                           ->GET();
            return $id;
        }
    }
?>