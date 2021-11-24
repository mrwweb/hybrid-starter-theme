/**
 * https://www.lottejackson.com/learning/a-reusable-javascript-toggle-pattern
 */
(function () {
	'use strict';

	const Toggler = function(rootElement) {

		var toggleButtons,
			toggleButton,
			toggleTarget,
			target,
			i;

		this.init = function() {

			toggleButton = rootElement.querySelector('.js-toggleButton');
			
			toggleTarget = toggleButton.getAttribute('aria-controls');
			target = document.getElementById(toggleTarget);
			target.classList.add('js-toggleTarget');
			
			toggleButton.setAttribute('aria-expanded', 'false');
			
			toggleButton.addEventListener('click', toggle, false);

		};

		var toggle = function(e) {

			if ( 'false' === toggleButton.getAttribute('aria-expanded') ) {

				toggleButton.setAttribute('aria-expanded', 'true');

			} else {

				toggleButton.setAttribute('aria-expanded', 'false');

			}

			e.preventDefault();
		}
		
	};

	var toggles = document.querySelectorAll('.js-toggleWrapper'),
		togglesTotal = toggles.length,
		i,
		toggle;

	for ( i = 0; i < togglesTotal; i = i + 1 ) {

		//A new instance of the Toggler object is stored in the toggle variable on each iteration of the loop
		toggle = new Toggler(toggles[i]);
		toggle.init();

	}
}());
