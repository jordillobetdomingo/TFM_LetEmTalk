<?php

namespace LetEmTalk\Tests\Unit\Component\Domain\User\ValueObject;

use LetEmTalk\Component\Domain\User\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    private String $rawEmail;

    private Email $email;

    /**
     * @test
     * @dataProvider wrongRawEmail
     */
    public function shouldExceptionWithIncorrectRawEmail($rawEmail)
    {
        $this->givenRawEmail($rawEmail);
        $this->thenExpectInvalidArgumentException();
        $this->whenCreateEmail();
    }

    /**
     * @test
     * @dataProvider correctRawEmail
     */
    public function shouldHasEmailWithCorrectRawEmail($rawEmail)
    {
        $this->givenRawEmail($rawEmail);
        $this->whenCreateEmail();
        $this->thenReturnRawEmail();
    }

    public function wrongRawEmail()
    {
        return [[""], ["email"], ["email@email"], ["@example.com"], ["example@example@example.com"]];
    }

    public function correctRawEmail()
    {
        return [["example@example.com"], ["exa@exa.com"], ["example.other@example.com"], ["example@other.other.com"]];
    }

    private function givenRawEmail(string $rawEmail): void
    {
        $this->rawEmail = $rawEmail;
    }

    private function thenExpectInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
    }

    private function whenCreateEmail()
    {
        $this->email = new Email($this->rawEmail);
    }

    private function thenReturnRawEmail()
    {
        $this->assertEquals($this->rawEmail, $this->email->getEmail());
    }

}
