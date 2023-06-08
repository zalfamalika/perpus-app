<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelBuku;
use App\Models\ModelKategori;
use App\Models\ModelRak;
use App\Models\ModelPenerbit;
use App\Models\ModelPenulis;

class Buku extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelBuku = new ModelBuku;
        $this->ModelKategori = new ModelKategori;
        $this->ModelRak = new ModelRak;
        $this->ModelPenerbit = new ModelPenerbit;
        $this->ModelPenulis = new ModelPenulis;
    }

    public function index()
    {
        $data = [
            'judul' => 'Buku',
            'page' => 'buku/v_index',
            'buku' => $this->ModelBuku->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function AddData()
    {
        $data = [
            'judul' => 'Add Buku',
            'page' => 'buku/v_adddata',
            'kategori' => $this->ModelKategori->AllData(),
            'penulis' => $this->ModelPenulis->AllData(),
            'penerbit' => $this->ModelPenerbit->AllData(),
            'rak' => $this->ModelRak->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function SimpanData()
    {
        if ($this->validate([
            'kode_buku' => [
                'label' => 'Kode Buku',
                'rules' => 'required|is_unique[tbl_buku.kode_buku]',
                'errors' => [
                    'required' =>'{field} Wajib Diisi !',
                    'is_unique' => '{field} Sudah Ada !',
                ]
                ],
                'isbn' => [
                    'label' => 'ISBN',
                    'rules' => 'required|is_unique[tbl_buku.isbn]',
                    'errors' => [
                        'required' =>'{field} Wajib Diisi !',
                        'is_unique' => '{field} Sudah Sudah Ada !',
                    ]
                    ],   
                    'judul_buku' => [
                        'label' => 'Judul Buku',
                        'rules' => 'required',
                        'errors' => [
                            'required' =>'{field} Wajib Diisi !',
                        ]
                        ],
                        'id_kategori' => [
                            'label' => 'Kategori',
                            'rules' => 'required',
                            'errors' => [
                                'required' =>'{field} Wajib Diisi !',
                            ]
                            ],
                            'id_penulis' => [
                                'label' => 'Penulis',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                                'id_rak' => [
                                    'label' => 'Lokasi Buku',
                                    'rules' => 'required',
                                    'errors' => [
                                        'required' =>'{field} Wajib Diisi !',
                                    ]
                                    ],
                                    'id_penerbit' => [
                                        'label' => 'Penerbit',
                                        'rules' => 'required',
                                        'errors' => [
                                            'required' =>'{field} Wajib Diisi !',
                                        ]
                                        ],
                                        'tahun' => [
                                            'label' => 'Tahun',
                                            'rules' => 'required',
                                            'errors' => [
                                                'required' =>'{field} Wajib Diisi !',
                                            ]
                                            ],
                                            'bahasa' => [
                                                'label' => 'Bahasa',
                                                'rules' => 'required',
                                                'errors' => [
                                                    'required' =>'{field} Wajib Diisi !',
                                                ]
                                                ],
                                                'halaman' => [
                                                    'label' => 'Halaman',
                                                    'rules' => 'required',
                                                    'errors' => [
                                                        'required' =>'{field} Wajib Diisi !',
                                                    ]
                                                    ],
                                                    'jumlah' => [
                                                        'label' => 'Jumlah Buku',
                                                        'rules' => 'required',
                                                        'errors' => [
                                                            'required' =>'{field} Wajib Diisi !',
                                                        ]
                                                        ],
                                'cover' => [
                                    'label' => 'Cover Buku',
                                    'rules' => 'uploaded[cover]|max_size[cover,1024]|mime_in[cover,image/png,image/jpg,image/jpeg]',
                                    'errors' => [
                                        'uploaded' =>'{field} Wajib Diisi !',
                                        'max_size' => '{field} Max 1024kb !',
                                        'mime_in' => 'Format {field} Harus JPG,PNG,JPEG !'
                                    ]
                                    ],

        ])) {
            //jika lolos validasi
            $cover = $this->request->getFile('cover');
            $nama_file = $cover->getRandomName();
            $data = [
                'kode_buku' => $this->request->getPost('kode_buku'),
                'isbn' => $this->request->getPost('isbn'),
                'judul_buku' => $this->request->getPost('judul_buku'),
                'id_penulis' => $this->request->getPost('id_penulis'),
                'id_penerbit' => $this->request->getPost('id_penerbit'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'tahun' => $this->request->getPost('tahun'),
                'bahasa' => $this->request->getPost('bahasa'),
                'halaman' => $this->request->getPost('halaman'),
                'id_rak' => $this->request->getPost('id_rak'),
                'jumlah' => $this->request->getPost('jumlah'),
                'jml_tersedia' => $this->request->getPost('jml_tersedia'),
                'jml_dipinjam' => '0',
                'cover' => $nama_file,
            ];
            //memindahkan/upload file foto ke dalam folder foto
            $cover->move('cover', $nama_file);
            $this->ModelBuku->AddData($data);
            session()->setFlashdata('pesan','Data Berhasil Simpan');
            return redirect()->to(base_url('Buku'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Buku/AddData'))->withInput('validation',\Config\Services::validation());
        }
    }

    public function EditData($id_buku)
    {
        $data = [
            'judul' => 'Edit Buku',
            'page' => 'buku/v_editdata',
            'kategori' => $this->ModelKategori->AllData(),
            'penulis' => $this->ModelPenulis->AllData(),
            'penerbit' => $this->ModelPenerbit->AllData(),
            'rak' => $this->ModelRak->AllData(),
            'buku' => $this->ModelBuku->DetailData($id_buku),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateData($id_buku)
    {
        if ($this->validate([
            'kode_buku' => [
                'label' => 'Kode Buku',
                'rules' => 'required',
                'errors' => [
                    'required' =>'{field} Wajib Diisi !',
                ]
                ],
                'isbn' => [
                    'label' => 'ISBN',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Wajib Diisi !',
                    ]
                    ],   
                    'judul_buku' => [
                        'label' => 'Judul Buku',
                        'rules' => 'required',
                        'errors' => [
                            'required' =>'{field} Wajib Diisi !',
                        ]
                        ],
                        'id_kategori' => [
                            'label' => 'Kategori',
                            'rules' => 'required',
                            'errors' => [
                                'required' =>'{field} Wajib Diisi !',
                            ]
                            ],
                            'id_penulis' => [
                                'label' => 'Penulis',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                                'id_rak' => [
                                    'label' => 'Lokasi Buku',
                                    'rules' => 'required',
                                    'errors' => [
                                        'required' =>'{field} Wajib Diisi !',
                                    ]
                                    ],
                                    'id_penerbit' => [
                                        'label' => 'Penerbit',
                                        'rules' => 'required',
                                        'errors' => [
                                            'required' =>'{field} Wajib Diisi !',
                                        ]
                                        ],
                                        'tahun' => [
                                            'label' => 'Tahun',
                                            'rules' => 'required',
                                            'errors' => [
                                                'required' =>'{field} Wajib Diisi !',
                                            ]
                                            ],
                                            'bahasa' => [
                                                'label' => 'Bahasa',
                                                'rules' => 'required',
                                                'errors' => [
                                                    'required' =>'{field} Wajib Diisi !',
                                                ]
                                                ],
                                                'halaman' => [
                                                    'label' => 'Halaman',
                                                    'rules' => 'required',
                                                    'errors' => [
                                                        'required' =>'{field} Wajib Diisi !',
                                                    ]
                                                    ],
                                                    'jumlah' => [
                                                        'label' => 'Jumlah Buku',
                                                        'rules' => 'required',
                                                        'errors' => [
                                                            'required' =>'{field} Wajib Diisi !',
                                                        ]
                                                        ],
                                'cover' => [
                                    'label' => 'Cover Buku',
                                    'rules' => 'max_size[cover,1024]|mime_in[cover,image/png,image/jpg,image/jpeg]',
                                    'errors' => [
                                        'max_size' => '{field} Max 1024kb !',
                                        'mime_in' => 'Format {field} Harus JPG,PNG,JPEG !'
                                    ]
                                    ],

        ])) {
            //jika lolos validasi
            $cover = $this->request->getFile('cover');
            if ($cover->getError()== 4) {
                //tanpa update cover
                $data = [
                    'id_buku' => $id_buku,
                    'kode_buku' => $this->request->getPost('kode_buku'),
                    'isbn' => $this->request->getPost('isbn'),
                    'judul_buku' => $this->request->getPost('judul_buku'),
                    'id_penulis' => $this->request->getPost('id_penulis'),
                    'id_penerbit' => $this->request->getPost('id_penerbit'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'tahun' => $this->request->getPost('tahun'),
                    'bahasa' => $this->request->getPost('bahasa'),
                    'halaman' => $this->request->getPost('halaman'),
                    'id_rak' => $this->request->getPost('id_rak'),
                    'jumlah' => $this->request->getPost('jumlah'),
                ];
                $this->ModelBuku->EditData($data);
            } else {
                //hapus cover lama
                $buku = $this->ModelBuku->DetailData($id_buku);
                if ($buku['cover'] <> '') {   
                    unlink('cover/' .$buku['cover']);  
                }
               //jika ganti cover 
               $nama_file = $cover->getRandomName();
               $data = [
                   'id_buku' => $id_buku,
                   'kode_buku' => $this->request->getPost('kode_buku'),
                   'isbn' => $this->request->getPost('isbn'),
                   'judul_buku' => $this->request->getPost('judul_buku'),
                   'id_penulis' => $this->request->getPost('id_penulis'),
                   'id_penerbit' => $this->request->getPost('id_penerbit'),
                   'id_kategori' => $this->request->getPost('id_kategori'),
                   'tahun' => $this->request->getPost('tahun'),
                   'bahasa' => $this->request->getPost('bahasa'),
                   'halaman' => $this->request->getPost('halaman'),
                   'id_rak' => $this->request->getPost('id_rak'),
                   'jumlah' => $this->request->getPost('jumlah'),
                   'cover' => $nama_file,
               ];
               //memindahkan/upload file foto ke dalam folder foto
               $cover->move('cover', $nama_file);
               $this->ModelBuku->EditData($data);
            }
            session()->setFlashdata('pesan','Data Berhasil Simpan');
            return redirect()->to(base_url('Buku'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Buku/EditData/'.$id_buku))->withInput('validation',\Config\Services::validation());
        }
    }

    public function DeleteData($id_buku)
    {
         //hapus foto lama
         $buku = $this->ModelBuku->DetailData($id_buku);
         if ($buku['cover'] <> '' or $buku['cover'] <> null) {     
         }
        $data = ['id_buku'=> $id_buku];
         $this->ModelBuku->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus');
         return redirect()->to(base_url('Buku'));
    }

}
