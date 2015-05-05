#Variables
#====================================================================#
SET @db_name 							= 'LangExchange';
SET @table_prefix 						= 'LangExchange_';

SET @user_table_name 					= 'User';
SET @personal_details_table_name	 	= 'PersonalDetails';
SET @country_table_name 				= 'Country';
SET @language_table_name 				= 'Language';
SET @spoken_table_name 					= 'LanguageSpoken';
SET @to_learn_table_name 				= 'LanguageLearn';
SET @lesson_request_table_name 			= 'LessonRequest';
SET @lesson_request_archive_table_name 	= 'LessonRequestArchive';
SET @message_table_name					= 'Message';
SET @active_lesson_table_name			= 'ActiveLesson';
#====================================================================#


#Create Database
#====================================================================#
SET @query = CONCAT('CREATE DATABASE IF NOT EXISTS ', @db_name);
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#


#User table
#====================================================================#
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @user_table_name, '(
	id int(11) NOT NULL AUTO_INCREMENT UNIQUE,
	email varchar(255) NOT NULL UNIQUE,
	password varchar(255) NOT NULL,
	salt varchar(255) NOT NULL,
	date_registered timestamp DEFAULT CURRENT_TIMESTAMP,
	last_visit datetime DEFAULT NULL,
	active BIT(1) DEFAULT 0,
	PRIMARY KEY (id)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#

#Personal Details table
#====================================================================#
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @personal_details_table_name, '(
	id int(11) NOT NULL AUTO_INCREMENT UNIQUE,
	user_id int(11) NOT NULL UNIQUE,
	first_name varchar(255) NOT NULL,
	last_name varchar(255) DEFAULT NULL,
	country_code varchar(2) NOT NULL,
	city varchar(255) DEFAULT NULL,
	age int(3),
	gender INT(1),
	profile_description VARCHAR(1000) DEFAULT NULL,
	PRIMARY KEY (id)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#

#Country table
#====================================================================#
-- Drop first in case the table already exists and we want to avoid
-- double entries. The table can be dropped safely since it only 
-- contains static data (seeded below)

SET @query = CONCAT('DROP TABLE IF EXISTS ', @db_name, '.', @table_prefix, @country_table_name);
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @country_table_name, '(
	id int(5) NOT NULL AUTO_INCREMENT UNIQUE,
	code char(2) NOT NULL,
	name varchar(45) NOT NULL,
	PRIMARY KEY (id)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#

#Language table
#====================================================================#
-- Drop first in case the table already exists and we want to avoid
-- double entries. The table can be dropped safely since it only 
-- contains static data (seeded below)

SET @query = CONCAT('DROP TABLE IF EXISTS ', @db_name, '.', @table_prefix, @language_table_name);
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @language_table_name, '(
	id int(5) NOT NULL AUTO_INCREMENT UNIQUE,
	code char(4) NOT NULL,
	name varchar(45) NOT NULL,
	PRIMARY KEY (id)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#


#Language spoken table
#====================================================================#
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @spoken_table_name, '(
	user_id int(11) NOT NULL,
	language_code varchar(2) NOT NULL,
	level int(1) NOT NULL,
	PRIMARY KEY (user_id, language_code)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#


#Language to learn table
#====================================================================#
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @to_learn_table_name, '(
	user_id int(11) NOT NULL,
	language_code varchar(2) NOT NULL,
	PRIMARY KEY (user_id, language_code)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#


#Lesson Request Table
#====================================================================#
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @lesson_request_table_name, '(
	id int(11) NOT NULL AUTO_INCREMENT UNIQUE,
	user_from_id int(11) NOT NULL,
	user_to_id int(11) NOT NULL,
	date date NOT NULL,
	start_time time NOT NULL,
	end_time time NOT NULL,
	duration int(11) NOT NULL,
	language_code varchar(2) NOT NULL,
	status int(1) NOT NULL,
	PRIMARY KEY (id)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#


