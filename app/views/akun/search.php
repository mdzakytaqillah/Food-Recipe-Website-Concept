<div class="bodyy">
        <div class="row row-cols-1 row-cols-md-4 g-4" style="margin-bottom: 31px;">
            <?php foreach($data['user'] as $user) : ?>
            <div class="col">
              <div class="card h-100">
                <div class="card-body">
                  <a href="<?= BASEURL; ?>/user/<?= $user['usersID']; ?>" class="text-decoration-none text-dark"><h5 class="card-title title-wrap"><?= $user['Name']; ?></h5></a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
        </div><?php if(empty($data['user'])) {echo '<p>Data tidak ditemukan</p>';};?>
</div>