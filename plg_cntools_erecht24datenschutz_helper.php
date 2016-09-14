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

//header('Content-Type: application/json');
header('Content-type:application/json;charset=utf-8');

$mainframe = JFactory::getApplication('site');
$mainframe->initialise();

$plugin = JPluginHelper::getPlugin('editors-xtd', 'plg_cntools_erecht24datenschutz_btn');
$params = new JRegistry($plugin->params);
$paramCount = 0;

$lDoExit = false;
$token = htmlspecialchars($_GET['token']);

//-- Exit if token is empty or like example '2Had!ws5' in the language files --
if($token == 'd41d8cd98f00b204e9800998ecf8427e' OR $token == '03e2634ebe1fd572fac3f7a2c625f52d')
{
	echo 'Token wurde nicht festgelegt! Es muss in den Plug-In-Einstellungen ein Token eingegeben werden, um den Aufruf der Datei von außen zu unterbinden. Ohne Absicherung könnten Dritte von außen die Verzeichnisstruktur des Servers auslesen.';
	jexit();
}

//-- Exit if needed plug in is not installed ----------------------------------
$lNeededPlugin = JPluginHelper::getPlugin('content', 'plg_cntools_erecht24datenschutz');
if (isset($lNeededPlugin) and ($lNeededPlugin->name == 'plg_cntools_erecht24datenschutz'))
{
	$NeededParams = new JRegistry($lNeededPlugin->params);
	if ($NeededParams->get('plg_cntools_e24d_acknowledge') != '1')
	{
		echo 'Damit dieses Button-Plug-In ordnungsgemäss funktioniert, kontollieren Sie bitte beim Plug-In \'Content - CNTools - Integration E-Recht24 Haftungsausschluss und Datenschutzbestimmung\' die Einstellungen im Reiter \'Basiseinstellungen\' zum Punkt \'Bestätigung\'!';
		$lDoExit = true;
	}
} else {
	echo 'Dieses Button-Plug-In funktioniert nur in Kombination mit dem Plug-In <a href="https://github.com/cn-tools/plg_cntools_erecht24datenschutz" target="_blank">PLG_CNTOOLS_ERECHT24DATENSCHUTZ</a>!';
	$lDoExit = true;
}

//-- Check if token is correct else exit --------------------------------------
if($token != md5($params->get('token')))
{
	echo 'Token falsch!';
	$lDoExit = true;
}
else
{
    $name = htmlspecialchars($_GET['name']);
}

if (!$lDoExit)
{
	$data = array();

	if ($name != '')
	{
		$lValue = '{ERecht24Datenschutz}&' . $name . '=1{/ERecht24Datenschutz}';
		$data['code'] = $lValue;

/*		JPluginHelper::importPlugin('content');
		$lValue = JHtml::_('content.prepare', $lValue, '', 'plg_cntools_erecht24datenschutz_btn.content'); 		
		$data['result'] = $lValue;
*/
		$article = new stdClass;
		$article->text = $lValue;

		// add more to parameters if needed
		$params = new JObject;
		$params->plg_cntools_e24d_dopiwikrework = 0;
		$params->plg_cntools_e24d_target = 0;

		// Note JDispatcher is deprecated in favour of JEventDispatcher in Joomla 3.x however still works.
		JPluginHelper::importPlugin('content');
		$dispatcher = JEventDispatcher::getInstance();
		$dispatcher->trigger('onContentPrepare', array('plg_cntools_erecht24datenschutz_btn.'.$name, &$article, &$params, 0));

		$data['result'] = $article->text;
		
		unset($article);
		unset($params);
	}

	echo json_encode($data);
}

unset($NeededParams);
unset($lNeededPlugin);
jexit();
?>