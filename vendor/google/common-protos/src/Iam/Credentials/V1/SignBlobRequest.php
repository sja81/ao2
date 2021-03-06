<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/iam/credentials/v1/common.proto

namespace Google\Iam\Credentials\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>google.iam.credentials.v1.SignBlobRequest</code>
 */
class SignBlobRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * The resource name of the service account for which the credentials
     * are requested, in the following format:
     * `projects/-/serviceAccounts/{ACCOUNT_EMAIL_OR_UNIQUEID}`.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    private $name = '';
    /**
     * The sequence of service accounts in a delegation chain. Each service
     * account must be granted the `roles/iam.serviceAccountTokenCreator` role
     * on its next service account in the chain. The last service account in the
     * chain must be granted the `roles/iam.serviceAccountTokenCreator` role
     * on the service account that is specified in the `name` field of the
     * request.
     * The delegates must have the following format:
     * `projects/-/serviceAccounts/{ACCOUNT_EMAIL_OR_UNIQUEID}`
     *
     * Generated from protobuf field <code>repeated string delegates = 3;</code>
     */
    private $delegates;
    /**
     * The bytes to sign.
     *
     * Generated from protobuf field <code>bytes payload = 5;</code>
     */
    private $payload = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *           The resource name of the service account for which the credentials
     *           are requested, in the following format:
     *           `projects/-/serviceAccounts/{ACCOUNT_EMAIL_OR_UNIQUEID}`.
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $delegates
     *           The sequence of service accounts in a delegation chain. Each service
     *           account must be granted the `roles/iam.serviceAccountTokenCreator` role
     *           on its next service account in the chain. The last service account in the
     *           chain must be granted the `roles/iam.serviceAccountTokenCreator` role
     *           on the service account that is specified in the `name` field of the
     *           request.
     *           The delegates must have the following format:
     *           `projects/-/serviceAccounts/{ACCOUNT_EMAIL_OR_UNIQUEID}`
     *     @type string $payload
     *           The bytes to sign.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Iam\Credentials\V1\Common::initOnce();
        parent::__construct($data);
    }

    /**
     * The resource name of the service account for which the credentials
     * are requested, in the following format:
     * `projects/-/serviceAccounts/{ACCOUNT_EMAIL_OR_UNIQUEID}`.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The resource name of the service account for which the credentials
     * are requested, in the following format:
     * `projects/-/serviceAccounts/{ACCOUNT_EMAIL_OR_UNIQUEID}`.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * The sequence of service accounts in a delegation chain. Each service
     * account must be granted the `roles/iam.serviceAccountTokenCreator` role
     * on its next service account in the chain. The last service account in the
     * chain must be granted the `roles/iam.serviceAccountTokenCreator` role
     * on the service account that is specified in the `name` field of the
     * request.
     * The delegates must have the following format:
     * `projects/-/serviceAccounts/{ACCOUNT_EMAIL_OR_UNIQUEID}`
     *
     * Generated from protobuf field <code>repeated string delegates = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getDelegates()
    {
        return $this->delegates;
    }

    /**
     * The sequence of service accounts in a delegation chain. Each service
     * account must be granted the `roles/iam.serviceAccountTokenCreator` role
     * on its next service account in the chain. The last service account in the
     * chain must be granted the `roles/iam.serviceAccountTokenCreator` role
     * on the service account that is specified in the `name` field of the
     * request.
     * The delegates must have the following format:
     * `projects/-/serviceAccounts/{ACCOUNT_EMAIL_OR_UNIQUEID}`
     *
     * Generated from protobuf field <code>repeated string delegates = 3;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setDelegates($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->delegates = $arr;

        return $this;
    }

    /**
     * The bytes to sign.
     *
     * Generated from protobuf field <code>bytes payload = 5;</code>
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * The bytes to sign.
     *
     * Generated from protobuf field <code>bytes payload = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setPayload($var)
    {
        GPBUtil::checkString($var, False);
        $this->payload = $var;

        return $this;
    }

}

