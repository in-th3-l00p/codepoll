<?php

namespace core\Http;

/**
 * This constant is used as a key to store flash messages in the session.
 */
const FLASH_KEY = "_flash";


/**
 * This constant is used as a key to store hidden values in the session.
 */
const HIDDEN_KEY = "_hidden";

/**
 * This class provides static methods to manage PHP sessions.
 */
class Session
{
    /**
     * Initializes the session by starting it.
     *
     * @return void
     */
    public static function initialize(): void
    {
        session_start();
    }

    /**
     * Destroys the session.
     *
     * @return void
     */
    public static function destroy(): void
    {
        session_destroy();
    }

    /**
     * Retrieves the value of a session key.
     *
     * @param string $key The key of the session
     * @return mixed Returns the value of the session key or null if the key does not exist
     */
    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? $_SESSION[FLASH_KEY][$key] ?? null;
    }

    /**
     * Checks if a session key exists.
     *
     * @param string $key The key of the session
     * @return bool Returns true if the session key exists, false otherwise
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]) || isset($_SESSION[FLASH_KEY][$key]);
    }

    /**
     * Sets the value of a session key.
     *
     * @param string $key The key of the session
     * @param mixed $value The value to be set for the session key
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Removes a session key and its associated value.
     *
     * @param string $key The key of the session to be removed
     * @return void
     */
    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Sets a flash message in the session.
     *
     * @param string $key The key of the flash message
     * @param mixed $value The value of the flash message
     * @return void
     */
    public static function setFlash(string $key, $value): void
    {
        $_SESSION[FLASH_KEY][$key] = $value;
    }

    /**
     * Checks if a flash message exists in the session.
     *
     * @param string $key The key of the flash message
     * @return bool Returns true if the flash message exists, false otherwise
     */
    public static function isFlash(string $key): bool
    {
        return isset($_SESSION[FLASH_KEY][$key]);
    }

    /**
     * Removes all flash messages from the session.
     *
     * @return void
     */
    public static function flash(): void
    {
        unset($_SESSION[FLASH_KEY]);
    }

    /**
     * Retrieves the value of a hidden key.
     * @param string $key The key of the hidden value
     * @return mixed The value of the hidden key or null if the key does not exist
     */
    public static function getHidden(string $key): mixed
    {
        return $_SESSION[HIDDEN_KEY][$key] ?? null;
    }

    /**
     * Retrieves the value of a hidden key.
     * @param string $key The key of the hidden value
     * @param $value The value of the hidden keyj
     * @return void
     */
    public static function setHidden(string $key, $value): void
    {
        $_SESSION[HIDDEN_KEY][$key] = $value;
    }

    /**
     * Removes a hidden key and its associated value.
     * @param string $key The key of the hidden value to be removed
     * @return void
     */
    public static function removeHidden(string $key): void
    {
        unset($_SESSION[HIDDEN_KEY][$key]);
    }

    /**
     * Retrieves an error message from the session.
     * @param string $key The key of the error message
     * @return string|null The error message or null if the key does not exist
     */
    public static function getError(string $key): ?string
    {
        return $_SESSION["errors"][$key] ?? null;
    }

    /**
     * Sets an error message in the session.
     * @param string $key The key of the error message
     * @param string $value The value of the error message
     * @return void
     */
    public static function setError(string $key, string $value): void
    {
        self::setFlash($key, $value);
    }
}