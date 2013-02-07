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
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['new']    = array('Neuer Feed', 'Erstellen Sie einen neuen Feed');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['show']   = array('Details', 'Details des Feeds ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['edit']   = array('Feed bearbeiten', 'Feed %s bearbeiten');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['copy']   = array('Feed kopieren', 'Feed %s duplizieren');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['delete'] = array('Feed l&ouml;schen', 'Feed ID %s l&ouml;schen');


/*
 * Legends
 */
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['resource_legend']	= 'Quelle';
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['title_legend']	= 'Titel und Beschreibung';
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['settings_legend']	= 'Einstellungen';
 
/*
 * Labels
 */
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['resource']		= array('Quelle', 'Bitte w&auml;hlen Sie aus, ob Sie News-Archive oder Kalender in einem Feed b&uuml;ndeln wollen.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['newsArchives'] 	= array('News-Archive', 'W&auml;hlen Sie die Newsarchive aus, aus denen der Feed erstellt werden soll.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['calendar']		= array('Kalender', 'W&auml;hlen Sie die Kalender aus, aus denen der Feed erstellt werden soll.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['title'] 			= array('Titel', 'Geben Sie einen eindeutigen Titel an.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['alias']          	= array('Alias', 'Hier können Sie einen eindeutigen Dateinamen (ohne Endung) eingeben. Die XML-Datei wird automatisch im Wurzelverzeichnis Ihrer TYPOlight-Installation erstellt, z.B. als <em>name.xml</em>.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['description']    = array('Beschreibung', 'Bitte geben Sie eine kurze Beschreibung des zusammengefassten Feeds ein.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['source']         	= array('Export-Einstellungen', 'Hier können Sie festlegen, was exportiert werden soll.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['letters']			= array('Beitrag k&uuml;rzen', 'Hier können Sie festlegen, nach wie vielen Buchstaben der Beitrag abgeschnitten werden soll. Der Beitrag wird nicht an der exakten Stelle, sondern beim n&auml;chsten Leerzeichen gek&uuml;rzt.<br />Geben Sie 0 ein, um den gesamten Beitrag zu verwenden.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['maxItems']       	= array('Maximale Anzahl an Beiträgen', 'Hier können Sie die Anzahl der Beiträge limitieren. Geben Sie 0 ein, um alle zu exportieren.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['language']       	= array('Sprache', 'Bitte geben Sie die Sprache der Seite gemäß des ISO-639 Standards ein (z.B. <em>de</em>, <em>de-ch</em>).');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['format']         	= array('Format', 'Bitte wählen Sie ein Format.');
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['feedBase']       	= array('Basis-URL', 'Bitte geben Sie die Basis-URL mit Protokoll (z.B. <em>http://</em>) ein.');

  
/**
 * References
 */
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['resource_values']['news']		= 'News-Archive';
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['resource_values']['calendar']	= 'Kalender';
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['teaser'] 						= 'Teasertexte';
$GLOBALS['TL_LANG']['tl_summarizeFeeds']['text']   						= 'Beiträge';

?>