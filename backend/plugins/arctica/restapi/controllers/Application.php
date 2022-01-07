<?php

namespace Arctica\Restapi\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class Application extends Controller
{
    /**
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public static function postApplication(): JsonResponse
    {
        $input = Input::only('phone', 'name', 'from');

        $name = $input['name'] ?? null;
        $from = $input['from'] ?? null;
        preg_match('/\d{11}/', $input['phone'] ?? null, $phone);
        $phone = current($phone);

        if (!$phone) {
            throw new \Exception('Номер телефона должен состоять из 11 цифр');
        }

        if (is_null($name)) {
            throw new \Exception('Поле имени должно быть заполнено');
        }

        if (is_null($from)) {
            throw new \Exception('Поле страницы должно быть заполнено');
        }

        $model = new \Arctica\Zayavki\Models\Application();

        $model->name = $name;
        $model->phone = $phone;
        $model->from = $from;
        $model->created_at = new \DateTimeImmutable();

        $model->save();


        return new JsonResponse();
    }
}
