<table class="table table-hover table-bordered">
    <thead class="table-dark text-center">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Isi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';

        $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
        $limit = 3;
        $limit_start = ($hlm - 1) * $limit;
        $no = $limit_start + 1;

        $sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);

        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql);

        $no = 1;
        while ($row = $hasil->fetch_assoc()) {
        ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td>
                    <strong><?= $row["judul"] ?></strong>
                    <br><small class="text-muted">pada: <?= $row["tanggal"] ?></small>
                    <br><small class="text-muted">oleh: <?= $row["username"] ?></small>
                </td>
                <td class="text-truncate" style="max-width: 300px;">
                    <?= $row["isi"] ?>
                </td>
                <td class="text-center">
                    <?php
                    if ($row["gambar"] != '') {
                        if (file_exists('img/' . $row["gambar"])) {
                    ?>
                            <img src="img/<?= $row["gambar"] ?>" class="img-thumbnail" style="max-width: 100px;">
                    <?php
                        } else {
                            echo '<span class="text-danger">Gambar tidak ditemukan</span>';
                        }
                    } else {
                        echo '<span class="text-muted">Tidak ada gambar</span>';
                    }
                    ?>
                </td>
                <td class="d-flex justify-content-center">
                    <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                    <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Article</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <!-- Pastikan 'for' di label sesuai dengan ID input -->
                                            <label for="judul_<?= $row["id"] ?>" class="form-label text-start">Judul</label>
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <input type="text" class="form-control" id="judul_<?= $row["id"] ?>" name="judul" placeholder="Tuliskan Judul Artikel" value="<?= $row["judul"] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <!-- Pastikan 'for' di label sesuai dengan ID textarea -->
                                            <label for="isi_<?= $row["id"] ?>" class="form-label text-start">Isi</label>
                                            <textarea class="form-control" id="isi_<?= $row["id"] ?>" name="isi" placeholder="Tuliskan Isi Artikel" required><?= $row["isi"] ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <!-- Pastikan 'for' di label sesuai dengan ID input file -->
                                            <label for="gambar_<?= $row["id"] ?>" class="form-label text-start">Ganti Gambar</label>
                                            <input type="file" class="form-control" id="gambar_<?= $row["id"] ?>" name="gambar">
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar_lama_<?= $row["id"] ?>" class="form-label text-start">Gambar Lama</label>
                                            <?php if ($row["gambar"] != ''): ?>
                                                <?php if (file_exists('img/' . $row["gambar"])): ?>
                                                    <br><img src="img/<?= $row["gambar"] ?>" width="100">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <input type="hidden" id="gambar_lama_<?= $row["id"] ?>" name="gambar_lama" value="<?= $row["gambar"] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit -->

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Article</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="hapus_<?= $row["id"] ?>" class="form-label">Yakin akan menghapus artikel "<strong><?= $row["judul"] ?></strong>"?</label>
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                                        <input type="submit" value="hapus" name="hapus" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Hapus -->

                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!-- pagination -->
<?php
$sql1 = "SELECT * FROM article";
$hasil1 = $conn->query($sql1);
$total_records = $hasil1->num_rows;
?>
<p>Total article : <?php echo $total_records; ?></p>
<nav class="mb-2">
    <ul class="pagination justify-content-end">
        <?php
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($hlm > $jumlah_number) ? $hlm - $jumlah_number : 1;
        $end_number = ($hlm < ($jumlah_page - $jumlah_number)) ? $hlm + $jumlah_number : $jumlah_page;

        if ($hlm == 1) {
            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $link_prev = ($hlm > 1) ? $hlm - 1 : 1;
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i = $start_number; $i <= $end_number; $i++) {
            $link_active = ($hlm == $i) ? ' active' : '';
            echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
        }

        if ($hlm == $jumlah_page) {
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        } else {
            $link_next = ($hlm < $jumlah_page) ? $hlm + 1 : $jumlah_page;
            echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
        }
        ?>
    </ul>
</nav>
<!-- pagination end -->