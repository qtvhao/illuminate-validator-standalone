<?php
namespace Haonx\Validation;

use Illuminate\Validation\ValidationRuleParser;

/**
 * Created by PhpStorm.
 * User: qtvha
 * Date: 2/6/2017
 * Time: 3:56 AM
 */
class Validator extends \Illuminate\Validation\Validator
{
    public function getRulesForJqueryValidation()
    {
        foreach ($this->rules as $attribute => $rules) {
            foreach ($rules as $rule) {
                list($rule, $parameters) = ValidationRuleParser::parse($rule);
                if ($rule == '') {
                    return;
                }
                print_r($rule);
                print_r($parameters);
            }
        }
    }
}