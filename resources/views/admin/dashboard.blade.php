@extends('admin.layouts.app')
@include('admin.layouts.sidebar')
@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($users)}}</div>
                                <div>Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('admin.users')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($completed_orders)}}</div>
                                <div>Completed Orders</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('admin.orders.completed')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($new_orders)}}</div>
                                <div>New Orders!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('admin.orders.new')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
           
        </div>
        <div class="row" style="height: 50px;"></div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered">
                    <thead>
                        <th class="text-align-center">Coin</th>
                        <th class="text-align-center">Bithumb Prices</th>
                        <th class="text-align-center">Our Prices</th>
                    </thead>
                    <tbody>
                        <?php for($i=0; $i<12;$i++) {?>
                        <tr>
                            <td class="text-align-left">
                                <img src="{{asset('img/'.$img_src[$i])}}" class="coin-img">
                            {{$coins_str[$i]}}</td>
                            <td class="text-align-right" id="bithumb_price_{{$i}}"></td>
                            <td class="text-align-right"  id="our_price_{{$i}}"></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
                
        </div>
        
    </div>
    <!-- /#page-wrapper -->

<script type="text/javascript">
$(document).ready(function(){
    setPrice();
    // getRealtimePrice();
    setTimeout(getRealtimePrice, 10000);
});
function getRealtimePrice() {
    $.ajax({
        url: '/realtime_currency',
        method: 'GET',
        success: function(result) {
            var coin_currency = result.response;
            // console.log(coin_currency);
            for(i = 0; i < 12 ; i++) {
                var price = coin_currency[i];
                var our_price = parseInt(parseInt(price) * 0.93);
                $("#bithumb_price_"+i).html(changeNumberFormat(price.toString())+'원');
                $("#our_price_"+i).html(changeNumberFormat(our_price.toString())+'원');
            }
            // ////////////////////////////////
            $.ajax({
                url: '/realtime_currency_dbset',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'json',
                data: {send_data: JSON.stringify(coin_currency)},    
                success: function(res) {
                    // console.log(res);
                }
            });
        }
    });
    setTimeout(getRealtimePrice, 10000);
}

function setPrice() {
    $.ajax({
        url: '/realtime_currency_db',
        method: 'GET',
        success: function(res) {
            var coin_currency = res.response;
            // console.log(coin_currency);
            for(i = 0; i < 12 ; i++) {
                var price = coin_currency[i];
                var our_price = parseInt(parseInt(price) * 0.93);
                $("#bithumb_price_"+i).html(changeNumberFormat(price.toString())+'원');
                $("#our_price_"+i).html(changeNumberFormat(our_price.toString())+'원');
            }
        }
    });
}

function changeNumberFormat(str) {
    x = str.split('.'); 
    x1 = x[0];
    var rgx = /(\d+)(\d{3})/; 
    while (rgx.test(x1)) { 
        x1 = x1.replace(rgx, '$1' + ',' + '$2'); 
    } 
    return x1;
}
</script>


@endsection

