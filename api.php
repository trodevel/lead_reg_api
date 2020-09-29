<?php

/*

User/Registration API.

Copyright (C) 2018 Sergey Kolevatov

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.

*/

// $Revision: 13908 $ $Date:: 2020-09-29 #$ $Author: serge $

namespace user_reg_api;

require_once __DIR__.'/../generic_api/api.php';
require_once __DIR__.'/../user_reg_protocol/protocol.php';
require_once __DIR__.'/../user_reg_protocol/parser.php';    // Parser::parse()
require_once __DIR__.'/apiio.php';

class Api extends \generic_api\Api
{
    public function __construct( $host, $port )
    {
        parent::__construct( $host, $port );

        $this->apiio = new ApiIO( $host, $port );
    }

    public function register_user( $user, $password, & $resp )
    {
        // execute request

        $req = \user_reg_protocol\create__RegisterUserRequest( $user, $password );

        $resp = $this->apiio->submit( $req );

        if( get_class ( $resp ) == "generic_protocol\ErrorResponse" )
        {
            return false;
        }
        elseif( get_class( $resp ) == "user_reg_protocol\RegisterUserResponse" )
        {
            return true;
        }

        throw new InternalException( "unexpected response: " . get_class( $resp ) );
    }

    public function confirm_registration( $registration_key, & $resp )
    {
        // execute request

        $req = \user_reg_protocol\create__ConfirmRegistrationRequest( $registration_key );

        $resp = $this->apiio->submit( $req );

        if( get_class ( $resp ) == "generic_protocol\ErrorResponse" )
        {
            return false;
        }
        elseif( get_class( $resp ) == "user_reg_protocol\ConfirmRegistrationResponse" )
        {
            return true;
        }

        throw new InternalException( "unexpected response: " . get_class( $resp ) );
    }

    private $apiio;  // ApiIO
}

?>
