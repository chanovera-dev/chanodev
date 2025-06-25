document.addEventListener('DOMContentLoaded', function () {
  const targets = document.querySelectorAll('#about .content, #works .content');

  if (!targets.length) return;

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && entry.intersectionRatio >= 0.1) {
          entry.target.classList.add('animate-in');
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.5,
    }
  );

  targets.forEach(target => observer.observe(target));
});