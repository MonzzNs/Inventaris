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

    echo form_open('ruang/add_execute');

    echo '
        <div class="form-group">
            <label for="email">Kode ruang:</label>
            '.form_input('kode_ruang', '', 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Nama ruang:</label>
            '.form_input('nama_ruang', '', 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Keterangan</label>
            '.form_textarea('keterangan', '', 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo form_submit('submit_ruang', 'Simpan', 'class="btn btn-primary"');
    echo anchor('ruang', 'Kembali', 'class="btn btn-secondary"');


    echo form_close();
?>