<?php

namespace Ilya\Recaptcha;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class RecaptchaRule implements Rule
{
    /**
     * Name of the key pair being used for validation.
     *
     * @var string
     */
    protected $keyPairName;

    /**
     * @param string $keyPairName
     */
    public function __construct($keyPairName = null)
    {
        $this->keyPairName = $keyPairName ?: config('recaptcha.default');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $options = [
            'form_params' => [
                'response' => $value,
                'remoteip' => request()->ip(),
                'secret' => config('recaptcha.pairs.'.$this->keyPairName.'.secret'),
            ],
        ];

        $response = (new Client)->post('https://www.google.com/recaptcha/api/siteverify', $options);

        return json_decode((string) $response->getBody(), true)['success'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Failed the reCAPTCHA test.';
    }
}
