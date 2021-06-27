<?php

namespace App\Http\Constants ;

trait APIConstants {
    public $email                                               = 'email';
    public $passString                                          = 'password';
    public $tokenExpired                                        = 'TOKEN_EXPIRED';
    public $unAuthenticated                                     = 'UNAUTHENTICATED';
    public $code                                                = 'code';
    public $message                                             = 'message';
    public $error                                               = 'error';
    public $required                                            = 'required';
    public $string                                              = 'string';
    public $validationMax                                       = 'max:';
    public $validationMin                                       = 'min:';
    public $numeric                                             = 'numeric';
    public $digits                                              = 'digits:';
    public $status                                              = 'status';
    public $data                                                = 'data';
    public $sometimes                                           = 'sometimes';
    public $MaxRecordLimit                                      = 1000;
    public $date                                                = 'date';
    public $dateTime                                            = 'dateTime';
    public $endDate                                             = 'endDate';
}
