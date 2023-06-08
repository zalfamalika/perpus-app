<div class="col-md-12">
     <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"> <?= $judul ?></h3>
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

                <?php echo form_open_multipart('DashboardAnggota/UpdateProfile') ?>
                <div class="row">
                    <div class="col-sm-2">
                <div class="col-sm-12">
              <div class="form-group">
              <label>Foto</label>
                <img src="<?= base_url('foto/'.$anggota['foto'])?>" id="gambar_load" class="img-fluid" width="200px" height="200px">
              </div>
             </div>
                <div class="col-sm-10">
                  <div class="form-group">
                    <label >Pilih Foto</label>
                        <input type="file" name="foto" class="form-control" id="preview_gambar" accept="image/*">
                </div>
                </div>
                    </div>
                    <div class="col-sm-10">
                    <div class="col-sm-12">
                  <div class="form-group">
                    <label>NIS</label>
                    <input class="form-control" name="nis" value="<?= $anggota['nis']?>" placeholder="NIS">
                  </div>
                  </div>

                  <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <input class="form-control" name="nama_siswa" value="<?= $anggota['nama_siswa']?>" placeholder="Nama Siswa">
                  </div>
                  </div>
                
                  <div class="col-sm-12">
                  <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                  <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                    <option value="<?= $anggota['jenis_kelamin']?>"><?= $anggota['jenis_kelamin']?></option>
                    <option value="Laki-Laki">Laki Laki</option>
                    <option value="Perempuan">Perempuan</option>
                    </select>
                     </div>
                     </div>

                     <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <select name="id_kelas" class="form-control">
                         <option value="<?= $anggota['id_kelas']?>"><?= $anggota['nama_kelas']?></option>
                         <?php foreach ($kelas as $key => $value) { ?>
                        <option value="<?= $value['id_kelas'] ?>"><?= $value['nama_kelas'] ?></option>
                        <?php } ?>
                         </select>
                  </div>
                  </div>
                  </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>No Handphone</label>
                    <input class="form-control" name="no_hp" value="<?= $anggota['no_hp']?>" placeholder="No Handphone">
                  </div>
                  </div>

                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" value="<?= $anggota['password']?>" placeholder="Password">
                  </div>
                  </div>
                  </div>
                  </div>

                  <div class="col-sm-12">
                  <div class="form-group">
                    <label>Alamat</label>
                    <input class="form-control" name="alamat" value="<?= $anggota['alamat']?>" placeholder="Alamat">
                  </div>
                  </div>
                        <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                        <a href="<?= base_url('DashboardAnggota')?>" class="btn btn-success btn-flat">Kembali</a>
                    </div>
                </div>
                <?php echo form_close() ?>
        </div>
    </div> 
</div>   