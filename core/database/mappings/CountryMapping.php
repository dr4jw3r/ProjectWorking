<?php

	require_once('IDataMapping.php');

	class CountryMapping implements IDataMapping
	{
		public static function map($data)
		{
			$data = strtoupper($data);
			$country = '';

			switch($data)
			{
				case 'AD':
					$country = 'Andorra';
					break;

				case 'AE':
					$country = 'United Arab Emirates';
					break;

				case 'AF':
					$country = 'Afghanistan';
					break;

				case 'AG':
					$country = 'Antigua and Barbuda';
					break;

				case 'AI':
					$country = 'Anguilla';
					break;

				case 'AL':
					$country = 'Albania';
					break;

				case 'AM':
					$country = 'Armenia';
					break;

				case 'AO':
					$country = 'Angola';
					break;

				case 'AQ':
					$country = 'Antarctica';
					break;

				case 'AR':
					$country = 'Argentina';
					break;

				case 'AS':
					$country = 'American Samoa';
					break;

				case 'AT':
					$country = 'Austria';
					break;

				case 'AU':
					$country = 'Australia';
					break;

				case 'AW':
					$country = 'Aruba';
					break;

				case 'AX':
					$country = 'Åland';
					break;

				case 'AZ':
					$country = 'Azerbaijan';
					break;

				case 'BA':
					$country = 'Bosnia and Herzegovina';
					break;

				case 'BB':
					$country = 'Barbados';
					break;

				case 'BD':
					$country = 'Bangladesh';
					break;

				case 'BE':
					$country = 'Belgium';
					break;

				case 'BF':
					$country = 'Burkina Faso';
					break;

				case 'BG':
					$country = 'Bulgaria';
					break;

				case 'BH':
					$country = 'Bahrain';
					break;

				case 'BI':
					$country = 'Burundi';
					break;

				case 'BJ':
					$country = 'Benin';
					break;

				case 'BL':
					$country = 'Saint Barthélemy';
					break;

				case 'BM':
					$country = 'Bermuda';
					break;

				case 'BN':
					$country = 'Brunei';
					break;

				case 'BO':
					$country = 'Bolivia';
					break;

				case 'BQ':
					$country = 'Bonaire';
					break;

				case 'BR':
					$country = 'Brazil';
					break;

				case 'BS':
					$country = 'Bahamas';
					break;

				case 'BT':
					$country = 'Bhutan';
					break;

				case 'BV':
					$country = 'Bouvet Island';
					break;

				case 'BW':
					$country = 'Botswana';
					break;

				case 'BY':
					$country = 'Belarus';
					break;

				case 'BZ':
					$country = 'Belize';
					break;

				case 'CA':
					$country = 'Canada';
					break;

				case 'CC':
					$country = 'Cocos [Keeling] Islands';
					break;

				case 'CD':
					$country = 'Democratic Republic of the Congo';
					break;

				case 'CF':
					$country = 'Central African Republic';
					break;

				case 'CG':
					$country = 'Republic of the Congo';
					break;

				case 'CH':
					$country = 'Switzerland';
					break;

				case 'CI':
					$country = 'Ivory Coast';
					break;

				case 'CK':
					$country = 'Cook Islands';
					break;

				case 'CL':
					$country = 'Chile';
					break;

				case 'CM':
					$country = 'Cameroon';
					break;

				case 'CN':
					$country = 'China';
					break;

				case 'CO':
					$country = 'Colombia';
					break;

				case 'CR':
					$country = 'Costa Rica';
					break;

				case 'CU':
					$country = 'Cuba';
					break;

				case 'CV':
					$country = 'Cape Verde';
					break;

				case 'CW':
					$country = 'Curacao';
					break;

				case 'CX':
					$country = 'Christmas Island';
					break;

				case 'CY':
					$country = 'Cyprus';
					break;

				case 'CZ':
					$country = 'Czech Republic';
					break;

				case 'DE':
					$country = 'Germany';
					break;

				case 'DJ':
					$country = 'Djibouti';
					break;

				case 'DK':
					$country = 'Denmark';
					break;

				case 'DM':
					$country = 'Dominica';
					break;

				case 'DO':
					$country = 'Dominican Republic';
					break;

				case 'DZ':
					$country = 'Algeria';
					break;

				case 'EC':
					$country = 'Ecuador';
					break;

				case 'EE':
					$country = 'Estonia';
					break;

				case 'EG':
					$country = 'Egypt';
					break;

				case 'EH':
					$country = 'Western Sahara';
					break;

				case 'ER':
					$country = 'Eritrea';
					break;

				case 'ES':
					$country = 'Spain';
					break;

				case 'ET':
					$country = 'Ethiopia';
					break;

				case 'FI':
					$country = 'Finland';
					break;

				case 'FJ':
					$country = 'Fiji';
					break;

				case 'FK':
					$country = 'Falkland Islands';
					break;

				case 'FM':
					$country = 'Micronesia';
					break;

				case 'FO':
					$country = 'Faroe Islands';
					break;

				case 'FR':
					$country = 'France';
					break;

				case 'GA':
					$country = 'Gabon';
					break;

				case 'GB':
					$country = 'United Kingdom';
					break;

				case 'GD':
					$country = 'Grenada';
					break;

				case 'GE':
					$country = 'Georgia';
					break;

				case 'GF':
					$country = 'French Guiana';
					break;

				case 'GG':
					$country = 'Guernsey';
					break;

				case 'GH':
					$country = 'Ghana';
					break;

				case 'GI':
					$country = 'Gibraltar';
					break;

				case 'GL':
					$country = 'Greenland';
					break;

				case 'GM':
					$country = 'Gambia';
					break;

				case 'GN':
					$country = 'Guinea';
					break;

				case 'GP':
					$country = 'Guadeloupe';
					break;

				case 'GQ':
					$country = 'Equatorial Guinea';
					break;

				case 'GR':
					$country = 'Greece';
					break;

				case 'GS':
					$country = 'South Georgia and the South Sandwich Islands';
					break;

				case 'GT':
					$country = 'Guatemala';
					break;

				case 'GU':
					$country = 'Guam';
					break;

				case 'GW':
					$country = 'Guinea-Bissau';
					break;

				case 'GY':
					$country = 'Guyana';
					break;

				case 'HK':
					$country = 'Hong Kong';
					break;

				case 'HM':
					$country = 'Heard Island and McDonald Islands';
					break;

				case 'HN':
					$country = 'Honduras';
					break;

				case 'HR':
					$country = 'Croatia';
					break;

				case 'HT':
					$country = 'Haiti';
					break;

				case 'HU':
					$country = 'Hungary';
					break;

				case 'ID':
					$country = 'Indonesia';
					break;

				case 'IE':
					$country = 'Ireland';
					break;

				case 'IL':
					$country = 'Israel';
					break;

				case 'IM':
					$country = 'Isle of Man';
					break;

				case 'IN':
					$country = 'India';
					break;

				case 'IO':
					$country = 'British Indian Ocean Territory';
					break;

				case 'IQ':
					$country = 'Iraq';
					break;

				case 'IR':
					$country = 'Iran';
					break;

				case 'IS':
					$country = 'Iceland';
					break;

				case 'IT':
					$country = 'Italy';
					break;

				case 'JE':
					$country = 'Jersey';
					break;

				case 'JM':
					$country = 'Jamaica';
					break;

				case 'JO':
					$country = 'Jordan';
					break;

				case 'JP':
					$country = 'Japan';
					break;

				case 'KE':
					$country = 'Kenya';
					break;

				case 'KG':
					$country = 'Kyrgyzstan';
					break;

				case 'KH':
					$country = 'Cambodia';
					break;

				case 'KI':
					$country = 'Kiribati';
					break;

				case 'KM':
					$country = 'Comoros';
					break;

				case 'KN':
					$country = 'Saint Kitts and Nevis';
					break;

				case 'KP':
					$country = 'North Korea';
					break;

				case 'KR':
					$country = 'South Korea';
					break;

				case 'KW':
					$country = 'Kuwait';
					break;

				case 'KY':
					$country = 'Cayman Islands';
					break;

				case 'KZ':
					$country = 'Kazakhstan';
					break;

				case 'LA':
					$country = 'Laos';
					break;

				case 'LB':
					$country = 'Lebanon';
					break;

				case 'LC':
					$country = 'Saint Lucia';
					break;

				case 'LI':
					$country = 'Liechtenstein';
					break;

				case 'LK':
					$country = 'Sri Lanka';
					break;

				case 'LR':
					$country = 'Liberia';
					break;

				case 'LS':
					$country = 'Lesotho';
					break;

				case 'LT':
					$country = 'Lithuania';
					break;

				case 'LU':
					$country = 'Luxembourg';
					break;

				case 'LV':
					$country = 'Latvia';
					break;

				case 'LY':
					$country = 'Libya';
					break;

				case 'MA':
					$country = 'Morocco';
					break;

				case 'MC':
					$country = 'Monaco';
					break;

				case 'MD':
					$country = 'Moldova';
					break;

				case 'ME':
					$country = 'Montenegro';
					break;

				case 'MF':
					$country = 'Saint Martin';
					break;

				case 'MG':
					$country = 'Madagascar';
					break;

				case 'MH':
					$country = 'Marshall Islands';
					break;

				case 'MK':
					$country = 'Macedonia';
					break;

				case 'ML':
					$country = 'Mali';
					break;

				case 'MM':
					$country = 'Myanmar [Burma]';
					break;

				case 'MN':
					$country = 'Mongolia';
					break;

				case 'MO':
					$country = 'Macao';
					break;

				case 'MP':
					$country = 'Northern Mariana Islands';
					break;

				case 'MQ':
					$country = 'Martinique';
					break;

				case 'MR':
					$country = 'Mauritania';
					break;

				case 'MS':
					$country = 'Montserrat';
					break;

				case 'MT':
					$country = 'Malta';
					break;

				case 'MU':
					$country = 'Mauritius';
					break;

				case 'MV':
					$country = 'Maldives';
					break;

				case 'MW':
					$country = 'Malawi';
					break;

				case 'MX':
					$country = 'Mexico';
					break;

				case 'MY':
					$country = 'Malaysia';
					break;

				case 'MZ':
					$country = 'Mozambique';
					break;

				case 'NA':
					$country = 'Namibia';
					break;

				case 'NC':
					$country = 'New Caledonia';
					break;

				case 'NE':
					$country = 'Niger';
					break;

				case 'NF':
					$country = 'Norfolk Island';
					break;

				case 'NG':
					$country = 'Nigeria';
					break;

				case 'NI':
					$country = 'Nicaragua';
					break;

				case 'NL':
					$country = 'Netherlands';
					break;

				case 'NO':
					$country = 'Norway';
					break;

				case 'NP':
					$country = 'Nepal';
					break;

				case 'NR':
					$country = 'Nauru';
					break;

				case 'NU':
					$country = 'Niue';
					break;

				case 'NZ':
					$country = 'New Zealand';
					break;

				case 'OM':
					$country = 'Oman';
					break;

				case 'PA':
					$country = 'Panama';
					break;

				case 'PE':
					$country = 'Peru';
					break;

				case 'PF':
					$country = 'French Polynesia';
					break;

				case 'PG':
					$country = 'Papua New Guinea';
					break;

				case 'PH':
					$country = 'Philippines';
					break;

				case 'PK':
					$country = 'Pakistan';
					break;

				case 'PL':
					$country = 'Poland';
					break;

				case 'PM':
					$country = 'Saint Pierre and Miquelon';
					break;

				case 'PN':
					$country = 'Pitcairn Islands';
					break;

				case 'PR':
					$country = 'Puerto Rico';
					break;

				case 'PS':
					$country = 'Palestine';
					break;

				case 'PT':
					$country = 'Portugal';
					break;

				case 'PW':
					$country = 'Palau';
					break;

				case 'PY':
					$country = 'Paraguay';
					break;

				case 'QA':
					$country = 'Qatar';
					break;

				case 'RE':
					$country = 'Réunion';
					break;

				case 'RO':
					$country = 'Romania';
					break;

				case 'RS':
					$country = 'Serbia';
					break;

				case 'RU':
					$country = 'Russia';
					break;

				case 'RW':
					$country = 'Rwanda';
					break;

				case 'SA':
					$country = 'Saudi Arabia';
					break;

				case 'SB':
					$country = 'Solomon Islands';
					break;

				case 'SC':
					$country = 'Seychelles';
					break;

				case 'SD':
					$country = 'Sudan';
					break;

				case 'SE':
					$country = 'Sweden';
					break;

				case 'SG':
					$country = 'Singapore';
					break;

				case 'SH':
					$country = 'Saint Helena';
					break;

				case 'SI':
					$country = 'Slovenia';
					break;

				case 'SJ':
					$country = 'Svalbard and Jan Mayen';
					break;

				case 'SK':
					$country = 'Slovakia';
					break;

				case 'SL':
					$country = 'Sierra Leone';
					break;

				case 'SM':
					$country = 'San Marino';
					break;

				case 'SN':
					$country = 'Senegal';
					break;

				case 'SO':
					$country = 'Somalia';
					break;

				case 'SR':
					$country = 'Suriname';
					break;

				case 'SS':
					$country = 'South Sudan';
					break;

				case 'ST':
					$country = 'São Tomé and Príncipe';
					break;

				case 'SV':
					$country = 'El Salvador';
					break;

				case 'SX':
					$country = 'Sint Maarten';
					break;

				case 'SY':
					$country = 'Syria';
					break;

				case 'SZ':
					$country = 'Swaziland';
					break;

				case 'TC':
					$country = 'Turks and Caicos Islands';
					break;

				case 'TD':
					$country = 'Chad';
					break;

				case 'TF':
					$country = 'French Southern Territories';
					break;

				case 'TG':
					$country = 'Togo';
					break;

				case 'TH':
					$country = 'Thailand';
					break;

				case 'TJ':
					$country = 'Tajikistan';
					break;

				case 'TK':
					$country = 'Tokelau';
					break;

				case 'TL':
					$country = 'East Timor';
					break;

				case 'TM':
					$country = 'Turkmenistan';
					break;

				case 'TN':
					$country = 'Tunisia';
					break;

				case 'TO':
					$country = 'Tonga';
					break;

				case 'TR':
					$country = 'Turkey';
					break;

				case 'TT':
					$country = 'Trinidad and Tobago';
					break;

				case 'TV':
					$country = 'Tuvalu';
					break;

				case 'TW':
					$country = 'Taiwan';
					break;

				case 'TZ':
					$country = 'Tanzania';
					break;

				case 'UA':
					$country = 'Ukraine';
					break;

				case 'UG':
					$country = 'Uganda';
					break;

				case 'UM':
					$country = 'U.S. Minor Outlying Islands';
					break;

				case 'US':
					$country = 'United States';
					break;

				case 'UY':
					$country = 'Uruguay';
					break;

				case 'UZ':
					$country = 'Uzbekistan';
					break;

				case 'VA':
					$country = 'Vatican City';
					break;

				case 'VC':
					$country = 'Saint Vincent and the Grenadines';
					break;

				case 'VE':
					$country = 'Venezuela';
					break;

				case 'VG':
					$country = 'British Virgin Islands';
					break;

				case 'VI':
					$country = 'U.S. Virgin Islands';
					break;

				case 'VN':
					$country = 'Vietnam';
					break;

				case 'VU':
					$country = 'Vanuatu';
					break;

				case 'WF':
					$country = 'Wallis and Futuna';
					break;

				case 'WS':
					$country = 'Samoa';
					break;

				case 'XK':
					$country = 'Kosovo';
					break;

				case 'YE':
					$country = 'Yemen';
					break;

				case 'YT':
					$country = 'Mayotte';
					break;

				case 'ZA':
					$country = 'South Africa';
					break;

				case 'ZM':
					$country = 'Zambia';
					break;

				case 'ZW':
					$country = 'Zimbabwe';
					break;
			}

			return $country;
		}
	}

?>