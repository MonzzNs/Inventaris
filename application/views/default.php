<!DOCTYPE html>
<html>
    <head>
        <title>Road to Ujikom</title>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" language="JavaScript">
    		function konfirmasi(){
                tanya = confirm("Anda Yakin Akan Menghapus Data ?");
                if (tanya == true) return true;
                else return false;
   		    }
        </script>
        <script type="text/javascript" language="JavaScript">
    		function konfirmasi2(){
                tanya = confirm("Anda Yakin Akan Mengembalikan Data ?");
                if (tanya == true) return true;
                else return false;
   		    }
        </script>
        <style>
            li{
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div style="border-radius:unset;" class="jumbotron text-container rounded-bottom">
			<center>
			<h1 class="display-4">APLIKASI INVENTARIS</h1>
				<p class="lead">pra-UJIKOM Tahun 2019</p>
			</center>	
				<br>
                <p class="lead" style="border:1px solid black;width:220px;text-align:center;border-radius:5px;margin-bottom:-30px;"><?= $this->session->userdata('nama');?></p>
                <?php
                    echo anchor(
                        'login/destroy',
                        'Keluar',
                        'class = "btn btn-danger col-3" style = "float: right;"'
                    );
                ?>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">MENU</div>
                        <div class="card-body">
                            <ul>
                                <li><?php echo anchor('inventaris','inventarisir')?></li>
                                <ul>
                                    <li><?php echo anchor('jenis','jenis barang')?></li>
                                    <li><?php echo anchor('ruang','ruang')?></li>
                                </ul>
                                <li><?php echo anchor('#','transaksi')?></li>
                                <ul>
                                    <li><?php echo anchor('peminjaman','peminjaman')?></li>
                                    <li><?php echo anchor('pengembalian','pengembalian')?></li>
                                </ul>
                                <li><?php echo anchor('laporan','laporan')?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header"><?php echo $judul;?></div>
                        <div class="card-body">
                            <?php $this->load->view($content);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center" style="margin:10px 0;"> </footer>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    </body>
</html>
