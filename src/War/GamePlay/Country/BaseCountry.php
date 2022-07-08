<?php
namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

/**
 * Defines a country, that is also a player.
 */
class BaseCountry implements CountryInterface
{

    /**
     * The name of the country.
     *
     * @var string
     */
    protected $name;

    /**
     * Array of neighbors of the country.
     *
     * @var array
     */
    protected array $neighbors = [];

    /**
     * Number of Troops of the country.
     * 
     * @var integer
     */
    protected int $numberOfTroops = 3;

    /**
     * Country who conquered this country.
     * 
     * @var BaseCountry
     */
    protected BaseCountry $conquered;

    
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumberOfTroops(): int
    {
        return $this->numberOfTroops;
    }

    public function setNumberofTroops(int $troops): void
    {
        $this->numberOfTroops += $troops;
    }

    public function getNeighbors(): array
    {
        return $this->neighbors;
    }

    public function setNeighbors(array $neighbors): void
    {
        $this->neighbors = $neighbors;
    }

    public function getConquered(): BaseCountry
    {
        return $this->conquered;
    }

    public function setConquered($conquered): void
    {
        $this->conquered = $conquered;
    }

    public function killTroops(int $killedTroops): void
    {
        $this->numberOfTroops -= $killedTroops;
    }

    public function conquer(BaseCountry $conqueredCountry): void
    {
        $neighborsConquered = $conqueredCountry->getNeighbors(); // get the neighbors of the conquered country
        $neighborsConquered = array_merge($this->neighbors, $neighborsConquered); // merge both arrays of the neighbors
        $neighborsConquered = array_unique($neighborsConquered, SORT_REGULAR); // remove the duplicates

        foreach ($neighborsConquered as $neighbor) {
            if ($neighbor->getName() == $this->name) { // remove the country that conquer from the array neighbors
                unset($neighbor);
                break;
            }
        }

        $this->setNeighbors($neighborsConquered);
    }

    public function isConquered(): bool
    {
        if ($this->numberOfTroops < 1) {
            return true;
        }
        return false;
    }
}
