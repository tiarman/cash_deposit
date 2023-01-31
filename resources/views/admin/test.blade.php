@extends('layouts.admin')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title"><strong>{{ $group->name }}</strong> {{__('group.manage_member_of')}}</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  @if(\App\Helpers\CustomHelper::canView('List Of Group', 'Super Admin'))
                    <a href="{{ route('group.list') }}" class="brn btn-success btn-sm">{{__('group.committee_list')}}</a>
                  @endif
                  <a href="{{ \Illuminate\Support\Facades\URL::previous() }}" class="brn btn-info btn-sm">{{__('group.back')}} </a>
                </div>

                <div class="col-md-12">
                  <form action="{{ route('group.assign.member', $group->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="">{{__('group.members')}}</label>
                      <select name="members[]" id="member-dropdown" class="form-control" multiple>
                        @foreach($members as $member)
                          <option value="{{ $member->id }}"
                                  @if(in_array($member->id, $group_members->toArray())) selected @endif >{{ $member->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <button class="btn btn-danger btn-sm w-full">{{__('group.submit')}}</button>
                  </form>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <div class="col-12 mt-4">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title"><strong>{{ $group->name }}</strong> {{__('group.member_of')}} </h2>
            </header>
            <div class="panel-body">
              <div class="row">
                @foreach($groupHasMembers as $group)
                  <div class="col-sm-6 member-card">
                    <div class="member-item">
                      <div class="row">
                        <div class="col-2">
                          <img src="{{ $group->user?->profile_photo_url }}" alt="{{ $group->user?->name }}">
                        </div>
                        <div class="col-6">
                          <strong>{{ $group->user?->name }}</strong>
                          <p>{{ $group->user?->email }}</p>
                          <p>{{ $group->user?->phone }}</p>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <select name="group-type" data-id="{{ $group->id }}" class="form-control">
                              @foreach(\App\Models\GroupUser::$typeArray as $type)
                                <option value="{{ $type }}"
                                        @if($group->type == $type) selected @endif>{{ ucfirst($type) }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>


  <script>
    $(document).ready(function () {
      $('#member-dropdown').select2()
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      $(document).on('change', 'select[name="group-type"]', function () {
        var id = $(this).data('id')
        var type = $(this).val()
        const $this = $(this);
        $.ajax({
          url: "{{ route('ajax.update.group.type') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'type': type},
          success: function (data) {
            if (data === "exist") {
              Toast.fire({
                icon: 'warning',
                text: 'Sorry. '+ type +' type exist in this group.'
              })
              setTimeout(function () {
                document.location.reload(true)
              }, 3000)
            }
            if (data === "success") {
              Toast.fire({
                icon: 'success',
                text: 'Successfully type changed.'
              })
            }
          }
        });
      })
    })
  </script>
  <script>
    function saveToDatabase() {
      var selectValue = $('#selectBoxID').val();
      console.log(selectValue);
      $.ajax({
        type: 'POST',
        url: "{{ route('ajax.update.group.type') }}",
        data: {selectValueBox: selectValue }
      })
    }
  </script>

@endsection
