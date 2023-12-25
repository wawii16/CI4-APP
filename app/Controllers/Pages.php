<?php

namespace App\Controllers;

use App\Models\mahasiswaModel;


class Pages extends BaseController
{
    public function __construct()
    {
        $this->model = new mahasiswaModel;
        helper('sn');
        $this->session = service('session');
        $this->auth   = service('authentication');
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
        $data = [
            'judul' => 'Homepage'
        ];
        // load view
        $data['count'] = $this->model->countAll();
        $data['mahasiswa_jurusan'] = $this->model->countStudentsByJurusan();

        tampilan('home/index', $data);
    }
}
