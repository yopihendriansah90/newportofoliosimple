import './bootstrap';

const menu = document.querySelector('[data-menu]');
const menuOpen = document.querySelector('[data-menu-open]');
const menuCloseButtons = document.querySelectorAll('[data-menu-close], [data-menu-link]');

const closeMenu = () => {
    menu?.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
};

menuOpen?.addEventListener('click', () => {
    menu?.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
});
menuCloseButtons.forEach((button) => button.addEventListener('click', closeMenu));

const slider = document.querySelector('[data-slider]');
if (slider) {
    const cards = [...slider.querySelectorAll('.project-card')];
    const dots = document.querySelector('[data-slider-dots]');
    const count = document.querySelector('[data-slider-count]');
    const previous = document.querySelector('[data-slider-prev]');
    const next = document.querySelector('[data-slider-next]');

    cards.forEach((_, index) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'slider-dot';
        dot.setAttribute('aria-label', `Lihat proyek ${index + 1}`);
        dot.addEventListener('click', () => cards[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' }));
        dots?.appendChild(dot);
    });

    const updateSlider = () => {
        const index = Math.min(cards.length - 1, Math.max(0, Math.round(slider.scrollLeft / Math.max(1, cards[0].offsetWidth + 16))));
        dots?.querySelectorAll('.slider-dot').forEach((dot, dotIndex) => dot.classList.toggle('is-active', dotIndex === index));
        if (count) count.textContent = `${index + 1} / ${cards.length}`;
        if (previous) previous.disabled = index === 0;
        if (next) next.disabled = index === cards.length - 1;
    };
    previous?.addEventListener('click', () => cards[Math.max(0, Math.round(slider.scrollLeft / (cards[0].offsetWidth + 16)) - 1)]?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' }));
    next?.addEventListener('click', () => cards[Math.min(cards.length - 1, Math.round(slider.scrollLeft / (cards[0].offsetWidth + 16)) + 1)]?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' }));
    slider.addEventListener('scroll', updateSlider, { passive: true });
    window.addEventListener('resize', updateSlider);
    updateSlider();
}

const skillSlider = document.querySelector('[data-skill-slider]');
if (skillSlider) {
    const cards = [...skillSlider.querySelectorAll('.skill-card')];
    const dots = document.querySelector('[data-skill-slider-dots]');
    const count = document.querySelector('[data-skill-slider-count]');
    const previous = document.querySelector('[data-skill-slider-prev]');
    const next = document.querySelector('[data-skill-slider-next]');
    const cardStep = () => cards[0]?.offsetWidth + 16 || 1;

    cards.forEach((_, index) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'slider-dot';
        dot.setAttribute('aria-label', `Lihat kategori keahlian ${index + 1}`);
        dot.addEventListener('click', () => cards[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' }));
        dots?.appendChild(dot);
    });

    const updateSkillSlider = () => {
        const index = Math.min(cards.length - 1, Math.max(0, Math.round(skillSlider.scrollLeft / cardStep())));
        dots?.querySelectorAll('.slider-dot').forEach((dot, dotIndex) => dot.classList.toggle('is-active', dotIndex === index));
        if (count) count.textContent = `${index + 1} / ${cards.length}`;
        if (previous) previous.disabled = index === 0;
        if (next) next.disabled = index === cards.length - 1;
    };

    previous?.addEventListener('click', () => cards[Math.max(0, Math.round(skillSlider.scrollLeft / cardStep()) - 1)]?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' }));
    next?.addEventListener('click', () => cards[Math.min(cards.length - 1, Math.round(skillSlider.scrollLeft / cardStep()) + 1)]?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' }));
    skillSlider.addEventListener('scroll', updateSkillSlider, { passive: true });
    window.addEventListener('resize', updateSkillSlider);
    updateSkillSlider();
}

const certificationSlider = document.querySelector('[data-certification-slider]');
if (certificationSlider) {
    const cards = [...certificationSlider.querySelectorAll('.certification-card')];
    const dots = document.querySelector('[data-certification-dots]');
    const count = document.querySelector('[data-certification-count]');
    const previous = document.querySelector('[data-certification-prev]');
    const next = document.querySelector('[data-certification-next]');
    const cardStep = () => cards[0]?.offsetWidth + 16 || 1;

    cards.forEach((_, index) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'slider-dot';
        dot.setAttribute('aria-label', `Lihat item sertifikasi ${index + 1}`);
        dot.addEventListener('click', () => cards[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' }));
        dots?.appendChild(dot);
    });

    const updateCertificationSlider = () => {
        const index = Math.min(cards.length - 1, Math.max(0, Math.round(certificationSlider.scrollLeft / cardStep())));
        dots?.querySelectorAll('.slider-dot').forEach((dot, dotIndex) => dot.classList.toggle('is-active', dotIndex === index));
        if (count) count.textContent = `${index + 1} / ${cards.length}`;
        if (previous) previous.disabled = index === 0;
        if (next) next.disabled = index === cards.length - 1;
    };

    previous?.addEventListener('click', () => cards[Math.max(0, Math.round(certificationSlider.scrollLeft / cardStep()) - 1)]?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' }));
    next?.addEventListener('click', () => cards[Math.min(cards.length - 1, Math.round(certificationSlider.scrollLeft / cardStep()) + 1)]?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' }));
    certificationSlider.addEventListener('scroll', updateCertificationSlider, { passive: true });
    window.addEventListener('resize', updateCertificationSlider);
    updateCertificationSlider();
}

const galleryModal = document.querySelector('[data-gallery-modal]');
const galleryImage = galleryModal?.querySelector('[data-gallery-image]');
const galleryTitle = galleryModal?.querySelector('[data-gallery-title]');
const galleryCounter = galleryModal?.querySelector('[data-gallery-counter]');
const galleryThumbnails = galleryModal?.querySelector('[data-gallery-thumbnails]');
const galleryPrevious = galleryModal?.querySelector('[data-gallery-prev]');
const galleryNext = galleryModal?.querySelector('[data-gallery-next]');
let galleryItems = [];
let galleryIndex = 0;
let galleryTouchStartX = 0;
let galleryZoomed = false;
let galleryDragging = false;
let galleryDragStartX = 0;
let galleryDragStartY = 0;
let galleryOffsetX = 0;
let galleryOffsetY = 0;
let galleryLastTap = 0;

const applyGalleryZoom = () => {
    if (!galleryImage) return;
    galleryImage.classList.toggle('is-zoomed', galleryZoomed);
    galleryImage.style.setProperty('--zoom-x', `${galleryOffsetX}px`);
    galleryImage.style.setProperty('--zoom-y', `${galleryOffsetY}px`);
};

const resetGalleryZoom = () => {
    galleryZoomed = false;
    galleryDragging = false;
    galleryOffsetX = 0;
    galleryOffsetY = 0;
    galleryImage?.classList.remove('is-zoomed', 'is-dragging');
    galleryImage?.style.removeProperty('--zoom-x');
    galleryImage?.style.removeProperty('--zoom-y');
};

const toggleGalleryZoom = () => {
    galleryZoomed = !galleryZoomed;
    if (!galleryZoomed) {
        galleryOffsetX = 0;
        galleryOffsetY = 0;
    }
    applyGalleryZoom();
};

const renderGallery = () => {
    if (!galleryImage || !galleryItems.length) return;
    const item = galleryItems[galleryIndex];
    galleryLastTap = 0;
    resetGalleryZoom();
    galleryImage.classList.remove('is-visible');
    galleryImage.src = item.url;
    galleryImage.alt = item.alt || '';
    const revealImage = () => requestAnimationFrame(() => galleryImage.classList.add('is-visible'));
    galleryImage.onload = revealImage;
    if (galleryImage.complete) revealImage();
    if (galleryCounter) galleryCounter.textContent = `${galleryIndex + 1} / ${galleryItems.length}`;
    if (galleryTitle) galleryTitle.textContent = galleryModal?.dataset.title || '';
    galleryThumbnails?.querySelectorAll('.gallery-thumb').forEach((thumb, index) => {
        thumb.classList.toggle('is-active', index === galleryIndex);
        if (index === galleryIndex) thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    });
    if (galleryPrevious) galleryPrevious.disabled = galleryIndex === 0;
    if (galleryNext) galleryNext.disabled = galleryIndex === galleryItems.length - 1;
};

const closeGallery = () => {
    galleryModal?.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    if (galleryImage) galleryImage.src = '';
};

document.querySelectorAll('[data-gallery-open]').forEach((button) => {
    button.addEventListener('click', () => {
        const payload = document.getElementById(`project-gallery-${button.dataset.galleryOpen}`) || document.getElementById(`certificate-gallery-${button.dataset.galleryOpen.replace('certificate-', '')}`);
        galleryItems = payload ? JSON.parse(payload.textContent) : [];
        galleryIndex = 0;
        if (galleryModal) {
            galleryModal.dataset.title = button.closest('.project-card, .certification-card')?.querySelector('h3')?.textContent?.trim() || '';
            galleryModal.classList.toggle('gallery-single', galleryItems.length <= 1);
        }
        if (galleryThumbnails) {
            galleryThumbnails.innerHTML = '';
            galleryItems.forEach((item, index) => {
                const thumbnail = document.createElement('button');
                thumbnail.type = 'button';
                thumbnail.className = 'gallery-thumb';
                thumbnail.setAttribute('aria-label', `Lihat gambar ${index + 1}`);
                const thumbnailImage = document.createElement('img');
                thumbnailImage.src = item.thumb || item.url;
                thumbnailImage.alt = '';
                thumbnail.appendChild(thumbnailImage);
                thumbnail.addEventListener('click', () => { galleryIndex = index; renderGallery(); });
                galleryThumbnails.appendChild(thumbnail);
            });
        }
        galleryModal?.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        renderGallery();
    });
});

galleryModal?.querySelectorAll('[data-gallery-close]').forEach((button) => button.addEventListener('click', closeGallery));
galleryPrevious?.addEventListener('click', () => { if (galleryIndex > 0) { galleryIndex -= 1; renderGallery(); } });
galleryNext?.addEventListener('click', () => { if (galleryIndex < galleryItems.length - 1) { galleryIndex += 1; renderGallery(); } });
galleryModal?.addEventListener('touchstart', (event) => { galleryTouchStartX = event.changedTouches[0].screenX; }, { passive: true });
galleryModal?.addEventListener('touchend', (event) => {
    const delta = event.changedTouches[0].screenX - galleryTouchStartX;
    if (Math.abs(delta) < 45) return;
    if (delta < 0 && galleryIndex < galleryItems.length - 1) galleryIndex += 1;
    if (delta > 0 && galleryIndex > 0) galleryIndex -= 1;
    renderGallery();
}, { passive: true });

galleryImage?.addEventListener('dblclick', (event) => {
    event.preventDefault();
    toggleGalleryZoom();
});
galleryImage?.addEventListener('touchend', (event) => {
    const now = Date.now();
    const touch = event.changedTouches[0];
    const isDoubleTap = now - galleryLastTap < 320;
    const moved = Math.abs(touch.screenX - (galleryImage.dataset.lastTapX || touch.screenX)) > 28 || Math.abs(touch.screenY - (galleryImage.dataset.lastTapY || touch.screenY)) > 28;
    galleryImage.dataset.lastTapX = touch.screenX;
    galleryImage.dataset.lastTapY = touch.screenY;
    if (isDoubleTap && !moved) {
        event.preventDefault();
        toggleGalleryZoom();
        galleryLastTap = 0;
        return;
    }
    galleryLastTap = now;
}, { passive: false });
galleryImage?.addEventListener('pointerdown', (event) => {
    if (!galleryZoomed) return;
    galleryDragging = true;
    galleryDragStartX = event.clientX - galleryOffsetX;
    galleryDragStartY = event.clientY - galleryOffsetY;
    galleryImage.classList.add('is-dragging');
    galleryImage.setPointerCapture(event.pointerId);
});
galleryImage?.addEventListener('pointermove', (event) => {
    if (!galleryDragging) return;
    galleryOffsetX = event.clientX - galleryDragStartX;
    galleryOffsetY = event.clientY - galleryDragStartY;
    applyGalleryZoom();
});
const stopGalleryDrag = () => {
    galleryDragging = false;
    galleryImage?.classList.remove('is-dragging');
};
galleryImage?.addEventListener('pointerup', stopGalleryDrag);
galleryImage?.addEventListener('pointercancel', stopGalleryDrag);
document.addEventListener('keydown', (event) => {
    if (galleryModal?.classList.contains('hidden')) return;
    if (event.key === 'Escape') closeGallery();
    if (event.key === 'ArrowLeft' && galleryIndex > 0) { galleryIndex -= 1; renderGallery(); }
    if (event.key === 'ArrowRight' && galleryIndex < galleryItems.length - 1) { galleryIndex += 1; renderGallery(); }
    if ((event.key === '+' || event.key === '=') && !galleryZoomed) toggleGalleryZoom();
    if (event.key === '0' && galleryZoomed) resetGalleryZoom();
});
