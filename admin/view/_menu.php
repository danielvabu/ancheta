
<nav class="navbar navbar-expand-md navbar-light bg-faded" itemscope itemtype="http://schema.org/SiteNavigationElement">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#jcnavbar" aria-controls="jcnavbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <a class="navbar-brand" href="<?php echo PATO; ?>"><i class="fas fa-home"></i></a>
    <div class="collapse navbar-collapse" id="jcnavbar">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item<?php if (MODULO == "admins") echo ' active'; ?>"><a class="nav-link" href="<?php echo PATO; ?>admins/" itemprop="URL"> <?php echo __("Administradores"); ?></a></li>


            <li class="nav-item<?php if (MODULO == "productos") echo ' active'; ?>"><a class="nav-link" href="<?php echo PATO; ?>productos/" itemprop="URL"> <?php echo __("Productos"); ?></a></li>

            <li class="nav-item<?php if (MODULO == "presentaciones") echo ' active'; ?>"><a class="nav-link" href="<?php echo PATO; ?>presentaciones/" itemprop="URL"> <?php echo __("Presentaciónes"); ?></a></li>





            <li class="nav-item<?php if (MODULO == "sessiones") echo ' active'; ?>"><a class="nav-link" href="<?php echo PATO; ?>sessiones/" itemprop="URL"> <?php echo __("Pedidos"); ?></a></li>





        </ul>
        <form class="form-inline my-2 my-lg-0 hidden">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" name="q" />
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> buscar</button>
        </form>
    </div>
</nav>
