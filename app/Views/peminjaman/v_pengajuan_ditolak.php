

<?php 
$db = \Config\Database::connect();
foreach($pengajuanditolak as $key => $value) { 
  $buku = $db->table('tbl_peminjaman')
  ->join('tbl_buku','tbl_buku.id_buku = tbl_peminjaman.id_buku', 'left')
  ->where('id_anggota', $value['id_anggota'])
  ->where('status_pinjam', 'Ditolak')
  ->get()->getResultArray();
  ?>

<div class="col-md-12">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-danger">

                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?= $value['nama_siswa']?> (<?= $value['qty']?> Buku)</h3>
                <h5 class="widget-user-desc"><?= $value['nama_kelas']?></h5>
              </div>
              <div class="card-footer p-0">
        <table class="table table-hover">
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal Pengajuan</th>
                <th>Cover</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Lama Pinjam</th>
                <th>Ket</th>
            </tr>
            <?php $no= 1;
            foreach ($buku as $key => $data) { ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $data['tgl_pengajuan'] ?></td>
                <td class="text-center">
                   <img src="<?= base_url('cover/'.  $data['cover']) ?>" width="100px" height="100px">
                </td>
                <td><?= $data['judul_buku'] ?></td>
                <td class="text-center"><?= $data['tgl_pinjam'] ?></td>
                <td class="text-center"><?= $data['lama_pinjam'] ?></td>
                <td class="text-center"><?= $data['ket'] ?></td>
                
                
            </tr>

            <?php } ?>
        </table>
              </div>
            </div>
            </div> 
<?php } ?>