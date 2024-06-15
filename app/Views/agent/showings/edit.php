<?php helper('form'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Showing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Edit Showing</h1>
      <?php if (session()->has('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Form untuk mengubah data showing -->
    <?= form_open_multipart('/agent/showings/update/' . $showing['id']) ?>
        <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT" />
    <div class="form-group">
        <label for="date">Tanggal</label>
        <input type="date" class="form-control" id="date" name="date" value="<?= $showing['Date'] ?>" required>
    </div>

    <div class="form-group">
        <label for="activity_name">Nama Aktivitas</label>
        <input type="text" class="form-control" id="activity_name" name="activity_name" value="<?= $showing['Activity_name'] ?>" required>
    </div>

    <div class="form-group">
        <label for="activity_description">Deskripsi Aktivitas</label>
        <textarea class="form-control" id="activity_description" name="activity_description" required><?= $showing['Activity_description'] ?></textarea>
    </div>

    <div class="form-group">
        <label for="activity_result">Hasil Aktivitas</label>
        <textarea class="form-control" id="activity_result" name="activity_result" required><?= $showing['Activity_result'] ?></textarea>
    </div>

<!-- ... -->
<div class="form-group">
    <label for="property_id">Properti</label>
    <select class="form-control" id="property_id" name="property_id" required>
        <?php if (!empty($properties)): ?>
            <?php foreach ($properties as $property): ?>
                <option value="<?= $property['id'] ?>" <?= $showing['property_id'] == $property['id'] ? 'selected' : '' ?>><?= $property['name'] ?></option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">Tidak ada properti yang tersedia</option>
        <?php endif; ?>
    </select>
</div>
<!-- ... -->


<div class="form-group">
    <label for="photos">Foto</label>
    <input type="file" class="form-control-file" id="photos" name="photos[]" multiple>
</div>

    <!-- Loop untuk menampilkan foto-foto yang terkait dengan showing -->
    <div class="form-group">
        <div class="row">
            <?php foreach ($showing['photo_urls'] as $photoUrl): ?>
                <div class="col-md-3">
                    <img src="<?= $photoUrl ?>" class="img-fluid">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <?= form_close() ?>
</div>

</body>
</html>
