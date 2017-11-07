@extends('layouts')

@section('header')
    @parent
    头部
@stop

@section('footer')

    尾部
@stop

<!-- 1.模板中输出PHP变量 -->
<p>{{ $name }}</p>

<!-- 2.模板中调用php代码 -->
<p>{{ date('Y-m-d H:i:s',time()) }}</p>

<p>{{ $arrData['name'] }}-{{$arrData['age']}}</p>

<p>{{ in_array($name,$arrData) ? 'true':'false'}}</p>

<!-- 3.原样输出 -->

<p>@{{@name}}</p>


{{--4.模板中的注释--}}

{{--5.引入子视图 include--}}

@include('member.common1',['message'=>'woshi'])


@foreach ($Banners as $Banner)
    @if ($loop->first)
        {{ $Banner->adid }}-{{ $Banner->picurl }}-this is the NO.1<br>
    @endif
@endforeach