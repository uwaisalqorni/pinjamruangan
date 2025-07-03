<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $tipe= $this->session->userdata('tipe'); ?>
<div class="container">
  <h3>Daftar Peminjaman Ruangan</h3>

  <form method="get" class="form-inline mb-3">
    <input type="text" name="katakunci" class="form-control" placeholder="Cari..." value="<?= $this->input->get('katakunci'); ?>">
	  <?php if (in_array($tipe, ['admin','user'])): ?>
      <a href="<?= site_url('/pinjamruangan/entr'); ?>" class="btn btn-success ml-2">+ Tambah</a>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary ml-2">Cari</button>
  </form>

  <p><em>Ditemukan: <?= $jml; ?> data</em></p>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIK</th>
        <th>Unit</th>
        <th>Tanggal & Waktu</th>
        <th>Tempat</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (isset($data) && count($data) > 0): ?>
        <?php $no = 1; foreach ($data as $row): ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nik']; ?></td>
            <td><?= $row['unit']; ?></td>
            <td><?= date('d-m-Y H:i', strtotime($row['datetime'])); ?></td>
            <td><?= $row['tempat']; ?></td>
            <td><?= $row['jumlah']; ?></td>
            <td><?= $row['keterangan']; ?></td>
            <td>
              <?php if ($row['status'] == 'disetujui'): ?>
                <span class="label label-success">Disetuju</span>
              <?php elseif ($row['status'] == 'ditolak'): ?>
                <span class="label label-danger">Ditolak</span>
              <?php else: ?>
                <span class="label label-warning">Menunggu</span>
              <?php endif; ?>
            </td>

            <td>
							<!-- Tombol Edit -->
							<a href="<?= site_url('/pinjamruangan/vedit/'.$row['id']); ?>" class="btn btn-xs btn-primary">Edit</a>
							<!-- Tombol Lihat Data -->

							<!-- <a href="<?= site_url('/pinjamruangan/view/'.$row['id']); ?>" class="btn btn-xs btn-info">
								<i class="glyphicon glyphicon-eye-open"></i> Lihat
							</a> -->

							<!-- Tombol Lihat Report -->
							<a href="<?= site_url('/pinjamruangan/report/'.$row['id']); ?>" class="btn btn-xs btn-info">
								<i class="glyphicon glyphicon-eye-open"></i> Lihat
							</a>


							<?php if (isset($admin)): ?>
								<!-- Tombol Setujui -->
								<form method="post" action="<?= site_url('/pinjamruangan/setuju'); ?>" style="display:inline;">
									<input type="hidden" name="id" value="<?= $row['id']; ?>">
									<button type="submit" class="btn btn-xs btn-success" <?= $row['status'] != 'menunggu' ? 'disabled' : ''; ?>>Setuju</button>
								</form>

								<!-- Tombol Tolak -->
								<form method="post" action="<?= site_url('/pinjamruangan/tolak'); ?>" style="display:inline;">
									<input type="hidden" name="id" value="<?= $row['id']; ?>">
									<button type="submit" class="btn btn-xs btn-warning" <?= $row['status'] != 'menunggu' ? 'disabled' : ''; ?>>Tolak</button>
								</form>

								<!-- Tombol Hapus -->
								<form method="post" action="<?= site_url('/pinjamruangan/del'); ?>" onsubmit="return confirm('Hapus data ini?');" style="display:inline;">
									<input type="hidden" name="id" value="<?= $row['id']; ?>">
									<button type="submit" class="btn btn-xs btn-danger">Hapus</button>
								</form>
							<?php endif; ?>
						</td>

          </tr>
		  
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="10" class="text-center">Tidak ada data</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <?= $pages; ?>
</div>
