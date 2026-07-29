# Rencana Pembangunan Portfolio Yopi Hendriansah

## 1. Keputusan utama

- Framework: Laravel 12.
- Admin panel/CMS: Filament 5.
- Database produksi: MySQL.
- Frontend: Blade, Tailwind CSS 4, dan JavaScript ringan melalui Vite.
- Pendekatan desain: mobile-first dengan pengalaman yang terasa seperti aplikasi native.
- Tema visual: dark, crisp, technical, profesional.
- Konten portofolio tidak ditulis permanen di Blade; seluruh konten utama dibaca dari database.
- Proyek pilihan ditampilkan sebagai horizontal slider/carousel.
- Icon menggunakan Google Material Symbols.

## 2. Data yang dikelola melalui Filament

### Profile

Nama, jabatan, bio, lokasi, foto profil, status ketersediaan, dan CV PDF.

### Skills

Kategori skill, nama skill, level opsional, urutan tampil, dan status aktif.

### Experiences

Posisi, perusahaan, lokasi, periode mulai/selesai, status pekerjaan saat ini, deskripsi, urutan, dan status aktif.

### Projects

Nama, slug, ringkasan, deskripsi, gambar utama, galeri opsional, teknologi, link demo, link repository, tahun, status featured, urutan slider, dan status aktif.

### Project technologies

Nama teknologi dan relasi ke proyek. Teknologi dapat dipilih ulang pada form proyek.

### Educations

Institusi, jurusan/program, periode, deskripsi, urutan, dan status aktif.

### Social links

Label, platform, URL, icon, urutan, dan status aktif. Nilai awal: LinkedIn, email, dan WhatsApp.

### Site settings

Judul brand, label navigasi, judul section, teks footer, SEO title, SEO description, dan pengaturan umum lainnya.

## 3. Rancangan database

Tabel utama yang akan dibuat:

```text
profiles
skill_categories
skills
experiences
projects
technologies
project_technology
educations
social_links
site_settings
```

Setiap tabel konten memiliki `is_active` dan `sort_order` jika relevan. Tanggal dibuat dan diperbarui memakai timestamps Laravel.

## 4. Struktur aplikasi

```text
app/
├── Filament/Resources/
│   ├── ProfileResource
│   ├── SkillCategoryResource
│   ├── SkillResource
│   ├── ExperienceResource
│   ├── ProjectResource
│   ├── EducationResource
│   ├── SocialLinkResource
│   └── SiteSettingResource
├── Http/Controllers/PortfolioController.php
├── Models/
└── ViewModels/PortfolioViewModel.php

resources/views/portfolio/
├── index.blade.php
├── components/navbar.blade.php
├── components/hero.blade.php
├── components/skills.blade.php
├── components/experience-timeline.blade.php
├── components/projects-slider.blade.php
├── components/education.blade.php
└── components/footer.blade.php
```

Route publik utama adalah `/`. Admin Filament tetap berada di `/admin`.

## 5. Rancangan mobile-first

### Navigasi

Pada mobile, navbar menjadi compact app bar:

```text
┌─────────────────────────────┐
│ YH Portfolio          ☰     │
└─────────────────────────────┘
```

Menu dibuka sebagai bottom sheet atau panel dari bawah dengan item besar yang mudah disentuh:

```text
┌─────────────────────────────┐
│ Navigasi                 ×   │
│                             │
│  Tentang                    │
│  Skills                     │
│  Pengalaman                 │
│  Proyek                     │
│  Kontak                     │
│                             │
│  [ Unduh CV ]               │
└─────────────────────────────┘
```

Target area sentuh minimal 44px. Navigasi menggunakan anchor scroll dengan offset untuk app bar.

### Hero

Urutan mobile: foto, nama/jabatan, bio, informasi kontak, lalu tombol aksi.

```text
┌─────────────────────────────┐
│          [ Foto ]           │
│                             │
│ YOPI HENDRIANSAH            │
│ Full-Stack Programmer       │
│                             │
│ Bio singkat yang mudah      │
│ dibaca dalam beberapa baris │
│                             │
│ ● Tasikmalaya               │
│ ✉ yopihendriansah90...     │
│                             │
│ [ Hubungi Saya ] [ CV ]     │
└─────────────────────────────┘
```

