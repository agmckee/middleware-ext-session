<?php namespace agmckee\SessionMiddleware;

/**
 * SessionInterface for PHP 5.6 projects
 * 
 * @copyright Copyright (c) 2018 Alex McKee. Based on work copyright (c) 2017 Zend Technologies USA Inc. (https://www.zend.com). Used under license.
 * @license   https://github.com/agmckee/middleware-ext-session/blob/master/LICENSE.md New BSD License
 */
interface SessionInterface
{

    /**
     * Serialize the session data to an array for storage purposes.
     * @return array
     */
    public function toArray();

    /**
     * Retrieve a value from the session.
     *
     * @param mixed $default Default value to return if $name does not exist.
     * @return mixed
     */
    public function get($name, $default = null);

    /**
     * Whether or not the container has the given key.
     * @return bool
     */
    public function has($name);

    /**
     * Set a value within the session.
     *
     * Values MUST be serializable in any format; we recommend ensuring the
     * values are JSON serializable for greatest portability.
     *
     * @param mixed $value
     */
    public function set($name, $value);

    /**
     * Remove a value from the session.
     * @return void
     */
    public function unset($name);

    /**
     * Clear all values.
     * @return void
     */
    public function clear();

    /**
     * Does the session contain changes? If not, the middleware handling
     * session persistence may not need to do more work.
     * @return bool
     */
    public function hasChanged();

    /**
     * Regenerate the session.
     *
     * This can be done to prevent session fixation. When executed, it SHOULD
     * return a new instance; that instance should always return true for
     * isRegenerated().
     *
     * An example of where this WOULD NOT return a new instance is within the
     * shipped LazySession, where instead it would return itself, after
     * internally re-setting the proxied session.
     * @return SessionInterface
     */
    public function regenerate();

    /**
     * Method to determine if the session was regenerated; should return
     * true if the instance was produced via regenerate().
     * @return bool
     */
    public function isRegenerated();
}