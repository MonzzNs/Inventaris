<?php
    echo anchor(
        'jenis/add',
        'Tambah',
        'class = "btn btn-success col-4" style = "margin-bottom:10px;"'
    );
?>
<table class="table table-striped table-bordered">
    <thead>
        <th>NO</th>
        <th>KODE</th>
        <th>NAMA</th>
        <th>KET</th>
        <th>ACTION</th>
    </thead>
    <tbody>
        <?php 
            $no=1;        
            foreach($data->result() as $r) {
                echo 
                    '<tr>
                        <td>'.$no.'</td>
                        <td>'.$r->kode_jenis.'</td>
                        <td>'.$r->nama_jenis.'</td>
                        <td>'.$r->keterangan.'</td>
                        <td>
                            '.anchor('jenis/update/'.$r->id_jenis.'','EDIT','class="btn btn-primary btn-sm mb-2 col-12"').'
                            '.anchor('jenis/hapus/'.$r->id_jenis.'','HAPUS','class="btn btn-warning btn-sm mb-2 col-12"' ,'onclick="return konfirmasi();"').'
                        </td>
                    </tr>'
                ;
                $no++;
            }
            ?>
    </tbody>
</table>    
