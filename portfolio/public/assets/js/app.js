/**
 * Global Portfolio Application JavaScript
 * Vanilla ES6+ without frameworks or bundlers
 */
document.addEventListener('DOMContentLoaded', () => {
  // Smooth scroll for anchor links with header offset
  const navLinks = document.querySelectorAll('a[href^="#"]');
  const header = document.querySelector('.site-header');
  const headerHeight = header ? header.offsetHeight : 80;

  navLinks.forEach((link) => {
    link.addEventListener('click', (e) => {
      const targetId = link.getAttribute('href');
      if (targetId === '#' || !targetId) return;

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        e.preventDefault();
        const elementPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - headerHeight - 16;

        window.scrollTo({
          top: targetId === '#top' ? 0 : offsetPosition,
          behavior: 'smooth'
        });

        // Update active class on links
        navLinks.forEach((l) => l.classList.remove('is-active'));
        link.classList.add('is-active');
      }
    });
  });

  // Intersection Observer to update active navigation on scroll
  const sections = document.querySelectorAll('section[id]');
  if ('IntersectionObserver' in window && sections.length > 0) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const id = entry.target.getAttribute('id');
            navLinks.forEach((link) => {
              if (link.getAttribute('href') === `#${id}`) {
                navLinks.forEach((l) => l.classList.remove('is-active'));
                link.classList.add('is-active');
              }
            });
          }
        });
      },
      {
        rootMargin: '-20% 0px -60% 0px'
      }
    );

    sections.forEach((section) => observer.observe(section));
  }
});
