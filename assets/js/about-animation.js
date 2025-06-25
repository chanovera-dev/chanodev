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


document.addEventListener('DOMContentLoaded', function () {
  const items = document.querySelectorAll('.card-timeline .card-item');

  items.forEach(item => {
    const figure = item.querySelector('figure');

    // Observar cambios en atributos (como class)
    const observer = new MutationObserver(mutations => {
      mutations.forEach(mutation => {
        if (mutation.attributeName === 'class') {
          // Reiniciar la animación quitando y volviendo a aplicar la animación en <figure>
          figure.style.animation = 'none';
          // Forzar reflow para que el cambio sea reconocido por el navegador
          void figure.offsetHeight;
          // Volver a aplicar la animación correcta según la clase actual del card-item
          if (item.classList.contains('animate')) {
            figure.style.animation = 'site-card-bounce 1s ease-in-out forwards';
          } else if (item.classList.contains('animate-back')) {
            figure.style.animation = 'site-card-bounce-reverse 1s ease-in-out forwards';
          } else {
            figure.style.animation = '';
          }
        }
      });
    });

    observer.observe(item, { attributes: true });

    // Eventos para alternar clases
    item.addEventListener('mouseenter', () => {
      item.classList.remove('animate-back');
      item.classList.add('animate');
    });

    item.addEventListener('mouseleave', () => {
      item.classList.remove('animate');
      item.classList.add('animate-back');
    });
  });
});

