<?php
namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

/**
 * Defines a country that is managed by the Computer.
 */
class ComputerPlayerCountry extends BaseCountry
{

    /**
     * Choose one country to attack, or none.
     *
     * The computer may choose to attack or not. If it chooses not to attack,
     * return NULL. If it chooses to attack, return a neighbor to attack.
     *
     * It must NOT be a conquered country.
     *
     * @return \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface|null The country that will be attacked, NULL if none will be.
     */
    public function chooseToAttack(): ?CountryInterface
    {
        $neighborChose = "";
        $attackOrNot = rand(0, 1);
        if ($attackOrNot == 1) {
            $neighborConquered = true;
            do {
                $neighborChose = $this->neighbors[rand(0, count($this->neighbors))];
                foreach ($this->conqueredCountries as $country) {
                    if ($country.getName() == $neighborChose) {
                        $neighborConquered = true;
                    } else {
                        $neighborConquered = false;
                    }
                }
            } while ($neighborConquered == true);
            
            foreach($this->neighbors as $i){
                if($i.getName() == $neighborChose) {
                    $countryOjbectChose = $i;
                }
            }
            return $countryOjbectChose;
        }
    }
}
