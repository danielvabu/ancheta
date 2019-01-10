
<nav class="navbar navbar-expand-md navbar-light bg-faded" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#jcnavbar" aria-controls="jcnavbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
	<a class="navbar-brand" href="<?php echo PATO; ?>"><i class="fas fa-home"></i></a>
	<div class="collapse navbar-collapse" id="jcnavbar">
		<ul class="navbar-nav mr-auto">

			<li class="nav-item<?php if(MODULO=="ciudades")echo ' active'; ?>"><a class="nav-link" href="<?php echo PATO; ?>ciudades/" itemprop="URL"> <?php echo __("Ciudades"); ?></a></li>


			<li class="nav-item<?php if(MODULO=="departamentos")echo ' active'; ?>"><a class="nav-link" href="<?php echo PATO; ?>departamentos/" itemprop="URL"> <?php echo __("Departamentos"); ?></a></li>


			<li class="nav-item<?php if(MODULO=="usuarios")echo ' active'; ?>"><a class="nav-link" href="<?php echo PATO; ?>usuarios/" itemprop="URL"> <?php echo __("Usuarios"); ?></a></li>


			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0 hidden">
			<input class="form-control mr-sm-2" type="text" placeholder="Search" name="q" />
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> buscar</button>
		</form>
	</div>
</nav>
