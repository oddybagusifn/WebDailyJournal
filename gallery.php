<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Daily Journal</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  </head>
  <body>

    <!-- navbar -->

    <nav class="navbar navbar-dark navbar-expand-lg bg-dark fixed-top">
        <div class="container">
          <a class="navbar-brand fw-bold" href="#">My Daily Journal</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link" aria-current="page" href="homepage.html">Home</a>
              <a class="nav-link" href="article.html">Article</a>
              <a class="nav-link active" href="#">Gallery</a>
            </div>
          </div>
        </div>
      </nav>

    <!-- navbar end -->


    <!-- content -->
    
    <div class="content m-5">
            <div class="gallery container">
                <header>
                    <h1 class="fw-bold text-center p-5">Gallery</h1>
                </header>

                <div class="carouselImage">
                  <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="img/img1.jpg" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/img2.jpg" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="img/img3.jpg" class="d-block w-100" alt="...">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                </div>


                <div class="cardGallery mt-5 container">
                  <div class="card-group mx-auto p-2">
                    <div class="card" style="width: 18rem;">
                      <img src="img/img2.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                      <img src="img/img3.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                      <img src="img/img1.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
    </div>

    <!-- content end -->


    <!-- footer -->
     <footer class="bg-dark">
        <div class="footerSection mt-3">
            <div class="mediaSocial d-flex justify-content-center mb-2">
                <a class="text-light" href="">
                    <i class="fa-brands fa-instagram me-2"></i>
                  </a>
                  <a class="text-light" href="">
                    <i class="fa-brands fa-twitter ms-2 me-2"></i>
                  </a>
                  <a class="text-light" href="">
                    <i class="fa-brands fa-whatsapp ms-2"></i>
                  </a>
            </div>
            <div class="nameYear">
                <p class="text-light">Oddy Bagus Ifanda @ 2024</p>
            </div>
        </div>
     </footer>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>