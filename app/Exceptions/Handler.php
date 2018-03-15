<?php
/**
 * Exception handling functionality.
 *
 * PHP Version 5
 *
 * @package ADoc\Exceptions
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */
namespace ADoc\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * The Handler provides application-specific exception handling overrides.
 *
 * The Handler extends the ExceptionHandler to transform ModelNotFoundException
 * into the correct 404 error.
 *
 * @package ADoc\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e The exception to report
     *
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request The request being handled
     * @param \Exception               $e       The exception that was thrown
     *
     * @return \Illuminate\Http\Response The response to send back to the client
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return abort(404);
        } else {
            return parent::render($request, $e);
        }
    }
}
