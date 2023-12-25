<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?= view('Myth\Auth\Views\_message_block') ?>

    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <p>Jumlah Mahasiswa: <?= $count; ?></p>
    <table>
        <tr>
            <th>Jurusan</th>
            <th>Jumlah Mahasiswa</th>
        </tr>
        <?php foreach ($mahasiswa_jurusan as $row) : ?>
            <tr>
                <td><?= $row['jurusan']; ?></td>
                <td><?= $row['jumlah_mahasiswa']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->