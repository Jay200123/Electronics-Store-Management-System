@include('layouts.base')
<table class="table table-striped">
    <thead>
      <tr>
        <th>Product Description</th>
        <th>Cost</th>
        <th>Product Image</th>
       </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{$products->description}}</td>
            <td>{{$products->cost_price}}</td>
            <td><img src="{{asset($products->product_image) }}" width = "70px" height="70px"></td>
        </tr>
    </tbody>
</table>