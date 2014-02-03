ZEND Coding Standards
=============
Coding standards are important in any development project, but they are particularly important when many developers are working on the same project. Coding standards help ensure that the code is high quality, has fewer bugs, and can be easily maintained.


## PHP File Formatting

### General
For files that contain only PHP code, the closing tag (?>) __MUST NOT__ be used. It is not required by PHP, and omitting it prevents the accidental injection of trailing white space into the response.

### Indentation
Indentation __MUST__ consist of 4 spaces. Tabs __MUST NOT__ be used for indentation.

### Maximum Line Length
The target line length is 80 characters. That is to say, Zend Framework developers __SHOULD__ strive keep each line of their code under 80 characters where possible and practical. However, longer lines are acceptable in some circumstances. The maximum length of any line of PHP code is 120 characters.


## Naming Conventions

### Classes
Class names __MUST__ contain only alphanumeric characters and the underscore. Numbers are permitted in class names but are discouraged in most cases.
If a class name is comprised of more than one word, the first letter of each new word __MUST__ be capitalized. 

### Abstract Classes
Abstract classes follow the same conventions as classes, with one additional rule: abstract class names __SHOULD__ begin with the term, "Abstract". As examples, "AbstractAdapter" and "AbstractWriter" are both considered valid abstract class names.

### Interfaces
Interfaces follow the same conventions as classes, with two additional rules: interface __MUST__ be nouns or adjectives and interface class names __SHOULD__ end with the term, "Interface". As examples, "ServiceLocationInterface", "EventCollectionInterface", and "PluginLocatorInterface" are all considered appropriate interface names.

### Filenames
All other PHP files __MUST__ only use alphanumeric characters, underscores, and the dash character ("-"). Spaces are strictly prohibited.

### Functions and Methods
Function names __MUST__ contain only alphanumeric characters. Underscores are not permitted. Numbers are permitted in function names but are discouraged.

Function names __MUST__ always start with a lowercase letter. When a function name consists of more than one word, the first letter of each new word __MUST__ be capitalized. This is commonly called "camelCase" formatting.

Verbosity is encouraged. Function names should be as verbose as is practical to fully describe their purpose and behavior.

These are examples of acceptable names for functions:
```php
filterInput()
 
getElementById()
 
widgetFactory()
```

For object-oriented programming, accessors for instance or static variables __SHOULD__ be prefixed with "get" or "set".

### Variables
Variable names __MUST__ contain only alphanumeric characters. Underscores are not permitted. Numbers are permitted in variable names but are discouraged in most cases.

As with function names, variable names __MUST__ always start with a lowercase letter and follow the "camelCaps" capitalization convention.

### Constants
Constant names __MAY__ contain both alphanumeric characters and underscores.

All letters used in a constant name __MUST__ be capitalized, while all words in a constant name __MUST__ be separated by underscore characters.

For example, EMBED_SUPPRESS_EMBED_EXCEPTION is permitted but EMBED_SUPPRESSEMBEDEXCEPTION is not.


## Coding Style

### PHP Code Demarcation
PHP code MUST always be delimited by the full-form, standard PHP tags:
```php
<?php

?>
```
The closing PHP tag (?>) __MUST__ be omitted if no markup or code follows it.

### Strings

#### String Literals
When a string is literal (contains no variable substitutions), the apostrophe or "single quote" __SHOULD__ be used to demarcate the string:
```php
$a = 'Example String';
```

#### String Concatenation
Strings __MUST__ be concatenated using the "." operator. A space __MUST__ always be added before and after the "." operator to improve readability:
```php
$school = 'Gjoevik' . ' ' . 'University' . ' ' . 'College';
```

### Classes
#### Class Declaration
Classes __MUST__ be named according to Zend Framework's naming conventions.
The brace __MUST__ be written on the line underneath the class name, at the same level of indentation as the class declaration.
Every class __MUST__ have a documentation block that conforms to the PHPDocumentor standard. *
All code in a class __MUST__ be indented with four spaces additional to the level of indentation of the class
PHP files declaring classes __MUST__ contain a single PHP class only.declaration.

The following is an example of an acceptable class declaration:
```php
/**
 * Documentation Block Here
 */
class SampleClass
{
    // all contents of class
    // must be indented four spaces
}
```

#### Class Member Variables
Member variables __MUST__ be named according to Zend Framework's variable naming conventions.

Any variables declared in a class __MUST__ be listed at the top of the class, above the declaration of any methods.

The var construct __MUST NOT__ be used. Member variables __MUST__ declare their visibility by using one of the private, protected, or public visibility modifiers. Giving access to member variables directly by declaring them as public __MAY__ be done, but is discouraged in favor of accessor methods (set &
get).


### Functions and Methods
#### Function and Method Declaration
Functions MUST be named according to Zend Framework's function naming conventions.

Methods inside classes __MUST__ always declare their visibility by using one of the private, protected, or public visibility modifiers.

As with classes, the brace __MUST__ always be written on the line underneath the function name. Space __MUST NOT__ be inserted between the function name and the opening parenthesis for the arguments.

Functions __SHOULD NOT__ be declared in the global scope.

The following is an example of an acceptable function declaration in a class:
```php
/**
 * Documentation Block Here
 */
class Foo
{
    /**
     * Documentation Block Here
     */
    public function bar()
    {
        // all contents of function
        // must be indented four spaces
    }
}
```
