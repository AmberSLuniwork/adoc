<?php
/**
 * Cookie encryption middleware
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Middleware
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */


namespace ADoc\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

/**
 * The EncryptCookies class handles the cookie encryption.
 *
 * It extends BaseEncrypter and defines the list of cookie names that should
 * not be encrypted.
 *
 * @package ADoc\Http\Middleware
 */
class EncryptCookies extends BaseEncrypter
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
