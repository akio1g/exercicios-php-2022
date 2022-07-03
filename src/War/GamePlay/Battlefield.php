<?php
namespace Galoa\ExerciciosPhp2022\War\GamePlay;

use function Galoa\ExerciciosPhp2022\War\GamePlay\Battlefield\minValue;
use Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface;
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
    public function rollDice(CountryInterface $country, bool $isAtacking): array
    {
        $arrayWithDiceValues = [];
        if ($isAtacking) {
            for ($i = 1; $i < $country . getNumberOfTroops(); $i ++) {
                array_push($arrayWithDiceValues, rand(1, 6));
            }
        } else {
            for ($i = 1; $i <= $country . getNumberOfTroops(); $i ++) {
                array_push($arrayWithDiceValues, rand(1, 6));
            }
        }
        rsort($arrayWithDiceValues);
        return $arrayWithDiceValues;
    }

    /**
     * Computes the winners and losers of a battle.
     *
     * @param \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface $attackingCountry
     *            The country that is attacking.
     * @param int[] $attackingDice
     *            The number
     * @param \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface $defendingCountry
     *            The country that is defending from the attack.
     */
    public function computeBattle(CountryInterface $attackingCountry, array $attackingDice, CountryInterface $defendingCountry, array $defendingDice): void
    {
        $AttackCounter = 0;
        $DefenderCounter = 0;
        $x = minValue($attackingDice.count(), $defendingDice.count());
        
        for ($i = 0; $i < $x; $i++){
            if ($defendingDice[$i] >= $attackingDice[$i]) {
                $DefenderCounter += 1;
            } else {
                $AttackCounter += 1;
            }
        }
        $attackingCountry.killTroops($DefenderCounter);
        $defendingCountry.killTroops($AttackCounter);
    }
        
    private function minValue(int $at, int $df): int {
        if ($at > $df) {
            return $df;
        } else {
            return $at;
        }
    }
}
