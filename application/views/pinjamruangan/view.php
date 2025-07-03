<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title"><?= $title; ?></h3>
    </div>
    <div class="panel-body">
      <dl class="dl-horizontal">
        <dt>Nama</dt>
        <dd><?= $nama; ?></dd>

        <dt>NIK</dt>
        <dd><?= $nik; ?></dd>

        <dt>Unit</dt>
        <dd><?= $unit; ?></dd>

        <dt>Tanggal & Waktu</dt>
        <dd><?= date('d-m-Y H:i', strtotime($datetime)); ?></dd>

        <dt>Tempat</dt>
        <dd><?= $tempat; ?></dd>

        <dt>Jumlah Orang</dt>
        <dd><?= $jumlah; ?></dd>

        <dt>Keterangan</dt>
        <dd><?= $keterangan ? $keterangan : '-'; ?></dd>

        <dt>Status</dt>
        <dd>
          <?php if ($status == 'disetujui'): ?>
            <span class="label label-success">Disetujui</span>
          <?php elseif ($status == 'ditolak'): ?>
            <span class="label label-danger">Ditolak</span>
          <?php else: ?>
            <span class="label label-warning">Menunggu</span>
          <?php endif; ?>
        </dd>
      </dl>
      <a href="<?= site_url('/pinjamruangan'); ?>" class="btn btn-default">
        <i class="glyphicon glyphicon-chevron-left"></i> Kembali
      </a>
    </div>
  </div>
</div>
