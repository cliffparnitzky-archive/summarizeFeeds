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
 * @filesource
 */


/**
 * Back end modules
 */
 $GLOBALS['BE_MOD']['content']['summarizeFeeds'] = array
(
	'tables'	=> array('tl_summarizeFeeds'),
	'icon'		=> 'system/modules/summarizeFeeds/html/icon.png'
);

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = array('summarizeFeeds', 'parseFrontendTemplate');
$GLOBALS['TL_HOOKS']['removeOldFeeds'][]		= array('summarizeFeeds', 'getFeedNames');

/**
 * Cron jobs
 */
$GLOBALS['TL_CRON']['daily'][] = array('summarizeFeeds', 'deleteGenerateFeeds');
 
?>