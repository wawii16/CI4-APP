<!DOCTYPE html>
<html>

<head>
    <title>Info Mahasiswa</title>
</head>
<div class="container-fluid">

    <body>
        <h2>Informasi Mahasiswa</h2>
        <?php if ($mahasiswaData) : ?>
            <table class="table table-bordered">
                <tr>
                    <th>NIM</th>
                    <td><?= $mahasiswaData['nim']; ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?= $mahasiswaData['nama']; ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= $mahasiswaData['alamat']; ?></td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td><?= $mahasiswaData['jurusan']; ?></td>
                </tr>
            </table>
        <?php else : ?>
            <p>Data Mahasiswa tidak ditemukan</p>
        <?php endif; ?>
    </body>
</div>

</html>