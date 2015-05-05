<?php

	require_once('IDataMapping.php');

	class GenderMapping implements IDataMapping
	{
		public static function map($data)
		{

			$data = (int) $data;
			$gender = "";
			$lang['settings'] = getTranslations('settings');

			switch($data)
			{
				case 1:
					$gender = $lang['settings']['male'];
					break;
				case 2:
					$gender = $lang['settings']['female'];
					break;
			}

			return $gender;
		}
	}

?>