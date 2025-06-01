</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<nav class="navbar fixed-bottom">
  <div class="container-fluid">
      <a class="nav-link<?= $data['title'] == 'Home' ? '-active' : '' ?>" href="<?= BASEURL; ?>"><img src="<?= BASEURL; ?>/icon/home<?= $data['title'] == 'Home' ? '-active' : '' ?>.png" alt="Home"></a>
      <a class="nav-link" href="<?= BASEURL; ?>/resep/upload"><img src="<?= BASEURL; ?>/icon/upload.png" alt="Upload"></a>
      <a class="nav-link<?= $data['title'] == 'Akun' ? '-active' : '' ?>" href="<?= BASEURL; ?>/akun"><img src="<?= BASEURL; ?>/icon/user<?= $data['title'] == 'Akun' ? '-active' : '' ?>.png" alt="User"></a>
  </div>
</nav>
</html>