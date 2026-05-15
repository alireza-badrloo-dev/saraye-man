// --- Modal 1: Gallery Modal ---
document.addEventListener("DOMContentLoaded", () => {
    const openGalleryModalBtn = document.getElementById('openModal'); 
    const galleryModal = document.getElementById('modal'); 
    const closeGalleryModalBtn = document.getElementById('closeGalleryModalBtn');
    const galleryBody = document.body; 

    if (openGalleryModalBtn && galleryModal && closeGalleryModalBtn) {
        openGalleryModalBtn.addEventListener('click', () => {
            galleryModal.style.display = 'flex';
            galleryBody.classList.add('no-scroll'); 
        });

        closeGalleryModalBtn.addEventListener('click', () => {
            galleryModal.style.display = 'none';
            galleryBody.classList.remove('no-scroll'); 
        });

        
    } else {
        console.error("Gallery Modal: One or more elements not found. Check IDs: 'openModal', 'modal', 'closeGalleryModalBtn'.");
    }

   
    const openOverlayModalBtn = document.getElementById('modalbtn');
    const overlayModal = document.getElementById('modalOverlay'); 
    const closeOverlayModalBtn = document.getElementById('modalClose');
    

    if (openOverlayModalBtn && overlayModal && closeOverlayModalBtn) {
        openOverlayModalBtn.addEventListener('click', () => {
            overlayModal.style.display = 'flex';
            galleryBody.classList.add('no-scroll'); 
        });

        closeOverlayModalBtn.addEventListener('click', () => {
            overlayModal.style.display = 'none';
            galleryBody.classList.remove('no-scroll'); 
        });

        
    } else {
        console.error("Overlay Modal: One or more elements not found. Check IDs: 'modalbtn', 'modalOverlay', 'modalClose'.");
    }
});


