@extends('master.frontheader')
@section('main-section')
    <!-- Content -->
    <div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
        <!-- Grid -->
        <div class="w3-row-padding" id="about">
            <div class="w3-center w3-padding-64">
                <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">
                    <div class="input-group">
                        <div class="form-outline">
                            <input type="search" id="form1" class="form-control" placeholder="Search Books..." />
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </span>
            </div>
            @foreach($bookData as $val)
                <div class="w3-third w3-margin-bottom">
                    <ul class="w3-ul w3-border w3-center w3-hover-shadow">
                        <li>
                            <div class="w3-card-4">
                                @if(!empty( $val->image ))
                                    <img src="{{ $val->image }}" onerror="this.onerror=null;this.src='{{ url('custom/dummy-logo.png') }}';" alt="mage" style="width:345px;height:230px;">
                                @else 
                                    <img src="{{ url('custom/dummy-logo.png') }}" alt="image" style="width:345px;height:230px;">
                                @endif
                                <div class="w3-container">
                                <h3>
                                    @php
                                        $name = $val->title;
                                        $limitedName = strlen($name) > 28 ? substr($name, 0, 28) . '...' : $name;
                                        echo $limitedName;
                                    @endphp
                                </h3>
                                <p>{{ $val->author }}</p>
                                <p><a href="{{ route('viewbook' , $val->id) }}" class="w3-button w3-light-grey w3-block">View</a></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
