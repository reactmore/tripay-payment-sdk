# Tripay Payment Gateway SDK for CodeIgniter 4

Library ini menyediakan integrasi **Tripay Payment Gateway** dengan framework **CodeIgniter 4**.  
Membantu developer mengelola transaksi, channel pembayaran, dan kalkulasi biaya dengan mudah melalui Service Facade.

---

## 📦 Installation

1. **Install via Composer**
```bash
composer require reactmore/tripay-payment-sdk
```

## ⚙️ Configuration

Tambahkan konfigurasi API Key pada .env
```bash
Tripay.stage = 'sandbox'
Tripay.apiKey = '';
Tripay.privateKey = '';
Tripay.merchantCode = '';
```

## 🚀 Usage
```php
$tripay = service('tripay');

// merchant 
$response = $tripay->merchant()->getChannel($payload)->get();

$response = $tripay->payment()->getInstruction()->get();

// open for open transactions https://tripay.co.id/developer?tab=open-payment-create
$response = $tripay->transaction('open/closed')->create($payload)->get();
```

## Method

🔹 Merchant
| Method                                                         | Parameter                                                   | Deskripsi                                                                                |
| -------------------------------------------------------------- | ----------------------------------------------------------- | ---------------------------------------------------------------------------------------- |
| `$tripay->merchant()->getChannel()`                            | –                                                           | Mendapatkan daftar channel pembayaran yang tersedia.                                     |
| `$tripay->merchant()->getFeeCalculator(array $payload)`        | `amount` *(numeric, required)*, `code` *(string, optional)* | Menghitung biaya transaksi berdasarkan jumlah (`amount`) dan metode pembayaran (`code`). |
| `$tripay->merchant()->getTransactionList(array $payload = [])` | `per_page`, `page`, `sort`, dsb. *(optional)*               | Mendapatkan daftar transaksi milik merchant.                                             |

🔹 Payment
| Method                                               | Parameter                   | Deskripsi                                                |
| ---------------------------------------------------- | --------------------------- | -------------------------------------------------------- |
| `$tripay->payment()->getInstruction(array $payload)` | `code` *(string, required)* | Mendapatkan instruksi pembayaran untuk channel tertentu. |


🔹 Transaction

| Method                                                      | Parameter                                                 | Deskripsi                                              |
| ----------------------------------------------------------- | --------------------------------------------------------- | ------------------------------------------------------ |
| `$tripay->transaction('closed/open')->create(array $data)`       | `method`, `merchant_ref`, `amount`, `customer_name`, dll. | Membuat transaksi baru dengan mode **Closed atau open Payment**. |
| `$tripay->transaction('closed/open')->detail(string $reference)` | `reference` *(string, required)*                          | Mendapatkan detail transaksi berdasarkan Reference ID. |
| `$tripay->transaction('closed/open')->status(array $payload)`    | `reference` *(string, required)*                          | Mengecek status transaksi tertentu.                    |



