<?php
namespace Galoa\ExerciciosPhp2022\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class SheetsController
{
    /**
     *  insert the papers data into a sheet
     * 
     * @param array $papers
     */
    public function insertPaper(array $papers): void
    {
        $writer = WriterEntityFactory::createXLSXWriter();

        $writer->openToFile('F:/ws-php/exercicios-php-2022/webscrapping/papers.xlsx'); # defines the path of the sheet
        $arrayTitle = ['ID','Title','Type']; # create an array with the header
        for ($i = 1; $i <= 10; $i++) {
            array_push($arrayTitle, 'Author ' . $i);
            array_push($arrayTitle, 'Author ' . $i . ' Institution');
        }
        $rowTitle = WriterEntityFactory::createRowFromArray($arrayTitle); 
        $writer->addRow($rowTitle); # insert the array 
        foreach ($papers as $paper) {
            $arrayAuthor = array_keys($paper->getAuthors()); 
            $arrayInstitution = array_values($paper->getAuthors());
            $arrayMerged = array();
            
            for ($i = 0; $i < sizeof($arrayAuthor); $i++) {
                array_push($arrayMerged, $arrayAuthor[$i]);
                array_push($arrayMerged, $arrayInstitution[$i]);
            }
            
            $arrayPaper = [$paper->getId(),$paper->getTitle(), $paper->getType()];
            
            for ($j = 0; $j < sizeof($arrayMerged); $j++) {
                array_push($arrayPaper, $arrayMerged[$j]);
            }
            
            $row = WriterEntityFactory::createRowFromArray($arrayPaper);
            $writer->addRow($row);
        }

        $writer->close();
    }
}


