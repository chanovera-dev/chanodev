const body = document.body;

function scrollActions() {
    const SCROLL_UP = "scroll-up";
    const SCROLL_DOWN = "scroll-down";
    let lastScroll = 0;

    window.addEventListener("scroll", () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll <= 0) {
            body.classList.remove(SCROLL_UP, SCROLL_DOWN);
            return;
        }

        const isScrollingDown = currentScroll > lastScroll;

        body.classList.toggle(SCROLL_DOWN, isScrollingDown);
        body.classList.toggle(SCROLL_UP, !isScrollingDown);

        lastScroll = currentScroll;
    });
}
scrollActions();

function toggleMenuMobile() {
    const button = document.querySelector('#main-nav__button');
    const menu = document.querySelector('#main-nav nav');

    button.classList.toggle('active');
    menu.classList.toggle('show');
    body.style.overflow = body.style.overflow === 'hidden' ? 'auto' : 'hidden';
}

function toggleMainSearch() {
    const searchform = document.querySelector('#custom-searchform');

    if (window.innerWidth >= 768) {
        const button = document.getElementById('main-search__button');
        const nav = document.querySelector('#main-nav');
        
        button.classList.toggle('active');
        nav.classList.toggle('rotate');
    } else {
        nav.classList.add('rotate');
    }
}

function closeCustomSearchform() {
    if (window.innerWidth < 768) {
        const searchform = document.querySelector('#custom-searchform');

        if (searchform.classList.contains('show')) {
            searchform.classList.remove('show');
        }
    }
}