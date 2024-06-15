
<?php 
helper('form');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Agen</title>
    
    
    
    <link rel="shortcut icon" href="<?= base_url('/admin/compiled/svg/favicon.svg')?>" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    
<link rel="stylesheet" href="<?= base_url('/admin/extensions/simple-datatables/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/admin/compiled/css/table-datatable.css') ?>">
<link rel="stylesheet" href="<?= base_url('/admin/compiled/css/app.css') ?>">
<link rel="stylesheet" href="<?= base_url('/admin/compiled/css/app-dark.css') ?>">
<link rel="stylesheet" href="<?= base_url('/admin/compiled/css/iconly.css') ?>">
</head>


<?= $this->include('admin/layouts/navbar') ?>
<body>
<script src="<?= base_url('/admin/static/js/initTheme.js') ?>"></script>   
  <div id="app">
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <?= $this->include('admin/layouts/sidebar') ?>
<!-- Alert sukses -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-light-success color-success">
        <i class="bi bi-check-circle"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- Alert validasi -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-light-danger color-danger">
        <i class="bi bi-exclamation-circle"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
   <div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Agen</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/index">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Agen</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<!-- Form edit agen -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Agen</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    <form action="/admin/agents/update/<?= $agent['id'] ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT" />              
                                      <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="agent_name">Nama Agent</label>
                                    <input type="text" class="form-control" id="agent_name" name="agent_name" required maxlength="255" value="<?= old('agent_name', $agent['agent_name']) ?>" placeholder="Masukkan Nama Agent">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address" required value="<?= old('address', $agent['address']) ?>" placeholder="Masukkan Alamat">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="phone_number">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" required value="<?= old('phone_number', $agent['phone_number']) ?>" placeholder="Contoh: 628123456789"  pattern="^62[^0]\d{7,}$">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="<?= old('email', $agent['email']) ?>" placeholder="Masukkan Email">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="facebook">Facebook (URL)</label>
                                    <input type="url" class="form-control" id="facebook" name="facebook" required value="<?= old('facebook', $agent['facebook']) ?>" placeholder="Masukkan URL Facebook">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="twitter">Twitter (URL)</label>
                                    <input type="url" class="form-control" id="twitter" name="twitter" required value="<?= old('twitter', $agent['twitter']) ?>" placeholder="Masukkan URL Twitter">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="instagram">Instagram (URL)</label>
                                    <input type="url" class="form-control" id="instagram" name="instagram" required value="<?= old('instagram', $agent['instagram']) ?>" placeholder="Masukkan URL Instagram">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" minlength="8">
                                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="agent_photo">Foto Agent</label>
                                    <input type="file" class="form-control-file" id="agent_photo" name="agent_photo" accept="image/*">
                                    <?php if (!empty($agent['agent_photo'])): ?>
                                        <img src="<?= $agent['agent_photo_url'] ?>" alt="Foto Agent" class="img-thumbnail mt-2" width="200">
                                    <?php endif; ?>
                                </div>
                            </div>
                                                        <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" minlength="8">
                                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                <a href="<?= base_url('/admin/agents') ?>" class="btn btn-light-secondary me-1 mb-1">Batal</a>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
 <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('agentForm');
        form.addEventListener('submit', function (event) {
            const phone_number = document.getElementById('phone_number').value;
            const password = document.getElementById('password').value;
            const password_confirmation = document.getElementById('password_confirmation').value;

            // Validasi kesesuaian password jika diisi
            if (password && password !== password_confirmation) {
                alert('Password dan Konfirmasi Password tidak sesuai.');
                event.preventDefault();
            }
        });
    });
</script>


        <?= $this->include('admin/layouts/footer') ?>

        <!-- Script untuk validasi password, nomor telepon, dan email -->
      

    </div>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Agent</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Edit Agent</h1>
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
    <form action="/admin/agents/update/<?= $agent['id'] ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT" />
            <div class="mb-3">
                <label for="agent_name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="agent_name" name="agent_name" value="<?= $agent['agent_name'] ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address"><?= $agent['address'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $agent['phone_number'] ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $agent['email'] ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
            </div>
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="text" class="form-control" id="facebook" name="facebook" value="<?= $agent['facebook'] ?>">
            </div>
            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter</label>
                <input type="text" class="form-control" id="twitter" name="twitter" value="<?= $agent['twitter'] ?>">
            </div>
            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="<?= $agent['instagram'] ?>">
            </div>
           <div class="mb-3">
                <label for="agent_photo" class="form-label">Foto</label>
                <input type="file" class="form-control" id="agent_photo" name="agent_photo">
                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                <?php if (!empty($agent['agent_photo_url'])): ?>
                    <div class="mt-2">
                        <img src="<?= $agent['agent_photo_url'] ?>" alt="Foto Agent" width="200">
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/admin/agents" class="btn btn-secondary">Batal</a>
            <?php if (session()->has('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>