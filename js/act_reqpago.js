//Script para fecha tentativa de pago
var pay_date = js_payment_date;
console.log(pay_date);
$('#wow').change(function(){
    if($('#wow').is(":checked"))
    {
        $('#aqui').append("<div name='paydate' id='paydate'><p><b>Fecha tentativa de pago:</b> </p><input type='date' name='fechapago' value='"+pay_date+"'><br><br><div>");
    }
    else
    {
        $('#paydate').remove();
    }
});
