<!DOCTYPE html>
<html>
<head>
  <title>Donasi Buku</title>
  <script>
    function validateForm() {
      var hargaSewa = document.getElementById("harga_sewa").value;
      var jumlahBuku = document.getElementById("jumlah").value;
      if (hargaSewa < 1000 || hargaSewa > 15000) {
        alert("Harga sewa harian minimal Rp1000 dan maksimal Rp15000");
        return false;
      }
      if (jumlahBuku < 1 || jumlahBuku > 5) {
        alert("Jumlah buku yang didonasikan minimal 1 dan maksimal 5");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <h1>Donasi Buku</h1>

  <form method="post" action="donasi-buku.php" onsubmit="return validateForm()">
    <h2>Informasi Buku</h2>
    <label for="judul">Judul Buku:</label>
    <input type="text" id="judul" name="judul" required>
    <br>
    <label for="harga_sewa">Harga Sewa Harian (Rp):</label>
    <input type="number" id="harga_sewa" name="harga_sewa" required>
    <br>
    <label for="jumlah">Jumlah Buku:</label>
    <input type="number" id="jumlah" name="jumlah" required>
    <br>
    <input type="submit" value="Donasikan">
    <br>
    <br>
    <a href="fitur.php">Kembali</a>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $harga_sewa = $_POST['harga_sewa'];
    $jumlah = $_POST['jumlah'];

    if (empty($judul) || $harga_sewa < 1000 || $harga_sewa > 15000 || $jumlah < 1 || $jumlah > 5) {
      echo "<p>Judul buku, harga sewa harian, dan jumlah buku harus valid.</p>";
      exit;
    }

    $link = mysqli_connect("127.0.0.1", "root", "", "perpustakaan");

    $query = "INSERT INTO buku (judul, harga_sewa_harian, stok) VALUES ('$judul', $harga_sewa, $jumlah)";
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
