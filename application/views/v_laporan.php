<center><p class="lead" style="border-top:2px solid grey;">Laporan Inventarisir Barang</p></center>
<form method="post" action="laporan/pdfInventaris">
    <label>Tanggal Awal</label>
      <input type="date" name="awal" id="tglAwal" class="form-control" required>
      <br>
    <label>Tanggal Akhir</label>
      <input type="date" name="akhir" id="tglAkhir" class="form-control" required>
      <br>
    <button class="btn btn-primary" type="submit">Generate Report</button>
</form>
<br>
<center><p class="lead" style="border-width: 2px; border-bottom:2px solid grey;">Report</p></center>
<br>
<br>
<center><p class="lead" style="border-top:2px solid grey;">Laporan Peminjaman Barang</p></center>
<form method="post" action="laporan/pdfPeminjaman">
    <label>Tanggal Awal</label>
      <input type="date" name="awal" id="tglAwal" class="form-control" required>
      <br>
    <label>Tanggal Akhir</label>
      <input type="date" name="akhir" id="tglAkhir" class="form-control" required>
      <br>
    <button class="btn btn-primary" type="submit">Generate Report</button>
</form>
<br>  
<center><p class="lead" style="border-bottom:2px solid grey;">Report</p></center>
