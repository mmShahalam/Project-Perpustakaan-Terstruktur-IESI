<?php
include "read-cart.php";
include "add-cart.php";
include "delete-cart.php";
include "save-cart.php";
include "update-cart.php";

$fitur = $_GET['fitur'] ?? null;
switch ($fitur) {
    case 'add':
        $idbuku = $_GET['idbuku'];
        $judul = $_GET['judul'];
        add($idbuku, $judul);
        header('location:pinjam.php?fitur=read');
        break;
    case 'delete':
        $idbuku = $_GET['idbuku'];
        delete($idbuku);
        header('location:pinjam.php?fitur=read');
        break;
    case 'save':
        save();
        header('location:pinjam.php?fitur=read');
        break;
    case 'update':
        $idbuku = $_GET['idbuku'];
        $hari = $_GET['hari'];
        update($idbuku, $hari);
        header('location:pinjam.php?fitur=read');
        break;
    default:
        read();
        break;
}

?>