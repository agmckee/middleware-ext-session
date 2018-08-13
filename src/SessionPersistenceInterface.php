<?php namespace agmckee\SessionMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * SessionPersistenceInterface for PHP 5.6 projects
 *
 * @copyright Copyright (c) 2018 Alex McKee. Based on work copyright (c) 2017 Zend Technologies USA Inc. (https://www.zend.com). Used under license.
 * @license   https://github.com/agmckee/middleware-ext-session/blob/master/LICENSE.md New BSD License
 */
interface SessionPersistenceInterface
{

    /**
     * Generate a session data instance based on the request.
     * @return SessionInterface
     */
    public function initializeSessionFromRequest(ServerRequestInterface $request);

    /**
     * Persist the session data instance.
     *
     * Persists the session data, returning a response instance with any
     * artifacts required to return to the client.
     * @return ResponseInterface
     */
    public function persistSession(SessionInterface $session, ResponseInterface $response);
}