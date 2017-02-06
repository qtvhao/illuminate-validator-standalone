<?php
/**
 * @package      WFCore
 * @subpackage   Factory
 * @author       Aluent Group
 * @copyright    Copyright (C) 2015 Aluent Group, Inc. All rights reserved.
 */

namespace Haonx\Validation;


class Validator extends \Illuminate\Validation\Validator
{
    public function getRulesForJqueryValidation()
    {
        return json_encode($this->getRules());
    }
}
