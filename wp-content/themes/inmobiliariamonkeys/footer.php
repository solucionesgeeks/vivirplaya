		<footer>
			<div class="principal">
				<div class="row">
					<div class="col-xs-12 col-sm-2 col-md-2">
						<h3>Empresa</h3>
						<a href="/">Inicio</a><br>
						<a href="servicios">Servicios</a><br>
						<a href="contacto">Contacto</a>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2">
						<h3>Propiedades</h3>
						<a href="#">Casas</a><br>
						<a href="#">Departamentos</a><br>
						<a href="#">Desarrollos</a><br>
						<a href="#">Locales</a><br>
						<a href="#">Oficinas</a><br>
						<a href="#">Terrenos</a><br>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2">
						<h3>Ciudades</h3>
						<a href="#">Cancún</a><br>
						<a href="#">Playa del Carmen</a><br>
						<a href="#">Tulum</a><br>
						<a href="#">Riviera Maya</a><br>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2">
						<h3>Siguenos</h3>
						<?php
							get_template_part( 'parts/social', 'none' );
						?>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<?php
							get_template_part( 'parts/sucursales', 'none' );
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 tcenter">
						Todos los Derechos Reservados &copy;, monkeysweb.com.mx 2005-2017
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/funciones.js"></script>
	</body>
</html>