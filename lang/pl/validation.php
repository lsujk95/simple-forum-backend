<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'incorrect_credentials' => 'Wprowadzone dane nie są prawidłowe.',
    'user_already_exists' => 'Użytkownik o podanym adresie email już istnieje.',

    'accepted' => 'Pole :attribute musi zostać zaakceptowane.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'Wartość pola :attribute nie jest poprawnym adresem URL.',
    'after' => 'Wartość pola :attribute musi być datą po :date.',
    'after_or_equal' => 'Wartość pola :attribute musi być datą po lub równą :date.',
    'alpha' => 'Wartość pola :attribute może składać się tylko z liter.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'Wartość pola :attribute musi być liczbą pomiędzy :min a :max.',
        'file' => ':attribute musi mieć pomiędzy :min a :max kb.',
        'string' => ':attribute musi mieć pomiędzy :min a :max znaków.',
        'array' => ':attribute musi mieć pomiędzy :min a :max elementów.',
    ],
    'boolean' => 'Wartość pola :attribute pole musi być wartością logiczną.',
    'confirmed' => ':attribute potwierdzenie nie zgadza się.',
    'current_password' => 'The password is incorrect.',
    'date' => 'Wartość pola :attribute nie jest poprawną datą.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :attribute may not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute may not start with one of the following: :values.',
    'email' => ':attribute musi być poprawnym adresem email.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => ':attribute musi być plikiem',
    'filled' => 'Pole :attribute musi być wypełnione.',
    'gt' => [
        'array' => 'The :attribute must have more than :value items.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute must have :value items or more.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
    ],
    'image' => ':attribute musi być obrazem.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'Wartość pola :attribute musi być liczbą.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'array' => 'The :attribute must have less than :value items.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'numeric' => 'The :attribute must be less than :value.',
        'string' => 'The :attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute must not have more than :value items.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'numeric' => 'Wartość pola :attribute nie może być większa od :max.',
        'file' => ':attribute nie może być większy niż :max kb.',
        'string' => 'Wartość pola :attribute nie może być dłuższy niż :max znaków.',
        'array' => 'Wartość pola :attribute nie może mieć więcej niż :max elementów.',
    ],
    'max_digits' => 'The :attribute must not have more than :max digits.',
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'Wartość pola :attribute musi wynosić conajmniej :min.',
        'file' => ':attribute musi mieć conajmniej :min kb.',
        'string' => 'Wartość pola :attribute musi mieć conajmniej :min znaków.',
        'array' => 'Wartość pola :attribute musi mieć conajmniej :min elementów.',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'multiple_of' => ':attribute musi być wielokrotnością :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Wartość pola :attribute musi być liczbą.',
    'password' => [
        'letters' => ':attribute musi zawierać przynajmniej jedna literę.',
        'mixed' => ':attribute musi zawierać przynajmniej jedną dużą i jedną małą literę..',
        'numbers' => ':attribute musi zawierać przynajmniej jedną cyfrę.',
        'symbols' => ':attribute musi zawierać przynajmniej jeden symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'Pole :attribute jest wymagane.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
