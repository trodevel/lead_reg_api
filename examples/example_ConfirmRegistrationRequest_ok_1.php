<?php
// $Revision: 13932 $ $Date:: 2020-10-03 #$ $Author: serge $

require_once __DIR__.'/../api.php';
require_once __DIR__.'/../../user_reg_protocol/html_helper.php';
require_once __DIR__.'/../../user_reg_protocol/object_initializer.php';
require_once __DIR__.'/../../basic_objects/object_initializer.php';
require_once '../credentials.php';

$error_msg = "";

echo "\n";
echo "TEST: user_reg_protocol/ConfirmRegistrationRequest\n";
try
{
    $api = new \user_reg_api\Api( $host, $port );

    $registration_key = "b074bb5e-e601-4822-83c7-e6ade99870fb";

    $resp = NULL;

    if( $api->confirm_registration( $registration_key, $resp ) == false )
    {
        echo \user_reg_protocol\to_html( $resp ) . "\n\n";
        throw new \Exception( "cannot confirm registration" );
    }

    echo \user_reg_protocol\to_html( $resp ) . "\n\n";
}
catch( \Exception $e )
{
    echo "FATAL: $e\n";
}

?>
