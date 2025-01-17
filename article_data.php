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

        $hlm = isset($_POST['hlm']) ? (int)$_POST['hlm'] : 1;
        $limit = 3;
        $limit_start = ($hlm - 1) * $limit;
        $no = $limit_start + 1;

        $sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);

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
                    <?= htmlspecialchars($row["isi"]) ?>
                </td>
                <td class="text-center">
                    <?php if (!empty($row["gambar"]) && file_exists('img/' . $row["gambar"])): ?>
                        <img src="img/<?= $row["gambar"] ?>" class="img-thumbnail" style="max-width: 100px;">
                    <?php else: ?>
                        <span class="text-muted"><?= empty($row["gambar"]) ? 'Tidak ada gambar' : 'Gambar tidak ditemukan' ?></span>
                    <?php endif; ?>
                </td>
                <td class="d-flex justify-content-center">
                    <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                    <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel<?= $row["id"] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalEditLabel<?= $row["id"] ?>">Edit Article</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="judul_<?= $row["id"] ?>" class="form-label">Judul</label>
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <input type="text" class="form-control" id="judul_<?= $row["id"] ?>" name="judul" value="<?= $row["judul"] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="isi_<?= $row["id"] ?>" class="form-label">Isi</label>
                                            <textarea class="form-control" id="isi_<?= $row["id"] ?>" name="isi" required><?= $row["isi"] ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar_<?= $row["id"] ?>" class="form-label">Ganti Gambar</label>
                                            <input type="file" class="form-control" id="gambar_<?= $row["id"] ?>" name="gambar">
                                        </div>
                                        <div class="mb-3">
                                            <label>Gambar Lama</label>
                                            <?php if (!empty($row["gambar"]) && file_exists('img/' . $row["gambar"])): ?>
                                                <br><img src="img/<?= $row["gambar"] ?>" width="100">
                                            <?php endif; ?>
                                            <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="simpan" class="btn btn-dark">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit -->

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusLabel<?= $row["id"] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalHapusLabel<?= $row["id"] ?>">Hapus Article</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus artikel "<strong><?= $row["judul"] ?></strong>"?</p>
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Hapus -->
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Pagination -->
<?php
$sql1 = "SELECT COUNT(*) AS total_records FROM article";
$hasil1 = $conn->query($sql1);
$total_records = $hasil1->fetch_assoc()['total_records'];
?>
<p>Total article: <?= $total_records; ?></p>
<nav class="mb-2">
    <ul class="pagination justify-content-end">
        <?php
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1;
        $start_number = ($hlm > $jumlah_number) ? $hlm - $jumlah_number : 1;
        $end_number = ($hlm < ($jumlah_page - $jumlah_number)) ? $hlm + $jumlah_number : $jumlah_page;

        if ($hlm > 1) {
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item halaman" id="' . ($hlm - 1) . '"><a class="page-link" href="#">&laquo;</a></li>';
        } else {
            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>';
        }

        for ($i = $start_number; $i <= $end_number; $i++) {
            $active = ($hlm == $i) ? ' active bg-dark text-white' : '';
            echo '<li class="page-item halaman' . $active . '" id="' . $i . '"><a class="page-link' . $active . '" href="#">' . $i . '</a></li>';
        }

        if ($hlm < $jumlah_page) {
            echo '<li class="page-item halaman" id="' . ($hlm + 1) . '"><a class="page-link" href="#">&raquo;</a></li>';
            echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
        } else {
            echo '<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        }
        ?>


    </ul>
</nav>
<!-- Pagination End -->