<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $news = Post::orderBy('published_at', 'desc')->limit(10)->get();
        return view('landing.index', compact('news'));
    }

    public function teamDetail($slug)
    {
        // Data statis, mapping slug ke data
        $team = [
            'agoes' => [
                'name' => 'Ir. Mochamat Agoes, MM',
                'position' => 'Direktur Utama',
                'photo' => 'assets/images/direktur-utama.jpg',
                'personal' => [
                    'Nama Lengkap : Ir. Mochamat Agoes, MM',
                    'Jenis Kelamin : Laki-laki',
                    'Tempat dan Tanggal Lahir : Semarang, 25 Agustus 1971',
                    'Agama : Islam',
                    'Status Perkawinan : Menikah',
                    'Kewarganegaraan : Indonesia',
                ],
                'experience' => [
                    '2025 - Sekarang Ketua/Direktur Utama - MoneyHub (KSP Cipta Artha Solusindo)',
                    '2023 - 2025 Sekretaris/Direktur Bisnis - KSPPS KOSPPI',
                    '2022 - 2023 General Manager - KSPPS KOSPPI',
                    '2021 - 2022 Direktur Bisnis - PT Bank Neo Commerce, Tbk',
                    '2020 - 2021 Direktur Bisnis - PT Bank Yudha Bhakti, Tbk',
                    '2017 - 2020 Senior Vice President - Standard Chartered Bank, Singapore',
                    '2011 - 2017 Senior Vice President - Standard Chartered Bank, Indonesia',
                    '2008 - 2011 Vice President - Citibank NA, Singapore',
                    '2005 - 2008 Assistant Vice President  - Citibank NA, Singapore',
                    '2000 - 2005 Senior Manager - PT Bank Central Asia, Tbk',
                    '1998 - 2000 Manager Development Program - PT Bank Central Asia, Tbk',
                    '1994 - 1998 Senior Staff - PT Bank Central Asia, Tbk',
                ]
            ],
            'syamsul' => [
                'name' => 'Syamsul Arifin, ST',
                'position' => 'Direktur Operasional',
                'photo' => 'assets/images/direktur-operasional.jpg',
                'personal' => [
                    'Nama Lengkap : Syamsul Arifin, ST',
                    'Jenis Kelamin : Laki-laki',
                    'Tempat dan Tanggal Lahir : Bandung, 17 September 1977',
                    'Agama : Islam',
                    'Status Perkawinan : Menikah',
                    'Kewarganegaraan : Indonesia',
                ],
                'experience' => [
                    '2025 - Sekarang Sekretaris/Direktur Operasional - MoneyHub (KSP Cipta Artha Solusindo)',
                    '2023 - 2025 Manager Asset Management, IT & Collection - KSPPS KOSPPI',
                    '2021 - 2023 Manager IT - KSPPS KOSPPI',
                    '2014 - 2021 Kepala Divisi IT - PT Berkah Wahana Sejahtera (BWS)',
                    '2012 - 2014 Kepala Departemen IT - PT Bhakti Kharisma Utama (BKU)',
                    '2011 - 2012 Kepala Departemen IT - KSPPS BhaktiPos',
                    '2006 - 2011 IT Services & Supporting - Koperasi Nusantara (KOPNUS)',
                    '2003 - 2006 IT Services & Supporting - PT Ferinatex Jaya',
                    '2002 - 2003 Progammer & MIS - Konsultan IT',
                    '2001 - 2002 IT Fasilitator - Konsultan IT & Dinas Pertanian',
                ]
            ],
            'eko' => [
                'name' => 'Eko Sudarsono S.Kom',
                'position' => 'Direktur Bisnis',
                'photo' => 'assets/images/direktur-bisnis.jpg',
                'personal' => [
                    'Nama Lengkap : Eko Sudarsono S.Kom',
                    'Jenis Kelamin : Laki-laki',
                    'Tempat dan Tanggal Lahir : Jakarta, 13 Agustus 1982',
                    'Agama : Islam',
                    'Status Perkawinan : Menikah',
                    'Kewarganegaraan : Indonesia',
                ],
                'experience' => [
                    '2025 - Sekarang Bendahara/Direktur Bisnis - MoneyHub (KSP Cipta Artha Solusindo)',
                    '2015 - 2025 Bisnis Support - KSPPS KOSPPI',
                    '2013 - 2015 Staff Credit Administrasi - KSP Bama Parahyangan',
                    '2011 - 2012 Senior Teknisi - PT EMAX',
                    '2001 - 2002 Staff Administrasi - PT Multi Guna',
                ]
            ],
        ];

        // Jika slug tidak ada, bisa redirect/404
        if (!array_key_exists($slug, $team)) {
            abort(404);
        }

        $member = $team[$slug];
        return view('landing.team.index', compact('member', 'slug'));
    }

    public function news()
    {
        $all_news = Post::orderBy('published_at', 'desc')->paginate(5);
        $recent = Post::orderBy('published_at', 'desc')->limit(3)->get();
        return view('landing.news.index', compact('all_news', 'recent'));
    }

    public function detail(string $slug)
    {
        $news = \App\Models\Post::where('slug', $slug)->firstOrFail();
        $recent = \App\Models\Post::where('slug', '!=', $slug)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('landing.news.detail', compact('news', 'recent'));
    }
}
