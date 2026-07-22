# HashOver-md

A self-hosted PHP comment system based on HashOver, substantially modified
for storing comments in Markdown format.

## Origin and Attribution

This project is a modified version of [HashOver](https://github.com/jacobwb/hashover),
created by **Jacob Barkdull** (github.com/jacobwb).

HashOver is a free and open source comment system designed as an alternative
to services like Disqus. It adds a comment section to any website by including
just a few lines of JavaScript or PHP.

### Main Changes from the Original

This project contains substantial modifications from HashOver 1.0.3rc4,
including:

- Custom HTML/CSS template adjustments
- Modifications to the spam filtering logic
- Configuration and localization tweaks
- Other adaptations for our environment


## License

This software is licensed under the **GNU Affero General Public License v3
(AGPL v3)**, as inherited from the original project.

- Copyright © Jacob Barkdull (original work)
- Copyright © Manel Guerra (css, viewing order and markdown format for commetns)

See the [LICENSE](./LICENSE) file for the full text of the license.


## Using HashOver-md

Once the files have successfully been downloaded, extracted, proper permissions set, and setup, all you need to do is copy the code to one of the two following implementation methods and paste it into your webpage(s):

```
<div id="hashover"></div>
<script type="text/javascript" src="/hashover/comments.php"></script>
<noscript>You must have JavaScript enabled to use the comments.</noscript>
```

**Optional**

The following JavaScript tag may be used with any or all of the following variables to disable specific input fields, by placing it before the `<script>` tag mentioned above:

```
<script type="text/javascript">
        var rows="4";        // Sets "Comments" field height
        var name_on="no";    // Disables "Name" field
        var passwd_on="no";  // Disables "Password" field
        var email_on="no";   // Disables "E-mail" field
        var sites_on="no";   // Disables "Website" field
</script>
```

Also, create secrets.php and settings.php from secrets_initial.php and settings_initial.php and replace keys and mails for those created and used by you.

## Documentation

For the original HashOver documentation, please visit the original repository:
https://github.com/jacobwb/hashover