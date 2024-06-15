<?php helper('form'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Buat Showing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Buat Showing</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?= form_open_multipart('/agent/showings/store') ?>
    <div class="form-group">
        <label for="date">Tanggal</label>
        <input type="date" class="form-control" id="date" name="date" value="<?= old('date') ?>" required>
    </div>

    <div class="form-group">
        <label for="activity_name">Nama Aktivitas</label>
        <input type="text" class="form-control" id="activity_name" name="activity_name" value="<?= old('activity_name') ?>" required>
    </div>

    <div class="form-group">
        <label for="activity_description">Deskripsi Aktivitas</label>
        <textarea class="form-control" id="activity_description" name="activity_description" required><?= old('activity_description') ?></textarea>
    </div>

    <div class="form-group">
        <label for="activity_result">Hasil Aktivitas</label>
        <textarea class="form-control" id="activity_result" name="activity_result" required><?= old('activity_result') ?></textarea>
    </div>

<div class="form-group">
    <label for="property_id">Properti</label>
    <select class="form-control" id="property_id" name="property_id" required>
        <?php if (!empty($properties)): ?>
            <?php foreach ($properties as $property): ?>
                <option value="<?= $property['id'] ?>" <?= old('property_id') == $property['id'] ? 'selected' : '' ?>><?= $property['name'] ?></option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">Tidak ada properti yang tersedia</option>
        <?php endif; ?>
    </select>
</div>


    <div class="form-group">
        <label for="photos">Foto</label>
        <input type="file" class="form-control-file" id="photos" name="photos[]" multiple>
    </div>

    <button type="submit" class="btn btn-primary">Buat Showing</button>
    <?= form_close() ?>
</div>

</body>
</html>
