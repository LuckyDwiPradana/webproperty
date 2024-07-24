<?= $this->include('home/layouts/header')?>
<?= $this->include('home/layouts/navbar')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Properti - Total Property</title>
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets/2/assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/owl.css">
    <link rel="stylesheet" href="<?= base_url() ?>/temp/assets//assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
   <style>
body {
    padding-top: 80px;
    background-color: #ffffff;
    font-family: 'Poppins', sans-serif;
}

header {
    padding: 80px 80px 0;
    min-height: calc(100vh - 80px);
    background: linear-gradient(135deg, rgba(15, 33, 130, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
    position: relative;
    z-index: 1;
}

header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(15, 33, 130, 0.05) 0%, rgba(255, 255, 255, 0) 100%);
    z-index: -1;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

header .left {
    width: 50%;
}

header .left h1 {
    font-size: 48px;
    margin-bottom: 20px;
}

header .left h1 span {
    color: #0f2182;
}

header .left p {
    margin: 20px 0;
    color: #777;
}

header .search {
    margin-top: 30px;
    max-width: 400px;
    margin-left: 0;
    margin-right: auto;
}

header .search form {
    display: flex;
    background-color: #f5f5f5;
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

header .search form:hover {
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

header .search input[type="text"] {
    flex-grow: 1;
    padding: 10px 15px;
    font-size: 14px;
    border: none;
    background-color: transparent;
    outline: none;
    width: 200px;
}

header .search button {
    padding: 10px 15px;
    background-color: #0f2182;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
    white-space: nowrap;
    font-size: 14px;
}

header .search button:hover {
    background-color: #0a1860;
}

header .search button i {
    margin-right: 5px;
}

header .right {
    width: 50%;
    position: relative;
}

.image-container {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: visible;
}

.image-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.image-wrapper.active {
    opacity: 1;
}

.image-wrapper::before {
    content: '';
    position: absolute;
    top: -15px;
    right: -15px;
    bottom: -15px;
    left: -15px;
    background: 
        linear-gradient(45deg, rgba(15, 33, 130, 0.6) 0%, rgba(0, 119, 182, 0.6) 33%, 
                               rgba(0, 180, 216, 0.6) 66%, rgba(144, 224, 239, 0.6) 100%);
    filter: blur(20px);
    z-index: -1;
    clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 50% 100%, 30% 100%, 0% 70%, 0% 30%);
}

.property-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
    position: relative;
    z-index: 1;
    transition: transform 0.3s ease-in-out;
}

.image-wrapper:hover .property-image {
    transform: scale(1.05);
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

header .search form:focus-within {
    animation: pulse 0.5s ease-in-out;
}

.property-section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 0 10px;
}

.property-section-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 900;
    font-size: 32px;
    margin: 0;
}

.view-more-link {
    background-color: #0f2182;
    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    padding: 8px 16px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    white-space: nowrap;
}

.view-more-link:hover {
    background-color: #0a1860;
}

.properti-terbaru {
    margin-top: 60px;
}

.section.properties {
    margin-top: 20px;
}

.typed-container {
    display: inline-block;
    position: relative;
    min-width: 180px;
}

.typed-text {
    position: absolute;
    left: 0;
    color: #0f2182;
    font-weight: bold;
}

.cursor {
    display: inline-block;
    width: 3px;
    background-color: #0f2182;
    margin-left: 2px;
    animation: blink 0.7s infinite;
}

@keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 1; }
}

@media (max-width: 768px) {
    header {
        padding: 60px 20px 0;
    }

    .header-content {
        flex-direction: column;
    }

    header .left, header .right {
        width: 100%;
    }

    header .right {
        margin-top: 30px;
    }

    header .left h1 {
        font-size: 36px;
    }

    header .search {
        width: 100%;
    }

    .property-section-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .property-section-title {
        margin-bottom: 10px;
    }
}
    </style>
</head>

<body>
   <header>
    <div class="header-content">
        <div class="left">
            <h1>Temukan 
                <span class="typed-container">
                    <span class="typed-text"></span>
                    <span class="cursor">|</span>
                </span>
                Impian Anda
            </h1>
             <p>Jelajahi berbagai pilihan properti berkualitas untuk tempat tinggal atau investasi masa depan Anda.</p>
            <div class="search">
                <form action="<?= site_url('home/properties') ?>" method="GET">
                    <input type="text" name="keyword" placeholder="Cari properti, lokasi, atau kata kunci...">
                    <button type="submit"><i class="fas fa-search"></i> Cari</button>
                </form>
            </div>
        </div>
       <div class="right">
    <div class="image-container">
        <?php foreach ($latestPropertyImages as $index => $image): ?>
            <div class="image-wrapper <?= $index === 0 ? 'active' : '' ?>">
                <img src="<?= $image ?>" alt="Property Image <?= $index + 1 ?>" class="property-image">
            </div>
        <?php endforeach; ?>
    </div>
