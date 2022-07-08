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
     * @return \Galoa\ExerciciosPhp2022\War\GamePlay\Country\BaseCountry|null The country that will be attacked, NULL if none will be.
     */
    public function chooseToAttack(): ?BaseCountry
    {
        $attackOrNot = rand(0, 1);
        
        
        if ($attackOrNot == 1) { # choose if will attack or not
            $numberChose = rand(0, sizeof($this->neighbors) - 1); # choose the index in the array neighbors
            $neighborChose = $this->neighbors[$numberChose];
            if ($neighborChose->isConquered()) { # if the country chose is conquered, choose the country who conquered the country chose
                return $neighborChose->getConquered();
            } else {
                return $neighborChose;
            }
        } else {
            return null;
        }
    }
}
