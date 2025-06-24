document.addEventListener('DOMContentLoaded', function () {
  const target = document.querySelector('#about .content');

  if (!target) return;

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && entry.intersectionRatio >= 0.1) {
          target.classList.add('animate-in');
          observer.unobserve(target);
        }
      });
    },
    {
      threshold: 0.5,
    }
  );

  observer.observe(target);
});