</div>
    </header>

<section class="properti-terbaru">
    <div class="property-section-header">
        <h2 class="property-section-title">Properti Terbaru</h2>
        <?php if (count($propertiTerbaru) == 3): ?>
            <a href="<?= site_url('home/properties?sort=newest') ?>" class="view-more-link">Lihat Selengkapnya</a>
        <?php endif; ?>
    </div>
    <div class="section properties">
        <div class="row properties-box">
                <?php if (empty($propertiTerbaru)): ?>
                    <div class="col-12">
                        <div class="alert alert-warning">Tidak ada properti terbaru yang ditemukan.</div>
                    </div>
                <?php else: ?>
                    <?php foreach ($propertiTerbaru as $property): ?>
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
                                        <?php if (!empty($property['agent']['agent_photo_url'])): ?>
                                            <img src="<?= esc($property['agent']['agent_photo_url']) ?>" alt="Agen" class="rounded-circle mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="rounded-circle mr-2 bg-secondary" style="width: 40px; height: 40px;"></div>
                                        <?php endif; ?>
                                        <div>
                                            <strong><?= esc($property['agent']['agent_name']) ?></strong><br>
                                            <small>Total Property <?= esc($property['agent']['agency'] ?? 'Agency') ?></small>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <a href="tel:<?= esc($property['agent']['phone_number']) ?>" class="btn btn-outline-secondary mr-2"><i class="fas fa-phone"></i></a>
                                        <a href="https://wa.me/<?= esc($property['agent']['phone_number']) ?>" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<section class="properti-terbaru">
    <div class="property-section-header">
        <h2 class="property-section-title">Properti Terpopuler</h2>
        <?php if (count($propertiTerpopuler) == 3): ?>
            <a href="<?= site_url('home/properties?sort=newest') ?>" class="view-more-link">Lihat Selengkapnya</a>
        <?php endif; ?>
    </div>
    <div class="section properties">
        <div class="row properties-box">
                <?php if (empty($propertiTerpopuler)): ?>
                    <div class="col-12">
                        <div class="alert alert-warning">Tidak ada properti terpopuler yang ditemukan.</div>
                    </div>
                <?php else: ?>
                    <?php foreach ($propertiTerpopuler as $property): ?>
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
                                        <?php if (!empty($property['agent']['agent_photo_url'])): ?>
                                            <img src="<?= esc($property['agent']['agent_photo_url']) ?>" alt="Agen" class="rounded-circle mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="rounded-circle mr-2 bg-secondary" style="width: 40px; height: 40px;"></div>
                                        <?php endif; ?>
                                        <div>
                                            <strong><?= esc($property['agent']['agent_name']) ?></strong><br>
                                            <small>Total Property <?= esc($property['agent']['agency'] ?? 'Agency') ?></small>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <a href="tel:<?= esc($property['agent']['phone_number']) ?>" class="btn btn-outline-secondary mr-2"><i class="fas fa-phone"></i></a>
                                        <a href="https://wa.me/<?= esc($property['agent']['phone_number']) ?>" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
     
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

            const typedText = document.querySelector('.typed-text');
            const words = ['Properti', 'Rumah', 'Apartemen', 'Ruko', 'Tanah', 'Villa', 'Gudang'];
            let wordIndex = 0;
            let charIndex = 0;
            let isDeleting = false;

            function type() {
                const currentWord = words[wordIndex];
                if (isDeleting) {
                    typedText.textContent = currentWord.substring(0, charIndex - 1);
                    charIndex--;
                } else {
                    typedText.textContent = currentWord.substring(0, charIndex + 1);
                    charIndex++;
                }

                if (!isDeleting && charIndex === currentWord.length) {
                    isDeleting = true;
                    setTimeout(type, 1500);
                } else if (isDeleting && charIndex === 0) {
                    isDeleting = false;
                    wordIndex = (wordIndex + 1) % words.length;
                    setTimeout(type, 500);
                } else {
                    setTimeout(type, isDeleting ? 50 : 100);
                }
            }

            type();
        });

        // Tambahkan kode untuk pergantian gambar
    const propertyImages = document.querySelectorAll('.image-wrapper');
    let currentImageIndex = 0;

    function changeImage() {
        propertyImages[currentImageIndex].classList.remove('active');
        currentImageIndex = (currentImageIndex + 1) % propertyImages.length;
        propertyImages[currentImageIndex].classList.add('active');
    }

    setInterval(changeImage, 5000); // Ganti gambar setiap 5 detik
    </script>
       <?= $this->include('home/layouts/footer')?>

</body>

</html>