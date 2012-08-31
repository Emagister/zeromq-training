<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EmagisterTech #rigor chat</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="/css/chatserver.css">
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            // <![CDATA[
            function updateChat(response) {
                $('#chatwindow').append('<p>' + response + '</p>');
                $("#chatwindow").attr({ scrollTop: $("#chatwindow").attr("scrollHeight") });
            }

            $(document).ready(function(){
                myname = '';

                $("#nameform").submit(function(e) {
                    myname = $('#namebox').val();
                    $('#nameform').css('display', 'none');
                    $('#chat').css('display', 'block');
                    e.stopPropagation();
                    e.preventDefault();
                    $('body').append( '<iframe id="datasrc" src="chat.php?name=' + myname + '"></iframe>');
                    $.post('/send.php', {'name': myname, 'message': 'm:joined'});
                });
                $('#chatform').submit(function(e) {
                    $.post('/send.php', {'name': myname, 'message': $('#chatbox').val()});
                    e.stopPropagation();
                    e.preventDefault();
                    $('#chatbox').val('');
                });
            });
            // ]]>
        </script>
    </head>
    <body>
        <div class="navbar navbar-static-top">
            <div class="navbar-inner">
                <a class="brand" href="#">Emagister</a>
                <form id="nameform" class="navbar-form pull-right">
                    <input type="text" class="span2" name="namebox" id="namebox" placeholder="Nickname">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-white icon-user"></i>
                        Join!
                    </button>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="page-header">
                <h1>
                    EmagisterTech Chat
                    <small>#rigor is all-around</small>
                </h1>
            </div>
            <div class="row">
                <div class="span12">
                    <div id="chat">
                        <div id="chatwindow" class="span12">
                        </div>
                        <form id="chatform" class="form-horizontal">
                            <div class="control-group">
                                <div class="input-append">
                                    <input id="chatbox" name="chatbox" type="text" placeholder="Type something" />
                                    <button type="submit" class="btn">
                                        <i class="icon-comment"></i>
                                        Send
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>