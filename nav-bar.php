<?php 

require_once 'model/clases/menunav.php';

$menunav = new MenuNav();
$menunavs = $menunav->getmenuxresp(($_SESSION['idperfil_anat']));
?>


<div class="sidebar  menu" id="sidebar">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<button class="btn btn-small btn-success">
				<i class="icon-signal"></i>
			</button>

			<button class="btn btn-small btn-info">
				<i class="icon-pencil"></i>
			</button>

			<button class="btn btn-small btn-warning">
				<i class="icon-group"></i>
			</button>

			<button class="btn btn-small btn-danger">
				<i class="icon-cogs"></i>
			</button>
		</div>

		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>

			<span class="btn btn-info"></span>

			<span class="btn btn-warning"></span>

			<span class="btn btn-danger"></span>
		</div>
	</div><!--#sidebar-shortcuts-->

	<ul class="nav nav-list " data-position="right" data-intro="Menu Principal" data-step="2">
		<li>

			<a href="index.php" class="dropdown-toggle" >
				<i class="icon-home"></i>
				<span class="menu-text"> Inicio </span>
				
			</a>

		</li>

		<?php foreach ($menunavs as $menunav): ?>

		<?php if (($menunav->id_padre)== null) : ?>
		<li>
			<a href="#" class="dropdown-toggle" style="<?php echo $menunav->color; ?>">
				<i class="icon- <?php echo $menunav->icono; ?>"></i>
				<span class="menu-text"> <?php echo $menunav->menu_descr; ?> </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu" style="<?php echo $menunav->color; ?>">
				<?php foreach ($menunavs as $menunav1): ?>

				<?php if (($menunav1->id_padre) == ($menunav->idmenu_anat )): ?>

				<li > <a href="<?php echo $menunav1->link; ?>"><i class="icon-double-angle-right"></i><?php echo $menunav1->menu_descr; ?></a></li>

				<?php endif ?>

				<?php endforeach ?>
			</ul>
		</li>
		<?php else: ?>
		<?php endif ?>
		<?php endforeach ?>

</ul>

<div class="sidebar-collapse" id="sidebar-collapse">
	<i class="icon-exchange"></i>
</div>

</div>

