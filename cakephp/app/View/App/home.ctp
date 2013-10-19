
<script type="text/template" id="chat-template">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 well">
            <div class="row">
                <div class="col-xs-12 col-sm-2 col-md-2">
                    <img src="<%- user_image_url %>" width="80" height="80">
                    <p><%- user_name %></p>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-10">
                    <p><%- body %></p>
                </div>
            </div>
        </div>
    </div>
</script>

<div id="chat-container">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
            <h2>チャット</h2>
            <span id="error"></span>
            <div id="chat-controller">
                <div class="row well">
                    <div class="input-group">
                        <input id="chat-input" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button id="add-chat" class="btn btn-default" type="button">投稿</button>
                        </span>
                    </div>
                </div>
            </div>
            <div id="chats">
            </div>
        </div>
    </div>
</div>


