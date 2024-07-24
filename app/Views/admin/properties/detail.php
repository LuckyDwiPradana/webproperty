<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Properti</title>
    
    
    
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
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Detail Properti</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/index">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/admin/properties/index">Properti</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= esc($property['name']) ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Informasi Dasar</h6>
                                    <p><strong>Status:</strong> <?= esc($property['status']) ?></p>
                                    <p><strong>Lokasi:</strong> <?= esc($property['location']) ?></p>
                                    <p><strong>Harga:</strong> Rp <?= number_format($property['price'], 0, ',', '.') ?></p>
                                    <p><strong>ID Referensi:</strong> <?= esc($property['reference_id']) ?></p>
                                    <p><strong>Area:</strong> <?= esc($property['area']) ?></p>
                                    <p><strong>Tipe Listing:</strong> <?= esc($property['listing_type']) ?></p>
                                    <p><strong>Tipe Properti:</strong> <?= esc($property['property_type']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Detail Properti</h6>
                                    <p><strong>Kamar Tidur:</strong> <?= esc($property['bedroom']) ?></p>
                                    <p><strong>Kamar Mandi:</strong> <?= esc($property['bathroom']) ?></p>
                                    <p><strong>Luas Bangunan:</strong> <?= esc($property['building_size']) ?> m²</p>
                                    <p><strong>Luas Lahan:</strong> <?= esc($property['land_area']) ?> m²</p>
                                    <p><strong>Tahun Dibangun:</strong> <?= esc($property['year_built']) ?></p>
                                </div>
                            </div>
                             <!-- Tambahkan bagian informasi agen -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6>Informasi Agen</h6>
                                    <?php if (isset($property['agent']) && !empty($property['agent'])): ?>
                                        <p><strong>Nama Agen:</strong> <?= esc($property['agent']['agent_name'] ?? '-') ?></p>
                                        <p><strong>Email Agen:</strong> <?= esc($property['agent']['email'] ?? '-') ?></p>
                                        <p><strong>Telepon Agen:</strong> <?= esc($property['agent']['phone_number'] ?? '-') ?></p>
                                        <!-- Tambahkan informasi agen lainnya sesuai kebutuhan -->
                                    <?php else: ?>
                                        <p>Tidak ada informasi agen tersedia</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6>Deskripsi</h6>
                                    <p><?= nl2br(esc($property['description'])) ?></p>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6>Foto</h6>
                                    <?php if (!empty($property['photos'])): ?>
                                        <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php foreach ($property['photos'] as $index => $photo): ?>
                                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                        <img src="<?= esc($photo['url']) ?>" class="d-block w-100" alt="Foto Properti">
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Sebelumnya</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Selanjutnya</span>
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <p>Tidak ada foto tersedia</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

             <?= $this->include('admin/layouts/footer') ?>
        </div>
    </div>
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Menghilangkan alert setelah 2 detik
    setTimeout(function() {
        var successAlert = document.querySelector('.alert-light-success');
        if (successAlert) {
            successAlert.classList.remove('show');
        }

        var errorAlert = document.querySelector('.alert-light-danger');
        if (errorAlert) {
            errorAlert.classList.remove('show');
        }
    }, 2000);
</script>
</body>
</html>