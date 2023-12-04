@extends('users.layout')
@section('title','Chi Tiết Sản Phẩm')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{$sanpham->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Thông tin chi tiết sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="images/{{$sanpham->image}}" height="250px" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
                                <p class="single-item-title"><h2>{{$sanpham->name}}</h2></p>
                                &nbsp;
								<p class="single-item-price"  style="font-size: 20px">
									@if($sanpham->discount==0)
										<span class="flash-sale">Giá: {{number_format($sanpham->price)}} $</span>
									@else
										<span class="flash-del">{{number_format($sanpham->price)}} $</span>
										<span class="flash-sale">{{number_format($sanpham->discount)}} $</span>
									@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">

                                <p style="color: #1a1d1f; font-size:20px" > Bảo Hành: {{$sanpham->baohanh}}</p>
                            </div>
                            &emsp;
                            <div class="space20" style="font-size: 20px">Trạng Thái:  {{$sanpham->trangthai}}</div>
                            &emsp;
							<div class="single-item-options">

								<select class="wc-select" name="color">
									<option>Số lượng</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="{{route('themgiohang',$sanpham->id)}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix">

                                </div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">{!! $sanpham->description !!}</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{!!$sanpham->content !!}</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm tương tự</h4>

						<div class="row">
						@foreach($sp_tuongtu as $sptt)
							<div class="col-sm-4">
								<div class="single-item">
									@if($sptt->discount!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="product.html"><img src="images/{{$sptt->image}}" alt="" height="150px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$sptt->name}}</p>
										<p class="single-item-price"  style="font-size: 20px">
											@if($sptt->promotion_price==0)
												<span class="flash-sale">{{number_format($sptt->price)}} $</span>
											@else
												<span class="flash-del">{{number_format($sptt->price)}} $</span>
												<span class="flash-sale">{{number_format($sptt->discount)}} $</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{route('themgiohang',$sptt->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('chitietsanpham',$sptt->id)}}">Chi Tiết <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						@endforeach
						</div>
						<div class="row">{{$sp_tuongtu->links()}}</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Bình Luận</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
                                <form method="post" >
								<div class="media beta-sales-item">

                                <input  required type="text" name="email" placeholder="Nhập Email">


								</div>
								<div class="media beta-sales-item">

                                    <input  require type="text" name="name" placeholder="Nhập Tên ">
								</div>
								<div class="media beta-sales-item">

                                    <input required type="text" name="content" placeholder="Nhập nội dung bình luận">
								</div>
								<div class="media beta-sales-item">

                                    <button style="width:200px" ctype="submit"name="submit" value="">Bình Luận</button>
                                </div>

                                {{csrf_field()}}
                                </form>
							</div>
						</div>
					</div> <!-- best sellers widget -->
					{{-- <div class="widget">
						<h3 class="widget-title">Chi Tiết Bình Luận</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists" style="font-size: 15px">
                                @foreach($data as $comments)
								<div class="media beta-sales-item">
									<div class="media-body">
                                     <span style="color:rgb(13, 14, 13)"><b>Tên:   {{$comments->name}}</b></span>
									</div>
                                    <span style="color:rgb(14, 13, 13) "><b>Ngày: {{date('d/m/Y H:i',strtotime($comments->create_at))}} </b></span><br/>
                                    <span style="color:rgb(8, 7, 7)"><b>Nội Dung:  {{$comments->content}} </b></span>
								</div>
                                @endforeach
							</div>
						</div>
					</div> <!-- best sellers widget --> --}}
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
