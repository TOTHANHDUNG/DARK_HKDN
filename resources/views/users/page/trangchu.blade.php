@extends('users.layout')
@section('title','Trang Chủ')
@section('content')
<!--slider-->
</div>
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Tất cả sảm phẩm</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{count($products)}} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                        @foreach($products as $item)
                            <div class="col-sm-3">
                                <div class="single-item">
                                @if($item->discount!=0)
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                @endif
                                    <div class="single-item-header">
                                        <a href="{{route('chitietsanpham',$item->id)}}"><img src="images/{{$item->image}}" alt="" height="250px"></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{$item->name}}</p>
                                        <p class="single-item-price"  style="font-size: 20px">
                                        @if($item->discount==0)
                                            <span class="flash-sale">{{number_format($item->price)}} $</span>
                                        @else
                                            <span class="flash-del">{{number_format($item->price)}} $</span>
                                            <span class="flash-sale">{{number_format($item->discount)}} $</span>
                                        @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{route('themgiohang',$item->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{route('chitietsanpham',$item->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            &emsp;&emsp13;
                        @endforeach
                        </div>
                        <div class="row" style="font-size:auto">{{$products->links()}}  </div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                   
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
@endsection
