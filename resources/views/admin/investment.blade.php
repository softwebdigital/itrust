@extends('layouts.admin')

@section('head')
    {{ 'investments' }}
@endsection

@section('title')
    {{ 'investments' }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">investments</li>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
@endsection

@section('content')
<div style="min-height: 500px">
    <div class="d-flex justify-content-end mb-3">
        {{-- <a href="{{ route('admin.inv.create') }}" type="button" c>Add Investment</a> --}}
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-add" class="btn btn-primary">Add Investment</a>
    </div>
    <div class="table" style="overflow-x: auto; border-color: white;">
        <table id="datatable" class="table table-borderless table-striped nowrap">
            <thead>
                <tr>
                    <th>Investment Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Amount</th>
                <th>ROI</th>
                <th>Asset</th>
                <th>Account</th>
                <th>Copy Bot</th>
                <th>Status</th>

                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($investments as $investment)
                <tr>
                    <td>{{ date('d/M/Y', strtotime($investment->created_at)) }}</td>
                    @if($investment->user)
                        <td>{{ $investment->user->full_name }}</td>
                        <td>{{ $investment->user->email }}</td>
                    @else
                    <td>( Deleted Account )</td>
                    <td></td>
                    @endif
                    
                    <td>{{ number_format($investment->amount, 2) }}</td>
                    <td>{{ number_format($investment->ROI, 2) }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $investment->type)) }}</td>
                    <td>
                        @if($investment->acct_type == 'offshore')
                        Offshore
                        @elseif($investment->acct_type == 'basic_ira')
                        Basic IRA
                        @endif
                    </td>
                    @if($investment->copyBot)
                        <td>{{ $investment->copyBot->name }}</td>
                    @else
                        <td>Not set</td>
                    @endif
                    <td> <span class="badge
                        {{ $investment->status == 'closed' ? 'bg-danger' : '' }}
                        {{ $investment->status == 'open' ? 'bg-success' : '' }}
                            ">{{ ucwords($investment->status) }}
                    </td>

                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                <span>Open </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-roi-{{ $investment->id }}">Edit</a>
                                    <a class="dropdown-item" href="{{ route('admin.investments.updatestatus', [$investment->id, 'closed']) }}">Make Closed</a>
                                    <a class="dropdown-item" href="{{ route('admin.investments.updatestatus', [$investment->id, 'open']) }}">Make Open</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop-delete-{{ $investment->id }}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="staticBackdrop-roi-{{ $investment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Invest for investments</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.investments.addroi', $investment->id) }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="investment">$</label>
                                            <input type="number" step="any" class="form-control @error('investment') is-invalid @enderror"
                                                name="investment" value="{{ $investment->amount }}" id="investment" placeholder="ROI">
                                        </div>
                                        @error('investment') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="amount">ROI</label>
                                            <input type="number" step="any" class="form-control @error('amount') is-invalid @enderror"
                                                name="amount" value="{{ $investment->ROI }}" id="amount" placeholder="ROI">
                                        </div>
                                        @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <select class="form-select @error('status') is-invalid @enderror" name="status" style="display:block !important;">
                                                <option value="">Select Status</option>
                                                <option value="open" {{ $investment->status == 'open' ? 'selected' : '' }}>Open</option>
                                                <option value="closed" {{ $investment->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                        @error('status') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="assets">Product:</label>
                                        <select class="form-select @error('asset_type') is-invalid @enderror" name="assets"
                                            id="assets-{{ $investment->id }}">
                                            <option value="">Select Asset</option>
                                            <option value="stocks" {{ $investment->asset_type == 'stocks' ? 'selected' : '' }}>Stocks</option>
                                            <option value="Bonds(Fixed Income)" {{ $investment->asset_type == 'Bonds(Fixed Income)' ? 'selected' : '' }}>Bonds(Fixed Income)</option>
                                            <option value="Properties" {{ $investment->asset_type == 'Properties' ? 'selected' : '' }}>Properties</option>
                                            <option value="crypto" {{ $investment->asset_type == 'crypto' ? 'selected' : '' }}>Cryptocurrencies</option>
                                            <option value="ETF’S" {{ $investment->asset_type == 'ETF’S' ? 'selected' : '' }}>ETF’S</option>
                                            <option value="gold" {{ $investment->asset_type == 'gold' ? 'selected' : '' }}>Gold</option>
                                            <option value="NFT’S" {{ $investment->asset_type == 'NFT’S' ? 'selected' : '' }}>NFT’S</option>
                                            <option value="Options" {{ $investment->asset_type == 'Options' ? 'selected' : '' }}>Options</option>
                                        </select>
                                        @error('asset_type') <strong class="text-danger"
                                            role="alert">{{ $message }}</strong> @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="type">Select Asset:</label>
                                        <select class="form-select @error('type') is-invalid @enderror" name="types" id="type-{{ $investment->id }}" style="border: 1px solid #f0f0f0; border-radius: 15px;">
                                            <option value=""></option>
                                        </select>
                                        @error('type') 
                                            <strong class="text-danger" role="alert">
                                                {{ $message }}
                                            </strong> 
                                        @enderror
                                    </div>
                                    <input id="hidden-type-{{ $investment->id }}" name="type" type="hidden" value="{{ $investment->type }}" />
                                    <div class="mt-3">
                                        <select class="form-select @error('interval') is-invalid @enderror" name="interval" id="interval" style="border: 1px solid #f0f0f0; border-radius: 10px;">
                                            <option value="5min"  {{ $investment->interval == '5min' ? 'selected' : '' }}>Interval: 5min </option>
                                            <option value="10min"  {{ $investment->interval == '10min' ? 'selected' : '' }}>Interval: 10min </option>
                                            <option value="30min"  {{ $investment->interval == '30min' ? 'selected' : '' }}>Interval: 30min </option>
                                            <option value="1hrs"  {{ $investment->interval == '1hrs' ? 'selected' : '' }}>Interval: 1hrs </option>
                                            <option value="2hrs"  {{ $investment->interval == '2hrs' ? 'selected' : '' }}>Interval: 2hrs </option>
                                            <option value="3hrs"  {{ $investment->interval == '3hrs' ? 'selected' : '' }}>Interval: 3hrs </option>
                                            <option value="6hrs"  {{ $investment->interval == '6hrs' ? 'selected' : '' }}>Interval: 6hrs </option>
                                            <option value="12hrs"  {{ $investment->interval == '12hrs' ? 'selected' : '' }}>Interval: 12hrs </option>
                                            <option value="24hrs"  {{ $investment->interval == '24hrs' ? 'selected' : '' }}>Interval: 24hrs </option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <select class="form-select @error('leverage') is-invalid @enderror" name="leverage" id="leverage" style="border: 1px solid #f0f0f0; border-radius: 10px;">
                                            <option value="1.0" {{ $investment->leverage == '1.0' ? 'selected' : '' }}>Leverage: 1.0X </option>
                                            <option value="2.0" {{ $investment->leverage == '2.0' ? 'selected' : '' }}>Leverage: 2.0X </option>
                                            <option value="3.0" {{ $investment->leverage == '3.0' ? 'selected' : '' }}>Leverage: 3.0X </option>
                                            <option value="4.0" {{ $investment->leverage == '4.0' ? 'selected' : '' }}>Leverage: 4.0X </option>
                                            <option value="5.0" {{ $investment->leverage == '5.0' ? 'selected' : '' }}>Leverage: 5.0X </option>
                                            <option value="6.0" {{ $investment->leverage == '6.0' ? 'selected' : '' }}>Leverage: 6.0X </option>
                                            <option value="7.0" {{ $investment->leverage == '7.0' ? 'selected' : '' }}>Leverage: 7.0X </option>
                                            <option value="8.0" {{ $investment->leverage == '8.0' ? 'selected' : '' }}>Leverage: 8.0X </option>
                                            <option value="9.0" {{ $investment->leverage == '9.0' ? 'selected' : '' }}>Leverage: 9.0X </option>
                                            <option value="10.0" {{ $investment->leverage == '10.0' ? 'selected' : '' }}>Leverage: 10.0X </option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="entry">Entry Point</label>
                                        <input class="form-control" type="number" name="entry" id="entry" placeholder="Enter entry point..." value="{{ $investment->entry_point }}" step="0.000000000000001">
                                    </div>
                                    <div class="mt-3">
                                        <label for="stop">Stop Loss</label>
                                        <input class="form-control" type="number" name="stop" id="stop" placeholder="Enter stop loss..." value="{{ $investment->stop_loss }}" step="0.000000000000001">
                                    </div>
                                    <div class="mt-3">
                                        <label for="takeprofit">Take Profit</label>
                                        <input class="form-control" type="number" name="takeprofit" id="takeprofit" placeholder="Enter take profit..." value="{{ $investment->take_profit }}" step="0.000000000000001">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="date">Date <span class="text-danger">*</span></label>
                                        <input type="date" step="any" class="form-control required @error('date') is-invalid @enderror"
                                               name="date" value="{{ old('date') ?? \Carbon\Carbon::make($investment['created_at'])->format('Y-m-d') }}" id="date" placeholder="Date">
                                        @error('date') <strong class="text-danger" role="alert">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop-delete-{{ $investment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Confirm Approval</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.investments.delete', $investment->id) }}" method="post">@csrf @method('POST')
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this investment?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const assetsSelect = document.getElementById('assets-{{ $investment->id }}');
                        const typeSelect = document.getElementById('type-{{ $investment->id }}');
                        const hiddenType = document.getElementById('hidden-type-{{ $investment->id }}');

                        // Initialize Choices.js for the 'type' select dropdown
                        let typeChoices = new Choices(typeSelect, {
                            searchEnabled: true,  // Enable search
                            placeholder: true,
                            itemSelectText: 'Select',   // Disable select text
                        });

                        // Function to fetch and populate the 'type' dropdown with data
                        const fetchAndPopulateType = (url, isCrypto = false) => {
                            fetch(url)
                                .then(response => response.json())
                                .then(data => {
                                    // Clear the current options in 'Choices'
                                    typeChoices.clearStore();

                                    // Create an array of new options
                                    const options = data.map(item => ({
                                        value: isCrypto ? `${item.symbol.toUpperCase()}/USDT` : item.name, // Adjust according to your data structure
                                        label: isCrypto ? `${item.symbol.toUpperCase()}/USDT` : item.name // Format based on asset type
                                    }));

                                    // Add the new options to the Choices instance
                                    typeChoices.setChoices(options, 'value', 'label', true); // true flag ensures the new options are added and set
                                })
                                .catch(error => console.error('Error fetching data:', error));
                        };

                        // Listen for changes in the assets dropdown
                        assetsSelect.addEventListener('change', function() {
                            const selectedValue = assetsSelect.value;
                            let url = '';

                            // Determine the correct URL and data handling based on selected asset type
                            if (selectedValue === 'stocks') {
                                url = '{{ route('assets.get') }}';
                                fetchAndPopulateType(url, false);  // Call the function for stocks (isCrypto is false)
                                typeSelect.style.display = 'block'; // Show the type select field for stocks
                            } else if (selectedValue === 'crypto') {
                                url = '{{ route('crypto.get') }}';
                                fetchAndPopulateType(url, true);  // Call the function for crypto (isCrypto is true)
                                typeSelect.style.display = 'block'; // Show the type select field for crypto
                            } else {
                                // For non-crypto or non-stock assets, automatically set the type field
                                typeChoices.clearStore(); // Clear any previous choices
                                typeChoices.setChoices([{ value: selectedValue, label: selectedValue }]); // Set the asset value as the type
                                typeChoices.setChoiceByValue(selectedValue);  // Automatically select the asset as the type
                                hiddenType.value = selectedValue;
                            }
                        });

                        // Update hidden input when a type is selected
                        typeSelect.addEventListener('change', function() {
                            hiddenType.value = typeSelect.value;  // Set the hidden_type value to the selected type
                        });

                        // Fetch and populate the 'type' dropdown based on the default selection
                        const initialValue = assetsSelect.value || 'stocks'; // Default to 'stocks' if no value is selected
                        if (initialValue === 'stocks') {
                            fetchAndPopulateType('{{ route('assets.get') }}', false);  // Default stocks
                            typeSelect.style.display = 'block'; // Show the type select for stocks
                        } else if (initialValue === 'crypto') {
                            fetchAndPopulateType('{{ route('crypto.get') }}', true);  // Default crypto
                            typeSelect.style.display = 'block'; // Show the type select for crypto
                        } else {
                            // If it's neither crypto nor stocks, set the asset as the type and hide the type dropdown
                            typeChoices.setChoices([{ value: initialValue, label: initialValue }]);
                            typeChoices.setChoiceByValue(initialValue);  // Automatically select the initial asset as the type
                            hiddenType.value = selectedValue;
                        }
                    });
                </script>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="staticBackdrop-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Investment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" method="post" enctype="multipart/form-data" action="{{ route('admin.users.newInvest') }}">
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-3">
                        <label for="">User <span class="text-danger">*</span></label>
                        <select class="form-select @error('user') is-invalid @enderror" name="user" id="user">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user') ==  $user->id  ? 'selected' : '' }}>{{ $user->username }}</option>
                            @endforeach
                        </select>
                        @error('user') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="trade_type">Trade Type :</label>
                        <select class="form-select @error('trade_type') is-invalid @enderror" name="trade_type"
                            id="trade_type">
                            <option value="buy">Buy</option>
                            <option value="sell">Sell</option>
                        </select>
                        @error('trade_type') <strong class="text-danger"
                            role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                            <label for="">Amount <span class="text-danger">*</span></label>
                            <input type="amount" step="any" class="form-control @error('amount') is-invalid @enderror"
                                name="amount" value="{{ old('amount') }}" id="amount" placeholder="Amount Invested">
                        @error('amount') <strong class="text-danger" role="alert">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                            <label for="">ROI <span class="text-danger">*</span></label>
                            <input type="amount" step="any" class="form-control @error('ROI') is-invalid @enderror"
                                name="ROI" value="{{ old('ROI') }}" id="ROI" placeholder="ROI">
                        @error('ROI') <strong class="text-danger" role="alert">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="user">
                            <option value="">Select Status</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                        </select>
                        @error('status') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="assets">Assets:</label>
                        <select class="form-select @error('assets') is-invalid @enderror" name="assets"
                            id="create_assets">
                            <option value="">Select Asset</option>
                            <option value="stocks" {{ old('type') == 'stocks' ? 'selected' : '' }}>Stocks</option>
                            <option value="Bonds(Fixed Income)" {{ old('type') == 'Bonds(Fixed Income)' ? 'selected' : '' }}>Bonds(Fixed Income)</option>
                            <option value="Properties" {{ old('type') == 'Properties' ? 'selected' : '' }}>Properties</option>
                            <option value="crypto" {{ old('type') == 'Cryptocurrencies' ? 'selected' : '' }}>Cryptocurrencies</option>
                            <option value="ETF’S" {{ old('type') == 'ETF’S' ? 'selected' : '' }}>ETF’S</option>
                            <option value="gold" {{ old('type') == 'gold' ? 'selected' : '' }}>Gold</option>
                            <option value="NFT’S" {{ old('type') == 'NFT’S' ? 'selected' : '' }}>NFT’S</option>
                            <option value="Options" {{ old('type') == 'Options' ? 'selected' : '' }}>Options</option>
                        </select>
                        @error('asset_type') <strong class="text-danger"
                            role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="mt-3">
                        <label for="type">Select Asset:</label>
                        <select class="form-select @error('type') is-invalid @enderror" name="type" id="create_type" style="border: 1px solid #f0f0f0; border-radius: 10px;">
                            <option value="">Select Asset </option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <select class="form-select @error('interval') is-invalid @enderror" name="interval" id="interval" style="border: 1px solid #f0f0f0; border-radius: 10px;">
                            <option value="5min">Interval: 5min </option>
                            <option value="10min">Interval: 10min </option>
                            <option value="30min">Interval: 30min </option>
                            <option value="1hrs">Interval: 1hrs </option>
                            <option value="2hrs">Interval: 2hrs </option>
                            <option value="3hrs">Interval: 3hrs </option>
                            <option value="6hrs">Interval: 6hrs </option>
                            <option value="12hrs">Interval: 12hrs </option>
                            <option value="24hrs">Interval: 24hrs </option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <select class="form-select @error('leverage') is-invalid @enderror" name="leverage" id="leverage" style="border: 1px solid #f0f0f0; border-radius: 10px;">
                            <option value="1.0">Leverage: 1.0X </option>
                            <option value="2.0">Leverage: 2.0X </option>
                            <option value="3.0">Leverage: 3.0X </option>
                            <option value="4.0">Leverage: 4.0X </option>
                            <option value="5.0">Leverage: 5.0X </option>
                            <option value="6.0">Leverage: 6.0X </option>
                            <option value="7.0">Leverage: 7.0X </option>
                            <option value="8.0">Leverage: 8.0X </option>
                            <option value="9.0">Leverage: 9.0X </option>
                            <option value="10.0">Leverage: 10.0X </option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="entry">Entry Point</label>
                        <input class="form-control" type="number" name="entry" id="entry" placeholder="Enter entry point..." step="0.000000000000001">
                    </div>
                    <div class="mt-3">
                        <label for="stop">Stop Loss</label>
                        <input class="form-control" type="number" name="stop" id="stop" placeholder="Enter stop loss..." step="0.000000000000001">
                    </div>
                    <div class="mt-3">
                        <label for="takeprofit">Take Profit</label>
                        <input class="form-control" type="number" name="takeprofit" id="takeprofit" placeholder="Enter take profit..." step="0.000000000000001">
                    </div>
                    @php 
                        $copyBots = \App\Models\CopyBot::all();
                    @endphp
                    <div class="form-group mb-3">
                        <label for="">Copy Bot <span class="text-danger">*</span></label>
                        <select class="form-select @error('bot') is-invalid @enderror" name="bot" id="user">
                            <option value="">Select Bot</option>
                            @foreach($copyBots as $bot)
                                <option value="{{ $bot->id }}" @if(old('bot_id') == $bot->name) selected @endif>{{ ucwords($bot->name) }}</option>
                            @endforeach
                        </select>
                        @error('bot') <strong class="text-danger" role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="acct_type">Account :</label>
                        <select class="form-select @error('acct_type') is-invalid @enderror" name="acct_type"
                            id="acct_type">
                            <option value="">Select Account</option>
                            <option value="basic_ira">Basic IRA (current account)</option>
                            <option value="offshore"> Offshore Account </option>
                        </select>
                        @error('acct_type') <strong class="text-danger"
                            role="alert">{{ $message }}</strong> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="date">Date <span class="text-danger">*</span></label>
                        <input type="date" step="any" class="form-control required @error('date') is-invalid @enderror"
                               name="date" value="{{ old('date') ?? now()->format('Y-m-d') }}" id="date" placeholder="Date">
                        @error('date') <strong class="text-danger" role="alert">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#datatable').DataTable({
            "ordering": false
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const assetsSelect = document.getElementById('create_assets');
            const typeSelect = document.getElementById('create_type');

            // Initialize Choices.js for the 'type' select dropdown
            let typeChoices = new Choices(typeSelect, {
                searchEnabled: true,  // Enable search
                placeholder: true,
                itemSelectText: 'Select',   // Disable select text
            });

            // Function to fetch and populate the 'type' dropdown with data
            const fetchAndPopulateType = (url, isCrypto = false) => {
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Clear the current options in 'Choices'
                        typeChoices.clearStore();

                        // Create an array of new options
                        const options = data.map(item => ({
                            value: isCrypto ? `${item.symbol.toUpperCase()}/USDT` : item.name, // Adjust according to your data structure
                            label: isCrypto ? `${item.symbol.toUpperCase()}/USDT` : item.name // Format based on asset type
                        }));

                        // Add the new options to the Choices instance
                        typeChoices.setChoices(options, 'value', 'label', true); // true flag ensures the new options are added and set
                    })
                    .catch(error => console.error('Error fetching data:', error));
            };

            // Listen for changes in the assets dropdown
            assetsSelect.addEventListener('change', function() {
                const selectedValue = assetsSelect.value;
                let url = '';

                // Determine the correct URL and data handling based on selected asset type
                if (selectedValue === 'stocks') {
                    url = '{{ route('assets.get') }}';
                    fetchAndPopulateType(url, false);  // Call the function for stocks (isCrypto is false)
                    typeSelect.style.display = 'block'; // Show the type select field for stocks
                } else if (selectedValue === 'crypto') {
                    url = '{{ route('crypto.get') }}';
                    fetchAndPopulateType(url, true);  // Call the function for crypto (isCrypto is true)
                    typeSelect.style.display = 'block'; // Show the type select field for crypto
                } else {
                    // For non-crypto or non-stock assets, automatically set the type field
                    typeChoices.clearStore(); // Clear any previous choices
                    typeChoices.setChoices([{ value: selectedValue, label: selectedValue }]); // Set the asset value as the type
                    typeChoices.setChoiceByValue(selectedValue);  // Automatically select the asset as the type
                    typeSelect.style.display = 'none'; // Hide the type dropdown for other assets
                }
            });

            // Fetch and populate the 'type' dropdown based on the default selection
            const initialValue = assetsSelect.value || 'stocks'; // Default to 'stocks' if no value is selected
            if (initialValue === 'stocks') {
                fetchAndPopulateType('{{ route('assets.get') }}', false);  // Default stocks
                typeSelect.style.display = 'block'; // Show the type select for stocks
            } else if (initialValue === 'crypto') {
                fetchAndPopulateType('{{ route('crypto.get') }}', true);  // Default crypto
                typeSelect.style.display = 'block'; // Show the type select for crypto
            } else {
                // If it's neither crypto nor stocks, set the asset as the type and hide the type dropdown
                typeChoices.setChoices([{ value: initialValue, label: initialValue }]);
                typeChoices.setChoiceByValue(initialValue);  // Automatically select the initial asset as the type
                typeSelect.style.display = 'none'; // Hide the type select for other assets
            }
        });
    </script>
@endsection
