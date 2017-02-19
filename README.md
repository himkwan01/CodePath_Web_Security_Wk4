# Project 4 - Globitek Authentication and Login Throttling

Time spent: **10** hours spent in total

## User Stories

The following **required** functionality is completed:

1. [x]  Required: Test for initial vulnerabilities

2. [x]  Required: Configure sessions
  * [x]  Required: Only allow session IDs to come from cookies
  * [x]  Required: Expire after one day
  * [x]  Required: Use cookies which are marked as HttpOnly

3. [x]  Required: Complete Login page.
  * [x]  Required: Show an error message when username is not found.
  * [x]  Required: Show an error message when username is found but password does not match.
  * [x]  Required: After login, store user ID in session data.
  * [x]  Required: After login, store user last login time in session data.
  * [x]  Required: Regenerate the session ID at the appropriate point.

4. [x]  Required: Require login to access staff area pages.
  * [x]  Required: Add a login requirement to *almost all* staff area pages.
  * [x]  Required: Write code for `last_login_is_recent()`.

5. [x]  Required: Complete Logout page.
  * [x]  Required: Add code to destroy the user's session file after logging out.
  
6. [x]  Required: Add CSRF protections to the state forms.
  * [x]  Required: Create a CSRF token.
  * [x]  Required: Add CSRF tokens to forms.
  * [x]  Required: Compare tokens against the stored version of the token.
  * [x]  Required: Only process forms data sent by POST requests.
  * [x]  Required: Confirm request referer is from the same domain as the host.
  * [x]  Required: Store the CSRF token in the user's session.
  * [x]  Required: Add the same CSRF token to the login form as a hidden input.
  * [x]  Required: When submitted, confirm that session and form tokens match.
  * [x]  Required: If tokens do not match, show an error message.
  * [x]  Required: Make sure that a logged-in user can use pages as expected.

7. [x]  Required: Ensure the application is not vulnerable to XSS attacks.

8. [x]  Required: Ensure the application is not vulnerable to SQL Injection attacks.

9. [x]  Required: Run all tests from Objective 1 again and confirm that your application is no longer vulnerable to any test.


The following advanced user stories are optional:

* [x]  Bonus Objective 1: Identify security flaw in Objective #4 (requiring login on staff pages)
  * [x]  Identify the security principal not being followed.
  * [x]  Write a short description of how the code could be modified to be more secure.</br>
         The error messages give certain information to the user such as the existence of the username and the correctness of the password. To prevent the information leak, the error message should be general. For example, Invalid username or password for any wrong combination of username and password. 

* [x] Bonus Objective 2: Add CSRF protections to all forms in the staff directory

* [x]  Bonus Objective 3: CSRF tokens only valid for 10 minutes.

* [x]  Bonus Objective 4: Sessions are valid only if user-agent string matches previous value.

* [x]  Advanced Objective: Set/Get Signed-Encrypted Cookie
  * [x]  Create "public/set\_secret\_cookie.php".
  * [x]  Create "public/get\_secret\_cookie.php".
  * [x]  Encrypt and sign cookie before storing.
  * [x]  Verify cookie is signed correctly or show error message.
  * [x]  Decrypt cookie.

## Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='http://i.imgur.com/8lAoHTJ.gif' title='Video Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Describe any challenges encountered while building the app.

## License

    Copyright 2017 Tsz Him Kwan

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
