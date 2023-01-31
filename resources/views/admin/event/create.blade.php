@extends('layout.admin')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Create Event</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Event', 'Super Admin'))
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.event.list') }}" class="brn btn-success btn-sm">List of Events</a>
                </div>
              </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.district.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label class="control-label">Event Name</label>
                          <input type="text" name="name" placeholder="Event Name bangla" autocomplete="off"
                                 value="{{ old('name') }}"
                                 class="form-control @error('name') is-invalid @enderror">
                          @error('name')
                          <strong class="text-danger">{{ $errors->first('name') }}</strong>
                          @enderror
                        </div>
                      </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Starts Date of Event<span class="text-danger">*</span></label>
                            <input type="datetime-local" name="start_date" id="start_date"
                            value="{{old("start_date")}}"
                            placeholder=""
                            class="form-control @error('start_date') is-invalid @enderror"
                            >
                            @error("start_date")
                            <strong class="text-danger">{{ $errors->first("start_date") }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Ends Date of Event<span class="text-danger">*</span></label>
                            <input type="datetime-local" name="end_date" id="end_date"
                            value="{{old("end_date")}}"
                            placeholder=""
                            class="form-control @error('end_date') is-invalid @enderror"
                            >
                            @error("end_date")
                            <strong class="text-danger">{{ $errors->first("end_date") }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="">Time Zone<span class="text-danger">*</span></label>
                            <select
                            name="time_zone"
                            id="time_zone"
                            class="form-control @error("condition_for_years_of_institute_establishment") is-invalid @enderror">
                                <option data-time-zone-id="1" data-gmt-adjustment="GMT-12:00" data-use-daylight="0" value="-12">(GMT-12:00) International Date Line West</option>
                                <option data-time-zone-id="2" data-gmt-adjustment="GMT-11:00" data-use-daylight="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                <option data-time-zone-id="3" data-gmt-adjustment="GMT-10:00" data-use-daylight="0" value="-10">(GMT-10:00) Hawaii</option>
                                <option data-time-zone-id="4" data-gmt-adjustment="GMT-09:00" data-use-daylight="1" value="-9">(GMT-09:00) Alaska</option>
                                <option data-time-zone-id="5" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                                <option data-time-zone-id="6" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                <option data-time-zone-id="7" data-gmt-adjustment="GMT-07:00" data-use-daylight="0" value="-7">(GMT-07:00) Arizona</option>
                                <option data-time-zone-id="8" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                <option data-time-zone-id="9" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                                <option data-time-zone-id="10" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Central America</option>
                                <option data-time-zone-id="11" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                                <option data-time-zone-id="12" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                <option data-time-zone-id="13" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Saskatchewan</option>
                                <option data-time-zone-id="14" data-gmt-adjustment="GMT-05:00" data-use-daylight="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                <option data-time-zone-id="15" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                                <option data-time-zone-id="16" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Indiana (East)</option>
                                <option data-time-zone-id="17" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                <option data-time-zone-id="18" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
                                <option data-time-zone-id="19" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Manaus</option>
                                <option data-time-zone-id="20" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Santiago</option>
                                <option data-time-zone-id="21" data-gmt-adjustment="GMT-03:30" data-use-daylight="1" value="-3.5">(GMT-03:30) Newfoundland</option>
                                <option data-time-zone-id="22" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Brasilia</option>
                                <option data-time-zone-id="23" data-gmt-adjustment="GMT-03:00" data-use-daylight="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
                                <option data-time-zone-id="24" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Greenland</option>
                                <option data-time-zone-id="25" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Montevideo</option>
                                <option data-time-zone-id="26" data-gmt-adjustment="GMT-02:00" data-use-daylight="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
                                <option data-time-zone-id="27" data-gmt-adjustment="GMT-01:00" data-use-daylight="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
                                <option data-time-zone-id="28" data-gmt-adjustment="GMT-01:00" data-use-daylight="1" value="-1">(GMT-01:00) Azores</option>
                                <option data-time-zone-id="29" data-gmt-adjustment="GMT+00:00" data-use-daylight="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                <option data-time-zone-id="30" data-gmt-adjustment="GMT+00:00" data-use-daylight="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                                <option data-time-zone-id="31" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                <option data-time-zone-id="32" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                <option data-time-zone-id="33" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                <option data-time-zone-id="34" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                <option data-time-zone-id="35" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) West Central Africa</option>
                                <option data-time-zone-id="36" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Amman</option>
                                <option data-time-zone-id="37" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                <option data-time-zone-id="38" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Beirut</option>
                                <option data-time-zone-id="39" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Cairo</option>
                                <option data-time-zone-id="40" data-gmt-adjustment="GMT+02:00" data-use-daylight="0" value="2">(GMT+02:00) Harare, Pretoria</option>
                                <option data-time-zone-id="41" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                <option data-time-zone-id="42" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Jerusalem</option>
                                <option data-time-zone-id="43" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Minsk</option>
                                <option data-time-zone-id="44" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Windhoek</option>
                                <option data-time-zone-id="45" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                <option data-time-zone-id="46" data-gmt-adjustment="GMT+03:00" data-use-daylight="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                <option data-time-zone-id="47" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Nairobi</option>
                                <option data-time-zone-id="48" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Tbilisi</option>
                                <option data-time-zone-id="49" data-gmt-adjustment="GMT+03:30" data-use-daylight="1" value="3.5">(GMT+03:30) Tehran</option>
                                <option data-time-zone-id="50" data-gmt-adjustment="GMT+04:00" data-use-daylight="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
                                <option data-time-zone-id="51" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Baku</option>
                                <option data-time-zone-id="52" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Yerevan</option>
                                <option data-time-zone-id="53" data-gmt-adjustment="GMT+04:30" data-use-daylight="0" value="4.5">(GMT+04:30) Kabul</option>
                                <option data-time-zone-id="54" data-gmt-adjustment="GMT+05:00" data-use-daylight="1" value="5">(GMT+05:00) Yekaterinburg</option>
                                <option data-time-zone-id="55" data-gmt-adjustment="GMT+05:00" data-use-daylight="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                <option data-time-zone-id="56" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
                                <option data-time-zone-id="57" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                <option data-time-zone-id="58" data-gmt-adjustment="GMT+05:45" data-use-daylight="0" value="5.75">(GMT+05:45) Kathmandu</option>
                                <option data-time-zone-id="59" data-gmt-adjustment="GMT+06:00" data-use-daylight="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
                                <option data-time-zone-id="60" data-gmt-adjustment="GMT+06:00" data-use-daylight="0" value="6">(GMT+06:00) Astana, Dhaka</option>
                                <option data-time-zone-id="61" data-gmt-adjustment="GMT+06:30" data-use-daylight="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
                                <option data-time-zone-id="62" data-gmt-adjustment="GMT+07:00" data-use-daylight="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                <option data-time-zone-id="63" data-gmt-adjustment="GMT+07:00" data-use-daylight="1" value="7">(GMT+07:00) Krasnoyarsk</option>
                                <option data-time-zone-id="64" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                <option data-time-zone-id="65" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                <option data-time-zone-id="66" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                <option data-time-zone-id="67" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Perth</option>
                                <option data-time-zone-id="68" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Taipei</option>
                                <option data-time-zone-id="69" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                <option data-time-zone-id="70" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Seoul</option>
                                <option data-time-zone-id="71" data-gmt-adjustment="GMT+09:00" data-use-daylight="1" value="9">(GMT+09:00) Yakutsk</option>
                                <option data-time-zone-id="72" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Adelaide</option>
                                <option data-time-zone-id="73" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Darwin</option>
                                <option data-time-zone-id="74" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Brisbane</option>
                                <option data-time-zone-id="75" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                <option data-time-zone-id="76" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Hobart</option>
                                <option data-time-zone-id="77" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
                                <option data-time-zone-id="78" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Vladivostok</option>
                                <option data-time-zone-id="79" data-gmt-adjustment="GMT+11:00" data-use-daylight="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                <option data-time-zone-id="80" data-gmt-adjustment="GMT+12:00" data-use-daylight="1" value="12">(GMT+12:00) Auckland, Wellington</option>
                                <option data-time-zone-id="81" data-gmt-adjustment="GMT+12:00" data-use-daylight="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                <option data-time-zone-id="82" data-gmt-adjustment="GMT+13:00" data-use-daylight="0" value="13">(GMT+13:00) Nuku'alofa</option>
                            </select>
                            @error('time_zone')
                      <strong class="text-danger">{{ $errors->first('time_zone') }}</strong>
                      @enderror
                        </div>
                    </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Repeat Period<span class="text-danger">*</span></label>
                      <select name="repeat_period" id="repeat_period" class="form-control @error('repeat_period') is-invalid @enderror">
                        <option value="">Choose an period</option>
                        <option value="0">Does not repeat</option>
                        <option value="1">1 Months Later</option>
                        <option value="2">2 Months Later</option>
                      </select>
                      @error('repeat_period')
                      <strong class="text-danger">{{ $errors->first('repeat_period') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Event Type<span class="text-danger">*</span></label>
                      <select name="event_type" id="event_type" class="form-control @error('event_type') is-invalid @enderror">
                        <option value="">Choose an Event Type</option>
                        <option value="0">Career Guide</option>
                        <option value="1">Job Placement</option>
                        <option value="2">IT Conference</option>
                      </select>
                      @error('event_type')
                      <strong class="text-danger">{{ $errors->first('event_type') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Event Venue<span class="text-danger">*</span></label>
                      <select name="venue" id="venue" class="form-control @error('venue') is-invalid @enderror">
                        <option value="">Choose an Event Venue</option>
                        <option value="0">	Bangladesh Institute Of Glass And Ceramics</option>
                        <option value="1">Brahmanbaria Technical School And College</option>
                        <option value="2">	Bhola Technical School And Colleges</option>
                      </select>
                      @error('venue')
                      <strong class="text-danger">{{ $errors->first('venue') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Event Host<span class="text-danger">*</span></label>
                      <select name="event_host" id="event_host" class="form-control @error('event_host') is-invalid @enderror">
                        <option value="">Choose an Event Host</option>
                        <option value="0">MD. Abul Kalam</option>
                        <option value="1">Raihan</option>
                        <option value="2">Robin</option>
                      </select>
                      @error('event_host')
                      <strong class="text-danger">{{ $errors->first('event_host') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="form-group">
                      <label for="file">File Upload (optional)</label>
                      <input type="file" name="file" id="file"
                      class="form-control @error('file') is-invalid @enderror"
                      >
                    </div>
                    @error('file')
                    <strong class="text-danger">{{$error->first('file')}}</strong>                              
                    @enderror
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description" class="control-label">Description (Optional)</label>
                      <textarea name="description" placeholder="Name" autocomplete="off" id="summernote"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                      @error('description')
                      <strong class="text-danger">{{ $errors->first('description') }}</strong>
                      @enderror
                    </div>
                  </div>
                  {{-- ending --}}
                </div>
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.js') }}"></script>
<script>
    $(".yearPicker").datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      startDate: '-50y',
      endDate: '+30y',
      autoclose: true
    });
// summernote
    $(document).ready(function(){
        $('#summernote').summernote({
        placeholder: 'Write here ...',
        tabSize: 2,
        height: 100
      });
    })
    
</script>


@endsection
