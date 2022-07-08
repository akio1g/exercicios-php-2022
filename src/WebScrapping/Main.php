<?php
namespace Galoa\ExerciciosPhp2022\WebScrapping;

use DOMDocument;

/**
 * Runner for the Webscrapping exercice.
 */
class Main
{

    /**
     * Main runner, instantiates a Scrapper and runs.
     */
    public static function run(): void
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->loadHTMLFile('F:/ws-php/exercicios-php-2022/webscrapping/origin.html');
        // (new Scrapper())->scrap($dom);

        $sc = new Scrapper();
        print_r($sc->getContent($dom));
    }
}
