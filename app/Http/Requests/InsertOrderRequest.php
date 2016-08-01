<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InsertOrderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //规则
    public function rules()
    {
        return [
            //
            'linkman'=>'required',
            'address'=>'required',
            'code'=>'required|regex:/^\d{6}$/',
            'phone'=>'required|regex:/^\d{11}$/',
            'total'=>'required|regex:/^\d*$/',
        ];
    }
    //规则描述
    public function messages()
    {
        return [
            'linkman.required'=>'联系人不能为空',
            'address.required'=>'地址不能为空',
            'code.required'=>'邮编不能为空',
            'code.regex'=>'请输入6位邮编号码',
            'phone.required'=>'电话不能为空',
            'phone.regex'=>'请输入11位电话号码',
            'total.required'=>'总金额不能为空',
            'total.regex'=>'总金额不能小于0',
            ];
    }     
}
