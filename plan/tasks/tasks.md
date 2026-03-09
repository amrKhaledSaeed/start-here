# SmartShop Mini Implementation Tasks

## 1. Project Setup
- [x] Confirm project baseline (Laravel 12, PHP 8.4, Livewire stack) and lock assumptions in planning notes
- [x] Configure `.env` for local database, cache, queue, session, mail, and app URL
- [x] Add AI provider configuration keys in `config/services.php` and reference only via config
- [x] Create route groups and naming strategy for `products.*`, `cart.*`, and `checkout.*`
- [x] Add base layout updates for store navigation, auth actions, and cart badge placeholder
- [x] Define repository-service-controller folder conventions under existing `app/` structure

## 2. Authentication
- [ ] Reuse existing auth flow (register, login, logout, reset password, verification) as SmartShop auth baseline
- [ ] Add route middleware rules for checkout pages (auth required) while keeping product browsing public
- [ ] Add guest redirect handling when trying to access checkout routes
- [ ] Add feature tests for auth-protected checkout access

## 3. Database & Models
- [ ] Create `products` migration with `slug`, `name`, `description`, `price`, `stock`, `image`, `category`, `is_active`
- [ ] Add indexes for `slug`, `category`, and active listing queries
- [ ] Create `Product` model with explicit casts and route model binding by slug
- [ ] Create concrete repository classes for product reads and cart-related product checks
- [ ] Create service classes for product listing/detail, cart orchestration, checkout simulation, and recommendations
- [ ] Create controllers for product pages, cart actions, and checkout flow using form requests for validation
- [ ] Define DTO-like payload structures for recommendation input/output data

## 4. Product Seeding
- [ ] Create `ProductFactory` with realistic categories, varied prices, and stock levels
- [ ] Create `ProductSeeder` to generate 20-30 active products
- [ ] Add deterministic placeholder image paths for seeded products
- [ ] Register `ProductSeeder` in `DatabaseSeeder`
- [ ] Verify `php artisan migrate:fresh --seed --no-interaction` produces a usable catalog

## 5. Home Page
- [ ] Build product listing page with pagination and responsive card layout
- [ ] Implement search and category filters with query string persistence
- [ ] Show price, stock status, and detail link for each product card
- [ ] Add empty-state UI for no matching products
- [ ] Implement sorting options (default relevance, price asc/desc, newest)
- [ ] Ensure listing query only returns active products

## 6. Product Detail Page
- [ ] Add product detail route using slug binding
- [ ] Build detail UI with image, name, category, price, stock, and description
- [ ] Implement quantity selector with stock-aware limits
- [ ] Add add-to-cart form request validation and feedback messages
- [ ] Render recommendation section with fallback content when AI is unavailable

## 7. Cart System
- [ ] Implement session-based `CartService` with add, update, remove, clear, and summary methods
- [ ] Define cart line schema (product id, name snapshot, unit price, qty, subtotal)
- [ ] Revalidate product existence, active state, and stock before cart mutations
- [ ] Build cart controller actions and Blade page for line-item updates
- [ ] Keep navbar cart count synced after all cart operations
- [ ] Handle stale cart items when products become inactive or out of stock
- [ ] Add feature/unit tests for happy path and edge cases

## 8. Checkout Simulation
- [ ] Add checkout routes and controller actions
- [ ] Create checkout form request for customer/shipping/payment-simulation fields
- [ ] Validate cart integrity before processing checkout
- [ ] Implement simulation result payload (confirmation code, timestamp, totals, line snapshot)
- [ ] Clear cart on successful checkout simulation
- [ ] Build confirmation page and failure handling for empty/invalid carts
- [ ] Add tests for checkout success and failure paths

## 9. AI Recommendation System
- [ ] Define `RecommendationService` contract and provider-agnostic implementation
- [ ] Build provider adapters for OpenAI, Gemini, and Claude selected by config
- [ ] Implement prompt builder with product context, constraints, and strict output instructions
- [ ] Add robust response parser/normalizer and safe fallback strategy
- [ ] Add timeout/retry handling and provider error logging without sensitive data
- [ ] Add short-term caching for recommendations by product/context key
- [ ] Add tests with mocked provider clients for success, malformed output, and fallback scenarios
- [ ] Document recommendation architecture and prompt strategy in `plan/architecture.md`

## 10. Frontend (Tailwind + Alpine)
- [ ] Build reusable Blade components (product card, cart row, status badge, alert, recommendation list)
- [ ] Add Alpine interactions for quantity controls and temporary notification banners
- [ ] Ensure responsive UI behavior across listing, detail, cart, and checkout pages
- [ ] Add loading and disabled states for async/submission actions
- [ ] Keep styling consistent with existing app patterns and dark mode support where present

## 11. Error Handling & Fallback Logic
- [ ] Add centralized domain exceptions for cart and checkout validation issues
- [ ] Convert domain exceptions to user-friendly flash/callout messages
- [ ] Add not-found and inactive-product handling for product detail route
- [ ] Add deterministic recommendation fallback when AI provider fails or returns invalid payload
- [ ] Log operational context (provider, latency, fallback used) while excluding secrets

## 12. Code Quality Tools
- [ ] Ensure Pint formatting command and standards are applied to changed files
- [ ] Configure and run PHPStan at max level with Laravel extension
- [ ] Configure and run Blade Formatter checks for Blade templates
- [ ] Add or align composer scripts for `format`, `analyse`, and `lint` workflows
- [ ] Verify local quality command sequence is CI-friendly

## 13. Testing
- [ ] Add feature tests for product listing, filtering, sorting, and product detail rendering
- [ ] Add cart tests for add/update/remove/clear and stock validation failures
- [ ] Add checkout tests for unauthorized access, empty cart rejection, and success flow
- [ ] Add recommendation tests with provider mocks and fallback assertions
- [ ] Add integration tests for repository-service-controller interaction on key flows
- [ ] Run minimal targeted test files during development and full suite before final delivery

## 14. README & Documentation
- [ ] Update README with setup, migration/seed, asset build, and run instructions
- [ ] Document env variables for AI providers and provider selection behavior
- [ ] Document recommendation flow, fallback behavior, and known limitations
- [ ] Document repository-service-controller architecture overview
- [ ] Document quality commands and expected outputs
- [ ] Add troubleshooting notes for common setup and AI integration issues

## 15. Bonus Features
- [ ] Persist cart for authenticated users with DB-backed merge behavior on login
- [ ] Add wishlist/favorites feature
- [ ] Add recommendation rationale text ("Why this is suggested")
- [ ] Add lightweight admin seed refresh command for fast demo resets
- [ ] Add basic analytics events for view, add-to-cart, and checkout simulation
