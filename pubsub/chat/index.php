<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>EmagisterTech Chat</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/bootstrap-responsive.min.css">
        <style type="text/css">
            /* <![CDATA[ */
            #chat{display:none;}
            #datasrc{display:none;}
            /* ]]> */
        </style>
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>EmagisterTech Chat<small>#rigor is all-around</small></h1>
            </div>
            <div class="row">
                <div class="span4">
                    <h2>Your credentials</h2>
                    <form id="join-form" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="name">Your name</label>
                            <input type="text" id="name" name="name" placeholder="Your name">
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-white icon-user"></i>
                                Join!
                            </button>
                        </div>
                    </form>
                </div>
                <div class="span8">
                    <div id="chat">
                        <div id="chatwindow"></div>
                        <form id="chatform">
                            <div class="input-append">
                                <input type="text" class="input-xxlarge" id="message" name="message" value="" placeholder="Introduce your message"><button type="submit" class="btn"><i class="icon-comment"></i>Send!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            // <![CDATA[
            function updateChat() {
                $('#chatwindow').append('<p>' + response + '</p>');
                $("#chatwindow").attr({ scrollTop: $("#chatwindow").attr("scrollHeight") });
            }

            $(document).ready(function() {
                var name = '';
                $('#join-form button').click(function(event) {
                    name = $('#name').val();
                    $('#join-form').css('display', 'none');
                    $('#chat').css('display', 'block');
                    event.stopPropagation();
                    event.preventDefault();
                    $('body').append('<iframe id="datasrc" src="/chat.php"></iframe>');
                    $.post('send.php', {
                        'name': name,
                        'message': 'm:joined'
                    });
                });

                $('#chatform button').click(function(event) {
                    $.post('/send.php', {
                        'name': name,
                        'message': $('#message').val()
                    });
                    event.stopPropagation();
                    event.preventDefault();
                    $('#message').val();
                });
            });
            // ]]>
        </script>
    </body>
</html>