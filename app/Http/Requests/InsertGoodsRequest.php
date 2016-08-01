<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InsertGoodsRequest extends Request
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
    public function rules()
    {
        return [
            //
            'typeid'=>'required',
            'goods'=>'required',
            'company'=>'required',
            'descr'=>'required',
            'price'=>'required',
            'picname'=>'required',
            'store'=>'required',
            'state'=>'required',

        ];
    }
    //规则描述
    public function messages()
    {
        return [
            //
            'typeid.required'=>'类别不能为空',
            'goods.required'=>'商品名称不能为空',
            'company.required'=>'生产厂家不能为空',
            'descr.required'=>'描述不能为空',
            'price.required'=>'单价不能为空',
            'picname.required'=>'图片不能为空',
            'store.required'=>'库存量不能为空',
            'state.required'=>'状态不能为空',
        ];
    }
}
