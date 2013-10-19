/**
 * Created with JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/03
 * Time: 14:39
 * To change this template use File | Settings | File Templates.
 */

$(function(){

    console.log("jQuery on");

    var User = Backbone.Model.extend({
        defaults: function() {
            return {
                id: Users.nextOrder(),
                name: "ゲスト1",
                user_image_url: "http://lorempixel.com/80/80/fashion/"
            };
        },

        parse: function(req) {
            console.log("User parse");
            return req.User;
        }
    });

    var UserList = Backbone.Collection.extend({
        model: User,
        url: "/users/",
        comparator: 'order',
//        localStorage: new Backbone.LocalStorage("chats-backbone"),

        initialize: function() {
            this.on("error", this.onError, this);
            this.on("sync", this.onSync, this);
        },

        nextOrder: function() {
            if (!this.length) return 1;
            return this.last().get('id') + 1;
        },

        onError: function(model, err) {
            console.log("Users onError: " + JSON.stringify(err));
        },

        onSync: function(model, req) {
            console.log("Users onSync: " + JSON.stringify(req));
        },

        parse: function(req) {
            console.log("UserList parse");
            return req.users;
        }
    });
    var Users = new UserList;



    var Chat = Backbone.Model.extend({
        defaults: function() {
            return {
                id: Chats.nextOrder(),
                body: "デフォルトメッセージ",
                user: new User()
            };
        },

        initialize: function() {
            console.log("Chat initialize");
        },

        parse: function(req) {
            console.log("Chat parse");

            return req.Chats;
        }
    });




    var ChatList = Backbone.Collection.extend({
        model: Chat,
        url: "/users/",
        comparator: 'order',
//        localStorage: new Backbone.LocalStorage("chats-backbone"),


        initialize: function() {
            this.on("error", this.onError, this);
            this.on("sync", this.onSync, this);
        },

        nextOrder: function() {
            if (!this.length) return 1;
            return this.last().get('id') + 1;
        },

        onError: function(model, err) {
            console.log("Chats onError: " + JSON.stringify(err));
        },

        onSync: function(model, req) {
            console.log("Chats onSync: " + JSON.stringify(req));

        },

        parse: function(req) {
            console.log("ChatList parse");
            return req.users;
        }
    });
    var Chats = new ChatList;



    var ChatView = Backbone.View.extend({
        tagName: "div",
        template: _.template($('#chat-template').html()),


        initialize: function() {
            console.log("ChatView initialize");
            this.listenTo(this.model, 'change', this.render);
        },

        render: function() {
            console.log("ChatView render");
            var user = Users.where({id: this.model.get("user_id")});
            var template = this.template({user_name: user.name, user_image_url: user.user_image_url, body: this.model.get("body")});
            this.$el.attr("data-chat-id", this.model.get("id"));
            this.$el.html(template);
            return this;
        }
    });




    var AppView = Backbone.View.extend({
        el: "#chat-container",


        events: {
            "click #add-chat": "onClickChatBtn",
            "keypress #chat-input"  : "onKeyPressChatInput"
        },

        initialize: function(){
            console.log("AppView initialize");
            this.input = this.$("#chat-input");
            this.chats = this.$("#chats");

            // Chats.createでaddイベントが発生
            this.listenTo(Chats, 'add', this.addOneChat);
            this.listenTo(Chats, 'reset', this.addAllChat);

            this.listenTo(Users, 'add', this.addUser);

//            Users.fetch({reset: true});
            Chats.fetch({reset: true});
        },

        onClickChatBtn: function(e) {
            console.log("AppView onClickChatBtn");
            if (!this.input.val()) return;

            Chats.create({body: this.input.val()});
        },

        onKeyPressChatInput: function(e) {
            console.log("AppView onKeyPressChatInput");
            if (e.keyCode != 13) return;
            if (!this.input.val()) return;

            Chats.create({body: this.input.val()});
        },

        addOneChat: function(chat) {
            console.log("AppView addOne");
            var chatView = new ChatView({model: chat});
            this.chats.prepend(chatView.render().el);
            this.input.val("");
        },

        addAllChat: function() {
            console.log("AppView addAll");
            var $chatAll = $("<div/>");
            Chats.each(function(chat) {
                var chatView = new ChatView({model: chat});
                $chatAll.prepend(chatView.render().el);
            }, this);
            this.chats.html($chatAll.get(0).innerHTML);
            this.input.val("");
        },

        addUser: function(user) {
            console.log("AppView addUser");
            Users.create(user);
        }
    });



    var appView = new AppView();
});