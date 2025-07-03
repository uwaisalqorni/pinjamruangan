<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12pt; }
        .report-container {
            max-width: 800px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .report-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-header img {
            height: 60px;
            margin-bottom: 10px;
        }
        .report-header h3 {
            margin: 5px 0;
            font-size: 18pt;
        }
        .report-body {
            font-size: 12pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        .report-footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="report-container">
    <!-- Header -->
    <div class="report-header">
        <img src="<?= base_url('public/images/logo_rs.png'); ?>" alt="Logo" style="height:60px;">
        <h3>RUMAH SAKIT ISLAM GONDANGLEGI</h3>
        <strong><?= $unit; ?></strong>
        <h4 style="margin-top:10px;">PEMINJAMAN RUANG PERTEMUAN</h4>
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
                <tr>
                    <td>1</td>
                    <td><?= $tempat; ?></td>
                    <td><?= $jumlah; ?></td>
                    <td><?= $keterangan ? $keterangan : "-"; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="report-footer">
        <p>Gondanglegi, <?= date('d-m-Y'); ?></p>
        <p style="margin-top:60px;">______________________________</p>
    </div>
</div>
</body>
</html>
