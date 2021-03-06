<?php

namespace Config;

use Exceptions\UserErrorException;

/**
 * Contains various utility functions for configuration and configuration checking purposes
 *
 * Class ConfigUtilities
 * @package Config
 */
class ConfigUtilities {

    /**
     * Appends a trailing slash to $path if one isn't already there
     *
     * @param $path
     * @return string
     */
    public static function addTrailingSlash($path) {
        return rtrim($path, '/') . '/';
    }

    /**
     * Checks if a field named $fieldName is present and non-empty in the dataset.
     * If specified, the function checks also for a subField of $fieldName.
     * In case the field could contains booleans, the parameter $checkForBoolean has
     * to be set to true.
     *
     * @param $dataset
     * @param $fieldName
     * @param null $subFieldName
     * @param bool $checkForBoolean
     * @return bool
     * @throws UserErrorException
     */
    public static function checkField($dataset, $fieldName, $subFieldName = null, $checkForBoolean = false) {

        if ($checkForBoolean) {
            if (!is_null($subFieldName)) {
                if (isset($dataset[$fieldName])) {
                    return isset($dataset[$fieldName][$subFieldName]);
                } else {
                    return false;
                }
            } else {
                return isset($dataset[$fieldName]);
            }
        }

        if (empty($dataset[$fieldName]) || (!is_null($subFieldName) && empty($dataset[$fieldName][$subFieldName]))) {
            $errMsg = 'Missing field ' . $fieldName;

            if ($subFieldName) {
                $errMsg .= ', subfield ' . $subFieldName;
            }

            throw new UserErrorException($errMsg);
        }

        return true;
    }

    /**
     * See: http://php.net/manual/en/function.array-merge-recursive.php
     *
     * @author Daniel <daniel (at) danielsmedegaardbuus (dot) dk>
     * @author Gabriel Sobrinho <gabriel (dot) sobrinho (at) gmail (dot) com>
     *
     * @param array $array1
     * @param array $array2
     * @return array
     */
    public static function array_merge_recursive_distinct(array & $array1, array & $array2) {
        $merged = $array1;

        foreach ($array2 as $key => & $value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = self::array_merge_recursive_distinct($merged[$key], $value);
            } else if (is_numeric($key)) {
                if (!in_array($value, $merged))
                    $merged[] = $value;
            } else
                $merged[$key] = $value;
        }

        return $merged;
    }

}