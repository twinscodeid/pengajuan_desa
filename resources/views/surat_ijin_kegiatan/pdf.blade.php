<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Ijin Kegiatan</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 14px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
        }

        .kop {
            font-weight: bold;
            text-transform: uppercase;
        }

        .judul-surat {
            text-align: center;
            margin-top: 20px;
            text-decoration: underline;
            font-weight: bold;
        }

        .nomor-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .isi-surat {
            text-align: justify;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
        }

        table {
            width: 100%;
        }

        td {
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" width="70">
        <div class="kop">
            PEMERINTAH DESA CEPOGO<br>
            KECAMATAN KEMBANG<br>
            KABUPATEN JEPARA<br>
        </div>
        <div>Jl. Raya Cepogo-Bucu</div>
    </div>

    <div class="judul-surat">SURAT KETERANGAN IJIN KEGIATAN</div>
    <div class="nomor-surat">Nomor: 477/....../Kode Desa/20..</div>

    <div class="isi-surat">
        Yang bertanda tangan di bawah ini Kepala Desa Cepogo Kecamatan Kembang Kabupaten
        Jepara, Provinsi Jawa Tengah, menerangkan dengan sebenarnya bahwa:
        <br><br>

        <table>
            <tr>
                <td width="5%">1.</td>
                <td>Nama</td>
                <td>: {{ $data->nama }}</td>
            </tr>
            <tr>
                <td width="5%">2.</td>
                <td>Jenis Kelamin</td>
                <td>: {{ $data->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td width="5%">3.</td>
                <td>Alamat</td>
                <td>: {{ $data->alamat }}</td>
            </tr>
            <tr>
                <td width="5%">4.</td>
                <td>No HP</td>
                <td>: {{ $data->no_hp }}</td>
            </tr>
            <tr>
                <td width="5%">5.</td>
                <td>Tanggal Kegiatan</td>
                <td>: {{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td width="5%">6.</td>
                <td>Tempat Kegiatan</td>
                <td>: {{ $data->tempat_kegiatan }}</td>
            </tr>
            <tr>
                <td width="5%">7.</td>
                <td>Tujuan Kegiatan</td>
                <td>: {{ $data->tujuan_kegiatan }}</td>
            </tr>
        </table>

        <br>
        Orang tersebut benar-benar berdomisili di Desa Cepogo Kecamatan Kembang Kabupaten
        Jepara. Surat ini diberikan untuk keperluan perijinan kegiatan sebagaimana tersebut di atas.

        <br><br>
        Demikian surat ini dibuat dengan sebenarnya dan untuk dipergunakan sebagaimana mestinya.
    </div>

    <div class="footer px-20">
        <div style="text-align: right; padding-right: 40px;">
            Jepara, {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
        </div>
        <br><br>
        <table style="width: 100%; padding-left: 40px; padding-right: 40px;">
            <tr>
                <td width="50%" style="text-align:left">
                    KEPALA DESA CEPOGO<br><br><br><br>
                    ..................................
                </td>
                <td width="50%" style="text-align:right">
                    PEMOHON,<br><br><br><br>
                    {{ $data->nama }}
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
