<?php
namespace Galoa\ExerciciosPhp2022\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class SheetsController
{

    public function insertPaper(array $papers): void
    {
        $writer = WriterEntityFactory::createXLSXWriter();

        $writer->setCurrentSheet("F:/ws-php/exercicios-php-2022/webscrapping/papers.xlsx");
        foreach ($papers as $paper) {
            $row = WriterEntityFactory::createRowFromArray($paper);
            $writer->addRow($row);
        }

        $writer->close();
    }
}


