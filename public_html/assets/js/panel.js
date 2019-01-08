(function(){
  $(document).ready(function(){
    // remove alerts
    $(document).find('.custom-alert .fa').click(function(){
      $('.custom-alert').remove();
    });
    setTimeout(function(){
      $(document).find('.custom-alert').remove();
    }, 5000);

    $('button[data-toggle="modal"], a[data-toggle="modal"]').on('click', function (e) {
      $('.modal:not(".edit-answer")')
        .find("input,textarea,select")
         .val('')
         .end()
        .find("input[type=checkbox], input[type=radio]")
         .prop("checked", "")
         .end();
    });

   
    // Offcanvas
    $("#toggle-sidebar").on('click', function(e) {
      e.preventDefault();
      $("#dashboard").toggleClass("isOpen");
      $(".header-sidebar-title").delay('3000').toggle();
      if(collapse.hasClass('in')){
        collapse.removeClass('in')
      }
    });

    $(window).resize(function(){
      if ($(window).width() <= 992){
        $("#dashboard").removeClass('isOpen');
        $('.header-sidebar-title').hide()
      } else {
        $("#dashboard").addClass('isOpen');
        $('.header-sidebar-title').show();
      }
    });

    // Sidebar
    $('.sidebar-nav > li > a').on('click', function(){
      var hrefId = $(this).attr('href'),
          activeLink = $(this).parent();
      $('.sidebar-nav > li').removeClass('active');
      activeLink.addClass('active');
      $('.content-tab').removeClass('active');
      $(hrefId).addClass('active');
      if(hrefId === '#statistics'){
        $('#stats').collapse({
          toggle: true
        });
      } else {
        $('#stats').collapse({
          toggle: false
        });
      }
    });

    var subMenu = $('.sub-menu > li > a');

    function sidebarAllowToggle(){
      subMenu.on('click', function(){
        var subMenuId = $(this).attr('href');
        $('#usersOnline a[href="'+subMenuId+'"]').tab('show');
        $('.sub-menu > li').removeClass('active');
        $(this).parent().addClass('active');
        $('.sidebar-nav > li > a[href="#statistics"]').trigger('click');
      });
    }

    function sidebarToggle(){
      if($(window).width() < 768){
        $("#dashboard").removeClass("isOpen");
        $(".header-sidebar-title").delay('3000').hide();
        if(collapse.hasClass('in')){
          collapse.removeClass('in')
        }
      } else if($(window).width() >= 768) {
        $("#dashboard").addClass("isOpen");
        $(".header-sidebar-title").delay('3000').show();
        if(collapse.hasClass('in')){
          collapse.removeClass('in')
        }
        sidebarAllowToggle();
      }
    } sidebarToggle(); //Initialize

    if(window.location.pathname === '/panel'
      || window.location.pathname === '/dashboard'
      && window.location.hash){
      $('.content-tab').removeClass('active');
      $(window.location.hash).addClass('active');
      var index = $('.content-tab.active').index();
      $('.sidebar-nav > li').removeClass('active');
      $('.sidebar-nav > li').eq(index).addClass('active');
    } else {
      $('.content-tab').removeClass('active');
      $('.content-tab:first-child').addClass('active');
      $('.sidebar-nav > li').removeClass('active');
      $('.sidebar-nav > li:first-child').addClass('active');
    }

    // get username
    var newMessage_form = $('#form_newMessage');
    var listContainer = $('#user_complete');

    newMessage_form.find('input[name="receiver"]').on('keyup', function(){
      value = $(this).val();

      if(value) {
        setTimeout(function(){
          $.post('checkUsername?q=' + value, function(data){
            if(data.indexOf('list-user') != -1 && data !== 'nodata') {
              listContainer.show();
              listContainer.html(data);
            }
          });
        },500);
      } else {
        listContainer.hide();
        listContainer.empty();
      }

    });

    // set message receiver data
    $('.list-user').on('click', function(){
      var id = $(this).data('id'),
          uNumber = $(this).data('uNumber'),
          name = $(this).text();

      newMessage_form.find('#receiver_id').val(id);
      newMessage_form.find('#receiver_number').val(uNumber);
      newMessage_form.find('input[name="receiver"]').val(name);

      listContainer.hide();
      listContainer.find('.list-group').empty();
    });


    // fetch messages

    if(window.location.href.indexOf('/message?') != -1) {
      $(document).find("form").children("textarea").val("");
      window.reset = function (e) {
        e.wrap("<form>").closest("form").get(0).reset();
        e.unwrap();
      }
      reset($(".msg_attachment"));

      var x = location.search.split('x=')[1].split('&')[0];
      $('#thread').load('fetch?x=' + x);
      setTimeout(function(){
        $('#thread').scrollTop($('#thread')[0].scrollHeight);
      },1000);
      setInterval(function(){
        $('#thread').load('fetch?x=' + x);
      }, 5000);
    }

    if(window.location.href.indexOf('/messages') != -1){
      var iframe = $('.iframe-box iframe');
      if(window.location.search != '') {
        var link = window.location.search;
        iframe.attr('src', 'message' + link);
      }
      var message = $('.inbox-message');
      message.on('click', function(){
        var href = $(this).data('href');
        window.location.href = href.split('message')[1];
        iframe.attr('src', href);
        $('#thread').scrollTop($('#thread')[0].scrollHeight);
      });
    }
    if(window.location.href.indexOf('/forums') != -1){
      var subject = $('#filter-subject');
      subject.find('option:first').attr('value', 'all');
      subject.on('change', function(){
        var value = $(this).val();
        window.location.href = 'forums?filter=' + value
      });
      var selected = window.location.search.split('=')[1];
      subject.find('option').each(function(){
        if($(this).attr('value') == selected ) {
          $(this).attr('selected', 'selected');
        }
      })
    }


  });
})();
