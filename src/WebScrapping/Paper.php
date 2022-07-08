<?php
namespace Galoa\ExerciciosPhp2022\WebScrapping;

class paper
{

    /**
     * paper id
     *
     * @var int
     */
    private $id;

    /**
     * title of the paper
     *
     * @var string
     */
    private $title;

    /**
     * type of the paper
     *
     * @var string
     */
    private $type;

    /**
     * array with the autors and their institutions
     *
     * @var array
     */
    private $authors;

    public function __construct(int $id, string $title, string $type, array $authors)
    {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type;
        $this->authors = $authors;
    }

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     *
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     *
     * @param array $authors
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
    }
}