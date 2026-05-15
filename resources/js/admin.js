const sidebar = document.getElementById('sidebar'),
    sidebarCloseicon = document.getElementById('sidebar-close-icon'),
    sidebarOpenicon = document.getElementById('sidebar-open-icon'),
    sidebarContentLayout = document.getElementById('sidebar-content-layout'),
    overlay = document.getElementById('overlay');

function openSidebar() {
    sidebar.classList.add('absolute', 'z-50', 'flex', 'flex-row-reverse')
    sidebar.classList.remove('hidden')


    sidebarCloseicon.classList.remove('hidden')
    sidebarCloseicon.classList.add('flex')

    document.body.classList.add('overflow-hidden')

    overlay.classList.remove('hidden')
}


function closeSidebar() {
    sidebar.classList.remove('absolute', 'z-50',  'flex', 'flex-row-reverse')
    sidebar.classList.add('hidden')

    sidebarCloseicon.classList.add('hidden')
    sidebarCloseicon.classList.remove('flex')

   

    document.body.classList.remove('overflow-hidden')

    overlay.classList.add('hidden')
}

sidebarOpenicon.addEventListener('click', () => openSidebar())
sidebarCloseicon.addEventListener('click', () => closeSidebar())
overlay.addEventListener('click', () => closeSidebar())
window.addEventListener('resize', () => closeSidebar())

// resources/js/admin/gallery-swiper.js
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

export function initGallerySwiper() {
    const swiperElement = document.querySelector('.gallery-swiper');
    if (!swiperElement) return;
    
    // دریافت تعداد اسلایدها
    const slides = swiperElement.querySelectorAll('.swiper-slide');
    const slidesCount = slides.length;
    const hasMultiple = slidesCount > 1;
    
    // تنظیمات پایه
    const config = {
        slidesPerView: 1,
        spaceBetween: 0,
        centeredSlides: true,
        speed: 600,
        effect: 'slide',
        touchRatio: 1.5,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        keyboard: {
            enabled: true,
            onlyInViewport: true,
        },
    };
    
    // اگر بیشتر از یک عکس باشه، لوپ و اتوپلی اضافه کن
    if (hasMultiple) {
        config.loop = true;
        config.autoplay = {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        };
    }
    
    // راه‌اندازی Swiper
    const swiper = new Swiper('.gallery-swiper', config);
    
    // لایت‌باکس برای بزرگنمایی تصاویر
    const lightbox = createLightbox();
    
    // اضافه کردن رویداد کلیک به تصاویر
    document.querySelectorAll('.gallery-swiper .swiper-slide img').forEach(img => {
        img.addEventListener('click', () => openLightbox(img.src, swiper));
    });
    
    return swiper;
}

// ساخت لایت‌باکس
function createLightbox() {
    let lightbox = document.querySelector('.custom-lightbox');
    
    if (!lightbox) {
        lightbox = document.createElement('div');
        lightbox.className = 'custom-lightbox fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center';
        lightbox.innerHTML = `
            <div class="relative max-w-5xl w-full mx-4">
                <button class="close-lightbox absolute -top-12 left-0 text-white text-3xl hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
                <img class="lightbox-image w-full rounded-lg" src="" alt="تصویر بزرگ">
                <button class="lightbox-prev absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="lightbox-next absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        `;
        document.body.appendChild(lightbox);
        
        // رویدادها
        lightbox.querySelector('.close-lightbox').addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });
        
        document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('flex')) return;
            if (e.key === 'Escape') closeLightbox();
        });
    }
    
    return lightbox;
}

function openLightbox(src, swiper) {
    const lightbox = document.querySelector('.custom-lightbox');
    if (!lightbox) return;
    
    lightbox.querySelector('.lightbox-image').src = src;
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden';
    
    // ذخیره اندیس فعلی
    const allImages = Array.from(document.querySelectorAll('.gallery-swiper .swiper-slide img'));
    const currentIndex = allImages.findIndex(img => img.src === src);
    lightbox.dataset.currentIndex = currentIndex;
    
    // رویداد دکمه قبلی
    const prevBtn = lightbox.querySelector('.lightbox-prev');
    const newPrevBtn = prevBtn.cloneNode(true);
    prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);
    newPrevBtn.addEventListener('click', () => navigateLightbox('prev', swiper));
    
    // رویداد دکمه بعدی
    const nextBtn = lightbox.querySelector('.lightbox-next');
    const newNextBtn = nextBtn.cloneNode(true);
    nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);
    newNextBtn.addEventListener('click', () => navigateLightbox('next', swiper));
}

function closeLightbox() {
    const lightbox = document.querySelector('.custom-lightbox');
    if (lightbox) {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    }
}

function navigateLightbox(direction, swiper) {
    const lightbox = document.querySelector('.custom-lightbox');
    if (!lightbox) return;
    
    const allImages = Array.from(document.querySelectorAll('.gallery-swiper .swiper-slide img'));
    let currentIndex = parseInt(lightbox.dataset.currentIndex);
    
    if (direction === 'prev') {
        currentIndex = currentIndex > 0 ? currentIndex - 1 : allImages.length - 1;
    } else {
        currentIndex = currentIndex < allImages.length - 1 ? currentIndex + 1 : 0;
    }
    
    lightbox.dataset.currentIndex = currentIndex;
    lightbox.querySelector('.lightbox-image').src = allImages[currentIndex].src;
    
    // حرکت Swiper به اسلاید مربوطه
    if (swiper) {
        swiper.slideTo(currentIndex);
    }
}

// اجرا بعد از لود کامل صفحه
document.addEventListener('DOMContentLoaded', initGallerySwiper);