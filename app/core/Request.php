<?php
class Request {
    public static function all() {
        return $_POST;
    }

    public static function input($key) {
        return $_POST[$key] ?? null;
    }
}