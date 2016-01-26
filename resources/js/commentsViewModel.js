$(document).ready(function(){
    //Comment object
    function Comment(nickname, date, commentMsg, editable){
        var self = this;
        self.nickname = nickname;
        self.date = date;
        self.commentMsg = ko.observable(commentMsg);
        self.editable = editable;
        self.editingComment = ko.observable(false);
        self.editedCommentMsg = ko.observable(self.commentMsg());
    }

    //Comments View-Model
    function CommentsViewModel(){
        var self = this;
        self.comments = ko.observableArray();
        self.pageCommentCount = 0;
        self.editMessageToUser = ko.observable();
        self.postMessageToUser = ko.observable();
        self.commentMsgToPost = ko.observable();

        /********Get Comments method*********/
        self.getNewComments = function(){
            $.post("get-comments.php", {pageID : ""+window.location.search.replace("?page=", "")+"",  pageCount : self.pageCommentCount}, function(data){
                self.pageCommentCount++;
                var newComments = JSON.parse(data);
                self.comments.unshift(new Comment(newComments.nickname, newComments.date, newComments.commentMsg, newComments.editable));
                self.getNewComments();
            });
        }

        //*********Make editing form for comments visible**********
        self.showFormForEditingComment = function(comment){
            comment.editingComment(true);
        }

        /**********Cancel editing**********/
        self.cancelEditing = function(comment){
            comment.editingComment(false);
        }

        /*********Send edited message***********/
        self.postEditedComment = function(comment){
            $.post("do-edit-comment.php", {editedComment:comment.editedCommentMsg(), oldCommentTime:comment.date, pageID:""+window.location.search.replace("?page=", "")+""}, function(data){
                var response = JSON.parse(data);
                if(!response.error){
                    self.editMessageToUser(response.message);
                    comment.commentMsg(comment.editedCommentMsg());
                    comment.editingComment(false);
                }else {
                    self.editMessageToUser(response.message);
                }
            });
        }

        //********Post comment*********
        self.postComment = function(){
            $.post("leave-comment.php", {comment:self.commentMsgToPost(), pageID: ""+window.location.search.replace("?page=", "")+""}, function(data){
                self.postMessageToUser(JSON.parse(data));
                self.commentMsgToPost("");
            });
        }

        self.getNewComments();
    }

    ko.applyBindings(new CommentsViewModel());
});