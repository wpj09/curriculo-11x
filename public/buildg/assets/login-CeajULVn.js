$(function(){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$('form[name="login"]').submit(function(a){a.preventDefault();const e=$(this),n=e.attr("action"),o=e.find('input[name="email"]').val(),c=e.find('input[name="password_check"]').val();$.post(n,{email:o,password:c},function(t){console.log(t),t.message&&s(t.message,3),t.redirect&&(window.location.href=t.redirect)},"json")});var i=3;function s(a,e){var n=$(a);n.append("<div class='message_time'></div>"),n.find(".message_time").animate({width:"100%"},e*1e3,function(){$(this).parents(".message").fadeOut(200)}),$(".ajax_response").append(n)}$(".ajax_response .message").each(function(a,e){s(e,i+=1)}),$(".ajax_response").on("click",".message",function(a){$(this).effect("bounce").fadeOut(1)})});
