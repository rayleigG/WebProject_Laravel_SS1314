<?php

$routeName = 'admin.insertProduct';
echo Form::open(array(
  'route' => array($routeName),
  'method' => 'POST',
));

echo Form::input('text', 'txtInput', null, ['placeholder' => 'Input text']);
echo Form::checkbox('price_toggle', 'price_toggle', null, ['label' => 'Price toggle']);
echo Form::label('email', 'E-Mail Address');
echo Form::text('email', 'example@gmail.com');
echo Form::close();

?>
