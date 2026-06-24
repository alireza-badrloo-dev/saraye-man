import './bootstrap';
import '@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css';
import '@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js';

import autoprefixer from 'autoprefixer';
// // در فایل app.js خودتان

import Swiper from 'swiper';


import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';





var swiper = new Swiper('.swiper-container', {

    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: 1,
    spaceBetween: 10,
    breakpoints: {
        425: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        550: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        700: {
            slidesPerView: 4,
            spaceBetween: 10,
        },

        900: {
            slidesPerView: 5,
            spaceBetween: 20,
        },

        1270: {
            slidesPerView: 6,
            spaceBetween: 20,
        }
    },
    // تنظیمات ناوبری
    // navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    // },
    // تنظیمات نقاط ناوبری (pagination)
    // pagination: {
    //     el: '.swiper-pagination',
    //     clickable: true, // امکان کلیک روی نقاط برای جابجایی
    // },
    // تنظیمات اسلاید خودکار (اختیاری)
    // autoplay: {
    //     delay: 5000, // زمان مکث بین اسلایدها به میلی‌ثانیه
    //     disableOnInteraction: false, // ادامه دادن اسلاید خودکار حتی بعد از تعامل کاربر
    // },
    // جلوه‌های انتقال (اختیاری)
    // 'slide', 'fade', 'cube', 'coverflow', 'flip'
    // loop: true, // فعال کردن حلقه اسلایدها
    // speed: 800, // سرعت انیمیشن انتقال به میلی‌ثانیه
});
document.addEventListener('DOMContentLoaded', function() {
    // اسلایدرهای اصلی
    const mainSliders = ['.swiper-second', '.swiper-third', '.swiper-fourth', '.swiper-fifth'];
    
    mainSliders.forEach(function(selector) {
        new Swiper(selector, {
            slidesPerView: 1,
            spaceBetween: 10,
            breakpoints: {
                425: { slidesPerView: 2, spaceBetween: 10 },
                700: { slidesPerView: 3, spaceBetween: 20 },
                960: { slidesPerView: 4, spaceBetween: 20 },
            }
        });
    });
    
    // اسلایدر جزئیات
    new Swiper('.swiper-details', {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});

var swiper = new Swiper('.swiper-details', {

    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: 1,
    spaceBetween: 10,

    //  navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    // },
    //  // تنظیمات نقاط ناوبری (pagination)
    pagination: {
        el: '.swiper-pagination',
        clickable: true, // امکان کلیک روی نقاط برای جابجایی
    },

});



function showEditForm() {
    document.getElementById('showInfo').style.display = 'none';
    document.getElementById('editForm').style.display = 'block';
}

function cancelEdit() {
    document.getElementById('editForm').style.display = 'none';
    document.getElementById('showInfo').style.display = 'block';
}



document.addEventListener('DOMContentLoaded', function () {
    // تبدیل تاریخ امروز به شمسی برای minDate
    const today = new Date();
    const todayJalali = new Intl.DateTimeFormat('fa-IR-u-ca-persian', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    }).format(today).replace(/\//g, '/');

    // تنظیم flatpickr
    flatpickr(".datepicker", {
        locale: "fa",
        dateFormat: "Y/m/d",
        minDate: todayJalali, // تاریخ امروز شمسی
        disableMobile: true,
        onChange: function (selectedDates, dateStr, instance) {
            if (instance.element.name === 'check_in') {
                const checkOut = document.querySelector('input[name="check_out"]');
                if (checkOut && checkOut._flatpickr) {
                    checkOut._flatpickr.set('minDate', dateStr);
                }
            }
        }
    });
});


// المنت‌های مربوط به dropdown
const userMenuBtn = document.getElementById('userMenuBtn');
const userDropdown = document.getElementById('userDropdown');

// باز و بسته کردن dropdown با کلیک روی دکمه
if (userMenuBtn && userDropdown) {
    userMenuBtn.addEventListener('click', function (event) {
        event.stopPropagation();
        userDropdown.classList.toggle('hidden');
    });

    // بستن dropdown با کلیک خارج از آن
    document.addEventListener('click', function (event) {
        if (!userMenuBtn.contains(event.target) && !userDropdown.contains(event.target)) {
            userDropdown.classList.add('hidden');
        }
    });

    // جلوگیری از بسته شدن dropdown هنگام کلیک روی خود dropdown
    userDropdown.addEventListener('click', function (event) {
        event.stopPropagation();
    });
}


// ====== منوی موبایل ======
document.addEventListener('DOMContentLoaded', function() {
    
    // دکمه‌های باز و بسته کردن منو
    const menuOpenBtn = document.getElementById('menu-open');
    const menuCloseBtn = document.getElementById('menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    
    // باز کردن منو
    if (menuOpenBtn) {
        menuOpenBtn.addEventListener('click', function(e) {
            e.preventDefault();
            mobileMenu.classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // جلوگیری از اسکرول
        });
    }
    
    // بستن منو
    if (menuCloseBtn) {
        menuCloseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            mobileMenu.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    }
    
    // بستن منو با کلیک روی لینک‌ها
    const menuLinks = mobileMenu.querySelectorAll('a');
    menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    });
    
    // بستن منو با کلیک روی خارج از آن
    mobileMenu.addEventListener('click', function(e) {
        if (e.target === mobileMenu) {
            mobileMenu.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
    
    // ====== دکمه ورود/ثبت‌نام ======
    const openUserBtn = document.getElementById('openUser');
    if (openUserBtn) {
        openUserBtn.addEventListener('click', function(e) {
            e.preventDefault();
            // در اینجا می‌توانید مودال ورود را باز کنید
            // یا به صفحه ورود هدایت کنید
            // window.location.href = '/login';
            console.log('باز کردن فرم ورود/ثبت‌نام');
        });
    }
    
    // ====== جستجو ======
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const searchInput = this.querySelector('input[type="search"]');
            const query = searchInput?.value.trim();
            if (query && query.length > 0) {
                window.location.href = '/blog/search?search=' + encodeURIComponent(query);
            }
        });
    }
    
    // ====== فعال‌سازی لینک‌های منو ======
    const currentUrl = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link, #mobile-menu a');
    navLinks.forEach(function(link) {
        if (link.getAttribute('href') === currentUrl) {
            link.classList.add('active', 'text-orange-500', 'font-bold');
        }
    });
});