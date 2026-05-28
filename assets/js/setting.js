/**
 * Main Theme JavaScript
 * Initialize Embla Carousel and mobile menu toggle.
 */

( function ( $ ) {
	'use strict';

	/* -----------------------------------------------------------------------
	   Mobile Menu Toggle
	----------------------------------------------------------------------- */
	const menuToggle = document.querySelector( '[aria-label="Toggle menu"]' );
	const header = document.querySelector( 'header' );

	if ( menuToggle && header ) {
		menuToggle.addEventListener( 'click', () => {
			header.classList.toggle( 'menu-open' );
		} );
	}

	/* -----------------------------------------------------------------------
	   Embla Carousel — initialise any .embla elements
	----------------------------------------------------------------------- */
	if ( typeof EmblaCarousel !== 'undefined' ) {
		document.querySelectorAll( '.embla' ).forEach( ( node ) => {
			const viewport = node.querySelector( '.embla__viewport' );
			if ( ! viewport ) return;

			EmblaCarousel( viewport, {
				loop: false,
				align: 'start',
			} );
		} );
	}

} )( jQuery );
