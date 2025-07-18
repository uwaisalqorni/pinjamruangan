<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Tambah Peminjaman Ruangan</h3>
        </div>
        <div class="panel-body">
          <form method="post" action="<?= site_url('/pinjamruangan/gentr'); ?>" class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">NIK</label>
              <div class="col-sm-9">
                <input type="text" name="nik" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Unit</label>
              <div class="col-sm-9">
                <input type="text" name="unit" class="form-control" required>
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
                <input type="text" name="tempat" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Jumlah Orang</label>
              <div class="col-sm-9">
                <input type="number" name="jumlah" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Keterangan</label>
              <div class="col-sm-9">
                <textarea name="keterangan" class="form-control" rows="3"></textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
                <a href="<?= site_url('/pinjamruangan'); ?>" class="btn btn-default">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
