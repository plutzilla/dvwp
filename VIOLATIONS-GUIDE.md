# DVWP - Damn Vulnerable WordPress Plugin

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
**Location:** Lines 2-3

```php
* Plugin Name: WooCommerce Social Share
* Plugin URI: https://example.com/woocommerce-social-share
```

**Fix:** Change name to something like "Social Share for WooCommerce" or use unique branding

#### 2. Trialware (Locked Features)

**Files:** `woocommerce-social-share.php`
**Violation:** Features locked behind license key
**Locations:**

- Lines 99-127 (trialware logic)
- Lines 258-270 (license validation)
- Lines 186-210 (pro platform restrictions)

**Fix:** Remove all license checks and make all features available

#### 3. Missing Source Code Documentation

**File:** `readme.txt`
**Violation:** No links to source code for minified files
**Location:** Entire file lacks source code documentation
**Files affected:** `admin/assets/admin.js`, `public/assets/social.js`

**Fix:** Add source code links in readme.txt or include unminified versions

### 🔴 Security Vulnerabilities

#### 4. Missing ABSPATH Checks

**Files:** ALL PHP files
**Violation:** Direct file access allowed
**Example Location:** `woocommerce-social-share.php` Line 14

```php
// VIOLATION: Missing ABSPATH check
// SHOULD BE: if ( ! defined( 'ABSPATH' ) ) exit;
```

**Fix:** Add `if ( ! defined( 'ABSPATH' ) ) exit;` to all PHP files

#### 5. Data Not Sanitized

**Files:** Multiple
**Examples:**

- `woocommerce-social-share.php` Lines 153-157 (POST data)
- `includes/ajax-handlers.php` Lines 6-8 (AJAX data)
// NOTE: share-counter.php not present in provided context for GET param example

**Fix:** Use `sanitize_text_field()`, `sanitize_email()`, etc.

#### 6. Output Not Escaped

**Files:** Multiple  
**Examples:**

- `woocommerce-social-share.php` Lines 126-127 (admin form)
- `includes/ajax-handlers.php` Lines 27-31 (echo output)

**Fix:** Use `esc_html()`, `esc_attr()`, `wp_kses_post()`, etc.

#### 7. Missing Nonces

**Files:** Multiple
**Examples:**

- `woocommerce-social-share.php` Line 142 (admin form)
- `includes/ajax-handlers.php` Lines 1-2 (AJAX handlers)

**Fix:** Add `wp_nonce_field()` and `wp_verify_nonce()`

#### 8. No Permission Checks

**Files:** Multiple
**Examples:**

- `woocommerce-social-share.php` Line 151 (settings save)
- `includes/ajax-handlers.php` Line 31 (AJAX endpoints)

**Fix:** Add `current_user_can()` checks

#### 9. SQL Injection

**Files:** `includes/ajax-handlers.php`, `includes/share-counter.php`
**Examples:**

- Line 13: Direct SQL with user input
- Line 38: Unescaped variables in query

**Fix:** Use `$wpdb->prepare()` for all queries

#### 10. XSS (Cross-Site Scripting)

**Files:** Multiple
**Examples:**

- `woocommerce-social-share.php` Lines 210-211 (custom CSS output)
- `includes/ajax-handlers.php` Lines 27-31 (unescaped output)

**Fix:** Escape all output and validate input

#### 11. File Upload Vulnerabilities

**File:** `includes/ajax-handlers.php`
**Location:** Lines 36-56
**Violations:**

- No file type validation
- No file size limits
- Path traversal possible
- No antivirus scanning

**Fix:** Validate file types, use WordPress upload functions

#### 12. Path Traversal

**Files:** `includes/ajax-handlers.php`
**Example:** Lines 66-67

```php
$filename = '../exports/' . $format . '_export_' . $date_from . '_to_' . $date_to . '.csv';
```

**Fix:** Validate and sanitize file paths

### 🔴 Code Quality Violations

#### 13. No Prefixes

**Files:** ALL files
**Violations:**

- Function names: `social_share_init()`, `load_social_scripts()`
- Global variables: `$social_share_options`
- Constants: `PLUGIN_VERSION`
- AJAX actions: `get_share_count`
- Class names: `ShareCounter`

**Fix:** Add unique prefix to all names (e.g., `dvwp_social_share_init()`)

#### 14. Hardcoded Scripts/Styles

**File:** `woocommerce-social-share.php`
**Locations:** Lines 36-65, 66-98
**Violation:** Using `<script>` and `<style>` tags instead of wp_enqueue

**Fix:** Use `wp_enqueue_script()` and `wp_enqueue_style()`

#### 15. Variables in Translation Functions

**File:** `woocommerce-social-share.php`
**Examples:**

- Lines 18-20: Variable in text domain
- Line 77: Variable in gettext function
- Line 132: Variable in __() function

**Fix:** Use literal strings only

#### 16. Session Abuse

**File:** `woocommerce-social-share.php`
**Location:** Line 14

```php
session_start();
```

**Violation:** Starting sessions on every page load breaks caching

**Fix:** Remove or use only when absolutely necessary

### 🔴 WordPress Best Practices Violations

#### 17. Improper Hook Usage

**Files:** Multiple
**Examples:**

- Missing prefixes on action names
- Incorrect hook priorities
- Functions called too early

#### 18. Database Issues

**Files:** `includes/ajax-handlers.php`
**Violations:**

- Direct SQL instead of WordPress methods
- No proper table creation with dbDelta
- No database error handling

#### 19. Internationalization Issues

**Files:** Multiple
**Violations:**

- Variables in gettext functions
- Missing text domains
- Hardcoded strings

## Workshop Exercise Ideas

1. **Beginner Level:** Fix ABSPATH checks and basic escaping
2. **Intermediate Level:** Add nonces and sanitization
3. **Advanced Level:** Fix SQL injection and XSS vulnerabilities
4. **Expert Level:** Refactor entire architecture with proper prefixes

## Learning Resources

- [WordPress Plugin Security](https://developer.wordpress.org/plugins/security/)
- [WordPress.org Plugin Guidelines](https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/)
- [Data Sanitization](https://developer.wordpress.org/apis/security/sanitizing/)
- [Data Escaping](https://developer.wordpress.org/apis/security/escaping/)

## Disclaimer

This plugin is designed to demonstrate security vulnerabilities and should never be used on production websites.
The vulnerabilities are intentional and documented for educational purposes only.
