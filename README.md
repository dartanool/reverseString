Основные функции
- isLetter($char) — проверяет, является ли символ буквой любого языка.
- saveCaseFlag($word) — возвращает массив флагов регистра для букв в слове.
- getCasedWord($letters, $flags) — применяет сохранённый регистр к массиву букв.
- reverse($str) — главная функция, которая обрабатывает всю строку, используя другие функции.

Запуск тестов
- Убедитесь, что установлен PHPUnit:
    ```bash 
#composer require --dev phpunit/phpunit
    ```

- Запустите тесты командой в терминале:
    ```bash
#vendor/bin/phpunit --colors --testdox tests/reverseTest.php
``` 