
<!-- header.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">Site de recettes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <?php if(!isset($_SESSION['LOGGED_USER'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <?php endif; ?>
        <?php if(isset($_SESSION['LOGGED_USER'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="page.php">Page Perso</a>
        </li>
        <li class="nav-item ms-auto">
          <a class="nav-link" href="logout.php">Déconnexion</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>