<?php

$sql = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil = $conn->query($sql);

$jumlah_article = $hasil->num_rows;
$jumlah_gallery = 0; //sementaa

?>

<div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center pt-4">
    <div class="col">
        <div class="card border-0 shadow-lg text-light" style="background: linear-gradient(135deg, #1f1c2c, #928dab);">
            <div class="card-body text-center p-5">
                <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;">
                    <i class="bi bi-newspaper fs-1"></i>
                </div>
                <h5 class="card-title fw-bold mb-3">Article</h5>
                <p class="card-text">Jumlah artikel yang tersedia.</p>
                <span class="badge bg-light text-dark fs-4 py-2 px-3 rounded-pill"><?php echo $jumlah_article; ?></span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card border-0 shadow-lg text-light" style="background: linear-gradient(135deg, #232526, #414345);">
            <div class="card-body text-center p-5">
                <div class="icon-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;">
                    <i class="bi bi-camera fs-1"></i>
                </div>
                <h5 class="card-title fw-bold mb-3">Gallery</h5>
                <p class="card-text">Jumlah galeri foto yang tersedia.</p>
                <span class="badge bg-light text-dark fs-4 py-2 px-3 rounded-pill"><?php echo $jumlah_gallery; ?></span>
            </div>
        </div>
    </div>
</div>



    </div> 
</div>