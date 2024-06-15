<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Deals</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .deal-photo {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <div class="container">
        <h1 class="mt-4">Daftar Deals</h1>
        <a href="/admin/deals/create" class="btn btn-primary mb-3">Tambah Deal</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Properti</th>
                    <th>Agen</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Pembeli</th>
                    <th>Dokumentasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($deals)): ?>
                    <?php foreach ($deals as $deal): ?>
                    <tr>
                        <td><?= esc($deal['id']) ?></td>
                        <td><?= esc($deal['property_id']) ?></td>
                        <td><?= esc($deal['agent_id']) ?></td>
                        <td><?= esc($deal['closing_description'] ?? 'No description') ?></td>
                        <td>Rp <?= number_format($deal['price'] ?? 0, 0, ',', '.') ?></td>
                        <td><?= esc($deal['buyer_name'] ?? '') ?></td>
                        <td><img src="<?= esc($deal['documentation_url']) ?>" width="50"></td>
                        <td>
                            <a href="/admin/deals/edit/<?= esc($deal['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                            <form action="/admin/deals/delete/<?= esc($deal['id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus deal ini?')">Hapus</button>
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