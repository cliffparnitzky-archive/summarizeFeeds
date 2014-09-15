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
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_summarize_feeds']['new']    = array('New feed', 'Create a new feed');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['show']   = array('Details', 'Show the details of feed ID %s');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['edit']   = array('Edit feed', 'Edit archive ID %s');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['copy']   = array('Copy feed', 'Copy archive ID %s');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['delete'] = array('Delete feed', 'Delete archive ID %s');


/*
 * Legends
 */
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource_legend']	= 'Source';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['title_legend']	= 'Title and description';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['settings_legend']	= 'Settings';
 
/*
 * Labels
 */
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource']		= array('Source', 'Please choose a source from which the feed is build.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['newsArchives'] 	= array('News archives', 'Choose the news archives of which the feed is build.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['calendar'] 		= array('Calendars', 'Choose the calendars of which the feed is build.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['title'] 			= array('Title', 'Assign a unique title.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['alias']          	= array('Alias', 'Here you can enter a unique filename (without extension). The XML feed file will be auto-generated in the root directory of your TYPOlight installation, e.g. as <em>name.xml</em>.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['description']    	= array('Description', 'Please enter a short description of the summarized feed.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['source']         	= array('Export settings', 'Here you can choose what will be exported.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['letters']			= array('Abbreviate article', 'Here you can choose after how many letters the article should be abbreviated. Set to 0 to use the whole article.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['maxItems']       	= array('Maximum number of items', 'Here you can limit the number of feed items. Set to 0 to export all.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['language']       	= array('Language', 'Please enter the page language according to the ISO-639 standard (e.g. <em>en</em> or <em>en-us</em>).');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['format']         	= array('Format', 'Please choose a feed format.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['feedBase']       	= array('Base URL', 'Please enter the base URL with protocol (e.g. <em>http://</em>).');

  
/**
 * References
 */
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource_values']['news']		 = 'News archives';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource_values']['calendar']	 = 'Calendars';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource_values']['news4ward'] = 'News4ward';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['teaser'] 						 = 'Teasers';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['text']   						 = 'Article';

?>