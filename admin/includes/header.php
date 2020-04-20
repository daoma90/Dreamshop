<?php

$catPath  = "";
$prodPath = "";
$homePath = "";
$currentPath =  $_SERVER['REQUEST_URI'];
if (strpos($currentPath, 'product')) {
    $catPath  = "./../index.php";
    $prodPath = "products.php";
    $homePath = "../../index.php";
} else {
    $catPath  = "./";
    $prodPath = "./product/products.php";
    $homePath = "../index.php";
}

?>
<header class="header">
    <nav class="header__hidden-burgernav">
        <ul class="header__list">
            <a href="<?= $catPath ?>" class="header__item-link">
                <li class="header__list-item">Kategorier</li>
            </a>
            <a href="<?= $prodPath ?>">
                <li class="header__list-item" id="products">Produkter</li>
            </a>
            <ul class="header__sub-list header__sub-list--hidden" id="sub-products">
                <a href="" class="header__sub-item-link" style="display:none">
                    <li class="header__sub-list-item">Kategori 1</li>
                </a>
            </ul>
            <a href="./order/orders.php">
                <li class="header__list-item" id="order">Beställningar</li>
            </a>
            <ul class="header__sub-list header__sub-list--hidden" id="sub-order">
                <a href="" class="header__sub-item-link">
                    <li class="header__sub-list-item">Aktiva</li>
                </a>
                <a href="" class="header__sub-item-link">
                    <li class="header__sub-list-item">Slutförda</li>
                </a>
            </ul>
            <a href="<?= $homePath ?>" class="header__item-link">
                <li class="header__list-item">Webbshoppen</li>
            </a>
        </ul>
    </nav>
    <div class="header__nav">
        <span class="header__nav-line"></span>
    </div>
    <h2 class="header__headline">Dreamshop admin</h2>
    <div class="nav-filler"></div>

</header>