<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="<?php echo URL::asset('images/favicon.ico');; ?>" type="image/x-icon">
<script src="<?php echo URL::asset('bsetec/js/jquery.v1.8.2.js');; ?>" type="text/javascript"></script>
<link href="<?php echo URL::asset('bsetec/css/api_docstyles.css');; ?>" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Instaplus API</title>

<script type="text/javascript">
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
</head>
<body>
<h1 id="title">Instaplus API v1.1 Resources</h1>
<div id="controls">
    <ul>
        <li><a id="toggle-endpoints" href="#">Toggle All Endpoints</a></li>
        <li><a id="toggle-methods" href="#">Toggle All Methods</a></li>
    </ul>
</div>
<ul>
    <li class="endpoint expanded">
        <h3 class="title"><span class="name">Methods</span>
            <ul class="actions">
                <li class="list-methods"><a href="#">List Methods</a></li>
                <li class="expand-methods"><a href="#">Expand Methods</a></li>
            </ul>
        </h3>
        <ul class="methods hidden" style="display: block;">
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">user register</span>
                    <span class="uri">/user/register</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/register" type="hidden">
                    <span class="description">It is used to register the user. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">First Name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First Name.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Last Name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Last Name</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">User Name</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Name.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Password</td>
                                <td class="para">password</td>
                                <td class="parameter">
                                    <input name="password" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Password.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Email</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="required">
                                </td>
                                <td class="type">email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Date Of Birth</td>
                                <td class="para">dob</td>
                                <td class="parameter">
                                    <input name="dob" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Date of Birth (YYYY-MM-DD)</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Gender</td>
                                <td class="para">gender</td>
                                <td class="parameter">
                                    <input name="gender" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>gender (male / female / other)</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Description</td>
                                <td class="para">description</td>
                                <td class="parameter">
                                    <input name="description" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Description</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Profile Pic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Player Id</td>
                                <td class="para">player_id</td>
                                <td class="parameter">
                                    <input name="player_id" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>One Signal - Player id</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Device token</td>
                                <td class="para">device_token</td>
                                <td class="parameter">
                                    <input name="device_token" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device token</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">device type</td>
                                <td class="para">device_type</td>
                                <td class="parameter">
                                    <input name="device_type" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device type android or iphone</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">user login</span>
                    <span class="uri">/user/login</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/login" type="hidden">
                    <span class="description">It is used to login the user. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">UserName/Email</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>UserName/Email</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Password</td>
                                <td class="para">password</td>
                                <td class="parameter">
                                    <input name="password" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Password.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Player Id</td>
                                <td class="para">player_id</td>
                                <td class="parameter">
                                    <input name="player_id" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>One Signal - Player id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Device token</td>
                                <td class="para">device_token</td>
                                <td class="parameter">
                                    <input name="device_token" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device token</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">device type</td>
                                <td class="para">device_type</td>
                                <td class="parameter">
                                    <input name="device_type" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device type android or iphone</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Forgot password -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Forgot password</span>
                    <span class="uri">/user/forgotpassword</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/forgotpassword" type="hidden">
                    <span class="description">It is used to set new password. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">Email</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="required">
                                </td>
                                <td class="type">Email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method put">
                <div class="title">
                    <span class="http-method">PUT</span>
                    <span class="name">Edit profile</span>
                    <span class="uri">/user/profile</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="PUT" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/profile" type="hidden">
                    <span class="description">It is used to edit the user profile. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">First name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First name<</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Last name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>lastname</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Date Of Birth</td>
                                <td class="para">dob</td>
                                <td class="parameter">
                                    <input name="dob" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Date of Birth (YYYY-MM-DD)</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Gender</td>
                                <td class="para">gender</td>
                                <td class="parameter">
                                    <input name="gender" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>gender (male / female / other)</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Description</td>
                                <td class="para">description</td>
                                <td class="parameter">
                                    <input name="description" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Description</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Profile Pic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Profile details</span>
                    <span class="uri">/user/profileinfo</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/profileinfo" type="hidden">
                    <span class="description">It is used to get the user profile information. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="required">
                                </td>
                                <td class="type">numeric</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">member id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="optional">
                                </td>
                                <td class="type">numeric</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member id</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Username</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="optional">
                                </td>
                                <td class="type">string</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Username</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">change password</span>
                    <span class="uri">/user/change_password</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/change_password" type="hidden">
                    <span class="description">It is used to change the user password. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="required">
                                </td>
                                <td class="type">numeric</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">old password</td>
                                <td class="para">old_password</td>
                                <td class="parameter">
                                    <input name="old_password" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>old password</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">new password</td>
                                <td class="para">new_password</td>
                                <td class="parameter">
                                    <input name="new_password" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>new password</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">oauth api</span>
                    <span class="uri">/user/oauth</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/oauth" type="hidden">
                    <span class="description">It is used external appuser login or signup. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">auth_id</td>
                                <td class="para">auth_id</td>
                                <td class="parameter">
                                    <input name="auth_id" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>auth_id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">auth_type</td>
                                <td class="para">auth_type</td>
                                <td class="parameter">
                                    <input name="auth_type" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>auth_type facebook or twitter or google</p></td>
                            </tr>
                             <tr class="required">
                                <td class="name">First Name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First Name.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Last Name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Last Name</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">User Name</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Name.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Email</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="optional">
                                </td>
                                <td class="type">email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Date Of Birth</td>
                                <td class="para">dob</td>
                                <td class="parameter">
                                    <input name="dob" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Date of Birth (YYYY-MM-DD)</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Gender</td>
                                <td class="para">gender</td>
                                <td class="parameter">
                                    <input name="gender" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>gender (male / female / other)</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">ProfilePic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Description</td>
                                <td class="para">description</td>
                                <td class="parameter">
                                    <input name="description" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Description</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Player Id</td>
                                <td class="para">player_id</td>
                                <td class="parameter">
                                    <input name="player_id" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>One Signal - Player id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Device token</td>
                                <td class="para">device_token</td>
                                <td class="parameter">
                                    <input name="device_token" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device token</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">device type</td>
                                <td class="para">device_type</td>
                                <td class="parameter">
                                    <input name="device_type" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device type android or iphone</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method put">
                <div class="title">
                    <span class="http-method">PUT</span>
                    <span class="name">update settings</span>
                    <span class="uri">/user/settings</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="PUT" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/settings" type="hidden">
                    <span class="description">It is used to update settings. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="required">
                                </td>
                                <td class="type">numeric</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">is_notify</td>
                                <td class="para">is_notify</td>
                                <td class="parameter">
                                    <input name="is_notify" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>is_notify 0 or 1</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">is_private</td>
                                <td class="para">is_private</td>
                                <td class="parameter">
                                    <input name="is_private" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>is_private 0 or 1</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">User List</span>
                    <span class="uri">/user/user_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/user_list" type="hidden">
                    <span class="description">It is used to user list. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">keyword</td>
                                <td class="para">keyword</td>
                                <td class="parameter">
                                    <input name="keyword" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>search by keyword</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">sort</td>
                                <td class="para">sort</td>
                                <td class="parameter">
                                    <input name="sort" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>(latest-1,trending-2)</p></td>
                            </tr>
                               <tr class="optional">
                                <td class="name">page_no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>page_no</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Admin Side user list Get - Start -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Admin back-end User List Get</span>
                    <span class="uri">/adminuser/user_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/adminuser/user_list" type="hidden">
                    <span class="description">It is used to user list. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">keyword</td>
                                <td class="para">keyword</td>
                                <td class="parameter">
                                    <input name="keyword" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>search by keyword</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">sort</td>
                                <td class="para">sort</td>
                                <td class="parameter">
                                    <input name="sort" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>(latest-1,trending-2)</p></td>
                            </tr>
                               <tr class="optional">
                                <td class="name">page_no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>page_no</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Admin Side user list Get - End -->
             <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Follow, Block and UnFollow</span>
                    <span class="uri">/user/follow_unfollow_block</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/follow_unfollow_block" type="hidden">
                    <span class="description">It is used to user follow unfollow and block. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-follow,2-block,3-unfollow,4-unblock</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Member ID</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>member_id</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Block List</span>
                    <span class="uri">/user/block_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/block_list" type="hidden">
                    <span class="description">It is used to block list. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">page_no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>page_no</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name"> FileUpload</span>
                    <span class="uri">/fileupload</span>
                </div>
                <form class="hidden" style="display: block;" enctype="multipart/form-data" id="multipart">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/fileupload" type="hidden">
                    <span class="description">It is used to list the recently watched broadcast. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">File</td>
                                <td class="para">file</td>
                                <td class="parameter">
                                    <input type="file" name="file" id="file" />
                                    <!-- <input name="cimage" placeholder="required"> -->
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>File</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Type( avatar / post ).</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Social Image stored in local and view - start -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name"> Social Image Upload</span>
                    <span class="uri">/socialfileupload</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/socialfileupload" type="hidden">
                    <span class="description">It is used to store social login image url to local. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">URL</td>
                                <td class="para">url</td>
                                <td class="parameter">
                                    <input type="text" name="url"/>
                                </td>
                                <td class="type">url</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>url</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Social Image stored in local and view - end -->
              <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Following list</span>
                    <span class="uri">/user/following_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/following_list" type="hidden">
                    <span class="description">It is used to list following persons. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">memberid</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>member_id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">username</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>username</p></td>
                            </tr>
                              <tr class="required">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Followers list</span>
                    <span class="uri">/user/followers_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/followers_list" type="hidden">
                    <span class="description">It is used to list followers persons. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">memberid</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>member_id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">username</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>username</p></td>
                            </tr>
                              <tr class="required">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no</p></td>
                            </tr>
                <tr class="optional">
                                <td class="name">Record</td>
                                <td class="para">record</td>
                                <td class="parameter">
                                    <input name="record" placeholder="optional">
                                </td>
                                <td class="type">query</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Get all follower list for <br/> add group page</p></td>
                            </tr>
                         </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
              <!-- Get Follower list for particular user - start -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Get Request Follower User List</span>
                    <span class="uri">/user/requestlist</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/requestlist" type="hidden">
                    <span class="description">It is used to get the follower request list from table </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page NO</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page NO</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Get Follower list for particular user - end -->
              <!-- Follower Request Accept/Decline - end -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Follower Request Accept/Decline</span>
                    <span class="uri">/user/response_status</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/response_status" type="hidden">
                    <span class="description">It is used to follower user request accept and decline functionality.</span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Connect Id</td>
                                <td class="para">connect_id</td>
                                <td class="parameter">
                                    <input name="connect_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Connect Id.(user_connection table 'id')</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Follower Id</td>
                                <td class="para">follower_id</td>
                                <td class="parameter">
                                    <input name="follower_id" placeholder="optional">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Follower Id ( In decline, follower_id is optional )</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Status</td>
                                <td class="para">status</td>
                                <td class="parameter">
                                    <input name="status" placeholder="required">
                                </td>
                                <td class="type">number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Status : 1-Accept, 0-Decline</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Follower Request Accept/Decline - end -->
              <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Title and Meta infos</span>
                    <span class="uri">/metainfo</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/metainfo" type="hidden">
                    <span class="description">It is used to get the meta information. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>


                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Delete User-->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Delete User</span>
                    <span class="uri">/user/delete_user</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/delete_user" type="hidden">
                    <span class="description">It is used to delete the user. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Delete Id</td>
                                <td class="para">u_id</td>
                                <td class="parameter">
                                    <input name="u_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Delete Id</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <!-- checkfor notify -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Notification</span>
                    <span class="uri">/user/notifications</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/notifications" type="hidden">
                    <span class="description">It is used to receive notifications. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                           <tr class="required">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <!-- checkfor notify -->
              <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Notifications status update</span>
                    <span class="uri">/user/notifications_update</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/notifications_update" type="hidden">
                    <span class="description">It is used to update the notification status.</span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Notification id</td>
                                <td class="para">notification_id</td>
                                <td class="parameter">
                                    <input name="notification_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Notification ids if needed send comma separetd like(1,2).</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
              <!-- Send/email options-->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Send Email</span>
                    <span class="uri">/user/send_email</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/send_email" type="hidden">
                    <span class="description">It is used for sending an email. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Member Id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member Id</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Email Id</td>
                                <td class="para">email_id</td>
                                <td class="parameter">
                                    <input name="email_id" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email Id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Subject</td>
                                <td class="para">subject</td>
                                <td class="parameter">
                                    <input name="subject" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Subject</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Message</td>
                                <td class="para">message</td>
                                <td class="parameter">
                                    <input name="message" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Message</p></td>
                            </tr>

                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <!-- Dashboard Details -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Dashboard Details</span>
                    <span class="uri">/admin/dashboard</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/dashboard" type="hidden">
                    <span class="description">It is used to list the admin dashboard info. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Multiple FileUpload</span>
                    <span class="uri">/multiple_fileuploads</span>
                </div>
                <form class="hidden" style="display: block;" enctype="multipart/form-data" id="multiplefile">
                    <input name="httpMethod" value="POST" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/multiple_fileuploads" type="hidden" />
                    <span class="description">It is used to upload multiple files photo and video. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">File</td>
                                <td class="para">files[]</td>
                                <td class="parameter"><input type="file" name="files[]" id="files" multiple /></td>
                                <td class="type">File</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Files.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit" />
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Get post feeds -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Post Feeds</span>
                    <span class="uri">/post/feeds</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/feeds" type="hidden">
                    <span class="description">It is used get the post feeds. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Feed Type</td>
                                <td class="para">feed_type</td>
                                <td class="parameter">
                                    <input name="feed_type" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-feed listing, 2-feed details.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Feed Id</td>
                                <td class="para">feed_id</td>
                                <td class="parameter">
                                    <input name="feed_id" placeholder="optional">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Feed Id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Member Id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="optional">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Add post</span>
                    <span class="uri">/post</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/post" type="hidden" />
                    <span class="description">It is used to add post. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="required" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Post text</td>
                                <td class="para">post_text</td>
                                <td class="parameter">
                                    <input name="post_text" placeholder="optional" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post text</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post type</td>
                                <td class="para">post_type</td>
                                <td class="parameter">
                                    <input name="post_type" placeholder="required" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post type ['photo', 'video', 'both'] </p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Media data</td>
                                <td class="para">media_data</td>
                                <td class="parameter">
                                    <input name="media_data" placeholder="required" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Multiple media with comma separated values. Media data = a68036bfe9343e966b3c8c15938467f4.png, aa6acc996a75176d2968b3b14d9228c5.webm, 51550ee24980bb27309138dce18bbd26.jpg, 65f6c10ead740cc597f3068b0ea46a6e.mp4</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Latitude</td>
                                <td class="para">latitude</td>
                                <td class="parameter">
                                    <input name="latitude" placeholder="optional"/>
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Latitude</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Longitude</td>
                                <td class="para">longitude</td>
                                <td class="parameter">
                                    <input name="longitude" placeholder="optional" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Longitude</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Location</td>
                                <td class="para">location</td>
                                <td class="parameter">
                                    <input name="location" placeholder="optional" />
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Location</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Edit post</span>
                    <span class="uri">/post/edit-feed</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/post/edit-feed" type="hidden" />
                    <span class="description">It is used to edit post. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="required" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="required" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post id</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Post text</td>
                                <td class="para">post_text</td>
                                <td class="parameter">
                                    <input name="post_text" placeholder="optional" />
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post text</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <!-- Post Action -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Post Action</span>
                    <span class="uri">/post/actionbt</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/actionbt" type="hidden">
                    <span class="description">It is used to perform following actions (Delete, like, comments) in posts. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post Id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post Id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Action Type</td>
                                <td class="para">action_type</td>
                                <td class="parameter">
                                    <input name="action_type" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-Delete, 2-like, 3-comments, 4-delete comment</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Description</td>
                                <td class="para">cmt_desc</td>
                                <td class="parameter">
                                    <input name="cmt_desc" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Comment Description</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Comment Id</td>
                                <td class="para">comment_id</td>
                                <td class="parameter">
                                    <input name="comment_id" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Comment Id</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Post Comments</span>
                    <span class="uri">/post/comments</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/comments" type="hidden">
                    <span class="description">It is used get the post comments. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="optional">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">postid</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>post_id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Photo/video listing</span>
                    <span class="uri">/post/media-listing</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/media-listing" type="hidden">
                    <span class="description">It is used get the posted media listing. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Feed Type</td>
                                <td class="para">feed_type</td>
                                <td class="parameter">
                                    <input name="feed_type" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-photo, 2-video.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Member Id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="optional">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member Id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Get Admin Pages lists</span>
                    <span class="uri">/admin/pages</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/pages" type="hidden">
                    <span class="description">It is used to list the pages info in table. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Sort by</td>
                                <td class="para">sort</td>
                                <td class="parameter">
                                    <input name="sort" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>sort by</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Order by</td>
                                <td class="para">order</td>
                                <td class="parameter">
                                    <input name="order" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Order</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page No</td>
                                <td class="para">page</td>
                                <td class="parameter">
                                    <input name="page" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Filter by</td>
                                <td class="para">filter</td>
                                <td class="parameter">
                                    <input name="filter" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Search option</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <!-- custom page creation action - start -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Page Action</span>
                    <span class="uri">/admin/pageaction</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/pageaction" type="hidden">
                    <span class="description">It is used to perform following actions (New, View, Update, Delete) in page. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Action Type</td>
                                <td class="para">action_type</td>
                                <td class="parameter">
                                    <input name="action_type" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-New,2-View,3-Delete,4-Update <br/>( Delete&View need only four field:User ID, Access Token, Action Type and Page Id)</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Page Id</td>
                                <td class="para">id</td>
                                <td class="parameter">
                                    <input name="id" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page Id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page Title</td>
                                <td class="para">title</td>
                                <td class="parameter">
                                    <input name="title" placeholder="required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page Title</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page Description</td>
                                <td class="para">desc</td>
                                <td class="parameter">
                                    <input name="desc" placeholder="required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Description</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page Alias Name</td>
                                <td class="para">alias</td>
                                <td class="parameter">
                                    <input name="alias" placeholder="required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Meta description</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Meta Key</td>
                                <td class="para">meta_key</td>
                                <td class="parameter">
                                    <input name="meta_key" placeholder="required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Meta kay</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Meta description</td>
                                <td class="para">meta_desc</td>
                                <td class="parameter">
                                    <input name="meta_desc" placeholder="required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Meta description</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Status</td>
                                <td class="para">status</td>
                                <td class="parameter">
                                    <input name="status" placeholder="required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page Stauts ( enable/disable )</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Allow Guest</td>
                                <td class="para">allow_guest</td>
                                <td class="parameter">
                                    <input name="allow_guest" placeholder="required">
                                </td>
                                <td class="type">number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Allow Guest ( 0/1 )</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
        </ul>
    </li>
