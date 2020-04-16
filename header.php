<header class="header">
  <nav class="header__hidden-burgernav">
    <input type="text" class="header__search" placeholder="Search Product" />
    <ul class="header__list">
      <li class="header__list-item">
        <a href="./" class="header__item-link">Home</a>
      </li>
      <?php require_once './assets/php/header_categories.php'; ?>
    </ul>
  </nav>
  <div class="header__nav">
    <span class="header__nav-line"></span>
  </div>
  <h2 class="header__headline">
    <a href="./">Dreamshop</a>
  </h2>
  <?php require_once 'cart.php'?>
</header>
