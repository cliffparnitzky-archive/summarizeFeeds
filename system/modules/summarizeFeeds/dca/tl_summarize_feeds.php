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
 * Table Backend-Tabellen 
 */
$GLOBALS['TL_DCA']['tl_summarize_feeds'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'			=> 'Table',
		'enableVersioning'		=> true,
		'onload_callback'		=> array
		(
			array('tl_summarize_feeds', 'updatePalette')
		),
		'onsubmit_callback' 	=> array
		(
			array('tl_summarize_feeds', 'generateFeed')
		),
		'ondelete_callback' 	=> array
		(
			array('tl_summarize_feeds', 'deleteFeed')
		)
	),
	
	// List
	'list' 	=> array
	(
		'sorting' => array
		(
			'mode'				=> 1,
			'flag'				=> 1,
			'panelLayout'		=> 'filter,limit',
			'fields'			=> array('title')
		),
		'label'	=> array
		(
			'fields'			=> array('title', 'language'),
			'format'			=> '%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>'
		),
		'global_operations'	=> array
		(
			'all' => array
			(
				'label'			=> &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'          => 'act=select',
				'class'         => 'header_edit_all',
				'attributes'	=> 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'			=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['edit'],
				'href'			=> 'act=edit',
				'icon'			=> 'edit.gif'
			),
			'copy' => array
			(
				'label'			=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['copy'],
				'href'			=> 'act=copy',
				'icon'			=> 'copy.gif'
			),
			'delete' => array
			(
				'label'			=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['delete'],
				'href'			=> 'act=delete',
				'icon'			=> 'delete.gif',
				'attributes'	=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'	=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['show'],
				'href'	=> 'act=show',
				'icon'	=> 'show.gif'
			)
		)
	),
	
	// Palettes
	'palettes' => array
	(
		'__selector__'			=> array('resource', 'source'),
		'default' 				=> '{resource_legend},resource',
		'newsteaser' 			=> '{resource_legend},resource,newsArchives;{title_legend},title,alias,description;{settings_legend},source,maxItems,language,format,feedBase',
		'calendarteaser' 		=> '{resource_legend},resource,calendar;{title_legend},title,alias,description;{settings_legend},source,maxItems,language,format,feedBase',
		'news4wardteaser' 		=> '{resource_legend},resource,news4wardArchives;{title_legend},title,alias,description;{settings_legend},source,maxItems,language,format,feedBase',
		'newstext' 				=> '{resource_legend},resource,newsArchives;{title_legend},title,alias,description;{settings_legend},source,letters,maxItems,language,format,feedBase',
		'calendartext' 			=> '{resource_legend},resource,calendar;{title_legend},title,alias,description;{settings_legend},source,letters,maxItems,language,format,feedBase',
		'news4wardtext' 		=> '{resource_legend},resource,news4wardArchives;{title_legend},title,alias,description;{settings_legend},source,letters,maxItems,language,format,feedBase'
	),

	// Fields
	'fields' => array
	(
		'resource' => array
		(
			'label'				=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource'],
			'inputType'			=> 'radio',
			'exclude'			=> true,
			'options'			=> array('news', 'calendar', 'news4ward'),
			'reference'			=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource_values'],
			'eval'				=> array('mandatory'=>true, 'submitOnChange'=>true)
		),
		'newsArchives' => array
		(
			'label'             => &$GLOBALS['TL_LANG']['tl_summarize_feeds']['newsArchives'],
			'exclude'           => true,
			'inputType'         => 'checkbox',
			'options_callback'	=> array('tl_summarize_feeds', 'getNewsArchives'),
			'eval'              => array('multiple'=>true, 'mandatory'=>true)
		),
		'calendar' => array
		(
			'label'             => &$GLOBALS['TL_LANG']['tl_summarize_feeds']['calendar'],
			'exclude'           => true,
			'inputType'         => 'checkbox',
			'options_callback'	=> array('tl_summarize_feeds', 'getCalendar'),
			'eval'              => array('multiple'=>true, 'mandatory'=>true)
		),
		'news4wardArchives' => array
		(
			'label'             => &$GLOBALS['TL_LANG']['tl_summarize_feeds']['news4wardArchives'],
			'exclude'           => true,
			'inputType'         => 'checkbox',
			'options_callback'	=> array('tl_summarize_feeds', 'getNews4WardArchives'),
			'eval'              => array('multiple'=>true, 'mandatory'=>true)
		),
		'title' => array
		(
			'label'				=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['title'],
			'exclude'			=> true,
			'search'			=> true,
			'inputType'			=> 'text',
			'eval'				=> array('mandatory'=>true, 'maxlength'=>255, 'doNotCopy'=>true, 'tl_class'=>'w50')
		),
		'alias' => array
		(
			'label'     		=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['alias'],
			'exclude'   		=> true,
			'inputType'			=> 'text',
			'eval'      		=> array('mandatory'=>true, 'rgxp'=>'alnum', 'unique'=>true, 'doNotCopy'=>true, 'spaceToUnderscore'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array
			(
				array('tl_summarize_feeds', 'checkFeedAlias')
			)
		),
		'description' => array
		(
			'label'     		=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['description'],
			'exclude'   		=> true,
			'inputType'			=> 'textarea',
			'eval'      		=> array('style'=>'height:60px;', 'tl_class'=>'clr')
		),
		'source' => array
		(
			'label'     		=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['source'],
			'default'   		=> 'teaser',
			'exclude'   		=> true,
			'inputType'			=> 'select',
			'options'   		=> array('teaser', 'text'),
			'reference' 		=> &$GLOBALS['TL_LANG']['tl_summarize_feeds'],
			'eval'      		=> array('submitOnChange'=>true)
		),
		'letters' => array
		(
			'label'				=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['letters'],
			'default'			=> 0,
			'exclude'			=> true,
			'inputType'			=> 'text',
			'eval'				=> array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50')
		),
		'maxItems' => array
		(
			'label'     		=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['maxItems'],
			'default'   		=> 25,
			'exclude'   		=> true,
			'inputType'			=> 'text',
			'eval'      		=> array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50')
		),
		'language' => array
		(
			'label'     		=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['language'],
			'exclude'   		=> true,
			'filter'			=> true,
			'inputType'			=> 'text',
			'eval'      		=> array('mandatory'=>true, 'maxlength'=>32, 'tl_class'=>'w50')
		),
		'format' => array
		(
			'label'				=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['format'],
			'default'   		=> 'rss',
			'exclude'   		=> true,
			'inputType'			=> 'select',
			'options'   		=> array('rss'=>'RSS 2.0', 'atom'=>'Atom'),
			'eval'      		=> array('tl_class'=>'w50')
		),
		'feedBase' => array
		(
			'label'     		=> &$GLOBALS['TL_LANG']['tl_summarize_feeds']['feedBase'],
			'default'   		=> $this->Environment->base,
			'exclude'   		=> true,
			'inputType'			=> 'text',
			'eval'      		=> array('trailingSlash'=>true, 'rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50')
		)
	)
);


