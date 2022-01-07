<?php

namespace Arctica\RestApi;

use Arctica\Contacts\Models\Contact;
use Illuminate\Http\JsonResponse;

trait JsonDataResponseTrait
{
    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function json(array $data): JsonResponse
    {
        $contacts = Contact::where('is_active', true)->get();

        $contactsMap = [
            'contacts' => false,
            'socials' => true
        ];

        foreach ($contactsMap as $key => $value) {
            $contactsResult[$key] = array_values($contacts->filter(
                function (Contact $contact) use ($value): bool {
                    return $contact->getType()->is_social == $value;
                }
            )->map(
                function (Contact $contact): array {
                    return $contact->getView();
                }
            )->toArray());
        }

        $fields = array_merge(
            ['date' => (new \DateTimeImmutable())->format(\DateTimeImmutable::ATOM)],
            $contactsResult
        );

        return response()->json(array_merge($fields, $data));
    }
}
