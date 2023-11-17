@extends('master.frontheader')
@section('main-section')
    <!-- Content -->
    <div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
        <!-- Page content -->
        <div class="w3-content" style="max-width:1100px">
            @if(!empty($bookData))
            <!-- About Section -->
            <div class="w3-row w3-padding-64" id="about">
            <div class="w3-col m6 w3-padding-large w3-hide-small">
                <img src="{{ $bookData->image }}" class="w3-round w3-image w3-opacity-min" onerror="this.onerror=null;this.src='{{ url('custom/dummy-logo.png') }}';" alt="image" width="600" height="750">
            </div>
            <div class="w3-col m6 w3-padding-large">
                <h1 class="w3-center">{{ $bookData->title }}</h1><br>
                <h5 class=""><b>Author :- </b> {{ $bookData->author }}</h5>
                <h5 class=""><b>Genre :- </b> {{ $bookData->genre }}</h5>
                <h5 class=""><b>ISBN :- </b> {{ $bookData->isbn }}</h5>
                <h5 class=""><b>Publisher :- </b> {{ $bookData->publisher }}</h5>
                <p class="w3-large w3-text-grey w3-hide-medium">{{ $bookData->description }}</p>
                <h5 class="w3-right"><b>Published Date :- </b> {{ date('d-m-Y' , strtotime($bookData->published)) }}</h5>
            </div>
            </div>
            @endif
        </div>
    </div>
@endsection
