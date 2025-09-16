# Contributing to DVWP

Thank you for your interest in contributing to DVWP (Damn Violating WordPress Plugin)!
This project serves as an educational tool for WordPress plugin developers to learn guidelines,
best practices, and quality standards, and we welcome contributions that enhance its educational value.

## 🎯 Project Purpose

DVWP is designed exclusively for educational purposes to help:

- Plugin developers learn WordPress.org guidelines and best practices
- WordPress Plugin Review Team members practice identifying violations efficiently
- Educators conduct effective plugin quality training sessions
- Improve overall plugin ecosystem quality and reduce review waiting times
- Developers understand what makes plugins maintainable, secure, and user-friendly

## 🤝 How to Contribute

### Types of Contributions Welcome

1. **New Vulnerability Examples**
   - Realistic WordPress plugin vulnerabilities
   - Common security anti-patterns
   - WordPress.org guideline violations

2. **Educational Content**
   - Workshop exercise ideas
   - Training scenarios
   - Documentation improvements

3. **Code Quality**
   - Bug fixes in educational examples
   - Code clarity improvements
   - Better vulnerability demonstrations

4. **Documentation**
   - Clearer explanations
   - Additional learning resources
   - Workshop guides

### What We Don't Accept

- Contributions that could cause real security harm
- Non-educational vulnerability additions
- Production-ready security fixes (this defeats the educational purpose)
- Malicious or harmful code

## 📋 Contribution Guidelines

### Before You Start

1. **Review Existing Content**: Familiarize yourself with current vulnerabilities in `VIOLATIONS-GUIDE.md`
2. **Understand the Scope**: Focus on WordPress-specific security issues and guideline violations
3. **Check Educational Value**: Ensure your contribution has clear learning objectives

### Making Changes

1. **Fork the Repository**

   ```bash
   git fork https://github.com/plutzilla/dvwp.git
   ```

2. **Create a Feature Branch**

   ```bash
   git checkout -b feature/your-educational-improvement
   ```

3. **Make Your Changes**
   - Follow WordPress coding standards where appropriate (for educational clarity)
   - Add comments explaining the vulnerability or violation
   - Update `VIOLATIONS-GUIDE.md` with your additions

4. **Test Your Changes**
   - Verify vulnerabilities work as intended in a safe environment
   - Ensure educational value is clear
   - Test in a WordPress development environment

### Documentation Requirements

For each new vulnerability or violation:

1. **Code Comments**: Explain what makes the code vulnerable
2. **VIOLATIONS-GUIDE Entry**: Document the issue type, severity, and learning objective
3. **Example Usage**: Show how the vulnerability could be exploited (safely)
4. **Educational Notes**: Explain the proper way to fix the issue

### Pull Request Process

1. **Title Format**: Use descriptive titles like "Add SQL injection example in user search"
2. **Description**: Include:
   - What vulnerability/violation you added
   - Educational purpose and target skill level
   - How to demonstrate the issue safely
   - References to WordPress security documentation

3. **Required Sections**:

   ```markdown
   ## Educational Purpose
   Brief description of what this teaches

   ## Vulnerability Type
   Category and severity level

   ## Learning Objectives
   What workshop participants should learn

   ## Safety Notes
   Any special precautions needed
   ```

### Code Style Guidelines

- **Intentionally Vulnerable**: Code should be obviously flawed for educational purposes
- **Well-Commented**: Explain why code is wrong and what the fix should be
- **Realistic**: Based on real-world WordPress plugin issues
- **Safe**: Should not cause harm when used properly in educational settings

## 🛡️ Safety Requirements

### Mandatory Safety Checks

- [ ] Code is only dangerous in educational context, not production
- [ ] Vulnerabilities are documented in `VIOLATIONS-GUIDE.md`
- [ ] Clear warnings about educational-only use
- [ ] No actual malicious payloads or harmful code

### Testing Environment

- Use isolated WordPress development installations
- Never test on production or publicly accessible sites
- Document any special setup requirements
- Provide instructions for safe demonstration

## 📚 Educational Standards

### Beginner Level Contributions

- Simple, obvious violations
- Clear code comments
- Basic WordPress security concepts
- Easy-to-understand fixes

### Intermediate Level Contributions

- More subtle security issues
- Multiple vulnerability chains
- WordPress-specific attack vectors
- Real-world exploitation scenarios

### Advanced Level Contributions

- Complex security architecture issues
- Advanced WordPress security concepts
- Multi-step exploitation processes
- Enterprise-level security considerations

## 🎓 Workshop Leader Resources

When contributing workshop materials:

1. **Provide Instructor Notes**: Detailed explanations for workshop leaders
2. **Include Time Estimates**: How long each exercise should take
3. **Skill Prerequisites**: What participants should know beforehand
4. **Learning Outcomes**: Specific skills participants will gain

## 📞 Getting Help

- **Questions**: Open an issue with the `question` label
- **Ideas**: Use the `enhancement` label for feature requests
- **Bugs**: Report issues with the `bug` label (remember, some bugs are intentional!)
- **Security Concerns**: Contact maintainers privately for any actual security issues

## 🏆 Recognition

Contributors will be acknowledged in:

- README.md acknowledgments section
- Workshop materials where applicable
- Educational documentation

## 📄 License Agreement

By contributing, you agree that your contributions will be licensed under the same GPL v2 or later license as the project.

## ⚠️ Ethical Guidelines

### Educational Use Only

- Contributions must serve educational purposes
- No real-world exploitation guidance
- Focus on defensive security training
- Promote responsible disclosure practices

### Responsible Disclosure

- If you discover real vulnerabilities in actual WordPress plugins during your work, follow responsible disclosure
- Report findings to plugin authors and WordPress security team
- Do not use educational work to harm production systems

## 🎯 Quality Standards

### Code Quality

- Clear, readable code (even when intentionally vulnerable)
- Comprehensive comments explaining issues
- Realistic vulnerability scenarios
- Educational value over complexity

### Documentation Quality

- Clear writing suitable for various skill levels
- Step-by-step instructions
- Learning objectives for each component
- Safety warnings where needed
