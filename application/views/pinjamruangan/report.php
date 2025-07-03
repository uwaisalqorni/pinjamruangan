<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .report-container {
        max-width: 800px;
        margin: auto;
        border: 1px solid #ddd;
        padding: 20px;
        font-family: Arial, sans-serif;
    }
    .report-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .report-header h3 {
        margin: 5px 0;
        font-size: 20px;
    }
    .report-header small {
        font-size: 14px;
        color: #777;
    }
    .report-body {
        font-size: 16px;
    }
    .report-body table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    .report-body table th, .report-body table td {
        border: 1px solid #000;
        padding: 6px;
        text-align: left;
    }
    .report-footer {
        margin-top: 30px;
        text-align: right;
    }
</style>
<a href="<?= site_url('/pinjamruangan/report_pdf/'.$id); ?>" target="_blank" class="btn btn-danger">
	<i class="glyphicon glyphicon-print"></i> Cetak PDF
	</a>

<div class="report-container">
    <!-- Header -->
    <div class="report-header">
        <img src="<?= base_url('public/images/logo_rs.png'); ?>" alt="Logo" style="height:60px;"><br>
        <strong>RUMAH SAKIT ISLAM GONDANGLEGI</strong><br>
        <strong> <?= $unit; ?></strong>
        <h4>PEMINJAMAN RUANG PERTEMUAN</h4>
    </div>

    <!-- Body -->
    <div class="report-body">
        <p><strong>Yang bertanda tangan di bawah ini:</strong></p>
        <p>
            Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $nama; ?><br>
            NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $nik; ?><br>
            Unit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $unit; ?>
        </p>

        <p>Dengan ini mengajukan permohonan peminjaman ruang pertemuan untuk keperluan:</p>
        <p style="min-height:50px; border:1px dashed #000; padding:5px;"><?= $keterangan ? $keterangan : ".............................................."; ?></p>

        <p>
            Hari, Tanggal&nbsp;&nbsp;: <?= date('l, d-m-Y', strtotime($datetime)); ?><br>
            Jam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= date('H:i', strtotime($datetime)); ?><br>
            Tempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $tempat; ?><br>
            Jumlah Peserta: <?= $jumlah; ?>
        </p>

        <p><strong>Sarana prasarana yang dibutuhkan:</strong></p>
        <table>
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th style="width:50%;">Sarana Prasarana</th>
                    <th style="width:15%;">Jumlah</th>
                    <th style="width:30%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<=2; $i++): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $unit; ?></td>
                        <td><?= $jumlah; ?></td>
                        <td><?= $keterangan; ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="report-footer">
        <p>Gondanglegi, <?= date('d-m-Y'); ?></p>
        <p style="margin-top:60px;">______________________________</p>
    </div>

    <a href="<?= site_url('/pinjamruangan'); ?>" class="btn btn-default">Kembali</a>
</div>
