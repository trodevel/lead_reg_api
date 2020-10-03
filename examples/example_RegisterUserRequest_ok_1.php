<?php
// $Revision: 13919 $ $Date:: 2020-10-02 #$ $Author: serge $

require_once __DIR__.'/../api.php';
require_once __DIR__.'/../../user_reg_protocol/html_helper.php';
require_once __DIR__.'/../../user_reg_protocol/object_initializer.php';
require_once __DIR__.'/../../basic_objects/object_initializer.php';
require_once '../credentials.php';

$error_msg = "";

echo "\n";
echo "TEST: user_reg_protocol/RegisterUserRequest\n";
try
{
    $api = new \user_reg_api\Api( $host, $port );


    $user  = \user_reg_protocol\create__User(
        \basic_objects\gender_e__MALE
        , "test_user"
        , "Dow"
        , "John"
        , \basic_objects\create__Email( "john.dow@yoyodine.com" )
        , "+1234567890"
        , \basic_objects\create__Date( 2020, 9, 29 )
    );

    $resp = NULL;

    if( $api->register_user( $user, "xxx123", $resp ) == false )
    {
        echo \user_reg_protocol\to_html( $resp ) . "\n\n";
        throw new \Exception( "cannot register user" );
    }

    echo \user_reg_protocol\to_html( $resp ) . "\n\n";
}
catch( \Exception $e )
{
    echo "FATAL: $e\n";
}

?>
