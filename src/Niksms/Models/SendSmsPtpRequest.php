<?php

namespace Niksms\Models;

/**
 * Request model for sending PTP (Point to Point) SMS
 */
class SendSmsPtpRequest extends BaseModel
{
    /** @var string */
    public $ApiKey;

    /** @var string */
    public $SenderNumber;

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
