<?= $this->include('home/layouts/header')?>
<?= $this->include('home/layouts/navbar')?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title><?= esc($agent['agent_name']) ?> - Detail Agen</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets/2/assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/owl.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <style>        

.agent-info {
    margin: 0;
    background-color: #ffffff;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    width: 100%;
    box-sizing: border-box;
}

.agent-container {
    max-width: 800px;
    margin: 0 auto;
}

.agent-photo {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 25px;
    display: block;
    border: 4px solid #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.agent-name {
    font-size: 32px;
    font-weight: 900;
    text-align: center;
    margin-bottom: 15px;
    color: #2c3e50;
}

.agent-details {
    margin-bottom: 25px;
    text-align: center;
}

.agent-details p {
    margin: 8px 0;
    color: #34495e;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 25px;
}

.social-link {
    text-decoration: none;
    color: #ffffff;
    font-size: 16px;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.social-link.facebook { background-color: #3b5998; }
.social-link.instagram { background-color: #e1306c; }
.social-link.tiktok { background-color: #000000; }

.social-link:hover {
    opacity: 0.8;
}

.contact-info {
    text-align: center;
}

.contact-info p {
    margin: 10px 0;
    color: #34495e;
}

.contact-info i {
    margin-right: 8px;
    color: #3498db;
}

.whatsapp-btn {
    background-color: #25D366;
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.whatsapp-btn:hover {
    background-color: #128C7E;
}
        </style>
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
          <span class="breadcrumb"><a href="<?php echo base_url('/'); ?>">Beranda</a> / Agen/ Agen Detail</span>
          <h3>Agen Detail</h3>
        </div>
      </div>
    </div>
  </div>


    </nav>
    
   <div class="agent-info">
    <div class="agent-container">
        <img src="<?= $agent['agent_photo_url'] ?>" alt="<?= $agent['agent_name'] ?>" class="agent-photo">
        <h1 class="agent-name"><?= $agent['agent_name'] ?></h1>
        
        <div class="agent-details">
            <p><strong>Jumlah Properti:</strong> <?= $agent['property_count'] ?></p>
            <p><strong>Alamat:</strong> <?= $agent['address'] ?></p>
        </div>
        
        <div class="social-links">
            <?php if (!empty($agent['facebook'])): ?>
                <a href="<?= $agent['facebook'] ?>" class="social-link facebook" target="_blank">
                    <i class="fab fa-facebook"></i> Facebook
                </a>
            <?php endif; ?>
            <?php if (!empty($agent['instagram'])): ?>
                <a href="<?= $agent['instagram'] ?>" class="social-link instagram" target="_blank">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
            <?php endif; ?>
            <?php if (!empty($agent['tiktok'])): ?>
                <a href="<?= $agent['tiktok'] ?>" class="social-link tiktok" target="_blank">
                    <i class="fab fa-tiktok"></i> TikTok
                </a>
            <?php endif; ?>
        </div>
        <div class="contact-info">
            <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <?= $agent['email'] ?></p>
            <p><i class="fas fa-phone"></i> <strong>Phone:</strong> <?= $agent['phone_number'] ?></p>
            <a href="https://wa.me/<?= $agent['phone_number'] ?>" class="whatsapp-btn">
                <i class="fab fa-whatsapp"></i> Contact via WhatsApp
            </a>
        </div>
        </div>
        </div>
        </div>
        
                    <div class="search-container">
    <form action="<?= site_url('home/agent_info/' . $agent['id']) ?>" method="GET" class="mb-4">
        <input type="text" name="keyword" class="form-control" placeholder="Lokasi, kata kunci, area, proyek, pengembang..." value="<?= $keyword ?? '' ?>">
        <input type="hidden" name="type" id="propertyType" value="<?= $type ?? '' ?>">
        <button type="submit">Cari</button>
    </form>
</div>

<div class="section properties">
    <div class="container">
       
    </div>
    <div class="section properties">
<div class="row properties-box">
     <?php if ($totalProperties == 0): ?>
        <div class="col-12">
                <div class="alert alert-warning">
                    Tidak ada properti yang ditemukan untuk agen ini.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($properties as $property): ?>
                <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 <?= strtolower($property['property_type']) ?>">
                    <div class="item property-card">
                        <a href="<?= site_url('home/properties_info/' . $property['id']) ?>">
                            <?php if (!empty($property['photos'])): ?>
                                <div id="propertyCarousel<?= esc($property['id']) ?>" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($property['photos'] as $key => $photo): ?>
                                            <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                                                <img src="<?= esc($photo['url']) ?>" class="d-block w-100" alt="Foto Properti" style="height: 200px; object-fit: cover;">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <ol class="carousel-indicators">
                                        <?php for ($i = 0; $i < count($property['photos']); $i++): ?>
                                            <li data-target="#propertyCarousel<?= esc($property['id']) ?>" data-slide-to="<?= $i ?>" <?= $i === 0 ? 'class="active"' : '' ?>></li>
                                        <?php endfor; ?>
                                    </ol>
                                </div>
                            <?php else: ?>
                                <img src="<?= base_url('path/to/default/image.jpg') ?>" alt="Default Property Image">
                            <?php endif; ?>
                        </a>
                        <span class="category"><?= esc($property['property_type']) ?> </span>
                        <span class="status"><?= esc($property['status'] ?? 'N/A') ?></span>
                        <span class="added-date">Tayang Sejak: <?= date('d M Y', strtotime($property['created_at'])) ?></span>
                        <h6 class="price">Rp<?= number_format($property['price'], 0, ',', '.') ?></h6>
                        <h4><a href="<?= site_url('home/properties_info/' . $property['id']) ?>"><?= esc($property['name']) ?></a></h4>
                        <div class="card-footer bg-white">
                            <div class="d-flex align-items-center">
                                <?php if (!empty($agent['agent_photo_url'])): ?>
                                    <img src="<?= esc($agent['agent_photo_url']) ?>" alt="Agen" class="rounded-circle mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="rounded-circle mr-2 bg-secondary" style="width: 40px; height: 40px;"></div>
                                <?php endif; ?>
                                <div>
                                    <strong><?= esc($agent['agent_name']) ?></strong><br>
                                    <small>Total Property: <?= esc($totalProperties) ?></small>
                                </div>
                            </div>
                            <div class="mt-">
                                <a href="tel:<?= esc($agent['phone_number']) ?>" class="btn btn-outline-secondary mr-2"><i class="fas fa-phone"></i></a>
                                <a href="https://wa.me/<?= esc($agent['phone_number']) ?>" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
   <?php if ($totalPages > 1): ?>
    <div class="row">
        <div class="col-lg-12">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li>
                        <a class="<?= $i == $currentPage ? 'is_active' : '' ?>" 
                           href="<?= site_url('home/agent_info/' . $agent['id'] . '?page=' . $i) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages): ?>
                    <li>
                        <a href="<?= site_url('home/agent_info/' . $agent['id'] . '?page=' . ($currentPage + 1)) ?>">
                            >>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
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