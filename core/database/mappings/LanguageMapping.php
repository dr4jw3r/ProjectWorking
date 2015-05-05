<?php

	require_once('IDataMapping.php');

	class LanguageMapping implements IDataMapping
	{
		public static function map($data)
		{
			$data = strtolower($data);
			$language = '';

			switch($data)
			{
				case 'ab':
					$language = 'Abkhazian';
					break;

				case 'aa':
					$language = 'Afar';
					break;

				case 'af':
					$language = 'Afrikaans';
					break;

				case 'sq':
					$language = 'Albanian';
					break;

				case 'am':
					$language = 'Amharic';
					break;

				case 'ar':
					$language = 'Arabic';
					break;

				case 'hy':
					$language = 'Armenian';
					break;

				case 'as':
					$language = 'Assamese';
					break;

				case 'ay':
					$language = 'Aymara';
					break;

				case 'az':
					$language = 'Azerbaijani';
					break;

				case 'ba':
					$language = 'Bashkir';
					break;

				case 'eu':
					$language = 'Basque';
					break;

				case 'bn':
					$language = 'Bengali/Bangla';
					break;

				case 'dz':
					$language = 'Bhutani';
					break;

				case 'bh':
					$language = 'Bihari';
					break;

				case 'bi':
					$language = 'Bislama';
					break;

				case 'br':
					$language = 'Breton';
					break;

				case 'bg':
					$language = 'Bulgarian';
					break;

				case 'my':
					$language = 'Burmese';
					break;

				case 'be':
					$language = 'Byelorussian';
					break;

				case 'km':
					$language = 'Cambodian';
					break;

				case 'ca':
					$language = 'Catalan';
					break;

				case 'zh':
					$language = 'Chinese';
					break;

				case 'co':
					$language = 'Corsican';
					break;

				case 'hr':
					$language = 'Croatian';
					break;

				case 'cs':
					$language = 'Czech';
					break;

				case 'da':
					$language = 'Danish';
					break;

				case 'nl':
					$language = 'Dutch';
					break;

				case 'en':
					$language = 'English';
					break;

				case 'eo':
					$language = 'Esperanto';
					break;

				case 'et':
					$language = 'Estonian';
					break;

				case 'fo':
					$language = 'Faeroese';
					break;

				case 'fj':
					$language = 'Fiji';
					break;

				case 'fi':
					$language = 'Finnish';
					break;

				case 'fr':
					$language = 'French';
					break;

				case 'fy':
					$language = 'Frisian';
					break;

				case 'gl':
					$language = 'Galician';
					break;

				case 'ka':
					$language = 'Georgian';
					break;

				case 'de':
					$language = 'German';
					break;

				case 'el':
					$language = 'Greek';
					break;

				case 'kl':
					$language = 'Greenlandic';
					break;

				case 'gn':
					$language = 'Guarani';
					break;

				case 'gu':
					$language = 'Gujarati';
					break;

				case 'ha':
					$language = 'Hausa';
					break;

				case 'iw':
					$language = 'Hebrew';
					break;

				case 'hi':
					$language = 'Hindi';
					break;

				case 'hu':
					$language = 'Hungarian';
					break;

				case 'is':
					$language = 'Icelandic';
					break;

				case 'in':
					$language = 'Indonesian';
					break;

				case 'ia':
					$language = 'Interlingua';
					break;

				case 'ie':
					$language = 'Interlingue';
					break;

				case 'ik':
					$language = 'Inupiak';
					break;

				case 'ga':
					$language = 'Irish';
					break;

				case 'it':
					$language = 'Italian';
					break;

				case 'ja':
					$language = 'Japanese';
					break;

				case 'jw':
					$language = 'Javanese';
					break;

				case 'kn':
					$language = 'Kannada';
					break;

				case 'ks':
					$language = 'Kashmiri';
					break;

				case 'kk':
					$language = 'Kazakh';
					break;

				case 'rw':
					$language = 'Kinyarwanda';
					break;

				case 'ky':
					$language = 'Kirghiz';
					break;

				case 'rn':
					$language = 'Kirundi';
					break;

				case 'ko':
					$language = 'Korean';
					break;

				case 'ku':
					$language = 'Kurdish';
					break;

				case 'lo':
					$language = 'Laothian';
					break;

				case 'la':
					$language = 'Latin';
					break;

				case 'lv':
					$language = 'Latvian/Lettish';
					break;

				case 'ln':
					$language = 'Lingala';
					break;

				case 'lt':
					$language = 'Lithuanian';
					break;

				case 'mk':
					$language = 'Macedonian';
					break;

				case 'mg':
					$language = 'Malagasy';
					break;

				case 'ms':
					$language = 'Malay';
					break;

				case 'ml':
					$language = 'Malayalam';
					break;

				case 'mt':
					$language = 'Maltese';
					break;

				case 'mi':
					$language = 'Maori';
					break;

				case 'mr':
					$language = 'Marathi';
					break;

				case 'mo':
					$language = 'Moldavian';
					break;

				case 'mn':
					$language = 'Mongolian';
					break;

				case 'na':
					$language = 'Nauru';
					break;

				case 'ne':
					$language = 'Nepali';
					break;

				case 'no':
					$language = 'Norwegian';
					break;

				case 'oc':
					$language = 'Occitan';
					break;

				case 'om':
					$language = '(Afan)/Oromoor/Oriya';
					break;

				case 'ps':
					$language = 'Pashto/Pushto';
					break;

				case 'fa':
					$language = 'Persian';
					break;

				case 'pl':
					$language = 'Polish';
					break;

				case 'pt':
					$language = 'Portuguese';
					break;

				case 'pa':
					$language = 'Punjabi';
					break;

				case 'qu':
					$language = 'Quechua';
					break;

				case 'rm':
					$language = 'Rhaeto-Romance';
					break;

				case 'ro':
					$language = 'Romanian';
					break;

				case 'ru':
					$language = 'Russian';
					break;

				case 'sm':
					$language = 'Samoan';
					break;

				case 'sg':
					$language = 'Sangro';
					break;

				case 'sa':
					$language = 'Sanskrit';
					break;

				case 'gd':
					$language = 'Scots/Gaelic';
					break;

				case 'sr':
					$language = 'Serbian';
					break;

				case 'sh':
					$language = 'Serbo-Croatian';
					break;

				case 'st':
					$language = 'Sesotho';
					break;

				case 'tn':
					$language = 'Setswana';
					break;

				case 'sn':
					$language = 'Shona';
					break;

				case 'sd':
					$language = 'Sindhi';
					break;

				case 'si':
					$language = 'Singhalese';
					break;

				case 'ss':
					$language = 'Siswati';
					break;

				case 'sk':
					$language = 'Slovak';
					break;

				case 'sl':
					$language = 'Slovenian';
					break;

				case 'so':
					$language = 'Somali';
					break;

				case 'es':
					$language = 'Spanish';
					break;

				case 'su':
					$language = 'Sundanese';
					break;

				case 'sw':
					$language = 'Swahili';
					break;

				case 'sv':
					$language = 'Swedish';
					break;

				case 'tl':
					$language = 'Tagalog';
					break;

				case 'tg':
					$language = 'Tajik';
					break;

				case 'ta':
					$language = 'Tamil';
					break;

				case 'tt':
					$language = 'Tatar';
					break;

				case 'te':
					$language = 'Tegulu';
					break;

				case 'th':
					$language = 'Thai';
					break;

				case 'bo':
					$language = 'Tibetan';
					break;

				case 'ti':
					$language = 'Tigrinya';
					break;

				case 'to':
					$language = 'Tonga';
					break;

				case 'ts':
					$language = 'Tsonga';
					break;

				case 'tr':
					$language = 'Turkish';
					break;

				case 'tk':
					$language = 'Turkmen';
					break;

				case 'tw':
					$language = 'Twi';
					break;

				case 'uk':
					$language = 'Ukrainian';
					break;

				case 'ur':
					$language = 'Urdu';
					break;

				case 'uz':
					$language = 'Uzbek';
					break;

				case 'vi':
					$language = 'Vietnamese';
					break;

				case 'vo':
					$language = 'Volapuk';
					break;

				case 'cy':
					$language = 'Welsh';
					break;

				case 'wo':
					$language = 'Wolof';
					break;

				case 'xh':
					$language = 'Xhosa';
					break;

				case 'ji':
					$language = 'Yiddish';
					break;

				case 'yo':
					$language = 'Yoruba';
					break;

				case 'zu':
					$language = 'Zulu';
					break;
			}

			return $language;
		}
	}
?>