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


РАЗРАБОТКА
----------
Для разработки был выбран Yii2, использовался базовый шаблон.
