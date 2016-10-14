var InviteDialog = {
    init: function() {
        InviteDialog.initDialog();
        InviteDialog.initProgress();
    },

    initProgress: function() {
		    if ($("[data-animate-width]").length>0) {
			      $("[data-animate-width]").each(function() {
				        if (Modernizr.touch || !Modernizr.csstransitions) {
					          $(this).find("span").hide();
				        };
				        var waypoints = $(this).waypoint(function(direction) {
					          $(this.element).animate({width: $(this.element).attr("data-animate-width")}, 800 );
					          this.destroy();
					          if (Modernizr.touch || !Modernizr.csstransitions) {
						            $(this.element).find("span").show('slow');
					          };
				        },{
					          offset: '90%'
				        });
			      });
		    };
    },

    initDialog: function() {
        $('#inviteDialog').on('show.bs.modal', function (event) {
            var modal = $(this);
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var url = button.data('url');

            console.debug(url);

            modal.find('.modal-title').text(title);
            modal.find('.modal-body')
                .html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>')
                .load(url, function () {
                    // when load complete
                    if (button.is(".email")) { InviteDialog.initEmailInvite(); }
                    if (button.is(".facebook")) { InviteDialog.initFacebookInvite(); }
                    if(button.is(".twitter")) { InviteDialog.initTwitterInvite(); }
                });
        });
    },

    initTwitterInvite: function() {
        $("#friend_list").on("click", ".friend", function() {

            $(this).toggleClass("selected");

            var check = $(this).find("input");
            check.prop("checked", !check.is(":checked"));

            var count = $("#friend_list .selected").length;

            if (count == 1) {
                $(".submit").val("Send " + count + " Invite");
            }
            else {
                $(".submit").val("Send " + count + " Invites");
            }
        });

        $("#friend_list").on("click", "#load_more", function() {
            var url = $(this).find("a").data("load");
            InviteDialog.addMoreFriends(url);
        });

        $("#twitter_submit").click(function(e) {
            e.preventDefault();

            //alert('prevented');
            var selected_ids = [];
            $.each($("#friend_list .friend.selected"), function(i, item) {
                selected_ids.push($(item).data("id"));
            });

            var deal_id = $("#friend_list").data("deal");
            var url = $("form").attr("action");

            var data = {
                "friends": selected_ids,
                "deal": deal_id
            };

            $.ajax(url, {
                'data': data,
                'method': 'post',
                success: function(response) {
                    console.log(response);
                }
            }).done(function() {
                $('#inviteDialog').modal("hide");
            });

        });
    },

    initEmailInvite: function() {
        var recipients = $("#recipients");
        recipients.tagsinput('focus');

            recipients.on('beforeItemAdd', function(event) {
            // event.item: contains the item
            // event.cancel: set to true to prevent the item getting added

            // validate input is an email address before adding.
            var exp = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            valid = exp.test(event.item);

            if (!valid) {
                $(".help-block").effect("shake");
                event.cancel = true;
            }

        });

        $("#email_address_input").on("keydown keyup", function(event) {
            event.preventDefault();

            // if key pressed is enter or comma
            if (event.keyCode == 13 || event.keyCode == 188) {
                // add new receipt
            }

            return false;
        });
    },

    initFacebookInvite: function() {
        $("#friend_list").on("click", ".friend", function() {
            $(this).toggleClass("selected");

            var check = $(this).find("input");
            check.prop("checked", !check.is(":checked"));

            var count = $("#friend_list .selected").length;

            if (count == 1) {
                $(".submit").val("Send " + count + " Invite");
            }
            else {
                $(".submit").val("Send " + count + " Invites");
            }
        });

        $("#friend_list").on("click", "#load_more", function() {
            var url = $(this).find("a").data("load");
            InviteDialog.addMoreFriends(url);
        });

        $("#facebook_submit").click(function(e) {
            e.preventDefault();

            var selected_ids = [];
            $.each($("#friend_list input:checked"), function(i, item) {
                selected_ids.push($(item).attr("value"));
            });

            console.debug(selected_ids);

            //$('#inviteDialog').dialog("hide");
            FB.ui({
                method: 'send',
                link: 'http://google.com',
                display: 'dialog',
                to: selected_ids,
                message: 'this is a test'
            });

        });
    },

    addMoreFriends: function(url) {
        $.ajax(url)
            .done(function(response) {
                var friendTemplate = '<div class="col-md-4 friend" data-id="%id%">' +
                        '<a href="#">' +
                        '<img src="%image%" class="pull-left" />' +
                        '<span class="name">%name%</span>' +
                        '</a>' +
                        '</div>';

                var friends = response.friends;

                $.each(friends, function(i, friend) {
                    var html = friendTemplate.replace(/%name%/g, friend.name);
                    html = html.replace(/%image%/g, friend.picture);
                    html = html.replace(/%id%/g, friend.id);

                    $("#friend_list").append(html);
                });

            })
            .always(function(response) {
                var template = '<div class="col-md-12" id="load_more"><a href="#" data-load="%url%" class="btn btn-block btn-info">' + 'Load more friends</a></div>';

                var load_more = $("#friend_list #load_more");
                load_more.remove();

                html = template.replace(/%url%/g, response.next);
                $("#friend_list").append(html);
            });
    }
};

$(document).ready(function() {
    InviteDialog.init();
});
