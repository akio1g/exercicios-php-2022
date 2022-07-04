<?php
namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

/**
 * Defines a country, that is also a player.
 */
class BaseCountry implements CountryInterface
{
    public static array $allConqueredCountries = [];
    /**
     * The name of the country.
     *
     * @var string
     */
    protected $name;

    protected array $neighbors = [];

    protected int $numberOfTroops = 3;

    protected array $conqueredCountries = [];

    public CountryInterface $conquered;

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

    public function getConqueredCountries(): array
    {
        return $this->conqueredCountries;
    }

    public function setConqueredCountries(CountryInterface $country): void
    {
        array_push($this->conqueredCountries, $country);
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
        $newNeighbors = array_merge($this->neighbors, $neighborsConquered); # junta as duas listas

        $newNeighbors = array_unique($newNeighbors,SORT_REGULAR); # remove duplicadas
        
        for($i=0; $i < sizeof($newNeighbors); $i++){
            if ($newNeighbors[$i] == $this){
                unset($newNeighbors[$i]);
                break;
            }
        }
        
        
        $this->neighbors = $newNeighbors;
        $this->setConqueredCountries($conqueredCountry);
        $conqueredCountry->setConquered($this);
        array_push(BaseCountry::$allConqueredCountries,$conqueredCountry); 
    }

    public function isConquered(): bool
    {
        if ($this->numberOfTroops < 1) {
            return true;
        }
        return false;
    }
}
