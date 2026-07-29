<?php

namespace Database\Seeders;

use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(['email' => 'yopihendriansah90@gmail.com'], [
            'name' => 'Yopi Hendriansah',
            'password' => 'password',
        ]);

        Profile::updateOrCreate(['id' => 1], [
            'name' => 'Yopi Hendriansah',
            'headline' => 'Full-Stack Programmer',
            'bio' => 'Seorang Full-Stack Programmer dengan pengalaman lebih dari 3 tahun dalam merancang, mengembangkan, dan memelihara aplikasi web yang scalable dan aman. Fokus saya adalah menciptakan solusi teknologi yang efisien dan berdampak positif bagi bisnis.',
            'location' => 'Tasikmalaya, Jawa Barat',
            'email' => 'yopihendriansah90@gmail.com',
            'phone' => '6283116545674',
            'photo_path' => 'portfolio/yopi.jpeg',
            'cv_path' => 'portfolio/cv/01KYNVWHYP33VFRYG7RM97K0EK.pdf',
            'is_available' => true,
        ]);

        $categories = [
            [
                'name' => 'Backend & Database', 'slug' => 'backend-database', 'sort_order' => 0, 'is_active' => true,
                'skills' => [
                    ['name' => 'PHP', 'sort_order' => 0], ['name' => 'Laravel', 'sort_order' => 1],
                    ['name' => 'REST API', 'sort_order' => 2], ['name' => 'MySQL', 'sort_order' => 3],
                    ['name' => 'PostgreSQL', 'sort_order' => 4],
                ],
            ],
            [
                'name' => 'Frontend', 'slug' => 'frontend', 'sort_order' => 1, 'is_active' => true,
                'skills' => [
                    ['name' => 'HTML5', 'sort_order' => 0], ['name' => 'CSS3', 'sort_order' => 1],
                    ['name' => 'JavaScript', 'sort_order' => 2], ['name' => 'Filament', 'sort_order' => 3],
                    ['name' => 'Tailwind CSS', 'sort_order' => 4], ['name' => 'Git / GitHub', 'sort_order' => 6],
                    ['name' => 'Payment Gateway', 'sort_order' => 7],
                ],
            ],
            [
                'name' => 'Tools & Integrations', 'slug' => 'tools-integrations', 'sort_order' => 2, 'is_active' => true,
                'skills' => [
                    ['name' => 'Docker', 'sort_order' => 0], ['name' => 'Git / GitHub', 'sort_order' => 1],
                    ['name' => 'Payment Gateway', 'sort_order' => 2], ['name' => 'WhatsApp API', 'sort_order' => 3],
                    ['name' => 'Linux', 'sort_order' => 4],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $skills = $categoryData['skills'];
            unset($categoryData['skills']);
            $category = SkillCategory::updateOrCreate(['slug' => $categoryData['slug']], $categoryData);
            $pivotData = [];

            foreach ($skills as $skillData) {
                $skill = Skill::updateOrCreate(
                    ['name' => $skillData['name']],
                    ['skill_category_id' => $category->id, 'sort_order' => $skillData['sort_order'], 'is_active' => true],
                );
                $pivotData[$skill->id] = ['sort_order' => $skillData['sort_order']];
            }

            $category->skills()->sync($pivotData);
        }

        foreach ([
            ['position' => 'Full-Stack Web Developer', 'company' => 'CV. Walatra Herbal', 'location' => null, 'started_at' => '2024-08-01', 'ended_at' => null, 'is_current' => true, 'description' => 'Mengembangkan dan memelihara sistem internal perusahaan, termasuk aplikasi manajemen inventaris dan sistem point of sale terintegrasi menggunakan Laravel dan MySQL.', 'sort_order' => 1, 'is_active' => true],
            ['position' => 'Freelance Web Developer', 'company' => 'Klien Independen', 'location' => null, 'started_at' => '2024-01-01', 'ended_at' => null, 'is_current' => true, 'description' => 'Mengerjakan website profil perusahaan, aplikasi donasi, dan sistem informasi akademik untuk klien UMKM dan instansi pendidikan.', 'sort_order' => 2, 'is_active' => true],
            ['position' => 'Staff Operasional & Web Developer', 'company' => 'PT. Manunggal Jaya Makmur', 'location' => null, 'started_at' => '2024-01-01', 'ended_at' => '2025-07-11', 'is_current' => false, 'description' => "Mengembangkan website untuk kebutuhan operasional\nMelakukan manajemen adminsistrasi kendaraan\nMelakukan entry data untuk absensi Driver\n", 'sort_order' => 3, 'is_active' => true],
            ['position' => 'Web Developer', 'company' => 'PT. Manunggal Jaya Makmur', 'location' => null, 'started_at' => '2024-01-01', 'ended_at' => '2024-07-31', 'is_current' => false, 'description' => 'Mengembangkan website korporat dan sistem manajemen proyek internal dengan antarmuka responsif.', 'sort_order' => 3, 'is_active' => true],
        ] as $experience) {
            Experience::updateOrCreate(['position' => $experience['position'], 'company' => $experience['company']], $experience);
        }

        foreach ([
            ['name' => 'Aplikasi Donasi', 'slug' => 'aplikasi-donasi', 'summary' => 'Platform penggalangan dana dan donasi online.', 'description' => null, 'image_path' => 'portfolio/lazipn.png', 'gallery' => [], 'demo_url' => null, 'repository_url' => null, 'year' => 2026, 'is_featured' => true, 'sort_order' => 1, 'is_active' => true],
            ['name' => 'Website Profil IPN', 'slug' => 'website-profil-ipn', 'summary' => 'Website profil institusi dengan tampilan profesional.', 'description' => null, 'image_path' => 'portfolio/screen.png', 'gallery' => [], 'demo_url' => null, 'repository_url' => null, 'year' => null, 'is_featured' => true, 'sort_order' => 2, 'is_active' => true],
            ['name' => 'Aksesin Digital', 'slug' => 'aksesin-digital', 'summary' => 'Solusi digital untuk kebutuhan bisnis dan layanan web.', 'description' => null, 'image_path' => 'portfolio/aksesindigital.png', 'gallery' => [['path' => 'portfolio/projects/gallery/01KYNVZH4EXSEKHK4TT2Y1Q8Y3.jpeg'], ['path' => 'portfolio/projects/gallery/01KYNVZH4EXSEKHK4TT2Y1Q8Y4.png']], 'demo_url' => null, 'repository_url' => null, 'year' => 2026, 'is_featured' => true, 'sort_order' => 3, 'is_active' => true],
        ] as $projectData) {
            $technologies = ['Laravel', 'MySQL', 'Tailwind CSS'];
            $record = Project::updateOrCreate(['slug' => $projectData['slug']], $projectData);
            $record->technologies()->sync(collect($technologies)->map(fn (string $name) => Technology::firstOrCreate(['name' => $name])->id));

            $legacyCover = $record->image_path ? storage_path('app/public/' . $record->image_path) : null;
            if ($legacyCover && is_file($legacyCover) && ! $record->hasMedia('cover')) {
                $record->addMedia($legacyCover)->toMediaCollection('cover', 'public');
            }

            foreach ((array) $record->gallery as $galleryImage) {
                $path = is_array($galleryImage) ? ($galleryImage['path'] ?? null) : $galleryImage;
                $file = $path ? storage_path('app/public/' . $path) : null;
                if ($file && is_file($file) && ! $record->getMedia('gallery')->contains(fn ($media) => $media->file_name === basename($file))) {
                    $record->addMedia($file)->toMediaCollection('gallery', 'public');
                }
            }
        }

        foreach ([
            ['institution' => 'Universitas Mayasari Bakti', 'program' => 'Teknik Informatika', 'period' => '2022 - Sekarang', 'description' => null, 'sort_order' => 1, 'is_active' => true],
            ['institution' => 'Institut Teknologi Garut', 'program' => 'Teknik Informatika', 'period' => '2020 - 2024', 'description' => null, 'sort_order' => 1, 'is_active' => true],
        ] as $education) {
            Education::updateOrCreate(['institution' => $education['institution']], $education);
        }

        Certification::updateOrCreate(['title' => 'Linux + CompTIA', 'provider' => 'CompTIA'], [
            'type' => 'certification', 'completed_at' => '2026-07-29', 'credential_id' => null,
            'verification_url' => null, 'description' => 'asdfasdf', 'sort_order' => 0, 'is_active' => true,
        ]);

        foreach ([
            ['platform' => 'linkedin', 'label' => 'LinkedIn Profile', 'url' => 'https://linkedin.com/in/yopihendriansah', 'icon' => 'linkedin', 'sort_order' => 1, 'is_active' => true],
            ['platform' => 'email', 'label' => 'Email', 'url' => 'mailto:yopihendriansah90@gmail.com', 'icon' => 'mail', 'sort_order' => 2, 'is_active' => true],
            ['platform' => 'whatsapp', 'label' => 'WhatsApp', 'url' => 'https://wa.me/6283116545674', 'icon' => 'whatsapp', 'sort_order' => 3, 'is_active' => true],
            ['platform' => 'youtube', 'label' => '@yopihendriansah', 'url' => 'https://www.youtube.com/@yopihendriansah', 'icon' => 'youtube', 'sort_order' => 4, 'is_active' => true],
            ['platform' => 'instagram', 'label' => 'Instagram @yopi_hendriansah', 'url' => 'https://www.instagram.com/yopi_hendriansah', 'icon' => 'instagram', 'sort_order' => 5, 'is_active' => true],
        ] as $link) {
            SocialLink::updateOrCreate(['platform' => $link['platform']], $link);
        }

        foreach ([
            'brand_name' => 'YH Portfolio', 'footer_tagline' => 'Buatan Indonesia', 'section_projects_title' => 'Proyek Pilihan',
            'seo_title' => 'Yopi Hendriansah - Full-Stack Programmer', 'seo_description' => 'Portfolio Yopi Hendriansah, Full-Stack Programmer.',
            'nav_about' => 'Tentang', 'nav_skills' => 'Skills', 'nav_experience' => 'Pengalaman', 'nav_projects' => 'Proyek', 'nav_contact' => 'Kontak',
            'navigation_title' => 'Navigasi', 'availability_label' => 'Available for work', 'download_cv_label' => 'Unduh CV', 'contact_cta_label' => 'Hubungi Saya',
            'skills_title' => 'Keahlian Teknis', 'experience_title' => 'Pengalaman Profesional', 'projects_title' => 'Proyek Pilihan',
            'project_link_label' => 'Lihat proyek', 'empty_projects_label' => 'Belum ada proyek pilihan.', 'education_title' => 'Pendidikan',
            'contact_title' => 'Mari berkolaborasi', 'contact_description' => 'Terbuka untuk diskusi proyek, kolaborasi, dan peluang baru.',
            'skills_eyebrow' => '01 / Expertise', 'experience_eyebrow' => '02 / Journey', 'current_label' => 'Sekarang',
            'projects_eyebrow' => '03 / Selected work', 'previous_project_label' => 'Proyek sebelumnya', 'next_project_label' => 'Proyek berikutnya',
            'education_eyebrow' => '04 / Background', 'contact_eyebrow' => '05 / Let’s connect', 'phone_label' => 'WhatsApp', 'linkedin_label' => 'LinkedIn',
            'nav_certifications' => 'Sertifikasi',
        ] as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value, 'type' => 'text']);
        }
    }
}
