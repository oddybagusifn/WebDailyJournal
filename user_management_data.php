<table class="table table-hover table-bordered">
    <thead class="table-dark text-center">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Password</th>
            <th>Foto</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';

        $hlm = isset($_POST['hlm']) ? (int)$_POST['hlm'] : 1;
        $limit = 5;
        $limit_start = ($hlm - 1) * $limit;
        $no = $limit_start + 1;

        $sql = "SELECT * FROM user ORDER BY username ASC LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);

        while ($row = $hasil->fetch_assoc()) {
        ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($row["username"]) ?></td>
                <td class="text-truncate" style="max-width: 150px;">
                    <?= htmlspecialchars($row["password"]) ?>
                </td>
                <td class="text-center">
                    <?php if (!empty($row["foto"]) && file_exists('img/' . $row["foto"])): ?>
                        <img src="img/<?= $row["foto"] ?>" class="img-thumbnail" style="max-width: 100px;">
                    <?php else: ?>
                        <span class="text-muted">Foto tidak tersedia</span>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <?= htmlspecialchars($row["role"]) ?>
                </td>
                <td class="d-flex justify-content-center">
                    <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
                        <i class="bi bi-x-circle"></i>
                    </a>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel<?= $row["id"] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalEditLabel<?= $row["id"] ?>">Edit User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="username_<?= $row["id"] ?>" class="form-label">Username</label>
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <input type="text" class="form-control" id="username_<?= $row["id"] ?>" name="username" value="<?= $row["username"] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_<?= $row["id"] ?>" class="form-label">Password Baru (Opsional)</label>
                                            <input type="password" class="form-control" id="password_<?= $row["id"] ?>" name="password">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                                        </div>
                                        <input type="hidden" name="password_lama" value="<?= $row["password"] ?>">
                                        <div class="mb-3">
                                            <label for="foto_<?= $row["id"] ?>" class="form-label">Ganti Foto</label>
                                            <input type="file" class="form-control" id="foto_<?= $row["id"] ?>" name="foto">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role_<?= $row["id"] ?>" class="form-label">Role</label>
                                            <select class="form-select" id="role_<?= $row["id"] ?>" name="role" required>
                                                <option value="admin" <?= $row["role"] === "admin" ? "selected" : "" ?>>Admin</option>
                                                <option value="user" <?= $row["role"] === "user" ? "selected" : "" ?>>User</option>
                                                <option value="guest" <?= $row["role"] === "guest" ? "selected" : "" ?>>Guest</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Foto Lama</label>
                                            <?php if (!empty($row["foto"]) && file_exists('img/' . $row["foto"])): ?>
                                                <br><img src="img/<?= $row["foto"] ?>" width="100">
                                            <?php endif; ?>
                                            <input type="hidden" name="foto_lama" value="<?= $row["foto"] ?>">
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
                                    <h1 class="modal-title fs-5" id="modalHapusLabel<?= $row["id"] ?>">Hapus User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus user "<strong><?= $row["username"] ?></strong>"?</p>
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <input type="hidden" name="foto" value="<?= $row["foto"] ?>">
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


