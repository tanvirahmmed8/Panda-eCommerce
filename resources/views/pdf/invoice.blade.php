<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									{{ env('APP_NAME') }}
								</td>

								<td>
									Invoice #: {{ $invoice->id }}<br />
									Created: {{ $invoice->created_at }}<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									{{ $invoice->customer_address }}
									{{ $city->name }}<br />
									{{ $country->name }}<br />
								</td>

								<td>
									{{ $invoice->customer_name }}<br />
									{{ $invoice->customer_email }}<br />
									{{ $invoice->customer_phone }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>

					<td>Status</td>
				</tr>

				<tr class="details">
					<td>{{ $invoice->payment_method }}  </td>

					<td>{{ $invoice->payment_status }}</td>
				</tr>

				<tr class="heading">
					<td>Item</td>
					<td>Price</td>
				</tr>
				@foreach ($invoice_details as $item)
                    <tr class="item">
                        <td>{{ $item->product->name }}</td>
                        <td>{{ ceil($item->unit_price *  $item->quantity) }}</td>
                    </tr>
                @endforeach

                <tr class="heading">
					<td>Sub Total</td>

					<td>{{ $invoice->subtotal }}</td>
				</tr>
                <tr class="item">
                    <td>Discount</td>
                    <td>{{ ($invoice->subtotal + $invoice->delivery_charge) - $invoice->total_price  }}</td>
                </tr>
                <tr class="item">
                    <td>Shipping Cherge</td>
                    <td>{{ $invoice->delivery_charge }}</td>
                </tr>
                <tr class="heading">
					<td>Total</td>

					<td>{{ $invoice->total_price }}</td>
				</tr>
			</table>
            <br>
            {{ env('APP_URL') }}
		</div>
	</body>
</html>
