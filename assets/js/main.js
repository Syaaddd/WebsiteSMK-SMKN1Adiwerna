// Mobile menu toggle
const mobileBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
if (mobileBtn && mobileMenu) {
    mobileBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
        const isOpen = mobileMenu.classList.contains('open');
        mobileBtn.innerHTML = isOpen
            ? `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>`
            : `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>`;
    });
}

// Navbar scroll effect
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 20);
    });
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// Scroll reveal animation
const revealElements = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('opacity-100', 'translate-y-0');
            entry.target.classList.remove('opacity-0', 'translate-y-6');
            revealObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });
revealElements.forEach(el => {
    el.classList.add('opacity-0', 'translate-y-6', 'transition-all', 'duration-500');
    revealObserver.observe(el);
});

// Counter animation for stats
function animateCounter(el, target, duration = 1500) {
    const start = 0;
    const startTime = performance.now();
    const update = (currentTime) => {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target).toLocaleString('id-ID');
        if (progress < 1) requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
}

const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const el = entry.target;
            const raw = el.dataset.count;
            if (raw) {
                const num = parseInt(raw.replace(/\D/g, ''));
                const suffix = raw.replace(/[0-9,]/g, '');
                animateCounter({ set textContent(v) { el.textContent = v + suffix; } }, num);
            }
            statsObserver.unobserve(el);
        }
    });
}, { threshold: 0.5 });
document.querySelectorAll('[data-count]').forEach(el => statsObserver.observe(el));

// Tab system
document.querySelectorAll('[data-tab-target]').forEach(btn => {
    btn.addEventListener('click', () => {
        const target = btn.dataset.tabTarget;
        const group = btn.dataset.tabGroup;
        document.querySelectorAll(`[data-tab-group="${group}"]`).forEach(b => {
            b.classList.remove('bg-orange-500', 'text-white');
            b.classList.add('text-stone-500', 'hover:text-stone-700');
        });
        btn.classList.add('bg-orange-500', 'text-white');
        btn.classList.remove('text-stone-500', 'hover:text-stone-700');
        document.querySelectorAll(`[data-tab-panel="${group}"]`).forEach(panel => {
            panel.classList.toggle('hidden', panel.dataset.tabId !== target);
        });
    });
});

// Form validation helper
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;
    let valid = true;
    form.querySelectorAll('[required]').forEach(field => {
        if (!field.value.trim()) {
            field.style.borderColor = '#ef4444';
            valid = false;
        } else {
            field.style.borderColor = '';
        }
    });
    return valid;
}

// Alert dismiss
document.querySelectorAll('[data-dismiss]').forEach(btn => {
    btn.addEventListener('click', () => {
        btn.closest('[data-alert]')?.remove();
    });
});
