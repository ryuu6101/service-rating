<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header header-elements-inline bg-secondary text-white">
                <h6 class="card-title">
                    <i class="icon-table2 mr-2"></i>
                    Thống kê đánh giá
                </h6>
                <div class="header-elements"></div>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-3">
                        <label>Nhân viên: </label>
                        <select class="form-select custom-select" wire:model.live="user_id">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Thời gian: </label>
                        <input type="text" class="form-control mr-2 daterange-picker cursor-pointer" wire:model="daterange" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="ratingStaticalChart" wire:ignore>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let chart_element = document.getElementById('ratingStaticalChart');
        let rating_statical_chart = echarts.init(chart_element);

        var legend_data = @this.chart_legend;
        var series_data = @this.chart_series;

        rating_statical_chart.setOption({
            // Colors
            color: [
                '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
                '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
                '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
                '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
            ],

            // Global text styles
            textStyle: {
                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                fontSize: 13
            },

            // Add title
            title: {
                text: 'Thống kê chung',
                left: 'center',
                textStyle: {
                    fontSize: 17,
                    fontWeight: 500
                },
                subtextStyle: {
                    fontSize: 12
                }
            },

            // Add tooltip
            tooltip: {
                trigger: 'item',
                backgroundColor: 'rgba(0,0,0,0.75)',
                padding: [10, 15],
                textStyle: {
                    fontSize: 13,
                    fontFamily: 'Roboto, sans-serif'
                },
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },

            // Add legend
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: legend_data,
                itemHeight: 8,
                itemWidth: 8
            },

            // Add series
            series: [{
                name: 'Đánh giá',
                type: 'pie',
                radius: '70%',
                center: ['50%', '57.5%'],
                itemStyle: {
                    normal: {
                        borderWidth: 1,
                        borderColor: '#fff'
                    }
                },
                data: series_data
            }]
        })

        // Resize function
        var triggerChartResize = function() {
            chart_element && rating_statical_chart.resize();
        };

        // On sidebar width change
        var sidebarToggle = document.querySelectorAll('.sidebar-control');
        if (sidebarToggle) {
            sidebarToggle.forEach(function(togglers) {
                togglers.addEventListener('click', triggerChartResize);
            });
        }

        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function() {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });

        $(document).on('update-chart', function() {
            console.log('test')
            var legend_data = @this.chart_legend;
            var series_data = @this.chart_series;
    
            rating_statical_chart.setOption({
                legend: {data: legend_data},
                series: [{data: series_data}],
            })
        });

        $('.daterange-picker').daterangepicker({
            parentEl: '.content-inner',
            autoUpdateInput: false,
            showDropdowns: true,
            ranges: {
                'Hôm nay': [moment(), moment()],
                'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '1 tuần trước': [moment().subtract(6, 'days'), moment()],
                '1 tháng trước': [moment().subtract(29, 'days'), moment()],
                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                applyLabel: 'OK',
                cancelLabel: 'Xóa',
                customRangeLabel: 'Tùy chỉnh',
                daysOfWeek: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7','CN'],
                monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                firstDay: 1,
                format: 'DD/MM/YYYY',
            }
        }).on('cancel.daterangepicker', function(ev, picker) {
            // $(this).val('');
            @this.set('daterange', '');
            @this.set('params.from_date', '');
            @this.set('params.to_date', '');
        }).on('apply.daterangepicker', function(ev, picker) {
            // $(this).val(picker.startDate.format('DD/MM/YYYY'));
            var start_date = picker.startDate.format('DD/MM/YYYY');
            var end_date = picker.endDate.format('DD/MM/YYYY');
            @this.set('daterange', `${start_date} - ${end_date}`);
            @this.set('params.from_date', start_date);
            @this.set('params.to_date', end_date);
        });
    });
</script>
@endpush