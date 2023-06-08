<div class="col-sm-12">
<?php 
          if ($anggota['verifikasi']== 1 ){ ?>
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Akun Anda Sudah Terverifikasi !</h5>
                </div>
            
         <?php } else { ?>
            <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-times"></i> Akun Anda Belun Terverifikasi !</h5>
                  Silahkan Hubungi Petugas Perpustakaan Untuk Verifikasi Data !
                </div>
         <?php } ?>
         
</div>



<div class="col-md-9">
     <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
            <div class="card-tools">
               
            </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th width="150px">NIS</th>
                        <th width="50px">:</th>
                        <td><?= $anggota['nis']?></td>
                    </tr>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>:</th>
                        <td><?= $anggota['nama_siswa']?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <th>:</th>
                        <td><?= $anggota['jenis_kelamin']?></td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <th>:</th>
                        <td><?= $anggota['nama_kelas']?></td>
                    </tr>
                    <tr>
                        <th>No Handphone</th>
                        <th>:</th>
                        <td><?= $anggota['no_hp']?></td>
                    </tr>
                   
                </table>
</div>
</div>
</div>
