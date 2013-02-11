<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
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

 
class summarizeFeeds extends Calendar
{
	/**
	 * Update a particular RSS feed
	 * @param integer
	 */
	public function generateFeed($intId)
	{
		$objFeed = $this->Database->prepare("SELECT * FROM tl_summarizeFeeds WHERE id=?")
									 ->limit(1)
									 ->execute($intId);

		if ($objFeed->numRows < 1)
		{
			return;
		}
		
		$objFeed->feedName = strlen($objFeed->alias) ? $objFeed->alias : 'feed' . $objFeed->id;
		
		// Update XML file
		$this->generateFile($objFeed->row());
		$this->log('Generated summarized feed "' . $objFeed->feedName . '.xml"', 'summarizeFeeds generateFeed()', TL_CRON);
	}


	/**
	 * Generate all feeds
	 */
	public function generateFeeds()
	{
		$objFeeds = $this->Database->execute("SELECT * FROM tl_summarizeFeeds");

		while ($objFeeds->next())
		{
			$objFeeds->feedName = strlen($objFeeds->alias) ? $objFeeds->alias : 'feed' . $objFeeds->id;
			
			$this->generateFile($objFeeds->row());
			$this->log('Generated summarized feed "' . $objFeeds->feedName.'.xml"', 'summarizeFeeds generateFeeds()', TL_CRON);
		}
	}

	
	/**
	 * Delete a particular RSS feed
	 * @param integer
	 */
	public function deleteFeed($intId)
	{
		$objFeed = $this->Database->prepare("SELECT * FROM tl_summarizeFeeds WHERE id=?")
									 ->limit(1)
									 ->execute($intId);

		if ($objFeed->numRows < 1)
		{
			return;
		}
		
		$objFeed->feedName = strlen($objFeed->alias) ? $objFeed->alias : 'feed' . $objFeed->id;
		
		// Delete XML file
		$this->import('Files');
		$this->Files->delete($objFeed->feedName.'.xml');
	}


	/**
	 * Delete and generate all feeds
	 */
	public function deleteGenerateFeeds()
	{
		$this->removeOldFeeds();
		$this->generateFeeds();
	}


	/**
	 * Get all feeds and return them in an array
	 */
	public function getFeedNames()
	{
		$objFeeds = $this->Database->execute("SELECT * FROM tl_summarizeFeeds");
		
		$feedNames = array();

		while ($objFeeds->next())
		{
			$feedNames[] = strlen($objFeeds->alias) ? $objFeeds->alias : 'feed'.$objFeeds->id;
		}
		
		return $feedNames;
	}

	
	/*
	 *
	 */
	protected function description($settings, $teaser, $text)
	{
		if($settings['source'] == 'text')
		{
			$letters = $settings['letters'];
			if($letters == 0)
			{
				return $text;
			}
			else
			{
				if(strlen(strip_tags($text)) < $letters + 10)
				{
					return $text;
				}
				else
				{
					return substr($text, 0, strpos($text, " ", $letters)) . '...';
				}
			}
		} 
		else
		{
			return $teaser;
		}
	}

