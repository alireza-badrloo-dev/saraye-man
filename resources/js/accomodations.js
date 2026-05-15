


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

// اول، عناصر HTML را انتخاب می‌کنیم
const sliderElement = document.getElementById('price-slider');
const minPriceDisplay = document.getElementById('val-min');
const maxPriceDisplay = document.getElementById('val-max');

// بعد، خود اسلایدر را با noUiSlider.create مقداردهی اولیه می‌کنیم
noUiSlider.create(sliderElement, {
    start: [0, 1000000], // مقدار شروع: حداقل 0، حداکثر 1,000,000
    connect: true,       // آیا قسمت بین دو دسته رنگی شود؟ (true یعنی بله)
    step: 50000,         // هر پله چقدر جابجا شود؟ (مثلاً 50 هزار تومان)
    range: {             // محدوده کلی اسلایدر
        'min': 0,
        'max': 1000000
    },
    format: { // فرمت نمایش اعداد (اختیاری اما مفید)
      to: function (value) {
        // این تابع اعداد را به فرمت دلخواه شما تبدیل می‌کند
        // برای مثال، اضافه کردن "تومان" یا جدا کردن ارقام
        return Math.round(value).toLocaleString('fa-IR'); // فرمت فارسی با کاما
      },
      from: function (value) {
        // این تابع مقادیر را از فرمت نمایش برمی‌گرداند به عدد
        return parseFloat(value.replace(/,/g, '')); // حذف کاماها برای تبدیل به عدد
      }
    }
});

// حالا، کاری می‌کنیم که با تغییر اسلایدر، اعداد روی صفحه هم آپدیت شوند
const slider = sliderElement.noUiSlider; // دسترسی به خود شیء اسلایدر

slider.on('update', function(values, handle) {
    // 'values' یک آرایه است که دو مقدار دارد: [حداقل, حداکثر]
    // 'handle' نشان می‌دهد کدام دسته حرکت کرده (0 برای اولی، 1 برای دومی)

    if (handle === 0) {
        minPriceDisplay.textContent = values[0]; // نمایش حداقل قیمت
    } else {
        maxPriceDisplay.textContent = values[1]; // نمایش حداکثر قیمت
    }
});

// اگر بخواهید وقتی کاربر اسلایدر را رها کرد، مقادیر نهایی را بگیرید
slider.on('change', function(values) {
    const finalMinValue = slider.get()[0]; // مقدار عددی حداقل
    const finalMaxValue = slider.get()[1]; // مقدار عددی حداکثر

    console.log("مقدار نهایی حداقل:", finalMinValue);
    console.log("مقدار نهایی حداکثر:", finalMaxValue);

    // اینجا می‌توانید کاری با این مقادیر انجام دهید، مثلاً
    // فیلتر کردن محصولات، ارسال به سرور، و غیره.
    // alert(`فیلتر بین ${finalMinValue} تا ${finalMaxValue}`);
    
});
