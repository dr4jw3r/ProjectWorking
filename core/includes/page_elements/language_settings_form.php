<h2 id="langsettings"><?php echo $lang['settings']['language_details']; ?></h2>
<div class="flex">
	<div class="lopts_label"><?php echo $lang['settings']['lang_spoken']; ?></div>
	<div class="lopts_content">
		<div class="lopts_left table_heading"><?php echo $lang['settings']['language']; ?></div>
		<div class="lopts_center table_heading table_heading_center"><?php echo $lang['settings']['proficiency']; ?></div>
		<div class="lopts_right table_heading"><?php echo $lang['settings']['action']; ?></div>

		<div class="lopts_item flex">
			<div class="lopts_left">
				<select name="language_add_lang" id="language_add_lang">
					<?php require(realpath(OPTION_INCLUDES_DIR . 'language_options.php')); ?>
				</select>
			</div>
			<div class="lopts_center table_heading_center">
				<select name="language_add_level" id="language_add_level">
					<?php require(realpath(OPTION_INCLUDES_DIR . 'proficiency_options.php')); ?>
				</select>
			</div>
			<div class="lopts_right flex">
				<div id="add_new_language_spoken" class="icon add_icon"></div>	
			</div>			
		</div>

		<?php
			if($languages_spoken == null)
			{
				echo '<div id="temp_message_box">';
					echo $lang['settings']['no_langs'];
				echo '</div>';
			}
			else
			{
				foreach ($languages_spoken as $language)
				{
					?>
						<div class="lopts_item flex" id="lid_<?php echo $language['language_code']; ?>">
							<div class="lopts_left">
								 <?php echo LanguageMapping::map($language['language_code']); ?> 
							</div>
							<div class="lopts_center table_heading_center">
								<?php echo ProficiencyMapping::map($language['level']); ?>
							</div>
							<div class="lopts_right flex">
								<div class="icon remove_icon remove_language_btn" data-code="<?php echo $language['language_code']; ?>" data-userid="<?php echo $_SESSION['logged_user']['id']; ?>"></div>	
							</div>			
						</div>
					<?php
				}
			}
		?>
	</div>
</div>

<br/><br/>

<div class="flex">
	<div class="lopts_label"><?php echo $lang['settings']['lang_learn']; ?></div>
	<div class="lopts_content_alt">
		<div class="lopts_left table_heading_alt"><?php echo $lang['settings']['language']; ?></div>
		<div class="lopts_center table_heading_alt table_heading_center"></div>
		<div class="lopts_right table_heading_alt"><?php echo $lang['settings']['action']; ?></div>

		<div class="lopts_item_alt flex">
			<div class="lopts_left">
				<select name="to_learn_add_select" id="to_learn_add_select">
					<?php require(realpath(OPTION_INCLUDES_DIR . 'language_options.php')); ?>
				</select>
			</div>
			<div class="lopts_center table_heading_center"></div>
			<div class="lopts_right flex">
				<div id="add_new_language_to_learn" class="icon add_icon"></div>	
			</div>			
		</div>

		<?php
			if($languages_learn == null)
			{
				echo '<div id="temp_message_box_alt">';
					echo $lang['settings']['no_langs'];
				echo '</div>';
			}
			else
			{
				foreach($languages_learn as $language)
				{
				?>
					<div class="lopts_item_alt flex">
						<div class="lopts_left">
							<?php echo LanguageMapping::map($language['language_code']); ?>
						</div>
						<div class="lopts_center table_heading_center">
						</div>
						<div class="lopts_right flex">
							<div class="icon remove_icon remove_language_to_learn_btn" data-code="<?php echo $language['language_code']; ?>" data-userid="<?php echo $_SESSION['logged_user']['id']; ?>"></div>	
						</div>			
					</div>
				<?php
				}				
			}
		?>
	</div>
</div>