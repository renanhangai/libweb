Validator
================================

Introduction
--------------------------------

Class used to validate data that usually comes from the user

```php
use LibWeb\Validator as v;

$data = array(
   "name" => "User name",
   "mother" => array(
       "name" => "My Mothers Name",
       "birthdate" => "10/02/1960",
   ),
   "children" => array(
       array( "name" => "First child", "age" => 15 ),
       array( "name" => "Second child", "age" => 4 ),
   )
);

v::validate( $data, array( 
    "name"   => v::s(),
	"mother" => array(
	    "name"      => v::s(),
            "birthdate" => v::date( "d/m/Y" ),
	),
	"children" => v::arrayOf(array(
		"name" => v::s(),
		"age"  => v::i(),	
	)),
) );
```

Rules
-------------------------------

  - `s` or `strval`: Convert to string
  - `i` or `intval`: Convert to int
  - `f` or `floatval` `($decimal = '.', $thousands = ',')`: Convert to float
  - `b` or `boolean`: Convert to bool
  - `call( $fn )`: Calls the $fn on the value
     ```php
     // Validate the string 'Bona'
     v::call(function( $value ) { return $value === 'Bona'; });
     v::call('trim');          // calls trim( $value );
     v::call('substr', 0, 20); // calls substr( $value, 0, 20 );
     ```
  - `date($format, $out = null)`: Expects a date on the given format
      ```php
      v::date( "d/m/Y" ); // Converts 20/03/2017 to a DateTime-like object
      ```
   - `arrayOf( $rules )`: Expects an array following the rules