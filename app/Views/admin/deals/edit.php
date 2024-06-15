<?php helper('form'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Deal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Edit Deal</h1>
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <!-- Form untuk mengubah data deal -->
    <?= form_open_multipart('/admin/deals/update/' . $deal['id']) ?>
        <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT" />
    <div class="form-group">
        <label for="property_id">Properti</label>
        <select class="form-control" id="property_id" name="property_id" required>
            <?php if (!empty($properties)): ?>
                <?php foreach ($properties as $property): ?>
                    <option value="<?= $property['id'] ?>" <?= $deal['property_id'] == $property['id'] ? 'selected' : '' ?>><?= $property['name'] ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">Tidak ada properti yang tersedia</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="closing_description">Deskripsi</label>
        <textarea class="form-control" id="closing_description" name="closing_description" required><?= $deal['closing_description'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="documentation">Dokumentasi</label>
        <input type="file" class="form-control-file" id="documentation" name="documentation">
        <?php if (!empty($deal['documentation'])): ?>
            <p>Dokumentasi saat ini: <?= $deal['documentation'] ?></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="price">Harga</label>
        <input type="number" class="form-control" id="price" name="price" value="<?= $deal['price'] ?>" required>
    </div>
    <div class="form-group">
        <label for="buyer_name">Nama Pembeli</label>
        <input type="text" class="form-control" id="buyer_name" name="buyer_name" value="<?= $deal['buyer_name'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Deal</button>
    <?= form_close() ?>
</div>
</body>
</html>