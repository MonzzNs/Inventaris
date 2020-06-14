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
<form method="post" action="<?= base_url()?>index.php/peminjaman/edit_execute">
    <label>Tanggal</label>
      <input type="date" name="tanggal" id="tglAwal" class="form-control" value="<?= set_value('tanggal_pinjam', date('Y-m-d', strtotime($result['tanggal_pinjam']))); set_value('tanggal_pinjam');?>" required>
    <label>Barang</label>
      <input type="text" name="barang" id="tglAwal" class="form-control" value="<?= $result['nama']?>" required readonly>        
    <label>Pegawai</label>
      <input type="text" name="pegawai" id="tglAwal" class="form-control" value="<?= $result['nama_pegawai']?>" required readonly>
    <label>jumlah</label>
      <input type="number" name="jumlah"  class="form-control" value="<?= $result['jumlah_pinjam']?>" required>
      <input type="hidden" name="stok"  class="form-control" value="<?= $result['jumlah']?>" required>
      <input type="hidden" name="id_inventaris"  class="form-control" value="<?= $result['id_inventaris']?>" required>
      <input type="hidden" name="id"  class="form-control" value="<?= $result['id_peminjaman']?>" required>
      <input type="hidden" name="jumlahA"  class="form-control" value="<?= $result['jumlah_pinjam']?>" required>
    <br>
    <button name="submit" class="btn btn-primary " type="submit">Ubah</button>
</form>