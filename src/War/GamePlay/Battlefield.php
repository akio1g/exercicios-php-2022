<?php
namespace Galoa\ExerciciosPhp2022\War\GamePlay;

use function Galoa\ExerciciosPhp2022\War\GamePlay\Battlefield\minValue;
use Galoa\ExerciciosPhp2022\War\GamePlay\Country\BaseCountry;
use function Galoa\ExerciciosPhp2022\War\GamePlay\Country\BaseCountry\getNumberOfTroops;
use function Galoa\ExerciciosPhp2022\War\GamePlay\Country\BaseCountry\killTroops;

/**
 * A manager that will roll the dice and compute the winners of a battle.
 */
class Battlefield implements BattlefieldInterface
{

    /**
     * Rolls the dice for a country.
     *
     * @param \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface $country
     *            The country that is rolling the dice.
     * @param bool $isAtacking
     *            TRUE if the dice is being rolled by the attacker, FALSE if by the
     *            defender.
     *            
     * @return int[] An array with values from 1-to-6. The array must have as many items as:
     *         - the number of troops of the country, when the defender is rolling
     *         the dice.
     *         - the number of troops of the country MINUS ONE, when the attacker is
     *         the one rolling the dice.
     */
    public function rollDice(BaseCountry $country, bool $isAtacking): array
    {
        $arrayWithDiceValues = []; # array who store the numbers of the dice
        if ($isAtacking) {
            for ($i = 1; $i < $country->getNumberOfTroops(); $i ++) {
                array_push($arrayWithDiceValues, rand(1, 6));
            }
        } else {
            for ($i = 1; $i <= $country->getNumberOfTroops(); $i ++) { # keeping one if its a defender
                array_push($arrayWithDiceValues, rand(1, 6));
            }
        }
        rsort($arrayWithDiceValues); # organize in reverse order
        return $arrayWithDiceValues;
    }

    public function computeBattle(BaseCountry $attackingCountry, array $attackingDice, BaseCountry $defendingCountry, array $defendingDice): void
    {
        $AttackCounter = 0; # count the win duels of the attacker
        $DefenderCounter = 0;# count the win duels of the defender
        $x = $this->minValue(sizeof($attackingDice), sizeof($defendingDice)); # get the size of the smallest array

        for ($i = 0; $i < $x; $i ++) {
            if ($defendingDice[$i] >= $attackingDice[$i]) { 
                $DefenderCounter += 1;
            } else {
                $AttackCounter += 1;
            }
        }
        $attackingCountry->killTroops($DefenderCounter);
        $defendingCountry->killTroops($AttackCounter);
    }

    /** # get the smallest int
     * 
     * 
     * @param int $at
     * @param int $df
     * @return int
     */
    private function minValue(int $at, int $df): int
    {
        if ($at > $df) {
            return $df;
        } else {
            return $at;
        }
    }
}
