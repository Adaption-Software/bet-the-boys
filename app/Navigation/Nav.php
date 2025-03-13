<?php

namespace App\Navigation;

class Nav
{

    protected string $route = '';
    protected ?string $icon = null;

    final public function __construct(protected string $label) {}

    public static function make($label): static
    {
        return new static($label);
    }

    public function route(string $route): static
    {
        $this->route = $route;

        return $this;
    }

    public function icon($icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function definition(): array
    {
        return [
            'label' => $this->label,
            'route' => $this->route,
            'icon' => $this->icon,
        ];
    }
}
