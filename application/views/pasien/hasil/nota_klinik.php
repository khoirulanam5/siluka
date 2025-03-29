<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">
    <style>
        body {
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        @media print {
            .no-print {
                display: none;
            }
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 80px;
        }

        .header h2 {
            margin: 10px 0;
            font-size: 18px;
        }

        .header p {
            margin: 0;
            font-size: 12px;
        }

        hr {
            border: 1px solid black;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature p {
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <img src="<?= base_url('assets/images/loading.png') ?>" alt="Logo">
        <h2><b>KLINIK RAWAT LUKA DIABETES PATI</b></h2>
        <p>Alamat: Jl. Juwana Jakenan KM 01, Tambak Pekuwon, Kecamatan Juwana, Kabupaten Pati, Jawa Tengah  59185<br>
            No. Telp: 0812-6167-1916
        </p>
    </div>
    <hr>

    <!-- Nota Section -->
    <h3 style="text-align: center;">Nota Pembayaran Perawatan</h3>
    <?php foreach ($hasil as $hasil): ?>
    <table>
        <tr>
            <th>Nama Pasien</th>
            <td><?= $hasil->nm_pasien ?></td>
        </tr>
        <tr>
            <th>Nama Perawatan</th>
            <td><?= $hasil->nm_perawatan ?></td>
        </tr>
        <tr>
            <th>Biaya Perawatan</th>
            <td>Rp <?= number_format($hasil->biaya_perawatan, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Status Perawatan</th>
            <td><?= $hasil->status_perawatan ?></td>
        </tr>
        <tr>
            <th>Catatan</th>
            <td><?= $hasil->catatan ?></td>
        </tr>
        <tr>
            <th>Tanggal Perawatan</th>
            <td><?= do_formal_date($hasil->tgl_perawatan) ?></td>
        </tr>
        <tr>
            <th>Bukti Bayar</th>
            <td>
                <?php if (!empty($hasil->bayar)): ?>
                    <a href="<?= base_url('assets/bayar/'.$hasil->bayar) ?>" target="_blank">
                        <img src="<?= base_url('assets/bayar/'.$hasil->bayar) ?>" alt="" style="height: 50px; width: 50px; object-fit: cover;">
                    </a>
                <?php else: ?>
                    <span>Tidak ada foto</span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Tanggal Pembayaran</th>
            <td><?= do_formal_date($hasil->tgl_bayar) ?></td>
        </tr>
        <tr>
            <th>Status Pembayaran</th>
            <td>
                <?php if ($hasil->bayar == NULL): ?>
                    Belum Bayar
                <?php else: ?>
                    Lunas
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php endforeach; ?>
    <!-- Signature Section -->
    <div class="signature">
        <p>Pati, <?= date('d F Y') ?></p>
        <p><b>PEMILIK KLINIK</b></p>
        <br><br><br>
        <p><b><u>Ns. Ni'mah Vicky Priyani, S.Kep</u></b></p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
