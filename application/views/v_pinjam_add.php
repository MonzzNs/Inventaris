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
<form method="post" action="add_execute">
    <label>Tanggal</label>
      <input type="date" name="tanggal" id="tglAwal" class="form-control" required>
    <label>Barang</label>
        <select name="barang" class="form-control">
            <?php foreach($data as $row):?>
                <option value="<?php echo $row->id_inventaris;?>"><?php echo $row->nama;?></option>
            <?php endforeach;?>
        </select>
        <label>Pegawai</label>
    <select name="pegawai" class="form-control">
            <?php foreach($data2 as $row):?>
                <option value="<?php echo $row->id_pegawai;?>"><?php echo $row->nama_pegawai;?></option>
            <?php endforeach;?>
        </select>
    <label>jumlah</label>
      <input type="number" name="jumlah"  class="form-control" required>
    <br>
    <button name="submit" class="btn btn-primary " type="submit">PINJAM</button>
</form>