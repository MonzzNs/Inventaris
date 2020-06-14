<?php
    echo anchor(
        'peminjaman/add',
        'Tambah',
        'class = "btn btn-success col-4" style = "margin-bottom:10px;"'
    );
?>
<table class="table table-striped table-bordered">
    <thead>
        <th>NO</th>
        <th>NAMA</th>
        <th>TANGGAL PINJAM</th>
        <th>TANGGAL KEMBALI</th>
        <th>STATUS</th>
        <th>JUMLAH</th>
        <th>PEGAWAI</th>
        <th>ACTION</th>
    </thead>
    <tbody>
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
                            '.anchor('peminjaman/edit/'.$r->id_peminjaman.'','EDIT','class="btn btn-outline-primary btn-sm mb-2 col-12"').'
							<br>
                            '.anchor('peminjaman/hapus/'.$r->id_peminjaman.'','HAPUS','class="btn btn-outline-warning btn-sm"','onclick="return konfirmasi();"').'
                        </td>
                    </tr>'
                ;
                $no++;
            }
            ?>
    </tbody>
</table>    
