@extends('layouts.user')

@section('head')
    {{ __('Documents') }}
@endsection

@section('title')
    {{ __('Documents') }}
    @endsection

    @section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Documents</li>
    @endsection

    @section('content')

    <div class="col-md-8">
        <p>We generate monthly account statements for every month in which you have trading activity. These statements are typically available within two weeks of the end of the month</p>
        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary m-2" href="{{ URL::to('/transactions/pdf') }}">Generate Account History</a>
            @if(count($documents) > 0)
                <a class="btn btn-primary m-2" href="{{ route('user.documents.download', App\Models\Document::where('user_id', auth()->id())->latest()->first()) }}">Generate latest invoice</a>
{{--                <a class="btn btn-primary m-2" href="{{ URL::to('/invoice/pdf/statement') }}">Generate latest invoice</a>--}}
            @endif
        </div>
        @foreach($documents as $document)
        <div class="card-body mb-3 border">
            <div class="row align-items-center" id="">
                <div class="col-2">
                    <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" width="40">
                </div>
                <div class="col-10 align-self-center d-flex justify-content-between">
                    <div class="mt-4 mt-sm-0 pull-left w-100">
                        <p class="pull-right">{{ \Carbon\Carbon::parse( $document->created_at )->diffForHumans() }}</p>
                        <h6><a href="{{ $document->file ? asset($document->file) : 'javascript:void(0)' }}" target="_blank">{{ $document->title }}</a></h6>
                        <p>{{ ucfirst($document->type) }}</p>
                        <p>{{ ucfirst($document->description) }}</p>
                    </div>
                    <div class="align-self-auto my-auto"><a href="{{ route('user.documents.download', $document->id) }}" title="Download"><i class="icon" data-feather="download"></i></a></div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('script')
    <script>
        // $('#datatable').DataTable()
    </script>
@endsection
