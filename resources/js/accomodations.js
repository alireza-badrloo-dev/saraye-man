


const toggleBtn = document.getElementById("menu-toggle");
const closeBtn = document.getElementById("menu-close");
const mobileMenu = document.getElementById("mobile-menu");

toggleBtn.addEventListener("click", () => {
    mobileMenu.classList.remove("hidden");
});

closeBtn.addEventListener("click", () => {
    mobileMenu.classList.add("hidden");
});




// اگر با npm نصب کردید، این خط را در ابتدای فایل بنویسید:
 import noUiSlider from 'nouislider';
 import 'nouislider/dist/nouislider.css'; // اگر از CDN استفاده نمی‌کنید
