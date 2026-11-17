document.addEventListener('DOMContentLoaded', () => {
    // Scroll reveal
    const revealEls = document.querySelectorAll('.fade-in, .slide-up');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        revealEls.forEach(el => observer.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('visible'));
    }

    // Header shadow once the page is scrolled
    const header = document.getElementById('site-header');
    if (header) {
        const onScroll = () => header.classList.toggle('shadow-sm', window.scrollY > 8);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    // Highlight the nav link of the section in view
    const navLinks = document.querySelectorAll('#desktop-nav a[href^="#"]');
    if (navLinks.length && 'IntersectionObserver' in window) {
        const linkFor = id => Array.from(navLinks).find(a => a.getAttribute('href') === `#${id}`);
        const sectionObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                navLinks.forEach(a => { a.classList.remove('nav-active'); a.removeAttribute('aria-current'); });
                const link = linkFor(entry.target.id);
                if (link) { link.classList.add('nav-active'); link.setAttribute('aria-current', 'true'); }
            });
        }, { rootMargin: '-45% 0px -50% 0px' });
        navLinks.forEach(a => {
            const section = document.querySelector(a.getAttribute('href'));
            if (section) sectionObserver.observe(section);
        });
    }

    // Mobile menu
    const menuBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('mobile-close-btn');
    const menu = document.getElementById('mobile-menu');
    if (menuBtn && menu) {
        let isOpen = false;

        const setMenu = open => {
            isOpen = open;
            menu.classList.toggle('opacity-0', !open);
            menu.classList.toggle('pointer-events-none', !open);
            menu.classList.toggle('opacity-100', open);
            menu.classList.toggle('pointer-events-auto', open);
            menu.setAttribute('aria-hidden', String(!open));
            menuBtn.setAttribute('aria-expanded', String(open));
            document.body.classList.toggle('overflow-hidden', open);
            if (open && closeBtn) closeBtn.focus();
            if (!open) menuBtn.focus({ preventScroll: true });
        };

        menuBtn.addEventListener('click', () => setMenu(!isOpen));
        if (closeBtn) closeBtn.addEventListener('click', () => setMenu(false));
        document.addEventListener('keydown', e => { if (e.key === 'Escape' && isOpen) setMenu(false); });
        menu.querySelectorAll('.mobile-link').forEach(link =>
            link.addEventListener('click', () => { if (isOpen) setMenu(false); })
        );
    }
});
