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

function toggleMenuMobile() {}