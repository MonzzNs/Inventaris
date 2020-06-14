<?php
    echo anchor(
        'inventaris/add',
        'Tambah',
        'class = "btn btn-success col-4" style = "margin-bottom:10px;"'
    );
?>
<table class="table table-striped table-bordered">
    <thead>
        <th>NO</th>
        <th>NAMA</th>
        <th>KONDISI</th>
        <th>JUMLAH</th>
        <th>JENIS</th>
        <th>TANGGAL MASUK</th>
        <th>RUANG</th>
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
                        <td>'.$r->kondisi.'</td>
                        <td>'.$r->jumlah.'</td>
                        <td>'.$r->nama_jenis.'</td>
                        <td>'.$r->tanggal_register.'</td>
                        <td>'.$r->nama_ruang.'</td>
                        <td>
                            '.anchor('inventaris/edit/'.$r->id_inventaris.'','EDIT','class="btn btn-outline-primary btn-sm mb-2 col-12"').'
                            '.anchor('inventaris/hapus/'.$r->id_inventaris.'','HAPUS','class="btn btn-outline-warning btn-sm mb-2 col-12"','onclick="return konfirmasi();"').'
                        </td>
                    </tr>'
                ;
                $no++;
            }
            ?>
    </tbody>
</table>    
