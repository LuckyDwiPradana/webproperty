
<?php helper('form'); ?>
   <!DOCTYPE html>
<html>
<head>
    <title>Create Property</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Create Property</h1>

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

    <?= form_open_multipart('/agent/properties/store') ?>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Available" <?= old('status') == 'Available' ? 'selected' : '' ?>>Available</option>
            <option value="Unavailablze" <?= old('status') == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
        </select>
    </div>

    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" value="<?= old('location') ?>" required>
    </div>

    <div class="form-group">
        <label for="bedroom">Bedroom</label>
        <input type="number" class="form-control" id="bedroom" name="bedroom" value="<?= old('bedroom') ?>" required>
    </div>

    <div class="form-group">
        <label for="bathroom">Bathroom</label>
        <input type="number" step="0.01" class="form-control" id="bathroom" name="bathroom" value="<?= old('bathroom') ?>" required>
    </div>

    <div class="form-group">
        <label for="building_size">Building Size</label>
        <input type="number" step="0.01" class="form-control" id="building_size" name="building_size" value="<?= old('building_size') ?>" required>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="<?= old('price') ?>" required>
    </div>

    <div class="form-group">
        <label for="reference_id">Reference ID</label>
        <input type="text" class="form-control" id="reference_id" name="reference_id" value="<?= old('reference_id') ?>">
    </div>

    <div class="form-group">
        <label for="area">Area</label>
        <input type="text" class="form-control" id="area" name="area" value="<?= old('area') ?>">
    </div>

    <div class="form-group">
        <label for="listing_type">Listing Type</label>
        <select class="form-control" id="listing_type" name="listing_type" required>
            <option value="Sale" <?= old('listing_type') == 'Sale' ? 'selected' : '' ?>>Sale</option>
            <option value="Rent" <?= old('listing_type') == 'Rent' ? 'selected' : '' ?>>Rent</option>
        </select>
    </div>

    <div class="form-group">
        <label for="property_type">Property Type</label>
        <select class="form-control" id="property_type" name="property_type" required>
            <option value="Apartement" <?= old('property_type') == 'Apartement' ? 'selected' : '' ?>>Apartement</option>
            <option value="House" <?= old('property_type') == 'House' ? 'selected' : '' ?>>House</option>
            <option value="Villa" <?= old('property_type') == 'Villa' ? 'selected' : '' ?>>Villa</option>
        </select>
    </div>

    <div class="form-group">
        <label for="land_area">Land Area</label>
        <input type="number" class="form-control" id="land_area" name="land_area" value="<?= old('land_area') ?>">
    </div>

    <div class="form-group">
        <label for="year_built">Year Built</label>
        <input type="number" class="form-control" id="year_built" name="year_built" value="<?= old('year_built') ?>">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required><?= old('description') ?></textarea>
    </div>

    <div class="form-group">
        <label for="photos">Photos</label>
        <input type="file" class="form-control-file" id="photos" name="photos[]" multiple>
    </div>

    <button type="submit" class="btn btn-primary">Create Property</button>
    <?= form_close() ?>
</div>

</body>
</html>