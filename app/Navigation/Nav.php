<?php

namespace App\Navigation;

class Nav
{
    protected string $route = '';

    protected ?string $icon = null;

    /**
     * Navigation url.
     */
    protected ?string $url = null;

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

    /**
     * Set the url for the navigation
     */
    public function url(string $name): self
    {
        $this->url = $name;

        return $this;
    }

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
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
