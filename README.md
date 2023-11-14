# SimpleCSV class 1.0
[<img src="https://img.shields.io/packagist/dt/shuchkin/simplecsv" />](https://packagist.org/packages/shuchkin/simplecsv)
[<img src="https://img.shields.io/github/license/shuchkin/simplecsv" />](https://github.com/shuchkin/simplecsv/blob/master/license.md) [<img src="https://img.shields.io/github/stars/shuchkin/simplecsv" />](https://github.com/shuchkin/simplecsv/stargazers) [<img src="https://img.shields.io/github/forks/shuchkin/simplecsv" />](https://github.com/shuchkin/simplecsv/network) [<img src="https://img.shields.io/github/issues/shuchkin/simplecsv" />](https://github.com/shuchkin/simplecsv/issues)
[<img src="https://img.shields.io/opencollective/all/simplexlsx" />](https://opencollective.com/simplexlsx)
[<img src="https://img.shields.io/badge/patreon-_-_" />](https://www.patreon.com/shuchkin)

Parse and retrieve data from CSV files. Save array to CSV file.
See XLSX reader [here](https://github.com/shuchkin/simplexlsx), XLS reader [here](https://github.com/shuchkin/simplexls),      

**Sergey Shuchkin** <sergey.shuchkin@gmail.com> 2015-2023<br/>

## Basic Usage
```php
if ( $csv = Shuchkin\SimpleCSV::parse('book.csv') ) {
	print_r( $csv->rows() );
}
```
```
Array
(
    [0] => Array
        (
            [0] => ISBN
            [1] => title
            [2] => author
            [3] => publisher
            [4] => ctry
        )

    [1] => Array
        (
            [0] => 618260307
            [1] => The Hobbit
            [2] => J. R. R. Tolkien
            [3] => Houghton Mifflin
            [4] => USA
        )

)
```
## Installation
The recommended way to install this library is [through Composer](https://getcomposer.org).
[New to Composer?](https://getcomposer.org/doc/00-intro.md)

This will install the latest supported version:
```bash
$ composer require shuchkin/simplecsv
```
or download class [here](https://github.com/shuchkin/simplecsv/blob/master/src/SimpleCSV.php)

### Debug
```php
ini_set('error_reporting', E_ALL );
ini_set('display_errors', 1 );

$csv = Shuchkin\SimpleCSV::import('books.csv');
print_r( $csv->rows() );
```
### Export
```php
$items = [
	['ISBN', 'title', 'author'],
	['618260307','The Hobbit','J. R. R. Tolkien']
];
$csv = Shuchkin\SimpleCSV::export( $items );
echo '<pre>' . $csv . '</pre>';
/*
ISBN,title,author
618260307,The Hobbit,J. R. R. Tolkien
*/
```
	
## History
1.0 (2023-08-27)
* used namespace now: Shuchkin\SimpleCSV
* fixed delimiter detection

0.2 (2023-07-27)
* fix 8x deprication [Passing null to parametr](https://github.com/shuchkin/simplecsv/issues/5)
* added static methods SimpleCSV::parse, SimpleCSV::parseFile, SimpleCSV::parseData
  
0.1.1 (2021-04-28) fix 7.4 deprication [error](https://github.com/shuchkin/simplecsv/issues/1)<br/>
0.1 (2018-12-20) GitHub realese, composer