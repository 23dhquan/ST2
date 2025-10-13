@extends('welcome')
@section('title', 'Dashboard')

@section('content')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">

            <div class="row">
                <div class="col-md-12 col-lg-3">
                    <div  class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                        <div  class="card-body">
                            <div  class="progress-widget">
                                <div  id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                    <svg class="card-slie-arrow icon-24" width="24"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p  class="mb-2">Tổng Tiền Nước</p>
                                    <h4 class="counter">{{ number_format($yearlyTotals['water'], 0) }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <div   class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                    <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p class="mb-2">Tổng Tiền Điện</p>
                                    <h4  class="counter">{{ number_format($yearlyTotals['electricity'], 0) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <div class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-03" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                    <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p  class="mb-2">Tổng Tiền Nhà</p>
                                    <h4 class="counter">{{ number_format($yearlyTotals['house_bill'], 0) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <div class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-04" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                    <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p  class="mb-2">Tổng Tiền DV</p>
                                    <h4 class="counter">{{ number_format($totalPrice)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card" data-aos="fade-up" data-aos-delay="900">
                            <form action="{{ route('dashboard') }}" method="GET" id="yearForm" class=" mt-2 ms-2">
                                <label for="year">Chọn năm:</label>
                                <select  id="year" name="year" onchange="this.form.submit()">
                                    <option class="form-select" value="" disabled selected>Chọn năm</option>
                                    @for ($i = 2022; $i <= \Carbon\Carbon::now()->year; $i++)
                                        <option  value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>

                            </form>
                            <div id="monthlyAmountChart"></div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card credit-card-widget" data-aos="fade-up" data-aos-delay="900">
                            <div class="pb-4 border-0 card-header">
                                <div class="p-4 border border-white rounded primary-gradient-card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="font-weight-bold">VISA </h5>
                                            <P class="mb-0">PREMIUM ACCOUNT</P>
                                        </div>
                                        <div class="master-card-content">
                                            <svg class="master-card-1 icon-60" width="60"  viewBox="0 0 24 24">
                                                <path fill="#ffffff" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                            </svg>
                                            <svg class="master-card-2 icon-60" width="60"  viewBox="0 0 24 24">
                                                <path fill="#ffffff" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-4">
                                        <div class="card-number">
                                            <span class="fs-5 me-2">5789</span>
                                            <span class="fs-5 me-2">****</span>
                                            <span class="fs-5 me-2">****</span>
                                            <span class="fs-5">2847</span>
                                        </div>
                                    </div>
                                    <div class="mb-2 d-flex align-items-center justify-content-between">
                                        <p class="mb-0">Card holder</p>
                                        <p class="mb-0">Expire Date</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6>Mike Smith</h6>
                                        <h6 class="ms-5">06/11</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="flex-wrap mb-4 d-flex align-itmes-center justify-content-between">
                                    <div class="d-flex align-itmes-center me-0 me-md-4">
                                        <div>
                                            <div class="p-3 mb-2 rounded bg-soft-primary">
                                                <svg style="width: 20px; height: 20px" class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M17.8877 10.8967C19.2827 10.7007 20.3567 9.50473 20.3597 8.05573C20.3597 6.62773 19.3187 5.44373 17.9537 5.21973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M19.7285 14.2505C21.0795 14.4525 22.0225 14.9255 22.0225 15.9005C22.0225 16.5715 21.5785 17.0075 20.8605 17.2815" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8867 14.6638C8.67273 14.6638 5.92773 15.1508 5.92773 17.0958C5.92773 19.0398 8.65573 19.5408 11.8867 19.5408C15.1007 19.5408 17.8447 19.0588 17.8447 17.1128C17.8447 15.1668 15.1177 14.6638 11.8867 14.6638Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8869 11.888C13.9959 11.888 15.7059 10.179 15.7059 8.069C15.7059 5.96 13.9959 4.25 11.8869 4.25C9.7779 4.25 8.0679 5.96 8.0679 8.069C8.0599 10.171 9.7569 11.881 11.8589 11.888H11.8869Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M5.88509 10.8967C4.48909 10.7007 3.41609 9.50473 3.41309 8.05573C3.41309 6.62773 4.45409 5.44373 5.81909 5.21973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M4.044 14.2505C2.693 14.4525 1.75 14.9255 1.75 15.9005C1.75 16.5715 2.194 17.0075 2.912 17.2815" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h5>{{$toltalTenant}}</h5>
                                            <small class="mb-0">Khách Hàng</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-itmes-center">
                                        <div>
                                            <div class="p-3 mb-2 rounded bg-soft-info">
                                                <svg style="width: 20px; height: 20px" class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M9.15722 20.7714V17.7047C9.1572 16.9246 9.79312 16.2908 10.581 16.2856H13.4671C14.2587 16.2856 14.9005 16.9209 14.9005 17.7047V17.7047V20.7809C14.9003 21.4432 15.4343 21.9845 16.103 22H18.0271C19.9451 22 21.5 20.4607 21.5 18.5618V18.5618V9.83784C21.4898 9.09083 21.1355 8.38935 20.538 7.93303L13.9577 2.6853C12.8049 1.77157 11.1662 1.77157 10.0134 2.6853L3.46203 7.94256C2.86226 8.39702 2.50739 9.09967 2.5 9.84736V18.5618C2.5 20.4607 4.05488 22 5.97291 22H7.89696C8.58235 22 9.13797 21.4499 9.13797 20.7714V20.7714" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h5>{{$toltalHouse}}</h5>
                                            <small class="mb-0">Phòng Thuê</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="flex-wrap d-flex justify-content-between">
                                        <h3  class="mb-4 mt-2">Tổng Danh Thu</h3>

                                    </div>
                                    <h2 class="mb-2">{{ number_format($totalAmountAll)}} VNĐ</h2>

                                </div>

                            </div>
                        </div>
                        <div class="card" data-aos="fade-up" data-aos-delay="500">
                            <div class="text-center card-body d-flex justify-content-around">
                                <div>
                                    <h2 class="mb-2">750<small>K</small></h2>
                                    <p class="mb-0 text-gray">Website Visitors</p>
                                </div>
                                <hr class="hr-vertial">
                                <div>
                                    <h2 class="mb-2">7,500</h2>
                                    <p class="mb-0 text-gray">New Customers</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 650
            },
            series: [{
                name: 'Tổng tiền',
                data: [
                    @for($i = 1; $i <= 12; $i++)
                        {{ $monthlyTotals[$i] ?? 0 }},
                    @endfor
                ]
            }],
            xaxis: {
                categories: [
                    'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                ],
            },
            fill: {
                opacity: 1,
                colors: ['#008FFB'],
            },
            dataLabels: {
                enabled: false,
            },
            title: {
                text: 'Tổng tiền thanh toán theo từng tháng',
                align: 'center',
                style: {
                    fontSize: '18px',
                    fontWeight: 'bold'
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value.toLocaleString() + ' VND';
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#monthlyAmountChart"), options);
        chart.render();
    </script>
    @endsection
