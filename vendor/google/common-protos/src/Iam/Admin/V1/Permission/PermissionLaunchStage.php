<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/iam/admin/v1/iam.proto

namespace Google\Iam\Admin\V1\Permission;

use UnexpectedValueException;

/**
 * A stage representing a permission's lifecycle phase.
 *
 * Protobuf type <code>google.iam.admin.v1.Permission.PermissionLaunchStage</code>
 */
class PermissionLaunchStage
{
    /**
     * The permission is currently in an alpha phase.
     *
     * Generated from protobuf enum <code>ALPHA = 0;</code>
     */
    const ALPHA = 0;
    /**
     * The permission is currently in a beta phase.
     *
     * Generated from protobuf enum <code>BETA = 1;</code>
     */
    const BETA = 1;
    /**
     * The permission is generally available.
     *
     * Generated from protobuf enum <code>GA = 2;</code>
     */
    const GA = 2;
    /**
     * The permission is being deprecated.
     *
     * Generated from protobuf enum <code>DEPRECATED = 3;</code>
     */
    const DEPRECATED = 3;

    private static $valueToName = [
        self::ALPHA => 'ALPHA',
        self::BETA => 'BETA',
        self::GA => 'GA',
        self::DEPRECATED => 'DEPRECATED',
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

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PermissionLaunchStage::class, \Google\Iam\Admin\V1\Permission_PermissionLaunchStage::class);

