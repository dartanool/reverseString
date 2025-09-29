<?php
function reverseEachWordPreserve(string $str)
{
    //Разбиение по пробелам
    $tokens = preg_split('/(\s+)/u', $str, -1, PREG_SPLIT_DELIM_CAPTURE);
    $result = '';

    foreach ($tokens as $token) {
        if (preg_match('/^\s+$/u', $token)) {
            $result .= $token;
        } else {
            $result .= processWordWithSeparators($token);
        }
    }
    return $result;
}

//Разбиение по девисам и апострофам
function processWordWithSeparators(string $word) : string
{
    $parts = preg_split("/(['-])/u", $word, -1, PREG_SPLIT_DELIM_CAPTURE);
    $processed = '';

    foreach ($parts as $part) {
        if ($part === '-' || $part === "'")  {
            $processed .= $part;
        } else {
            $processed .= reverseWordPreserve($part);
        }
    }
    return $processed;
}

//Переворачивание букв
function reverseWordPreserve(string $word) : string{
    $chars = [];
    for ($i = 0; $i < mb_strlen($word); $i++) {
        $chars[] = mb_substr($word, $i, 1);
    }

    $left = 0;
    $right = count($chars) - 1;
    while ($left < $right) {
        if (!isLetter($chars[$left])) {
            $left++;
        } elseif (!isLetter($chars[$right])) {
            $right--;
        } else {
            swapWithCasePreserved($chars, $left, $right);
            $left++;
            $right--;
        }
    }
    return implode('',$chars);
}

//Меняем местами буквы с учетом регистра
function swapWithCasePreserved(array &$chars, int $left, int $right)
{
    $letter1 = $chars[$left];
    $letter2 = $chars[$right];

    //Проверка на регистр
    $isUpper1 = (mb_strtoupper($letter1) === $letter1) && (mb_strtolower($letter1) !== $letter1);
    $isUpper2 = (mb_strtoupper($letter2) === $letter2) && (mb_strtolower($letter2) !== $letter2);

    $low1= mb_strtolower($letter1);
    $low2= mb_strtolower($letter2);

    //Изменение букв с учетом регистра
    $chars[$left] = $isUpper1 ? mb_strtoupper($low2) : $low2;
    $chars[$right] = $isUpper2 ? mb_strtoupper($low1) : $low1;
}

function isLetter(string $letter) : bool
{
    return preg_match('/\p{L}/u', $letter) === 1;
}

$input = "ПриВет, can’t third-part is 'cold' now";
$output = reverseEachWordPreserve($input);
echo $output;