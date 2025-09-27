<?php

namespace Niksms\Models;

/**
 * Request model for sending OTP SMS
 */
class SendSmsOtpRequest extends BaseModel
{
    /** @var string */
    public $ApiKey;

    /** @var string */
    public $SenderNumber;

    /** @var string */
    public $Phone;

    /** @var string */
    public $Message;

    /** @var string */
    public $ServiceType;

    /** @var int */
    public $ApiType;

    /** @var string|null */
    public $MessageId;

    /** @var string|null */
    public $SendDate;

    /** @var int|null */
    public $SendType;
}
