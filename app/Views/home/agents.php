<?= $this->include('home/layouts/header')?>
<?= $this->include('home/layouts/navbar')?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Agen - Total Property</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets/2/assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/owl.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area End ***** -->

<div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="breadcrumb"><a href="<?php echo base_url('/'); ?>">Beranda</a> / Agen</span>
                    <h3>Agen</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="section properties">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-container">
                                <form action="<?= site_url('home/agents') ?>" method="GET" class="mb-4">
                                    <input type="text" name="keyword" class="form-control" placeholder="Nama agen, alamat, nomor telepon..." value="<?= $keyword ?? '' ?>">
                                    <button type="submit">Cari</button>
                                </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php if (!empty($agents)): ?>
                    <?php foreach ($agents as $agent): ?>
                        <div class="col-lg-4 col-md-6 align-self-center mb-30">
                            <div class="item">
                                <a href="<?= site_url('home/agent_info/' . $agent['id']) ?>">
                                    <img src="<?= esc($agent['agent_photo_url'] ?? base_url('path/to/default/agent-image.jpg')) ?>" alt="<?= esc($agent['agent_name']) ?>" style="height: 200px; object-fit: cover;">
                                </a>
                                <span class="category" style="background-color: #0f2182;">Agen Properti</span>
                                <h6><?= esc($agent['agent_name']) ?></h6>
                                <p><?= esc($agent['email']) ?></p>
                                <ul style="min-height: 80px;">
                                    <li>Jumlah Properti: <span><?= esc($agent['property_count']) ?></span></li>
                                    <li>Alamat: <span><?= esc($agent['address']) ?></span></li>
                                    <li>
                                        <a href="https://wa.me/<?= esc($agent['phone_number']) ?>" class="whatsapp-btn">
                                            <i class="fab fa-whatsapp"></i> WhatsApp
                                        </a>
                                    </li>
                                </ul>
                                <div class="main-button">
                                    <a href="<?= site_url('home/agent_info/' . $agent['id']) ?>" class="w-100">
                                        <i class="fas fa-info-circle"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center">Tidak ada agen yang ditemukan.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<div class="section properties">
 <?php if ($totalPages > 1): ?>
    <div class="row">
        <div class="col-lg-12">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li>
                        <a class="<?= $i == $currentPage ? 'is_active' : '' ?>" 
                           href="<?= site_url('home/agents?' . http_build_query(array_merge($_GET, ['page' => $i]))) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages): ?>
                    <li>
                        <a href="<?= site_url('home/agents?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]))) ?>">
                            >>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
    <!-- Scripts -->
    <script src="<?= base_url() ?>/temp/assets/2/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/isotope.min.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/owl-carousel.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/counter.js"></script>
    <script src="<?= base_url() ?>/temp/assets/2/assets/js/custom.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var filterLinks = document.querySelectorAll('.properties-filter a');
        filterLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var url = new URL(this.href);
                window.location.href = url.toString();
            });
        });
    });
    </script>

    <?= $this->include('home/layouts/footer')?>
</body>
</html>