
## Основные функции

### `reverseEachWordPreserve(string $str): string` - Разбивает строку на части (слова и пробелы)
### `processWordWithSeparators(string $word): string` - Разбивает слово по символам `-` и `'`
### `reverseWordPreserve(string $word): string`- Преобразует слово в массив символов (`$chars`), ищет буквы, игнорируя знаки препинания
### `swapWithCasePreserved(array &$chars, int $left, int $right): void` - Меняет местами два символа в массиве с учётом их исходного регистра
### `isLetter(string $letter): bool` - Проверяет, является ли символ буквой (любой язык, Unicode)

##Запуск тестов
- Убедитесь, что установлен PHPUnit:
    
```composer require --dev phpunit/phpunit```

- Запустите тесты командой в терминале:

```vendor/bin/phpunit --colors --testdox tests/reverseTest.php```