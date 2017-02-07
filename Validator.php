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
    public $remoteUrl;

    public function getJqueryValidationOptions()
    {
        $jQueryValidationOptions = [];
        foreach ($this->rules as $attribute => $rules) {
            foreach ($rules as $rule) {
                list($rule, $parameters) = ValidationRuleParser::parse($rule);
                if ($rule == '') {
                    continue;
                }
                $methodApplierJquery = "jQueryValidatorApply{$rule}";
                $jQueryValidationOptions = $this->$methodApplierJquery($jQueryValidationOptions, $attribute, $parameters);
            }
        }

        return $jQueryValidationOptions;
    }

    public function jQueryValidatorApplyRequired($results, $attribute, $parameters)
    {
        data_set($results, "rules.{$attribute}.required", true);

        return $results;
    }

    public function jQueryValidatorApplyUnique($results, $attribute, $parameters)
    {
        data_set($results, "rules.{$attribute}.remote", data_get($this, 'remoteUrl', 'jquery-validation-remoter.php?selector=' . implode('.',$parameters)));

        return $results;
    }

    public function jQueryValidatorApplyIn($results, $attribute, $parameters)
    {
        throw new \Exception();
    }

    public function jQueryValidatorApplyBetween($results, $attribute, $parameters)
    {
        $minLength = $parameters[0];
        $maxLength = $parameters[1];
        data_set($results, "rules.{$attribute}.minlength", $minLength);
        data_set($results, "rules.{$attribute}.maxlength", $maxLength);

        return $results;
    }

    public function jQueryValidatorApplyEmail($results, $attribute, $parameters)
    {
        data_set($results, "rules.{$attribute}.email", true);

        return $results;
    }

    public function jQueryValidatorApplyUrl($results, $attribute, $parameters)
    {
        data_set($results, "rules.{$attribute}.url", true);

        return $results;
    }

    public function jQueryValidatorApplySame($results, $attribute, $parameters)
    {
        data_set($results, "rules.{$attribute}.equalTo", "[name={$parameters[0]}]");

        return $results;
    }


}