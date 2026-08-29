/**
 * ChanoDev Interactive Scripts
 * - Mouse-tracking spotlight glow effect
 * - Process Steps Interactive Fade-in Slideshow
 * - Authority Metrics Automatic Fade-in Slideshow
 * - Smooth Interactive FAQ Accordion (WAAPI)
 */
document.addEventListener('DOMContentLoaded', function () {
	// 1. Mouse Spotlight tracking
	const spotlightCards = document.querySelectorAll(
		'.hover-glow, .timeline-card-front, .service-detail-card, .architecture-window, .authority-metrics-track, .portfolio-cta-box, .profile-terminal-window, .code-terminal-window, .home-terminal-window, .home-deck-card, .home-mockup-window, .home-metric-card, .home-metric-slide-card, .about-skill-card, .about-metric-card, .about-philosophy-card, .philosophy-slide-card, .philosophy-visual-panel, .timeline-content-card, .home-pillar-card, .home-service-card, .tech-strip-wrapper'
	);

	spotlightCards.forEach(function (card) {
		card.addEventListener('mousemove', function (e) {
			const rect = card.getBoundingClientRect();
			const x = e.clientX - rect.left;
			const y = e.clientY - rect.top;
			card.style.setProperty('--mouse-x', x + 'px');
			card.style.setProperty('--mouse-y', y + 'px');
		});
	});

	// 2. Process & Metrics Slideshows (Scoped to every .process-carousel-wrapper)
	(function initProcessSlideshows() {
		const wrappers = document.querySelectorAll('.process-carousel-wrapper');
		if (!wrappers.length) return;

		wrappers.forEach(function (wrapper) {
			const track = wrapper.querySelector('.process-steps-track');
			if (!track) return;

			const items = track.querySelectorAll('.process-step-item');
			const prevBtn = wrapper.querySelector('.slide-prev, .carousel-nav-btn.prev');
			const nextBtn = wrapper.querySelector('.slide-next, .carousel-nav-btn.next');
			const dots = wrapper.querySelectorAll('.carousel-dots .carousel-dot');

			if (items.length === 0) return;
			let currentSlide = 0;

			function goToSlide(index) {
				if (index < 0) index = items.length - 1;
				if (index >= items.length) index = 0;
				currentSlide = index;

				items.forEach(function (item, i) {
					item.classList.toggle('active', i === currentSlide);
				});

				dots.forEach(function (dot, i) {
					dot.classList.toggle('active', i === currentSlide);
				});
			}

			if (prevBtn) {
				prevBtn.addEventListener('click', function (e) {
					e.preventDefault();
					goToSlide(currentSlide - 1);
				});
			}

			if (nextBtn) {
				nextBtn.addEventListener('click', function (e) {
					e.preventDefault();
					goToSlide(currentSlide + 1);
				});
			}

			dots.forEach(function (dot) {
				dot.addEventListener('click', function (e) {
					e.preventDefault();
					const slideIdx = parseInt(this.getAttribute('data-slide'), 10);
					goToSlide(slideIdx);
				});
			});
		});
	})();

	// 3. Authority Metrics Automatic Slideshow (Scoped specifically to .authority-metrics-carousel)
	(function initAuthorityMetricsSlideshow() {
		const authTrack = document.getElementById('authorityMetricsTrack');
		if (!authTrack) return;

		const authCarousel = authTrack.closest('.authority-metrics-carousel') || authTrack.parentElement;
		const authItems = authTrack.querySelectorAll('.authority-metric-card');
		const authDots = authCarousel.querySelectorAll('#authDots .carousel-dot');

		if (authItems.length === 0) return;
		let currentAuthSlide = 0;
		let autoSlideInterval = null;

		function goToAuthSlide(index) {
			if (index < 0) index = authItems.length - 1;
			if (index >= authItems.length) index = 0;
			currentAuthSlide = index;

			authItems.forEach(function (item, i) {
				item.classList.toggle('active', i === currentAuthSlide);
			});

			authDots.forEach(function (dot, i) {
				dot.classList.toggle('active', i === currentAuthSlide);
			});
		}

		function startAutoSlide() {
			stopAutoSlide();
			if (authItems.length > 1) {
				autoSlideInterval = setInterval(function () {
					goToAuthSlide(currentAuthSlide + 1);
				}, 3500);
			}
		}

		function stopAutoSlide() {
			if (autoSlideInterval) {
				clearInterval(autoSlideInterval);
				autoSlideInterval = null;
			}
		}

		authDots.forEach(function (dot) {
			dot.addEventListener('click', function (e) {
				e.preventDefault();
				const slideIdx = parseInt(this.getAttribute('data-slide'), 10);
				goToAuthSlide(slideIdx);
				startAutoSlide();
			});
		});

		if (authCarousel) {
			authCarousel.addEventListener('mouseenter', stopAutoSlide);
			authCarousel.addEventListener('mouseleave', startAutoSlide);
		}

		// Iniciar rotación automática
		startAutoSlide();
	})();

	// 3.0 Home Hero Synchronized Showcase (Metrics + 3D Card Deck)
	(function initHeroSynchronizedShowcase() {
		const metricsCarousel = document.getElementById('homeMetricsCarousel');
		const metricsTrack = document.getElementById('homeMetricsTrack');
		const deckWrapper = document.getElementById('homeHeroDeck');
		const deckStack = document.getElementById('homeDeckStack');

		const metricSlides = metricsTrack ? Array.from(metricsTrack.querySelectorAll('.home-metric-slide')) : [];
		const deckCards = deckStack ? Array.from(deckStack.querySelectorAll('.home-deck-card')) : [];

		const totalItems = Math.max(metricSlides.length, deckCards.length);
		if (totalItems === 0) return;

		let currentHeroIndex = 0;
		let autoHeroInterval = null;

		function syncHeroState(activeIndex) {
			currentHeroIndex = (activeIndex % totalItems + totalItems) % totalItems;

			// Synchronize metrics slide
			if (metricSlides.length > 0) {
				metricSlides.forEach(function (slide, i) {
					slide.classList.remove('active');
					const isActive = (i === currentHeroIndex);
					slide.setAttribute('aria-selected', isActive ? 'true' : 'false');
					slide.setAttribute('tabindex', isActive ? '0' : '-1');
					if (isActive) {
						void slide.offsetWidth;
						slide.classList.add('active');
					}
				});
			}

			// Synchronize 3D deck cards
			if (deckCards.length > 0) {
				deckCards.forEach(function (card, i) {
					const offset = (i - currentHeroIndex + totalItems) % totalItems;
					card.classList.remove('is-active', 'is-next', 'is-prev', 'is-stacked');
					card.setAttribute('aria-hidden', offset === 0 ? 'false' : 'true');

					if (offset === 0) {
						void card.offsetWidth;
						card.classList.add('is-active');
					} else if (offset === 1) {
						card.classList.add('is-next');
					} else if (offset === 2) {
						card.classList.add('is-prev');
					} else {
						card.classList.add('is-stacked');
					}
				});
			}
		}

		function startAutoHeroRotation() {
			stopAutoHeroRotation();
			if (totalItems > 1) {
				autoHeroInterval = setInterval(function () {
					syncHeroState(currentHeroIndex + 1);
				}, 4500);
			}
		}

		function stopAutoHeroRotation() {
			if (autoHeroInterval) {
				clearInterval(autoHeroInterval);
				autoHeroInterval = null;
			}
		}

		// Click & Keyboard on any card in the deck
		deckCards.forEach(function (card, i) {
			function activate() {
				if (i !== currentHeroIndex) {
					syncHeroState(i);
					startAutoHeroRotation();
				}
			}
			card.addEventListener('click', activate);
			card.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					activate();
				}
			});
		});

		// Click & Keyboard on any metric slide
		metricSlides.forEach(function (slide, i) {
			function activate() {
				if (i !== currentHeroIndex) {
					syncHeroState(i);
					startAutoHeroRotation();
				}
			}
			slide.addEventListener('click', activate);
			slide.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					activate();
				}
			});
		});

		// Hover and Focus pause on either side (WCAG 2.2.2 Pause, Stop, Hide)
		const interactContainers = [metricsCarousel, deckWrapper].filter(Boolean);
		interactContainers.forEach(function (el) {
			el.addEventListener('mouseenter', stopAutoHeroRotation);
			el.addEventListener('mouseleave', startAutoHeroRotation);
			el.addEventListener('focusin', stopAutoHeroRotation);
			el.addEventListener('focusout', startAutoHeroRotation);
		});

		// Touch swipe support on both containers
		interactContainers.forEach(function (el) {
			let touchStartX = 0;
			let touchEndX = 0;

			el.addEventListener('touchstart', function (e) {
				touchStartX = e.changedTouches[0].screenX;
				stopAutoHeroRotation();
			}, { passive: true });

			el.addEventListener('touchend', function (e) {
				touchEndX = e.changedTouches[0].screenX;
				const diffX = touchEndX - touchStartX;
				if (Math.abs(diffX) > 35) {
					if (diffX < 0) {
						syncHeroState(currentHeroIndex + 1);
					} else {
						syncHeroState(currentHeroIndex - 1);
					}
				}
				startAutoHeroRotation();
			}, { passive: true });
		});

		// Initial start in sync
		syncHeroState(0);
		startAutoHeroRotation();
	})();

	// 3.1 Home Pillars Interactive Slideshow
	(function initHomePillarsSlideshow() {
		const carousel = document.getElementById('homePillarsCarousel');
		const track = document.getElementById('homePillarsTrack');
		if (!carousel || !track) return;

		const slides = Array.from(track.querySelectorAll('.home-pillar-slide'));
		const dots = Array.from(carousel.querySelectorAll('.carousel-dots .carousel-dot'));
		const prevBtn = document.getElementById('pillarsPrevBtn');
		const nextBtn = document.getElementById('pillarsNextBtn');

		if (slides.length === 0) return;
		let currentPillarSlide = 0;
		let autoPillarsInterval = null;

		function goToPillarSlide(index) {
			if (index < 0) index = slides.length - 1;
			if (index >= slides.length) index = 0;
			currentPillarSlide = index;

			slides.forEach(function (slide, i) {
				const isActive = i === currentPillarSlide;
				slide.classList.toggle('active', isActive);
				slide.setAttribute('aria-hidden', !isActive);
			});

			dots.forEach(function (dot, i) {
				const isActive = i === currentPillarSlide;
				dot.classList.toggle('active', isActive);
				dot.setAttribute('aria-current', isActive ? 'true' : 'false');
			});
		}

		function startAutoRotation() {
			stopAutoRotation();
			if (slides.length > 1) {
				autoPillarsInterval = setInterval(function () {
					goToPillarSlide(currentPillarSlide + 1);
				}, 5000);
			}
		}

		function stopAutoRotation() {
			if (autoPillarsInterval) {
				clearInterval(autoPillarsInterval);
				autoPillarsInterval = null;
			}
		}

		if (prevBtn) {
			prevBtn.addEventListener('click', function (e) {
				e.preventDefault();
				goToPillarSlide(currentPillarSlide - 1);
				startAutoRotation();
			});
		}

		if (nextBtn) {
			nextBtn.addEventListener('click', function (e) {
				e.preventDefault();
				goToPillarSlide(currentPillarSlide + 1);
				startAutoRotation();
			});
		}

		dots.forEach(function (dot) {
			dot.addEventListener('click', function (e) {
				e.preventDefault();
				const idx = parseInt(this.getAttribute('data-slide'), 10);
				goToPillarSlide(idx);
				startAutoRotation();
			});
		});

		// Pause on hover
		carousel.addEventListener('mouseenter', stopAutoRotation);
		carousel.addEventListener('mouseleave', startAutoRotation);

		// Touch swipe support
		let touchStartX = 0;
		carousel.addEventListener('touchstart', function (e) {
			touchStartX = e.changedTouches[0].screenX;
			stopAutoRotation();
		}, { passive: true });

		carousel.addEventListener('touchend', function (e) {
			const touchEndX = e.changedTouches[0].screenX;
			const diffX = touchEndX - touchStartX;
			if (Math.abs(diffX) > 35) {
				if (diffX < 0) {
					goToPillarSlide(currentPillarSlide + 1);
				} else {
					goToPillarSlide(currentPillarSlide - 1);
				}
			}
			startAutoRotation();
		}, { passive: true });

		// Initial start
		goToPillarSlide(0);
		startAutoRotation();
	})();

	// 3.2 Philosophy & Principles Slideshow (.philosophy-carousel-wrapper - Manual navigation)
	(function initPhilosophySlideshow() {
		const wrappers = document.querySelectorAll('.philosophy-carousel-wrapper');
		if (!wrappers.length) return;

		wrappers.forEach(function (wrapper) {
			const track = wrapper.querySelector('.philosophy-slideshow-track');
			if (!track) return;

			const items = track.querySelectorAll('.philosophy-slide-item');
			const prevBtn = wrapper.querySelector('.slide-prev, .carousel-nav-btn.prev');
			const nextBtn = wrapper.querySelector('.slide-next, .carousel-nav-btn.next');
			const dots = wrapper.querySelectorAll('.carousel-dots .carousel-dot');

			if (items.length === 0) return;
			let currentSlide = 0;

			function goToSlide(index) {
				if (index < 0) index = items.length - 1;
				if (index >= items.length) index = 0;
				currentSlide = index;

				items.forEach(function (item, i) {
					const isActive = i === currentSlide;
					item.classList.toggle('active', isActive);
					item.setAttribute('aria-hidden', !isActive);
				});

				dots.forEach(function (dot, i) {
					dot.classList.toggle('active', i === currentSlide);
					dot.setAttribute('aria-current', i === currentSlide ? 'true' : 'false');
				});
			}

			if (prevBtn) {
				prevBtn.addEventListener('click', function (e) {
					e.preventDefault();
					goToSlide(currentSlide - 1);
				});
			}

			if (nextBtn) {
				nextBtn.addEventListener('click', function (e) {
					e.preventDefault();
					goToSlide(currentSlide + 1);
				});
			}

			dots.forEach(function (dot) {
				dot.addEventListener('click', function (e) {
					e.preventDefault();
					const slideIdx = parseInt(this.getAttribute('data-slide'), 10);
					goToSlide(slideIdx);
				});
			});

			// Touch swipe gestures
			let touchStartX = 0;
			let touchEndX = 0;

			wrapper.addEventListener('touchstart', function (e) {
				touchStartX = e.changedTouches[0].screenX;
			}, { passive: true });

			wrapper.addEventListener('touchend', function (e) {
				touchEndX = e.changedTouches[0].screenX;
				const diffX = touchEndX - touchStartX;
				if (Math.abs(diffX) > 40) {
					if (diffX < 0) {
						goToSlide(currentSlide + 1);
					} else {
						goToSlide(currentSlide - 1);
					}
				}
			}, { passive: true });

			// Keyboard arrow navigation
			wrapper.addEventListener('keydown', function (e) {
				if (e.key === 'ArrowLeft') {
					e.preventDefault();
					goToSlide(currentSlide - 1);
				} else if (e.key === 'ArrowRight') {
					e.preventDefault();
					goToSlide(currentSlide + 1);
				}
			});

			// Initialize
			goToSlide(0);
		});
	})();

	// 4. Smooth Animated Exclusive Accordion for <details>
	(function initFaqAccordion() {
		const faqDetails = document.querySelectorAll('.services-faq-section .faq-item');

		faqDetails.forEach(function (detail) {
			const summary = detail.querySelector('.faq-question');
			const content = detail.querySelector('.faq-answer-wrapper');
			if (!summary || !content) return;

			let currentAnimation = null;
			let isClosing = false;
			let isExpanding = false;

			function shrink(duration) {
				isClosing = true;
				const startHeight = detail.offsetHeight;
				const endHeight = summary.offsetHeight;

				if (currentAnimation) currentAnimation.cancel();

				currentAnimation = detail.animate(
					{ height: [startHeight + 'px', endHeight + 'px'] },
					{ duration: duration || 320, easing: 'cubic-bezier(0.4, 0, 0.2, 1)' }
				);

				currentAnimation.onfinish = function () {
					detail.removeAttribute('open');
					detail.style.height = '';
					isClosing = false;
					currentAnimation = null;
				};
				currentAnimation.oncancel = function () {
					isClosing = false;
					currentAnimation = null;
				};
			}

			function expand(duration) {
				isExpanding = true;
				const startHeight = detail.offsetHeight;
				const endHeight = summary.offsetHeight + content.offsetHeight;

				if (currentAnimation) currentAnimation.cancel();

				currentAnimation = detail.animate(
					{ height: [startHeight + 'px', endHeight + 'px'] },
					{ duration: duration || 360, easing: 'cubic-bezier(0.4, 0, 0.2, 1)' }
				);

				currentAnimation.onfinish = function () {
					detail.style.height = '';
					isExpanding = false;
					currentAnimation = null;
				};
				currentAnimation.oncancel = function () {
					isExpanding = false;
					currentAnimation = null;
				};
			}

			function open() {
				detail.style.height = detail.offsetHeight + 'px';
				detail.setAttribute('open', '');
				window.requestAnimationFrame(function () {
					expand(360);
				});
			}

			// Expose shrink method on the individual element instance
			detail._faqShrink = shrink;

			summary.addEventListener('click', function (e) {
				e.preventDefault();
				detail.style.overflow = 'hidden';

				if (isClosing || !detail.open) {
					// Smoothly shrink any other open sibling using its own instance method
					faqDetails.forEach(function (other) {
						if (other !== detail && other.open && typeof other._faqShrink === 'function') {
							other.style.overflow = 'hidden';
							other._faqShrink(300);
						}
					});
					open();
				} else if (isExpanding || detail.open) {
					shrink(320);
				}
			});
		});
	})();

	// 5. Scroll & Entry Reveal Animations (IntersectionObserver)
	(function initScrollReveals() {
		// Respect user's motion preferences
		const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		if (prefersReducedMotion) {
			document.documentElement.classList.add('no-reveals');
			return;
		}

		// Activate JS-driven reveal class on root
		document.documentElement.classList.add('js-reveal-ready');

		// Handle staggered delays automatically for containers with [data-reveal-stagger]
		const staggerContainers = document.querySelectorAll('[data-reveal-stagger]');
		staggerContainers.forEach(function (container) {
			const children = container.querySelectorAll('[data-reveal], :scope > *');
			children.forEach(function (child, idx) {
				if (!child.hasAttribute('data-reveal')) {
					child.setAttribute('data-reveal', 'fade-up');
				}
				if (!child.style.getPropertyValue('--delay')) {
					child.style.setProperty('--delay', ((idx + 1) * 110) + 'ms');
				}
			});
		});

		const revealElements = document.querySelectorAll('[data-reveal]');
		if (revealElements.length === 0) return;

		if (!('IntersectionObserver' in window)) {
			// Fallback for browsers without IntersectionObserver
			revealElements.forEach(function (el) {
				el.classList.add('is-revealed');
			});
			return;
		}

		const observerOptions = {
			root: null,
			rootMargin: '0px 0px -40px 0px',
			threshold: 0.1
		};

		const revealObserver = new IntersectionObserver(function (entries, observer) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-revealed');
					// Unobserve once revealed for peak performance
					observer.unobserve(entry.target);
				}
			});
		}, observerOptions);

		revealElements.forEach(function (el) {
			revealObserver.observe(el);
		});

		// Immediate check for above-the-fold hero elements
		const heroReveals = document.querySelectorAll('.services-hero-block [data-reveal], .about-hero-block [data-reveal], .home-hero-block [data-reveal]');
		if (heroReveals.length > 0) {
			window.requestAnimationFrame(function () {
				heroReveals.forEach(function (el) {
					const rect = el.getBoundingClientRect();
					if (rect.top < window.innerHeight) {
						el.classList.add('is-revealed');
					}
				});
			});
		}
	})();

	// 6. Horizontal Scroll Mask & Drag-to-Scroll for Tags (.post--tags, .skill-tags-cloud)
	(function initTagsScroll() {
		function updateTagsScrollMask(el) {
			if (!el) return;
			const scrollLeft = el.scrollLeft;
			const scrollWidth = el.scrollWidth;
			const clientWidth = el.clientWidth;
			const maxScroll = scrollWidth - clientWidth;

			if (maxScroll <= 2) {
				if (el.dataset.scrollState !== 'none') el.dataset.scrollState = 'none';
				return;
			}

			let state = 'middle';
			if (scrollLeft <= 2) {
				state = 'start';
			} else if (scrollLeft >= maxScroll - 2) {
				state = 'end';
			}

			if (el.dataset.scrollState !== state) {
				el.dataset.scrollState = state;
			}
		}

		const tagContainers = document.querySelectorAll('.post--tags, .skill-tags-cloud');
		if (tagContainers.length === 0) return;

		tagContainers.forEach(updateTagsScrollMask);

		document.addEventListener('scroll', function (e) {
			if (e.target && e.target.classList && (e.target.classList.contains('post--tags') || e.target.classList.contains('skill-tags-cloud'))) {
				updateTagsScrollMask(e.target);
			}
		}, { capture: true, passive: true });

		window.addEventListener('resize', function () {
			document.querySelectorAll('.post--tags, .skill-tags-cloud').forEach(updateTagsScrollMask);
		}, { passive: true });

		// Drag-to-scroll
		let isDown = false;
		let startX = 0;
		let scrollLeft = 0;
		let activeEl = null;
		let hasDragged = false;

		document.addEventListener('mousedown', function (e) {
			const tagsEl = e.target.closest('.post--tags, .skill-tags-cloud');
			if (!tagsEl) return;

			isDown = true;
			hasDragged = false;
			activeEl = tagsEl;
			startX = e.pageX - activeEl.offsetLeft;
			scrollLeft = activeEl.scrollLeft;
		});

		document.addEventListener('mouseup', function () {
			if (isDown && activeEl) {
				activeEl.classList.remove('is-dragging');
				isDown = false;
				activeEl = null;
			}
		});

		document.addEventListener('mousemove', function (e) {
			if (!isDown || !activeEl) return;
			const x = e.pageX - activeEl.offsetLeft;
			const walk = (x - startX) * 1.5;
			if (Math.abs(walk) > 4) {
				hasDragged = true;
				activeEl.classList.add('is-dragging');
				e.preventDefault();
				activeEl.scrollLeft = scrollLeft - walk;
				updateTagsScrollMask(activeEl);
			}
		});

		document.addEventListener('click', function (e) {
			if (hasDragged && e.target.closest('.post--tags, .skill-tags-cloud')) {
				e.preventDefault();
				e.stopPropagation();
				hasDragged = false;
			}
		}, true);
	})();

	// 7. 3D Cascading Timeline Slideshow
	(function initTimeline3dSlideshow() {
		const showcase = document.querySelector('.timeline-3d-showcase');
		if (!showcase) return;

		const cards = showcase.querySelectorAll('.timeline-3d-card');
		const stepBtns = showcase.querySelectorAll('.timeline-step-btn');
		const progressBar = showcase.querySelector('.timeline-stepper-progress-bar');
		const prevBtn = showcase.querySelector('.timeline-prev-btn');
		const nextBtn = showcase.querySelector('.timeline-next-btn');
		const playToggle = showcase.querySelector('.timeline-play-toggle');
		const autoplayFill = showcase.querySelector('.timeline-autoplay-fill');
		const dropTriggers = showcase.querySelectorAll('.timeline-card-drop-trigger');

		if (!cards.length) return;

		let currentIndex = 0;
		const total = cards.length;
		let isAnimating = false;
		let isPaused = false;
		let isHovered = false;
		let autoTimer = null;
		let startTime = null;
		const SLIDE_DURATION = 5500; // 5.5s per slide

		function setCardPositions(targetIndex) {
			cards.forEach(function (card, i) {
				card.classList.remove('is-rising');
				if (i < targetIndex) {
					card.classList.remove('is-active', 'is-stacked');
					card.classList.add('is-fallen');
					card.style.setProperty('--stack-offset', '0');
				} else if (i === targetIndex) {
					card.classList.remove('is-fallen', 'is-stacked');
					card.classList.add('is-active');
					card.style.setProperty('--stack-offset', '0');
				} else {
					card.classList.remove('is-active', 'is-fallen');
					card.classList.add('is-stacked');
					card.style.setProperty('--stack-offset', String(i - targetIndex));
				}
			});

			stepBtns.forEach(function (btn, i) {
				const active = (i === targetIndex);
				btn.classList.toggle('is-active', active);
				btn.setAttribute('aria-selected', active ? 'true' : 'false');
			});

			if (progressBar && total > 1) {
				const pct = (targetIndex / (total - 1)) * 100;
				progressBar.style.height = pct + '%';
			}

			currentIndex = targetIndex;
		}

		// Initial stack setup
		setCardPositions(0);

		function updateCards(targetIndex) {
			if (isAnimating) return;
			isAnimating = true;

			setCardPositions(targetIndex);

			setTimeout(function () {
				isAnimating = false;
			}, 700);
		}

		function resetAllCardsToBeginning() {
			if (isAnimating) return;
			isAnimating = true;

			// Add .is-rising to trigger the reverse cascade gathering
			cards.forEach(function (card, i) {
				card.classList.add('is-rising');
				card.classList.remove('is-fallen');
				if (i === 0) {
					card.classList.add('is-active');
					card.classList.remove('is-stacked');
					card.style.setProperty('--stack-offset', '0');
				} else {
					card.classList.remove('is-active');
					card.classList.add('is-stacked');
					card.style.setProperty('--stack-offset', String(i));
				}
			});

			stepBtns.forEach(function (btn, i) {
				const active = (i === 0);
				btn.classList.toggle('is-active', active);
				btn.setAttribute('aria-selected', active ? 'true' : 'false');
			});

			if (progressBar) {
				progressBar.style.height = '0%';
			}

			currentIndex = 0;

			setTimeout(function () {
				cards.forEach(function (card) {
					card.classList.remove('is-rising');
				});
				isAnimating = false;
			}, 950);
		}

		function nextSlide() {
			if (isAnimating) return;
			if (currentIndex < total - 1) {
				updateCards(currentIndex + 1);
			} else {
				resetAllCardsToBeginning();
			}
			restartAutoplay();
		}

		function prevSlide() {
			if (isAnimating) return;
			if (currentIndex > 0) {
				updateCards(currentIndex - 1);
			} else {
				updateCards(total - 1);
			}
			restartAutoplay();
		}

		// Click events
		if (nextBtn) {
			nextBtn.addEventListener('click', function (e) {
				e.preventDefault();
				nextSlide();
			});
		}

		if (prevBtn) {
			prevBtn.addEventListener('click', function (e) {
				e.preventDefault();
				prevSlide();
			});
		}

		stepBtns.forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				const targetIdx = parseInt(this.getAttribute('data-timeline-index'), 10);
				if (!isNaN(targetIdx) && targetIdx !== currentIndex) {
					updateCards(targetIdx);
					restartAutoplay();
				}
			});
		});

		cards.forEach(function (card) {
			card.addEventListener('click', function (e) {
				if (card.classList.contains('is-fallen')) {
					e.preventDefault();
					const cardIdx = parseInt(this.getAttribute('data-card-index'), 10);
					if (!isNaN(cardIdx)) {
						updateCards(cardIdx);
						restartAutoplay();
					}
				}
			});
		});

		dropTriggers.forEach(function (trigger) {
			trigger.addEventListener('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
				nextSlide();
			});
		});

		// Autoplay animation frame loop
		let rafId = null;
		let elapsedBeforePause = 0;

		function startAutoplay() {
			if (isPaused) return;
			startTime = performance.now() - elapsedBeforePause;

			function tick(now) {
				if (isPaused || isHovered) {
					elapsedBeforePause = now - startTime;
					return;
				}

				const elapsed = now - startTime;
				const progress = Math.min(elapsed / SLIDE_DURATION, 1);

				if (autoplayFill) {
					autoplayFill.style.width = (progress * 100) + '%';
				}

				if (progress >= 1) {
					elapsedBeforePause = 0;
					nextSlide();
				} else {
					rafId = requestAnimationFrame(tick);
				}
			}

			cancelAnimationFrame(rafId);
			rafId = requestAnimationFrame(tick);
		}

		function restartAutoplay() {
			elapsedBeforePause = 0;
			if (autoplayFill) {
				autoplayFill.style.width = '0%';
			}
			if (!isPaused && !isHovered) {
				startAutoplay();
			}
		}

		function pauseAutoplay() {
			cancelAnimationFrame(rafId);
		}

		if (playToggle) {
			playToggle.addEventListener('click', function () {
				isPaused = !isPaused;
				playToggle.classList.toggle('is-paused', isPaused);
				if (isPaused) {
					pauseAutoplay();
				} else {
					startAutoplay();
				}
			});
		}

		// Pause on hover over 3D Stage
		showcase.addEventListener('mouseenter', function () {
			isHovered = true;
			pauseAutoplay();
		});

		showcase.addEventListener('mouseleave', function () {
			isHovered = false;
			if (!isPaused) {
				startAutoplay();
			}
		});

		// Start autoplay initially
		startAutoplay();
	})();
});

