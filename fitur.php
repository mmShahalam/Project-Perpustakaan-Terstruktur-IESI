<html>
    <body>
    <h1>Perpustakaan Chicken Pok</h1>
    <?php
        include "cari.php";
        $fitur = $_GET['fitur'] ?? null;
        switch ($fitur) {
            case 'pinjam':
                header('location:pinjam/pinjam.php?fitur=read');
                exit;
            case 'cari':
            default:
                $keyword = $_GET['keyword'] ?? null;
                $listbuku = cari($keyword);
                display($listbuku);
                break;
        }
    ?>
    <a href='./donasi-buku.php'>Donasi Buku</a>
    </body>
</html>