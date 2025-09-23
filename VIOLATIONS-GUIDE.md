# DVWP - Damn Violating WordPress Plugin

## 🚨 EDUCATIONAL PURPOSES ONLY 🚨

This plugin contains **DELIBERATE SECURITY VULNERABILITIES** and **WordPress.org guideline violations** for educational purposes.

**DO NOT USE IN PRODUCTION ENVIRONMENTS**

## Purpose

This plugin serves as a training tool for:

- WordCamp workshops
- Plugin Review Team training
- Security education
- WordPress development best practices training

## How to Use This Plugin

1. **Workshop Leaders**: Use this plugin to demonstrate common violations
2. **Students**: Try to identify and fix the violations
3. **Review Team**: Practice spotting guideline violations

## Complete Violation Index

### 🔴 WordPress.org Guideline Violations

#### 1. Trademark Violations

**File:** `woocommerce-social-share.php` (Plugin Header)
**Violation:** Plugin name "WooCommerce Social Share" implies false affiliation with WooCommerce
**Location:** Line 3

```php
* Plugin Name: WooCommerce Social Share
```

**Fix:** Change name to something like "Social Share for WooCommerce" or use unique branding

#### 2. Invalid Plugin URI

**File:** `woocommerce-social-share.php` (Plugin Header)
**Violation:** Plugin URI points to example.com domain
**Location:** Line 4

```php
* Plugin URI: https://example.com/woocommerce-social-share
```

**Fix:** Use valid domain or remove Plugin URI if no official site exists

#### 3. Outdated Tested Version

**File:** `readme.txt`
**Violation:** Tested up to version is outdated
**Location:** Line 5

```
Tested up to: 6.4
```

**Fix:** Update to current WordPress version (6.6+ as of 2025)

#### 4. Nonexistent Domain Path

**File:** `woocommerce-social-share.php` (Plugin Header)
**Violation:** Domain Path points to non-existent directory
**Location:** Line 10

```php
* Domain Path: /languages
```

**Fix:** Create /languages directory or remove Domain Path header

#### 5. Trialware (Locked Features)

**Files:** `woocommerce-social-share.php`
**Violation:** Features locked behind license key
**Locations:**

- Lines 150-162 (Pro features section)
- Lines 248-253 (license validation function)
- Lines 208-218 (pro platform restrictions)

**Fix:** Remove all license checks and make all features available

#### 6. Missing Source Code Documentation

**File:** `readme.txt`
**Violation:** No links to source code for minified files
**Location:** Entire file lacks source code documentation
**Files affected:** `admin/assets/admin.js`, `public/assets/social.js`

**Fix:** Add source code links in readme.txt or include unminified versions

### 🔴 Security Vulnerabilities

#### 7. Missing ABSPATH Checks

**Files:** ALL PHP files
**Violation:** Direct file access allowed
**Example Location:** `woocommerce-social-share.php` Line 1

```php
// VIOLATION: Missing ABSPATH check
// SHOULD BE: if ( ! defined( 'ABSPATH' ) ) exit;
```

**Fix:** Add `if ( ! defined( 'ABSPATH' ) ) exit;` to all PHP files

#### 8. Missing Unslash

**Files:** Multiple
**Violation:** User input not unslashed before processing
**Examples:**

- `woocommerce-social-share.php` Lines 169-170 (POST data processing)
- `includes/ajax-handlers.php` Lines 7-9 (AJAX data handling)

**Fix:** Use `wp_unslash()` before sanitizing user input

#### 9. Data Not Sanitized

**Files:** Multiple
**Examples:**

- `woocommerce-social-share.php` Lines 169-170 (POST data)
- `includes/ajax-handlers.php` Lines 7-9 (AJAX data)

**Fix:** Use `sanitize_text_field()`, `sanitize_email()`, etc.

#### 10. Output Not Escaped

**Files:** Multiple  
**Examples:**

- `woocommerce-social-share.php` Line 135 (license key in admin form)
- `woocommerce-social-share.php` Line 142 (custom CSS textarea)
- `includes/ajax-handlers.php` Lines 30-32 (echo output)

