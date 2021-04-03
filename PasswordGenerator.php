<?php
/**
 * List of valid password generation types
 */
const TYPES = [
    'numbers',
    'letters',
    'no_symbols',
    'some_symbols',
    'all',
];

/**
 * Range of ascii codes for numbers
 */
const NUMBERS         = [48, 57];

/**
 * Range of ascii codes for capital letters
 */
const CAPITAL_LETTERS = [65, 90];

/**
 * Range of ascii codes for small letters
 */
const SMALL_LETTERS   = [97, 122];

/**
 * Range of ascii codes for all type
 */
const ALL             = [33, 126];

/**
 * The class 'PasswordGenerator' manages the random password generation.
 */
class PasswordGenerator
{
    /**
     * The password type to generate
     * (if symbols should contained etc.)
     * 
     * @var string
     */
    private string $type = '';

    /**
     * Password length
     * 
     * @var int
     */
    private int $length = 0;

    /**
     * Constructs an instance of 'PasswordGenerator'.
     *
     * @param string $type    password type
     * @param int    $length  password length (default = 8)
     */
    public function __construct(string $type, int $length = 8)
    {
        $this->setType($type);
        $this->setLength($length);
    }

    /**
     * Creates a password.
     *
     * @return string password
     */
    public function createPassword() : string
    {
        if ($this->type === 'numbers') {
            return $this->createPasswordNumbers();
        }
        if ($this->type === 'letters') {
            return $this->createPasswordLetters();
        }
        if ($this->type === 'no_symbols') {
            return $this->createPasswordNoSymbols();
        }
        if ($this->type === 'some_symbols') {
            return $this->createPasswordSomeSymbols();
        }
        if ($this->type === 'all') {
            return $this->createPasswordAll();
        }
        throw new RuntimeException('Cannot create password because of invalid type!');
    }

    /**
     * Creates a password which only contains numbers.
     *
     * @return string password
     */
    private function createPasswordNumbers() : string
    {
        $password = '';
        for ($i = 0; $i < $this->length; $i++) {
            $number    = rand(NUMBERS[0], NUMBERS[1]);
            $password .= chr($number);
        }
        return $password;
    }

    /**
     * Creates a password which only contains letters.
     *
     * @return string password
     */
    private function createPasswordLetters() : string
    {
        $password = '';
        for ($i = 0; $i < $this->length; $i++) {
            $number = rand(CAPITAL_LETTERS[0], CAPITAL_LETTERS[0] + 51);
            if ($number > CAPITAL_LETTERS[1]) {
                $number += (SMALL_LETTERS[0] - CAPITAL_LETTERS[1]);
            }
            $password .= chr($number);
        }
        return $password;
    }

    /**
     * Creates a password which contains numbers and letters.
     *
     * @return string password
     */
    private function createPasswordNoSymbols() : string
    {
        $password = '';
        for ($i = 0; $i < $this->length; $i++) {
            $number = rand(NUMBERS[0], NUMBERS[0] + 61);
            if ($number > NUMBERS[1]) {
                $number += (CAPITAL_LETTERS[0] - NUMBERS[1]);
            }
            if ($number > CAPITAL_LETTERS[1]) {
                $number += (SMALL_LETTERS[0] - CAPITAL_LETTERS[1]);
            }
            $password .= chr($number);
        }
        return $password;
    }

    /**
     * Creates a password which contains numbers, letters and usual symbols.
     *
     * @return string password
     */
    private function createPasswordSomeSymbols() : string
    {
        $password = '';
        for ($i = 0; $i < $this->length; $i++) {
            $number = rand(NUMBERS[0], NUMBERS[0] + 61);
            if ($number > NUMBERS[1]) {
                $number += (CAPITAL_LETTERS[0] - NUMBERS[1]);
            }
            if ($number > CAPITAL_LETTERS[1]) {
                $number += (SMALL_LETTERS[0] - CAPITAL_LETTERS[1]);
            }
            if ($number > SMALL_LETTERS[1]) {
                if ($number === SMALL_LETTERS[1] + 1) {
                    $number = 95;
                } else if ($number === SMALL_LETTERS[1] + 2) {
                    $number = 123;
                } else if ($number === SMALL_LETTERS[1] + 3) {
                    $number = 125;
                }
            }
            $password .= chr($number);
        }
        return $password;
    }

    /**
     * Creates a password which contains numbers, letters and all symbols.
     *
     * @return string password
     */
    private function createPasswordAll() : string
    {
        $password = '';
        for ($i = 0; $i < $this->length; $i++) {
            $number    = rand(ALL[0], ALL[1]);
            $password .= chr($number);
        }
        return $password;
    }

    /**
     * Sets the password type.
     *
     * @param string $type  type to set
     * @return self
     */
    private function setType(string $type) : self
    {
        foreach (TYPES as $validType) {
            if ($type === $validType) {
                $this->type = $type;
                return $this;
            }
        }
        throw new InvalidArgumentException('Invalid type!');
    }

    /**
     * Sets the password length.
     *
     * @param int $length  length to set
     * @return self
     */
    private function setLength(int $length) : self
    {
        if ($length < 1 || $length > 1000) {
            throw new InvalidArgumentException('Length must be between 1 and 1000');
        }
        $this->length = $length;
        return $this;
    }

}
