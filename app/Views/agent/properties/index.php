<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php else: ?>
    <?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
<!DOCTYPE html>
<html>
<head>
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <title>Daftar Properti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .carousel-item-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .carousel-item-container .carousel-item img {
            max-height: 600px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Daftar Properti</h1>
        <a href="/agent/properties/create" class="btn btn-primary mb-3">Tambah Properti</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                    <th>Kamar Tidur</th>
                    <th>Kamar Mandi</th>
                    <th>Luas Bangunan</th>
                    <th>Harga</th>
                    <th>Referensi ID</th>
                    <th>Area</th>
                    <th>Tipe Listing</th>
                    <th>Tipe Properti</th>
                    <th>Luas Lahan</th>
                    <th>Tahun Dibangun</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($properties)): ?>
                    <?php foreach ($properties as $property): ?>
                    <tr>
                        <td><?= esc($property['name']) ?></td>
                        <td><?= esc($property['status']) ?></td>
                        <td><?= esc($property['location']) ?></td>
                        <td><?= esc($property['bedroom']) ?></td>
                        <td><?= esc($property['bathroom']) ?></td>
                        <td><?= esc($property['building_size']) ?> m²</td>
                        <td><?= 'Rp ' . number_format($property['price'], 0, ',', '.') ?></td>
                        <td><?= esc($property['reference_id']) ?></td>
                        <td><?= esc($property['area']) ?></td>
                        <td><?= esc($property['listing_type']) ?></td>
                        <td><?= esc($property['property_type']) ?></td>
                        <td><?= esc($property['land_area']) ?> m²</td>
                        <td><?= esc($property['year_built']) ?></td>
                        <td><?= esc(substr($property['description'], 0, 50)) . '...' ?></td>
                        <td>
                            <?php if (!empty($property['photos'])): ?>
                                <div id="propertyCarousel<?= esc($property['id']) ?>" class="carousel slide carousel-item-container" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php $active = true; ?>
                                        <?php foreach ($property['photos'] as $photo): ?>
                                            <div class="carousel-item <?= $active ? 'active' : '' ?>">
                                                <img src="<?= esc($photo['url']) ?>" class="d-block w-100" alt="Property Photo" width="200">
                                            </div>
                                            <?php $active = false; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel<?= esc($property['id']) ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel<?= esc($property['id']) ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            <?php else: ?>
                                Tidak ada foto
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/agent/properties/edit/<?= esc($property['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                            <form action="/agent/properties/delete/<?= esc($property['id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus properti ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php endif; ?>