@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Add -->

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.edit') @lang('site.clients')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('partials._errors')
                        <form action="{{route('dashboard.clients.update', $client->id)}}" method="post">

                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="form-group">
                                <label>@lang('site.name')</label>
                                <input type="text" name="name" class="form-control" value="{{ $client->name }}">
                            </div>

                            @for($i = 0; $i < 2; $i++)
                                <div class="form-group">
                                    <label>@lang('site.phone')</label>
                                    <input type="text" name="phone[]" class="form-control" value="{{ $client->phone[$i] ?? '' }}">
                                </div>
                            @endfor

                            <div class="form-group">
                                <label>@lang('site.address')</label>
                                <textarea name="address" class="form-control">{{ $client->address }}</textarea>
                            </div>


                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit"  class="btn btn-success btn-block">@lang('site.edit')</button>
                            </div>
                        </form>
                    </div>

                </div>



            </div>
        </div>
    </section>


@endsection
