<!DOCTYPE html>
<html>
<head>
  <title>Donasi Buku</title>
</head>
<body>
  <h1>Donasi Buku</h1>

  <form method="post" action="donasi-buku.php">
    <h2>Informasi Buku</h2>
    <label for="judul">Judul Buku:</label>
    <input type="text" id="judul" name="judul" required>
    <br>
    <label for="harga_sewa">Harga Sewa Harian (Rp):</label>
    <input type="number" id="harga_sewa" name="harga_sewa" min="0" required>
    <br>
    <input type="submit" value="Donasikan">
    <br>
    <br>
    <a href="fitur.php">Kembali</a> </form>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $harga_sewa = $_POST['harga_sewa'];

    $link = mysqli_connect("127.0.0.1", "root", "", "perpustakaan");

    if (empty($judul) || $harga_sewa < 0) {
      echo "Judul buku dan harga sewa harus valid.";
      exit;
    }

    $query = "INSERT INTO buku (judul, harga_sewa_harian) VALUES ('$judul', $harga_sewa)";
    $result = $link->query($query);

    if ($result) {
      echo "<p>Terima kasih atas donasi buku Anda! Buku '$judul' telah ditambahkan ke perpustakaan.</p>";
    } else {
      echo "<p>Gagal melakukan donasi. Silahkan coba lagi.</p>";
    }

    $link->close();
  }
  ?>
</body>
</html>
