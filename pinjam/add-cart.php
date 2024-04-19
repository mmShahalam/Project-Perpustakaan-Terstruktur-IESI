<?php
function add($idbuku, $judul, $hari = 1)
{
  $cookie_name = "cart";
  $cart = json_decode($_COOKIE[$cookie_name], true);

  $link = mysqli_connect("127.0.0.1", "root", "", "perpustakaan");

  $query = "SELECT harga_sewa_harian FROM buku WHERE id = $idbuku";
  $result = $link->query($query);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $biayaPerHari = $row['harga_sewa_harian'];
  } else {
    echo "Buku tidak ditemukan!";
    return;
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