**Fix:** Use `esc_html()`, `esc_attr()`, `wp_kses_post()`, etc.

#### 11. Missing Nonces

**Files:** Multiple
**Examples:**

- `woocommerce-social-share.php` Line 118 (admin form)
- `includes/ajax-handlers.php` (all AJAX handlers)

**Fix:** Add `wp_nonce_field()` and `wp_verify_nonce()`

#### 12. No Permission Checks

**Files:** Multiple
**Examples:**

- `woocommerce-social-share.php` Line 169 (settings save)
- `includes/ajax-handlers.php` (all AJAX endpoints)

**Fix:** Add `current_user_can()` checks

#### 13. SQL Injection

**Files:** `includes/ajax-handlers.php`, `includes/share-counter.php`
**Examples:**

- `ajax-handlers.php` Line 12: Direct SQL with user input
- `ajax-handlers.php` Line 27: Unescaped variables in query

**Fix:** Use `$wpdb->prepare()` for all queries

#### 14. XSS (Cross-Site Scripting)

**Files:** Multiple
**Examples:**

- `woocommerce-social-share.php` Lines 200-205 (product URL/title output)
- `includes/ajax-handlers.php` Lines 30-32 (unescaped database output)

**Fix:** Escape all output and validate input

#### 15. File Upload Vulnerabilities

**File:** `includes/ajax-handlers.php`
**Location:** Lines 35-55
**Violations:**

- No file type validation
- No file size limits
- Path traversal possible
- No antivirus scanning

**Fix:** Validate file types, use WordPress upload functions

#### 16. Path Traversal

**Files:** `includes/ajax-handlers.php`
**Example:** Line 66

```php
$filename = '../exports/' . $format . '_export_' . $date_from . '_to_' . $date_to . '.csv';
```

**Fix:** Validate and sanitize file paths

### 🔴 Code Quality Violations

#### 17. No Prefixes

**Files:** ALL files
**Violations:**

- Function names: `social_share_init()`, `load_social_scripts()`
- Global variables: `$social_share_options`
- Constants: `PLUGIN_VERSION`
- AJAX actions: `get_share_count`
- Class names: `ShareCounter`

**Fix:** Add unique prefix to all names (e.g., `dvwp_social_share_init()`)

#### 18. Unsafe Printing Functions

**Files:** Multiple
**Violation:** Using potentially unsafe printing functions
**Examples:**

- `woocommerce-social-share.php` Line 109 (admin form with __() function)
- Various locations using `_e()` without proper escaping context

**Fix:** Use `esc_html_e()`, `esc_attr_e()` instead of raw `_e()` functions

#### 19. Hardcoded Scripts/Styles

**File:** `woocommerce-social-share.php`
**Locations:** Lines 39-58 (CSS), Lines 60-83 (JavaScript)
**Violation:** Using `<script>` and `<style>` tags instead of wp_enqueue

**Fix:** Use `wp_enqueue_script()` and `wp_enqueue_style()`

#### 20. Variables in Translation Functions

**File:** `woocommerce-social-share.php`
**Examples:**

- Line 109: Variable in __() function: `__($page_title = 'Social Share Settings'...)`
- Multiple instances of translations with variables

**Fix:** Use literal strings only

#### 21. Session Abuse

**File:** `woocommerce-social-share.php`
**Location:** Line 17

```php
session_start();
```

**Violation:** Starting sessions on every page load breaks caching

**Fix:** Remove or use only when absolutely necessary

#### 22. External API Dependencies

**File:** `includes/share-counter.php`
**Location:** Lines 12-15
**Violation:** Hardcoded external API endpoints without fallback

```php
$this->api_endpoints = array(
    'facebook' => 'https://graph.facebook.com/?id=%s&fields=engagement',
    'twitter' => 'https://counts.twitcount.com/counts.php?url=%s',
    'linkedin' => 'https://www.linkedin.com/countserv/count/share?url=%s'
);
```

