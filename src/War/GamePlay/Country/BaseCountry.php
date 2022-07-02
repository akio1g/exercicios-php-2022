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
     *
     * The neighbors of a country.
     *
     * @var array
     */
    protected $neighbors;

    /**
     *
     * The number of troops in this country.
     *
     * @var int
     */
    protected $numberOfTroops;

    /**
     * Builder.
     *
     * @param string $name
     *            The name of the country.
     * @param array $neighbors
     *            The neighbors of a country.
     * @param int $numberOfTroops
     *            The nuber of troops in this country.
     */
    public function __construct(string $name, array $neighbors, int $numberOfTroops)
    {
        $this->name = $name;
        $this->neighbors = $neighbors;
        $this->numberOfTroops = $numberOfTroops;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumberOfTroops(): int
    {
        return $this->numberOfTroops;
    }

    public function getNeighbors(): array
    {
        return $this->neighbors;
    }

    public function setNeighbors(array $neighbors): void
    {
        $this->neighbors = $neighbors;
    }

    public function killTroops(int $killedTroops): void
    {
        $this->numberOfTroops -= $killedTroops;
    }

    public function conquer(CountryInterface $conqueredCountry): void
    {
        $neighbors = getNeighbors();
        $neighborsConquered = $conqueredCountry . getNeighbors();
        $newNeighbors = array_merge($neighbors, $neighborsConquered); # junta as duas listas
        
        $newNeighbors = array_unique($newNeighbors); # remove duplicadas
        
        for($i = 0; $i < count($newNeighbors); ++$i){ # remove o pais conquistado da lista
            if($newNeighbors[$i] == $conqueredCountry.getName()){
                unset($neighbors[$i]);
                break;
            }
        }
    }

    public function isConquered(): bool
    {
        if ($this->numberOfTroops <= 0) {
            return true;
        }
        return false;
    }
}
