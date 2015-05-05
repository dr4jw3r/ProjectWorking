<?php 
	appendJs(array('login_script', 'jquery.validate.min'));
?>

<nav>
	<a href="<?php echo PAGES_URL; ?>">
		<img id="nav_logo" src="<?php echo CORE_IMAGES_URL; ?>logo.60.png" alt="LangExchange logo">
	</a>
	<ul id="navigation">

		<!-- HOMEPAGE -->
		<li>
			<a href="<?php echo PAGES_URL; ?>"
				<?php if($active_page=="homepage"){ echo 'class="active"'; } ?>
			>
				<?php echo $lang['navigation']['homepage']; ?>
			</a>
		</li>

		<!-- TAKE A TOUR -->
		<li>
			<a href="<?php echo PAGES_URL . "tour.php"; ?>"
				<?php if($active_page=="tour"){echo 'class="active"'; } ?>
			>
				<?php echo $lang['navigation']['take_a_tour']; ?>
			</a>
		</li>
		
		<!-- REGISTER -->
		<li>
			<a href="<?php echo PAGES_URL . "registration.php"; ?>"
				<?php if($active_page=="registration"){ echo 'class="active"'; } ?>
			>
				<?php echo $lang['navigation']['register']; ?>
			</a>
		</li>

		<!-- CONTACT -->
		<li>
			<a href="<?php echo PAGES_URL . "contact.php"; ?>"
				<?php if($active_page=="contact"){ echo 'class="active"'; } ?>
			>
				<?php echo $lang['navigation']['contact']; ?>
			</a>
		</li>

		<!-- LOG IN -->
		<?php if(!isLoggedIn()){ ?>
			<li><a href="" id="nav_login_button"><?php echo $lang['navigation']['log_in']; ?></a></li>
		<?php 
			}else{
		?>
			<li><a href="<?php echo PROCESSES_URL . "logout.php"; ?>"><?php echo $lang['navigation']['log_out']; ?></a></li>
		<?php } ?>
	</ul>
	<div id="login_box"><?php require(PAGE_ELEMENTS_DIR . 'login_form.php'); ?></div>

</nav>