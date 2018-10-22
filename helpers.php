<?php

use Illuminate\Support\HtmlString;

if (!function_exists('recaptcha')) {
    /**
     * Generate a reCAPTCHA.
     *
     * @param string $keyPairName
     * @return \Illuminate\Support\HtmlString
     */
    function recaptcha($keyPairName = null)
    {
        $keyPairName = $keyPairName ?: config('recaptcha.default');

        return new HtmlString(sprintf(
            '<div class="g-recaptcha" data-sitekey="%s"></div>',
            config('recaptcha.pairs.'.$keyPairName.'.site')
        ));
    }
}

if (!function_exists('recaptcha_script')) {
    /**
     * Get the reCAPTCHA script tag.
     *
     * @return \Illuminate\Support\HtmlString
     */
    function recaptcha_script($lang='en')
    {
        return new HtmlString('<script src="https://www.google.com/recaptcha/api.js?hl='.$lang.'"></script>');
    }
}

if (!function_exists('recaptcha_input')) {
    /**
     * Get the name of the reCAPTCHA input value.
     *
     * @return string
     */
    function recaptcha_input()
    {
        return 'g-recaptcha-response';
    }
}
