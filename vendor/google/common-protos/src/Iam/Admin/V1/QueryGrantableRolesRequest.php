<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/iam/admin/v1/iam.proto

namespace Google\Iam\Admin\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The grantable role query request.
 *
 * Generated from protobuf message <code>google.iam.admin.v1.QueryGrantableRolesRequest</code>
 */
class QueryGrantableRolesRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The full resource name to query from the list of grantable roles.
     * The name follows the Google Cloud Platform resource format.
     * For example, a Cloud Platform project with id `my-project` will be named
     * `//cloudresourcemanager.googleapis.com/projects/my-project`.
     *
     * Generated from protobuf field <code>string full_resource_name = 1;</code>
     */
    private $full_resource_name = '';
    /**
     * Generated from protobuf field <code>.google.iam.admin.v1.RoleView view = 2;</code>
     */
    private $view = 0;
    /**
     * Optional limit on the number of roles to include in the response.
     *
     * Generated from protobuf field <code>int32 page_size = 3;</code>
     */
    private $page_size = 0;
    /**
     * Optional pagination token returned in an earlier
     * QueryGrantableRolesResponse.
     *
     * Generated from protobuf field <code>string page_token = 4;</code>
     */
    private $page_token = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $full_resource_name
     *           Required. The full resource name to query from the list of grantable roles.
     *           The name follows the Google Cloud Platform resource format.
     *           For example, a Cloud Platform project with id `my-project` will be named
     *           `//cloudresourcemanager.googleapis.com/projects/my-project`.
     *     @type int $view
     *     @type int $page_size
     *           Optional limit on the number of roles to include in the response.
     *     @type string $page_token
     *           Optional pagination token returned in an earlier
     *           QueryGrantableRolesResponse.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Iam\Admin\V1\Iam::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The full resource name to query from the list of grantable roles.
     * The name follows the Google Cloud Platform resource format.
     * For example, a Cloud Platform project with id `my-project` will be named
     * `//cloudresourcemanager.googleapis.com/projects/my-project`.
     *
     * Generated from protobuf field <code>string full_resource_name = 1;</code>
     * @return string
     */
    public function getFullResourceName()
    {
        return $this->full_resource_name;
    }

    /**
     * Required. The full resource name to query from the list of grantable roles.
     * The name follows the Google Cloud Platform resource format.
     * For example, a Cloud Platform project with id `my-project` will be named
     * `//cloudresourcemanager.googleapis.com/projects/my-project`.
     *
     * Generated from protobuf field <code>string full_resource_name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFullResourceName($var)
    {
        GPBUtil::checkString($var, True);
        $this->full_resource_name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.iam.admin.v1.RoleView view = 2;</code>
     * @return int
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Generated from protobuf field <code>.google.iam.admin.v1.RoleView view = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setView($var)
    {
        GPBUtil::checkEnum($var, \Google\Iam\Admin\V1\RoleView::class);
        $this->view = $var;

        return $this;
    }

    /**
     * Optional limit on the number of roles to include in the response.
     *
     * Generated from protobuf field <code>int32 page_size = 3;</code>
     * @return int
     */
    public function getPageSize()
    {
        return $this->page_size;
    }

    /**
     * Optional limit on the number of roles to include in the response.
     *
     * Generated from protobuf field <code>int32 page_size = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setPageSize($var)
    {
        GPBUtil::checkInt32($var);
        $this->page_size = $var;

        return $this;
    }

    /**
     * Optional pagination token returned in an earlier
     * QueryGrantableRolesResponse.
     *
     * Generated from protobuf field <code>string page_token = 4;</code>
     * @return string
     */
    public function getPageToken()
    {
        return $this->page_token;
    }

    /**
     * Optional pagination token returned in an earlier
     * QueryGrantableRolesResponse.
     *
     * Generated from protobuf field <code>string page_token = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setPageToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->page_token = $var;

        return $this;
    }

}