### Skills

Kategori ditampilkan sebagai stacked cards. Chip skill dapat di-scroll horizontal jika terlalu panjang, bukan memaksa layout melebar.

### Pengalaman

Timeline menjadi satu kolom dengan node besar dan jarak antar item yang lega. Deskripsi dibatasi secara visual agar mudah dipindai.

### Proyek slider

```text
Proyek Pilihan                         1 / 4

┌─────────────────────────────┐
│        Gambar proyek        │
│                             │
│ Nama Proyek                 │
│ Ringkasan singkat           │
│ Laravel · MySQL · Docker    │
│                             │
│ [ Lihat Detail ]            │
└─────────────────────────────┘
        ● ○ ○ ○
```

Slider mendukung swipe touch, drag, tombol panah, pagination indicator, dan keyboard. Hanya proyek dengan `is_featured = true` yang masuk slider.

### Kontak dan footer

Kontak menggunakan tombol besar berbentuk action card:

```text
┌─────────────────────────────┐
│ Siap berkolaborasi?         │
│                             │
│ [ WhatsApp ]                │
│ [ Email ]                   │
│ [ LinkedIn ]                │
└─────────────────────────────┘
```

## 6. Rancangan desktop

Pada desktop, konten menggunakan container maksimal sekitar 1200px dan grid 12 kolom.

```text
┌──────────────────────────────────────────────────────────────┐
│ YH Portfolio   Tentang Skills Pengalaman Proyek Kontak [CV]  │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│  YOPI HENDRIANSAH                         ┌───────────────┐   │
│  Full-Stack Programmer                    │               │   │
│  Bio dan informasi kontak                  │     Foto      │   │
│                                            │               │   │
│  [ Hubungi Saya ]                          └───────────────┘   │
│                                                              │
│  Keahlian Teknis                                             │
│  [ Backend ]          [ Frontend ]       [ Tools & DevOps ]  │
│                                                              │
│  Pengalaman Profesional                                      │
│  ● Full-Stack Web Developer                                  │
│  │ Freelance Web Developer                                   │
│  ● Web Developer                                             │
│                                                              │
│  Proyek Pilihan                              [<] [>]         │
│  [ Proyek 1 ]             [ Proyek 2 ]       [ Proyek 3 ]    │
│                                                              │
│  Pendidikan                    Kontak                        │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

Desktop menampilkan tiga kartu proyek sekaligus. Pada breakpoint menengah dua kartu, sedangkan mobile satu kartu.

## 7. Tahapan pengerjaan

1. Mengubah konfigurasi database dari SQLite ke MySQL.
2. Membuat migration, model, relasi, dan seeder data awal dari hasil Stitch.
3. Membuat Filament Resources dan form CRUD.
4. Menyiapkan upload foto, gambar proyek, galeri, dan CV.
5. Memindahkan asset lokal ke storage Laravel dan membuat symbolic link storage.
6. Mengubah `code.html` menjadi Blade layout dan komponen reusable.
7. Menghubungkan seluruh section dengan query data aktif dan `sort_order`.
8. Membuat slider proyek dengan kontrol touch, keyboard, tombol panah, dan pagination.
9. Mengimplementasikan mobile-first app bar, bottom sheet menu, action cards, dan touch target.
10. Menambahkan validasi, fallback saat data kosong, SEO metadata, dan aksesibilitas.
11. Menguji CRUD Filament, upload file, slider, responsive layout, dan production build.

## 8. Kriteria selesai

- Tidak ada konten portofolio utama yang hardcode di view.
- Perubahan konten di Filament langsung terlihat di halaman publik.
- Semua asset utama menggunakan file lokal/storage Laravel.
- CV dapat diganti dari Filament.
- Proyek featured dapat diatur dan diurutkan dari Filament.
- Slider berfungsi dengan mouse, touch, keyboard, dan tombol navigasi.
- Tampilan mobile terasa seperti aplikasi: app bar, menu sheet, kartu aksi, spacing, dan touch target yang nyaman.
- Tampilan desktop tetap mengikuti komposisi desain Stitch.
- Aplikasi berjalan pada Laravel 12, Filament 5, MySQL, dan Vite.
