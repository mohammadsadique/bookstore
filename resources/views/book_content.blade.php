<div class="w3-row-padding">
@foreach($bookData as $val)
<div class="w3-third w3-margin-bottom">
    <ul class="w3-ul w3-border w3-center w3-hover-shadow">
        <li>
            <div class="w3-card-4">
                @if(!empty( $val->image ))
                    <img src="{{ $val->image }}" class="imageToPreload" alt="Preload Image" style="display: none;">
                    <img class="imageToShow" alt="Image" style="width:345px;height:230px;">

                    <!-- <img class="imageWithError" src="{{ $val->image }}"  alt="mage" style="width:345px;height:230px;"> -->
                @else 
                    <img src="{{ url('custom/dummy-logo.png') }}" alt="image" style="width:345px;height:230px;">
                @endif
                <div class="w3-container">
                <h3>
                    @php
                        $name = $val->title;
                        $limitedName = strlen($name) > 25 ? substr($name, 0, 25) . '...' : $name;
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
<script>
    $(document).ready(function() {
        $('.imageToPreload').each(function() {
            var img = new Image();
            img.src = $(this).attr('src');
        });

        $('.imageToShow').on('error', function() {
            $(this).attr('src', '{{ asset('custom/dummy-logo.png') }}');
        });

        $('.imageToShow').each(function() {
            $(this).attr('src', $(this).prev('.imageToPreload').attr('src'));
        });
    });

</script>