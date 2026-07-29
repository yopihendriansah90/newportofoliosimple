@php
    $mediaUrl = fn (?string $path) => $path && str_starts_with($path, 'http')
        ? $path
        : ($path ? asset('storage/' . $path) : null);
    $setting = fn (string $key, string $fallback) => $settings->get($key, $fallback);
    $profilePhoto = $mediaUrl($profile?->photo_path) ?: asset('portfolio/yopi.jpeg');
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="{{ $setting('seo_description', 'Portfolio Yopi Hendriansah, Full-Stack Programmer.') }}">
    <title>{{ $setting('seo_title', 'Yopi Hendriansah - Full-Stack Programmer') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="portfolio-shell bg-[#0b0b0c] text-[#e5e2e1] antialiased selection:bg-[#0070f3] selection:text-white">
    <header class="app-bar fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-[#0b0b0c]/85 backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5 lg:h-20 lg:px-6">
            <a href="#tentang" class="font-mono text-sm font-semibold tracking-wide text-white">{{ $setting('brand_name', 'YH Portfolio') }}</a>
            <nav class="hidden items-center gap-7 text-sm text-[#a6a6ad] md:flex" aria-label="Navigasi utama">
                <a href="#tentang" class="nav-link">{{ $setting('nav_about', 'Tentang') }}</a>
                <a href="#skills" class="nav-link">{{ $setting('nav_skills', 'Skills') }}</a>
                <a href="#pengalaman" class="nav-link">{{ $setting('nav_experience', 'Pengalaman') }}</a>
                <a href="#proyek" class="nav-link">{{ $setting('nav_projects', 'Proyek') }}</a>
                <a href="#pendidikan" class="nav-link">{{ $setting('nav_education', 'Pendidikan') }}</a>
                <a href="#sertifikasi" class="nav-link">{{ $setting('nav_certifications', 'Sertifikasi') }}</a>
                <a href="#kontak" class="nav-link">{{ $setting('nav_contact', 'Kontak') }}</a>
                @if ($profile?->cv_path)
                    <a href="{{ $mediaUrl($profile->cv_path) }}" target="_blank" class="primary-button">{{ $setting('download_cv_label', 'Unduh CV') }}</a>
                @endif
            </nav>
            <button type="button" class="icon-button md:hidden" data-menu-open aria-label="Buka menu navigasi">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </header>

    <div class="mobile-menu fixed inset-0 z-[60] hidden md:hidden" data-menu>
        <button class="absolute inset-0 bg-black/70" data-menu-close aria-label="Tutup menu"></button>
        <section class="mobile-sheet absolute inset-x-0 bottom-0 rounded-t-3xl border-t border-white/10 bg-[#171719] p-6 pb-[calc(1.5rem+env(safe-area-inset-bottom))]" aria-label="Menu navigasi">
            <div class="mb-5 flex items-center justify-between"><span class="font-mono text-xs uppercase tracking-[0.18em] text-[#96969e]">{{ $setting('navigation_title', 'Navigasi') }}</span><button class="icon-button" data-menu-close aria-label="Tutup menu"><span class="material-symbols-outlined">close</span></button></div>
            <nav class="grid gap-1" aria-label="Navigasi mobile">
                @foreach ([['tentang','nav_about','Tentang'],['skills','nav_skills','Skills'],['pengalaman','nav_experience','Pengalaman'],['proyek','nav_projects','Proyek'],['pendidikan','nav_education','Pendidikan'],['sertifikasi','nav_certifications','Sertifikasi'],['kontak','nav_contact','Kontak']] as [$anchor,$key,$fallback])
                    <a href="#{{ $anchor }}" data-menu-link class="mobile-nav-link">{{ $setting($key, $fallback) }}<span class="material-symbols-outlined text-base">arrow_forward</span></a>
                @endforeach
            </nav>
            @if ($profile?->cv_path)
                <a href="{{ $mediaUrl($profile->cv_path) }}" target="_blank" class="primary-button mt-5 flex w-full justify-center">{{ $setting('download_cv_label', 'Unduh CV') }}</a>
            @endif
        </section>
    </div>

    <main class="mx-auto max-w-6xl px-5 pb-16 pt-28 lg:px-6 lg:pt-40">
        <section id="tentang" class="scroll-mt-24 lg:grid lg:grid-cols-[1fr_320px] lg:items-center lg:gap-24">
            <div>
                <h1 class="max-w-3xl font-display text-4xl font-bold tracking-[-0.045em] text-white sm:text-5xl lg:text-7xl">{{ $profile?->name }}</h1>
                <p class="mt-3 font-display text-xl font-semibold text-[#70a9ff] lg:text-3xl">{{ $profile?->headline }}</p>
                <p class="mt-7 max-w-2xl text-base leading-7 text-[#b8b7bf] lg:text-lg lg:leading-8">{{ $profile?->bio }}</p>
                <div class="mt-8 grid gap-3 border-t border-white/10 pt-6 text-sm text-[#b8b7bf] sm:grid-cols-2">
                    <span class="contact-item"><span class="material-symbols-outlined">location_on</span>{{ $profile?->location }}</span>
                    <a class="contact-item hover:text-white" href="mailto:{{ $profile?->email }}"><span class="material-symbols-outlined">mail</span>{{ $profile?->email }}</a>
                    <a class="contact-item hover:text-white" href="https://wa.me/{{ $profile?->phone }}" target="_blank"><span class="material-symbols-outlined">phone</span>{{ $setting('phone_label', 'WhatsApp') }}</a>
                    @if ($linkedin = $socialLinks->first(fn ($link) => strtolower($link->platform) === 'linkedin'))<a class="contact-item hover:text-white" href="{{ $linkedin->url }}" target="_blank"><x-social-icon :platform="$linkedin->platform" class="text-[#70a9ff]" />{{ $setting('linkedin_label', 'LinkedIn') }}</a>@endif
                </div>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#kontak" class="primary-button justify-center">{{ $setting('contact_cta_label', 'Hubungi Saya') }}<span class="material-symbols-outlined text-lg">arrow_outward</span></a>
                    @if ($profile?->cv_path)<a href="{{ $mediaUrl($profile->cv_path) }}" target="_blank" class="secondary-button justify-center">{{ $setting('download_cv_label', 'Unduh CV') }}</a>@endif
                </div>
            </div>
            <div class="mt-10 lg:mt-0"><div class="profile-frame"><img src="{{ $profilePhoto }}" alt="{{ $profile?->name }}" class="h-full w-full object-cover object-top grayscale transition duration-500 hover:grayscale-0"></div></div>
        </section>

        <section id="skills" class="section scroll-mt-24">
            <div class="section-heading"><div><p class="eyebrow">{{ $setting('skills_eyebrow', '01 / Expertise') }}</p><h2>{{ $setting('skills_title', 'Keahlian Teknis') }}</h2></div><div class="hidden gap-2 sm:flex"><button class="slider-button" data-skill-slider-prev aria-label="Kategori keahlian sebelumnya"><span class="material-symbols-outlined">arrow_back</span></button><button class="slider-button" data-skill-slider-next aria-label="Kategori keahlian berikutnya"><span class="material-symbols-outlined">arrow_forward</span></button></div></div>
            <div class="skill-slider" data-skill-slider tabindex="0">
                @foreach ($skillCategories as $category)
                    <article class="content-card skill-card"><h3 class="card-label">{{ $category->name }}</h3><div class="flex flex-wrap gap-2">@foreach ($category->skills as $skill)<span class="skill-chip">{{ $skill->name }}</span>@endforeach</div></article>
                @endforeach
            </div>
            <div class="mt-5 flex items-center justify-between sm:justify-center"><div class="slider-dots" data-skill-slider-dots aria-label="Posisi kategori keahlian"></div><span class="ml-4 font-mono text-xs text-[#777780] sm:hidden" data-skill-slider-count></span></div>
        </section>

        <section id="pengalaman" class="section scroll-mt-24">
            <div class="section-heading"><div><p class="eyebrow">{{ $setting('experience_eyebrow', '02 / Journey') }}</p><h2>{{ $setting('experience_title', 'Pengalaman Profesional') }}</h2></div></div>
            <div class="timeline">@foreach ($experiences as $experience)<article class="timeline-item"><span class="timeline-dot"></span><div class="flex flex-col gap-2 sm:flex-row sm:items-baseline sm:justify-between"><h3 class="text-xl font-semibold text-white">{{ $experience->position }}</h3><span class="date-pill">{{ $experience->started_at?->format('M Y') }} — {{ $experience->is_current ? $setting('current_label', 'Sekarang') : $experience->ended_at?->format('M Y') }}</span></div><p class="mt-2 font-medium text-[#70a9ff]">{{ $experience->company }}</p><p class="mt-3 max-w-3xl leading-7 text-[#94949c]">{{ $experience->description }}</p></article>@endforeach</div>
        </section>

        <section id="proyek" class="section scroll-mt-24">
            <div class="section-heading"><div><p class="eyebrow">{{ $setting('projects_eyebrow', '03 / Selected work') }}</p><h2>{{ $setting('projects_title', 'Proyek Pilihan') }}</h2></div><div class="hidden gap-2 sm:flex"><button class="slider-button" data-slider-prev aria-label="{{ $setting('previous_project_label', 'Proyek sebelumnya') }}"><span class="material-symbols-outlined">arrow_back</span></button><button class="slider-button" data-slider-next aria-label="{{ $setting('next_project_label', 'Proyek berikutnya') }}"><span class="material-symbols-outlined">arrow_forward</span></button></div></div>
            @if ($projects->isNotEmpty())
                <div class="project-slider" data-slider tabindex="0">@foreach ($projects as $project) @php($galleryMedia = $project->getMedia('gallery')) @php($coverMedia = $project->getFirstMedia('cover')) @php($coverUrl = $coverMedia?->getUrl('thumb') ?: $mediaUrl($project->image_path) ?: asset('portfolio/screen.png')) @php($galleryItems = collect([['url' => $coverMedia?->getUrl() ?: $coverUrl, 'thumb' => $coverUrl, 'alt' => $project->name]])->merge($galleryMedia->map(fn ($image) => ['url' => $image->getUrl(), 'thumb' => $image->getUrl('thumb'), 'alt' => $project->name]))->unique('url')->values())<article class="project-card"><button type="button" data-gallery-open="{{ $project->id }}" class="project-image block w-full cursor-zoom-in text-left"><img src="{{ $coverUrl }}" alt="{{ $project->name }}">@if ($galleryItems->count() > 1)<span class="project-gallery-count"><span class="material-symbols-outlined text-sm">collections</span>{{ $galleryItems->count() }}</span>@endif</button><script type="application/json" id="project-gallery-{{ $project->id }}">@json($galleryItems)</script><div class="p-5 sm:p-6"><div class="flex items-start justify-between gap-3"><h3 class="text-xl font-semibold text-white">{{ $project->name }}</h3>@if ($project->year)<span class="font-mono text-xs text-[#777780]">{{ $project->year }}</span>@endif</div>@if ($galleryMedia->isNotEmpty())<div class="mt-4 flex gap-2 overflow-hidden">@foreach ($galleryMedia->take(3) as $galleryImage)<img src="{{ $galleryImage->getUrl('thumb') }}" alt="" class="h-12 w-16 rounded object-cover">@endforeach</div>@endif<p class="mt-3 min-h-12 text-sm leading-6 text-[#9999a2]">{{ $project->summary }}</p><div class="mt-5 flex flex-wrap gap-2">@foreach ($project->technologies as $technology)<span class="tech-label">{{ $technology->name }}</span>@endforeach</div><div class="mt-6 flex gap-4 text-sm font-semibold">@if ($project->demo_url)<a href="{{ $project->demo_url }}" target="_blank" class="inline-link">{{ $setting('project_link_label', 'Lihat proyek') }}<span class="material-symbols-outlined text-base">arrow_outward</span></a>@endif @if ($project->repository_url)<a href="{{ $project->repository_url }}" target="_blank" class="inline-link text-[#9b9ba3]">Code</a>@endif</div></div></article>@endforeach</div>
                <div class="mt-5 flex items-center justify-between sm:justify-center"><div class="slider-dots" data-slider-dots aria-label="Posisi proyek"></div><span class="ml-4 font-mono text-xs text-[#777780] sm:hidden" data-slider-count></span></div>
            @else
                <div class="content-card text-[#9999a2]">{{ $setting('empty_projects_label', 'Belum ada proyek pilihan.') }}</div>
            @endif
        </section>

        <section id="pendidikan" class="section scroll-mt-24">
            <div class="section-heading"><div><p class="eyebrow">{{ $setting('education_eyebrow', '04 / Background') }}</p><h2>{{ $setting('education_title', 'Pendidikan') }}</h2></div></div>
            <div class="timeline">@foreach ($educations as $education)<article class="timeline-item"><span class="timeline-dot"></span><div class="flex flex-col gap-2 sm:flex-row sm:items-baseline sm:justify-between"><h3 class="text-xl font-semibold text-white">{{ $education->institution }}</h3><span class="date-pill">{{ $education->period }}</span></div><p class="mt-2 font-medium text-[#70a9ff]">{{ $education->program }}</p>@if ($education->description)<p class="mt-3 max-w-3xl leading-7 text-[#94949c]">{{ $education->description }}</p>@endif</article>@endforeach</div>
        </section>

        <section id="sertifikasi" class="section scroll-mt-24">
            <div class="section-heading"><div><p class="eyebrow">{{ $setting('certifications_eyebrow', '05 / Continuous learning') }}</p><h2>{{ $setting('certifications_title', 'Pelatihan & Sertifikasi') }}</h2></div><div class="hidden gap-2 sm:flex"><button class="slider-button" data-certification-prev aria-label="Item sebelumnya"><span class="material-symbols-outlined">arrow_back</span></button><button class="slider-button" data-certification-next aria-label="Item berikutnya"><span class="material-symbols-outlined">arrow_forward</span></button></div></div>
            @if ($certifications->isNotEmpty())
                <div class="certification-slider" data-certification-slider tabindex="0">@foreach ($certifications as $certification) @php($coverMedia = $certification->getFirstMedia('cover')) @php($certificateMedia = $certification->getFirstMedia('certificate')) @php($downloadName = \Illuminate\Support\Str::slug($profile?->name ?: 'Portfolio') . ' - ' . \Illuminate\Support\Str::slug($certification->title) . '.' . $certificateMedia?->extension)<article class="content-card certification-card">@if ($coverMedia)<button type="button" data-gallery-open="certificate-{{ $certification->id }}" class="certification-cover cursor-zoom-in"><img src="{{ $coverMedia->getUrl() }}" alt="Cover {{ $certification->title }}"></button><script type="application/json" id="certificate-gallery-{{ $certification->id }}">@json([['url' => $coverMedia->getUrl(), 'thumb' => $coverMedia->getUrl(), 'alt' => 'Cover ' . $certification->title]])</script>@else<div class="certification-cover certification-cover-placeholder"><span class="material-symbols-outlined">workspace_premium</span><span>Preview sertifikat</span></div>@endif<div class="flex items-start justify-between gap-3"><span class="date-pill">{{ $certification->type === 'training' ? 'Pelatihan' : 'Sertifikasi' }}</span>@if ($certification->completed_at)<span class="font-mono text-xs text-[#777780]">{{ $certification->completed_at->format('M Y') }}</span>@endif</div><h3 class="mt-5 text-lg font-semibold text-white">{{ $certification->title }}</h3><p class="mt-2 font-medium text-[#70a9ff]">{{ $certification->provider }}</p>@if ($certification->description)<p class="mt-3 text-sm leading-6 text-[#9999a2]">{{ $certification->description }}</p>@endif @if ($certification->credential_id)<p class="mt-3 font-mono text-xs text-[#777780]">ID: {{ $certification->credential_id }}</p>@endif<div class="mt-6 flex flex-wrap gap-3">@if ($certificateMedia)<a href="{{ $certificateMedia->getUrl() }}" target="_blank" class="inline-link">Lihat sertifikat<span class="material-symbols-outlined text-base">open_in_new</span></a><a href="{{ $certificateMedia->getUrl() }}" download="{{ $downloadName }}" class="inline-link text-[#c1c6d7]">Download<span class="material-symbols-outlined text-base">download</span></a>@endif @if ($certification->verification_url)<a href="{{ $certification->verification_url }}" target="_blank" class="inline-link text-[#c1c6d7]">Verifikasi<span class="material-symbols-outlined text-base">verified</span></a>@endif</div></article>@endforeach</div>
                <div class="mt-5 flex items-center justify-between sm:justify-center"><div class="slider-dots" data-certification-dots aria-label="Posisi pelatihan dan sertifikasi"></div><span class="ml-4 font-mono text-xs text-[#777780] sm:hidden" data-certification-count></span></div>
            @else
                <div class="content-card text-[#9999a2]">{{ $setting('empty_certifications_label', 'Belum ada pelatihan atau sertifikasi.') }}</div>
            @endif
        </section>

        <section id="kontak" class="section scroll-mt-24">
            <div class="section-heading"><div><p class="eyebrow">{{ $setting('contact_eyebrow', '06 / Let’s connect') }}</p><h2>{{ $setting('contact_title', 'Mari berkolaborasi') }}</h2></div></div><div class="contact-card"><p class="leading-7 text-[#b8b7bf]">{{ $setting('contact_description', 'Terbuka untuk diskusi proyek, kolaborasi, dan peluang baru.') }}</p><div class="mt-6 grid gap-3">@foreach ($socialLinks as $link)<a href="{{ $link->url }}" target="_blank" class="contact-action"><x-social-icon :platform="$link->platform" class="shrink-0 text-[#70a9ff]" /><span>{{ $link->label }}</span><span class="material-symbols-outlined ml-auto text-base">arrow_outward</span></a>@endforeach</div></div>
        </section>
    </main>

    <div class="gallery-modal hidden" data-gallery-modal role="dialog" aria-modal="true" aria-label="Project image viewer">
        <button type="button" class="gallery-backdrop" data-gallery-close aria-label="Tutup viewer"></button>
        <div class="gallery-panel">
            <div class="gallery-toolbar"><div><p class="eyebrow">Project preview</p><p class="gallery-title" data-gallery-title></p></div><button type="button" class="icon-button" data-gallery-close aria-label="Tutup viewer"><span class="material-symbols-outlined">close</span></button></div>
            <div class="gallery-stage"><button type="button" class="gallery-nav gallery-prev" data-gallery-prev aria-label="Gambar sebelumnya"><span class="material-symbols-outlined">arrow_back</span></button><img data-gallery-image src="" alt="" class="gallery-main-image"><button type="button" class="gallery-nav gallery-next" data-gallery-next aria-label="Gambar berikutnya"><span class="material-symbols-outlined">arrow_forward</span></button></div>
            <div class="gallery-footer"><span class="gallery-counter" data-gallery-counter></span><div class="gallery-thumbnails" data-gallery-thumbnails aria-label="Thumbnail gambar"></div></div>
        </div>
    </div>

    <footer class="border-t border-white/10 px-5 py-8 lg:px-6"><div class="mx-auto flex max-w-6xl flex-col gap-5 text-center font-mono text-[11px] uppercase tracking-[0.16em] text-[#777780] sm:flex-row sm:items-center sm:justify-between sm:text-left"><div><span>{{ $setting('footer_tagline', 'Buatan Indonesia') }}</span><div class="mt-4 flex justify-center gap-2 sm:justify-start">@foreach ($socialLinks as $link)<a href="{{ $link->url }}" target="_blank" class="footer-social" aria-label="{{ $link->label }}"><x-social-icon :platform="$link->platform" /></a>@endforeach</div></div><span>© {{ date('Y') }} {{ $profile?->name }}</span></div></footer>
</body>
</html>
