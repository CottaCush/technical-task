## Technical Task
Create an application that allows users to enter shipment information and retrieve shipping rates
from Printful's API. In order to speed up the process, create a caching mechanism and use it to
store API results for faster retrieval when the same shipment information is provided.

### Environment Variable
```bash
cp .env.sample .env
```

### Installing Dependencies
```bash
composer install
```

### Serve Application
```bash
php -S localhost:8080
```

### Run Test
```bash
php vendor/bin/phpunit test/ShipmentInfoTest.php
```

### Sample Body Request
```json
{
    "recipient": {
        "address1": "19749 Dearborn St",
        "city": "Chatsworth",
        "country_code": "US",
        "state_code": "CA",
        "zip": 91311
    },
    "items": [
        {
            "quantity": 1,
            "variant_id": 2
        },
        {
            "quantity": 5,
            "variant_id": 202
        }
    ]
}
```

```json
{
    "recipient": {
        "address1": "11025 Westlake Dr",
        "city": "Charlotte",
        "country_code": "US",
        "state_code": "NC",
        "zip": 28273
    },
    "items": [
        {
            "quantity": 1,
            "variant_id": 7679
        },
        {
            "quantity": 1,
            "variant_id": 202
        }
    ]
}
```

### Sample Response
```json
{
    "code": 200,
    "result": [
        {
            "id": "STANDARD",
            "name": "Flat Rate (Estimated delivery: Oct  1- 6) ",
            "rate": "14.98",
            "currency": "USD",
            "minDeliveryDays": 4,
            "maxDeliveryDays": 7
        }
    ],
    "extra": []
}
```