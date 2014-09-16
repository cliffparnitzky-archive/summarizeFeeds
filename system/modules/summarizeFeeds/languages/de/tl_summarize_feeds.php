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
$GLOBALS['TL_LANG']['tl_summarize_feeds']['new']    = array('Neuer Feed', 'Erstellen Sie einen neuen Feed');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['show']   = array('Details', 'Details des Feeds ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['edit']   = array('Feed bearbeiten', 'Feed %s bearbeiten');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['copy']   = array('Feed kopieren', 'Feed %s duplizieren');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['delete'] = array('Feed l&ouml;schen', 'Feed ID %s l&ouml;schen');


/*
 * Legends
 */
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource_legend']	= 'Quelle';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['title_legend']	= 'Titel und Beschreibung';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['settings_legend']	= 'Einstellungen';
 
/*
 * Labels
 */
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource']		= array('Quelle', 'Bitte w&auml;hlen Sie aus, ob Sie News-Archive oder Kalender in einem Feed b&uuml;ndeln wollen.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['newsArchives'] 	= array('News-Archive', 'W&auml;hlen Sie die Newsarchive aus, aus denen der Feed erstellt werden soll.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['calendar']		= array('Kalender', 'W&auml;hlen Sie die Kalender aus, aus denen der Feed erstellt werden soll.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['news4Archives']	= array('News4Ward Beitragsarchive', 'W&auml;hlen Sie die News4Ward Beitragsarchive aus, aus denen der Feed erstellt werden soll.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['title'] 			= array('Titel', 'Geben Sie einen eindeutigen Titel an.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['alias']          	= array('Alias', 'Hier können Sie einen eindeutigen Dateinamen (ohne Endung) eingeben. Die XML-Datei wird automatisch im Wurzelverzeichnis Ihrer TYPOlight-Installation erstellt, z.B. als <em>name.xml</em>.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['description']    = array('Beschreibung', 'Bitte geben Sie eine kurze Beschreibung des zusammengefassten Feeds ein.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['source']         	= array('Export-Einstellungen', 'Hier können Sie festlegen, was exportiert werden soll.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['letters']			= array('Beitrag k&uuml;rzen', 'Hier können Sie festlegen, nach wie vielen Buchstaben der Beitrag abgeschnitten werden soll. Der Beitrag wird nicht an der exakten Stelle, sondern beim n&auml;chsten Leerzeichen gek&uuml;rzt.<br />Geben Sie 0 ein, um den gesamten Beitrag zu verwenden.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['maxItems']       	= array('Maximale Anzahl an Beiträgen', 'Hier können Sie die Anzahl der Beiträge limitieren. Geben Sie 0 ein, um alle zu exportieren.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['language']       	= array('Sprache', 'Bitte geben Sie die Sprache der Seite gemäß des ISO-639 Standards ein (z.B. <em>de</em>, <em>de-ch</em>).');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['format']         	= array('Format', 'Bitte wählen Sie ein Format.');
$GLOBALS['TL_LANG']['tl_summarize_feeds']['feedBase']       	= array('Basis-URL', 'Bitte geben Sie die Basis-URL mit Protokoll (z.B. <em>http://</em>) ein.');

  
/**
 * References
 */
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource_values']['news']		= 'News-Archive';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource_values']['calendar']	= 'Kalender';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['resource_values']['news4'] 		= 'News4Ward Beitragsarchive';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['teaser'] 						= 'Teasertexte';
$GLOBALS['TL_LANG']['tl_summarize_feeds']['text']   						= 'Beiträge';

?>