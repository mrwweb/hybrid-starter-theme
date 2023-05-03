/**
 * https://www.lottejackson.com/learning/a-reusable-javascript-toggle-pattern
 */
'use strict';
(function () {
	const Toggler = function (toggleButton) {
		let toggleTargetId, toggleTarget;

		this.init = function () {
			toggleTargetId = toggleButton.getAttribute('aria-controls');
			toggleTarget = document.getElementById(toggleTargetId);
			toggleTarget.classList.add('wta-js-toggleTarget');
			toggleButton.setAttribute('aria-expanded', 'false');
			toggleButton.addEventListener('click', toggle, false);
			toggleButton.addEventListener('keyup', close, false);
			toggleTarget.addEventListener('keyup', close, false);
		};

		const toggle = function (e) {
			if ('false' === toggleButton.getAttribute('aria-expanded')) {
				toggleButton.setAttribute('aria-expanded', 'true');
			} else {
				toggleButton.setAttribute('aria-expanded', 'false');
			}
			e.preventDefault();
		};

		const close = function (e) {
			if (
				27 === e.keyCode &&
				'true' === toggleButton.getAttribute('aria-expanded')
			) {
				toggleButton.setAttribute('aria-expanded', 'false');
				toggleButton.focus();
			}
			e.preventDefault();
		}
	};

	document.addEventListener('DOMContentLoaded', function() {
		const toggles = document.querySelectorAll('.wta-js-toggleButton'),
			togglesTotal = toggles.length;
		let toggle;

		for (let i = 0; i < togglesTotal; i = i + 1) {
			//A new instance of the Toggler object is stored in the toggle variable on each iteration of the loop
			toggle = new Toggler(toggles[i]);
			toggle.init();
		}
	});
})();
