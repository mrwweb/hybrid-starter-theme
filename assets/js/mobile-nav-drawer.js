const mobileMenu = document.getElementById('menu-drawer');
const menuToggle = document.getElementById('main-menu-open');
const menuClose = document.getElementById('main-menu-close');

/* Support for dialog when command/commandfor attributes aren't supported */
const test = document.createElement('button');
if (test.commandForElement !== null) {
	menuToggle.addEventListener('click', function () {
		mobileMenu.showModal();
	});
	menuClose.addEventListener('click', function () {
		mobileMenu.close();
	});
}

/* Ensure newly opened mobile submenu is fully visible in the viewport */
mobileMenu.addEventListener('click', function (e) {
	const el = e.target;
	if (el.hasAttribute('aria-expanded')) {
		const boundingRect = el.getBoundingClientRect();
		/* Comparing to value greater than 0 as low values seem to cause problems */
		if (boundingRect.top < 20) {
			el.scrollIntoView();
		}
	}
});
