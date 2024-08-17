<?php

declare(strict_types=1);

namespace application\core;

/**
 * The Session class manages flash messages in a web application.
 */
final class Session
{
    /**
     * The key used to store flash messages in the session.
     */
    private const FLASH_KEY = 'flash_messages';

    /**
     * The key used to store non-flash session data.
     */
    private const DATA_KEY  = 'none_flash_massage';

    /**
     * Constructor method.
     * Starts the session and processes any existing flash messages.
     */
    public function __construct()
    {
        session_start();

        // Retrieve the flash messages from the session
        $flash_messages = &$_SESSION[self::FLASH_KEY] ?? [];

        // If the flash messages exist and are an array, mark them for removal
        if (is_array($flash_messages)) {
            foreach ($flash_messages as &$flash_message) {
                $flash_message['remove'] = true;
            }
            unset($flash_message); // Remove the reference to the last element
        }
    }

    /**
     * Sets a flash message with the given key and message.
     *
     * @param string $key The key of the flash message.
     * @param string $message The content of the flash message.
     */
    public function set_flash(string $key, mixed $message): void
    {
        // Store the flash message in the session
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'message' => $message
        ];
    }

    /**
     * Stores a non-flash session data item with the given key and message.
     *
     * @param string $key The key of the session data.
     * @param string $message The content of the session data.
     */
    public function set_data(string $key, mixed $value): void
    {
        $_SESSION[self::DATA_KEY][$key] = [
            'remove' => false,
            'value' => $value
        ];
    }

    /**
     * Retrieves the non-flash session data item with the given key.
     *
     * @param string $key The key of the session data.
     * @return mixed The content of the session data, or null if the data does not exist.
     */
    public function get_data(string $key): mixed
    {
        return $_SESSION[self::DATA_KEY][$key]['value'] ?? null;
    }

    /**
     * Marks the non-flash session data item with the given key for removal.
     *
     * @param string $key The key of the session data.
     */
    public function remove_session_data(string $key): void
    {
        $_SESSION[self::DATA_KEY][$key]['remove'] = true;
    }

    /**
     * Retrieves the content of a flash message with the given key.
     *
     * @param string $key The key of the flash message.
     * @return string|null The content of the flash message, or null if the message does not exist.
     */
    public static function get_flash(string $key): mixed
    {
        return $_SESSION[self::FLASH_KEY][$key]['message'] ?? null;
    }

    /**
     * Destructor method.
     * Removes any flash messages marked for removal from the session.
     */
    public function __destruct()
    {
        foreach ($_SESSION as $s_key => $session_key) {
            if (is_array($session_key)) {
                foreach ($session_key as $key => $_value) {
                    if ($_SESSION[$s_key][$key]['remove'])
                        unset($_SESSION[$s_key][$key]);
                }
            }
        }
    }
}
