<?php

namespace Population\Manipule\Rules;

use Locaravel\ValueObjects\Latitude;
use Illuminate\Contracts\Validation\Rule;
use InvalidArgumentException;

/**
 * Class LatitudeRule.
 *
 * @package Population\Manipule\Rules
 */
class LatitudeRule implements Rule
{
    /**
     * @inheritdoc
     */
    public function passes($attribute, $value)
    {
        try {
            new Latitude($value);
            return true;
        } catch (InvalidArgumentException $e) {
            return false;
        }
    }

    /**
     * @inheritdoc
     *
     * @return array|null|string
     */
    public function message()
    {
        return __('validation.latitude');
    }
}
