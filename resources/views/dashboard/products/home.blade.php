@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">




                <div class="col-12">
                    <div class="card">
                        <p class="card-title text-bold" style="margin-bottom:0px; ">@lang('site.products')<small>{{$products->total()}}</small></p>

                        <div class="card-header">


                            <form action="{{route('dashboard.products.index')}}" method="get">

                                <div class="row">
                                    <div class="col-md-3">

                                        <input type="text" id="myInput" name="search" class="form-control" placeholder="بحث" value="{{request()->search}}">
                                    </div>
                                    <div class="col-md-3">

                                        <select name="category_id" class="form-control">
                                            <option value="">@lang('site.all_categories')</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>

                                                @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>@lang('site.search')</button>
                                        @if(auth()->user()->hasPermission('products-create'))
                                            <a href="{{route('dashboard.products.create')}}" class="btn btn-primary"> <i class="fa fa-category-plus"></i> @lang('site.create')</a>
                                        @else
                                            <a class="btn btn-primary disabled"> <i class="fa fa-category-plus"></i> @lang('site.create')</a>
                                        @endif
                                    </div>
                                </div>



                            </form>
                        </div>
                    @if($products->count() > 0 )
                        <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.id')</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.description')</th>
                                        <th>@lang('site.category')</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.purchase_price') </th>
                                        <th>@lang('site.sale_price') </th>
                                        <th>@lang('site.profit_percent')% </th>
                                        <th>@lang('site.stock') </th>
                                        <th>@lang('site.action') </th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    @foreach($products as $index=>$category)
                                        <tr>
                                            <td>{{ $index + 1  }}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{!! $category->description !!}</td>
                                            <td>{{ $category->category->name }}</td>
                                            <td><img src="{{ $category->image_path }}" style="width: 50px;" class="img-thumbnail" alt=""></td>
                                            <td>{{$category->purchase_price}}</td>
                                            <td>{{$category->sale_price}}</td>
                                            <td>{{$category->profit_percent}} %</td>
                                            <td><span class="{{$category->stock == 0 ? 'btn btn-danger btn-sm' : ''}}">{{ $category->stock == 0 ? 'فارغ' : $category->stock}}</span></td>

                                            <td>
                                                @if(auth()->user()->hasPermission('products-update'))
                                                    <a href="{{route('dashboard.products.edit',$category->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                                @else
                                                    <button class="btn btn-info btn-sm disabled">@lang('site.edit')</button>
                                                @endif

                                                @if(auth()->user()->hasPermission('products-delete'))
                                                    <form  action="{{route('dashboard.products.destroy',$category->id)}}" method="post" style="display:inline-block" >
                                                        {{csrf_field()}}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="delete btn btn-danger btn-sm "><i class="fa fa-trash"></i></button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-danger btn-sm disabled">@lang('site.delete')</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{ $products->appends(request()->query())->links() }}

                            </div>
                            <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>


                @else

                    <p class="alert alert-danger btn-block text-center text-bold">@lang('site.no_data_found')</p>

                @endif

            </div>
        </div>
    </section>


    <script>






    </script>



@endsection