#Lesson Request Archive Table
#====================================================================#
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @lesson_request_archive_table_name, '(
	id int(11) NOT NULL AUTO_INCREMENT UNIQUE,
	request_id int(11) NOT NULL UNIQUE,
	user_from_id int(11) NOT NULL,
	user_to_id int(11) NOT NULL,
	date date NOT NULL,
	start_time time NOT NULL,
	end_time time NOT NULL,
	duration int(11) NOT NULL,
	language_code varchar(2) NOT NULL,
	status int(1) NOT NULL,
	PRIMARY KEY (id)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#


#Messages Table
#====================================================================#
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @message_table_name, '(
	id int(11) NOT NULL AUTO_INCREMENT UNIQUE,
	user_from_id int(11) NOT NULL,
	user_to_id int(11) NOT NULL,
	date_sent datetime NOT NULL,
	subject varchar(100) NOT NULL,
	content varchar(1000) NOT NULL,
	status int(1) NOT NULL,
	PRIMARY KEY (id)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#



#Active Lesson Table
#====================================================================#
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS ', @db_name, '.', @table_prefix, @active_lesson_table_name, '(
	id int(11) NOT NULL AUTO_INCREMENT UNIQUE,
	request_id int(11) NOT NULL UNIQUE,
	user_a_id int(11) NOT NULL,
	user_b_id int(11) NOT NULL,
	user_hash varchar(1000) NOT NULL,
	room_id varchar(1000) DEFAULT NULL,
	PRIMARY KEY (id)
)');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#




-- Static data table seeding

