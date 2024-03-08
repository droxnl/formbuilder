<?php

declare(strict_types=1);

namespace Droxnl\FormBuilder;

use Droxnl\FormBuilder\Helpers\AbstractHelper;
use Droxnl\FormBuilder\Validators\FormValidator;
use Illuminate\Support\Facades\View;

class FormBuilder extends AbstractHelper
{
    /**
     * @var string
     */
    public string $style;

    /**
     * @var array
     */
    public array $config;

    /**
     * @var array
     */
    private array $form;

    /**
     * @var FormValidator
     */
    private FormValidator $formValidator;

    /**
     * @param string $style
     */
    public function __construct(string $style)
    {
        $this->formValidator = new FormValidator();
        $this->style = $this->formValidator->validateStyle($style);

        parent::__construct();
    }

    /**
     * @param $index
     * @return array
     */
    public function getConfig($index = null): array
    {
        if ($index !== null) {
            return $this->config[$index];
        }

        return $this->config;
    }

    /**
     * @param array $config
     * @return void
     */
    public function setConfig(array $config): void
    {
        /** @note validate config */
        if ($this->formValidator->validateConfig($config)) {
            $this->config = $config;

            /** @note set the form config */
            $this->form = [
                'method' => $config['method'],
                'action' => $config['action'],
                'fields' => $config['fields'],
                'classes' => $config['classes'],
            ];
        }

        throw new \InvalidArgumentException('Invalid form configuration');
    }

    /**
     * @return array
     */
    public function getForm(): array
    {
        return $this->form;
    }

    /**
     * @param array $field
     * @return string
     */
    public function parseField(array $field): string
    {
        return View::make($this->getViewPath($this->style, $this->config['fields'][$field['type']]), $field)->render();
    }

    /**
     * @param $name
     * @param $value
     * @return array
     */
    public function getDefaultConfig($name, $value = null): array
    {
        return [
            'value' => $value,
            'name' => $name,
            'id' => $name,
            'attributes' => [
                'class' => $this->getStyleClass($this->style),
                'id' => $name,
            ],
        ];
    }

    /**
     * @param string $style
     * @return string
     */
    private function getStyleClass(string $style): string
    {
        return match ($style) {
            self::TAILWIND => 'form-input',
            default => 'form-control',
        };
    }
}