/* ═══════════════════════════════════════════════════════════
   testimonies.js — Infinite loop overlapping coverflow carousel
   ═══════════════════════════════════════════════════════════ */
document.addEventListener("DOMContentLoaded", function () {
	const section = document.getElementById("testimonies");
	if (!section) return;

	const avatars = Array.from(section.querySelectorAll(".avatar-item"));
	const cards = Array.from(section.querySelectorAll(".testimony-card"));
	const bulletsWrapper = section.querySelector(".testi-bullets");
	const prevBtn = section.querySelector(".slide-prev, .testi-prev, .carousel-nav-btn.prev");
	const nextBtn = section.querySelector(".slide-next, .testi-next, .carousel-nav-btn.next");

	if (avatars.length === 0 || cards.length === 0) return;

	const total = avatars.length;
	let current = Math.min(3, Math.floor(total / 2)); // Start centered
	let isAnimating = false;

	// Build or use existing bullets
	if (bulletsWrapper && bulletsWrapper.children.length === 0) {
		bulletsWrapper.innerHTML = "";
		for (let i = 0; i < total; i++) {
			const b = document.createElement("button");
			b.type = "button";
			b.classList.add("carousel-dot", "bullet");
			b.setAttribute("role", "tab");
			b.setAttribute("aria-label", `Ir al testimonio ${i + 1}`);
			if (i === current) b.classList.add("active");
			b.dataset.slide = i;
			b.dataset.index = i;
			bulletsWrapper.appendChild(b);
		}
	}
	const bullets = bulletsWrapper ? bulletsWrapper.querySelectorAll(".carousel-dot, .bullet") : [];

	function updateBullets(idx) {
		bullets.forEach((b, i) => {
			const isActive = i === idx;
			b.classList.toggle("active", isActive);
			b.setAttribute("aria-selected", isActive ? "true" : "false");
		});
	}

	function renderCarousel() {
		const width = window.innerWidth;
		const isMobile = width < 768;
		const isTablet = width >= 768 && width < 1024;
		const maxOffset = Math.floor(total / 2);

		// Render cards
		cards.forEach((card, i) => {
			let diff = i - current;
			if (diff < -maxOffset) diff += total;
			if (diff > maxOffset) diff -= total;

			const absDiff = Math.abs(diff);

			// Overlapping Card z-index
			card.style.zIndex = 10 - absDiff * 2;

			let translateX = 0;
			let scale = 1 - absDiff * 0.1;
			let opacity = 1;

			if (isMobile) {
				translateX = diff * 45; // compact stacking
				scale = 1 - absDiff * 0.15;
				opacity = absDiff > 1 ? 0 : 1; // only show immediate neighbors
			} else if (isTablet) {
				translateX = diff * 150;
				scale = 1 - absDiff * 0.12;
				opacity = absDiff > 2 ? 0 : 1;
			} else {
				translateX = diff * 220; // desktop full layout
			}

			card.style.transform = `translateX(${translateX}px) scale(${scale})`;
			card.style.opacity = opacity;
			const isActive = diff === 0;
			card.classList.toggle("active", isActive);
			card.classList.toggle("prev", diff < 0);
			card.classList.toggle("next", diff > 0);
			card.setAttribute("aria-hidden", isActive ? "false" : "true");
		});

		// Render avatars
		avatars.forEach((avatar, i) => {
			let diff = i - current;
			if (diff < -maxOffset) diff += total;
			if (diff > maxOffset) diff -= total;

			const absDiff = Math.abs(diff);
			avatar.style.zIndex = 10 - absDiff * 2;

			let translateX = 0;
			let scale = 1.3 - absDiff * 0.22;
			let opacity = 1 - absDiff * 0.22;

			if (isMobile) {
				translateX = diff * 42;
				scale = 1.15 - absDiff * 0.25;
				opacity = absDiff > 2 ? 0 : (1 - absDiff * 0.35);
			} else if (isTablet) {
				translateX = diff * 65;
			} else {
				translateX = diff * 85; // desktop spacing
			}

			avatar.style.transform = `translateX(${translateX}px) scale(${scale})`;
			avatar.style.opacity = opacity >= 0 ? opacity : 0;
			const isActive = diff === 0;
			avatar.classList.toggle("active", isActive);
			avatar.setAttribute("aria-selected", isActive ? "true" : "false");
		});

		updateBullets(current);
	}

	function goToSlide(targetIdx) {
		if (isAnimating) return;
		isAnimating = true;

		current = ((targetIdx % total) + total) % total;
		renderCarousel();

		setTimeout(() => {
			isAnimating = false;
		}, 450);
	}

	// Controls listeners
	if (prevBtn) {
		prevBtn.addEventListener("click", () => {
			goToSlide(current - 1);
			resetAutoplay();
		});
	}

	if (nextBtn) {
		nextBtn.addEventListener("click", () => {
			goToSlide(current + 1);
			resetAutoplay();
		});
	}

	if (bulletsWrapper) {
		bulletsWrapper.addEventListener("click", (e) => {
			const b = e.target.closest(".carousel-dot, .bullet");
			if (!b) return;
			const slideIdx = b.dataset.slide !== undefined ? parseInt(b.dataset.slide, 10) : parseInt(b.dataset.index, 10);
			if (!isNaN(slideIdx)) {
				goToSlide(slideIdx);
				resetAutoplay();
			}
		});
	}

	// Click on avatar to navigate to its slide
	avatars.forEach((avatar, i) => {
		avatar.addEventListener("click", () => {
			goToSlide(i);
			resetAutoplay();
		});
	});

	// Swipe Support
	let startX = 0;
	const container = section.querySelector(".testimonies-interactive-container");
	if (container) {
		container.addEventListener("touchstart", (e) => {
			startX = e.touches[0].clientX;
		}, { passive: true });

		container.addEventListener("touchend", (e) => {
			const deltaX = e.changedTouches[0].clientX - startX;
			if (Math.abs(deltaX) > 40) {
				goToSlide(deltaX < 0 ? current + 1 : current - 1);
				resetAutoplay();
			}
		});

		// Keyboard navigation when focused
		container.addEventListener("keydown", (e) => {
			if (e.key === "ArrowLeft") {
				e.preventDefault();
				goToSlide(current - 1);
				resetAutoplay();
			} else if (e.key === "ArrowRight") {
				e.preventDefault();
				goToSlide(current + 1);
				resetAutoplay();
			}
		});

		// Pause autoplay on mouse enter / hover
		let isHovered = false;
		container.addEventListener("mouseenter", () => { isHovered = true; });
		container.addEventListener("mouseleave", () => { isHovered = false; });

		// Autoplay when visible and not hovered
		let autoplayInterval = setInterval(() => {
			if (isHovered) return;
			const rect = section.getBoundingClientRect();
			const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
			if (isVisible) {
				goToSlide(current + 1);
			}
		}, 8000);

		function resetAutoplay() {
			clearInterval(autoplayInterval);
			autoplayInterval = setInterval(() => {
				if (isHovered) return;
				const rect = section.getBoundingClientRect();
				const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
				if (isVisible) {
					goToSlide(current + 1);
				}
			}, 8000);
		}
	}

	// First Render
	renderCarousel();

	// Responsive adaptation
	window.addEventListener("resize", renderCarousel);
});
