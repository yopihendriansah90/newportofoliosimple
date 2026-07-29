<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

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
            'is_available' => true,
        ]);

        $categories = [
            'Backend & Database' => ['PHP', 'Laravel', 'REST API', 'MySQL', 'PostgreSQL'],
            'Frontend' => ['HTML5', 'CSS3', 'JavaScript', 'Filament', 'Tailwind CSS'],
            'Tools & Integrations' => ['Docker', 'Git / GitHub', 'Payment Gateway', 'WhatsApp API', 'Linux'],
        ];
        foreach ($categories as $order => $skills) {
            $category = SkillCategory::updateOrCreate(['slug' => str($order)->slug()], ['name' => $order, 'sort_order' => array_search($order, array_keys($categories)), 'is_active' => true]);
            foreach ($skills as $skillOrder => $skill) {
                $skillRecord = Skill::updateOrCreate(['name' => $skill], ['skill_category_id' => $category->id, 'sort_order' => $skillOrder, 'is_active' => true]);
                $category->skills()->syncWithoutDetaching([$skillRecord->id => ['sort_order' => $skillOrder]]);
            }
        }

        $experiences = [
            ['position' => 'Full-Stack Web Developer', 'company' => 'CV. Walatra Herbal', 'started_at' => '2024-08-01', 'is_current' => true, 'sort_order' => 1, 'description' => 'Mengembangkan dan memelihara sistem internal perusahaan, termasuk aplikasi manajemen inventaris dan sistem point of sale terintegrasi menggunakan Laravel dan MySQL.'],
            ['position' => 'Freelance Web Developer', 'company' => 'Klien Independen', 'started_at' => '2024-01-01', 'is_current' => true, 'sort_order' => 2, 'description' => 'Mengerjakan website profil perusahaan, aplikasi donasi, dan sistem informasi akademik untuk klien UMKM dan instansi pendidikan.'],
            ['position' => 'Web Developer', 'company' => 'PT. Manunggal Jaya Makmur', 'started_at' => '2024-01-01', 'ended_at' => '2024-07-31', 'sort_order' => 3, 'description' => 'Mengembangkan website korporat dan sistem manajemen proyek internal dengan antarmuka responsif.'],
        ];
        foreach ($experiences as $experience) {
            Experience::updateOrCreate(['position' => $experience['position'], 'company' => $experience['company']], $experience + ['is_active' => true]);
        }

        $projectData = [
            ['name' => 'Aplikasi Donasi', 'slug' => 'aplikasi-donasi', 'summary' => 'Platform penggalangan dana dan donasi online.', 'image_path' => 'portfolio/lazipn.png', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Website Profil IPN', 'slug' => 'website-profil-ipn', 'summary' => 'Website profil institusi dengan tampilan profesional.', 'image_path' => 'portfolio/screen.png', 'is_featured' => true, 'sort_order' => 2],
            ['name' => 'Aksesin Digital', 'slug' => 'aksesin-digital', 'summary' => 'Solusi digital untuk kebutuhan bisnis dan layanan web.', 'image_path' => 'portfolio/aksesindigital.png', 'is_featured' => true, 'sort_order' => 3],
        ];
        foreach ($projectData as $project) {
            $record = Project::updateOrCreate(['slug' => $project['slug']], $project + ['is_active' => true]);
            $technologies = collect(['Laravel', 'MySQL', 'Tailwind CSS'])->map(fn ($name) => Technology::firstOrCreate(['name' => $name])->id);
            $record->technologies()->sync($technologies);

            $legacyImage = $record->image_path ? storage_path('app/public/' . $record->image_path) : null;
            if ($legacyImage && is_file($legacyImage) && ! $record->hasMedia('cover')) {
                $record->addMedia($legacyImage)->toMediaCollection('cover', 'public');
            }
        }

        Education::updateOrCreate(['institution' => 'Institut Teknologi Garut'], ['program' => 'Teknik Informatika', 'period' => '2020 - 2024', 'sort_order' => 1, 'is_active' => true]);

        // Normalize records created by the previous free-text platform form.
        SocialLink::where('platform', 'LinkedIn')->update(['platform' => 'linkedin', 'icon' => 'linkedin']);
        SocialLink::where('platform', 'Email')->update(['platform' => 'email', 'icon' => 'mail']);
        SocialLink::where('platform', 'WhatsApp')->update(['platform' => 'whatsapp', 'icon' => 'whatsapp']);

        foreach ([
            ['platform' => 'linkedin', 'label' => 'LinkedIn Profile', 'url' => 'https://linkedin.com/in/yopihendriansah', 'icon' => 'linkedin', 'sort_order' => 1],
            ['platform' => 'email', 'label' => 'Email', 'url' => 'mailto:yopihendriansah90@gmail.com', 'icon' => 'mail', 'sort_order' => 2],
            ['platform' => 'whatsapp', 'label' => 'WhatsApp', 'url' => 'https://wa.me/6283116545674', 'icon' => 'whatsapp', 'sort_order' => 3],
        ] as $link) {
            SocialLink::updateOrCreate(['platform' => $link['platform']], $link + ['is_active' => true]);
        }

        foreach ([
            'brand_name' => 'YH Portfolio',
            'footer_tagline' => 'Buatan Indonesia',
            'seo_title' => 'Yopi Hendriansah - Full-Stack Programmer',
            'seo_description' => 'Portfolio Yopi Hendriansah, Full-Stack Programmer.',
            'nav_about' => 'Tentang',
            'nav_skills' => 'Skills',
            'nav_certifications' => 'Sertifikasi',
            'nav_experience' => 'Pengalaman',
            'nav_projects' => 'Proyek',
            'nav_education' => 'Pendidikan',
            'nav_contact' => 'Kontak',
            'navigation_title' => 'Navigasi',
            'availability_label' => 'Available for work',
            'download_cv_label' => 'Unduh CV',
            'contact_cta_label' => 'Hubungi Saya',
            'skills_title' => 'Keahlian Teknis',
            'skills_eyebrow' => '01 / Expertise',
            'experience_title' => 'Pengalaman Profesional',
            'experience_eyebrow' => '02 / Journey',
            'current_label' => 'Sekarang',
            'projects_title' => 'Proyek Pilihan',
            'projects_eyebrow' => '03 / Selected work',
            'previous_project_label' => 'Proyek sebelumnya',
            'next_project_label' => 'Proyek berikutnya',
            'project_link_label' => 'Lihat proyek',
            'empty_projects_label' => 'Belum ada proyek pilihan.',
            'education_title' => 'Pendidikan',
            'education_eyebrow' => '04 / Background',
            'contact_title' => 'Mari berkolaborasi',
            'contact_eyebrow' => '05 / Let’s connect',
            'contact_description' => 'Terbuka untuk diskusi proyek, kolaborasi, dan peluang baru.',
            'phone_label' => 'WhatsApp',
            'linkedin_label' => 'LinkedIn',
        ] as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value, 'type' => 'text']);
        }
    }
}
