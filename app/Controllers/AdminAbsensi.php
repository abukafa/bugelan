<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MemberModel;
use App\Controllers\BaseController;
use App\Models\AbsensiModel;

class AdminAbsensi extends BaseController
{
    protected $userModel;
    protected $memberModel;
    protected $absensiModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->memberModel = new MemberModel();
        $this->absensiModel = new AbsensiModel();
    }

    public function getByIdm($idm)
    {
        $hadir1 = $hadir2 = $hadir3 = $hadir4 = $hadir5 = $hadir6 = 0;
        $absensi = $this->absensiModel->where('idm', $idm)->get()->getResultArray();
        foreach ($absensi as $abs) {
            if ($abs['tanggal'] == date('Y-m-d')) {
                $hadir1 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
            }
            if ($abs['tanggal'] == date('Y-m-d', strtotime("-1 days"))) {
                $hadir2 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
            }
            if ($abs['tanggal'] == date('Y-m-d', strtotime("-2 days"))) {
                $hadir3 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
            }
            if ($abs['tanggal'] == date('Y-m-d', strtotime("-3 days"))) {
                $hadir4 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
            }
            if ($abs['tanggal'] == date('Y-m-d', strtotime("-4 days"))) {
                $hadir5 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
            }
            if ($abs['tanggal'] == date('Y-m-d', strtotime("-5 days"))) {
                $hadir6 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
            }
            $data = [
                'h1' => $hadir1,
                'h2' => $hadir2,
                'h3' => $hadir3,
                'h4' => $hadir4,
                'h5' => $hadir5,
                'h6' => $hadir6,
            ];
        }
        echo json_encode($data);
    }

    public function index($thn = NULL)
    {
        if ($thn == NULL) {
            $tah = (date('m') > 6 ? date('Y') : date('Y') - 1) - 2;
            $member = $this->memberModel->where('akun', 'Siswa')->where('tahun >= ', $tah)->findAll();
        } else {
            $member = $this->memberModel->where('akun', 'Siswa')->where('tahun', $thn)->findAll();
        }
        $data = [
            'title' => 'Absensi',
            'tahun' => $thn,
            'member' => $member,
            'absensi' => $this->absensiModel->where('tanggal', date('Y-m-d'))->findAll()
        ];
        // dd($data);
        return view('admin/absensi', $data);
    }

    public function ceklis($jam, $id)
    {
        if ($this->request->isAJAX()) {
            $member = $this->memberModel->find($id);
            $absensi = $this->absensiModel->where('idm', $id)->where('tanggal', date('Y-m-d'))->first();
            if (!$absensi) {
                $this->absensiModel->save([
                    'idm' => $member['id'],
                    'akun' => $member['akun'],
                    'tahun' => $member['tahun'],
                    'panggil' => $member['panggil'],
                    'tanggal' => date('Y-m-d'),
                    'jam1' => true,
                    'jam2' => true,
                    'jam3' => true,
                    'jam4' => true,
                    'jam5' => true,
                    'absen' => '',
                    'ket' => ''
                ]);
                $cek = 'baru';
            } else {
                if ($absensi[$jam] == true) {
                    $this->absensiModel->set($jam, false);
                    $cek = false;
                } else {
                    $this->absensiModel->set([$jam => true, 'absen' => '', 'ket' => '']);
                    $cek = true;
                }
                $this->absensiModel->where('id', $absensi['id']);
                $this->absensiModel->update();
            }
            echo json_encode($cek);
        } else {
            exit('Terjadi Kesalahan!');
        }
    }

    public function absen($idm)
    {
        $absen = $this->request->getPost('absen');
        $ket = $this->request->getPost('ket');
        $member = $this->memberModel->find($idm);
        $absensi = $this->absensiModel->where('idm', $idm)->where('tanggal', date('Y-m-d'))->first();
        $thn = intval($member['tahun']);
        if (!$absensi) {
            $this->absensiModel->save([
                'idm' => $member['id'],
                'akun' => $member['akun'],
                'tahun' => $thn,
                'panggil' => $member['panggil'],
                'tanggal' => date('Y-m-d'),
                'jam1' => false,
                'jam2' => false,
                'jam3' => false,
                'jam4' => false,
                'jam5' => false,
                'absen' => $absen,
                'ket' => $ket ?: ''
            ]);
            $cek = 'baru';
        } else {
            $this->absensiModel->set([
                'jam1' => false,
                'jam2' => false,
                'jam3' => false,
                'jam4' => false,
                'jam5' => false,
                'absen' => $absen,
                'ket' => $ket
            ]);
            $this->absensiModel->where('id', $absensi['id']);
            $this->absensiModel->update();
        }
        return redirect()->to('data/absensi/' . $thn);
    }
}
