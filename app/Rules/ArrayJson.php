<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ArrayJson implements Rule
{
    protected $rules;
    protected $errorMessage;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $json)
    {
        if(is_array($json)){
            $list = $json;
        }else{
            $list = json_decode($json, true);
        }
        if(is_integer($list) || is_string($list)){
            return false;
        }
        if (empty($list)) {
            return false;
        }

        $result = $this->validatorJsonArray($list);
        return $result;
    }

    /**
     * @param $data
     * @return bool
     */
    public function validatorJsonArray($list)
    {
        if ($this->isAssocArray($list)) {
            return $this->check_column($list);
        } else {
            foreach ($list as $item) {
                $isAssocArray = $this->isAssocArray($item);
                if ($isAssocArray === false) {
                    $this->errorMessage = '参数错误';
                    return false;
                }
                $result = $this->check_column($item);
                if ($result === false) {
                    return false;
                }
            }
            return true;
        }
    }

    public function check_column($checkData)
    {
        $rules = $this->rules;
        foreach ($rules as $key => $rule) {
            $value = isset($checkData[$key]) ? $checkData[$key] : null;
            $validator = Validator::make([$key => $value], [$key => $rule]);
            if ($validator->fails()) {
                $errorList = $validator->errors()->get($key);
                $this->errorMessage = $errorList[0];
                return false;
            }
            if (!empty($this->errorMessage)) {
                return false;
            }
        }
        return true;

    }

    public function isAssocArray($array)
    {
        if (count(array_filter(array_keys($array), 'is_string')) > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'json Inválido';
    }
}
