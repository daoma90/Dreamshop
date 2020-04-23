<header class="header">
  <nav class="header__hidden-burgernav">
    <form action="searchProd.php" action="POST" class="header__form">
      <input type="text" name="search-word" class="header__search" placeholder="Search Product" />
      <input type="submit" name="submit-search" style="position: absolute; left: -9999px; width: 1px; height: 1px;" />
    </form>
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
  <?php require_once 'cart.php' ?>
</header>