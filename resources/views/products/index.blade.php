@extends('layouts.layout')

@section('title')
    Продукты
@endsection

@section('content')
    <div class="container">
        <table id="products-table" class="container table">
            <thead>
                <tr class='row'>
                    <th>ID продукта</th>
                    <th>Название партнера</th>
                    <th>Поставщик</th>
                    <th>Цена</th>
                </tr>
            </thead>
                <tbody>
		    <?php $i=0; ?>
                @foreach($products as $product)
                    <tr class="row <?= $i%2?'info':'' ?>">
                        <td class="product_id">
                           <span>{{$product->id}}</span>
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            {{$product->vendor->name}}
                        </td>
                        <td>
                            <span class="price">{{$product->price}}</span>
                        </td>
                    </tr>
		    <?php $i++;?>
                @endforeach
                </tbody>
        </table>
        <div class="col-xs-12 pagination-block">
            <?php echo $products->render(); ?>
        </div>
    </div>

{{--Модальное окно для смены цены --}}
    <div id="change-price-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Укажите новую цену</h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="new-price" name="new-price">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary save-price" data-dismiss="modal">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
@endsection

