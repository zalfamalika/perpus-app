<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'FilterUser'    => \App\Filters\FilterUser::class,
        'FilterAnggota'    => \App\Filters\FilterAnggota::class,
        'FilterPetugas'    => \App\Filters\FilterPetugas::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
           'FilterUser'=>[
                'except'=> [
                    'Auth','Auth/*',
                    'Home','Home/*',
                    '/',
                ]
                ],
           'FilterAnggota'=>[
                'except'=> [
                'Auth','Auth/*',
                'Home','Home/*',
                '/',

                ]
                ],
            'FilterPetugas'=>[
                'except'=> [
                'Auth','Auth/*',
                'Home','Home/*',
                '/',
    
                ]
                ], 
        ],
        'after' => [
            'FilterUser'=>[
                'except'=> [
                    'Auth','Auth/*',
                    'Home','Home/*',
                    '/',
                    'Admin', 'Admin/*',
                    'Petugas', 'Petugas/*',
                    'Kategori', 'Kategori/*',
                    'Rak', 'Rak/*',
                    'Penerbit', 'Penerbit/*',
                    'Penulis', 'Penulis/*',
                    'User', 'User/*',
                    'Kelas', 'Kelas/*',
                    'Pengaturan', 'Pengaturan/*',
                    'Anggota', 'Anggota/*',
                    'Buku', 'Buku/*',
                ]
                ],
                'FilterAnggota'=>[
                    'except'=> [
                        'Auth','Auth/*',
                        'Home','Home/*',
                        '/',
                        'DashboardAnggota', 'DashboardAnggota/*',
                        'Peminjaman','Peminjaman/*',
                    
                    ]
                    ],
                    'FilterPetugas'=>[
                        'except'=> [
                            'Auth','Auth/*',
                            'Home','Home/*',
                            '/',
                            'Admin', 'Admin/*',
                            'Petugas', 'Petugas/*',
                            'Kategori', 'Kategori/*',
                            'Rak', 'Rak/*',
                            'Penerbit', 'Penerbit/*',
                            'Penulis', 'Penulis/*',
                            'Kelas', 'Kelas/*',
                            'Anggota', 'Anggota/*',
                            'Buku', 'Buku/*',
                        ]
                        ],
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [];
}
