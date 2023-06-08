<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelPengaturan;

class Pengaturan extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelPengaturan = new ModelPengaturan();
    }

    public function web()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'web',
            'judul' => 'Pengaturan Web',
            'page' => 'v_pengaturan_web',
            'web' => $this->ModelPengaturan->DetailWeb(),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateWeb()
    {
        if ($this->validate([
            'nama_sekolah' => [
                'label' => 'Nama Sekolah',
                'rules' => 'required',
                'errors' => [
                    'required' =>'{field} Wajib Diisi !',
                ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Wajib Diisi !',
                    ]
                    ],   
                    'kecamatan' => [
                        'label' => 'Kecamatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' =>'{field} Wajib Diisi !',
                        ]
                        ],
                        'kab_kota' => [
                            'label' => 'Kabupaten / Kota',
                            'rules' => 'required',
                            'errors' => [
                                'required' =>'{field} Wajib Diisi !',
                            ]
                            ],
                            'pos' => [
                                'label' => 'Pos',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                            'no_telpon' => [
                                'label' => 'No Telpon',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                                'sejarah' => [
                                    'label' => 'Sejarah',
                                    'rules' => 'required',
                                    'errors' => [
                                        'required' =>'{field} Wajib Diisi !',
                                    ]
                                    ],
                                    'visi' => [
                                        'label' => 'Visi',
                                        'rules' => 'required',
                                        'errors' => [
                                            'required' =>'{field} Wajib Diisi !',
                                        ]
                                        ],
                                        'misi' => [
                                            'label' => 'Misi',
                                            'rules' => 'required',
                                            'errors' => [
                                                'required' =>'{field} Wajib Diisi !',
                                            ]
                                            ],
                                'logo' => [
                                    'label' => 'Logo',
                                    'rules' => 'max_size[logo,1024]|mime_in[logo,image/png]',
                                    'errors' => [
                                        'max_size' => '{field} Max 1024kb !',
                                        'mime_in' => 'Format {field} Harus PNG !'
                                    ]
                                    ],

        ])) {
            //jika lolos validasi
            $logo = $this->request->getFile('logo');

            if ($logo->getError()== 4) {
                //jika tidak ganti logo
                $nama_file = $logo->getRandomName();
                $data = [
                    'id_web' => '1',
                    'nama_sekolah' => $this->request->getPost('nama_sekolah'),
                    'alamat' => $this->request->getPost('alamat'),
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kab_kota' => $this->request->getPost('kab_kota'),
                    'pos' => $this->request->getPost('pos'),
                    'no_telpon' => $this->request->getPost('no_telpon'),
                    'sejarah' => $this->request->getPost('sejarah'),
                    'visi' => $this->request->getPost('visi'),
                    'misi' => $this->request->getPost('misi'),
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $this->ModelPengaturan->UpdateWeb($data);

            } else {
                //hapus foto lama
                $web = $this->ModelPengaturan->DetailWeb();
                if ($web['logo'] <> '') {
                    unlink('logo/'. $web['logo']);
                }
                //jika ganti gambar
                $nama_file = $logo->getRandomName();
                $data = [
                    'id_web' => '1',
                    'nama_sekolah' => $this->request->getPost('nama_sekolah'),
                    'alamat' => $this->request->getPost('alamat'),
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kab_kota' => $this->request->getPost('kab_kota'),
                    'pos' => $this->request->getPost('pos'),
                    'no_telpon' => $this->request->getPost('no_telpon'),
                    'sejarah' => $this->request->getPost('sejarah'),
                    'visi' => $this->request->getPost('visi'),
                    'misi' => $this->request->getPost('misi'),
                    'logo' => $nama_file
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $logo->move('logo', $nama_file);
                $this->ModelPengaturan->UpdateWeb($data);
            }

    
            session()->setFlashdata('pesan','Data Berhasil Di Update');
            return redirect()->to(base_url('Pengaturan/web'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pengaturan/web/'));
        }
    }

    public function Slider()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'slider',
            'judul' => 'Data Slider',
            'page' => 'v_slider',
            'slider' => $this->ModelPengaturan->Slider(),
        ];
        return view('v_template_admin', $data);
    }
}
