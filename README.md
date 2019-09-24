# shoppinglist_fullstack
HTML, PHP + SQL ostoslista, joka esittää ja muokkaa tietokannan sisältöä 

Short html, php + sql program which inserts user inputs into sql database through php using html front and displays database contents in thepage 
1. Establish sql database connection using php
2. Create new table if none is found
3. Check if user has made any inputs through form in previous page. If inputs found, insert inputs into database. If not, pass
4. Load table contents from database and display them into html webpage
5. After the page refresh (form submitted, F5 pressed, new user arrives to page) continue from 1. 

Environments:

HTML5

mysql  Ver 15.1 Distrib 10.4.6-MariaDB, for Win64 (AMD64), source revision b8e655ce029a1f182602c9f12c3cc5931226eec2

PHP 7.3.9 (cli) (built: Aug 28 2019 09:28:48) ( ZTS MSVC15 (Visual C++ 2017) x64 )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.3.9, Copyright (c) 1998-2018 Zend Technologies