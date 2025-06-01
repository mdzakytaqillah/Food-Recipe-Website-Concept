<div class="bodyy">    
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <form action="<?= BASEURL; ?>/resep/update" method="post" enctype="multipart/form-data">
        <input type="hidden" id="recipeID" name="recipeID" value="<?php echo isset($data['value']['recipeID']) ? $data['value']['recipeID'] : ''; ?>">
        <div class="container-fluid" style="padding-bottom: 90px;">
            <div class="row">
                <div class="col-md text-center">
                    <label for="imgfood" class="form-label">Ganti Foto Masakan</label>
                    <input class="form-control form-control-lg" id="imgfood" name="imgfood" type="file">
                    <p>Format foto yang diizinkan : .jpg, .jpeg, .png</p>
                    <p>Maksimal size foto adalah 4MB</p>
                </div>
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="title" class="form-control" id="recipeTitle" name="recipeTitle" value="<?php echo isset($data['value']['recipeTitle']) ? $data['value']['recipeTitle'] : ''; ?>" required>
                        <label for="title">Judul Masakan</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" id="descPreview" name="descPreview" style="height: 100px" required><?php echo isset($data['value']['descPreview']) ? htmlspecialchars($data['value']['descPreview']) : ''; ?></textarea>
                        <label for="descPreview">Deskripsi Singkat Masakan</label>
                    </div>
                    <div class="d-flex justify-content-center align-items-center" style="padding: 24px;">
                        <div class="col-sm-4">
                            <label class="visually-hidden" for="duration">Durasi Memasak</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="durationNum" name="durationNum" value="<?php echo isset($data['value']['durationNum']) ? $data['value']['durationNum'] : ''; ?>" placeholder="Durasi Memasak" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="visually-hidden" for="durationState">Waktu</label>
                            <select class="form-select" id="durationState" name="durationState">
                                <option value="Menit" <?php echo (isset($data['value']['durationState']) && $data['value']['durationState'] == ' Menit') ? 'selected' : ''; ?>>Menit</option>
                                <option value="Jam" <?php echo (isset($data['value']['durationState']) && $data['value']['durationState'] == ' Jam') ? 'selected' : ''; ?>>Jam</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" style="padding-bottom: 90px;">
            <div class="form-floating">
                <textarea class="form-control" id="descDetail" name="descDetail" style="height: 100px" required><?php echo isset($data['value']['descDetail']) ? htmlspecialchars($data['value']['descDetail']) : ''; ?></textarea>
                <label for="descDetail">Penjelasan Masakan</label>
            </div>
        </div>

        <div class="container-fluid" style="padding-bottom: 90px;">
            <div class="form-floating">
                <input type="text" class="form-control" id="equipment" name="equipment" value="<?php echo isset($data['value']['equipment']) ? $data['value']['equipment'] : ''; ?>" required>
                <label for="equipment">Peralatan</label>
            </div>
        </div>

        <script>
            function addBahan() {
            const bahanForm = document.getElementById('bahanform');
            const newBahan = document.createElement('div');
            newBahan.className = 'd-flex align-items-center';
            newBahan.style.margin = '12px';
            newBahan.innerHTML = `
                <div class="col">
                    <input class="form-control" type="text" id="ingredient" name="ingredient[]" placeholder="Bahan">
                </div>
            `;
            bahanForm.appendChild(newBahan);
            }

        function addLangkah() {
            const stepsForm = document.getElementById('stepsform');
            const newLangkah = document.createElement('div');
            newLangkah.className = 'd-flex align-items-center';
            newLangkah.style.margin = '12px';
            newLangkah.innerHTML = `
                <textarea class="form-control" placeholder="Langkah memasak" id="step" name="step[]"></textarea>
            `;
            stepsForm.appendChild(newLangkah);
            }
        </script>

        <div class="container-fluid" style="padding-bottom: 90px;">
            <div class="row">
                <div class="col-md-4" id='bahanform'>
                    <h6>Bahan</h6> <div class="col-md-auto"><button type="button" onclick="addBahan()">Tambah Bahan</button></div>
                    <?php if (isset($data['value']['ingredient'])) : ?>
                        <?php foreach ($data['value']['ingredient'] as $index => $itembahan) : ?>
                        <div class="d-flex align-items-center" style="margin: 12px">
                            <div class="col">
                                <input class="form-control" type="text" id="ingredient" name="ingredient[]" value="<?php echo htmlspecialchars($itembahan); ?>" placeholder="Bahan">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-8" id='stepsform'>
                    <h6>Cara Membuat</h6> <div class="col-md-auto"><button type="button" onclick="addLangkah()">Tambah Langkah</button></div>
                    <?php if (isset($data['value']['step'])) : ?>
                        <?php foreach ($data['value']['step'] as $indexx => $itemstep) : ?>
                        <div class="d-flex align-items-center" style='margin: 12px'>
                            <textarea class="form-control" placeholder="Langkah memasak" id="step" name="step[]"><?php echo htmlspecialchars($itemstep); ?></textarea>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>