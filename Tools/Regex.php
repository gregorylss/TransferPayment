<?php
/*************************************************************************************/
/*                                                                                   */
/*      Thelia	                                                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : info@thelia.net                                                      */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      This program is free software; you can redistribute it and/or modify         */
/*      it under the terms of the GNU General Public License as published by         */
/*      the Free Software Foundation; either version 3 of the License                */
/*                                                                                   */
/*      This program is distributed in the hope that it will be useful,              */
/*      but WITHOUT ANY WARRANTY; without even the implied warranty of               */
/*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                */
/*      GNU General Public License for more details.                                 */
/*                                                                                   */
/*      You should have received a copy of the GNU General Public License            */
/*	    along with this program. If not, see <http://www.gnu.org/licenses/>.         */
/*                                                                                   */
/*************************************************************************************/
namespace TransferPayment\Tools;

class Regex
{
    const IBAN = "[a-zA-Z]{2}[\d]{2}[a-zA-Z\d]{4}[\d]{7}([a-zA-Z\d]?){0,16}";
    const SWIFT = "[a-zA-Z]{6}[a-zA-Z\d]{2}([a-zA-Z\d]{3})?";

    public static function iban($value)
    {
        return preg_match("#^".self::IBAN."$#",$value);
    }

    public static function swift($value)
    {
        return preg_match("#^".self::SWIFT."$#",$value);
    }
}
