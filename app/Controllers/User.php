<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelUser;

class User extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelUser = new ModelUser;
    }

    public function index()
    {
        $data = [
            'judul' => 'User',
            'page' => 'user/v_index',
            'user' => $this->ModelUser->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function AddData()
    {
        $data = [
            'judul' => 'Tambah Data User',
            'page' => 'user/v_adddata',
        ];
        return view('v_template_admin', $data);
    }

    public function SimpanData()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' =>'{field} Wajib Diisi !',
                ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|is_unique[tbl_user.email]',
                    'errors' => [
                        'required' =>'{field} Wajib Diisi !',
                        'is_unique' => '{field} Sudah Digunakan, Cari E-mail Lain !',
                    ]
                    ],   
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors' => [
                            'required' =>'{field} Wajib Diisi !',
                        ]
                        ],
                        'no_hp' => [
                            'label' => 'No Handphone',
                            'rules' => 'required',
                            'errors' => [
                                'required' =>'{field} Wajib Diisi !',
                            ]
                            ],
                            'level' => [
                                'label' => 'Level',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                                'foto' => [
                                    'label' => 'Foto User',
                                    'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg,image/ico]',
                                    'errors' => [
                                        'uploaded' =>'{field} Wajib Diisi !',
                                        'max_size' => '{field} Max 1024kb !',
                                        'mime_in' => 'Format {field} Harus JPG,PNG,GIF,JPEG !'
                                    ]
                                    ],

        ])) {
            //jika lolos validasi
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'no_hp' => $this->request->getPost('no_hp'),
                'level' => $this->request->getPost('level'),
                'foto' => $nama_file,
            ];
            //memindahkan/upload file foto ke dalam folder foto
            $foto->move('foto', $nama_file);
            $this->ModelUser->AddData($data);
            session()->setFlashdata('pesan','Data Berhasil Simpan');
            return redirect()->to(base_url('User'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/AddData'))->withInput('validation',\Config\Services::validation());
        }
    }

    public function EditData($id_user)
    {
        $data = [
            'judul' => 'Edit Data User',
            'page' => 'user/v_editdata',
            'user' => $this->ModelUser->DetailData($id_user),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateData($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' =>'{field} Wajib Diisi !',
                ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Wajib Diisi !',
                    ]
                    ],   
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors' => [
                            'required' =>'{field} Wajib Diisi !',
                        ]
                        ],
                        'no_hp' => [
                            'label' => 'No Handphone',
                            'rules' => 'required',
                            'errors' => [
                                'required' =>'{field} Wajib Diisi !',
                            ]
                            ],
                            'level' => [
                                'label' => 'Level',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                                'foto' => [
                                    'label' => 'Foto User',
                                    'rules' => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg,image/ico]',
                                    'errors' => [
                                        'max_size' => '{field} Max 1024kb !',
                                        'mime_in' => 'Format {field} Harus JPG,PNG,GIF,JPEG !'
                                    ]
                                    ],

        ])) {
            //jika lolos validasi
            $foto = $this->request->getFile('foto');

            if ($foto->getError()== 4) {
                //jika tidak ganti foto
                $nama_file = $foto->getRandomName();
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $this->ModelUser->EditData($data);

            } else {
                //hapus foto lama
                $user = $this->ModelUser->DetailData($id_user);
                if ($user['foto'] <> '') {   
                    unlink('foto/' .$user['foto']);  
                }
                //jika ganti gambar
                $nama_file = $foto->getRandomName();
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                    'foto' => $nama_file,
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $foto->move('foto', $nama_file);
                $this->ModelUser->EditData($data);
            }

            session()->setFlashdata('pesan','Data Berhasil Di Update');
            return redirect()->to(base_url('User'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/EditData/'. $id_user));
        }

    }

    public function DeleteData($id_user)
    {
         //hapus foto lama
         $user = $this->ModelUser->DetailData($id_user);
         if ($user['foto'] <> '' or $user['foto'] <> null) {     
         }
        $data = ['id_user'=> $id_user];
         $this->ModelUser->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus');
         return redirect()->to(base_url('User'));
    }
}
