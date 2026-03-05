import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
	const revealNodes = document.querySelectorAll('[data-reveal]');

	if (revealNodes.length > 0) {
		const revealObserver = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting) {
						return;
					}

					entry.target.classList.add('is-visible');
					revealObserver.unobserve(entry.target);
				});
			},
			{
				threshold: 0.15,
			},
		);

		revealNodes.forEach((node) => {
			revealObserver.observe(node);
		});
	}

	const mobileToggle = document.getElementById('mobile-menu-toggle');
	const mobileNav = document.getElementById('mobile-nav');

	if (mobileToggle && mobileNav) {
		mobileToggle.addEventListener('click', () => {
			const isHidden = mobileNav.classList.toggle('hidden');
			const isOpen = !isHidden;
			mobileToggle.setAttribute('aria-expanded', String(isOpen));
		});
	}
});
