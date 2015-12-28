<?php
namespace PhalconUtils\Validation\Validator;

use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;
use Phalcon\Validation\Message;
use Phalcon\DI;

class Phone extends Validator implements ValidatorInterface
{

  public function __construct($options = null)
  {

    parent::__construct($options);
    $this->setOption('cancelOnFail', TRUE);

  }


  public function validate($validator, $attribute)
  {

    $value = $validator->getValue($attribute);

    // Source https://ericholmes.ca/php-phone-number-validation-revisited/
    $regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";

    if (preg_match($regex, $value)) {

      // If phone number is valid
      return TRUE;

    }

    // If value is not valid, set error
    $message = $this->getOption('message');
    if (!$message) {

      // Set default error
      $message = 'Phone number must be in the format: (555) 555-5555';

    }

    $validator->appendMessage(new Message($message, $attribute, 'Phone'));

    return FALSE;

  }

}
