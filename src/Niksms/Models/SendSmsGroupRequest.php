<?php

namespace Niksms\Models;

/**
 * Request model for sending group SMS
 */
class SendSmsGroupRequest extends BaseModel
{
    /** @var string */
    public $ApiKey;

    /** @var string */
    public $SenderNumber;

    /** @var string */
    public $Message;

    /** @var array */
    public $Recipients;

    /** @var string */
    public $ServiceType;

    /** @var int */
    public $ApiType;

    /** @var string|null */
    public $SendDate;

    /** @var int|null */
    public $SendType;
}