**Fix:** Add error handling, fallbacks, and configuration options for API endpoints

#### 23. Missing Dependency Validation

**Files:** Multiple
**Violation:** No check for WooCommerce activation before using WC functions
**Examples:**

- `woocommerce-social-share.php` Line 32 (using WooCommerce hooks without validation)
- Missing `is_plugin_active()` checks

**Fix:** Add dependency validation in plugin activation and before using WooCommerce functions

### 🔴 WordPress Best Practices Violations

#### 24. Improper Hook Usage

**Files:** Multiple
**Examples:**

- Missing prefixes on action names
- Incorrect hook priorities
- Functions called too early

#### 25. Database Issues

**Files:** `includes/ajax-handlers.php`
**Violations:**

- Direct SQL instead of WordPress methods
- No proper table creation with dbDelta
- No database error handling

#### 26. No Database Caching

**Files:** `includes/share-counter.php`, `includes/ajax-handlers.php`
**Violation:** Direct database queries bypass WordPress caching
**Examples:**

- Multiple `$wpdb->get_results()` calls without caching consideration
- No use of transients for expensive queries

**Fix:** Use WordPress caching mechanisms, transients, or object cache

#### 27. No Uninstall Cleanup

**File:** Missing `uninstall.php`
**Violation:** No cleanup when plugin is deleted
**Issues:**

- Database tables persist after deletion
- Options remain in wp_options table
- Transients and cache entries not cleared

**Fix:** Create `uninstall.php` file to clean up all plugin data

#### 28. DateTime Function Violations

**Files:** Multiple (detected by automated tools)
**Violation:** Using PHP date functions instead of WordPress alternatives
**Examples:**

- Using `date()` instead of `wp_date()`
- Not considering timezone settings

**Fix:** Use WordPress datetime functions that respect site timezone

#### 29. File System Operations

**File:** `includes/ajax-handlers.php`
**Location:** Line 71
**Violation:** Using direct PHP file functions

```php
readfile($filename);
```

**Fix:** Use WordPress filesystem API (`WP_Filesystem`)

#### 30. Internationalization Issues

**Files:** Multiple
**Violations:**

- Variables in gettext functions
- Missing text domains
- Hardcoded strings

#### 31. Input Validation Missing

**Files:** Multiple
**Violation:** Raw $_POST, $_GET, $_REQUEST usage without proper validation
**Examples:**

- `woocommerce-social-share.php` Lines 170-171, 238-239 (direct $_POST access)
- `includes/ajax-handlers.php` Lines 7-9, 24, 62-64 (unvalidated superglobals)
- `includes/share-counter.php` Lines 135-136 (direct $_GET access)

**Fix:** Always validate input types and ranges before processing

#### 32. Deprecated Functions

**File:** `woocommerce-social-share.php`
**Location:** Line 242
**Violation:** Using deprecated `rand()` instead of WordPress alternative

```php
$count = rand(1, 1000);
```

**Fix:** Use `wp_rand()` which is cryptographically secure

## Workshop Exercise Ideas

1. **Beginner Level:** Fix ABSPATH checks, basic escaping, and plugin header issues
2. **Intermediate Level:** Add nonces, sanitization, and proper unslash handling
3. **Advanced Level:** Fix SQL injection, XSS vulnerabilities, and file system operations
4. **Expert Level:** Refactor entire architecture with proper prefixes, dependency validation, and WordPress standards compliance
5. **Plugin Review Focus:** Practice identifying trademark violations, trialware patterns, and missing documentation

## Learning Resources

- [WordPress Plugin Security](https://developer.wordpress.org/plugins/security/)
- [WordPress.org Plugin Guidelines](https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/)
- [Data Sanitization](https://developer.wordpress.org/apis/security/sanitizing/)
- [Data Escaping](https://developer.wordpress.org/apis/security/escaping/)

## Disclaimer

This plugin is designed to demonstrate security vulnerabilities and should never be used on production websites.
The vulnerabilities are intentional and documented for educational purposes only.
