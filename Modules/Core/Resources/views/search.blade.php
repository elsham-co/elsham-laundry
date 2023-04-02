<form action="{{route($route.'.index')}}" id="filter" autocomplete="off">
    <div class="wrap">
        <div class="search">
            <input type="text" name="search"  data-href="{{route($route.'.index')}}"
                   value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                   class="searchTerm" placeholder="{{__('What are you looking for?')}}">
                   <hr>
        </div>
     
    </div>
</form>