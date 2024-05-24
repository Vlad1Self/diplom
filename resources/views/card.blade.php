@extends('shop')

@include('includes.header')


@section('content')
    @if(empty(session('cart')))
        {{__('Нет ни одного товара')}}
    @else
    <table id="cart" class="table table-bordered" style="table-layout: fixed;">
        <thead>
        <tr>
            <th style="width: 20%; height: 50px;">Название</th>
            <th style="height: 50px;">Цена</th>
            <th style="height: 50px;">Описание</th>
            <th style="height: 50px;">Количество</th>
            <th style="height: 50px;">Всего</th>
            <th style="width: 10%; height: 50px;"></th>
        </tr>
        </thead>

        <tbody>
        @php $total = 0 @endphp

        @if(session('cart'))

            @foreach(session('cart') as $id => $details)

                <tr rowId="{{ $id }}" style="height: 100px;">
                    <td data-th="Product" style="height: 100px;">
                        <div class="row">
                            <div class="">
                                <h4 class="nomargin">{{ $details['title'] }}</h4>
                            </div>
                            <div class="col-sm-10 hidden-xs">
                                <img src="{{ isset($details['image_path']) ? asset('storage/' . $details['image_path']) : asset('path/to/default/image.jpg') }}" class="card-img-top"/>
                            </div>
                        </div>
                    </td>
                    <td style="height: 100px;">{{ $details['price'] }} ₽</td>

                    <td style="height: 100px;">{{ $details['content'] }}</td>

                    <td data-th="Quantity" style="height: 100px;">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control text-center edit-cart-info" rowId="{{ $id }}">
                    </td>

                    <td data-th="Subtotal" style="height: 100px;">{{ $details['price'] * $details['quantity'] }} ₽</td>

                    <td class="actions" style="height: 100px;">
                        <a class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i></a>
                    </td>

                    @php $total += $details['price'] * $details['quantity'] @endphp

                </tr>

            @endforeach
        @endif
        </tbody>

        <tfoot>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('shop') }}" class="btn btn-primary"></i>Назад</a>

                <a href="{{ url('payment') }}" class="btn btn-danger"></i>Оформить заказ</a>
                {{--<button class="btn btn-danger">Оплатить</button>--}}
            </td>
            <th style="width: 10%; height: 50px;"></th>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <h3>Итого: {{ $total }} ₽</h3>
            </td>
            <th style="width: 10%; height: 50px;"></th>
        </tr>

        </tfoot>
    </table>

    @endif
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
                    quantity: ele.val()
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
    @include('includes.footer')
@endsection
