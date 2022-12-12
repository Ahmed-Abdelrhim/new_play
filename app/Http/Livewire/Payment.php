<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use App\Models\PaymentPlatform;
use Livewire\Component;

class Payment extends Component
{
    public $payMethod;
    public $currency;
    public $value;
    public $usedMethod;

    protected function rules()
    {
        return [
            'payMethod' => 'required',
            'currency' => 'required',
            'value' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $usedMethod = $this->usedMethod;
        $currencies = Currency::get();
        $paymentPlatforms = PaymentPlatform::get();
        $plats = PaymentPlatform::get();
        $payMethod= $this->payMethod;
        return view('livewire.payment', compact('usedMethod','currencies','plats','payMethod'));
    }

    public function submit()
    {
        $this->validate();
        if ($this->payMethod == 1)
            $this->usedMethod = 1;
        if ($this->payMethod == 2)
            $this->usedMethod = 2;
        $this->usedMethod = 'None Payment has been used';
    }
}
