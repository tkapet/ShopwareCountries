<?php
/**
* Der Klassenname der Bootstrap setzt sich immer aus den gleichen Bestandteilen zusammen und
* entspricht weitestgehend dem Pfad, in dem das Plugin liegt.
*
* Das Plugin \Shopware\Plugins\Commercial\Backend\SwagTest hat beispielsweise eine Bootstrap
* mit dem Namen Shopware_Plugins_Backend_SwagTest.
*
* Der Pfad-Bestandteil Local/Default/Community/Commercial wird nicht berücksichtigt,
* die Plugins können zwischen diesen Ordnern frei verschoben werden.
*
* Die Zuordnung zu einem der drei Bereiche Frontend/Backend/Core ist zwar obligatorisch
* hat aber keine funktionale Bedeutung - sie dient einzig einer groben Einordnung
* zur Übersicht.
*
*/
class Shopware_Plugins_Frontend_Countries_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    /**
     * In der getCapabilities-Methode kann der Entwickler beeinflussen,
     * welche Funktionen der PluginManager dem Nutzer zur Verfügung stellt:
     *
     * install: Ist es möglich, das Plugin zu (de)installieren?
     * enable: Ist es möglich, das Plugin zu (de)aktivieren?
     * update: Kann das Plugin aktualisiert werden?
     *
     */
    public function getCapabilities()
    {
        return array(
            'install' => true,
            'enable' => true,
            'update' => false
        );
    }
 
    /**
     * Gibt den Marketing-Namen des Plugins zurück.
     */
    public function getLabel()
    {
        return 'Länder';
    }
 
    /**
     * Gibt die Version des Plugins als String zurück
     */
    public function getVersion()
    {
        return "1.0.0";
    }
 
    /**
    * Gibt die gesammelten Plugin-Informationen zurück
    *
    */
    public function getInfo() {
        return array(
            // Die Plugin-Version.
            'version' => $this->getVersion(),
            // Copyright-Hinweis
            'copyright' => 'Copyright (c) 2014, graphodata AG',
            // Lesbarer Name des Plugins
            'label' => $this->getLabel(),
            // Info-Text, der in den Plugin-Details angezeigt wird
			'author' => 'Pieter Paßmann',
            'description' => file_get_contents($this->Path() . 'info.txt'),
            // Anlaufstelle für den Support
            'support' => 'http://graphodata.de',
            // Hersteller-Seite
            'link' => 'http://graphodata.de',
            // Änderungen
            'changes' => array(
                '1.0.0'=>array('releasedate'=>'2014-10-13', 'lines' => array(
                    'Tabelle leeren und neu befüllen mit aktueller Länderliste'
                ))
            ),
            // Aktuelle Revision des Plugins
            'revision' => '1'
        );
    }
 
    /**
     * Die Update-Methode wird ausgeführt, wenn ein bestehendes Plugin
     * durch den Nutzer aktualisiert wird.
     * War das Update erfolgreich, muss 'true' zurück gegeben werden
     */
    public function update($version)
    {
        // Hier können bspw. Änderungen an der Tabellenstruktur des Plugins
        // vorgenommen werden
        return true;
    }

	protected function getEntityManager()
    {
        return Shopware()->Models();
    }
 
    /**
     * Die Install-Methode wird bei der Installation des Plugins ausgeführt.
     * Hier wird bspw. die Datenstruktur des Plugins erzeugt.
     *
     * Auch das Generieren von Attribut-Models, das Erstellen der
     * Konfigurations-Elemente oder das Registrieren einer neuen
     * Zahlungsart geschieht zur Installationszeit
     */
    public function install()
    {
        //$this->subscribeEvents();
		$this->sqlUpdate();

        // Das zurückgegebene Boolean gibt darüber Auskunft, ob die Installation
        // erfolgreich war:
		return true;
 
        // Alternativ kann auch ein Array zurückgegeben werden:
        /*return array(
            'success' => false,
            'message' => 'ERROR see Bootstrap.php'
        );*/
    }
 
    /**
     * Die Uninstall-Methode wird ausgeführt, wenn ein Plugin durch den
     * Benutzer deinstalliert wird.
     * Hier können bspw. Datenstrukturen wieder entfernt werden.
     *
     */
    public function uninstall()
    {		
		$this->sqlRevert();
        return true;
    }
 
    /**
     * Helfer-Methode um das Plugin auf bestimmte Events zu registrieren
     */
    private function subscribeEvents()
    {

		return true;
    }

	private function sqlRevert()
	{
		$sql = "TRUNCATE TABLE `s_core_countries`; INSERT INTO `s_core_countries` (`id`, `countryname`, `countryiso`, `areaID`, `countryen`, `position`, `notice`, `shippingfree`, `taxfree`, `taxfree_ustid`, `taxfree_ustid_checked`, `active`, `iso3`, `display_state_in_registration`, `force_state_in_registration`) VALUES
		(2, 'Deutschland', 'DE', 1, 'GERMANY', 1, '', 0, 0, 0, 0, 1, 'DEU', 0, 0),
		(3, 'Arabische Emirate', 'AE', 2, 'ARAB EMIRATES', 10, '', 0, 0, 0, 0, 1, 'ARE', 0, 0),
		(4, 'Australien', 'AU', 2, 'AUSTRALIA', 10, '', 0, 0, 0, 0, 1, 'AUS', 0, 0),
		(5, 'Belgien', 'BE', 3, 'BELGIUM', 10, '', 0, 0, 0, 0, 1, 'BEL', 0, 0),
		(7, 'Dänemark', 'DK', 3, 'DENMARK', 10, '', 0, 0, 0, 0, 1, 'DNK', 0, 0),
		(8, 'Finnland', 'FI', 3, 'FINLAND', 10, '', 0, 0, 0, 0, 1, 'FIN', 0, 0),
		(9, 'Frankreich', 'FR', 3, 'FRANCE', 10, '', 0, 0, 0, 0, 1, 'FRA', 0, 0),
		(10, 'Griechenland', 'GR', 3, 'GREECE', 10, '', 0, 0, 0, 0, 1, 'GRC', 0, 0),
		(11, 'Großbritannien', 'GB', 3, 'GREAT BRITAIN', 10, '', 0, 0, 0, 0, 1, 'GBR', 0, 0),
		(12, 'Irland', 'IE', 3, 'IRELAND', 10, '', 0, 0, 0, 0, 1, 'IRL', 0, 0),
		(13, 'Island', 'IS', 3, 'ICELAND', 10, '', 0, 0, 0, 0, 1, 'ISL', 0, 0),
		(14, 'Italien', 'IT', 3, 'ITALY', 10, '', 0, 0, 0, 0, 1, 'ITA', 0, 0),
		(15, 'Japan', 'JP', 2, 'JAPAN', 10, '', 0, 0, 0, 0, 1, 'JPN', 0, 0),
		(16, 'Kanada', 'CA', 2, 'CANADA', 10, '', 0, 0, 0, 0, 1, 'CAN', 0, 0),
		(18, 'Luxemburg', 'LU', 3, 'LUXEMBOURG', 10, '', 0, 0, 0, 0, 1, 'LUX', 0, 0),
		(20, 'Namibia', 'NA', 2, 'NAMIBIA', 10, '', 0, 0, 0, 0, 1, 'NAM', 0, 0),
		(21, 'Niederlande', 'NL', 3, 'NETHERLANDS', 10, '', 0, 0, 0, 0, 1, 'NLD', 0, 0),
		(22, 'Norwegen', 'NO', 3, 'NORWAY', 10, '', 0, 0, 0, 0, 1, 'NOR', 0, 0),
		(23, 'Österreich', 'AT', 3, 'AUSTRIA', 1, '', 0, 0, 0, 0, 1, 'AUT', 0, 0),
		(24, 'Portugal', 'PT', 3, 'PORTUGAL', 10, '', 0, 0, 0, 0, 1, 'PRT', 0, 0),
		(25, 'Schweden', 'SE', 3, 'SWEDEN', 10, '', 0, 0, 0, 0, 1, 'SWE', 0, 0),
		(26, 'Schweiz', 'CH', 3, 'SWITZERLAND', 10, '', 0, 1, 0, 0, 1, 'CHE', 0, 0),
		(27, 'Spanien', 'ES', 3, 'SPAIN', 10, '', 0, 0, 0, 0, 1, 'ESP', 0, 0),
		(28, 'USA', 'US', 2, 'USA', 10, '', 0, 0, 0, 0, 1, 'USA', 0, 0),
		(29, 'Liechtenstein', 'LI', 3, 'LIECHTENSTEIN', 10, '', 0, 0, 0, 0, 1, 'LIE', 0, 0),
		(30, 'Polen', 'PL', 3, 'POLAND', 10, '', 0, 0, 0, 0, 1, 'POL', 0, 0),
		(31, 'Ungarn', 'HU', 3, 'HUNGARY', 10, '', 0, 0, 0, 0, 1, 'HUN', 0, 0),
		(32, 'Türkei', 'TR', 2, 'TURKEY', 10, '', 0, 0, 0, 0, 1, 'TUR', 0, 0),
		(33, 'Tschechien', 'CZ', 3, 'CZECH REPUBLIC', 10, '', 0, 0, 0, 0, 1, 'CZE', 0, 0),
		(34, 'Slowakei', 'SK', 3, 'SLOVAKIA', 10, '', 0, 0, 0, 0, 1, 'SVK', 0, 0),
		(35, 'Rum&auml;nien', 'RO', 3, 'ROMANIA', 10, '', 0, 0, 0, 0, 1, 'ROU', 0, 0),
		(36, 'Brasilien', 'BR', 2, 'BRAZIL', 10, '', 0, 0, 0, 0, 1, 'BRA', 0, 0),
		(37, 'Israel', 'IL', 2, 'ISRAEL', 10, '', 0, 0, 0, 0, 1, 'ISR', 0, 0)";

		Shopware()->Db()->query($sql);

		return true;
	}
	
	private function sqlUpdate()
	{
		#$sql = "TRUNCATE TABLE `s_core_countries`"
		#Shopware()->Db()->query($sql);

		$sql = "TRUNCATE TABLE `s_core_countries`; INSERT INTO `s_core_countries` (`countryname`, `countryiso`, `areaID`, `countryen`, `position`, `notice`, `shippingfree`, `taxfree`, `taxfree_ustid`, `taxfree_ustid_checked`, `active`, `iso3`, `display_state_in_registration`, `force_state_in_registration`) VALUES
		('Andorra','AD',2,'Andorra',10,'',0,0,0,0,1,'AND',0,0),
		('Vereinigte Arabische Emirate','AE',2,'United Arab Emirates',10,'',0,0,0,0,1,'ARE',0,0),
		('Afghanistan','AF',2,'Afghanistan',10,'',0,0,0,0,1,'AFG',0,0),
		('Antigua und Barbuda','AG',2,'Antigua and Barbuda',10,'',0,0,0,0,1,'ATG',0,0),
		('Anguilla','AI',2,'Anguilla',10,'',0,0,0,0,1,'AIA',0,0),
		('Albanien','AL',2,'Albania',10,'',0,0,0,0,1,'ALB',0,0),
		('Armenien','AM',2,'Armenia',10,'',0,0,0,0,1,'ARM',0,0),
		('Angola','AO',2,'Angola',10,'',0,0,0,0,1,'AGO',0,0),
		('Antarktika','AQ',2,'Antarctica',10,'',0,0,0,0,1,'ATA',0,0),
		('Argentinien','AR',2,'Argentina',10,'',0,0,0,0,1,'ARG',0,0),
		('Amerikanisch-Samoa','AS',2,'American Samoa',10,'',0,0,0,0,1,'ASM',0,0),
		('Österreich','AT',3,'Austria',10,'',0,0,0,0,1,'AUT',0,0),
		('Australien','AU',2,'Australia',10,'',0,0,0,0,1,'AUS',0,0),
		('Aruba','AW',2,'Aruba',10,'',0,0,0,0,1,'ABW',0,0),
		('Åland','AX',2,'Åland Islands',10,'',0,0,0,0,1,'ALA',0,0),
		('Aserbaidschan','AZ',2,'Azerbaijan',10,'',0,0,0,0,1,'AZE',0,0),
		('Bosnien und Herzegowina','BA',2,'Bosnia and Herzegovina',10,'',0,0,0,0,1,'BIH',0,0),
		('Barbados','BB',2,'Barbados',10,'',0,0,0,0,1,'BRB',0,0),
		('Bangladesch','BD',2,'Bangladesh',10,'',0,0,0,0,1,'BGD',0,0),
		('Belgien','BE',3,'Belgium',10,'',0,0,0,0,1,'BEL',0,0),
		('Burkina Faso','BF',2,'Burkina Faso',10,'',0,0,0,0,1,'BFA',0,0),
		('Bulgarien','BG',2,'Bulgaria',10,'',0,0,0,0,1,'BGR',0,0),
		('Bahrain','BH',2,'Bahrain',10,'',0,0,0,0,1,'BHR',0,0),
		('Burundi','BI',2,'Burundi',10,'',0,0,0,0,1,'BDI',0,0),
		('Benin','BJ',2,'Benin',10,'',0,0,0,0,1,'BEN',0,0),
		('Saint-Barthélemy','BL',2,'Saint Barthélemy',10,'',0,0,0,0,1,'BLM',0,0),
		('Bermuda','BM',2,'Bermuda',10,'',0,0,0,0,1,'BMU',0,0),
		('Brunei Darussalam','BN',2,'Brunei Darussalam',10,'',0,0,0,0,1,'BRN',0,0),
		('Bolivien','BO',2,'Bolivia, Plurinational State of',10,'',0,0,0,0,1,'BOL',0,0),
		('Brasilien','BR',2,'Brazil',10,'',0,0,0,0,1,'BRA',0,0),
		('Bahamas','BS',2,'Bahamas',10,'',0,0,0,0,1,'BHS',0,0),
		('Bhutan','BT',2,'Bhutan',10,'',0,0,0,0,1,'BTN',0,0),
		('Bouvetinsel','BV',2,'Bouvet Island',10,'',0,0,0,0,1,'BVT',0,0),
		('Botswana','BW',2,'Botswana',10,'',0,0,0,0,1,'BWA',0,0),
		('Belarus (Weißrussland)','BY',2,'Belarus',10,'',0,0,0,0,1,'BLR',0,0),
		('Belize','BZ',2,'Belize',10,'',0,0,0,0,1,'BLZ',0,0),
		('Kanada','CA',2,'Canada',10,'',0,0,0,0,1,'CAN',0,0),
		('Kokosinseln','CC',2,'Cocos (Keeling) Islands',10,'',0,0,0,0,1,'CCK',0,0),
		('Zentralafrikanische Republik','CF',2,'Central African Republic',10,'',0,0,0,0,1,'CAF',0,0),
		('Republik Kongo','CG',2,'Congo',10,'',0,0,0,0,1,'COG',0,0),
		('Schweiz (Confoederatio Helvetica)','CH',3,'Switzerland',10,'',0,1,0,0,1,'CHE',0,0),
		('Côte d’Ivoire (Elfenbeinküste)','CI',2,'Côte d\'Ivoire',10,'',0,0,0,0,1,'CIV',0,0),
		('Cookinseln','CK',2,'Cook Islands',10,'',0,0,0,0,1,'COK',0,0),
		('Chile','CL',2,'Chile',10,'',0,0,0,0,1,'CHL',0,0),
		('Kamerun','CM',2,'Cameroon',10,'',0,0,0,0,1,'CMR',0,0),
		('China, Volksrepublik','CN',2,'China',10,'',0,0,0,0,1,'CHN',0,0),
		('Kolumbien','CO',2,'Colombia',10,'',0,0,0,0,1,'COL',0,0),
		('Costa Rica','CR',2,'Costa Rica',10,'',0,0,0,0,1,'CRI',0,0),
		('Kuba','CU',2,'Cuba',10,'',0,0,0,0,1,'CUB',0,0),
		('Kap Verde','CV',2,'Cabo Verde',10,'',0,0,0,0,1,'CPV',0,0),
		('Curaçao','CW',2,'Curaçao',10,'',0,0,0,0,1,'CUW',0,0),
		('Weihnachtsinsel','CX',2,'Christmas Island',10,'',0,0,0,0,1,'CXR',0,0),
		('Zypern','CY',2,'Cyprus',10,'',0,0,0,0,1,'CYP',0,0),
		('Tschechische Republik','CZ',3,'Czech Republic',10,'',0,0,0,0,1,'CZE',0,0),
		('Deutschland','DE',1,'Germany',1,'',0,0,0,0,1,'DEU',0,0),
		('Dschibuti','DJ',2,'Djibouti',10,'',0,0,0,0,1,'DJI',0,0),
		('Dänemark','DK',3,'Denmark',10,'',0,0,0,0,1,'DNK',0,0),
		('Dominica','DM',2,'Dominica',10,'',0,0,0,0,1,'DMA',0,0),
		('Dominikanische Republik','DO',2,'Dominican Republic',10,'',0,0,0,0,1,'DOM',0,0),
		('Algerien','DZ',2,'Algeria',10,'',0,0,0,0,1,'DZA',0,0),
		('Ecuador','EC',2,'Ecuador',10,'',0,0,0,0,1,'ECU',0,0),
		('Estland','EE',2,'Estonia',10,'',0,0,0,0,1,'EST',0,0),
		('Ägypten','EG',2,'Egypt',10,'',0,0,0,0,1,'EGY',0,0),
		('Westsahara','EH',2,'Western Sahara',10,'',0,0,0,0,1,'ESH',0,0),
		('Eritrea','ER',2,'Eritrea',10,'',0,0,0,0,1,'ERI',0,0),
		('Spanien','ES',3,'Spain',10,'',0,0,0,0,1,'ESP',0,0),
		('Äthiopien','ET',2,'Ethiopia',10,'',0,0,0,0,1,'ETH',0,0),
		('Finnland','FI',3,'Finland',10,'',0,0,0,0,1,'FIN',0,0),
		('Fidschi','FJ',2,'Fiji',10,'',0,0,0,0,1,'FJI',0,0),
		('Falklandinseln','FK',2,'Falkland Islands (Malvinas)',10,'',0,0,0,0,1,'FLK',0,0),
		('Mikronesien','FM',2,'Micronesia, Federated States of',10,'',0,0,0,0,1,'FSM',0,0),
		('Färöer','FO',2,'Faroe Islands',10,'',0,0,0,0,1,'FRO',0,0),
		('Frankreich','FR',3,'France',10,'',0,0,0,0,1,'FRA',0,0),
		('Gabun','GA',2,'Gabon',10,'',0,0,0,0,1,'GAB',0,0),
		('Vereinigtes Königreich Großbritannien und Nordirland','GB',3,'United Kingdom',10,'',0,0,0,0,1,'GBR',0,0),
		('Grenada','GD',2,'Grenada',10,'',0,0,0,0,1,'GRD',0,0),
		('Georgien','GE',2,'Georgia',10,'',0,0,0,0,1,'GEO',0,0),
		('Französisch-Guayana','GF',2,'French Guiana',10,'',0,0,0,0,1,'GUF',0,0),
		('Guernsey (Kanalinsel)','GG',2,'Guernsey',10,'',0,0,0,0,1,'GGY',0,0),
		('Ghana','GH',2,'Ghana',10,'',0,0,0,0,1,'GHA',0,0),
		('Gibraltar','GI',2,'Gibraltar',10,'',0,0,0,0,1,'GIB',0,0),
		('Grönland','GL',2,'Greenland',10,'',0,0,0,0,1,'GRL',0,0),
		('Gambia','GM',2,'Gambia',10,'',0,0,0,0,1,'GMB',0,0),
		('Guinea','GN',2,'Guinea',10,'',0,0,0,0,1,'GIN',0,0),
		('Guadeloupe','GP',2,'Guadeloupe',10,'',0,0,0,0,1,'GLP',0,0),
		('Äquatorialguinea','GQ',2,'Equatorial Guinea',10,'',0,0,0,0,1,'GNQ',0,0),
		('Griechenland','GR',2,'Greece',10,'',0,0,0,0,1,'GRC',0,0),
		('Guatemala','GT',2,'Guatemala',10,'',0,0,0,0,1,'GTM',0,0),
		('Guam','GU',2,'Guam',10,'',0,0,0,0,1,'GUM',0,0),
		('Guinea-Bissau','GW',2,'Guinea-Bissau',10,'',0,0,0,0,1,'GNB',0,0),
		('Guyana','GY',2,'Guyana',10,'',0,0,0,0,1,'GUY',0,0),
		('Hongkong','HK',2,'Hong Kong',10,'',0,0,0,0,1,'HKG',0,0),
		('Honduras','HN',2,'Honduras',10,'',0,0,0,0,1,'HND',0,0),
		('Kroatien','HR',2,'Croatia',10,'',0,0,0,0,1,'HRV',0,0),
		('Haiti','HT',2,'Haiti',10,'',0,0,0,0,1,'HTI',0,0),
		('Ungarn','HU',3,'Hungary',10,'',0,0,0,0,1,'HUN',0,0),
		('Indonesien','ID',2,'Indonesia',10,'',0,0,0,0,1,'IDN',0,0),
		('Irland','IE',3,'Ireland',10,'',0,0,0,0,1,'IRL',0,0),
		('Israel','IL',2,'Israel',10,'',0,0,0,0,1,'ISR',0,0),
		('Insel Man','IM',2,'Isle of Man',10,'',0,0,0,0,1,'IMN',0,0),
		('Indien','IN',2,'India',10,'',0,0,0,0,1,'IND',0,0),
		('Irak','IQ',2,'Iraq',10,'',0,0,0,0,1,'IRQ',0,0),
		('Iran, Islamische Republik','IR',2,'Iran, Islamic Republic of',10,'',0,0,0,0,1,'IRN',0,0),
		('Island','IS',3,'Iceland',10,'',0,0,0,0,1,'ISL',0,0),
		('Italien','IT',3,'Italy',10,'',0,0,0,0,1,'ITA',0,0),
		('Jersey (Kanalinsel)','JE',2,'Jersey',10,'',0,0,0,0,1,'JEY',0,0),
		('Jamaika','JM',2,'Jamaica',10,'',0,0,0,0,1,'JAM',0,0),
		('Jordanien','JO',2,'Jordan',10,'',0,0,0,0,1,'JOR',0,0),
		('Japan','JP',2,'Japan',10,'',0,0,0,0,1,'JPN',0,0),
		('Kenia','KE',2,'Kenya',10,'',0,0,0,0,1,'KEN',0,0),
		('Kirgisistan','KG',2,'Kyrgyzstan',10,'',0,0,0,0,1,'KGZ',0,0),
		('Kambodscha','KH',2,'Cambodia',10,'',0,0,0,0,1,'KHM',0,0),
		('Kiribati','KI',2,'Kiribati',10,'',0,0,0,0,1,'KIR',0,0),
		('Komoren','KM',2,'Comoros',10,'',0,0,0,0,1,'COM',0,0),
		('St. Kitts und Nevis','KN',2,'Saint Kitts and Nevis',10,'',0,0,0,0,1,'KNA',0,0),
		('Korea, Demokratische Volksrepublik (Nordkorea)','KP',2,'Korea, Democratic People\'s Republic of',10,'',0,0,0,0,1,'PRK',0,0),
		('Korea, Republik (Südkorea)','KR',2,'Korea, Republic of',10,'',0,0,0,0,1,'KOR',0,0),
		('Kuwait','KW',2,'Kuwait',10,'',0,0,0,0,1,'KWT',0,0),
		('Kaimaninseln','KY',2,'Cayman Islands',10,'',0,0,0,0,1,'CYM',0,0),
		('Kasachstan','KZ',2,'Kazakhstan',10,'',0,0,0,0,1,'KAZ',0,0),
		('Laos, Demokratische Volksrepublik','LA',2,'Lao People\'s Democratic Republic',10,'',0,0,0,0,1,'LAO',0,0),
		('Libanon','LB',2,'Lebanon',10,'',0,0,0,0,1,'LBN',0,0),
		('St. Lucia','LC',2,'Saint Lucia',10,'',0,0,0,0,1,'LCA',0,0),
		('Liechtenstein','LI',3,'Liechtenstein',10,'',0,0,0,0,1,'LIE',0,0),
		('Sri Lanka','LK',2,'Sri Lanka',10,'',0,0,0,0,1,'LKA',0,0),
		('Liberia','LR',2,'Liberia',10,'',0,0,0,0,1,'LBR',0,0),
		('Lesotho','LS',2,'Lesotho',10,'',0,0,0,0,1,'LSO',0,0),
		('Litauen','LT',2,'Lithuania',10,'',0,0,0,0,1,'LTU',0,0),
		('Luxemburg','LU',3,'Luxembourg',10,'',0,0,0,0,1,'LUX',0,0),
		('Lettland','LV',2,'Latvia',10,'',0,0,0,0,1,'LVA',0,0),
		('Libyen','LY',2,'Libya',10,'',0,0,0,0,1,'LBY',0,0),
		('Marokko','MA',2,'Morocco',10,'',0,0,0,0,1,'MAR',0,0),
		('Monaco','MC',2,'Monaco',10,'',0,0,0,0,1,'MCO',0,0),
		('Moldawien (Republik Moldau)','MD',2,'Moldova, Republic of',10,'',0,0,0,0,1,'MDA',0,0),
		('Montenegro','ME',2,'Montenegro',10,'',0,0,0,0,1,'MNE',0,0),
		('Madagaskar','MG',2,'Madagascar',10,'',0,0,0,0,1,'MDG',0,0),
		('Marshallinseln','MH',2,'Marshall Islands',10,'',0,0,0,0,1,'MHL',0,0),
		('Mazedonien','MK',2,'Macedonia, the former Yugoslav Republic of',10,'',0,0,0,0,1,'MKD',0,0),
		('Mali','ML',2,'Mali',10,'',0,0,0,0,1,'MLI',0,0),
		('Myanmar (Burma)','MM',2,'Myanmar',10,'',0,0,0,0,1,'MMR',0,0),
		('Mongolei','MN',2,'Mongolia',10,'',0,0,0,0,1,'MNG',0,0),
		('Macao','MO',2,'Macao',10,'',0,0,0,0,1,'MAC',0,0),
		('Nördliche Marianen','MP',2,'Northern Mariana Islands',10,'',0,0,0,0,1,'MNP',0,0),
		('Martinique','MQ',2,'Martinique',10,'',0,0,0,0,1,'MTQ',0,0),
		('Mauretanien','MR',2,'Mauritania',10,'',0,0,0,0,1,'MRT',0,0),
		('Montserrat','MS',2,'Montserrat',10,'',0,0,0,0,1,'MSR',0,0),
		('Malta','MT',2,'Malta',10,'',0,0,0,0,1,'MLT',0,0),
		('Mauritius','MU',2,'Mauritius',10,'',0,0,0,0,1,'MUS',0,0),
		('Malediven','MV',2,'Maldives',10,'',0,0,0,0,1,'MDV',0,0),
		('Malawi','MW',2,'Malawi',10,'',0,0,0,0,1,'MWI',0,0),
		('Mexiko','MX',2,'Mexico',10,'',0,0,0,0,1,'MEX',0,0),
		('Malaysia','MY',2,'Malaysia',10,'',0,0,0,0,1,'MYS',0,0),
		('Mosambik','MZ',2,'Mozambique',10,'',0,0,0,0,1,'MOZ',0,0),
		('Namibia','NA',2,'Namibia',10,'',0,0,0,0,1,'NAM',0,0),
		('Neukaledonien','NC',2,'New Caledonia',10,'',0,0,0,0,1,'NCL',0,0),
		('Niger','NE',2,'Niger',10,'',0,0,0,0,1,'NER',0,0),
		('Norfolkinsel','NF',2,'Norfolk Island',10,'',0,0,0,0,1,'NFK',0,0),
		('Nigeria','NG',2,'Nigeria',10,'',0,0,0,0,1,'NGA',0,0),
		('Nicaragua','NI',2,'Nicaragua',10,'',0,0,0,0,1,'NIC',0,0),
		('Niederlande','NL',3,'Netherlands',10,'',0,0,0,0,1,'NLD',0,0),
		('Norwegen','NO',3,'Norway',10,'',0,0,0,0,1,'NOR',0,0),
		('Nepal','NP',2,'Nepal',10,'',0,0,0,0,1,'NPL',0,0),
		('Nauru','NR',2,'Nauru',10,'',0,0,0,0,1,'NRU',0,0),
		('Niue','NU',2,'Niue',10,'',0,0,0,0,1,'NIU',0,0),
		('Neuseeland','NZ',2,'New Zealand',10,'',0,0,0,0,1,'NZL',0,0),
		('Oman','OM',2,'Oman',10,'',0,0,0,0,1,'OMN',0,0),
		('Panama','PA',2,'Panama',10,'',0,0,0,0,1,'PAN',0,0),
		('Peru','PE',2,'Peru',10,'',0,0,0,0,1,'PER',0,0),
		('Französisch-Polynesien','PF',2,'French Polynesia',10,'',0,0,0,0,1,'PYF',0,0),
		('Papua-Neuguinea','PG',2,'Papua New Guinea',10,'',0,0,0,0,1,'PNG',0,0),
		('Philippinen','PH',2,'Philippines',10,'',0,0,0,0,1,'PHL',0,0),
		('Pakistan','PK',2,'Pakistan',10,'',0,0,0,0,1,'PAK',0,0),
		('Polen','PL',3,'Poland',10,'',0,0,0,0,1,'POL',0,0),
		('Saint-Pierre und Miquelon','PM',2,'Saint Pierre and Miquelon',10,'',0,0,0,0,1,'SPM',0,0),
		('Pitcairninseln','PN',2,'Pitcairn',10,'',0,0,0,0,1,'PCN',0,0),
		('Puerto Rico','PR',2,'Puerto Rico',10,'',0,0,0,0,1,'PRI',0,0),
		('Portugal','PT',3,'Portugal',10,'',0,0,0,0,1,'PRT',0,0),
		('Palau','PW',2,'Palau',10,'',0,0,0,0,1,'PLW',0,0),
		('Paraguay','PY',2,'Paraguay',10,'',0,0,0,0,1,'PRY',0,0),
		('Katar','QA',2,'Qatar',10,'',0,0,0,0,1,'QAT',0,0),
		('Réunion','RE',2,'Réunion',10,'',0,0,0,0,1,'REU',0,0),
		('Rumänien','RO',3,'Romania',10,'',0,0,0,0,1,'ROU',0,0),
		('Serbien','RS',2,'Serbia',10,'',0,0,0,0,1,'SRB',0,0),
		('Russische Föderation','RU',2,'Russian Federation',10,'',0,0,0,0,1,'RUS',0,0),
		('Ruanda','RW',2,'Rwanda',10,'',0,0,0,0,1,'RWA',0,0),
		('Saudi-Arabien','SA',2,'Saudi Arabia',10,'',0,0,0,0,1,'SAU',0,0),
		('Salomonen','SB',2,'Solomon Islands',10,'',0,0,0,0,1,'SLB',0,0),
		('Seychellen','SC',2,'Seychelles',10,'',0,0,0,0,1,'SYC',0,0),
		('Sudan','SD',2,'Sudan',10,'',0,0,0,0,1,'SDN',0,0),
		('Schweden','SE',2,'Sweden',10,'',0,0,0,0,1,'SWE',0,0),
		('Singapur','SG',2,'Singapore',10,'',0,0,0,0,1,'SGP',0,0),
		('Slowenien','SI',2,'Slovenia',10,'',0,0,0,0,1,'SVN',0,0),
		('Slowakei','SK',3,'Slovakia',10,'',0,0,0,0,1,'SVK',0,0),
		('Sierra Leone','SL',2,'Sierra Leone',10,'',0,0,0,0,1,'SLE',0,0),
		('San Marino','SM',2,'San Marino',10,'',0,0,0,0,1,'SMR',0,0),
		('Senegal','SN',2,'Senegal',10,'',0,0,0,0,1,'SEN',0,0),
		('Somalia','SO',2,'Somalia',10,'',0,0,0,0,1,'SOM',0,0),
		('Suriname','SR',2,'Suriname',10,'',0,0,0,0,1,'SUR',0,0),
		('Südsudan','SS',2,'South Sudan',10,'',0,0,0,0,1,'SSD',0,0),
		('El Salvador','SV',2,'El Salvador',10,'',0,0,0,0,1,'SLV',0,0),
		('Syrien, Arabische Republik','SY',2,'Syrian Arab Republic',10,'',0,0,0,0,1,'SYR',0,0),
		('Swasiland','SZ',2,'Swaziland',10,'',0,0,0,0,1,'SWZ',0,0),
		('Turks- und Caicosinseln','TC',2,'Turks and Caicos Islands',10,'',0,0,0,0,1,'TCA',0,0),
		('Tschad','TD',2,'Chad',10,'',0,0,0,0,1,'TCD',0,0),
		('Togo','TG',2,'Togo',10,'',0,0,0,0,1,'TGO',0,0),
		('Thailand','TH',2,'Thailand',10,'',0,0,0,0,1,'THA',0,0),
		('Tadschikistan','TJ',2,'Tajikistan',10,'',0,0,0,0,1,'TJK',0,0),
		('Tokelau','TK',2,'Tokelau',10,'',0,0,0,0,1,'TKL',0,0),
		('Osttimor (Timor-Leste)','TL',2,'Timor-Leste',10,'',0,0,0,0,1,'TLS',0,0),
		('Turkmenistan','TM',2,'Turkmenistan',10,'',0,0,0,0,1,'TKM',0,0),
		('Tunesien','TN',2,'Tunisia',10,'',0,0,0,0,1,'TUN',0,0),
		('Tonga','TO',2,'Tonga',10,'',0,0,0,0,1,'TON',0,0),
		('Türkei','TR',2,'Turkey',10,'',0,0,0,0,1,'TUR',0,0),
		('Trinidad und Tobago','TT',2,'Trinidad and Tobago',10,'',0,0,0,0,1,'TTO',0,0),
		('Tuvalu','TV',2,'Tuvalu',10,'',0,0,0,0,1,'TUV',0,0),
		('Republik China (Taiwan)','TW',2,'Taiwan, Province of China',10,'',0,0,0,0,1,'TWN',0,0),
		('Tansania, Vereinigte Republik','TZ',2,'Tanzania, United Republic of',10,'',0,0,0,0,1,'TZA',0,0),
		('Ukraine','UA',2,'Ukraine',10,'',0,0,0,0,1,'UKR',0,0),
		('Uganda','UG',2,'Uganda',10,'',0,0,0,0,1,'UGA',0,0),
		('United States Minor Outlying Islands','UM',2,'United States Minor Outlying Islands',10,'',0,0,0,0,1,'UMI',0,0),
		('Vereinigte Staaten von Amerika','US',2,'United States',10,'',0,0,0,0,1,'USA',0,0),
		('Uruguay','UY',2,'Uruguay',10,'',0,0,0,0,1,'URY',0,0),
		('Usbekistan','UZ',2,'Uzbekistan',10,'',0,0,0,0,1,'UZB',0,0),
		('Vatikanstadt','VA',2,'Holy See (Vatican City State)',10,'',0,0,0,0,1,'VAT',0,0),
		('St. Vincent und die Grenadinen','VC',2,'Saint Vincent and the Grenadines',10,'',0,0,0,0,1,'VCT',0,0),
		('Venezuela','VE',2,'Venezuela, Bolivarian Republic of',10,'',0,0,0,0,1,'VEN',0,0),
		('Britische Jungferninseln','VG',2,'Virgin Islands, British',10,'',0,0,0,0,1,'VGB',0,0),
		('Amerikanische Jungferninseln','VI',2,'Virgin Islands, U.S.',10,'',0,0,0,0,1,'VIR',0,0),
		('Vietnam','VN',2,'Viet Nam',10,'',0,0,0,0,1,'VNM',0,0),
		('Vanuatu','VU',2,'Vanuatu',10,'',0,0,0,0,1,'VUT',0,0),
		('Wallis und Futuna','WF',2,'Wallis and Futuna',10,'',0,0,0,0,1,'WLF',0,0),
		('Samoa','WS',2,'Samoa',10,'',0,0,0,0,1,'WSM',0,0),
		('Jemen','YE',2,'Yemen',10,'',0,0,0,0,1,'YEM',0,0),
		('Mayotte','YT',2,'Mayotte',10,'',0,0,0,0,1,'MYT',0,0),
		('Südafrika','ZA',2,'South Africa',10,'',0,0,0,0,1,'ZAF',0,0),
		('Sambia','ZM',2,'Zambia',10,'',0,0,0,0,1,'ZMB',0,0),
		('Simbabwe','ZW',2,'Zimbabwe',10,'',0,0,0,0,1,'ZWE',0,0)
		";
		Shopware()->Db()->query($sql);

		return true;
	}

	

}
