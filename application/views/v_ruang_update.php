<?php
    if($this->session->userdata('alert_error') != NULL){
        $alert_error = $this->session->userdata('alert_error');
        $alert_error_type = $this->session->userdata('alert_error_type');

        echo '
            <div class="alert '.$alert_error_type.'" role="alert">
                '.$alert_error.'
            </div>
        ';

        $this->session->unset_userdata('alert_error');
        $this->session->unset_userdata('alert_error_type');
    }

    echo form_open('ruang/update_execute');

    echo '
        <div class="form-group">
            <label for="email">Kode ruang:</label>
            '.form_input('kode_ruang', $row["kode_ruang"], 'class="form-control" required readonly').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Nama ruang:</label>
            '.form_input('nama_ruang', $row["nama_ruang"], 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Keterangan</label>
            '.form_textarea('keterangan', $row["keterangan"], 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo form_hidden('id_ruang', $row["id_ruang"]);
    echo form_submit('submit_ruang', 'Perbaharui', 'class="btn btn-primary"');
    echo anchor('ruang', 'Kembali', 'class="btn btn-secondary"');

    echo form_close();
    
?>