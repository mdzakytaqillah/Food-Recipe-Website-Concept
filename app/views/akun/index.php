  <div class="bodyy">  
    <div class="accneed">
        <h3>Hi<?= $_SESSION['login'] ? ', '. $data['name'] .'!' : '!' ?></h3>
    </div>
    <div class="row">
      <div class="col-md-6">
        <?php Flasher::flash(); ?>
      </div>
    </div>
    <h3>Resep <?= $data['owningName'];?></h3>
        <div class="row row-cols-1 row-cols-md-4 g-4" style="margin-bottom: 31px;">
            <?php foreach($data['resep'] as $resep) : ?>
            <div class="col">
              <div class="card h-100">
                <img src="<?= BASEURL; ?>/img/resepthumb/<?= $resep['imgthumbnail']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <a href="<?= BASEURL; ?>/resep/detail/<?= $resep['recipeID']; ?>" class="text-decoration-none text-dark"><h5 class="card-title title-wrap"><?= $resep['recipeTitle']; ?></h5></a>
                  <a href="#"><span class="badge rounded-pill text-bg-success"><?= $resep['duration']; ?></span></a>
                  <p class="card-text"><?= $resep['descPreview']; ?></p>
                  <div class="row accneed">
                    <div class="col-md-6 d-flex justify-content-center g-2">
                        <button onclick="location.href='<?= BASEURL; ?>/resep/edit/<?= $resep['recipeID']; ?>'" class="btn btn-outline-secondary btn-sm accneed">Edit</button>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center g-2">
                        <button onclick="confirm('Apakah anda yakin ingin menghapus resep ini?') ? location.href='<?= BASEURL; ?>/resep/delete/<?= $resep['recipeID']; ?>' : '';" class="btn btn-danger btn-sm accneed">Hapus</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
        </div><?php if(empty($data['resep'])) {echo '<p>belum memiliki resep</p>';};?>

        <h3 class="accneed">Resep yang <?= $data['owningName'];?> Apresiasi</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4 accneed" style="margin-bottom: 31px;">
          <?php foreach($data['likeResep'] as $resep) : ?>
          <div class="col">
            <div class="card h-100">
              <img src="<?= BASEURL; ?>/img/resepthumb/<?= $resep['imgthumbnail']; ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <a href="<?= BASEURL; ?>/resep/detail/<?= $resep['recipeID']; ?>" class="text-decoration-none text-dark"><h5 class="card-title title-wrap"><?= $resep['recipeTitle']; ?></h5></a>
                <a href="#"><span class="badge rounded-pill text-bg-success"><?= $resep['duration']; ?></span></a>
                <p class="card-text"><?= $resep['descPreview']; ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="accneed">
          <?php if(empty($data['likeResep'])) {echo '<p>Belum ada resep yang telah anda apresiasi</p>';};?>
        </div>

        <h3 class="accneed">Resep yang <?= $data['owningName'];?> Tandai</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4 accneed" style="margin-bottom: 31px;">
          <?php foreach($data['markResep'] as $resep) : ?>
          <div class="col">
            <div class="card h-100">
              <img src="<?= BASEURL; ?>/img/resepthumb/<?= $resep['imgthumbnail']; ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <a href="<?= BASEURL; ?>/resep/detail/<?= $resep['recipeID']; ?>" class="text-decoration-none text-dark"><h5 class="card-title title-wrap"><?= $resep['recipeTitle']; ?></h5></a>
                <a href="#"><span class="badge rounded-pill text-bg-success"><?= $resep['duration']; ?></span></a>
                <p class="card-text"><?= $resep['descPreview']; ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="accneed">
          <?php if(empty($data['markResep'])) {echo '<p>Belum ada resep yang telah anda tandai</p>';};?>
        </div>
  </div>      
<script>
if(<?= !isset($_SESSION['login']) || $_SESSION['idAkun'] != $data['id']?>){
  var elements = document.getElementsByClassName("accneed");
  for (var i = 0; i < elements.length; i++) {
      elements[i].style.display = "none";
  }
}
</script>