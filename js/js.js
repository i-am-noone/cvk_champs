$(document).ready(function(){
    $('.login a').click(function(){
    	$('.login').hide();
    	$('signUp').show();
       $('.signUp').css("display","block"); 
    });
    $('.loginToBook').click(function(){
    	$('.login form #nameLogin').focus();
    });
});