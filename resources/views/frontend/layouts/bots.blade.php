<section class="wrapper bg-white">
      @php 
        $copyBots = App\Models\CopyBot::inRandomOrder()->get();
      @endphp 
      <div class="container py-14 py-md-16">
        <h3 class="display-5 mb-7 pe-xxl-5">Copy Bots</h3>
        <div class="row">
        <div data-cue="fadeIn">
          <div class="carousel owl-carousel gap-small" data-margin="0" data-dots="true" data-autoplay="false" data-autoplay-timeout="5000" data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "992":{"items": "2"}, "1200":{"items": "3"}}'>
            @foreach($copyBots as $copyBot)
                <div class="item">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="mx-4 card-body mb-3" style="box-shadow: 0px 5px 15px rgba(0,0,0,0.1); border-radius: 20px; padding: 20px;">
                            <div class="row border-bottom pb-4">
                                <div class="col-2">
                                    <img style="border-radius: 999px; width: 50px; height: 50px;" class="bg-dark" src="{{ $copyBot->image }}" alt="" width="75">
                                </div>
                                <div class="col-10">
                                    <h4 class="m-0 p-0">{{ $copyBot->name }}</h4>
                                    <p>From {{ $copyBot->creator }}</p>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <h1 class="text-success">{{ $copyBot->yield }}</h1>
                                    <p>30D Yield</p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6">
                                    <h4 class="font-bold">{{ $copyBot->rate }}</h4>
                                    <p>Subscribe win rate</p>
                                </div>
                                <div class="col-6">
                                    <h4 class="font-bold">{{ $copyBot->aum }}</h4>
                                    <p>AMU (USDT)</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">

                                </div>
                                <div class="col-6">
                                        <!-- <a style="width: 150px; border-radius: 20px;" class="btn btn-md btn-success mx-1" href="javascript:void(0)">Active</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
          <!-- /.owl-carousel -->
        </div>
      </div>
      </div>
    </section>