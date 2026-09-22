const menuButton = document.querySelector('[data-menu-button]');
const menu = document.querySelector('[data-menu]');

menuButton?.addEventListener('click', () => {
    const isOpen = menu?.classList.toggle('is-open') ?? false;
    menuButton.setAttribute('aria-expanded', String(isOpen));
});

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.12 });

document.querySelectorAll('.reveal').forEach((element) => observer.observe(element));
