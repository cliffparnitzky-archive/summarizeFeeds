<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Torben Stoffer 2009
 * @author     Torben Stoffer - torben@online.de 
 * @package    summarizeFeeds 
 * @license    LGPL 
 */

/**
 * Palettes
 */
 
foreach($GLOBALS['TL_DCA']['tl_layout']['palettes'] as $k => $v) 
{
	if($k != "__selector__")
	{
		$GLOBALS['TL_DCA']['tl_layout']['palettes'][$k] = str_replace('calendarfeeds', 'calendarfeeds,summarizeFeeds', $v);
	}
}


/**
 * Fields
 */ 
 
$GLOBALS['TL_DCA']['tl_layout']['fields']['summarizeFeeds'] = array(
	'label'             => &$GLOBALS['TL_LANG']['tl_layout']['summarizeFeeds'],
	'exclude'           => true,
	'inputType'         => 'checkbox',
	'options_callback'	=> array('tl_layout_summarizeFeeds', 'getSummarizedFeeds'),
	'eval'              => array('multiple'=>true)
);


/**
 * Class tl_layout_summarizeFeeds
 *
 * @copyright  Torben Stoffer 2009
 * @author     Torben Stoffer - torben@online.de 
 * @package    summarizeFeeds
 */
class tl_layout_summarizeFeeds extends Backend
{

	/**
	 * Get all summarized feeds and return them as array
	 * @return array
	 */
	public function getSummarizedFeeds()
	{
		$arrFeeds = array();
		$objFeeds = $this->Database->execute("SELECT id, title FROM tl_summarize_feeds ORDER BY title");

		while ($objFeeds->next())
		{
			$arrFeeds[$objFeeds->id] = $objFeeds->title;
		}

		return $arrFeeds;
	}
}
	
?>