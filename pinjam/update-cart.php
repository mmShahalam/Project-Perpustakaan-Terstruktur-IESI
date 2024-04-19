<?php
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