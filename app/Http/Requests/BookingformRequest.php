<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingformRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // return [
        //             'pickuptime' => [
        //                 'required',
        //                 'string'
        //             ],
        //             'pickupdate' => [
        //                 'required',
        //                 'string'
        //             ],
        //             'dropofftime' => [
        //                 'required',
        //                 'string'
        //             ],
        //             'dropoffdate' => [
        //                 'required',
        //                 'string'
        //             ],
        //             'destination' => [
        //                 'required',
        //                 'string'
        //             ],

        //             'daytrip' => [
        //                 'required',
        //                 'string'
        //             ],

        //         ];
            }
}
