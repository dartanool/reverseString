<?php
/**
 * Обрабатывает строку, разворачивая каждое слово с сохранением регистра и пунктуации.
 *
 * @param string $str Входная строка для обработки.
 * @return string Обработанная строка с перевёрнутыми словами.
 */
function reverseEachWordPreserve(string $str) : string
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

/**
 * Разбивает слово по дефисам и апострофам.
 *
 * @param string $word Слово для обработки.
 * @return string Слово с перевёрнутыми частями, разделёнными дефисами и апострофами.
 */
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

/**
 * Переворачивание букв.
 *
 * @param string $word Слово для реверса.
 * @return string Перевернутое слово с сохранённым регистром и пунктуацией.
 */
function reverseWordPreserve(string $word) : string
{
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

/**
 * Меняет местами буквы в массиве символов с учётом исходного регистра.
 *
 * @param array $chars Массив символов, который будет изменён по ссылке.
 * @param int $left Индекс левого символа.
 * @param int $right Индекс правого символа.
 * @return void
 */
function swapWithCasePreserved(array &$chars, int $left, int $right) : void
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
/**
 * Проверяет, является ли символ буквой.
 *
 * @param string $letter символ для проверки.
 * @return bool true, если символ — буква, иначе false.
 */
function isLetter(string $letter) : bool
{
    return preg_match('/\p{L}/u', $letter) === 1;
}

$input = "ПриВет, can’t third-part is 'cold' now";
echo reverseEachWordPreserve($input);