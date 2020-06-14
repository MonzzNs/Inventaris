<h2 style="text-align: center;">Laporan Inventaris</h2>
<table border="1" width="100%" cellpadding="10" cellspasing="0">
    <thead>
    <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>KONDISI</th>
        <th>JUMLAH</th>
        <th>JENIS</th>
        <th>TANGGAL MASUK</th>
        <th>RUANG</th>
    </tr>
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
                    </tr>'
                ;
                $no++;
            }
            ?>
    </tbody>
</table>    