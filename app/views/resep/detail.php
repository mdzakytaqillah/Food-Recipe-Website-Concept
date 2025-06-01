<div class="bodyy">
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="container-fluid" style="padding-bottom: 90px;">
        <div class="row">
          <div class="col-md text-center">
            <img src="<?= BASEURL; ?>/img/resepthumb/<?= $data['resep']['imgthumbnail']; ?>" alt="" style="border-radius: 2%; max-width: 100%; height: auto;">
          </div>
          <div class="col-md">
            <h5><?= $data['resep']['recipeTitle']; ?></h5>
            <p><a href="<?= BASEURL; ?>/user/<?=$data['resep']['userID'];?>"><b><?= $data['owner']['Name']; ?></b></a> <?= $data['resep']['recipeDate']; ?></p>
            <p><?= $data['resep']['descPreview']; ?></p>
            <p class="card-text"><small class="text-body-secondary">Mendapat <?= $data['sumlike']['count']; ?> Ucapan Terima Kasih</small></p>
            <div class="d-flex justify-content-between align-items-center">
                <a href="#" style="font-size: 20px;"><span class="badge rounded-pill text-bg-success"><?= $data['resep']['duration']; ?></span></a>
                <a role="button" class="btn btn-outline-success btn-sm" id="likeButton"><span class="material-symbols-outlined" style="font-size: 12px;">favorite</span> Terima Kasih</a>
                <a role="button" class="btn btn-outline-success btn-sm" id="markButton" title="Mark" style="border-radius: 40%;"><span class="material-symbols-outlined" style="font-size: 12px;">bookmark_add</span></a>
            </div>
          </div>
        </div>
    </div>
    <script>
        if(<?= isset($_SESSION['login'])?>){
            document.getElementById("likeButton").className = "btn <?= $data['isLike']['count'] == 1 ? 'active' : '' ?> btn-outline-success btn-sm";
            document.getElementById('likeButton').addEventListener('click', function(event) {
        
            if (this.classList.contains('active')) {
                this.href = '<?= BASEURL; ?>/resep/unlikerecipe/<?= $data['resep']['recipeID']; ?>'; // Ubah href saat tombol aktif
            } else {
                this.href = '<?= BASEURL; ?>/resep/likerecipe/<?= $data['resep']['recipeID']; ?>'; // Kembalikan href saat tombol tidak aktif
            }
            
            });

            document.getElementById("markButton").className = "btn <?= $data['isMark']['count'] == 1 ? 'active' : '' ?> btn-outline-success btn-sm";
            document.getElementById('markButton').addEventListener('click', function(event) {
        
            if (this.classList.contains('active')) {
                this.href = '<?= BASEURL; ?>/resep/unmarkrecipe/<?= $data['resep']['recipeID']; ?>'; // Ubah href saat tombol aktif
            } else {
                this.href = '<?= BASEURL; ?>/resep/markrecipe/<?= $data['resep']['recipeID']; ?>'; // Kembalikan href saat tombol tidak aktif
            }
            
            });
        }
    </script>
    <script>
        if(<?= !isset($_SESSION['login'])?>){
            document.getElementById("likeButton").title = "Login untuk memberikan ucapan terima kasih";
            document.getElementById("markButton").title = "Login untuk menandai resep";
        }
    </script>
    
    <div class="container-fluid" style="padding-bottom: 90px;">
        <p><?= $data['resep']['descDetail']; ?></p>
    </div>

    <h6>Alat</h6>
    <div class="container-fluid" style="padding-bottom: 90px;">
        <p><?= $data['resep']['equipment']; ?></p>
    </div>

    <div class="container-fluid" style="padding-bottom: 90px;">
        <div class="row">
            <div class="col-md-4">
                <h6>Bahan</h6>
                <ul><?= $data['resep']['ingredients']; ?></ul>
                <!--
                <ul>
                    <li>1 sdm lorem</li>
                    <li>1 buah lorem</li>
                    <li>1 gram lorem</li>
                    <li>1 liter lorem</li>
                    <li>1 butir lorem</li>
                    <li>1 potong lorem</li>
                </ul>
                -->
            </div>
            <div class="col-md-8">
                <h6>Cara Membuat</h6>
                <ol><?= $data['resep']['steps']; ?></ol>
                <!--
                <ol>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quo et cupiditate.</li>
                    <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam facere qui corrupti!</li>
                    <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto natus eveniet et?</li>
                    <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa consequatur nostrum ea.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores sit repellat provident.</li>
                    <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem vero adipisci repudiandae?</li>
                    <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate deserunt recusandae suscipit.</li>
                </ol>
                -->
            </div>
        </div>
    </div>
</div>