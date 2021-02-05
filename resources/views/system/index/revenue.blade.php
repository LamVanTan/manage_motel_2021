<figure class="highcharts-figure" >
    <div id="container"></div> 
    <table id="datatable" class="d-none" >
      <thead>
        <tr>
            <th></th>
            <th>Tháng</th>
        </tr>
      </thead>
      <tbody > 
            @for($i=1; $i<=12; $i++)
              <tr>
                  <th>{{$i}}</th>
                  <td>{{$revenue[$i]}}</td>
              </tr>
            @endfor
      </tbody>
    </table>
  </figure>
  
  
  <script>
      Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Doanh thu của từng tháng của năm {{$year}}'
        },
        yAxis: {
            min: 0,
            max: 50000000,
          // allowDecimals: true,
            title: {
                text: 'Triệu'
            }
          
        },
        
        tooltip: {
          headerFormat: 'Tháng {point.x}<br>',
          pointFormat: 'Doanh thu: <b>{point.y} triệu</b><br/>',
          shared: true
        }
    });
  </script>




