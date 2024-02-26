@extends('dashboard.master')

@section('title')
    index masters
@endsection

@section('body')

<div class="container py-5 ">
    <div class="row">    
        <div class="col-md-11 mt-5 mx-5">
            <h3 class=" bg-light py-3">Marks Grade</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{url('/markgrades')}}">Marks Grade</a></li>
                </ol>
            </nav>
        
            <div class="row mt-3" id="marksGradeData">
                <div class="col-md-12">
                    <div class="row bg-white d-flex justify-content-between">
                        <h3 class="p-3">Marks Grade</h3>
                        <a href="{{url('/markgrades/create')}}"><button class="p-3 btn-primary "><strong>+Add Marks Grade</strong></button></a>
                    </div>
                </div>
                  @include('dashboard.examination.marks_grade.indexResult')    
            </div>
        </div>
    </div>
</div>

 
<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
        var page = window.location.hash.replace('#','');
        if (page == Number.NaN || page <= 0) {
        return false;
        }else{
        getData(page);
        }
        }
    });
    $(document).ready(function(){
        $(document).on('click', '.pagination a',function(event){
            alert('Hi');
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
            getData(page);
        });
        });
        function getData(page){
            $.ajax(
            {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
            }).done(function(data){
            $("#marksGradeData").empty().html(data);
            location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
    });
}
</script>
@endsection
