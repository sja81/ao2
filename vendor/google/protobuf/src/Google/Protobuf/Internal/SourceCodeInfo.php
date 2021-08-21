<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/descriptor.proto

namespace Google\Protobuf\Internal;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\GPBWire;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\InputStream;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Encapsulates information about the original source file from which a
 * FileDescriptorProto was generated.
 *
 * Generated from protobuf message <code>google.protobuf.SourceCodeInfo</code>
 */
final class SourceCodeInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * A Location identifies a piece of source code in a .proto file which
     * corresponds to a particular definition.  This information is intended
     * to be useful to IDEs, code indexers, documentation generators, and similar
     * tools.
     * For example, say we have a file like:
     *   message Foo {
     *     optional string foo = 1;
     *   }
     * Let's look at just the field definition:
     *   optional string foo = 1;
     *   ^       ^^     ^^  ^  ^^^
     *   a       bc     de  f  ghi
     * We have the following locations:
     *   span   path               represents
     *   [a,i)  [ 4, 0, 2, 0 ]     The whole field definition.
     *   [a,b)  [ 4, 0, 2, 0, 4 ]  The label (optional).
     *   [c,d)  [ 4, 0, 2, 0, 5 ]  The type (string).
     *   [e,f)  [ 4, 0, 2, 0, 1 ]  The name (foo).
     *   [g,h)  [ 4, 0, 2, 0, 3 ]  The number (1).
     * Notes:
     * - A location may refer to a repeated field itself (i.e. not to any
     *   particular index within it).  This is used whenever a set of elements are
     *   logically enclosed in a single code segment.  For example, an entire
     *   extend block (possibly containing multiple extension definitions) will
     *   have an outer location whose path refers to the "extensions" repeated
     *   field without an index.
     * - Multiple locations may have the same path.  This happens when a single
     *   logical declaration is spread out across multiple places.  The most
     *   obvious example is the "extend" block again -- there may be multiple
     *   extend blocks in the same scope, each of which will have the same path.
     * - A location's span is not always a subset of its parent's span.  For
     *   example, the "extendee" of an extension declaration appears at the
     *   beginning of the "extend" block and is shared by all extensions within
     *   the block.
     * - Just because a location's span is a subset of some other location's span
     *   does not mean that it is a descendant.  For example, a "group" defines
     *   both a type and a field in a single declaration.  Thus, the locations
     *   corresponding to the type and field and their components will overlap.
     * - Code which tries to interpret locations should probably be designed to
     *   ignore those that it doesn't understand, as more types of locations could
     *   be recorded in the future.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.SourceCodeInfo.Location location = 1;</code>
     */
    private $location;
    private $has_location = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Protobuf\Internal\SourceCodeInfo\Location[]|\Google\Protobuf\Internal\RepeatedField $location
     *           A Location identifies a piece of source code in a .proto file which
     *           corresponds to a particular definition.  This information is intended
     *           to be useful to IDEs, code indexers, documentation generators, and similar
     *           tools.
     *           For example, say we have a file like:
     *             message Foo {
     *               optional string foo = 1;
     *             }
     *           Let's look at just the field definition:
     *             optional string foo = 1;
     *             ^       ^^     ^^  ^  ^^^
     *             a       bc     de  f  ghi
     *           We have the following locations:
     *             span   path               represents
     *             [a,i)  [ 4, 0, 2, 0 ]     The whole field definition.
     *             [a,b)  [ 4, 0, 2, 0, 4 ]  The label (optional).
     *             [c,d)  [ 4, 0, 2, 0, 5 ]  The type (string).
     *             [e,f)  [ 4, 0, 2, 0, 1 ]  The name (foo).
     *             [g,h)  [ 4, 0, 2, 0, 3 ]  The number (1).
     *           Notes:
     *           - A location may refer to a repeated field itself (i.e. not to any
     *             particular index within it).  This is used whenever a set of elements are
     *             logically enclosed in a single code segment.  For example, an entire
     *             extend block (possibly containing multiple extension definitions) will
     *             have an outer location whose path refers to the "extensions" repeated
     *             field without an index.
     *           - Multiple locations may have the same path.  This happens when a single
     *             logical declaration is spread out across multiple places.  The most
     *             obvious example is the "extend" block again -- there may be multiple
     *             extend blocks in the same scope, each of which will have the same path.
     *           - A location's span is not always a subset of its parent's span.  For
     *             example, the "extendee" of an extension declaration appears at the
     *             beginning of the "extend" block and is shared by all extensions within
     *             the block.
     *           - Just because a location's span is a subset of some other location's span
     *             does not mean that it is a descendant.  For example, a "group" defines
     *             both a type and a field in a single declaration.  Thus, the locations
     *             corresponding to the type and field and their components will overlap.
     *           - Code which tries to interpret locations should probably be designed to
     *             ignore those that it doesn't understand, as more types of locations could
     *             be recorded in the future.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Protobuf\Internal\Descriptor::initOnce();
        parent::__construct($data);
    }

    /**
     * A Location identifies a piece of source code in a .proto file which
     * corresponds to a particular definition.  This information is intended
     * to be useful to IDEs, code indexers, documentation generators, and similar
     * tools.
     * For example, say we have a file like:
     *   message Foo {
     *     optional string foo = 1;
     *   }
     * Let's look at just the field definition:
     *   optional string foo = 1;
     *   ^       ^^     ^^  ^  ^^^
     *   a       bc     de  f  ghi
     * We have the following locations:
     *   span   path               represents
     *   [a,i)  [ 4, 0, 2, 0 ]     The whole field definition.
     *   [a,b)  [ 4, 0, 2, 0, 4 ]  The label (optional).
     *   [c,d)  [ 4, 0, 2, 0, 5 ]  The type (string).
     *   [e,f)  [ 4, 0, 2, 0, 1 ]  The name (foo).
     *   [g,h)  [ 4, 0, 2, 0, 3 ]  The number (1).
     * Notes:
     * - A location may refer to a repeated field itself (i.e. not to any
     *   particular index within it).  This is used whenever a set of elements are
     *   logically enclosed in a single code segment.  For example, an entire
     *   extend block (possibly containing multiple extension definitions) will
     *   have an outer location whose path refers to the "extensions" repeated
     *   field without an index.
     * - Multiple locations may have the same path.  This happens when a single
     *   logical declaration is spread out across multiple places.  The most
     *   obvious example is the "extend" block again -- there may be multiple
     *   extend blocks in the same scope, each of which will have the same path.
     * - A location's span is not always a subset of its parent's span.  For
     *   example, the "extendee" of an extension declaration appears at the
     *   beginning of the "extend" block and is shared by all extensions within
     *   the block.
     * - Just because a location's span is a subset of some other location's span
     *   does not mean that it is a descendant.  For example, a "group" defines
     *   both a type and a field in a single declaration.  Thus, the locations
     *   corresponding to the type and field and their components will overlap.
     * - Code which tries to interpret locations should probably be designed to
     *   ignore those that it doesn't understand, as more types of locations could
     *   be recorded in the future.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.SourceCodeInfo.Location location = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * A Location identifies a piece of source code in a .proto file which
     * corresponds to a particular definition.  This information is intended
     * to be useful to IDEs, code indexers, documentation generators, and similar
     * tools.
     * For example, say we have a file like:
     *   message Foo {
     *     optional string foo = 1;
     *   }
     * Let's look at just the field definition:
     *   optional string foo = 1;
     *   ^       ^^     ^^  ^  ^^^
     *   a       bc     de  f  ghi
     * We have the following locations:
     *   span   path               represents
     *   [a,i)  [ 4, 0, 2, 0 ]     The whole field definition.
     *   [a,b)  [ 4, 0, 2, 0, 4 ]  The label (optional).
     *   [c,d)  [ 4, 0, 2, 0, 5 ]  The type (string).
     *   [e,f)  [ 4, 0, 2, 0, 1 ]  The name (foo).
     *   [g,h)  [ 4, 0, 2, 0, 3 ]  The number (1).
     * Notes:
     * - A location may refer to a repeated field itself (i.e. not to any
     *   particular index within it).  This is used whenever a set of elements are
     *   logically enclosed in a single code segment.  For example, an entire
     *   extend block (possibly containing multiple extension definitions) will
     *   have an outer location whose path refers to the "extensions" repeated
     *   field without an index.
     * - Multiple locations may have the same path.  This happens when a single
     *   logical declaration is spread out across multiple places.  The most
     *   obvious example is the "extend" block again -- there may be multiple
     *   extend blocks in the same scope, each of which will have the same path.
     * - A location's span is not always a subset of its parent's span.  For
     *   example, the "extendee" of an extension declaration appears at the
     *   beginning of the "extend" block and is shared by all extensions within
     *   the block.
     * - Just because a location's span is a subset of some other location's span
     *   does not mean that it is a descendant.  For example, a "group" defines
     *   both a type and a field in a single declaration.  Thus, the locations
     *   corresponding to the type and field and their components will overlap.
     * - Code which tries to interpret locations should probably be designed to
     *   ignore those that it doesn't understand, as more types of locations could
     *   be recorded in the future.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.SourceCodeInfo.Location location = 1;</code>
     * @param \Google\Protobuf\Internal\SourceCodeInfo\Location[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLocation($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Protobuf\Internal\SourceCodeInfo\Location::class);
        $this->location = $arr;
        $this->has_location = true;

        return $this;
    }

    public function hasLocation()
    {
        return $this->has_location;
    }

}

