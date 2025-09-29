<?php
//проверка на букву
function isLetter($char) {
    return preg_match('/\p{L}/u', $char);
}
function reverse(string $str){

    //замена символов
    $placeholders = ['-'=>' __h__ ', '`' => ' __a__ ', '’' => ' __aa__ ', "'"=>' __aaa__ '];
    foreach ($placeholders as $symbol => $placeholder) {
        $str = str_replace($symbol, $placeholder, $str);
    }

    $words = explode(' ', $str);
    $resultString = '';

    foreach($words as $word){
        //массив из букв
        $letters = [];
        for($i = 0; $i < mb_strlen($word); $i++){
            $char = mb_substr($word, $i, 1);
            if (isLetter($char)){
                $letters[] = $char;
            }
        }
        //флаги, где заглавная
        $flags = saveCaseFlag($letters);
        $letters = array_reverse($letters);

        //Массив с измененными буквами
        $lettersGetCased = getCasedWord($letters, $flags);

        //Формирование строки со знаками из массива
        $newWord = '';
        $letterIndex = 0;
        for ($i = 0; $i < mb_strlen($word); $i++) {
            $char = mb_substr($word, $i, 1);
            if (isLetter($char)) {
                $newWord .= $lettersGetCased[$letterIndex++];
            } else {
                $newWord .= $char;
            }
        }
        $resultString .= $newWord . ' ';
    }

    $resultString = trim($resultString);

    // Возвращаем символы-заменители обратно в реальные дефисы и апострофы
    foreach ($placeholders as $symbol => $placeholder) {
        $resultString = str_replace($placeholder, $symbol, $resultString);
    }
    return $resultString;
}

// Определяет, где с заглавной
function saveCaseFlag(array $letters){
    $flags = [];
    foreach ($letters as $letter){
        $flags[] = ($letter  === mb_strtoupper($letter));
    }
    return $flags;

}

//Изменяет регистр нового слова
function getCasedWord(array $letters, array $flags){
    $resultLetters = [];
    $letters = array_map('strtolower', $letters);

    for ($i=0; $i < count($letters); $i++) {
        if ($flags[$i]) {
            $resultLetters[] = mb_strtoupper($letters[$i]);
        } else {
            $resultLetters[] = $letters[$i];
        }
    }
    return $resultLetters;
}

echo reverse('Can`t Third-part, sEcond thIrd');