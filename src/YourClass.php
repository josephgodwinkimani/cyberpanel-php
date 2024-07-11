<?php

namespace Gkimani\Skeleton;

class YourClass
{
    /**
     * Greets the provided name.
     *
     * @param string $name The name to greet.
     * @return string The greeting message.
     */
    public function greet(string $name): string
    {
        return "Hello, $name!";
    }

    /**
     * Calculates the sum of two numbers.
     *
     * @param float $a The first number.
     * @param float $b The second number.
     * @return float The sum of the two numbers.
     */
    public function add(float $a, float $b): float
    {
        return $a + $b;
    }
}
