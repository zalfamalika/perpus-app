<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul?></h3>
                <div class="card-tools">
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-borderless table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Cover</th>
                            <th>Buku</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($buku as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><img src="<?= base_url('cover/'.  $value['cover']) ?>" width="250px" height="270px">
                        <p><b><?= $value['kode_buku'] ?></b></p></td>
                        <td>
                        <p><h5 class="text-primary"><?= $value['judul_buku'] ?></h5></p>
                            <p><b> Kategori : </b> <?= $value['nama_kategori']?><br>
                            <b> Penulis : </b> <?= $value['nama_penulis']?><br>
                            <b> Penerbit : </b> <?= $value['nama_penerbit']?><br>
                            <b> ISBN : </b> <?= $value['isbn']?><br>
                            <b> Halaman : </b> <?= $value['halaman']?><br>
                            <b> Bahasa : </b> <?= $value['bahasa']?><br>
                            <b> Tahun : </b> <?= $value['tahun']?><br>
                            <b> Lokasi : </b> <?= $value['nama_rak']?> Lantai   <?= $value['lantai_rak']?>
                        </p>
                        </td>
                            </tr>

                       <?php } ?>
                    </tbody>
                </table>
                </div>
              </div>
</div>