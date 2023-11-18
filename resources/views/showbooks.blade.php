@extends('master.frontheader')
@section('main-section')
    <!-- Content -->
    <div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
        <!-- Grid -->
        <div class="w3-row-padding" id="about">
            <div class="w3-center w3-padding-64 inputSearch">
                <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">
                    <div class="input-group mb-3 rounded-pill border">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent" id="searchIcon">
                            <i class="bi bi-search"></i>
                            </span>
                        </div>
                        <input type="text" id="searchBook" class="form-control border-0" placeholder="Search Books:-  By title, author, publication date, ISBN and genre." aria-label="Search Google" aria-describedby="searchIcon">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary bg-transparent border-0" type="button"></button>
                        </div>
                    </div>
                </span>
            </div>
            <span class="content"></span>
        </div>
        <span class="pagination"></span>
    </div>
@endsection
@section("js")
<script>
 
        function fetchBooks(searchBy,page,data) {
            $.ajax({
                url: "{{route('search')}}",
                type: 'POST',
                data: {all: searchBy , searchInput: data, page: page},
                datatype: "json",
                success: function(res){
                    $('.content').html(res.content);
                    $('.pagination').html(res.pagination);
                }
            });
        }
        $(document).on('keyup','#searchBook',function(e){
            e.preventDefault(); 
            let data = $('#searchBook').val();
            if (data === null || data.trim() === "") {
                fetchBooks('yes',1,'');
            } else {
                fetchBooks('no',1,data);
            }
        });
        $(document).ready(function() {
            fetchBooks('yes',1,'');
        });
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let data = $('#searchBook').val();
            if (data === null || data.trim() === "") {
                fetchBooks('yes',page,'');
            } else {
                fetchBooks('no',page,data);
            }
        });
        </script>
@endsection