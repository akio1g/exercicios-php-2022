<?php
namespace Galoa\ExerciciosPhp2022\WebScrapping;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper
{

    /**
     * Loads paper information from the HTML and creates a XLSX file.
     */
    public function scrap(\DOMDocument $dom): void
    {
        print $dom->saveHTML();
    }

    /**
     * Get an array with all paper information  
     * 
     * @param \DOMDocument $dom
     * @return array
     */
    public function getContent(\DOMDocument $dom): array
    {
        $Papers = array(); ## array with all the papers info
        $divs = $dom->getElementsByTagName('div'); # array with all divs
        $NumberDiv = 0;

        foreach ($divs as $div) {
            $classDiv = $div->getAttribute('class');
            if ($classDiv == "col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4") {
                break;
            }
            $NumberDiv ++;
        }
        $classA = $divs->item($NumberDiv)->getElementsByTagName('a'); # array with all classes 'a'

        $indexPaper = 0;
        foreach ($classA as $a) {
            $arrayAuthors = array(); # array with authors and their titles
            $id = ''; # paper's id
            $type = ''; # type's id
            
            $classH4 = $classA->item($indexPaper)->getElementsByTagName('h4'); # get the h4
            $title = $classH4->nodeValue; # get the text of h4

            $classDiv = $classA->item($indexPaper)->getElementsByTagName('div'); # array with all classes 'div'
            $indexDiv = 0;
            foreach ($classDiv as $divInsideA) {
                $classAttribute = $divInsideA->getAttribute('class'); # get attribute of div class one by one;
                if ($classAttribute == 'authors') {
                    $classSpan = $classDiv->item($indexDiv)->getElementsByTagName('span'); # array with all classes 'span'
                    $indexSpan = 0;
                    foreach ($classSpan as $span) {
                        $titleAuthor = $classSpan->item($indexSpan)->getAttribute('title'); #get attribute title of span one by one
                        $author = $span->nodeValue; # get author of span one by one;

                        $arrayAuthors[$author] = $titleAuthor; # array with name and title of the author
                        $indexSpan ++;
                    }
                } else if ($classAttribute == 'tags mr-sm') { 
                    $type = $divInsideA->nodeValue; # get type of the paper
                } else if ($classAttribute == 'volume-info') {
                    $id = $divInsideA->nodeValue; # get id of the paper
                }
                $indexDiv ++;
            }
            $paper = new paper($id, $title, $type, $arrayAuthors);
            $Papers[$paper->getId()] = $paper;
            $indexPaper ++;
        }
        return $Papers;
    }
}
