document.addEventListener('DOMContentLoaded', () => {
   const mobileMenuButton = document.querySelector('.mobile-menu-button');
   const mobileMenu = document.querySelector('.mobile-menu');

   console.log(mobileMenu, mobileMenuButton);

   if (mobileMenuButton && mobileMenu) {
       mobileMenuButton.addEventListener('click', () => {
           mobileMenu.classList.toggle('hidden');
       });
   }
});
