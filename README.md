Веб-приложение для импорта данных, введённых на сайте, в таблицы GoogleSheets. 
Страница сайта содержит форму со следующими элементами: поле для ввода email, поле для ввода номера телефона, поле для ввода имени, кнопка отправить. 
Требования к данным: email должен соответствовать шаблону name@subdomain.domain, телефон должен соответствовать шаблону 7ХХХХХХХХХХ, имя должно содержать только буквы кириллицы, любых других символов и цифр быть не должно, также ни одно из полей не должно быть пустым. 
Проект состоит из: 
index.html - главная страница, на которой находится форма для ввода данных; 
стили находятся в папке css; 
в папке js скрипт checkPhone.js отвечает за маску номера телефона; 
ajax.js отвечает за отправку данных с формы на сервер и визуализацию результата; 
server.php - скрипт, отвечающий за принятие данных с формы, их валидацию и экспорт в GoogleSheets; 
в файле log.txt содержатся логи. 
В проекте используется PHP библиотека Google для работы с GS и другими сервисами Google


