<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    body {
        margin: 10mm;
        font-family: Arial, sans-serif;
    }

    @media print {
        .no-print {
            display: none;
        }
    }

    .header-container {
        display: flex;
        align-items: center;
        margin-bottom: 5px; /* Kurangi margin agar lebih dekat */
        page-break-after: avoid; /* Hindari pemisahan header */
    }

    .header-logo {
        height: 100px;
    }

    .header-text {
        text-align: center;
        width: 100%;
    }

    hr {
        margin-top: 5px; /* Kurangi margin agar dekat dengan tabel */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px; /* Kurangi jarak tabel */
        page-break-before: avoid; /* Hindari tabel muncul di halaman baru */
        page-break-inside: auto; /* Biarkan tabel terbagi jika terlalu panjang */
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        font-size: 12px;
    }

    @media print and (orientation: portrait) {
        th, td {
            font-size: 10px;
            padding: 5px;
        }
    }

    .signature {
        margin-top: 30px;
        text-align: right;
        page-break-inside: avoid; /* Hindari tanda tangan terpotong */
    }

    @media print {
        .header-container, table, .signature {
            page-break-after: avoid; /* Hindari elemen terpisah */
        }
    }
</style>
</head>
<body>
    <div class="print-container">
        <!-- Header Section -->
        <div class="header-container">
            <div>
                <img src="<?= base_url('assets/images/loading.png') ?>" alt="Logo" class="header-logo">
            </div>
            <div class="header-text">
                <h2><b>KLINIK RAWAT LUKA DIABETES PATI</b></h2>
                <p>Alamat: Jl. Juwana Jakenan KM 01, Tambak Pekuwon, Kecamatan Juwana, Kabupaten Pati, Jawa Tengah  59185<br>
                   No. Telp: 0812-6167-1916
                </p>
            </div>
        </div>
        <hr style="border: 2px solid black;">

        <!-- Content Section -->
        <h3 style="text-align: center;">DATA PASIEN</h3>
        <table id="datatable" class="table data-table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pasien</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($pasien as $val): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $val->id_pasien ?></td>
                        <td><?= $val->nm_pasien ?></td>
                        <td><?= $val->nik ?></td>
                        <td><?= $val->umur ?></td>
                        <td><?= $val->jenis_kelamin ?></td>
                        <td><?= $val->no_hp ?></td>
                        <td><?= $val->email ?></td>
                        <td><?= $val->alamat ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Signature Section -->
    <div class="signature">
        <p>Pati, <?= date('d F Y'); ?></p>
        <p><b>PEMILIK KLINIK</b></p>
        <br><br><br>
        <div>
            <p><b><u>Ns. Ni'mah Vicky Priyani, S.Kep</u></b></p>
        </div>
    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>
