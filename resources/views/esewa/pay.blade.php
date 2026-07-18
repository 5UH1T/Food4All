<form id="esewaForm" action="{{ env('ESEWA_PAYMENT_URL') }}" method="POST">

    <input type="hidden" id="amount" name="amount" value="{{ $order->total_cost }}">
    <input type="hidden" id="tax_amount" name="tax_amount" value="0">
    <input type="hidden" id="total_amount" name="total_amount" value="{{ $order->total_cost }}">
    <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="{{ $transaction_uuid }}">
    <input type="hidden" id="product_code" name="product_code" value="{{ env('ESEWA_PRODUCT_CODE') }}">
    <input type="hidden" id="product_service_charge" name="product_service_charge" value="0">
    <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0">
    <input type="hidden" id="success_url" name="success_url" value="{{ route('esewa.success') }}">
    <input type="hidden" id="failure_url" name="failure_url" value="{{ route('esewa.failure') }}">
    <input type="hidden" id="signed_field_names" name="signed_field_names"
        value="total_amount,transaction_uuid,product_code">
    <input type="hidden" id="signature" name="signature" value="{{ $signature }}">

</form>

<script>
    document.getElementById('esewaForm').submit();
</script>
