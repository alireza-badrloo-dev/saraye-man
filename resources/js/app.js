import './bootstrap';
import '@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css';
import '@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js';

const btn = document.getElementById('userMenuBtn');
const dropdown = document.getElementById('userDropdown');

if (btn) {
    btn.addEventListener('click', function () {
        dropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', function (e) {
        if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
}




// استفاده
window.jalaliDatepicker.startWatch({

});

import autoprefixer from 'autoprefixer';
// // در فایل app.js خودتان

import Swiper from 'swiper';


import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';



// فعال‌سازی Swiper
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


var swiper = new Swiper('.swiper-second', {

    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: 1,
    spaceBetween: 10,
    breakpoints: {
        425: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        700: {
            slidesPerView: 3,
            spaceBetween: 20,
        },

        960: {
            slidesPerView: 4,
            spaceBetween: 20,
        }

    },

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


