<?php
function read()
{
  $cookie_name = "cart";
  if (!isset($_COOKIE[$cookie_name])) {
    echo "Keranjang kosong";
  } else {
    $cart = json_decode($_COOKIE[$cookie_name], true);
    echo "<table border=1>";
    echo "<tr>
              <th>No</th>
              <th>ID</th>
              <th>Judul</th>
              <th>Hari Pinjam</th>
              <th>Harga Sewa/Hari</th>
              <th>Biaya Total</th>
              <th></th>
          </tr>";
    $i = 0;
    $totalBiayaSeluruh = 0;

    foreach ($cart as $row) {
      $idbuku = $row[0];
      $judul = $row[1];
      $hari = $row[2];
      $biayaSewa = $row[3];
      $totalBiaya = $hari * $biayaSewa;
      $totalBiayaSeluruh += $totalBiaya;

      echo "<tr>
              <td>$i</td>
              <td>$idbuku</td>
              <td>$judul</td>
              <td><form method='get' action='./pinjam.php'>
                  <input type='hidden' name='fitur' value='update'>
                  <input type='hidden' name='idbuku' value='$i'>
                  <input type='number' name='hari' min='1' value='$hari'>
                  <input type='submit' value='Ubah'>
                </form></td>
              <td>Rp $biayaSewa</td>
              <td>Rp $totalBiaya</td>
              <td><a href='./pinjam.php?fitur=delete&idbuku=$i'>Hapus</td>
          </tr>";
      $i++;
    }

    echo "</table>";
    echo "<a href='../fitur.php'>CARI</a> <br>";
    echo "<a href='pinjam.php?fitur=save'>SIMPAN</a> <br>";
    echo "<br><b>Total Biaya Peminjaman: Rp $totalBiayaSeluruh</b>";
  }
}
