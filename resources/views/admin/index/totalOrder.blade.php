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
                  <td>{{$total[$month]}}</td>
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
            text: 'Đơn đặt phòng của từng tháng của năm {{$year}}'
        },
        yAxis: {
            min: 1,
            max: 15,
          // allowDecimals: true,
            title: {
                text: 'Đơn đặt'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0,
                borderWidth: 5
            }
        },    
        tooltip: {
          headerFormat: 'Tháng {point.x}<br>',
          pointFormat: 'Tổng đơn đặt: <b>{point.y} đơn</b><br/>',
        }
    });
  </script>




