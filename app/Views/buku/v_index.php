<div class="col-md-12">
     <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>

            <div class="card-tools">
                <a href="<?= base_url('Buku/AddData')?>" class="btn btn-primary btn-flat btn-sm" >
                    <i class="fas fa-plus"></i> Add
                </a>
            </div>
            </div>
            <div class="card-body">
            <?php 
      //notifikasi
      $errors = session()->getFlashdata('errors');
      if (!empty($errors)) { ?> 
         <div class="alert alert-danger" role="alert">
              <h4>Periksa Entry Form</h4>
              <ul> 
                  <?php  foreach ($errors as $key => $errors) { ?>
                      <li><?= esc($errors) ?></li> 
                  <?php } ?> 
              </ul> 
         </div>
      <?php } ?>

            <?php 
             if (session()->getFlashdata('pesan')) {
             echo '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>';
            echo session()->getFlashdata('pesan');
             echo '</h5></div>';
             }
             ?>

            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Cover</th>
                        <th>Judul Buku</th>
                        <th>ISBN</th>
                        <th>Tahun</th>
                        <th>Bahasa</th>
                        <th>Jumlah</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($buku as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td class="text-center">
                          <img src="<?= base_url('cover/'.  $value['cover']) ?>" width="125px" height="125px">
                        <p><b><?= $value['kode_buku'] ?></b></p>
                        </td>
                        <td>
                            <p><h5 class="text-primary"><?= $value['judul_buku'] ?></h5></p>
                            <p><b> Kategori : </b> <?= $value['nama_kategori']?><br>
                            <b> Penulis : </b> <?= $value['nama_penulis']?><br>
                            <b> Penerbit : </b> <?= $value['nama_penerbit']?><br>
                            <b> Lokasi : </b> <?= $value['nama_rak']?> Lantai   <?= $value['lantai_rak']?> <br>
                            <b> Halaman : </b> <?= $value['halaman']?><br>
                            <b> Bahasa : </b> <?= $value['bahasa']?><br>
                        </p>
                        </td>
                        <td><?= $value['isbn'] ?> </td>
                        <td><?= $value['tahun'] ?> </td>
                        <td><?= $value['bahasa'] ?> </td>
                        <td class="text-center">
                        Total : <span class="badge badge-success"><?= $value['jumlah']?></span><br>
                        </td>
                        <td class="text-center">
                        <a href="<?= base_url('Buku/EditData/'. $value['id_buku'])?>" class="btn btn-warning btn-flat btn-sm" >
                        <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?=$value['id_buku'] ?>" >
                        <i class="fas fa-trash"></i>
                        </button>
                        </td>
                    </tr>
                  <?php  } ?>
                </tbody>
                </table>
            </div>
    </div> 
</div>   

<!-- Modal Delete -->
<?php foreach ($buku as $key => $value) { ?>
<div class="modal fade" id="modal-delete<?=$value['id_buku'] ?>">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open(base_url('Buku/DeleteData/'.$value['id_buku'])) ?>
              <div class="form-group">
                    Apakah Yakin Hapus Data <b><?= $value['judul_buku']?></b>..?
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger btn-flat">Delete</button>
            </div>
            <?php echo form_close() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<?php } ?>