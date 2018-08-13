<?php namespace agmckee\SessionMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Session persistence using ext-session.
 *
 * Adapts ext-session to work with PSR-7 by disabling its auto-cookie creation
 * (`use_cookies => false`), while simultaneously requiring cookies for session
 * handling (`use_only_cookies => true`). The implementation pulls cookies
 * manually from the request, and injects a `Set-Cookie` header into the
 * response.
 *
 * Session identifiers are generated using random_bytes (and casting to hex).
 * During persistence, if the session regeneration flag is true, a new session
 * identifier is created, and the session re-started.
 *
 * @copyright Copyright (c) 2018 Alex McKee. Based on work copyright (c) 2017 Zend Technologies USA Inc. (https://www.zend.com). Used under license.
 * @license   https://github.com/agmckee/middleware-ext-session/blob/master/LICENSE.md New BSD License
 */
class SessionPersistence implements SessionPersistenceInterface
{
    /** @var string */
    private $cacheLimiter;

    /** @var int */
    private $cacheExpire;

    /**
     * Memoize session ini settings before starting the request.
     *
     * The cache_limiter setting is actually "stolen", as we will start the
     * session with a forced empty value in order to instruct the php engine to
     * skip sending the cache headers (this being php's default behaviour).
     * Those headers will be added programmatically to the response along with
     * the session set-cookie header when the session data is persisted.
     */
    public function __construct()
    {
        $this->cacheLimiter = ini_get('session.cache_limiter');
        $this->cacheExpire  = (int) ini_get('session.cache_expire');
    }

    public function initializeSessionFromRequest(ServerRequestInterface $request)
    {
        $this->cookie = $request->getCookieParams();
    }

    public function persistSession(SessionInterface $session, ResponseInterface $response)
    {
        
    }
}