<div class="bodyy">    
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <form action="<?= BASEURL; ?>/resep/add" method="post" enctype="multipart/form-data">
        <div class="container-fluid" style="padding-bottom: 90px;">
            <div class="row">
                <div class="col-md text-center">
                    <label for="imgfood" class="form-label">Upload Foto Masakan</label>
                    <input class="form-control form-control-lg" id="imgfood" name="imgfood" type="file">
                    <p>Format foto yang diizinkan : .jpg, .jpeg, .png</p>
                    <p>Maksimal size foto adalah 4MB</p>
                </div>
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="title" class="form-control" id="title" name="title" value="<?php echo isset($data['value']['title']) ? $data['value']['title'] : ''; ?>" required>
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
                                <input type="number" class="form-control" id="duration" name="duration" value="<?php echo isset($data['value']['duration']) ? $data['value']['duration'] : ''; ?>" placeholder="Durasi Memasak" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="visually-hidden" for="durationState">Waktu</label>
                            <select class="form-select" id="durationState" name="durationState">
                                <option value="Menit" <?php echo (isset($data['value']['durationState']) && $data['value']['durationState'] == 'Menit') ? 'selected' : ''; ?>>Menit</option>
                                <option value="Jam" <?php echo (isset($data['value']['durationState']) && $data['value']['durationState'] == 'Jam') ? 'selected' : ''; ?>>Jam</option>
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
                <input type="text" class="form-control" id="alat" name="alat" value="<?php echo isset($data['value']['alat']) ? $data['value']['alat'] : ''; ?>" required>
                <label for="alat">Peralatan</label>
            </div>
        </div>

        <script>
            function addBahan() {
            const bahanForm = document.getElementById('bahanform');
            const newBahan = document.createElement('div');
            newBahan.className = 'd-flex align-items-center';
            newBahan.style.margin = '12px';
            newBahan.innerHTML = `
                <div class="col-sm-3">
                    <label class="visually-hidden" for="JumlahBahan">Jumlah</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="JumlahBahan[]" placeholder="Jumlah">
                    </div>
                </div>
                <div class="col-sm-4">
                    <input class="form-control" list="jumlahStateOptions" name="JumlahState[]" placeholder="pcs">
                </div>
                <div class="col-sm-5">
                    <input class="form-control" type="text" name="namabahan[]" placeholder="Nama Bahan">
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
                <textarea class="form-control" placeholder="Langkah memasak" name="langkahmasak[]"></textarea>
            `;
            stepsForm.appendChild(newLangkah);
            }
        </script>

        <div class="container-fluid" style="padding-bottom: 90px;">
            <div class="row">
                <div class="col-md-4" id='bahanform'>
                <h6>Bahan</h6> <div class="col-md-auto"><button type="button" onclick="addBahan()">Tambah Bahan</button></div>
                    <div class="d-flex align-items-center" style="margin: 12px">
                        <div class="col-sm-3">
                            <label class="visually-hidden" for="JumlahBahan">Jumlah</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="JumlahBahan" name="JumlahBahan[]" value="<?php echo isset($data['value']['JumlahBahan'][0]) ? $data['value']['JumlahBahan'][0] : ''; ?>" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" list="jumlahStateOptions" id="JumlahState" name="JumlahState[]" value="<?php echo isset($data['value']['JumlahState'][0]) ? $data['value']['JumlahState'][0] : ''; ?>" placeholder="pcs" required>
                            <datalist id="jumlahStateOptions">
                                <option value="sdm">
                                <option value="sdt">
                                <option value="gram">
                                <option value="liter">
                                <option value="ml">
                                <option value="butir">
                                <option value="potong">
                                <option value="pcs">
                            </datalist>
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" id="namabahan" name="namabahan[]" value="<?php echo isset($data['value']['namabahan'][0]) ? $data['value']['namabahan'][0] : ''; ?>" placeholder="Nama Bahan" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id='stepsform'>
                <h6>Cara Membuat</h6> <div class="col-md-auto"><button type="button" onclick="addLangkah()">Tambah Langkah</button></div>
                    <div class="d-flex align-items-center" style='margin: 12px'>
                        <textarea class="form-control" placeholder="Langkah memasak" id="langkahmasak" name="langkahmasak[]" required><?php echo isset($data['value']['langkahmasak'][0]) ? htmlspecialchars($data['value']['langkahmasak'][0]) : ''; ?></textarea>
                    </div>
                    <?php if (count($data['value']['langkahmasak']) > 1) : ?>
                        <?php $moresteprecover = array_slice($data['value']['langkahmasak'], 1)?>
                        <?php foreach ($moresteprecover as $indexx => $itemstep) : ?>
                        <div class="d-flex align-items-center" style='margin: 12px'>
                            <textarea class="form-control" placeholder="Langkah memasak" id="langkahmasak" name="langkahmasak[]"><?php echo htmlspecialchars($itemstep); ?></textarea>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>