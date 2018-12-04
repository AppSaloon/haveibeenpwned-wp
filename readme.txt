=== Have I Been Pwned WP ===
Contributors: koenHuybrechts
Tags: password, security, have i been pwned
Requires at least: 4.9
Tested up to: 5.0
Requires PHP: 5.6
License: GPL
License URI: https://www.gnu.org/licenses/gpl.html

This plugin will help your website users make secure passwords. Everytime a new password is set,
the plugin will check if the password was leaked in a known data breach.

== Description ==
Protect all website users from using vulnerable passwords to log in to your website.

On a (weekly basis)[https://feeds.feedburner.com/HaveIBeenPwnedLatestBreaches] there are new data breaches
involving usernames, passwords and email addresses. (Have I Been Pwned)[https://haveibeenpwned.com/] tries to
keep track of these breaches and stores an anonymised version of personal data to ensure there is no new risk
of exposure created.

= How does it work? =

When a user updates its password, a call to the API of Have I Been Pwned service to request if this password
was leaked. If this happened, this plugin van send an error to the user to alert.

= Code Quality =

To make sure the quality of the code is optimal and the security risks are as limited as possible, the code of
this plugin is Open Source. You can contribute to the code on the
(Github)[https://github.com/AppSaloon/haveibeenpwned-wp] repository. Don't hesitate to fork and send pull requests!

= Roadmap =

Development of this plugin will continue and there are some enhancement/features lined up:
* Mark users who have a pwned password
* Check passwords on a regular basis (weekly)
* Integrate with costum login plugins


Although, feel free to add feature requests through the support forum. I'm looking forward to your input.

== Frequently Asked Questions ==
= Will my password be exposed? =
No.
This plugin generates a hash of your password and only sends a small part of that hash to the Have I Been Pwned API.
**No password is ever sent to the external parties.**

== Screenshots ==
1. Error message when a pwned password is chosen
2. Settings of the HIBP WP plugin