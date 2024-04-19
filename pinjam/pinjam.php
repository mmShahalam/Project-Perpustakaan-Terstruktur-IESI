<?php
include "read-cart.php";
include "add-cart.php";
include "delete-cart.php";
include "save-cart.php";

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

function update($idbuku, $hari)
{
    $cookie_name = "cart";
    if (isset($_COOKIE[$cookie_name])) {
        $cart = json_decode($_COOKIE[$cookie_name], true);
        $cart[$idbuku][2] = $hari;
        setcookie($cookie_name, json_encode($cart));
    }
}

?>