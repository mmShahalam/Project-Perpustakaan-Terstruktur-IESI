<?php
function read()
{
  $cookie_name = "cart";
  if (!isset($_COOKIE[$cookie_name])) {
    echo "Keranjang kosong";
    echo "<br><a href='../fitur.php'>Kembali ke Daftar Buku</a>";
  } else {
    $cart = json_decode($_COOKIE[$cookie_name], true);
    if (empty($cart)) {
      echo "Keranjang kosong";
      echo "<br><a href='../fitur.php'>Kembali ke Daftar Buku</a>";
      return;
    }

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
              <td>
                <form method='get' action='./pinjam.php' onsubmit='return validateForm(this)'>
                  <input type='hidden' name='fitur' value='update'>
                  <input type='hidden' name='idbuku' value='$i'>
                  <input type='number' name='hari' value='$hari'>
                  <input type='submit' value='Ubah'>
                </form>
              </td>
              <td>Rp $biayaSewa</td>
              <td>Rp $totalBiaya</td>
              <td><a href='./pinjam.php?fitur=delete&idbuku=$i'>Hapus</a></td>
          </tr>";
      $i++;
    }

    echo "</table>";
    echo "<a href='../fitur.php'>CARI</a> <br>";
    echo "<form method='get' action='./pinjam.php' onsubmit='return validateAllForms()'>
            <input type='hidden' name='fitur' value='save'>
            <input type='submit' value='SIMPAN'>
          </form>";
    echo "<br><b>Total Biaya Peminjaman: Rp $totalBiayaSeluruh</b>";
  }
}
?>

<script>
function validateForm(form) {
  var hari = form.hari.value;
  if (hari < 1 || hari > 7) {
    alert("Hari pinjam harus antara 1-7 hari");
    return false;
  }
  return true;
}

function validateAllForms() {
  var inputs = document.querySelectorAll("input[name='hari']");
  for (var i = 0; i < inputs.length; i++) {
    var hari = inputs[i].value;
    if (hari < 1 || hari > 7) {
      alert("Hari pinjam harus antara 1-7 hari");
      return false;
    }
  }
  return true;
}

document.addEventListener("DOMContentLoaded", function() {
  var inputs = document.querySelectorAll("input[type='number']");
  inputs.forEach(function(input) {
    input.addEventListener("invalid", function(event) {
      event.preventDefault();
      if (!event.target.validity.valid) {
        alert("Hari pinjam harus antara 1-7 hari");
      }
    });
  });
});
</script>
