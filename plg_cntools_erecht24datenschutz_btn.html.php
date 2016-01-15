<?php
/**
 * plg_cntools_erecht24datenschutz_btn - Joomla Editor Button Plugin
 *
 * @package    Joomla
 * @subpackage Plugin
 * @author Clemens Neubauer
 * @link https://github.com/cn-tools/
 * @license		GNU/GPL, see LICENSE.php
 *
 *  @license GNU/GPL
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

define('_JEXEC', 1);
define('JPATH_BASE', dirname(__FILE__).'/../../..');

// Deactivate error reporting to suppress possible warnings
ini_set('error_reporting', 0);

require_once JPATH_BASE . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'defines.php';
require_once JPATH_BASE . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'framework.php';

$mainframe = JFactory::getApplication('site');
$mainframe->initialise();

$plugin = JPluginHelper::getPlugin('editors-xtd', 'plg_cntools_erecht24datenschutz_btn');
$params = new JRegistry($plugin->params);
$paramCount = 0;

$token = htmlspecialchars($_GET['token']);

//-- Exit if token is empty or like example '2Had!ws5' in the language files --
if($token == 'd41d8cd98f00b204e9800998ecf8427e' OR $token == '03e2634ebe1fd572fac3f7a2c625f52d')
{
	echo 'Token wurde nicht festgelegt! Es muss in den Plug-In-Einstellungen ein Token eingegeben werden, um den Aufruf der Datei von außen zu unterbinden. Ohne Absicherung könnten Dritte von außen die Verzeichnisstruktur des Servers auslesen.';
	jexit();
}

//-- Check if token is correct else exit --------------------------------------
if($token != md5($params->get('token')))
{
	echo 'Token falsch!';
	jexit();
}
else
{
    $name = htmlspecialchars($_GET['name']);
}
?>

<?php
function doAddContent($params, $name, $label, $desc) {
?>
	<tr>
		<td><label id="<?php echo $name; ?>-lbl" for="<?php echo $name; ?>" class="tooltip" title="<?php echo $desc; ?>"><?php echo $label; ?>:&nbsp;&nbsp;</label></td>
		<td>
			<input name="<?php echo $name; ?>" <?php if ($params->get($name) != '2') { echo 'disabled';} ?> id="<?php echo $name; ?>" value="1" type="radio" <?php if ($params->get($name) == '1') { echo 'checked="checked"'; }?> />
			<label for="<?php echo $name; ?>">Ja</label>
			<input name="<?php echo $name; ?>" <?php if ($params->get($name) != '2') { echo 'disabled';} ?> id="<?php echo $name; ?>0" value="0" type="radio" <?php if ($params->get($name) != '1') { echo 'checked="checked"'; }?> />
			<label for="<?php echo $name; ?>2">Nein</label>
		</td>
		<td><?php if ($params->get($name) != '2') {?><span id="<?php echo $name; ?>-admlbl">&nbsp;&nbsp;Vom Admin vorgegeben!</span><?php } ?></td>
	</tr>
<?php
}
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title>Editor Button - CNTools - eRecht24 Parameter</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<script type="text/javascript" src="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF'])); ?>/../../../media/system/js/mootools-core.js"></script>
			<script type="text/javascript" src="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF'])); ?>/../../../media/system/js/mootools-more.js"></script>
			<script type="text/javascript">
                function insertParameter(editor)
                {
					var lValue = "";
					if (document.erecht24_parameter.standard[0].checked == true) { lValue = lValue + "&standard=1"; }
					if (document.erecht24_parameter.privacy[0].checked == true) { lValue = lValue + "&privacy=1"; }
					if (document.erecht24_parameter.facebook[0].checked == true) { lValue = lValue + "&facebook=1"; }
					if (document.erecht24_parameter.analytics[0].checked == true) { lValue = lValue + "&analytics=1"; }
					if (document.erecht24_parameter.plusone[0].checked == true) { lValue = lValue + "&plusone=1"; }
					//if (document.erecht24_parameter.adsense[0].checked == true) { lValue = lValue + "&adsense=1"; }
					//if (document.erecht24_parameter.remarketing[0].checked == true) { lValue = lValue + "&remarketing=1"; }
					if (document.erecht24_parameter.etracker[0].checked == true) { lValue = lValue + "&etracker=1"; }
					if (document.erecht24_parameter.twitter[0].checked == true) { lValue = lValue + "&twitter=1"; }
					if (document.erecht24_parameter.xing[0].checked == true) { lValue = lValue + "&xing=1"; }
					if (document.erecht24_parameter.instagram[0].checked == true) { lValue = lValue + "&instagram=1"; }
					if (document.erecht24_parameter.linkedin[0].checked == true) { lValue = lValue + "&linkedin=1"; }
					if (document.erecht24_parameter.pinterest[0].checked == true) { lValue = lValue + "&pinterest=1"; }
					if (document.erecht24_parameter.tumblr[0].checked == true) { lValue = lValue + "&tumblr=1"; }
					//if (document.erecht24_parameter.amazon[0].checked == true) { lValue = lValue + "&amazon=1"; }
					if (document.erecht24_parameter.infodelete[0].checked == true) { lValue = lValue + "&infodelete=1"; }
					if (document.erecht24_parameter.serverlogfiles[0].checked == true) { lValue = lValue + "&serverlogfiles=1"; }
					if (document.erecht24_parameter.cookies[0].checked == true) { lValue = lValue + "&cookies=1"; }
					if (document.erecht24_parameter.contactform[0].checked == true) { lValue = lValue + "&contactform=1"; }
					if (document.erecht24_parameter.advertemail[0].checked == true) { lValue = lValue + "&advertemail=1"; }
					if (document.erecht24_parameter.newsletter[0].checked == true) { lValue = lValue + "&newsletter=1"; }
					//if (document.erecht24_parameter.registration[0].checked == true) { lValue = lValue + "&registration=1"; }
					//if (document.erecht24_parameter.shops[0].checked == true) { lValue = lValue + "&shops=1"; }
					//if (document.erecht24_parameter.onlinecontracts[0].checked == true) { lValue = lValue + "&onlinecontracts=1"; }
					//if (document.erecht24_parameter.dataprocessing[0].checked == true) { lValue = lValue + "&dataprocessing=1"; }
					if (lValue!=""){
						lValue = "{ERecht24Datenschutz}" + lValue + "{/ERecht24Datenschutz}";
						//alert("Variable: "+lValue+"!"); //Testausgabe 
						window.parent.jInsertEditorText(lValue, '<?php echo preg_replace('#[^A-Z0-9\-\_\[\]]#i', '', $name); ?>');
					}
					window.parent.SqueezeBox.close();
					return false;
				}
            </script>
        </head>
		<?php
		$width = (int) $params->get('width', '550');
		$width = $width + 20;
		?>
        <body style="background-color: WhiteSmoke; font-family: Verdana; font-size: 80%; width: <?php echo $width; ?>px;">
            <form name="erecht24_parameter" action="">
                <div style="margin-left: 10px"><span title="Wählen Sie die gewünschten Einstellungen und klicken anschliessend 'Einfügen' um den entsprechenden Code einzufügen!">Bitte auswählen und abschliessend hier klicken:</span> - <button onclick="insertParameter();">Einfügen</button></div>
                <div id="e24rechtparams">
                    <table width="100%" style="border-spacing:10px">
                        <tbody>
							<?php
							doAddContent($params, 'standard', 'Disclaimer', '');
							doAddContent($params, 'privacy', 'Datenschutzerklärung', '');
							doAddContent($params, 'facebook', 'Facebook', '');
							doAddContent($params, 'analytics', 'Google Analytics', '');
							doAddContent($params, 'plusone', 'Google +1', '');
							//doAddContent($params, 'adsense', 'Google Adsense', '');
							//doAddContent($params, 'remarketing', 'Google Analytics Remarketing', '');
							doAddContent($params, 'etracker', 'etracker', '');
							doAddContent($params, 'twitter', 'Twitter', '');
							doAddContent($params, 'xing', 'Xing', '');
							doAddContent($params, 'instagram', 'Instagram', '');
							doAddContent($params, 'linkedin', 'Linkedin', '');
							doAddContent($params, 'pinterest', 'Pinterest', '');
							doAddContent($params, 'tumblr', 'Tumblr', '');
							//doAddContent($params, 'amazon', 'Amazon Partnerprogramm', '');
							doAddContent($params, 'infodelete', 'Auskunft, Löschung, Sperrung', '');
							doAddContent($params, 'serverlogfiles', 'Server-Log-Dateien', '');
							doAddContent($params, 'cookies', 'Cookies', '');
							doAddContent($params, 'contactform', 'Kontaktformular', '');
							doAddContent($params, 'advertemail', 'Werbe-E-Mails', '');
							doAddContent($params, 'newsletter', 'Newsletter', '');
							//doAddContent($params, 'registration', 'Nutzerregistrierung', '');
							//doAddContent($params, 'shops', 'Datenübermittlung - Online-Shops & Händler (mit Warenversand)', '');
							//doAddContent($params, 'onlinecontracts', 'Datenübermittlung - Dienstleister, die online Verträge schließen (ohne Warenversand)', '');
							//doAddContent($params, 'dataprocessing', 'Datenschutzerklärung zum Verarbeiten von Kunden- und Vertragsdaten', '');
							?>
                        </tbody>
                    </table>
                </div>
            </form>
        </body>
    </html>

