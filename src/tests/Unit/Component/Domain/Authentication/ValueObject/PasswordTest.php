<?php

namespace LetEmTalk\Tests\Unit\Component\Domain\Authentication\ValueObject;

use LetEmTalk\Component\Domain\Authentication\ValueObject\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    private $rawPassword;

    private $password;

    /**
     * @test
     * @dataProvider wrongRawPassword
     */
    public function shouldExceptionWithWrongPassword($rawPassword)
    {
        $this->givenPassword($rawPassword);
        $this->thenExpectInvalidArgumentException();
        $this->whenCreatePassword();
    }

    /**
     * @test
     * @dataProvider correctRawPassword
     */
    public function shouldReturnPasswordWithCorrectPassword($rawPassword)
    {
        $this->givenPassword($rawPassword);
        $this->whenCreatePassword();
        $this->thenReturnRawPassword();
    }

    public function wrongRawPassword()
    {
        return [
            [""],
            ["a"],
            ["aa"],
            ["21"],
            ["lettersonly"],
            ["123456789"],
            ["...,,,###"],
            ["12345ab"],
            ["longlonglonglonglonglonglonglong1"],
            ["longlonglonglonglonglonglonglonglong"]
        ];
    }

    public function correctRawPassword()
    {
        return [
            ["hola3434"],
            ["letersand12345"],
            ["long1234long1234long1234long1234"],
            ["h2h2#.,.,"],
            ["1holahola"],
            ["1234567b"]
        ];
    }

    private function givenPassword(string $rawPassword)
    {
        $this->rawPassword = $rawPassword;
    }

    private function whenCreatePassword()
    {
        $this->password = new Password($this->rawPassword);
    }

    private function thenExpectInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
    }

    private function thenReturnRawPassword()
    {
        $this->assertEquals($this->rawPassword, $this->password->getPassword());
    }

}
