function social( donde ) {
	window.open( donde, 'Compartir', 'toolbar=0, status=0, width=650, height=450' );
}
$( document ).on( 'click', '.linkmenu', function( event ) {
	event.preventDefault();
	var target = '#' + this.getAttribute( 'data-target' );
	$( 'html, body' ).animate( {
		scrollTop: ( $( target ).offset().top ) - 50
	}, 1000 );
} );
$( window ).scroll( function () {
	if ( $( this ).scrollTop() >= 119 ) {
		if ( 'none' === $( '.fixheader' ).css( 'display' ) && 'none !important' !== $( '.fixheader' ).css( 'display' ) ) {
			$( '.fixheader' ).slideToggle();
		}
	} else {
		if ( 'block' === $( '.fixheader' ).css( 'display' ) ) {
			$( '.fixheader' ).hide();
		}
	}
} );
function valEmail( email ) {
	var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if ( !expr.test( email ) ) {
		return false;
	}
	else {
		return true;
	}
}
function vacia( cual ) {
	$( '#' + cual + ' input' ).each( function() {
		$( this ).val( '' );
	} );
	$( '#' + cual + ' select' ).each( function() {
		$( this ).val( '0' );
	} );
	$( '#' + cual + ' textarea' ).each( function() {
		$( this ).val( '' );
	} );
	$( '#' + cual + ' .id' ).val( '0' );
	desmarca( cual );
}
function marca( cual ) {
	desmarca( cual );
	$( '#' + cual + ' .obligatorio' ).each( function() {
		if ( '' === $( this ).val() || '0' === $( this ).val() ) {
			$( this ).addClass( 'vacio' );
		}
	} );
}
function desmarca( cual ) {
	$( '#' + cual + ' .vacio' ).each( function() {
		$( this ).removeClass( 'vacio' );
	} );
}
function enviar( contenedor, correo ) {
	var vacio = 0;
	$( '#' + contenedor + ' .obligatorio' ).each( function() {
		if ( '' === $( this ).val() ) {
			vacio++;
		}
	} );
	if ( 0 === vacio ) {
		var mail = 0;
		if ( $( '#' + contenedor + ' #email' ).length ) {
			var email = $( '#' + contenedor + ' #email' ).val();
			if ( !valEmail( email ) ) {
				mail = 1;
			}
			if ( 0 === mail ) {
				var captcha = 0;
				if ( null !== localStorage.getItem( 'captcha' ) && 'null' !== localStorage.getItem( 'captcha' ) ) {
					if ( localStorage.getItem( 'captcha' ) !== $( '#' + contenedor + ' .inputcaptcha' ).val() ) {
						captcha++;
					}
				}
				if ( 0 === captcha ) {
					var datos = $( '#' + contenedor ).serialize();
					console.log( datos );
					if ( '' !== datos ) {
						$.ajax( {
							type: 'GET',
							url: 'querys/enviar.php',
							data: datos + '&contactocorreo=' + correo,
							success:function( response ) {
								if ( response === 'Error' ) {
									$.notify( { message: 'Hubo un problema de conexión' }, { type: 'danger' } );
								} else {
									$.notify( { message: 'Enviado con exito, en Breve contestaremos' }, { type: 'success' } );
									vacia( contenedor );
								}
							}
						} );
					}
				} else {
					$.notify( { message: 'El valor Captcha no coincide' }, { type: 'danger' } );
					$( '#' + contenedor + ' .inputcaptcha' ).focus();
				}
			} else {
				$.notify( { message: 'Ingresa un mail valido' }, { type: 'danger' } );
				$( '#' + contenedor + ' #email' ).val( '' );
				$( '#' + contenedor + ' #email' ).focus();
				desmarca( contenedor );
				marca( contenedor );
			}
		}
	} else {
		marca( contenedor );
		$.notify( { message: 'Favor de llenar la información solicitada' }, { type: 'danger' } );
	}
}