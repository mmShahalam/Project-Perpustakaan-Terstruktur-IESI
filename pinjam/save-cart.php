<?php
function save()
{
    $cookie_name = "cart";
    if (isset($_COOKIE[$cookie_name])) {
        $cart = json_decode($_COOKIE[$cookie_name], true);
        $link = new mysqli("127.0.0.1", "root", "", "perpustakaan");
        $query = "INSERT INTO peminjaman VALUES (null, current_timestamp())";
        $result = $link->query($query);
        $id = $link->insert_id;
        foreach ($cart as $row) {
            $idbuku = $row[0];
            $hari = $row[2];
            if ($hari < 1 || $hari > 7) {
                echo "Hari pinjam harus antara 1-7 hari";
                return;
            }
            $query = "INSERT INTO dipinjam(peminjaman_id, buku_id, hari, jumlah) VALUES ($id, $idbuku, $hari, 1)";
            $result = $link->query($query);
            $query = "UPDATE buku SET stok = stok - 1 WHERE id = $idbuku";
            $link->query($query);
        }
        $link->close();
        // Hapus cookie setelah menyimpan
        setcookie($cookie_name, "", time() - 3600);
    }
}
?>
