
Subforms extension for Contao CMS form genrator
===============================================

[![Build Status](http://img.shields.io/travis/netzmacht/contao-subforms/master.svg?style=flat-square)](https://travis-ci.org/netzmacht/contao-subforms)
[![Version](http://img.shields.io/packagist/v/netzmacht/contao-subforms.svg?style=flat-square)](http://packagist.com/packages/netzmacht/contao-subforms)
[![License](http://img.shields.io/packagist/l/netzmacht/contao-subforms.svg?style=flat-square)](http://packagist.com/packages/netzmacht/contao-subforms)
[![Downloads](http://img.shields.io/packagist/dt/netzmacht/contao-subforms.svg?style=flat-square)](http://packagist.com/packages/netzmacht/contao-subforms)
[![Contao Community Alliance coding standard](http://img.shields.io/badge/cca-coding_standard-red.svg?style=flat-square)](https://github.com/contao-community-alliance/coding-standard)

Features
--------

This extension provides an easy way to include fields of subforms into a main form. So it is easy to use some parts of 
a form again or structure huge forms with many field much better.
 
This extension provides full support for the [multipage extension][terminal42.mp_forms], 
[conditionalformfield extension][terminal42.conditionalformfields] 
and [leads extension][[terminal42.leads]] provided by [terminal42][terminal42].

**Important:** Support of the [efg][efg] is not tested and won't be offically supported.
   
Requirements
------------

The extension requires at least Contao 3.3 and PHP 5.4

Install
-------

This extension can be installed using composer:

```
$ php composer.phar require netzmacht/contao-subforms:~1.0
```

[terminal42.mp_forms]: https://github.com/terminal42/contao-mp_forms
[terminal42.leads]: https://github.com/terminal42/contao-leads
[terminal42.conditionalformfields]: https://github.com/terminal42/contao-conditionalformfields
[terminal42]: https://www.terminal42.ch
[efg]: https://bitbucket.org/thk/efg
