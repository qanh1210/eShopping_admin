<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Product name</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Category</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($list as $product)
        <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td><img src="{{ $product->feature_image_path }}" style="max-width: 100px;"/></td>
            <td>
                {{ $product->category->name }}
            </td>
            <td>
                <a href="{{ route('product.edit',['id' => $product->id]) }}" class="btn btn-default">Edit</a>
                <a href="" data-url="{{ route('product.delete',['id' => $product->id]) }}" class="btn btn-danger action-delete">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