/**
 * Class tl_summarize_feeds
 *
 * @copyright  Torben Stoffer 2009
 * @author     Torben Stoffer - torben@online.de 
 * @package    summarizeFeeds
 */
class tl_summarize_feeds extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	/**
	 * Get all news archives and return them as array
	 * @return array
	 */
	public function getNewsArchives()
	{
		if (!$this->User->isAdmin && !is_array($this->User->news))
		{
			return array();
		}

		$arrForms = array();
		$objForms = $this->Database->execute("SELECT id, title FROM tl_news_archive ORDER BY title");

		while ($objForms->next())
		{
			if ($this->User->isAdmin || in_array($objForms->id, $this->User->news))
			{
				$arrForms[$objForms->id] = $objForms->title;
			}
		}

		return $arrForms;
	}


	/**
	 * Get all calendars and return them as array
	 * @return array
	 */
	public function getCalendar()
	{
		if (!$this->User->isAdmin && !is_array($this->User->calendars))
		{
			return array();
		}

		$arrForms = array();
		$objForms = $this->Database->execute("SELECT id, title FROM tl_calendar ORDER BY title");

		while ($objForms->next())
		{
			if ($this->User->isAdmin || in_array($objForms->id, $this->User->calendars))
			{
				$arrForms[$objForms->id] = $objForms->title;
			}
		}

		return $arrForms;
	}
	
	/**
	 * Get all news archives and return them as array
	 * @return array
	 */
	public function getNews4WardArchives()
	{
		if (!$this->User->isAdmin && !is_array($this->User->news))
		{
		//	return array();
		}

		$arrForms = array();
		$objForms = $this->Database->execute("SELECT id, title FROM tl_news4ward ORDER BY title");

		while ($objForms->next())
		{
			if ($this->User->isAdmin || in_array($objForms->id, $this->User->news))
			{
				$arrForms[$objForms->id] = $objForms->title;
			}
		}

		return $arrForms;
	}
	
	/**
	 * Update the Palette
	 */
	public function updatePalette(DataContainer $dc) {
		if (!$dc->id)
		{
			return;
		}
		
		$objFeed = $this->Database->prepare("SELECT source FROM tl_summarize_feeds WHERE id=?")
									 ->limit(1)
									 ->execute($dc->id);
									 
		if ($objFeed->numRows > 0 AND $objFeed->source == 'text')
		{
			$GLOBALS['TL_DCA']['tl_summarize_feeds']['fields']['source']['eval']['tl_class']	= 'w50';
		}
	}


	/**
	 * Update the RSS-feed
	 * @param object
	 */
	public function generateFeed(DataContainer $dc)
	{
		if (!$dc->id)
		{
			return;
		}

		$this->import('summarizeFeeds');
		$this->summarizeFeeds->generateFeed($dc->id);
	}


	/**
	 * Delete the RSS-feed
	 * @param object
	 */
	public function deleteFeed(DataContainer $dc)
	{
		if (!$dc->id)
		{
			return;
		}

		$this->import('summarizeFeeds');
		$this->summarizeFeeds->deleteFeed($dc->id);
	}


	/**
	 * Check the RSS-feed alias
	 * @param object
	 * @throws Exception
	 */
	public function checkFeedAlias($varValue, DataContainer $dc)
	{
		// No change or empty value
		if ($varValue == $dc->value || $varValue == '')
		{
			return $varValue;
		}

		$arrFeeds = $this->removeOldFeeds(true);

		// Alias exists
		if (array_search($varValue, $arrFeeds) !== false)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		return $varValue;
	}
}

?>