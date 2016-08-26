<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/7/18
 * Time: 9:40
 */
//需要在 ext 文件夹中包含有php_ming.dll文件，在php.ini文件中加入extension=php_ming.dll
$f = new SWFFont( '_sans' );

$t = new SWFTextField();
$t->setFont( $f );
$t->setColor( 0, 0, 0 );
$t->setHeight( 400 );
$t->addString( 'Hello World' );

$m = new SWFMovie();
$m->setDimension( 2500, 800 );
$m->add( $t );

$m->save( 'hello.swf' );