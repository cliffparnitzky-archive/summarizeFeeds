<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package SummarizeFeeds
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'NewsSummarizeFeeds' => 'system/modules/summarizeFeeds/classes/NewsSummarizeFeeds.php',
	'summarizeFeeds'     => 'system/modules/summarizeFeeds/summarizeFeeds.php',
));
