<?php

declare(strict_types=1);

namespace Droxnl\FormBuilder\Validators;

use Droxnl\FormBuilder\Helpers\Constants;

class FormValidator
{
    /**
     * @param array $config
     * @return bool
     */
    public function validateConfig(array $config): bool
    {
        /** @note if method is not set */
        if (!isset($config['method'])) {
            throw new \InvalidArgumentException('Method is required');
        }

        /** @note validate available methods */
        if (!in_array($config['method'], Constants::METHODS, true)) {
            throw new \InvalidArgumentException('Invalid method');
        }

        if (!isset($config['action'])) {
            throw new \InvalidArgumentException('Action is required');
        }

        if (!isset($config['fields'])) {
            throw new \InvalidArgumentException('Fields are required');
        }

        if (!isset($config['classes'])) {
            throw new \InvalidArgumentException('Classes are required');
        }

        return true;
    }

    /**
     * @param string $style
     * @return string|null
     */
    public function validateStyle(string $style): ?string
    {
        if (!in_array($style, [Constants::BOOTSTRAP, Constants::TAILWIND], true)) {
            throw new \InvalidArgumentException('Invalid style');
        }

        return $style;
    }
}