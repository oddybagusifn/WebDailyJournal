<div class="container mt-4">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah User
    </button>
    <div class="row">
        <div class="table-responsive" id="user_data"></div>
    </div>
    <!-- Awal Modal Tambah-->
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Simpan" name="simpan" class="btn btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Tambah-->
</div>

<script>
$(document).ready(function() {
    load_data();
    function load_data(hlm) {
        $.ajax({
            url: "user_management_data.php",
            method: "POST",
            data: { hlm: hlm },
            success: function(data) {
                $('#user_data').html(data);
            }
        });
    }

    $(document).on('click', '.halaman', function() {
        var hlm = $(this).attr("id");
        load_data(hlm);
    });
});
</script>

<?php
include "upload_foto.php";

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password_baru = $_POST['password']; 
    $role = $_POST['role'];
    $foto = '';
    $nama_foto = $_FILES['foto']['name'];

    // Handle upload foto jika ada
    if ($nama_foto != '') {
        $cek_upload = upload_foto($_FILES["foto"]);

        if ($cek_upload['status']) {
            $foto = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=user_management';
            </script>";
            die;
        }
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($nama_foto == '') {
            $foto = $_POST['foto_lama'];
        } else {
            unlink("img/" . $_POST['foto_lama']);
        }

        if (empty($password_baru)) {
            $password = $_POST['password_lama']; 
        } else {
            $password = md5($password_baru); 
        }

        $stmt = $conn->prepare("UPDATE user 
                                SET 
                                username = ?,
                                password = ?,
                                foto = ?,
                                role = ?
                                WHERE id = ?");

        $stmt->bind_param("ssssi", $username, $password, $foto, $role, $id);
        $simpan = $stmt->execute();

    } else {
        $password = md5($password_baru); 
        $stmt = $conn->prepare("INSERT INTO user (username, password, foto, role)
                                VALUES (?,?,?,?)");

        $stmt->bind_param("ssss", $username, $password, $foto, $role);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=user_management';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=user_management';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $foto = $_POST['foto'];

    if ($foto != '') {
        unlink("img/" . $foto);
    }

    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=user_management';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=user_management';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
