(function($) {
  "use strict";
  $('input[name="participate_type"]').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('input[name="participate_type"]').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="participate_type"]').val(ui.item.label);
      return false;
    }
  });

  $('input[name="building_name"]').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('input[name="building_name"]').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="building_name"]').val(ui.item.label);
      return false;
    }
  });


  $('input[name="block_name"]').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('input[name="block_name"]').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="block_name"]').val(ui.item.label);
      return false;
    }
  });

  $('input[name="floor_name"]').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('input[name="floor_name"]').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="floor_name"]').val(ui.item.label);
      return false;
    }
  });

  $('input[name="room_name"]').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('input[name="room_name"]').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="room_name"]').val(ui.item.label);
      return false;
    }
  });

  $('input[name="room_name"]').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('input[name="room_name"]').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="room_name"]').val(ui.item.label);
      return false;
    }
  });


  $('input[name="room_no"]').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('input[name="room_no"]').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="room_no"]').val(ui.item.label);
      return false;
    }
  });


  $('input[name="name_of_item"]').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('input[name="name_of_item"]').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="name_of_item"]').val(ui.item.label);
      return false;
    }
  });


  $('#board_roll_leader').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('#board_roll_leader').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="student_name_leader"]').val(ui.item.name_en);
      $('#student_name_leader_id').val(ui.item.user_id);
      $('#technology').val(ui.item.trade_technology);
      $('#semester').val(ui.item.semester);
      $('#board_roll_leader').val(ui.item.board_roll);
    }
  });
  $('#board_roll_two').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('#board_roll_two').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="student_name_two"]').val(ui.item.name_en);
      $('#student_name_two_id').val(ui.item.user_id);
        $('#technology_two').val(ui.item.trade_technology);
        $('#semester_two').val(ui.item.semester);
            $('#board_roll_two').val(ui.item.label);
      return false;
    }
  });
  $('#board_roll_one').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: $('#board_roll_one').data('url'),
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="student_name_one"]').val(ui.item.name_en);
      $('#student_name_one_id').val(ui.item.user_id);
        $('#technology_one').val(ui.item.trade_technology);
        $('#semester_one').val(ui.item.semester);
      $('#board_roll_one').val(ui.item.label);
      return false;
    }
  });


})(jQuery);
