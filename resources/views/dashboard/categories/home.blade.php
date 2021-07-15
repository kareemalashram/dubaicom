@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">




                <div class="col-12">
                    <div class="card">
                        <p class="card-title text-bold" style="margin-bottom:0px; ">@lang('site.categories')<small>{{$categories->total()}}</small></p>

                        <div class="card-header">


                            <form action="{{route('dashboard.categories.index')}}" method="get">

                                <div class="row">
                                    <div class="col-md-3">

                                        <input type="text" id="myInput" name="search" class="form-control" placeholder="بحث" value="{{request()->search}}">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>@lang('site.search')</button>
                                        @if(auth()->user()->hasPermission('categories-create'))
                                            <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary"> <i class="fa fa-category-plus"></i> @lang('site.create')</a>
                                        @else
                                            <a class="btn btn-primary disabled"> <i class="fa fa-category-plus"></i> @lang('site.create')</a>
                                        @endif
                                    </div>
                                </div>



                            </form>
                        </div>
                    @if($categories->count() > 0 )
                        <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.id')</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.products_count')</th>
                                        <th>@lang('site.related_products')</th>
                                        <th>@lang('site.action') </th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    @foreach($categories as $index=>$category)
                                        <tr>
                                            <td>{{ $index + 1  }}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->products->count() }}</td>
                                            <td><a href="{{ route('dashboard.products.index', ['category_id' => $category->id ]) }}" class="btn btn-info btn-sm">@lang('site.related_products')</a></td>

                                            <td>
                                                @if(auth()->user()->hasPermission('categories-update'))
                                                    <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                                @else
                                                    <button class="btn btn-info btn-sm disabled">@lang('site.edit')</button>
                                                @endif

                                                @if(auth()->user()->hasPermission('categories-delete'))
                                                    <form  action="{{route('dashboard.categories.destroy',$category->id)}}" method="post" style="display:inline-block" >
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

                                {{ $categories->appends(request()->query())->links() }}

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
