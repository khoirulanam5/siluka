<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
    <h3 style="text-align: center;">Nota Pembayaran Homecare</h3>
    <?php foreach ($hasil as $val): ?>
    <table>
        <tr>
            <th>Nama Pasien</th>
            <td><?= $val->nm_pasien ?></td>
        </tr>
        <tr>
            <th>Nama Perawatan</th>
            <td><?= $val->nama_perawatan ?></td>
        </tr>
        <tr>
            <th>Kondisi Luka</th>
            <td>
                <?php if (!empty($val->foto)): ?>
                    <a href="<?= base_url('assets/luka/'.$val->foto) ?>" target="_blank">
                        <img src="<?= base_url('assets/luka/'.$val->foto) ?>" alt="" style="height: 50px; width: 50px; object-fit: cover;">
                    </a>
                <?php else: ?>
                    <span>Tidak ada foto</span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Tanggal Kunjungan</th>
            <td><?= do_formal_date($val->tgl_kunjungan) ?></td>
        </tr>
        <tr>
            <th>Jam</th>
            <td><?= $val->jam ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?= $val->alamat_kunjungan ?></td>
        </tr>
        <tr>
            <th>Catatan</th>
            <td><?= $val->catatan_kunjungan ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= $val->status ?></td>
        </tr>
        <tr>
            <th>Bukti Bayar</th>
            <td>
                <?php if (!empty($val->bayar)): ?>
                    <a href="<?= base_url('assets/bayar/'.$val->bayar) ?>" target="_blank">
                        <img src="<?= base_url('assets/bayar/'.$val->bayar) ?>" alt="" style="height: 50px; width: 50px; object-fit: cover;">
                    </a>
                <?php else: ?>
                    <span>Tidak ada foto</span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Tanggal Pembayaran</th>
            <td><?= do_formal_date($val->tgl_bayar) ?></td>
        </tr>
        <tr>
            <th>Pembayaran</th>
            <td>
                <?php if ($val->bayar == NULL): ?>
                    <a href="<?= base_url('pasien/hasil/bayar/'.$val->id_pembayaran) ?>" class="badge bg-warning">Belum Bayar</a>
                <?php else: ?>
                    <span class="badge bg-primary">Lunas</span>
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
