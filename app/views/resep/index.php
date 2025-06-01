<div class="bodyy">
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Pencarian Resep</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL; ?>/resep/" method="post">
                        <input type="text" class="form-control mb-3" placeholder="Cari resep" name="recipesearch" id="recipesearch" autocomplete="off">
                        <input type="text" class="form-control mb-3" placeholder="Alat yang tidak diinginkan" name="equipexclude" id="equipexclude" autocomplete="off">
                        <input type="text" class="form-control mb-3" placeholder="Bahan yang tidak diinginkan" name="ingredientexclude" id="ingredientexclude" autocomplete="off">
                        <button type="submit" class="btn btn-primary mb-3" id="cari">Cari Resep</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->
    <div class="row mb-3">
        <div class="col-md-3">
            <select class="form-select" id="sort" name="sort">
                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>
            </select>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-4">
            <form id="searchForm" action="<?= BASEURL; ?>/resep/" method="post">
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <span class="material-symbols-outlined" style="font-size: 12px;">filter_alt</span>
                    </button>
                    <input type="text" class="form-control" placeholder="Cari resep" name="recipesearch" id="recipesearch" autocomplete="off">
                    <button class="btn btn-outline-secondary" type="submit" id="cari">Cari</button>
                </div>
                <input type="hidden" name="equipexclude" id="equipexclude">
                <input type="hidden" name="ingredientexclude" id="ingredientexclude">
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4" style="margin-bottom: 31px;" id="recipeContainer">
        <?php foreach(array_reverse($data['resep']) as $index => $resep) : ?>
        <div class="col" data-index="<?= $index; ?>">
            <div class="card h-100">
                <img src="<?= BASEURL; ?>/img/resepthumb/<?= $resep['imgthumbnail']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="<?= BASEURL; ?>/resep/detail/<?= $resep['recipeID']; ?>" class="text-decoration-none text-dark">
                        <h5 class="card-title title-wrap"><?= $resep['recipeTitle']; ?></h5>
                    </a>
                    <a href="#"><span class="badge rounded-pill text-bg-success"><?= $resep['duration']; ?></span></a>
                    <p class="card-text"><?= $resep['descPreview']; ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div><?php if(empty($data['resep'])) {echo '<p>Data tidak ditemukan</p>';};?>

    <script>
    document.getElementById('sort').addEventListener('change', function() {
        var sortValue = this.value;
        var recipeContainer = document.getElementById('recipeContainer');
        var recipes = Array.from(recipeContainer.getElementsByClassName('col'));

        if (sortValue === 'terlama') {
            recipes.sort((a, b) => b.dataset.index - a.dataset.index);
        } else {
            recipes.sort((a, b) => a.dataset.index - b.dataset.index);
        }

        recipeContainer.innerHTML = '';
        recipes.forEach(function(recipe) {
            recipeContainer.appendChild(recipe);
        });
    });
    </script>
</div>