#Seeding the country table
#====================================================================#
SET @query = CONCAT('INSERT INTO ', @db_name, '.', @table_prefix, @country_table_name, ' (`code`, `name`) VALUES 
	(\'AD\', \'Andorra\'),
	(\'AE\', \'United Arab Emirates\'),
	(\'AF\', \'Afghanistan\'),
	(\'AG\', \'Antigua and Barbuda\'),
	(\'AI\', \'Anguilla\'),
	(\'AL\', \'Albania\'),
	(\'AM\', \'Armenia\'),
	(\'AO\', \'Angola\'),
	(\'AQ\', \'Antarctica\'),
	(\'AR\', \'Argentina\'),
	(\'AS\', \'American Samoa\'),
	(\'AT\', \'Austria\'),
	(\'AU\', \'Australia\'),
	(\'AW\', \'Aruba\'),
	(\'AX\', \'Åland\'),
	(\'AZ\', \'Azerbaijan\'),
	(\'BA\', \'Bosnia and Herzegovina\'),
	(\'BB\', \'Barbados\'),
	(\'BD\', \'Bangladesh\'),
	(\'BE\', \'Belgium\'),
	(\'BF\', \'Burkina Faso\'),
	(\'BG\', \'Bulgaria\'),
	(\'BH\', \'Bahrain\'),
	(\'BI\', \'Burundi\'),
	(\'BJ\', \'Benin\'),
	(\'BL\', \'Saint Barthélemy\'),
	(\'BM\', \'Bermuda\'),
	(\'BN\', \'Brunei\'),
	(\'BO\', \'Bolivia\'),
	(\'BQ\', \'Bonaire\'),
	(\'BR\', \'Brazil\'),
	(\'BS\', \'Bahamas\'),
	(\'BT\', \'Bhutan\'),
	(\'BV\', \'Bouvet Island\'),
	(\'BW\', \'Botswana\'),
	(\'BY\', \'Belarus\'),
	(\'BZ\', \'Belize\'),
	(\'CA\', \'Canada\'),
	(\'CC\', \'Cocos [Keeling] Islands\'),
	(\'CD\', \'Democratic Republic of the Congo\'),
	(\'CF\', \'Central African Republic\'),
	(\'CG\', \'Republic of the Congo\'),
	(\'CH\', \'Switzerland\'),
	(\'CI\', \'Ivory Coast\'),
	(\'CK\', \'Cook Islands\'),
	(\'CL\', \'Chile\'),
	(\'CM\', \'Cameroon\'),
	(\'CN\', \'China\'),
	(\'CO\', \'Colombia\'),
	(\'CR\', \'Costa Rica\'),
	(\'CU\', \'Cuba\'),
	(\'CV\', \'Cape Verde\'),
	(\'CW\', \'Curacao\'),
	(\'CX\', \'Christmas Island\'),
	(\'CY\', \'Cyprus\'),
	(\'CZ\', \'Czech Republic\'),
	(\'DE\', \'Germany\'),
	(\'DJ\', \'Djibouti\'),
	(\'DK\', \'Denmark\'),
	(\'DM\', \'Dominica\'),
	(\'DO\', \'Dominican Republic\'),
	(\'DZ\', \'Algeria\'),
	(\'EC\', \'Ecuador\'),
	(\'EE\', \'Estonia\'),
	(\'EG\', \'Egypt\'),
	(\'EH\', \'Western Sahara\'),
	(\'ER\', \'Eritrea\'),
	(\'ES\', \'Spain\'),
	(\'ET\', \'Ethiopia\'),
	(\'FI\', \'Finland\'),
	(\'FJ\', \'Fiji\'),
	(\'FK\', \'Falkland Islands\'),
	(\'FM\', \'Micronesia\'),
	(\'FO\', \'Faroe Islands\'),
	(\'FR\', \'France\'),
	(\'GA\', \'Gabon\'),
	(\'GB\', \'United Kingdom\'),
	(\'GD\', \'Grenada\'),
	(\'GE\', \'Georgia\'),
	(\'GF\', \'French Guiana\'),
	(\'GG\', \'Guernsey\'),
	(\'GH\', \'Ghana\'),
	(\'GI\', \'Gibraltar\'),
	(\'GL\', \'Greenland\'),
	(\'GM\', \'Gambia\'),
	(\'GN\', \'Guinea\'),
	(\'GP\', \'Guadeloupe\'),
	(\'GQ\', \'Equatorial Guinea\'),
	(\'GR\', \'Greece\'),
	(\'GS\', \'South Georgia and the South Sandwich Islands\'),
	(\'GT\', \'Guatemala\'),
	(\'GU\', \'Guam\'),
	(\'GW\', \'Guinea-Bissau\'),
	(\'GY\', \'Guyana\'),
	(\'HK\', \'Hong Kong\'),
	(\'HM\', \'Heard Island and McDonald Islands\'),
	(\'HN\', \'Honduras\'),
	(\'HR\', \'Croatia\'),
	(\'HT\', \'Haiti\'),
	(\'HU\', \'Hungary\'),
	(\'ID\', \'Indonesia\'),
	(\'IE\', \'Ireland\'),
	(\'IL\', \'Israel\'),
	(\'IM\', \'Isle of Man\'),
	(\'IN\', \'India\'),
	(\'IO\', \'British Indian Ocean Territory\'),
	(\'IQ\', \'Iraq\'),
	(\'IR\', \'Iran\'),
	(\'IS\', \'Iceland\'),
	(\'IT\', \'Italy\'),
	(\'JE\', \'Jersey\'),
	(\'JM\', \'Jamaica\'),
	(\'JO\', \'Jordan\'),
	(\'JP\', \'Japan\'),
	(\'KE\', \'Kenya\'),
	(\'KG\', \'Kyrgyzstan\'),
	(\'KH\', \'Cambodia\'),
	(\'KI\', \'Kiribati\'),
	(\'KM\', \'Comoros\'),
	(\'KN\', \'Saint Kitts and Nevis\'),
	(\'KP\', \'North Korea\'),
	(\'KR\', \'South Korea\'),
	(\'KW\', \'Kuwait\'),
	(\'KY\', \'Cayman Islands\'),
	(\'KZ\', \'Kazakhstan\'),
	(\'LA\', \'Laos\'),
	(\'LB\', \'Lebanon\'),
	(\'LC\', \'Saint Lucia\'),
	(\'LI\', \'Liechtenstein\'),
	(\'LK\', \'Sri Lanka\'),
	(\'LR\', \'Liberia\'),
	(\'LS\', \'Lesotho\'),
	(\'LT\', \'Lithuania\'),
	(\'LU\', \'Luxembourg\'),
	(\'LV\', \'Latvia\'),
	(\'LY\', \'Libya\'),
	(\'MA\', \'Morocco\'),
	(\'MC\', \'Monaco\'),
	(\'MD\', \'Moldova\'),
	(\'ME\', \'Montenegro\'),
	(\'MF\', \'Saint Martin\'),
	(\'MG\', \'Madagascar\'),
	(\'MH\', \'Marshall Islands\'),
	(\'MK\', \'Macedonia\'),
	(\'ML\', \'Mali\'),
	(\'MM\', \'Myanmar [Burma]\'),
	(\'MN\', \'Mongolia\'),
	(\'MO\', \'Macao\'),
	(\'MP\', \'Northern Mariana Islands\'),
	(\'MQ\', \'Martinique\'),
	(\'MR\', \'Mauritania\'),
	(\'MS\', \'Montserrat\'),
	(\'MT\', \'Malta\'),
	(\'MU\', \'Mauritius\'),
	(\'MV\', \'Maldives\'),
	(\'MW\', \'Malawi\'),
	(\'MX\', \'Mexico\'),
	(\'MY\', \'Malaysia\'),
	(\'MZ\', \'Mozambique\'),
	(\'NA\', \'Namibia\'),
	(\'NC\', \'New Caledonia\'),
	(\'NE\', \'Niger\'),
	(\'NF\', \'Norfolk Island\'),
	(\'NG\', \'Nigeria\'),
	(\'NI\', \'Nicaragua\'),
	(\'NL\', \'Netherlands\'),
	(\'NO\', \'Norway\'),
	(\'NP\', \'Nepal\'),
	(\'NR\', \'Nauru\'),
	(\'NU\', \'Niue\'),
	(\'NZ\', \'New Zealand\'),
	(\'OM\', \'Oman\'),
	(\'PA\', \'Panama\'),
	(\'PE\', \'Peru\'),
	(\'PF\', \'French Polynesia\'),
	(\'PG\', \'Papua New Guinea\'),
	(\'PH\', \'Philippines\'),
	(\'PK\', \'Pakistan\'),
	(\'PL\', \'Poland\'),
	(\'PM\', \'Saint Pierre and Miquelon\'),
	(\'PN\', \'Pitcairn Islands\'),
	(\'PR\', \'Puerto Rico\'),
	(\'PS\', \'Palestine\'),
	(\'PT\', \'Portugal\'),
	(\'PW\', \'Palau\'),
	(\'PY\', \'Paraguay\'),
	(\'QA\', \'Qatar\'),
	(\'RE\', \'Réunion\'),
	(\'RO\', \'Romania\'),
	(\'RS\', \'Serbia\'),
	(\'RU\', \'Russia\'),
	(\'RW\', \'Rwanda\'),
	(\'SA\', \'Saudi Arabia\'),
	(\'SB\', \'Solomon Islands\'),
	(\'SC\', \'Seychelles\'),
	(\'SD\', \'Sudan\'),
	(\'SE\', \'Sweden\'),
	(\'SG\', \'Singapore\'),
	(\'SH\', \'Saint Helena\'),
	(\'SI\', \'Slovenia\'),
	(\'SJ\', \'Svalbard and Jan Mayen\'),
	(\'SK\', \'Slovakia\'),
	(\'SL\', \'Sierra Leone\'),
	(\'SM\', \'San Marino\'),
	(\'SN\', \'Senegal\'),
	(\'SO\', \'Somalia\'),
	(\'SR\', \'Suriname\'),
	(\'SS\', \'South Sudan\'),
	(\'ST\', \'São Tomé and Príncipe\'),
	(\'SV\', \'El Salvador\'),
	(\'SX\', \'Sint Maarten\'),
	(\'SY\', \'Syria\'),
	(\'SZ\', \'Swaziland\'),
	(\'TC\', \'Turks and Caicos Islands\'),
	(\'TD\', \'Chad\'),
	(\'TF\', \'French Southern Territories\'),
	(\'TG\', \'Togo\'),
	(\'TH\', \'Thailand\'),
	(\'TJ\', \'Tajikistan\'),
	(\'TK\', \'Tokelau\'),
	(\'TL\', \'East Timor\'),
	(\'TM\', \'Turkmenistan\'),
	(\'TN\', \'Tunisia\'),
	(\'TO\', \'Tonga\'),
	(\'TR\', \'Turkey\'),
	(\'TT\', \'Trinidad and Tobago\'),
	(\'TV\', \'Tuvalu\'),
	(\'TW\', \'Taiwan\'),
	(\'TZ\', \'Tanzania\'),
	(\'UA\', \'Ukraine\'),
	(\'UG\', \'Uganda\'),
	(\'UM\', \'U.S. Minor Outlying Islands\'),
	(\'US\', \'United States\'),
	(\'UY\', \'Uruguay\'),
	(\'UZ\', \'Uzbekistan\'),
	(\'VA\', \'Vatican City\'),
	(\'VC\', \'Saint Vincent and the Grenadines\'),
	(\'VE\', \'Venezuela\'),
	(\'VG\', \'British Virgin Islands\'),
	(\'VI\', \'U.S. Virgin Islands\'),
	(\'VN\', \'Vietnam\'),
	(\'VU\', \'Vanuatu\'),
	(\'WF\', \'Wallis and Futuna\'),
	(\'WS\', \'Samoa\'),
	(\'XK\', \'Kosovo\'),
	(\'YE\', \'Yemen\'),
	(\'YT\', \'Mayotte\'),
	(\'ZA\', \'South Africa\'),
	(\'ZM\', \'Zambia\'),
	(\'ZW\', \'Zimbabwe\')
');

PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#



#Seeding the language table
#====================================================================#
SET @query = CONCAT('INSERT INTO ', @db_name, '.', @table_prefix, @language_table_name, ' (`name`, `code`) VALUES 
	(\'Abkhazian\', \'ab\'),
	(\'Afar\', \'aa\'),
	(\'Afrikaans\', \'af\'),
	(\'Albanian\', \'sq\'),
	(\'Amharic\', \'am\'),
	(\'Arabic\', \'ar\'),
	(\'Armenian\', \'hy\'),
	(\'Assamese\', \'as\'),
	(\'Aymara\', \'ay\'),
	(\'Azerbaijani\', \'az\'),
	(\'Bashkir\', \'ba\'),
	(\'Basque\', \'eu\'),
	(\'Bengali/Bangla\', \'bn\'),
	(\'Bhutani\', \'dz\'),
	(\'Bihari\', \'bh\'),
	(\'Bislama\', \'bi\'),
	(\'Breton\', \'br\'),
	(\'Bulgarian\', \'bg\'),
	(\'Burmese\', \'my\'),
	(\'Byelorussian\', \'be\'),
	(\'Cambodian\', \'km\'),
	(\'Catalan\', \'ca\'),
	(\'Chinese\', \'zh\'),
	(\'Corsican\', \'co\'),
	(\'Croatian\', \'hr\'),
	(\'Czech\', \'cs\'),
	(\'Danish\', \'da\'),
	(\'Dutch\', \'nl\'),
	(\'English\', \'en\'),
	(\'Esperanto\', \'eo\'),
	(\'Estonian\', \'et\'),
	(\'Faeroese\', \'fo\'),
	(\'Fiji\', \'fj\'),
	(\'Finnish\', \'fi\'),
	(\'French\', \'fr\'),
	(\'Frisian\', \'fy\'),
	(\'Galician\', \'gl\'),
	(\'Georgian\', \'ka\'),
	(\'German\', \'de\'),
	(\'Greek\', \'el\'),
	(\'Greenlandic\', \'kl\'),
	(\'Guarani\', \'gn\'),
	(\'Gujarati\', \'gu\'),
	(\'Hausa\', \'ha\'),
	(\'Hebrew\', \'iw\'),
	(\'Hindi\', \'hi\'),
	(\'Hungarian\', \'hu\'),
	(\'Icelandic\', \'is\'),
	(\'Indonesian\', \'in\'),
	(\'Interlingua\', \'ia\'),
	(\'Interlingue\', \'ie\'),
	(\'Inupiak\', \'ik\'),
	(\'Irish\', \'ga\'),
	(\'Italian\', \'it\'),
	(\'Japanese\', \'ja\'),
	(\'Javanese\', \'jw\'),
	(\'Kannada\', \'kn\'),
	(\'Kashmiri\', \'ks\'),
	(\'Kazakh\', \'kk\'),
	(\'Kinyarwanda\', \'rw\'),
	(\'Kirghiz\', \'ky\'),
	(\'Kirundi\', \'rn\'),
	(\'Korean\', \'ko\'),
	(\'Kurdish\', \'ku\'),
	(\'Laothian\', \'lo\'),
	(\'Latin\', \'la\'),
	(\'Latvian/Lettish\', \'lv\'),
	(\'Lingala\', \'ln\'),
	(\'Lithuanian\', \'lt\'),
	(\'Macedonian\', \'mk\'),
	(\'Malagasy\', \'mg\'),
	(\'Malay\', \'ms\'),
	(\'Malayalam\', \'ml\'),
	(\'Maltese\', \'mt\'),
	(\'Maori\', \'mi\'),
	(\'Marathi\', \'mr\'),
	(\'Moldavian\', \'mo\'),
	(\'Mongolian\', \'mn\'),
	(\'Nauru\', \'na\'),
	(\'Nepali\', \'ne\'),
	(\'Norwegian\', \'no\'),
	(\'Occitan\', \'oc\'),
	(\'(Afan)/Oromoor/Oriya\', \'om\'),
	(\'Pashto/Pushto\', \'ps\'),
	(\'Persian\', \'fa\'),
	(\'Polish\', \'pl\'),
	(\'Portuguese\', \'pt\'),
	(\'Punjabi\', \'pa\'),
	(\'Quechua\', \'qu\'),
	(\'Rhaeto-Romance\', \'rm\'),
	(\'Romanian\', \'ro\'),
	(\'Russian\', \'ru\'),
	(\'Samoan\', \'sm\'),
	(\'Sangro\', \'sg\'),
	(\'Sanskrit\', \'sa\'),
	(\'Scots/Gaelic\', \'gd\'),
	(\'Serbian\', \'sr\'),
	(\'Serbo-Croatian\', \'sh\'),
	(\'Sesotho\', \'st\'),
	(\'Setswana\', \'tn\'),
	(\'Shona\', \'sn\'),
	(\'Sindhi\', \'sd\'),
	(\'Singhalese\', \'si\'),
	(\'Siswati\', \'ss\'),
	(\'Slovak\', \'sk\'),
	(\'Slovenian\', \'sl\'),
	(\'Somali\', \'so\'),
	(\'Spanish\', \'es\'),
	(\'Sundanese\', \'su\'),
	(\'Swahili\', \'sw\'),
	(\'Swedish\', \'sv\'),
	(\'Tagalog\', \'tl\'),
	(\'Tajik\', \'tg\'),
	(\'Tamil\', \'ta\'),
	(\'Tatar\', \'tt\'),
	(\'Tegulu\', \'te\'),
	(\'Thai\', \'th\'),
	(\'Tibetan\', \'bo\'),
	(\'Tigrinya\', \'ti\'),
	(\'Tonga\', \'to\'),
	(\'Tsonga\', \'ts\'),
	(\'Turkish\', \'tr\'),
	(\'Turkmen\', \'tk\'),
	(\'Twi\', \'tw\'),
	(\'Ukrainian\', \'uk\'),
	(\'Urdu\', \'ur\'),
	(\'Uzbek\', \'uz\'),
	(\'Vietnamese\', \'vi\'),
	(\'Volapuk\', \'vo\'),
	(\'Welsh\', \'cy\'),
	(\'Wolof\', \'wo\'),
	(\'Xhosa\', \'xh\'),
	(\'Yiddish\', \'ji\'),
	(\'Yoruba\', \'yo\'),
	(\'Zulu\', \'zu\')
');

PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
#====================================================================#
