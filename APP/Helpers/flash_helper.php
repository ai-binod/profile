<?php
declare(strict_types=1);

session_start();

/**
 * Flash message helper (PHP 8.3 optimized).
 */
function flash(
    string $name,
    string $message = '',
    string $class = 'alert alert-success',
    string $position = 'top-right'
): void {
    if ($name === '') {
        return;
    }

    // Store flash message
    if ($message !== '' && !isset($_SESSION[$name])) {
        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;
        $_SESSION[$name . '_position'] = $position;
        return;
    }

    // Show flash message
    if ($message === '' && isset($_SESSION[$name])) {
        $class    = $_SESSION[$name . '_class'] ?? 'alert alert-success';
        $position = $_SESSION[$name . '_position'] ?? 'top-right';

        // Base style (no margin, no gap)
        $style = "position:fixed; z-index:1050; padding:10px 15px; margin:0;";

        $style .= match ($position) {
            'top-right'     => "top:0; right:0;",
            'top-left'      => "top:0; left:0;",
            'bottom-right'  => "bottom:0; right:0;",
            'bottom-left'   => "bottom:0; left:0;",
            'middle-left'   => "top:50%; left:0; transform:translateY(-50%);",
            'middle-right'  => "top:50%; right:0; transform:translateY(-50%);",
            'middle-top'    => "top:0; left:50%; transform:translateX(-50%);",
            'middle-bottom' => "bottom:0; left:50%; transform:translateX(-50%);",
            default         => "top:0; right:0;",
        };

        echo '<div class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '" 
                 id="msg-flash" 
                 style="' . $style . '">' 
             . htmlspecialchars((string)$_SESSION[$name], ENT_QUOTES, 'UTF-8') 
             . '</div>';

        // Clear session
        unset($_SESSION[$name], $_SESSION[$name . '_class'], $_SESSION[$name . '_position']);
    }
}
