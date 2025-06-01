  <div class="bodyy">  
    <div class="resep">
        <h3>Resep Terfavorit</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4" style="margin-bottom: 31px;">
            <?php foreach($data['mostFav'] as $topresep) : ?>
            <div class="col">
                <div class="card">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="<?= BASEURL; ?>/img/resepthumb/<?= $topresep['imgthumbnail']; ?>" class="img-fluid rounded-start" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <a href="<?= BASEURL; ?>/resep/detail/<?= $topresep['recipeID']; ?>" class="text-decoration-none text-dark"><h5 class="card-title title-wrap"><?= $topresep['recipeTitle']; ?></h5></a>
                          <a href="#"><span class="badge rounded-pill text-bg-success"><?= $topresep['duration']; ?></span></a>
                          <p class="card-text desc-wrap"><?= $topresep['descPreview']; ?></p>
                          <p class="card-text"><small class="text-body-secondary">Mendapat <?= $topresep['grateful'] ?> Ucapan Terima Kasih</small></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3">
                <h3>Resep Terbaru</h3>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-4">
                <form id="searchForm" action="<?= BASEURL; ?>/resep/" method="post">
                    <div class="input-group">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#" id="cariresep" >Resep</a></li>
                          <li><a class="dropdown-item" href="#" id="caripengguna" >Pengguna</a></li>
                        </ul>
                        <input type="text" class="form-control" placeholder="Cari resep" name="recipesearch" id="searchInput" autocomplete="off">
                        <button class="btn btn-outline-secondary" type="submit" id="cari">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            document.getElementById('cariresep').addEventListener('click', function(event) {
                event.preventDefault();
                setSearchType('resep');
            });

            document.getElementById('caripengguna').addEventListener('click', function(event) {
                event.preventDefault();
                setSearchType('pengguna');
            });

            function setSearchType(type) {
                const form = document.getElementById('searchForm');
                const input = document.getElementById('searchInput');
                const button = document.getElementById('cari');

                if (type === 'resep') {
                    form.action = '<?= BASEURL; ?>/resep/';
                    input.placeholder = 'Cari resep';
                    input.name = 'recipesearch';
                } else if (type === 'pengguna') {
                    form.action = '<?= BASEURL; ?>/user/search';
                    input.placeholder = 'Cari pengguna';
                    input.name = 'usersearch';
                }
                // Reattach the input event listener to ensure it updates correctly
                input.removeEventListener('input', handleInput);
                input.addEventListener('input', handleInput);

                button.disabled = input.value.trim() === '';
            }
            function handleInput() {
                const input = document.getElementById('searchInput');
                const button = document.getElementById('cari');
                button.disabled = input.value.trim() === '';
            }

            // Initial call to set the button state on page load
            document.addEventListener('DOMContentLoaded', function() {
                const input = document.getElementById('searchInput');
                const button = document.getElementById('cari');
                input.addEventListener('input', handleInput);
                button.disabled = input.value.trim() === '';
            });
        </script>

        <div class="row row-cols-1 row-cols-md-4 g-4" style="margin-bottom: 31px;">
            <?php $colcount = 0; $collimit = 12;?>
            <?php foreach(array_reverse($data['resep']) as $resep) : ?>
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
            <?php $colcount += 1; ?>
            <?php if ($colcount == $collimit) break; ?>
            <?php endforeach; ?>
            <?php if(empty($data['resep'])) {echo '<p>Data tidak ditemukan</p>';};?>
            <div class="d-grid gap-2 col-6 mx-auto">
              <a class="btn btn-outline-secondary" href="<?= BASEURL; ?>/resep" role="button">More</a>
            </div>
        </div>
    </div>
  </div>