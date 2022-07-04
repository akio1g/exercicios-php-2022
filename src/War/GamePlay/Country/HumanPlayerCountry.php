<?php
namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

/**
 * Defines a country that is managed by a human player.
 */
class HumanPlayerCountry extends BaseCountry
{

    public function chooseToAttack(): ?CountryInterface
    {
        $attackOrNot = rand(0, 1);
        if ($attackOrNot == 1) {
            $numberChose = rand(0, count($this->neighbors) - 1);
            if (empty(BaseCountry::$allConqueredCountries)) {
                return $this->neighbors[$numberChose];
            } else {
                $i = 0;
                do {
                    if ($this->neighbors[$numberChose] == BaseCountry::$allConqueredCountries[$i] && (count($this->neighbors) == 1)) {
                        return $this->neighbors[$numberChose]->getConquered(); // PRECISA IMPLEMENTAR UM JEITO DE ESCOLHER O CARA Q FOI DOMINADO
                    } elseif ($this->neighbors[$numberChose] == BaseCountry::$allConqueredCountries[$i]) {
                        $numberChose = rand(0, count($this->neighbors) - 1);
                        $i = 0;
                    } elseif ($this->neighbors[$numberChose] != BaseCountry::$allConqueredCountries[$i]) {
                        $i += 1;
                    } else {
                        return null;
                    }
                } while ($i == (sizeof(BaseCountry::$allConqueredCountries) - 1));
                return $this->neighbors[$numberChose];
            }
        } else {
            return null;
        }
    }
}
