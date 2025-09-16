# DVWP - Damn Violating WordPress Plugin

![WordPress](https://img.shields.io/badge/WordPress-5.0+-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.4+-purple.svg)
![License](https://img.shields.io/badge/license-GPL--2.0-green.svg)
![Educational](https://img.shields.io/badge/purpose-educational-red.svg)

> 🚨 **EDUCATIONAL PURPOSES ONLY** - This plugin contains deliberate WordPress.org guideline violations
> and coding anti-patterns for training purposes.

## Overview

DVWP (Damn Violating WordPress Plugin) is an educational WordPress plugin designed to help developers learn WordPress.org plugin guidelines,
best practices, and quality standards.
It serves as a training tool for plugin developers,
WordPress Plugin Review Team members,
and educators to practice identifying common guideline violations and coding issues that impact plugin quality.

Similar to projects like DVWA (Damn Vulnerable Web Application),
DVWP provides a safe environment to learn about WordPress plugin development best practices without risking production systems.
This project helps developers understand what makes a high-quality WordPress plugin by showing examples of what to avoid.
By improving plugin quality across the ecosystem, we contribute to faster plugin reviews and better user experiences.

## 🎯 Purpose

- **Plugin Developer Training**: Learn WordPress.org guidelines and best practices
- **Code Quality Education**: Understand what makes plugins maintainable and secure
- **Plugin Review Training**: Help reviewers identify common issues efficiently
- **Workshop Materials**: Hands-on learning for WordCamps and developer meetups
- **Review Process Improvement**: Reduce plugin review waiting times through better submissions

## 🔧 Installation

### For Workshop Leaders

1. Clone this repository:

```bash
git clone https://github.com/plutzilla/dvwp.git
```

1. Copy to WordPress plugins directory:

```bash
cp -r dvwp /path/to/wordpress/wp-content/plugins/
```

1. **DO NOT ACTIVATE** on production sites

### For Workshop Participants

1. Receive the plugin files from your workshop leader
2. Review the code to identify violations
3. Use the `VIOLATIONS-GUIDE.md` for verification (leaders only)

## 📁 Plugin Structure

```
dvwp/
├── woocommerce-social-share.php    # Main plugin file
├── admin/assets/admin.js            # Minified admin scripts
├── public/assets/
│   ├── social.js                    # Minified frontend scripts
│   └── social.css                   # Minified styles
├── includes/
│   ├── ajax-handlers.php            # AJAX endpoints
│   └── share-counter.php            # API handling
├── readme.txt                       # WordPress.org style readme
├── VIOLATIONS-GUIDE.md              # Educational reference
└── README.md                        # This file
```

## 🚨 Plugin Quality Issues

The plugin contains intentional violations and anti-patterns in the following areas:

### WordPress.org Guidelines

- Trademark violations
- Trialware restrictions
- Missing source code documentation
- Improper naming conventions

### Security & Best Practices

- SQL Injection vulnerabilities
- Cross-Site Scripting (XSS) issues
- Cross-Site Request Forgery (CSRF) gaps
- File Upload security flaws
- Path Traversal vulnerabilities
- Missing input validation
- Insufficient access controls

### Code Quality & Standards

- Missing function/variable prefixes
- Hardcoded scripts/styles (should be enqueued)
- Translation violations
- Session abuse
- Missing ABSPATH checks
- Poor coding practices

## 🎓 Educational Usage

### For Instructors

1. **Preparation**: Review `VIOLATIONS-GUIDE.md` for complete issue list
2. **Setup**: Provide clean plugin files to participants
3. **Exercise**: Have participants identify guideline violations and quality issues
4. **Review**: Use the guide to verify findings and discuss proper solutions
5. **Learning**: Focus on how proper practices improve plugin review times

### For Plugin Developers

1. **Code Review**: Examine all plugin files systematically
2. **Documentation**: Note potential guideline violations and quality issues
3. **Categories**: Group findings by issue type (guidelines, security, quality)
4. **Impact Assessment**: Understand how issues affect users and review process
5. **Best Practices**: Learn proper WordPress plugin development patterns

## 📚 Learning Scenarios

### Beginner Level

- Identify missing ABSPATH checks
- Find unescaped output
- Spot missing function prefixes
- Detect hardcoded scripts/styles

### Intermediate Level

- Detect SQL injection vulnerabilities
- Find XSS opportunities
- Identify improper sanitization
- Review translation readiness

### Advanced Level

- Analyze file upload security
- Review API handling patterns
- Assess privilege escalation risks
- Evaluate overall code architecture

### Expert Level

- Complete plugin quality audit
- WordPress.org guideline compliance review
- Comprehensive improvement recommendations
- Performance and scalability assessment

## 🛡️ Safety Guidelines

⚠️ **CRITICAL SAFETY NOTES:**

- **Never use on production websites**
- **Only install in development environments**
- **Do not activate on live WordPress sites**
- **Always inform participants of educational nature**
- **Keep workshop environments isolated**

## 🔗 Related Resources

- [WordPress Plugin Security](https://developer.wordpress.org/plugins/security/)
- [WordPress.org Plugin Guidelines](https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/)
- [Data Sanitization Guide](https://developer.wordpress.org/apis/security/sanitizing/)
- [Data Escaping Guide](https://developer.wordpress.org/apis/security/escaping/)
- [Nonce Security](https://developer.wordpress.org/apis/security/nonces/)

## 🤝 Contributing

This project is designed for educational purposes. Contributions are welcome for:

- Additional vulnerability examples
- Improved documentation
- Workshop exercise ideas
- Educational content

### Guidelines for Contributors

1. **Maintain Educational Value**: New vulnerabilities should be realistic and educational
2. **Document Everything**: Include clear explanations in `VIOLATIONS-GUIDE.md`
3. **Safety First**: Ensure additions don't create actual security risks in isolated environments
4. **Test Thoroughly**: Verify all vulnerabilities work as intended for educational purposes

## 📄 License

This project is licensed under the GPL v2 or later - see the [LICENSE](LICENSE) file for details.

## ⚠️ Disclaimer

This plugin is designed exclusively for educational purposes to demonstrate
WordPress.org guideline violations and coding anti-patterns. The authors and
contributors:

- **Disclaim all liability** for any misuse of this software
- **Do not encourage** the use of these techniques in production environments
- **Recommend following** WordPress coding standards and best practices in real projects
- **Assume no responsibility** for damages caused by improper use

## 🏆 Acknowledgments

- WordPress Plugin Review Team for their dedication to plugin quality and security
- WordPress Core Contributors for establishing coding standards and best practices
- The broader WordPress community for promoting plugin quality initiatives
- Plugin developers who strive to create high-quality, guideline-compliant plugins

## 📞 Support

For workshop-related questions or educational use:

- Create an issue in this repository
- Contact the WordPress Plugin Review Team
- Join WordCamp security workshops

**Remember**: This tool is for learning.
Always practice responsible disclosure and follow ethical guidelines when working with security vulnerabilities.

---

**Happy Learning! 🎓🔒**
