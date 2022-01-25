<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home" style="font-size:1.2em;"></i>
					<span>Inicio</span>

				</a>

			</li>
			
			<li>

				<a href="carpetas">

					<i class="icon-tractor" style="font-size:1.2em;padding-right:5px;"></i>
					<span>Carpetas </span>

				</a>

			</li>

			<li>

				<a href="Perfiles">

					<i class="icon-jeringa" style="font-size:1.8em;"></i>
					<span>Perfiles</span>

				</a>

			</li>

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';

		}

		?>

		</ul>

	 </section>

</aside>
