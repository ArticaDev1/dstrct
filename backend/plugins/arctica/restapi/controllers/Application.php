<?php

namespace Arctica\Restapi\Controllers;

use Arctica\RestApi\NotificationAlertHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class Application extends Controller
{
    private static $sendEmails = ['romaartemov1999@gmail.com'];
    private static $template = 'arctica.dstrct::contact';

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
            throw new \UnexpectedValueException('Номер телефона должен состоять из 11 цифр');
        }

        if (is_null($name)) {
            throw new \UnexpectedValueException('Поле имени должно быть заполнено');
        }

        if (is_null($from)) {
            throw new \UnexpectedValueException('Поле страницы должно быть заполнено');
        }

        $model = new \Arctica\Zayavki\Models\Application();

        $model->name = $name;
        $model->phone = $phone;
        $model->from = $from;
        $model->created_at = new \DateTimeImmutable();

        $model->save();

        NotificationAlertHelper::application($model->toEmail());

        foreach (self::$sendEmails as $email) {
            \Mail::send(self::$template, $model->toEmail(), function ($message) use ($email) {
                $message->to($email);
            });
        }

        return new JsonResponse();
    }
}
