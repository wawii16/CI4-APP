<?php

namespace App\Models;

use CodeIgniter\Model;

class mahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    // public function __construct()
    // {
    //     $this->db = db_connect();
    //     // $this->db->table('mahasiswa') = $this->db->table($this->table);
    // }
    public function getAllData($id = null)
    {
        if ($id == null) {
            return $this->db->table('mahasiswa')->get()->getResultArray();
        } else {
            $this->db->table('mahasiswa')->where('id', $id);
            $query = $this->db->table('mahasiswa')->where('id', $id)->get();
            return $query->getRowArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table('mahasiswa')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('mahasiswa')->delete(['id' => $id]);
    }
    public function ubah($data, $id)
    {
        return $this->db->table('mahasiswa')->update($data, ['id' => $id]);
    }
    public function search($keyword)
    {
        $builder = $this->table('mahasiswa');
        $builder->like('nama', $keyword);
        return $builder;
    }
    public function getMahasiswaData($id)
    {
        return $this->where('id', $id)->first();
    }
    public function countAll()
    {
        return $this->countAllResults();
    }
    public function countStudentsByJurusan()
    {
        $this->select('jurusan, COUNT(*) as jumlah_mahasiswa')
            ->groupBy('jurusan');
        return $this->findAll();
    }
}
