<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-09-16
 * Time: 20:13
 */


$result = 0;

$one = function()
{ var_dump($result); };

$two = function() use ($result)
{ var_dump($result); };

$three = function() use (&$result)
{ var_dump($result); };

$result++;

$one();    // outputs NULL: $result is not in scope
$two();    // outputs int(0): $result was copied
$three();    // outputs int(1)
?>

    Another less trivial example with objects (what I actually tripped up on):

<?php
//set up variable in advance
$myInstance = null;

$broken = function() use ($myInstance)
{
    if(!empty($myInstance)) $myInstance->doSomething();
};

$working = function() uses (&$myInstance)
{
    if(!empty($myInstance)) $myInstance->doSomething();
}

//$myInstance might be instantiated, might not be
if(SomeBusinessLogic::worked() == true)
{
    $myInstance = new myClass();
}

$broken();    // will never do anything: $myInstance will ALWAYS be null inside this closure.
$working();    // will call doSomething if $myInstance is instantiated