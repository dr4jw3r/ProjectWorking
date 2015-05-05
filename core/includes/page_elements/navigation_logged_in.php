<?php appendJs(array('navigation_loggedin')); ?>

<nav>
	<a href="<?php echo PAGES_URL; ?>">
		<img id="nav_logo" src="<?php echo CORE_IMAGES_URL; ?>logo.60.png" alt="LangExchange logo">
	</a>
	<ul id="navigation">
			<!-- HOMEPAGE -->
			<li>
				<a href="<?php echo PAGES_URL . 'index.php'; ?>"
					<?php if($active_page=="homepage"){ echo 'class="active"'; } ?>
				>
					<?php echo $lang['navigation']['homepage']; ?>
				</a>
			</li>

			<!-- HELP -->
			<li>
				<a href="<?php echo PAGES_URL . "help.php"; ?>"
					<?php if($active_page=="help"){ echo 'class="active"'; } ?>
				>
					<?php echo $lang['navigation']['help']; ?>
				</a>
			</li>


			<!-- MENU -->
			<li id="navigation_menu">
				<ul id="navigation_drop">
					<li>
						<a href="<?php echo PAGES_URL . 'partnersearch.php'; ?>"
							<?php if($active_page=="partnersearch"){ echo 'class="active_small"'; } ?>
						>
							<?php echo $lang['navigation']['partner_search']; ?></a>
					</li>
					<li>
						<a href="<?php echo PAGES_URL . 'lessons.php'; ?>"
							<?php if($active_page=="lessons"){ echo 'class="active_small"'; } ?>
						>
							<?php echo $lang['navigation']['lessons']; ?></a>
					</li>
					<li>
						<a href="<?php echo PAGES_URL . 'messages.php'; ?>"
							<?php if($active_page=="messages"){ echo 'class="active_small"'; } ?>
						>
							<?php echo $lang['navigation']['messages']; ?></a>
					</li>
				</ul>
			</li>

			<!-- PROFILE -->
			<li id="profile_box">
				<div id="avatar"></div>
				<div id="profile_box_top">
					<a href="<?php echo PAGES_URL . 'settings.php'; ?>"
						<?php if($active_page=="settings"){ echo 'class="active"'; } ?>
					>
						<?php echo $lang['navigation']['settings']; ?>
					</a>
				</div>

				<div id="profile_box_bottom">
					<a href="<?php echo PROCESSES_URL . 'logout.php'; ?>">Sign Out</a>
				</div>
			</li>
	</ul>
</nav>