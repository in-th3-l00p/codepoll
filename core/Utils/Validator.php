<?php

namespace core\Utils;

use core\Http\Session;
use JetBrains\PhpStorm\NoReturn;

const PASSWORD_ERRORS = [
    "min_length" => "Password must be at least 8 characters long.",
    "max_length" => "Password must be at most 255 characters long."
];

class Validator {
    public static function unique(
        string $field,
        string $value,
        string $tableField
    ): ?string {
        $tableField = explode(".", $tableField);
        if (sizeof($tableField) !== 2)
            throw new \Exception("Invalid table field format.");

        $sql = \core\App::getInstance()
            ->getDatabase()
            ->getPDO()
            ->prepare("SELECT COUNT(*) as count FROM $tableField[0] WHERE $tableField[1] = :value");
        $sql->bindParam(":value", $value);
        $sql->execute();
        $count = $sql->fetch(\PDO::FETCH_ASSOC)["count"];
        if ($count > 0)
            return "$field is already taken.";
        return null;
    }

    public static function validateEmail(string $email): ?string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return "Invalid email address.";
        if (strlen(trim($email)) > 255)
            return "Email must be at most 255 characters long.";
        return self::unique("Email", $email, "users.email");
    }

    public static function validatePassword(string $password): ?string {
        if (strlen(trim($password)) < 8)
            return PASSWORD_ERRORS["min_length"];
        if (strlen(trim($password)) > 255)
            return PASSWORD_ERRORS["max_length"];
        return null;
    }

    public static function validateUsername(string $username): ?string {
        if (strlen(trim($username)) < 3)
            return "Username must be at least 3 characters long.";
        if (strlen(trim($username)) > 255)
            return "Username must be at most 255 characters long.";
        return self::unique("Username", $username, "users.username");
    }

    public static function validateName(string $name): ?string {
        if (strlen(trim($name)) < 3)
            return "Name must be at least 3 characters long.";
        if (strlen(trim($name)) > 255)
            return "Name must be at most 255 characters long.";
        return null;
    }

    /**
     * Validate data using rules.
     * @param array $data Associative array where key is the field name and value is the field value.
     * @param array $rules Associative array where key is the field name and value is the validation rule.
     * @return array Associative array where key is the field name and value is the error message.
     * @throws \Exception if validation rule does not exist
     */
    public static function validateRules(array $data, array $rules): array {
        $errors = [];
        foreach ($rules as $key => $rule) {
            if (!isset($data[$key])) {
                $errors[$key] = "Field is required.";
                continue;
            }
            $value = $data[$key];
            foreach (explode("|", $rule) as $r) {
                if (!method_exists(self::class, "validate" . ucfirst($r)))
                    throw new \Exception("Validation rule $r does not exist.");
                $error = call_user_func_array([self::class, "validate" . ucfirst($r)], [$value]);
                if ($error !== null) {
                    $errors[$key] = $error;
                    break;
                }
            }
        }
        return $errors;
    }

    /**
     * Validate request data using rules.
     * @throws \Exception if validation rule does not exist
     * @param array $rules Associative array where key is the field name and value is the validation rule.
     * @return \stdClass Object containing validated data.
     */
    #[NoReturn]
    public static function validateRequest(array $rules): \stdClass
    {
        $request = array_merge($_GET, $_POST);
        $errors = self::validateRules($request, $rules);
        if (!empty($errors)) {
            Session::setFlash("errors", $errors);
            back();
        }

        $data = [];
        foreach (array_keys($rules) as $key)
            $data[$key] = $request[$key];
        return (object) $data;
    }
}
