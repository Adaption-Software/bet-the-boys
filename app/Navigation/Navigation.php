<?php

namespace App\Navigation;

abstract class Navigation
{
    public function __invoke(): array
    {
        return $this->buildNavigation($this->navigation());
    }

    abstract public function navigation();

    public function buildNavigation($navigation): array
    {
        return collect($navigation)
            ->map(fn ($item) => $item->definition())
            ->toArray();
    }
}
