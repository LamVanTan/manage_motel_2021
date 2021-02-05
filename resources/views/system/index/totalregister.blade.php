<figure class="highcharts-figure" >
    <div id="order"></div> 
   
    <table id="totalOrder" class="d-none">
      <thead>
        <tr>
            <th></th>
            <th>Tháng</th>
        </tr>
      </thead>
      <tbody > 
            @for($month =1; $month<=12; $month++)
              <tr>
                  <th>{{$month}} </th>
                  <td>{{$total_user_app[$month]}}</td>
              </tr>
            @endfor
      </tbody>
    </table>
   
  </figure>
  
  
  <script>
      Highcharts.chart('order', {
        data: {
            table: 'totalOrder'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '<h5 style="font-size:15px">Tổng số đơn đăng ký sử dụng hệ thống của từng tháng của năm {{$year}} </h5>'
        },
        yAxis: {
            min: 0,
            max: 30,
          // allowDecimals: true,
            title: {
                text: 'Đơn đặt'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.5,
                borderWidth: 5
            }
        },    
        tooltip: {
          headerFormat: 'Tháng {point.x}<br>',
          pointFormat: 'Số lượng đăng ký: <b>{point.y}</b><br/>',
          shared: true
        }
    });
  </script>




