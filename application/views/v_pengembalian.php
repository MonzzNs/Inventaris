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
?> 
<form action="<?php echo base_url(); ?>index.php/pengembalian/cari" method="post">
				<div class="input-group ">
				  <input type="text" class="form-control" placeholder="Cari Data Barang.." name="keyword" id="keyword" autocomplete="off">
				  <div class="input-group-append">
				    <button class="btn btn-primary" style="width:120px" type="submit" id="tombolCari">Cari</button>
				  </div>
				</div>
</form>
<br>
<div id="view">
<table class="table table-striped table-bordered">
  <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>TANGGAL PINJAM</th>
        <th>TANGGAL KEMBALI</th>
        <th>STATUS</th>
        <th>JUMLAH</th>
        <th>PEGAWAI</th>
        <th>ACTION</th>
  </tr>
  <?php
    $no=1;        
    foreach($data->result() as $r) {
        echo 
            '<tr>
                <td>'.$no.'</td>
                <td>'.$r->nama.'</td>
                <td>'.$r->tanggal_pinjam.'</td>
                <td>'.$r->tanggal_kembali.'</td>
                <td>'.$r->status_peminjaman.'</td>
                <td>'.$r->jumlah_pinjam.'</td>
                <td>'.$r->nama_pegawai.'</td>
                <td>
                    '.anchor('pengembalian/execute/'.$r->id_peminjaman.'/'.$r->jumlah_pinjam.'/'.$r->jumlah.'/'.$r->id_inventaris.'','Kembalikan Barang','class="btn btn-secondary" onclick="return konfirmasi2();"').'
            </tr>'
        ;
        $no++;
    }
  ?>
</table>
</div>
<script src="<?php echo base_url(); ?>assets/js/config.js"></script>
<script>
    var baseurl = "<?php echo base_url("index.php/"); ?>";
</script>
