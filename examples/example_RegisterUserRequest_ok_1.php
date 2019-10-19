<?php
// $Revision: 12202 $ $Date:: 2019-10-18 #$ $Author: serge $

require_once '../api.php';
require_once __DIR__.'/../../user_reg_protocol/str_helper.php';
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
            $req = new \user_reg_protocol\RegisterUserRequest( $session_id, new \user_reg_protocol\User( \user_reg_protocol\gender_e_MALE, "Doe", "John", new \basic_objects\Email( "johndoe@example.com" ), "+49123456789", new \basic_objects\Date( 1978, 7, 6 ) ) );

            echo "REQ = " . $req->to_generic_request() . "\n";
            $resp = $api->submit( $req );

            echo "RESP = " . \user_reg_protocol\to_html( $resp ) . "\n\n";
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
