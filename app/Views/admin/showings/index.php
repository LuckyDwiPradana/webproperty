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
    <title>Daftar Showings</title>
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
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <div class="container">
        <h1 class="mt-4">Daftar Showings</h1>
        <a href="/admin/showings/create" class="btn btn-primary mb-3">Tambah Showing</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Aktivitas</th>
                    <th>Deskripsi Aktivitas</th>
                    <th>Hasil Aktivitas</th>
                    <th>Properti ID</th>
                    <th>Agen ID</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($showings)): ?>
                    <?php foreach ($showings as $showing): ?>
                    <tr>
                        <td><?= esc($showing['Date']) ?></td>
                        <td><?= esc($showing['Activity_name']) ?></td>
                        <td><?= esc($showing['Activity_description']) ?></td>
                        <td><?= esc($showing['Activity_result']) ?></td>
                        <td><?= esc($showing['property_id']) ?></td>
                        <td><?= esc($showing['agent_id']) ?></td>
                        <td>
                            <?php if (!empty($showing['photos'])): ?>
                                <div id="showingCarousel<?= esc($showing['id']) ?>" class="carousel slide carousel-item-container" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php $active = true; ?>
                                        <?php foreach ($showing['photos'] as $photo): ?>
                                            <div class="carousel-item <?= $active ? 'active' : '' ?>">
                                                <img src="<?= esc($photo['url']) ?>" class="d-block w-100" alt="Showing Photo" width="200">
                                            </div>
                                            <?php $active = false; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#showingCarousel<?= esc($showing['id']) ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#showingCarousel<?= esc($showing['id']) ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            <?php else: ?>
                                Tidak ada foto
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/admin/showings/edit/<?= esc($showing['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                            <form action="/admin/showings/delete/<?= esc($showing['id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus showing ini?')">Hapus</button>
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
