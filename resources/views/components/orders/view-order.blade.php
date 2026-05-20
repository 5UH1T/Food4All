<!-- ORDER DETAIL MODAL -->
<div class="modal fade" id="viewOrder" tabindex="-1" aria-labelledby="viewOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-3xl overflow-hidden border-0">

            <!-- HEADER -->
            <div class="modal-header bg-gray-900 text-white">
                <div>
                    <h5 class="modal-title font-bold" id="viewOrderLabel">
                        Order Details - #ord_111
                    </h5>
                    <small class="text-gray-300">Placed on: 21 May 2026, 12:45 PM</small>
                </div>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body bg-gray-50 p-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- CUSTOMER INFO -->
                    <div class="bg-white p-4 rounded-xl shadow-sm border">
                        <h6 class="font-semibold text-gray-700 mb-3">Customer Info</h6>

                        <p class="text-gray-600"><span class="font-semibold">Name:</span> Sujal Pokhrel</p>
                        <p class="text-gray-600"><span class="font-semibold">Phone:</span> +977 98XXXXXXX</p>
                        <p class="text-gray-600"><span class="font-semibold">Address:</span> Kathmandu, Nepal</p>
                    </div>

                    <!-- ORDER INFO -->
                    <div class="bg-white p-4 rounded-xl shadow-sm border">
                        <h6 class="font-semibold text-gray-700 mb-3">Order Info</h6>

                        <p class="text-gray-600">
                            <span class="font-semibold">From:</span> Kalaiya Sekuwa
                        </p>

                        <p class="text-gray-600">
                            <span class="font-semibold">Status:</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600 font-semibold">
                                Packed
                            </span>
                        </p>

                        <p class="text-gray-600">
                            <span class="font-semibold">Payment:</span> Cash on Delivery
                        </p>
                    </div>

                    <!-- SUMMARY -->
                    <div class="bg-white p-4 rounded-xl shadow-sm border">
                        <h6 class="font-semibold text-gray-700 mb-3">Summary</h6>

                        <p class="text-gray-600"><span class="font-semibold">Total Items:</span> 4</p>
                        <p class="text-gray-600"><span class="font-semibold">Total Units:</span> 6</p>
                        <p class="text-gray-600 text-lg mt-2">
                            <span class="font-semibold">Total:</span>
                            <span class="text-green-600 font-bold">NPR 1,250</span>
                        </p>
                    </div>

                </div>

                <!-- ITEMS TABLE -->
                <div class="mt-5 bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="p-3 border-b bg-gray-100 font-semibold text-gray-700">
                        Ordered Items
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-gray-600 text-sm">
                                <tr>
                                    <th class="p-3">Item</th>
                                    <th class="p-3">Price</th>
                                    <th class="p-3">Qty</th>
                                    <th class="p-3 text-right">Subtotal</th>
                                </tr>
                            </thead>

                            <tbody class="text-gray-700">
                                <tr class="border-t">
                                    <td class="p-3 font-medium">Chicken Sekuwa</td>
                                    <td class="p-3">NPR 350</td>
                                    <td class="p-3">2</td>
                                    <td class="p-3 text-right">NPR 700</td>
                                </tr>

                                <tr class="border-t">
                                    <td class="p-3 font-medium">Momo (Steam)</td>
                                    <td class="p-3">NPR 150</td>
                                    <td class="p-3">2</td>
                                    <td class="p-3 text-right">NPR 300</td>
                                </tr>

                                <tr class="border-t">
                                    <td class="p-3 font-medium">Fried Rice</td>
                                    <td class="p-3">NPR 250</td>
                                    <td class="p-3">1</td>
                                    <td class="p-3 text-right">NPR 250</td>
                                </tr>
                            </tbody>

                            <tfoot class="bg-gray-50 border-t">
                                <tr>
                                    <td colspan="3" class="p-3 font-semibold text-right">Grand Total</td>
                                    <td class="p-3 text-right font-bold text-green-600">NPR 1,250</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- NOTES -->
                <div class="mt-4 bg-white p-4 rounded-xl border shadow-sm">
                    <h6 class="font-semibold text-gray-700 mb-2">Notes</h6>
                    <p class="text-gray-600">
                        Please deliver without chili sauce. Call before arriving.
                    </p>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer bg-gray-100 flex justify-between">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>

                <div class="flex gap-2">
                    <button class="btn btn-warning">
                        Mark as Preparing
                    </button>
                    <button class="btn btn-success">
                        Mark as Delivered
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
