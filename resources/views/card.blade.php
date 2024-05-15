@extends('shop')

@section('content')
    <table id="cart" class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 20%;">Название</th>

            <th>Цена</th>
            <th>Описание</th>
            <th>Количество</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))

            @foreach(session('cart') as $id => $details)

                <tr rowId="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="">
                                <h4 class="nomargin">{{ $details['title'] }}</h4>
                            </div>
                            <div class="col-sm-10 hidden-xs">
                                <img src="{{ isset($details['image_path']) ? asset('storage/' . $details['image_path']) : asset('path/to/default/image.jpg') }}" class="card-img-top"/>
                            </div>
                        </div>
                    </td>
                    <td>{{ $details['price'] }} ₽</td>

                    <td>{{ $details['content'] }}</td>
                    <td></td>


                    <td class="actions">
                        <a class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('shop') }}" class="btn btn-primary"></i>Вернуться обратно</a>
                <button class="btn btn-danger">Оплатить</button>
            </td>
        </tr>
        </tfoot>
    </table>
@endsection

@section('scripts')
    <script type="text/javascript">

        $(".edit-cart-info").change(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ route('update.shopping.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId"),
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".delete-product").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Вы действительно хотите удалить?")) {
                $.ajax({
                    url: '{{ route('delete.cart.product') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("rowId")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

    </script>
@endsection