</ul>

<script src="<?php echo URL::asset('bsetec/js/common.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function() {

    $('form').on('submit', function() {
        var datatype = $(this).attr('id');
        //if($(this).attr('id')!='multipart'){
        var form = $(this);

        var methodtype = $(this).children('input[name=httpMethod]').val();

        var methoduri = $(this).children('input[name=methodUri]').val();
        $("#message").html("<span class='error'>API Request</span>");

        var siteurl = "<?php echo url(); ?>";

        var realpath = siteurl + methoduri;
        if (methodtype == 'DELETE')
        {
            realpath = realpath + '?' + $(this).serialize();
        }
        if(datatype !='multipart' && datatype !='multiplefile'){
               $.ajax({
                type: methodtype,
                url: realpath, // proper url to your "store-address.php" file
                data: $(this).serialize(),
                success: function(msg)
                {
                    var msg1 = JSON.stringify(msg);
                    // $('#my_result' ).text(msg1);
                    form.find('.my_result').text(msg1);
                },
                error: function(msg)
                {
                    var msg1 = JSON.stringify(msg);
                    // $('#my_result' ).text(msg1);
                    form.find('.my_result').text(msg1);
                }
            });
        }

        return false;
    });

    ///multipart data submit
    $("#multipart").submit(function(e)
    {
        var form = $(this);
        var methodtype = $(this).children('input[name=httpMethod]').val();
        var methoduri = $(this).children('input[name=methodUri]').val();
        $("#message").html("<span class='error'>API Request</span>");

        var siteurl = "<?php echo url(); ?>";

        var realpath = siteurl + methoduri;
        if (methodtype == 'DELETE')
        {
            realpath = realpath + '?' + $(this).serialize();
        }

        var formData = new FormData(this);
        $.ajax({
            url: realpath,
            type: methodtype,
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
        success: function(msg)
        {
//           var msg1 = JSON.stringify(msg);

//            form.find('.my_result').text(msg1);
            form.find('.my_result').text(msg);
        },
         error: function(msg)
         {
            //alert(msg);
            var msg1 = JSON.stringify(msg);
            //var msg1 = msg;
            form.find('.my_result').text(msg1);
         }
        });
    });
    $("#multiform").submit();
    $("#multiplefile").submit();

    ///multiplefile data submit
    $("#multiplefile").submit(function(e)
    {
        var form = $(this);
        var methodtype = $(this).children('input[name=httpMethod]').val();
        var methoduri = $(this).children('input[name=methodUri]').val();
        $("#message").html("<span class='error'>API Request</span>");

        var siteurl = "<?php echo url(); ?>";

        var realpath = siteurl + methoduri;
        if (methodtype == 'DELETE')
        {
            realpath = realpath + '?' + $(this).serialize();
        }

        var formData = new FormData(this);
        $.ajax({
            url: realpath,
            type: methodtype,
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
        success: function(msg)
        {
//           var msg1 = JSON.stringify(msg);
           $('input[type=file]').val(null);
            //var msg1 = msg;
            form.find('.my_result').text(msg);
        },
         error: function(msg)
         {
            //alert(msg);
            var msg1 = JSON.stringify(msg);
            $('input[type=file]').val(null);
            //var msg1 = msg;
            form.find('.my_result').text(msg1);
         }
        });
    });
});
</script>
</body>
</html>

