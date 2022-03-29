@extends("app")

@section("content")

    <!-- begin:content -->
    <div id="content" style="padding: 30px 0 20px 0;">

        @if(Session::has('flash_message'))
            <div class="alert alert-success alert-box" style="text-align: center;font-size: 16px;position: fixed;top: 20%;z-index: 1000;padding-right: 35px;background-color: rgb(0 0 0);color: rgb(255 255 255);border: 0;max-width: 400px;border-radius: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute;top: 5px;right: 8px;font-size: 28px;line-height: 0.5;opacity: 0.8;font-weight: 100;text-shadow: none;color: #ffffff;">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-box" style="text-align: center;font-size: 16px;position: fixed;top: 20%;z-index: 1000;padding-right: 35px;background-color: rgb(0 0 0);color: rgb(255 255 255);border: 0;max-width: 400px;border-radius: 0;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute;top: 5px;right: 8px;font-size: 28px;line-height: 0.5;opacity: 0.8;font-weight: 100;text-shadow: none;color: #ffffff;">
                        <span aria-hidden="true">&times;</span></button>
                    {{$error}}
                </div>
            @endforeach
        @endif

        <div class="container" style="width: 100%;">

            <!-- begin:latest -->

            <div class="row" style="margin: 0;">

                <div style="padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div style="margin: 0;display: flex;justify-content: space-between;flex-wrap: wrap;" class="row">

                        <div style="margin-bottom: 15px;" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <h3 style="margin: 0;">Upcoming Events</h3>
                        </div>

                        <div style="display: flex;justify-content: flex-end;align-items: center;margin-bottom: 15px;" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div style="color: #3f3f3f;font-size: 16px;padding: 0;font-weight: 800;margin-right: 10px;" class="label">{{__('text.Sort by:')}}</div>

                            <select name="filter_orderby" class="orderby" data-placeholder="Sort by" tabindex="-1" aria-hidden="true">
                                <option value="Price Highest">Price Highest</option>
                                <option value="Price Lowest">Price Lowest</option>
                                <option value="Earliest">Earliest</option>
                                <option value="Oldest">Oldest</option>
                            </select>
                        </div>

                    </div>

                    <div class="row company-boxes">

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sub">

                            <div style="border: 1px solid #dfdfdf;display: flex;justify-content: flex-start;flex-direction: column;" class="row">
                                <div style="display: flex;justify-content: space-between;padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>Warmup Match</h4>
                                    <button style="background-color: #d9cef8;border-color: #d9cef8;color: #8b6be5;font-weight: 600;" class="btn btn-primary">Games</button>
                                </div>
                                <div style="display: flex;justify-content: space-between;padding: 0;margin-top: 15px;flex-wrap: wrap;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div style="padding: 0;display: flex;flex-direction: column;" class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                        <h5>MCG Club Indoor Ground</h5>
                                        <span>South Yara VIC 3141, Australia</span>
                                        <span>10:00 AM</span>

                                    </div>

                                    <div style="padding: 0;display: flex;flex-direction: column;align-items: flex-end;padding-right: 10px;" class="col-lg-5 col-md-5 col-sm-5 col-xs-5">

                                        <span style="width: 50px;height: 50px;border-radius: 100%;background-color: #cdf2dc;color: #45D87B;display: flex;justify-content: center;align-items: center;font-size: 18px;font-weight: bold;font-family: monospace;">14</span>
                                        <span style="font-weight: 600;">May, 2019</span>

                                    </div>

                                    <div style="padding: 0;display: flex;justify-content: space-between;align-items: center;margin-top: 10px;padding-right: 10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <button style="background-color: white;border-color: #62CDF2;color: #62CDF2;font-weight: 600;font-size: 12px;" class="btn btn-primary">View Details</button>
                                        <span style="font-weight: 100;">13 andere data</span>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sub">

                            <div style="border: 1px solid #dfdfdf;display: flex;justify-content: flex-start;flex-direction: column;" class="row">
                                <div style="display: flex;justify-content: space-between;padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>Warmup Match</h4>
                                    <button style="background-color: #d9cef8;border-color: #d9cef8;color: #8b6be5;font-weight: 600;" class="btn btn-primary">Games</button>
                                </div>
                                <div style="display: flex;justify-content: space-between;padding: 0;margin-top: 15px;flex-wrap: wrap;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div style="padding: 0;display: flex;flex-direction: column;" class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                        <h5>MCG Club Indoor Ground</h5>
                                        <span>South Yara VIC 3141, Australia</span>
                                        <span>10:00 AM</span>

                                    </div>

                                    <div style="padding: 0;display: flex;flex-direction: column;align-items: flex-end;padding-right: 10px;" class="col-lg-5 col-md-5 col-sm-5 col-xs-5">

                                        <span style="width: 50px;height: 50px;border-radius: 100%;background-color: #cdf2dc;color: #45D87B;display: flex;justify-content: center;align-items: center;font-size: 18px;font-weight: bold;font-family: monospace;">14</span>
                                        <span style="font-weight: 600;">May, 2019</span>

                                    </div>

                                    <div style="padding: 0;display: flex;justify-content: space-between;align-items: center;margin-top: 10px;padding-right: 10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <button style="background-color: white;border-color: #62CDF2;color: #62CDF2;font-weight: 600;font-size: 12px;" class="btn btn-primary">View Details</button>
                                        <span style="font-weight: 100;">13 andere data</span>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sub">

                            <div style="border: 1px solid #dfdfdf;display: flex;justify-content: flex-start;flex-direction: column;" class="row">
                                <div style="display: flex;justify-content: space-between;padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>Warmup Match</h4>
                                    <button style="background-color: #d9cef8;border-color: #d9cef8;color: #8b6be5;font-weight: 600;" class="btn btn-primary">Games</button>
                                </div>
                                <div style="display: flex;justify-content: space-between;padding: 0;margin-top: 15px;flex-wrap: wrap;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div style="padding: 0;display: flex;flex-direction: column;" class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                        <h5>MCG Club Indoor Ground</h5>
                                        <span>South Yara VIC 3141, Australia</span>
                                        <span>10:00 AM</span>

                                    </div>

                                    <div style="padding: 0;display: flex;flex-direction: column;align-items: flex-end;padding-right: 10px;" class="col-lg-5 col-md-5 col-sm-5 col-xs-5">

                                        <span style="width: 50px;height: 50px;border-radius: 100%;background-color: #cdf2dc;color: #45D87B;display: flex;justify-content: center;align-items: center;font-size: 18px;font-weight: bold;font-family: monospace;">14</span>
                                        <span style="font-weight: 600;">May, 2019</span>

                                    </div>

                                    <div style="padding: 0;display: flex;justify-content: space-between;align-items: center;margin-top: 10px;padding-right: 10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <button style="background-color: white;border-color: #62CDF2;color: #62CDF2;font-weight: 600;font-size: 12px;" class="btn btn-primary">View Details</button>
                                        <span style="font-weight: 100;">13 andere data</span>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sub">

                            <div style="border: 1px solid #dfdfdf;display: flex;justify-content: flex-start;flex-direction: column;" class="row">
                                <div style="display: flex;justify-content: space-between;padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>Warmup Match</h4>
                                    <button style="background-color: #d9cef8;border-color: #d9cef8;color: #8b6be5;font-weight: 600;" class="btn btn-primary">Games</button>
                                </div>
                                <div style="display: flex;justify-content: space-between;padding: 0;margin-top: 15px;flex-wrap: wrap;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div style="padding: 0;display: flex;flex-direction: column;" class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                        <h5>MCG Club Indoor Ground</h5>
                                        <span>South Yara VIC 3141, Australia</span>
                                        <span>10:00 AM</span>

                                    </div>

                                    <div style="padding: 0;display: flex;flex-direction: column;align-items: flex-end;padding-right: 10px;" class="col-lg-5 col-md-5 col-sm-5 col-xs-5">

                                        <span style="width: 50px;height: 50px;border-radius: 100%;background-color: #cdf2dc;color: #45D87B;display: flex;justify-content: center;align-items: center;font-size: 18px;font-weight: bold;font-family: monospace;">14</span>
                                        <span style="font-weight: 600;">May, 2019</span>

                                    </div>

                                    <div style="padding: 0;display: flex;justify-content: space-between;align-items: center;margin-top: 10px;padding-right: 10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <button style="background-color: white;border-color: #62CDF2;color: #62CDF2;font-weight: 600;font-size: 12px;" class="btn btn-primary">View Details</button>
                                        <span style="font-weight: 100;">13 andere data</span>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sub">

                            <div style="border: 1px solid #dfdfdf;display: flex;justify-content: flex-start;flex-direction: column;" class="row">
                                <div style="display: flex;justify-content: space-between;padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>Warmup Match</h4>
                                    <button style="background-color: #d9cef8;border-color: #d9cef8;color: #8b6be5;font-weight: 600;" class="btn btn-primary">Games</button>
                                </div>
                                <div style="display: flex;justify-content: space-between;padding: 0;margin-top: 15px;flex-wrap: wrap;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div style="padding: 0;display: flex;flex-direction: column;" class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                        <h5>MCG Club Indoor Ground</h5>
                                        <span>South Yara VIC 3141, Australia</span>
                                        <span>10:00 AM</span>

                                    </div>

                                    <div style="padding: 0;display: flex;flex-direction: column;align-items: flex-end;padding-right: 10px;" class="col-lg-5 col-md-5 col-sm-5 col-xs-5">

                                        <span style="width: 50px;height: 50px;border-radius: 100%;background-color: #cdf2dc;color: #45D87B;display: flex;justify-content: center;align-items: center;font-size: 18px;font-weight: bold;font-family: monospace;">14</span>
                                        <span style="font-weight: 600;">May, 2019</span>

                                    </div>

                                    <div style="padding: 0;display: flex;justify-content: space-between;align-items: center;margin-top: 10px;padding-right: 10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <button style="background-color: white;border-color: #62CDF2;color: #62CDF2;font-weight: 600;font-size: 12px;" class="btn btn-primary">View Details</button>
                                        <span style="font-weight: 100;">13 andere data</span>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sub">

                            <div style="border: 1px solid #dfdfdf;display: flex;justify-content: flex-start;flex-direction: column;" class="row">
                                <div style="display: flex;justify-content: space-between;padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>Warmup Match</h4>
                                    <button style="background-color: #d9cef8;border-color: #d9cef8;color: #8b6be5;font-weight: 600;" class="btn btn-primary">Games</button>
                                </div>
                                <div style="display: flex;justify-content: space-between;padding: 0;margin-top: 15px;flex-wrap: wrap;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div style="padding: 0;display: flex;flex-direction: column;" class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                        <h5>MCG Club Indoor Ground</h5>
                                        <span>South Yara VIC 3141, Australia</span>
                                        <span>10:00 AM</span>

                                    </div>

                                    <div style="padding: 0;display: flex;flex-direction: column;align-items: flex-end;padding-right: 10px;" class="col-lg-5 col-md-5 col-sm-5 col-xs-5">

                                        <span style="width: 50px;height: 50px;border-radius: 100%;background-color: #cdf2dc;color: #45D87B;display: flex;justify-content: center;align-items: center;font-size: 18px;font-weight: bold;font-family: monospace;">14</span>
                                        <span style="font-weight: 600;">May, 2019</span>

                                    </div>

                                    <div style="padding: 0;display: flex;justify-content: space-between;align-items: center;margin-top: 10px;padding-right: 10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <button style="background-color: white;border-color: #62CDF2;color: #62CDF2;font-weight: 600;font-size: 12px;" class="btn btn-primary">View Details</button>
                                        <span style="font-weight: 100;">13 andere data</span>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sub">

                            <div style="border: 1px solid #dfdfdf;display: flex;justify-content: flex-start;flex-direction: column;" class="row">
                                <div style="display: flex;justify-content: space-between;padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>Warmup Match</h4>
                                    <button style="background-color: #d9cef8;border-color: #d9cef8;color: #8b6be5;font-weight: 600;" class="btn btn-primary">Games</button>
                                </div>
                                <div style="display: flex;justify-content: space-between;padding: 0;margin-top: 15px;flex-wrap: wrap;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div style="padding: 0;display: flex;flex-direction: column;" class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                        <h5>MCG Club Indoor Ground</h5>
                                        <span>South Yara VIC 3141, Australia</span>
                                        <span>10:00 AM</span>

                                    </div>

                                    <div style="padding: 0;display: flex;flex-direction: column;align-items: flex-end;padding-right: 10px;" class="col-lg-5 col-md-5 col-sm-5 col-xs-5">

                                        <span style="width: 50px;height: 50px;border-radius: 100%;background-color: #cdf2dc;color: #45D87B;display: flex;justify-content: center;align-items: center;font-size: 18px;font-weight: bold;font-family: monospace;">14</span>
                                        <span style="font-weight: 600;">May, 2019</span>

                                    </div>

                                    <div style="padding: 0;display: flex;justify-content: space-between;align-items: center;margin-top: 10px;padding-right: 10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <button style="background-color: white;border-color: #62CDF2;color: #62CDF2;font-weight: 600;font-size: 12px;" class="btn btn-primary">View Details</button>
                                        <span style="font-weight: 100;">13 andere data</span>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sub">

                            <div style="border: 1px solid #dfdfdf;display: flex;justify-content: flex-start;flex-direction: column;" class="row">
                                <div style="display: flex;justify-content: space-between;padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4>Warmup Match</h4>
                                    <button style="background-color: #d9cef8;border-color: #d9cef8;color: #8b6be5;font-weight: 600;" class="btn btn-primary">Games</button>
                                </div>
                                <div style="display: flex;justify-content: space-between;padding: 0;margin-top: 15px;flex-wrap: wrap;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div style="padding: 0;display: flex;flex-direction: column;" class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                        <h5>MCG Club Indoor Ground</h5>
                                        <span>South Yara VIC 3141, Australia</span>
                                        <span>10:00 AM</span>

                                    </div>

                                    <div style="padding: 0;display: flex;flex-direction: column;align-items: flex-end;padding-right: 10px;" class="col-lg-5 col-md-5 col-sm-5 col-xs-5">

                                        <span style="width: 50px;height: 50px;border-radius: 100%;background-color: #cdf2dc;color: #45D87B;display: flex;justify-content: center;align-items: center;font-size: 18px;font-weight: bold;font-family: monospace;">14</span>
                                        <span style="font-weight: 600;">May, 2019</span>

                                    </div>

                                    <div style="padding: 0;display: flex;justify-content: space-between;align-items: center;margin-top: 10px;padding-right: 10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <button style="background-color: white;border-color: #62CDF2;color: #62CDF2;font-weight: 600;font-size: 12px;" class="btn btn-primary">View Details</button>
                                        <span style="font-weight: 100;">13 andere data</span>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- end:latest -->

            <div class="row" style="margin: 50px 0;">

                <div style="border: 1px solid #dadada;border-radius: 10px;" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h4 style="border-bottom: 1px solid #e4e4e4;padding-bottom: 5px;">Beschrijing</h4>
                    <p class="addReadMore showlesscontent">
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                        Maak kennis met de beste makelaar van Amstelveen e.o.
                        Ik ben Felix, dé makelaar van Amstelveen e.o. Wat mij drijft, is jouw.
                    </p>
                </div>

            </div>

        </div>
    </div>
    <!-- end:content -->

    <!-- begin:modal-message -->
    <div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="modal-signin" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom:none;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <div class="modal-body">
                    <div id="ajax" style="color: #db2424"></div>
                </div>

            </div>
        </div>
    </div>
    <!-- end:modal-message -->

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

    <style>

        .bottom-list li
        {
            float: left;
            margin: 10px;
        }

        .bottom-list li a
        {
            color: black;
        }

        .bottom-list li a:hover
        {
            color: #3bafda;
        }

        #footer
        {
            background-color: white;
            border-top: 1px solid #686868;
            padding: 20px 0 0;
        }

        #footer .widget h3
        {
            color: black;
        }

        .copyright .social-links > li > a > .fa
        {
            color: white;
        }

        .wrapper2 {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper2 .content {
            background: #FFE870;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            min-width: 200px;
            border-radius: 10px;
            text-align: center;
        }
        .wrapper2 .content p
        {
            color: black;
            text-align: left;
        }
        .wrapper2 .content p span {
            color: #685905;
            font-size: 20px;
            font-weight: 900;
        }
        .wrapper2 .content section {
            color: #929da6;
            font-size: 15px;
        }
        .wrapper2 .content footer input {
            border: unset;
            background-color: #FFF5BF;
            padding: 15px;
            font-size: 13px;
            border-radius: 10px;
            width: 100%;
        }
        .wrapper2 .content footer button {
            background-color: #685905;
            color: #fff;
            border: unset;
            width: 100%;
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
            cursor: pointer;
        }

        .wrapper2 .content footer input:focus, .wrapper2 .content footer button:focus {
            outline: none;
        }

        .fav-articles
        {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .fav-articles img
        {
            width: 100px;
            height: 100px;
            border-radius: 100%;
        }

        .fav-articles span
        {
            margin-top: 20px;
            text-align: center;
        }

        .fav-articles h4
        {
            font-weight: 600;
            text-align: center;
        }

        .company-boxes
        {
            margin: 0;
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .company-boxes .sub
        {
            padding: 10px;
            /*margin-top: 10px;*/
        }

        .company-boxes .row
        {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-direction: column;
            margin: 0;
            border-radius: 5px;
            width: 100%;
            min-height: 185px;
            /*border: 2px solid black;*/
            padding: 10px;
            margin-top: 10px;
        }

        .company-boxes a
        {
            color: #6C6CA4;
            font-weight: 600;
            font-size: 18px;
        }

        .ekko-lightbox .modal-dialog
        {
            margin: 10px;
        }

        @media (max-width: 478px)
        {
            .res-container
            {
                padding: 0 !important;
            }


            .res-content
            {
                height: 150px !important;
                font-size: 20px;
            }


            .res-size
            {
                min-height: 280px !important;
            }

            .bottom-text
            {
                min-height: 55px !important;
                flex-direction: column !important;
                justify-content: flex-end !important;
                align-items: flex-start !important;
            }

            .bottom-text small
            {
                margin: 2px 0px;
            }
        }

        @media (max-width: 768px)
        {
            .latest
            {
                height: 185px !important;
            }

            .property-content h3, .property-text h3
            {
                font-size: 15px !important;
                line-height: 18px !important;
            }


            .property-content h3 .res-small
            {
                font-size: 10px !important;
            }

            .property-content h3 .res-span
            {
                font-size: 10px !important;
            }

            .property-content h3 small, .property-text h3 small
            {
                font-size: 11px;
                margin-top: 5px;
            }

            /*.extra-text span
            {
                font-size: 9px !important;
            }*/

            .extra-text img
            {
                width: 10px !important;
                height: 10px !important;
                margin-right: 5px !important;
            }

            .property-content .company-res
            {
                font-size: 12px !important;
            }

        }

        small
        {
            line-height: 15px !important;
        }

        @media (max-width: 400px) {
            .status-responsive {
                width: 120px !important;
                font-size: 10px !important;
            }
        }

        @media (max-width: 1299px){
            .latest-container{padding: 0px 95px;}
            .top-container1{padding: 0px 95px;}
            .members-container{padding: 0px 95px;}
            .show-more-container{padding: 0px 120px;}
        }

        @media (min-width: 1300px){
            .latest-container{padding: 0px 200px;}
            .top-container1{padding: 0px 200px;}
            .members-container{padding: 0px 200px;}
            .show-more-container{padding: 0px 215px;}
        }

        @media (max-width: 1200px){
            .latest-container{padding: 0px 15px;}
            .top-container1{padding: 0px 15px;}
            .members-container{padding: 0px 15px;}
            .show-more-container{padding: 0px 15px;}
        }

        .video-wrapper-inner .popup-video{position:relative;z-index:1;display:inline-block;width:50px;height:50px;line-height:50px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;font-size:18px;color:#fff;background:#f9424b;text-align:center}

        @media (min-width: 1200px){.video-wrapper-inner .popup-video{width:70px;height:70px;line-height:70px;font-size:22px}}

        .video-wrapper-inner .popup-video:before{-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;content:'';position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;background:#f9424b;opacity:0.3;filter:alpha(opacity=30);border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-animation:scaleicon 3s ease-in-out 0s infinite alternate;animation:scaleicon 3s ease-in-out 0s infinite alternate}.widget-video.style2 .popup-video{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}

        @-webkit-keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}

        @keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}

        .css-htlmaj
        {
            padding:0 18px;
            margin:0px auto 0px;
        }

        @media(min-width:1021px)
        {
            .css-htlmaj
            {
                padding:0 10px;
                margin-bottom:50px;
            }
        }

        .css-ce6ko1{font-size:25px;font-weight:bold;margin-bottom:30px;}

        .css-48sroz{ align-items: center;justify-content: center;flex-direction: column; }

        @media(min-width:624px){.css-48sroz{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:justify;-webkit-justify-content:flex-start;-ms-flex-pack:justify;justify-content:flex-start;}}

        @media(min-width:1021px){.css-48sroz{border-radius:3px;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;}}

        .css-48sroz li{font-weight:bold;margin-bottom:12px;background-color:#fff;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);}

        .css-48sroz li:hover,.css-48sroz li:focus{box-shadow:0 3px 6px 0 rgba(30,41,61,0.15),0 5px 10px 0 rgba(30,41,61,0.15);-webkit-transition:box-shadow ease-in 100ms;transition:box-shadow ease-in 100ms;z-index:1;}

        @media(min-width:624px){.css-48sroz li{-webkit-flex-basis:calc(50% - 6px);-ms-flex-preferred-size:calc(50% - 6px);flex-basis:calc(50% - 6px);}}

        @media(min-width:1021px){

            .css-48sroz li{width: 70%;-webkit-box-flex:0;-webkit-flex-grow:0;-ms-flex-positive:0;flex-grow:0;-webkit-flex-basis:24%;-ms-flex-preferred-size:24%;flex-basis:24%;font-size:18px;text-align:center;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);border-right:1px solid #e6e9ed;margin-top:-1px;margin-bottom:-1px;}

            .css-48sroz li:last-child{border-right-width:0;}

        }

        @media(min-width:1600px){.css-48sroz li{-webkit-box-flex:0;-webkit-flex-grow:0;-ms-flex-positive:0;flex-grow:0;-webkit-flex-basis:16%;-ms-flex-preferred-size:16%;flex-basis:16%;font-size:18px;text-align:center;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);border-right:1px solid #e6e9ed;margin-top:-1px;margin-bottom:-1px;}}

        .css-48sroz a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;padding:12px;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;font-size: 90%;}

        @media(min-width:1021px){.css-48sroz a{display:block;padding:20px 18px;height:100%;}}

        .css-48sroz img{color:#0ea800;width:110px !important;height:80px !important;margin-right:12px;}

        @media(min-width:1021px){.css-48sroz img{display:block;margin:0 auto 20px auto;width:100% !important;height:125px !important;}}

        .css-jeyium{stroke-linejoin:round;stroke-linecap:round;fill:none;vertical-align:middle;width:24px;height:24px;}


        .latest
        {
            height: 210px;
        }

        .latest img
        {
            height: 100%;
        }

        .property-status img
        {
            display: inline-block;
        }

        .property-status a:focus
        {
            outline: none;
        }

        .modal-backdrop.fade
        {
            opacity: 0.5;
        }

        .ekko-lightbox .modal-header
        {
            min-height: 0;
            padding: 0;
            border: 0;
            display: none;

        }

        .ekko-lightbox .modal-title
        {
            display: none;
        }

        .ekko-lightbox .modal-header .close
        {
            font-size: 60px;
            position: absolute;
            right: -115px;
            top: -62px;
            opacity: 0.8;
            text-shadow: none;

        }

        .ekko-lightbox .modal-body
        {
            padding: 0;
        }

        .ekko-lightbox .modal-content
        {
            border:0;
        }

        .ekko-lightbox .close{
            position: absolute;
            right: 43px;
            top: -3px;
            opacity: 0.6;
            text-shadow: none;
            outline: 0;
        }

        .ekko-lightbox .close span{
            font-size: 88px;
        }

        a
        {
            text-decoration: none;
        }

        a:hover, a:focus
        {
            text-decoration: none;
        }

        .fade {
            opacity: 0;
            transition: all .2s linear;
        }

        .modal1.fade.in
        {
            display: flex !important;
        }

        .modal2.fade.in
        {
            display: flex !important;
        }

        .navbar-fixed-top, .navbar-fixed-bottom
        {
            -webkit-transform: none;
            transform: none;
        }


        .slick-slide
        {
            outline: none;
        }

        @media (min-width: 1200px){

            .slick-slide
            {
                padding: 0px 20px;
            }

        }

        @media (min-width: 1250px){

            .slick-slide
            {
                padding: 0px 30px;
            }

        }

        .property-container
        {
            box-shadow: 0 0rem 1.2rem -3px #c2c2c2;margin-bottom: 30px;padding: 0;
        }

        .slick-arrow{position:absolute;top:50%;width:60px;height:60px;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);background:rgba(#fff,0.8);color:#0b2047;text-align:center;cursor:pointer;z-index:1;width:48px;height:48px;background:#fff;color:#3c475b;border:0;border-radius:50%;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);opacity:0.9;}

        .slick-arrow:before
        {
            display: none;
        }

        .slick-arrow:hover , .slick-arrow:focus
        {
            outline: none;
            background: #fff;
        }

        .css-oee40j{stroke-linejoin:round;stroke-linecap:round;fill:none;vertical-align:middle;width:24px;height:24px;vertical-align:middle;}

        .css-oee40j:hover
        {
            color: #0ea800;
        }

        .slick-prev:hover, .slick-prev:focus, .slick-next:hover, .slick-next:focus
        {
            color: #0ea800;
        }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>

        $(document).ready(function () {

            $('.orderby').select2({
                minimumResultsForSearch: Infinity,
                width: '150px',
            });

        });

    </script>

    <style>

        .ck-cont
        {
            flex: 1;
        }

        #myModal2 .modal-dialog .modal-content .modal-body{display: inline-block;}

        #myModal2 .modal-dialog
        {
            margin: auto;
            width: 60%;
        }

        #myModal1 .modal-dialog .modal-content .modal-body{display: inline-block;}

        #myModal1 .modal-dialog
        {
            margin: auto;
            width: 60%;
        }

        .cookie-box{height: 100%;padding: 15px;border: 1px solid #e5e5e5;}

        .cookie-box:hover{border: 1px solid #f3de47 !important;cursor: pointer;}

        .cookie-selected{border: 1px solid #f3de47;}

        @media (max-width: 992px)
        {
            .trending
            {
                margin-top: 30px;
            }

            .bottom-list
            {
                justify-content: flex-start !important;
            }

            .bottom-list li
            {
                float: none;
            }

            .wrapper2-container
            {
                justify-content: flex-start !important;
            }

            .wrapper2
            {
                width: auto !important;
            }
        }

        @media (max-width: 1200px)
        {
            #myModal1 .modal-dialog
            {
                width: 80%;
            }

            #myModal2 .modal-dialog
            {
                width: 80%;
            }
        }

        @media (max-width: 991px)
        {

            #myModal1 .modal-dialog
            {
                width: 90%;
            }

            #myModal2 .modal-dialog
            {
                width: 90%;
            }

            .ck-cont
            {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 767px)
        {
            .ck-ls
            {
                margin-top: 20px !important;
            }

            .ck-ls span{margin-left: 10px;}

            .res-ck{flex-direction: column;}

        }

        .modal-open1{
            overflow: hidden;
            padding-right: 9px;
        }

        body
        {
            padding-right: 0 !important;
        }

    </style>

@endsection
