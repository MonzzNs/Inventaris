<?php
  if ($this->session->userdata('alert_error') != NULL) {
    $alert_error = $this->session->userdata('alert_error');
    $alert_error_type = $this->session->userdata('alert_error_type');

    echo '
        <div class="alert '.$alert_error_type.' "role="alert">
         '.$alert_error.'
        </div>
    ';

    $this->session->unset_userdata('alert_error');
    $this->session->unset_userdata('alert_error_type');
}
	echo form_open('inventaris/edit_execute');

	echo '
		<div class="form-group">
			<label for="nama">Nama Inventaris</label>
			'. form_input('nama', $result["nama"], 'class="form-control" placeholder="..." required') .'
		</div>
	';
	
	
	echo '
		<div class="form-group">
			<label for="kondisi">Kondisi</label>
			'. form_input('kondisi', $result["kondisi"], 'class="form-control" placeholder="..." required') .'
		</div>
	';
	
	echo '
		<div class="form-group">
			<label for="keterangan">Keterangan</label>
			'. form_textarea('keterangan', $result["keterangan"], 'class="form-control" placeholder="..." required') .'
		</div>
	';
	
	echo '
		<div class="form-group">
			<label for="jumlah">Jumlah</label>
			'. form_input('jumlah', $result["jumlah"], 'class="form-control" placeholder="..." required') .'
		</div>
	';

	// $jenis = [];
	echo '
		<div class="form-group">
			<label for="jenis">Jenis</label>
			'. form_dropdown('jenis', $jenis, $result["id_jenis"], 'class="form-control" placeholder="..." required') .'
		</div>
	';
	
	// $ruang = [];
	echo '
		<div class="form-group">
			<label for="ruang">Ruang</label>
			'. form_dropdown('ruang', $ruang, $result["id_ruang"], 'class="form-control" placeholder="..." required') .'
		</div>
	';
	
	echo form_hidden("id_inventaris", $result["id_inventaris"]);
	echo form_submit('submit_inventaris', 'Perbaharui', 'class="btn btn-primary"');
	echo anchor('inventaris', 'Kembali', 'class="btn btn-default"');

	echo form_close();
?>