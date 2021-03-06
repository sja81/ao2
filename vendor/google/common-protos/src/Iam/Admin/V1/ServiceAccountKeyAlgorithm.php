<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/iam/admin/v1/iam.proto

namespace Google\Iam\Admin\V1;

use UnexpectedValueException;

/**
 * Supported key algorithms.
 *
 * Protobuf type <code>google.iam.admin.v1.ServiceAccountKeyAlgorithm</code>
 */
class ServiceAccountKeyAlgorithm
{
    /**
     * An unspecified key algorithm.
     *
     * Generated from protobuf enum <code>KEY_ALG_UNSPECIFIED = 0;</code>
     */
    const KEY_ALG_UNSPECIFIED = 0;
    /**
     * 1k RSA Key.
     *
     * Generated from protobuf enum <code>KEY_ALG_RSA_1024 = 1;</code>
     */
    const KEY_ALG_RSA_1024 = 1;
    /**
     * 2k RSA Key.
     *
     * Generated from protobuf enum <code>KEY_ALG_RSA_2048 = 2;</code>
     */
    const KEY_ALG_RSA_2048 = 2;

    private static $valueToName = [
        self::KEY_ALG_UNSPECIFIED => 'KEY_ALG_UNSPECIFIED',
        self::KEY_ALG_RSA_1024 => 'KEY_ALG_RSA_1024',
        self::KEY_ALG_RSA_2048 => 'KEY_ALG_RSA_2048',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

