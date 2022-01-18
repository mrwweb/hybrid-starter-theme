"use strict";

/**
 * https://www.lottejackson.com/learning/a-reusable-javascript-toggle-pattern
 *
 * Todo:
 * - If there is an input in the toggled body, move focus to it immediately
 */
(function () {
	'use strict'; //Cutting the mustard. If the following actions are not supported, then return and do nothing

	if (!document.querySelectorAll || !window.addEventListener) {
		return;
	} //Create the toggler object


	var Toggler = function Toggler(rootElement) {
		//Set a variable and store the selector for the toggle action
		var toggleButtonSelector = '.js-toggleButton'; //A variable to store all toggle links

		var toggleButtons; //A variable to store a single toggle link

		var toggleButton; //A variable to store the href attribute of the toggle link

		var toggleTarget; //A variable to store the content associagted to the link

		var target; //A counter to use in for loops

		var i; //Initialisation

		this.init = function () {
			//Get the toggle link
			toggleButton = rootElement.querySelector(toggleButtonSelector); //Get the href attribute of the toggle action link

			toggleTarget = toggleButton.getAttribute('aria-controls'); //Get the content with an id matching the href

			target = document.getElementById(toggleTarget); //Add the toggle class to that content

			toggleButton.setAttribute('aria-expanded', 'false'); //Set aria-hidden attribute to true

			target.classList.add('js-toggleTarget');

			target.setAttribute('aria-hidden', 'true'); //Add a click event listener to the toggle link

			toggleButton.addEventListener('click', toggle, false);
		}; //Toggle function


		var toggle = function toggle(ev) {
			//if the toggle button is aria-expanded = false
			if ('false' === toggleButton.getAttribute('aria-expanded')) {
				toggleButton.setAttribute('aria-expanded', 'true'); //Change the aria-hidden attribute value to false

				target.setAttribute('aria-hidden', 'false'); //Or if the toggle link does not contain the closed class
			} else {
				toggleButton.setAttribute('aria-expanded', 'false'); //Change the aria-hidden attribute value to true

				target.setAttribute('aria-hidden', 'true');
			} //Prevent the default link behaviour when clicked.


			ev.preventDefault();
		};
	}; //Find all of the instances of the toggler pattern on the page.


	var toggles = document.querySelectorAll('.js-toggleWrapper'); // Store the total number of toggler patterns

	var togglesTotal = toggles.length; //Counter for the for loop

	var i; //For storing one toggle

	var toggle; //Loop through each togger pattern on the page

	for (i = 0; i < togglesTotal; i = i + 1) {
		//A new instance of the Toggler object is stored in the toggle variable on each iteration of the loop
		toggle = new Toggler(toggles[i]); //Initialise each toggle

		toggle.init();
	}
})();
