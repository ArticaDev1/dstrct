<?php

namespace Arctica\RestApi;

class NotificationAlertHelper
{
    /**
     * @param string $message
     *
     * @return void
     */
    public static function alert(string $message): void
    {
        $project = 'https://dstrct-bureau.com';
        $botToken = "2105577357:AAH6N7YrKKuJ3O7FGlNWR7Sk7eYfRatxIZg";

        $chatId = '-733987107';
        $params = [
            'chat_id' => $chatId,
            'text' => sprintf('project: %s' . PHP_EOL . 'message: %s', $project, $message),
        ];

        self::send($botToken, $chatId, $params);
    }

    /**
     * @param array $applicationData
     *
     * @return void
     */
    public static function application(array $applicationData): void
    {
        $project = 'https://dstrct-bureau.com';
        $botToken = '5086821840:AAH1FYzQVNVnHLbdtzZ6m3JIq0lL8_Y6SXU';
        $chatId = '417893004';

        $params = [
            'chat_id' => $chatId,
            'text' => sprintf(
                'У вас новая заявка на сайте %s :' . PHP_EOL .
                '  <i>От клиента:</i> <b>%s</b>' . PHP_EOL .
                '  <i>Номер телефона:</i> <b>+%s</b>' . PHP_EOL .
                '  <i>Со страницы:</i> <b>%s</b>',
                $project,
                $applicationData['name'],
                $applicationData['phone'],
                $applicationData['url']
            ),
            'parse_mode' => 'HTML'
        ];

        self::send($botToken, $chatId, $params);
    }

    /**
     * @param $botToken
     * @param $chatId
     * @param $params
     *
     * @return void
     */
    private static function send($botToken, $chatId, $params): void
    {
        $ch = curl_init("https://api.telegram.org/bot" . $botToken . '/sendMessage');

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        curl_close($ch);
    }
}
