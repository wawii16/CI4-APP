<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    public function __construct()
    {
        $this->session = service('session');
        $this->auth   = service('authentication');
        helper('sn');
    }
    public function getMahasiswaInfo($id)
    {
        // Memuat helper 'sn'

        // Data yang akan dikirimkan ke tampilan
        $data = [
            'judul' => 'Data Mahasiswa',
            'nama' => 'Nama Mahasiswa',
            'nim' => 'NIM Mahasiswa',
        ];

        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaData = $mahasiswaModel->getMahasiswaData($id);

        if ($mahasiswaData) {
            // Kirim data ke tampilan
            echo view('layout/v_header', $data);
            echo view('layout/v_sidebar');
            echo view('layout/v_topbar');
            return view('nilai/index', ['mahasiswaData' => $mahasiswaData, 'data' => $data]);
            echo view('layout/v_footer');
        } else {
            return 'Data Mahasiswa tidak ditemukan';
        }
    }
}
