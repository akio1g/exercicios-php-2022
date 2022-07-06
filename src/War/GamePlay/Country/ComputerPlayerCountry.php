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
        $attackOrNot = rand(0, 1);
        
        
        if ($attackOrNot == 1) { # ESCOLHE SE VAI ATACAR OU NAO
            $numberChose = rand(0, sizeof($this->neighbors) - 1); # escolhe o index pra escolher um inimigo
            $neighborChose = $this->neighbors[$numberChose];
            if ($neighborChose->isConquered()) { # # CALL TO A MEMEBER FUNCTION ON NULL
                return $neighborChose->getConquered();
            } else {
                return $neighborChose;
            }
        } else {
            return null;
        }
    }
}
