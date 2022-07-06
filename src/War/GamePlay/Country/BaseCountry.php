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
    protected  $name;

    protected  array $neighbors = [];

    protected int $numberOfTroops = 3;

    protected  array $conqueredCountries = [];

    protected CountryInterface $conquered;

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
    
    public function setNumberofTroops(int $troops): void {
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

    public function getConquered(): CountryInterface
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

    public function conquer(CountryInterface $conqueredCountry): void
    {
        $neighborsConquered = $conqueredCountry->getNeighbors();
        $neighborsConquered = array_merge($this->neighbors, $neighborsConquered); # junta os vizinhos da sua cidade e do inimigo conquistado
        $neighborsConquered = array_unique($neighborsConquered,SORT_REGULAR); # remove duplicadas
        
        foreach ($neighborsConquered as $neighbor) { 
            if ($neighbor->getName() == $this->name || $conqueredCountry->getName()) {
                unset($neighbor);
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
