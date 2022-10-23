<form method="GET" action="{{ url('/search') }}">
    @csrf
    <div class="form group col-md-4">
        <label for="search">Search</label>
        <input type="text" class="form-control" name="search" id="search">
</form>
