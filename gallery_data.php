<?php
include 'koneksi.php';

$hlm = isset($_POST['hlm']) ? (int)$_POST['hlm'] : 1;
$limit = 3;
$limit_start = ($hlm - 1) * $limit;
$no = $limit_start + 1;

$stmt = $conn->prepare("SELECT * FROM gallery ORDER BY tanggal DESC LIMIT ?, ?");
$stmt->bind_param("ii", $limit_start, $limit);
$stmt->execute();
$result = $stmt->get_result();
?>

<table class="table table-hover table-bordered">
    <thead class="table-dark text-center">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center">
                    <?php if (!empty($row["image"]) && file_exists('img/' . $row["image"])): ?>
                        <img src="img/<?= $row["image"] ?>" class="img-thumbnail" style="max-width: 100px;">
                    <?php else: ?>
                        <span class="text-muted"><?= empty($row["image"]) ? 'Tidak ada gambar' : 'Gambar tidak ditemukan' ?></span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row["desc"]) ?></td>
                <td class="d-flex justify-content-center">
                    <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                    <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Gambar Gallery</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>"> 

                                        <div class="mb-3">
                                            <label for="desc_<?= $row["id"] ?>" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="desc_<?= $row["id"] ?>" name="desc" required><?= $row["desc"] ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image_<?= $row["id"] ?>" class="form-label">Ganti Gambar</label>
                                            <input type="file" class="form-control" id="image_<?= $row["id"] ?>" name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label>Gambar Lama</label>
                                            <?php if (!empty($row["image"]) && file_exists('img/' . $row["image"])): ?>
                                                <br><img src="img/<?= $row["image"] ?>" width="100">
                                            <?php endif; ?>
                                            <input type="hidden" name="image_lama" value="<?= $row["image"] ?>"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="simpan_gallery" class="btn btn-dark">Edit</button>
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
                                    <h1 class="modal-title fs-5" id="modalHapusLabel<?= $row["id"] ?>">Hapus Galeri</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus gambar "<strong><?= $row["image"] ?></strong>"?</p>
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <input type="hidden" name="image" value="<?= $row["image"] ?>">
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
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Pagination -->
<?php
$sql1 = "SELECT COUNT(*) AS total_records FROM gallery";
$hasil1 = $conn->query($sql1);
$total_records = $hasil1->fetch_assoc()['total_records'];
?>

<nav class="mb-2">
    <ul class="pagination justify-content-end">
        <?php
        $jumlah_page = ceil($total_records / $limit);
        $start_number = max(1, $hlm - 1);
        $end_number = min($jumlah_page, $hlm + 1);

        if ($hlm > 1) {
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item halaman" id="' . ($hlm - 1) . '"><a class="page-link" href="#">&laquo;</a></li>';
        } else {
            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>';
        }

        for ($i = $start_number; $i <= $end_number; $i++) {
            $active = ($hlm == $i) ? ' active' : '';
            echo '<li class="page-item halaman' . $active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
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