<?php

declare(strict_types=1);

namespace Droxnl\FormBuilder\Helpers;

class AbstractHelper implements Constants
{
    public array $baseConfig;

    public function __construct()
    {
        $this->init();
    }

    /**
     * @return void
     */
    public function init(): void
    {
        /** @note set available styles */
        $this->baseConfig['availableStyles'] = [
            self::BOOTSTRAP => [
                'version' => '5.0.0',
                'url' => 'https://getbootstrap.com/docs/5.0/forms/overview/',
                'default' => 'form-control'
            ],
            self::TAILWIND => [
                'version' => '2.0.2',
                'url' => 'https://tailwindcss.com/docs/forms',
                'default' => 'form-input'
            ],
        ];

        /** @note set available fields */
        $this->baseConfig['fields'] = [
            self::TEXT => 'text',
            self::TEXTAREA => 'textarea',
            self::SELECT => 'select',
            self::CHECKBOX => 'checkbox',
            self::RADIO => 'radio',
            self::FILE => 'file',
            self::HIDDEN => 'hidden',
            self::BUTTON => 'button',
            self::SUBMIT => 'submit',
            self::RESET => 'reset',
            self::COLOR => 'color',
            self::RANGE => 'range',
            self::SEARCH => 'search',
            self::TEL => 'tel',
            self::URL => 'url',
            self::EMAIL => 'email',
            self::PASSWORD => 'password',
            self::NUMBER => 'number',
            self::DATE => 'date',
            self::TIME => 'time',
            self::DATETIME => 'datetime-local',
        ];
    }

    /**
     * @param $style
     * @param null $type
     * @return string
     */
    public function getViewPath($style, $type = null): string
    {
        if ($type) {
            return sprintf('views.%s.inputs.%s', $style, $type);
        }

        return sprintf('views.%s', $style);
    }

    /**
     * @param string $type
     * @return string
     */
    public function getField(string $type): string
    {
        return $this->baseConfig['fields'][$type];
    }
}