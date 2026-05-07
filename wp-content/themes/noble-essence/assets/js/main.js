const header = document.querySelector('.ne-header');
if (header) {
    window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 80);
    }, { passive: true });
}
const fadeEls = document.querySelectorAll('.ne-fade-in');
if (fadeEls.length) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(el => {
            if (el.isIntersecting) { el.target.classList.add('visible'); observer.unobserve(el.target); }
        });
    }, { threshold: 0.15 });
    fadeEls.forEach(el => observer.observe(el));
}
const burger = document.querySelector('.ne-burger');
const mobileMenu = document.querySelector('.ne-mobile-menu');
const mobileClose = document.querySelector('.ne-mobile-close');
if (burger && mobileMenu) {
    burger.addEventListener('click', () => { mobileMenu.classList.add('open'); document.body.style.overflow = 'hidden'; });
    mobileClose.addEventListener('click', () => { mobileMenu.classList.remove('open'); document.body.style.overflow = ''; });
}
