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

    echo form_open('jenis/update_execute');

    echo '
        <div class="form-group">
            <label for="email">Kode Jenis:</label>
            '.form_input('kode_jenis', $row["kode_jenis"], 'class="form-control" required readonly').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Nama Jenis:</label>
            '.form_input('nama_jenis', $row["nama_jenis"], 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Keterangan</label>
            '.form_textarea('keterangan', $row["keterangan"], 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo form_hidden('id_jenis', $row["id_jenis"]);
    echo form_submit('submit_jenis', 'Perbaharui', 'class="btn btn-primary"');
    echo anchor('jenis', 'Kembali', 'class="btn btn-secondary"');

    echo form_close();
    
?>