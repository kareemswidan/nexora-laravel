# Checkout and order security

Nexora intentionally supports guest checkout, so it does not create a permanent user account. Access is protected around the order rather than by inventing unnecessary credentials.

- Laravel CSRF middleware protects all cart, checkout, AI, and tracking POST requests.
- Validation restricts names, emails, and order lookup inputs.
- Checkout and tracking endpoints are rate limited.
- The order-success page requires a temporary signed URL that expires after 20 minutes; knowing an internal order ID is not sufficient.
- Long-term tracking requires both the unpredictable public order number and the normalized checkout email.
- Blade escapes user-provided output by default.
- Order and order-item insertion is atomic inside a database transaction.

`tests/Feature/OrderAccessTest.php` proves that unsigned success URLs are forbidden and that a mismatched tracking email cannot reveal an order.
