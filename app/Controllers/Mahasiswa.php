<?php

namespace App\Controllers;

use App\Models\mahasiswaModel;

class Mahasiswa extends BaseController
{
    public function __construct()
    {
        $this->model = new mahasiswaModel;
        $this->session = service('session');
        $this->auth   = service('authentication');
        helper('sn');
    }
    public function index()
    {

        //jika belum login, user tidak memiliki akses
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url($this->config->landingRoute);
            unset($_SESSION['redirect_url']);

            return redirect()
                ->to($redirectURL);
        }


        //search

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $mahasiswa = $this->model->search($keyword);
        } else {
            $mahasiswa = $this->model;
        }


        $currentPage = $this->request->getVar('page_mahasiswa') ? $this->request->getVar('page_mahasiswa') : 1;
        $data = [
            'judul' => 'Data Mahasiswa',
            // 'mahasiswa' => $this->model->getAllData()
            'mahasiswa' => $mahasiswa->paginate('5', 'mahasiswa'),
            'pager' => $this->model->pager,
            'currentPage' => $currentPage
        ];
        // load view
        tampilan('mahasiswa/index', $data);
    }
    public function tambah()
    {
        if (isset($_POST['tambah'])) {
            $val = $this->validate([
                'nim' => [
                    'label' => 'Nomor Induk Mahasiswa',
                    'rules' => 'required|numeric|max_length[11]|is_unique[mahasiswa.nim]'
                ],
                'nama' => [
                    'label' => 'Nama Mahasiswa',
                    'rules' => 'required'
                ],
                'alamat' => [
                    'label' => 'Alamat Rumah',
                    'rules' => 'required'
                ],
                'jurusan' => [
                    'label' => 'Jurusan',
                    'rules' => 'required'
                ],
            ]);
            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                $currentPage = $this->request->getVar('page_mahasiswa') ? $this->request->getVar('page_mahasiswa') : 1;
                $data = [
                    'judul' => 'Data Mahasiswa',
                    // 'mahasiswa' => $this->model->getAllData()
                    'mahasiswa' => $this->model->paginate('5', 'mahasiswa'),
                    'pager' => $this->model->pager,
                    'currentPage' => $currentPage
                ];
                // load view
                tampilan('mahasiswa/index', $data);
            } else {
                $data = [
                    'nim' => $this->request->getPost('nim'),
                    'nama' => $this->request->getPost('nama'),
                    'alamat' => $this->request->getPost('alamat'),
                    'jurusan' => $this->request->getPost('jurusan')
                ];
                //insert data
                $success = $this->model->tambah($data);
                if ($success) {
                    session()->setFlashdata('message', 'Ditambahkan');
                    return redirect()->to(base_url('mahasiswa'));
                }
            }
        } else {
            return redirect()->to(base_url('mahasiswa'));
        }
    }


    public function ubah()
    {
        if (isset($_POST['ubah'])) {
            $id = $this->request->getPost('id');
            $nim = $this->request->getPost('nim');
            $db_nim = $this->model->getAllData($id)['nim'];

            if ($nim === $db_nim) {
                $val = $this->validate([
                    'nim' => [
                        'label' => 'Nomor Induk Mahasiswa',
                        'rules' => 'required|numeric|max_length[11]'
                    ],
                    'nama' => [
                        'label' => 'Nama Mahasiswa',
                        'rules' => 'required'
                    ],
                    'alamat' => [
                        'label' => 'Alamat Rumah',
                        'rules' => 'required'
                    ],
                    'jurusan' => [
                        'label' => 'Jurusan',
                        'rules' => 'required'
                    ]
                ]);
            } else {
                $val = $this->validate([
                    'nim' => [
                        'label' => 'Nomor Induk Mahasiswa',
                        'rules' => 'required|numeric|max_length[11]|is_unique[mahasiswa.nim]'
                    ],
                    'nama' => [
                        'label' => 'Nama Mahasiswa',
                        'rules' => 'required'
                    ],
                    'alamat' => [
                        'label' => 'Alamat Rumah',
                        'rules' => 'required'
                    ],
                    'jurusan' => [
                        'label' => 'Jurusan',
                        'rules' => 'required'
                    ]
                ]);
            }

            if (!$val) {
                $currentPage = $this->request->getVar('page_mahasiswa') ? $this->request->getVar('page_mahasiswa') : 1;
                $data = [
                    'judul' => 'Data Mahasiswa',
                    // 'mahasiswa' => $this->model->getAllData()
                    'mahasiswa' => $this->model->paginate('5', 'mahasiswa'),
                    'pager' => $this->model->pager,
                    'currentPage' => $currentPage
                ];
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                // load view
                tampilan('mahasiswa/index', $data);
            } else {
                $id = $this->request->getPost('id');
                $data = [
                    'nim' => $this->request->getPost('nim'),
                    'nama' => $this->request->getPost('nama'),
                    'alamat' => $this->request->getPost('alamat'),
                    'jurusan' => $this->request->getPost('jurusan')
                ];

                //ubah data

                $success = $this->model->ubah($data, $id);
                if ($success) {
                    session()->setFlashdata('message', 'Diubah');
                    return redirect()->to(base_url('mahasiswa'));
                }
            }
        } else {
            return redirect()->to(base_url('mahasiswa'));
        }
    }
    public function hapus()
    {
        $id = $this->request->getPost('id-Mahasiswa');
        $this->model->hapus($id);
        session()->setFlashdata('message', 'Dihapus!');
        return redirect()->to('/mahasiswa');
    }
}
