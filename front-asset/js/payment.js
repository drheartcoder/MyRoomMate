/*<!-- Payment Method Validations jQuery -->*/
<script type="application/javascript">
//onclick toggle
$(document).ready(function() {
$('.container1-b').hide();
$(".container1-b:first").addClass("act1").show();
$('.regi_toggle .billing_cycle').click(function() {
$('.billing_cycle').removeClass('act'); //remove the class from the button
$(this).addClass('act'); //add the class to currently clicked button
var target = "#" + $(this).data("target");
$(".container1-b").not(target).hide();
$(target).show();
target.slideToggle();
});

$(".billing_cycle").click(function(event) {
event.stopPropagation();
/*alert("The span element was clicked.");*/
});
$('.paymt-sec').hide();
$(".paymt-sec:first").addClass("ac1").show();
$('.side-menu .common').click(function() {
//alert();

var curr_id = $(this).attr('id');
$('.common').removeClass('act2'); //remove the class from the button
$(this).addClass('act2'); //add the class to currently clicked button
var target = "#" + $(this).data("target");
console.log(target);
$(".paymt-sec").not(target).hide();
$(target).show();
//target.slideToggle();
if(curr_id=='monthly-free1')
{
$('#li_monthly-free1').addClass('active-pay');
$('#li_monthly-free1').addClass('last-border');
$('#li_monthly-free11').removeClass('active-pay');
$('#li_monthly-free11').removeClass('last-border');
}
if(curr_id=='monthly-free11')
{
$('#li_monthly-free11').addClass('active-pay');
$('#li_monthly-free11').addClass('last-border');
$('#li_monthly-free1').removeClass('active-pay');
$('#li_monthly-free1').removeClass('last-border');
}
});
/* --------------T.A--------------------------------*/
$('#visa').click(function(){
$('#card_type').val('Visa');
});
$('#mastercard').click(function(){
$('#card_type').val('Mastercard');
});
$('#amazon').click(function(){
$('#card_type').val('Amazon');
});
$('#discover').click(function(){
$('#card_type').val('Discover');
});
$('#btn_cc_pay').click(function(){


var card_type = $('#card_type').val();
var Acc_no = $('#cc_number').val();
var Expirydate = $('#cc_exp').val();
var cvv = $('#cc_cvc').val();
var flag=1;
if(card_type=="")
{
$('#error_msg_card_type').show();
$('#error_msg_card_type').html('Please select card type');
$('#card_type').focus();
$('#card_type-img').on('click',function()
{

$('#error_msg_card_type').hide();
});

flag=0;
}
if(Acc_no=="")
{
$('#error_msg_cc_number').show();
$('#error_msg_cc_number').html('Please enter card no');
$('#cc_number').focus();
$('#cc_number').on('keyup',function()
{
//$('#error_msg_cc_number').hide();
});

flag=0;
}
if(Expirydate=="")
{
$('#error_msg_cc_exp').show();
$('#error_msg_cc_exp').html('Please enter expiry date');
$('#cc_exp').focus();
$('#cc_exp').on('click',function()
{
$('#error_msg_cc_exp').hide();
});

flag=0;
}
if(Expirydate!="")
{
var txtVal = $('#cc_exp').val();
var filter = new RegExp("(0[123456789]|10|11|12)([/])([1-2][0-9][0-9][0-9])");

var lastFive = txtVal.substr(txtVal.length - 4);
var currentYear = new Date().getFullYear();

var firstTwo = txtVal.substring(0, 2);
var currentDay = new Date();

var d = new Date();
var currentDay = d.getMonth();


if(!filter.test(txtVal) || lastFive < currentYear || firstTwo < currentDay || lastFive == currentYear && firstTwo < currentDay)
{
$('#error_msg_cc_exp').show();
$('#error_msg_cc_exp').html('Invalid Date!!!');
$('#cc_exp').focus();
$('#cc_exp').on('click',function()
{

$('#error_msg_cc_exp').hide();
});

flag=0;
}
}
if(cvv=="")
{
$('#error_msg_cc_cvc').show();
$('#error_msg_cc_cvc').html('Please enter cvv');
$('#cc_cvc').focus();
$('#cc_cvc').on('keyup',function()
{
//$('#error_msg_cc_cvc').hide();
});

flag=0;
}
/* credit card expiry date validation (mm/yyyy) --------------T.A*/
$('#cc_exp').blur(function() {
var txtVal = $('#cc_exp').val();
var filter = new RegExp("(0[123456789]|10|11|12)([/])([1-2][0-9][0-9][0-9])");

var lastFive = txtVal.substr(txtVal.length - 4);
var currentYear = new Date().getFullYear();

var firstTwo = txtVal.substring(0, 2);
var currentDay = new Date();

var d = new Date();
var currentDay = d.getMonth();

flag=1;
if(!filter.test(txtVal) || lastFive < currentYear || firstTwo < currentDay || lastFive == currentYear && firstTwo < currentDay)
{
$('#error_msg_cc_exp').show();
$('#error_msg_cc_exp').html('Invalid Date!!!');
$('#cc_exp').focus();
$('#cc_exp').on('click',function()
{

$('#error_msg_cc_exp').hide();
});
flag=0;
}
});
/* end credit card expiry date ------------------------------T.A*/
if(flag==1){
return true;
}
else
{
return false;
}
});
/* character restriction */
$("#cc_number").bind("keydown", function (event) {
if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 17 || event.keyCode == 86 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 190 ||
// Allow: Ctrl+A
(event.keyCode == 65 && event.ctrlKey === true) ||
// Allow: home, end, left, right
(event.keyCode >= 35 && event.keyCode <= 39)) {
// let it happen, don't do anything
return;
} else {
// Ensure that it is a number and stop the keypress
if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
$('#error_msg_cc_number').show();
$('#error_msg_cc_number').html('Please enter only numbers');
event.preventDefault();
}
else
{
$('#error_msg_cc_number').hide();
}
}
});
$("#cc_cvc").bind("keydown", function (event) {
if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 190 ||
// Allow: Ctrl+A
(event.keyCode == 65 && event.ctrlKey === true) ||

// Allow: home, end, left, right
(event.keyCode >= 35 && event.keyCode <= 39)) {
// let it happen, don't do anything
return;
} else {
// Ensure that it is a number and stop the keypress
if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
$('#error_msg_cc_cvc').show();
$('#error_msg_cc_cvc').html('Please enter only numbers');
event.preventDefault();
}
else
{
$('#error_msg_cc_cvc').hide();
}
}
});
/* end character restriction --------------T.A*/
}); // end document ready
</script> 