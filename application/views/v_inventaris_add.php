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

    echo form_open('inventaris/add_execute');

    echo '
        <div class="form-group">
            <label for="email">Nama Barang:</label>
            '.form_input('nama', '', 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Kondisi:</label>
            '.form_input('kondisi', '', 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Jumlah:</label>
            '.form_input('jumlah', '', 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Ruang:</label>
            '.form_dropdown('ruang', $ruang, '', 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Jenis:</label>
            '.form_dropdown('jenis', $jenis, '', 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo '
        <div class="form-group">
            <label for="email">Keterangan</label>
            '.form_textarea('keterangan', '', 'class="form-control" placeholder="...." required').'
        </div>
    ';
    echo form_submit('submit_inventaris', 'Simpan', 'class="btn btn-primary"');
    echo anchor('inventaris', 'Kembali', 'class="btn btn-secondary"');


    echo form_close();
?>  