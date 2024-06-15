<?php helper('form'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Buat Deal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Buat Deal</h1>

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

    <?= form_open_multipart('/admin/deals/store') ?>
    <div class="form-group">
        <label for="property_id">Properti</label>
        <select class="form-control" id="property_id" name="property_id" required>
            <?php if (!empty($properties)): ?>
                <?php foreach ($properties as $property): ?>
                    <option value="<?= $property['id'] ?>"><?= $property['name'] ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">Tidak ada properti yang tersedia</option>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="closing_description">Deskripsi</label>
        <textarea class="form-control" id="closing_description" name="closing_description" required></textarea>
    </div>

    <div class="form-group">
        <label for="documentation">Dokumentasi</label>
        <input type="file" class="form-control-file" id="documentation" name="documentation">
    </div>

    <div class="form-group">
        <label for="price">Harga</label>
        <input type="number" class="form-control" id="price" name="price" required>
    </div>

    <div class="form-group">
        <label for="buyer_name">Nama Pembeli</label>
        <input type="text" class="form-control" id="buyer_name" name="buyer_name" required>
    </div>

    <button type="submit" class="btn btn-primary">Buat Deal</button>
    <?= form_close() ?>
</div>

</body>
</html>