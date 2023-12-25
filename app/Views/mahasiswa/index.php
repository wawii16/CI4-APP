<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col">
            <h1 class="h3 mb-1 text-gray-800"><?= $judul; ?></h1>
        </div>
    </div>

    <!-- <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Mahasiswa berhasil <strong><?= session()->getFlashdata('message'); ?></strong>
        </div>
    <?php endif; ?> -->

    <div class="swal" data-swal="<?= session()->get('message') ?>"></div>

    <div class="row">
        <div class="col-md-6">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger p-0 pt-2' role='alert'>" . session()->get('err') . " </div>";
                session()->remove('err');
            }

            ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"> Tambah Data</i>
            </button>

        </div>
        <div class="row">
            <div class="col-7 ml-3">
                <form action="" method="post">
                    <div class="input-group mt-3">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Data..." aria-label="Search" aria-describedby="basic-addon2" name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jurusan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                    <?php foreach ($mahasiswa as $row) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['nim']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['alamat']; ?></td>
                            <td><?= $row['jurusan']; ?></td>
                            <td style="width: 150px">
                                <a type="button" class="btn btn-sm btn-secondary" href="<?= base_url('nilai/' . $row['id']); ?>"><i class="fa fa-info-circle"></i></a>

                                <button type="button" data-toggle="modal" data-target="#modalUbah" class="btn btn-sm btn-warning" id="btn-edit" data-id="<?= $row['id']; ?>" data-nim="<?= $row['nim']; ?>" data-nama="<?= $row['nama']; ?>" data-alamat="<?= $row['alamat']; ?>" data-jurusan="<?= $row['jurusan']; ?>"><i class="fa fa-edit"></i></button>
                                <button type="button" data-toggle="modal" data-target="#modalHapus" id="btn-hapus" class="btn btn-sm btn-danger" data-id="<?= $row['id']; ?>"> <i class="fa fa-trash-alt"></i> </button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('mahasiswa', 'mahasiswa_pagination'); ?>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Button trigger modal -->


<!-- Modal Tambah data mahasiswa -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('mahasiswa/tambah') ?>" method="post">
                    <div class="form-group mb-0">
                        <label for="nim"></label>
                        <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan NIM">
                    </div>
                    <div class="form-group mb-0 ">
                        <label for="nama"></label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Mahasiswa">
                    </div>
                    <div class="form-group mb-0 ">
                        <label for="alamat"></label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat Saat ini">
                    </div>
                    <div class="form-group mb-0">
                        <label for="jurusan"></label>
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option value="">Pilih Jurusan</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Komputer">Teknik Komputer</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- Modal ubah data mahasiswa -->
<div class="modal fade" id="modalUbah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('mahasiswa/ubah') ?>" method="post">
                    <input type="hidden" name="id" id="id-mahasiswa">
                    <div class="form-group mb-0">
                        <label for="nim"></label>
                        <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan NIM" value="<?= !empty($row) ? $row['nim'] : ''; ?>">
                    </div>
                    <div class="form-group mb-0 ">
                        <label for="nama"></label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Mahasiswa" value="<?= !empty($row) ? $row['nama'] : ''; ?>">
                    </div>
                    <div class="form-group mb-0 ">
                        <label for="alamat"></label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat Saat ini" value="<?= !empty($row) ? $row['alamat'] : ''; ?>">
                    </div>
                    <div class="form-group mb-0">
                        <label for="jurusan"></label>
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option value="">Pilih Jurusan</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Komputer">Teknik Komputer</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
            </div>
        </div>
        </form>
    </div>
</div>


<!-- Modal Hapus data Mahasiswa-->
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/mahasiswa/hapus" method="post">
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus data ini?
                    <input type="hidden" id="id-Mahasiswa" name="id-Mahasiswa">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>