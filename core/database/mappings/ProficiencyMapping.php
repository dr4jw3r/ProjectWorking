<?php

	require_once('IDataMapping.php');

	class ProficiencyMapping implements IDataMapping
	{
		public static function map($data)
		{

			$data = (int) $data;
			$level_str = "";
			$lang['settings'] = getTranslations('settings');

			switch($data)
			{
				case 0:
					$level_str = $lang['settings']['beginner'];
					break;
				case 1:
					$level_str = $lang['settings']['intermediate'];
					break;
				case 2:
					$level_str = $lang['settings']['advanced'];
					break;
				case 3:
					$level_str = $lang['settings']['native'];
					break;
			}

			return $level_str;
		}
	}

?>