@extends('layouts.user')

@section('title')
    {{ __('Portfolio') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Portfolio</li>
@endsection

@section('style')
<link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div>
            <div id="live-chart"></div>
        </div>
        <div>
            <div class="card">
                <div class="card-body">
                    <h6>Verify Your Identity</h6>
                    <p>Upload a photo of your driver's license or passport and take a live photo of yourself so we can finish processing your application.</p>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Upload Photo Now</a>
                </div>
            </div>
        </div>
        <div>
            <h4>News</h4>
            <hr>
            <div class="">
                <div class="row">
                    <div class="col-9">
                        <h6>Nikkei Asian Review <small>7h</small></h6>
                        <p>China's tech crackdown widens to Tencent from Alibaba</p>
                        <p>BABA &nbsp; 1.40% &nbsp;&nbsp;&nbsp; TCEHY &nbsp; 0.54%</p>
                    </div>
                    <div class="col-3">
                        <img src="{{ asset('assets/images/small/img-7.jpg') }}" alt="" style="height: 100%; width: 100%; object-fit: contain;">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-9">
                        <h6>Nikkei Asian Review <small>7h</small></h6>
                        <h5>Uber and Lyft Drivers Are Coming Back, but Prices Aren't Falling</h5>
                        <p>Drivers are returning to Uber Technologies Inc. and Lyft Inc. after the companies spent big on incentives to address a pandemic-driven labor shortage. That shif...</p>
                        <p>BABA &nbsp; 1.40% &nbsp;&nbsp;&nbsp; TCEHY &nbsp; 0.54%</p>
                    </div>
                    <div class="col-3">
                        <img src="{{ asset('assets/images/small/img-7.jpg') }}" alt="" style="height: 100%; width: 100%; object-fit: contain;">
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card w-75 mx-auto">
            <div class="card-body">
                <div class="table">
                    <table class="table table-borderless">
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                        <tr class="text-center">
                            <td>BTC</td>
                            <td>BTC</td>
                            <td>$20000</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <img src="{{ asset('svg/upload.svg') }}" alt="">
            <div class="modal-body">
                <p>We need photos of both sides of your passport card, permanent resident card, or state ID in order to verify your identity.</p>
                <div class="form-group">
                    <label for="doc">Document Type:</label>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="formRadios"
                               id="formRadios1" value="Passport">
                        <label class="form-check-label" for="formRadios1">
                            Passport
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="formRadios"
                               id="formRadios2" value="Driver's License">
                        <label class="form-check-label" for="formRadios2">
                            Driver's License
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="formRadios"
                               id="formRadios3" value="Other U.S. Government-Issued ID">
                        <label class="form-check-label" for="formRadios3">
                            Other U.S. Government-Issued ID
                        </label>
                    </div>
                </div>
                <button type="button" id="cont-btn" data-bs-dismiss="modal" onclick="updateModalTitle('#myLargeModalLabel')" disabled class="btn w-100 btn-block btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Continue</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Upload a photo of your </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Please ensure the entire document is in the frame and information is legible.
                <div class="row" id="modalDetails"></div>
                <div class="row">
                    <div class="col-12">
                        <div class="mt-5">
                            <form action="" class="" enctype="multipart/form-data">
                                <input type="hidden" name="type" value="">
                                <input type="file" class="dropify" data-default-file="" data-max-file="1" data-max-file-size="1M" required />
                            </form>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Upload</button>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'line',
                height: 300
            },
            series: [{
                name: 'sales',
                data: [30,40,35,50,49,60,70,91,125]
            }],
            xaxis: {
                categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
            },
            stroke: {
                curve: 'smooth',
            }
        }

        var chart = new ApexCharts(document.querySelector("#live-chart"), options);

        chart.render();

        $('.dropify').dropify({
            messages: {
                'default': '<p style="font-size: 18px">Drag and drop a file here or click</p>',
                'replace': '<p style="font-size: 18px">Drag and drop or click to replace</p>',
                'remove':  'Remove'
            }
        });

        $('input[type="radio"][name="formRadios"]').on('change', function () {
            if ($(this).is(':checked')) $('#cont-btn').attr('disabled', false)
        })

        function updateModalTitle(id) {
            const value = $('input[type="radio"][name="formRadios"]:checked').val()
            $(id).html('Upload a photo of your '+ value)
            $('input[type="hidden"][name="type"]').val(value)

            if (value === "Passport") $('#modalDetails').html(`
                <div class="col-md-6">
                    Your photo must:<br>
                    <i class=" fas fa-check-circle text-success"></i> Be a clear, color image<br>
                    <i class=" fas fa-check-circle text-success"></i> Show the entire page, including your face<br>
                    <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                </div>
                <div class="col-md-6">
                    We can't accept:<br>
                    <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
                </div>
                `);

            if (value === "Driver's License") $('#modalDetails').html(`
                <div class="col-md-6">
                    Your photo must:<br>
                    <i class=" fas fa-check-circle text-success"></i> Be a clear, color image<br>
                    <i class=" fas fa-check-circle text-success"></i> Be of a valid driver’s license or permit<br>
                    <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                </div>
                <div class="col-md-6">
                    We can't accept:<br>
                    <i class="fas fa-times-circle text-danger"></i> Printed or temporary licenses<br>
                    <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
                    <i class="fas fa-times-circle text-danger"></i> Laminated or plastic covered cards<br>
                </div>
                `);

            if (value === "Other U.S. Government-Issued ID") $('#modalDetails').html(`
                <div class="col-md-6">
                    Your photo must:<br>
                    <i class=" fas fa-check-circle text-success"></i> Be a clear, colored image<br>
                    <i class=" fas fa-check-circle text-success"></i> Show all four corners<br>
                </div>
                <div class="col-md-6">
                    We can't accept:<br>
                    <i class="fas fa-times-circle text-danger"></i> U.S. military ID and trusted traveller cards<br>
                    <i class="fas fa-times-circle text-danger"></i> Employment authorization documents<br>
                    <i class="fas fa-times-circle text-danger"></i> Documents not from the U.S. government<br>
                    <i class="fas fa-times-circle text-danger"></i> Scans, copies, or screenshots<br>
                </div>
                `);
        }
    </script>
@endsection

