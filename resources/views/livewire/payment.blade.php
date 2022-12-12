<div class="container ">
    <div class="card mx-auto" style="width: 26rem;">
        <div class="card-title text-center " style="background-color: lightgrey">Payment</div>
        <div class="card-body">
            <form wire:submit.prevent="submit">
                @csrf
                <div class="row ">
                    <div class="col-auto">
                        <label>How much you want to pay?</label>
                        <input class="form-control" type="number" name="value" required
                               value="{{mt_rand(500,1000)}}" wire:model="value">
                    </div>
                    @error('value') <span class="error text-danger">{{ $message }}</span> @enderror

                    <div class="col-auto ">
                        <label for="inputGroupSelect01">Currency</label>

                        <select class="custom-select form-control" name="currency" id="inputGroupSelect01"
                                wire:model="currency">
                            @foreach($currencies as $cur)
                                <option selected> choose</option>
                                <option value="{{$cur->iso}}"> {{strtoupper($cur->iso)}} </option>
                            @endforeach
                        </select>
                        @error('currency') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>Select Payment Method You Want To Use</label>
                        <div class="form-group" id="toggler">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach($plats as $plat)
                                    <label class="btn btn-outline-secondary rounded m-2 p-1"
                                           data-target="#{{$plat->name}}collapse" data-toggle="collapse">
                                        <input type="radio" name="payment_platform" value="{{$plat->id}}"
                                               wire:model="payMethod">
                                        <img class="img-thumbnail"
                                             src="{{asset('img/payment_platform/' .$plat->image)}}">
                                    </label>
                                @endforeach
                            </div>
                            @error('payMethod') <span class="error text-danger">{{ $message }}</span> @enderror

                            @if(isset($payMethod))
                                <h2 class="h2">Your Payment Is Here!</h2>
                                @if($payMethod == 1)
                                    <div>
                                        <h3 class="h3">Paypal</h3>
                                    </div>

                                @endif
                                @if($payMethod == 2)
                                    <div>
                                        <h3 class="h3">Stripe</h3>
                                    </div>
                                    {{--{{$payMethod}}--}}
                                @endif
                            @else
                                <div>
                                    <h3 class="h3">{{$payMethod}}</h3>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-primary mt-4" wire:click="submit">Continue to pay</button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>
