<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../index.php';

class reverseTest extends TestCase
{
    public function testReverseSimpleWords()
    {
        $this->assertEquals('Tac', reverse('Cat'));
        $this->assertEquals('Ьшым', reverse('Мышь'));
    }

    public function testReverseWithPunctuation()
    {
        $this->assertEquals('tac,', reverse('cat,'));
        $this->assertEquals('Амиз:', reverse('Зима:'));
        $this->assertEquals("si 'dloc' won", reverse("is 'cold' now"));
        $this->assertEquals("Москва-река flowing through the city,", reverse("Авксом-акер gniwolf hguorht eht ytic,"));
    }

    public function testReverseWithHyphensAndApostrophes()
    {
        $this->assertEquals('driht-trap', reverse('third-part'));
        $this->assertEquals("nac`t", reverse("can`t"));
    }
}