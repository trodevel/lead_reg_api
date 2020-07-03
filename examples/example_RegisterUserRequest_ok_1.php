<?php
// $Revision: 13347 $ $Date:: 2020-07-03 #$ $Author: serge $

require_once '../api.php';
require_once __DIR__.'/../../user_reg_protocol/str_helper.php';
require_once __DIR__.'/../../user_reg_protocol/object_initializer.php';
require_once __DIR__.'/../../user_reg_protocol/request_encoder.php';
require_once __DIR__.'/../../basic_objects/object_initializer.php';
require_once '../credentials.php';

$error_msg = "";

$user_id = 0;

echo "\n";
echo "TEST: user_reg_protocol/RegisterUserRequest\n";
{
    $api = new \user_reg_api\Api( $host, $port );

    $session_id = NULL;

    if( $api->open_session( $login, $password, $session_id, $error_msg ) == true )
    {
        echo "OK: opened session\n";

        {
            $req = new \user_reg_protocol\create__RegisterUserRequest( $session_id, \user_reg_protocol\create__User( \user_reg_protocol\gender_e__MALE, "Doe", "John", \basic_objects\create__Email( "johndoe@example.com" ), "+49123456789", new \basic_objects\create__Date( 1978, 7, 6 ) ) );

            echo "REQ = " . \user_reg_protocol\to_generic_request( $req ) . "\n";
            $resp = $api->submit( $req );

            echo "RESP = " . \user_reg_protocol\to_string( $resp ) . "\n\n";
        }

        if( $api->close_session( $session_id, $error_msg ) == true )
        {
            echo "OK: session closed\n";
        }
        else
        {
            echo "ERROR: cannot close session: $error_msg\n";
        }
    }
    else
    {
        echo "ERROR: cannot open session: $error_msg\n";
    }
}


?>
