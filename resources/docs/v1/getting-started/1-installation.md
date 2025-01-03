---
Section: Getting started
---

# Installation

To install the new debug bar for Laravel if you have early access to the private GitHub repository, you can tell Composer to look into it. Add the following lines to your `composer.json` file:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:newdebugbar/newdebugbar.git"
        }
    ]
}
```

Then, if you [added your public SSH key to your GitHub account](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account), all it takes is to run this command:

```bash
composer require newdebugbar/newdebugbar --dev
```

Remember, it's highly discouraged to use the new debug bar in production as it could expose sensitive information to anyone.
