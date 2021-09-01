@cannot('edit-category')
    <script type="text/javascript">
        $(function () {
            $('.action-edit').on('click', function (e) {
                $('#access_modal').modal('show');
                e.preventDefault();
            });
        });
    </script>
@endcannot
@cannot('delete-category')
    <script type="text/javascript">
        $(function () {
            $('.action-delete').on('click', function (e) {
                $('#access_modal').modal('show');
                e.preventDefault();
            });
        });
    </script>
@endcannot
<table class="table table-hover">

    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Category name</th>
        <th scope="col">Category parent name</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($list as $category)
        <tr>
            <th scope="row">{{ $category->id }}</th>
            <td>{{ $category->name }}</td>
            <td>
                @if(empty($category->parent_name))
                    {{ '-----' }}
                @else
                    {{ $category->parent_name }}
                @endif
            </td>
            <td>
                <a href="{{ route('categories.edit',['id' => $category->id]) }}"
                   class="btn btn-default action-edit">Edit</a>
                <a href="" data-url="{{ route('categories.delete',['id' => $category->id]) }}"
                   class="btn btn-danger action-delete">Delete</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
<!-- /.table -->
<div class="d-flex justify-content-center">
    {!! $list->links() !!}
</div>
