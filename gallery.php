<div class="container mt-4">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#modalTambahGallery">
        <i class="bi bi-plus-lg"></i> Tambah Gambar
    </button>
    <div class="row">
        <div class="table-responsive" id="gallery_data">

        </div>
    </div>
    <!-- Awal Modal Tambah-->
    <div class="modal fade" id="modalTambahGallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gambar Gallery</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
              <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="desc" placeholder="Tuliskan Deskripsi" name="desc" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="simpan" name="simpan_gallery" class="btn btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Tambah-->
</div>

<script>
$(document).ready(function(){
    load_gallery(1); 

    function load_gallery(hlm){
        $.ajax({
            url : "gallery_data.php",  
            method : "POST",
            data : { hlm: hlm }, 
            success : function(data){
                $('#gallery_data').html(data); 
            }
        });
    }

    $(document).on('click', '.halaman', function(){
        var hlm = $(this).attr("id");
        load_gallery(hlm);  
    });
});


</script>

<?php
include "upload_foto.php";

if (isset($_POST['simpan_gallery'])) {
  $desc = $_POST['desc'];
  $image = '';
  $nama_image = $_FILES['image']['name'];

  if ($nama_image != '') {
      $cek_upload = upload_foto($_FILES["image"]);

      if ($cek_upload['status']) {
          $image = $cek_upload['message'];
      } else {
          echo "<script>
              alert('" . $cek_upload['message'] . "');
              document.location='admin.php?page=gallery';
          </script>";
          die;
      }
  }

  if (isset($_POST['id'])) {
      $id = $_POST['id'];

      if ($nama_image == '') {
          $image = $_POST['image_lama'];
      } else {
          unlink("img/" . $_POST['image_lama']);
      }

      $stmt = $conn->prepare("UPDATE gallery SET image = ?, `desc` = ? WHERE id = ?");
      $stmt->bind_param("ssi", $image, $desc, $id);
      $simpan = $stmt->execute();
  } else {
      // Insert data baru
      $stmt = $conn->prepare("INSERT INTO gallery (image, `desc`) VALUES (?, ?)");
      $stmt->bind_param("ss", $image, $desc);
      $simpan = $stmt->execute();
  }

  if ($simpan) {
      echo "<script>
          alert('Data berhasil disimpan');
          document.location='admin.php?page=gallery';
      </script>";
  } else {
      echo "<script>
          alert('Data gagal disimpan');
          document.location='admin.php?page=gallery';
      </script>";
  }

  $stmt->close();
  $conn->close();
}





// Hapus gallery
if (isset($_POST['hapus'])) {
  $id = $_POST['id'];
  $image = $_POST['image'];

  if ($image != '') {
      unlink("img/" . $image); 
  }

  $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
  $stmt->bind_param("i", $id);
  if ($stmt->execute()) {
      echo "<script>
          alert('Gambar berhasil dihapus');
          document.location='admin.php?page=gallery';
      </script>";
  }
  $stmt->close();
}

?>
