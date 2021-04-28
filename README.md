# SimpleCSV class 0.1.1
[<img src="https://img.shields.io/endpoint.svg?url=https%3A%2F%2Fshieldsio-patreon.herokuapp.com%2Fshuchkin" />](https://www.patreon.com/shuchkin)

Parse and retrieve data from CSV files. Save array to CSV file.
See XLSX reader [here](https://github.com/shuchkin/simplexlsx), XLS reader [here](https://github.com/shuchkin/simplexls),      

**Sergey Shuchkin** <sergey.shuchkin@gmail.com> 2015-2019<br/>

## Basic Usage
```php
if ( $csv = SimpleCSV::import('book.csv') ) {
	print_r( $csv );
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

```

### Debug
```php
ini_set('error_reporting', E_ALL );
ini_set('display_errors', 1 );

$csv = SimpleCSV::import('books.csv');
print_r( $csv );

```
### Export
```php
$items = array(
	array('ISBN', 'title', 'author'),
	array('618260307','The Hobbit','J. R. R. Tolkien')
);
$csv = SimpleCSV::export( $items );
echo '<pre>' . $csv . '</pre>';
/*
ISBN,title,author
618260307,The Hobbit,J. R. R. Tolkien
*/
```
	
## History
```
0.1.1 (2021-04-28) fix 7.4 deprication [error](https://github.com/shuchkin/simplecsv/issues/1)
0.1 (2018-12-20) GitHub realese, composer
```
