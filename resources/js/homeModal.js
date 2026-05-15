document.addEventListener("DOMContentLoaded", () => {
    const openUser = document.getElementById('openUser');
    const userOverlay = document.getElementById('userOverlay');
    const closeUser = document.getElementById('closeUser');



    openUser.addEventListener('click', () => {
        userOverlay.classList.remove('hidden');
        userOverlay.classList.add('flex');

    });

    closeUser.addEventListener('click', () => {
        userOverlay.classList.add('hidden');
        userOverlay.classList.remove('flex');

    });
}
);



const userOverlay = document.getElementById('userOverlay');
const closeUser = document.getElementById('closeUser');

const userModalTitle = document.getElementById('userModalTitle');

const registerForm = document.getElementById('registerForm');
const loginForm = document.getElementById('loginForm');

const showLoginLink = document.getElementById('showLoginLink');
const showRegisterLink = document.getElementById('showRegisterLink');

// بستن مودال
closeUser?.addEventListener('click', () => {
    userOverlay.classList.add('hidden');
});

// نمایش فرم ورود
showLoginLink?.addEventListener('click', (e) => {
    e.preventDefault();
    registerForm.classList.add('hidden');
    loginForm.classList.remove('hidden');
    userModalTitle.innerText = 'ورود';
});

// نمایش فرم ثبت نام
showRegisterLink?.addEventListener('click', (e) => {
    e.preventDefault();
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');
    userModalTitle.innerText = 'ثبت نام';
});


