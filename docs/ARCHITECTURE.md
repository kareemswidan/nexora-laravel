# Nexora architecture

Nexora is a bilingual server-rendered Laravel marketplace. Blade renders the catalogue and account-free checkout, controllers own the shopping workflow, session storage holds the active cart, and Eloquent persists products and orders in MySQL.

## Request flow

```text
Browser
  -> Laravel routes + CSRF + rate limits
  -> Store / Cart / Checkout / AI controllers
  -> Eloquent models and DB transaction
  -> MySQL
```

## Main domains

- **Catalogue:** active products, categories, bilingual descriptions, prices, ratings, and badges.
- **Cart:** quantity changes stored in the visitor's server-side session.
- **Checkout:** validated identity fields, transactional order and order-item creation, and cart clearing.
- **Tracking:** order number plus matching normalized email.
- **Local AI matcher:** deterministic, privacy-first recommendations without an external key.

## Data model

```text
Product 1---* OrderItem *---1 Order
Session 1---1 Cart (temporary)
```

Order creation and item creation run in one database transaction. A checkout either persists the complete order or none of it.

## Delivery

GitHub Actions compiles Laravel Mix assets and runs feature tests with in-memory SQLite. The Docker Compose setup starts MySQL, runs migrations and seed data, and serves the multi-page application.
