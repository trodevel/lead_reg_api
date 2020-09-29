<?php

/*

UserReg API.

Copyright (C) 2020 Sergey Kolevatov

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

// $Revision: 13899 $ $Date:: 2020-09-28 #$ $Author: serge $

namespace user_reg_api;

require_once __DIR__.'/../user_reg_protocol/parser.php';      // Parser::parse()
require_once __DIR__.'/../user_reg_protocol/request_encoder.php';    // \to_generic_request()
require_once __DIR__.'/../generic_api/apiio.php';

class ApiIO extends \generic_api\ApiIO
{
    protected function parse_response( $resp )
    {
        $res = \user_reg_protocol\Parser::parse( $resp );

        return $res;
    }

    protected function to_generic_request( $req )
    {
        $res = \user_reg_protocol\to_generic_request( $req );

        return $res;
    }
}

?>
