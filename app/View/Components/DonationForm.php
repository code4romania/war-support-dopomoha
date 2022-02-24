<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class DonationForm extends Component
{
    public string $gateway;

    public string $action;

    public bool $recurring = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $gateway)
    {
        $this->gateway = $gateway;

        $this->action = localized_route('front.donations.submit');

        $this->recurring = config("website-factory.payments.gateways.{$gateway}.recurring", false);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.donation-form');
    }
}
