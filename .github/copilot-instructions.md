# DVWP Copilot Instructions

## Project Overview

DVWP (Damn Violating WordPress Plugin) is an **educational WordPress plugin** designed to teach WordPress.org guidelines, security best practices, and code quality standards. This plugin contains **deliberate violations and vulnerabilities** for training purposes.

**⚠️ CRITICAL: This is NOT a production plugin - it's an educational tool for workshops and training.**

## Architecture & File Organization

### Main Plugin Structure
- `woocommerce-social-share.php` - Main plugin file with inline styles/scripts (anti-pattern)
- `admin/` - Admin-specific functionality and assets
- `includes/` - Core functionality (AJAX handlers, share counters)  
- `public/` - Public-facing assets (minified CSS/JS)

### Key Patterns

**WordPress Plugin Initialization:**
```php
add_action('plugins_loaded', 'social_share_init');
register_activation_hook(__FILE__, 'social_share_activate');
```

**WooCommerce Integration:**
```php
add_action('woocommerce_single_product_summary', 'display_social_buttons', 25);
```

**AJAX Handler Pattern:**
```php
add_action('wp_ajax_action_name', 'handler_function');
add_action('wp_ajax_nopriv_action_name', 'handler_function');
```

## Educational Purpose - Deliberate Violations

This codebase contains intentional WordPress.org guideline violations documented in `VIOLATIONS-GUIDE.md`:

1. **Trademark Issues** - Plugin name implies false WooCommerce affiliation
2. **Trialware** - Features locked behind license keys (lines 230-250 in main file)
3. **Security Vulnerabilities** - SQL injection, XSS, insecure file uploads in `includes/`
4. **Code Quality Issues** - Inline styles/scripts, direct SQL queries, no nonces

## Working with This Codebase

### When Adding New Violations
- Document in `VIOLATIONS-GUIDE.md` with clear explanations
- Add educational comments explaining the issue
- Include proper fix examples in documentation
- Test vulnerabilities safely in development environments

### Code Style for Educational Clarity
- Use clear, readable code even when demonstrating bad practices
- Add comments explaining why something is wrong
- Keep examples realistic but contained
- Follow WordPress coding standards where it doesn't interfere with educational goals

### Asset Management
- CSS/JS files are minified (see `public/assets/`) - uncommon for educational code
- Main plugin file contains inline styles/scripts (anti-pattern for demonstration)
- Admin assets use variable naming obfuscation (demonstrates poor practices)

### Database Patterns
- Direct `$wpdb` usage without sanitization (intentional vulnerability)
- Custom table creation in activation hook (`wp_social_shares`)
- No database cleanup on deactivation (poor practice)

## Essential Knowledge for Contributors

### WordPress Plugin Guidelines to Demonstrate
- Proper sanitization and validation
- Security nonce usage
- Trademark compliance
- Freemium vs trialware distinctions
- Asset organization best practices

### Development Workflow
1. Never activate on production sites
2. Use local WordPress development environment
3. Test vulnerabilities safely and document impact
4. Update `VIOLATIONS-GUIDE.md` for any new issues added
5. Include both the violation and proper fix in documentation

### Key Files for Understanding Context
- `VIOLATIONS-GUIDE.md` - Complete violation documentation
- `README.md` - Educational purpose and setup instructions  
- `CONTRIBUTING.md` - Guidelines for adding educational content

## Testing & Validation

This plugin requires WooCommerce to fully demonstrate product page integration. Use WordPress development environments with WooCommerce installed for complete testing of social sharing functionality and admin features.