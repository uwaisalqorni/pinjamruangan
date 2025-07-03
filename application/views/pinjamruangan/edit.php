<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $title; ?></h3>
        </div>
        <div class="panel-body">
          <!-- Flash message -->
          <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
              <?= $this->session->flashdata('success'); ?>
            </div>
          <?php endif; ?>

          <form method="post" action="<?= site_url('/pinjamruangan/update'); ?>" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $id; ?>">

            <!-- Isi form edit -->
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" required value="<?= $nama; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">NIK</label>
              <div class="col-sm-9">
                <input type="text" name="nik" class="form-control" required value="<?= $nik; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Unit</label>
              <div class="col-sm-9">
                <input type="text" name="unit" class="form-control" required value="<?= $unit; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal & Waktu</label>
              <div class="col-sm-9">
								<input type="datetime-local" name="datetime" class="form-control" 
								value="<?= isset($datetime) ? date('Y-m-d\TH:i', strtotime($datetime)) : date('Y-m-d\TH:i'); ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tempat</label>
              <div class="col-sm-9">
                <input type="text" name="tempat" class="form-control" required value="<?= $tempat; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Jumlah Orang</label>
              <div class="col-sm-9">
                <input type="number" name="jumlah" class="form-control" required value="<?= $jumlah; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Keterangan</label>
              <div class="col-sm-9">
                <textarea name="keterangan" class="form-control" rows="3"><?= $keterangan; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-success">
                  <i class="glyphicon glyphicon-save"></i> Update
                </button>
                <a href="<?= site_url('/pinjamruangan'); ?>" class="btn btn-default">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Panel Reset Status -->
			
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title"><?= $title; ?></h3>
							</div>
							<div class="panel-body">
								<!-- ✅ Badge Status -->
								<div class="text-center" style="margin-bottom: 15px;">
									<?php if ($status == 'disetujui'): ?>
										<span class="badge badge-success" style="font-size: 1.2em; padding: 10px 20px; background-color: #5cb85c;">
											✅ Disetujui
										</span>
									<?php elseif ($status == 'ditolak'): ?>
										<span class="badge badge-danger" style="font-size: 1.2em; padding: 10px 20px; background-color: #d9534f;">
											❌ Ditolak
										</span>
									<?php else: ?>
										<span class="badge badge-warning" style="font-size: 1.2em; padding: 10px 20px; background-color: #f0ad4e;">
											⏳ Menunggu Persetujuan
										</span>
									<?php endif; ?>
								</div>

								<!-- Notifikasi sukses -->
								<?php if ($this->session->flashdata('success')): ?>
									<div class="alert alert-success">
										<?= $this->session->flashdata('success'); ?>
									</div>
								<?php endif; ?>

								<!-- Form Edit -->
								<form method="post" action="<?= site_url('/pinjamruangan/update'); ?>" class="form-horizontal">
									<input type="hidden" name="id" value="<?= $id; ?>">
									
									<!-- isi form edit (nama, nik, dll seperti sebelumnya) -->
									...
								</form>
							</div>
						</div>

						<!-- Panel Reset Status -->
						<?php if (isset($this->session->tipe) && $this->session->tipe == 'admin'): ?>
							<!-- Panel Reset Status untuk admin saja -->
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h3 class="panel-title">Reset Status</h3>
								</div>
								<div class="panel-body">
									<form method="post" action="<?= site_url('pinjamruangan/resetstatus/'.$id); ?>" onsubmit="return confirm('Yakin ingin reset status ke menunggu?');">
										<button type="submit" class="btn btn-warning btn-block">
											<i class="glyphicon glyphicon-refresh"></i> Reset Status ke Menunggu
										</button>
									</form>
								</div>
							</div>
						<?php endif; ?>


					</div>
				</div>


    </div>
  </div>
</div>
