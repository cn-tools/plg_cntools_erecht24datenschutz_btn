<?php
/**
 * plg_cntools_erecht24datenschutz_btn - Joomla Editor Button Plugin
 *
 * @package Joomla
 * @subpackage Plugin
 * @author Clemens Neubauer
 * @link https://github.com/cn-tools/
 * @license GNU/GPL, see LICENSE.php
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

defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgButtonplg_cntools_erecht24datenschutz_btn extends JPlugin
{
	function plgButtonplg_cntools_erecht24datenschutz_btn(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}

	function onDisplay($name)
    {
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();

		$token = md5($this->params->get('token'));

		if($app->isAdmin())
		{
			$link = '../plugins/editors-xtd/plg_cntools_erecht24datenschutz_btn/plg_cntools_erecht24datenschutz_btn.html.php?name='.$name.'&amp;token='.$token;
		}
		else
		{
			$link = 'plugins/editors-xtd/plg_cntools_erecht24datenschutz_btn/plg_cntools_erecht24datenschutz_btn.html.php?name='.$name.'&amp;token='.$token;
		}

		$btnName = trim($this->params->get('btnname'));
		if ($btnName == '') {$btnName = 'eRecht24';}

		$button = new JObject;
		$button->modal = true;
		$button->class = 'btn';
		$button->link  = $link;
		$button->text  = $btnName;
		$button->name  = 'book';
		$button->options = "{handler: 'iframe', size: {x: ". $this->params->get('width', '600') . ", y: ". $this->params->get('hight', '550') . "}}";

		return $button;
    }

}
