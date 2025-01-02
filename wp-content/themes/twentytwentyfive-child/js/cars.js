document.addEventListener('DOMContentLoaded', function() {
    // @INFO: For navigation
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    silver: '#C0C0C0',
                }
            }
        }
    }
});
