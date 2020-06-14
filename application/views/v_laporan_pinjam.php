<h2 style="text-align: center;">Laporan Peminjaman</h2>
<table border="1" width="100%" cellpadding="10" cellspasing="0">
    <thead>
        <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>TANGGAL PINJAM</th>
        <th>TANGGAL KEMBALI</th>
        <th>STATUS</th>
        <th>JUMLAH</th>
        <th>PEGAWAI</th>
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
                        <td>'.$r->tanggal_pinjam.'</td>
                        <td>'.$r->tanggal_kembali.'</td>
                        <td>'.$r->status_peminjaman.'</td>
                        <td>'.$r->jumlah_pinjam.'</td>
                        <td>'.$r->nama_pegawai.'</td>
                    </tr>'
                ;
                $no++;
            }
            ?>
    </tbody>
</table>    