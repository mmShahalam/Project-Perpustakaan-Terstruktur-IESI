<?php
function add($idbuku, $judul, $hari = 1)
{
  $cookie_name = "cart";
  $cart = json_decode($_COOKIE[$cookie_name], true);

  $link = mysqli_connect("127.0.0.1", "root", "", "perpustakaan");

  $query = "SELECT harga_sewa_harian, stok FROM buku WHERE id = $idbuku";
  $result = $link->query($query);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $biayaPerHari = $row['harga_sewa_harian'];
    $stok = $row['stok'];
  } else {
    echo "Buku tidak ditemukan!";
    return;
  }

  if ($stok < 1) {
    echo "Stok buku habis!";
    return;
  }

  if ($hari < 1) {
    $hari = 1;
  } elseif ($hari > 7) {
    $hari = 7;
  }

  $biayaSewa = $biayaPerHari * $hari;

  $buku[] = $idbuku;
  $buku[] = $judul;
  $buku[] = $hari;
  $buku[] = $biayaSewa;
  $cart[] = $buku;

  setcookie($cookie_name, json_encode($cart));

  $link->close();
}
?>