	/**
	 * Generate an XML files and save them to the root directory
	 * @param array
	 */
	protected function generateFile($arrFeed)
	{
		$time = time();
		$this->arrEvents = array();
		$strType = ($arrFeed['format'] == 'atom') ? 'generateAtom' : 'generateRss';
		$strLink = strlen($arrFeed['feedBase']) ? $arrFeed['feedBase'] : $this->Environment->base;
		$strFile = $arrFeed['feedName'];

		$objFeed = new Feed($strFile);

		$objFeed->link = $strLink;
		$objFeed->title = $arrFeed['title'];
		$objFeed->description = $arrFeed['description'];
		$objFeed->language = $arrFeed['language'];
		$objFeed->published = $arrFeed['tstamp'];
		
		// Get items
		if($arrFeed['resource'] == 'news') {
			$archives = deserialize($arrFeed['newsArchives']);	
			
			if(count($archives) < 1 OR $strFile == '')
			{
				return;
			}
			
			$ids = '(pid='.implode(' OR pid=', $archives).')';
		
			$objNewsStmt = $this->Database->prepare("SELECT * FROM tl_news WHERE ".$ids." AND (start='' OR start<?) AND (stop='' OR stop>?) AND published=1 ORDER BY date DESC");

			if ($arrFeed['maxItems'] > 0)
			{
				$objNewsStmt->limit($arrFeed['maxItems']);
			}
			
			$objNews = $objNewsStmt->execute($time, $time);
			
			$this->import('newsSummarizeFeeds');

			// Parse items
			while ($objNews->next())
			{
				$objParent = $this->Database->prepare("SELECT jumpTo FROM tl_news_archive WHERE id=?")
											->limit(1)
											->execute($objNews->pid);
			
				// Get default URL
				$objPage = $this->Database->prepare("SELECT id, pid, alias FROM tl_page WHERE id=?")
											->limit(1)
											->execute($objParent->jumpTo);

				$strUrl = $this->generateFrontendUrl($objPage->fetchAssoc(), '/items/%s');
				
				// no chance to add event image ... not provided by core
				
				$objItem = new FeedItem();
				$objItem->title = $objNews->headline;
				$objItem->description = $this->description($arrFeed, $objNews->teaser, $objNews->text);
				$objItem->link = (($objNews->source == 'external') ? '' : $this->getRootDNS($objPage->pid, $strLink)) . $this->newsSummarizeFeeds->newsGetLink($objNews, $strUrl);
				$objItem->published = $objNews->date;

				// Enclosure
				if ($objNews->addEnclosure)
				{
					$arrEnclosure = deserialize($objNews->enclosure, true);

					if (is_array($arrEnclosure))
					{
						foreach ($arrEnclosure as $strEnclosure)
						{
							if (is_file(TL_ROOT . '/' . $strEnclosure))
							{				
								$objItem->addEnclosure($strEnclosure);
							}
						}
					}
				}
				
				$objFeed->addItem($objItem);
			}
		} elseif($arrFeed['resource'] == 'calendar') {
			$calendar = deserialize($arrFeed['calendar']);	
			
			if(count($calendar) < 1 OR $strFile == '')
			{
				return;
			}
			
			$ids = '(pid='.implode(' OR pid=', $calendar).')';
			
			$objEventStmt = $this->Database->prepare("SELECT * FROM tl_calendar_events WHERE  ".$ids." AND (startTime>=? OR (recurring=1 AND (recurrences=0 OR repeatEnd>=?))) AND (start='' OR start<?) AND (stop='' OR stop>?) AND published=1 ORDER BY startTime");

			if ($arrFeed['maxItems'] > 0)
			{
				$objEventStmt->limit($arrFeed['maxItems']);
			}

			$objEvent = $objEventStmt->execute($time, $time, $time, $time);
			
			$intRecord = 0;

			// Parse items
			while ($objEvent->next())
			{
				$objParent = $this->Database->prepare("SELECT jumpTo FROM tl_calendar WHERE id=?")
											->limit(1)
											->execute($objEvent->pid);
			
				// Get default URL
				$objPage = $this->Database->prepare("SELECT id, pid, alias FROM tl_page WHERE id=?")
											->limit(1)
											->execute($objParent->jumpTo);

				$strUrl = $this->generateFrontendUrl($objPage->fetchAssoc(), '/events/%s');
				
				$intStart = $objEvent->startTime;
				
				$this->addEvent($objEvent, $intStart, $objEvent->endTime, $strUrl, $strLink);
				
				// Add domain
				if($intStart > $time)
				{
					$intKey = date('Ymd', $intStart);
					$intCount = count($this->arrEvents[$intKey][$intStart]) - 1;
					$this->arrEvents[$intKey][$intStart][$intCount]['domain'] = $this->getRootDNS($objPage->pid, $strLink);
				}

				// Recurring events
				if ($objEvent->recurring)
				{
					$count = 0;
					$arrRepeat = deserialize($objEvent->repeatEach);

					// Do not include more than 20 recurrences
					while ($count++ < 20)
					{
						if ($objEvent->recurrences > 0 && $count >= $objEvent->recurrences)
						{
							break;
						}

						$arg = $arrRepeat['value'];
						$unit = $arrRepeat['unit'];

						$strtotime = '+ ' . $arg . ' ' . $unit;

						$objEvent->startTime = strtotime($strtotime, $objEvent->startTime);
						$objEvent->endTime = strtotime($strtotime, $objEvent->endTime);

						if ($objEvent->startTime > $time)
						{
							$intStart = $objEvent->startTime;
				
							$this->addEvent($objEvent, $intStart, $objEvent->endTime, $strUrl, $strLink);
							
							
							// Add domain
							$intKey = date('Ymd', $intStart);
							$intCount = count($this->arrEvents[$intKey][$intStart]) - 1;
							$this->arrEvents[$intKey][$intStart][$intCount]['domain'] = $this->getRootDNS($objPage->pid, $strLink);
						}
					}
				}
			}

			$count = 0;
			ksort($this->arrEvents);

			// Add feed items
			foreach ($this->arrEvents as $days)
			{
				foreach ($days as $events)
				{
					foreach ($events as $event)
					{
						if ($arrFeed['maxItems'] > 0 && $count++ >= $arrFeed['maxItems'])
						{
							break(3);
						}
						
						if (strlen($event['singleSRC']) > 1) {
							$image = (($event['source'] == 'external') ? '' : $strLink) . $this->getImage($event['singleSRC'], 250,null);
							$image = '<img src="' . $image . '" border="0" />' ;
						} else {
							$image = "";
						}

						$objItem = new FeedItem();
						$objItem->title = $event['title'];
						$objItem->description = $this->description($arrFeed, $event['teaser'], $event['description']);
						$objItem->link = $event['domain'] . $event['link'];
						$objItem->published = $event['published'];
						$objItem->start = $event['start'];
						$objItem->end = $event['end'];

						if (is_array($event['enclosure']))
						{
							foreach ($event['enclosure'] as $enclosure)
							{
								$objItem->addEnclosure($enclosure);
							}
						}

						$objFeed->addItem($objItem);
					}
				}
			}
		}
		
		$write = str_replace('</generator>', ' - Extension summarizeFeeds</generator>', $objFeed->$strType());
		
		// Create file
		$objRss = new File($strFile . '.xml');
		$objRss->write($this->replaceInsertTags($write));
		$objRss->close();
	}
	
	
	protected function getRootDNS($intId, $strLink) 
	{
		$objPage = $this->Database->prepare("SELECT pid, type, dns FROM tl_page WHERE id=?")
									 ->limit(1)
									 ->execute($intId);

		if ($objPage->numRows < 1)
		{
			return;
		}
		
		if($objPage->type == 'root')
		{
			if(strlen($objPage->dns) == 0)
				$dns = $strLink;
			else
			{
				if(strpos($objPage->dns, 'http://') === false)
					$dns = 'http://' . ((strpos($strLink, 'www') !== false AND strpos($objPage->dns, 'www') === false) ? 'www.' : '') . $objPage->dns . '/';
				else
					$dns = $objPage->dns . '/';
			}
		
			return $dns;
		}
		else
			return $this->getRootDNS($objPage->pid, $strLink);
	}
	
	
	/**
     * Get a page layout and return it as database result object.
     * This is a copy from PageRegular, see comments in parseFrontendTemplate() below for the reason why this is here.
     * @param integer
     * @return object
     */
    protected function getPageLayout($intId)
    {
        $objLayout = $this->Database->prepare("SELECT * FROM tl_layout WHERE id=?")
                                    ->limit(1)
                                    ->execute($intId);
		
        // Fallback layout
        if ($objLayout->numRows < 1)
        {
            $objLayout = $this->Database->prepare("SELECT * FROM tl_layout WHERE fallback=?")
                                        ->limit(1)
                                        ->execute(1);
        }
        
        // Die if there is no layout at all
        if ($objLayout->numRows < 1)
        {
            $this->log('Could not find layout ID "' . $intId . '"', 'PageRegular getPageLayout()', TL_ERROR);

            header('HTTP/1.1 501 Not Implemented');
            die('No layout specified');
        }

        return $objLayout;
    } 

        
    /**
     * get called by hook to inject all RSS feeds for the current layout into the template
     */
    public function parseFrontendTemplate($strBuffer, $strTemplate) {
        global $objPage;
		
        if(TL_MODE == 'FE' AND !isset($GLOBALS['TL_HEAD']['SUMMARIZE_FEEDS'])) {
            // here we are getting dirty, we have to import the page layout as we have no other way to get the layout from it.
            // I know it does exist already as we are being called from it but hey, we got no Hook in PageRegular::createStyleSheets
            // and therefore have to suffer the hard way... :(
            $objLayout = $this->getPageLayout($objPage->layout);

            $feedIDs = deserialize($objLayout->summarizeFeeds); 
            // Add summarized feeds
            if (is_array($feedIDs) && count($feedIDs) > 0)
            {
                $objFeeds = $this->Database->execute("SELECT * FROM tl_summarizeFeeds WHERE id IN(" . implode(',', $feedIDs) . ")");
				$head = '';
				
                while($objFeeds->next())
                {
                    $base 	 = strlen($objFeeds->feedBase) ? $objFeeds->feedBase : $this->Environment->base;
					$feedName = strlen($objFeeds->alias) ? $objFeeds->alias : 'feed' . $objFeeds->id;
					
                    $head 	.= '<link rel="alternate" href="'.$base.$feedName.'.xml" type="application/' . $objFeeds->format . '+xml" title="' . $objFeeds->title . '" />' . "\n";
                }
				
				$GLOBALS['TL_HEAD']['SUMMARIZE_FEEDS'] = $head;
            } 
        }
        // Return buffer no matter if we added something to the global array or not.
        // We simply to not want to tamper with it.
        return $strBuffer;
    }  
}


class newsSummarizeFeeds extends News
{
	public function newsGetLink(Database_Result $obj, $strUrl)
	{
		return $this->getLink($obj, $strUrl);
	}
}z

?>