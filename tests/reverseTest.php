<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../index.php';

class reverseTest extends TestCase
{
    public function testReverseSimpleWords()
    {
        $this->assertEquals('Tac', reverseEachWordPreserve('Cat'));
        $this->assertEquals('Ьшым', reverseEachWordPreserve('Мышь'));
    }

    public function testReverseWithPunctuation()
    {
        $this->assertEquals('tac,', reverseEachWordPreserve('cat,'));
        $this->assertEquals('Амиз:', reverseEachWordPreserve('Зима:'));
        $this->assertEquals("si 'dloc' won", reverseEachWordPreserve("is 'cold' now"));
        $this->assertEquals("Москва-река flowing through the city,", reverseEachWordPreserve("Авксом-акер gniwolf hguorht eht ytic,"));
    }

    public function testReverseWithHyphensAndApostrophes()
    {
        $this->assertEquals('driht-trap', reverseEachWordPreserve('third-part'));
        $this->assertEquals("tna`c", reverseEachWordPreserve("can`t"));
    }

    public function testEmptyString()
    {
        $this->assertEquals("", reverseEachWordPreserve(""));
    }

    public function testOnlyPunctuation()
    {
        $this->assertEquals("...?!", reverseEachWordPreserve("...?!"));
    }

    public function testThrowsErrorOnInvalidInput()
    {
        $this->expectException(TypeError::class);
        reverseEachWordPreserve(null); // передаём не строку
    }
}