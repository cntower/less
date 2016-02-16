Сервис коротких ссылок
============================

Программа реализует требования:
Реализовать сервис для создания коротких адресов страниц в соответствии со сценарием:

1.	Посетитель вводит любой оригинальный URL в поле ввода, например: http://anydomain/any/path/;
2.	Посетитель нажимает кнопку "Укоротить";
3.	Выполняется AJAX-запрос;
4.	Короткий URL появляется на странице, например: http://yourdomain/abCdE (нельзя использовать любой сторонний API сервис, например goo.gl и т.д.);
5.	Посетитель может скопировать короткий URL и повторить процесс с другой ссылкой.

Короткий URL должен перенаправлять на оригинальную ссылку в любом браузере с любого и хранится фактически вечно, неважно сколько раз еще был использован генератор.

Требования:
1.	Использование CMS фреймворка Yii, Yii2, Laravel, etc.;
2.	На стороне клиента можно использовать любой фреймворк.

РАЗРАБОТКА
----------
Для разработки был выбран Yii2, использовался базовый шаблон.

 Наиболее простым алгоритмом укорачивания ссылок будет сохранение в
 базе данных переданной ссылки и возврат пользователю идентификатора (ключа)
 который будет однозначно указывать на сохраненную ссылку.
 less.ru/controllers/UrlsController.php
```php
...
if ($model->save()){
    $num = $model->primaryKey;
    //генерируется идентификатор из primaryKey
    $w = $this->arrToWord($this->tenToFifty($num));
    $res = array(
        'body'    => 'http://less.ru/' . $w,
        'success' => true,
    );
}
...
```
 Для представления ключа можно использовать буквы латинского алфавита, это
 25 символов в нижнем регистре и 25 в верхнем - всего 50. Значит можно для записи
 использовать 50-ную систему счисления.

 Для возможности использовать ЧПУ:
 ```php
 'components' => [
 ...
          'urlManager' => [
             //включает ЧПУ
             'enablePrettyUrl' => true,
             //скрывает index...
             'showScriptName' => false,
             'enableStrictParsing' => false,
             'rules' => [
                 //правило передает в urls/index параметр $word
                 '/<word>' => 'urls/index',
             ],
         ],
 ```

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
