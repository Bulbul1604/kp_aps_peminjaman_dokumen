<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        td,
        th {
            text-align: left;
            padding: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .td {
            width: 40%;
        }

        ul li {
            list-style: none;
        }
    </style>
</head>

<body>
    <img src="<?= base_url('assets/img/logodasar.png'); ?>" alt="" width="100">
    <br>
    <br>
    <br>
    <table>
        <tr>
            <td class="td">Nama</td>
            <td>: <?= ucwords($permohonan->nama) ?></td>
        </tr>
        <tr>
            <td class="td">NPK</td>
            <td>: <?= ucwords($permohonan->npk) ?></td>
        </tr>
        <tr>
            <td class="td">Unit Kerja</td>
            <td>: <?= ucwords($permohonan->unit_kerja) ?></td>
        </tr>
        <tr>
            <td class="td">Jenis permintaan/Peminjaman</td>
            <td>: <?= ucwords($permohonan->jenis) ?></td>
        </tr>
        <tr>
            <td class="td">Nomor permintaan</td>
            <td>: <?= ucwords($permohonan->no_permintaan) ?></td>
        </tr>
        <tr>
            <td class="td">Tanggal Permintaan</td>
            <td>: <?= date("d F Y", strtotime($permohonan->tgl_permintaan)) ?></td>
        </tr>
        <tr>
            <td class="td">Keperluan</td>
            <td>: <?= ucwords($permohonan->keperluan) ?></td>
        </tr>
        <tr>
            <td class="td">Tanggal Pinjam</td>
            <td>: <?= date("d F Y", strtotime($permohonan->tgl_pinjam)) ?></td>
        </tr>
        <tr>
            <td class="td">Tanggal Kembali</td>
            <td>: <?= date("d F Y", strtotime($permohonan->tgl_kembali)) ?></td>
        </tr>
    </table>
    <br>
    <p style="text-align: justify; line-height: 25px;">Dengan ini Dept.Administrasi Koorporasi memberikan sebuah dokumen kepada Unit kerja yang membutuhkan untuk mencapai tujuan kerja Bersama. Atas ketentuan yang berlaku, terdapat beberapa point yang harus diikuti demi keamanan dokumen terjaga antara lain:</p>
    <ul>
        <li style="margin-bottom: 10px;">1. Tidak memindah tangankan dokumen kepada pihak ketiga.</li>
        <li style="margin-bottom: 10px;">2. Menjaga kerahasiaan dokumen.</li>
        <li style="margin-bottom: 10px;">3. Mengembalikan dokumen sesuai dengan estimasi yang telah dibuat.</li>
    </ul>
    <p style="text-align: justify; line-height: 25px;">Demikian pernyataan ini, segala kejahatan yang terjadi diluar dari kendali Pusat Arsip merupakan tanggung jawab dari peminjam/peminta.</p>
</body>

</html>
